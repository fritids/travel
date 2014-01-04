<script type="text/javascript">
    $(function() {
        $( "#offer_start_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            onSelect: function( selectedDate ) {
                $( "#offer_finish_date" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#offer_finish_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',
            onSelect: function( selectedDate ) {
                $( "#offer_start_date" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
	
	$(document).ready(function() {
		$("#offer_price_adult").keydown(function(event) {
			// Allow: backspace, delete, tab, escape, and enter
			if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
				 // Allow: Ctrl+A
				(event.keyCode == 65 && event.ctrlKey === true) || 
				 // Allow: home, end, left, right
				(event.keyCode >= 35 && event.keyCode <= 39)) {
					 // let it happen, don't do anything
					 return;
			}
			else {
				// Ensure that it is a number and stop the keypress
				if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
					event.preventDefault(); 
				}   
			}
		});
	});
	
	$(document).ready(function() {
		$("#offer_price_children").keydown(function(event) {
			// Allow: backspace, delete, tab, escape, and enter
			if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
				 // Allow: Ctrl+A
				(event.keyCode == 65 && event.ctrlKey === true) || 
				 // Allow: home, end, left, right
				(event.keyCode >= 35 && event.keyCode <= 39)) {
					 // let it happen, don't do anything
					 return;
			}
			else {
				// Ensure that it is a number and stop the keypress
				if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
					event.preventDefault(); 
				}   
			}
		});
	});
</script>
<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>

<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">

<div class="four columns background">

			<div id="default-example-info" data-collapse>
										                        <h5 class="open"><?php echo lang('information_offer_title_1');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_1');?>

										                       </div> 
										                       
										                       <h5><?php echo lang('information_offer_title_2');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_2');?>

										                       </div> 
										                       
										                       <h5><?php echo lang('information_offer_title_3');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_3');?>

										                       </div> 
										                       
										                       <h5><?php echo lang('information_offer_title_4');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_4');?>

										                       </div> 
										                       
										                       
										                          <h5><?php echo lang('information_offer_title_5');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_5');?>

										                       </div> 
										                          <h5><?php echo lang('information_offer_title_6');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_6');?>

										                       </div> 
										                       
										                          <h5><?php echo lang('information_offer_title_7');?></h5>
										                       <div>
										                       			<?php echo lang('information_offer_description_7');?>

										                       </div> 

										                       </div>
			       </div>			       
			       			

			
			
									<div class="twelve columns background">
					
						<div class="padding">

				<form id="add_new_lastminute_offer" name="add_new_lastminute_offer" method="post" action="" enctype="multipart/form-data">
										<div class="notification red">
			<h3><?php echo lang('add-offer');?></h3>
<div class="clearfix-big"></div>
                    <label class="padding_top_13"><?php echo lang('offer_title');?></label>
                    <span id="offer_title_error" class="suggestion first_signup_visit"><?php echo lang('offer_title_suggestion');?></span>
					<input type="text" name="offer_title" id="offer_title" class="input-big" value="" />
					<div class="clearfix"></div>
	
					<label class="padding_top_13"><?php echo lang('duration_time');?></label>
                    <span id="offer_duration_error" class="suggestion first_signup_visit"><?php echo lang('duration_time_suggesion');?></span>
                    <?php $options = lang('duration_time_options');?> 
                    <select name="offer_duration" id="offer_duration" style="width: 205px !important;">
                    	<?php foreach($options as $key=>$value) { ?>
                        	<option value="<?php echo $value;?>" ><?php echo $value;?></option>
                        <?php } ?>
                    </select>
					<div class="clearfix"></div>
	
					<div style="display:none;">
                    <label class="padding_top_13"><?php echo lang('availability');?></label>
                    <span id="offer_availability_error" class="suggestion first_signup_visit">Please Input Offer Availability.</span>
					<input type="text" name="offer_availability" id="offer_availability" class="input-big"  value="" />
					<div class="clearfix"></div>
					</div>
                    	
					<label class="padding_top_13"><?php echo lang('start_date'); ?></label>
					<span id="offer_start_date_error" class="suggestion first_signup_visit"><?php echo lang('start_date_sugession'); ?></span>
					<input type="text" name="offer_start_date" id="offer_start_date" class="input-big text date_picker" value="" />
					<div class="clearfix"></div>
	
					<label class="padding_top_13"><?php echo lang('finish_date'); ?></label>
                    <span id="offer_finish_date_error" class="suggestion first_signup_visit"><?php echo lang('finish_date_sugession');?></span>
					<input type="text" name="offer_finish_date" id="offer_finish_date" class="input-big text date_picker" value="" />
					<div class="clearfix"></div>
					</div>
					<div class="notification blue">
					
					<label class="padding_top_7"><?php echo lang('offer_includes');?></label>
					<select name="offer_included" id="offer_included">
                    	<?php if(!empty($offer_include_options) && is_array($offer_include_options))
								foreach($offer_include_options as $oip_key=>$option){ ?>
									<option value="<?php echo $option->offerincludeoption_id;?>"><?php echo $option->offerinclude_option;?></option>
                    	<?php 	} ?>
                    </select>
					<div class="clearfix"></div>
                    
                    <div style="display:none;">
					<label class="padding_top_13"><?php echo lang('end_price');?> </label>
                    <span id="offer_end_price_error" class="suggestion first_signup_visit"><?php echo lang('end_price_sugession');?></span>
                    <input type="text" name="offer_end_price" id="offer_end_price" class="input-big"  value="" />
					<div class="clearfix"></div>
					</div>
                    
					<label class="padding_top_13"><?php echo lang('price_adult');?> TK.<br><span style="font-size:11px;line-height:11px;">Price example: 1999 (no TK,.)</span></label>
                    <span id="offer_price_adult_error" class="suggestion first_signup_visit"><?php echo lang('price_adult_sugession');?></span>
					<input type="text" name="offer_price_adult" id="offer_price_adult" class="input-big"  value="" />
					<div class="clearfix"></div>
	
					<label class="padding_top_13"><?php echo lang('price_children');?> TK.<br><span style="font-size:11px;line-height:11px;">Price example: 1999 (no TK,.)</span></label>
					<span id="offer_price_adult_error" class="suggestion first_signup_visit"><?php echo lang('price_children_sugession');?></span>
					<input type="text" name="offer_price_children" id="offer_price_children" class="input-big"  value="" /><br>
					<div class="clearfix"></div>
					
                    
                    </div>
                    
                    										<div class="notification red">
                    

					<div id="div_offer_description_it" <?php if(CURRENT_LANGUAGE=="it") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                    <label><?php echo lang('package_description_it');?></label>
                    	<?php if(CURRENT_LANGUAGE=="it") { ?> <span id="offer_package_description_error" class="suggestion first_signup_visit"><?php echo lang('package_description_sugession');?></span> <?php } ?>
						<textarea class="input-big" name="offer_package_description_it" id="offer_package_description_it" style="margin:0px; padding:0px;"/></textarea>
                   
                    
                    </div>
                    
                    <div class="clearfix"></div>
                    <div id="div_offer_description_en" <?php if(CURRENT_LANGUAGE=="en") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                    <label><?php echo lang('package_description_en');?></label>
                    		<?php if(CURRENT_LANGUAGE=="en") { ?> <span id="offer_package_description_error" class="suggestion first_signup_visit"><?php echo lang('package_description_sugession');?></span> <?php } ?>
							<textarea class="input-big" name="offer_package_description_en" id="offer_package_description_en" style="margin:0px; padding:0px;"/></textarea>
                    	
                    </div>
                    
                    <div class="clearfix"></div>
                    <div id="div_offer_description_fr" <?php if(CURRENT_LANGUAGE=="fr") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                    <label><?php echo lang('package_description_fr');?></label>
							<?php if(CURRENT_LANGUAGE=="fr") { ?> <span id="offer_package_description_error" class="suggestion first_signup_visit"><?php echo lang('package_description_sugession');?></span> <?php } ?>
							<textarea class="input-big" name="offer_package_description_fr" id="offer_package_description_fr" style="margin:0px; padding:0px;"/></textarea>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    <div id="div_offer_description_de" <?php if(CURRENT_LANGUAGE=="de") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                    <label><?php echo lang('package_description_de');?></label>
                    		<?php if(CURRENT_LANGUAGE=="de") { ?> <span id="offer_package_description_error" class="suggestion first_signup_visit"><?php echo lang('package_description_sugession');?></span> <?php } ?>
							<textarea class="input-big" name="offer_package_description_de" id="offer_package_description_de" style="margin:0px; padding:0px;"/></textarea>
                        
                   	</div>
                    
                    <div class="clearfix"></div>
                    <div id="div_offer_description_es" <?php if(CURRENT_LANGUAGE=="es") { ?> style="display:block;"<?php }else{ ?> style="display:none;" <?php } ?> >
                    <label><?php echo lang('package_description_es');?></label>
                    	
							<?php if(CURRENT_LANGUAGE=="es") { ?> <span id="offer_package_description_error" class="suggestion first_signup_visit"><?php echo lang('package_description_sugession');?></span> <?php } ?>
							<textarea class="input-big" name="offer_package_description_es" id="offer_package_description_es" style="margin:0px; padding:0px;"/></textarea>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    

                    <div class="clearfix-big"></div>		
								
					<div style="display:none;">			
					<label><?php echo lang('facility'); ?></label>
                    <span id="offer_facility_error" class="suggestion first_signup_visit"><?php echo lang('offer_facility_sugession'); ?></span>
					<ul class="facility">
                	<?php 
					if(!empty($services) && is_array($services))
					foreach($services as $service_key=>$service){ ?>
                	<li><input type="checkbox" class="checkbox" name="offer_facilities[]" id="offer_facilities_<?php echo $service_key; ?>" value="<?php echo $service->facility_id;?>" /> <?php echo $service->facility_name;?></li>
               		<?php } ?>
					</ul>
					<input type="hidden" name="number_of_facilities" id="number_of_facilities" value="<?php echo count($services);?>">
                	<div class="clearfix-big"></div>			
					</div>			
					
					<label><?php echo lang('offer_theme');?></label>
                    <span id="offer_theme_error" class="suggestion first_signup_visit"><?php echo lang('offer_theme_sugession');?></span>
					<ul class="facility">
                	<?php 
					if(!empty($lastminute_themes) && is_array($lastminute_themes))
					foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                	<li><input type="checkbox" class="checkbox" name="offer_themes[]" id="offer_themes_<?php echo $theme_key; ?>" value="<?php echo $LastminuteTheme->lastminutetheme_id;?>" /> <?php echo $LastminuteTheme->theme_name;?></li>
                	<?php } ?>
					</ul>
                	<input type="hidden" name="number_of_themes" id="number_of_themes" value="<?php echo count($lastminute_themes);?>">
                	<div class="clearfix-big"></div>	
					
					
					<label><?php echo lang('offer_period');?></label>
                    <span id="offer_period_error" class="suggestion first_signup_visit"><?php echo lang('offer_period_sugession');?></span>
					<ul class="facility">
					<?php 
					if(!empty($offer_peroids) && is_array($offer_peroids))
					foreach($offer_peroids as $offer_period_key=>$OfferPeriod){ ?>
                	<li><input type="checkbox" class="checkbox" name="offer_periods[]" id="offer_periods_<?php echo $offer_period_key; ?>" value="<?php echo $OfferPeriod->period_id;?>" /> <?php echo $OfferPeriod->period_name;?></li>
                	<?php } ?>
					</ul>
					<input type="hidden" name="number_of_periods" id="number_of_periods" value="<?php echo count($offer_peroids);?>">	
					<div class="clearfix-big"></div>	
					
                                        <!--
					<label><?php echo lang('images');?></label>
					<ul class="images">
						<?php
							$number_of_attachment = $settings->max_no_picture;
							for($i=1;$i<$number_of_attachment;$i++){
																			
						?>
								<li><input type="file" name="offer_attachments_<?php echo $i; ?>" id="offer_attachments_<?php echo $i; ?>" value="" /></li> 
						<?php	
							}
						?>
					</ul>	
					<div class="clearfix-big"></div>
                                        //-->
					
					<div style="margin-left: 120px; margin-bottom:10px;">
						<div id="add_offer_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
							<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
						</div>
					</div>
					
					<input type="submit" name="save_offer_informaiton" id="save_offer_informaiton" value="<?php echo lang('save');?>" class="button medium btn-red">
				</form>
								<div class="clearfix-big"></div>
					</div>

			</div></div>
		<div class="clearfix-big"></div>
		</div>
	</div>
</div>