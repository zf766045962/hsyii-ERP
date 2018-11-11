<?php
 session_start();
 isset($PHPSESSID)?session_id($PHPSESSID):$PHPSESSID = session_id();  
// 如果設置了$PHPSESSID，就將SessionID賦值為$PHPSESSID，否則生成SessionID  
 setcookie('PHPSESSID', $PHPSESSID, time()+3156000); // 儲存SessionID到Cookie中 
 $_SESSION['usercode']=""; 
 $_SESSION['login_type']='0000'; 
?>
<script> // html5中默認的script是javascript,故不需要特別指定script language \
var tcod="<?php echo $_SESSION['usercode']?>";
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>濠江中學社會實踐系統</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width,height=device-height">
<link rel="stylesheet" type="text/css" href="css/ionic.css"> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>

 <!-- <link rel="stylesheet" type="text/css" href="ionic.min.css">  -->
  
</head>
<body>
 <form id="login_form">
  
<div class="scroll-content padding" id="index_login">
      <div class="list list-borderless">
        <div class="item item-thumbnail-left item-positive">
        <img src="img/3.png" style="margin:0;width:100%;height:100%;border-radius:50px;overflow:hidden;">
        <h1 class="light">濠江中學社會實踐系統</h1>
      </div>

      </div>
      <div class="list list-inset">
        <label class="item item-input">
        <i class="icon ion-android-person positive"></i>
        <input type="text" name='userName' id='userName' placeholder="用戶名">
        </label>
        <label class="item item-input">
        <i class="icon ion-ios-unlocked-outline positive"></i>
        <input type="password" name='password' id='password' placeholder="密碼">
        </label>
        <label class="item item-checkbox">
        <label class="checkbox">
          <input type="checkbox" checked>
        </label>
    
      </label>
        
      </div>
     <input class="button button-block button-positive"  name="" type="button" class="loginbtn" value="登錄"  onclick="login();"  /> 
    
</div>

</form>
</body>
</html>
<script>

  function login() {
     $("#login_res").html('<img src="images/loading.gif" width="24" height="24" />');
      if ($("#userName").val().replace(/[ ]/g, "") == "" || $("#userName").val().replace(/[ ]/g, "") == "請輸入帳號") {
          // $("#login_res").html("帳號不能為空");
           return;
      }

      if ($("#password").val().replace(/[ ]/g, "") == "") {$("#login_res").html("密碼不能為空");return;}

      var post_data = $("#login_form").serialize();
      var s1=$("#userName").val();
      var u1='slogin';
           if (s1.length<8)
           { u1='tlogin';}
      $.ajax({
            url: "data_interfaces.php?action="+u1,
            type: 'post',
            data: post_data,
            async: true,
            dataType: 'json',
            success: function (data) {
        if (data.error == 0) {
          
           var s2='../hkyg/index.php?r=select/studentinfo&stsnum='+s1;
           if (s1.length<8)
           { s2='../hkyg/index.php?r=select/teacherlate&stsnum='+s1;}
           window.location.href =s2;
        } else {
            malert("密碼有錯");
          //  $("#login_res").html("密碼有錯");
        }
            },
             error: function(XMLHttpRequest, textStatus, errorThrown) {
             malert("Connection  error");
             console.log(XMLHttpRequest.status);  console.log(XMLHttpRequest);
                    },
   complete: function(XMLHttpRequest, textStatus) {
// this; // 調用本次AJAX請求時傳遞的options慘數
 console.log(XMLHttpRequest);
      $("#login_res").html(data.msg);
   }


        });
    }

  function  malert(str)   
  {   
  execScript('MsgBox   "'+str+'",0,"新标题"','VBScript');   
  } 
</script>

