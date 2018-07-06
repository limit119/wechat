<?php
namespace wechat\pay\lib;

/**
 * 场景Entity
 * @author allen
 *
 */
class WxPaySceneEntity
{
    //门店id
    private $id;
    //门店名称
    private $name;
    //门店行政区划码
    private $area_code;
    //门店详细地址
    private $address;
    
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $area_code
     */
    public function getArea_code()
    {
        return $this->area_code;
    }

    /**
     * @return the $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param field_type $area_code
     */
    public function setArea_code($area_code)
    {
        $this->area_code = $area_code;
    }

    /**
     * @param field_type $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    
    
    
}

?>