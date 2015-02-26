/*
 * 遍历菜单DOM，并在a标签下插入class
 * */

/*function insertClass(){	
	$(".menu").children("ul").find("li").each(function(){
		alert("insertClass");
		if($(this).has("ul")){
			//alert("有子ul");
			if($(this).children("ul").html()==undefined){
				//alert("无子ul");					
				}else{
					
					//$(this).children("ul").css({"border":"2px solid red"});
					//alert($(this).children("ul").html());
					//alert($(this).children("ul").css("display"));
					var classname = "list" + x; 
					x = x +1;
					menulist.push(classname);
					//alert(classname);
					$(this).children("a").addClass(classname);					
									
				}			
			}
	
		}
	});
}

function menustyle(){
	$.each(menulist,function(key,value){
		//alert(key+"="+value);
		var list = "." + value;
		//alert(list);
		$(list).click(function(){
			//$(list).css("background-color","7c7bad" );
			$(list).siblings("ul").slideToggle("slow");
			
			$(list).parent().siblings("li").children("ul").slideUp(); 
			
			$(list).siblings("ul").find("ul").slideUp();
		});
	});
}
*/

 $(document).ready(function(){
	x=1;
 	menulist= new Array();		
 	
 	$(".menu").children("ul").find("li").each(function(){	
 		
		if($(this).has("ul")){				
			if($(this).children("ul").html()==undefined){									
			}else{			
				var classname = "list" + x; 
				x = x +1;
				menulist.push(classname);					
				$(this).children("a").addClass(classname);				
								
			}
			
		}
	
	});
 	
 	$.each(menulist,function(key,value){			
		var list = "." + value;			
		$(list).click(function(){
           // alert($(this).children("ul").html());
			$(list).siblings("ul").slideToggle("slow");
			//隐藏其它同级li下的UL
			$(list).parent().siblings("li").children("ul").slideUp(); 
			//隐藏子级下的的UL
			$(list).siblings("ul").find("ul").slideUp();
		});
	});
 	
 });

 
	




