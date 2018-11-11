<?php

class SelectController extends BaseController {
    protected $model = '';
    public function init() {
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }
    // $partnership_type 单位类型
    // $no_cooperation 单位id，非此单位的联盟单位
public function actionStudentinfo($stsnum=0) {
       $this->show_Student('student_info',$stsnum);
}
  
public function actionStudentchose() {
    $this->show_Student('student_chose',get_stsnum());
 }

  public function actionStudentlate() {
    $this->show_Student('student_late',get_stsnum());
 }

// $partnership_type 单位类型
    // $no_cooperation 单位id，非此单位的联盟单位
    public function actionClub($keywords = '', $partnership_type = 0, $project_id = 0, $no_cooperation = 0,$club_type = '') {
       
        $this->show_club($keywords, $partnership_type, $project_id, $no_cooperation,$club_type,'club');
    }

    public function actionClubmore($keywords = '', $partnership_type = 0, $project_id = 0, $no_cooperation = 0,$club_type = '') {
      
     $this->show_club($keywords, $partnership_type, $project_id, $no_cooperation,$club_type,'clubmore');
    }

    function show_club($keywords, $partnership_type, $project_id, $no_cooperation,$club_type,$pfile ) {
        $data = array();
        $model = ClubList::model();
        $criteria = new CDbCriteria;
        $criteria->condition = 'if_del=510';
        $criteria->select = 'id select_id,club_name select_title,club_code select_code';
        if ($keywords != '') {
            $criteria->condition .= ' AND (club_name like "%' . $keywords . '%" OR club_code like "%' . $keywords . '%")';
        }
    
        parent::_list($model, $criteria, $pfile, $data);
    }
function show_Student($php_file, $stsnum) {
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = GfUser1::model(); 
    $criteria = new CDbCriteria;
    $criteria->condition=get_where('1=1',($stsnum!="0"),'STSNUM',$stsnum,'');
    $criteria->order = 'STSNUM';    $data = array();
    parent::_list($model, $criteria,$php_file,$data);
 }

 public function actionShownews($keywords = '',$styear="0",$stterm="0",$start_date='',$end_date='',$state='') {
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = ClubNews::model();
    $criteria = new CDbCriteria;
    $styear=2018;
    $w1='f_year=2018 and f_term>=1 and now()<=sign_date_start ';//get_where('1=1',($styear!="0"),'scyear',$styear,'"');
    //$w1=get_where($w1,($stterm!="0"),'scterm',$stterm,'"');
    //$w1=get_where($w1,!empty($state),'state',$state,'');
    //$w1=get_where($w1,($start_date!=""),'news_date_start>=',$start_date,'"');
    $criteria->condition=$w1;//get_like($criteria->condition,'news_title,news_code,club_name',$keywords,'');
    put_msg($criteria->condition);
    $criteria->order = 'sign_date_end DESC';
    $data = array();
    $data['terms'] = BaseCode::model()->getTerm();
    $data['years'] = BaseCode::model()->getYear();
    $data['state'] = BaseCode::model()->getCode(370);
    parent::_list($model, $criteria, 'shownews', $data);
    }

   public function actionTeacherset($club_news_id=0) {
         set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = GfUser1::model(); 
    $criteria = new CDbCriteria;
    $criteria->condition=get_where('1=1',($stsnum!="0"),'STSNUM',$stsnum,'"');
    $criteria->order = 'STSNUM';    $data = array();
    parent::_list($model, $criteria,'teacher_set',$data);
    }

   public function actionTeacherscore($club_news_id=0) {
       $this->show_mark_late('teacher_score',$club_news_id,$_POST);
       if(0==1){
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = ClubNewsSignList::model();
    $criteria = new CDbCriteria;
    $club_id=0;
    if (isset($_POST['club_news_id'])){ $club_id=$_POST['club_news_id']; }
    $w1=get_where('f_chose=1',$club_id,'club_news_id',$club_id,'');
    $criteria->condition=get_where($w1,($stterm!="0"),'scterm',$stterm,'"');
    $criteria->order = 'f_level,f_class,scsnum';
    $data = array();
     //$this->parent::_list($model, $criteria, 'teacher_score', $data,5);
     $this->show_mark_late('teacher_score',$club_news_id,$_POST);}
    }

  public function actionTeacherlate($club_news_id=0) {
    $this->show_mark_late('teacher_late',$club_news_id,$_POST);
    }

