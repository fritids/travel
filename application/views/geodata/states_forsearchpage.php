<h5><?php echo lang('state');?></h5>
	<?php 
      	 if(isset($hotel_state))
			$selected_state = $hotel_state;
	?>
	<select name="hotelsearch_state" id="search_state" style="width:205px !important;">
		 <option value=""><?php echo lang('select_state');?></option>
		 <?php foreach($states as $key=>$state) { ?>
			<option value="<?php echo $state->state_id;?>" <?php if(isset($selected_state) && $selected_state==$state->state_id){ ?> selected="selected" <?php } ?> ><?php echo $state->regione;?></option>
		<?php } ?>
	</select>