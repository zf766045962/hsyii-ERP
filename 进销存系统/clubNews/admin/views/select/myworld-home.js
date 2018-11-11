var b=new Base64();
$(function () {
    if(logined) {
		getFoot();
		GetMyWorldPage();
		getConcernNum()
		getFansStars()
    }else{
		alert(not_login_msg);
		goLogin();
		return false;
    }
});
function getFoot(){
	var map = new Map();
	map.put("gfid",gfId);
	map.put("my_gfid",gfId);
	map.put("from",0);
	map.put("rank_id",0);
	map.put("page",page);
	map.put("pageSize",pageSize);
	$.ajaxloading({
		url:"Test/get_foot",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			e=$.parseJSON(e.result)
			console.log(e);
            $(".nickname").html(e.user.name);
			$(".header_pic img").attr("src",e.user.tx);
			$('.motto').html(e.user.grqm);
		}
	});
}

var content
var address
var media = []
var rem_frien = []
var is_show
var show_friends = [gfId]
function Publishmood(){
	var map = new Map();
	map.put("gfid",gfId);
	map.put("content",b.encode(content));
	map.put("address",b.encode(address));
	map.put("gfwb",1);
	map.put("web_link","");
	map.put("pubType",0);
	map.put("media_url",media.join('|'));
	map.put("if_remind",1);
	map.put("remind_friends",rem_frien.join('|'));
	map.put("is_show",is_show);
	if(is_show==3){
		map.put("show_friends",show_friends.join('|'));
	}
	console.log(map)
	$.ajaxloading({
		url:"GFUser/Publishmood",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			$('.wlc_show').remove();
			GetMyWorldPage();
			
			$('#wold_pub').val("");
			$("#wold_pub_class").change(function(){
				$("#wold_pub_class option").eq(0).attr("selected",false);
			})
			$("#wold_pub_class option").eq(0).attr("selected",true);
			$('.wold_pub_t1').hide();
			$('.alert_friend').empty();
			$(".alert_friend:empty").hide()
			rem_frien = []
			$('.no_access').empty();
			$(".no_access:empty").hide()
			show_friends = [gfId]
			$('.add_pic').remove();
			$('.wold_add_pic').hide();
			pic_count = 0;
			$('.media span').text(pic_count)
			media = []
			$('.wold_show_address span').empty();
			$(".wold_show_address span:empty").parent().hide()
		}
	});
}

$('#pub_key').click(function(){
	console.log(media.length)
	is_show = $('#wold_pub_class').val();
	content = $('#wold_pub').val();
	address = $('.wold_show_address span').html();
	$('.alert_friend .remind_frie').each(function fun(){
	    txt=$(this).attr('value');
	    rem_frien.push(txt)
	})
	$('.no_access .is_show').each(function fun(){
	    txt=$(this).attr('value');
	    show_friends.push(txt)
	})
	if(content==''&&media.length==0){
		if(confirm('先说两句吧')){
			return false;
		}
	}else{
		Publishmood();
	}
})

$('#show_address').click(function(){
	initMap();
})
//获取当前位置
function initMap(){
	position_msg();
	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r){
		var site = r.address
		console.log(site);
		$('.wold_show_address span').html(site.province+site.city+site.district+site.street);
		$('.wold_show_address').show();
		position_msg_hide();
	})
}

function getFrlist(){
	var map = new Map();
	map.put("gf_id",gfId);
	$.ajaxloading({
		url:"Test/get_frlist",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			e=$.parseJSON(e.result)
			console.log(e);
			var content = '';
			$.each(e.datas,function(k,info){
				content += '<td>'+
				'<a><img src="'+info.TX+'" onerror="this.src=error_img" value="'+info.GF_ID+'"/></a>'
				if(info.GF_MEMO_NAME==''){
					content += '<span>'+info.GF_NAME+'</span>'
				}else{
					content += '<span>'+info.GF_MEMO_NAME+'</span>'
				}
				content += '</td>'
			})
			$('.friend_list table tr').html(content)
		}
	});
}
$('#at').click(function(){
	if($('.remind').is(":hidden")){
		$('.remind').show()
		if($(".alert_friend").is(":empty")){
			$(".alert_friend").hide()
		}else{
			$(".alert_friend").show()
		}
	}else{
		$('.remind').hide()
		$(".alert_friend").hide()
	}
})
$('#sele1_key').click(function(){
	$('.body_bg').show();
	$('.sele_aff1').show();
	$('.sele_aff2').hide();
	getFrlist()
})

