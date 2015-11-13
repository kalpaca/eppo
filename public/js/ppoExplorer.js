/**
 * Script by Steven Wang
 * PPO Lookup interaction javascript, depends on "jquery.shuffle.modernizr.min.js"
 */
var ppoExplorer = (function($){
	var $ppoContainer = $('#ppo-container'),

	init = function() {

		setupPrimaryCategories();
		setupSecondrayCategories();
		$('.ppo').removeClass('hidden');

		// Setup ShuffleJS, Show nothing at beginning
		$ppoContainer.shuffle({
		    itemSelector: '.ppo',
		    columnThreshold: 0.01,
		    delimeter: ',',
		});
		filterAndDisplay ('nothing');
	},
	// Setup button clicks
	setupPrimaryCategories = function() {

		$('.pri-cat-btn-group').on( 'click', 'button', function() {
			//toggle btn color
			$('.pri-cat-btn').removeClass('btn-primary').addClass('btn-default');
			$('.sec-cat-btn').removeClass('btn-primary').addClass('btn-default');
			$(this).addClass('btn-primary').removeClass('btn-default');

			$('#sec-cat-heading').removeClass('hidden');
			$('#ppo-lead').removeClass('hidden');

			var filter = $(this).attr('data-filter');

			//toggle on secondary cats under current primary cat
			$('.sec-cat-btn-group').addClass('hidden');
			$('#'+filter+'-group').removeClass('hidden');

			if(filter == 'all')
			{
				var numItems = $('.ppo').length;
				var currentCat = 'All Categories';
			}
			else
			{
				var numItems = $('a.'+filter).length;
				var currentCat = filter.replace(/-/g,' ');
			}

			filterAndDisplay (filter,currentCat,numItems);
		});

	},
	// Setup button clicks
	setupSecondrayCategories = function() {

		$('.sec-cat-btn-group').on( 'click', 'button', function() {
			$('.sec-cat-btn').removeClass('btn-primary').addClass('btn-default');
			$(this).addClass('btn-primary').removeClass('btn-default');

			var filter = $(this).attr('data-filter');
			var numItems = $('a.'+filter).length;
			var currentCat = filter.replace(/-/g,' ');

			filterAndDisplay (filter,currentCat,numItems);
		});
	},

	// Filter the regimens and display , fit by rows

	filterAndDisplay = function (filterValue,currentCat,numItems){
		$('#current-cat').html('current category');
		$('#number-of-available').html(numItems);

		$ppoContainer.shuffle('shuffle', filterValue);
	};
	return {
		init: init
	};
}( jQuery ));

$(document).ready(function() {
  ppoExplorer.init();
});

/* was trying to use isotopeJS before

$ppoContainer.isotope({
	filter: filterValue,
    itemSelector : '.ppo-item',
    percentPosition: true,
    layoutMode: 'fitRows',
    fitRows: { gutter: 10 },
    transitionDuration: 0,
});
*/