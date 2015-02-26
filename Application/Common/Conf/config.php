<?php
return array(
	//'配置项'=>'配置值'
    'SESSION_AUTO_START' =>true,
    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
   'LANG_AUTO_DETECT' => false, // 自动侦测语言 开启多语言功能后有效
   // 'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
   // 'VAR_LANGUAGE'     => '1', // 默认语言切换变量

    //显示调试信息
	'SHOW_PAGE_TRACE'=>true,
	'LOG_RECORD'=>true,
    'LOG_TYPE'   =>  'File',
	'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,DEBUG,SQL,INFO,NOTICE,WARN',

	/*'TMPL_PARSE_STRING'=>array(
		'__STATICS__'=>__ROOT__.'/statics'
		),
		*/

	//数据库配置
	//pdo类型,采用dsn方式连接
	'DB_TYPE'=>'pdo',
	'DB_USER'=>'root',
	'DB_PWD'=>'root',
	'DB_PREFIX'=>'wy_',
	'DB_PORT'=>'3306',
	'DB_DSN'=>'mysql:host=127.0.0.1;dbname=wy_erp1.0;charset=utf8',

	//权限验证设置
	'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'wy_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'wy_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'wy_auth_rule', //权限规则表
        'AUTH_USER' => 'wy_members'//用户信息表
    ),
    //超级管理员id,拥有全部权限,只要用户uid在这个角色组里的,就跳出认证.可以设置多个值,如array('1','2','3')
    'ADMINISTRATOR'=>array('1'),
);