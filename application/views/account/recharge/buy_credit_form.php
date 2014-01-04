
			<br>
			
			 <form id="account_profile_form"  name="account_profile_form" action="<?php echo base_url();?><?php echo $this->config->item('subscribe_credit_url');?>" method="post">
										
										<div id="account_settings_form">										
                                            <h4 style="font-weight:normal;"><?php echo lang('credit_amount'); ?></h4>
                                            <input type="hidden" class="input-big" name="credit_amount" id="credit_amount" title="Write Your Full Name" readonly="readonly"  value="10" />
    <div class="clearfix-big"></div>
                                           	<h3><?php echo lang('payment_methods'); ?></h3>
                                           	<?php echo lang('payment_info_paypal'); ?><br><br>
                                            <!-- 
                                            <div class="clearfix"></div>
                                           	<input type="radio" name="payment_methods" id="payment_methods" value="paypal" style="width:20px;" checked="checked"><?php echo lang('paypal'); ?>
                                            //-->
                                            <div class="clearfix"></div>
                                            <input type="radio" name="payment_methods" id="payment_methods" checked="checked" value="bank_transfer" style="width:20px;"><?php echo lang('bank_transfer'); ?>
                                            <div class="clearfix-big"></div>
    
					<input type="submit" class="button medium btn-red" name="buy_credit_for_account" id="save_account_information" value="<?php echo lang('procced_payment'); ?>" />

    									</div>
    									
                                         
									</form>
