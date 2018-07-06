<?php
namespace wechat\entity;


class WechatMsg
{
    
    /**
     * 获取文本消息
     * @return 
     */
    public function getCryptMsg(){
    
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            return  $postObj;
        }
        return null;
    }
    
    
    
    //编辑回复文本消息
    public function text($text){
        
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            
            $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0<FuncFlag>
            </xml>";
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $text);
                return $resultStr;
            }
        }
    }
    
}

?>