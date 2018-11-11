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
 //$arr= $p_lategate->get_list($d1,$d1);
  $arr= $p_studentcourser->get_list($_SESSION['usercode']);
  $arr1=$p_student->get_student($_SESSION['usercode']);
?>

<script> // html5中默认的script是javascript,故不需要特别指定script language \
var data= <?php echo json_encode($arr)?>;
var st= <?php echo json_encode($arr1)?>;
//console.log(st[stsnum]);
//console.log("<?php echo $_SESSION['usercode']?>");

var tcod="<?php echo $_SESSION['usercode']?>";
var chose=0;
data=data["datas"];
console.log(data);
</script> 
<html ng-app="ionicApp">
  <head>
 <meta charset="UTF-8">
   <title>濠江中學社會實踐服务签到登記系統</title>
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
 getLocation();
 //showPosition(1);
 
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
       <tr  style="height:25px;"><th width="15%" style="font-size:12px">年級：</th>
       <th width="18%" style="height:30px; font-size:12px;"><?php echo $arr1['stlevel']?></th>
       <th width="15%"  style="font-size:12px" >班別</th>
      <th width="18%"  style="height:30px; font-size:12px;" ><?php echo  $arr1['stclass']?></th>
      <th width="15%" style="font-size:12px">學號：</th>
      <th width="18%" style="height:30px; font-size:12px;"><?php echo  $arr1['scsnum']?></th>
      </tr>
    </table>
  <table  width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF7EA;" >
    <tr><th width="100%"  >
 <div id="A">
  <div id="A1"  class="acontent">
  <table  width="100%" border="0" cellspacing="0" cellpadding="0" >
       <tr style="height:30px;" ><th colspan="3" id="result" align="center" style="height:30px; font-size:12px;"></th>
       </tr>
   <tr style="height:30px;" ><th width="20%"></th><th width="12%">
   <input  style="height:30px;width:98%;font-size:12px" type="button" id="bqd" value="签 到 確 認"  onclick="save_data(1);"  /> 
   </th>
  <th width="12%" >
  <input style="height:30px;width:98%;font-size:12px"  type="button"  value="签 退"  onclick="save_data(2);"  /> 
  </th></tr>
       <tr ><th style="font-size:10px;">姓名：</th>
       <th name="sstname" id="sstname" colspan="2" alter='right' style="height:30px;font-size:10px">
       <?php echo  $arr1['stname']?></th>
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
    <table width="100%"  style="font-size:10px">
        <tr style="height: 25px;">
        <th width="15%">活动名称</th><th id='show_title' width="40%"></th>
        <th width="15%">时间</th><th id='show_time' width="30%"></th></tr>
        <tr style="height:25px;" ><th >地址</th><th id='show_address'></th>
        <th style="height:25px;" >签到时间</th><th id='show_time' ></th></tr>
        <tr style="height:25px;"><th >签到范围</th><th id='show_dista'>200m</th>
             <th >距离</th><th id='show_real_dist' name='show_real_dist' >100m</th></tr>

        </table>
        <table width="100%"  style="font-size:10px">
    <thead>
              <tr style="height:35px;">
                <th width="10%">序號</th>
                <th width="15%">活动名称</th>
                <th width="10%">地址</th>
                <th width="20%">机构</th>
                <th width="20%">签到距离</th>
                <th width="25%">時間</th>
              </tr>
              </thead>
              <tbody id="student_course" style="height:30px;"> </tbody>
            </table>
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
 div class="tabs tabs-positive tabs-icon-top">
  <a class="tab-item active" href="../../../hkyg2018/login.php">
    <i class="icon ion-ios-home-outline"></i>首页</a>
  <a class="tab-item active " href="../../../hkyg2018/student_chose.php?STSNUM=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-paper-outline"></i>報名</a>
  <a class="tab-item active " href="../../../hkyg2018/student_late.php?STSNUM=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-paper-outline"></i>签到</a>
  <a class="tab-item has-badge active" href="../../../hkyg/admin/qmddwzg/index.php?r=select/shownews&STSNUM=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-eye-outline"></i>活动介绍</a>
  <a class="tab-item active" href="../../../hkyg/admin/qmddwzg/index.php?r=clubnews/index&news_type=1&STSNUM=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>教师评分</a>
  <a class="tab-item active" href="../../../hkyg/admin/qmddwzg/index.php?r=select/studentinfo&stsnum=STSNUM=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>我信息</a>
  </div> 
</body>
</html>

<script>
//<button onclick="getLocation()">试一下</button>

var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }

