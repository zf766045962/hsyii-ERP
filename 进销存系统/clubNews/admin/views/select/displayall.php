<?php
require_once('./init.php');
 session_start();
 isset($PHPSESSID)?session_id($PHPSESSID):$PHPSESSID = session_id();  
// 如果设置了$PHPSESSID，就将SessionID赋值为$PHPSESSID，否则生成SessionID  
setcookie('PHPSESSID', $PHPSESSID, time()+3156000); // 储存SessionID到Cookie中  
 $d1=date("Y/m/d");
 if($_SESSION['usercode']==""){
   header("Location:login.php"); 
 //确保重定向后，后续代码不会被执行 
 exit;
}
 $arr= $p_lategate->get_list($d1,$d1);
?>
<script> // html5中默认的script是javascript,故不需要特别指定script language 
var data= <?php echo json_encode($arr)?>;
var stsnum="<?php echo $_SESSION['usercode']?>+";
var chose=0;
data=data["datas"];
</script> 
<html ng-app="ionicApp">
  <head>
 <meta charset="UTF-8">
    <title>濠江中學門口遲到登記系統</title>

<link href="css/css.css" rel="stylesheet" type="text/css" />

    <link href="css/ionic.min.css" rel="stylesheet">
    <script src="js/ionic.bundle.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="js/jquery.js"></script>
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,height=device-height">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/ionic.css" > 


  <link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="model/css/game_new.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui.css" rel="stylesheet">
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.zsyl.datagrid.js"></script>
  <link href="css/jquery.ui.zsyl.datagrid.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery.json-2.4.js"></script> 
  <script src="js/js_combo_show.js"></script>
<script src="js/js_pic_show.js"></script>
<script src="js/public.js"></script>  

    <script type="text/javascript">
    angular.module('ionicApp', ['ionic'])
    .controller('SlideController', function($scope) { 
      $scope.myActiveSlide = 0; 
    });
</script>

<script type="text/javascript">
 
 
//定义函数：构建要显示的时间日期字符串
function showTime()
{
 //创建Date对象
 var today = new Date();
 //分别取出年、月、日、时、分、秒
 var year = today.getFullYear();
 var month = today.getMonth()+1;
 var day = today.getDate();
 var hours = today.getHours();
 var minutes = today.getMinutes();
 var seconds = today.getSeconds();
 //如果是单个数，则前面补0
 month  = month<10  ? "0"+month : month;
 day  = day <10  ? "0"+day : day;
 hours  = hours<10  ? "0"+hours : hours;
 minutes = minutes<10 ? "0"+minutes : minutes;
 seconds = seconds<10 ? "0"+seconds : seconds;
  

 $("#syear").val(year);
 $("#syue").val(month);
 $("#sday").val(day);
 //延时器
}
</script>
<style type="text/css">
#result{
 border:0px solid #CCCCCC;
 margin:0px auto;
 font-size:1px;
 color:#FF0000;
 padding:0px;
}
</style>

<style type="text/css">
    .slider { height: 34%;}
    .slider-slide {
      color: #000;   text-align: center; 
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: 300; }
    .a {background-image: url(img/55.jpg);background-size: 100% 100% ;}
    .b {background-image: url(img/66.jpg);background-size: 100% 100% ;}
    .c {background-image: url(img/66.jpeg);background-size: 100% 100% ;}
    .box{     height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%); }
    </style>
<style type="text/css">
  .acontent {
margin:0px auto;
width: 70%;
float: left;
}
    </style>
<style type="text/css">
  .bcontent {
margin:0px auto;
width: 30%;
float: left;
}
    </style>

  </head>
 
<body >

<!--顶部-->
  <ion-view title="Home" hide-nav-bar="true">
   <div style="font:bold;font-size:12px;"></div>
  <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">
    <div>
    <form id="data_form">
     <input name="stsnum" id="stsnum" type="hidden" value=""/> 
     <input name="stname" id="stname" type="hidden" value=""/> 
     <input name="sterm" id="sterm" type="hidden" value=""/> 
     
     <input name="sdatec" id="sdatec" type="hidden" value=""/> 
     <input name="sdate" id="sdate" type="hidden" value=""/> 
     <input name="stimec" id="stimec" type="hidden" value=""/> 
  
   <table class="tablelist" width="100%" border="0" cellspacing="0" cellpadding="0" >
       <tr><th width="15%" style="font-size:24px"> 年份：</th>
       <th width="18%">
       <select name="syear" id="syear" style="height:33px; width:100%;font-size:24px;" >
              <option value="2017">2017</option>
              <option value="2018">2018</option>
            </select></th>
      <th width="67%"></th>
        
      </tr>
    </table>


 <div><a class="button button-block button-positive" href="javascript:void(0)" onclick="show_late_data()" 
  style="font:bold;font-size:36px;">
  点击查询</a></div>
    <table width="100%"  class="tablelist" style=""font-size:20px;">
             <thead>
              <tr style="height: 13px;">
                <th width="10%">序號</th>
                <th width="15%">年級</th>
                <th width="10%">班別</th>
                <th width="20%">學號</th>
                <th width="20%">姓名</th>
                <th width="25%">時間</th>
              </tr>
              </thead>
              <tbody id="student_course" > </tbody>
            </table>
   </form>
    </div>
     <div id="dialog1" title="數據保存成功" style="display:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100%"><img src="images/result.gif" /></td>
            <td></td></tr>
    </table>
    </div>
 
   </ion-scroll>
  </ion-view>
  <!-- 底部-->
