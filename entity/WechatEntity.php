<?php
namespace wechat\entity;

class WechatEntity
{
    /**
     * 具体的属性
     */
    private  $appid;
    private  $secret;
    
    private  $token;
    private  $aeskey;
    
    private $menus;
    
    
    /**
     * 构造方法
     */
    public function __construct(){
        
        
    }
    
    
    
    
    /**
     * @return the $appid
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @return the $secret
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param field_type $appid
     */
    public function setAppid($appid)
    {
        $this->appid = $appid;
    }

    /**
     * @param field_type $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }
    
    
    /**
     * @return the $token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param field_type $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
    /**
     * @return the $menus
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * @param field_type $menus
     */
    public function setMenus($menus)
    {
        $this->menus = $menus;
    }
    /**
     * @return the $aeskey
     */
    public function getAeskey()
    {
        return $this->aeskey;
    }

    /**
     * @param field_type $aeskey
     */
    public function setAeskey($aeskey)
    {
        $this->aeskey = $aeskey;
    }




    
    
    
    
}

?>