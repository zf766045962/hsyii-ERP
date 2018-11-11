<?php if (!isset($_REQUEST['game_list_data_id'])) {$_REQUEST['game_list_data_id']='0';} ?>
<div class="box">
    <div class="box-content">
        <div>
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <input type="hidden" name="game_list_data_id" value="<?php echo $_REQUEST['game_list_data_id'];?>">
               
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input id="game" style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
            <button class="btn btn-blue" type="submit">查询<?php echo $_REQUEST['game_list_data_id'];?></button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead><tr><th>点击选择</th></tr></thead>
                <tbody>
<?php foreach($arclist as $v){ ?>
    <tr data-id="<?php echo $v->select_id; ?>" data-code="<?php echo $v->select_code; ?>" data-title="<?php echo $v->select_title; ?>">
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
    api = $.dialog.open.api;    //          art.dialog.open扩展方法
    if (!api) return;

    // 操作对话框
    api.button( { name: '取消' } );
    $('.box-table tbody tr').on('click', function(){
        $.dialog.data('team_id', $(this).attr('data-id'));
        $.dialog.data('team_code', $(this).attr('data-code'));
        $.dialog.data('team_title', $(this).attr('data-title'));
        $.dialog.close();
    });
});
</script>