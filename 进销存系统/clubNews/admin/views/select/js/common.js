/////模拟界坱切换
var page_name;
var page_t;
function show_menu_page(page_name,page_t,name_style){
	$("*").removeClass(name_style);
	$(page_name).addClass(name_style);
	$(page_t).parent().find('div').hide();
	$(page_t).show();
	$(page_t).find('div').show();
		
}
