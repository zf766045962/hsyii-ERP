
/*------------------全选函数-----------------*/
$(function() {
           $("#checkAll").click(function() {
                $('input[name="checkboxes"]').attr("checked",this.checked); 
            });
            var $subBox = $("input[name='checkboxes']");
            $subBox.click(function(){
                $("#checkAll").attr("checked",$subBox.length == $("input[name='checkboxes']:checked").length ? true : false);
            });
        });
/*-------添加分类-----------------*/
var randSourceListNum=0;
function add_cat(){
    var str = "mall_cat_list_" + randSourceListNum ;
    $('#mall_cat_source_div').append('&nbsp;&nbsp;<span><select name="cat_list" name="'+str+'_cat" style="width:150px"><option value="-1">请选择...</option></select>&nbsp;&nbsp;<input type="button" name="'+str+'_del" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-------添加项目-----------------*/
function add_project(){
    var str = randSourceListNum ;
    $('#mall_project_source_div').append('<span>&nbsp;&nbsp;<select id="project_id_'+str+'"  name="project_id_'+str+'" style="width:150px"><option value="-1">请选择...</option></select>&nbsp;&nbsp;<input type="button" name="'+str+'_projectdel" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-------添加规格属性-----------------*/
function add_attr(){
    var str = "mall_attr_list_" + randSourceListNum ;
    $('#mall_attr_source_div').append('&nbsp;&nbsp;<span><select name="'+str+'_attr" style="width:150px;"><option value="-1">请选择...</option></select>&nbsp;&nbsp;<input type="button" class="mall_btn" name="'+str+'_del" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-------商品数量-添加行-----------------*/
function add_numline(data1="",data2=""){
    var str = "mall_num_list_" + randSourceListNum ;
    $('#mall_num_source_div').append('<span class="product_count"><br />最低数量 <input type="text" name="'+str+'_min" size="20" value="'+data1+'"/> 件，最高数量 <input type="text" name="'+str+'_mAX" size="20" value="'+data2+'"/> 件&nbsp;<input type="button" class="mall_btn" name="'+str+'_del" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-------订单价格-添加行-----------------*/
function add_price_line(data1="",data2=""){
    var str = "mall_price_list_" + randSourceListNum ;
    $('#mall_price_source_div').append('<span class="product_price"><br />最低总价 <input type="text" name="'+str+'_min" size="20" value="'+data1+'"/> 元，最高总价 <input type="text" name="'+str+'_mAX" size="20" value="'+data2+'"/> 元&nbsp;<input type="button" class="mall_btn" name="'+str+'_del" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-------区域免邮-添加行-----------------*/
function add_post_area(){
    var str = "mall_post_list_" + randSourceListNum ;
    $('#mall_post_area_div').append('&nbsp;&nbsp;<span><br /><input type="text" name="'+str+'_area" size="40" />&nbsp;<input type="button" class="mall_btn" name="'+str+'_del" value="删除" onclick="delRankSource(this)"/></span>');
    randSourceListNum++;
}
/*-----------删除所添加的行-----------------*/
function delRankSource(delitem){
    $(delitem).parent().remove();
}

/*--------------生成规格-----------------*/
function attr_create(){
	$("#attr_create tr").not("#attr_create_header").remove();
                var color_list=$("#attr_color [type=checkbox]:checked");//颜色
				var color_text=[];
				var size_list=$("#attr_size [type=checkbox]:checked");//尺寸
				var size_text=[];
				$.each(color_list,function(a,b){
					var text=color_list.eq(a).next().next().text();
					color_text.push(text);
				});
				$.each(size_list,function(a,b){
					var text=size_list.eq(a).next().text();
					size_text.push(text);
				});
				$.each(color_text,function(m,color){                        
					$.each(size_text,function(n,size){
						if(n==0){
							var str2='<td><input class="mall_btn" name="attr_uploadpic" id="attr_uploadpic" type="button" value="上传图片"/><br><span id="dpic_product_LOG"></span></td><td><a href="#">批量操作</a></td>';
						}
						else{
							var str2='<td></td><td></td>';
						}
						$("#attr_create").append('<tr><td><input type="text" class="mall_table_input" id="d_code" name="d_code" value="TC01021" /></td><td><input type="text" class="mall_table_input" id="d_json_attr" name="d_json_attr" value="'+color+'/'+size+'" /></td><td><input type="text" class="mall_table_input" id="d_unit" /></td><td><input type="text" class="mall_table_input" id="d_price" /></td><td><input type="text" class="mall_table_input" id="d_price" /></td><td><input type="text" class="mall_table_input" id="d_count" /></td>'+str2+'</tr>');
					})
				})  
              }
/*------------------生成规格结束-------------------*/

/*---------------商品预售定价-添加行------------------*/
function add_priceline(){
    var str = "mall_price_" + randSourceListNum ;
    $('#price_type').append('<tr><td><select id="dcom_customer_level_id'+randSourceListNum+'"><option value="-1">无等级</option></select></td><td><input type="text" class="mall_table_input" id="d_shopping_price'+randSourceListNum+'" /></td><td><input type="text" class="mall_table_input" id="d_shopping_beans'+randSourceListNum+'" /></td><td><input type="button" class="mall_btn" name="'+str+'_del" value="删除" onclick="delRankSource_price(this)"/>&nbsp;<input class="mall_btn" type="button" onClick="add_priceline()" value="添加行" /></td></tr>');
    randSourceListNum++;
}
/*-----------商品预售定价-删除所添加的行-----------------*/
function delRankSource_price(delitem){
    $(delitem).parent().parent().remove();
}

/*---------------物流基础运费详细-添加行------------------*/
function add_logistics_price(){
    var str = randSourceListNum ;
    $('#logistics_price').append('<tr align="center"><td><select name="dcom_send_area" id="dcom_send_area'+str+'"><option value="-1">请选择</option></select></td><td><select name="dcom_get_area" id="dcom_get_area'+str+'"><option value="-1">请选择</option></select></td><td><input type="text" class="mall_table_input" id="d_first_weight'+str+'" /></td><td><input type="text" class="mall_table_input" id="d_first_pay'+str+'" /></td><td><input type="text" class="mall_table_input" id="d_next_weight'+str+'" /></td><td><input type="text" class="mall_table_input" id="d_next_pay'+str+'" /></td></tr>');
    randSourceListNum++;
}