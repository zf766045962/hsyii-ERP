<?php 
if (!isset($_REQUEST['club_news_id'])) {$_REQUEST['club_news_id']=0;}
$club_news= ClubNews::model()->getClubnews();
$f_lates=Basecode::model()->getCode(40);    
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
    .c { background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);  }
  </style>

<!--頂部-->
 <div class="bar bar-header bar-positive item-input-inset " ><h1 class="title">學生活動請假登記</h1></div>

<!--內容--> 
<ion-view title="Home" hide-nav-bar="true">
<ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">

<div class="box">
  <div class="box-title c" style="margin-top:0px;margin-bottom:0px;">
  <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i><font style="color:#000000;">刷新</font></a>
  <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="set_mark();" >
  <i class="fa fa-edit"></i><font style="color:#000000;">批入請假</font></a>
</div>
 <div class="box-table" style="margin-top:0px;margin-bottom:0px;">
<form action="<?php echo Yii::app()->request->url;?>" method="get">
  <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>"> 
  <input type="hidden" name="stsnum" value="<?php echo Yii::app()->request->getParam('stsnum');?>">  
 
<table class="list" id="list_mark2" border="1" style="margin-top:0px;margin-bottom:0px;">
<tr >
    <td width='60%'>活動:<select name="club_news_id">
            <option value="">請選擇</option>
            <?php foreach($club_news as $v){?>
            <option value="<?php echo $v->id;?>"<?php if(Yii::app()->request->getParam('club_news_id')==$v->id){?> selected<?php }?>><?php echo $v->news_title;?></option>
            <?php }?>
        </select></td>
    <td width='10%'> <button  type="submit" class="btn btn-blue">
    <font style="color:#000000;">查詢</font></button>
    </td>
    <td width='30%'>批入請假：<select name="f_lates" id="f_lates">
            <option value="">請選擇</option>
            <?php foreach($f_lates as $v){?>
            <option value="<?php echo $v->F_NAME;?>"><?php echo $v->F_NAME;?></option>
            <?php }?>
        </select></a></td>
        
  </tr>
</table>

<table class="list" id="list_mark" style="margin-top:0px;margin-bottom:0px;">
    <thead>
        <tr >
            <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
            <th class="list-id">序號</th>
            <th class="list-id">相片</th>
            <th><?php echo $model->getAttributeLabel('scsnum');?></th>
            <th><?php echo $model->getAttributeLabel('stname');?></th>
            <th><?php echo $model->getAttributeLabel('f_late');?></th>
        </tr>
    </thead>
    <tbody>
<?php
$index = 1;
 foreach($arclist as $v){ 
    $s1=''.$v->stsnum;
 $s1='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
    ?>
<tr id="row_<?php echo $index ?>" name="row_<?php echo $index ?>" value="<?php echo $index ?>" >
    <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>"></td>
    <td ><span class="num num-1"><?php echo $index ?></span></td>
    <td style="margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;">  
    <a style="margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;" href="<?php echo $s1; ?>" target="_blank">
    <img src="<?php echo $s1; ?>" width="45"style="margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right: 0px;">
    </a></td>
    <td><?php echo $v->scsnum; ?></td>
    <td><?php echo $v->stname; ?></a></td>
    <td><input name="f_late<?php echo $index ?>" id="f_late<?php echo $index ?>" type="text" value="<?php
     $ld=$v->f_qrtime;
     if (empty($ld)) {$ld=CHtml::encode($v->f_late);}
     echo $ld; ?>">

    <input name="id<?php echo $index ?>" id="id<?php echo $index ?>" type="hidden" value="<?php echo CHtml::encode($v->id); ?>">
  </td>
  </tr>
<?php $index++; } ?>
                </tbody>
            </table>
 <input type="hidden" name="row_num" id="row_num" value="<?php echo $index-1;?>">
</div><!--box-table end-->
<div class="box-page c" ><?php $this->page($pages);?></div>
</div><!--box-content end-->
</div><!--box end-->


  </ion-scroll>
  </ion-view>

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
    </form>
  </body>
</html>

<script>
var deleteUrl = '<?php echo $this->createUrl('update', array('id'=>'ID'));?>';
/*--------------生成規格-----------------*/
var $standard_box=$('#standard_box');
$('#attr_create_btn').on('click', function(){set_mark();});

function set_mark(){
 var boxnum =$('#row_num').val();// $('#list_mark').find('.selected');
 //console.log($('#f_lates').val());
        for(var j=1;j<=boxnum;j++)
        {  
            if ($('#row_'+j).attr('class')=='selected'){
             $('#f_late'+j).attr('value',$('#f_lates').val());//f_lates
             save_mark($('#id'+j).val(),$('#f_lates').val());
            }
        
        }
}

function save_mark(pid,pvalue){
     var s2='<?php echo $this->createUrl("ClubNewsSignList/Savelate");?>';
      $.ajax({
        type: 'get',
        url: s2,
        data: {'id': pid,'value':pvalue},
        dataType:'json',
        success: function(data) {
         // console(data);
       },
       error:   function(XMLHttpRequest, textStatus, errorThrown) {
                     console.log(XMLHttpRequest);
                    }
    });
 }

</script>     

