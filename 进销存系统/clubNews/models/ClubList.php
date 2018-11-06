<?php

class ClubList extends BaseModel {
	public $club_list_pic='';
    public function tableName() {
        return '{{club_list}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('club_code', 'required', 'message' => '{attribute} 不能为空'),
            array('club_name', 'required', 'message' => '{attribute} 不能为空'),
			//array('apply_time', 'required', 'message' => '{attribute} 不能为空'),
            array('apply_name', 'required', 'message' => '{attribute} 不能为空'),
			array('contact_phone', 'required', 'message' => '{attribute} 不能为空'),
            array('email', 'required', 'message' => '{attribute} 不能为空'),
		    //array('contact_id_card_back', 'required', 'message' => '{attribute} 不能为空'),
			//array('club_address', 'required', 'message' => '{attribute} 不能为空'),
			array('club_code,club_name,management_category,company,apply_club_gfnick,financial_code,club_logo_pic,apply_club_gfid,club_type,partnership_type,individual_enterprise,apply_club_id_card,apply_club_phone,apply_club_email,legal_person_id_card_face,organization_code,certificates_number,valid_until,management_category,contact_phone,email,apply_id_card,contact_id_card_back,certificates,recommend,bank_name,bank_account,club_area_country,club_area_province,club_area_district,club_area_city,club_area_street,club_address,latitude,Longitude,service_hotline,apply_time,isRecommend,state,dispay_xh,club_list_pic','safe',), 
			//array($s1,'safe'),
		);
    }

    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
		 
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
             'no' => '序号',
			 'club_code' => '社区',
			 'financial_code' => '财务编码',
			 'club_name' => '名称',
			 'club_logo_pic' => '缩略图',
			 'company' => '公司名称',
			 'apply_club_gfnick' => '法人',
			 'apply_club_id_card' => '法人身份证号',
			 'apply_club_phone' => '法人电话',
			 'apply_club_email' => '法人邮箱',
			 'apply_name' => '联系人',
			 'contact_phone' => '联系人电话',
			 'email' => '联系人邮箱',
			 'apply_id_card' => '联系人身份证',
			 'club_area_country' => '国家',
			 'club_area_province' => '省',
			 'club_area_district' => '区域区县',
			 'club_area_city' => '社区单位：市',
			 'club_area_street' => '所在区域街道',
			 'club_address' => '详细地址',
			 'latitude' => '纬度',
			 'Longitude' => '经度',
			 'service_hotline' => '客服服务热线',
			 'apply_time' => '创办时间',
			 'uDate' => '更新时间',
			 'about_me'=> '关于我们',
			 'state' => '状态',
			 'state_name' => '状态名称',
			 'if_del' => '删除',
			 'news_clicked' => '点击率',
			 'book_club_num' => '订阅数',
			 'dispay_xh' => '显示序号',
			 'reasons_for_failure'=>'操作备注',
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
