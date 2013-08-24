<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<form name="search_hotel_form_left" id="search_hotel_form_left" method="post" action="<?php echo base_url();?>hotels/search_hotel">
<input type="hidden" name="search_latitude" id="search_latitude" value="">
<input type="hidden" name="search_longitude" id="search_longitude" value="">
                
<div id="default-example"  class="background" data-collapse>

<h5 class="open first"><?php echo lang('location');?></h5>
<div>
<ul class="ckeckbox-search">
	<div class="field">
		<input type="text" value="<?php if(isset($search_text)) echo $search_text; ?>" id="city" name="city" placeholder="<?php echo lang('placeholder_city');?>" class="top-search" />
	</div></ul>
	<div class="clearfix"></div>
             </div>               
    	<h5 class="open"><?php echo lang('star_rating');?></h5>
		<div>
            <ul class="ckeckbox-search" id="search_by_offers_hotel_star">                       
                <li><input type="checkbox" class="checkbox" name="search_by_hotel_star[]" value="1" <?php if(isset($search_rating) && in_array("1",$search_rating)) { ?> checked="checked" <?php } ?> ><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle1.png"></span></li> 
                <li><input type="checkbox" class="checkbox" name="search_by_hotel_star[]" value="2" <?php if(isset($search_rating) && in_array("2",$search_rating)) { ?> checked="checked" <?php } ?> ><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle2.png"></span></li> 
                <li><input type="checkbox" class="checkbox" name="search_by_hotel_star[]" value="3" <?php if(isset($search_rating) && in_array("3",$search_rating)) { ?> checked="checked" <?php } ?> ><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle3.png"></span></li> 
                <li><input type="checkbox" class="checkbox" name="search_by_hotel_star[]" value="4" <?php if(isset($search_rating) && in_array("4",$search_rating)) { ?> checked="checked" <?php } ?> ><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle4.png"></span></li> 
                <li><input type="checkbox" class="checkbox" name="search_by_hotel_star[]" value="5" <?php if(isset($search_rating) && in_array("5",$search_rating)) { ?> checked="checked" <?php } ?> ><span class="tag"><img src="<?php echo IMAGEPATH; ?>stelle5.png"></span></li> 
            </ul>
            <div class="clearfix"></div>
        </div>

        <h5 class="open"><?php echo lang('hotel_type');?></h5>
        <div>
            <ul class="ckeckbox-search" id="search_by_hotel_type">
            <?php foreach($hotel_types as $hotel_type_key=>$HotelType){ ?>
                    <li><input type="checkbox" class="checkbox" name="search_by_hotel_type[]" value="<?php echo $HotelType->hotel_type_id;?>"><span class="tag"><?php echo $HotelType->hotel_type;?></span></li> 
            <?php } ?>
            </ul>
            <div class="clearfix"></div>
        </div>
		
        <h5><?php echo lang('hotel_theme');?></h5>
        <div>
            <ul class="ckeckbox-search" id="search_by_hotel_theme">
            <?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
                    <li><input type="checkbox" class="checkbox" name="search_by_hotel_theme[]"  value="<?php echo $LastminuteTheme->lastminutetheme_id;?>"><span class="tag"><?php echo $LastminuteTheme->theme_name;?></span></li> 
            <?php } ?>
            </ul>
            <div class="clearfix"></div>
        </div>
					
        <h5><?php echo lang('facility');?></h5>
        <div>
            <ul class="ckeckbox-search" id="search_by_hotel_facility">
            <?php foreach($services as $service_key=>$service){ ?>
                    <li><input type="checkbox" class="checkbox" name="search_by_hotel_facility[]"  value="<?php echo $service->facility_id;?>"><span class="tag"><?php echo $service->facility_name;?></span></li>	
            <?php } ?>
            </ul>
            <div class="clearfix"></div>
       	</div>
	</div>        
</form>