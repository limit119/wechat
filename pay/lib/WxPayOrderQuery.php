<?php
namespace wechat\pay\lib;

use wechat\pay\lib\WxPayDataBase;
class WxPayOrderQuery extends WxPayDataBase
{
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetAppid($value)
    {
        $this->values['appid'] = $value;
    }
    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetAppid()
    {
        return $this->values['appid'];
    }
    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsAppidSet()
    {
        return array_key_exists('appid', $this->values);
    }
    
    
    /**
     * 设置微信支付分配的商户号
     * @param string $value
     **/
    public function SetMch_id($value)
    {
        $this->values['mch_id'] = $value;
    }
    /**
     * 获取微信支付分配的商户号的值
     * @return 值
     **/
    public function GetMch_id()
    {
        return $this->values['mch_id'];
    }
    /**
     * 判断微信支付分配的商户号是否存在
     * @return true 或 false
     **/
    public function IsMch_idSet()
    {
        return array_key_exists('mch_id', $this->values);
    }
    
    
    /**
     * 设置微信的订单号，优先使用
     * @param string $value
     **/
    public function SetTransaction_id($value)
    {
        $this->values['transaction_id'] = $value;
    }
    /**
     * 获取微信的订单号，优先使用的值
     * @return 值
     **/
    public function GetTransaction_id()
    {
        return $this->values['transaction_id'];
    }
    /**
     * 判断微信的订单号，优先使用是否存在
     * @return true 或 false
     **/
    public function IsTransaction_idSet()
    {
        return array_key_exists('transaction_id', $this->values);
    }
    
    
    /**
     * 设置商户系统内部的订单号，当没提供transaction_id时需要传这个。
     * @param string $value
     **/
    public function SetOut_trade_no($value)
    {
        $this->values['out_trade_no'] = $value;
    }
    /**
     * 获取商户系统内部的订单号，当没提供transaction_id时需要传这个。的值
     * @return 值
     **/
    public function GetOut_trade_no()
    {
        return $this->values['out_trade_no'];
    }
    /**
     * 判断商户系统内部的订单号，当没提供transaction_id时需要传这个。是否存在
     * @return true 或 false
     **/
    public function IsOut_trade_noSet()
    {
        return array_key_exists('out_trade_no', $this->values);
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
      * 功 能:获取默认订单状态 
      * 参 数: 
      * 返 回 值: 
      * [1]:
      * 日期: 2018年5月2日
      */
    public static function getStatus($st){
        
        $arr  =  array(
            'SUCCESS'=>'支付成功',
            'REFUND'=>'转入退款',
            'NOTPAY'=>'未支付',
            'CLOSED'=>'已关闭',
            'REVOKED'=>'已撤销（刷卡支付）',
            'USERPAYING'=>'用户支付中',
            'PAYERROR'=>'支付失败(其他原因，如银行返回失败)',
        );
        
        return $arr[$st];
    }
}

?>