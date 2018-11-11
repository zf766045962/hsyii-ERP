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
                <thead>
                    <tr>
                        <th>点击选择</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach($arclist as $v){ ?>
                    <tr data-id="<?php echo $v->select_id; ?>" data-title="<?php echo $v->select_title; ?>">
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
    var parentt = $.dialog.parent;				// 父页面window对象
    api = $.dialog.open.api;	// 			art.dialog.open扩展方法
    if (!api) return;

    // 操作对话框
    api.button(
        {
            name: '取消'
        }
    );
    $('.box-table tbody tr').on('click', function(){
        var id=$(this).attr('data-id');
        var title=$(this).attr('data-title');
        $.dialog.data('project_id', id);
        $.dialog.data('project_title', title);
        $.dialog.close();
    });
});
</script>

<tr>
                <th><?php echo $form->labelEx($model, 'project_e_name'); ?></td>
                <td>
                    <?php echo $form->textField($model, 'project_e_name', array('class' => 'input-text', 'style'=>'width:200px;')); ?>
                    <?php echo $form->error($model, 'project_e_name', $htmlOptions = array()); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'IF_VISIBLE'); ?></th>
                <td>
                    <?php echo $form->dropDownList($model, 'IF_VISIBLE', Chtml::listData(BaseCode::model()->getCode(647), 'f_id', 'F_NAME'), array('prompt'=>'请选择')); ?>
                    <?php echo $form->error($model, 'IF_VISIBLE', $htmlOptions = array()); ?>
                </td>
                
            </tr>

            <td><?php echo $form->labelEx($model, 'if_project'); ?></td>
                    <td>
                        <?php echo $form->radioButtonList($model, 'if_project', Chtml::listData(BaseCode::model()->getCode(647), 'f_id', 'F_NAME'), $htmlOptions = array('separator' => '', 'class' => 'input-check', 'style'=>"display:inline-block;width:45px;" , 'template' => '<span class="check">{input}{label}</span>')); ?>
                        <?php echo $form->error($model, 'if_project', $htmlOptions = array()); ?>
                    </td> 