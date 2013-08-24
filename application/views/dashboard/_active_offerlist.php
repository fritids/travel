							<?php 
								if($user_active_offers!=NULL){
									foreach($user_active_offers as $offer_key=>$offer_item) { ?>
		                                <div id="my_active_offer_<?php echo $offer_item->offer_id;?>" class="dashboard_item alpha omega">
		                                  
            
											<div class="item_body_full">
			 									
													<h4>
														<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>"><?php echo $offer_item->offer_title;?></a>
													</h4>
													
													<div class="clearfix"></div>
<p class="detail">

								                        <span><strong><?php echo lang('duration_time');?>:</strong></span> <?php echo $offer_item->offer_duration;?>, <span><strong><?php echo lang('offer_includes');?>:</strong></span> <?php echo $offer_item->offerinclude_option?><br>
								                      <span><strong>Valido:</strong></span> <?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?>
								                    </p>											</div> 												                   	                
						                				                   	                
                 							<div class="item_body_right">a partire da<br>
												<h3>&euro; <?php echo $offer_item->offer_price_adult;?></h3>
                   								<div class="clearfix-small"></div>
                							</div>
                							<div class="clearfix"></div>
                									
                									
                									<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
			                                    		<?php if($profile_details->user_id==$offer_item->user_id) { ?>                							<div class="clearfix-big"></div>
<div style="background-color:#efefef;padding:5px;">
						                                        <a href="<?php echo base_url();?><?php echo str_replace('%id%',$offer_item->offer_id,$this->config->item('offers_edit_url'));?>" class="button small yellow"><?php echo lang('edit');?></a>
						                                        <a id="delete_button" href="javascript:void(0);" class="button small red"><?php echo lang('cancel');?></a>
				                                                    <div class="popover">
				                                                        <a href="javascript:void(0);" class="close"></a>
				                                                        <div class="inner">
				                                                            <h3 class="title"><?php echo lang('cancel_offer_message');?></h3>
				                                                                <div class="content">
				                                                                    <ul>
				                                                                        <li><a class="yes"  href="javascript:void(0);" onclick="cancel_offer(<?php echo $offer_item->offer_id;?>);"><?php echo lang('yes_string');?></a></li>
				                                                                        <li><a class="no" href="javascript:void(0);"><?php echo lang('no_string');?></a></li>
				                                                                    </ul>								 
				                                                                </div>
				                                                        </div>															 
				                                                    </div>
				                                                    <div style="clear:both;"></div>	                                                </div>

	                                                    <?php } ?>
	                                                <?php } ?>
               							</div>								
                                       <div class="clearfix"></div>          
							<?php 
									}
								} else {
							?>		
                                       
                                                        <div class="error_message_final"><?php echo lang('you_dont_have_active_offer');?></div>
                                       <?php } ?>