$(function(){
	var $win = $(window);
	var winHeight = $win.height();
	
	var $container = $('.container');
	$container.css('height', winHeight-40);
	//$(".container-left").niceScroll({zindex: '1000'});
        
	var $subnavHd = $('.subnav-hd'), $thisBd;
	$subnavHd.on('click', function(){
		var $this = $(this);
                $thisBd = $this.next('.subnav-bd');
		if($thisBd.is(':visible')){
                        $thisBd.slideUp(200);
			$this.find('i').attr('class', 'fa fa-angle-right');
		}else{
			$thisBd.slideDown(200);
			$this.find('i').attr('class', 'fa fa-angle-down');
		}
	});
        
        var $subnavLink = $('.subnav-bd a');
        $subnavLink.on('click', function(){
            $('.subnav-bd li').removeClass('current');
            $(this).parent().addClass('current');
        });
});