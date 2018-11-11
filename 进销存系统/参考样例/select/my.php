<?php
 session_start();
?>
<html ng-app="ionicApp">
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>我的信息</title>
    <link href="css/ionic.min.css" rel="stylesheet">
    <script src="js/ionic.bundle.min.js"></script>
	 <script type="text/javascript">
    angular.module('ionicApp', ['ionic'])

    .controller('SlideController', function($scope) {
      
      $scope.myActiveSlide = 0;
      
    });
	
	
    </script>
</head>
<body>
<!--我的信息-->

<!--顶部-->
 <div class="bar bar-header bar-positive item-input-inset " >
     <h1 class="title">我的信息</h1>
	  
	</div>
<!--内容-->	

   <ion-view title="Home" hide-nav-bar="true">
   <ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">
	<div>
	         <div style="width:70px;height:70px;"></div>
	          <div style="margin:10px auto;width:100px;height:100px;border-radius:50px;overflow:hidden;">
					<img src="img/3.jpg" style="margin:0;width:100%;height:100%;">
              </div>
                   <p style="text-align:center"><?php echo $_SESSION['usertype'] .":". $_SESSION['username'];?></p>
		
			 <div>
					 <hr style="height:2px;background-color:#E6E6FA;border:0px" >
					  
			 </div>
			  <div>
			     <ul class="list" >
			        <li style="background-color:#E6E6FA;border:0px" class="item item-toggle item-button-right icon ion-ios-calendar-outline">
				
					</li>
				 </ul>
				 
				
			  </div>
			 
			 
			 
	</div>
	<div style="height:50px;width:100%;clear:all"></div>
	 </ion-scroll>
    </ion-view>
	<!-- 底部-->
	<div class="tabs tabs-positive tabs-icon-top">
		<div class="tabs tabs-positive tabs-icon-top">
		<a class="tab-item active" href="loginm.html">
			<i class="icon ion-ios-home-outline"></i>首页
		</a>
		<a class="tab-item active "  href="course_mchose.php">
			<i class="icon ion-ios-paper-outline"></i>选课
		</a>
		<a class="tab-item has-badge active"  href="indexm.php">
			<i class="icon ion-ios-eye-outline"></i>课程介绍
		</a>
		<a class="tab-item" >
			<i class="icon ion-ios-person-outline"></i>我
		</a>
	</div>  
	</div> 


</body>	
</html>