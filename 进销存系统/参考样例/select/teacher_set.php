<?php 
  $stsnum=get_session('stsnum');
  $model= GfUser1::model()->find("STSNUM=".$stsnum);
  $model1=ClubNews::model()-> get_chose_news($model->club_id);
  $xs_sign=ClubNewsSignList::model()-> get_sign_news($stsnum);
  $st2= Sclass::model()->find("STSNUM=".$stsnum.' and scterm=4');
?>
 <html ng-app="ionicApp">
   <script type="text/javascript">
     angular.module('ionicApp', ['ionic'])
     .controller('SlideController', function($scope) {
      $scope.myActiveSlide = 0;});
   </script>
   <style type="text/css">
    .slider {    height: 34%;}
    .slider-slide {
      color: #000; 
      text-align: center; 
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: 300; }
    .a {  background-image: url(img/3.jpg); background-size: 100% 100% ;}
    .b {  background-image: url(img/4.jpg);background-size: 100% 100% ;}
    .c { background-image: url(img/15.jpeg); background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);  }
  </style>

<!--頂部-->
 <div class="bar bar-header bar-positive item-input-inset " ><h1 class="title">社會實踐簽到登記</h1></div>

<!--內容--> 
<ion-view title="Home" hide-nav-bar="true">
<ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">

<?php  $form = $this->beginWidget('CActiveForm', get_form_list()); ?>

<div class="box">
  <div class="box-title c">
  <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i><font style="color:#000000;">刷新</font></a>
  <a style="display:none;" id="j-save" class="btn" href="javascript:;" onclick="set_mark();" >
  <i class="fa fa-edit"></i><font style="color:#000000;">登記</font></a>
</div>
 <div class="box-table">
<form action="<?php echo Yii::app()->request->url;?>" method="get">
  <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">  
  <table class="list" id='list2' width="560">
  <tr > 
    <td width="10%"><?php echo $form->labelEx($model, 'STLEVEL'); ?></td>
    <td width="20%" id="STLEVEL" ><?php echo $st2->SCLEV; ?></td>
    <td width="10%"><?php echo $form->labelEx($model,'STCLASS'); ?></td>
    <td width="20%" id="STCLASS"><?php echo $st2->SCCLASS; ?></td> 
    <td rowspan="4" width="30%" id='stpic' align="center">
<?php 
 $s1=$model->STSNUM;
 $p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
?>
 <img id="pic_" name="pic_" src="<?php echo $p; ?>" width="160" height="180">
 </td>
</tr>  
<tr > 
      <td><?php echo $form->labelEx($model, 'SCSNUM'); ?></td> 
      <td  id="SCSNUM" ><?php echo$st2->SCSNUM; ?></td>
      <td  ><?php echo $form->labelEx($model, 'STNAME'); ?></td>
      <td  id="STNAME"><?php echo $model->STNAME; ?></td> 
  </tr>
<tr >
<td >活動名稱</td>
<td ><?php echo $model1[0]->news_title; ?></td>
<td ><?php echo $form->labelEx($model, 'organization'); ?></td>
<td ><?php echo $model->organization; ?></td>
</tr>
<tr >
<td >活動地址</td>
<td ><?php echo $model1[0]->news_address; ?></td>
<td >活動時間</td>
<td ><?php echo $model1[0]->news_date; ?></td>
</tr>  
<tr><td>簽到範圍</th><td id='show_dista'><?php echo $model1[0]->sign_dist; ?></td>
<td >距活動點(M)</td><td id='show_real_dist' name='show_real_dist' >100m</td>
 <td> <a  id="j-save" class="btn" href="javascript:;" onclick="set_mark();" >
  <i class="fa fa-edit"></i><font style="color:#000000;">簽到</font></a></td>
</tr>
<tr><td>當前時間</td><td id='show_time'></td>
  <td>簽到時間</td><td id='show_timeA'></td>
  <td> <a id="j-save" class="btn" href="javascript:;" onclick="set_mark_out();" >
  <i class="fa fa-edit"></i><font style="color:#000000;">簽退</font></a></td>
</tr>

</table>
 </form>
<table class="list" id="list_mark">
  <tr >
  <td class="check"><input id="j-checkall" class="input-check" type="checkbox"></td>
  <td style='text-align: center;'>序號</td>
  <td style='text-align: center;'>名稱</td>
  <td style='text-align: center;'>時間</td>
  <td style='text-align: center;'>簽到</td>
  <td style='text-align: center;'>簽退</td>
  </tr>
  <tbody>
<?php
  $index = 1;
 foreach($model1 as $v){ 
   $ch='待簽到';$ch1='待簽退';$sg=0;$id=0;
   foreach($xs_sign as $v1){
    if(($v1->club_news_id==$v->id)) {
      $sg=1;$id=$v1->id;
        put_msg('=b='. $index.',ID='.$v1->id);
    
      put_msg('=a='.$v1->f_starttime);
       put_msg('=b='.$v1->f_start);
     if($v1->f_start==1){ $ch=$v1->f_starttime;} 
     if($v1->f_end==1){ $ch1=$v1->f_endtime;}
     $ch=$v1->f_starttime;
      }
    } 
    if ($sg==1){
?>
<tr id="row_<?php echo $index ?>" name="row_<?php echo $index ?>" value="<?php echo $index ?>" >
   <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>" <?php echo $ch ?> ></td>
   <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->news_title; ?></td>
   <td style='text-align: center;'><?php echo $v->news_date; ?></td>
   <td style='text-align: center;'><?php echo $ch; ?></td>
   <td style='text-align: center;'><?php echo $ch1; ?></td>
    <input name="id<?php echo $index ?>" id="id<?php echo $index ?>" type="hidden" value="<?php echo $id; ?>">
  </tr>
<?php $index++;}
  } 
