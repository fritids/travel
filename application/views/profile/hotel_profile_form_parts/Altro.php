<div class="clearfix-small"></div>

<div style="margin-bottom:0px;">
	<div id="save_altro_message" class="success_message"></div>
</div>

 <label class="padding_top_13 margin_top_22"><?php echo lang('nearest_airport');?></label>
                                        <span class="suggestion" id="hotel_nearest_airport_error"><?php echo lang('nearest_airport_suggestion'); ?></span>
                                    	<input type="text" class="input-big" name="nearest_airport_1" id="nearest_airport_1" value="<?php if(isset($nearest_airport_1)) echo $nearest_airport_1; else if($profile_details->nearest_airport_1!="0") echo $profile_details->nearest_airport_1;?>" />
                                        <div class="clearfix"></div>
										
                                        <label class="padding_top_13"><?php echo lang('nearest_airport');?> #2</label>
                                    	<input type="text" class="input-big" name="nearest_airport_2" id="nearest_airport_2" value="<?php if(isset($nearest_airport_2)) echo $nearest_airport_2; else if($profile_details->nearest_airport_2!="0") echo $profile_details->nearest_airport_2;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('nearest_airport');?> #3</label>
                                    	<input type="text" class="input-big" name="nearest_airport_3" id="nearest_airport_3" value="<?php if(isset($nearest_airport_3)) echo $nearest_airport_3; else if($profile_details->nearest_airport_3!="0") echo $profile_details->nearest_airport_3;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('nearest_train_station');?></label>
                                    	<input type="text" class="input-big" name="nearest_train_station" id="nearest_train_station" value="<?php if(isset($nearest_train_station)) echo $nearest_train_station; else if($profile_details->nearest_train_station!="0") echo $profile_details->nearest_train_station;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('nearest_bus_station');?></label>
                                    	<input type="text" class="input-big" name="nearest_bus_station" id="nearest_bus_station" value="<?php if(isset($nearest_bus_station)) echo $nearest_bus_station; else if($profile_details->nearest_bus_station!="0") echo $profile_details->nearest_bus_station;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('nearest_beach');?></label>
                                    	<input type="text" class="input-big" name="nearest_beach" id="nearest_beach" value="<?php if(isset($nearest_beach)) echo $nearest_beach; else if($profile_details->nearest_beach!="0") echo $profile_details->nearest_beach;?>" />
                                        <div class="clearfix"></div>
                                        
                                        <label class="padding_top_13"><?php echo lang('nearest_restaurant');?></label>
                                    	<input type="text" class="input-big" name="nearest_restaurant" id="nearest_restaurant" value="<?php if(isset($nearest_restaurant)) echo $nearest_restaurant; else if($profile_details->nearest_restaurant!="0") echo $profile_details->nearest_restaurant;?>" />
                                        <div class="clearfix"></div>
                                        
                                         <input type="submit" class="button medium yellow" name="save_profile_data" id="save_profile_data" value="<?php echo lang('save');?>" />