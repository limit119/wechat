<?php
namespace wechat\pay\lib;

/**
 * 签名
 * @author allen
 *
 */
class WxPaySign
{
   
    /**
     * 静态属性
     */
    //签名属性
    public static $MD5= 'MD5';
    public static $HMAC_SHA256= 'HMAC-SHA256';
    

    
    /**
     *
     * 产生随机字符串，不长于32位
     * @param int $length
     * @return 产生的随机字符串
     */
    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }
    
    
    /**
	 * 生成签名
	 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
	 */
	public static function MakeSign(WxPayEntity $Wxpayentity)
	{
		//签名步骤一：按字典序排序参数
		ksort($Wxpayentity->getValue());
		$string = self::ToUrlParams($Wxpayentity->getValue());
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".WxPayConfig::KEY;
		//签名步骤三：MD5加密
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);
		return $result;
	}
	
	
	/**
	 * 格式化参数格式化成url参数
	 */
	public function ToUrlParams($values)
	{
	    $buff = "";
	    foreach ($values as $k => $v)
	    {
	        if($k != "sign" && $v != "" && !is_array($v)){
	            $buff .= $k . "=" . $v . "&";
	        }
	    }
	
	    $buff = trim($buff, "&");
	    return $buff;
	}
	
    
}

?>