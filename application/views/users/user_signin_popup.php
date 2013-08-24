<script type="text/javascript" src="<?php echo JSPATH;?>jquery.form.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#existing_member_login_popup').ajaxForm({ beforeSubmit: validate_existing_member_login_popup,
		success: function(data) {
		$('#signin_popup_loading').removeClass('loading');
											response=$.trim(data);
											if(response=="1")
												{
													location.reload(true);
												}
											else
												{
													var popup_signin_Info = $("#popup_signin_Info");
													popup_signin_Info.removeClass("success");
													popup_signin_Info.addClass("error");
													popup_signin_Info.text(data);
													$('#username_email_popup').val("");
													$('#password_signup_popup').val("");
													
												}
											
										}
									});
								});
								
					function validate_existing_member_login_popup()
								{
									if($('#username_email_popup').val()=="" || $('#password_signup_popup').val()=="")
										{
											alert("Input your username and password.");
											return false;
										}
									else
									{
										$('#signin_popup_loading').addClass('loading');
										return true;
									}
								}
</script>								



<div id="user-login-popup">
		<div id="signup-ct">
						<div id="signup-header">
							<h2><?php echo lang('signin_page_title');?></h2>
							<a class="modal_close" href="#"></a>
						</div>
						<div id="popup_main_content">
							<div class="clearfix-big"></div>
							<form class="sign_in_form common_style"  name="existing_member_login" id="existing_member_login_popup"  method="post" action="<?php echo base_url();?>users/popuplogin">
							<p>
								<label for="username_email" class="inlined"><?php echo lang('username_email_string');?></label>
								<input type="text" value="" name="username_email" class="input-big" id="username_email_popup" />
							</p>
							
							<div class="clearfix"></div>
							<p>
								<label for="password_signup" class="inlined"><?php echo lang('password_string');?></label> 
								
								
								<input type="password" value="" name="password_signup" class="input-big" id="password_signup_popup" />
															</p>
														<div class="clearfix"></div>

							<p>
								
							<label class="sign_in_remember" for="sign_in_remember_me">&nbsp;</label>	<input type="checkbox" name="sign_in_remember_me" value="1" id="sign_in_remember_me"> <?php echo lang('remember_me_string');?> / <a href="<?=base_url();?><?=$this->config->item('passrecover_url');?>"><?php echo lang('forgot_it_string');?></a>
								
								
							</p>
																					<div class="clearfix"></div>
														
														<div class="clearfix"></div>
<label class="sign_in_remember" for="sign_in_remember_me">&nbsp;</label>
							<input type="submit" value="Signin" name="signin" id="signin" style="float:left; padding:8px 14px; margin-right:10px;" class="button medium yellow" /> <a href="<?php echo base_url();?><?php echo $this->config->item('signup_url');?>" style="padding:8px 12px;" class="button medium blue">Register</a>	
	
						<div class="clearfix-big"></div>	
					</form>
					</div>
					
									</div>
					</div>
	
					
				