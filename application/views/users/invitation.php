<script type="text/javascript">
	
	function checkusernameinput(){
		var return_var = true;
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		
		if($('#invitation_email').val()==null || $('#invitation_email').val()=="" || !filter.test($('#invitation_email').val())){
			$("#emailInfo").css('color','red');
			if(return_var) $('#invitation_email').focus();
			return_var = false;	
		}
		
		return return_var;
	}
</script>	
<div class="clearfix-bigger"></div>

<!-- 960 Container -->
<div class="container">
	<!-- Project Title -->
		<div class="four columns alpha">		
				&nbsp;
			</div>
			<div class="eight columns background">
			<div class="padding">
				<h3 class="login">Richiedi il codice per l'accesso gratuito</h3>
				<p>Inserisci qui sotto il tuo indirizzo e-mail valido e clicca invia</p>
					<form id="login" method="post" action="<?php echo base_url(); ?><?php echo $this->config->item('invitation_url'); ?>" onsubmit="return checkusernameinput();" >
						
                        <div style="margin-bottom:10px; margin-left: 0px;">
							<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && isset($message) && $message!='') echo "display:block;"; ?>">
								<?php if(isset($display_message) && isset($message) && $message!='') echo $message; ?>
							</div>
						</div>
                        
						<?php if (isset($email_not_registered)) { ?>
								<span class="suggestion error first_signup_visit" id="emailInfo"><?php echo $email_not_registered; ?></span>
						<?php  }else{ ?>
						<?php } ?>
						<input type="text" class="input-big" placeholder="E-mail" value="<?php if(isset($email_address)) echo $email_address;?>" name="invitation_email" id="invitation_email" />
						<div class="clearfix"></div>
						
                        <div style="margin-left: 0px; margin-bottom:15px;">
							<div id="signup_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>"><?php if(isset($display_error) && $error_message!='') echo $error_message; ?></div>
						</div>
						<input type="submit" name="send_invitation_code" id="btn_register" class="button medium yellow" value="<?php echo lang('submit');?>">	
											<a href="<?php echo base_url();?><?php echo $this->config->item('hotel_owner_signup_url'); ?>" class="button medium white"><?php echo lang('goback_to_registration');?></a>
				</form></div>
			</div>
	
			<div class="four columns omega">		
				&nbsp;
			</div>
	
			<div class="clearfix-big"></div>

	</div>
</div>
<!-- End 960 Container -->