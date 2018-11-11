<div class="mapbox c">
    <div class="container_address" id="container_address_man"></div>
    <div class="container_address_right">
        <a id="curCityText" href="javascript:void(0)" onClick="curCityText()"><strong id="curCity" class="curCity">北京市</strong></a>
        <input id="txtarea" type="text" size="50" style="width:195px;margin-left:5px;"placeholder="输入地址搜索" />  
        <button  id="areaSearch" style="cursor: pointer;" class="container_address_right_seek">搜索</button> 
        <div><strong>纬度：</strong><br/><input name="txtlatitude" type="text" id="txtlatitude" /> </div>
        <div><strong>经度：</strong><br/><input name="txtLongitude" type="text" id="txtLongitude" /> </div>
        <div><strong>标注点所在区域：</strong><br/><input name="txtAreaCode" type="text" id="txtAreaCode" style="height:60px;" /> </div>
        <!--div class="sel_container"> 
          <strong id="curCity" class="curCity">北京市</strong> 
          <button id="curCityText" href="javascript:void(0)" class="container_address_right_change">更换成市</button> 
        </div--> 
        <div class="map_popup" id="cityList" style="display: none;"> 
            <div class="popup_main"> 
                <div class="popup_main_title"> 城市列表</div> 
                <div class="cityList" id="citylist_container"></div>
                <button id="popup_close"> </button> 
            </div> 
        </div> 
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script> <!--百度地图的文件 -->
<script type="text/javascript" src="http://api.map.baidu.com/library/CityList/1.2/src/CityList_min.js"></script> <!--城市选择的-->

