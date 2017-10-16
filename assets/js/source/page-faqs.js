jQuery(document).ready(function($) {

	var win = $(window);
//	var hashNow = location.hash;
//	var toAnimate = $('html, body');
	var $header_h = $('#pre').height() + $('#pre-menu').height() + 18;
	var $pos = $header_h;

	// fix right menu when scroll
	win.scroll(function () {
		if (win.scrollTop() <= $pos)
			$('#faqs-nav').css({'position': 'static'});
		else {
			$('#faqs-nav').css({'position': 'fixed', 'top': $pos, 'right': 0});
		}
	});

	// change active element if there is a hash in the url
//	win.load(function() {
//		$("#faqs-nav a[href^='#']").each(
//			function() {
//				hash = this.hash;
//				offset = Number($(this.hash).offset().top);
//				if ( hashNow == hash ) {
//					var active = this;
//					// animate
//					toAnimate.animate({
//						scrollTop: offset
//						}, 300, function(){
//							$(active).parent().addClass('active');
//						}
//					);
//				}
//			}
//		);
//	});

	// change active element when scroll
//	win.scroll(function () {
//		$("#faqs-nav a[href^='#']").each(
//			function() {
//				offset = Number($(this.hash).offset().top) - $pos;
//				if ( win.scrollTop() > offset ) {
//					$('#faqs-nav .active').removeClass('active');
//					$(this).parent().addClass('active');
//				}
//			}
//		);
//	});

	// navbar items click event
//	$(".scroll-smooth a[href^='#']").on('click', function(e) {
//		// prevent default anchor click behavior
//		e.preventDefault();
//
//		// store hash and offset
//		var hash = this.hash;
//		offset = Number($(this.hash).offset().top);
//		var active = $(this);
//
//		// animate
//		toAnimate.animate({
//			scrollTop: offset
//			}, 300, function(){
//				// when done, add hash to url
//				// (default click behaviour)
//				window.location.hash = hash;
//				$('#faqs-nav .active').removeClass('active');
//				active.parent().addClass('active');
//			}
//		);
//	});

});
