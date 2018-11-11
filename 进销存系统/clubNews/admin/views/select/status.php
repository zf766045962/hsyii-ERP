<?php
require_once('./init.php');
 session_start();
 isset($PHPSESSID)?session_id($PHPSESSID):$PHPSESSID = session_id();  
// 如果设置了$PHPSESSID，就将SessionID赋值为$PHPSESSID，否则生成SessionID  
 setcookie('PHPSESSID', $PHPSESSID, time()+3156000); // 储存SessionID到Cookie中 
 if($_SESSION['usercode']==""){
   header("Location:login.php"); 
 //确保重定向后，后续代码不会被执行 
 exit;
}
 $d1=date("Y/m/d");
 $arr= $p_lategate->get_list($d1,$d1);
?>

<script> // html5中默认的script是javascript,故不需要特别指定script language \
var data= <?php echo json_encode($arr)?>;
var tcod="<?php echo $_SESSION['usercode']?>";
var chose=0;
data=data["datas"];
</script> 
<html ng-app="ionicApp">
  <head>
 <meta charset="UTF-8">
    <title>濠江中學門口遲到登記系統</title>

  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.zsyl.datagrid.js"></script>
  <link href="css/jquery.ui.zsyl.datagrid.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery.json-2.4.js"></script> 
  <script src="js/js_combo_show.js"></script>
  <script src="js/js_pic_show.js"></script>
  <script src="js/public.js"></script>  
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,height=device-height">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/ionic.css" > 

    <script type="text/javascript">
    angular.module('ionicApp', ['ionic'])
    .controller('SlideController', function($scope) { 
      $scope.myActiveSlide = 0; 
    });
</script>
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
  
 //构建要输出的字符串
 var str = month+"月"+day+"日"+hours+":"+minutes+":"+seconds;
  
 //获取id=result的对象
 var obj = document.getElementById("result");
 //将str的内容写入到id=result的<div>中去
 obj.innerHTML = str;
 $("#sdate").val(year+"-"+month+"-"+day+" "+hours+":"+minutes+":"+seconds);
 $("#sdatec").val(year+"-"+month+"-"+day);
 $("#stimec").val(hours+":"+minutes+":"+seconds);
  $("#syear").val(year);
 //延时器
 window.setTimeout("showTime()",1000);
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
width: 75%;
float: left;
}
    </style>
<style type="text/css">
  .bcontent {
margin:0px auto;
width: 25%;
float: left;
}
    </style>

  </head>
 
<body onLoad="showTime()">

