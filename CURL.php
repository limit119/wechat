<?php

namespace wechat;

class CURL
{
    
    /**
     * 拼接参数
     * @param 请求url $url
     * @param 请求参数Array $params
     */
    public static function CURL_URL_GET($url,$params){
        $ret = $url;
        foreach ($params as $key => $val){
            $ret = $ret.$key.'='.$val.'&';
        }
        return $ret;
    }
    
    /**
     * 获取GET类型API数据
     * @param unknown $GET_URL
     * @param unknown $PARAMS
     */
    public static function CURL_GET($GET_URL,$PARAMS){
        
        $URL = CURL::CURL_URL_GET($GET_URL, $PARAMS);
        //初始化
        
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $URL);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, false);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      
        // 跳过证书检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return  $data;
    }
    
    
    
    /**
     * 获取GET类型API数据
     * @param unknown $GET_URL
     * @param unknown $PARAMS
     */
    public static function CURL_POST($URL,$DATA){
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $URL);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        
        // 跳过证书检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $DATA);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //执行命令
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
          return curl_error($curl);
        }
        //关闭URL请求
        curl_close($curl);
        return  $data;
    }
    
    
    
    
}

?>