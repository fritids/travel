<?php 
							if($old_messages!=NULL){
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
												<?php foreach($old_messages as $old_message_key=>$old_message_item) {  ?>
												<tr>
													<td><h4><a href="javascript:void(0);"><?php echo $old_message_item->booking_name;?></a></h4></td>
													<td><?php echo $old_message_item->booking_phone;?></td>
													<td><?php echo $old_message_item->booking_checkin_date;?></td>
													<td><?php echo $old_message_item->booking_checkout_date;?></td>
													<td><a  class="button small btn-red">cancellato</a></td>
												</tr>
												<?php  } ?>				
										</table>
									</div>
						<?php 
								} 
							else{
						?>						
									<div id="welcome_item_list">
											<div class="error_message_final">There is no old messages.</div>
									</div>						
						<?php		
								}
						?>