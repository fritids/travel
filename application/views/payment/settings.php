<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>


<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>
<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">

<div class="four columns">
    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>			
    
    
    <div id="default-example-info" class="background" data-collapse>
    <h5 class="open"><?php echo lang('information_payment_title_1');?></h5>
    
										                       <div>
																		<?php echo lang('information_payment_description_1');?>
										                       </div> 
										                       
										                       
</div>


			
</div>
			
			
			<div class="twelve columns">
			
			<?php if(isset($show_payment_notification)) { ?>
						<?php echo $this->template->block('PaymentNotification','payment/payment_notification_in_account.php'); ?>
				<?php } ?>
				
				
							<div class="large-notice notification error background"><h4>
	<?php if($profile_details->account_expiry_date!=NULL ) { ?>
<?php echo lang('your_payment_is_valid_till'); ?>: <?php echo date("d-m-Y", strtotime($profile_details->account_expiry_date));?>	                

<?php }else{ ?>
<?php echo lang("not_active_membership");?>
<?php } ?></h4>
</div>                			   <div class="clearfix-small"></div>

<?php if(isset($show_profile_notification)) { ?>
						<?php echo $this->template->block('UserProfileIncompleteNotification','dashboard/_complete_profile_notification.php');?>
				<?php } ?>				
				
                <?php 
					$date1 = date("Y-m-d");
					if(isset($profile_details)) $date2 = $profile_details->account_expiry_date; else $date2 = date("Y-m-d");
					$diff = strtotime($date2) - strtotime($date1);
					if( isset($profile_details) && $diff<0 && $profile_details->request_credit==0){
						echo $this->template->block('PaymentNotification','payment/payment_notification_in_account.php');
					}
					else if($diff>=0 && isset($profile_details) && $profile_details->available_credit==0){
						echo $this->template->block('PaymentNotification','payment/payment_notification_in_account_for_credit.php');
					}
					 
				?>
				
				
                <div>
					<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
						<?php if(isset($display_message) && $message!='') echo $message; ?>
					</div>
                    
                    <div id="login_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
						<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
					</div>
				</div>
				
							<div class="background">

				<ul class="tabs-nav">
				<li class="active"><a href="#tab1">Pagamento</a></li>
				<li><a href="#tab2">Fatture</a></li>
			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">
				<div class="tab-content" id="tab1"><div class="padding">
				                    <?php echo $this->template->block('BuyCreditForm','account/recharge/buy_credit_form'); ?>
				                    <div class="clearfix-small"></div>
</div>
				</div>
						
				<div class="tab-content" id="tab2">
				<div class="padding">
                <?php if($list_of_payments!=NULL) { ?>
                				<div style="width:130px; float:left; display:inline; font-weight:bold;"><?php echo lang('invoice_number');?></div>
                                <div style="width:130px; float:left; display:inline; font-weight:bold;"><?php echo lang('payment_by');?></div>
                                <div style="width:100px; float:left; display:inline; font-weight:bold;"><?php echo lang('price');?> (&euro;)</div>
                                <div style="width:100px; float:left; display:inline; font-weight:bold;">Status</div>
                                <div style="width:150px; float:left; display:inline; font-weight:bold;">&nbsp;</div>
                                <div style="clear:both; height:5px; border-bottom:solid #bababa 2px; margin-bottom:7px;"></div>
                	<?php foreach($list_of_payments as $key=>$payment) { ?>
                    			<div style="width:130px; float:left; display:inline;"><a href="#"><?php echo $payment->invoice_number; ?></a></div>
                                <div style="width:130px; float:left; display:inline;"><?php echo $payment->payment_through; ?></div>
                                <div style="width:100px; float:left; display:inline;"><?php echo $payment->total_amount; ?> &euro;</div>
                                <div style="width:100px; float:left; display:inline;"><?php echo $payment->payment_status; ?></div>
                                <div style="width:150px; float:left; display:inline;">
                                <?php if($payment->payment_through=="Bank Transfer") { ?>
                                	<?php if($payment->invoice_attachment!=NULL || $payment->invoice_attachment!="") { ?>
                                    		<a href="<?php echo base_url(); ?><?php echo BILLS_ATTACHMENT_DOWNLOAD_PATH."/".$payment->user_id."/".$payment->invoice_attachment; ?>">Download Invoice</a>
                                    <?php }else if(($payment->bank_transfer_receipt==NULL || $payment->bank_transfer_receipt=="") && ($payment->payment_status=="Pending"))  { ?>
                                    		<a href="mailto:payments@travelly.me">Email Payment Receipt</a>
                                    <?php } ?>
                                <?php }else{ ?>
                                &nbsp;
                                <?php } ?>
                                </div>
                    <?php } ?>
                <?php } ?>
                			   <div class="clearfix-small"></div>

				</div>
				</div>
			</div>
		
			<div class="clearfix"></div>
		</div>
	</div>
<!-- End 960 Container -->
</div>