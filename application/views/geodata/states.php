<label style="margin-top:7px;"><?php echo lang('state');?></label>
	<?php 
      	 if(isset($hotel_state))
			$selected_state = $hotel_state;
		else
			$selected_state = $profile_details->hotel_state;
	?>
	<select name="hotel_state" id="hotel_state">
		 <option value=""><?php echo lang('select_state');?></option>
		 <?php foreach($states as $key=>$state) { ?>
			<option value="<?php echo $state->state_id;?>" <?php if(isset($selected_state) && $selected_state==$state->state_id && !isset($ajax_load)){ ?> selected="selected" <?php } ?> ><?php echo $state->state_name;?></option>
		<?php } ?>
	</select>
<div class="clearfix"></div>