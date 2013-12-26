<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white',
	tabindex : 2
 };
</script>

            <div class="clearfix-bigger"></div>



<!-- 960 Container -->
<div class="container">

	<div class="four columns">&nbsp;</div>

	<div class="eight columns background">

		<div class="padding">
				<h3 class="login"><?php echo lang('login');?></h3>
					<form id="login" name="login_form" method="post" action="<?php echo base_url();?><?php echo $this->config->item('login_url');?>">
                        
                        
<div class="clearfix-big"></div>

 <a class="btn-facebook" href="<?php echo base_url(); ?><?php echo $this->config->item('facebooklogin_url'); ?>"><?php echo lang('connect_with');?> Facebook</a>
        <a class="btn-twitter" href="<?php echo base_url(); ?><?php echo $this->config->item('twitterlogin_url'); ?>"><?php echo lang('connect_with');?> Twitter</a>
        
	<div class="clearfix-border"></div>
					<div class="clearfix"></div>         									
        									
						<div style="margin-bottom:10px; margin-left: 0px;">
							<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
								<?php if(isset($display_message) && $message!='') echo $message; ?>
							</div>
						</div>
						
                        <span class="suggestion" id="login_username_error">&nbsp;</span>
						<input type="text" placeholder="<?php echo lang('username');?>" class="input-big" name="username_email" id="username_email" value="" />
						<div class="clearfix"></div>


                        <span class="suggestion" id="login_password_error">&nbsp;</span>
						<input type="password" placeholder="<?php echo lang('password');?>" name="password_signup" id="password" class="input-big" value="" />
						<div class="clearfix"></div>
                        
                        <?php if(isset($display_captcha) && $display_captcha=="yes"){ ?>
                         	<label><?php echo lang('verification');?></label>
                   		 	<span class="suggestion"><?php echo lang('human_string'); ?></span>
						 	<?php echo $recaptcha_html; ?>
                            <input type="hidden" name="recaptcha_validate" id="recaptcha_validate" value="yes">
							<div class="clearfix"></div>
                        <?php } ?>
                        
                        <div class="forgot_password" style="margin-bottom: 0px;text-align:left; ">
                        	<a href="<?=base_url();?><?=$this->config->item('passrecover_url');?>"><?php echo lang('forgot_password');?>?</a> / 
                        	<a href="<?php echo base_url(); ?><?php echo $this->config->item('signup_url'); ?>"><?php echo lang('signup');?></a> / 
                        	<a href="<?php echo base_url();?><?php echo $this->config->item('hotel_owner_signup_url'); ?>"><strong>Post your offers</strong></a>

                        </div>
                        
                        <div style="margin-bottom:10px; margin-left: 0px;">
							<div id="login_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
								<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
							</div>
						</div>
						
        								                        	<div class="clearfix"></div>


						<input type="submit" name="signin" id="signin" class="button medium btn-red" value="<?php echo lang('login');?>">
						
									<div class="clearfix"></div>

						  
        		
                    </form>
			</div>

		
			<div class="clearfix-big"></div>
	</div>
	<!-- End Project Title-->
	            <div class="clearfix-bigger"></div>


</div>
<!-- End 960 Container -->


