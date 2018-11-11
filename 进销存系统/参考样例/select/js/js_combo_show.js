function getQueryString(name) { //获取URL参数名
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var rn=1;
	var r = window.location.search.substr(1).match(reg); 
	if (r != null) rn= unescape(r[2]); 
	return rn; 
  } 

 function set_data_pick(d_object,padd) {
		 if (padd>0) padd=30;
		$( "#".d_object ).datepicker({
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true,
			yearRange: "c:c+"+padd});
		 $( "#".d_object ).datepicker( "option", "dateFormat", 'yyyy-mm-dd' );
	 }

	 function get_project_combo(pname,projectid) {
			get_combo_list("belong_loading","get_project_combo","project","id","name",projectid);
		}

		function show_project_combo(pdata,projectid) {
			show_combo_list("belong_loading","project",pdata,"id","name",projectid);
		}

	 function get_club_project_combo(club_id) {
		 var s1 ="&club_id=0";
		 if(club_id === undefined){} else{ s1 ="&club_id=" + club_id;};
			get_combo_list("belong_loading","get_club_project_combo" + s1,"project","id","name",0);
		}
		//获取俱乐部ID和club_name
		function get_club_combo(pclubid) {
			get_combo_list("belong_loading","get_club_combo","club","id","name",pclubid);
		}
		function show_club_combo(pdata,pclubid) {
			show_combo_list("belong_loading","club",pdata,"id","name",pclubid);
		}

		//获取俱乐部ID和club_name
		function create_club_combo() {
			get_combo_list("belong_loading","get_club_combo","club","id","name",0);
		}

		function create_project_combo() {
			get_combo_list("belong_loading","get_project_combo","project","id","name",0);
		}

		function show_combo_with_data(comname,pdata,p_choseid,pkname,pdname) {
			show_combo_list("belong_loading",comname,pdata,pkname,pdname,p_choseid);
		}
	 //   show_combo_with_data("state",data.state,data.passed,"f_code","f_name");
// 控件对象名，对象ID,数据，数据ID,数据名称，默认知道
function show_combo_list(pcom,pcomid,data,pitem_id,pitem_name,pchoseid) {
		//    $("#"+pcom).show();
				$("#"+pcom).css("left", document.body.clientWidth / 2);
				$("#"+pcom).css("top", 100);
				show_combo_old(pcomid,data,pitem_id,pitem_name,pchoseid);
				$("#"+pcom).hide();
	}
//初始化下拉选项的
//pcomid=下来控件的名称
//data下拉控制的值
//下拉控件的编码和名称pitem_id,pitem_name
//默认选择pchoseid
function show_combo_old(pcomid,data,pitem_id,pitem_name,pchoseid) {
				var i = 0;var s1,s2,s3;
				$("#"+pcomid+"_id").val(-1);
				$("#"+pcomid+"_list").empty();
				$("#"+pcomid+"_list").append("<option value='-1'>请选择</option>");
				 if (typeof(data.length) != "undefined") {
						while (i < data.length) {
							s2="";
							s3=data[i][pitem_id];
							if(s3==pchoseid) { s2=" selected ";  $("#"+pcomid+"_id").val(s3);}
							 s1="<option value='" +s3+ "' "+s2+">" + data[i][pitem_name]+"</option>";
							 $("#"+pcomid+"_list").append(s1);
							 i++;
						}
				}
	}
 
function get_combo_list(pcom,paction,pcomid,pitem_id,pitem_name,pchoseid) {
			 /////////////////遮罩
		//alert("data_interfaces.php?action="+paction+'=='+pcomid+"_list,id="+pchoseid);
				$("#"+pcom).show();
				$("#"+pcom).css("left", document.body.clientWidth / 2);
				$("#"+pcom).css("top", 100);
				$("#"+pcom).hide();
				var	url="data_interfaces.php?action="+p_action+" &select_id="+$("#select_id").val();				
				save_get_data("del_data","",url,show_combo_list(pcom,pcomid,data,pitem_id,pitem_name,pchoseid));
		
		}

		//第一个参数为action名称，第二个参数为接口文件名称,默认为data_interfaces.php
	function del_info(p_action,p_url="data_interfaces.php"){
		 $("#menu").hide();
		if(window.confirm('你确定要删该数据吗？'+$("#select_id").val() )){
				$("#action").val(p_action);
				var post_data=$("#info_form").serialize();
				var	url=p_url+"?action="+p_action+"&select_id="+$("#select_id").val();
				save_get_data("del_data",post_data,url,getDatas(now_page,10));
		}
}


function show_title(pnews_type,ptitle1,ptitle2,ptitle3,ptitle4){
	var typename="";
	 if(pnews_type==0) typename=ptitle1;
		if(pnews_type==1) typename=ptitle2;
		if(pnews_type==2) typename=ptitle3;
		if(pnews_type==3) typename=ptitle4;
		$("#news_name").html(typename);
}

function show_news_title(info_id,pnews_type,stype){
	$("#news_type").val(pnews_type);
	$("#sclub_id").val(info_id);
	if (stype==0) show_title(pnews_type,"动态信息列表","动态图集列表","动态视频列表");
	if (stype==1) show_title(pnews_type,"动态信息明细","动态图集明细","动态视频明细");
}

