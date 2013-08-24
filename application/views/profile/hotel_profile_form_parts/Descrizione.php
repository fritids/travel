<div class="clearfix-small"></div>

<div style="margin-bottom:0px;">
	<div id="save_descrizione_message" class="success_message"></div>
</div>


<div id="div_hotel_description_en" <?php if(CURRENT_LANGUAGE=="en") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                                    	<label style="margin-top:15px;"><?php echo lang('hotel_description_en');?></label><br>
                                        
                                        	<span class="suggestion" id="hotel_description_error"><?php echo lang('type_hotel_description_sugession_en'); ?></span>
                                    		<textarea class="input-big" name="hotel_description_en" id="hotel_description_en" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_description_en)) echo $hotel_description_en; else if($profile_details->hotel_description_en!="0") echo $profile_details->hotel_description_en;?></textarea>
                                        
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_description_it" <?php if(CURRENT_LANGUAGE=="it") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                                        <label style="margin-top:15px;"><?php echo lang('hotel_description_it');?></label>
                                        	<span class="suggestion" id="hotel_description_error"><?php echo lang('type_hotel_description_sugession_it'); ?></span>
                                    		<textarea class="input-big" name="hotel_description_it" id="hotel_description_it" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_description_it)) echo $hotel_description_it; else if($profile_details->hotel_description_it!="0") echo $profile_details->hotel_description_it;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_description_fr" <?php if(CURRENT_LANGUAGE=="fr") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                                        <label style="margin-top:15px;"><?php echo lang('hotel_description_fr');?></label>
                                        	<span class="suggestion" id="hotel_description_error"><?php echo lang('type_hotel_description_sugession_fr'); ?></span>
                                    		<textarea class="input-big" name="hotel_description_fr" id="hotel_description_fr" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_description_fr)) echo $hotel_description_fr; else if($profile_details->hotel_description_fr!="0") echo $profile_details->hotel_description_fr;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_description_de"  <?php if(CURRENT_LANGUAGE=="de") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                                        <label style="margin-top:15px;"><?php echo lang('hotel_description_de');?></label>
                                        	<span class="suggestion" id="hotel_description_error"><?php echo lang('type_hotel_description_sugession_de'); ?></span>
                                    		<textarea class="input-big" name="hotel_description_de" id="hotel_description_de" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_description_de)) echo $hotel_description_de; else if($profile_details->hotel_description_de!="0") echo $profile_details->hotel_description_de;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_description_es" <?php if(CURRENT_LANGUAGE=="es") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                                        <label style="margin-top:15px;"><?php echo lang('hotel_description_es');?></label>
                                        	<span class="suggestion" id="hotel_description_error"><?php echo lang('type_hotel_description_sugession_es'); ?></span>
                                    		<textarea class="input-big" name="hotel_description_es" id="hotel_description_es" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_description_es)) echo $hotel_description_es; else if($profile_details->hotel_description_es!="0") echo $profile_details->hotel_description_es;?></textarea>    
                                        </div>
                                        
                                        <label style="margin-top:0px !important;">&nbsp;</label>
                                        <span class="language_span"><?php echo lang('input_description_different_language'); ?></span>
                                        <span id="lang_for_inputfield">	
                                            <ul class="site_languag_option">
                                                <?php 
                                                        $languages = $this->config->item('supported_languages');
                                                        if(!empty($languages))
                                                            foreach($languages as $l_key => $l_value ) { 
                                                            if($l_key!=CURRENT_LANGUAGE){
                                                ?>
                                                                <li onclick="toggle_description('<?php echo $l_key;?>');"><img class="flag" src="<?php echo IMAGEPATH; ?>flags/<?php echo $l_key; ?>.png" /></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                            </ul>
                                        </span>
                                        <div class="clearfix-big"></div>		
                                                                    
                                        <div id="div_hotel_activities_en" <?php if(CURRENT_LANGUAGE=="en") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('activities_around_the_hotel_en');?></label>
                                    		<span class="suggestion" id="hotel_activities_error"><?php echo lang('activities_around_the_hotel_sugession_en'); ?></span>
                                        	<textarea class="input-big" name="hotel_activities_en" id="hotel_activities_en" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_activities_en)) echo $hotel_activities_en; else if($profile_details->hotel_activities_en!="0") echo $profile_details->hotel_activities_en;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_activities_it" <?php if(CURRENT_LANGUAGE=="it") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('activities_around_the_hotel_it');?></label>
                                    		<span class="suggestion" id="hotel_activities_error"><?php echo lang('activities_around_the_hotel_sugession_it'); ?></span>
                                        	<textarea class="input-big" name="hotel_activities_it" id="hotel_activities_it" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_activities_it)) echo $hotel_activities_it; else if($profile_details->hotel_activities_it!="0") echo $profile_details->hotel_activities_it;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_activities_fr" <?php if(CURRENT_LANGUAGE=="fr") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('activities_around_the_hotel_fr');?></label>
                                    		<span class="suggestion" id="hotel_activities_error"><?php echo lang('activities_around_the_hotel_sugession_fr'); ?></span>
                                        	<textarea class="input-big" name="hotel_activities_fr" id="hotel_activities_fr" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_activities_fr)) echo $hotel_activities_fr; else if($profile_details->hotel_activities_fr!="0") echo $profile_details->hotel_activities_fr;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_activities_de" <?php if(CURRENT_LANGUAGE=="de") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('activities_around_the_hotel_de');?></label>
                                    		<span class="suggestion" id="hotel_activities_error"><?php echo lang('activities_around_the_hotel_sugession_de'); ?></span>
                                        	<textarea class="input-big" name="hotel_activities_de" id="hotel_activities_de" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_activities_de)) echo $hotel_activities_de; else if($profile_details->hotel_activities_de!="0") echo $profile_details->hotel_activities_de;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_hotel_activities_es" <?php if(CURRENT_LANGUAGE=="es") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('activities_around_the_hotel_es');?></label>
                                    		<span class="suggestion" id="hotel_activities_error"><?php echo lang('activities_around_the_hotel_sugession_es'); ?></span>
                                        	<textarea class="input-big" name="hotel_activities_es" id="hotel_activities_es" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_activities_es)) echo $hotel_activities_es; else if($profile_details->hotel_activities_es!="0") echo $profile_details->hotel_activities_es;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <label style="margin-top:0px !important;">&nbsp;</label>
                                        <span class="language_span"><?php echo lang('input_description_different_language'); ?></span>
                                        <span id="lang_for_inputfield">	
                                            <ul class="site_languag_option">
                                                <?php 
                                                        $languages = $this->config->item('supported_languages');
                                                        if(!empty($languages))
                                                            foreach($languages as $l_key => $l_value ) { 
                                                            if($l_key!=CURRENT_LANGUAGE){
                                                ?>
                                                                <li onclick="toggle_hotel_activities('<?php echo $l_key;?>');"><img class="flag" src="<?php echo IMAGEPATH; ?>flags/<?php echo $l_key; ?>.png" /></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                            </ul>
                                        </span>
                                        <div class="clearfix-big"></div>
                                        
                                        
                                        <div id="div_important_information_en" <?php if(CURRENT_LANGUAGE=="en") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('important_information_en');?></label>
                                        	<span class="suggestion" id="hotel_activities_error"><?php echo lang('important_information_sugession_en'); ?></span>
                                    		<textarea class="input-big" name="hotel_importnat_information_en" id="hotel_importnat_information_en" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_importnat_information_en)) echo $hotel_importnat_information_en; else if($profile_details->important_information_en!="0") echo $profile_details->important_information_en;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_important_information_it" <?php if(CURRENT_LANGUAGE=="it") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('important_information_it');?></label>
                                        	<span class="suggestion" id="hotel_activities_error"><?php echo lang('important_information_sugession_it'); ?></span>
                                    		<textarea class="input-big" name="hotel_importnat_information_it" id="hotel_importnat_information_it" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_importnat_information_it)) echo $hotel_importnat_information_it; else if($profile_details->important_information_it!="0") echo $profile_details->important_information_it;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_important_information_fr" <?php if(CURRENT_LANGUAGE=="fr") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('important_information_fr');?></label>
                                        	<span class="suggestion" id="hotel_activities_error"><?php echo lang('important_information_sugession_fr'); ?></span>
                                    		<textarea class="input-big" name="hotel_importnat_information_fr" id="hotel_importnat_information_fr" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_importnat_information_fr)) echo $hotel_importnat_information_fr; else if($profile_details->important_information_fr!="0") echo $profile_details->important_information_fr;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_important_information_de" <?php if(CURRENT_LANGUAGE=="de") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('important_information_de');?></label>
                                        	<span class="suggestion" id="hotel_activities_error"><?php echo lang('important_information_sugession_de'); ?></span>
                                    		<textarea class="input-big" name="hotel_importnat_information_de" id="hotel_importnat_information_de" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_importnat_information_de)) echo $hotel_importnat_information_de; else if($profile_details->important_information_de!="0") echo $profile_details->important_information_de;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="div_important_information_es" <?php if(CURRENT_LANGUAGE=="es") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?>>
                                        <label style="margin-top:15px;"><?php echo lang('important_information_es');?></label>
                                        	<span class="suggestion" id="hotel_activities_error"><?php echo lang('important_information_sugession_es'); ?></span>
                                    		<textarea class="input-big" name="hotel_importnat_information_es" id="hotel_importnat_information_es" style="margin-bottom:0px; padding-bottom:0px;" /><?php if(isset($hotel_importnat_information_es)) echo $hotel_importnat_information_es; else if($profile_details->important_information_es!="0") echo $profile_details->important_information_es;?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <label style="margin-top:0px !important;">&nbsp;</label>
                                        <span class="language_span"><?php echo lang('input_description_different_language'); ?></span>
                                        <span id="lang_for_inputfield">	
                                            <ul class="site_languag_option">
                                                <?php 
                                                        $languages = $this->config->item('supported_languages');
                                                        if(!empty($languages))
                                                            foreach($languages as $l_key => $l_value ) { 
                                                            if($l_key!=CURRENT_LANGUAGE){
                                                ?>
                                                                <li onclick="toggle_important_information('<?php echo $l_key;?>');"><img class="flag" src="<?php echo IMAGEPATH; ?>flags/<?php echo $l_key; ?>.png" /></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                            </ul>
                                        </span>
                                        <div class="clearfix-big"></div>
                                        
                                         <input type="submit" class="button medium yellow" name="save_profile_data" id="save_profile_data" value="<?php echo lang('save');?>" />
                                         
                                         
                                      