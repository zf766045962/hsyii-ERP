<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>素材列表</h1></div><!--box-title end-->
    <div class="box-detail-tab box-detail-tab-green mt15">
        <ul class="c">
            <?php $action=Yii::app()->controller->getAction()->id;?>
            <li<?php if($action=='pic'){?> class="current"<?php }?>><a href="<?php echo $this->createUrl('gfMaterial/pic');?>">图片</a></li>
            <li<?php if($action=='audio'){?> class="current"<?php }?>><a href="<?php echo $this->createUrl('gfMaterial/audio');?>">音频</a></li>
            <li<?php if($action=='video'){?> class="current"<?php }?>><a href="<?php echo $this->createUrl('gfMaterial/video');?>">视频</a></li>
        </ul>
    </div><!--box-detail-tab end-->
    <div class="material c">
        <div class="material-lt">
            <div class="material-hd c">
                <div class="material-hd-lt">全部音频</div>
                <div class="material-hd-rt">
                    <div class="material-upload"><script>var materialAudioUrl='<?php echo $this->createUrl('gfMaterial/upaudio', array('group_id'=>$group_id));?>';we.materialAudio();</script></div>
                    <span class="msg">格式支持mp3、wma、wav、amr，文件大小不超过20M</span>
                </div>
            </div><!--material-hd end-->
            <div class="material-bar c">
                <label><input id="btn-check-all" class="input-check" type="checkbox"><span>全选</span></label>
                <a onclick="fnChangeGroupShow(we.checkval('.check-item:checked'), this);" class="btn" href="javascript:;"><i class="fa fa-exchange"></i>移动分组</a>
                <a class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>删除</a>
            </div><!--material-bar end-->
            <div class="material-audio c">
                <ul id="material-main" class="c">
                    <?php foreach($arclist as $v){ ?>
                    <li>
                        <div class="pic"><img data-src="<?php echo $v->v_file_path;?><?php echo $v->v_name;?>" src="<?php echo SITE_PATH;?>/static/admin/img/i-audio.png"></div>
                        <div class="info">
                            <div class="title">
                                <input class="input-check check-item" type="checkbox" value="<?php echo $v->id;?>">
                                <input id="title-<?php echo $v->id;?>" class="input-text" type="text" value="<?php echo $v->v_title;?>" readonly>
                            </div>
                            <div class="duration"><?php echo $v->v_file_insert_size;?></div>
                            <div class="date"><?php echo substr($v->v_file_time, 0, -9);?></div>
                        </div>
                        <div class="bar">
                            <a class="fa fa-pencil" href="javascript:;" onclick="fnChangeTitle('<?php echo $v->id;?>', this);"></a>
                            <a class="fa fa-exchange" href="javascript:;" onclick="fnChangeGroupShow('<?php echo $v->id;?>', this);"></a>
                            <a class="fa fa-download" href="<?php echo $v->v_file_path;?><?php echo $v->v_name;?>" target="_blank"></a>
                            <a class="fa fa-trash-o" href="javascript:;" onclick="we.dele('<?php echo $v->id;?>', deleteUrl);"></a>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div><!--material-pic end-->
            <div class="box-page c"><?php $this->page($pages); ?></div>
        </div><!--material-lt end-->
        <div class="material-rt">
            <div class="material-group">
                <a<?php if($group_id==0){?> class="current"<?php }?> href="<?php echo $this->createUrl('gfMaterial/'.$action);?>">全部音频<span>(<?php echo $all_num;?>)</span></a>
                <a<?php if($group_id==-1){?> class="current"<?php }?> href="<?php echo $this->createUrl('gfMaterial/'.$action, array('group_id'=>-1));?>">未分组<span>(<?php echo $nogroup_num;?>)</span></a>
                <?php foreach($material_group as $v){ ?>
                <a<?php if($group_id==$v->id){?> class="current"<?php }?> href="<?php echo $this->createUrl('gfMaterial/'.$action, array('group_id'=>$v->id));?>"><?php echo $v->group_name;?><span>(<?php echo GfMaterial::model()->getNum($v->id,254);?>)</span></a>
                <?php } ?>
            </div>
            <div class="item" onclick="fnAddGroupShow();">+新建分组</div>
            <div id="addgroup" class="addgroup">
                <div class="addgroup-hd">创建分组</div>
                <div class="addgroup-bd"><input id="addgroup-name" class="input-text" type="text"></div>
                <div class="addgroup-bar">
                    <input onclick="fnAddGroup();" class="btn btn-green" type="button" value="确定">
                    <input onclick="fnAddGroupHide();" class="btn" type="button" value="取消">
                </div>
            </div><!--addgroup end-->
        </div><!--material-rt end-->
    </div><!--box-content end-->
</div><!--box end-->
<div id="changegroup" class="changegroup">
    <div class="changegroup-bd">移动分组<select id="group-id"><option>请选择</option></select></div>
    <div class="changegroup-bar">
        <input onclick="fnChangeGroup();" class="btn btn-green" type="button" value="确定">
        <input onclick="fnChangeGroupHide();" class="btn" type="button" value="取消">
    </div>
</div><!--changegroup end-->
<script src="<?php echo SITE_PATH;?>/static/admin/js/jquery.jmp3.js"></script>
<script>
var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID'));?>';
var $addgroup=$('#addgroup');
var $addgroup_name=$('#addgroup-name');
var isAjaxRunning=false;
var fnAddGroupShow=function(){
    $addgroup.show();
};
var fnAddGroupHide=function(op){
    $addgroup.hide();
    $addgroup_name.val('');
};
var fnAddGroup=function(){
    if(isAjaxRunning || $addgroup_name.val()==''){return false;}
    isAjaxRunning=true;
    $.ajax({
        type:'POST',
        url:'<?php echo $this->createUrl('addGroup');?>',
        data: {name:$addgroup_name.val()},
        dataType:'json',
        success:function(data){
            isAjaxRunning=false;
            if(data.status==1){
                $('.material-group').append('<a href="<?php echo $this->createUrl('gfMaterial/'.$action);?>&group_id='+data.id+'">'+$addgroup_name.val()+'<span>(0)</span></a>');
                fnAddGroupHide();
            }else{
                we.msg('minus', data.msg);
            }
        }
    });
};

var $changegroup=$('#changegroup');
var $groupId=$('#group-id');
var changeGroupId=0;
var fnChangeGroupShow=function(id,op){
    changeGroupId=id;
    if(changeGroupId<=0){
         we.msg('minus', '请选择要移动的图片');
        return false;
    }
    var　$this=$(op);
    var thisW=$this.width();
    var thisH=$this.height();
    var offset=$this.offset();
    $.ajax({
         type:'GET',
         url:'<?php echo $this->createUrl('getGroup');?>',
         dataType:'html',
         success:function(data){
             $groupId.html('<option value="">请选择</option>'+data);
             $changegroup.css({top:offset.top+thisH+15, left:offset.left-(50-thisW/2)}).show();
         }
    });
};
var fnChangeGroupHide=function(){
    $changegroup.hide();
};
var fnChangeGroup=function(){
    if(changeGroupId<=0){
         we.msg('minus', '请选择要移动的图片');
        return false;
    }
    if($groupId.val()<=0){
         we.msg('minus', '请选择分组');
        return false;
    }
    if(isAjaxRunning){return false;}
    isAjaxRunning=true;
    $.ajax({
        type:'POST',
        url:'<?php echo $this->createUrl('changeGroup');?>',
        data: {group_id:$groupId.val(), changeGroupId:changeGroupId},
        dataType:'json',
        success:function(data){
            isAjaxRunning=false;
            if(data.status==1){
                we.success(data.msg);
                fnChangeGroupHide();
            }else{
                we.msg('minus', data.msg);
            }
        }
    });
};

//编辑标题
var fnChangeTitle=function(id,op){
    $('#title-'+id).attr('readonly',false).focus();
    $('#title-'+id).on('change', function(){
        var readonly=$(this).attr('readonly');
        if(readonly==undefined || readonly==false){
            $.ajax({
                type:'POST',
                url:'<?php echo $this->createUrl('changeTitle');?>',
                data: {id:id, title:$('#title-'+id).val()},
                dataType:'json',
                success:function(data){}
            });
        }
        $(this).attr('readonly',true);
    }).on('blur',function(){
        $(this).attr('readonly',true);
    });
};

$(function(){
    $('#btn-check-all').on('click', function() {
        var $this = $(this);
        if ($this.is(':checked')) {
            $('.check-item').each(function() {
                this.checked = true;
            });
        } else {
            $('.check-item').each(function() {
                this.checked = false;
            });
        }
    });
    
    $(".material-audio .pic img").on('click', function(){
        $(this).jmp3({
            filepath:$(this).attr('data-src')
        })
    });
});
</script>