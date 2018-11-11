<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,height=device-height">
    <script type="text/javascript">
    angular.module('ionicApp', ['ionic'])
    .controller('SlideController', function($scope) {
      $scope.myActiveSlide = 0;
    });
  </script>
   <style type="text/css">
    .slider {      height: 34%;}
    .slider-slide {
      color: #000; 
      text-align: center; 
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: 300; }
    .a {background-image: url(img/55.jpg);background-size: 100% 100% ;}
    .b {background-image: url(img/66.jpg);background-size: 100% 100% ;}
    .c {background-image: url(img/166.jpeg); background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);}
    </style>
  </head>
<!--頂部-->
 <div class="bar bar-header bar-positive item-input-inset "></div>
<!--內容-->
 <ion-view title="Home" hide-nav-bar="true">
 <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">

<div>
  <div ng-app="ionicApp" animation="slide-left-right-ios7" ng-controller="SlideController"></div>
  <div>
    <div><p style="background-color:#99BBFF  ">活動部分介紹</p>
      <div >
      </div>
    </div> 
  </div>
</div>

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

