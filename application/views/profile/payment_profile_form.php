									<form id="payment_profile_form" name="payment_profile_form" action="<?php echo base_url();?><?php echo $this->config->item('user_profile_payment_edit_url');?>" method="post">
										<label class="padding_top_7"><?php echo lang('payment_method');?></label>
										<select name="payment_method" id="payment_method" class="styled">
											<option value="1" <?php if(isset($payment_method) && $payment_method==1){ ?> selected="selected" <?php } ?> ><?php echo lang('bank_transfer');?></option>
											<option value="2" <?php if(isset($payment_method) && $payment_method==2){ ?> selected="selected" <?php } ?> ><?php echo lang('paypal');?></option>
										</select>
										<div class="clearfix"></div>
                                        
                                        <div id="paypal_form" <?php if(isset($payment_method) && $payment_method==2){ ?> style="display:block" <?php }else{ ?> style="display:none;" <?php } ?> >
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('paypal_email');?></label>
                                            <span class="suggestion" id="paypal_email_error"><?php echo lang('paypal_email_sugession'); ?></span>
                                            <input type="text" class="input-big" name="paypal_email" id="paypal_email"  value="<?php if(isset($paypal_email)) echo $paypal_email; else echo $profile_details->paypal_email;?>" />
                                            <div class="clearfix"></div>
                                        </div>

										<div id="bank_form" <?php if(isset($payment_method) && $payment_method==2){ ?> style="display:none;" <?php } ?> >
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('bank_name');?></label>
                                            <span class="suggestion" id="bank_name_error"><?php echo lang('bank_name_sugession'); ?></span>
                                            <input type="text" class="input-big" name="bank_name" id="bank_name" value="<?php if(isset($bank_name)) echo $bank_name; else echo $profile_details->bank_name;?>" />
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('bank_swift_code');?></label>
                                            <span class="suggestion" id="swift_code_error"><?php echo lang('swift_code_sugession'); ?></span>
                                            <input type="text" class="input-big" name="swift_code" id="swift_code" value="<?php if(isset($swift_code)) echo $swift_code; else echo $profile_details->swift_code;?>" />
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('bank_code');?></label>
                                            <span class="suggestion" id="bank_code_error"><?php echo lang('bank_code_sugession'); ?></span>
                                            <input type="text" class="input-big" name="bank_code" id="bank_code" value="<?php if(isset($bank_code)) echo $bank_code; else echo $profile_details->bank_code;?>" />
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('benificiary_name');?></label>
                                            <span class="suggestion" id="benificiary_name_error"><?php echo lang('benificiary_name_sugession'); ?></span>
                                            <input type="text" class="input-big" name="benificiary_name" id="benificiary_name" value="<?php if(isset($benificiary_name)) echo $benificiary_name; else echo $profile_details->benificiary_name;?>" />
                                            <div class="clearfix"></div>
                                                
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('iban_code');?></label>
                                            <span class="suggestion" id="iban_code_error"><?php echo lang('iban_code_sugession'); ?></span>
                                            <input type="text" class="input-big" name="iban_number" id="iban_number" value="<?php if(isset($iban_number)) echo $iban_number; else echo $profile_details->IBAN_number;?>" />
                                            <div class="clearfix"></div>
                                                
                                             <label class="padding_top_13 margin_top_22"><?php echo lang('bank_country');?></label>
                                             <span class="suggestion" id="bank_country_error"><?php echo lang('bank_country_sugession'); ?></span>
                                             <input type="text" class="input-big" name="bank_country" id="bank_country" value="<?php if(isset($bank_country)) echo $bank_country; else echo $profile_details->bank_country;?>" />
                                             <div class="clearfix-big"></div>
                                         </div>	
										
                                         <div style="margin-left: 120px; margin-bottom:10px;">
											<div id="hotel_paymentprofile_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
												<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
											</div>
										 </div>	
                                         <input type="submit" class="button medium btn-red" name="save_payment_information" id="save_payment_information" value="<?php echo lang('save');?>" />
									</form>