
function DrawImage(ImgD,iwidth,iheight){//控制宽与高
//参数(图片,允许的宽度,允许的高度)
 var image=new Image();
 image.src=ImgD.src;
 if(image.width>0 && image.height>0){
    if(image.width/image.height>= iwidth/iheight){
        if(image.width>iwidth){ 
            ImgD.width=iwidth;ImgD.height=(image.height*iwidth)/image.width;
        }else{
            ImgD.width=image.width; ImgD.height=image.height;
        }
    }else{
        if(image.height>iheight){ 
            ImgD.height=iheight; ImgD.width=(image.width*iheight)/image.height; 
        }else{
            ImgD.width=image.width; ImgD.height=image.height;
         }
        }
      ImgD.alt=image.width+"×"+image.height;
    }
}

function check_indexof(str,substr)
{ 
  return str.indexOf(substr);
}

function check_video(p_pic)
{
  if(check_indexof(p_pic,".mp4")>= 0) p_pic="images/video_icon.jpg";
  if(check_indexof(p_pic,".rm")>= 0) p_pic="images/video_icon.jpg";
  return p_pic;
}

function check_video_input(p_pic)
{  var rs=0;
  if(check_indexof(p_pic,".mp4")>= 0) rs=1;
  if(check_indexof(p_pic,".rm")>= 0) rs=1;
  return rs=1;
}



function show_morepic_ing(p_picname,p_pxh,p_order,p_title,p_pic,p_intro) {
    var picname=p_picname+"_"+p_pxh;
    p_pic=check_video(p_pic);
    var title_show="";
    put_picname(p_picname,p_pxh,p_order,p_title,p_pic,p_intro);
   if($('#dpicm_'+p_picname).attr('title_show')!=='undefined') title_show="style='DISPLAY:none'";
    var  p_html;//{border-collapse:collapse;border:none;}
    var cn=p_picname;
    p_html = "<table width='100%' style='border:none'  id='table_"+picname+"'>";
    p_html +="<tr height='82'><td width='90' rowspan='2' style='padding:0px;border:none'><img id='pic_"+picname+"' name='pic_"+picname+"' ";
    p_html +="src='" + p_pic + "' width='80' height='80'  onerror=\"this.src='images/default.png'\"/></td>";
    p_html +="<td  width='386' "+title_show+" >";
    p_html +="图序号：<input name='pno_"+picname+"' type='text' id='pno_"+picname+"' style='width:45px;'";
    p_html +=" class='define_input_normal' value='"+p_order+"'>";
    p_html +="图标题：<input name='title_"+picname+"'  id='title_"+picname+"' type='text' class='define_input_normal' ";
    p_html +=" id='title_"+picname+"' style='width:150px;' value='"+p_title+"'/></td><td rowspan='2'  style='border:none' >";
    p_html +=" <img id='delete_pic"+picname+"' src='images/delete.png' width='24' height='24' ";
    p_html +=" onclick='delete_more_pic(\""+p_picname+"\","+p_pxh+")'/></td></tr>";

    p_html +=" <tr style='border:none'><td  "+title_show+" >";
    p_html +="图介绍：<input name='introduction_"+picname+"' type='text' id='introduction_"+picname+"' style='width:45px;'";
    p_html +=" class='define_input_normal' value='"+p_order+"'>";
    
    p_html +=" </tr></table>";
    return  p_html;
  }

function put_picname(p_picname,p_pxh,p_order,p_title,p_pic,p_intro){
    var s1=$('#'+p_picname).val();
    if (s1!=='') s1=s1+'|'; 
    s1=s1+"xh="+p_pxh+',p_order='+p_order+',title='+p_title+',pic='+p_pic+',intro='+p_intro;
    $('#'+p_picname).val(s1);
}

