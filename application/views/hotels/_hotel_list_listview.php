							<?php 
								if($hotel_list!=NULL){
									foreach($hotel_list as $hotel_key=>$hotel_item) { ?>
		                                <div id="my_active_offer_<?php echo $hotel_item->user_id;?>" class="dashboard_item alpha omega">
		                                   <div class="item-img">
												<a href="<?php echo base_url();?><?php echo hotel_url($hotel_item);?>" title="<?php echo $hotel_item->hotel_name;?>">
													<?php 
									                	$filename = offer_random_attachment($hotel_item->user_id);
									                    if($filename!=NULL)
															$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$hotel_item->user_id."/".$filename;
														else
															$file = "assets/images/default_attachment.png";
														echo image_thumb($file,75,90);
													?>
									            </a>
							                </div>
            
											<div class="item_body_full">
			 									
													
													<h4>
														<a href="<?php echo base_url();?><?php echo hotel_url($hotel_item);?>"><?php echo $hotel_item->hotel_name;?> </a>, <strong><?php echo $hotel_item->city_name;?>, <?php echo $hotel_item->country_name;?></strong>
													</h4>	
													<div class="clearfix-small"></div>
													<p class="detail"></p>											
                                                    </div> 												                   	                
						                				                   	                
                 							
                							<div class="clearfix"></div>
                									
                									
                									
               							</div>								
                                       <div class="clearfix"></div>          
							<?php 
									}
								} else {
							?>		
                                       
                                                        <div class="error_message_final"><?php echo lang('you_dont_have_active_offer');?></div>
                                       <?php } ?>