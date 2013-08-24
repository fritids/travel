
var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
	//global vars
	var form = $("#add_new_lastminute_offer");
	
	var offer_title = $("#offer_title");
	var offer_duration = $("#offer_duration");
	var offer_availability = $("#offer_availability");
	var offer_start_date = $("#offer_start_date");
	var offer_finish_date = $("#offer_finish_date");
	var offer_end_price = $("#offer_end_price");
	var offer_price_adult = $("#offer_price_adult");
	var offer_price_children = $("#offer_price_children");
	var offer_package_description_en = $("#offer_package_description_en");
	var offer_package_description_it = $("#offer_package_description_it");
	var offer_package_description_fr = $("#offer_package_description_fr");
	var offer_package_description_de = $("#offer_package_description_de");
	var offer_package_description_es = $("#offer_package_description_es");
	
	
	form.submit(function(){
		var check_result = validate_offer_data();
		if(check_result)
			return true;
		else
			return false;
	});
	
	
	function validate_offer_data(){
		v_return = true;
		var num_of_facilities = parseInt($('#number_of_facilities').val());
		var num_of_themes = parseInt($('#number_of_themes').val());
		var num_of_periods = parseInt($('#number_of_periods').val()); 
		var offer_facilities =  new Array();
		var offer_themes = new Array();
		var offer_periods = new Array();
		
		for(i=0;i<num_of_facilities;i++){
			var checkbox_id='#offer_facilities_'+i;
			if($(checkbox_id).is(':checked'))
				offer_facilities.push($(checkbox_id).val());
		}
		for(i=0;i<num_of_themes;i++){
			var checkbox_id='#offer_themes_'+i;
			if($(checkbox_id).is(':checked'))
				offer_themes.push($(checkbox_id).val());
		}
		for(i=0;i<num_of_periods;i++){
			var checkbox_id='#offer_periods_'+i;
			if($(checkbox_id).is(':checked'))
				offer_periods.push($(checkbox_id).val());
		}
		
		if(offer_title.val()==null || offer_title.val()==''){
			$("#offer_title_error").css('color','red');
			if(v_return) offer_title.focus();
			v_return = false;
		}
		if(offer_duration.val()==null || offer_duration.val()==''){
			$("#offer_duration_error").css('color','red');
			if(v_return) offer_duration.focus();
			v_return = false;
		}
		/*
		if(offer_availability.val()==null || offer_availability.val()==''){
			$("#offer_availability_error").css('color','red');
			if(v_return) offer_availability.focus();
			v_return = false;
		}
		*/
		if(offer_start_date.val()==null || offer_start_date.val()==''){
			$("#offer_start_date_error").css('color','red');
			if(v_return) offer_start_date.focus();
			v_return = false;
		}
		if(offer_finish_date.val()==null || offer_finish_date.val()==''){
			$("#offer_finish_date_error").css('color','red');
			if(v_return) offer_finish_date.focus();
			v_return = false;
		}
		/*
		if(offer_end_price.val()==null || offer_end_price.val()==''){
			$("#offer_end_price_error").css('color','red');
			if(v_return) offer_end_price.focus();
			v_return = false;
		}else{
			if(!$.isNumeric(offer_end_price.val())){
				$("#offer_end_price_error").css('color','red');
				if(v_return) offer_end_price.focus();
				v_return = false;
			}	
		}
		*/
		if(offer_price_adult.val()==null || offer_price_adult.val()==''){
			$("#offer_price_adult_error").css('color','red');
			if(v_return) offer_price_adult.focus();
			v_return = false;
		}else{
			if(!$.isNumeric(offer_price_adult.val())){
				$("#offer_price_adult_error").css('color','red');
				if(v_return) offer_price_adult.focus();
				v_return = false;
			}	
		}
		
		if((offer_package_description_en.val()==null || offer_package_description_en.val()=='') &&
				(offer_package_description_it.val()==null || offer_package_description_it.val()=='') &&
				(offer_package_description_fr.val()==null || offer_package_description_fr.val()=='') &&
				(offer_package_description_de.val()==null || offer_package_description_de.val()=='') &&
				(offer_package_description_es.val()==null || offer_package_description_es.val()=='')){
			$("#offer_package_description_error").css('color','red');
			if(v_return) offer_package_description_it.focus();
			v_return = false;
		}
		/*
		if(offer_facilities==null || offer_facilities==''){
			$("#offer_facility_error").css('color','red');
			if(v_return) $("#offer_facility_error").focus();
			v_return = false;
		}
		*/
		if(offer_themes==null || offer_themes==''){
			$("#offer_theme_error").css('color','red');
			if(v_return) $("#offer_theme_error").focus();
			v_return = false;
		}
		if(offer_periods==null || offer_periods==''){
			$("#offer_period_error").css('color','red');
			if(v_return) $("#offer_period_error").focus();
			v_return = false;
		}
		
		//else{
			//$("#add_offer_error_message").hide();
			//$("#add_offer_error_message").text('');
			//v_return = true;
		//}
		
		return v_return;
	}
});

function toggle_offerdescription(lang){
		var div = "#div_offer_description_"+lang;
		$(div).toggle();
	}
	
function DeleteOfferAttachment(offerattachment_id,offer_id){
		if(offerattachment_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"offers/delete_offerattachment", {
        											offerattachment_id: offerattachment_id,
													offer_id: offer_id
      											 }, function(response){
													response=$.trim(response);
        											if(response=="1"){
														var id='#existing_attachment_'+offerattachment_id;
														$(id).hide();
													}
													
										}
									);
			
			
			
		}
	}	