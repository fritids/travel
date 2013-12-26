<script type="text/javascript">
	 var RecaptchaOptions = {
		theme : 'white',
		tabindex : 2
 	};
	
	function checkusernameinput(){
		var return_var = true;
		
		if($('#recovery_email').val()==null || $('#recovery_email').val()==""){
			$("#emailInfo").css('color','red');
			if(return_var) $('#recovery_email').focus();
			return_var = false;	
		}
		
		return return_var;
	}
</script>	
<div class="clearfix-big"></div>

<!-- 960 Container -->
<div class="container">
	<!-- Project Title -->
		<div class="four columns alpha">		
				&nbsp;
			</div>
			<div class="eight columns background">
			<div class="padding">
				<h2 class="login">Recover Your Password</h2>
					<form id="login" method="post" action="<?php echo base_url(); ?><?php echo $this->config->item('passrecover_url'); ?>" onsubmit="return checkusernameinput();" >
						
						<div style="margin-bottom:10px; margin-left: 120px;">
							<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && isset($message) && $message!='') echo "display:block;"; ?>">
								<?php if(isset($display_message) && isset($message) && $message!='') echo $message; ?>
							</div>
						</div>
						
						<?php if (isset($email_not_registered)) { ?>
								<span class="suggestion error first_signup_visit" id="emailInfo"><?php echo $email_not_registered; ?></span>
						<?php  }else{ ?>
								<span class="suggestion" id="emailInfo"><?php echo lang('email_suggestion_for_recover_pass'); ?></span>
						<?php } ?>
						<input type="text" class="input-big" placeholder="Username / E-mail" value="<?php if(isset($email_address)) echo $email_address;?>" name="recovery_email" id="recovery_email" />
						<div class="clearfix"></div>
						
                        
	                    <?php if (isset($recaptcha_error ) && $recaptcha_error == TRUE) { ?>
								<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('recaptcha_validation_failed'); ?></span>
						<?php  }else{ ?>
								<span class="suggestion"><?php echo lang('human_string'); ?></span>
						<?php } ?>
	                    <?php echo $recaptcha_html; ?>
						<div class="clearfix"></div>
	                    
	                    <div style="margin-left: 120px; margin-bottom:15px;">
							<div id="signup_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>"><?php if(isset($display_error) && $error_message!='') echo $error_message; ?></div>
						</div>
						<input type="submit" name="recovery_email_send" id="btn_register" class="button medium btn-red" value="Submit">	
								
				</form></div>
			</div>
	
			<div class="four columns omega">		
				&nbsp;
			</div>
	
			<div class="clearfix-big"></div>

	</div>
</div>
<!-- End 960 Container -->