<?php
namespace  wechat\entity;
/**
 * 微信菜单ID
 * @author allen
 *
 */
class MenuEntity
{
    
    public static $click = 'click';
    public static $view = 'view';
    public static $scancode_push = 'scancode_push';
    public static $scancode_waitmsg = 'scancode_waitmsg';
    public static $pic_sysphoto = 'pic_sysphoto';
    public static $pic_photo_or_album = 'pic_photo_or_album';
    public static $pic_weixin = 'pic_weixin';
    public static $location_select= 'location_select';
    public static $media_id = 'media_id';
    public static $view_limited = 'view_limited';
    public static $miniprogram = 'miniprogram';
    
    
    
    public $type;
    public $name;
    public $key;
    public $url;
    public $mediaid;
    public $appid;
    public $pagepath;
    public $id;
    public $pid;
    
    public function __construct($entiry_menu){
        $this->setType($entiry_menu['type']);
        $this->setName($entiry_menu['name']);
        $this->setKey($entiry_menu['key']);
        $this->setUrl($entiry_menu['url']);
        $this->setMediaid($entiry_menu['media_id']);
        $this->setAppid($entiry_menu['appid']);
        $this->setPagepath($entiry_menu['pagepath']);
    }
    
    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return the $media_id
     */
    public function getMediaid()
    {
        return $this->media_id;
    }

    /**
     * @return the $appid
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @return the $pagepath
     */
    public function getPagepath()
    {
        return $this->pagepath;
    }

    /**
     * @param field_type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param field_type $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param field_type $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $media_id
     */
    public function setMediaid($media_id)
    {
        $this->mediaid = $media_id;
    }

    /**
     * @param field_type $appid
     */
    public function setAppid($appid)
    {
        $this->appid = $appid;
    }

    /**
     * @param field_type $pagepath
     */
    public function setPagepath($pagepath)
    {
        $this->pagepath = $pagepath;
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $pid
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }


    
    
    
}

?>