                                    <form id="account_profile_form" name="account_profile_form" action="<?php echo base_url();?><?php echo $this->config->item('user_profile_account_setting_url');?>" method="post">
										
										<div id="account_settings_form">
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('account_name'); ?></label>
                                            <span class="suggestion" id="full_nameInfo"><?php echo lang('full_name_advice'); ?></span>
                                            <input type="text" class="input-big" name="full_name" id="full_name" value="<?php if(isset($full_name)) echo $full_name; else echo $profile_details->full_name;?>" />
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13"><?php echo lang('username'); ?></label>
                                            <input type="text" class="input-big" name="username" id="username" value="<?php if(isset($username)) echo $username; else echo $profile_details->username;?>" />
                                            <input type="hidden" name="existing_username" id="existing_username" value="<?php echo $profile_details->username;?>">
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13"><?php echo lang('email'); ?></label>
                                            <input type="text" class="input-big" name="email" id="email" readonly="reaadonly" value="<?php if(isset($email_address)) echo $email_address; else echo $profile_details->email;?>" />
                                            <div class="clearfix"></div>
    									</div>
    									
    									<div>
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('old_password'); ?></label>
                                            <span class="suggestion" id="old_pass_info"><?php echo lang('old_password_suggestion'); ?></span>
                                            <input type="password" class="input-big" name="old_password" id="old_password" value="" />
                                            <div class="clearfix"></div>
                                                
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('new_password'); ?></label>
                                            <span class="suggestion" id="new_password_info"><?php echo lang('password_suggestion_strong'); ?></span>
                                            <input type="password" class="input-big" name="new_password" id="new_password" value="" />
                                            <div class="clearfix"></div>
                                                
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('configm_passowrd'); ?></label>
                                            <span class="suggestion" id="confirm_pass_info"><?php echo lang('confirm_password_suggestion'); ?></span>
                                            <input type="password" class="input-big" name="confirm_password" id="confirm_password" value="" />
                                            <div class="clearfix-big"></div>
                                         </div>
                                        
                                         <div style="margin-left: 120px; margin-bottom:10px;">
											<div id="account_profile_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
												<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
											</div>
										 </div>	
                                         
                                         <input type="submit" class="button medium btn-red" name="save_account_information" id="save_account_information" value="<?php echo lang('save'); ?>" style="margin-left:220px;" />
                                         
									</form>