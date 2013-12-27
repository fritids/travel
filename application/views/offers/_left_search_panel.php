<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>
<form name="search_offer_form_left" id="search_offer_form_left" method="post" action="<?php echo base_url();?>search/search_offers">
<div id="default-example" class="background" data-collapse>

						<?php
							$state_list=array('Dhaka', 'Chittagong', 'Sylhet', 'Khulna', 'Rajshahi', 'Barisal', 'Rangpur', 'Rangamati',
												'Bandarban','Cox\'s Bazar', 'Kuakata', 'Saint Martin');
						?>    
    
					    <h5>Offers by City</h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_state_multiple">
                                 <?php 
								 if(isset($selected_region))
								 $selected_state_list = explode(',',$selected_region);

								 foreach($state_list as $state_key=>$state_name){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_state_multiple[]"  
                                    <?php if(isset($selected_region)) if(in_array(strtolower($state_name),$selected_state_list)) echo 'checked="checked"'; ?>
                                    value="<?php echo strtolower($state_name);?>"><span class="tag"><?php echo $state_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <!-- <li><a href="http://www.travelly.me/offers/italy/abruzzo">Abruzzo</a></li> //-->
                            <div class="clearfix"></div>
                        </div>
						


                        
 						<h5 class="open"><?php echo lang('hotel_theme');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_hotel_theme">
                                 <?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_hotel_theme[]" 
                                    <?php if(isset($search_hotel_theme) && is_array($search_hotel_theme) && in_array($LastminuteTheme->lastminutetheme_id, $search_hotel_theme)) echo 'checked="checked"'; ?>
                                    value="<?php echo $LastminuteTheme->lastminutetheme_id;?>"><span class="tag"><?php echo $LastminuteTheme->theme_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

<h5 class="open"><?php echo lang('hotel_offer_period');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_period">
                                 <?php foreach($offer_peroids as $period_key=>$OfferPeriod){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_period[]" 
                                    <?php if(isset($search_offer_period) && is_array($search_offer_period) && in_array($OfferPeriod->period_id, $search_offer_period)) echo 'checked="checked"'; ?>
                                    value="<?php echo $OfferPeriod->period_id;?>"><span class="tag"><?php echo $OfferPeriod->period_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>



                        <h5 class="open"><?php echo lang('hotel_type');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_type">
                                <?php foreach($hotel_types as $hotel_type_key=>$HotelType){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_type[]" 
                                    <?php if(isset($search_hotel_type) && is_array($search_hotel_type) && in_array($HotelType->hotel_type_id, $search_hotel_type)) echo 'checked="checked"'; ?>
                                    value="<?php echo $HotelType->hotel_type_id;?>"><span class="tag"><?php echo $HotelType->hotel_type;?></span></li> 
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                       	</div>
		
                                               
                        					
                        <h5><?php echo lang('facility');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_facility">
                                <?php foreach($services as $service_key=>$service){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_facility[]" 
                                    <?php if(isset($search_hotel_service) && is_array($search_hotel_service) && in_array($service->facility_id, $search_hotel_service)) echo 'checked="checked"'; ?>
                                    value="<?php echo $service->facility_id;?>"><span class="tag"><?php echo $service->facility_name;?></span></li>	
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                                              	
                       	
					</div>
                    <input type="hidden" name="result_sort_by" id="result_sort_by" value="price">
                    <input type="hidden" name="search_city" id="search_city"  value="<?php if(isset($search_city)) echo $search_city;?>"  />
                    <input type="hidden" name="search_form_date"  id="search_form_date" value="<?php if(isset($search_from_date)) echo $search_from_date;?>"  />
                    <input type="hidden" name="search_to_date"  id="search_to_date" value="<?php if(isset($search_to_date)) echo $search_to_date;?>" />
</form>					