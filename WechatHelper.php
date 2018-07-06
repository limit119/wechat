<?php

namespace wechat;

use wechat\entity\WechatEntity;
//use PHPMailer\PHPMailer\Exception;
class WechatHelper  implements WechatHelperInterface
{
    
    
    //wechat类
    private  $wechat;
    
    public function __construct(WechatEntity $we){
        $this->wechat = $we;
    }
    
    /**
     * 获取微信公众号的token
     */
    public function achiveToken(){
       include __DIR__.'/config.php';
       return  $this->parseDataFromJson( CURL::CURL_GET($API_WEXIN_TOKEN,array('appid'=>$this->wechat->getAppid(),'secret'=>$this->wechat->getSecret()))); 
    }
    
    
    
    /**
     * 获取关注微信的用户信息
     */
    public function achiveUserInfo($openid){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson( CURL::CURL_GET($API_WEXIN_USERINFO,array('access_token'=>$this->wechat->getToken(),'openid'=>$openid,'lang'=>'zh_CN')));
        
    }
    
    
    
    /**********************************************
     * 菜单相关
     */
    
    
    //获取相关菜单
    public  function achiveMenu(){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson(CURL::CURL_GET($API_WEXIN_MENU_GET,['access_token'=>$this->wechat->getToken()]));
        
    }
    
    //生成菜单
    public  function pushMenu(){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson(CURL::CURL_POST($API_WEXIN_MENU_CREATE.$this->wechat->getToken(),$this->wechat->getMenus()));
    }

    //解析数据
    public  function parseDataFromJson($data){

        $ret =  json_decode($data);
        
        if(!empty($ret->errcode) && $ret->errcode!=0 ){
             throw new Exception($ret->errmsg);
        }
        return $ret;
    }
    
   
    
    /* ++++++++++++++++++++++++++++++++++++++++++++
     * 
     * 获取微信前端
     * ++++++++++++++++++++++++++++++++++++++++++++
     */    
    
    /**
      * 功 能:微信前端js票据
      * 参 数: 
      * 返 回 值: 
      * [1]:
      * 日期: 2018年4月14日
      */
    public function achiveTicket(){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson( CURL::CURL_POST($API_WEIXIN_JS_TICKET,['access_token'=>$this->wechat->getToken(),'type'=>'jsapi']));
    }
    
    
    
    /* ++++++++++++++++++++++++++++++++++++++++++++
     *
     * 获取微信客服消息
     * ++++++++++++++++++++++++++++++++++++++++++++
     */
    public function sendMsg($info){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson(CURL::CURL_POST($API_WEIXIN_KEFUINFO.$this->wechat->getToken(),$info));
        
    }
    
    
    //发送模板消息
    public function sendMsgModel($info){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson(CURL::CURL_POST($API_WEIXIN_MODELINFO.$this->wechat->getToken(),$info));
        
    }
    
    
    /* ++++++++++++++++++++++++++++++++++++++++++++
     *
     * 获取微信图文消息
     * ++++++++++++++++++++++++++++++++++++++++++++
     */
    public function getMatetirials($info){
        include __DIR__.'/config.php';
        return  $this->parseDataFromJson(CURL::CURL_POST($AP_WEIXIN_TUWEN.$this->wechat->getToken(),$info));
    
    }



    /* ++++++++++++++++++++++++++++++++++++++++++++
    *
    * 获取客服列表
    * ++++++++++++++++++++++++++++++++++++++++++++
    */
    public  function addStaff(){
        include __DIR__.'/config.php';
        return $this->parseDataFromJson(CURL::CURL_GET($API_WEIXIN_KEFULIST,['access_token'=>$this->wechat->getToken()]));
    }

}

?>