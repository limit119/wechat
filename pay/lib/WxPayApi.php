<?php
namespace wechat\pay\lib;

/**
 * 签名
 * @author allen
 *
 */
class WxPayApi  
{
   
    
    /**
     *
     * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
     * @param WxPayUnifiedOrder $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function unifiedOrder(WxPayEntity $order, $timeOut = 6)
    {
        
        $trade_no = $order->getOut_trade_no();
        if(empty($trade_no)){
            return array('status'=>false,'msg'=>"缺少统一支付接口必填参数out_trade_no！");
        }
        
        $body = $order->getBody();
        if(empty($body)){
            return array('status'=>false,'msg'=>"缺少统一支付接口必填参数body！");
        }
        
        $getTotal_fee = $order->getTotal_fee();
        if(empty($getTotal_fee)){
            return array('status'=>false,'msg'=>"缺少统一支付接口必填参数total_fee！");
        }
        
        $getTrade_type = $order->getTrade_type();
        if(empty($getTrade_type)){
            return array('status'=>false,'msg'=>"缺少统一支付接口必填参数trade_type！");
        }
        
    
        //关联参数
        if($order->getTrade_type() == "JSAPI" && !$order->getOpenid()){
            return array('status'=>false,'msg'=>"统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！");
        }
        if($order->getTrade_type() == "NATIVE" && !$order->getProduct_id()){
            return array('status'=>false,'msg'=>"统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！");
        }
        
    
        //异步通知url未设置，则使用配置文件中的url
        $getNotify_url = $order->getNotify_url();
        if(empty($getNotify_url)){
            $order->setNotify_url(WxPayConfig::NOTIFY_URL);//异步通知url
        }
        
        $order->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);//终端ip
        $order->SetNonce_str(WxPaySign::getNonceStr());//随机字符串
        //签名
        $order->setSign();
        //获取XML信息
        $xml = $order->ToXml();
//         $startTimeStamp = self::getMillisecond();//请求开始时间
        $response = self::postXmlCurl($xml, WxPayConfig::UNIFORM_ORDER, false, 20);
        $result = WxPayResults::Init($response);
//         self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间

        return $result;
    }


    /**
     *  关闭订单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
     * @param WxPayUnifiedOrder $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function closeOrder(WxPayEntity $order, $timeOut = 6)
    {

    }
    
    /**
     *
     * 查询订单，WxPayOrderQuery中out_trade_no、transaction_id至少填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param WxPayOrderQuery $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function orderQuery(WxPayOrderQuery $inputObj, $timeOut = 6)
    {
        //检测必填参数
        if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
            throw new WxPayException("订单查询接口中，out_trade_no、transaction_id至少填一个！");
        }
        
        $inputObj->SetNonce_str(WxPaySign::getNonceStr());
        
        $inputObj->SetSign();//签名
        $xml = $inputObj->ToXml();
    
//         $startTimeStamp = self::getMillisecond();//请求开始时间
        $response = self::postXmlCurl($xml, WxPayConfig::UNIFORM_QUERY, false, $timeOut);
        $result = WxPayResults::Init($response);
//         self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
    
        return $result;
    }
    
    
    /**
     * 以post方式提交xml到对应的接口url
     *
     * @param string $xml  需要post的xml数据
     * @param string $url  url
     * @param bool $useCert 是否需要证书，默认不需要
     * @param int $second   url执行超时时间，默认30s
     * @throws WxPayException
     */
    private static function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    
        //如果有配置代理这里就设置代理
        if(WxPayConfig::CURL_PROXY_HOST != "0.0.0.0"
            && WxPayConfig::CURL_PROXY_PORT != 0){
                curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
                curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
        }
        curl_setopt($ch,CURLOPT_URL, $url);
        
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
        if($useCert == true){
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
        }else{
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验
        }
        
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new WxPayException("curl出错，错误码:$error");
        }
    }
    
    
    /**
     *
     * 支付结果通用通知
     * @param function $callback
     * 直接回调函数使用方法: notify(you_function);
     * 回调类成员函数方法:notify(array($this, you_function));
     * $callback  原型为：function function_name($data){}
     */
    public static function notify($callback, &$msg)
    {
        //获取通知的数据
        $xml = file_get_contents('php://input');
        //如果返回成功则验证签名
        try {
            $result = WxPayResults::Init($xml);
        } catch (WxPayException $e){
            $msg = $e->errorMessage();
            return false;
        }
    
        return call_user_func($callback, $result);
    }
    
    /**
     * 直接输出xml
     * @param string $xml
     */
    public static function replyNotify($xml)
    {
        echo $xml;
    }
    
    
    
    
    
    /**
     *
     * 申请退款，WxPayRefund中out_trade_no、transaction_id至少填一个且
     * out_refund_no、total_fee、refund_fee、op_user_id为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param WxPayRefund $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function refund($inputObj, $timeOut = 6)
    {
        $url = WxPayConfig::REFUND_URL;
        //检测必填参数
        if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
            throw new WxPayException("退款申请接口中，out_trade_no、transaction_id至少填一个！");
        }else if(!$inputObj->IsOut_refund_noSet()){
            throw new WxPayException("退款申请接口中，缺少必填参数out_refund_no！");
        }else if(!$inputObj->IsTotal_feeSet()){
            throw new WxPayException("退款申请接口中，缺少必填参数total_fee！");
        }else if(!$inputObj->IsRefund_feeSet()){
            throw new WxPayException("退款申请接口中，缺少必填参数refund_fee！");
        }else if(!$inputObj->IsOp_user_idSet()){
            throw new WxPayException("退款申请接口中，缺少必填参数op_user_id！");
        }
        
        $inputObj->SetNonce_str(WxPaySign::getNonceStr());//随机字符串
    
        $inputObj->SetSign();//签名
        $xml = $inputObj->ToXml();
        //$startTimeStamp = self::getMillisecond();//请求开始时间
        $response = self::postXmlCurl($xml, $url, true, $timeOut);
        $result = WxPayResults::Init($response);
       // self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
    
        return $result;
    }
    
    /**
     *
     * 查询退款
     * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
     * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
     * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param WxPayRefundQuery $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function refundQuery($inputObj, $timeOut = 6)
    {
        $url = WxPayConfig::REFUND_QUERY;
        //检测必填参数
        if(!$inputObj->IsOut_refund_noSet() &&
            !$inputObj->IsOut_trade_noSet() &&
            !$inputObj->IsTransaction_idSet() &&
            !$inputObj->IsRefund_idSet()) {
                throw new WxPayException("退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！");
            }
            $inputObj->SetNonce_str(WxPaySign::getNonceStr());//随机字符串
    
            $inputObj->SetSign();//签名
            $xml = $inputObj->ToXml();
    
            $startTimeStamp = self::getMillisecond();//请求开始时间
            $response = self::postXmlCurl($xml, $url, false, $timeOut);
            $result = WxPayResults::Init($response);
            self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
    
            return $result;
    }
    
    
    
    /**
     *
     * 打款操作，
     * out_refund_no、total_fee、refund_fee、op_user_id为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param WxPayRefund $inputObj
     * @param int $timeOut
     * @throws WxPayException
     * @return 成功时返回，其他抛异常
     */
    public static function transfer($inputObj, $timeOut = 6)
    {
        $url = WxPayConfig::REFUND_TRANSFER;
        //检测必填参数
        if(!$inputObj->IsPartner_trade_no()) {
            throw new WxPayException("退款申请接口中，out_trade_no、transaction_id至少填一个！");
        }else if(!$inputObj->IsMch_idSet()){
            throw new WxPayException("退款申请接口中，缺少必填参数MCH_ID！");
        }else if(!$inputObj->IsAmount()){
            throw new WxPayException("退款申请接口中，缺少必填参数amount！");
        }else if(!$inputObj->IsDesc()){
            throw new WxPayException("退款申请接口中，缺少必填参数Desc！");
        }else if(!$inputObj->IsOpenid()){
            throw new WxPayException("退款申请接口中，缺少必填参数opendId！");
        }
    
        $inputObj->SetNonce_str(WxPaySign::getNonceStr());//随机字符串
    
        $inputObj->SetSign();//签名
        $xml = $inputObj->ToXml();
        
        //$startTimeStamp = self::getMillisecond();//请求开始时间
        $response = self::postXmlCurl($xml, $url, true, $timeOut);
        $result = WxPayResults::Init($response);
        // self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
    
        return $result;
    }
	
    
}

?>