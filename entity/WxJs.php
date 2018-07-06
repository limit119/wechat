<?php
namespace wechat\entity;

/**
 * 签名
 * @author allen
 *
 */
class WxJs
{
   
    public $noncestr='';
    public $jsapi_ticket='';
    public $timestamp='';
    public $url='';
    public $sign ='';
	
    //获取js验证签名
    public function  getJsSignature(){
        $this->noncestr = \wechat\tools\pay\lib\WxPaySign::getNonceStr(16);
        $this->timestamp = time();
        
        $sign['noncestr'] = $this->noncestr;
        $sign['jsapi_ticket'] = $this->jsapi_ticket;
        $sign['timestamp'] = $this->timestamp;
        $sign['url'] = $this->url;
        ksort($sign);
        $buff = "";
        foreach ($sign as $k => $v)
        {
            if($v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        
        $buff = trim($buff, "&");
        $this->sign = sha1($buff);
        return $this->sign;
    }
}

?>