<!--  Page Title -->
<div id="search">
	<!-- 960 Container Start -->
	<div class="container">
		<div class="sixteen columns">
				<div id="navigation-dashboard">

		<ul id="nav">
				<li <?php if(isset($selected_tab) && $selected_tab=="profile") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_edit_url');?>"><?php echo lang('profile_nav');?></a></li>
				
				<?php if(isset($profile_details) && $profile_details->user_type==1) { ?>
				<li <?php if(isset($selected_tab) && $selected_tab=="lastminute") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('dashboard_lastminute_url');?>"><?php echo lang('offers_nav');?></a></li>
                <!-- <li><a href="<?php echo base_url();?><?php echo $this->config->item('subscribe_credit_url');?>">Credits: <?php echo $profile_details->available_credit;?></a></li> //-->
                <!-- <li><a href="<?php echo base_url();?><?php echo $this->config->item('subscribe_credit_url');?>"><?php echo lang('active_account');?></a></li> //-->
                <li <?php if(isset($selected_tab) && $selected_tab=="payment_settings") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('payment_bills_url');?>"><?php echo lang('payments_nav');?></a></li>
                <li <?php if(isset($selected_tab) && $selected_tab=="messages") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('messages_url');?>"><?php echo str_replace('#n',$total_message,lang('message_nav'));?></a></li>

				<?php } ?>
				
                <li <?php if(isset($selected_tab) && $selected_tab=="account") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('account_profile_edit_url');?>"><?php echo lang('account_nav');?></a></li>
                <li <?php if(isset($selected_tab) && $selected_tab=="comments") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo str_replace("%username%", $profile_details->username, $this->config->item('user_comments_url'));?>"><?php echo lang('comments_nav');?></a></li>
				
				
				
				
				<?php if(isset($profile_details) && $profile_details->user_type==3) { ?>
				<li <?php if(isset($selected_tab) && $selected_tab=="events") { ?>class="current" <?php } ?> ><a href="<?php echo base_url();?><?php echo $this->config->item('dashboard_event_url');?>">Events</a></li>
				<li><a href="payment.html">Payments</a></li>
				<?php } ?>
			</ul>
			<?php if(isset($profile_details) && $profile_details->user_type==1) { ?>
        		<a href="<?php echo base_url();?><?php echo $this->config->item('create_new_offer_url');?>" class="button small btn-red" style="float:right;"><?php echo lang('post_offer');?></a> 
            <?php }elseif(isset($profile_details) && $profile_details->user_type==3){ ?>
        		<a href="<?php echo base_url();?><?php echo $this->config->item('create_new_offer_url');?>" class="button small btn-red" style="float:right;"><?php echo lang('publish_event');?></a> 
			<?php }else{ ?>
            	<a href="<?php echo base_url();?><?php echo $this->config->item('user_profile_edit_url');?>" class="button small btn-red" style="float:right;"><?php echo lang('edit_profile');?></a> 
            <?php } ?>
			
					</div>

			
		</div>
	
		
	</div>
	<!-- 960 Container End -->
</div>
<!-- Page Title End -->