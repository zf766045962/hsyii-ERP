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
                            <?php echo $form->textField($model, 'customer_name', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'customer_name', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'remarks'); ?></td>
                        <td colspan="3">
                            <?php echo $form->textArea($model,'remarks', array('class' => 'input-text', 'maxlength'=>'30' )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $form->dropDownList($model, 'remarks', Chtml::listData($model, 'id', 'order_title')
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
        $.dialog.data('club_id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/club", array('if_del'=>510));?>',{
            id:'danwei',
            lock:true,
            opacity:0.3,
            title:'选择具体内容',
            width:'500px',
            height:'60%',
            close: function () {
                if($.dialog.data('club_id')>0){
                    $('#MallLowerSet_supplier_id').val($.dialog.data('club_id'));
                    $('#price_box').html('<span class="label-box">'+$.dialog.data('club_title')+'</span>');
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
        $.dialog.open('<?php echo $this->createUrl("tradeDetail/update");?>&mall_member_price_id='+supplier_id,{
            id:'xiajia',
            lock:true,
            opacity:0.3,
            title:'选择下架商品',
            width:'900px',
            height:'70%',
            close: function() {
                if($.dialog.data('id')==-1){
                    var boxnum=$.dialog.data('title');
                    for(var j=0;j<boxnum.length;j++) {
                        // num=num+1;
                        if($('#low_item_'+boxnum[j].dataset.code).length==0){
                            var as=boxnum[j].dataset.inventory-boxnum[j].dataset.available;
                            $product.append(
                                '<tr style="text-align:center;" id="low_item_'+boxnum[j].dataset.code+'">'+
                                    '<td>'+boxnum[j].dataset.code+
                                        '<input type="hidden" class="input-text" name="product['+num+'][id_null]" value="null">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][code]" value="'+boxnum[j].dataset.code+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][title]" value="'+boxnum[j].dataset.title+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][productid]" value="'+boxnum[j].dataset.productid+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][detailsid]" value="'+boxnum[j].dataset.detailsid+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][json_attr]" value="'+boxnum[j].dataset.attr+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][pricing_type]" value="'+boxnum[j].dataset.pricingtype+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][upquantity]" value="'+boxnum[j].dataset.upquantity+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][supplier_id]" value="'+boxnum[j].dataset.supplierid+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][supplier_name]" value="'+boxnum[j].dataset.supplier+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][down_pricing_id]" value="'+boxnum[j].dataset.downpricingid+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][down_pricing_set_details_id]" value="'+boxnum[j].dataset.downpricingsetdetailsid+'">'+
                                        '<input type="hidden" class="input-text" name="product['+num+'][down_pricing_set_id]" value="'+boxnum[j].dataset.downpricingsetid+'">'+
                                    '</td>'+
                                    '<td>'+boxnum[j].dataset.title+'</td>'+
                                    '<td>'+boxnum[j].dataset.attr+'</td>'+
                                    '<td>'+boxnum[j].dataset.supplier+'<input type="hidden" value="'+boxnum[j].dataset.supplierid+'"></td>'+
                                    '<td>'+boxnum[j].dataset.upquantity+'</td>'+
                                    '<td><input class="input-text" name="product['+num+'][inventory_quantity]" value="'+as+'"></td>'+
                                    '<td><a class="btn" href="javascript:;" onclick="fnDeleteProduct(this);" title="删除"><i class="fa fa-trash-o"></i></a></td>'+
                                '</tr>'
                            );
                            num++;
                        }
                    }
                }
            }
        });
    })
</script>
