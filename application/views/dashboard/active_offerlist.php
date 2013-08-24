							<?php 
								if($user_active_offers!=NULL){
									foreach($user_active_offers as $offer_key=>$offer_item) { ?>
		                                <div class="dashboard_item">
		                                    <div class="item-img">
		                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>" title="SockMonkee">
		                                        	<?php 
		                                        		$filename = offer_random_attachment($offer_item->user_id);
		                                        		if($filename!=NULL)
															$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->offer_id."/".$filename;
														else
															$file = "assets/images/default_attachment.png";
														echo image_thumb($file,110,130);
		                                        	?>
		                                            <div class="overlay zoom"></div>
		                                        </a>
		                                    </div>
		                                    <div class="item_body">
		                                        <h5>
		                                            <span class="stars">
		                                                <img src="<?php echo IMAGEPATH; ?>stelle3.png">
		                                            </span>
		                                            <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>"><?php echo $offer_item->hotel_name;?></a>
		                                        </h5>																			
		                                        <h4>
		                                            <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>"><?php echo $offer_item->offer_title;?></a>
		                                        </h4>
		                                        <p class="detail">
		                                            <?php echo $offer_item->offer_duration;?> | 
		                                            <?php echo $offer_item->offer_availability;?> |
		                                            Mezza Pensione | 
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
		                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_cancel_url'));?>" class="button small red">cancel</a>
		                                    </div>
		                                </div>
							<?php 
									}
								} 
							?>							