<?php
namespace Admin\Controller;
use Admin\Controller\AdminController;
//use Think\Controller;
class DepartmentController extends AdminController {
	public function index() {
        /*
         * 从department中取出数据
         */
		$this->display();
	}

    public function DepartmentCreate(){
        $m = M('department');
        /*
         * 判断是创建，还是编辑已经存在的部门，分别显示，如果编辑，设置一个session，在departmentAdd中判断
         */
        if($_POST['dpState']=="create"){
            session("dpAction","dpCreate");
            $this->display();
        }else{
            $oeId = session('dpID');
            session("dpAction","dpEdit");


            $this->display();
        }
    }
}