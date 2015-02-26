<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-10-13
 * Time: 下午4:08
 */

namespace Admin\Controller;
use Admin\Controller\AdminController;
//use Think\Controller;
class BankController extends AdminController {
    public function bankCreate(){
        $com = D("Bank");
        if($com->create()){
            $result = $com->add();
            if($result){
                $insertId = $result;
                $data['name'] =$insertId;
                file_put_contents("d:/WWW/wy_erp/mylog.log","bankCreate true:".$result."\r\n",FILE_APPEND);
            }else{
                file_put_contents("d:/WWW/wy_erp/mylog.log","bankCreate error:"."\r\n",FILE_APPEND);
                $data['name'] ="bankCreate error";
            }
        }else{
            file_put_contents("d:/mylog.log","error:"."\r\n",FILE_APPEND);
            $data['name'] =" bankCreate insert error";
        }
        /* if(!$com->create($_POST)){
             exit($com->getError());
         }*/
        $data['name'] = $_POST['name'];
        $data['code'] = $_POST['code'];
        $this->ajaxReturn($data,"json");
    }

public function bankList(){
    $com = D("Bank");
    $rel = $com->field('code,name')->select();
        /*  foreach($rel as $val){
              file_put_contents("d:/mylog.log","code:".$val['code']."::name:".$val['name']."\r\n",FILE_APPEND);
          }*/
  //  $data['name']="success";
    $this->ajaxReturn($rel,"json");
    }
} 