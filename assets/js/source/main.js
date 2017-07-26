(function($) {

	// fix header when scroll down
	var win = $(window);
	var offset = Number($('#ante').height());
	var offsetFixed = Number($('#pre').height());

	win.scroll(function () {
		if ( win.scrollTop() > offset ) {
			$('#pre').addClass('navbar-fixed-top');
			$('#pre-menu').addClass('navbar-fixed-top');
			$('#pre-menu').css({top: offsetFixed+'px'});
			$('#content').css({'padding-top': offsetFixed+'px'});
		} else if ( win.scrollTop() < offset && $('#pre').hasClass('navbar-fixed-top') ) {
			$('#pre').removeClass('navbar-fixed-top');
			$('#pre-menu').removeClass('navbar-fixed-top');
			$('#pre-menu').css({top: '0'});
			$('#content').css({'padding-top': '0'});
		}
	});

})(jQuery);
