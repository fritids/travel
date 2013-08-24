<script type="text/javascript">
	$(function() {
		$('#password').pstrength();
	});
</script>	
<div class="clearfix-big"></div>

<!-- 960 Container -->
<div class="container">
	<!-- Project Title -->
	<div class="sixteen columns background">
	
		<div class="padding">
			<div class="ten columns alpha">
				<h2 class="login">Change Your Password</h2>
					<form id="login" method="post" action="">
						
						<label class="register_form">New Password</label>
						<?php if (isset($password_blank) && $password_blank==TRUE) { ?>
								<span class="suggestion error first_signup_visit" id="pass1Info"><?php echo lang('password_suggestion_min'); ?></span>
						<?php  }elseif(isset($password_length) && $password_length==TRUE){ ?>
								<span class="suggestion error first_signup_visit" id="pass1Info"><?php echo lang('password_suggestion_minsix'); ?></span>
						<?php  }else{ ?>
									<?php if (isset($password) && $password==TRUE) { ?>
											<span class="suggestion success" id="emailInfo"><?php echo lang('password_suggestion_ok'); ?></span>
									<?php  }else{ ?>
											<span class="suggestion" id="pass1Info"><?php echo lang('password_suggestion_strong'); ?></span>
									<?php } ?>
						<?php } ?>
						<input type="password" class="input-big" value="" name="signup_password" id="password" maxlength="20" />
						<div class="clearfix"></div>
						
						<label class="padding_top_20">Confirm Password</label>
						<?php if (isset($retyped_password_blank) && $retyped_password_blank==TRUE) { ?>
								<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('confirm_password_suggestion'); ?></span>
						<?php  }elseif(isset($password_not_matched) && $password_not_matched==TRUE){ ?>
								<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('confirm_password_wrong'); ?></span>
						<?php  }else{ ?>
								<span class="suggestion" id="pass2Info"><?php echo lang('confirm_password_suggestion'); ?></span>
						<?php } ?>
						<input type="password" class="input-big" value="" name="retype_password" id="retype_password" maxlength="20" />
						<div class="clearfix"></div>
						
						
	                    
	                    <div style="margin-left: 120px; margin-bottom:10px;">
							<div id="signup_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>"><?php if(isset($display_error) && $error_message!='') echo $error_message; ?></div>
						</div>
						<input type="submit" name="save_settings" id="btn_register" class="button medium yellow" value="Submit">	
								
				</form>
			</div>
	
			<div class="clearfix-big"></div>
		</div>

	</div>
</div>
<!-- End 960 Container -->