<?php 
  $stsnum=get_session('stsnum');
  $model= GfUser1::model()->find("STSNUM=".$stsnum);
  $st2= Sclass::model()->find("STSNUM=".$stsnum.' and SCYEAR=2018');
  $cid=0;
  if(!empty($st2)){
   $cid=$st2->club_id;
  }
  $model1=ClubNews::model()-> get_chose_news($cid);
 
  $xs_sign=ClubNewsSignList::model()-> get_sign_news($stsnum);
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
    .c { background-image: url(img/41.jpg); background-size: 100% 100% ;}
    .box{  height:100%; } 
    .box h3{ position:relative; top:50%; transform:translateY(-50%);  }
  </style>

<!--頂部-->
 <div class="bar bar-header bar-positive item-input-inset " ><h1 class="title">學生社會活動報名登記</h1></div>
<!--內容--> 
<ion-view title="Home" hide-nav-bar="true">
<ion-scroll  direction="y" scrollbar-y="false" style="width: 100%; height: 100%">
<?php  $form = $this-> beginWidget('CActiveForm', get_form_list()); ?>
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>信息列表</h1></div><!--box-title end-->
    <div class="box-content">
     <div class="box-header">
      <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
      <a style="display:none;" id="j-delete" class="btn" href="javascript:;"  onclick="set_mark()"></a>
   <a class="btn" id="j-save" href="javascript:;" onclick="set_mark();" >
   <i class="fa fa-edit"></i><font style="color:#000000;">報名確認</font></a>
   
  </div><!--box-header end-->

 <div class="box-table">

  <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">  
     <table class="list" id='list2' >
          <tr > 
            <td width="10%"><?php echo $model->getAttributeLabel( 'STLEVEL'); ?></td>
            <td width="20%" id="STLEVEL" ><?php echo (empty($st2)) ? "" : $st2->SCLEV; ?></td>
            <td width="10%"><?php echo $model->getAttributeLabel('STCLASS'); ?></td>
            <td width="20%" id="STCLASS"><?php echo (empty($st2)) ? "" : $st2->SCCLASS; ?></td> 
            <td rowspan="3" width="30%" id='stpic' align="center">
        <?php 
         $s1=''.$stsnum;
         $p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
        ?>
         <img id="pic_" name="pic_" src="<?php echo $p; ?>" width="160" height="180">
         </td>
        </tr>  
        <tr > 
              <td><?php echo $model->getAttributeLabel( 'SCSNUM'); ?></td> 
              <td  id="SCSNUM" ><?php echo empty($st2) ? "" : $st2->SCSNUM; ?></td>
              <td  ><?php echo $model->getAttributeLabel( 'STNAME'); ?></td>
              <td  id="STNAME"><?php echo empty($st2) ? "" : $model->STNAME; ?></td> 
          </tr>
    <tr > 
        <td ><?php echo$model->getAttributeLabel( 'organization'); ?></td>
        <td colspan="3" ><?php echo empty($st2) ? "" : $st2->club_name; ?></td>
  </tr>  
  </table>

<table class="list" id="list_mark">
  <tr >
  <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
  <th style='text-align: center;' with='10%'>序號</th>
  <th style='text-align: center;' with='30%'>名稱</th>
  <th style='text-align: center;' with='10%'>人数</th>
  <th style='text-align: center;' with='10%'>已报</th>
  <th style='text-align: center;' with='20%'>時間</th>
  <th style='text-align: center;' with='20%'>活動地址</th>
  </tr>
  <tbody>
<?php
  $index = 1;
 foreach($model1 as $v){ 
   $ch='';
   foreach($xs_sign as $v1){
     if(($v1->club_news_id==$v->id) && ($v1->f_chose==1)){ $ch=' checked="checked"';}
    } 
?>
<tr id="row_<?php echo $index ?>" name="row_<?php echo $index ?>" value="<?php echo $index ?>" >
    <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>" <?php echo $ch ?> ></td>
   <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->news_title; ?></td>
   <td style='text-align: center;'><?php echo $v->sign_max; ?></td>
   <td id='sign_<?php echo $index ?>' style='text-align: center;'><?php echo $v->sign_num; ?></td>
   <td style='text-align: center;'><?php echo $v->news_introduction; ?></td>
   <td style='text-align: center;'><?php echo $v->news_address; ?></td>
    <input name="id<?php echo $index ?>" id="id<?php echo $index ?>" type="hidden" value="<?php echo CHtml::encode($v->id); ?>">
  </tr>
<?php $index++; } 
?>
</tbody>
</table>
 <input type="hidden" name="row_num" id="row_num" value="<?php echo $index-1;?>">
</div><!--box-table end-->
<div class="box-page c"><?php $this->page($pages);?></div>
</div><!--box-content end-->
</div><!--box end-->

<?php $this->endWidget(); ?>
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

<script>
var deleteUrl = '<?php echo $this->createUrl('update', array('id'=>'ID'));?>';
/*--------------生成規格-----------------*/
var $standard_box=$('#standard_box');
$('#attr_create_btn').on('click', function(){set_mark();});

function set_mark(){
 var boxnum =$('#row_num').val();// $('#list_mark').find('.selected');
  var ch=0;
        for(var j=1;j<=boxnum;j++)
        {   ch=0;
            if ($('#row_'+j).attr('class')=='selected') ch=1;
           // console.log('save='+ch);

             save_mark($('#id'+j).val(),ch,<?php echo $stsnum;?>,j);
        }
}

  function save_mark(pid,pvalue,pstsnum,j){
     var s2='<?php echo $this->createUrl("ClubNewsSignList/Savechose");?>';
      $.ajax({
        type: 'get',
        url: s2,
        data: {'id': pid,'chose':pvalue,'stsnum':pstsnum},
        dataType:'json',
        success: function(data) {
          $('#sign_'+j).html(data['sign_num'])
       },
       error:   function(XMLHttpRequest, textStatus, errorThrown) {
                     console.log(XMLHttpRequest);
                    }
    });
 }
 console.log('164');
</script>     