var ID
var frien
var GF_ID = []
var My_frien = []
$(document).on('click','.tab_box td img',function(){
	ID = $(this).attr('value');
	frien = $(this).parent().next().text();
	if($(this).hasClass('checked')){
		$(this).removeClass('checked')
		$.each(My_frien,function(index,item){
            if(item==frien){
            	My_frien.splice(index,1);
    	    }
    	});
    	$.each(GF_ID,function(i,j){
            if(j==ID){
            	GF_ID.splice(i,1);
    	    }
    	});
	}else{
		$(this).addClass('checked');
		GF_ID.push(ID);
		My_frien.push(frien);
		$.unique(GF_ID);
		$.unique(My_frien);
	}
})
var remind
$('.sele_aff1 input').click(function(){
	for(var i=0;i<$('.checked').length;i++){
		remind = $( '<div class="no_user remind_frie" value="'+GF_ID[i]+'">'+
		'<span>'+My_frien[i]+'</span>'+
		'<a><img src="'+ctx+'/resources/images/myworld/images/no_user.png" width="12" height="12"/></a>'+
		'</div>')
		$('.alert_friend').append(remind);
	}
	GF_ID=[];
	My_frien=[];
	$('.body_bg').hide();
	$('.alert_friend').show()
})
$('#close').click(function(){
	$('.body_bg').hide();
})
$(document).on('click',".remind_frie a",function(event){
	$(this).parent().remove()
	$(".alert_friend:empty").hide()
	event.stopImmediatePropagation();
})

$('#sele2_key').click(function(){
	$('.body_bg').show();
	$('.sele_aff2').show();
	$('.sele_aff1').hide();
	getFrlist()
})
$('.sele_aff2 input').click(function(){
	for(var i=0;i<$('.checked').length;i++){
		remind = $( '<div class="no_user is_show" value="'+GF_ID[i]+'">'+
		'<span>'+My_frien[i]+'</span>'+
		'<a><img src="'+ctx+'/resources/images/myworld/images/no_user.png" width="12" height="12"/></a>'+
		'</div>')
		$('.no_access').append(remind);
	}
	GF_ID=[];
	My_frien=[];
	$('.body_bg').hide();
	$('.no_access').show()
})
$(document).on('click',".is_show a",function(event){
	$(this).parent().remove()
	$(".no_access:empty").hide()
	event.stopImmediatePropagation();
})

$('#wold_pub_class').change(function(){
	if($('#wold_pub_class').val()==3){
		$('.is_show').show()
	}else{
		$('.is_show').hide()
	}
})

