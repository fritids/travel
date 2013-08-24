<?php 
	if($latest_offers!=NULL){
		foreach($latest_offers as $offer_key=>$offer_item) {
?>							
			<div class="dashboard_item">
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
                    <div class="price">&euro; <?php echo $offer_item->offer_end_price;?></div>
                    <a href="#" class="button small yellow">Prenota</a>
                </div>
                <ul class="item_toolbar">
                    <li class="item_like"><a class="open-popup" href="#user-login-popup">Mi piace</a></li>
                    <li class="item_comment"><a href="../offers/single_project.html#comments">Recensione</a></li>
                    <li class="item_go_match"><a href="../offers/single_project.html">Leggi il post</a></li>
                </ul>
			</div>								
                                    
<?php	
		}
	} 
?>