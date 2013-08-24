<div class="clearfix-small"></div>

<div style="margin-bottom:0px;">
	<div id="save_struttura_message" class="success_message"></div>
</div>
                                        
         
										<div id="mapCanvas"></div>
										<div id="infoPanel">
											<div id="info"></div>
											<div class="clearfix-small"></div>
											<div class="notification notice" style="padding:10px;">
												<p><?php echo lang('map_indication');?></p>
											</div>
										</div>
                                        <div class="clearfix-big"></div>
                                        <input type="hidden" id="hotel_address_from_google" name="hotel_address_from_google" value="">
                                        <input type="hidden" id="hotel_country_from_google" name="hotel_country_from_google" value="">
                                        <input type="hidden" id="hotel_latitude_from_google" name="hotel_latitude_from_google" value="">
                                        <input type="hidden" id="hotel_logitude_from_google" name="hotel_logitude_from_google" value="">
                                        <input type="hidden" id="hotel_zoomlevel_from_google" name="hotel_zoomlevel_from_google" value="">
                                        
                                        
                                        <label class="padding_top_7"><?php echo lang('type_of_hotel');?></label>
											<select name="hotel_type" id="hotel_type" class="styled">
												<?php foreach($hotel_types as $hoteltype_key=>$hotel) { ?>
                                                	<option value="<?php echo $hotel->hotel_type_id;?>" <?php if(isset($hotel_type) && $hotel_type==$hotel->hotel_type_id){ ?> selected="selected" <?php } ?> <?php if(isset($profile_details) && $profile_details->hotel_type == $hotel->hotel_type){ ?> selected="selected" <?php } ?> ><?php echo $hotel->hotel_type;?> </option>
                                                <?php } ?>
											</select>
										<div class="clearfix"></div>
                                        
                                        <label><?php echo lang('star_rating');?></label>
                                        	<input class="star required" type="radio" name="hotel_rating" value="1" <?php if(isset($hotel_rating) && $hotel_rating==1 ){ ?> checked="checked" <?php }else if($profile_details->hotel_rating==1) { ?> checked="checked" <?php } ?>  />
                                            <input class="star" type="radio" name="hotel_rating" value="2" <?php if(isset($hotel_rating) && $hotel_rating==2 ){ ?> checked="checked" <?php }else if($profile_details->hotel_rating==2) { ?> checked="checked" <?php } ?>  />
                                            <input class="star" type="radio" name="hotel_rating" value="3" <?php if(isset($hotel_rating) && $hotel_rating==3 ){ ?> checked="checked" <?php }else if($profile_details->hotel_rating==3) { ?> checked="checked" <?php } ?>  />
                                            <input class="star" type="radio" name="hotel_rating" value="4" <?php if(isset($hotel_rating) && $hotel_rating==4 ){ ?> checked="checked" <?php }else if($profile_details->hotel_rating==4) { ?> checked="checked" <?php } ?>  />
                                            <input class="star" type="radio" name="hotel_rating" value="5" <?php if(isset($hotel_rating) && $hotel_rating==5 ){ ?> checked="checked" <?php }else if($profile_details->hotel_rating==5) { ?> checked="checked" <?php } ?>  />
										<div class="clearfix"></div>
                                        <div style="height:15px;"></div>

										<label class="padding_top_13 margin_top_22"><?php echo lang('name_of_hotel');?></label>
                                       	<span class="suggestion" id="hotel_name_error"><?php echo lang('type_hotel_name_sugession'); ?></span>
                                        <input type="text" class="input-big" name="hotel_name" id="hotel_name" value="<?php if(isset($hotel_name)) echo $hotel_name; else echo $profile_details->hotel_name;?>" />
										<div class="clearfix"></div>

										<div>
                                                <label style="margin-top:24px;"><?php echo lang('country');?></label>
                                                <span class="suggestion" id="hotel_country_error"><?php echo lang('select_country_sugession');?></span>
                                                <?php 
                                                    if(isset($hotel_country))
                                                        $selected_country = $hotel_country;
                                                    else
                                                        $selected_country = $profile_details->hotel_country;
                                                ?>
                                                <select name="hotel_country" id="hotel_country">
                                                    <option value=""><?php echo lang('select_country');?></option>
                                                    <?php foreach($countries as $key=>$country) { ?>
                                                            <option value="<?php echo $country->country_id;?>" <?php if(isset($selected_country) && $selected_country==$country->country_id){ ?> selected="selected" <?php } ?> ><?php echo $country->country_name;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="clearfix"></div>
                                                <div id="load_states">
                                                    <?php echo $this->template->block('StateRegion','geodata/states.php');?>
                                                </div>
                                                <div id="load_cities">
                                                    <?php echo $this->template->block('Cities','geodata/cities.php');?>
                                                </div>
                                                
                                                <div id="hotel_city_other_div">
                                                <label class="padding_top_13 margin_top_22"><?php echo lang('town');?></label>
                                                <span class="suggestion" id="hotel_town_error"><?php echo lang('write_town_sugession');?></span>
												<input type="text" class="input-big" name="hotel_town" id="hotel_town" onblur="codeAddress(this.value);"  value="<?php if(isset($hotel_town)) echo $hotel_town; else echo $profile_details->hotel_town;?>" />	
                                                <div class="clearfix"></div>
                                                </div>
                                                <?php 
                                                	if(isset($hotel_state)) $selected_state = $hotel_state; else $selected_state = $profile_details->hotel_state;
													if(isset($hotel_city))	$selected_city = $hotel_city; else $selected_city = $profile_details->hotel_city;
												?>
                                                <input type="hidden" name="hotel_state_value" id="hotel_state_value" value="<?php if(isset($selected_state)) echo $selected_state;?>">
                                                <input type="hidden" name="hotel_city_value" id="hotel_city_value" value="<?php if(isset($selected_city)) echo $selected_city;?>">
                                                <input type="hidden" name="hotel_comune_value" id="hotel_comune_value" value="">
                                                
                                                <!--
                                                <div id="load_cumuni">
                                                    <?php //echo $this->template->block('Comune','geodata/comune.php');?>
                                                </div>
                                                //-->
                                        </div>
                                       
                                        
                                        <label class="padding_top_13 margin_top_22"><?php echo lang('address_line');?></label>
                                        <span class="suggestion" id="hotel_address_line_error"><?php echo lang('type_hotel_address_line_sugession'); ?></span>
        								<input type="text" class="input-big" name="hotel_address" id="hotel_address" onblur="codeAddress(this.value);"  value="<?php if(isset($hotel_address)) echo $hotel_address; else echo $profile_details->hotel_address;?>" />
										<div class="clearfix"></div>

										<label class="padding_top_13 margin_top_22"><?php echo lang('zip');?></label>
                                       	<span class="suggestion" id="hotel_zipcode_error"><?php echo lang('hotel_zip_code_sugession');?></span>
                            			<input type="text" class="input-big" name="hotel_zip" id="hotel_zip" value="<?php if(isset($hotel_zip)) echo $hotel_zip; else echo $profile_details->hotel_zip;?>" />
										<div class="clearfix"></div>
                                        
                                        
                                        
                                        <label class="padding_top_13 margin_top_22"><?php echo lang('phone');?></label>
                                        <span class="suggestion" id="hotel_phonenumber_error"><?php echo lang('type_hotel_phonenumber_sugession'); ?></span>
    									<input type="text" class="input-big" name="hotel_phone" id="hotel_phone" value="<?php if(isset($hotel_phone)) echo $hotel_phone; else echo $profile_details->hotel_phone;?>" />
										<div class="clearfix"></div>
                                        
                                        <label class="margin_top_18"><?php echo lang('fax');?></label>
                                    	<input type="text" class="input-big" name="hotel_fax" id="hotel_fax" value="<?php if(isset($hotel_fax)) echo $hotel_fax; else echo $profile_details->hotel_fax;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('www');?></label>
                                    	<input type="text" class="input-big" name="hotel_website" id="hotel_website" value="<?php if(isset($hotel_website)) echo $hotel_website; else echo $profile_details->hotel_website;?>" />
                                        <div class="clearfix"></div>
                                        
                                        
                                        <div class="clearfix-big"></div>
					                    <label>&nbsp;</label>
										 <input type="checkbox" name="accept_privacy_conditions" id="accept_privacy_conditions" value="1" <?php if((isset($accept_privacy) && $accept_privacy=="1") || (isset($profile_details) && $profile_details->accept_privacy=="1")){ ?> checked="checked" <?php } ?> style="width:30px; margin-left:-5px;"><?php echo lang('i_agree_text');?> <a href="#privacy_policy" rel="leanModal"><?php echo lang('privacy');?> </a>
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
					                    <label>&nbsp;</label>
										 <input type="checkbox" name="send_newsletter" id="send_newsletter" value="1" <?php if ((isset($send_newsletter) && $send_newsletter=="1")|| (isset($profile_details) && $profile_details->send_newsletter=="1")) { ?> checked="checked" <?php } ?> style="width:30px; margin-left:-5px;"> Notify me by e-mail about travelly's offers and news
										<div class="clearfix"></div>
                                    	
                                    	<div style="margin-left: 120px; margin-bottom:10px;">
											<div id="hotel_profile_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
												<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
											</div>
										</div>
							
                                    	 <input type="submit" class="button medium yellow" name="save_profile_data" id="save_profile_data" value="<?php echo lang('save');?>" />
                                        