$('#pic').click(function(){
	if($('.wold_add_pic').is(":hidden")){
		$('.wold_add_pic').show()
		$(".media").show()
	}else{
		$(".wold_add_pic").hide()
		$('.media').hide()
	}
})
//选择图片
var pic_count = 0;
var pic_max = 9;
$('.add_pic_icon').click(function(){
	if(pic_count < pic_max){
		$("#pic-input").trigger('click');
	}else{
		alert("最多只能添加"+pic_max+"张图片！");
		return false;
	}
	return false;
})
$(document).on("change","#pic-input",function(){
	var img_file=$(this);
	var formdata = new FormData(img_file.parent("form")[0]);
	$.ajax({
        url: 'RealName/uploadImg',
        type: 'POST',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
        	if(img_file.val()==""){
        		return false;
        	}
        	showmask();
        },
        success: function (e) {
        	console.log(e)
            if (e.error == 0) {
            	media.push(e.ImgName);
            	console.log(media)
            	$.unique(media);
            	var content = "";
        		content += '<div class="add_pic"><a class="del-pic"><img src="'+ctx+'/resources/images/myworld/images/no_pic.png" width="20" height="20" onerror="this.src=error_img" /></a><img class="upload_pic" src="'+getFileUrl(img_file.attr('id'))+'" alt=""/></div>';
        		$(".wold_add_pic").prepend(content);
        		$(".media").show();
        		$(".del-pic").on('click',function(event){
        			$(this).parent().remove();
        			pic_count--;
        			$.each(media,function(index,item){
        	            if(item==e.ImgName){
        	            	media.splice(index,1);
        	    	    }
        	    	});
        			console.log(media)
        			$('.media span').html(pic_count)
        			event.stopImmediatePropagation();
        		});
        		pic_count++;
        		$('.media span').html(pic_count)
            } else {
                alert("上传失败！");
            }
			img_file.after('<input type="file" id="'+img_file.attr('id')+'" accept="image/png,image/jpeg" name="'+img_file.attr('name')+'" style="display:none">')
            img_file.remove();
        },
        complete:function(){
            hidemask();
        }
    });
});
function getObjectURL(file) {  
	var url = null ;   
	if (window.createObjectURL!=undefined){
		url = window.createObjectURL(file);
	}else if(window.URL!=undefined){
		url = window.URL.createObjectURL(file);  
	}else if(window.webkitURL!=undefined){
	    url = window.webkitURL.createObjectURL(file);  
	}  
	return url;  
}