function show_club_title(club_id,club_type,stype){
	if (club_id>-2) $("#club_id").val(club_id);
	$("#news_type").val(club_type); 
	if (stype==0) show_title(club_type,"双创单位列表",'',"战略合作伙伴列表","供应商信息列表");
	if (stype==1) show_title(club_type,"双创单位明细",'',"战略合作伙伴明细","供应商信息明细");
}

function create_msg_box(pvis){
	 show_mask(1,pvis)
 }

function show_mask(vmask,vloading){
	 $("#operate_mask").css("height", document.body.scrollHeight + 250);//250是ckedit的高，这个body统计不到
	 $("#operate_loading").css("left", document.body.clientWidth / 2);
	 $("#operate_loading").css("top", 300);
	 show_mask_ing(vmask,"operate_mask");
	 show_mask_ing(vloading,"operate_loading");
}

function show_mask_ing(vmask,mname){
	 if(vmask==1) $("#"+mname).show();
	 if(vmask==0) $("#"+mname).hide();
}

function check_input_isnull(pinputname,pmeg,pfocus) {
			if ($("#"+pinputname).val() == "") {
					 create_msg_box(1);
					 alert(pmeg+"不能为空");
					 if (!pfocus=="") $("#"+pfocus).focus();
						show_mask(0,0);
						return 1;}
			 return 0;
		}

function del_project_item(item_id) {
		if (window.confirm('你确定要删该项目吗？')) {
					show_club_project(item_id);//表示不删除
				}
		}

function show_projects(projects) {
	var j = 0;
	while (j < projects.length) {
				 func_add_project(projects[j].project_id,projects[j].project_name);
				j++;
		}
}
 
function func_add_project(project_id,project_name,type){ 
		var project_ids_array = $("#project_ids").val().split('|');
		var j = 0;
		while (j < project_ids_array.length) {
				if (($("#project_list").val() == project_ids_array[j])&&(type==1)) {
						alert("项目重复");
						return;
				}
				j++;
		}
		$("#project_names").val($("#project_names").val() + "|" + project_name);
		$("#project_ids").val($("#project_ids").val() + "|" + project_id);        
		 show_club_project(0);//表示不删除
		}

function show_club_project(item_id) {
				var project_ids_array = $("#project_ids").val().split('|');
				var project_names_array = $("#project_names").val().split('|');
				var j = 0;
				var bk= "";  var re_ids = "";
				var re_names = "";
				var p_html ="";
				while (j < project_ids_array.length) {
						if (item_id != project_ids_array[j]) {
								re_ids += bk+ project_ids_array[j];
								re_names +=bk+ project_names_array[j];bk="|";
								p_html =p_html + " <div class='code_list_item' id=item_div_id_" + project_ids_array[j]+ ">";
								p_html =p_html + project_names_array[j]+ "<div class='code_list_item_circle_del'>";
								p_html =p_html +"<img src='images/del.png' width='32'height='32'";
								p_html =p_html +" onclick='del_project_item(" + project_ids_array[j]+ ");";
								p_html =p_html +"'style='cursor:pointer;' title='删除'/></div>";
								}
						j++;
				}
				$("#project_ids").val(re_ids);
				$("#project_names").val(re_names);
				$("#project_item_container").html(p_html);
		}

function show_club_name(combo_name,show_name) {$("#"+combo_name).val(show_name); }

function show_radio_botton(combo_name1,combo_name2,show_com1) {
		 if (show_com1) combo_name2=combo_name1;
		 $("#"+combo_name2).attr("checked","checked");
		}

function label_show_hide(plabelname,pshow){
		if (pshow) {$("#"+plabelname).show();} 
			 else{$("#"+plabelname).hide(); }  
}

function show_value(plabelname,pvalue){
	if (pvalue==null) pvalue="";
    if (pvalue=="null") pvalue="";
    $("#"+plabelname).val(pvalue); 
}

//显示标签
function label_text_show(plabelname,pvalue,ptype){
	var s1 ="#"+ptype+"_"+plabelname;
	if ( $(s1).length > 0 )
		 $(s1).html(pvalue);
}

//显示标签
function is_null(pvalue){
    if (pvalue==null) pvalue="";
    if (pvalue=="null") pvalue="";
	return pvalue;
}

