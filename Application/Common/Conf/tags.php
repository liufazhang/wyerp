<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 14-8-23
 * Time: 下午2:44
 */
return array(
    // 添加下面一行定义即可
  // 'app_begin' => array('Behavior\CheckLang'),
    // 如果是3.2.1版本 需要改成
     'app_begin' => array('Behavior\CheckLangBehavior'),
    'view_filter' => array('Behavior\TokenBuildBehavior'),

);
