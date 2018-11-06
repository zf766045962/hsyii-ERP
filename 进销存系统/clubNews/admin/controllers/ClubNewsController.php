<?php

class ClubNewsController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionIndex($keywords = '',$start_date='',$end_date='',$state='',$news_type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
		$criteria->join = "join club_news_project on t.id=club_news_project.club_news_id";
        $criteria->condition=get_where_club_project('club_id','club_news_project.project_id');
		$criteria->condition.=' AND if_del=506';
        $criteria->condition=get_where($criteria->condition,!empty($state),'state',$state,'');
        $criteria->condition=get_where($criteria->condition,!empty($news_type),'news_type',$news_type,'');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_start>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_end<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'news_title,news_code,news_club_name',$keywords,'');//get_where
       $criteria->group='t.id';
      // $criteria->condition.='  group by t.id';
        $criteria->order = 'id DESC';
		//put_msg('gfgf=='.$criteria->condition);
        $data = array();
        $data['state'] = BaseCode::model()->getCode(370);
		$data['news_type'] = BaseCode::model()->getCode(882);
        parent::_list($model, $criteria, 'index', $data);
    }

    public function actionCreate() {
        $modelName = $this->model;
        $model = new $modelName('create');
		$old_pic='';
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            $data['model'] = $model;
            $this->render('update', $data);
        } else {
            $this-> saveData($model,$_POST[$modelName]);
        }
    }


    public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
		$old_pic=$model->news_pic;
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           $basepath = BasePath::model()->getPath(222);
           $model->news_content_temp=get_html($basepath->F_WWWPATH.$model->news_content, $basepath);
           $data['model'] = $model;
          
           $this->render('update', $data);
        } else {
            $this-> saveData($model,$_POST[$modelName]);
         }
    }
  
 function saveData($model,$post) {
       $model->attributes =$post;
       $old_pic=$model->news_pic;
	   if ($_POST['submitType'] == 'shenhe') {
			$model->state = 371;
        } else if ($_POST['submitType'] == 'baocun') {
            $model->state = 721;
        } else if ($_POST['submitType'] == 'tongguo') {
            $model->state = 372;
        } else if ($_POST['submitType'] == 'butongguo') {
            $model->state = 373;
        } else {
            $model->state = 721;
        }
       $sv=$model->save();  
       $this->save_pics($model->id,$post['club_news_pic']);
       $this->save_projects($model->id,$post['project_id']);
       $this->save_club_list($model->id,$post['club_list']);
	     $this->save_gfmaterial($old_pic,$model->news_pic,$model->news_title);
	     $logopath=BasePath::model()->getPath(124);
       show_status($sv,'保存成功', get_cookie('_currentUrl_'),'保存失败');  
 }
 
  //保存到素材管理	
public function save_gfmaterial($oldpic,$pic,$title){  
	$logopath=BasePath::model()->getPath(124);
    $gfpic=GfMaterial::model()->findAll('club_id='.get_session('club_id').' AND v_type=252 AND v_pic="'.$pic.'"');
    $gfmaterial=new GfMaterial();
	if($oldpic!=$pic){
		if(empty($gfpic)){
			$gfmaterial->isNewRecord = true;
			unset($gfmaterial->id);
			$gfmaterial->gf_type=501;
			$gfmaterial->gfid=get_session('admin_id');
			$gfmaterial->club_id=get_session('club_id');
			$gfmaterial->v_type=252;
			$gfmaterial->v_title=$title;
			$gfmaterial->v_pic=$pic;
			$gfmaterial->v_file_path=$logopath->F_WWWPATH;
			$gfmaterial->save();
		}
	}     

  }
 
     //逻辑删除
  public function actionDelete($id) {
        $modelName = $this->model;
        $model = $modelName::model();
        $count = $model->updateByPk($id,array('if_del'=>507));
        if ($count > 0) {
            ajax_status(1, '删除成功');
        } else {
            ajax_status(0, '删除失败');
        }
    }
  
     //////////////////////////////// 保存子图集//////////////////// 
  public  function save_pics($id,$pic){
	$club_news_pic=ClubNewsPic::model()->findAll('club_news_id='.$id);
	$arr=array();
	if (isset($_POST['club_news_pic'])) {
        $newspic = new ClubNewsPic();
        foreach ($_POST['club_news_pic'] as $v) {
            if ($v['pic'] == '') {
               continue;
             }		
			 if ($v['id'] =='null') {
				 //if($v['intro']
				 $newspic->isNewRecord = true;
                 unset($newspic->id);
                 $newspic->club_news_id =$id;
			     $newspic->news_pic =$v['pic'];
                 $newspic->introduce = $v['intro'];
                 $newspic->save();
			 } else {
				 $newspic->updateByPk($v['id'],array('introduce' => $v['intro']));
				 $arr[]=$v['id'];
			 }
            
         }
     }
	 if(isset($club_news_pic)) {
		 foreach ($club_news_pic as $k) {
			 if(!in_array($k->id,$arr)) {
				 ClubNewsPic::model()->deleteAll('id='.$k->id);
			 }
		 }
	 }
	 
  }

  public  function save_projects($club_news_id,$project_ids){       
    //删除原有项目
    ClubNewsProject::model()->deleteAll('club_news_id='.$club_news_id);
    if(!empty($project_ids)){
        $model2 = new ClubNewsProject();
        $club_list_pic = array();
        $club_list_pic = explode(',', $project_ids);
        $club_list_pic = array_unique($club_list_pic);
        foreach ($club_list_pic as $v) {
            $model2->isNewRecord = true;
            unset($model2->id);
            $model2->club_news_id = $club_news_id;
            $model2->project_id = $v;
            $model2->save();
        }
    }
  }

  public  function save_club_list($news_id,$club_list){       
    //删除原有项目
    ClubNewsRecommend::model()->deleteAll('news_id='.$news_id);
    if(!empty($club_list)){
        $model2 = new ClubNewsRecommend();
        $club_list_pic = array();
        $club_list_pic = explode(',', $club_list);
        $club_list_pic = array_unique($club_list_pic);
        foreach ($club_list_pic as $v) {
            $model2->isNewRecord = true;
            unset($model2->id);
            $model2->news_id = $news_id;
            $model2->recommend_clubid = $v;
            $model2->save();
        }
    }
  }

   

}
