
<div class="box">
    <div class="box-title c">
        <h1><i class="fa fa-table"></i>商品下架管理</h1></div><!--box-title end-->
    <div class="box-content">
    	<div class="box-header">
            <a class="btn" href="<?php echo $this->createUrl('create');?>"><i class="fa fa-plus"></i>新增方案</a>
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>删除</a>
        </div><!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <label style="margin-right:20px;">
                    <span>审核状态：</span>
                    <select name="state">
                        <option value="">请选择</option>
                        <?php if(is_array($base_code)) foreach($base_code as $v){?>
                            <option value="<?php echo $v->f_id;?>"<?php if(Yii::app()->request->getParam('state')==$v->f_id){?> selected<?php }?>><?php echo $v->F_NAME;?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:20px;">
                    <span>使用状态：</span>
                    <select name="userstate">
                        <option value="">请选择</option>
                        <?php if(is_array($userstate)) foreach($userstate as $v){?>
                            <option value="<?php echo $v->f_id;?>"<?php if(Yii::app()->request->getParam('userstate')==$v->f_id){?> selected<?php }?>><?php echo $v->F_NAME;?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:20px;">
                    <span>商品类型：</span>
                    <select name="type">
                        <option value="">请选择</option>
                        <?php if(is_array($product_type)) foreach($product_type as $v){?>
                            <option value="<?php echo $v->f_id;?>"<?php if(Yii::app()->request->getParam('type')==$v->f_id){?> selected<?php }?>><?php echo $v->F_NAME;?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>上下线日期：</span>
                    <input style="width:120px;" class="input-text" type="text" id="star_time" name="star_time" value="<?php echo Yii::app()->request->getParam('star_time');?>">
                    <span>-</span>
                    <input style="width:120px;" class="input-text" type="text" id="end_time" name="end_time" value="<?php echo Yii::app()->request->getParam('end_time');?>">
                </label>
                <br/>
                <label style="margin-right:20px;">
                    <span>发布单位：</span>
                    <select name="supplier_id">
                        <option value="">请选择</option>
                        <?php  foreach($supplier_id as $v){?>
                            <option value="<?php  echo   $v->id;?>"<?php if(Yii::app()->request->getParam('supplier_id')==$v->id){?> selected<?php }?>><?php echo $v->club_name;?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input style="width:200px;" class="input-text"  placeholder="请输入方案编码/标题" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
                <button class="btn btn-blue" type="submit">查询</button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
        	<table class="list">
                	<tr class="table-title">
                    	<th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
                        <th width="10%"><?php echo $model->getAttributeLabel('event_code');?></th>
                        <th width="20%"><?php echo $model->getAttributeLabel('event_title');?></th>
                        <th><?php echo $model->getAttributeLabel('pricing_type_name');?></th>
                        <th><?php echo $model->getAttributeLabel('supplier_id');?></th>
                        <th><?php echo $model->getAttributeLabel('if_user_state');?></th>
                        <th><?php echo $model->getAttributeLabel('f_check');?></th>
                        <th><?php echo $model->getAttributeLabel('star_time');?></th>
                        <th><?php echo $model->getAttributeLabel('end_time');?></th>
                        <th><?php echo $model->getAttributeLabel('update_date');?></th>
                        <th>操作</th>
                    </tr>
                    <?php 
					 if(is_array($arclist)) foreach($arclist as $v){ ?>
                    <tr>
                    	<td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>"></td>
                        <td><?php echo $v->event_code; ?></td>
                        <td><?php echo $v->event_title; ?></td>
                        <td><?php echo $v->pricing_type_name; ?></td>
                        <td><?php echo $v->supplier_name; ?></td>
                        <td><?php if($v->if_user_state!=null){ $if_user_state=array(648=>'否', 649=>'是'); echo $if_user_state[$v->if_user_state]; } ?></td>
                        <td><?php if($v->f_check!=null){ echo $v->base_code->F_NAME; } ?></td>
                        <td><?php echo $v->star_time; ?></td>
                        <td><?php echo $v->end_time; ?></td>
                        <td><?php echo $v->update_date; ?></td>
                        <td>
                        	<a class="btn" href="<?php echo $this->createUrl('update', array('id'=>$v->id));?>" title="编辑"><i class="fa fa-edit"></i></a>
                            <a class="btn" href="javascript:;" onclick="we.dele('<?php echo $v->id;?>', deleteUrl);" title="删除"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                   <?php } ?>
                </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages); ?></div>
    </div><!--box-content end-->
</div><!--box end-->
<script>
    var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID'));?>';
    $(function(){
        var $star_time=$('#star_time');
        var $end_time=$('#end_time');
        $star_time.on('click', function(){
            WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});
        });
        $end_time.on('click', function(){
            WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});
        });
    });
</script>
