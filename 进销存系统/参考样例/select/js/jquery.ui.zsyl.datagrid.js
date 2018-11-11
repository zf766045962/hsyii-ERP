//author Luchec Chen 2014-7-26
var defaults;	//默认值 
var isInit="1";//是否是第一次初始化控件，0否1是
(function ($) { 

	var ColorStyleBgMouseMoveVal="#FFFFFF";//定义在不同色调样式时表格行鼠标时背景色

$.fn.zsyl_datagrid_init = function (options) { 
//this.fadeIn('normal'); 

 defaults={
	TotalCol: 3 ,
    Titles: {"0": "a","1": "b","2": "c"} ,
	ColTypes: {"0": "text","1": "text","2": "text"} ,//text img
	ColDisplay: {"0": "block","1": "block","2": "block"} ,
	ImgSize:{"max-width":"30","max-height":"30"} ,
	ColorStyle:'gray' ,
	count_array:0,
	HeadHeight:40 ,
	RowHeight:40 ,
	ToggleSplitPages:false ,//是否打开分页控件
	MaxRowsCount:5 ,    //每页显示几条
	//TotalPage:10 , ///总页数 通过外部计算传入后得到，此处暂做模型使用
	//PagesTabCount:10 ,//分页控件最大显示分页按钮，只能为正数，不能为基数，只能为偶 ,
	TotalElementCount:0 ,//总共有多少元素要使用
	onRowClick:function(){} ,
	onPageClick:function(){}//点击分页控制器标签
	};
	if ( options ) {   
        $.extend( defaults, options );  
      }
	defaults.ColorStyle='gray';
							  //开始组装HTML字符串
							 
	var outHTML="<table width='100%' border='0' cellpadding='0' cellspacing='1' id='zsyl_datagrid'><tr id='datagrid_head'>";
	var i=0;
	while(i<defaults.TotalCol){
					
		var displayVal="block";
		var displayVal="";
		var titles_array = defaults.Titles[i].split(",");

		if(defaults.ColDisplay[i]=="none") displayVal="none";
		if(titles_array.length == 1){
			outHTML=outHTML+"<td style='display:"+displayVal+";text-align:center'>"+defaults.Titles[i]+"</td>";
		}else{//大于1
			defaults.count_array+= parseInt(titles_array.length-2);	
			outHTML=outHTML+"<td style='display:"+displayVal+";padding:0;'><table style='border-collapse:collapse;' width='100%'><tr style='border-bottom:1px solid #dddddd;'><td style='text-align:center' colspan='"+(titles_array.length-1)+"'>"+titles_array[0]+"</td></tr><tr>";
			for(var j = 1 ; j < titles_array.length;j++){
				if(j!=1){
					outHTML=outHTML+"<td style='padding:0px;text-align:center;border-left:2px solid #ddd'>"+titles_array[j]+"</td>";
				}else{
					outHTML=outHTML+"<td style='padding:0px;text-align:center;'>"+titles_array[j]+"</td>";
				}
			}
			outHTML=outHTML+"</tr></table></td>";
		}
		i++;
	}
	defaults.count_array = defaults.TotalCol+defaults.count_array;
	outHTML+="</tr>";

	//刚开始，为了撑住表格，先输出每页显示条数大小的空表格
	var j=0;
	while(j<defaults.MaxRowsCount){
		outHTML+="<tr id='row' style='height:40px;background-color:#FFFFFF'>";
		var k=0;
		while(k<defaults.TotalCol){
			outHTML+="<td></td>";
			k++;
		}
		outHTML+="</tr>";
		j++;
	}
					
	outHTML+="</table>";//最后
	outHTML+="<div id='page_split_controler'></div>";//分页控制器
	outHTML+="<div id='loading'><img src='../images/loading.gif' id='loading_img' />";
	outHTML+="</div><div id='fn_zsyl_datagrid_mask'></div>";
	this.html(outHTML);
				
	//loading
				
	$("#fn_zsyl_datagrid_mask").hide();
	$("#loading").hide();

	//色调样式
				
	
	$("#product_head").css("height",defaults.HeadHeight);

	$("#row").css("height",defaults.RowHeight);
	if(defaults.ColorStyle=="gray") {
					ColorStyleBgMouseMoveVal="#F0F0F0";
				}else if(defaults.ColorStyle=="blue"){
					ColorStyleBgMouseMoveVal="#9CDAF1";
				}else if(defaults.ColorStyle=="orange"){
					ColorStyleBgMouseMoveVal="#FBD391";
				}
	$("#zsyl_datagrid").addClass("zsyl_datagrid_style_"+defaults.ColorStyle);
	$("#datagrid_head").addClass("head_style_"+defaults.ColorStyle);
	$("#page_split_controler").addClass("split_controller_"+defaults.ColorStyle);//分页控制器样式
	//分页控制器
				
				
				if(defaults.TotalElementCount<=defaults.MaxRowsCount){
					TotalPage=1;
				}else if(defaults.TotalElementCount%defaults.MaxRowsCount==0){
						//alert(defaults.TotalElementCount+":"+defaults.MaxRowsCount);
					TotalPage=parseInt(defaults.TotalElementCount)/parseInt(defaults.MaxRowsCount);
						
				}else{
					TotalPage=Math.floor(defaults.TotalElementCount/defaults.MaxRowsCount)+1;
							//alert(defaults.TotalElementCount+":"+defaults.MaxRowsCount);
				}
				
				
				PagesTabCount=defaults.PagesTabCount;
				if(defaults.ToggleSplitPages){
					show_page_control(1);//打开分页控制器 //这里打开会造成二次回调
					
				}else{
					//回调到插件外部
					//defaults.onPageClick(now_page,TotalPage,defaults.MaxRowsCount);//点击当前页，总页数，每页最大显示行数	
					
				}
				
				var datagrid_top=parseInt($("#datagrid_head").height()+$("#datagrid").offset().top);
				var datagrid_content_height=parseInt($("#zsyl_datagrid").height()-2-defaults.RowHeight);
				$("#fn_zsyl_datagrid_mask").css("top",datagrid_top);
				$("#fn_zsyl_datagrid_mask").css("height",datagrid_content_height);
				$("#loading").css("top",parseInt(datagrid_top+datagrid_content_height/2-16));
				$("#fn_zsyl_datagrid_mask").css("width",parseInt($("#datagrid").width()));
				$("#fn_zsyl_datagrid_mask").show();  
				$("#loading").show(); 

}; 

$.fn.zsyl_datagrid_col_width = function(col,width) { //暴露，设置列宽方法
	$("#datagrid_head").find("td").eq(col).css("width",width);
	$("#datagrid_head").find("td").eq(col).css("max-width",width);
};

$.fn.zsyl_datagrid_min_col_width = function(col,width) { //暴露，设置最小列宽方法
	$("#datagrid_head").find("td").eq(col).css("min-width",width);//min-width必须要设具体值，%没作用
};

$.fn.zsyl_datagrid_col_display = function(col,operate_type){//设置某列隐藏或显示
		var getTR=$("#zsyl_datagrid").find("tr");
		var i=0;
		while(i<defaults.MaxRowsCount+1){
			if(operate_type=="block") operate_type="";
			getTR.eq(i).find("td").eq(col).css("display",operate_type);
			//getTR.eq(i).find("td").eq(col).hide();
			i++;
			} 
		defaults.ColDisplay[col]=operate_type;//赋值
	};
$.fn.zsyl_datagrid_forward_page = function(page){//直接点击某页
	//show_page_control(page);//打开分页控制器
};
$.fn.zsyl_datagrid_is_init = function(pInit){//设置isInit变量
	isInit=pInit;
};
$.fn.zsyl_datagrid_datasource = function(dataurl,set_page){///*set_page=0为默认当前状态*/暴露，设数据源方法
//	console.log(dataurl)
    $.ajax({
        url: dataurl,
        dataType:'json',
        data:{},
        error : function(XMLHttpRequest)
                { alert('链接失败');
                  console.log(XMLHttpRequest.responseText);},
        success:function(data){
        	// console.log(data);
            $("tr").each(function() {   if($(this).attr("id")=="row") $(this).remove();  });
            var datas=data.datas;
            var i=0;
    if (data.datas_count) {
        while(i<datas.length){
                var afterHTML="";
                                
                afterHTML+="<tr id='row' name="+i+" bgcolor='#FFFFFF' onmousemove=this.style.backgroundColor='";
                afterHTML+=ColorStyleBgMouseMoveVal+"' onmouseout=this.style.backgroundColor='#FFFFFF'>";
                var col=0;
                var array_num = 0;
                var num = defaults.TotalCol<defaults.count_array?defaults.count_array:defaults.TotalCol;
                while(col<num){
                    var titles_array = defaults.Titles[array_num].split(",");
                    var displayVal="";
                                    
                    if(defaults.ColDisplay[col]=="none") displayVal="none";
                                        
                    if(typeof(defaults.ColTypes[col])=="undefined" || defaults.ColTypes[col]=="text"){//文本
                        
                        if(titles_array.length==1){
                        	afterHTML=afterHTML+"<td style='display:"+displayVal+";'><div style='height:";
                        	afterHTML+=defaults.RowHeight+"px;line-height:"+defaults.RowHeight;
	                        afterHTML+="px;'><a href='javascript:void(0);' title='"+datas[i][col]+"'>";
	                        afterHTML+=datas[i][col]+"</a></div></td>";
                        }else{
                        	afterHTML=afterHTML+"<td style='display:"+displayVal+";'><table style='border-collapse:collapse;width:100%'><tr>";
                        	for(var z = 0 ; z < titles_array.length-1;z++){
                        		if(z!=0){
                        			afterHTML+="<td style='border-left:2px solid #ddd'>";
                        		}else{
                        			afterHTML+="<td>";
                        		}
                        		afterHTML+="<div style='height:"+defaults.RowHeight+"px;line-height:"+defaults.RowHeight;
                        		afterHTML+="px;'><a href='javascript:void(0);' title='"+datas[i][col+z]+"'>";
                        		afterHTML+=datas[i][col+z]+"</a></div></td>";
                        	}
	                        afterHTML+="</tr></table></td>";
                        }
                        
                    }else if(defaults.ColTypes[col]=="img"){//图像
                        afterHTML=afterHTML+"<td valign='middle' style='display:"+displayVal+";'><img src=";
                        afterHTML+=datas[i][col]+" width="+defaults.ImgSize['max-width'];
                        afterHTML+=" height="+defaults.ImgSize['max-height'];
                        afterHTML+=" onerror=this.src='images/default.png' onload='DrawImage(this,"+defaults.ImgSize['max-width']+",+"+defaults.ImgSize['max-height']+")' /></td>";
                    }
                    if(titles_array.length==1){
                    	col++;
                    }else{
                    	col+=(titles_array.length-1);
                    }
                    array_num++;
                }
                afterHTML+="</tr>";
               //  alert(  afterHTML);
                $("#zsyl_datagrid").append(afterHTML);
                i++;
                if(i==defaults.MaxRowsCount) break;
            }
           }               
           $("tr").each(function(){

                if($(this).attr("id")=="row"){
                    $(this).bind("click", function (e) {defaults.onRowClick($(this).attr("name"),e);});
                }
            });
                /////////////////////////////////////重塑分页控制器
                //alert(data.datas_count+":"+defaults.TotalElementCount);
            if(data.datas_count!=defaults.TotalElementCount){//如果不相等才重塑,因添加或删除数据，都有可能会造成需要重塑
        
                defaults.TotalElementCount=data.datas_count;
                if(data.datas_count<=defaults.MaxRowsCount){
                        TotalPage=1;
                }else if(data.datas_count%defaults.MaxRowsCount==0){
    
                        TotalPage=parseInt(data.datas_count)/parseInt(defaults.MaxRowsCount);
                            
                }else{TotalPage=Math.floor(data.datas_count/defaults.MaxRowsCount)+1;}

                    
                if(now_page>TotalPage) now_page=TotalPage;//说明是删数据
                    
                if(defaults.ToggleSplitPages){
                	var show_page=now_page;
                    if(set_page>0) show_page=set_page;
                    show_page_control(show_page);//打开分页控制器
                }
            }
            $("#fn_zsyl_datagrid_mask").hide();
            $("#loading").hide();
            isInit="0";

        }
    });
    
};


$.fn.zsyl_datagrid_get_column_val = function(row,col){
	var getrow=parseInt(row)+1;//不转数字，会变成字符串来组成，得到01 02 11这类型 
		//alert(getrow);
			if(defaults.ColTypes[col]=="text"){
				// console.log($("#zsyl_datagrid #row").eq(1).find("td").length);
				return $("#zsyl_datagrid #row").eq(row).find("td").eq(col).find("div").text();
			}else if(defaults.ColTypes[col]=="img"){
				return $("#zsyl_datagrid #row").eq(row).find("td").eq(col).find("img").attr("src");	
			}else{
				return $("#zsyl_datagrid #row").eq(row).find("td").eq(col).find("div").text();
			}
			return this;
		//alert(row+":"+col+":"+getVal);
	};
	
})(jQuery);

