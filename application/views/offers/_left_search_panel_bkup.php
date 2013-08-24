<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<form name="search_offer_form_left" id="search_offer_form_left" method="post" action="<?php echo base_url();?>search/search_offers">
<div id="default-example" class="background" data-collapse>
<h5 class="open first"><?php echo lang('price_per_week');?></h5>
<div style="border: 1px solid #eeeeee; border-bottom:none;">
<div class="clearfix-big"></div>
<div class="ckeckbox-slider">		                    
                        <div class="layout-slider">
                            <input id="Slider3" type="slider" name="search_by_offer_price" value="0;<?php if(isset($search_price) && $search_price!="any") echo $search_price; else echo "500"; ?>" />
                        </div>
                        <script type="text/javascript" charset="utf-8">
                            jQuery("#Slider3").slider({ 
                            							from: 0, 
                            							to: 1000, 
                            							heterogeneity: ['100/1000', '500/700'], 
                            							scale: [0, '|', 250, '|', 500, '|', 750, '|', 1000], 
                            							limits: false, 
                            							step: 1, 
                            							dimension: '&nbsp;€', 
                            							skin: "round_plastic",
														callback: function( value ){
								    						$('#search_offer_form_left').submit();
								  						}
  						 							});
                        </script>
    				</div>                            <div class="clearfix"></div>

</div>


					<h5 class="open"><?php echo lang('duration_time');?></h5>
					<div>
					<div class="clearfix-big"></div>
					<div class="ckeckbox-slider">		                    
                        <div class="layout-slider">
                            <input id="Slider4" type="slider" name="search_by_offer_nights" value="0;<?php if(isset($search_price) && $search_price!="any") echo $search_price; else echo "30"; ?>" />
                        </div>
                        <script type="text/javascript" charset="utf-8">
                            jQuery("#Slider4").slider({ 
                            							from: 0, 
                            							to: 14, 
                            							scale: [0, '|', 2, '|', 4, '|', 6, '|', 8, '|', 10, '|', 12, '|', 14], 
                            							limits: false, 
                            							step: 1, 
                            							dimension: ' notti', 
                            							skin: "round_plastic",
														callback: function( value ){
								    						$('#search_offer_form_left').submit();
								  						}
  						 							});
                        </script>
    				</div>                            
    				<div class="clearfix"></div>
    				</div>

					


                        
 						<h5 class="open"><?php echo lang('hotel_theme');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_hotel_theme">
                                 <?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_hotel_theme[]" value="<?php echo $LastminuteTheme->lastminutetheme_id;?>"><span class="tag"><?php echo $LastminuteTheme->theme_name;?></span></li> 
                                 <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

<h5><?php echo lang('star_rating');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_star">                       
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_star[]" value="1"><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle1.png"></span></li> 
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_star[]" value="2"><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle2.png"></span></li> 
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_star[]" value="3"><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle3.png"></span></li> 
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_star[]" value="4"><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle4.png"></span></li> 
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_star[]" value="5"><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle5.png"></span></li> 
                            </ul>
                            <div class="clearfix"></div>
                        </div>


                        <h5><?php echo lang('hotel_type');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offers_hotel_type">
                                <?php foreach($hotel_types as $hotel_type_key=>$HotelType){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offers_hotel_type[]" value="<?php echo $HotelType->hotel_type_id;?>"><span class="tag"><?php echo $HotelType->hotel_type;?></span></li> 
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                       	</div>
		
                                               
                        <h5><?php echo lang('hotel_offer_period');?></h5>
                        <div>
                            <ul class="ckeckbox-search" id="search_by_offesr_period">
                                 <?php foreach($offer_peroids as $period_key=>$OfferPeriod){ ?>
                                    <li><input type="checkbox" class="checkbox" name="search_by_offesr_period[]" value="<?php echo $OfferPeriod->period_id;?>"><span class="tag"><?php echo $OfferPeriod->period_name;?></span></li> 
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
                        
                        <h5 class="last">Information</h5>
                        <div>
                           
                            <div class="clearfix"></div>
                       	</div>
                       	
                       	
					</div>
                    <input type="hidden" name="result_sort_by" id="result_sort_by" value="price">
                    <input type="hidden" name="search_city" id="search_city"  value="<?php if(isset($search_city)) echo $search_city;?>"  />
                    <input type="hidden" name="search_form_date"  id="search_form_date" value="<?php if(isset($search_from_date)) echo $search_from_date;?>"  />
                    <input type="hidden" name="search_to_date"  id="search_to_date" value="<?php if(isset($search_to_date)) echo $search_to_date;?>" />
</form>					