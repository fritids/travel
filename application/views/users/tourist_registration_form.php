<form id="login" method="post" action="">
					<div class="clearfix"></div> 
					<input type="hidden" name="account_type" id="account_type" value="<?php echo $account_type;?>"><!--  Tourist account!-->
					
                    <?php if($invitation_code!=NULL && $account_type=="1" && FALSE) { ?>
                    					<div class="notification red" style="background-color:#efefef;">
                    					<h5 style="margin-bottom:10px;line-height:14px;">Promotion Code: PROMO4FREE2MON<br> (free access for 2 months.)</h5>
                    	<?php if (isset($invalid_invitation_code) && $invalid_invitation_code==TRUE) { ?>
                            <span class="suggestion error first_signup_visit" id="full_nameInfo"><?php echo lang('invalid_invitaiton_code'); ?></span>
                        <?php  }else{ ?>
			<span class="suggestion" id="invitation_codeInfo"></span>

                        <?php } ?>
                        <input type="text" class="input-big" style="width:360px;" placeholder="Promotional Code" value="<?php if(isset($invitation_code) && $invitation_code!="beta") echo $invitation_code;?>" name="invitation_code" id="invitation_code" />
                        <div class="clearfix"></div>
                        <a href="#" class="button medium btn-red">Promotion Code: PROMO4FREE2MON</a><br>
                        <div class="clearfix-small"></div>
                        If you have any problems in registration with promo code,<br>
                        send an e-mail <a href="mailto:support@trip-bangladesh.com">support@trip-bangladesh.com</a>
                        <div class="clearfix-small"></div>

                        </div>  <div class="clearfix-border"></div>
                    <?php } ?>
                    
                    
					
					<?php if (isset($fullname_length) && $fullname_length==TRUE) { ?>
						<span class="suggestion error first_signup_visit" id="full_nameInfo"><?php echo lang('full_name_suggestion'); ?></span>
					<?php  }else{ ?>
						<?php if(isset($full_name)) { ?>
						<span class="suggestion success" id="full_nameInfo"><?php echo lang('full_name_ok'); ?></span>
						<?php  }else{ ?>
						<span class="suggestion" id="full_nameInfo"><?php echo lang('full_name_advice'); ?></span>
						<?php } ?>
					<?php } ?>
					<input type="text" class="input-big" placeholder="<?php echo lang('full_name');?>" value="<?php if(isset($full_name)) echo $full_name;elseif(isset($fb_full_name)) echo $fb_full_name;elseif(isset($tw_full_name)) echo $tw_full_name;?>" name="full_name" id="full_name" />
					<div class="clearfix"></div>
					
					<?php if (isset($username_blank) && $username_blank==TRUE) { ?>
						<span class="suggestion error first_signup_visit" id="usernameInfo"><?php echo lang('username_suggestion_alpha'); ?></span>
					<?php  }elseif(isset($exist_this_username) && $exist_this_username==TRUE){ ?>
						<span class="suggestion error first_signup_visit" id="usernameInfo"><?php echo lang('username_suggestion_used'); ?></span>
					<?php  }else{ ?>
								<?php if (isset($username) && $username==TRUE) { ?>
									<span class="suggestion success" id="usernameInfo"><?php echo lang('username_ok_string'); ?></span>
								<?php  }else{ ?>
									<span class="suggestion" id="usernameInfo"><?php echo lang('username_ok_string'); ?></span>
								<?php } ?>
					<?php } ?>
					<input type="text" class="input-big" placeholder="<?php echo lang('username');?>" value="<?php if(isset($username)) echo $username;elseif(isset($fb_username)) echo $fb_username;elseif(isset($tw_username)) echo $tw_username;?>" name="signup_username" id="username" />
					<div class="clearfix"></div>

					<?php if ((isset($email_blank) && $email_blank==TRUE) or (isset($invalid_email) && $invalid_email==TRUE)) { ?>
							<span class="suggestion error first_signup_visit" id="emailInfo"><?php echo lang('email_suggestion_invalid'); ?></span>
					<?php  }elseif(isset($email_already_use) && $email_already_use==TRUE){ ?>
							<span class="suggestion error first_signup_visit" id="emailInfo"><?php echo lang('email_suggestion_used'); ?><a href="{$baseurl}user/login"><?php echo lang('signin_string'); ?></a></span>
					<?php  }else{ ?>
								<?php if (isset($username) && $username==TRUE) { ?>
									<span class="suggestion success" id="emailInfo"><?php echo lang('email_suggestion_confirmation'); ?></span>
								<?php  }else{ ?>
									<span class="suggestion"  id="emailInfo"><?php echo lang('email_suggestion_add'); ?></span>
								<?php } ?>
					<?php } ?>
					<input type="text" class="input-big" placeholder="<?php echo lang('email');?>" value="<?php if(isset($email_address)) echo $email_address;elseif(isset($fb_email)) echo $fb_email;?>" name="email" id="email" />
					<div class="clearfix"></div>
					
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
					<input type="password" class="input-big" value="" placeholder="<?php echo lang('password');?>" name="signup_password" id="password" maxlength="20" />
					
					<?php if (isset($retyped_password_blank) && $retyped_password_blank==TRUE) { ?>
							<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('confirm_password_suggestion'); ?></span>
					<?php  }elseif(isset($password_not_matched) && $password_not_matched==TRUE){ ?>
							<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('confirm_password_wrong'); ?></span>
					<?php  }else{ ?>
							<span class="suggestion" id="pass2Info"><?php echo lang('confirm_password_suggestion'); ?></span>
					<?php } ?>
					
					
					<input type="password" class="input-big" value="" placeholder="<?php echo lang('configm_passowrd');?>" name="retype_password" id="retype_password" maxlength="20" />
					<div class="clearfix"></div>
                    
					<select name="user_country" id="user_country">
                    	<?php foreach($countries as $key=>$country) { ?>
                        		<option value="<?php echo $country->country_id;?>" <?php if((isset($user_country) && $user_country==$country->country_id) || $country->country_id==$this->config->item('default_country')){ ?> selected="selected" <?php } ?> ><?php echo $country->country_name;?></option>
                        <?php } ?>
                    </select>
					<div class="clearfix"></div>
                    
                    
					<!--
                    <label><?php echo lang('verification');?></label>
                    <?php if (isset($recaptcha_error ) && $recaptcha_error == TRUE) { ?>
							<span class="suggestion error first_signup_visit" id="pass2Info"><?php echo lang('recaptcha_validation_failed'); ?></span>
					<?php  }else{ ?>
							<span class="suggestion"><?php echo lang('human_string'); ?></span>
					<?php } ?>
                    <?php echo $recaptcha_html; ?>
					<div class="clearfix"></div>
                    //-->
                    
                    <div class="clearfix"></div>
					 <input type="checkbox" name="accept_privacy_conditions" id="accept_privacy_conditions" style="width:30px; margin-left:-5px;"> <?php echo lang('i_agree_text');?> <a href="#privacy_policy" rel="leanModal"><?php echo lang('privacy_policy');?></a> and <a href="http://trip-bangladesh.com/terms-and-conditions">Conditions</a>
					<div class="clearfix"></div>
					
					<div class="clearfix"></div>
					<input type="checkbox" name="send_newsletter" id="send_newsletter" value="1" checked="checked" style="width:30px; margin-left:-5px;">  <?php echo lang('notify_me_checkbox_text');?>
					<div class="clearfix"></div>
					
                    
                    <div style="margin-left: 0px; margin-bottom:15px;">
						<div id="signup_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>"><?php if(isset($display_error) && $error_message!='') echo $error_message; ?></div>
					</div>
					
					<?php if(isset($fb_uid)){ ?>
						<input type="hidden" name="fb_uid" id="fb_uid" value="<?php echo $fb_uid;?>">
						<input type="hidden" name="fb_email" id="fb_email" value="<?php echo $fb_email;?>">
						<input type="hidden" name="oauth_provider" id="oauth_provider" value="facebook">
						<input type="hidden" name="fb_oauth_token" id="fb_oauth_token" value="<?php echo $fb_oauth_token;?>">
					<?php } ?>
                    
                    <?php if(isset($tw_oauth_uid)){ ?>
						<input type="hidden" name="tw_oauth_uid" id="fb_uid" value="<?php echo $tw_oauth_uid;?>">
						<input type="hidden" name="tw_twitter_oauth_token" id="fb_email" value="<?php echo $tw_twitter_oauth_token;?>">
						<input type="hidden" name="oauth_provider" id="oauth_provider" value="twitter">
						<input type="hidden" name="tw_twitter_oauth_token_secret" id="tw_twitter_oauth_token_secret" value="<?php echo $tw_twitter_oauth_token_secret;?>">
					<?php } ?>
                    
        			        			<div class="clearfix"></div>
						        									
					<input type="hidden" name="timezone_offset" id="timezone_offset" value="">
					<input type="submit" name="cretae_my_account" id="btn_register" class="button medium btn-red" value="<?php echo lang('register');?>">	
			
</form>