var page = 1;
var pageSize = 8;
var total=0;
var totalPage=0;
function GetMyWorldPage(){
var map = new Map();
	map.put("gfid",gfId);
	map.put("v_gfid",gfId);
	map.put("page",page);
	map.put("pageSize",pageSize);
	$.ajaxloading({
		url:"GFUser/GetMyWorldPage",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			console.log(e);
			total=e.total;
			totalPage=Math.ceil(total/pageSize);
			var content = '';
			if(e.error==0){
				$.each(e.datas,function(k,info){
					var content = '';
					var cool = [];
					var coolCount = [];
					var boring  = [];
					var boringCount = [];
					$.each(info.data_position,function(m,n){
						if(n.mType==1){
							cool.push('<img src="'+e.media_url_dir+n.TXNAME+'" onerror="this.src=error_head" />');
							coolCount.push(info.data_position)
						}else if(n.mType==2){
							boring.push('<img src="'+e.media_url_dir+n.TXNAME+'" onerror="this.src=error_head" />');
							boringCount.push(info.data_position)
						}
					})
					content += '<div class="wlc_show">'+
					'<div class="content_l_show3">'+
					'<div class="content_head">'+
					'<a style="cursor: auto;"><img src="'+info.tx+'" width="56" height="56" onerror="this.src=error_head" onclick="getFrienWorld('+info.f_gfid+')" /><p onclick="getFrienWorld('+info.f_gfid+')">'+info.GF_NAME+'</p><div class="clear"></div></a>'+
					'</div>'+
					'<div class="content_show">'+
					'<div class="show_content">'+
					'<div class="show_content_text">'+new Base64().decode(info.content)+'</div>'+
					'<div class="show_content_img">'
					if(info.media_url!=''){
						$.each(info.media_url.split('|'),function(m,n){
							content += '<img src="'+img_path+info.media_url.split('|')[m]+'" width="220" onerror="this.src=error_img" />'
						})
					}
					content += '<div class="clear"></div></div></div>'+
					
					'<div class="content_bottom">'+
					'<img src="'+ctx+'/resources/images/myworld/images/wold_address.png" width="25" height="22"/>'+
					'<p>'+new Date(info.ttime).format("MM-dd hh:mm")+'</p>'+
					'<p>'+new Base64().decode(info.address)+'</p>'+
					'<input type="button" value=" " id="wold_ico1"/>'+
					'<p>评论（'+info.data_comment.length+'）</p>'+
					'<input type="button" value=" " id="wold_ico2" onclick="PositionMood('+info.if_praise+','+info.xq_id+')" />'+
					'<p>给力（'+coolCount.length+'）</p>'+
					'<input type="button" value=" " id="wold_ico3" onclick="PositionMood('+info.if_beat+','+info.xq_id+')" />'+
					'<p>没劲（'+boringCount.length+'）</p> '+
					'<span class="more">更多<ul>'
					if(info.f_gfid==gfId){
						content += '<li class="remove_xq" data-xq-id="'+info.xq_id+'">删除</li>'
					}else{
						content += '<li onclick="goReport(958,'+info.xq_id+')">举报</li>'
					}
					content += '</ul></span>'+
					'<div class="clear"></div>'+
					'</div></div>'+
					'<div class="wold_angle"><img src="'+ctx+'/resources/images/myworld/images/wold_angle1.png" width="732"/></div>'+
					'<div class="wold_message" xq_id="'+info.xq_id+'">'+
					'<div class="wold_m1">'+
					'<div class="wold_s">'+
					'<div id="wold_ico4"><img src="'+ctx+'/resources/images/myworld/images/wold_support2.png" width="19" height="22"/></div>'+
					'<div class="wold_s_hp">'+
					cool.join('')+
					'<p id="wold_s_count">等<span>'+coolCount.length+'人</span>给力</p>'+
					'<div class="clear"></div>'+
					'</div></div>'+
					'<div class="wold_o">'+
					'<div id="wold_ico5"><img src="'+ctx+'/resources/images/myworld/images/wold_oppose.png" width="19" height="22"/></div>'+
					'<div class="wold_o_hp">'+
					boring.join('')+
					'<p id="wold_s_count">等<span>'+boringCount.length+'人</span>没劲</p>'+
					'<div class="clear"></div></div></div></div>'
	 				$.each(info.data_comment,function(m,n){
						if(n.reply_id==0){
							content+='<div class="wold_m2" comment_id="'+n.comment_id+'">'+
							'<div>'+
							'<div class="wold_mm1">'+
							'<div class="wold_mm1_pic1">'+
							'<img src="'+img_path+n.TXNAME+'" width="35" height="35" onerror="this.src=error_head" />'+
							'</div>'+
							'<div class="wold_mm1_text1">'+
							'<p><span>'+n.GF_NAME+'：</span>'+new Base64().decode(n.content)+'</p>'+
							'<div class="wold_mt">'+
							'<p id="mt">'+new Date(n.uDate).format("MM-dd hh:mm")+'</p>'+
							'<input type="button" value=" " id="wold_ico1"/>'+
							'<div class="clear"></div>'+
							'</div>'+
							'</div>'+
							'<div class="clear"></div>'+
							'</div>'+
							'<div class="wold_mmm2">'+
							'<textarea id="mm2_content" name="mm2_content"></textarea>'+
							'<input type="button" id="mm2_face" value=" " name="mm2_face"/>'+
							'<input type="button" id="mm2_pub" data-comment-id="'+n.comment_id+'" value="发表" name="mm2_pub"/>'+
							'<div class="clear"></div>'+
							'</div>'+
							'</div>'+
							'</div>'
						}
					})
					content+='</div>'+
					'<div class="wold_angle"><img src="'+ctx+'/resources/images/myworld/images/wold_angle2.png" width="732"/></div></div>'+
					
					'<div class="wold_pub1">'+
					'<textarea name="wold_pub1_text" id="wold_pub1_text" onfocus="pp(this)" onblur="pp2(this)" placeholder="我也来说两句"></textarea>'+
					'<input type="button" name="wold_pub1_face" id="wold_pub1_face" value=" "/>'+
					'<input type="button" name="wold_pub1_key" id="wold_pub1_key" value="发表" data-xq-id="'+info.xq_id+'"/>'+
					'<div class="clear"></div></div></div>'
					$('.wold_more_bg').before(content);
//					$('.wold_message[xq_id="'+info.xq_id+'"]').find(".wold_m2").each(function(m,y){
//						$.each(info.data_comment,function(a,b){
//							if(b.reply_id==$('.wold_message[xq_id="'+info.xq_id+'"]').find(".wold_m2").eq(m).attr("comment_id")){
//								var content="";
//								content+='<div>'+
//								'<div class="wold_mmm1">'+
//								'<div class="wold_mm1_pic1">'+
//								'<img src="'+img_path+b.TXNAME+'" width="35" height="35"/>'+
//								'</div>'+
//								'<div class="wold_mm1_text1">'+
//								'<p><span>'+b.GF_NAME+'</span>&nbsp;评论&nbsp;<span>'+b.reply_name+'：</span>'+new Base64().decode(b.content)+'</p>'+
//								'<div class="wold_mt">'+
//								'<p id="mt">'+new Date(b.uDate).format("MM-dd hh:mm")+'</p>'+
//								'<input type="button" value=" " id="wold_ico1"/>'+
//								'<div class="clear"></div>'+
//								'</div>'+
//								'</div>'+
//								'<div class="clear"></div>'+
//								'</div>'+
//								'<div class="wold_mmm2">'+
//								'<textarea id="mm2_content" name="mm2_content"></textarea>'+
//								'<input type="button" id="mm2_face" value=" " name="mm2_face"/>'+
//								'<input type="button" id="mm3_pub" data-comment-id="'+b.comment_id+'" value="发表" name="mm3_pub"/>'+
//								'<div class="clear"></div>'+
//								'</div>'+
//								'</div>'
//								$('.wold_message[xq_id="'+info.xq_id+'"]').find(".wold_m2").eq(m).append(content)
//							}
//						})
//					})
				})
				hideMore()
			}else{
				content += '<div class="wlc_show" style="text-align:center;height:50px;line-height:50px;">暂无数据</div>'
				$('.wold_more_bg').before(content)
				$('.wold_more_bg').hide()
			}
			$('.wlc_show').eq(0).css('margin-top','5px')
		}
	});
}
function hideMore(){
	if(page<totalPage){
		$(".wold_more_bg").css("display","block");
	}else{
		$(".wold_more_bg").css("display","none");
	}
}
function moreInfo(){
	page++;
	console.log(page)
	GetMyWorldPage();
}
function pp2(x){
	x.placeholder="我也来说两句";
}
function pp(e){
	var p = document.getElementById("wold_pub");
	e.placeholder="";
	p.value="";
	p.style.color="#000000";
	p.style.fontFamily="方正兰亭黑_GBK";
	p.style.fontWeight="normal";
}


