<div class="box">
    <div class="box-content">
        <div>
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input id="club" style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
                <button class="btn btn-blue" type="submit">查询</button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead><tr><th>点击选择</th>
                <th class="check"><input id="j-checkall" class="input-check" type="checkbox">全选<a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="add_chose();"><i class="fa fa-trash-o"></i>添加</a></th>
                </tr></thead>
                <tbody>
<?php foreach($arclist as $v){ ?>
    <tr id="line<?php echo $v->select_id; ?>" data-id="<?php echo $v->select_id; ?>" data-code="<?php echo $v->select_code; ?>" data-title="<?php echo $v->select_title; ?>"><td class="check check-item"><input class="input-check" type="checkbox" id="id<?php echo CHtml::encode($v->select_id); ?>" value="<?php echo CHtml::encode($v->id); ?>"></td>
        <td><?php echo $v->select_title; ?></td>
    </tr>
<?php } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages); ?></div>
    </div><!--box-content end-->
</div><!--box end-->
<script>
$(function(){
    api = $.dialog.open.api;	// 			art.dialog.open扩展方法
    if (!api) return;

    // 操作对话框
    api.button( { name: '取消' } );
    $('.box-table tbody tr').on('click', function(){
    //    var id=$(this).attr('data-id');
    //    var title=$(this).attr('data-title');
        $.dialog.data('club_id', $(this).attr('data-id'));
        $.dialog.data('club_code', $(this).attr('data-code'));
        $.dialog.data('club_title',$(this).attr('data-title') );
        $.dialog.close();
    });
});


function add_chose(){
        var boxnum = $('table.list ').find('.selected');
        $.dialog.data('club_id', -1);
        $.dialog.data('club_code', $(this).attr('data-code'));
        $.dialog.data('club_title', boxnum );
        $.dialog.close();
 };
</script>