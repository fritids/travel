<h5><?php echo lang('city');?></h5>
	<?php 
      	 if(isset($hotel_city))
			$selected_city = $hotel_city;
	?>
    <select name="hotelsearch_city" id="search_city" style="width:205px !important;">
    	<option value=""><?php echo lang('select_city');?></option>
		 <?php foreach($cities as $key=>$city) { ?>
			<option value="<?php echo $city->city_id;?>" <?php if(isset($selected_city) && $selected_city==$city->city_id){ ?> selected="selected" <?php } ?> ><?php echo $city->city;?></option>
		<?php } ?>
        <option value="-1" <?php if(isset($selected_city) && $selected_city=="-1") { ?>selected="selected"<?php } ?>>Other</option>
	</select>