<?php
namespace Admin\Controller;
use Admin\Controller\AdminController;
//use Think\Controller;
class IndexController extends AdminController {
    //public static $html;
   public function index() {
       header("Content-Type:text/html; charset=utf-8");
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->where('sort !=0')->order('id asc')->select(); // 滤除一级菜单这一项
       // dump($list);
        $t = new tree();
        $html = $t->unlimitCategoryFormat($list);
       // dump($html);
      //  print_r($t->treeFormat($html));

       /*
      * 按照id升序 取得PID=0 的顶级菜单
      */
       $menuTop = $m->where('pid = 0')->order('id asc')->select();
      $this->assign('menuTop',$menuTop);
       $this->assign('menu',$t->treeFormat($html));
        $this->display();
    }
    public function menuList() {
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->order('sort asc')->select();
        //dump(MODULE_NAME);
       // $link=U();
       // dump($link);
       	$this->assign('menulist',$list);
        $this->display();
    }
    
    public function menuAdd() {
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->order('sort asc')->select();
       // dump($list);
       // $link=U();
       // dump($link);
       	//$this->assign('menulist',$list);
       // $this->display();
    }

    public function menuLeft(){
        //file_put_contents("d:/WWW/wy_erp/mylog.log","menuLeft:".$_POST['menuId']."\r\n",FILE_APPEND);
        $m = D('Menu');
        $list = $m->field('*,CONCAT(path,"-",id) as path2')->where('sort !=0')->order('id asc')->select(); // 滤除一级菜单这一项
        // dump($list);
        $t = new tree();
        $html = $t->unlimitCategoryFormat($list);
        foreach($list as $_v){
            file_put_contents("d:/WWW/wy_erp/mylog.log","menuLeft:".$_v['title'].$_v['id']."\r\n",FILE_APPEND);
        }
    }
}


class tree {

    static public function unlimitCategoryFormat($cate,$name='child',$pid = 0){
        $arr = array();
        foreach($cate as $_v){
            if($_v['pid'] == $pid){
                $_v[$name] = self::unlimitCategoryFormat($cate,$name,$_v['id']);
                $arr[] = $_v;
                //echo $_v['title'];
            }
            //echo "title".$_v['title']."<br/>";
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
               // $html .= '<li><a href="'.$link.'">'.$_v['title'].'</a>'.'<span>'.$link.'</span>'.self::treeFormat($_v['child']).'</li>';
               $html .= '<li class='."menuLeft".$_v['id'].'><a href="#">'.$_v['title'].'</a>'.'<span>'.$link.'</span>'.self::treeFormat($_v['child']).'</li>';
             // $link=U($_v['link']);
              //  $html .= '<li><a href="xxx">'.$_v['title'].'</a>'.self::treeFormat($_v['child']).'</li>';
            }else{
                if($_v['link']==null){
                    $link="#";
                }else{
                    $link=U($_v['link']);
                }
                //$html .= '<li><a href="'.$link.'">'.$_v['title'].'</a></li>';
                $html .= '<li><a href="#">'.$_v['title'].'</a>'.'<span>'.$link.'</span>'.'</li>';
              //  unset($link) ;

            }
        }
       
        $html .= '</ul>';
        return $html;
    }


}