<!-- CSS
 ================================================== -->
<?php if(isset($load_bootstrap_css)) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo JSPATH?>richeditor/lib/css/bootstrap.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo JSPATH?>richeditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo JSPATH?>richeditor/src/bootstrap-wysihtml5.css"></link>
<?php } ?>

<link rel="stylesheet" type="text/css"  href="<?php echo CSSPATH;?>style.css">
<?php if(!isset($dont_load_extra_css)) { ?>
<link rel="stylesheet" href="<?php echo CSSPATH; ?>jquery-ui.css" />

<link rel="stylesheet" href="<?php echo CSSPATH; ?>jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo CSSPATH; ?>jslider.blue.css" type="text/css">

<link rel="stylesheet" href="<?php echo CSSPATH; ?>extra.css" type="text/css">
<link rel="stylesheet" href="<?php echo CSSPATH; ?>uniform.default.css" type="text/css" media="screen">

<link rel="stylesheet" href="<?php echo CSSPATH; ?>grid.css" type="text/css">
<?php } ?>
<style type="text/css">
	@media only screen and (min-width: 960px) {#portfolio-wrapper img {min-height: 147px;}} 
	@media only screen and (min-width: 768px) and (max-width: 959px) {#portfolio-wrapper img {min-height: 115px;}}
</style>
<?php
	// per page styles (string or array)
	if(isset($page_css) AND $page_css != ''){
		if(is_array($page_css))	foreach ($page_css as $css)	echo '<link rel="stylesheet" type="text/css" href="'.CSSPATH.$css.'.css" />';
		else echo '<link rel="stylesheet" type="text/css" href="'.CSSPATH.$page_css.'.css" />';
	}
?>