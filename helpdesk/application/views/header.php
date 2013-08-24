<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo config('site_name'); ?></title>



<!-- CSS -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/root.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/prettify.css" />

<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/ie7-style.css" /><![endif]-->

 

 <!-- JS -->

 <script src="<?php echo base_url(); ?>js/jquery.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>js/jquery.settings.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>js/prettify.js" type="text/javascript"></script>
 

</head>

<body>





<!-- Start Header -->

<div id="header">

<div class="center880">
<div class="logo"><a href="http://www.travelly.me"><img src="<?php echo base_url(); ?>images/logo.png" alt="Logo"/></a></div>
	
	<div class="links text-right">
	
	<?php if(is_login()){ ?>
	<?php if(userdata('department') == 0){ ?>
	<a href="<?php echo base_url('tickets/create'); ?>"><?php echo $this->lang->line('create_a_new_ticket'); ?></a> <a href="<?php echo base_url('tickets/index'); ?>"><?php echo $this->lang->line('all_tickets'); ?></a> <a href="<?php echo base_url('member/settings'); ?>"><?php echo $this->lang->line('settings'); ?></a>
	<?php }elseif(userdata('department') == 1){ ?>
	<a href="<?php echo base_url('member/user_list'); ?>"><?php echo $this->lang->line('user_management'); ?></a> <a href="<?php echo base_url('departments/index'); ?>"><?php echo $this->lang->line('departments'); ?></a> <a href="<?php echo base_url('tickets/index'); ?>"><?php echo $this->lang->line('all_tickets'); ?></a> 
    
    <a href="<?php echo base_url('member/settings'); ?>"><?php echo $this->lang->line('settings'); ?></a>
    

	<?php }else{ ?>
	<a href="<?php echo base_url('tickets/index'); ?>"><?php echo $this->lang->line('all_tickets'); ?></a>
	<?php } ?>
	<a href="<?php echo base_url('member/logout'); ?>"><?php echo $this->lang->line('logout'); ?></a>
	<?php }else{ ?>
	<a href="<?php echo base_url('member/login'); ?>"><?php echo $this->lang->line('login'); ?></a> 
	<a href="<?php echo base_url('member/create'); ?>"><?php echo $this->lang->line('create_a_new_account'); ?></a> 
	<a href="<?php echo base_url('member/lostpassword'); ?>"><?php echo $this->lang->line('forgot_my_password'); ?></a>
	<?php } ?>
	
	
	
	
	
	</div>
	<div class="clear"></div>	

</div>	

</div>

<!-- End Header -->

	<div class="clear-big"></div>	

