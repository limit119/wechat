<?php

namespace wechat;

use wechat\entity\WechatEntity;
class WechatWebAuthHelper  
{
    
     const SCOPE_SNSAPI_BASE = 'snsapi_base';
     const SCOPE_SNSAPI_USERINFO = 'snsapi_userinfo';
    
    //wechat类
    private  $wechat;
    
    public function __construct(WechatEntity $we){
        $this->wechat = $we;
    }
    
    /**
     * 获取微信公众号的code
     * @param 重定向URL $redirect
     * @param 公众账号拥有授权作用域 $scope
     * @param 重定向后会带上state参数 $sate
     */
    public function authWebCode($redirect,$scope,$sate){
        //appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
        include  __DIR__.'/config.php';
        $URL = CURL::CURL_URL_GET($API_WEXIN_WEB_AUTH, array(
            'appid'=>$this->wechat->getAppid(),
            'redirect_uri'=> $redirect,
            'response_type'=>'code',
            'scope'=>$scope,
            'state'=>$sate."#wechat_redirect"
        ));
		
        header("Location:".$URL);
        die();
        
    }
    
    
    /**
     * 获取微信公众号的网页授权token
     * @param 网页授权 $code
     */
    public function authWebToken($code){
    
//      https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
        include __DIR__.'/config.php';
        $URL_PARAM = array(
            'appid'=>$this->wechat->getAppid(),
            'secret'=> $this->wechat->getSecret(),
            'code'=>$code,
            'grant_type'=>"authorization_code"
        );
        return CURL::CURL_GET($API_WEXIN_WEB_AUTH_TOKEN, $URL_PARAM);
    }
    

    
    /**
     * 获取微信公众号的网页授权token
     * @param 网页授权 $code
     */
    public function authWebUserInfo($token,$openid){
    
        //https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
        include  __DIR__.'/config.php';
        $URL_PARAM = array(
            'access_token'=>$token,
            'openid'=> $openid,
            'lang'=>'zh_CN'
        );
        return CURL::CURL_GET($API_WEXIN_WEB_AUTH_USERINFO, $URL_PARAM);
    }
}

?>