function showPosition(position)
  {
   // var a=position;
  var s1,s2;
  s1=position.coords.latitude;
  s2=position.coords.longitude;
  s2=position.coords.longitude;
 // s1=s1.substring(0,6);
//  s2=s2.substring(0,6);
  
 var x="La: " +data[0]['latitude']+ ",Lg:" +data[0]['longitude'];
  //var lng = data[0]['longitude'];//113.200;//empty($_POST['longitude'])?0:$_POST['longitude'];
  //var lat =data[0]['latitude'];// 23.1415;//empty($_POST['latitude'])?0:$_POST['latitude'];
  var p1=3.1415926;//pi()/180.00;
  //var ps1=Math.sin(lat*p1);
  //var latitude=position.coords.latitude;
  //var longitude= position.coords.longitude;

//  $r1=6378137.0*ACOS($ps1);Math.sin(,Math.con(
  // var pc1=Math.cos(lat*p1);
 //var disct_sql=(6378137.0*Math.acos(ps1*Math.sin(latitude*p1)+pc1*Math.cos(latitude*p1)*Math.cos((lng-longitude)*p1)));

    var lat = [position.coords.latitude, data[0]['latitude']]
    var lng = [position.coords.longitude,data[0]['longitude']] 
    var R = 6378137;
    var dLat = (lat[1] - lat[0]) * Math.PI / 180;
    var dLng = (lng[1] - lng[0]) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat[0] * Math.PI / 180) * Math.cos(lat[1] * Math.PI / 180) * Math.sin(dLng / 2) * Math.sin(dLng / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d =Math.round(R * c);
   // return Math.round(d);
  //showPosition_add(position);
   $("#bqd").attr("disabled",d>=60);
   $("#show_real_dist").html(d);
   $("#show_dista").html(x);
  }
  //$lng = empty($_POST['longitude'])?0:$_POST['longitude'];
 // $lat = empty($_POST['latitude'])?0:$_POST['latitude'];
 // $p1=pi()/180.00;
 // $ps1=SIN($lat*$p1);
//  $r1=6378137.0*ACOS($ps1);
 //   $pc1=SIN($lat*$p1);
 //   $pc1=COS($lat*$p1);
// $disct_sql="(6378137.0*ACOS({$ps1}*SIN(a.latitude*{$p1})+{$pc1}*COS(a.latitude*{$p1})*COS(({$lng}-a.longitude)*{$p1})))";

function showPosition_add(position)
{
var latlon=position.coords.latitude+","+position.coords.longitude;

var img_url="http://maps.googleapis.com/maps/api/staticmap?center="
+latlon+"&zoom=14&size=120x300&sensor=false";
document.getElementById("mapholder").innerHTML="<img src='"+img_url+"' />";
}
</script>
<script type="text/javascript">

function show_late(pname,ptype,poname,pxh){
  var s1,s2,s3;
   var p_html ='';
    if(typeof(data)!=="undefined"){

        var obj_len=data.length;  //alert(news_contentObj["datas"].length);
        var i = 0; var i1 = 0;var r1 = 0;
        while (i1 <obj_len) {//alert(train_pid_array[i]);
            r1=r1+1;
              p_html = p_html +'<tr style="height:20px;" ><th>'+r1+'</th>';
              p_html = p_html +'<th>'+data[i1]['news_title']+'</th>';
              p_html = p_html +'<th>'+data[i1]['news_address']+'</th>';
              p_html = p_html +'<th>'+data[i1]['news_club_name']+'</th>';
              p_html = p_html +'<th>'+data[i1]['sign_dist']+'</th>';
              p_html = p_html +'<th>'+data[i1]['news_date']+'</th>';
              p_html = p_html +'</tr>';
           i1++;
         }
      }
  $("#student_course").html(p_html);
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
 $("#sstname").html(data.stname);
 $("#stname").val(st['stsnum']);
 $("#sterm").val(data.scterm);
 $("#stsnum").val(data.stsnum);
 var s1=st['stsnum'];
  var  p='nostudent.png';
 if(is_null(s1)!==""){
   p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'+s1.substring(0,4)+'/s'+s1+'.jpg';
 } 

 var s2='<img id="pic_" name="pic_" src="'+p+'" width="160PX" height="180PX">';
 $("#stpic").html(s2);
} 

function save_get_ajx(save_code,post_data,url){
   save_get_data(save_code,post_data,url);
  } 

function save_get_ok(save_code,data1){//back call
   data=data1;
   if(save_code=='search_student')  { 
  //  show_student(data);
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

function save_data(pcome_out) { //保存数据
    var post_data=$("#data_form").serialize();
    var url="data_interfaces.php?action=save_late&stsnum="+$("#stsnum").val() +"&come_out="+pcome_out;
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
    show_student(data);
 
  show_late();
 }
//init_dialog("dialog1");//设置S数据保存后返回状态选择和提示;//button_sh_qu
main_run();
</script>
