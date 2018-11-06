<?php
 
class IndexController extends BaseController {

    public $layout = false;

    public function actionIndex() {
        $s1='index';
       
          $this->render('index');
    }

    public function actionLogin(){
       $this->login_form();
    }

  public function actionLogout(){
       $this->login_form();
    }

    function login_form(){
        Yii::app()->session['admin_id']=null;
        $model = new Teacher('create');
        $data = array();
        $data['model'] = $model;
        $s1='login';
        $this->render($s1,$data);  
    }

    public function actionCheckuser() {
      $usercode="0";//
      $mobile='0';//mobile=0表示教师或社工后台，1表示前台教师，2表示前台学生，用于控制样式使用
      if (isset($_REQUEST['TUNAME'])) { $usercode=$_REQUEST['TUNAME'];}
      if (isset($_REQUEST['mobile'])) { $mobile=(strlen($usercode)<8) ?'2' : "2";}
      $data = array();
      $data['TUNAME']="";
      $data['TCOD']='';
      $data['ROLE']='';
      set_session('gfaccount','hkyg');
      set_session('mobile',$mobile);
     // set_session('STSNUM','');
      $_SESSION['STSNUM']="";
      Yii::app()->session['admin_id']=null;
      Yii::app()->session['admin']=0;
      if (strlen($usercode)<8){
        $model= Teacher::model()->find("(TCOD='". $usercode."' or TUNAME='". $usercode."')");
        if(isset($model->TCOD))
         if($model->TPWD==$_REQUEST['PASSWORD']){
             $data['TCOD']=$model->TCOD;
             $data['TUNAME']=$model->TCNAME;
             $s1=$model->F_ROLECODE;
             Yii::app()->session['club_id']=$model->CLUB_ID;
             Yii::app()->session['club_name']=$model->CLUB_NAME;
             Yii::app()->session['role']=$s1;
             if ((indexof($s1,'A')>=0)|| (indexof($s1,'B')>=0)||(indexof($s1,'E')>=0))
              Yii::app()->session['admin']=1;
            }
        }
        else {

             $model= Sclass::model()->find("STSNUM='".$usercode."'");
    
             if (empty($model->STSNUM)){
         
               $this->copy_Data($usercode);
             }
              $model=GfUser1::model()->find("STSNUM='".$usercode."'");
             
             if(isset($model->STSNUM))
             if($model->f_stpass==$_REQUEST['PASSWORD']){
                 $data['TCOD']=$usercode;
                 $data['TUNAME']=$model->STNAME;
                }
        }
      if($data['TCOD']!=''){
       Yii::app()->session['TUNAME']=$data['TUNAME'];
       $this->set_init($usercode);
      }

      echo CJSON::encode($data);
    }

function copy_Data($st) {
      $model0=Sclassmac::model()->find('STSNUM='.$st .' and scyear='.get_year());
      $model1=Sclass::model()->find('STSNUM='.$st .' and scyear='.get_year());
      if (empty($model1->STSNUM)){
            $model1 = new Sclass();
            $model1->isNewRecord = true;
        }
         $model1->STSNUM=$model0->STSNUM;
         $model1->SCYEAR=$model0->SCYEAR;
         $model1->SCTERM=$model0->SCTERM;
         $model1->SCLEV=$model0->SCLEV;
         $model1->SCCLASS=$model0->SCCLASS;
         $model1->SCSNUM=$model0->SCSNUM;
         $model1->STNAME=$model0->STNAME;
         $model1->f_stpass ='123456';
         $model1->save();  
     }

    function set_init($usercode){
      $y=  Semester::model()->getYear();
      $t=  Semester::model()->getTerm();
      $sc=$_REQUEST['SCHOOL'];
  //       put_msg('line=76');
      // if ($sc=='濠江英才學校') $db_name="mac_memscore";
// if ($sc=='濠江小學') $db_name="mac_hkxxscore";
// if ($sc=='濠江幼稚园') $db_name="mac_hkyescore";
      $sl="小一";
      $sl=($sc='濠江中學') ? "高一" : (($sc='濠江幼稚园') ? "幼高" : $sl);
      Yii::app()->session['admin_id']=$usercode;
      Yii::app()->session['STSNUM']=$usercode;
     
      Yii::app()->session['school']=$_REQUEST['SCHOOL'];
      Yii::app()->session['password']=$_REQUEST['PASSWORD']; 
      Yii::app()->session['year']=$y;
      Yii::app()->session['term']=$t;
      Yii::app()->session['level']=$sl;
      Yii::app()->session['class']=1;

      Yii::app()->session['class_teacher']='';
      if(strlen($usercode)>=8){
        $m1=Sclass::model()->find("STSNUM=".$usercode." AND scyear=2018 and scterm=1");
        if(!empty($m1)){
        Yii::app()->session['level']=$m1->SCLEV;
        Yii::app()->session['class']=$m1->SCCLASS;
       }
      }
     else{
       $this->teacher_init($usercode);
     }
    }

   function teacher_init($usercode){
      $y=0;$t=0;
    //      put_msg('line=108');
      $sql='SELECT F_LEVEL,F_CLASS FROM (';
     // $sql.="select F_CLASS,F_LEVEL from class_course  where ";
     // $sql.=get_school_where("f_tcod='".$usercode."'","F_school",'',"",'F_YEAR','f_term');
      $sql.="  select F_CLASS,F_LEVEL from class  where ";
      $sql.=get_school_where("(CCMAS='".$usercode."' or cwmas='".$usercode."')","school",'',"",'f_YEAR','f_term');
      $sql.=" ) TMP GROUP BY F_LEVEL,F_CLASS";
      $sql="select concat(F_LEVEL,'(',F_CLASS,')') F_CLASS FROM (" . $sql . ') BB';
     // put_msg($sql);
      $m1=sql_findALL($sql);
     // put_msg($m1,2);
      Yii::app()->session['class_teacher']=$m1;
    }

function get_menu(){

}

  public function actionTest() {
        $a=<<<EF
}
}
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"/>
<style>
*{
    margin:0;
    padding:0;
    -webkit-tap-highlight-color:rgba(0,0,0,0);}
img{
	max-width:100%;}
body{
	line-height:1.8;
	font-size:20px;
	color:#000;
	-webkit-text-size-adjust:none;
	-o-text-size-adjust:none;
	text-size-adjust:none;
	background:#fff;}
.qmdd-wrapper{}
</style>
<script type="text/javascript">
    window.onload = function() {
        var h  = document.body.scrollHeight;
        parent.postMessage(h, "http://gf41.cn:8090/");
    }
</script>
</head>
<body>
<div class="qmdd-wrapper">
<!--详情开始--->
EF;
        echo $a;
    }

}