  function show_mark_late($actname,$club_news_id,$post){
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = ClubNewsSignList::model();
    if(isset($post['club_news_id'])){
        $club_news_id=$post['club_news_id'];
    }
    $_REQUEST['club_news_id']=$club_news_id;
    $criteria = new CDbCriteria;
    $criteria->condition=get_where('f_chose=1',$club_news_id,'club_news_id',$club_news_id,'');
    $criteria->order = 'f_level,f_class,scsnum';
    $data = array();
    parent::_list($model, $criteria, $actname, $data,6);
  }

public function actionStudentshow($keywords = '',$styear="0",$stterm="0",$start_date='',$end_date='',$state='') {
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $model = ClubNews::model();
    $criteria = new CDbCriteria;
    $w1=get_where('1=1',($styear!="0"),'scyear',$styear,'"');
    $w1=get_where($w1,($stterm!="0"),'scterm',$stterm,'"');
    $w1=get_where($w1,!empty($state),'state',$state,'');
    $w1=get_where($w1,($start_date!=""),'news_date_start>=',$start_date,'"');
    $criteria->condition=get_like($criteria->condition,'news_title,news_code,club_name',$keywords,'');
    $criteria->order = 'id ';
    $data = array();
    $data['terms'] = BaseCode::model()->getTerm();
    $data['years'] = BaseCode::model()->getYear();
    $data['state'] = BaseCode::model()->getCode(370);
    parent::_list($model, $criteria, 'Student_show', $data);
    }



//先查询主模型（User）的数据， SELECT user.* FROM user LEFT JOIN item ON item.owner_id=user.id AND category_id=1
// 然后再根据关联条件查询相关模型数据SELECT * FROM item WHERE owner_id IN (...) AND category_id=1
// 这两个在查询的过程中都使用了 on条件。
//$users = User::find()->joinWith('books')->all();

    public function actionServicePerson($club_id, $project_id = 0, $keywords = '',$code_type='') {
        $data = array();
        $model = QualificationsClub::model();
        $criteria = new CDbCriteria;
        $criteria->with = array('qualifications_person');
        $now = date('Y-m-d H:i:s');
        $arrClub = array($club_id);
        $cooperation = CooperationClubList::model()->findAll('club_id=' . $club_id . ' AND (cooperation_state=337 OR cooperation_state=497)');
        foreach ($cooperation as $v) {
            $arrClub[] = $v->invite_club_id;
        }
        $criteria->condition = 't.club_id in (' . implode(',', $arrClub) . ') AND (t.state=337 OR t.state=497) AND qualifications_person.start_date<"' . $now . '" AND qualifications_person.end_date>"' . $now . '" AND qualifications_person.check_state=372 AND (qualifications_person.if_del=510 OR qualifications_person.if_del=0)';
        $criteria->select = '*,t.qualification_person_id as select_id,qualifications_person.qualification_name as select_title';
        if ($keywords != '') {
            $criteria->condition .= ' AND (qualifications_person.qualification_name like "%' . $keywords . '%" OR qualifications_person.qualification_project_name like "%' . $keywords . '%" OR qualifications_person.qualification_type like "%' . $keywords . '%")';
        }

        if ($project_id > 0) {
            $criteria->condition.=' AND t.project_id=' . $project_id;
        }

        parent::_list($model, $criteria, 'servicePerson', $data);
    }


    public function actionGfuser($keywords = '') {
        $data = array();
        $model = GfUser1::model();
        $criteria = new CDbCriteria;
        $criteria->condition = '1=1';
        $criteria->select = 'id as select_id,STNAME as select_title,STSNUM as select_code';
        if ($keywords != '') {
            $criteria->condition .= ' AND (STSNUM like "%' . $keywords . '%" OR STNAME like "%' . $keywords . '%")';
        }
       
        parent::_list($model, $criteria, 'gfuser', $data);
    }

    public function actionClassify($fid = -1, $keywords = '') {
        $data = array();
        $model = MallProductsTypeSname::model();
        $criteria = new CDbCriteria;
        $criteria->condition = '1';
        $criteria->select = 'id as select_id,sn_name as select_title';
        if ($keywords != '') {
            $criteria->condition .= ' AND sn_name like "%' . $keywords . '%"';
        }

        if ($fid > 0) {
            $criteria->condition .= ' AND fater_id=' . $fid;
        }
        parent::_list($model, $criteria, 'classify', $data);
    }


    public function actionMapArea() {
        $this->render('mapArea');
    }

  
    public function actionWatermark($keywords = '') {
        $data = array();
        $model = GfWatermark::model();
        $criteria = new CDbCriteria;
        $criteria->condition = '1';
        $criteria->select = 'id as select_id,w_title as select_title';

        if ($keywords != '') {
            $criteria->condition .= ' AND w_title like "%' . $keywords . '%';
        }

        $criteria->order = 'id DESC';

        parent::_list($model, $criteria, 'watermark', $data);
    }

}