function show_rm_ing(p_picname,p_pxh,p_order,p_title,p_pic,p_intro) {
    var picname=p_picname+"_"+p_pxh;
    var title_show=$('#dpicm_'+plabelname).attr('title_show');
   if(title_show==='undefined') title_show='text';
    p_pic=check_video(p_pic);
    var  p_html;
    p_html = "<table width='100%' border='0' cellspacing='0' cellpadding='0' id='table_"+picname+"'>";
//p_html = "<table width='100%' style='border-collapse:collapse;border:none;' id='table_"+picname+"'>";

    p_html +="<tr border:0px><td width='90' border:0px rowspan='2' style='padding:0px'><img name='pic_"+picname+"' id='pic_"+picname+"' ";
    p_html +="src='" + p_pic + "' width='80' height='80'  onerror=\"this.src='images/default.png'\"/></td>";
    p_html +="<td border:0px width='386'>图序号：";

    p_html +="<input id='pno_"+picname+"' type='"+title_show+"' name='pno_"+picname+"' style='width:45px;'";
    p_html +=" class='define_input_normal' value='"+p_order+"'>";
    p_html +=" 图标题：<input name='title_"+picname+"' type='"+title_show+"' class='define_input_normal' ";
    p_html +=" id='title_"+picname+"' style='width:150px;'";
    p_html +=" onmousemove=\"javascript:this.className='define_input_hover';\" ";
    p_html +=" onmouseout=\"javascript:this.className='define_input_normal';\" ";
    p_html +=" value='"+p_title+"'/></td><td rowspan='2'>";
    p_html +=" <img id='delete_pic"+picname+"' src='images/delete.png' width='24' height='24' ";
    p_html +=" onclick='delete_more_pic(\""+p_picname+"\","+p_pxh+")'/></td></tr>";
    p_html +=" <tr border:0px><td border:0px>音视频文件路径：<textarea id='introduction_"+picname+"' ";
    p_html +=" name='introduction_"+picname+"' class='define_input_normal'> "+p_intro+"</textarea> </td>";
    p_html +=" </tr></table>";
    p_html +='<table width="100%"><tr><td><section id="player"><video id="media" width="720" height="400" controls>';
    p_html +='<source src="http://minkbooks.com/content/trailer.mp4"><source src="http://minkbooks.com/content/trailer.ogg">';
    p_html +='</video> </section>"</td></tr></table>';
    return  p_html;
  }

 function show_pic_ing(p_picname,p_pic) {
     p_pic=check_video(p_pic);
    $("#pic_"+p_picname).val(p_pic);
    var p_html = "<table id='pic_table_"+p_picname+"' width='80' style='border:none' cellspacing='0' cellpadding='0' >";
   
    p_html += "<tr style='border:none' ><td style='border:none' ><div align='center' style='position:relative;left:0px;'>";
    p_html += "<img src='" + p_pic + "' width='60' height='60' ";
    p_html += " onload='DrawImage(this,60,60);' onerror=\"this.src='images/default.png'\"/>";
    p_html += "<div class='pic_delete'  style='position:position;top:0px;right:0px;'><img src='images/delete.png' width='16' height='16' ";
    p_html += " onclick='delete_pic_proc(\""+p_picname+"\")'/>";
    p_html += "</div></div></td></tr></table>";
    return  p_html;
  }

 function show_pic_proc(p_picname,p_pic) {
    var sn ="#pic_container_"+p_picname;
     $(sn).css("display", "none");
      if (p_pic !== "") {
        $(sn).html(show_pic_ing(p_picname,p_pic,0,"")); 
        $(sn).css("display","block"); 
      }
    }


 function show_pic_more(p_picname,p_pic,ptype) {
   show_pic_more_proc(p_picname,p_pic,-1)
 }

 function show_pic_more_proc(p_picname,p_pic,p_optype) { 
    var p_html = "";
    var d0,d1,d2,d3,d4;
    var i = 0; var j = 0;var r = 0;
    //console.log(p_pic);
    var datas=new Array();//var single_data=new Array(); //var input_datas=new Array();
    if ((p_pic == "") ||(p_pic == null)) {            
        $("#pic_container_"+p_picname).css("display", "none");} 
    else {
      if(p_pic.indexOf('c_order')<0){
        var s1=p_pic.split("|");
        var obj_len=s1.length ;  //alert(news_contentObj["datas"].length);
        while (i <obj_len) {//alert(train_pid_array[i]);
                    d0=i; d1='';d2=s1[i];d3='';
                   if(typeof(d2)!="undefined")
                    if(d2.indexOf(".")>=0)
                     {  p_html +=show_morepic_ing(p_picname,j,d0,d1,d2,d3);
                        j++;         
                       datas.push({"c_order": d0,"c_title": d1,"c_pic" : d2,"c_introduct": d3});
                      }
              
                i++;
         }
    
        }
    else
    {
       var news_contentObj=JSON.parse(p_pic);//eval(p_pic);//eval()
       if(typeof(news_contentObj["datas"])!=="undefined"){
        var obj_len=news_contentObj["datas"].length;  //alert(news_contentObj["datas"].length);
        var pid_array =news_contentObj["datas"];
        while (i <obj_len) {//alert(train_pid_array[i]);
                if (!(i==p_optype)){
                    if(typeof(pid_array[i]['c_order'])=="undefined"){d0=i;}
                  else {  d0=pid_array[i]['c_order'];};
                    d1=pid_array[i]['c_title'];
                    d2=pid_array[i]['c_pic'];
                    d3=pid_array[i]['c_introduct'];
                   if(typeof(d2)!="undefined")
                    if(d2.indexOf(".")>=0)
                     {  
                        p_html +=show_morepic_ing(p_picname,j,d0,d1,d2,d3);j++;         
                        datas.push({"c_order": d0,"c_title": d1,"c_pic" : d2,"c_introduct": d3});
                      }
                }
            i++;
         }
      }
     }

     if (j>0){
          var jsonText = JSON.stringify({"datas": datas}); //把子集对象都装到c_pic_all_obj的datas对象 
          $("#pic_datas_"+p_picname).val(jsonText);//写到input 
         // console.log(p_html);      
          $("#pic_container_"+p_picname).html(p_html);
          $("#pic_container_"+p_picname).css("display", "block");
      }

    }
}

