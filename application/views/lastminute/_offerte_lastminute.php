<?php 
	if($latest_offers!=NULL){
		foreach($latest_offers as $offer_key=>$offer_item) {
?>							
   <?php if($offer_key%3==0){ ?>
   <article class="full-width background">
   <?php }elseif($offer_key%3==1){ ?>
   <article class="full-width background">
   <?php }elseif($offer_key%3==2){ ?>
   <article class="full-width background">
   <?php } ?>
   
							<ul class="item_toolbar" style="width:50px;">da<br>
                    <h3 style="color:#FFF;"><?php echo $offer_item->offer_price_adult;?>€</h3>
                </ul>
								<figure><a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>">
                    <?php 
                            $filename = offer_random_attachment($offer_item->user_id);
                            if($filename!=NULL)
								$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
                            else
								$file = "assets/images/default_attachment.png";
                            
                            echo image_thumb($file,160,220);
                    ?>
                   </a>
</figure>
								<div class="details">
								      <span class="stars">
                    <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
                    <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
                    <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
                    <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
                    <input name="star_<?php echo $offer_item->offer_id;?>" type="radio" class="star" disabled="disabled" <?php if($offer_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
                </span>                                          
                <div style="clear:both;"></div>
									<h5 class="offer_name"><a class="offer_name" href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="<?php echo $offer_item->offer_title;?>">
                        <?php echo short_title($offer_item->offer_title,30);?>
                    </a></h5>
									<div class="description">
										<p> <a href="<?php echo base_url();?><?php echo hotel_url($offer_item);?>" title="<?php echo $offer_item->hotel_name;?>">
                        <?php echo $offer_item->hotel_name;?>
                    </a><br><strong>  <?php echo $offer_item->offer_duration;?>,  <?php echo $offer_item->offerinclude_option;?></strong><br><?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?> - <?php echo $offer_item->city_name;?>, <?php echo $offer_item->country_name;?> </p>
									</div>
									
								
								</div>
							</article>
							
	
                <?php if($offer_key%3==2 && $offer_key>0){ ?>
          
        <?php } ?>    
<?php	
		}
	} 
	else{ 
?>
	<div class="error_message"> Currently we dont have any offers available. </div>
	
<?php } ?>
<div class="clearfix-small"></div>