///////////////////插件内部方法
function DrawImage(ImgD,iwidth,iheight){//控制宽与高
//参数(图片,允许的宽度,允许的高度)
var image=new Image();
image.src=ImgD.src;
if(image.width>0 && image.height>0){

	if(image.width/image.height>= iwidth/iheight){
		if(image.width>iwidth){ 
			ImgD.width=iwidth;
			ImgD.height=(image.height*iwidth)/image.width;
		}else{
			ImgD.width=image.width; 
			ImgD.height=image.height;
		}
		ImgD.alt=image.width+"×"+image.height;
	}else{
		if(image.height>iheight){ 
			ImgD.height=iheight;
			ImgD.width=(image.width*iheight)/image.height; 
		}else{
			ImgD.width=image.width; 
			ImgD.height=image.height;
		}
		ImgD.alt=image.width+"×"+image.height;
		}
	}
}
////////////////////分页控制器

var TotalPage=15;//总页数 通过总数据量计算得到，此处暂做模型使用
var now_page=1;//当前第几页
var PagesTabCount=15;//分页控件最大显示分页按钮，只能为正数，不能为基数，只能为偶数且不等2
var split_page_html="";
var show_pages=15;
function show_page_control(NowPage){
	//alert("TotalPage="+TotalPage);
	split_page_html="";
	now_page=NowPage;
	if(NowPage<1) now_page=1;
	if(NowPage>TotalPage)now_page=TotalPage;
	var i=0;
	var i1=0;
	var i2=0;
	show_pages=15;
	i2=now_page-5;
	if(i2<0) i2=0;
	if(TotalPage<=show_pages)
	{show_pages=TotalPage;i2=0;}

	split_page_html+="<a href='#' onclick='show_page_control(1)'>首页</a><a href='#' onclick='previous_page()'>上一页</a>";

	while((i1<show_pages) && (i2+i1<TotalPage)){//本分页控制器暂时固定显示10个页标签
		i1++;
		i=i2+i1;
		split_page_html+="<a href='#' ";
		if(now_page==i)split_page_html+=" class='current'";
		split_page_html+=" onclick='show_page_control("+i+")'>"+i+"</a>";
		}
	split_page_html+="<a href='#' onclick='next_page()'>下一页</a><a href='#' onclick='show_page_control("+TotalPage+")'>末页</a>";
	//alert(split_page_html);
	$("#page_split_controler").html(split_page_html);
	//alert("高度："+parseInt(total_tr_count*defaults.RowHeight+total_tr_count+1));
	//alert($("#zsyl_datagrid").height());
	//var datagrid_left=parseInt($("#datagrid").offset().left);
	var datagrid_top=parseInt(defaults.RowHeight+$("#datagrid").offset().top);
	var datagrid_content_height=parseInt($("#zsyl_datagrid").height()-2-defaults.RowHeight);
	$("#fn_zsyl_datagrid_mask").css("top",datagrid_top);
	$("#fn_zsyl_datagrid_mask").css("height",datagrid_content_height);
	$("#loading").css("top",parseInt(datagrid_top+datagrid_content_height/2-16));
	$("#fn_zsyl_datagrid_mask").css("width",parseInt($("#datagrid").width()));
	$("#fn_zsyl_datagrid_mask").show();  
	$("#loading").show(); 
	//回调到插件外部
	//
	 if(isInit=="0") {
		 defaults.onPageClick(now_page,TotalPage,defaults.MaxRowsCount);//点击当前页，总页数，每页最大显示行数
	 	//$("#fn_zsyl_datagrid_mask").hide();  
		//$("#loading").hide(); 
	 }
}
//var t="{'firstName': 'cyra', 'lastName': 'richardson', 'address': { 'streetAddress': '1 Microsoft way', 'city': 'Redmond', 'state': 'WA', 'postalCode': 98052 },'phoneNumbers': [ '425-777-7777','206-777-7777' ] }";   
//var jsonobj=eval('('+t+')');    //eval()函数：把json字符串转换为js对象。  
//alert(jsonobj.firstName);   
//alert(jsonobj.lastName);  

