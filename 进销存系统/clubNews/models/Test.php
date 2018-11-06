<?php

class Test extends BaseModel {
    public $selectval=array(2);
    public function tableName() {
        return '{{test_err}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
        return array(
            array('f_msg', 'required', 'message' => '{attribute} 不能为空'),
            array('f_msg','safe'), 
        );
    }

    /**
     * 模型关联规则
     */
    public function relations() {
        return array();
    }
    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
            'f_id' => 'ID',
            'f_rcode' => '编码',
            'f_rname' => '名称',
            'f_type' => '类别',
            'f_child' => '子角色',
            'f_default' => '权限',
        );
    }




    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

   public static function put_msg($pmsg) {
        $this->isNewRecord = true;
        $this->f_msg=$pmsg;
        $this->save();
    }


    protected function beforeSave() {
        parent::beforeSave();
      
        return true;
    }

}
