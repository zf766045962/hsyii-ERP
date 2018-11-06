<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/admin/css/public.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/admin/css/style.css">
</head>
<body style="background:#fff; text-align:center;">
    <div class="show_msg">
        <h2 class="fail"><i></i>操作失败</h2>
        <div class="content error"><?php echo $message;?></div>
        <div class="bottom">系统将在<span>3</span>秒后自动跳转，如果不想等待，直接点击<a href="javascript:window.history.go(-1);">这里</a></div><!--bottom end-->
    </div><!--show_msg end-->
    <script>
        setTimeout(function(){
            window.history.go(-1);
        }, 3000);
    </script>
</body>
</html>