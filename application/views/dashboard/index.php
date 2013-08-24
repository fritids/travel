
<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>


<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>
<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">

<div class="four columns">

    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>			

    		<?php echo $this->template->block('AddNewLastMinuteNotification','dashboard/_add_new_lastminute_notification.php'); ?>	
  <div class="clearfix-small"></div>
  		
    				
<div id="default-example-info" class="background" data-collapse>
    <h5 class="open"><?php echo lang('my_offers_online');?></h5>
										                       <div>
																		<?php echo lang('my_offers_online_description');?>
										                       </div> 
										                       
										                       <h5><?php echo lang('old_offers');?></h5>
										                       <div>
																		<?php echo lang('old_offers_description');?>

										                       </div> 
</div>
</div>
			
			

				<?php if(isset($profile_details) && $profile_details->is_complete==0) { ?>
                	<?php echo $this->template->block('UserProfileIncompleteNotification','dashboard/_complete_profile_notification.php');?>
                <?php } ?>
                
                
                <div class="twelve columns background">	
			
		
				
                
                <div style="margin-bottom:0px;">
					<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
						<?php if(isset($display_message) && $message!='') echo $message; ?>
					</div>
                    
                    <div id="login_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
						<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
					</div>
				</div>
                
                
				<ul class="tabs-nav">
                <?php if(isset($profile_details) && ($profile_details->user_type ==1 || $profile_details->user_type==3)){ ?>
                    <li class="active"><a href="#tab1"><?php echo lang('my_offers_online');?></a></li>
					<li><a href="#tab2"><?php echo lang('old_offers');?></a></li>
 
				<?php }else{?>
                   	<li><a href="#tab1"><?php echo lang('favourites_offers');?></a></li> 
                    <li><a href="#tab2">Recent comments</a></li> 
                <?php } ?>
               </ul>

				<!-- Tabs Content -->
				<div class="tabs-container">
					<div class="tab-content" id="tab1">
						<div id="welcome_item_list">
							<?php if(isset($profile_details) && ($profile_details->user_type ==1 || $profile_details->user_type==3)){ ?>
							<?php echo $this->template->block('ActiveOffers','dashboard/_active_offerlist.php');?>
                            <?php }else{?>
                            <?php echo $this->template->block('ActiveOffers','dashboard/_offers_you_like.php');?>
                            <?php } ?>
						</div>
					</div>
					
					<div class="tab-content" id="tab2">
						<div id="welcome_item_list">
                        	<?php if(isset($profile_details) && ($profile_details->user_type ==1 || $profile_details->user_type==3)){ ?>
							<?php echo $this->template->block('OldOfferList','dashboard/_old_offerlist.php');?>
                            <?php }else{?>
                            <?php echo $this->template->block('ActiveOffers','dashboard/_recent_comments.php');?>
                            <?php } ?>
						</div>
					</div>
					
                    <?php if(isset($profile_details) && ($profile_details->user_type ==1 || $profile_details->user_type==3)){ ?>
					<div class="tab-content" id="tab3">
						<div id="welcome_item_list">
							<?php echo $this->template->block('ActiveOffers','dashboard/_offers_you_like.php');?>
						</div>
					</div>
                    <?php } ?>
					
                    <?php if(isset($profile_details) && ($profile_details->user_type ==1 || $profile_details->user_type==3)){ ?>
					<div class="tab-content" id="tab4">
						<div id="welcome_item_list">
							<?php echo $this->template->block('ActiveOffers','dashboard/_recent_comments.php');?>
						</div>
					</div>
                    <?php } ?>
                    
				</div>
			</div>
			<div class="clearfix-big"></div>
		</div>
	</div>
</div>
<!-- End 960 Container -->