var menu = $(".wold_menu a");
menu.click(function(){
	$(this).addClass("thisclass").siblings().removeClass("thisclass");
});
$(document).on('click','.content_bottom #wold_ico1',function () {
	$(this).parents('.content_l_show3').siblings('.wold_pub1').children('#wold_pub1_text').focus();
})

//$(document).on('click','.wold_mm1 #wold_ico1',function(){
//	if($(this).parent().parent().parent().next().css("display")=="none")
//	{
//		$(this).parent().parent().parent().next().css("display","block")
//		$(this).parent().parent().parent().next().children('#mm2_content').focus();
//	}
//	else{
//		$(this).parent().parent().parent().next().css("display","none")
//	}
//})
//$(document).on('click','.wold_mmm1 #wold_ico1',function(){
//	if($(this).parent().parent().parent().next().is(":hidden"))
//	{
//		$(this).parent().parent().parent().next().show()
//		$(this).parent().parent().parent().next().children('#mm2_content').focus();
//	}
//	else{
//		$(this).parent().parent().parent().next().hide()
//	}
//})

function getConcernNum(){
	var map = new Map();
	map.put("gfid",gfId);
	$.ajaxloading({
		url:"Test/get_concern_num",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			e=$.parseJSON(e.result)
//			console.log(e);
			$('#fensNum a').html(e.fensNum);
			$('#mod3_border a').html(e.concernNum);
			$('#publishNum a').html(e.moods_num);
		}
	});
}
function PositionMood(type,id){
	var map = new Map();
	map.put("xq_id",id);
	map.put("gfid",gfId);
	map.put("mType",type);
	console.log(map)
	$.ajaxloading({
		url:"GFUser/PositionMood",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			console.log(e)
			$('.wlc_show').remove();
			GetMyWorldPage()
		}
	});
}
$(document).on('click','.remove_xq',function(){
	var xq = $(this).attr('data-xq-id')
	if(confirm('确定删除此条心情吗？')){
		DelMyMood(xq)
	}else{
		return false;
	}
})
function DelMyMood(xqId){
	var map = new Map();
	map.put("xq_id",xqId);
	map.put("gfid",gfId);
	console.log(map)
	$.ajaxloading({
		url:"GFUser/DelMyMood",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			console.log(e)
			$('.wlc_show').remove();
			GetMyWorldPage()
		}
	});
}

