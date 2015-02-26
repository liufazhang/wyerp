/**
 * Created by user on 14-12-21.
 */
/*
方法一，添加静态方法
 */

(function($){
    $.fn.extend({
        pluginName:function(a,b){
            return a+b;
        },
        pluginName2:function(){

        }
    })
})(jQuery) ;

(function($){
    $.fn.pluginName3 = function(options){
        var defaults = {
            value1:0,
            value2:0
        };
        var opts = $.extend(defaults,options);//用户传参，无则使用defaults
/*
 pluginName3 实现的代码
 */
       return opts.value1+opts.value2;
        //return 3;
    };
})(jQuery) ;