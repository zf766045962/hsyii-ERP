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
        <h2 class="success"><i></i>操作成功</h2>
        <div class="content message"><?php echo $message;?></div>
        <div class="bottom">系统将在<span>1</span>秒后自动跳转，如果不想等待，直接点击<a href="<?php if(empty($redirect)){ echo 'javascript:window.history.go(-1);'; }else{ echo $redirect;}?>">这里</a></div><!--bottom end-->
    </div><!--show_msg end-->
    <script>
        setTimeout(function(){
            <?php if(empty($redirect)){?>
                window.history.go(-1);
            <?php }else{ ?>
                window.location.href = '<?php echo $redirect;?>';
            <?php }?>
        }, 1000);
    </script>
</body>
</html>