//plabelname 对象名称,pvalue 值 ,porder 图片的序号值
function label_data_show(data){//根据标签展示显示内容，
	// console.log(plabelname);
	var i,k,plabelname,pvalue,porder,pic_index_name,back_list;
	 k=0;
	 pic_index_name="";bt="";
	 for ( var i in data ){
				plabelname=i;pvalue=data[i];
	  if (pvalue==null) pvalue="";
      if (pvalue=="null") pvalue="";
		 if ( $("#dpic_"+i).length > 0 ) {
				 label_pic_input(plabelname,pvalue,k);//图片显示标签
				 pic_index_name=pic_index_name+bt+k+','+i;
				 bt=';';
				 k=k+1;
				}
		 if ( $("#dpicm_"+i).length > 0 ){
					label_picm_input(plabelname,pvalue,k);//多图片显示标签
					pic_index_name=pic_index_name+bt+k+','+i;
					bt=';';
					k=k+1;
				}
		if ( $("#dpicr_"+i).length > 0 ) {
				 label_pic_show(plabelname,pvalue,k);//图片显示标签
				}
		 if ( $("#dpicmr_"+i).length > 0 ){
					label_picm_show(plabelname,pvalue,k);//多图片显示标签
				}
		 if ($("#d_"+plabelname).length > 0 ){
      //         console.log(plabelname);
    	 label_text_input(plabelname,pvalue);//一般文本显示标签 readonly
        }
       if ($("#dr_"+plabelname).length > 0 ){//只读
       	 label_text_input(plabelname,pvalue,"readonly");//一般文本显示标签 readonly
          if ($("#dr_"+plabelname+'2').length > 0 ){//只读
       	     label_text_input(plabelname+'2',pvalue,"readonly")};//一般文本显示标签 readonly
       
         }
		 if ( $("#dtxt_"+plabelname).length > 0 )
			 label_textarea_input(plabelname,pvalue);//一般多行文本显示标签
		
			if ( $("#dt_"+plabelname).length > 0 )
			 label_date_input(plabelname,pvalue);//一般时间显示标签
	
			if ( $("#dcom_"+plabelname).length > 0 ){
				lobel_combo_input(plabelname,pvalue,data[i+'s']);//选择下拉框显示
			 }
		}
	$("#pic_index_name").val(pic_index_name);
}

function str_index(s)
{   
	if (s==null) s="";
    if (s=="null") s="";
   return s.indexOf(';'); 
}


function upload_all_pic_proc()
{ var s=$("#pic_index_name").val();
	var ss1,ss2,s2 ;
	if (str_index(s)>0){
		  	ss1 = s.split(";");
			for ( var i = 0; i < ss1.length; i++) {
						s2= ss1[i];
						ss2 = s2.split(",");
					 check_upload(ss2[0],0,"38",ss2[1]);
			}
  } 
}

function check_all_pic_upload()
{ var s=$("#pic_index_name").val();
    if (s==null) pvalue="";
    if (s=="null") pvalue="";
	var fs=(0==0);
	 if(str_index(s)>0){
	    var ss1,ss2,s2 ;
		ss1 = s.split(";");
		for ( var i = 0; i < ss1.length; i++) {
					s2= ss1[i];
					ss2 = s2.split(",");
					fs=fs && ($("#pic_switch_"+ss2[1]).val()==0);
				 // console.log("upda "+i+",checK_alle =B=" + fs+',kk='+ss2[1]+',='+ s);
		}
  	}
	return fs;
}

function label_text_readonly(plabelname,pvalue){
 label_text_input(plabelname,pvalue,"readonly");
}
//显示数名词进行处理
function label_text_input(plabelname,pvalue,Preadonly=""){
	 var s2="dr";
     var s1='<input name="'+plabelname+'" type="text" class="define_input_normal" id="'+plabelname+'" ';
	 s1=s1+'style="width:80%;" onmousemove="javascript:this.className = ';
	 s1=s1+"'define_input_hover';"
	 s1=s1+'" onmouseout="javascript:this.className = ';
	 s1=s1+"'define_input_normal';";
	 s1=s1+'" value="'+pvalue+'" '+Preadonly+'/>';
	 if(Preadonly=="") s2="d";
	 label_text_show(plabelname,s1,s2);
}

function label_textarea_input(plabelname,pvalue){
	 var s1='';
		 s1=s1+' <textarea id="'+plabelname+'" name="'+plabelname+'"';
	 s1=s1+' style=" border:1px solid #CCCCCC; background-color:#FAFAFA; border-radius:3px;';
	 s1=s1+' width:600px; max-width:600px; min-width:600px; height:100px; margin-top:5px; margin-bottom:5px; padding:3px;';
	 s1=s1+' font-family:\'微软雅黑\';color:#333;"> '+pvalue+'</textarea>';
	 label_text_show(plabelname,s1,"dtxt");
}

//显示数名词进行处理
function label_date_input(plabelname,pvalue){
	 var s1='<input name="'+plabelname+'" type="text" width="150px" class="define_input_normal" id="'+plabelname+'" ';
	 s1=s1+' readonly="readonly"> ';
	 label_text_show(plabelname,s1,"dt");
	 label_date_input_set(plabelname,pvalue)
}

function label_date_input_set(plabelname,pvalue){
	 init_datepicker(plabelname);
	 $("#"+plabelname).val(pvalue);
}

function check_input_data(inputname,msg){
		if($("#"+inputname).val()==""){
		 $("#"+inputname).focus();
		 show_mask(0,0);
		 return;
		}
 }

function init_datepicker(dname){
		

		$("#"+dname ).datepicker( "option", "dateFormat",'yy-mm-dd' );
	}

 // <input id='news_date_start' name='news_date_start' class="define_input_normal" readonly="readonly">
	// 控件对象名，对象ID,数据，数据ID,数据名称，默认知道
