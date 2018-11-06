
<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zh-cn"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="zh-cn"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="zh-cn"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="zh-cn"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>网站后台管理登陆</title>
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
    <script>
        var baseUrl = '<?php echo Yii::app()->request->baseUrl;?>';
        var indexUrl = '<?php echo get_cookie('_currentUrl_');?>';
        var uppicUrl = '<?php echo $this->createUrl('public/uppic');?>';
        var upfileUrl = '<?php echo $this->createUrl('public/upfile');?>';
    </script>
</head>
<body>
<div class="wrapper">
    <div class="main">
    <?php  $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="item"><h1>网站后台登陆</h1></div>
        <div class="item">
            <?php echo $form->textField($model, 'username', array('maxlength' => 50, 'class' => 'user-input', 'placeholder'=>'用户名')); ?>
            <?php echo $form->error($model, 'username', $htmlOptions = array()); ?>
        </div><!--item end-->
        <div class="item">
            <?php echo $form->passwordField($model, 'password', array('class' => 'pwd-input', 'placeholder'=>'密码')); ?>
            <?php echo $form->error($model, 'password', $htmlOptions = array()); ?>
        </div><!--item end-->
         <?php if(CCaptcha::checkRequirements()): ?>
        <div class="item">
            <?php echo $form->textField($model, 'verify', array('class' => 'verify-input', 'placeholder'=>'验证码')); ?>
            <?php echo $form->error($model, 'verify', $htmlOptions = array()); ?>
        </div><!--item end-->
        <div class="item">
            <?php $this->widget('CCaptcha', array('showRefreshButton'=>false, 'clickableImage'=>true, 'imageOptions'=>array('alt'=>'点击刷新', 'title'=>'点击刷新', 'style'=>'vertical-align:top;cursor:pointer;'))); ?>
        </div><!--item end-->
        <?php endif; ?>
    <div class="item"><button class="btn btn-blue" type="submit">登陆</button></div><!--item end-->
    <div class="item"></div><!--item end-->
    <?php $this->endWidget(); ?>
    </div><!--main end-->
</div><!--wrapper end-->
</body>
</html>