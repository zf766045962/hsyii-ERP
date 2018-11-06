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
                            <?php echo $form->dropDownList($model, 'news_type', Chtml::listData(BaseCode::model()->getCode(882), 'f_id', 'F_NAME')
                            , array('prompt'=>'请选择','onchange' =>'selectOnchang(this)')); ?>
                            <?php echo $form->error($model, 'news_type', $htmlOptions = array()); ?>
                        </td>
                        <td style="padding:10px;"><?php echo $form->labelEx($model, 'club_id'); ?></td>
                        <td>
                            <span id="club_box"><?php if($model->club_id!=null){?><span class="label-box"><?php echo $model->news_club_name;?><?php echo $form->hiddenField($model, 'club_id', array('class' => 'input-text')); ?></span><?php } else {?><span class="label-box"><?php echo get_session('club_name');?><?php echo $form->hiddenField($model, 'club_id', array('class' => 'input-text','value'=>get_session('club_id'))); ?></span><?php } ?></span>
                            <?php echo $form->error($model, 'club_id', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'news_introduction'); ?></td>
                        <td>
                          <?php echo $form->textArea($model,'news_introduction', array('class' => 'input-text', 'maxlength'=>'30' )); ?>
                          <p>*简短介绍，最多可输入30个字符，含数字特殊符号：-&nbsp;/&nbsp;\&nbsp;等；</p>
                          <?php echo $form->error($model, 'news_introduction', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'project_id'); 
                        $model->id=empty($model->id) ?0 : $model->id;
                        $project_list = ClubNewsProject::model()->findAll('club_news_id='.$model->id);
                        ?></td>
                        <td>
                            <?php echo $form->hiddenField($model, 'project_id', array('class' => 'input-text')); ?>
                            <span id="project_box"><?php foreach($project_list as $v){?><span class="label-box" id="project_item_<?php echo $v->project_id;?>" data-id="<?php echo $v->project_id;?>"><?php if (!empty($v->project_list)) echo $v->project_list->project_name;?><i onclick="fnDeleteProject(this);"></i></span><?php }?></span>
                            <input id="project_add_btn" class="btn" type="button" value="添加项目">
                            <?php echo $form->error($model, 'project_id', $htmlOptions = array()); ?>
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
                    <?php if(($model->club_id==1) || get_session('club_id')===1) {?>
                    <tr>
                        <td><?php echo $form->labelEx($model,'recommend_type'); ?></td>
                        <td colspan="3">
                            <?php echo $form->dropDownList($model, 'recommend_type', Chtml::listData(BaseCode::model()->getCode(1009), 'f_id', 'F_NAME'), array('prompt'=>'请选择','onchange'=>'selectRecommendType(this)')); ?>
                        </td>
                    </tr>
                    <?php }?>
                    <tr id="dis_club_list" style="display:none;">
                        <td style="padding:10px;"><?php echo $form->labelEx($model, 'club_list'); ?></td>
                        <td colspan="3">
                            <?php
                                echo $form->hiddenField($model, 'club_list', array('class' => 'input-text'));
                                $model->id=empty($model->id) ?0 : $model->id;
                                $club_list = ClubNewsRecommend::model()->findAll('news_id='.$model->id);
                            ?>
                            <span id="club_list_box">
                                <?php if(!empty($club_list)) foreach ($club_list as $v) {?>
                                    <span class="label-box" id="club_item_<?php echo $v->recommend_clubid;?>" data-id="<?php echo $v->recommend_clubid;?>"><?php echo $v->club_list->club_name;?><i onclick="fnDeleteClub(this);"></i></span>
                                <?php }?>
                            </span>
                            <input id="club_list_add_btn" class="btn" type="button" value="选择">
                            <?php echo $form->error($model, 'club_list', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'order_num'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'order_num', array('class' => 'input-text')); ?>
                            </br>
                            <span>*排序号，越大越靠前排序显示</span>
                            <?php echo $form->error($model, 'order_num', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'news_pic'); ?></td>
                        <td>
                            <?php echo $form->hiddenField($model, 'news_pic', array('class' => 'input-text fl')); ?>
                            <?php $basepath=BasePath::model()->getPath(124);$picprefix='';if($basepath!=null){ $picprefix=$basepath->F_CODENAME; }?>
                            <?php if($model->news_pic!=''){?><div class="upload_img fl" id="upload_pic_ClubNews_news_pic"><a href="<?php echo $basepath->F_WWWPATH.$model->news_pic;?>" target="_blank"><img src="<?php echo $basepath->F_WWWPATH.$model->news_pic;?>" width="100"></a></div><?php }?>
                            <input style="margin-left:5px;" id="picture_select_btn" class="btn" type="button" value="图库选择" >
                            <script>we.uploadpic('<?php echo get_class($model);?>_news_pic','<?php echo $picprefix;?>');</script>
                            <?php echo $form->error($model, 'news_pic', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr id='show_pic_line'  style="display:none;"><!--news_type=226时显示，此外为多图，链接club_news_pic表-->
                     <td><?php echo $form->labelEx($model, 'club_news_pic'); 
                        $model->id=empty($model->id) ?0 : $model->id;
                        $club_news_pic=ClubNewsPic::model()->findAll('club_news_id='.$model->id);
                        ?></td>
                        <td colspan="3">
                            <?php echo $form->hiddenField($model, 'club_news_pic', array('class' => 'input-text')); ?>
                            <div class="upload_img fl" id="upload_pic_club_news_pic">
                                <?php $basepath=BasePath::model()->getPath(165);$picprefix='';
                                if($basepath!=null){ $picprefix=$basepath->F_CODENAME; } ?>
                                <script>
								var pic_num=0;
                                </script>
                                <table id="club_news_pic">
                                <?php if(!empty($club_news_pic)) foreach($club_news_pic as $v) { ?>
                                  <tr>
                                    <td width="150"><input type="hidden" name="club_news_pic[<?php echo $v['id'];?>][id]" value="<?php echo $v['id'];?>" ><input type="hidden" name="club_news_pic[<?php echo $v['id'];?>][pic]" value="<?php echo $v['news_pic'];?>" ><a class="picbox" data-savepath="<?php echo $v['news_pic'];?>" 
                                href="<?php echo $basepath->F_WWWPATH.$v['news_pic'];?>" target="_blank">
                                <img src="<?php echo $basepath->F_WWWPATH.$v['news_pic'];?>" width="100">
                                </a></td>
                                    <td><textarea oninput="LimitText(this)" onpropertychange="LimitText(this)" name="club_news_pic[<?php echo $v['id'];?>][intro]" class="input-text" style="width:80%;height:80px;" placeholder="请输入图片介绍... 50字以内"><?php echo $v['introduce'];?></textarea></td>
                                    <td width="50"><a class="btn" href="javascript:;" onclick="fnDelPic(this);" title="删除"><i class="fa fa-trash-o"></i></a></td>
                                  </tr>
                                  <script>
								 pic_num=<?php echo $v['id'];?>;
                                </script>
                                  <?php }?>
                                </table>
                            </div>
                    <script>         
                      we.uploadpic('<?php echo get_class($model);?>_club_news_pic','<?php echo $picprefix;?>','','',function(e1,e2){fnscrollPic(e1.savename,e1.allpath);},50);
                        </script>
                            <?php echo $form->error($model, 'club_news_pic', $htmlOptions = array()); ?>
                         <div style="height:50px;"></div>
                        </td>
                    </tr><!--子图片结束-->
                    <tr id='show_video_line'  style="display:none;"><!--news_type=227时显示,此外表，链接club_news_pic表-->
                        <td><?php echo $form->labelEx($model, 'news_video'); 
                        ?></td>
                        <td colspan="3" style="padding:30px 15px;">
                            <?php echo $form->hiddenField($model, 'news_video', array('class' => 'input-text')); ?>
                            <div class="c">
                                <span id="video_box" class="fl">
                                <?php if($model->gf_material!=null){?>
                                    <span class="label-box">
                                    <a href="<?php echo $model->gf_material->v_file_path.$model->gf_material->v_name;?>" target="_blank">
                                    <?php if($model->gf_material->v_title!=''){ 
                                         echo $model->gf_material->v_name;
                                    }else{ 
                                         echo $model->gf_material->v_title;
                                    }?>
                                    </a>
                                    </span>
                                <?php }?>
                                </span>
                                <div class="upload fl">
                                <script>var materialVideoUrl='<?php echo $this->createUrl('gfMaterial/upvideo');?>';
                                we.materialVideo(function(data){ $('#ClubNews_news_video').val(data.id).trigger('blur'); $('#video_box').html('<span class="label-box">'+data.name+'</span>'); },61,24,'上传');</script></div>
                                <input style="margin-left:5px;" id="video_select_btn" class="btn fl" type="button" value="选择视频">
                            </div>
                            <?php echo $form->error($model, 'news_video', $htmlOptions = array()); ?>
                        </td>
                    </tr><!--视频结束-->
                    <tr style="dispay:black;"><!--news_type=225时显示-->
                        <td><?php echo $form->labelEx($model, 'news_content'); ?></td>
                        <td colspan="3">
                            <?php echo $form->hiddenField($model, 'news_content_temp', array('class' => 'input-text')); ?>
                            <script>we.editor('<?php echo get_class($model);?>_news_content_temp', '<?php echo get_class($model);?>[news_content_temp]');</script>
                            <?php echo $form->error($model, 'news_content_temp', $htmlOptions = array()); ?>
                        </td>
                    </tr>
<?php if($_REQUEST['news_type']==884){ ?>
        <tr>
                        <td><?php echo $form->labelEx($model, 'pic_sourcer'); ?></td>
                        <td colspan="3">
                            <?php echo $form->textField($model, 'pic_sourcer', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'pic_sourcer', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                <tr>
                        <td><?php echo $form->labelEx($model, 'pic_editor'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'pic_editor', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'pic_editor', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'pic_create'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'pic_create', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'pic_create', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                            <tr>
                        <td><?php echo $form->labelEx($model, 'pic_auditing'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'pic_auditing', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'pic_auditing', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'pic_editor_chief'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'pic_editor_chief', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'pic_editor_chief', $htmlOptions = array()); ?>
                        </td>
                    </tr>
    

<?php  } ?>
                </table>
            </div><!--box-detail-tab-item end-->
        </div><!--box-detail-bd end-->
        <div class="mt15">
            <table class="table-title"><tr> <td>审核信息</td></tr></table>
            <table>
                <tr>
                    <td width="15%"><?php echo $form->labelEx($model, 'reasons_for_failure'); ?></td>
                    <td width="85%">
                        <?php echo $form->textArea($model, 'reasons_for_failure', array('class' => 'input-text' ,'value'=>'')); ?>
                        <?php echo $form->error($model, 'reasons_for_failure', $htmlOptions = array()); ?>
                    </td>
                </tr>
                <tr>
                	<td>可执行操作</td>
                    <td>
                    <?php echo show_shenhe_box(array('baocun'=>'保存','shenhe'=>'提交审核','tongguo'=>'审核通过','butongguo'=>'审核不通过'));?>
                    <button class="btn" type="button" onclick="we.back();">取消</button>
                    </td>
                </tr>
            </table>
        </div>
         
         <table class="showinfo">
            <tr>
                <th style="width:20%;">操作时间</th>
                <th style="width:20%;">操作人</th>
                <th style="width:20%;">状态</th>
                <th>操作备注</th>
            </tr>
            <tr>
                <td><?php echo $model->uDate; ?></td>
                <td><?php echo $model->state_qmddname; ?></td>
                <td><?php echo $model->state_name; ?></td>
                <td><?php echo $model->reasons_for_failure; ?></td>
            </tr>
        </table>
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

//从图库选择图片
var $Single=$('#ClubNews_news_pic');
    $('#picture_select_btn').on('click', function(){
		var club_id=$('#ClubNews_club_id').val();
        $.dialog.data('app_icon', 0);
        $.dialog.open('<?php echo $this->createUrl("gfMaterial/materialPictureAll", array('type'=>252,'fd'=>124));?>&club_id='+club_id,{
            id:'picture',
            lock:true,
            opacity:0.3,
            title:'请选择素材',
            width:'100%',
            height:'90%',
            close: function () {
                if($.dialog.data('material_id')>0){
                    $Single.val($.dialog.data('app_icon')).trigger('blur');

                    $('#upload_pic_ClubNews_news_pic').html('<a href="<?php echo $basepath->F_WWWPATH;?>'+art.dialog.data('app_icon')
                    +'" target="_blank"> <img src="<?php echo $basepath->F_WWWPATH;?>'+art.dialog.data('app_icon')
                    +'"  width="100"></a>');

                   // $('#Gfapp_app_icon_x').val($.dialog.data('dataX')).trigger('blur');
                    //$('#Gfapp_app_icon_y').val($.dialog.data('dataY')).trigger('blur');
                    //$('#Gfapp_app_icon_w').val($.dialog.data('dataWidth')).trigger('blur');
                    //$('#Gfapp_app_icon_h').val($.dialog.data('dataHeight')).trigger('blur');
               }

            }
        });
    });
	
//限制图集简介字数
function LimitText(op){
	 maxlimit = 50;
	 var textval=$(op).val();
	 if (textval.length > maxlimit) {
		 $(op).val(textval.substring(0, maxlimit));
		 we.msg('minus', '字数不得多于50！');
	 }
}
selectRecommendType($('#ClubNews_recommend_type'));
function selectRecommendType(obj){
    var show_type=$(obj).val();
    if(show_type==1011){ 
        $('#dis_club_list').show();
    } else{
        $('#dis_club_list').hide();
    }
}

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
var $club_news_pic=$('#club_news_pic');
var $upload_pic_club_news_pic=$('#upload_pic_club_news_pic');
var $upload_box_scroll_pic_img=$('#upload_box_scroll_pic_img');

///////////////////////////// 删除图片
var fnDelPic=function(op){
	$(op).parent().parent().remove();
}
/////////////////////////////////////////////////////////////////////
// 上传完成时图片处理
var fnscrollPic=function(savename,allpath){
	pic_num++;
    $club_news_pic.append('<tr><td width="150"><input type="hidden" name="club_news_pic['+pic_num+'][id]" value="null" ><input type="hidden" name="club_news_pic['+pic_num+'][pic]" value="'+savename+'" ><a class="picbox" data-savepath="'+savename+'" href="'+allpath+'" target="_blank"><img src="'+allpath+'" width="100"></a></td><td><textarea oninput="LimitText(this)" onpropertychange="LimitText(this)" name="club_news_pic['+pic_num+'][intro]" class="input-text" style="width:80%;height:80px;" placeholder="请输入图片介绍... 50字以内"></textarea></td><td width="50"><a class="btn" href="javascript:;" onclick="fnDelPic(this);" title="删除"><i class="fa fa-trash-o"></i></a>');
	
    //fnUpdatescrollPic();
};
//selectOnchang('#ClubNews_news_type');
 function selectOnchang(obj){ 
//     console(obj);
// var value = obj.options[obj.selectedIndex].value;
// alert(value);
var  show_id=$(obj).val();

 if (show_id==884) { $("#show_pic_line").show() }
  else {$("#show_pic_line").hide();}

 if (show_id==885) $("#show_video_line").show()
  else $("#show_video_line").hide();
};
// 推荐到单位更新、删除
    var $club_list_box=$('#club_list_box');
    var $ClubNews_club_list=$('#ClubNews_club_list');
    var fnUpdateClub=function(){
        var arr=[];
        var id;
        $club_list_box.find('span').each(function(){
            id=$(this).attr('data-id');
            arr.push(id);
        });
        //console.log(we.implode(',', arr));
        $ClubNews_club_list.val(we.implode(',', arr)).trigger('blur');
    };
    
    var fnDeleteClub=function(op){
        $(op).parent().remove();
        fnUpdateClub();
    };

$(function(){
    var show_id=$('#ClubNews_news_type').val();
     if (show_id==884) { 
        $("#show_pic_line").show();
        $("#show_video_line").hide();
    }else if (show_id==885){
        $("#show_video_line").show();
        $("#show_pic_line").hide();
    }

    // 添加项目到$model->project_id;
    var arr=[];
    var id;
    $project_box.find('span').each(function(){
        id=$(this).attr('data-id');
        arr.push(id);
    });
    $ClubNews_project_id.val(we.implode(',', arr));

    // 添加图片到$model->club_news_pic;
    var arr1=[];
    $upload_pic_club_news_pic.find('a').each(function(){
        arr1.push($(this).attr('data-savepath'));
    });
    $club_news_pic.val(we.implode(',',arr1));
    $upload_box_scroll_pic_img.show();
    // if(arr1.length>=5) {
    //     $upload_box_scroll_pic_img.hide();
    // }


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
           }

        });
    });
    
    
    // 选择单位
    var $club_box=$('#club_box');
    var $ClubNews_club_id=$('#ClubNews_club_id');
    $('#club_select_btn').on('click', function(){
        $.dialog.data('club_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/club");?>',{
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
    var $ClubNews_news_video=$('#ClubNews_news_video');
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
                    $ClubNews_news_video.val($.dialog.data('material_id')).trigger('blur');
                    $video_box.html('<span class="label-box">'+$.dialog.data('material_title')+'</span>');
                }
            }
        });
    });

	
	

});
</script> 
