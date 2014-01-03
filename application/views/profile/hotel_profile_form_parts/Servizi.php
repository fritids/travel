<div class="clearfix-small"></div>

<div style="margin-bottom:0px;">
	<div id="save_servizi_message" class="success_message"></div>
</div>

<label class="margin_top_22"><?php echo lang('services');?></label>
                                        <span class="suggestion" id="hotel_services_error"><?php echo lang('set_hotel_services_sugession'); ?></span>
                                        <ul class="facility">
                                           	<?php foreach($services as $service_key=>$service){ ?>
                                           	<li><input type="checkbox" class="checkbox" name="hotel_facilities[]" <?php if(isset($hotel_facilities) && is_array($hotel_facilities) && in_array($service->facility_id,$hotel_facilities)){?> checked="checked" <?php } ?><?php if(!isset($hotel_facilities) && is_array($user_profile_hotel_services) && in_array($service->facility_id,$user_profile_hotel_services)){?> checked="checked" <?php } ?> id="hotel_facilities_<?php echo $service_key; ?>" value="<?php echo $service->facility_id;?>" /> <?php echo $service->facility_name;?></li>
                                           	<?php } ?>
										</ul>
										<input type="hidden" name="number_of_facilities" id="number_of_facilities" value="<?php echo count($services);?>">
                                    	<div class="clearfix-big"></div>
                                                        
                                        <label class="margin_top_22"><?php echo lang('lastminute_theme');?></label>
                                        <span class="suggestion" id="hotel_theme_error"><?php echo lang('set_hotel_theme_sugession'); ?></span>
                                        <ul class="facility">
                                           <?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                                           <li><input type="checkbox" class="checkbox" name="hotel_themes[]" <?php if(isset($hotel_themes) && is_array($hotel_themes) && in_array($LastminuteTheme->lastminutetheme_id,$hotel_themes)){?> checked="checked" <?php } ?><?php if(!isset($hotel_themes) && is_array($user_profile_hotel_themes) && in_array($LastminuteTheme->lastminutetheme_id,$user_profile_hotel_themes)){?> checked="checked" <?php } ?> id="hotel_themes_<?php echo $theme_key; ?>" value="<?php echo $LastminuteTheme->lastminutetheme_id;?>" /> <?php echo $LastminuteTheme->theme_name;?></li>
                                           <?php } ?>
										</ul>
                                    	<input type="hidden" name="number_of_themes" id="number_of_themes" value="<?php echo count($lastminute_themes);?>">
                                    	<div class="clearfix-big"></div>
                                        
                                         <input type="submit" class="button medium btn-red" name="save_profile_data" id="save_profile_data" value="<?php echo lang('save');?>" />