function set_grid_Columns(pgridname,pstrColumns){
	//0: "序号,30,none,img",1:"单位编码",2: "单位LOGO",3: "单位名称",4:"单位帐号",5: "创建时间",6: "id"}
	var p_array =pstrColumns.split(',');
	var i,j,k;
    var t_obj=new Array();
	var p_obj=new Array();
	var t_title=new Array();
	for(j=0;j<5;j++){ t_title[j]="";}
	for(i=0;i<p_array.length;i++){
    	t_obj=p_array[i].split(':');
    	for(j=0;j<t_obj.length;j++){
    		 k=j;
    		 if(t_obj[j]=='none') k=2;
    		 if(t_obj[j]=='img') k=3;
    	 	 t_title[k]=get_row_str(t_title[k],i,t_obj[j]);
          }
       }
       data_grid_init(pgridname,p_array.length,str_json(t_title[0]),str_json(t_title[2]),str_json(t_title[3]));
       set_grid_row_width_b(pgridname,t_title[1]);
 }

function data_grid_init(pgridname,pcolnum,ptitlejson,pdispjson,pimgjson){
	 $("#"+pgridname).zsyl_datagrid_init({
	 	    TotalCol:    pcolnum,
 			Titles:      ptitlejson,
 			ColorSytle:  "gray",
 			ColDisplay:  pdispjson,
 			ColTypes:    pimgjson,
 			ToggleSplitPages:true ,PagesTabCount :15 ,MaxRowsCount :15,//每页显示几条
 			onRowClick:  function(row,e){ Row_Click(row,e);},
			onPageClick: function(page,TotalPage,MaxRowsCount){
 	    					getDatas(page,MaxRowsCount);//点击当前页，每页最大显示行数
	    					now_page=page;maxRowsCount=MaxRowsCount;
       				 	}
    		});
}