function lobel_combo_input(pcomname,pchoseid,data) {
	 var s1='<select name="list_'+pcomname+'" id="list_'+pcomname+'" style="width:80%"></select>';
			s1=s1+'<input name="id_'+pcomname+'" id="id_'+pcomname+'" type="hidden" />';
	 label_text_show(pcomname,s1,"dcom");
	 show_combo(pcomname,data,"f_code",'f_name',pchoseid);
	}
	
//显示COMBO数据，参数是数组
  function lobel_combo_array(pcomname,pchoseid,data) {
   var s1='<select name="list_'+pcomname+'" id="list_'+pcomname+'" style="width:80%"></select>';
       s1=s1+'<input name="id_'+pcomname+'" id="id_'+pcomname+'" type="hidden" />';
   label_text_show(pcomname,s1,"dcom");
   show_combo_array(pcomname,data,pchoseid);
  }
  
  function show_combo(pcomid,data,pitem_id,pitem_name,pchoseid) {
        var i = 0;var s1,s2,s3;
        $("#id_"+pcomid).val(-1);
        $("#list_"+pcomid).empty();
        $("#list_"+pcomid).append("<option value='-999'>请选择</option>");
         if (typeof(data) != "undefined") { 
          if (typeof(data.length) != "undefined") {     
            while (i < data.length) {
              s2="";
              s3=data[i][pitem_id];
              if(s3==pchoseid) { s2=" selected ";  $("#id_"+pcomid).val(s3);}
               s1="<option value='" +s3+ "' "+s2+">" + data[i][pitem_name]+"</option>";
               $("#list_"+pcomid).append(s1);
               i++;
              }
           }
        }
  }

  function show_combo_array(pcomid,data,pchoseid) {
        var s1,s2,s3;
         var i = 0;
        $("#id_"+pcomid).val(-1);
        $("#list_"+pcomid).empty();
        $("#list_"+pcomid).append("<option value='-999'>请选择</option>");  
      //    console.log(data);
         for(var name in data)
         {
              s3=name;
              if(s3==pchoseid) { s2=" selected ";  $("#id_"+pcomid).val(s3);}
              s1="<option value='" +name+ "' "+">" + name +"</option>";
               $("#list_"+pcomid).append(s1);
           }     
    }
  
    function show_city_data(pcomid,data,pchoseid) {
        var i = 0;var s1,s2,s3;
        $("#id_"+pcomid).val(-1);
        $("#list_"+pcomid).empty();
        $("#list_"+pcomid).append("<option value='-1'>请选择</option>");
      //  console.log(pcomid);
         if (typeof(data) != "undefined") { 
   //     console.log(data);
          if (typeof(data.length) != "undefined") {
        
            while (i < data.length) {
              s2="";
              s3=data[i];
              if(s3==pchoseid) { s2=" selected ";  $("#id_"+pcomid).val(s3);}
               s1="<option value='" +s3+ "' "+s2+">" + data[i]+"</option>";
               $("#list_"+pcomid).append(s1);
               i++;
              }
           }
        }
  }
//显示数名词进行处理
function label_pic_input(plabelname,pvalue,porder){
	 var s1='<table  style="border:none" cellspacing="0" cellpadding="0" >'
	 s1=s1+'<input  type="hidden" name="'+plabelname+'" id="'+plabelname+'" value="'+pvalue+'" />';//存放图片文件	
	 s1=s1+'<input  type="hidden" name="pic_switch_'+plabelname+'" id="pic_switch_'+plabelname+'" value="0" />';//上传状态
	 s1=s1+'<tr style="border:none" ><td  style="border:none" style="padding:5px">';
	 s1=s1+'<div style="display:none;" id="pic_container_'+plabelname+'"></div></td>';
	 s1=s1+'<td style="border:none"><div id="pic_upload_'+plabelname+'"></div></td></tr>';
	 s1=s1+'</table>';
	//console.log(pvalue);
	 label_text_show(plabelname,s1,"dpic");
	 upload_pic_init(plabelname,porder);
	 show_pic_proc(plabelname,pvalue);
}

function label_picm_input(plabelname,pvalue,porder){
					<!--，若不存在文件上传，上传返回空，该值为1，上传成功，该值为1-->
        var s0="子图";
        if (plabelname=="club_aualifications_pic") s0="附件图";
        
 var s1='<table style="border:none" cellspacing="0" cellpadding="0">';
        s1=s1+'<input type="hidden" name="'+plabelname+'" id="'+plabelname+'" value="'+pvalue+'" />';//存放图片文件	
    	s1=s1+'<input type="hidden" name="pic_'+plabelname+'" id="pic_'+plabelname+'" />';
		s1=s1+'<input type="hidden" name="pic_up_num_'+plabelname+'" id="pic_up_num_'+plabelname+'" value="0" />';
		s1=s1+'<input type="hidden" name="pic_switch_'+plabelname+'" id="pic_switch_'+plabelname+'" value="0" />';
		s1=s1+'<input type="hidden" name="pic_datas_'+plabelname+'"  id="pic_datas_'+plabelname+'"  value="" />';
		s1=s1+'<input type="hidden" name="pic_datas_index_'+plabelname+'" id="pic_datas_index_'+plabelname+'" value="-1" />';

//		s1=s1+'<tr id="pic_line_name_'+plabelname+'" ><td rowspan="2"><div id="pic_type">'+s0+'：</div></td>';
		s1=s1+'<tr ><td style="padding:1px;border:none" width="75%"><div style="display:none;" id="pic_container_'+plabelname+'"></div></td>';
		s1=s1+'<td style="padding:1px;border:none"><div id="pic_upload_'+plabelname+'"></div></td></tr>';
		s1=s1+'</table>';
	 label_text_show(plabelname,s1,"dpicm");
	 upload_morepic_init(plabelname,porder);//   upload_morepic_init("c",2,30);
	 var pic_num=$('#dpicm_'+plabelname).attr('pic_num');
	 if(pic_num==='undefined') pic_num=30;
	 show_pic_more(plabelname,pvalue,pic_num);//'图片数'
}

