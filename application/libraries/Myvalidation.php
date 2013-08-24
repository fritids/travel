<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Myvalidation
{
	public $error=array();
	public $data;

    function Myvalidation(){
    	$this->obj =& get_instance();
		$this->obj->load->model('user_model','User');
    }
	
	function validate_fullname(){
		$this->data['full_name']=$this->obj->input->post('full_name');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if(strlen($this->data['full_name']) < 2){
				array_push($this->error,'fullname_length'); 	
		}
			
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_loginusername(){
		$this->data['username']=$this->obj->input->post('signup_username');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if($this->data['username']==''){
			array_push($this->error,'username_blank');
		}
		else{
			if($this->obj->authentication->is_exist_username($this->data['username'])){
				array_push($this->error,'exist_this_username');
			}
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_loginemailaddress(){
		$this->data['email_address']=$this->obj->input->post('email');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if ($this->data['email_address'] == ''){ 		
			array_push($this->error,'email_blank');
		}
		else{
			if(!$this->validEmail($this->data['email_address'])){
				array_push($this->error,'invalid_email');
			}
			else{
				if($this->obj->authentication->is_exist_email($this->data['email_address'])){
					array_push($this->error,'email_already_use');
				}
			}
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_invitation_code(){
		$this->obj->load->model('invitation_model','Invitation');
		$this->data['invitation_code']=$this->obj->input->post('invitation_code');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		if(!$this->obj->Invitation->check_invitation_code($this->data) && 
			$this->data['invitation_code']!="PROMO4FREE2MON" && 
			$this->data['invitation_code']!="PROMOTRAVE" &&
			$this->data['invitation_code']!="RAFFA4FREE2MON" && 
			$this->data['invitation_code']!="NICOL4FREE2MON")
			array_push($this->error,'invalid_invitation_code');
		else
			$this->obj->template->set('invitation_code_is_valid', "true");
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_loginpassword(){
		$this->data['password']=$this->obj->input->post('signup_password');
		$this->data['retyped_password']=$this->obj->input->post('retype_password');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if ($this->data['password'  ] == '' ){
			array_push($this->error,'password_blank'); 		
		}
		else{
			if(strlen($this->data['password']) < 6){
				array_push($this->error,'password_length'); 	
			}
		}
		
		if ($this->data['retyped_password'  ] == ''){
			array_push($this->error,'retyped_password_blank'); 		
		}
		
		if ($this->data['retyped_password'] != $this->data['password']){
			array_push($this->error,'password_not_matched'); 		
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_recaptcha(){
		$privatekey=$this->obj->config->item('recaptcha_private_key');
		$resp =recaptcha_check_answer($privatekey,
                                				$_SERVER["REMOTE_ADDR"],
                                				$_POST["recaptcha_challenge_field"],
                                				$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid){
			array_push($this->error,'recaptcha_error'); 
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
			
	}
	
	function validate_old_password()
	{
		$this->data['old_password']=$this->obj->input->post('old_password');
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if(!$this->obj->user_model->is_valid_old_password($this->data['old_password'],$this->obj->userauthentication->get_loggedin_userid()))
		{
			array_push($this->error,'old_password_invalid'); 	
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	function validate_hotel_profile(){
		$this->data['hotel_type']=$this->obj->input->post('hotel_type');
		$this->data['hotel_rating']=$this->obj->input->post('hotel_rating');
		$this->data['hotel_name']=$this->obj->input->post('hotel_name');
		$this->data['hotel_country']=$this->obj->input->post('hotel_country');
		$this->data['hotel_state']=$this->obj->input->post('hotel_state');
		$this->data['hotel_city']=$this->obj->input->post('hotel_city');
		$this->data['hotel_town']=$this->obj->input->post('hotel_town');		
		$this->data['hotel_address']=$this->obj->input->post('hotel_address');
		$this->data['hotel_zip']=$this->obj->input->post('hotel_zip');		
		$this->data['hotel_phone']=$this->obj->input->post('hotel_phone');
		$this->data['hotel_fax']=$this->obj->input->post('hotel_fax');
		$this->data['hotel_website']=$this->obj->input->post('hotel_website');
		$this->data['hotel_website'] = str_replace("https://www.","",$this->data['hotel_website']);
		$this->data['hotel_website'] = str_replace("http://www.","",$this->data['hotel_website']);
		$this->data['hotel_website'] = str_replace("http://","",$this->data['hotel_website']);
		$this->data['hotel_website'] = str_replace("https://","",$this->data['hotel_website']);
		$this->data['hotel_website'] = "http://www.".$this->data['hotel_website'];
		
		$this->data['hotel_description_en']=$this->obj->input->post('hotel_description_en');
		$this->data['hotel_description_it']=$this->obj->input->post('hotel_description_it');
		$this->data['hotel_description_fr']=$this->obj->input->post('hotel_description_fr');
		$this->data['hotel_description_de']=$this->obj->input->post('hotel_description_de');
		$this->data['hotel_description_es']=$this->obj->input->post('hotel_description_es');
		$this->data['hotel_activities_en']=$this->obj->input->post('hotel_activities_en');
		$this->data['hotel_activities_it']=$this->obj->input->post('hotel_activities_it');
		$this->data['hotel_activities_fr']=$this->obj->input->post('hotel_activities_fr');
		$this->data['hotel_activities_de']=$this->obj->input->post('hotel_activities_de');
		$this->data['hotel_activities_es']=$this->obj->input->post('hotel_activities_es');
		$this->data['hotel_importnat_information_en']=$this->obj->input->post('hotel_importnat_information_en');
		$this->data['hotel_importnat_information_it']=$this->obj->input->post('hotel_importnat_information_it');
		$this->data['hotel_importnat_information_fr']=$this->obj->input->post('hotel_importnat_information_fr');
		$this->data['hotel_importnat_information_de']=$this->obj->input->post('hotel_importnat_information_de');
		$this->data['hotel_importnat_information_es']=$this->obj->input->post('hotel_importnat_information_es');				
		$this->data['hotel_facilities']=$this->obj->input->post('hotel_facilities');
		$this->data['hotel_themes']=$this->obj->input->post('hotel_themes');
		$this->data['nearest_airport_1']=$this->obj->input->post('nearest_airport_1');
		$this->data['nearest_airport_2']=$this->obj->input->post('nearest_airport_2');
		$this->data['nearest_airport_3']=$this->obj->input->post('nearest_airport_3');
		$this->data['nearest_train_station']=$this->obj->input->post('nearest_train_station');
		$this->data['nearest_bus_station']=$this->obj->input->post('nearest_bus_station');
		$this->data['nearest_beach']=$this->obj->input->post('nearest_beach');
		$this->data['nearest_restaurant']=$this->obj->input->post('nearest_restaurant');
		
		$this->data['map_address']=$this->obj->input->post('hotel_address_from_google');
		$this->data['map_latitude']=$this->obj->input->post('hotel_latitude_from_google');
		$this->data['map_longitude']=$this->obj->input->post('hotel_logitude_from_google');
		$this->data['map_zoomlevel']=$this->obj->input->post('hotel_zoomlevel_from_google');
		
		if($this->obj->input->post('accept_privacy_conditions')=="1")
			$this->data['accept_privacy'] ="1";
		else
			$this->data['accept_privacy']="0";
		
		if($this->obj->input->post('send_newsletter')=="1")
			$this->data['send_newsletter'] ="1";
		else
			$this->data['send_newsletter']="0";			
		
		if($this->obj->input->post('send_newsletter')=="1")
			$this->data['send_newsletter']="1";
		else
			$this->data['send_newsletter']="0";
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if($this->data['hotel_name']==''){
			array_push($this->error,'hotel_name_blank');
		}
		if($this->data['hotel_country']==''){
			array_push($this->error,'hotel_country_blank');
		}
		if($this->data['hotel_state']==''){
			array_push($this->error,'hotel_state_blank');
		}
		if($this->data['hotel_city']==''){
			array_push($this->error,'hotel_city_blank');
		}
		if($this->data['hotel_address']==''){
			array_push($this->error,'hotel_address_blank');
		}
		if($this->data['hotel_zip']==''){
			array_push($this->error,'hotel_zip_blank');
		}
		if($this->data['hotel_phone']==''){
			array_push($this->error,'hotel_phone_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_profile_data_descrizione(){
		$this->data['hotel_description_en']=$this->obj->input->post('hotel_description_en');
		$this->data['hotel_description_it']=$this->obj->input->post('hotel_description_it');
		$this->data['hotel_description_fr']=$this->obj->input->post('hotel_description_fr');
		$this->data['hotel_description_de']=$this->obj->input->post('hotel_description_de');
		$this->data['hotel_description_es']=$this->obj->input->post('hotel_description_es');
		$this->data['hotel_activities_en']=$this->obj->input->post('hotel_activities_en');
		$this->data['hotel_activities_it']=$this->obj->input->post('hotel_activities_it');
		$this->data['hotel_activities_fr']=$this->obj->input->post('hotel_activities_fr');
		$this->data['hotel_activities_de']=$this->obj->input->post('hotel_activities_de');
		$this->data['hotel_activities_es']=$this->obj->input->post('hotel_activities_es');
		$this->data['hotel_importnat_information_en']=$this->obj->input->post('hotel_importnat_information_en');
		$this->data['hotel_importnat_information_it']=$this->obj->input->post('hotel_importnat_information_it');
		$this->data['hotel_importnat_information_fr']=$this->obj->input->post('hotel_importnat_information_fr');
		$this->data['hotel_importnat_information_de']=$this->obj->input->post('hotel_importnat_information_de');
		$this->data['hotel_importnat_information_es']=$this->obj->input->post('hotel_importnat_information_es');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		if($this->data['hotel_description_en']=='' &&
			$this->data['hotel_description_it']=='' &&
			$this->data['hotel_description_fr']=='' &&
			$this->data['hotel_description_de']=='' &&
			$this->data['hotel_description_es']==''){
			array_push($this->error,'hotel_description_blank');
		}
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_profile_data_servizi(){
		$this->data['hotel_facilities']=$this->obj->input->post('hotel_facilities');
		$this->data['hotel_themes']=$this->obj->input->post('hotel_themes');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		if($this->data['hotel_facilities']==''){
			array_push($this->error,'hotel_facilities_blank');
		}
		if($this->data['hotel_themes']==''){
			array_push($this->error,'hotel_themes_blank');
		}
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}	
	}
	
	function validate_profile_data_altro(){
		$this->data['nearest_airport_1']=$this->obj->input->post('nearest_airport_1');
		$this->data['nearest_airport_2']=$this->obj->input->post('nearest_airport_2');
		$this->data['nearest_airport_3']=$this->obj->input->post('nearest_airport_3');
		$this->data['nearest_train_station']=$this->obj->input->post('nearest_train_station');
		$this->data['nearest_bus_station']=$this->obj->input->post('nearest_bus_station');
		$this->data['nearest_beach']=$this->obj->input->post('nearest_beach');
		$this->data['nearest_restaurant']=$this->obj->input->post('nearest_restaurant');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}	
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}		
	}
	
	function validate_payment_profile(){
		$this->data['payment_method']=$this->obj->input->post('payment_method');
		$check_paypal_email = false;
		$check_bank_information = false;
		if($this->data['payment_method'] == 2 )
			$check_paypal_email  = $this->validate_payment_profile_paypal();
		else
			$check_bank_information  = $this->validate_payment_profile_bank();
		
		if($check_paypal_email && $selected_payment_method == 2)
			return true;
		else if($check_bank_information && $selected_payment_method == 1)
			return true;
		else
			return false;
	}
	
	function validate_payment_profile_bank(){
		$this->data['bank_name']=$this->obj->input->post('bank_name');
		$this->data['swift_code']=$this->obj->input->post('swift_code');
		$this->data['bank_code']=$this->obj->input->post('bank_code');
		$this->data['benificiary_name']=$this->obj->input->post('benificiary_name');
		$this->data['iban_number']=$this->obj->input->post('iban_number');
		$this->data['bank_country']=$this->obj->input->post('bank_country');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if($this->data['bank_name']==''){
			array_push($this->error,'bank_name_blank');
		}
		if($this->data['swift_code']==''){
			array_push($this->error,'swift_code_blank');
		}
		if($this->data['bank_code']==''){
			array_push($this->error,'bank_code_blank');
		}
		if($this->data['benificiary_name']==''){
			array_push($this->error,'benificiary_name_blank');
		}
		if($this->data['iban_number']==''){
			array_push($this->error,'iban_number_blank');
		}
		if($this->data['bank_country']==''){
			array_push($this->error,'bank_country_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_payment_profile_paypal(){
		$this->data['paypal_email']=$this->obj->input->post('paypal_email');
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if($this->data['paypal_email']==''){
			array_push($this->error,'paypal_email_blank');
		}
		else if($this->data['paypal_email']!='' && !$this->validEmail($this->data['paypal_email'])){
			array_push($this->error,'paypal_email_invalid');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_normal_user_profile(){
		$this->data['gender']=$this->obj->input->post('gender');
		$this->data['first_name']=$this->obj->input->post('first_name');
		$this->data['last_name']=$this->obj->input->post('last_name');
		$this->data['full_name']= $this->data['first_name']." ".$this->data['last_name'];
		$this->data['profile_address']=$this->obj->input->post('profile_address');
		$this->data['profile_zipcode']=$this->obj->input->post('profile_zipcode');
		$this->data['profile_city']=$this->obj->input->post('profile_city');
		$this->data['profile_country']=$this->obj->input->post('profile_country');
		$this->data['profile_phone']=$this->obj->input->post('profile_phone');
		$this->data['profile_fax']=$this->obj->input->post('profile_fax');
		$this->data['hotel_themes']=$this->obj->input->post('hotel_themes');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		if($this->data['first_name']==''){
			array_push($this->error,'first_name_blank');
		}
		if($this->data['last_name']==''){
			array_push($this->error,'last_name_blank');
		}
		if($this->data['profile_address']==''){
			array_push($this->error,'profile_address_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	function validate_offer_data(){
		$this->data['offer_title']=$this->obj->input->post('offer_title');
		$this->data['offer_duration']=$this->obj->input->post('offer_duration');
		$this->data['offer_availability']=$this->obj->input->post('offer_availability');
		$this->data['offer_start_date']=$this->obj->input->post('offer_start_date');
		$this->data['offer_finish_date']=$this->obj->input->post('offer_finish_date');
		$this->data['offer_end_price']=$this->obj->input->post('offer_end_price');
		$this->data['offer_price_adult']=$this->obj->input->post('offer_price_adult');
		$this->data['offer_price_children']=$this->obj->input->post('offer_price_children');
		$this->data['offer_included']=$this->obj->input->post('offer_included');
		
		$this->data['offer_package_description_en']=$this->obj->input->post('offer_package_description_en');
		$this->data['offer_package_description_it']=$this->obj->input->post('offer_package_description_it');
		$this->data['offer_package_description_fr']=$this->obj->input->post('offer_package_description_fr');
		$this->data['offer_package_description_de']=$this->obj->input->post('offer_package_description_de');
		$this->data['offer_package_description_es']=$this->obj->input->post('offer_package_description_es');
		
		$this->data['offer_facilities']=$this->obj->input->post('offer_facilities');
		$this->data['offer_themes']=$this->obj->input->post('offer_themes');
		$this->data['offer_periods']=$this->obj->input->post('offer_periods');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if($this->data['offer_title']==''){
			array_push($this->error,'offer_title_blank');
		}
		if($this->data['offer_duration']==''){
			array_push($this->error,'offer_duration_blank');
		}
		/*
		if($this->data['offer_availability']==''){
			array_push($this->error,'offer_availability_blank');
		}
		*/
		if($this->data['offer_start_date']==''){
			array_push($this->error,'offer_start_date_blank');
		}
		if($this->data['offer_finish_date']==''){
			array_push($this->error,'offer_finish_date_blank');
		}
		if($this->data['offer_price_adult']==''){
			array_push($this->error,'offer_price_adult_blank');
		}
		if(	$this->data['offer_package_description_en']=='' &&
			$this->data['offer_package_description_it']=='' &&
			$this->data['offer_package_description_fr']=='' &&
			$this->data['offer_package_description_de']=='' &&
			$this->data['offer_package_description_es']==''){
			array_push($this->error,'offer_package_description_blank');
		}
		/*
		if($this->data['offer_facilities']=='' || empty($this->data['offer_facilities'])){
			array_push($this->error,'offer_facilities_blank');
		}
		*/
		if($this->data['offer_themes']=='' || empty($this->data['offer_themes'])){
			array_push($this->error,'offer_themes_blank');
		}
		if($this->data['offer_periods']=='' || empty($this->data['offer_periods'])){
			array_push($this->error,'offer_periods_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}
	
	
	function validate_user_settings(){
		$this->data['language']=$this->obj->input->post('user_lang');
		$this->data['timezone']=$this->obj->input->post('timezones');
		$this->data['send_newsletter']=0; if($this->obj->input->post('send_newsletter')) $this->data['send_newsletter']=1;
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if ($this->data['language'] == '')
		{ 		
			array_push($this->error,'language_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
		
	}

	function validate_booking_data(){
		$this->data['booking_checkin'] = $this->obj->input->post('booking_from_date');
		$this->data['booking_checkout'] = $this->obj->input->post('booking_to_date');
		$this->data['booking_adults'] = $this->obj->input->post('booking_adults');
		$this->data['booking_children'] = $this->obj->input->post('booking_children');
		$this->data['booking_name'] = $this->obj->input->post('booking_name');
		$this->data['booking_address'] = $this->obj->input->post('booking_address');
		$this->data['booking_country'] = $this->obj->input->post('booking_country');
		$this->data['booking_email'] = $this->obj->input->post('booking_email');
		$this->data['booking_phone'] = $this->obj->input->post('booking_phone');
		$this->data['booking_message'] = $this->obj->input->post('booking_message');
		$this->data['offer_id'] = $this->obj->input->post('offer_id');
		$this->data['user_id'] = $this->obj->input->post('user_id');
		 
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if ($this->data['booking_checkin'] == ''){ 		
			array_push($this->error,'booking_checkin_blank');
		}
		if ($this->data['booking_checkout'] == ''){ 		
			array_push($this->error,'booking_checkout_blank');
		}
		if ($this->data['booking_adults'] == ''){ 		
			array_push($this->error,'booking_adults_blank');
		}
		if ($this->data['booking_name'] == ''){ 		
			array_push($this->error,'booking_name_blank');
		}
		if ($this->data['booking_address'] == ''){ 		
			array_push($this->error,'booking_address_blank');
		}
		if ($this->data['booking_country'] == ''){ 		
			array_push($this->error,'booking_country_blank');
		}
		if ($this->data['booking_email'] == ''){ 		
			array_push($this->error,'booking_email_blank');
		}
		if ($this->data['booking_phone'] == ''){ 		
			array_push($this->error,'booking_phone_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}

	function validate_invoicing_profile(){
		$this->data['vat_number']=$this->obj->input->post('vat_number');
		$this->data['legal_name']=$this->obj->input->post('legal_name');
		$this->data['invoice_email']=$this->obj->input->post('invoice_email');
		$this->data['invoice_attention']=$this->obj->input->post('invoice_attention');
		$this->data['invoice_address']=$this->obj->input->post('invoice_address');
		$this->data['invoice_zipcode']=$this->obj->input->post('invoice_zipcode');
		$this->data['invoice_city']=$this->obj->input->post('invoice_city');
		$this->data['invoice_country']=$this->obj->input->post('invoice_country');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->set($key, $value);
		}
		
		if ($this->data['vat_number'] == ''){ 		
			array_push($this->error,'vat_number_blank');
		}
		if ($this->data['legal_name'] == ''){
			array_push($this->error,'vat_number_blank');
		}
		if ($this->data['invoice_email'] == ''){
			array_push($this->error,'legal_name_blank');
		}
		if ($this->data['invoice_attention'] == ''){
			array_push($this->error,'invoice_attention_blank');
		}
		if ($this->data['invoice_address'] == ''){
			array_push($this->error,'invoice_address_blank');
		}
		if ($this->data['invoice_zipcode'] == ''){
			array_push($this->error,'invoice_zipcode_blank');
		}
		if ($this->data['invoice_city'] == ''){
			array_push($this->error,'invoice_city_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->set($value, 'true');
		}
	}

	function recaptcha_matches(){
        $this->obj->config->load('recaptcha');
        $public_key = $this->obj->config->item('recaptcha_public_key');
        $private_key = $this->obj->config->item('recaptcha_private_key');
        $response_field = $this->obj->input->post('recaptcha_response_field');
        $challenge_field = $this->obj->input->post('recaptcha_challenge_field');
        $response = recaptcha_check_answer($private_key,
                                           $_SERVER['REMOTE_ADDR'],
                                           $challenge_field,
                                           $response_field);
        if ($response->is_valid){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }	
	
	function validEmail($data, $strict = false){ 
  		$regex = $strict? 
      	'/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' : 
       	'/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' 
  		; 
  		if (preg_match($regex, trim($data), $matches)){ 
    		return array($matches[1], $matches[2]); 
  		} 
		else{ 
    		return false; 
  		} 
	}
	
	function isvalid_match_time($time){
		 return (bool)preg_match("/^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/",$time);
		//return preg_match('^([0-1][0-9]|[2][0-3])(:([0-5][0-9])){1,2}$', $url);
	}
	
	function isValidURL($url){
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
	
}
?>