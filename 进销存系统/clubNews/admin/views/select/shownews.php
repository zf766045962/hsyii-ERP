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
    .a {  background-image: url(img/13.jpg); background-size: 100% 100% ;}
    .b {  background-image: url(img/14.jpg);background-size: 100% 100% ;}
    .c { background-image: url(img/15.jpeg); background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);  }
    .imc-scroll {
   width: 100%;
   height: 140px;
   white-space: nowrap;
   overflow-x: scroll;
   overflow-y: hidden;
   overflow-scrolling: touch;
   -webkit-overflow-scrolling: touch /*iOS 滚动弹簧效果 */
 }


  </style>
<!--頂部-->

 <div class="bar bar-header bar-positive item-input-inset " ><h1 class="title">社會實踐信息列表</h1></div>

  <ion-view title="Home" hide-nav-bar="true">
  <ion-content overflow-scroll="true">
  <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">

<div class="box">
  <div class="box-content">
  <div class="box-table">
    <table class="list">
     <tr>
      <th style='text-align: center;'>序號</th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('news_title');?></th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('news_introduction');?></th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('news_address');?></th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('club_id');?></th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('sign_date_start');?></th>
      <th style='text-align: center;'><?php echo $model->getAttributeLabel('sign_date_end');?></th>     
    </tr>
<?php 
$index = 1;
foreach($arclist as $v){ 
?>
<tr>
   <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->news_title; ?></td>
   <td style='text-align: center;'><?php echo $v->news_introduction; ?></td>
   <td style='text-align: center;'><?php echo $v->news_address; ?></td>
   <td style='text-align: center;'><?php echo $v->news_club_name; ?></td>
   <td style='text-align: center;'><?php echo $v->sign_date_start; ?></td>
   <td style='text-align: center;'><?php echo $v->sign_date_end; ?></td>
</tr>
<?php $index++; } ?>
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