function str_json(pstr){//上一页/生成显示属性JSON字符串描述方式
	  return eval('({'+pstr+'})');
 }

function get_row_str(poldstr,pi,pstr){//上一页/生成显示属性JSON字符串描述方式
	  var s1="";
	  var s2="";
	  if(pstr.length>0) s2=""+pi+":'"+pstr+"'";
	  if((poldstr.length>0) && (s2.length>0)) s1=",";
	  return poldstr+s1+s2;
 }

function set_grid_row_width(pgridname,pstr){//上一页,字符串设置宽度。10PX,29PX,30PX
	   var p_array = pstr.split(',');
    	for(var i=0;i<p_array.length;i++){
         	$("#"+pgridname).zsyl_datagrid_min_col_width(i,p_array[i]);
        	}
 }

function set_grid_row_width_b(pgridname,pstr){//上一页,字符串设置宽度。10PX,29PX,30PX
	   var p_array = pstr.split(',');
	   var t_obj;
    	for(var i=0;i<p_array.length;i++){
    		t_obj=p_array[i].split(':');
         	$("#"+pgridname).zsyl_datagrid_min_col_width(i,t_obj[1]);
        	}
 }

function previous_page(){//上一页
   show_page_control(parseInt(now_page)-1);
}
function next_page(){//下一页
   show_page_control(parseInt(now_page)+1);
}
