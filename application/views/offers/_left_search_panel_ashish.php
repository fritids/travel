<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>


<form name="search_offer_form_left" id="search_offer_form_left" method="post" action="<?php echo base_url();?>search/search_offers">
<div id="default-example" class="background" data-collapse>


					


                        
 						<h5 class="open"><?php echo lang('hotel_theme');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_hotel_theme">
                                 <?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_hotel_theme[]" value="<?php echo $LastminuteTheme->lastminutetheme_id;?>"><span class="tag"><?php echo $LastminuteTheme->theme_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

<h5 class="open"><?php echo lang('hotel_offer_period');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_period">
                                 <?php foreach($offer_peroids as $period_key=>$OfferPeriod){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_period[]" value="<?php echo $OfferPeriod->period_id;?>"><span class="tag"><?php echo $OfferPeriod->period_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>



                        <h5 class="open"><?php echo lang('hotel_type');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_type">
                                <?php foreach($hotel_types as $hotel_type_key=>$HotelType){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_type[]" value="<?php echo $HotelType->hotel_type_id;?>"><span class="tag"><?php echo $HotelType->hotel_type;?></span></li> 
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                       	</div>
		
                                               
                        					
                        <h5><?php echo lang('facility');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_facility">
                                <?php foreach($services as $service_key=>$service){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_facility[]" value="<?php echo $service->facility_id;?>"><span class="tag"><?php echo $service->facility_name;?></span></li>	
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