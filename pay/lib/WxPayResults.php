<?php
namespace wechat\pay\lib;

/**
 * 支付结果获取
 * @author allen
 *
 */
class WxPayResults extends WxPayDataBase
{
    
    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
    public static function Init($xml)
    {
        $obj = new self();
        $obj->FromXml($xml);
        if($obj->values['return_code'] != 'SUCCESS'){
            return $obj->GetValues();
        }
        $obj->CheckSign();
        return $obj->GetValues();
    }
    
    /**
     *
     * 检测签名
     */
    public function CheckSign()
    {
        //fix异常
        if(!$this->values['sign']){
            throw new WxPayException("签名错误！");
        }
        
        $sign = $this->MakeSign();
        if($this->values['sign'] == $sign){
            return true;
        }
        throw new WxPayException("签名错误！");
    }
    
    
    
/**
	 * 
	 * 获取jsapi支付的参数
	 * @param array $UnifiedOrderResult 统一支付接口返回的数据
	 * @throws WxPayException
	 * 
	 * @return json数据，可直接填入js函数作为参数
	 */
	public static function  GetJsApiParameters($UnifiedOrderResult)
	{

		if(!array_key_exists("appid", $UnifiedOrderResult)
		|| !array_key_exists("prepay_id", $UnifiedOrderResult)
		|| $UnifiedOrderResult['prepay_id'] == "")
		{
			throw new WxPayException("参数错误");
		}
		$jsapi = new WxPayJsApiPay();
		$jsapi->SetAppid($UnifiedOrderResult["appid"]);
		$timeStamp = time();
		$jsapi->SetTimeStamp("$timeStamp");
		$jsapi->SetNonceStr(WxPaySign::getNonceStr());
		$jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
		$jsapi->SetSignType("MD5");
		$jsapi->SetPaySign($jsapi->MakeSign());
		$parameters = json_encode($jsapi->GetValues());
		return $parameters;
	}
    
    
}

?>