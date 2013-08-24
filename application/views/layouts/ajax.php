<?php 

// per page scripts (string or array)
if(isset($page_js) AND $page_js != ''){
	if(is_array($page_js))
	 	foreach ($page_js as $js) 
			echo '<script type="text/javascript" src="'.JSPATH.$js.'.js"></script>';
	else 
		echo '<script type="text/javascript" src="'.JSPATH.$page_js.'.js"></script>';
}
// per page styles (string or array)
if(isset($page_css) AND $page_css != ''){
	if(is_array($page_css))	
		foreach ($page_css as $css)	
			echo '<link rel="stylesheet" type="text/css" href="'.CSSPATH.$css.'.css" />';
	else 
		echo '<link rel="stylesheet" type="text/css" href="'.CSSPATH.$page_css.'.css" />';
}
echo $this->template->yield(); 
?>