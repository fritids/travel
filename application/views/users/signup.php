<script type="text/javascript">
	$(function() {
		$('#password').pstrength();
	});
	 var RecaptchaOptions = {
		theme : 'white',
		tabindex : 2
 	};
</script>
<!--  Page Title -->

            <div class="clearfix-bigger"></div>
				

<!-- 960 Container -->
<div class="container">

	<div class="four columns">&nbsp;</div>

	<!-- Project Title -->
	<div class="eight columns background">
		<div class="padding">
				<h1 class="login" style="color:#666;">
                                    <?php 
                                    if(isset($account_type) && $account_type=="2")
                                        echo lang('dd')."Sign up - <strong>Tourist</strong>"; 
                                    else if(isset($account_type) && $account_type=="1")
                                        echo lang('regisster')."Sign up - <strong>Hotel Owner</strong>";
                                    else if(isset($account_type) && $account_type=="3")
                                        echo lang('register')." Sign up - <strong>Tourist Office</strong> ";
                                    else
                                        echo lang('register');
                                    
                                    ?>
                                </h1>
                                     <?php 
                                    if(isset($account_type) && $account_type=="2"){
                                        echo lang('dd')."Already a member? <a href='".base_url()."users/login'>Login</a>"; 
										echo "<br>Are you a hotel owner? <a href='".base_url()."users/signup/hotel-owner/beta'>Sign up</a>";
									}
                                    else if(isset($account_type) && $account_type=="1"){
                                        echo lang('regisster')."Already a member? <a href='".base_url()."users/login'>Login</a>";
										echo "<br>Are you a tourist? <a href='".base_url()."users/signup/tourist'>Sign up</a>";
									}
                                    else if(isset($account_type) && $account_type=="3")
                                        echo lang('register')." as Tourist Office ";
                                    else
                                        echo lang('register');
                                    
                                    ?>
                                    
                            
                                
                                   <div class="clearfix-big"></div>

				<?php echo $this->template->block('RegistrationForm','users/tourist_registration_form.php');?>

            <div class="clearfix"></div>
		</div>
    </div>
    <!-- End Project Title-->
    
                <div class="clearfix-bigger"></div>

</div>
<!-- End 960 Container -->

<?php echo $this->template->block('PrivacyPolicy','users/privacy_policy.php'); ?>