function label_pic_show(plabelname,pvalue,porder){
	 var s1='<table border="0" cellspacing="0" cellpadding="0">';
	 s1=s1+'<tr><td style="height:45px"><img src="'+pvalue+'" width=60 height=40></td></tr>';
	 s1=s1+'</table>';
	 label_text_show(plabelname,s1,"dpicr");
 }

function label_picm_show(plabelname,news_contentObj,porder){
					<!--，若不存在文件上传，上传返回空，该值为1，上传成功，该值为1-->
        var p_html ='<table  border="0" cellspacing="0" cellpadding="0" >';
		 if(typeof(news_contentObj["datas"])!=="undefined"){

        var obj_len=news_contentObj["datas"].length;  //alert(news_contentObj["datas"].length);
        var pid_array =news_contentObj["datas"];
        var d0,d1,d2,d3,d4;
        var i = 0; var j = 0;
        var datas=new Array();//var single_data=new Array(); //var input_datas=new Array();
        while (i <obj_len) {//alert(train_pid_array[i]);
                 if(typeof(pid_array[i]['c_order'])=="undefined"){d0=i;}
                  else { 
                      p_html = p_html +'<tr><td style="height:45px"><img src="'+pid_array[i]['c_pic']+'" width=60 height=40></td></tr>';
                   }
                i++;
         }
      }
     p_html=p_html+'</table>';  
	 label_text_show(plabelname,s1,"dpicmr");
//	 upload_morepic_init(plabelname,porder);//   upload_morepic_init("c",2,30);
//	 show_pic_more(plabelname,pvalue,30);//'图片数'
}

function show_page(pagename,pagenum,pageshow){
		var j = 0;
		while (j < pagenum) {
			 j=j+1;
			 $('#'+pagename+j).hide();
			 $('#u'+pagename+j).removeClass("selected");
			}
		//$('#'+pagename+(pageshow-1)).empty();
		$('#'+pagename+pageshow).show();
		$('#u'+pagename+pageshow).addClass("selected");
}


function def_dialog(pname)
{
	var htmlCodes = [
'       <table width="100%" border="0" cellspacing="0" cellpadding="0">',
'        <tr><td width="100" height="100"><img src="images/result.gif" width="80" height="80"/></td><td>信息保存成功</td></tr>',
'        <tr>',
'            <td colspan="2">',
'                <div align="center">',
'                    <input type="button" id="back_pro_list" value="返回信息列表"/>&nbsp;',
'                    <input type="button" id="go_on_puslish" value="继续添加新数据"/>',
'      </div></td></tr></table>',
].join("");
$("#"+pname).html(htmlCodes);
}


function show_user_msg(pname,pmsg)
{
	var htmlCodes = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
        htmlCodes =htmlCodes + '<tr><td width="100" height="100"><div>'+pmsg+'</div></td></tr></table>';
        set_dialog(pname);
       $("#"+pname).html(htmlCodes);
       $("#"+pname).dialog("open");
}

