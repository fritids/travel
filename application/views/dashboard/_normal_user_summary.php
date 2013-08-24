<div class="background padding">
    <?php if(isset($profile_details) && $profile_details->avatar!=NULL){ 
            $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$profile_details->user_id."/".$profile_details->avatar;
            echo "<div class='user_avatar'>".image_thumb($file_source,48,48)."</div>";
          } 
    ?>
    <h3><?php echo lang('welcome');?>,</h3>
    <em>
        <?php if(isset($profile_details)) echo $profile_details->display_name;?>
    </em>
    <?php if(isset($profile_details) && $profile_details->account_expiry_date!=NULL && $profile_details->user_type==1) { ?>
    <br>
        <?php } ?>
    <a href="<?php echo base_url();?><?php echo $this->config->item('account_profile_edit_url');?>"><?php echo lang('edit_profile_sidebar');?></a> 
    <div class="clearfix"></div>
</div>
<div class="clearfix-big"></div>
			
