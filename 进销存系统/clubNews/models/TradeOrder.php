<?php

class TradeOrder extends BaseModel {
	public $club_list_pic='';
    public function tableName() {
        return '{{trade_order}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('order_title', 'required', 'message' => '{attribute}不能为空'),
            //array('order_num', 'required', 'message' => '{attribute} 不能为空'),
            array('order_time', 'required', 'message' => '{attribute} 不能为空'),
			array('customer_name', 'required', 'message' => '{attribute} 不能为空'),
            array('receiver', 'required', 'message' => '{attribute} 不能为空'),
			array('auditor', 'required', 'message' => '{attribute} 不能为空'),
            //array('email', 'required', 'message' => '{attribute} 不能为空'),
		    //array('contact_id_card_back', 'required', 'message' => '{attribute} 不能为空'),
			//array('club_address', 'required', 'message' => '{attribute} 不能为空'),
			array('id,order_title,order_num,order_time,customer_name,receiver,auditor,remarks','safe',), 
			//array($s1,'safe'),
		);
    }

    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
            'club_list' => array(self::HAS_MANY, 'TradeDetail', 'order_num'), 
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_title' => '订单标题',
        	'order_num' => '订单编号',
        	'order_time' => '订单日期',
        	'customer_name' => '客户/供应商',
        	'receiver' => '收货人',
        	'auditor' => '审核人',
            'remarks' => '备注',
     );
    }

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	
	

    public function getCode() {
        return $this->findAll('1=1');
    }

    public function beforeSave(){
        parent::beforeSave();
        //执行save()方法前才对order_num赋值
        //期望效果：创建订单时自动生成对应order_num
        if(empty($this->order_num))
        {
            $order_sn = date('ymd').substr(microtime(),2,4);
            $this->order_num = $order_sn;            
        }
        return true;
    }
}