function new_dialog(pbox_name,oplablename,pw=500){
   $("#"+pbox_name).dialog({
				autoOpen: false,
				show: {effect: "blind",duration: 100},
				hide: {effect: "fadeOut",duration: 100},
                minWidth: (pw-20),maxWidth: pw,
				//title: "查看资质人",
				close: function () { 
					if (!(oplablename=="")) $("#"+oplablename).hide();
					if (pw>500){
				      $("#latitude").val(window.$("#map_frame")[0].contentWindow.get_latitude());
				      $("#longitude").val(window.$("#map_frame")[0].contentWindow.get_longitude());
				      $("#game_address").val(window.$("#map_frame")[0].contentWindow.get_point_address()); 
				      $("#operate_loading").hide();
				      $("#operate_mask").hide();
			     try{ 
  	                 map_back_call(window.$("#map_frame")[0].contentWindow.get_point_address(),
               		window.$("#map_frame")[0].contentWindow.get_latitude(),
        			window.$("#map_frame")[0].contentWindow.get_longitude()); 
                    }catch(e){        } 
				    }
				}
		});
}
 
 function init_dialog(pbox_name,pw=500){ //设置标签在弹出框显示绑定坦诚框
	 new_dialog(pbox_name,'',pw);
}

 function set_dialog(pbox_name){ //设置标签在弹出框显示绑定坦诚框
 	 def_dialog(pbox_name);
	 new_dialog(pbox_name,'');
}
 function init_map_dialog(pbox_name,p_address='',p_locate_x='',p_locate_y=''){
 	p_address=p_address+', , , ,';
 	 var str_array = p_address.split(",");
   var s1='   <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td >';
   s1=s1+ '   <input name="p_address" id="p_address" type="hidden" value="'+str_array[0]+'" />';
   s1=s1+ '   <input name="p_area_province" id="p_area_province" type="hidden" value="'+str_array[1]+'" />';
   s1=s1+ '   <input name="p_area_city" id="p_area_city" type="hidden" value="'+str_array[2]+'" />';
   s1=s1+ '   <input name="p_area_street" id="p_area_street" type="hidden" value="'+str_array[3]+'" />';
  
   s1=s1+ '   <input name="p_locate_x" id="p_locate_x" type="hidden" value="'+p_locate_x+'" />';
   s1=s1+ '   <input name="p_locate_y" id="p_locate_y" type="hidden" value="'+p_locate_y+'" />';

   s1=s1+'    <iframe marginheight="0" marginwidth="0" scrolling="no" width="900" height="440" frameborder="0" ';
   s1=s1+'    id="map_frame" src="geographic_coordinates.html" style="margin-left:0px; margin:0px;"></iframe>';
   s1=s1+' </td></tr><tr> <td><div align="center">&nbsp;&nbsp;&nbsp;</div></td></tr></table>';
   $("#"+pbox_name).html(s1);
   init_dialog(pbox_name,1000);
}
 
 function map_back_call(paddress,piontx,pionty){ //显示数据
    var s=paddress+' , , ,';map=s.split(",");
    map_back_set('p_address',paddress);
    map_back_set('p_area_province',map[0]);
    map_back_set('p_area_city',map[1]);
    map_back_set('p_area_street',map[2]);
    map_back_set('p_locate_x',piontx);
    map_back_set('p_locate_y',pionty);
}

function map_back_set(pname1,pvalue){ //
	var pname=$( "#"+pname1).val(paddress);
    if(pname!==""){
      $( "#"+pname ).val(pvalue); 
    }
}

function init_menu(pmenuname)
{ 
 var  pmenuname1='#'+pmenuname;
 $(pmenuname1).hide();
 $(pmenuname1).menu({
					select: function( event, ui ) {
						var s1=ui.item.find("div").html();
					if(s1=="取消"){$("#menu").hide();}
					if((s1=="详细信息")|| (s1=="信息详细")){ show_data_detail(0);}
					if(s1=="删除信息"){delete_proc(0);}
					}
	});
}
function check_init(title_txt){
	var s1='<div class="checkBox"><p>'+title_txt+'</p>';
	 s1=s1+'<textarea></textarea><br><button>确定</button><a>取消</a>';
	 s1=s1+'</div><div class="check_bg"></div>';
	$("#"+pname).html(s1);
	$("#"+pname).show();
}

function check_show(title_txt){

	$("#"+title_txt).show();
}

function check_save()
{

}
//创建审核框，check_name表示类型，0，纯文本，1文本+COMBO下拉框
 function new_check_box(title_txt,check_name)
{
	//<div id="dialog" title="邀请俱乐部成员" style="display:none;">
	var  s1='';
			 s1=s1+'<table width="100%" border="0" cellspacing="1" cellpadding="0" class="product_publish_content" >';
			 s1=s1+' <tr>';
			 s1=s1+'   <td width="20%">目标帐号：</td>';
			 s1=s1+'   <td width="80%"><input name="gfaccount" type="text" class="define_input_normal" ';
			 s1=s1+' id="d_member_gfid" style="width:160px;" onmousemove="javascript:this.className=\'define_input_hover\';"'; 
			 s1=s1+' onmouseout="javascript:this.className=\'define_input_normal\';"/></td>';
			 s1=s1+'  </tr>';
			 s1=s1+'   <tr>';
			 s1=s1+'   <td width="20%">加入项目：</td>';
			 s1=s1+'   <td width="80%">';
			 s1=s1+'   <select name="project_list" id="d_member_project_id" style="width:150px">';
			 s1=s1+'      <option value="太极">太极</option>';
			 s1=s1+'      <option value="跆拳道">跆拳道</option>';
			 s1=s1+'   < lect>';
			 s1=s1+'       <input name="project_id" id="project_id" type="hidden" /></td>';
			 s1=s1+'  </tr>';
			 s1=s1+'  <tr><td width="20%">邀请附言：</td>';
			 s1=s1+'   <td width="80%"><textarea id="d_member_content" name="notify_content"';
			 s1=s1+' style=" border:1px solid #CCCCCC; background-color:#FAFAFA; border-radius:3px;';
			 s1=s1+' width:250px; max-width:250px; min-width:250px; height:50px; margin-top:5px; margin-bottom:5px; padding:3px;';
			 s1=s1+' font-family:\'微软雅黑\';color:#333;"> 这人很老实，什么好话都没留下</textarea></td>';
			 s1=s1+'   </tr>';
			 s1=s1+' <tr>';
			 s1=s1+'   <td colspan="2">';
			 s1=s1+'     <div align="center">';
			 s1=s1+'       <input name="invite" type="button" id="invite" value="提交" />';
			 s1=s1+'     </div>';
			 s1=s1+'   </td>';
			 s1=s1+' </tr>';
			 s1=s1+'   </table>';
		s1=s1+'</form>';
	s1=s1+'</div>';
}


