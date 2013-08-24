var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
						   
	$('#search_by_state_multiple').each(function() {
		$(this).click(function() {
			var selected_state = new Array();
			$.each($("input[name='search_by_state_multiple[]']:checked"), function() {
			  	selected_state.push($(this).val());
			});	
			var URL=CI.base_url+"offers/italy/"+selected_state;
			window.location=URL;
		});
	});
	
			   
						   
						   
	$('#sort_by').live('change',function(e){
		$('#result_sort_by').val($('#sort_by').val());
		$('#search_offer_form_left').submit();
	});
	
	$('#search_by_offers_hotel_star').each(function() {
		$(this).click(function() {
			$('#search_offer_form_left').submit();
		});
	});
	
	$('#search_by_offers_hotel_type').each(function() {
		$(this).click(function() {
			$('#search_offer_form_left').submit();
		});
	});
	
	$('#search_by_offesr_hotel_theme').each(function() {
		$(this).click(function() {
			$('#search_offer_form_left').submit();
		});
	});
	
	$('#search_by_offesr_period').each(function() {
		$(this).click(function() {
			$('#search_offer_form_left').submit();
		});
	});
	
	$('#search_by_offers_hotel_facility').each(function() {
		$(this).click(function() {
			$('#search_offer_form_left').submit();
		});
	});
	
	$('#search_offer_form_left').ajaxForm({ beforeSubmit: do_nothing,
		success: function(data) {
								$('#request_info_form_loading').removeClass('search_loading');
								$('#request_info_form_loading').hide();
								$('#offer_search_result').html(data);
								}
		});
});

function do_nothing(){
	$('#request_info_form_loading').addClass('search_loading');
	$('#request_info_form_loading').show();
	return true;
}