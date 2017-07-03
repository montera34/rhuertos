// WordPress WPMap plugin adaptations
// to this theme
// https://github.com/skotperez/wpmap

(function($) {

	// window load event
	$(window).load(function() {
		resizeMapH('#map');
	});

	// window resize event
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 500);
	});
	$(window).bind("resizeEnd", function() {
		resizeMapH('#map');
	});

	function resizeMapH(mapId) {
		var winH = Number($(window).height());
		var mapMB = Number(18);
		var offset = Number($('#masthead').height() + mapMB );
		var mapH = winH - offset;
		$(mapId).css({height: mapH+'px'});
		map.invalidateSize();
	}

})(jQuery);
