<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14-10-25
 * Time: 上午8:40
 */

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller {

    public function index(){
        $this->display();
    }
    public function test(){
        $arr1 = array(1,2,3);
        $info = array('coffee', 'brown', 'caffeine');
        list($a, $b, $c) = $info;
        echo $a." ".$b." ".$c;
        foreach($arr1 as $var){
           // echo "arr1:".$var."</br>";
        }

        $product = array("apple"=>15,"banana"=>"ban");
        $product ["oranger"]="org";
        foreach($product as $k => $v ){
           // echo "key:$k value:$v </br>";
        }
        $arr2 = array(
            array(1,2,3),
            array("apple"=>15,"banana"=>"ban"),
            array("fruit"=>16,"meal"=>"mel"),
        );
        for($row=0 ;$row<3;$row++){
            /*foreach($arr2[$row] as $key => $val){
                echo "key:".$key."val:".$val."</br>";
            }*/
            while(list($key,$val)=each($arr2[$row])){
                echo $key."</br>".$val;
                echo "</br>";
            }
        }


        $arr3 =array(
           array("apple","banana","orange"),
           array(1,2,3),
        );
        for($row=0;$row<2;$row++){
            for($col=0;$col<3;$col++){
               // echo $arr3[$row][$col]."</br>";
            }
        }
    }
    function trim_value(&$value)
    {
        $value = trim($value);
    }

    private static  function test_echo(){
        echo "test";
    }
    public function stringFormat(){
       // $fruit = array('apple','banana ', ' cranberry ');
       // var_dump($fruit);

        //array_walk($fruit, 'trim_value');
       // var_dump($fruit);
       // test_echo();
        $pizza  = "sina@Spo@rts.com";
        $pieces = explode("@", $pizza);
        echo $pieces[0]; // piece1
        echo "</br>";
        echo $pieces[1]; // piece2
        echo "</br>";
        echo $pieces[2]; // piece2
         $str = "/some/hhh/bbb/ccc";
        $str1 = strtok($str,'/');
        echo "</br>";
        echo $str1;
        $str2=strtok('/');
        echo "</br>";
        echo $str2;
        echo "</br>";

        $var = 'abcdefg/mnrporknbcdef';

        echo substr_replace($var,'bob',0,strlen($var))."<br/>\n";
        echo substr_replace($var, 'bob', 10) . "<br />\n";

    }


} 