<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 14-8-27
 * Time: 上午10:49
 */
namespace Admin\Controller;
use Admin\Controller\AdminController;
//use Think\Controller;
class MenuController extends AdminController {
    public function index() {
     /*  header("Content-Type:text/html; charset=utf-8");
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->order('id asc')->select();
      // dump($list);
        $t = new tree();
        $html = $t->unlimitCategoryFormat($list);
      //  print_r($t->treeFormat($html));
       // $this->assign('menu',$t->treeFormat($html));
        $this->display();
        */
    }
    public function menuList() {
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->order('id asc')->select();
      // dump($list);
        $t = new tree();
        $html = $t->unlimitCategoryFormat($list);
      //  print_r($t->treeFormat($html));
        $this->assign('menuWithoutLink',$t->treeFormatWithoutLink($html));
        $this->display();
    }
    
public function menuAdd(){	
	/*
	 * get the parent ID and　path ,
	 * the current menu pid = ID,path= path-ID
	 * */
	$data  = $_POST;	
	$array = array("name" => "Eric","age" => 23);  
	$map['parentMenu']=$data['parentMenu'];	
	$m = M('Menu');	
	//$res = $m -> where("id='%d",$data['id]'])->find();
	$res = $m->where('id='.$data['id'])->find();
	$addMenu['pid']=$res['id'];
	$addMenu['path']=$res['path'].'-'.$res['id'];
	$addMenu['title']=$data['menuTitle'];
	$addMenu['link']=$data['menuLink'];
	$addMenu['status']=$data['menuStatus'];
	$addMenu['sort']=$data['menuSort'];	
	$result= $m->add($addMenu);
	//trace($result,"res");
	 
	//$var = dump($res);
	//$res = $m->where($map)->find();	
    //$this->ajaxReturn(json_encode($array),"json");  
    //file_put_contents("d:/mylog.log","pid:".$addMenu['pid']."path:".$addMenu['path']."\r\n",FILE_APPEND);
     $this->ajaxReturn($data['id'],"json");    
    }
}

class tree {

    static public function unlimitCategoryFormat($cate,$name='child',$pid = 0){
        $arr = array();
        foreach($cate as $_v){
            if($_v['pid'] == $pid){
                $_v[$name] = self::unlimitCategoryFormat($cate,$name,$_v['id']);
                $arr[] = $_v;
            }
        }
        return $arr;
    }

    static public function treeFormat($arr){

        $html = '<ul>';
        foreach($arr as $_v){
            if(!empty($_v['child'])){

                if($_v['link']==null){
                $link="#";
                }else{
                    $link=U($_v['link']);
                }
               $html .= '<li><a href="'.$link.'">'.$_v['title'].'</a>'.'<input class="idhide">'.$_v['id'].'</input>'.self::treeFormat($_v['child']).'</li>';
             // $link=U($_v['link']);
              //  $html .= '<li><a href="xxx">'.$_v['title'].'</a>'.self::treeFormat($_v['child']).'</li>';
            }else{
                if($_v['link']==null){
                    $link="#";
                }else{
                    $link=U($_v['link']);
                }
                $html .= '<li><a href="'.$link.'">'.$_v['title'].'</a>'.'<input class="idhide">'.$_v['id'].'</input>'.'</li>';
              //  unset($link) ;

            }
        }
       
        $html .= '</ul>';
        return $html;
    }
    
 static public function treeFormatWithoutLink($arr){ 
         $html = '<ul>';
        foreach($arr as $_v){
            if(!empty($_v['child'])){
              // $html .= '<li><a>'.$_v['title'].'</a>'.self::treeFormatWithoutLink($_v['child']).'</li>';
                 $html .= '<li><a>'.$_v['title'].'</a>'.'<input class="idhide" value='.$_v['id'].'></input>'.self::treeFormatWithoutLink($_v['child']).'</li>';
            }else{
               // $html .= '<li><a>'.$_v['title'].'</a></li>';
               $html .= '<li><a>'.$_v['title'].'</a>'.'<input class="idhide" value='.$_v['id'].'></input>'.'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
/*
    static public function treeFormat($arr){
        $html = '<ul>';
        foreach($arr as $_v){
            if(!empty($_v['child'])){
                $html .= '<li><a href="#">'.$_v['title'].'</a>'.self::treeFormat($_v['child']).'</li>';
            }else{
                $html .= '<li><a href="#">'.$_v['title'].'</a></li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
*/

}