//获取选项的文本
function get_select_value(pname){
   return $("#dcom_"+pname+" option:selected").text() ;
}
//获取选项的文本
function get_combo_text(pname){
   return get_select_value(pname) ;
}
//获取选项的值VAL
function get_combo_value(pname){
   return $("#list_"+pname).val() ;
}
// $("#list_"+pcomid).empty()
function show_combo_data(pname,data){ //显示数据
   lobel_combo_input(pname,get_select_value(pname),data);
   return ;
}

function get_post_str(pname){ //显示数据
   return "&"+pname+"="+$("#"+pname).val();
}

function show_city_proc(pname,prval){
   //console.log(pname);
   //console.log(pc[pname]);
   // lobel_combo_array(pcityname, pc[pname],prval);
    show_city_data(pcityname, pc[pname],prval);
}

function save_get_data(save_code,post_data,post_url,backcall=0) {
       $.ajax({
            url: post_url,
            data:post_data,type: 'post',async:false,dataType: 'json',
            success: function (data) { 
            	      if (backcall==0){
                           save_get_ok(save_code,data);
            	       } else {
            	             backcall(data);
            	            }
            	     },
            error:   function(XMLHttpRequest, textStatus, errorThrown) {
            	     console.log(XMLHttpRequest);
            	     save_get_ok("error",data);
                    }
               });
    }

/******************************
******地区三级联动下拉列表开始*****
 ******参数(生成的div,地区数量,地区名字(逗号分隔),要默认显示的值(value/中文,逗号分隔))**********/
 /*例子：init_region("region_area_dropdown",2,"国家，省","中国,12")*/
function init_region(region_div,region_num=5,attr_str="",show_data=""){
	var html_str ="";
	var data_array="";
	var init_url = "";
	for(var i = 0 ; i < region_num;i++){
		if(typeof(attr_str.split(",")[i])!="undefined"&&attr_str!=""){
			html_str+="<span style='font-weight:bold;'>"+attr_str.split(",")[i]+":</span>&nbsp;";
		}
		html_str+="<select style='min-width:50px;max-width:100px;text-overflow: ellipsis;' id='d_region_"+i+"' class='region_drop_down'><option value='-1'>请选择</option></select>&nbsp;&nbsp;";
	}
	$("#"+region_div).append(html_str);
	//处理默认显示的值
	if(show_data!=""){
		data_array = show_data.split(",");
	}
	init_url = "order_interfaces.php?action=region_country";
	//搜索地区三级联动下拉表
	// save_get_data("get_country","","data_interfaces.php?action=region_country",1,show_region_countr);
	$.ajax({
        url: init_url,
        type: 'post',
        async:true,
        dataType: 'json',
        success: function (data) {
           show_region_country(data,region_num,data_array);
        },
        error:  function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(XMLHttpRequest);
        }
    });
}
function show_region_rest(id_name,region_num,action_name,callback,data_array){
	if(data_array!=""){//若有默认数据，直接触发事件
		trigger_region(id_name,region_num,action_name,callback,data_array);
	}
	$(id_name).change(function(){//绑定事件
	    trigger_region(id_name,region_num,action_name,callback,data_array);
	});
}
function trigger_region(id_name,region_num,action_name,callback,data_array){
	$(id_name).nextAll("select").html("<option value='-1'>请选择</option>");
    var region_url = "order_interfaces.php?action="+action_name+"&code="+ $(id_name).val();
    if($(id_name).val()!=-1){
        $.ajax({
            url: region_url,
            type: 'post',
            async:true,
            dataType: 'json',
            success: function (data) {
            	// console.log(data);
                callback(data,region_num,data_array);
            },
            error:  function(XMLHttpRequest, textStatus, errorThrown) {
               console.log(XMLHttpRequest);
            }
        });
    }
}
function check_key_data(id_name,data,data_array){
	var sub_num = id_name.substr(-1,1);
	for(var i = 0 ; i<data.datas.length;i++){
		if(data_array!=""){
			if(data_array[sub_num]==data.datas[i][1]||data_array[sub_num]==data.datas[i][2]){
				$(id_name).append("<option selected='selected' value='"+data.datas[i][1]+"'>"+data.datas[i][2]+"</option>");
			}else{
				$(id_name).append("<option value='"+data.datas[i][1]+"'>"+data.datas[i][2]+"</option>");
			}
		}else{
			$(id_name).append("<option value='"+data.datas[i][1]+"'>"+data.datas[i][2]+"</option>");
		}
	}
}
function show_region_country(data,region_num,data_array){
	check_key_data("#d_region_0",data,data_array);
    if(region_num==1){
    	return;
    }else{
    	show_region_rest("#d_region_0",region_num,"region_city",show_region_city,data_array);
    }
}
function show_region_city(data,region_num,data_array){
	check_key_data("#d_region_1",data,data_array);
    if(region_num==2){
    	return;
    }else{
    	show_region_rest("#d_region_1",region_num,"region_area",show_region_area,data_array);
    }
}

