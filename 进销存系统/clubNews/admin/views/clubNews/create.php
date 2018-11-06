<?php
if (!isset( $_REQUEST['news_type'] ) ) {
      $_REQUEST['news_type']= $model->news_type;
    } 
?>
<div class="box">
    <div class="box-title c">
    <h1><i class="fa fa-table"></i>详细详情</h1><span class="back">
    <a class="btn" href="javascript:;" onclick="we.back();">
    <i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
     <?php  $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
             <input type="hidden" name="news_type" value="<?php echo $_REQUEST['news_type'];?>">
                <table class="mt15">
                    <tr>
                        <td width="15%"><?php echo $form->labelEx($model, 'news_code'); ?></td>
                        <td width="35%"><?php echo $model->news_code;?></td>
                        <td width="15%"><?php echo $form->labelEx($model, 'news_title'); ?></td>
                        <td width="35%">
                            <?php echo $form->textField($model, 'news_title', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'news_title', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                   		<td ><?php echo $form->labelEx($model, 'news_type'); ?></td>
                        <td >
                            <?php echo $form->dropDownList($model, 'news_type', Chtml::listData(BaseCode::model()->getCode(882), 'f_id', 'F_NAME'), array('prompt'=>'请选择')); ?>
                            <?php echo $form->error($model, 'news_type', $htmlOptions = array()); ?>
                        </td>
                        <td style="padding:10px;"><?php echo $form->labelEx($model, 'club_id'); ?></td>
                        <td>
                            <span id="club_box"><span class="label-box"><?php echo get_session('club_name');?><?php echo $form->hiddenField($model, 'club_id', array('class' => 'input-text','value'=>get_session('club_id'))); ?></span></span>
                            <?php echo $form->error($model, 'club_id', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'news_date_start'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'news_date_start', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'news_date_start', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'news_date_end'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'news_date_end', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'news_date_end', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'news_introduction'); ?></td>
                        <td>
                          <?php echo $form->textArea($model,'news_introduction', array('class' => 'input-text')); ?>
                          <?php echo $form->error($model, 'news_introduction', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'project_id'); 
                        //$project_list = ClubNewsProject::model()->findAll('club_news_id='.$model->id);
                        ?></td>
                        <td>
                            <?php echo $form->hiddenField($model, 'project_id', array('class' => 'input-text')); ?>
                            <span id="project_box">
                            <?php 
                            if(!empty($project_id)){
                            foreach($project_id as $v){?>
                                <span class="label-box" id="project_item_<?php echo $v->id;?>" data-id="<?php echo $v->id;?>"><?php echo $v->project_name;?>
                                <i onclick="fnDeleteProject(this);"></i>
                                </span>
                            <?php }?>
                            <?php }?>
                            </span>
                            <input id="project_add_btn" class="btn" type="button" value="添加项目">
                            <?php echo $form->error($model, 'project_id', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr style="dispay:black;"><!--news_type=225时显示-->
                        <td><?php echo $form->labelEx($model, 'news_content'); ?></td>
                        <td colspan="3">
                            <?php echo $form->hiddenField($model, 'news_content_temp', array('class' => 'input-text')); ?>
                            <script>we.editor('<?php echo get_class($model);?>_news_content_temp', '<?php echo get_class($model);?>[news_content_temp]');</script>
                            <?php echo $form->error($model, 'news_content_temp', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                    	<td>可执行操作</td>
                    	<td colspan="3">
                    	  <button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button>
                          <button onclick="submitType='shenhe'" class="btn btn-blue" type="submit">提交审核</button>
                          <button class="btn" type="button" onclick="we.back();">取消</button>
                        </td>
                    </tr>

                </table>
            </div><!--box-detail-tab-item end-->
        </div><!--box-detail-bd end-->

    <?php $this->endWidget();?>
  </div><!--box-detail end-->
</div><!--box end-->
<script>
we.tab('.box-detail-tab li','.box-detail-tab-item');
var club_id=0;
$('#ClubNews_news_date_start').on('click', function(){
WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});});
$('#ClubNews_news_date_end').on('click', function(){
WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});});
var project_id=0;
// 删除项目
var $project_box=$('#project_box');
var $ClubNews_project_id=$('#ClubNews_project_id');
var fnUpdateProject=function(){
    var arr=[];
    var id;
    $project_box.find('span').each(function(){
        id=$(this).attr('data-id');
        arr.push(id);
    });
    $ClubNews_project_id.val(we.implode(',', arr));
};

