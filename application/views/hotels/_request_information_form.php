<script type="text/javascript" src="<?php echo JSPATH;?>jquery.form.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#information-request').ajaxForm({ beforeSubmit: validate_request_information_form,
		success: function(data) {
								$('#request_info_form_loading').removeClass('loading');
											response=$.trim(data);
											if(response=="1"){
													$('#request_information_name').val('');
													$('#request_information_email').val('');
													$('#request_information_phone').val('');
													$('#message').val('');
													$('#show_inforequest_error_message').show();
													$('#show_inforequest_error_message').text('Thanks, We will contact you soon.');
													$('#show_inforequest_error_message').addClass('success_message');
												}
											else{
													$('#show_inforequest_error_message').text('Internal Error. Please Refrash Page.');
													$('#show_inforequest_error_message').addClass('error_message');
												}
										}
									});
								});
								
	function validate_request_information_form(){
		var return_val = true;
		if($('#request_information_name').val()=="" || $('#request_information_name').val()==""){
			$('#request_information_name').css('border','solid red 1px');			
			return_val = false;
		}
		if($('#request_information_email').val()=="" || $('#request_information_email').val()==""){
			$('#request_information_email').css('border','solid red 1px');			
			return_val = false;
		}
		if($('#request_information_phone').val()=="" || $('#request_information_phone').val()==""){
			$('#request_information_phone').css('border','solid red 1px');			
			return_val = false;
		}
		if($('#message').val()=="" || $('#message').val()==""){
			$('#message').css('border','solid red 1px');			
			return_val = false;
		}
		if(!validate_privacy_policy()){
			return_val = false;
		}
		
		return return_val;
	}
	
	function validate_privacy_policy(){
		if($('#accept_privacy_conditions').is(':checked')){
			$('#show_inforequest_error_message').text('');
			$('#show_inforequest_error_message').removeClass('error_message');
			$('#show_inforequest_error_message').hide();
			return true;
		}
		else{
			$('#show_inforequest_error_message').show();
			$('#show_inforequest_error_message').text('Please check and accept privacy policy.');
			$('#show_inforequest_error_message').addClass('error_message');
			return false;
		}
			
	}
</script>	

<form id="information-request" method="post" action="<?php echo base_url();?>hotels/send_request_information">
	<div id="show_inforequest_error_message" class="error_message" style="display: block;"></div>

	<div class="clearfix"></div>
	<label>Name</label>
	<input type="text" class="input-big" value="<?php if(isset($profile_details)) echo $profile_details->display_name;?>" name="request_information_name" id="request_information_name" onfocus="$('#request_information_name').css('border','solid #bababa 1px');" />
				
    <div class="clearfix"></div>
	<label>Email</label>
	<input type="text" class="input-big"   value="<?php if(isset($profile_details)) echo $profile_details->email;?>" name="request_information_email" id="request_information_email" onfocus="$('#request_information_email').css('border','solid #bababa 1px');" />

	<div class="clearfix"></div>
	<label>Phone</label>
	<input type="text" class="input-big"  value="<?php if(isset($profile_details) && $profile_details->phone!=NULL) echo $profile_details->phone;?>" name="request_information_phone" id="request_information_phone" onfocus="$('#request_information_phone').css('border','solid #bababa 1px');" />
	
    <div class="clearfix"></div>
	<label>Message</label>
	<textarea name="message" id="message" style="width:160px;" onfocus="$('#message').css('border','solid #bababa 1px');" ></textarea>
    
    <div class="clearfix"></div>
	<input type="checkbox" name="accept_privacy_conditions" id="accept_privacy_conditions" value="1" style="width:30px; margin-left:-5px;"> I agree to the travelly <a href="#privacy_policy" rel="leanModal">Pricacy Policy</a>
	<div class="clearfix"></div>
    
	<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $hotel_profile_information[0]->user_id;?>">
	<div class="clearfix"></div>
	<input type="hidden" name="requester_id" id="requester_id" value="<?php if(isset($profile_details)) echo $profile_details->user_id; else echo "-1"; ?>">		
	<div class="clearfix-big"></div>

	<input type="submit" name="request_information" id="request_information" value="Information request" class="button medium yellow" style="padding-left: 5px; padding-right: 5px; width: auto;">
	<div class="clearfix"></div>	
	<span id="request_info_form_loading" style="display:block;"></span>
</form>
<?php echo $this->template->block('PrivacyPolicy','users/privacy_policy.php'); ?>