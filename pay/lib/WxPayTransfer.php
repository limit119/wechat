<?php
namespace wechat\pay\lib;

use wechat\pay\lib\WxPayDataBase;
class WxPayTransfer extends WxPayDataBase
{
   
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetAppid($value)
    {
        $this->values['mch_appid'] = $value;
    }
    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetAppid()
    {
        return $this->values['mch_appid'];
    }
    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsAppidSet()
    {
        return array_key_exists('mch_appid', $this->values);
    }
    
    
    /**
     * 设置微信支付分配的商户号
     * @param string $value
     **/
    public function SetMch_id($value)
    {
        $this->values['mchid'] = $value;
    }
    /**
     * 获取微信支付分配的商户号的值
     * @return 值
     **/
    public function GetMch_id()
    {
        return $this->values['mchid'];
    }
    /**
     * 判断微信支付分配的商户号是否存在
     * @return true 或 false
     **/
    public function IsMch_idSet()
    {
        return array_key_exists('mchid', $this->values);
    }
    
    
    /**
     * 设置微信支付分配的终端设备号，与下单一致
     * @param string $value
     **/
    public function SetDevice_info($value)
    {
        $this->values['device_info'] = $value;
    }
    /**
     * 获取微信支付分配的终端设备号，与下单一致的值
     * @return 值
     **/
    public function GetDevice_info()
    {
        return $this->values['device_info'];
    }
    /**
     * 判断微信支付分配的终端设备号，与下单一致是否存在
     * @return true 或 false
     **/
    public function IsDevice_infoSet()
    {
        return array_key_exists('device_info', $this->values);
    }
    
    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetNonce_str($value)
    {
        $this->values['nonce_str'] = $value;
    }
    /**
     * 获取随机字符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetNonce_str()
    {
        return $this->values['nonce_str'];
    }
    /**
     * 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsNonce_strSet()
    {
        return array_key_exists('nonce_str', $this->values);
    }
    
    /**
     * 设置签名，详见签名生成算法
     * @param string $value
     **/
    public function SetSign()
    {
        $sign = $this->MakeSign();
        $this->values['sign'] = $sign;
        return $sign;
    }
    
    /**
     * 设置订单编号字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetPartner_trade_no($value)
    {
        $this->values['partner_trade_no'] = $value;
    }
    /**
     * 获取订单编号符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetPartner_trade_no()
    {
        return $this->values['partner_trade_no'];
    }
    /**
     * 判断订单编号，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsPartner_trade_no()
    {
        return array_key_exists('partner_trade_no', $this->values);
    }
    
    
    /**
     * 设置用户openid字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetOpenid($value)
    {
        $this->values['openid'] = $value;
    }
    /**
     * 获取用户openid符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetOpenid()
    {
        return $this->values['openid'];
    }
    /**
     * 判断用户openid，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsOpenid()
    {
        return array_key_exists('openid', $this->values);
    }
    
    
    //校验用户姓名选项
    public function SetCheck_name($value){
        if(empty($value)){
            $value = 'NO_CHECK';
        }
        $this->values['check_name'] = $value;
        
    }
    
    /**
     * 设置金额，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetAmount($value)
    {
        $this->values['amount'] = $value;
    }
    /**
     * 获取金额，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetAmount()
    {
        return $this->values['amount'];
    }
    /**
     * 判断金额，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsAmount()
    {
        return array_key_exists('amount', $this->values);
    }
    
    
    
    /**
     * 设置订单编号字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetDesc($value)
    {
        $this->values['desc'] = $value;
    }
    
    /**
     * 获取订单编号符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetDesc()
    {
        return $this->values['desc'];
    }
    /**
     * 判断订单编号，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsDesc()
    {
        return array_key_exists('desc', $this->values);
    }
    
    
    /**
     * 设置订单编号字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetSpbill_create_ip($value)
    {
        $this->values['spbill_create_ip'] = $value;
    }
    
    /**
     * 获取订单编号符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetSpbill_create_ip()
    {
        return $this->values['spbill_create_ip'];
    }
    /**
     * 判断订单编号，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsSpbill_create_ip()
    {
        return array_key_exists('spbill_create_ip', $this->values);
    }
    
    
}

?>