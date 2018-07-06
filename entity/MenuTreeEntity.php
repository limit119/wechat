<?php
namespace wechat\entity;

class MenuTreeEntity
{
    //菜单树
    private $menuTree;
    
    
    public function __construct($menuTree){
        
        $this->setMenuTree($menuTree);
        
    }
    
    /**
     * @return the $menuTree
     */
    public function getMenuTree()
    {
        return $this->menuTree;
    }
    

    /**
     * @param field_type $menuTree
     */
    public function setMenuTree($menuTree)
    {
        $this->menuTree = $menuTree;
    }
    
    /**
     * 获取菜单树
     */
    public function achiveTree(){
        $array_tree = $this->treeWechat($this->treeLevel($this->menuTree, 0));
        $arr['button'] = $array_tree;
        $menu = json_encode($arr,JSON_UNESCAPED_UNICODE);
        return $menu;
        
    }
    
    /**
     * 转换成微信的菜单
     * @param unknown $array
     */
    public function treeWechat($array){
        
        $arr = [];
        //菜单树
        foreach ($array as $key => $val){
        
            unset($array[$key]['id']);
            unset($array[$key]['pid']);
            unset($array[$key]['status']);
            unset($array[$key]['icon']);
            unset($array[$key]['sort']);
            unset($this->menuTree[$key]['sort']);
        
            
            unset($array[$key]['level']);
            unset($array[$key]['addtime']);
            unset($array[$key]['modtime']);
            unset($array[$key]['weid']);
        
            if($val['type']=='view'){
                unset($array[$key]['key']);
                unset($array[$key]['appid']);
                unset($array[$key]['pagepath']);
                unset($array[$key]['media_id']);
                
            }elseif ($val['type']=='miniprogram'){
                
                unset($array[$key]['key']);
                unset($array[$key]['media_id']);
                
            }elseif ($val['type']=='media_id'){
                
                unset($array[$key]['key']);
                unset($array[$key]['appid']);
                unset($array[$key]['pagepath']);
                unset($array[$key]['url']);
                
            }else{
                unset($array[$key]['url']);
                unset($array[$key]['appid']);
                unset($array[$key]['pagepath']);
                unset($array[$key]['media_id']);
            }
            
            if($val['level']=='1' && count($val['sub_button'])>0){
                unset($array[$key]['type']);
                unset($array[$key]['url']);
                unset($array[$key]['key']);
                unset($array[$key]['appid']);
                unset($array[$key]['pagepath']);
                unset($array[$key]['media_id']);
            }
            
           
            if(count($val['sub_button'])>0){
                $array[$key]['sub_button'] = $this->treeWechat($val['sub_button']);
            }else{
                unset($array[$key]['sub_button']);
            }
            
            $arr[] = $array[$key];
        }
        return $arr;
    }
    
    
    /**
     * tree获取菜单树
     */
    public function treeLevel($array,$pid){
        
        $re_array = [];
        foreach ($array as $key => $val){
            //判断类型
            if($val['pid']==$pid){
                unset($array[$key]);
                $val['sub_button'] = $this->treeLevel($array, $val['id']);
                $re_array[] = $val;
            }
        }
        return $re_array;
    }
    
  

    
}

?>