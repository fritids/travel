
var ajax_load = "<img class='loading' src='images/load.gif' alt='loading...' />";
$(document).ready(function(){
	//global vars
	var form = $("#profile_edit_form");
	var form_servizi = $("#profile_edit_form3");
	
	var paymentprofile_form = $("#payment_profile_form");
	var invoiceprofile_form = $("#account_invoicing_form");
	var normal_user_profile = $("#normal_user_profile_edit_form");
	
	var hotel_type = $("#hotel_type");
	var hotel_name = $("#hotel_name");
	var hotel_country = $("#hotel_country");
	var hotel_state = $("#hotel_state_value");
	var hotel_city = $("#hotel_city_value");
	var hotel_town = $("#hotel_town");
	var hotel_address = $("#hotel_address");
	var hotel_zip = $("#hotel_zip");
	var hotel_phone = $("#hotel_phone");
	var hotel_fax = $("#hotel_fax");
	var hotel_website = $("#hotel_website");
	var hotel_description_en = $("#hotel_description_en");
	var hotel_description_it = $("#hotel_description_it");
	var hotel_description_fr = $("#hotel_description_fr");
	var hotel_description_de = $("#hotel_description_de");
	var hotel_description_es = $("#hotel_description_es");
	
	var hotel_activities = $("#hotel_activities");
	
	var payment_method  = $("#payment_method");
	var paypal_email  = $("#paypal_email");
	var bank_name  = $("#bank_name");
	var swift_code  = $("#swift_code");
	var bank_code  = $("#bank_code");
	var benificiary_name  = $("#benificiary_name");
	var iban_number  = $("#iban_number");
	var bank_country  = $("#bank_country");
	
	var vat_number = $("#vat_number");
	var legal_name = $("#legal_name");
	var invoice_email = $("#invoice_email");
	var invoice_attention = $("#invoice_attention");
	var invoice_addressline = $("#invoice_address");
	var invoice_zip = $("#invoice_zipcode");
	var invoice_city = $("#invoice_city");
	
	var first_name = $("#first_name");
	var last_name = $("#last_name");
	var profile_address = $("#profile_address");
	
	var check6 = false;
	
	form.submit(function(){
		var check_result = validate_hotel_profile();
		if(check_result){
			check6= validate_privacy_policy();
			if(check6)
				return true;
			else
				return false;
		}
		else
			return false;
	});
	
	form_servizi.submit(function(){
		var check_result = validate_hotel_profile_servizi();
		if(check_result){
			return true;			
		}
		else
			return false;
	});
	
	paymentprofile_form.submit(function(){
		var selected_payment_method = payment_method.val();
		var check_paypal_email = false;
		var check_bank_information = false;
		if(selected_payment_method == 2 )
			check_paypal_email  = validate_paypal_email();
		else
			check_bank_information  = validate_bank_information();
		
		//alert(selected_payment_method);
		if(check_paypal_email && selected_payment_method == 2)
			return true;
		else if(check_bank_information && selected_payment_method == 1)
			return true;
		else
			return false;
	});
	
	invoiceprofile_form.submit(function(){
		if(validate_invoice_profile()){
			return true;
		}
		else
			return false;
	});
	
	normal_user_profile.submit(function(){
		if(validate_normal_user_profile()){
			return true;
		}
		else
			return false;
	});
	
	function validate_privacy_policy(){
		if($('#accept_privacy_conditions').is(':checked')){
			$('#hotel_profile_error_message').hide();	
			return true;
		}
		else{
			$('#hotel_profile_error_message').show();
			$('#hotel_profile_error_message').text('Please check and accept privacy policy.');
			return false;
		}
			
	}
	
	function validate_normal_user_profile(){
		return_value = true;
		if(first_name.val()==null || first_name.val()==''){
			$("#normal_profile_error_message").show();
			$("#normal_profile_error_message").text('Please input your first name.');
			return_value = false;
		}
		else if(last_name.val()==null || last_name.val()==''){
			$("#normal_profile_error_message").show();
			$("#normal_profile_error_message").text('Please input your last name.');
			return_value = false;
		}
		else if(profile_address.val()==null || profile_address.val()==''){
			$("#normal_profile_error_message").show();
			$("#normal_profile_error_message").text('Please input your address.');
			return_value = false;
		}
		
		return return_value;
	}
	
	function validate_hotel_profile(){
		v_return = true;
		var focus_field;
		
		if(hotel_name.val()==null || hotel_name.val()==''){
			$("#hotel_name_error").css('color','red');
			if(v_return) hotel_name.focus(); 
			v_return = false;
		}
		if(hotel_country.val()==null || hotel_country.val()==""){
			$("#hotel_country_error").css('color','red');
			if(v_return) hotel_country.focus();
			v_return = false;
		}
		if(hotel_state.val()==null || hotel_state.val()==""){
			$("#hotel_country_error").css('color','red');
			if(v_return) $("#hotel_state").focus();
			v_return = false;
		}
		if(hotel_city.val()==null || hotel_city.val()==""){
			$("#hotel_country_error").css('color','red');
			if(v_return) $("#hotel_city").focus();
			v_return = false;
		}
		if(hotel_town.val()==null || hotel_town.val()==""){
			$("#hotel_town_error").css('color','red');
			if(v_return) hotel_town.focus();
			v_return = false;
		}
		if(hotel_address.val()==null || hotel_address.val()==""){
			$("#hotel_address_line_error").css('color','red');
			if(v_return) hotel_address.focus();
			v_return = false;
		}
		if(hotel_zip.val()==null || hotel_zip.val()==''){
			$("#hotel_zipcode_error").css('color','red');
			if(v_return) hotel_zip.focus();
			v_return = false;
		}
		if(hotel_zip.val()!=null && !valid_zip_code(hotel_zip.val())){
			$("#hotel_zipcode_error").css('color','red');
			if(v_return) hotel_zip.focus();
			v_return = false;
		}
		if(hotel_phone.val()==null || hotel_phone.val()==''){
			$("#hotel_phonenumber_error").css('color','red');
			if(v_return) hotel_phone.focus();
			v_return = false;
		}
		if(hotel_phone.val()!=null && !valid_phone_number(hotel_phone.val())){
			$("#hotel_phonenumber_error").css('color','red');
			if(v_return) hotel_phone.focus();
			v_return = false;
		}
		//else{
			//$("#hotel_profile_error_message").hide();
			//$("#hotel_profile_error_message").text('');
			//v_return = true;
		//}
		if(v_return){
			$("#hotel_name_error").css('color','#949494');
			$("#hotel_country_error").css('color','#949494');
			$("#hotel_country_error").css('color','#949494');
			$("#hotel_country_error").css('color','#949494');
			$("#hotel_town_error").css('color','#949494');
			$("#hotel_address_line_error").css('color','#949494');
			$("#hotel_zipcode_error").css('color','#949494');
			$("#hotel_phonenumber_error").css('color','#949494');
			$("#hotel_phonenumber_error").css('color','#949494');
			
		}
		
		return v_return;
	}
	
	function validate_hotel_profile_servizi(){
		v_return = true;
		var focus_field;
		
		var num_of_facilities = parseInt($('#number_of_facilities').val());
		var num_of_themes = parseInt($('#number_of_themes').val());
		var hotel_facilities =  new Array();
		var hotel_themes = new Array();
		for(i=0;i<num_of_facilities;i++){
			var checkbox_id='#hotel_facilities_'+i;
			if($(checkbox_id).is(':checked'))
				hotel_facilities.push($(checkbox_id).val());
		}
		for(i=0;i<num_of_themes;i++){
			var checkbox_id='#hotel_themes_'+i;
			if($(checkbox_id).is(':checked'))
				hotel_themes.push($(checkbox_id).val());
		}
		if(hotel_facilities==null || hotel_facilities==''){
			$("#hotel_services_error").css('color','red');
			if(v_return) $("#hotel_services_error").focus();
			v_return = false;
		}
		else{
			$("#hotel_services_error").css('color','#949494');
			v_return = true;
		}
		
		if(hotel_themes==null || hotel_themes==''){
			$("#hotel_theme_error").css('color','red');
			if(v_return) $("#hotel_theme_error").focus();
			v_return = false;
		}
		else{
			$("#hotel_theme_error").css('color','#949494');
			v_return = true;
		}
		
		return v_return;	
	}
	
	
	function validate_bank_information(){
		var return_value = true;
		if(bank_name.val()==null || bank_name.val()==''){
			$("#bank_name_error").css('color','red');
			if(return_value) bank_name.focus();
			return_value = false;
		}
		if(swift_code.val()==null || swift_code.val()==''){
			$("#swift_code_error").css('color','red');
			if(return_value) swift_code.focus();
			return_value = false;
		}
		if(bank_code.val()==null || bank_code.val()==''){
			$("#bank_code_error").css('color','red');
			if(return_value) bank_code.focus();
			return_value = false;
		}
		if(benificiary_name.val()==null || benificiary_name.val()==''){
			$("#benificiary_name_error").css('color','red');
			if(return_value) benificiary_name.focus();
			return_value = false;
		}
		if(iban_number.val()==null || iban_number.val()==''){
			$("#iban_code_error").css('color','red');
			if(return_value) iban_number.focus();
			return_value = false;
		}
		if(bank_country.val()==null || bank_country.val()==''){
			$("#bank_country_error").css('color','red');
			if(return_value) bank_country.focus();
			return_value = false;
		}
		
		if(return_value)
		{
			$("#bank_name_error").css('color','#949494');
			$("#swift_code_error").css('color','#949494');
			$("#bank_code_error").css('color','#949494');
			$("#benificiary_name_error").css('color','#949494');
			$("#iban_code_error").css('color','#949494');
			$("#bank_country_error").css('color','#949494');
			
			$("#hotel_paymentprofile_error_message").hide();
			$("#hotel_paymentprofile_error_message").text('');
		}
		
		return return_value;
	}
	
	function validate_paypal_email(){
		var return_value = true;
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		if(paypal_email.val()==null || paypal_email.val()==''){
			$("#paypal_email_error").css('color','red');
			if(return_value) paypal_email.focus();
			return_value = false;
		}
		else if(paypal_email.val()!=null && !filter.test(paypal_email.val())){
			$("#paypal_email_error").css('color','red');
			if(return_value) paypal_email.focus();
			return_value = false;
		}
		else{
			$("#paypal_email_error").css('color','#949494');
			
			$("#hotel_paymentprofile_error_message").hide();
			$("#hotel_paymentprofile_error_message").text('');
			return_value = true;
		}
		return return_value;
	}
	
	function validate_invoice_profile(){
		var return_value = true;
		if(vat_number.val()==null || vat_number.val()==''){
			$("#vat_number_error").css('color','red');
			if(return_value) vat_number.focus();
			return_value = false;
		}
		if(legal_name.val()==null || legal_name.val()==''){
			$("#legal_name_error").css('color','red');
			if(return_value) legal_name.focus();
			return_value = false;
		}
		if(invoice_addressline.val()==null || invoice_addressline.val()==''){
			$("#invoice_address_line_error").css('color','red');
			if(return_value) invoice_addressline.focus();
			return_value = false;
		}
		if(invoice_zip.val()==null || invoice_zip.val()==''){
			$("#invoice_zipcode_error").css('color','red');
			if(return_value) invoice_zip.focus();
			return_value = false;
		}
		
		if(return_value)
		{
			$("#vat_number_error").css('color','#949494');
			$("#legal_name_error").css('color','#949494');
			$("#invoice_address_line_error").css('color','#949494');
			$("#invoice_zipcode_error").css('color','#949494');
			
			$("#invoice_profile_error_message").hide();
			$("#invoice_profile_error_message").text('');
		}
		
		return return_value;
	}
	
	
	$('#payment_method').live('change',function(e){
		if($(this).val()==2){
			$('#bank_form').hide();
			$('#paypal_form').show();
		}
		else{
			$('#paypal_form').hide();
			$('#bank_form').show();
		}
	});
	
	
	function isAlphanumeric(inputValue){  
		var regexp = /^[a-zA-Z0-9-_]+$/;
		//alert(inputValue);
		if (inputValue.search(regexp) == -1)
    		return false;
		else
    		return true;
 	}
	
	function valid_zip_code(value){
		var regexp = /^[0-9xX]+$/;
		//alert(inputValue);
		if (value.search(regexp) == -1)
    		return false;
		else
    		return true;
	}
	
	function valid_phone_number(value){
		var regexp = /^[0-9-+]+$/;
		if (value.search(regexp) == -1)
    		return false;
		else
    		return true;
	}
	
	$('#hotel_country').live('change',function(e){
		var url = CI.base_url+"geodata/states/"+$(this).val();
		$('#load_states').load(url);
		$('#load_states').show();
		change_map_country();
	});
	
	$('#hotel_state').live('change',function(e){
		var url = CI.base_url+"geodata/cities/"+$(this).val();
		$('#load_cities').load(url);
		$('#load_cities').show();
		$(this).css('border','solid #bababa 1px;');
		hotel_state.val($(this).val());
		change_map_state();		
	});
	
	$('#hotel_city').live('change',function(e){
		//var url = CI.base_url+"geodata/comune/"+$(this).val();
		//$('#load_cumuni').load(url);
		$(this).css('border','solid #bababa 1px;');
		hotel_city.val($(this).val());
		if($(this).val()=="-1"){}else{change_map_city();}		
	});
	
	/*
	$('#hotel_comune').live('change',function(e){
		hotel_comune.val($(this).val());
		$(this).css('border','solid #bababa 1px;');
		change_map_comune();		
	});
	*/
	
});



function DeleteProfileAvatar(user_id){
		if(user_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"profile/delete_avatar", {
        											user_id: user_id
      											 }, function(response){
													response=$.trim(response);
        											if(response=="1")
													{
														$("#existing_avatar").hide();
													}
													
										}
									);
			
			
			
		}
	}
	
function DeleteHotelProfileAttachment(profileattachment_id){
		if(profileattachment_id.length != 0){
			//name.addClass("error");
			$.post(CI.base_url+"profile/delete_profileattachment", {
        											profileattachment_id: profileattachment_id
      											 }, function(response){
													response=$.trim(response);
        											if(response=="1"){
														var id='#existing_attachment_'+profileattachment_id;
														$(id).hide();
													}
													
										}
									);
			
			
			
		}
	}
	
function toggle_description(lang){
		var div = "#div_hotel_description_"+lang;
		$(div).toggle();
	}
	
function toggle_hotel_activities(lang){
		var div = "#div_hotel_activities_"+lang;
		$(div).toggle();
	}
function toggle_important_information(lang){
		var div = "#div_important_information_"+lang;
		$(div).toggle();
	}	
	


