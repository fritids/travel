<label style="margin-top:7px;"><?php echo lang('comune');?></label>
	<?php 
      	 if(isset($hotel_comune))
			$selected_comune = $hotel_comune;
		else
			$selected_comune = $profile_details->hotel_comune;
	?>
    <select name="hotel_comune" id="hotel_comune">
    	<option value=""><?php echo lang('select_comune');?></option>
		 <?php foreach($comuni as $key=>$comune) { ?>
			<option value="<?php echo $comune->comune_id;?>" <?php if(isset($selected_comune) && $selected_comune==$comune->comune_id){ ?> selected="selected" <?php } ?> ><?php echo $comune->comune;?></option>
		<?php } ?>
	</select>
<div class="clearfix"></div>