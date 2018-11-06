<?php

class BaseController extends CController {

    public $layout = '//layouts/main';

    //public $menu = array();
    //public $breadcrumbs = array();
    public function init() {
        //$this->checkLogin();
        parent::init();
        // 模拟个人登录信息
        
        $session = array(
            'captcha_word' => 'MzBkZjQzNDAzYQ==',
            'gfnick' => '',
            'gfid' => '0',
            'gfaccount' => '0000',
            'level' => 1,
            'club_id' => '1',
            'name' => '',
            'gf_id' => '0',
            'userAdmin' => '平台管理员',
            'supplier' => 0,
            'club_name' => '一家平台管理员',
            'supplier_id' => 0,
            'datagrid_style_color' => 'gray',
            'admin_name' => '',
            'action_list' => null,
            'last_check' => '0000-00-00 00:00:00',
            'lang_type' => '1',
            'suppliers_id' => null,
            'admin_level' => 0,
            'shop_guide' => false,
            'user_id' => '0',
            'admin_id' => null,
            'user_name' => '0',
            'user_rank' => '0',
            'discount' => '0.00',
            'email' => '0',);
       if (!isset(Yii::app()->session['admin_id'])) {
            foreach ($session as $k => $v) {
                if (!isset(Yii::app()->session[$k])){
                Yii::app()->session[$k] = $v;}
            }
        }
        if(isset($_session)){
             foreach ($_session as $k => $v) {
                if (!isset(Yii::app()->session[$k])){
                Yii::app()->session[$k] = $v;}
            }
          }
           
        
    }