function get_pic_name_str(p_pic) {
//   p_pic.indexOf('c_order')
   if(typeof(p_pic)!=="undefined"){
   //    console.log('===='+p_pic);
   var news_contentObj=JSON.parse(p_pic);//eval()
   var pic_str="";
      if(typeof(news_contentObj["datas"])!=="undefined"){

        var obj_len=news_contentObj["datas"].length;  //alert(news_contentObj["datas"].length);
        var pid_array =news_contentObj["datas"];
        var b_k= "";
        var i = 0; 
        while (i <obj_len) {//alert(train_pid_array[i]);
           if(typeof(pid_array[i]['c_pic'])!="undefined")
              { 
                    pic_str=pic_str+b_k+pid_array[i]['c_pic'];b_k='|';
               }
                i++;
         }
      }
    } else pic_str='';
    return pic_str;
}


function delete_pic_proc(p_picname) {
    show_pic_proc(p_picname,"delete.jpg");
}

function delete_more_pic(p_picname,p_xh) {
  show_pic_more_proc(p_picname,$("#pic_datas_"+p_picname).val(),p_xh,-1);
}

function check_upload_file(pic_name) {
  if (pic_name!=="")
    $("#pic_switch_"+pic_name).val("0");
    save_data();
}

//alert('选择完成'+$(".classname")[0].tagName);

function upload_pic_init(pic_name,pic_order){
    var data;
  $("#pic_upload_"+pic_name).html5uploader(pic_order,{
        auto:false, multi:false,
        fileTypeExts:"image/jpeg,image/png,image/gif",
        removeTimeout:9999999, limitFiles:1,
        url:'upload.php',
        picname:pic_name,
        picfile:pic_name,
        definedTitle:false,
        onSelectting:function(files){  return true; },//可决定文件是否被选择成功
        onSelected:function(){ $("#pic_switch_"+data[0].picname).val("1");},//alert('选择完成');
        onUploadStart:function(){ },//alert('开始上传');
        onInit:function(){ data=$(this);},//alert('初始化');
        onSingleUploadSuccess:function(reinfo,title,file_index){
            var dataObj=eval("("+reinfo+")");//转换为json对象$data['img_name']
            $("#pic_"+data[0].picname).val(dataObj.save_name);
              if (!"#pic_"+data[0].picname)
                $("#pic_"+data[0].picname).val(dataObj.save_name);
            $("#"+data[0].picname).val(dataObj.save_name);
            },
        onUploadComplete:function(filename){//alert('全部上传完成');
             //  console.log("onUploadComplete="+data[0].picname);
           
            check_upload_file(data[0].picname);
            },
        onUploadError:function(filename,reinfo){
           var dataObj=eval("("+reinfo+")");
            $("#pic_switch_"+data[0].picname).val("1");
            check_upload_file("");
         },
        onDeleted:function(index){ } //alert('aaa');
  });
}

