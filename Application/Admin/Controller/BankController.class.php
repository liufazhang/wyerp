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
        $data['name'] = $_POST['name'];
        $data['code'] = $_POST['code'];
        $this->ajaxReturn($data,"json");
    }

public function bankList(){
    /*
     * 每一次点击都会从数据库读，为了只读一次，要设置一个Session变量
     */

    $bankListFlag = session("bankListFlag");
    file_put_contents("d:/mylog.log","bankListFlag".$bankListFlag."\r\n",FILE_APPEND);
    if(!$bankListFlag){
        $bankListFlag = true;
        session('bankListFlag',$bankListFlag);
        $com = D("Bank");
        $rel = $com->field('code,name')->select();
        /*  foreach($rel as $val){
              file_put_contents("d:/mylog.log","code:".$val['code']."::name:".$val['name']."\r\n",FILE_APPEND);
          }*/
        //  $data['name']="success";
        $rel['bankListFlag']=false;

        file_put_contents("d:/mylog.log","bankListFlag222222".$rel['bankListFlag']."\r\n",FILE_APPEND);
         $this->ajaxReturn($rel,"json");
        }else{
            $rel['bankListFlag']=true;
             file_put_contents("d:/mylog.log","bankListFlag33333333332".$rel['bankListFlag']."\r\n",FILE_APPEND);
             $this->ajaxReturn($rel,"json");
    }
    }

} 