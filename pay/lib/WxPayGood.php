<?php
namespace wechat\pay\lib;

/**
 * 微信支付商品详情
 * @author allen
 *
 */
class WxPayGood
{
    
    //商品编码
    private $goods_id;
    //微信侧商品编码
    private $wxpay_goods_id;
    //商品名称
    private $goods_name;
    //商品数量
    private $quantity;
    //商品单价
    private $price;
    
    
    /**
     * @return the $goods_id
     */
    public function getGoods_id()
    {
        return $this->goods_id;
    }

    /**
     * @return the $wxpay_goods_id
     */
    public function getWxpay_goods_id()
    {
        return $this->wxpay_goods_id;
    }

    /**
     * @return the $goods_name
     */
    public function getGoods_name()
    {
        return $this->goods_name;
    }

    /**
     * @return the $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return the $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param field_type $goods_id
     */
    public function setGoods_id($goods_id)
    {
        $this->goods_id = $goods_id;
    }

    /**
     * @param field_type $wxpay_goods_id
     */
    public function setWxpay_goods_id($wxpay_goods_id)
    {
        $this->wxpay_goods_id = $wxpay_goods_id;
    }

    /**
     * @param field_type $goods_name
     */
    public function setGoods_name($goods_name)
    {
        $this->goods_name = $goods_name;
    }

    /**
     * @param field_type $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param field_type $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    
    
    
}

?>