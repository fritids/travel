<?php 
	if($hotel_list!=NULL){
            foreach($hotel_list as $hotel_key=>$hotel_item) {
?>
       <?php if($hotel_key%3==0){ ?>
   <article class="full-width background">
       <?php }elseif($hotel_key%3==1){ ?>
   <article class="full-width background">
       <?php }elseif($hotel_key%3==2){ ?>
   <article class="full-width background">
       <?php } ?>
                
                
                		<ul class="item_toolbar">                        <strong><?php echo $hotel_item->city_name;?></strong>

                </ul>
								<figure> <a href="<?php echo base_url();?><?php echo hotel_url($hotel_item);?>" title="<?php echo $hotel_item->hotel_name;?>">
                        <?php 
		                $filename = hotel_default_attachment($hotel_item->user_id);
		                if($filename!=NULL)
                                    $file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$hotel_item->user_id."/".$filename;
				else
                                    $file = "assets/images/default_attachment.png";
				
                                echo image_thumb($file,160,220);
			?>
                    </a>
</figure>
								<div class="details">
								       <span class="stars">
                        <input name="hotel_profile_item_<?php echo $hotel_item->user_id;?>" type="radio" class="star" disabled="disabled" <?php if($hotel_item->hotel_rating==1) { ?> checked="checked" <?php }?> />
                        <input name="hotel_profile_item_<?php echo $hotel_item->user_id;?>" type="radio" class="star" disabled="disabled" <?php if($hotel_item->hotel_rating==2) { ?> checked="checked" <?php }?> />
                        <input name="hotel_profile_item_<?php echo $hotel_item->user_id;?>" type="radio" class="star" disabled="disabled" <?php if($hotel_item->hotel_rating==3) { ?> checked="checked" <?php }?> />
                        <input name="hotel_profile_item_<?php echo $hotel_item->user_id;?>" type="radio" class="star" disabled="disabled" <?php if($hotel_item->hotel_rating==4) { ?> checked="checked" <?php }?> />
                        <input name="hotel_profile_item_<?php echo $hotel_item->user_id;?>" type="radio" class="star" disabled="disabled" <?php if($hotel_item->hotel_rating==5) { ?> checked="checked" <?php }?> />
                    </span>                                        
                <div style="clear:both;"></div>
									<h5 class="hotel_name"><a  class="offer_name" href="<?php echo base_url();?><?php echo hotel_url($hotel_item);?>" title="<?php echo $hotel_item->hotel_name;?>"><?php echo short_title($hotel_item->hotel_name,30);?></a></h5>
									<div class="description">
										<p><strong><?php echo $hotel_item->hotel_town; ?>, <?php echo $hotel_item->city_name;?> </strong> <?php echo $hotel_item->hotel_zip;?>, <?php echo $hotel_item->hotel_address;?><br>
										            <?php echo short_description($hotel_item->hotel_description, 10); ?>
</p>	
									</div>
									
								
								</div>
							</article>
							
							
							
	
            <?php if($hotel_key%3==2 && $hotel_key>0){ ?>
            <?php } ?>

<?php	
	}
    }
    else{
?>            
      <div class="error_message" style="display:block;">No hotel found.</div>      
 <?php           
        } 
?>
<div class="clearfix-small"></div>