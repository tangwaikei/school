<?php
return array(
    //'配置项'=>'配置值'
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_name' => 'auth',
    'db_user' => 'root',
    'db_pwd'  => '',
    'db_port' => '3306',
    'db_prefix'=> 'think_',
    'db_charset'=> 'utf8', 

    'SUPERADMIN' => 'yomi',               // 超级管理员    
    'USER_AUTH_ON' => true,               // 开启认证
    'USER_AUTH_TYPE' => 2,                // 默认认证类型，1为登录认证，2为实时认证
    'USER_AUTH_KEY' => 'authId',          // 用户认证SESSION标记
    'ADMIN_AUTH_KEY' => 'administrator',  // 管理员用户标记   
    'USER_AUTH_GATEWAY' => '/Home/Login', // 默认认证网关  

    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则    
     // 定义格式1 数组方式     
     'Admin:accountList'=>  array('Admin/{:action}',10),
     'Admin:accountAdd' =>  array('Admin/{:action}',10), 
     'Admin:accountEdit'=>  array('Admin/{:action}_{id}',10), 
     'Login:index'      =>  array('Login/{:action}',10),
     'Login:logup'      =>  array('Login/{:action}',10),
     'Personal:accountList' => array('Personal/{:action}_{builder}',10),
     'Personal:userEdit' => array('Personal/{:action}_{id}',10),
     'User:userList'     => array('User/{:action}',10),
     'User:userEdit'     => array('User/{:action}_{id}',10),
    ),
    'HTML_PATH'         => '__APP__/html',//静态缓存文件目录，HTML_PATH可任意设置，此处设为当前项目下新建的html目录  
    'HTML_READ_TYPE'    => 1,
    'SHOW_PAGE_TRACE'=>true,//调试模式
    'URL_HTML_SUFFIX' => 'html', //伪静态
);
/*
$config = require './config.php';
$mixed  = array(
	//'配置项'=>'配置值'
	'SUPERADMIN' => 'admin',             // 超级管理员
	'RBAC_ROLE_TABLE' => 'member',       // 角色表
    'RBAC_USER_TABLE' => 'member_group', // 角色分配表
	'RBAC_ACCESS_TABLE' => 'group_rule', // 权限分配表
	'RBAC_NODE_TABLE' => 'rule',         // 权限表
	'default_theme' => 'default',
    'USER_AUTH_ON' => true,               // 开启认证
    'USER_AUTH_TYPE' => 2,			      // 默认认证类型，1为登录认证，2为实时认证
    'USER_AUTH_KEY' => 'authId',          // 用户认证SESSION标记
    'ADMIN_AUTH_KEY' => 'administrator',  // 管理员用户标记
    'USER_AUTH_MODEL' => 'User',          // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5',          // 用户认证密码加密方式
    'USER_AUTH_GATEWAY' => '/Home/Login', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Login,Public',  // 默认无需认证模块
    'REQUIRE_AUTH_MODULE' => '',          // 默认需要认证模块
    'NOT_AUTH_ACTION' => '',              // 默认无需认证操作
    'REQUIRE_AUTH_ACTION' => '',          // 默认需要认证操作
    'GUEST_AUTH_ON' => false,             // 是否开启游客授权访问
    'GUEST_AUTH_ID' => 0,                 // 游客的用户ID
    'URL_MODEL'            => 1,          // URL普通模式
    'URL_HTML_SUFFIX'      => 'html',     // URL伪静态后缀设置
    'URL_CASE_INSENSITIVE' => true,       // URL是否不区分大小写 默认区分大小写
    'DEFAULT_GROUP'        => 'Home',     // 默认分组,可以不写
    'RBAC_ERROR_PAGE'      => './Public/tips/error.html',//错误页面
	);
return array_merge($config,$mixed);
*/