function upload_morepic_init(pic_name,pic_order,pic_num){
  var data;
  var c_pic_obj = new Array();
  $("#pic_upload_"+pic_name).html5uploader(pic_order,{
        auto:false, multi:false,
        fileTypeExts:"image/jpeg,image/png,image/gif",
        removeTimeout:9999999, limitFiles:pic_num,
        url:'upload.php',
       // url:'http://qmdd.gf41.net/admin/qmdd/upload.php',
        picname:pic_name,
        definedTitle:false,
        onSelectting:function(files){
               var pname="#pic_datas_"+data[0].picname;
                var psn=$('#dpicm_'+data[0].picname).attr('pic_num');
                var pname1='#pic_line_data_'+data[0].picname;
                var u_num=$(pname1).find("li").length;
                if(psn==='undefined') psn=30;
                if($(pname).val()!=""){
                  var news_contentObj=JSON.parse($(pname).val());
                  if (news_contentObj["datas"]!=="undefined")
                  if (news_contentObj["datas"].length!=="undefined")
                    { u_num=u_num+parseInt(news_contentObj["datas"].length);}
                  if(parseInt(u_num)>=psn){
                    alert('图集不可上传超过'+psn+'张');
                    return false;
                   }
                }
                return true; },//可决定文件是否被选择成功
        onSelected:function(){ $("#pic_switch_"+data[0].picname).val("1");},//alert('选择完成');
        onUploadStart:function(){ },//alert('开始上传');
        onInit:function(){ data=$(this);},//alert('初始化');
        onSingleUploadSuccess:function(reinfo,title,description,file_index){
            var dataObj=eval("("+reinfo+")");//转换为json对象$data['img_name']
            var cn =data[0].picname;
            var cn1 ="#pic_datas_index_"+data[0].picname;
            var single_c_pic_obj={"c_title":title,"c_pic":dataObj.save_name,"c_introduct":description};
            c_pic_obj.push(single_c_pic_obj);
      　　　　　if($(cn1).val()=="-1"){ $(cn1).val(file_index);}
              else{ $(cn1).val($(cn1).val()+"@"+file_index);}

            },
        onUploadComplete:function(filename){//alert('全部上传完成');
            var c_pic_sort_obj=bubbleSortForPictures(c_pic_obj,data[0].picname);
            var cn1 ="#pic_datas_"+data[0].picname;
             var ass_contentObj;
            if($(cn1).val()!=""){//存在，则合并
                var news_contentObj=JSON.parse($(cn1).val());
                ass_contentObj={"datas":news_contentObj["datas"].concat(c_pic_sort_obj)};
            }else{//不存在，新组
                  ass_contentObj={"datas":c_pic_sort_obj};//把子集对象都装到c_pic_all_obj的datas对象
                }
            var jsonText = JSON.stringify( ass_contentObj);  
            $(cn1).val(jsonText);//写到input
            $("#"+data[0].picname).val(jsonText);
            check_upload_file(data[0].picname);

        },
        onUploadError:function(filename,reinfo){
           var dataObj=eval("("+reinfo+")");
            $("#pic_switch_"+data[0].picname).val("1");
            check_upload_file("");
         },
        onDeleted:function(index){ } //alert('aaa');
  });
}

function bubbleSortForPictures(arr,picname){//冒泡  小到大排序图片
    var pictures_index_obj = $("#pic_datas_index_"+picname).val();
    var pictures_index_arr = pictures_index_obj.split("@");
    //alert(pictures_arr.length);
    //外层循环，共要进行arr.length次求最大值操作
    for(var i=0;i<pictures_index_arr.length;i++){
        //内层循环，找到第i大的元素，并将其和第i个元素交换
        for(var j=i;j<pictures_index_arr.length;j++){
            if(pictures_index_arr[i]>pictures_index_arr[j]){
                //交换两个元素的位置
                var indexTemp=pictures_index_arr[i];
                var objTemp= arr[i];
                pictures_index_arr[i]=pictures_index_arr[j];
                arr[i]=arr[j];
                pictures_index_arr[j]=indexTemp;
                arr[j]=objTemp;
            }
        }
    }
    return arr;
}

