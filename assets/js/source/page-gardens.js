jQuery(document).ready(function($) {
	// init isotope
	var $grid = $('.gardens').isotope({
		itemSelector: '.garden',
		layoutMode: 'fitRows'
	});
	// filter functions
	var filterFns = {
		// show if number is greater than 50
		numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		},
		// show if name ends with -ium
		ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
		}
	};
	// bind filter button click
	$('.garden-filters').on( 'click', 'a', function(e) {
		e.preventDefault();
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		filterValue = filterFns[ filterValue ] || filterValue;
		$grid.isotope({ filter: filterValue });
	});
	// change is-checked class on buttons
	$('.garden-filters').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', '.garden-filter a', function() {
			$buttonGroup.find('.filter-active').removeClass('filter-active');
			$( this ).addClass('filter-active');
		});
	});
});
