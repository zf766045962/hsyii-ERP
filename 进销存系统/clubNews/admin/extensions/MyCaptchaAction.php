<?php
class MyCaptchaAction extends CCaptchaAction {
   const SESSION_VAR_PREFIX='Ext.MyCaptchaAction.';
   public $minLength=4; //默认四位
   public $maxLength=4; //默认四位
 
   protected function generateVerifyCode()
   {
       if($this->minLength<3)
           $this->minLength=3;
       if($this->maxLength>20)
           $this->maxLength=20;
       if($this->minLength>$this->maxLength)
           $this->maxLength=$this->minLength;
       $length=rand($this->minLength,$this->maxLength);
 
       $letters='1234567890';//此处可以去掉数字1和0避免和字母L和O混淆
       $code='';
       for($i=0;$i<$length;++$i)
       {
           $code.=$letters[rand(0,9)];
       }
 
       return $code;
   }
}