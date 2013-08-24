<?php 
	if($most_viewed_offers!=NULL){
		foreach($most_viewed_offers as $offer_key=>$offer_item) {
?>							
			<div class="twelve columns dashboard_item alpha">
				<div class="item-img">
					<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="SockMonkee">
						<?php 
		                	$filename = offer_default_attachment($offer_item->offer_id);
		                    if($filename!=NULL)
								$file = OFFER_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
							else
								$file = "assets/images/default_attachment.png";
							echo image_thumb($file,240,300);
						?>
		                <div class="overlay zoom"></div>
		            </a>
                </div>
            
				<div class="item_body">
				<h4>
						<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>"><?php echo $offer_item->offer_title;?></a>
					</h4>
					 <p class="detail">
                        <?php echo $offer_item->offer_duration;?> | 
                        <?php echo $offer_item->offer_availability;?> |
                        <?php echo $offer_item->offerinclude_option?> |
                        <?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?>
                    </p>	
					<h5>
												<div class="clearfix"></div>
						<a href="<?php echo base_url();?><?php echo hotel_url($offer_item);?>"><?php echo $offer_item->hotel_name;?> </a><span class="stars">
                            <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
							<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
							<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
							<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
							<input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
						</span>
</a>
					</h5>	
											<div class="clearfix"></div>
																			
					    <p>
                        <?php
                            echo short_description($offer_item->offer_package_description, 15);
                        ?>
                    </p>
                   						
                   						
                </div>
                <div class="item_body_right">
                    <div class="price">&euro; <?php echo $offer_item->offer_end_price;?></div>
                    <a href="#" class="button small yellow">Prenota</a>
                </div>
                <ul class="item_toolbar">
                	<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
                	<li class="item_like">
							<span class="item_likes">
								<span id="total_like_offer_<?php echo $offer_item->offer_id;?>"><?php echo $offer_item->total_like;?></span>
							</span> 
							<span id="like_this_post">
                                <a id="<?php echo $offer_item->offer_id;?>" href="javascript:void(0);">
									<span id="likethisoffer_txt_<?php echo $offer_item->offer_id;?>">
                                    	<?php if(is_liked_this_offer($offer_item->offer_id,$profile_details->user_id)) { ?>
                                        		Non mi piace
                                        <?php }else{?>	
                                            	Mi piace
                                        <?php } ?>
                                    </span>
								</a>
                            </span>
					</li>
                    <?php }else{?>
                    <li class="item_like2">
                    		<span class="item_likes">
								<span id="total_like_offer_<?php echo $offer_item->offer_id;?>"><?php echo $offer_item->total_like;?></span>
							</span> 
							<span id="like_this_post">
                               <a class="open-popup" rel="leanModal" href="#user-login-popup">
									<span id="likethisoffer_txt_<?php echo $offer_item->offer_id;?>">Mi piace</span>
								</a>
                            </span>
                    </li>
                    <?php } ?>
                    
                	<li class="item_comment"><a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>">Recensione</a></li>
                    <li class="item_go_match"><a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_detail_url'));?>">Leggi il post</a></li>
                </ul>
			</div>								                                    
<?php	
		}
	} 
	else{ 
?>
	<div class="error_message"> Currently we dont have any offers available. </div>
	
<?php } ?>