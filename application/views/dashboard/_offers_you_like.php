							<?php 
								if($offers_you_like!=NULL){
									foreach($offers_you_like as $offer_key=>$offer_item) { ?>
		                                <div id="offers_i_like_<?php echo $offer_item->offer_id; ?>" class="dashboard_item">
		                                    <div class="item-img">
		                                        <a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="<?php echo $offer_item->offer_title;?>">
		                                        	<?php 
		                                        		$filename = offer_random_attachment($offer_item->user_id);
		                                        		if($filename!=NULL)
															$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
														else
															$file = "assets/images/default_attachment.png";
														echo image_thumb($file,75,90);
		                                        	?>
		                                            <div class="overlay zoom"></div>
		                                        </a>
		                                    </div>
		                                    <div class="item_body">
		                                            <span class="stars">
                                                    	<input name="star_offers_you_like<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
														<input name="star_offers_you_like<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
														<input name="star_offers_you_like<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
														<input name="star_offers_you_like<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
														<input name="star_offers_you_like<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
		                                            </span>
		                                            <div class="clearfix"></div>
		                                        <h4>
		                                        	<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>"><?php echo $offer_item->offer_title;?></a>
												</h4>
												<h6>
													<a href="<?php echo base_url();?><?php echo hotel_url($offer_item);?>"><?php echo $offer_item->hotel_name;?> </a>
												</h6>
												<div class="clearfix"></div>
											</div>
											<div class="item_body_detail">
												       <p class="detail">
									                        <span>Giorni:</span> <?php echo $offer_item->offer_duration;?><br>
									                        <span>Quantità:</span> <?php echo $offer_item->offer_availability;?><br>
									                        <span>Trattamento:</span> <?php echo $offer_item->offerinclude_option?><br>
									                      	<span>Valido:</span> <strong><?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?></strong>
									                    </p>	             	                
											</div>		
												
											<div class="item_body_right">
												<h3>&euro; <?php echo $offer_item->offer_price_adult;?></h3>
							                   	Adulti					
							                   	<div class="clearfix-small"></div>
							
							                   	<h3>&euro; <?php echo $offer_item->offer_price_children;?></h3>
							                   	Bambini
							               	</div>
							               	
							               		<div style="margin-top: 5px; margin-left: 110px;">
								               		<a id="delete_button" href="javascript:void(0);" class="button small red">unlike</a>
	                                                <div class="popover">
	                                                    <a href="javascript:void(0);" class="close"></a>
	                                                    <div class="inner">
	                                                        <h3 class="title"><?php echo lang('unlike_offer_message');?></h3>
	                                                            <div class="content">
	                                                                <ul>
	                                                                    <li><a class="yes"  href="javascript:void(0);" onclick="unlike_offer(<?php echo $offer_item->offer_id;?>);"><?php echo lang('yes_string');?></a></li>
	                                                                    <li><a class="no" href="javascript:void(0);"><?php echo lang('no_string');?></a></li>
	                                                                </ul>								 
	                                                            </div>
	                                                    </div>															 
	                                                </div>
                                                </div>
											
											
		                                </div>
							<?php 
									}
								} else{
							?>
									<div class="error_message_final"><?php echo lang('you_dont_have_offers_like');?></div>
                                    
                            <?php } ?>