<?php
namespace wechat\entity;
/**
 * 微信加解密工具
 * @author allen
 *
 */
class CriptTools
{
    
    public $wecahtEntity;//微信实体
    
    /**
     * 验证密文
     * @param 微信加密签名 $signature
     * @param 时间戳   $timestamp
     * @param 随机数 $nonce
     * @param 随机字符串 $echostr
     */
    public function validCrypt($signature,$timestamp,$nonce,$echostr){
        
        //消息加解密密钥
        if (strlen($wecahtEntity->getAeskey()) != 43) {
            return false;
        }
        //令牌(Token)
        $token = $wecahtEntity->getToken();
        if (empty($token)) {
            return false;
        }
        
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return $echostr;
        }else{
            return false;
        }
        
    }
    
    
}

?>