var fnDeleteProject=function(op){
    $(op).parent().remove();
    fnUpdateProject();
};
// 滚动图片处理
var $scroll_pic_img=$('#GameNews_scroll_pic_img');
var $upload_pic_scroll_pic_img=$('#upload_pic_scroll_pic_img');
var $upload_box_Cscroll_pic_img=$('#upload_box_scroll_pic_img');

// 添加或删除时，更新图片
var fnUpdatescrollPic=function(){
    var arr=[];
    $upload_pic_scroll_pic_img.find('a').each(function(){
        arr.push($(this).attr('data-savepath'));
    });
    $scroll_pic_img.val(we.implode(',',arr));
    $upload_box_scroll_pic_img.show();
    if(arr.length>=5) {
        $upload_box_scroll_pic_img.hide();
    }
};
// 上传完成时图片处理
var fnscrollPic=function(savename,allpath){
    $upload_pic_scroll_pic_img.append('<a class="picbox" data-savepath="'+
    savename+'" href="'+allpath+'" target="_blank"><img src="'+allpath+'" width="100"><i onclick="$(this).parent().remove();fnUpdatescrollPic();return false;"></i></a>');
    fnUpdatescrollPic();
};



$(function(){

    // 添加项目
    $('#project_add_btn').on('click', function(){
		var club_id=$('#ClubNews_club_id').val();
        $.dialog.data('project_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/project");?>&club_id='+club_id,{
            id:'xiangmu',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
				if($.dialog.data('project_id')==-1){
                        var boxnum=$.dialog.data('project_title');
                        for(var j=0;j<boxnum.length;j++) {
							if($('#project_item_'+boxnum[j].dataset.id).length==0){
								var s1='<span class="label-box" id="project_item_'+boxnum[j].dataset.id;
								s1=s1+'" data-id="'+boxnum[j].dataset.id+'">'+boxnum[j].dataset.title;
								$project_box.append(s1+'<i onclick="fnDeleteProject(this);"></i></span>');
								fnUpdateProject(); 
							}
                        }
                    }
            }
        });
    });
    
    // 推荐到单位
    $('#club_list_add_btn').on('click', function(){
        $.dialog.data('club_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/clubmore");?>',{
            id:'tuijiandanwei',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
            if($.dialog.data('club_id')==-1){
                 var  boxnum=$.dialog.data('club_title');
                for(var j=0;j<boxnum.length;j++)
                {
					if($('#club_item_'+boxnum[j].dataset.id).length==0){    
						var s1='<span class="label-box" id="club_item_'+boxnum[j].dataset.id;
						s1=s1+'" data-id="'+boxnum[j].dataset.id+'">'+boxnum[j].dataset.title;
						$club_list_box.append(s1+'<i onclick="fnDeleteClub(this);"></i></span>');
						fnUpdateClub(); 
					}
               }
             }

        });
    });
    
    // 选择单位
    var $club_box=$('#club_box');
    var $ClubNews_club_id=$('#ClubNews_club_id');
    $('#club_select_btn').on('click', function(){
        $.dialog.data('club_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/club", array('partnership_type'=>16));?>',{
            id:'danwei',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
                //console.log($.dialog.data('club_id'));
                if($.dialog.data('club_id')>0){
                    club_id=$.dialog.data('club_id');
                    $ClubNews_club_id.val($.dialog.data('club_id')).trigger('blur');
                    $club_box.html('<span class="label-box">'+$.dialog.data('club_title')+'</span>');
                }
            }
        });
    });
	
	// 选择视频
    var $video_box=$('#video_box');
    var $BoutiqueVideo_club_news_pic=$('#BoutiqueVideo_club_news_pic');
    $('#video_select_btn').on('click', function(){
        $.dialog.data('video_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/material", array('type'=>253));?>',{
            id:'shipin',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
                //console.log($.dialog.data('club_id'));
                if($.dialog.data('material_id')>0){
                    $BoutiqueVideo_club_news_pic.val($.dialog.data('material_id')).trigger('blur');
                    $video_box.html('<span class="label-box">'+$.dialog.data('material_title')+'</span>');
                }
            }
        });
    });

	
	// 推荐到单位更新、删除
	var $club_list_box=$('#club_list_box');
	var $VideoLive_club_list=$('#VideoLive_club_list');
	var fnUpdateClub=function(){
		var arr=[];
		var id;
		$club_list_box.find('span').each(function(){
			id=$(this).attr('data-id');
			arr.push(id);
		});
		console.log(we.implode(',', arr));
		$VideoLive_club_list.val(we.implode(',', arr)).trigger('blur');
	};
	
	var fnDeleteClub=function(op){
		$(op).parent().remove();
		fnUpdateClub();
	};

});
</script> 
