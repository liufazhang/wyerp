<?php
namespace Admin\Controller;
use Admin\Controller\AdminController;
use Think\Model;

//use Think\Controller;
class CompanyController extends AdminController {
	public function index() {
        /*
         * 从wy_data_group_access表中读出当前用户对应的datagroupid，
         * 根据datagroupid，从wy_data_group表中，查找数据数据权限规则rules
         * 根据rules，从wy_data_rule中查询数据权限
         * 最后根据数据权限展示company数据
         *
         */
        $uid = session("uid");
        /*
         * 原生语句无法使用mysql_fetch_array()之类的函数
        $m = new Model();
        $sql= "select datagroupid from `wy_data_group_access` where `uid` = $uid";//一对一的关系
        echo "<pre>";
        $res = $m->query($sql);
        $datagroupid= $res[0]['datagroupid'];
       // var_dump($datagroupid);
       $sql = "select rules from `wy_data_group`where `id`=$datagroupid";
        $res =$m->query($sql);
        $rules =$res[0]['rules'];
        $arr = explode(",",$rules);
        $sql = "select `companyid` from `wy_data_rule` where `title`='company' and `id` in(4,6)";// in 里面是常数，能不能用数组？
        //var_dump($sql);
        $res = $m->query($sql);// $res为数组，可能包含多个公司的id，遍历将其信息展示出来
*/
        /*
         * 结果可能是：1，2，。。n   n为wy_data_rule中的id,这里，仅仅显示公司实体数据，
         * 将结果字符串截取为数组，根据数组id，遍历wy_data_rule表,取出title为公司的记录，
         * 根据记录从wy_company表中读出数据并显示
         */

         $m = M('data_group_access');
        $res=$m->where('uid='.$uid)->getField('datagroupid');
        $m =M('data_group');
        $res = $m->where('id='.$res)->getField('rules');
        $m = M('data_rule');
        $res = $m->where("title='%s' and id in(%s)",array("company",$res))-> getField('key');//key为公司id组合，以逗号隔开
        /*
         * 判断是否是最高数据权限用户
         */
        $m = M('company');
        if(strstr($res,'all')===false){
            // $res = $m->where("id in(%s)",$res)->getField('id,name');
            $res = $m->where("id in(%s)",$res)->select();
        }else{
            /*
             * 最高数据权限用户
             */
            $res = $m->select();
        }

        //var_dump($m->getLastSql());
       // var_dump($res);
       $this->assign('oeList',$res);
	   $this->display();
	}
	
	public function companyCreate(){
        $m = M('company');
        /*
         * 判断是创建，还是编辑已经存在的公司，分别显示，如果编辑，设置一个session，在companyAdd中判断
         */
        if($_POST['oeState']=="create"){
            session("oeAction","oeCreate");
		    $this->display();
        }else{
             $oeId = session('oeId');
            session("oeAction","oeEdit");
          //  session("oeId",$oeId);
          //  $sql = "select * from `wy_erp1.0`.`wy_company` where `wy_company`.`id`=$oeId";
            $res = $m->alias('a')->where('a.id='.$oeId)->join('wy_bankcount  ON  wy_bankcount.companyname = a.name')->select();
          // $res = $m->query($sql);
            $this->assign("data",$res[0]);
            $bankList = array();
            foreach($res as  $v){
                $bankList[]=array('owner'=>$v['owner'],'count'=>$v['count'],'bank'=>$v['bank']);
            }

            $this->assign("data",$res[0]);
            $this->assign("bankList",$bankList);
           $this->display();
        }
	}

    public function companySaved(){
        $oeId = $_POST['oeId'];
       // dump($oeId);
        /*
         * 设置一个session，在companyAdd中判断,是创建还是覆盖
         */
       // session("oeAction","oeEdit");
        session("oeId",$oeId);
        /*
        $m = new Model();
        $sql = "select * from `wy_erp1.0`.`wy_company` where `wy_company`.`id`=$oeId";
        $res = $m->query($sql);
        $this->assign("data",$res[0]);
        */
        $m = M("company");
      //  $resOe = $m->where('id='.$oeId)->select();
      //  $m = M("bankcount");
       // $resCt = $m->where();
       // $wish = $JOKES->join('user on jokes.uid = user.id')->order('time DESC')->limit($limit)->select();
        /*
         * 如果存在多個銀行賬號，則結果包含多條記錄
         * 從記錄中取出賬戶 count owner bank 三個字段，放入一個賬戶數組
         * $res為一個二維數組
         */
        $res = $m->alias('a')->where('a.id='.$oeId)->join('wy_bankcount  ON  wy_bankcount.companyname = a.name')->select();
        $bankList = array();
        foreach($res as  $v){
            $bankList[]=array('owner'=>$v['owner'],'count'=>$v['count'],'bank'=>$v['bank']);
        }
      // dump($m->getLastSql());
       // dump($bankList);
       $this->assign("data",$res[0]);
        $this->assign("bankList",$bankList);
        $this->display();

    }
	
	public function companyAdd(){
        /*
         * 判断是编辑还是创建，编辑则覆盖原来的数据。
         *
         * 银行账户关联：
         * 根据count取得账户id，更新companyname字段
         */
        file_put_contents("d:/WWW/wy_erp/mylog.log","companyAdd count:".$_POST['count']."\r\n",FILE_APPEND);
        $action = session('oeAction');
        $oeId = session('oeId');
        $com = M("Company");
        if($action == "oeCreate"){
            // 根据表单提交的POST数据创建数据对象
            if($com->create()){
                 $result = $com->add(); // 写入数据到数据库
                 if($result){
                       // 如果主键是自动增长型 成功后返回值就是最新插入的值
                    $insertId = $result;
                     $data['oeId'] =$insertId;
                     //file_put_contents("d:/WWW/wy_erp/mylog.log","true:".$result."\r\n",FILE_APPEND);
                }else{
                     file_put_contents("d:/WWW/wy_erp/mylog.log","create error:"."\r\n",FILE_APPEND);
                     $data['oeId'] =-1;
                 }
             }else{
                file_put_contents("d:/mylog.log","error:"."\r\n",FILE_APPEND);
                $data['oeId'] =-10;
            }
        }elseif($action == "oeEdit"){
            // update
            $res = $com->create();
                if($res){
                    if( $result = $com->where('id='.$oeId)->save()){
                        $data['oeId']=$oeId;
                    }else{
                        /*
                         * 如果数据没有修改，则会进入这里，保存出错，错误代码？？？
                         */
                        $error = $com->getError();
                        $data['oeId'] =$oeId;
                    }

            }
        }
		$this->ajaxReturn($data,"json");

	}



    public function companyDelete(){
        $m = new Model();
        $data  = $_POST;
        //$data = json_decode($_POST,true);
        //file_put_contents("d:/WWW/wy_erp/companyDelete.log",$data['dat']."\r\n",FILE_APPEND);
      // $data=array(1,2,5);

        foreach($data['data'] as   $v){
            $sql = "DELETE FROM `wy_erp1.0`.`wy_company` WHERE `wy_company`.`id` =$v";
            //file_put_contents("d:/WWW/wy_erp/companyDelete.log","sql".$sql."\r\n",FILE_APPEND);
            $res = $m->execute($sql);
            file_put_contents("d:/WWW/wy_erp/companyDelete.log","res".$res."\r\n",FILE_APPEND);
        }
        $this->ajaxReturn($res,"json");
    }
}