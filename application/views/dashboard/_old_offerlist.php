<?php 
	if($user_past_offers!=NULL){
		foreach($user_past_offers as $offer_key=>$offer_item) { ?>
		                                
		                                
		                                
		                                
		                                
		                                
		                                
		                                
		                                <div id="my_old_offer_<?php echo $offer_item->offer_id; ?>" class="dashboard_item" style="border:solid red 1px;">
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
                                                    	<input name="star_old_offer_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
														<input name="star_old_offer_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
														<input name="star_old_offer_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
														<input name="star_old_offer_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
														<input name="star_old_offer_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
		                                            </span>
		                                        <div class="clearfix"></div>
													<h4>
														<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>"><?php echo $offer_item->offer_title;?></a>
													</h4>
													<h6>
														<a href="<?php echo base_url();?><?php echo hotel_url($offer_item);?>"><?php echo $offer_item->hotel_name;?> </a>
													</h6>	
													<p><strong><?php echo $offer_item->city_name;?>, <?php echo $offer_item->country_name;?></strong></p>
													<div class="clearfix"></div>
											</div> 												                   	                
						                	<div class="item_body_detail">
												    <p class="detail">
								                        <span>Giorni:</span> <?php echo $offer_item->offer_duration;?><br>
								                        <span>Quantit��:</span> <?php echo $offer_item->offer_availability;?><br>
								                        <span>Trattamento:</span> <?php echo $offer_item->offerinclude_option?><br>
								                      <span>Valido:</span> <strong><?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?></strong>
								                    </p>	             	                
											</div>
		                                    <div class="item_body_right">
                                                <h3>&euro; <?php echo $offer_item->offer_end_price;?></h3>
                   								Adulti
                   								<div class="clearfix-small"></div>

                   								<h3>&euro; <?php echo $offer_item->offer_price_children;?></h3>
                   								Bambini
                   							</div>
                   							<div class="clearfix"></div>
                   							
                   							
                   							 
                   								<div style="margin-top: 5px; margin-left: 110px;">
                   								<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
		                                    		<?php if($profile_details->user_id==$offer_item->user_id) { ?>
				                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_edit_url'));?>" class="button small yellow"><?php echo lang('edit');?></a>
				                                        <a id="delete_button" href="javascript:void(0);" class="button small red"><?php echo lang('cancel');?></a>
		                                                	<div class="popover">
		                                                        <a href="javascript:void(0);" class="close"></a>
		                                                        <div class="inner">
		                                                            <h3 class="title"><?php echo lang('delete_offer_message');?></h3>
		                                                                <div class="content">
		                                                                    <ul>
		                                                                        <li><a class="yes"  href="javascript:void(0);" onclick="delete_offer(<?php echo $offer_item->offer_id;?>);"><?php echo lang('yes_string');?></a></li>
		                                                                        <li><a class="no" href="javascript:void(0);"><?php echo lang('no_string');?></a></li>
		                                                                    </ul>								 
		                                                                </div>
		                                                        </div>															 
		                                                    </div>
		                                                    <div style="clear:both;"></div>
		                                          	<?php } ?>
                                                <?php } ?>
                                                </div>
                   							
                   							
                   							
               							</div>								
              						<div class="clearfix"></div>  
<?php 
		}
	}else{ 
?>

<div class="error_message_final"><?php echo lang('you_dont_have_old_offer');?></div>

<?php } ?>