<style>
    .mapbox{padding:10px; width:887px;}
    .container_address{width: 520px; height: 480px; border: 1px solid gray; float: left;z-index:200;}
    .container_address_right{float:left;margin-left:10px;width:350px;height:340px;}
    .container_address_right input{width:340px;height:30px;line-height:30px;border:1px solid #ccc;text-indent:5px;border-radius:2px;}
    .curCity{border-radius:2px;border:1px solid #ccc;width:80px;height:33px;line-height:33px;top:5px;float:left;text-indent:5px;}
    .container_address_right_seek{width:60px;height:35px;line-height:35px;border:1px solid #ccc;float:right;}
    .container_address_right_change{width:80px;float:left;margin-left:5px;height:30px;}
    .container_address_right div{margin:5px;}
    .container_address_right div strong{height:30px;line-height:30px;}
    .map_popup{background:#FFF;margin-top:50px;border:1px solid #ccc;float:left;COLOR:#000;height:300px;overflow-x:hidden;overflow-y:scroll;width:340px;}
    .popup_main_title{width:100%;font-weight:bold;font-size:16px/20px 黑体;border-bottom:1px solid #f60;line-height:40px;}

</style>
<script  language="javascript" >
var map = new BMap.Map("container_address_man");
map.centerAndZoom(new BMap.Point(117.10, 40.13), 11); 
map.addControl(new BMap.NavigationControl()); 
map.addControl(new BMap.ScaleControl()); 
map.addControl(new BMap.OverviewMapControl()); 
map.addControl(new BMap.MapTypeControl()); 
//搜索 
document.getElementById("areaSearch").onclick = function () { 
	// 创建地址解析器实例 
	var myGeo = new BMap.Geocoder(); 
	var searchTxt = document.getElementById("txtarea").value; 
	// 将地址解析结果显示在地图上，并调整地图视野 
	myGeo.getPoint(searchTxt, function (point) { 
		if (point) { 
			map.centerAndZoom(point, 16); 
			document.getElementById("txtlatitude").value = point.lat; 
			document.getElementById("txtLongitude").value = point.lng; 
			var pointMarker = new BMap.Point(point.lng, point.lat); 
			geocodeSearch(pointMarker); 
			map.addOverlay(new BMap.Marker(point)); 
		} 
			else 
			alert("搜索不到结果"); 
	}, "全国"); 
} 
map.enableScrollWheelZoom(); 
// 创建CityList对象，并放在citylist_container节点内 
var myCl = new BMapLib.CityList({ container: "citylist_container", map: map }); 
// 给城市点击时，添加相关操作 
myCl.addEventListener("cityclick", function (e) { 
	// 修改当前城市显示 
	document.getElementById("curCity").innerHTML = e.name; 
	// 点击后隐藏城市列表 
	document.getElementById("cityList").style.display = "none"; 
}); 
// 给“更换城市”链接添加点击操作 
document.getElementById("curCityText").onclick = function () { 
	var cl = document.getElementById("cityList"); 
	if (cl.style.display == "none") { 
		cl.style.display = ""; 
	} else { 
		cl.style.display = "none"; 
	} 
}; 
// 给城市列表上的关闭按钮添加点击操作 
document.getElementById("popup_close").onclick = function () { 
	var cl = document.getElementById("cityList"); 
	if (cl.style.display == "none") { 
		cl.style.display = ""; 
	} else { 
		cl.style.display = "none"; 
	} 
}; 

map.addEventListener("click", function (e) { 
	document.getElementById("txtlatitude").value = e.point.lat; 
	document.getElementById("txtLongitude").value = e.point.lng; 
	map.clearOverlays(); 

	var pointMarker = new BMap.Point(e.point.lng, e.point.lat); // 创建标注的坐标 
	addMarker(pointMarker); 
	geocodeSearch(pointMarker); 
}); 

function addMarker(point) { 
	var myIcon = new BMap.Icon("mk_icon.png", new BMap.Size(21, 25), 
	{ offset: new BMap.Size(21, 21), 
		imageOffset: new BMap.Size(0, -21) 
	}); 
	var marker = new BMap.Marker(point, { icon: myIcon }); 
	map.addOverlay(marker); 
} 
function geocodeSearch(pt) { 
	var myGeo = new BMap.Geocoder(); 
	myGeo.getLocation(pt, function (rs) { 
		var addComp = rs.addressComponents; 
		document.getElementById("txtAreaCode").value = addComp.province + "," + addComp.city + "," + addComp.district+ "," + addComp.street + ", " + addComp.streetNumber; 
		document.getElementById("curCity").innerHTML=addComp.province;
	}); 
} 

function send_map_back(){
  try{ 
    }catch(e){ 
         } 
} 

///Luchec 2015-9-22
function get_point(){
	var get_lngitude=document.getElementById("txtLongitude").value; //经
	var get_latitude =document.getElementById("txtlatitude").value;//纬
	//alert(get_latitude+","+get_lngitude);
	 return get_latitude+","+get_lngitude;
	
	}
function get_longitude(){
	 return document.getElementById("txtLongitude").value; //经	
	}
function get_latitude(){
	 return document.getElementById("txtlatitude").value;//纬;
	
	}
function get_point_address(){
	var get_address=document.getElementById("txtAreaCode").value; //
	 return get_address;
	}

</script>
<script>
$(function(){
    api = $.dialog.open.api;
    if (!api) return;

    // 操作对话框
    var $txtAreaCode=$('#txtAreaCode');
    var $txtLongitude=$('#txtLongitude');
    var $txtlatitude=$('#txtlatitude');
    api.button(
        {
            name: '确认',
           
            callback: function () {
            	console.log('map=163');
                $.dialog.data('maparea_address', $txtAreaCode.val());
                $.dialog.data('maparea_lng', $txtLongitude.val());
                $.dialog.data('maparea_lat', $txtlatitude.val());
                //$.dialog.close();
                //return false;
            },
            focus: true
        },
        {
            name: '取消'
        }
    );
//    $('.box-table tbody tr').on('click', function(){
//        var $this=$(this);
//        $.dialog.data('service_place_id', $this.attr('data-id'));
//        $.dialog.data('service_place_title', $this.attr('data-title'));
//        $.dialog.close();
//    });
});
</script>