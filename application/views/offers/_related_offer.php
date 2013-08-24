<!-- 960 Container -->
	<!-- Portfolio Content -->
		
		<h4 class="headline">Altre Offerte</h4>
				<div class="clearfix-big"></div>
	<!-- 1/4 Column -->
	<?php if(isset($related_offers) && $related_offers!=NULL) { ?>
		<?php foreach($related_offers as $roffer_key=>$offer_item){ ?>
			 	  <!-- 1/4 Column -->
			 	  
			 	  <div class="latest-post-blog">
						<a href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="<?php echo $offer_item->offer_title;?>">
                            	<?php 
		                             $filename = offer_random_attachment($offer_item->user_id);
		                             if($filename!=NULL)
										$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR .$offer_item->user_id."/".$filename;
									else
										$file = "assets/images/default_attachment.png";
									echo image_thumb($file,80,90);
		                        ?>
                             </a>
						<p> <a class="offer_name" href="<?php echo base_url();?><?php echo offers_url($offer_item);?>" title="<?php echo $offer_item->offer_title;?>">
Vacanze a <?php echo $offer_item->city_name;?>
								</a><br><strong><?php echo $offer_item->offer_duration;?></strong></p>
						<span><?php echo date('d M',strtotime($offer_item->offer_start_date)); ?> al <?php echo date('d M Y',strtotime($offer_item->offer_finish_date)); ?></span>
					</div>
					
				
					
                   
                 
		<?php } ?>
	<?php } ?>
<!-- End 960 Container -->