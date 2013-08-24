$(document).ready(function(){
	
	$('#search_by_offers_hotel_star').each(function() {
		$(this).click(function() {
           $('#search_hotel_form_left').submit();
		});
	});
	
	$('#city').each(function() {
		$(this).blur(function() {
			var v = $.trim($(this).val());
			if(v!=null && v!=""){
				//alert($(this).val());
				$('#search_hotel_form_left').submit();
			}
		});
	});
	
	$('#search_by_hotel_type').each(function() {
		$(this).click(function() {
			$('#search_hotel_form_left').submit();
		});
	});
	
	$('#search_by_hotel_theme').each(function() {
		$(this).click(function() {
			$('#search_hotel_form_left').submit();
		});
	});
	
	$('#search_by_hotel_facility').each(function() {
		$(this).click(function() {
			$('#search_hotel_form_left').submit();
		});
	});
	
	
	$('#search_hotel_form_left').ajaxForm({ beforeSubmit: do_nothing,
		success: function(data) {
								$('#request_info_form_loading').removeClass('search_loading');
								$('#request_info_form_loading').hide();
								$('#all_hotel_lists').html(data);
								}
	});
	
});

function do_nothing(){
	var search_text = $('#city').val();
	search_text = search_text.replace(" ","-");
	var segment = search_text.split(",");
	var country = "any";
	var state = "any";
	var city = "any";
	
	if(search_text.length > 0){
		if(segment.length==3){
			country = segment[2];
			state = segment[1];
			city = segment[0];
		}
		else if(segment.length==2){
			country = segment[1];
			state = segment[0];
			city = "any";
		}
		else if(segment.length==1){
			country = segment[0];
			state = "any";
			city = "any";
		}
	}
	var star_rating = new Array();
	$.each($("input[name='search_by_hotel_star[]']:checked"), function() {
	  star_rating.push($(this).val());
	});
	if(star_rating.length>0)
		var max_star = star_rating[(star_rating.length-1)];
	else
		var max_star = "any";
	
	if(country!="any" && state!="any"){
		//var URL=CI.base_url+"search/hotels/"+country+"/"+state+"/"+city+"/star/"+max_star;
		var URL=CI.base_url+"search/hotels/"+country+"/"+state;
		History.pushState({ path: this.path }, 'url', URL);
	}
	$('#request_info_form_loading').addClass('search_loading');
	$('#request_info_form_loading').show();	
	
    return true;
        
}