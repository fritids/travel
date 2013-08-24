<form id="normal_user_profile_edit_form" name="profile-edit-form" method="post" action="<?php echo base_url();?><?php echo $this->config->item('user_profile_edit_url');?>" enctype="multipart/form-data">

	<label>Gender</label>
    <?php
    	if(isset($gender))
			$selected_gender = $gender;	
		else
			$selected_gender = $profile_details->gender;	
	?>
	<select name="gender" id="gender" class="styled">
		<option value="Male"   <?php if($selected_gender=="Male"){ ?> selected="selected" <?php }?> >Male</option>
		<option value="Female" <?php if($selected_gender=="Female"){ ?> selected="selected" <?php } ?> >Female</option>
	</select>
	<div class="clearfix"></div>

	<?php
    	if(!isset($first_name)){
			$full_name = $profile_details->full_name;
			$name_parts = explode(' ',$full_name);
			if(sizeof($name_parts)>1){
				$last_name = $name_parts[sizeof($name_parts)-1];
				$name_parts = array_slice($name_parts, 0, (sizeof($name_parts)-1));
				$first_name = implode($name_parts,' ');
			}else{
				$first_name = $full_name;
				$last_name="";
			}
		}
	?>

	<label class="padding_top_13">First Name</label>
	<input type="text" name="first_name" id="first_name" class="input-big"  title="We ask for your age only for statistical purposes."  value="<?php if(isset($first_name)) echo $first_name; else echo $profile_details->first_name;?>" />
	<div class="clearfix"></div>

	<label class="padding_top_13">Surname</label>
	<input type="text" name="last_name" id="last_name" class="input-big"  title="We ask for your age only for statistical purposes."  value="<?php if(isset($last_name)) echo $last_name; else echo $profile_details->last_name;?>" />
	<div class="clearfix"></div>

	<label class="padding_top_13">Address</label>
	<input type="text" name="profile_address" id="profile_address" class="input-big" title="We ask for your age only for statistical purposes."  value="<?php if(isset($profile_address)) echo $profile_address; else echo $profile_details->address_line;?>" />
	<div class="clearfix"></div>

	<label class="padding_top_13">Zip</label>
	<input type="text" name="profile_zipcode" id="profile_zipcode" class="input-big" title="We ask for your age only for statistical purposes." value="<?php if(isset($profile_zipcode)) echo $profile_zipcode; else echo $profile_details->zipcode;?>" />
	<div class="clearfix"></div>

	<label class="padding_top_13"><?php echo lang('town');?></label>
	<input type="text" name="profile_city" id="profile_city" class="input-big" title="We ask for your age only for statistical purposes." value="<?php if(isset($profile_city)) echo $profile_city; else echo $profile_details->city;?>" />
	<div class="clearfix"></div>
    
    <label>Country</label>
    <?php 
	if(isset($profile_country))
		$selected_country = $profile_country;
	else
		$selected_country = $profile_details->country;
	?>
    <select name="profile_country" id="profile_country">
        <?php foreach($countries as $key=>$country) { ?>
                <option value="<?php echo $country->country_id;?>" <?php if($selected_country==$country->country_id){ ?> selected="selected" <?php } ?> ><?php echo $country->country_name;?></option>
        <?php } ?>
    </select>
    <div class="clearfix"></div>

	<label class="padding_top_13">Phone</label>
	<input type="text" name="profile_phone" id="profile_phone" class="input-big" title="We ask for your age only for statistical purposes." value="<?php if(isset($profile_phone)) echo $profile_phone; else echo $profile_details->phone;?>" />
	<div class="clearfix"></div>

	<label class="padding_top_13">Fax</label>
	<input type="text" name="profile_fax" id="profile_fax" class="input-big" title="We ask for your age only for statistical purposes." value="<?php if(isset($profile_fax)) echo $profile_fax; else echo $profile_details->fax;?>" />
	<div class="clearfix"></div>
	
	<label>Offers you like</label>
    <ul class="facility">
	<?php foreach($lastminute_themes as $theme_key=>$LastminuteTheme){ ?>
			<li><input type="checkbox" class="checkbox" name="hotel_themes[]" <?php if(isset($hotel_themes) && is_array($hotel_themes) && in_array($LastminuteTheme->lastminutetheme_id,$hotel_themes)){?> checked="checked" <?php } ?><?php if(!isset($hotel_themes) && is_array($user_profile_hotel_themes) && in_array($LastminuteTheme->lastminutetheme_id,$user_profile_hotel_themes)){?> checked="checked" <?php } ?> id="hotel_themes_<?php echo $theme_key; ?>" value="<?php echo $LastminuteTheme->lastminutetheme_id;?>" /> <?php echo $LastminuteTheme->theme_name;?></li>
	<?php } ?>
	</ul>	
	<div class="clearfix-big"></div>		
	
        
    <label>&nbsp;</label>
    <ul id="existing_avatar" class="images">
		<?php
		//print_r($profile_details);
        //print_r($existence_offer_attachments);
        if(isset($avatar))
        {
            $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$profile_details->user_id."/".$avatar;
            echo "<li>".image_thumb($file_source,48,48)." <br><a href='javascript:void(0);' onclick='DeleteProfileAvatar(".$profile_details->user_id.");'>Delete</a></li>";
        }
        else if(isset($profile_details) && $profile_details->avatar!=NULL)
        {
            $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$profile_details->user_id."/".$profile_details->avatar;
            echo "<li>".image_thumb($file_source,48,48)." <br><a href='javascript:void(0);' onclick='DeleteProfileAvatar(".$profile_details->user_id.");'>Delete</a></li>";
        }
        ?>
        <div style="clear:both;"></div>
    </ul>
    <div class="clearfix-big"></div>
    
    					
	<label>Avatar</label>
	<ul class="images">
		<li><input type="file" name="profile_avatar" id="profile_avatar" value="" /></li>
	</ul>	
	<div class="clearfix-big"></div>		
	
    
    <div style="margin-left: 120px; margin-bottom:10px;">
		<div id="normal_profile_error_message" class="error_message" style="margin-left: 100px; <?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
			<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>asdadas
		</div>
	</div>
	<input type="submit" class="button medium yellow" name="save_profile_data_normal" id="save_profile_data_normal" value="Save" />
			
</form>