<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-10-14
 * Time: 上午11:24
 */

namespace Admin\Controller;

use Admin\Controller\AdminController;
class BankCountController extends AdminController{
    public function addBankCount(){
        /*
         * 要判断，如果银行名称在bank数据库中没有，则在bank中添加一个银行
         *
         */
        $_POST['modifyerid']=session('oeId');
        $_POST['mtime']=date("Y-m-d H:i:s");
    /*  foreach($_POST as $key=>$v){
            file_put_contents("d:/WWW/wy_erp/mylog.log","$key :".$v."\r\n",FILE_APPEND);
        }
   */


        $com = D("bankcount");
        if($com->create()){
            $result = $com->add();
            if($result){
                $insertId = $result;
                file_put_contents("d:/WWW/wy_erp/mylog.log","addBankCount true:".$result."\r\n",FILE_APPEND);
            }else{
                $sql =$com->getLastSql();
                file_put_contents("d:/WWW/wy_erp/mylog.log","addBankCount error:".$sql."\r\n",FILE_APPEND);
            }
        }else{
            file_put_contents("d:/mylog.log","addBankCount error:"."\r\n",FILE_APPEND);
        }
        $rel = $com->field('owner,count,bank')->where("id='$insertId'")->select();
        $this->ajaxReturn($rel,"json");

    }
}