<!--顶部-->
  <ion-view title="Home" hide-nav-bar="true">
   <div style="font:bold;font-size:12px;"></div>
  <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">
	  <div>
    <form id="data_form">
     <input name="stsnum" id="stsnum" type="hidden" value=""/> 
     <input name="stname" id="stname" type="hidden" value=""/> 
     <input name="syear" id="syear" type="hidden" value=""/>
     <input name="sterm" id="sterm" type="hidden" value=""/> 
     
     <input name="sdatec" id="sdatec" type="hidden" value=""/> 
     <input name="sdate" id="sdate" type="hidden" value=""/> 
     <input name="stimec" id="stimec" type="hidden" value=""/> 
    <input name="tcod" id="tcod" type="hidden" value=""/> 
	 <table  width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF7EA;">
       <tr  style="height:70px;"><th width="15%" style="font-size:40px">年級：</th>
       <th width="18%" style="height:55px; width:100%; font-size:40px;"><?php echo $_SESSION['userlevel']?></th>
       <th width="15%"  style="font-size:40px" >班別</th>
      <th width="18%"  style="height:55px;width:100%; font-size:40px;" ><?php echo $_SESSION['userlevel']?></th>
      <th width="15%" style="font-size:40px">學號：</th>
      <th width="18%" style="height:55px; width:100%; font-size:40px;"><?php echo $_SESSION['userlevel']?></th>
      </tr>
    </table>
  <table  width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF7EA;" >
    <tr><th width="100%"  >
 <div id="A">
  <div id="A1"  class="acontent">
  <table  width="100%" border="0" cellspacing="0" cellpadding="0" >
       <tr style="height:60px;" ><th colspan="3" id="result" align="center" style="height:55px; font-size:40px;"></th>
       </tr>
   <tr style="height:70px;" ><th width="20%"></th><th width="40%">
   <input  style="height:55px;width:98%;font-size:40px" type="button"  value="请  假"  onclick="search_student();"  /> 
   </th>
  <th width="40%" >
  <input style="height:55px;width:98%;font-size:40px"  type="button"  value="签 到 確 認"  onclick="save_data();"  /> 
  </th></tr>
       <tr ><th style="font-size:38px;">姓名：</th>
       <th name="sstname" id="sstname" colspan="2" alter='right' style="height:45px;font-size:40px"></th>
       </tr>
 </table>
  </div>
  <div id="A2"  class="bcontent">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" >
     <tr height=100px ><th height=100px width="100%" id='stpic' align="center">
        <img id="pic_" name="pic_" src="nostudent.png" width="80" height="80"></th></tr>
       </table>
    </div>
    </div>
    </th>
   </tr> 
    </table>
    <table width="100%"  class="tablelist" style="font-size:22px">
        <tr style="height: 25px;">
        <th width="30%">活动名称</th><th width="70%"><?php echo $_SESSION['userlevel']?></th>
              </tr>
			  <tr >
                <th >时间</th>
                <th ><?php echo $_SESSION['userlevel']?></th>
              </tr>
			  <tr >
                <th >地址</th>
                <th ><?php echo $_SESSION['userlevel']?></th>
              </tr>

			  <tr >
                <th >签到时间</th>
                <th ><?php echo $_SESSION['userlevel']?></th>
              </tr>
			  <tr >
                <th >签到范围</th>
                <th ><?php echo $_SESSION['userlevel']?></th>
              </tr>
            <tr >
                <th >距离</th>
                <th >年級</th>
          </tr>

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
		  <img src="img/login.png" width=120px height=100px />		</a>
		<a class="tab-item active"  href="status.php">
			 <img src="img/mark.png" width=120px height=100px />		</a>
		<a class="tab-item has-badge active" href="show_late.php">
			 <img src="img/SEARCH.png" width=120px height=100px />		</a>
		  <a class="tab-item active"  href="displayall.php" >
			<img src="img/displayall.png" width=120px height=100px />		</a>	</div>  
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
              p_html = p_html +'<tr style="height: 25px;" ><th>'+r1+'</th>';
              p_html = p_html +'<th>'+data[i1]['slevel']+'</th>';
              p_html = p_html +'<th>'+data[i1]['sclass']+'</th>';
              p_html = p_html +'<th>'+data[i1]['scsnum']+'</th>';
              p_html = p_html +'<th>'+data[i1]['stname']+'</th>';
              p_html = p_html +'<th>'+data[i1]['stimec']+'</th>';
              p_html = p_html +'</tr>';
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

function show_student(data){
 // if (data.error==0){
   //  obj.innerHTML = str;


 $("#sstname").html(data.stname);
 $("#stname").val(data.stname);
 $("#sterm").val(data.scterm);
 $("#stsnum").val(data.stsnum);
 var s1=data.stsnum;
  var  p='nostudent.png';
 if(is_null(s1)!==""){
   p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'+s1.substring(0,4)+'/s'+s1+'.jpg';
 } 

 var s1='<img id="pic_" name="pic_" src="'+p+'" width="160PX" height="180PX">';
 $("#stpic").html(s1);
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
    var d1=$("#syear").val()+'-'+$("#syue").val()+'-'+$("#sday").val();
    var url="data_interfaces.php?action=get_late_by_date&date1="+d1+"&date2="+d1;
    save_get_ajx("show_late_data",post_data,url);
}

function save_data() { //保存数据
    var post_data=$("#data_form").serialize();
    var url="data_interfaces.php?action=save_late&stsnum="+$("#stsnum").val();
    var s1=$("#stsnum").val();
    if(is_null(s1)!==""){
    save_get_ajx("save_late",post_data,url);
  }
}

function main_run(){
  //$("#late_date").datepicker( "option", "dateFormat", 'yy-mm-dd hh:mm:ss' );
  var today = new Date();
//   label_date_input("late_date",'2017-10-10');
  $("#tcod").val(tcod);
  get_select_no("sclass",16,"");
  get_select_no("scsnum",33,"");//sday
  get_select_no("sday",31,"");//sday
  show_late();
 }
//init_dialog("dialog1");//设置S数据保存后返回状态选择和提示;//button_sh_qu
main_run();
</script>
