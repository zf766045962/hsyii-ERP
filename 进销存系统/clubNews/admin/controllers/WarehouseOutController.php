<?php
 
class WarehouseOutController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionDelete($id) {
        parent::_clear($id);
    }
    

    public function actionCreate() {   
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            //$sn = $this->getOrderId();
            $sn = date('ymd').substr(microtime(),2,4);
            $model->order_num = $sn;
            $data['model'] = $model;
            $this->render('update', $data);
        }else{
            $this-> saveData($model,$_POST[$modelName]);
        }
    }

    public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           //$model->order_num = date('ymd').substr(microtime(),2,4);
           $data['model'] = $model;
           $this->render('update', $data);
        } else {
           $this-> saveData($model,$_POST[$modelName]);
        }
    }/*曾老师保留部份，---结束*/
  
    function saveData($model,$post) {
       $model->attributes =$post;
       show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
    }


    function getOrderID(){
        static $ORDERSN=array();                                        //静态变量
        $ors=date('ymd').substr(time(),-5).substr(microtime(),2,5);     //生成16位数字基本号
        if (isset($ORDERSN[$ors])) {                                    //判断是否有基本订单号
            $ORDERSN[$ors]++;                                           //如果存在,将值自增1
        }else{
            $ORDERSN[$ors]=1;
        }
        return $ors.str_pad($ORDERSN[$ors],2,'0',STR_PAD_LEFT);     //链接字符串
    }

    ///列表搜索
     public function actionIndex( $keywords = '') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->order = 'id';
        $criteria->condition = 'order_type=1';
        $data = array();
        //$data['remarks'] = TradeDetail::model();

        if ($keywords != '') {
            $criteria->condition .= ' AND(order_title like "%' . $keywords . '%" OR order_num like "%' . $keywords . '%")';
        }

        parent::_list($model, $criteria, 'index', $data);
    }

}
