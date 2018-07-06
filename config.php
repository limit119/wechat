<?php

//获取微信token参数
$API_WEXIN_TOKEN = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&';


/****************************************************************8
 * 菜单相关
 */
//创建菜单
$API_WEXIN_MENU_CREATE = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=';
$API_WEXIN_MENU_GET = 'https://api.weixin.qq.com/cgi-bin/menu/get?';


//获取用户信息
$API_WEXIN_USERINFO = 'https://api.weixin.qq.com/cgi-bin/user/info?';




/**
 * 网页权限获取
 */
$API_WEXIN_WEB_AUTH = "https://open.weixin.qq.com/connect/oauth2/authorize?";
$API_WEXIN_WEB_AUTH_TOKEN = "https://api.weixin.qq.com/sns/oauth2/access_token?";
$API_WEXIN_WEB_AUTH_USERINFO = "https://api.weixin.qq.com/sns/userinfo?";



//微信前端js票据
$API_WEIXIN_JS_TICKET ="https://api.weixin.qq.com/cgi-bin/ticket/getticket?";


//微信获取素材
$AP_WEIXIN_TUWEN = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=';

//客服消息接口
$API_WEIXIN_KEFUINFO = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=";
//发送模板消息
$API_WEIXIN_MODELINFO = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=";

//添加客服
$API_WEIXIN_KEFULIST = "https://api.weixin.qq.com/cgi-bin/customservice/getkflist?";

