<?php
namespace wechat\pay\lib;

class WxPayDetail
{
    //订单原价
    private $cost_price;
    //商品小票ID
    private $receipt_id;
    //单品列表
    private $goods_detail;
    
    
    
    /**
     * @return the $cost_price
     */
    public function getCost_price()
    {
        return $this->cost_price;
    }

    /**
     * @return the $receipt_id
     */
    public function getReceipt_id()
    {
        return $this->receipt_id;
    }

    /**
     * @return the $goods_detail
     */
    public function getGoods_detail()
    {
        return $this->goods_detail;
    }

    /**
     * @param field_type $cost_price
     */
    public function setCost_price($cost_price)
    {
        $this->cost_price = $cost_price;
    }

    /**
     * @param field_type $receipt_id
     */
    public function setReceipt_id($receipt_id)
    {
        $this->receipt_id = $receipt_id;
    }

    /**
     * @param field_type $goods_detail
     */
    public function setGoods_detail(WxPayGood $wxPayGood)
    {
        $this->goods_detail[] = $wxPayGood;
    }

    
    
    
    
}

?>