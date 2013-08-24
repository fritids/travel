<?php 
	if($user_past_offers!=NULL){
		foreach($user_past_offers as $offer_key=>$offer_item) { ?>
		                                <article class="dashboard_item">
		                                    <div class="item-img">
		                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>" title="SockMonkee">
		                                        	<?php 
		                                        		$filename = offer_random_attachment($offer_item->user_id);
		                                        		if($filename!=NULL)
															$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
														else
															$file = "assets/images/default_attachment.png";
														echo image_thumb($file,200,300);
		                                        	?>
		                                            <div class="overlay zoom"></div>
		                                        </a>
		                                    </div>
		                                    <div class="item_body">
		                                        <h5>
		                                            <span class="stars">
                                                    	<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
														<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
														<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
														<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
														<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
		                                            </span>
		                                            <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>"><?php echo $offer_item->hotel_name;?></a>
		                                        </h5>																			
		                                        <h4>
		                                            <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>"><?php echo $offer_item->offer_title;?></a>
		                                        </h4>
		                                        <p class="detail">
		                                            <?php echo $offer_item->offer_duration;?> | 
		                                            <?php echo $offer_item->offer_availability;?> |
		                                            <?php echo $offer_item->offerinclude_option?> | 
		                                            <?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?>
		                                        </p>							
		        
		                                        <p>
                                                	<?php
                                                		echo short_description($offer_item->offer_package_description, 25);
                                                    ?>
                                                </p>
											</div>
		                                    <div class="item_body_right">
		                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_edit_url'));?>" class="button small yellow">edit</a>
		                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_cancel_url'));?>" class="button small red">Delete</a>
		                                    </div>
		                                </article>
<?php 
		}
	} 
?>