?>
</tbody>
</table>
  <input type="hidden" name="row_num" id="row_num" value="<?php echo $index-1;?>">
  <input name="stsnum" id="stsnum" type="hidden" value=""/> 
  <input name="stname" id="stname" type="hidden" value=""/> 
  <input name="syear" id="syear" type="hidden" value=""/>
  <input name="sterm" id="sterm" type="hidden" value=""/> 
  <input name="sdatec" id="sdatec" type="hidden" value=""/> 
  <input name="sdate" id="sdate" type="hidden" value=""/> 
  <input name="stimec" id="stimec" type="hidden" value=""/> 
  <input name="tcod" id="tcod" type="hidden" value=""/> 
  </div><!--box-table end-->
<?php $this->endWidget();?>
<div class="box-page c"><?php $this->page($pages); ?></div>
</div><!--box end-->    
   </ion-scroll>
  </ion-view>
  <!-- 底部-->
   <div class="tabs tabs-positive tabs-icon-top">
  <a class="tab-item active" href="../../../hkyg/login.php">
    <i class="icon ion-ios-home-outline"></i>首頁</a>
   <a class="tab-item active" href="../../../hkyg/index.php?r=select/teacherset&stsnum=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>活动位置设置</a>

   <a class="tab-item active" href="../../../hkyg/index.php?r=select/teacherscore&stsnum=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>教師評分</a>
  <a class="tab-item active" href="../../../hkyg/index.php?r=select/teacherlate&stsnum=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>教師點名</a>
  </div> 
  </body>
</html>
<script>
var deleteUrl = '<?php echo $this->createUrl('update', array('id'=>'ID'));?>';
/*--------------生成規格-----------------*/
var $standard_box=$('#standard_box');
$('#attr_create_btn').on('click', function(){set_mark();});
       
function set_mark(){
 var boxnum =$('#row_num').val();// $('#list_mark').find('.selected');
  var ch=0;
        for(var j=1;j<=boxnum-0000;j++)
        {   ch=1;
            if ($('#row_'+j).attr('class')=='selected') ch=1;
             save_mark($('#id'+j).val(),ch,<?php echo $stsnum;?>,'start');
        }
}
function set_mark_out(){
 var boxnum =$('#row_num').val();// $('#list_mark').find('.selected');
  var ch=0;
        for(var j=1;j<=boxnum-0000;j++)
        {   ch=1;
           console.log('j='+j+',val='+$('#id'+j).val());
            if ($('#row_'+j).attr('class')=='selected') ch=1;
             save_mark($('#id'+j).val(),ch,<?php echo $stsnum;?>,'end');
        }
}
  function save_mark(pid,pvalue,pstsnum,pfieldname){
     var s2='<?php echo $this->createUrl("ClubNewsSignList/Savestartend");?>';
      $.ajax({
        type: 'get',
        url: s2,
        data: {'id': pid,'Savelate':pvalue,'stsnum':pstsnum,'field':pfieldname},
        dataType:'json',
        success: function(data) {
          console.log(data);
       },
       error:   function(XMLHttpRequest, textStatus, errorThrown) {
                     console.log(XMLHttpRequest);
                    }
    });
 }

 function showTime()
{
 //創建Date對象
 var today = new Date();
 //分別取出年、月、日、時、分、秒
 var year = today.getFullYear();
 var month = today.getMonth()+1;
 var day = today.getDate();
 var hours = today.getHours();
 var minutes = today.getMinutes();
 var seconds = today.getSeconds();
 //如果是單個數，則前面補0
 month  = month<10  ? "0"+month : month;
 day  = day <10  ? "0"+day : day;
 hours  = hours<10  ? "0"+hours : hours;
 minutes = minutes<10 ? "0"+minutes : minutes;
 seconds = seconds<10 ? "0"+seconds : seconds;
  
 //構建要輸出的字符串
 var str = month+"月"+day+"日"+hours+":"+minutes+":"+seconds;
  
 //獲取id=result的對象
 var obj = document.getElementById("show_time");
 //將str的內容寫入到id=result的<div>中去
 obj.innerHTML = str;
 $("#sdate").val(year+"-"+month+"-"+day+" "+hours+":"+minutes+":"+seconds);
 $("#sdatec").val(year+"-"+month+"-"+day);
 $("#stimec").val(hours+":"+minutes+":"+seconds);
 $("#syear").val(year);
 //延時器
 window.setTimeout("showTime()",1000);
}
</script> 

<script>
//<button onclick="getLocation()">試壹下</button>

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
 // s2=position.coords.longitude;
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
  // $("#bqd").attr("disabled",d>=60);
   $("#show_real_dist").html(d);
  // $("#show_dista").html(x);
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
showTime();
</script>