    // 基础列表方法
    protected function _list($model = null, $criteria = null, $template = 'index', $data = array(), $pageSize = 15) {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }
        $count = $model->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $pageSize;
        $pages->applylimit($criteria);
        $arclist = $model->findAll($criteria);
        $data = array_merge($data, array('model' => $model, 'arclist' => $arclist, 'pages' => $pages, 'count'=>$count));  
        $this->render($template, $data);
    }

    // 基础创建方法
    protected function _create($model = null, $tpl = 'create', $data = array(), $redirect = '') {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }

        $modelName = $this->model;

        if (Yii::app()->request->isPostRequest && isset($_POST[$modelName])) {
            $model->attributes = $_POST[$modelName];
            if ($model->save()) {
                ajax_status(1, '添加成功', $redirect);
            } else {
                 $msg = '';
                foreach ($model->getErrors() as $v) {
                    foreach ($v as $v2) {
                        $msg .= '<p>' . $v2 . '</p>';
                    }
                }
                ajax_status(0, $msg);
            }
        } else {
            $data = array_merge($data, array('model' => $model));
            $this->render($tpl, $data);
        }
    }

    // 基础更新方法
    protected function _update($model = null, $tpl = 'update', $data = array(), $redirect = '') {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }

        $modelName = get_class($model);

        if (Yii::app()->request->isPostRequest && isset($_POST[$modelName])) {
            $model->attributes = $_POST[$modelName];
            if ($model->save()) {
                ajax_status(1, '更新成功', $redirect);
            } else {
                 $msg = '';
                foreach ($model->getErrors() as $v) {
                    foreach ($v as $v2) {
                        $msg .= '<p>' . $v2 . '</p>';
                    }
                }
                ajax_status(0, $msg);
            }
        } else {
            $data = array_merge($data, array('model' => $model));
            $this->render($tpl, $data);
        }
    }

    // 单字段基础更新方法
    protected function _setField($id, $model = null, $k = '', $v = '') {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }
        $model->$k = $v;
        $rs = $model->save();
        if ($rs !== false) {
            ajax_status(1, '更新成功');
        } else {
            ajax_status(0, '更新失败');
        }
    }

    // 基础更改状态方法
    protected function _status($id, $status = 0) {
        if (!in_array($status, array(0, 1))) {
            ajax_status(0, '非法数据');
        }
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (in_array(Yii::app()->controller->id, array('article', 'singlepage'))) {
            $this->checkColumnAccess($model->column_id);
        }
        $this->_setField($id, $model, 'status', $status);
    }

    // 基础更改状态方法
    protected function _recommend($id, $status = 0) {
        if (!in_array($status, array(0, 1))) {
            ajax_status(0, '非法数据');
        }
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);

        if (in_array(Yii::app()->controller->id, array('article', 'singlepage'))) {
            $this->checkColumnAccess($model->column_id);
        }

        $this->_setField($id, $model, 'recommend', $status);
    }

    // 基础更改排序方法
    protected function _sortid($id, $sortid = 0) {
        $sortid = intval($sortid);
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);

        if (in_array(Yii::app()->controller->id, array('article', 'singlepage'))) {
            $this->checkColumnAccess($model->column_id);
        }

        $this->_setField($id, $model, 'sortid', $sortid);
    }

    // 基础伪删除方法
    protected function _delete($id, $del = 509, $redirect = '') {
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;

        $criteria->condition = 'id in(' . $id . ')';

        $count = $model->updateAll(array('if_del' => $del), $criteria);
        if ($count > 0) {
            ajax_status(1, '删除成功', $redirect);
        } else {
            ajax_status(0, '删除失败');
        }
    }

    // 基础删除方法
    protected function _clear($id, $redirect = '',$keyname='id') {
        $modelName = $this->model;
        $model = $modelName::model();
        $count = $model->deleteAll($keyname.' in (' . $id . ')');
        if ($count > 0) {
            ajax_status(1, '删除成功', $redirect);
        } else {
            ajax_status(0, '删除失败');
        }
    }
    

    //主从基础创建方法
    protected function _creates($model = null, $tpl = 'create', $data = array(), $redirect = '', $archiveName = 'Archive') {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }

        $archive = new $archiveName('create');

        if (Yii::app()->request->isPostRequest && isset($_POST[$archiveName])) {
            $archive->attributes = $_POST[$archiveName];
            if (!$archive->save()) {
                ajax_status(0, '添加失败1');
            }
            $modelName = get_class($model);
            $model->attributes = $_POST[$modelName];
            $model->archive_id = $archive->id;
            $model->sub_column_id = $archive->sub_column_id;
            if ($model->save()) {
                ajax_status(1, '添加成功', $redirect);
            } else {
                $archive->delete();
                ajax_status(0, '添加失败');
            }
        } else {
            $archive->status = 1;
            $data = array_merge($data, array('archive' => $archive), array('model' => $model));
            $this->render($tpl, $data);
        }
    }

    // 主从基础更新方法
    protected function _updates($model = null, $tpl = 'update', $data = array(), $redirect = '', $archiveName = 'Archive') {
        if ($model === null) {
            ajax_status(0, '没有数据或数据已禁用');
        }

        $archive = $archiveName::model()->findByPk($model->archive_id);
        //dump($archive);exit;
        if (Yii::app()->request->isPostRequest && isset($_POST[$archiveName])) {
            $archive->attributes = $_POST[$archiveName];
            if (!$archive->save()) {
                ajax_status(0, '更新失败');
            }
            $modelName = get_class($model);
            $model->attributes = $_POST[$modelName];
            $model->archive_id = $archive->id;
            $model->sub_column_id = $archive->sub_column_id;
            if ($model->save()) {
                ajax_status(1, '更新成功', $redirect);
            } else {
                ajax_status(0, '更新失败');
            }
        } else {
            $data = array_merge($data, array('model' => $model, 'archive' => $archive,));
            $this->render($tpl, $data);
        }
    }

    // 加载模型
    protected function loadModel($id, $modelName, $criteria = null) {
        if ($criteria === null) {
            $model = $modelName::model()->findByPk($id);
        } else {
            $model = $modelName::model()->find($criteria);
        }
        return $model;
    }

    // 分页控件
    public function page($pages) {
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'cssFile' => false,
            'header' => '',
            'footer' => '<div class="info">共' . $pages->getItemCount() . '条内容，当前第' . ($pages->currentPage + 1) . '/' . $pages->pageCount . '页</div>',
            'maxButtonCount' => 5,
            'firstPageLabel' => '首页',
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'lastPageLabel' => '末页'
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'active-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
