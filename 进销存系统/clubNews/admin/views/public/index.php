<div style="padding:15px;">
    <!--<div class="box-msg"><p><b>提示信息</b></p><p>网站以前正常显示，现在无法显示请清除缓存试试，<a href="#">【更新缓存】</a></p></div>-->
    <div class="box-info">
        <div class="box-info-hd"><b>服务器信息</b></div>
        <div class="box-info-bd">
            <p>服务器域名/IP：<?php echo $_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]';?></p>
            <div class="hr"></div>
            <p>操作系统：<?php echo PHP_OS;?></p>
            <div class="hr"></div>
            <p>运行环境：<?php echo $_SERVER["SERVER_SOFTWARE"];?></p>
            <div class="hr"></div>
            <!--<p>MySQL 版本：<?php //echo mysql_get_server_info();?></p>
            <div class="hr"></div>-->
            <p>时区设置：<?php $timezone = function_exists("date_default_timezone_get") ? date_default_timezone_get() : '显示错误'; echo $timezone;?></p>
            <div class="hr"></div>
            <p>安全模式：<?php echo (boolean) ini_get('safe_mode') ?  '是' : '否';?></p>
            <div class="hr"></div>
            <p>CURL 支持：<?php echo function_exists("curl_getinfo") ?  '是' : '否';?></p>
            <div class="hr"></div>
            <p>上传附件限制：<?php echo ini_get('upload_max_filesize');?></p>
            <div class="hr"></div>
            <p>执行时间限制：<?php echo ini_get('max_execution_time').'秒';?></p>
            <div class="hr"></div>
            <p>魔术引号开启：<?php $magic = get_magic_quotes_gpc() ? '是' : '否'; echo $magic;?></p>
        </div><!--box-info-bd end-->
    </div><!--box-info end-->
</div><!--box end-->
<style>
a.link{
    text-decoration:underline;}
.news span{
    display:inline-block;
    margin-left:10px;
    color:#999;}
</style>