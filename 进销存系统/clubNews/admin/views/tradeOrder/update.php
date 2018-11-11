<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>入出库单信息</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
    <?php  $form = $this->beginWidget('CActiveForm', get_form_list());?>
        <div class="box-detail-tab">
            <ul class="c">
                <li class="current">入出库单</li>
            </ul>
        </div><!--box-detail-tab end-->
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table>
                    <tr class="table-title">
                        <td colspan="4">基本信息</td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'order_num'); ?></td>
                        <td><!-- 自动生成订单编号 -->
                             <?php echo $model->order_num; ?>
                        </td>                        
                        <td><?php echo $form->labelEx($model, 'order_title'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'order_title', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'order_title', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'order_time'); ?></td>
                         <td>
                            <?php echo $form->textField($model, 'order_time', array('class' => 'input-text')); ?>
                            <p>*输入格式: YYYY-MM-DD</p>
                            <?php echo $form->error($model, 'order_time', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'customer_name'); ?></td>
                        <td><!--区域选择弹窗未显示-->
                            <?php echo $form->hiddenField($model, 'customer_name', array('class' => 'input-text')); ?>
                            <span id="price_box"><?php if($model->customer_name!=null){?><span class="label-box"><?php echo $model->customer_name;?></span><?php } ?></span>
                            <input id="downproduct_select_btn" class="btn" type="button" value="选择">
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'remarks'); ?></td>
                        <td colspan="3">
                            <?php echo $form->textArea($model,'remarks', array('class' => 'input-text', 'maxlength'=>'30' )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo "测试下拉框："; ?>
                        <td colspan="3"><?php echo $form->dropDownList($model, 'remarks', Chtml::listData(tradeOrder::model()->findAll(), 'id', 'auditor')
                            , array('prompt'=>'请选择','onchange' =>'selectOnchang(this)'));?>
                        </td>
                    </tr>
                </table>
                <script>var oldnum=0;</script>               
                <table class="mt15" id="product">
                    <tr class="table-title">
                        <td colspan="8">入库单明细&nbsp;&nbsp;<input id="product_select_btn" class="btn" type="button" value="添加商品"></td>
                    </tr>
                    <tr class="table-title" style="text-align:center;">
                        <td>商品编码</td>
                        <td>商品名称</td>
                        <td>数量</td>
                        <td>单位</td>
                        <td>单价</td>
                        <td>总金额</td>
                        <td>仓库</td>
                        <td>备注</td>
                    </tr>
                    <?php echo $form->hiddenField($model, 'order_num', array('class' => 'input-text')); ?>
                    <?php $num=1; if(isset($product_list)) if (is_array($product_list)) foreach ($product_list as $v) {?>
                        <tr style="text-align:center;" id="low_item_<?php echo $v->order_num; ?>">
                            <td>
                                <?php echo $v->order_num; ?>
                                <input type="hidden" class="input-text" name="order_num[<?php echo $num;?>][id]" value="<?php echo $v->id;?>">

                            </td>
                        <script>oldnum=<?php echo $v->id ?>;</script>
                    <?php $num=$num+1; } ?>                     
               </table>


               <table>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'receiver');?></td>
                        <td><?php echo $form->textField($model, 'receiver', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'receiver', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'auditor');?></td>
                        <td><?php echo $form->textField($model, 'auditor', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'auditor', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                </table>
                </div>

        </div><!--box-detail-bd end-->

        <div class="box-detail-submit">
            <button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button>
            <button class="btn" type="button" onclick="we.back();">取消</button></div>
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
<script>
    $(function(){
        var $down_time=$('#<?php echo get_class($model);?>_down_time');
        $down_time.on('click', function(){
        WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss '});});
    });

    var fnDeleteProduct=function(op){
        // alert('确定删除吗？');
        var a=confirm("确定删除吗？");
        if(a==true){
            $(op).parent().parent().remove();
        }
        else{
            console.log('取消删除');
        }
    };

    $('#downproduct_select_btn').on('click', function(){
        $.dialog.data('customer_name', 0);
        $.dialog.open('<?php echo $this->createUrl("select/club", array('if_del'=>510));?>',{
            id:'danwei',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
                if($.dialog.data('customer_name')>0){
                    $('#TradeOrder_customer_name').val($.dialog.data('customer_name'));
                    $('#price_box').html('<span class="label-box">'+$.dialog.data('customer_name')+'</span>');
                }
            }
        });
    });

    $product=$('#product');
    var num=<?php echo $num; ?>;
    $('#product_select_btn').on('click', function(){
        // var supplier_id=$('#MallLowerSet_supplier_id').val();
        // if(supplier_id==''){
        //     we.msg('minus','请先选择供应商');
        //     return false;
        // }
        $.dialog.data('id', 0);
        $.dialog.open('<?php echo $this->createUrl("create");?>')    
    })
</script>
