<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zh-cn"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="zh-cn"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="zh-cn"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="zh-cn"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>社會實踐活動</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php $cs = Yii::app()->clientScript;?>
<?php $cs->registerCssFile(Yii::app()->request->baseUrl.'/static/admin/css/login.css');?>
<?php $cs->registerCoreScript('jquery');?>
<?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/jquery.nicescroll.js');?>

<?php $cs->registerCssFile(Yii::app()->request->baseUrl.'/static/admin/js/jquery.fallr/jquery.fallr.css');?>
<?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/jquery.fallr/jquery.fallr.js');?>

<?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/public.js');?>
</head>
<body>
<div class="wrapper">
    <div class="main">
    <?php  $form = $this->beginWidget('CActiveForm', get_form_login()); ?>
        <div class="item"><h1>歡迎使用社會實踐活動</h1></div>
        <div class="item">
            <?php echo $form->textField($model, 'TUNAME', array('maxlength' => 50, 'class' => 'user-input', 'placeholder'=>'用護名')); ?>
            <?php echo $form->error($model, 'TUNAME', $htmlOptions = array()); ?>
        </div><!--item end-->
        <div class="item">
            <?php echo $form->passwordField($model, 'TPWD', array('class' => 'pwd-input', 'placeholder'=>'密碼')); ?>
            <?php echo $form->error($model, 'TPWD', $htmlOptions = array()); ?>
        </div><!--item end-->
      
        <div class="item">
        <button class="button "  type="submit"  onclick="login();" style=" color: #ff000" >登陆</button></div><!--item end-->
    <?php $this->endWidget(); ?>
    </div><!--main end-->
</div><!--wrapper end-->
</body>
</html>

<script>
function login() {
      var post_data = $("#CActiveForm").serialize();
      var s1=$("#Teacher_TUNAME").val();
      var s2='<?php echo $this->createUrl("index/checkUser");?>';
       $.ajax({
        type: 'get',
        url: s2,
        data: {TUNAME: s1,PASSWORD:$("#Teacher_TPWD").val(),SCHOOL:"濠江中學"},
        dataType:'json',
        success: function(data) {
          if (data.TCOD==s1){
             var s22='../hkyg/index.php?r=index/index&TCOD='+s1;
             window.location.href =s22;
          }else{
             alert("密碼有錯");
          }
       },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
        }
    });
 }

window.alert=function(str)   
  { 
var iframe = document.createElement("IFRAME");
iframe.style.display="none";
iframe.setAttribute("src", 'data:text/plain');
document.documentElement.appendChild(iframe);
window.frames[0].window.alert(str);
iframe.parentNode.removeChild(iframe);

 //function       Alert(strText){
    //   var       pWin=window.showModalDialog("b.htm",str,"dialogHeight:116px;       dialogWidth:232px;       help:       No;       resizable:       no;       status:       No;       scroll:no;       dialogTop:"+(screen.height-116)/2+"px;       dialogLeft:"+(screen.width-232)/2+"px;");
   //    }
  } 
</script>