function check_upload(pxh,porder,pathcode,picname){
       if (!$('#pic_upload_'+picname).html5uploader.uploads(pxh,porder,pathcode,picname))
        $("#pic_switch_"+picname).val("0"); 
    }

//td中小图片显示与上传
function upload_td_pic(pic_name,pic_order){
  var data;
  // console.log("#dpic_td_"+pic_name);
  $("#dpic_td_"+pic_name).html5uploader(pic_order,{
        auto:false, multi:false,
        fileTypeExts:"image/jpeg,image/png,image/gif",
        removeTimeout:9999999, limitFiles:1,
        url:'upload.php',
        picname:pic_name,
        picfile:pic_name,
        definedTitle:false,
        itemTemplate:"<li id='${fileID}file'><table  border='0' cellspacing='0' cellpadding='0'>"
        +" <tr><td><div style='position:relative;'><span class='filename'>文件名：${fileName}</span><a class='delfilebtn' style='position:absolute;top:0;left:0' id='${fileID}a'>"
        +" <img src='images/delete.png' style='width:15px'/></a></div></td></tr></table></li>",
        onSelectting:function(files){  return true; },//可决定文件是否被选择成功
        onSelected:function(){ $("#pic_switch_"+data[0].picname).val("1");},//alert('选择完成');
        onUploadStart:function(){ },//alert('开始上传');
        onInit:function(){ data=$(this);},//alert('初始化');
        onSingleUploadSuccess:function(reinfo,title,file_index){
            var dataObj=eval("("+reinfo+")");//转换为json对象$data['img_name']
          $("#pic_"+data[0].picname).val(dataObj.save_name);
             check_upload_file(data[0].picname);
            },
        onUploadComplete:function(filename){//alert('全部上传完成');
            check_upload_file(data[0].picname);
            },
        onUploadError:function(filename,reinfo){   },
        onDeleted:function(index){ } //alert('aaa');
  });

}

//商品滚动多图显示
function upload_multi_pic_init(pic_name,pic_order,pic_num){
  var data;
  $("#pic_upload_"+pic_name).html5uploader(pic_order,{
    auto:false, multi:true,
    fileTypeExts:"image/jpeg,image/png,image/gif",
    removeTimeout:9999999,
    url:'upload.php',
    picname:pic_name,
    picfile:pic_name,
    definedTitle:false,
    limitFiles:pic_num,
    onSelectting:function(files){  return true; },//可决定文件是否被选择成功
    onSelected:function(){},//文件选择完成时
    onUploadStart:function(){},//上传开始时的动作
    onSingleUploadSuccess:function(reinfo,title,file_index){//每有一个文件上传成功时生成input存放文件的名称
      var dataObj=eval("("+reinfo+")");
      var pic_html = "<input type='hidden' class='multi_pic_input' value='"+dataObj.save_name+"'/>";
      $("#dpicm_"+data[0].picname).append(pic_html);
    },
    onUploadComplete:function(){//上传完成的动作
      save_data();
    },
    onUploadError:function(){}, //上传失败的动作
    onInit:function(){data=$(this);},//初始化时的动作
    onDeleted:function(){}//删除完成时
  });
}
//多图片显示
function multi_pic_show(plabelname,pvalue){
  var p_html = "<table id='pic_table_"+plabelname+"' width='80' border='0' cellspacing='0' cellpadding='0' >";
 if(pvalue["datas"]&&pvalue["datas"][0]["c_pic"]!=""){
    for(var i = 0 ; i < pvalue["datas"].length;i++){
      p_html += "<tr border:0px><td border:0px><div align='center' style='position:relative;left:0px;'>";
      p_html+="<img src='"+pvalue["datas"][i]["c_pic"]+"' width='150px' height='120px' onload='DrawImage(this,150,120);' onerror=\"this.src='images/default.png'\"/>";
      p_html += "<div class='pic_delete' style='position:position;top:0px;right:0px;'><img src='images/delete.png' width='16' height='16' />";
      // p_html += " onclick='delete_pic_proc(\""+plabelname+"\")'/>";
      p_html += "</div></div></td></tr>";
    }  }
  p_html +="</table>";
  
  $("#pic_container_"+plabelname).html(p_html);
}