									<form id="account_invoicing_form" name="account_profile_form" action="<?php echo base_url();?>profile/save_invoicing_profile" method="post">
										
										<div id="account_settings_form">
                                            
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('vat_number');?></label>
                                            <span class="suggestion" id="vat_number_error"><?php echo lang('vat_number_sugession'); ?></span>
                                            <input type="text" class="input-big" name="vat_number" id="vat_number" value="<?php if(isset($vat_number)) echo $vat_number; else echo $profile_details->vat_number;?>" />
                                            <div class="clearfix"></div> 
                                            
                                            
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('legal_name');?></label>
                                            <span class="suggestion" id="legal_name_error"><?php echo lang('legal_name_sugession'); ?></span>
                                            <input type="text" class="input-big" name="legal_name" id="legal_name"  value="<?php if(isset($legal_name)) echo $legal_name; else echo $profile_details->legal_name;?>" />
                                            <div class="clearfix"></div>
    
                                            <label class="padding_top_13"><?php echo lang('email');?></label>
                                            <input type="text" class="input-big" name="invoice_email" id="invoice_email" value="<?php if(isset($invoice_email)) echo $invoice_email; else echo $profile_details->invoice_email;?>" />
                                            <div class="clearfix"></div>
                                            
                                            
                                            <label class="padding_top_13"><?php echo lang('attention');?></label>
                                            <input type="text" class="input-big" name="invoice_attention" id="invoice_attention" value="<?php if(isset($invoice_attention)) echo $invoice_attention; else echo $profile_details->invoice_attention;?>" />
                                            <div class="clearfix"></div>
                                            
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('address_line');?></label>
                                            <span class="suggestion" id="invoice_address_line_error"><?php echo lang('type_hotel_address_line_sugession'); ?></span>
                                            <input type="text" class="input-big" name="invoice_address" id="invoice_address" value="<?php if(isset($invoice_address)) echo $invoice_address; else echo $profile_details->invoice_address;?>" />
                                            <div class="clearfix"></div> 
                                            
                                            <label class="padding_top_13 margin_top_22"><?php echo lang('zip');?></label>
                                            <span class="suggestion" id="invoice_zipcode_error"><?php echo lang('hotel_zip_code_sugession'); ?></span>
                                            <input type="text" class="input-big" name="invoice_zipcode" id="invoice_zipcode" value="<?php if(isset($invoice_zipcode)) echo $invoice_zipcode; else echo $profile_details->invoice_zipcode;?>" />
                                            <div class="clearfix"></div>
                                            
                                            <label class="padding_top_13"><?php echo lang('city');?></label>
                                            <input type="text" class="input-big" name="invoice_city" id="invoice_city" value="<?php if(isset($invoice_city)) echo $invoice_city; else echo $profile_details->invoice_city;?>" />
                                            <div class="clearfix"></div> 
                                            
                                            <label class="padding_top_7"><?php echo lang('country');?></label>
                                            <?php 
                                                    if(isset($invoice_country))
                                                        $selected_country = $invoice_country;
                                                    else
                                                        $selected_country = $profile_details->invoice_country;
                                                    ?>
                                                <select name="invoice_country" id="invoice_country">
                                                    <?php foreach($countries as $key=>$country) { ?>
                                                            <option value="<?php echo $country->country_id;?>" <?php if(isset($selected_country) && $selected_country==$country->country_id){ ?> selected="selected" <?php } ?> ><?php echo $country->country_name;?></option>
                                                    <?php } ?>
                                                </select>
                                            <div class="clearfix"></div> 
                                            
                                            
                                            
                                            
                                            
    									</div>
    									
    									
										
                                         <div style="margin-left: 120px; margin-bottom:10px;">
											<div id="invoice_profile_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
												<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
											</div>
										 </div>	
                                         
                                         <input type="submit" class="button medium btn-red" name="save_invoice_information" id="save_account_information" value="<?php echo lang('save');?>" />
                                         
									</form>