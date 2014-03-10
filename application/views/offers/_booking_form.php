<script type="text/javascript" src="<?php echo JSPATH;?>jquery.form.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#booking-request-form').ajaxForm({ beforeSubmit: validate_booking_information_form,
		success: function(data){
									$('#request_info_form_loading').removeClass('loading');
									$('#popup_main_content').html(data);
								}
							});
	});
	
	function validate_booking_first_form(){
		var return_val = true;
		if($('#from-booking').val()=="" || $('#from-booking').val()==""){
			$('#from-booking').css('border','solid red 1px');			
			return_val = false;
		}
		if($('#to-booking').val()=="" || $('#to-booking').val()==""){
			$('#to-booking').css('border','solid red 1px');			
			return_val = false;
		}
		if(!validate_booking_policy()){
			return_val = false;
		}
		if(return_val) $('#popup_booking_request').click();
		
		return false;
	}
	
	function validate_booking_policy(){
		if($('#accept_booking_conditions').is(':checked')){
			$('#accept_booking_conditions_error').hide();	
			return true;
		}
		else{
			$('#accept_booking_conditions_error').show();
			$('#accept_booking_conditions_error').text('Please confirm conditions');
			return false;
		}
	}
								
	function validate_booking_information_form(){
		var return_value = true;
		if($('#alternate-from').val()=="" || $('#alternate-from').val()==""){
			$('#alternate-from').css('border','solid red 1px');			
			return_value = false;
		}
		if($('#alternate-to').val()=="" || $('#alternate-to').val()==""){
			$('#alternate-to').css('border','solid red 1px');			
			return_value = false;
		}
		if($('#booking_name').val()=="" || $('#booking_name').val()==""){
			$('#booking_name').css('border','solid red 1px');			
			return_value = false;
		}
		if($('#booking_address').val()=="" || $('#booking_address').val()==""){
			$('#booking_address').css('border','solid red 1px');			
			return_value = false;
		}
		if($('#booking_email').val()=="" || $('#booking_email').val()==""){
			$('#booking_email').css('border','solid red 1px');			
			return_value = false;
		}
		if($('#booking_phone').val()=="" || $('#booking_phone').val()==""){
			$('#booking_phone').css('border','solid red 1px');			
			return_value = false;
		}
		else{
			$('#request_info_form_loading').addClass('loading');
			return_value = true;
		}
		
		return return_value;
	}
</script>	

			<form id="booking-request" action="" onsubmit="return validate_booking_first_form();">
				<div class="clearfix"></div>
				
				<div id="accept_booking_conditions_error" class="error_message"></div>
				
                <label><?php echo lang('checkin');?></label>
                <input type="text" class="text date_picker"  id="from-booking" value="" placeholder="<?php echo lang('checkin');?>" onfocus="$('#from-booking').css('border','solid #bababa 1px');"  />
                <div class="clearfix"></div>

                <label><?php echo lang('checkin');?></label>
                <input type="text" class="text date_picker"  id="to-booking" value="" placeholder="<?php echo lang('checkout');?>" onfocus="$('#to-booking').css('border','solid #bababa 1px');"  />
                <div class="clearfix"></div>
		
                <input type="checkbox" id="accept_booking_conditions" name="accept_booking_conditions" value="1"> Confirm conditions
                <div class="clearfix"></div>
				
				<div>
					<input type="submit" name="submit" id="booking_request_submit" value="<?php echo lang('send_request');?>" class="button medium yellow" style="margin: 0px;">
				</div>
				
				<div id="show_popup_booking_form" style="display:none;">
					<a rel="leanModal" href="#booking" class="button medium yellow" id="popup_booking_request"><?php echo lang('booking_request');?></a>
				</div>
				<div class="clearfix"></div>
				
				
			</form>

			<div id="booking" style="top:100px !important;">
					<div id="signup-ct">
                    <form action="<?php echo base_url();?>offers/bookong_request" method="post" name="booking-request" id="booking-request-form" style="margin:0px; padding:0px;">
						<div id="signup-header">
							<h2 style="margin-top: -2px; margin-bottom: 3px;"><?php echo lang('booking_request');?></h2>
							<p style="margin-top: 3px;"><?php echo lang('booking_request_undertitle');?></p>
							<a class="modal_close" href="#"></a>
						</div>
						<div id="popup_main_content">
                        	<div id="show_inforequest_error_message" class="error_message" style="display: block;"></div>
							
							<div class="left">	
							<div class="clearfix-big"></div>

	                            <label><?php echo lang('checkin');?></label>
	                            <input type="text" class="text date_picker" name="booking_from_date" id="alternate-from" value="Checkin" readonly="readonly" />
	                            <div class="clearfix"></div>
	
	                            <label><?php echo lang('checkin');?></label>
	                            <input type="text" class="text date_picker" name="booking_to_date"  id="alternate-to" value="Checkout" readonly="readonly" />
	                            <div class="clearfix"></div>
			
								<label><?php echo lang('adults');?></label>
								<select class="small" name="booking_adults" id="booking_adults">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
								</select>		
								<div class="clearfix"></div>
	
								<label><?php echo lang('children');?></label>
								<select class="small" name="booking_children" id="booking_children">
										<option>0</option>
	                                    <option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
								</select>		
								<div class="clearfix"></div>
	                            
	                            <label><?php echo lang('name');?></label>
								<input type="text" class="input-big" name="booking_name" id="booking_name" value="" />
								<div class="clearfix"></div>
	
								<label><?php echo lang('address');?></label>
								<input type="text" class="input-big" name="booking_address" id="booking_address" value="" />
								<div class="clearfix"></div>
							</div>
	
							<div class="right">	
								<div class="clearfix-big"></div>
						
	                            <label><?php echo lang('country');?></label>
	                            <input type="text" class="input-big" name="booking_country" id="booking_country" value="" />
	                            <div class="clearfix"></div>
											
								<label>Email</label>
								<input type="text" class="input-big" name="booking_email" id="booking_email"   value="" />
								<div class="clearfix"></div>
	
								<label><?php echo lang('phone');?></label>
								<input type="text" class="input-big" name="booking_phone" id="booking_phone"  value="" />
	 							<div class="clearfix"></div>
		
								<label><?php echo lang('message');?></label>
								<textarea class="input-big" value="" name="booking_message" id="booking_message" /></textarea>
								<div class="clearfix"></div>
								<input type="hidden" id="offer_id" name="offer_id" value="<?php echo $offer_details->offer_id;?>">
								<input type="hidden" id="user_id" name="user_id" value="<?php if(isset($profile_details)) echo $profile_details->user_id; else echo "-1"; ?>">
	                            <input type="submit" name="request_booking" id="request_booking" value="<?php echo lang('send_request');?>" class="button medium btn-red" style="margin-left: 90px;" />
	                            <span id="request_info_form_loading" style="display:block;"></span>
							</div>
						</div>
					</form>
					</div>
				</div>
			