<div class="tabs tabs-positive tabs-icon-top"  style="background:#FFFFFF; height:105px;">
    <a class="tab-item active" href="login.php">
      <img src="img/login.png" width=120px height=100px />
    </a>
    <a class="tab-item active"  href="status.php">
       <img src="img/mark.png" width=120px height=100px />
    </a>
    <a class="tab-item has-badge active" href="show_late.php">
       <img src="img/SEARCH.png" width=120px height=100px />
    </a>
      <a class="tab-item active"  href="displayall.php" >
      <img src="img/displayall.png" width=120px height=100px />
    </a>
  </div>  
  </body>
</html>

<script type="text/javascript">

function show_late(pname,ptype,poname,pxh){
  var s1,s2,s3;
   var p_html ='';
    if(typeof(data)!=="undefined"){

        var obj_len=data.length;  //alert(news_contentObj["datas"].length);
        var i = 0; var i1 = 0;var r1 = 0;
        while (i1 <obj_len) {//alert(train_pid_array[i]);
            r1=r1+1;
            var k1=0;
            while (k1 <1){
              k1=k1+1;
              p_html = p_html +'<tr style="height: 12px;" ><th>'+r1+'</th>';
              p_html = p_html +'<th>'+data[i1]['slevel']+'</th>';
              p_html = p_html +'<th>'+data[i1]['sclass']+'</th>';
              p_html = p_html +'<th>'+data[i1]['scsnum']+'</th>';
              p_html = p_html +'<th>'+data[i1]['stname']+'</th>';
              p_html = p_html +'<th>'+data[i1]['sdatec']+'  '+data[i1]['stimec']+'</th>';
              p_html = p_html +'</tr>';
            }
           i1++;
         }
      }
    
  $("#student_course").html( p_html);

}

function show_late_data(){
  

}
function get_select_no(pname,pno,plname){
  var s1,s2,s3;
   var p_html ='<option value="-1">请选择'+plname+'</option>';
    if(plname=='') p_html='';
        var i = 0; var i1 = 0;var r1 = 0;
        while (i1 <pno) {//alert(train_pid_array[i]);
              i1++;
              p_html = p_html +'<option value="'+i1+'">'+i1+'</option>';
         }   
   $("#"+pname).html(p_html);

}

function subgo(i,pt){
     var j,k;
 show_main();
}


function save_get_ajx(save_code,post_data,url){
   save_get_data(save_code,post_data,url);
  } 

function save_get_ok(save_code,data1){//back call
   data=data1;
   if(save_code=='search_student')  { 
    show_student(data);
   }//保存数据返回
  if(save_code=='save_late')  {
    data=data["datas"];
    show_late();
   }//保存数据返回
  if(save_code=='show_late_data')  {
    data=data["datas"];
    show_late();
   }//保存数据返回
} 

function search_student() { //保存数据
    var post_data=$("#data_form").serialize();
    var url="data_interfaces.php?action=search_student&stsnum="+$("#stsnum").val();
    save_get_ajx("search_student",post_data,url);
}

function show_late_data() { //保存数据
    var post_data=$("#data_form").serialize();
    var d1=$("#syear").val();
    var url="data_interfaces.php?action=get_late_by_year&scyear="+d1;
    save_get_ajx("show_late_data",post_data,url);
}


function main_run(){
  //$("#late_date").datepicker( "option", "dateFormat", 'yy-mm-dd hh:mm:ss' );
  var today = new Date();
//   label_date_input("late_date",'2017-10-10');
//  $("#late_date").val(today);
  //get_select_no("sclass",16,"");
  get_select_no("syue",12,"");//sday
  get_select_no("sday",31,"");//sday

  show_late();
 }
//init_dialog("dialog1");//设置S数据保存后返回状态选择和提示;//button_sh_qu
main_run();
</script>