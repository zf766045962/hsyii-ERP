<?php

class BaseModel extends CActiveRecord {

    public $select_id='';
    public $select_code='';
    public $select_title='';
    public $select_item1='';
    public $select_item2='';
    public $select_item3='';
    
    protected function afterSave() {
        parent::afterSave();
    }
    
    protected function afterDelete() {
        parent::afterDelete();
    }

}
