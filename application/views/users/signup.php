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
                                        echo lang('dd')."Registrati su Travelly"; 
                                    else if(isset($account_type) && $account_type=="1")
                                        echo lang('regisster')."Registra la tua <strong>struttura</strong>";
                                    else if(isset($account_type) && $account_type=="3")
                                        echo lang('register')." Tourist Office ";
                                    else
                                        echo lang('register');
                                    
                                    ?>
                                </h1>
                                     <?php 
                                    if(isset($account_type) && $account_type=="2")
                                        echo lang('dd')."Giá registrato? <a href='http://travelly.me/users/login'>Login</a>"; 
                                    else if(isset($account_type) && $account_type=="1")
                                        echo lang('regisster')."Giá registrato? <a href='http://travelly.me/users/login'>Login</a>";
                                    else if(isset($account_type) && $account_type=="3")
                                        echo lang('register')." Tourist Office ";
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

