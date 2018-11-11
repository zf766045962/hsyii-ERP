  <?php if (!isset($_REQUEST['stsnum'])) {$_REQUEST['stsnum']='0';}
   if($_REQUEST['stsnum']>190000){
    set_session('stsnum',$_REQUEST['stsnum']);
   }
   $model= GfUser1::model()->find("STSNUM=".get_session('stsnum'));
?>
 
  <link href="<?php echo Yii::app()->request->baseUrl;?>/static/my/css/ionic.min.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl;?>/static/my/js/ionic.bundle.min.js"></script>
    <link href="<?php echo Yii::app()->request->baseUrl;?>/static/my/css/style.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->request->baseUrl;?>/static/my/js/cloud.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/static/my/css/ionic.css" >

 <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,height=device-height">
    <script type="text/javascript">
    angular.module('ionicApp', ['ionic'])
    .controller('SlideController', function($scope) {
      $scope.myActiveSlide = 0;
    });
  </script>
    <style type="text/css">
    .slider {      height: 25px;}
    .slider-slide {
      color: #000; 
      text-align: center; 
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: 300; }
    .a {background-image: url(img/55.jpg);background-size: 100% 100% ;}
    .b {background-image: url(img/66.jpg);background-size: 100% 100% ;}
    .c {background-image: url(img/66.jpeg); background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);}
    </style>
  </head>

<!--顶部-->
 <div class="bar bar-header bar-positive item-input-inset " ><h1 class="title">我的信息</h1></div>
<!--内容--> 
<ion-view title="Home" hide-nav-bar="true">
   <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">

   <div class="box-content">
        <?php  $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
        <input type="hidden" name="stsnum" value="<?php echo $_REQUEST['stsnum'];?>">
        <table border="1" cellspacing="1" cellpadding="0" >
          <tr > 
            <td width="10%"><?php echo $form->labelEx($model, 'STLEVEL'); ?></td>
            <td width="50%" id="STLEVEL" ><?php echo $model->STLEVEL; ?></td>
            <td rowspan="5" width="40%" id='stpic' align="center">
        <?php 
         $s1=$model->STSNUM;
         $p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
        ?>
         <img id="pic_" name="pic_" src="<?php echo $p; ?>" width="160" height="180">
         </td>
        </tr>  
         <tr > 
              <td ><?php echo $form->labelEx($model,'STCLASS'); ?></td>
              <td  id="STCLASS"><?php echo $model->STCLASS; ?></td> 
          </tr>
          <tr > 
              <td><?php echo $form->labelEx($model, 'SCSNUM'); ?></td> 
              <td  id="SCSNUM" ><?php echo $model->SCSNUM; ?></td>
          </tr>
          <tr > 
          
              <td  ><?php echo $form->labelEx($model, 'STNAME'); ?></td>
              <td  id="STNAME"><?php echo $model->STNAME; ?></td> 
          </tr>
    <tr > 
        <td ><?php echo $form->labelEx($model, 'organization'); ?></td>
        <td><?php echo $model->organization; ?></td>
  </tr>  
        </table>
      </div>

      <?php
       $model1=ClubNews::model()->findAll('1=1');
      ?>
      <div class="box">
  <div class="box-title c"><h1><i class="fa fa-table"></i>信息列表</h1></div><!--box-title end-->
  <div class="box-content">
  <div class="box-table">
    <table class="list">
     <tr>
      <th style='text-align: center;'>序号</th>
      <th style='text-align: center;'>名称</th>
      <th style='text-align: center;'>介绍</th>
      <th style='text-align: center;'>地址</th>
      <th style='text-align: center;'>机构</th>
      <th style='text-align: center;'>表示</th>
    </tr>
<?php 
$index = 1;
foreach( $model1 as $v){ 
?>
<tr>
   <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->news_title; ?></td>
   <td style='text-align: center;'><?php echo $v->news_introduction; ?></td>
   <td style='text-align: center;'><?php echo $v->news_address; ?></td>
   <td style='text-align: center;'><?php echo $v->news_club_name; ?></td>
   <td style='text-align: center;'>良好</td>
</tr>
<?php $index++; } ?>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages);?></div>
    </div><!--box-content end-->
</div><!--box end-->
   
        <?php 
        $this->endWidget(); ?>

<script>we.tab('.box-detail-tab li','.box-detail-tab-item');</script> 

</ion-scroll>
</ion-view>
  <!-- 底部-->
<div class="tabs tabs-positive tabs-icon-top">
  <a class="tab-item active" href="../../../hkyg2018/login.php">
    <i class="icon ion-ios-home-outline"></i>首页</a>
  <a class="tab-item active " href="../../../hkyg2018/student_chose.php">
    <i class="icon ion-ios-paper-outline"></i>報名</a>
  <a class="tab-item active " href="../../../hkyg2018/student_late.php">
    <i class="icon ion-ios-paper-outline"></i>签到</a>
  <a class="tab-item has-badge active" href="../../../hkyg/admin/qmddwzg/index.php?r=select/shownews">
    <i class="icon ion-ios-eye-outline"></i>活动介绍</a>
  <a class="tab-item active" href="../../../hkyg/admin/qmddwzg/index.php?r=select/studentinfo" >
    <i class="icon ion-ios-person-outline"></i>我信息</a>
  </div> 
</body> 
</html>


