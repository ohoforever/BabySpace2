<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 系统配文件
 * 所有系统级别的配置
 */

//define('UC_TABLE_PREFIX', ''); // 数据表前缀，使用Model方式调用API必须配置此项
return array(
    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
    'DEFAULT_MODULE'     => 'Admin',
    'MODULE_DENY_LIST'   => array('Common','User','Admin'),
    //'MODULE_ALLOW_LIST'  => array('Home','Admin'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => '|s8!B*CSH@(?$"Ae}7>.yv~9[5c=]k;oX`xDzpUf', //默认数据加密KEY

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 3, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => 'strip_tags,htmlspecialchars', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'babyspace.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_NAME'   => 'babyspace', // 数据库名
    'DB_USER'   => 's_all', // 用户名
    'DB_PWD'    => 'wangyafeng',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 't_', // 数据库表前缀
//    'DB_TYPE'   => 'mysql', // 数据库类型
//    'DB_HOST'   => 'sdp4internet.mysql.rds.aliyuncs.com', // 服务器地址
//    'DB_NAME'   => 'kkoil', // 数据库名
//    'DB_USER'   => 'web_all', // 用户名
//    'DB_PWD'    => 'Wangxuebing05',  // 密码
//    'DB_PORT'   => '3306', // 端口
//    'DB_PREFIX' => 't_', // 数据库表前缀

    /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
    
    //模板后辍设置为php
    'TMPL_TEMPLATE_SUFFIX'=>'.php',
);
