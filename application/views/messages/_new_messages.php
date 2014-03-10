<?php 
							if($new_messages!=NULL){
								?>						
										<div class="padding">						
											<table class="standard-table">
													<tr>
														<th>Name</th>
														<th>Contact</th>
														<th>From</th>
														<th>To</th>
														<th></th>
													</tr>
													<?php foreach($new_messages as $new_message_key=>$new_message_item) { ?>
													<tr>
														<td><h4><a rel="leanModal" href="#message_view_<?php echo ($new_message_key+1);?>"><?php echo $new_message_item->booking_name;?></a></h4></td>
														<td><?php echo $new_message_item->booking_phone;?></td>
														<td><?php echo $new_message_item->booking_checkin_date;?></td>
														<td><?php echo $new_message_item->booking_checkout_date;?></td>
														<td>
															<a rel="leanModal" href="#message_view_<?php echo ($new_message_key+1);?>" class="button small btn-red">view</a>
															<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
						                                    		
									                                        <a id="delete_button" href="javascript:void(0);" class="button small btn-red"><?php echo lang('cancel');?></a>
							                                                    <div class="popover">
							                                                        <a href="javascript:void(0);" class="close"></a>
							                                                        <div class="inner">
							                                                            <h3 class="title"><?php echo lang('cancel_offer_message');?></h3>
							                                                                <div class="content">
							                                                                    <ul>
							                                                                        <li><a class="yes"  href="<?php echo base_url();?>messages/delete/<?php echo $new_message_item->booking_request_id;?>"><?php echo lang('yes_string');?></a></li>
							                                                                        <li><a class="no" href="javascript:void(0);"><?php echo lang('no_string');?></a></li>
							                                                                    </ul>								 
							                                                                </div>
							                                                        </div>															 
							                                                    </div>
							                                                    <div style="clear:both;"></div>
				                                                    
				                                            <?php } ?>
                                                            <div id="message_view_<?php echo ($new_message_key+1);?>" class="message_popup">
                                                                <div id="signup-ct">
                                                                    <div id="signup-header">
                                                                    	<h2 style="margin-top: -2px; margin-bottom: 3px;">Booking request</h2>
																		<p>
																			<?php echo $new_message_item->booking_name;?>
																		</p>
																		<a class="modal_close" href="#"></a>
                                                                    </div>
                                                                    <div id="popup_main_content" style="font-size: 12px !important; padding-top: 10px; ">
                                                                        <b>Message:</b> <?php echo $new_message_item->booking_message;?><br><br>
                                                                        <b>Person (adult):</b> <?php echo $new_message_item->booking_adult;?><br><br>
                                                                        <b>Email:</b> <a href="mailto:<?php echo $new_message_item->booking_email;?>"><?php echo $new_message_item->booking_email;?></a>
                                                                    </div>
                                                                </div>
                                                            </div>
				                                                
															
															
															
														</td>
													</tr>
													<?php } ?>											
											</table>						
											<div class="pagination">
												<?php echo $pagination_links;?>
											</div>
										</div>
						<?php 
								} 
							else{
						?>						
										<div id="welcome_item_list">
											<div class="error_message_final">There is no new messages.</div>
										</div>					
						<?php		
								}
						?>