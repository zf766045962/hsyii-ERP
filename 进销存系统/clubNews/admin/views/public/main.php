<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zh-cn"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="zh-cn"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="zh-cn"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="zh-cn"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>后台管理系统5</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <?php $cs = Yii::app()->clientScript;?>
    <?php $cs->registerCssFile(Yii::app()->request->baseUrl.'/static/admin/css/public.css');?>
    <?php $cs->registerCssFile(Yii::app()->request->baseUrl.'/static/admin/css/font.css');?>
    <?php $cs->registerCssFile(Yii::app()->request->baseUrl.'/static/admin/css/index.css');?>
    <?php //$cs->registerCoreScript('jquery', CClientScript::POS_END);?>
    <?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/jquery.js', CClientScript::POS_END);?>
    <?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/jquery.nicescroll.js', CClientScript::POS_END);?>
    <?php $cs->registerScriptFile(Yii::app()->request->baseUrl.'/static/admin/js/index.js', CClientScript::POS_END);?>
</head>
<body>
<div class="wrapper">
    <div class="header c">
        <div class="logo"><a href="<?php echo Yii::app()->homeUrl;?>"><img src="<?php echo SITE_PATH;?>/static/admin/img/logo.png"></a></div>
        <a class="btn-menu" href="#"><i class="fa fa-reorder"></i></a>
        <ul class="nav">
            <li class="current"><a href="#">管理平台</a></li>
        </ul><!--nav end-->
        <ul class="tool">
            <li><a href="<?php echo SITE_PATH;?>/" target="_blank"><i class="fa fa-home"></i> <span>网站首页</span></a></li>
            <li><a href="<?php echo $this->createUrl('index/logout');?>"><i class="fa fa-sign-out"></i> <span>退出</span></a></li>;
        </ul><!--tool end-->
    </div><!--header end-->
    <div class="container">
        <div class="container-left">
            <div class="subnav">
                <?php foreach(Yii::app()->params['roleItem'] as $v){?>
                <div class="subnav-hd"><a href="javascript:;"><i class="fa fa-angle-down"></i><?php echo $v[0];?></a></div>
                <ul class="subnav-bd">
                    <?php //dump($v);exit;?>
                    <?php foreach($v as $v_item){?>
                        <?php if(is_array($v_item)){?>
                            <?php foreach($v_item as $v_subitem){?>
                                <?php if(count($v_subitem)>1){?><li><a href="<?php echo $this->createUrl($v_subitem[1]);?>" target="container-iframe"><?php echo $v_subitem[0];?></a></li><?php }?>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                </ul><!--subnav-bd end-->
                <?php }?>
            </div><!--subnav end-->
        </div><!--container-left end-->
        <div class="container-right">
            <iframe id="container-iframe" name="container-iframe" frameborder="0" scrolling="auto" src="<?php echo $this->createUrl('public/index');?>"></iframe>
        </div><!--container-right end-->
    </div><!--container end-->
</div><!--wrapper end-->
</body>
</html>