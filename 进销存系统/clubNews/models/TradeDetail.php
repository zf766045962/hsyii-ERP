<?php

class TradeDetail extends BaseModel {
    public function tableName() {
        return '{{trade_detail}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            //array('id', 'required', 'message' => '{attribute} 不能为空'),
            array('material_code', 'required', 'message' => '{attribute} 不能为空'),
			array('material_name', 'required', 'message' => '{attribute} 不能为空'),
            array('material_quantity', 'required', 'message' => '{attribute} 不能为空'),
			array('unit', 'required', 'message' => '{attribute} 不能为空'),
            array('unitprice', 'required', 'message' => '{attribute} 不能为空'),
		    array('total', 'required', 'message' => '{attribute} 不能为空'),
            array('warehouse_id', 'required', 'message' => '{attribute} 不能为空'),
			array('id,material_code,material_name,unitprice,material_quantity,total,unit,warehouse_id,order_num','safe'), 
			//array($s1,'safe'),
		);
    }

    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
            // 'trade_order' => array(self::BELONGS_TO, 'TradeOrder', 'order_num'),
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
        	'id' => 'ID',
            'material_code' => '产品编码',
        	'material_name' => '产品名称',
            'material_quantity' => '数量',
        	'unit' => '单位',
        	'unitprice' => '单价',
        	'total' => '总金额',
            'warehouse_id' => '仓库',
            'remarks' => '备注',
            'order_num' => '订单编号',
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

}
