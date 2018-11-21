<?php

class SelectController extends BaseController {
    protected $model = '';
    public function init() {
        parent::init();
    }

    public function actionSupplier($keywords = '', $partnership_type = 0, $project_id = 0, 
        $no_cooperation = 0, $s_type = 's_type=100') {

        //最后一个参数选择渲染页面  
        $this->show_info($keywords, $partnership_type, $project_id, $no_cooperation, $s_type, 'supplier');
    }

    public function actionCustomer($keywords = '', $partnership_type = 0, $project_id = 0, 
        $no_cooperation = 0, $s_type = 's_type=101') {

        $this->show_info($keywords, $partnership_type, $project_id, $no_cooperation, $s_type, 'supplier');
    }


    function show_info($keywords, $partnership_type, $project_id, $no_cooperation, $s_type, $pfile) {
        $data = array();
        $model = SupplierList::model();
        $criteria = new CDbCriteria;

        $criteria->condition = $s_type;
        $criteria->select = 's_id select_id,s_name select_title,s_type select_code';

        if($keywords != '') {
            $criteria->condition .= ' AND (s_name like "%' . $keywords . '%")';
        }

        parent::_list($model, $criteria, $pfile, $data);
    }
}