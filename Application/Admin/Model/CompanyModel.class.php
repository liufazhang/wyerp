<?php
namespace Admin\Model;
use Think\Model;

class CompanyModel extends Model{
    protected $insertFields = array('id', 'name', 'pname', 'legalperson', 'tax', 'registration', 'contacts', 'phone', 'qq', 'email', 'country', 'province', 'city', 'postcode', 'address', 'oeslogan', 'website');
    protected $updateFields =array('id', 'name', 'pname', 'legalperson', 'tax', 'registration', 'contacts', 'phone', 'qq', 'email', 'country', 'province', 'city', 'postcode', 'address', 'oeslogan', 'website');

    protected $_validate = array(
        array('name', '', '标识已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
      
    );
} 