<?php 
   $stsnum=$_REQUEST['stsnum'];
   set_session('stsnum',$stsnum);
   set_session('gfaccount','0000');
   $model= GfUser1::model()->find("STSNUM=".$stsnum);//.get_stsnum());
   $st2= Sclass::model()->find("STSNUM=".$stsnum.' and SCYEAR=2018');
   //.get_stsnum());
   $cid=0;
   if(!empty($model)){
     $cid=$model->club_id;
   }
   $model1=ClubNews::model()-> get_chose_news($cid);
   $xs_sign=ClubNewsSignList::model()->get_sign_news($stsnum);
   $model2=ClubList::model()-> find('id='.$cid);
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
 <div class="bar bar-header bar-positive item-input-inset " >我的信息</div>
<!--內容--> 
<ion-view title="Home" hide-nav-bar="true">
<ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">
   <div class="box-content">
        <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
        <input type="hidden" name="stsnum" value="<?php echo $_REQUEST['stsnum'];?>">
      </div>
  <div class="box">
  <!--box-title end-->
  <div class="box-content">
  <div class="box-table">
   <table class="list" id='list2' >
          <tr > 
            <td width="7%"><?php echo $model->getAttributeLabel('STLEVEL'); ?></td>
            <td width="20%" id="STLEVEL" ><?php ;echo $st2->SCLEV; ?></td>
            <td width="8%"><?php echo $model->getAttributeLabel('STCLASS'); ?></td>
            <td width="15%" id="STCLASS"><?php  echo $st2->SCCLASS; ?></td> 
            <td rowspan="4" width="40%" id='stpic' align="center">
        <?php 
         $s1=''.$stsnum;
         $p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
        ?>
         <img id="pic_" name="pic_" src="<?php echo $p; ?>" width="80px" height="90">
         </td>
        </tr>  
        <tr > 
          <td><?php echo $model->getAttributeLabel('SCSNUM'); ?></td> 
          <td  id="SCSNUM" ><?php echo $st2->SCSNUM; ?></td>
          <td  ><?php echo $model->getAttributeLabel('STNAME'); ?></td>
          <td  id="STNAME"><?php echo $model->STNAME; ?></td> 
        </tr>
    <tr > 
        <td ><?php echo $model->getAttributeLabel('organization'); ?></td>
        <td colspan="3" ><?php echo $st2->club_name; ?></td>
  </tr> 
  <?php 
  if (!empty($model2)) { ?> 
   <tr > 
          <td><?php echo $model2->getAttributeLabel('apply_name'); ?></td> 
          <td  id="apply_name" ><?php echo $model2->apply_name; ?></td>
          <td  ><?php echo $model2->getAttributeLabel('contact_phone'); ?></td>
          <td  id="contact_phone"><?php echo $model2->contact_phone; ?></td> 
        </tr>
    <?php } ?> 
  </table>
    <table class="list">
     <tr>
      <th style='text-align: center;'>序號</th>
      <th style='text-align: center;'>名稱</th>
      <th style='text-align: center;'>日期</th>
      <th style='text-align: center;'>地址</th>
      <th style='text-align: center;'>表現</th>
    </tr>
<?php 
$index = 1;
foreach( $model1 as $v){ 
   $ch='';
   foreach($xs_sign as $v1){
     if(($v1->club_news_id==$v->id) && ($v1->f_chose==1)){ 
      $ch=$v1->f_mark;
?>
<tr>
   <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->news_title; ?></td>
   <td style='text-align: center;'><?php echo $v->news_date; ?></td>
   <td style='text-align: center;'><?php echo $v->news_address; ?></td>
   <td style='text-align: center;'><?php echo $ch; ?></td>
</tr>
<?php  $index++;
  }
 }
} ?>
    </table>
</div><!--box-table end-->

<div class="box-page c"><?php $this->page($pages);?></div>
</div><!--box-content end-->
</div><!--box end-->

</ion-scroll>
</ion-view>
  <!-- 底部-->
 <div class="tabs tabs-positive tabs-icon-top">
  <a class="tab-item active" href="../../../hkyg/login.php">
    <i class="icon ion-ios-home-outline"></i>首頁</a>
  <a class="tab-item active " href="../../../hkyg/index.php?r=select/studentchose&stsnum=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-paper-outline"></i>報名</a>
  <a class="tab-item active " href="../../../hkyg/index.php?r=select/studentlate&stsnum=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-paper-outline"></i>簽到</a>
  <a class="tab-item has-badge active" href="../../../hkyg/index.php?r=select/shownews&stsnum=<?php echo $_REQUEST['stsnum'] ;?>">
    <i class="icon ion-ios-eye-outline"></i>活動介紹</a>
  <a class="tab-item active" 
  href="../../../hkyg/index.php?r=select/studentinfo&stsnum=<?php echo $_REQUEST['stsnum'] ;?>" >
    <i class="icon ion-ios-person-outline"></i>我信息</a>
  </div> 
</body> 
</html>

