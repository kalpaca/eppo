/**
 * Script by Steven Wang
 * Prescription form interaction javascript
 */
var ppoHelper = (function($){
	/**
	 * initilization
	 */
	var init = function() {

		setupPreloadStates();

		setupDatePicker();

		setupBSACalculator();

		setupIntegerInputFilter();

		setupDecimalInputFilter();

		setupMutualExclusiveBehavior();

		setupAllergiesListener();

		setupSubmissionValidator();
	},

	/**
	 * Toggle
	 *
	 * If allergies radio button toggle, then show allergies textarea
	 *
	 */
	toggleAllergiesInput = function () {
		if ($("#is-allergies").is(":checked"))
		{
			$('#is-allergies-unknown').prop("checked",false);
			$("#allergies-detail").removeClass('hidden');
		}
		else
		{
			$("#allergies-detail").addClass('hidden');
		}
	},
	toggleAllergiesUnknownInput = function () {
		if ($("#is-allergies-unknown").is(":checked"))
		{
			$('#is-allergies').prop("checked",false);
			$("#allergies-detail").addClass('hidden');
		}
	},

	/**
	 *  Validation Toggle
	 *  @Description:
	 *
	 *  1. get the id of the checkbox
	 * 	2. string processing to get the class(area) of this whole drug item. set the class as item-is-selected
	 *  3. if this drug is checked, then remove disabled prop, add class mandatary-field for validation
	 *  4. if this drug is unchecked, then do reverse stuff.
	 *
	 *  @param: get the check box for drug
	 */

	toggleMedFieldsMandatary = function (box) {

		var itemID = $(box).attr("id");
		var pos = itemID.indexOf('_');
		var ppoItemIndex = itemID.substring(0, pos);
		var ppoItem = $('#' + ppoItemIndex);
		if ($(box).is(':checked')) {
			ppoItem.addClass("item-is-selected");
			$('.' + ppoItemIndex + '-input').addClass("mandatary-field").prop('disabled', false);

		} else {
			ppoItem.removeClass("item-is-selected");
			$('.' + ppoItemIndex + '-input').removeClass("mandatary-field").removeClass("mandatary-field-error").prop('disabled', true);
			ppoItem.find('.alert').remove();
		}
	},

	/**
	 * Check prescription pre-load data and make related events happen
	 */
	setupPreloadStates = function(){
		//If allergies toggled 'yes', then show allergies textarea
		toggleAllergiesInput();
		//If ppo-item-checkbox is checked, then toggle its fields as mandatary
		$('.ppo-item-checkbox').each(function() {
			toggleMedFieldsMandatary(this);
		});

	},

	/**
	 * Setup bootstrap datetime picker with only date option
	 */
	setupDatePicker = function(){

		$('.datepicker').datepicker({
			showTodayButton : true,
			showClose: true,
			format : 'MM d, yyyy',
			autoclose: true,
		})
	},

	/**
	 * Listener: calculate bsa based on height and weight
	 */
	setupBSACalculator = function() {

		$('.get-bsa-btn').click(function() {
			if($('#weight').val() && $('#height').val())
			{
				var bsaValue = Math.round(Math.sqrt($('#weight').val() * $('#height').val() / 3600) * 100) / 100;
				if(bsaValue < 0.5 || bsaValue >3.0){
					alert("BSA value should be in the range of 0.5 to 3.0.");
				}

				$('#bsa').val(bsaValue);
				$('.bsa_dose_result').val('');
			}
		});
		$('#height').change(function(e) {
			$('.get-bsa-btn').click();
		});
		$('#weight').change(function(e) {
			$('.get-bsa-btn').click();
		});
	},

	/**
	 * Listener: make sure some fields are 0-9 and dot only, INPUT CONTROL
	 */
	setupIntegerInputFilter = function(){

		$('.integer-field').keydown(function (e) {
		    // Allow: backspace, delete, tab, escape, enter
		    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
		         // Allow: Ctrl+A
		        (e.keyCode == 65 && e.ctrlKey === true) ||
		         // Allow: Ctrl+C
		        (e.keyCode == 67 && e.ctrlKey === true) ||
		         // Allow: Ctrl+X
		        (e.keyCode == 88 && e.ctrlKey === true) ||
		         // Allow: home, end, left, right
		        (e.keyCode >= 35 && e.keyCode <= 39)) {
		             // let it happen, don't do anything
		             return;
		    }
		    // Ensure that it is a number and replace not allow value with 0-9
		    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

		    	e.preventDefault();

		    	alert("Only integers are allowed.")

		    	this.value = this.value.replace(/[^0-9]/g, '');
		    }
		})
	},

	/**
	 * Listener: make sure some fields decimal only
	 */
	setupDecimalInputFilter = function(){

		$('.decimal-field').keydown(function(e) {
		    // Allow: backspace, delete, tab, escape, enter and .(110 & 190)
		    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		         // Allow: Ctrl+A
		        (e.keyCode == 65 && e.ctrlKey === true) ||
		         // Allow: Ctrl+C
		        (e.keyCode == 67 && e.ctrlKey === true) ||
		         // Allow: Ctrl+X
		        (e.keyCode == 88 && e.ctrlKey === true) ||
		         // Allow: home, end, left, right
		        (e.keyCode >= 35 && e.keyCode <= 39)) {
		             // let it happen, don't do anything
		             return;
		    }
		    // Ensure that it is a number and replace not allow value with 0-9.
		    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

		        e.preventDefault();

		        alert("Only numeric input please.")

		        this.value = this.value.replace(/[^0-9.]/g, '');
		    }
		})
	},
	/**
	 * Listener: if checkbox clicked, simulate radio button behavior for each drug block
	 * and call toggleMedFieldsMandatary() function
	 *
	 */
	setupMutualExclusiveBehavior = function(){

		$('.ppo-item-checkbox').change(function() {

			var block = $(this).attr("class").split(' ')[0];

			//a block of durgs with same id that should be mutual exclusive
			if ($(this).is(":checked") && block != 'block-unique') {

				// toggle all durgs off with same drug id(same block)
				$('.' + block).prop("checked", false).each(function() {
					// toggle inputs fields belongs to diabled to this block of drugs

					toggleMedFieldsMandatary(this)
				});

				// toggle this one on, this would not trigger change event, so would not be a dead loop
				$(this).prop("checked", true);

			}

			// toggle other inputs fields diable/enable belongs to this drug not this block
			toggleMedFieldsMandatary(this);
		})
	},

	/**
	 * Listener: If allergies radio button toggle, then show allergies textarea
	 *
	 */
	//
	setupAllergiesListener = function(){

		$("#is-allergies").change(function() {
			toggleAllergiesInput();
		})
		$("#is-allergies-unknown").change(function() {
			toggleAllergiesUnknownInput();
		})
	},
	/**
	 * Listener: form submit javascript valiadation
	 *
	 */
	setupSubmissionValidator = function(){

		$('form').on('submit', function() {
			return checkMandataryFields() && checkIntegerFields();
		})
		/**
		 * all input with "mandatary-field" should not be empty.
		 *
		 * empty space will be add mandatary-field-error class and focused
		 */
		var checkMandataryFields = function () {
			var result = true;

			//before check new errors, check the error is corrected
			$('.mandatary-field-error').each(function() {
				if ($(this).val()) {
					$(this).removeClass("mandatary-field-error");
					var errorID = $(this).attr('id')+'-error';
					$( '#'+errorID ).remove();
				}
			});
			//check errors
			$('.mandatary-field').each(function() {
				if (!$(this).val() && !$(this).is(':disabled')) {
					//  keep focus on new error and no distraction
					$(this).focus();
					// check this has no class .mandatary-field-error so we only attach error message once
					if(!$(this).hasClass("mandatary-field-error"))
					{
						var alert =
						"<span id = '"+$(this).attr('id')+"-error' class='alert alert-danger alert-dismissible' role='alert'>"
							+"!</span>";
						// add error message
						$(this).addClass("mandatary-field-error").after( alert );
					}
					// set result false to prevent form submit
					result = false;
				}
			});
			return result;
		};
		/**
		 * we have already make sure no charaters input.
		 * all input with "integer-field" and not empty should not be empty.
		 *
		 * empty space will be add mandatary-field-error class and focused
		 */
		var checkIntegerFields = function () {
			var result = true;

			// before check new errors, check the error is corrected
			$('.integer-field-error').each(function() {
				var value = $(this).val() - 0;
			    if($.isNumeric(value) && value % 1 === 0){
			       // yes it's an integer.
					$(this).removeClass("integer-field-error");
					var errorID = $(this).attr('id')+'-error';
					$( '#'+errorID ).remove();
			    }

			});
			// check errors
			$('.integer-field').each(function(){
				if(!$(this).is(':disabled'))
				{
					var value = $(this).val() - 0;

				    if($.isNumeric(value) && value % 1 === 0){
				       // yes it's an integer.
				    }
				    else
				    {
				    	$(this).focus();
				    	result = false;
				    	var alert =
						"<span id = '"+$(this).attr('id')+"-error' class='alert alert-danger alert-dismissible' role='alert'>"
							+"!</span>";
				    	if(!$(this).hasClass("integer-field-error"))
				    		$(this).addClass("integer-field-error").after( alert );
				    }
				}

			});
			return result;
		};
	};
	return {
		init: init
	};
}( jQuery ));

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
  	ppoHelper.init();
  	ppoExplorer.init();

  	//respond to click event on anything with 'overlay' class
	$(".ajax-modal-link").click(function(event){
		event.preventDefault();
		//load content from href of link
		$('.modal-body').load($(this).attr("href"),function( response, status, xhr ){
			if ( status == "success" ) {
				$('#myModal').modal();
			}
		});
	});
});


