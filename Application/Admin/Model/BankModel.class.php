<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-10-9
 * Time: 下午7:37
 */

namespace Admin\Model;
use Think\Model;

class BankModel extends Model{
    protected $_validate = array(
        array('name', 'require', '银行已经存在', self::MUST_VALIDATE , 'unique', self::MODEL_BOTH),
    );
} 