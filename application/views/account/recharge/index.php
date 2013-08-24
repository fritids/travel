<style type="text/css">
	@media only screen and (min-width: 960px) {#portfolio-wrapper img {min-height: 147px;}} 
	@media only screen and (min-width: 768px) and (max-width: 959px) {#portfolio-wrapper img {min-height: 115px;}}
</style>

<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>


<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>
<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">

<div class="four columns">
    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>
</div>
			
			
		
									<div class="twelve columns">	
									
									<?php if(isset($show_payment_notification)) { ?>
						<?php echo $this->template->block('PaymentNotification','payment/payment_notification_in_account.php'); ?>
				<?php } ?>
				
				
							<div class="large-notice notification error background"><h4>
	<?php if($profile_details->account_expiry_date!=NULL ) { ?>
<?php echo lang('your_payment_is_valid_till'); ?>: <?php echo date("d-m-Y", strtotime($profile_details->account_expiry_date));?></h3></div>	<br>
<?php }else{ ?>
<?php echo lang("not_active_membership");?>
<?php } ?></h4>
</div>

									<div class="large-notice background">
				
				<?php if(isset($show_profile_notification)) { ?>
						<?php echo $this->template->block('UserProfileIncompleteNotification','dashboard/_complete_profile_notification.php');?>
				<?php } ?>				
				
                
                <div>
					<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
						<?php if(isset($display_message) && $message!='') echo $message; ?>
					</div>
                    
                    <div id="login_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
						<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
					</div>
				</div>

                
				

				<!-- Tabs Content -->
				<div class="tabs-container">
                    <?php echo $this->template->block('BuyCreditForm','account/recharge/buy_credit_form'); ?>
				</div>
			</div></div>
			<div class="clearfix-big"></div>
		</div>
	</div>
</div>
<!-- End 960 Container -->
