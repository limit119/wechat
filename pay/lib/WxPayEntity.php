<?php
namespace   wechat\pay\lib;

/**
 * 
 * @author allen
 *
 */

class WxPayEntity extends WxPayDataBase
{
    
    public static $JSAPI='JSAPI',$NATIVE= 'NATIVE' ,$APP = 'APP';
    
    //公众账号ID
    public $appid;
    //商户号
    public $mch_id;
    //设备号
    public $device_info;
    //随机字符串
    public $nonce_str;
    //签名
    public $sign;
    //签名类型
    public $sign_type;
    //商品描述
    public $body;
    //商品详情
    public $detail;
    //附加数据
    public $attach;
    //商户订单号
    public $out_trade_no;
    //标价币种
    public $fee_type = 'CNY';//人民币
    //标价金额   订单总金额，单位为分
    public $total_fee;
    //终端IP
    public $spbill_create_ip;
    //交易起始时间
    public $time_start;
    //交易结束时间	
    public $time_expire;
    //订单优惠标记
    public $goods_tag;
    //通知地址
    public $notify_url;
    //交易类型  
    public $trade_type;
    //商品ID
    public $product_id;
    //指定支付方式
    public $limit_pay;
    //用户标识
    public $openid;
    //场景信息
    public $screen_info;
    
  
    
    /**
     * @return the $appid
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @return the $mch_id
     */
    public function getMch_id()
    {
        return $this->mch_id;
    }

    /**
     * @return the $device_info
     */
    public function getDevice_info()
    {
        return $this->device_info;
    }

    /**
     * @return the $nonce_str
     */
    public function getNonce_str()
    {
        return $this->nonce_str;
    }

    /**
     * @return the $sign
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @return the $sign_type
     */
    public function getSign_type()
    {
        return $this->sign_type;
    }

    /**
     * @return the $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return the $detail
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return the $attach
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @return the $out_trade_no
     */
    public function getOut_trade_no()
    {
        return $this->out_trade_no;
    }

    /**
     * @return the $fee_type
     */
    public function getFee_type()
    {
        return $this->fee_type;
    }

    /**
     * @return the $total_fee
     */
    public function getTotal_fee()
    {
        return $this->total_fee;
    }

    /**
     * @return the $spbill_create_ip
     */
    public function getSpbill_create_ip()
    {
        return $this->spbill_create_ip;
    }

    /**
     * @return the $time_start
     */
    public function getTime_start()
    {
        return $this->time_start;
    }

    /**
     * @return the $time_expire
     */
    public function getTime_expire()
    {
        return $this->time_expire;
    }

    /**
     * @return the $goods_tag
     */
    public function getGoods_tag()
    {
        return $this->goods_tag;
    }

    /**
     * @return the $notify_url
     */
    public function getNotify_url()
    {
        return $this->notify_url;
    }

    /**
     * @return the $trade_type
     */
    public function getTrade_type()
    {
        return $this->trade_type;
    }

    /**
     * @return the $product_id
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * @return the $limit_pay
     */
    public function getLimit_pay()
    {
        return $this->limit_pay;
    }

    /**
     * @return the $openid
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * @return the $screen_info
     */
    public function getScreen_info()
    {
        return $this->screen_info;
    }

    /**
     * @param field_type $appid
     */
    public function setAppid($appid)
    {
        $this->values['appid']= $appid;
        $this->appid = $appid;
    }

    /**
     * @param field_type $mch_id
     */
    public function setMch_id($mch_id)
    {
        $this->values['mch_id']= $mch_id;
        $this->mch_id = $mch_id;
    }

    /**
     * @param field_type $device_info
     */
    public function setDevice_info($device_info)
    {
        $this->values['device_info']= $device_info;
        $this->device_info = $device_info;
    }

    /**
     * @param field_type $nonce_str
     */
    public function setNonce_str($nonce_str)
    {
        $this->values['nonce_str']= $nonce_str;
        $this->nonce_str = $nonce_str;
    }

    /**
     * @param field_type $sign
     */
    public function setSign($sign = '')
    {
        $sign = $this->MakeSign();
        $this->values['sign']= $sign;
        $this->sign = $sign;
    }

    /**
     * @param field_type $sign_type
     */
    public function setSign_type($sign_type)
    {
        $this->values['sign_type']= $sign_type;
        $this->sign_type = $sign_type;
    }

    /**
     * @param field_type $body
     */
    public function setBody($body)
    {
        $this->values['body']= $body;
        $this->body = $body;
    }

    /**
     * @param field_type $detail
     */
    public function setDetail(WxPayDetail $detail)
    {
        $detail = json_encode($detail);
        $this->values['detail']= $detail;
        $this->detail = $detail;
    }

    /**
     * @param field_type $attach
     */
    public function setAttach($attach)
    {
        $this->values['attach']= $attach;
        $this->attach = $attach;
    }

    /**
     * @param field_type $out_trade_no
     */
    public function setOut_trade_no($out_trade_no)
    {
        $this->values['out_trade_no']= $out_trade_no;
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @param string $fee_type
     */
    public function setFee_type($fee_type)
    {
        $this->values['fee_type']= $fee_type;
        $this->fee_type = $fee_type;
    }

    /**
     * @param field_type $total_fee
     */
    public function setTotal_fee($total_fee)
    {
        $this->values['total_fee']= $total_fee;
        $this->total_fee = $total_fee;
    }

    /**
     * @param field_type $spbill_create_ip
     */
    public function setSpbill_create_ip($spbill_create_ip)
    {
        $this->values['spbill_create_ip']= $spbill_create_ip;
        $this->spbill_create_ip = $spbill_create_ip;
    }

    /**
     * @param field_type $time_start
     */
    public function setTime_start($time_start)
    {
        $this->values['time_start']= $time_start;
        $this->time_start = $time_start;
    }

    /**
     * @param field_type $time_expire
     */
    public function setTime_expire($time_expire)
    {
        $this->values['time_expire']= $time_expire;
        $this->time_expire = $time_expire;
    }

    /**
     * @param field_type $goods_tag
     */
    public function setGoods_tag($goods_tag)
    {
        $this->values['goods_tag']= $goods_tag;
        $this->goods_tag = $goods_tag;
    }

    /**
     * @param field_type $notify_url
     */
    public function setNotify_url($notify_url)
    {
        $this->values['notify_url']= $notify_url;
        $this->notify_url = $notify_url;
    }

    /**
     * @param field_type $trade_type
     */
    public function setTrade_type($trade_type)
    {
        $this->values['trade_type']= $trade_type;
        $this->trade_type = $trade_type;
    }

    /**
     * @param field_type $product_id
     */
    public function setProduct_id($product_id)
    {
        $this->values['product_id']= $product_id;
        $this->product_id = $product_id;
    }

    /**
     * @param field_type $limit_pay
     */
    public function setLimit_pay($limit_pay)
    {
        $this->values['limit_pay']= $limit_pay;
        $this->limit_pay = $limit_pay;
    }

    /**
     * @param field_type $openid
     */
    public function setOpenid($openid)
    {
        $this->values['openid']= $openid;
        $this->openid = $openid;
    }

    /**
     * @param field_type $screen_info
     */
    public function setScreen_info(WxPaySceneEntity $screen_info)
    {
        $screen_info = json_encode($screen_info);
        $this->values['screen_info']= $screen_info;
        $this->screen_info = $screen_info;
    }
    /**
     * @return the $values
     */
    public function getvalues()
    {
        return $this->values;
    }

    /**
     * @param multitype: $values
     */
    public function setvalues($values)
    {
        $this->values = $values;
    }


    
    
    
}

?>