function show_region_area(data,region_num,data_array){
	check_key_data("#d_region_2",data,data_array);
    if(region_num==3){
    	return;
    }else{
    	show_region_rest("#d_region_2",region_num,"region_town",show_region_town,data_array);
    }
}
function show_region_town(data,region_num,data_array){
	check_key_data("#d_region_3",data,data_array);
    if(region_num==4){
    	return;
    }else{
    	show_region_rest("#d_region_3",region_num,"region_street",show_region_street,data_array);
    }
}
function show_region_street(data,region_num,data_array){
	check_key_data("#d_region_4",data,data_array);
}
/******************************
******地区三级联动下拉列表结束*****/

/******************************
******数据文本，下拉框，图片显示*****
 *******************************/

function show_all_data(data){
    var plabelname,pvalue,pic_index_name,bt,k;
    plabelname="";pvalue="";pic_index_name="";bt="";k=0;
    for ( var i in data ){
    	// console.log(i);
      plabelname=i;pvalue=data[i];
      if (pvalue==null) pvalue="";
      if (pvalue=="null") pvalue="";
      if ( $("#dpic_"+i).length > 0 ) {
         label_pic_input(plabelname,pvalue,k);//单图片显示标签
         pic_index_name=pic_index_name+bt+k+','+i;
         bt=';';
         k=k+1;
      }
     if ( $("#dpicm_"+i).length > 0 ){
        multi_pic_input(plabelname,pvalue,k);//多图片显示标签
        pic_index_name=pic_index_name+bt+k+','+i;
        bt=';';
        k=k+1;
      }
      if ( $("#dcom_"+plabelname).length > 0 ){
        if(pvalue.length>0){//有数据
          drop_down_combo_input(plabelname,pvalue,data[i+"_ed"],"#");//选择下拉框显示
        }
      }
      if ( $("#d_"+plabelname).length > 0 ){//input(text)框数据显示
        $("#d_"+plabelname).val(pvalue);
      }
      if ( $("#dtext_"+plabelname).length > 0 ){//text数据显示
        $("#dtext_"+plabelname).html(pvalue);
      }
      if ( $(".dcom_"+plabelname).length > 0 ){
        if(pvalue.length>0){//有数据
          drop_down_combo_input(plabelname,pvalue,data[i+"_ed"],".");//选择下拉框显示
        }
      }
    }
    $("#pic_index_name").val(pic_index_name);
    return k;
 }
 /***********************************************************
  		(json名称,对应的json值,默认显示的值,id/class)
  *******************************************************/
 function drop_down_combo_input(p_name,p_value,data,type){
	if(p_value==""){
 		$(type+"dcom_"+p_name).find("option[value='"+data+"']").attr("selected","selected");
 		return;
 	}    var str = "";
    for(var j in p_value[0]){
      str+=j+",";
    }
    str = str.substring(0,str.length-1);
    var str_array = str.split(",");
    var html_str = "";
    for(var i = 0 ; i < p_value.length; i++){
      if( data==p_value[i][str_array[1]]){
        html_str+= "<option selected='selected' value = '"+p_value[i][str_array[1]]+"'>"+p_value[i][str_array[2]]+"</option>";
      }else{
        html_str+= "<option value = '"+p_value[i][str_array[1]]+"'>"+p_value[i][str_array[2]]+"</option>";
      }
    }
    $(type+"dcom_"+p_name).html("<option value='-1'>请选择...</option>");
    $(type+"dcom_"+p_name).append(html_str);
  }

 function td_pic_input(plabelname,pvalue,porder){
 	upload_td_pic(plabelname,porder);
 }

 //多图显示与上传
function multi_pic_input(plabelname,pvalue,porder){
	var s1='<table  border="0" cellspacing="0" cellpadding="0" ><input name="pic_'+plabelname+'" type="hidden" id="pic_'+plabelname+'" />';
	s1=s1+'<tr><td style="height:45px"> <div id="pic_container_'+plabelname+'">';
	s1=s1+'</div></td>';
	s1=s1+'<td style="padding:5px;"><div style="max-width:250px" id="pic_upload_'+plabelname+'"></div></td></tr></table>';
	$("#dpicm_"+plabelname).append(s1);
	multi_pic_show(plabelname,pvalue);
	upload_multi_pic_init(plabelname,porder,5);//对多5张
}
function upload_all_pic_proc2()
{ var s=$("#pic_index_name").val();
	var ss1,ss2,s2 ;
	if (str_index(s)>0){
		  	ss1 = s.split(";");
			for ( var i = 0; i < ss1.length; i++) {
						s2= ss1[i];
						ss2 = s2.split(",");
					 check_upload(ss2[0],0,"38",ss2[1]);
					 if(i==ss1.length-1){
					 	save_data();
					 }
			}
  	}else{
  		save_data();
  	}
}