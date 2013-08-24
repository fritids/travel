<script type="text/javascript" src="<?php echo JSPATH; ?>fileupload/jsource.js"></script>
<script script type="text/javascript">
$(document).ready(function() {
    $('#file_upload_container').Uploadrr({
		"data":{"key":"value", "akey":"avalue"},
		"maxFileCount": 10
	});
});
</script>
<!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="<?php echo CSSPATH; ?>fileupload/style-ie.css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo CSSPATH; ?>fileupload/style.css" />	
	

<div class="clearfix-small"></div>

<div style="margin-bottom:0px;">
	<div id="save_immagini_message" class="success_message"></div>
</div>

<div class="clearfix"></div>
                                        <ul class="offer_attachments">
                                        <?php
                                        //print_r($existence_offer_attachments);
                                        if($user_profile_hotel_attachments!=NULL)
                                        foreach($user_profile_hotel_attachments as $key=>$item){
                                            $file_source = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$item->profile_id."/".$item->image_name;
                                            echo "<li id='existing_attachment_".$item->profileattachment_id."'>".image_thumb($file_source,48,48)." <a href='javascript:void(0);' onclick='DeleteHotelProfileAttachment(".$item->profileattachment_id.");'>Delete</a> | <a href='".base_url()."profile/edit_image/".$item->attachment_id."'>Edit</a></li>";
                                        }
                                        ?>
                                        </ul>
                                        <div class="clearfix"></div>
                                               	<div class="clearfix-border"></div>
  												<div class="notification notice" style="padding:10px;">
  													<h3>Attenzione:</h3>
													<p><?php echo lang('photo_indication');?></p>
											
													<div id="file_upload_wrap">
														<div id="file_upload_container"></div>
													</div>
												</div>
                                        <div class="clearfix"></div>
                                        
