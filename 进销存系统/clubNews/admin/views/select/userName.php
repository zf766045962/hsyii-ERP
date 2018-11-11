 <table class="list" id='list2' >
          <tr > 
            <td width="7%"><?php echo $model->getAttributeLabel('STLEVEL'); ?></td>
            <td width="20%" id="STLEVEL" ><?php echo $st2->SCLEV; ?></td>
            <td width="8%"><?php echo $model->getAttributeLabel('STCLASS'); ?></td>
            <td width="15%" id="STCLASS"><?php echo $st2->SCCLASS; ?></td> 
            <td rowspan="3" width="40%" id='stpic' align="center">
        <?php 
         $s1=''.$stsnum;
         $p='http://202.175.81.109:8080/upload/IMG/HKPIC/P'.substr($s1,0,4).'/s'.$s1.'.jpg';
        ?>
         <img id="pic_" name="pic_" src="<?php echo $p; ?>" width="80px" height="90">
         </td>
        </tr>  
        <tr > 
              <td><?php echo $model->getAttributeLabel('SCSNUM'); ?></td> 
              <td  id="SCSNUM" ><?php echo $st2->SCSNUM; ?></td>
              <td  ><?php echo $model->getAttributeLabel('STNAME'); ?></td>
              <td  id="STNAME"><?php echo $model->STNAME; ?></td> 
          </tr>
    <tr > 
        <td ><?php echo $model->getAttributeLabel('organization'); ?></td>
        <td colspan="3" ><?php echo $model->organization; ?></td>
  </tr>  
  </table>

  

 <?php 
 if (!isset( $_REQUEST['code_type'] ) ) { $_REQUEST['code_type']='';}
?>
<div class="box">
    <div class="box-content">
        <div>
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
        <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
        <input type="hidden" name="club_id" value="<?php echo Yii::app()->request->getParam('club_id');?>">
        <input type="hidden" name="project_id" value="<?php echo Yii::app()->request->getParam('project_id');?>">
        <input type="hidden" name="qualification_code_type" value="<?php echo $_REQUEST['code_type'];?>">
        <label style="margin-right:10px;">
            <span>关键字：</span>
            <input style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
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
    <tr data-id="<?php echo $v->select_id; ?>" data-name="<?php echo $v->select_title; ?>" 
    data-account="<?php echo $v->select_code;?>"
    >
    <td><?php echo $v->select_title; ?>-<?php echo $v->select_code; ?></td>
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
    api.button({  name: '取消'});
    $('.box-table tbody tr').on('click', function(){
        var $this=$(this);
        $.dialog.data('username_id', $this.attr('data-id'));
        $.dialog.data('username_account', $this.attr('data-account'));
        $.dialog.data('username_name', $this.attr('data-name'));

        $.dialog.close();
    });
});
</script>