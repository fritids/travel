<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1&appId=163468447072879";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Header -->
<div id="header">
	<!-- 960 Container Start -->
	<div class="container ie-dropdown-fix">
		
		<!-- Logo -->
		<div class="five columns omega" style="width: auto; margin-top: 14px;">
			<a href="<?php echo base_url();?>">
				<img src="<?php echo IMAGEPATH; ?>logo.png" alt=""/>
			</a>
		</div>
		
		<!-- Main Navigation Start -->
		<div class="eleven columns">
			<div id="navigation">
				<ul id="nav">				
					<li><i class="icon-bookmark icon-white"></i> <a href="<?php echo base_url();?>"><?php echo lang('home'); ?></a></li>
					<li><i class="icon-calendar icon-white"></i> <a href="<?php echo base_url();?><?php echo $this->config->item('lastminute_page_url');?>"><?php echo lang('offers'); ?></a></li>
					<li><i class="icon-home icon-white"></i> <a href="<?php echo base_url();?><?php echo $this->config->item('hotel_page_url');?>"><?php echo lang('hotels'); ?></a></li>
        			<a style="margin-top:5px;margin-left:15px;" href="<?php echo base_url();?><?php echo $this->config->item('how_it_work_page_for_hotel_owner_url'); ?>" class="button small btn-red" style="float:right;">Post your offers</a> 
        		    <a style="margin-top:5px;margin-left:0px;" href="<?php echo base_url();?><?php echo $this->config->item('hotel_owner_signup_url'); ?>" class="button small btn-red" style="float:right;">Sign up</a> 

                </ul>
			</div>
	
			<div id="navigation-account" style="margin-top: 22px; padding-top: 0px;">
				<div style="float:right;">
					<?php //echo $this->template->block('languagepicker', 'layouts/_language_picker.php'); ?>
				</div>
				<div class="clearfix"></div>
				<ul id="nav">
					<?php if(isset($is_loggedin) && $is_loggedin=="true"){ ?>
					<li><a href="<?php echo base_url();?><?php echo $this->config->item('dashboard_url');?>"><?php echo lang('account'); ?></a></li>
                    <li><a href="<?php echo base_url();?><?php echo $this->config->item('logout_url');?>"><?php echo lang('signout'); ?></a></li>
                    <?php }else{ ?>
                    <li class="current"><a href="<?php echo base_url();?><?php echo $this->config->item('account_profile_edit_url');?>">My account</a></li>
                    <li><a href="<?php echo base_url();?><?php echo $this->config->item('login_url');?>">Login</a></li>
                    <?php } ?>
					
				</ul>
			</div>
		</div>
		<!-- Main Navigation End -->
	</div>
	<!-- 960 Container End -->

</div>
<!-- End Header -->