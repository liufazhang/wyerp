<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-10-14
 * Time: 上午11:23
 */

namespace Admin\Model;


use Think\Model;

class BankCountModel extends Model {
    protected $insertFields =array( 'name', 'count','company','bank','bankcode');
    protected $_validate = array(
        array('name', 'require', "账户已经存在", self::MUST_VALIDATE , 'unique', self::MODEL_BOTH),
    );
} 