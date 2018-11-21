<?php

class SupplierList extends BaseModel {
	public function tableName() {
		return '{{supplier_list}}';
	}

	public function rules() {
		return array(
			//array('s_name', 'required', 'message' => '{attribute} 不能为空'),
			array('s_id,s_name,s_type','safe'),
		);
	}

	public function relations() {
		return array(

		);
	}

	public function attributeLabels() {
		return array(
			's_id' => 'ID',
			's_name' => '姓名',
			's_type' => '类型',
		);
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCode() {
        return $this->findAll('1=1');
    }

}