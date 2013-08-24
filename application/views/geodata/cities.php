<label style="margin-top:7px;"><?php echo lang('comune');?></label>
	<?php 
      	 if(isset($hotel_city))
			$selected_city = $hotel_city;
		else
			$selected_city = $profile_details->hotel_city;
	?>
    <select name="hotel_city" id="hotel_city">
    	<option value=""><?php echo lang('select_city');?></option>
		 <?php if(isset($cities) && is_array($cities)) foreach($cities as $key=>$city) { ?>
			<option value="<?php echo $city->city_id;?>" <?php if(isset($selected_city) && $selected_city==$city->city_id && !isset($ajax_load)){ ?> selected="selected" <?php } ?> ><?php echo $city->city_name;?></option>
		<?php } ?>
	</select>
<div class="clearfix"></div>