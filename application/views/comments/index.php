<style type="text/css">
	@media only screen and (min-width: 960px) {#portfolio-wrapper img {min-height: 147px;}} 
	@media only screen and (min-width: 768px) and (max-width: 959px) {#portfolio-wrapper img {min-height: 115px;}}
</style>

<script src="<?php echo JSPATH;?>jquery.collapse.js"></script>

<?php echo $this->template->block('PageTopPanel','layouts/_page_top_panel.php');?>

<div class="clearfix-big"></div>


<!-- 960 Container -->
<div class="container">

<div class="four columns">
    <?php echo $this->template->block('NormalUserSummary','dashboard/_normal_user_summary.php');?>
</div>
			
						<div class="twelve columns alpha">
	<?php if(isset($profile_details) && $profile_details->is_complete==0) { ?>
                                    <?php echo $this->template->block('UserProfileIncompleteNotification','dashboard/_complete_profile_notification.php');?>
                                    <div class="clearfix"></div>
                                <?php } ?>


				<div class="twelve columns">
			<div class="dashboard_item background">
			<h3><?php echo lang('my_comments');?></h3>
			
			</div><div class="clearfix-big"></div></div>
			
			
                        <div class="twelve columns background">		
								
				<div id="welcome_item_list">
					<?php echo $this->template->block('UserCommentsList','comments/_users_comment_list.php'); ?>				
				</div>		
			</div>
			<div class="clearfix-big"></div>
		</div>
	</div></div>

</div>
<!-- End 960 Container -->
