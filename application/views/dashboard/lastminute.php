<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>

				<div class="clearfix-big"></div>

	<!-- 960 Container -->
<div class="container">

<div class="four columns">

    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>			

					<?php echo $this->template->block('AddNewLastMinuteNotification','dashboard/_add_new_lastminute_notification.php'); ?>			

					<div class="clearfix-small"></div>

<div class="background">
			<div id="default-example-info" data-collapse>
										                        <h5 class="open"><?php echo lang('my_offers_online');?></h5>
										                       <div>
																		<?php echo lang('my_offers_online_description');?>
										                       </div> 
										                       
										                       <h5><?php echo lang('old_offers');?></h5>
										                       <div>
																		<?php echo lang('old_offers_description');?>

										                       </div> 
										                       
										                     
										                       </div>
										                       
										                       
			       </div></div>
			
			
	
									<div class="twelve columns">		
					
					
					
					
					<div style="margin-bottom:0px;">
						<div id="profile_edit_message" class="success_message" style="<?php if(isset($display_message) && $message!='') echo "display:block;"; ?>">
							<?php if(isset($display_message) && $message!='') echo $message; ?>
						</div>
	                    
	                    <div id="login_error_message" class="error_message" style="<?php if(isset($display_error) && $error_message!='') echo "display:block;"; ?>">
							<?php if(isset($display_error) && $error_message!='') echo $error_message; ?>
						</div>
					</div>

					<div class="background">
					<ul class="tabs-nav">
						<li class="active"><a href="#tab1"><?php echo lang('my_offers_online');?></a></li>
						<li><a href="#tab2"><?php echo lang('old_offers');?></a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1">
							<div id="welcome_item_list">
								<?php echo $this->template->block('ActiveOffers','dashboard/_active_offerlist.php');?>
							</div>
						</div>
						
						<div class="tab-content" id="tab2">
							<div id="welcome_item_list">
								<?php echo $this->template->block('OldOffers','dashboard/_old_offerlist.php');?>
							</div>
						</div>
					</div>
				</div>
				</div>
				
				
				<div class="clearfix-big"></div>
		</div></div>
		<!-- End Project Title-->
	</div>
	<!-- End 960 Container -->
