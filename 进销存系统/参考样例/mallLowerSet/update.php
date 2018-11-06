
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>商品下架详情</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
        <?php $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="box-detail-tab"><ul class="c"><li class="current">基本信息</li></ul></div><!--box-detail-tab end-->
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table class="mt15">
                	<tr class="table-title">
                    	<td colspan="4" >方案信息</td>
                    </tr>
                    <tr>
                        <?php if(empty($model->id)) {?>
                            <?php echo $form->hiddenField($model, 'down_up', array('value'=>-1)); ?>
                            <?php echo $form->hiddenField($model, 'if_user_state', array('value'=>648)); ?>
                        <?php }?>
                        <td><?php echo $form->labelEx($model, 'event_code'); ?></td>
                        <td><?php echo $model->event_code; ?></td>
                        <td><?php echo $form->labelEx($model, 'event_title'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'event_title', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'event_title', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr> 
                         <td><?php echo $form->labelEx($model, 'down_time'); ?></td>
                         <td colspan="3">
                            <?php echo $form->textField($model, 'down_time', array('class' => 'input-text','style'=>'width:30%;')); ?>
                            <?php echo $form->error($model, 'down_time', $htmlOptions = array()); ?>
                         </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'supplier_id'); ?></td>
                        <td colspan="3">
                            <?php echo $form->hiddenField($model, 'supplier_id', array('class' => 'input-text')); ?>
                            <span id="price_box"><?php if($model->supplier_name!=null){?><span class="label-box"><?php echo $model->supplier_name;?></span><?php } ?></span>
                            <input id="downproduct_select_btn" class="btn" type="button" value="选择">
                        </td>
                    </tr>    
                </table>
                <script>var oldnum=0;</script>               
                <table class="mt15" id="product">
                    <tr class="table-title">
                        <td colspan="7">本次下架商品&nbsp;&nbsp;<input id="product_select_btn" class="btn" type="button" value="添加商品"></td>
                    </tr>
                    <tr class="table-title" style="text-align:center;">
                        <td>商品编码</td>
                        <td>商品名称</td>
                        <td>型号/规格</td>
                        <td>供应商</td>
                        <td>下架时库存数</td>
                        <td>可下架数量</td>
                        <td>更多操作</td>
                    </tr>
                    <?php echo $form->hiddenField($model, 'product', array('class' => 'input-text')); ?>
                    <?php $num=1; if(isset($product_list)) if (is_array($product_list)) foreach ($product_list as $v) {?>
                        <tr style="text-align:center;" id="low_item_<?php echo $v->product_code; ?>">
                            <td>
                                <?php echo $v->product_code; ?>
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][id_null]" value="<?php echo $v->id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][id]" value="<?php echo $v->id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][setid]" value="<?php echo $v->set_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][code]" value="<?php echo $v->product_code;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][title]" value="<?php echo $v->product_name;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][upquantity]" value="<?php echo $v->up_quantity;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][json_attr]" value="<?php echo $v->json_attr;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][pricing_type]" value="<?php echo $v->pricing_type;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][productid]" value="<?php echo $v->product_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][detailsid]" value="<?php echo $v->down_pricing_set_details_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][supplier_id]" value="<?php echo $v->supplier_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][supplier_name]" value="<?php echo $v->supplier_name;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][down_pricing_id]" value="<?php echo $v->down_pricing_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][down_pricing_set_details_id]" value="<?php echo $v->down_pricing_set_details_id;?>">
                                <input type="hidden" class="input-text" name="product[<?php echo $num;?>][down_pricing_set_id]" value="<?php echo $v->down_pricing_set_id;?>">
                            </td>
                            <td><?php echo $v->product_name; ?></td>
                            <td><?php echo $v->json_attr; ?></td>
                            <td><?php echo $v->supplier_name; ?></td>
                            <td><?php echo $v->up_quantity; ?></td>
                            <td><input type="text" class="input-text" name="product[<?php echo $num;?>][inventory_quantity]" value="<?php echo $v->Inventory_quantity; ?>"></td>
                            <td><a class="btn" href="javascript:;" onclick="fnDeleteProduct(this);" title="删除"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <script>oldnum=<?php echo $v->id ?>;</script>
                    <?php $num=$num+1; } ?>                     
               </table>
            </div><!--box-detail-tab-item end-->
        </div><!--box-detail-bd end-->
        <div class="mt15">
            <table class="table-title">
                <tr>
                    <td>审核信息</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width='15%'><?php echo $form->labelEx($model, 'reasons_for_failure'); ?></td>
                    <td width='85%'>
                        <?php echo $form->textField($model, 'reasons_for_failure', array('class' => 'input-text' ,'value'=>'')); ?>
                        <?php echo $form->error($model, 'reasons_for_failure', $htmlOptions = array()); ?>
                    </td>
                </tr>
                <tr>
                	<td>可执行操作</td>
                    <td>
                        <?php if(empty($model->id)) {?>
                            <?php echo show_shenhe_box(array('baocun'=>'保存'));?>
                        <?PHP }else{?>
                            <?php echo show_shenhe_box(array('baocun'=>'保存','shenhe'=>'提交审核','tongguo'=>'审核通过','butongguo'=>'审核不通过'));?>
                        <?php }?>
                        <button class="btn" type="button" onclick="we.back();">取消</button>
                    </td>
                </tr>
            </table>
        </div>
        <table class="showinfo">
            <tr>
                <th style="width:20%;">操作时间</th>
                <th style="width:20%;">操作人</th>
                <th style="width:20%;">审核状态</th>
                <th>操作备注</th>
            </tr>
            <tr>
                <td><?php echo $model->reasons_time; ?></td>
                <td><?php echo $model->reasons_admin_nick; ?></td>
                <td><?php echo $model->f_check_name; ?></td>
                <td><?php echo $model->reasons_for_failure; ?></td>
            </tr>
        </table>
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
        var supplier_id=$('#MallLowerSet_supplier_id').val();
        if(supplier_id==''){
            we.msg('minus','请先选择供应商');
            return false;
        }
        $.dialog.data('id', 0);
		$.dialog.open('<?php echo $this->createUrl("select/mallPricingDetails");?>&mall_member_price_id='+supplier_id,{
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
