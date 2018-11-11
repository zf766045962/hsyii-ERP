<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/common/taglibs.jsp" %>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>小世界-主页</title>
<link href="${ctx }/resources/css/myworld.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
<!--header-->
<div class="member_header"><jsp:include page="/common/member_header.jsp"></jsp:include></div>
<!-- main -->
<div class="main">
<div class="wold_bg">
<div class="wold_bg1"> 
  <div class="wold_header">
    <div class="header_pic">
      <img src="${ctx }/resources/images/myworld/images/head_pic.png" onerror="this.src='/GF/resources/images/community/myclub/sqdw_club_rank_10.png'" width="170" height="170" alt=""/>
    </div>
    <div class="wold_header_r">
      <div class="nick_motto">
        <p class="nickname">LOVE</p>
        <p class="motto">——这个人很懒，什么也没留下...</p>
        <div class="clear"></div>
      </div>
      <div class="wold_menu">
        <a href="${ctx }/myworld-homes" class="thisclass">主页</a>
        <span>|</span>
        <a href="${ctx }/myworld-publishs">发表</a>
        <span>|</span>
        <a href="${ctx }/myworlds">动态</a>
        <span>|</span>
        <a href="${ctx }/myworld-footprints">足迹</a>
        <span>|</span>
        <a href="${ctx }/myworld-fanss">粉丝</a>
        <span>|</span>
        <a href="${ctx }/myworld-concerns">关注</a>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="wold_content">
    <div class="wold_content_l">
      <div class="content_l_show2">
        <textarea id="wold_pub" name="pub_text" onfocus="pp(this)" onblur="this.placeholder='抒发点什么吧...'" placeholder="抒发点什么吧..."></textarea>
      </div>
      <div class="pub_bottom">
        <input type="button" value="发 表" id="pub_key" name="pub_key"/>
        <div class="pub_fun">
	        <a id="emotion"><img src="${ctx }/resources/images/myworld/images/wold_face.png" /></a>
	        <a id="pic"><img src="${ctx }/resources/images/myworld/images/wold_camera.png" /></a>
	        <a id="at"><img src="${ctx }/resources/images/myworld/images/Hait.png" /></a>
	        <a id="show_address"><img src="${ctx }/resources/images/myworld/images/wold_address.png" /><p>显示当前位置</p></a>
	        <a>可见范围  : <select name="wold_pub_class" id="wold_pub_class">
		          <option value="0">公开</option>
		          <option value="1">好友可见</option>
		          <option value="2">自己可见</option>
		          <option value="3">部分可见</option>
		        </select>
	        </a>
        </div>
      </div>
      <div class="wold_show_address">显示位置：<span></span></div>
      <div class="wold_pub_t1 remind">提醒谁看
      	<input type="button" value="选择" id="sele1_key" name="sele1_key">
      </div>  
      <div class="wold_pub_no alert_friend"></div>
      <div class="wold_pub_t1 is_show">部分好友可见
        <input type="button" value="选择" id="sele2_key" name="sele2_key">
       </div>  
      <div class="wold_pub_no no_access"></div>
      <div class="wold_pub_t1 media">已上传<span>0</span>张图片</div> 
      <div class="wold_add_pic">
        
        <div class="add_pic_icon">
          <img src="${ctx }/resources/images/myworld/images/add_pic_icon1.png" width="140" height="140"/>
        </div>
        <form enctype="multipart/form-data" onsubmit="return false;" style="display:none">
	               	<input type="hidden" name="gfid" value="${gf_id }">
	               	<input type="hidden" name="F_SCODE" value="qualification_apply_join">
	               	<input type="hidden" name="F_FIELDNAME" value="certificate_img">
	               	<input type="file" id="pic-input" accept="image/png,image/jpeg" name="testImg">
	            </form>
        <div class="clear"></div>
      </div>
      
    <%-- <div class="wlc_show">
      <div class="content_l_show3">
        <div class="content_head">
          <a href="#"><img src="${ctx }/resources/images/myworld/images/head_pic.png" width="56" height="56" alt=""/><p>LOVE</p><div class="clear"></div></a>
        </div>
        <div class="content_show">
          <div class="show_content">
            <div class="show_content_img">
              <img src="${ctx }/resources/images/myworld/images/content_show_img.png" width="327" height="203" alt=""/>
              <img src="${ctx }/resources/images/myworld/images/content_show_img.png" width="327" height="203" alt=""/>
              <div class="clear"></div>
            </div>
          </div>
          <div class="content_bottom">
            <img src="${ctx }/resources/images/myworld/images/wold_address.png" width="25" height="22"/>
            <p>9-2 14:29</p>
            <p>海南省</p>
            <input type="button" value=" " id="wold_ico1"/>
            <p>评论（0）</p> 
            <input type="button" value=" " id="wold_ico2"/>
            <p>给力（0）</p>
            <input type="button" value=" " id="wold_ico3"/>
            <p>没劲（0）</p> 
            <div class="clear"></div>         
          </div>                 
        </div>
      </div>
      <div class="wold_pub1">
            <textarea name="wold_pub1_text" id="wold_pub1_text" onFocus="pp2();">我也来说两句</textarea>
            <input type="button" name="wold_pub1_face" id="wold_pub1_face" value=" "/>
            <input type="button" name="wold_pub1_key" id="wold_pub1_key" value="发表"/>
            <div class="clear"></div>
      </div> 
     </div> --%>
     
     <%-- <div class="wlc_show">
      <div class="content_l_show3">
        <div class="content_head">
          <a href="#"><img src="${ctx }/resources/images/myworld/images/head_pic.png" width="56" height="56" alt=""/><p>LOVE</p><div class="clear"></div></a>
        </div>
        <div class="content_show">
          <div class="show_content">
            <div class="show_content_img">
              <img src="${ctx }/resources/images/myworld/images/content_show_img.png" width="327" height="203" alt=""/>
              <img src="${ctx }/resources/images/myworld/images/content_show_img.png" width="327" height="203" alt=""/>
              <div class="clear"></div>
            </div>
          </div>
          <div class="content_bottom">
            <img src="${ctx }/resources/images/myworld/images/wold_address.png" width="25" height="22"/>
            <p>9-2 14:29</p>
            <p>海南省</p>
            <input type="button" value=" " id="wold_ico1"/>
            <p>评论（3）</p> 
            <input type="button" value=" " id="wold_ico2"/>
            <p>给力（12）</p>
            <input type="button" value=" " id="wold_ico3"/>
            <p>没劲（2）</p> 
            <div class="clear"></div>         
          </div>                 
        </div>
      </div>
      <div class="wold_pub1">
            <textarea name="wold_pub1_text" id="wold_pub1_text" onFocus="pp2();">我也来说两句</textarea>
            <input type="button" name="wold_pub1_face" id="wold_pub1_face" value=" "/>
            <input type="button" name="wold_pub1_key" id="wold_pub1_key" value="发表"/>
            <div class="clear"></div>
      </div> 
     </div>
     
     <div class="wlc_show">
      <div class="content_l_show3">
        <div class="content_head">
          <a href="#"><img src="${ctx }/resources/images/myworld/images/head_pic.png" width="56" height="56" alt=""/><p>LOVE</p><div class="clear"></div></a>
        </div>
        <div class="content_show">
          <div class="show_content">
            <div class="show_content_text">
              哇哈哈，今天天气太好了
            </div>
          </div>
          <div class="content_bottom">
            <img src="${ctx }/resources/images/myworld/images/wold_address.png" width="25" height="22"/>
            <p>9-2 14:29</p>
            <p>海南省</p>
            <input type="button" value=" " id="wold_ico1"/>
            <p>评论（0）</p> 
            <input type="button" value=" " id="wold_ico2"/>
            <p>给力（0）</p>
            <input type="button" value=" " id="wold_ico3"/>
            <p>没劲（0）</p> 
            <div class="clear"></div>         
          </div>                 
        </div>
      </div>
      <div class="wold_pub1">
            <textarea name="wold_pub1_text" id="wold_pub1_text" onFocus="pp2();">我也来说两句</textarea>
            <input type="button" name="wold_pub1_face" id="wold_pub1_face" value=" "/>
            <input type="button" name="wold_pub1_key" id="wold_pub1_key" value="发表"/>
            <div class="clear"></div>
      </div> 
     </div>
      
     <div class="wlc_show">
      <div class="content_l_show3">
        <div class="content_head">
          <a href="#"><img src="${ctx }/resources/images/myworld/images/head_pic.png" width="56" height="56" alt=""/><p>LOVE</p><div class="clear"></div></a>
        </div>
        <div class="content_show">
          <div class="show_content">
            <div class="show_content_img">
              <img src="${ctx }/resources/images/myworld/images/content_show_img.png" width="661" height="410" alt=""/>
              <div class="clear"></div>
            </div>
          </div>
          <div class="content_bottom">
            <img src="${ctx }/resources/images/myworld/images/wold_address.png" width="25" height="22"/>
            <p>9-2 14:29</p>
            <p>海南省</p>
            <input type="button" value=" " id="wold_ico1"/>
            <p>评论（0）</p> 
            <input type="button" value=" " id="wold_ico2"/>
            <p>给力（0）</p>
            <input type="button" value=" " id="wold_ico3"/>
            <p>没劲（0）</p>  
            <div class="clear"></div>         
          </div>          
        </div>
        
      </div>
      <div class="wold_pub1">
            <textarea name="wold_pub1_text" id="wold_pub1_text" onFocus="pp2();">我也来说两句</textarea>
            <input type="button" name="wold_pub1_face" id="wold_pub1_face" value=" "/>
            <input type="button" name="wold_pub1_key" id="wold_pub1_key" value="发表"/>
            <div class="clear"></div>
      </div> 
     </div> --%>
      <div class="wold_more_bg" onclick="moreInfo()">
      <a>
        <div class="wold_more">
           <img src="/GF/resources/images/myworld/images/wold_more_pic.png" width="27" height="6"> 
           <p>more</p>
           <img src="/GF/resources/images/myworld/images/wold_more_pic.png" width="27" height="6">             
        </div>
      </a>
      </div>
      
      
    </div>
    <div class="wold_content_r">
      <div class="wold_r_mod3">
        <ul>
        <li id="fensNum"><a>1340</a><br/><span>粉丝</span></li>
        <li id="mod3_border"><a>1340</a><br/><span>关注</span></li>
        <li id="publishNum"><a>1340</a><br/><span>发表</span></li>
        <div class="clear"></div>
        </ul>
      </div>
      
      <div class="wold_r_mod4">
        <div class="mod4_title1">本周关注之星</div>
        <!-- <div class="mod4_title2">跆拳道</div> -->
        <div class="mod4_content">
          <div class="mod4_rank">
           <span>1</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>2</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>3</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>4</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>5</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
        </div>
        
        <%-- <div class="mod4_title2">跆拳道</div>
        <div class="mod4_content">
          <div class="mod4_rank">
           <span>1</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>2</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>3</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>4</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
          <div class="mod4_rank">
           <span>5</span>
           <a><img src="${ctx }/resources/images/myworld/images/wold_head_pic3.jpg" width="86" height="86"/></a>
           <input type="button" value="+关注" name="wold_att" id="att_key"/>
          </div>
        </div> --%>
      </div>
      
    </div>
    <div class="body_bg">
	    <div class="sele_friend">
	    	<div class="sele_header">请选择指定好友<a id="close"><img src="/GF/resources/images/myworld/images/mall_product_details_03.png" width="100%"></a></div>
	    	<div class="sele_box">
	    		<div class="sele_right">
	    			<div class="check_tit">已选好友（<span>10</span>）</div>
	                <div class="seek">
	                  	<div class="seek_box">
	                       <input class="seek_input" type="text" placeholder="请输入关键字">
	                       <div class="seek_submit"><img src="/GF/resources/images/customer_service/mall_flash_sale.png"></div>
	                   </div>
	               </div>
	               <div class="friend_list">
		               <table class="list_tab" cellspacing="0">
			                <tbody><tr class="tab_box">
			                    
			                </tr>
	        			</tbody></table>
	               </div>
	    		</div>
	    		<div class="sele_left">
	    			<div class="sele_group_tit">可选分组</div>
	    			<div class="new_group">+ 新建分组</div>
	    			<div class="group_list">
	    				<div class="new_group_box">
	    					<div class="new_tet">
	    						<input type="text" placeholder="请输入分组名称">
	    					</div>
	    					<div class="new_btn">
	    						<input type="button" value="确定">
	    					</div>
	    				</div>
	    				<div class="group"><img src="/GF/resources/images/myworld/images/check_not.png">家人</div>
	    				<div class="group"><img src="/GF/resources/images/myworld/images/check.png">公司</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="sele_aff1">
	    		<input type="button" value="确&nbsp;&nbsp;&nbsp;&nbsp;认">
	    	</div>
	    	<div class="sele_aff2">
	    		<input type="button" value="确&nbsp;&nbsp;&nbsp;&nbsp;认">
	    	</div>
	    </div>
	</div>
    <div class="clear"></div>
  </div>
  <div class="wold_bg2"><img src="${ctx }/resources/images/myworld/images/wold_bg3.png" width="100%" alt=""/></div>
</div>
</div>
</div>
<!-- 底部 -->
<%@include file="/common/sec_footer.jsp" %>
</div>
<script src="${ctx }/resources/js/myworld-home.js"></script>
<!--百度地图获取地址-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cf6Q7pQwwVUuwqBvDVtd5HOAaKBiOxoa"></script> <!--百度地图的文件 -->
</body>
</html>