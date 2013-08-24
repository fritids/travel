<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="it"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="it"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="it"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="it"><!--<![endif]-->
<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <title><?php if(isset($seo_title)) echo $seo_title; else echo $site_name; ?> </title>
	    <meta name="description" content="<?php if(isset($seo_description)) echo $seo_description; else echo $site_description; ?>" />
	    <meta name="keywords" content="<?php if(isset($seo_keywords)) echo $seo_keywords; else echo $site_keywords; ?>" />
	    <meta name="author" content="studiomodo">
	    <link rel="canonical" href="<?php //echo current_url(); ?>" />  <!-- this line is for load canonocal url using helper function, have to implement later after development-->  
	    <meta http-equiv="expires" content="0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="p:domain_verify" content="bf686c79e1fc9d362981be317a871e61" />

<meta name="google-site-verification" content="HSKucyailJ9ne6p-IGQX4SqTLd2bZEFu-P7UBnppnSs" />
		<meta http-equiv="cache-control" content="no-cache, no-store, proxy-revalidate, must-revalidate" />							    
		<?php 
        echo $this->template->block('name', 'layouts/_stylesheets'); 	
        echo $this->template->block('name', 'layouts/_javascripts'); 
        ?>
	</head>
	<body>
	    <?php echo $this->template->block('Header', 'layouts/_header.php'); ?>
		<?php //echo $this->template->block('navHeadermenu', 'layouts/_navigation_menu.php'); ?>
				
		<?php echo $this->template->message(); ?>
		<?php echo $this->template->yield(); ?>
		
	    <?php echo $this->template->block('footer', 'layouts/_footer.php'); ?>
        <?php echo $this->template->block('UserSigninPopup','users/user_signin_popup.php');?>	
	</body>
</html>
