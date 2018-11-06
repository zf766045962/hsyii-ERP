<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>单位信息</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
    <?php  $form = $this->beginWidget('CActiveForm', get_form_list());?>
        <div class="box-detail-tab">
            <ul class="c">
                <li class="current">基本信息</li>
            </ul>
        </div><!--box-detail-tab end-->
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table>
                    <tr class="table-title">
                        <td colspan="2">申请信息</td>
                    </tr>
                    <tr>
                        <td width="30%"><?php echo $form->labelEx($model, 'material_code'); ?></td>
                       <td width="30%">
                            <?php echo $form->textField($model, 'material_code', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'material_code', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                         <td><?php echo $form->labelEx($model, 'material_name'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'material_name', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'material_name', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                     <tr>
                        <td><?php echo $form->labelEx($model, 'material_quantity'); ?></td>
                        <td><!--区域选择弹窗未显示-->
                            <?php echo $form->textField($model, 'material_quantity', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'material_quantity', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'unit');?></td>
                        <td><?php echo $form->textField($model, 'unit', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'unit', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'unitprice');?></td>
                        <td><?php echo $form->textField($model, 'unitprice', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'unitprice', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'total');?></td>
                        <td><?php echo $form->textField($model, 'total', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'total', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'remarks'); ?></td>
                        <td>
                            <?php echo $form->textArea($model,'remarks', array('class' => 'input-text', 'maxlength'=>'30' )); ?>
                        </td>
                    </tr>
                </table>



                    

            
        </div><!--box-detail-bd end-->
        </div>
        <div class="box-detail-submit"><button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button><button class="btn" type="button" onclick="we.back();">取消</button></div>
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