$(document).on('click','#wold_pub1_key',function(){
	var xqId = $(this).attr('data-xq-id')
	var cont = $(this).siblings('#wold_pub1_text').val()
	console.log(cont)
	map.put("xq_id",xqId);
	map.put("comment_id","");
	map.put("content",b.encode(cont));
	ReplyMoods()
})
//$(document).on('click','.wold_m2 #mm2_pub',function(){
//	var commentId = $(this).attr('data-comment-id')
//	var cont = $(this).siblings('#mm2_content').val()
//	map.put("xq_id","");
//	map.put("comment_id",commentId);
//	map.put("content",b.encode(cont));
//	ReplyMoods()
//})
//$(document).on('click','.wold_m2 #mm3_pub',function(){
//	var commentId = $(this).attr('data-comment-id')
//	var cont = $(this).siblings('#mm2_content').val()
//	map.put("xq_id","");
//	map.put("comment_id",commentId);
//	map.put("content",b.encode(cont));
//	ReplyMoods()
//})
var map = new Map();
function ReplyMoods(){
	console.log(map)
	map.put("m_gfid",gfId);
	$.ajaxloading({
		url:"GFUser/ReplyMoods",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			console.log(e)
			$('.wlc_show').remove();
			GetMyWorldPage()
		}
	});
}

var starsData;
var stars_totalPage=0;
var stars_totalCount=0;
var stars_page=1;
var stars_pageSize=10;
function getFansStars(){
	var map = new Map();
	map.put("project_id",projectId);
	map.put("gfid",gfId);
//	map.put("page",1);
//	map.put("pageSize",10);
	console.log(map)
	$.ajaxloading({
		url:"Test/get_fans_stars",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			e=$.parseJSON(e.result)
			console.log(e)
			if(e.error==0){
				starsData=e.datas
				stars_totalCount=e.total;
				stars_totalPage=Math.ceil(stars_totalCount/stars_pageSize);
				fans_stars_page();
			}
		}
	});
}
function fans_stars_page(){
	var content='';
	$.each(starsData,function(k,info){
		k++
		if(k<=stars_pageSize*stars_page){
			content += '<div class="mod4_rank"><span>'+k+'</span><a><img src="'+info.icon+'" width="86" height="86" onerror="this.src=error_head" onclick="getFrienWorld('+info.gfid+')" /></a><input type="button" value="+关注" name="wold_att" id="att_key" onclick="setConcern('+info.gfid+')"/></div>'
		}
	});
	$('.mod4_content').html(content);
}
function setConcern(concernedId){
	var map = new Map();
	map.put("gfid",gfId);
	map.put("concernedId",concernedId);
	map.put("type",1);
	$.ajaxloading({
		url:"Test/set_concern",
		data:map.toJSON(),
		type:"post",
		async:false,
		success:function(e){
			e=$.parseJSON(e.result)
			console.log(e)
			if(e.msg=='关注成功'){
				alert('关注成功')
				$('.mod4_content').empty();
				getFansStars()
			}
		}
	});
}
$('#publishNum a,#publishNum span').click(function(){
	window.location.href="myworld-publishs";
})
$('#mod3_border a,#mod3_border span').click(function(){
	window.location.href="myworld-concerns";
})
$('#fensNum a,#fensNum span').click(function(){
	window.location.href="myworld-fanss";
})

function getFrienWorld(VgfId){
	sessionStorage.setItem("VgfId",VgfId)
	if(VgfId==gfId){
		window.location.href="myworld-homes";
	}else{
		window.location.href="frien-worlds";
	}
}