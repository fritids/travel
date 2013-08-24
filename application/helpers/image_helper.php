<?php

function image_thumb($image_path, $height, $width=NULL)
{
    $memory_limit='256M';
	ini_set('memory_limit', $memory_limit);

	// Get the CodeIgniter super object
    $CI =& get_instance();
	
	list($_width2, $_height2,$type2) = @getimagesize($image_path);
	
	
	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	$new_image_name = explode(".",$new_image_name);
	$new_image_name = $new_image_name[0];
	
	$img_thumb2 = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '2.'.image_type_to_extension($type2,false);	
	if (file_exists($img_thumb2))
	{
		return '<img src="' .base_url(). '' . $img_thumb2 . '" />';
	}
	else
	{
		
			// Path to image thumbnail
			//$image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
			$img_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.'.image_type_to_extension($type2,false);
		
			
		
			//if( ! file_exists($image_thumb))
			{
				// LOAD LIBRARY
				$CI->load->library('image_lib');
				
				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $image_path;
				$config['new_image']        = $img_thumb;
				$config['maintain_ratio']   = FALSE;
				$config['overwrite'] 		= TRUE; 
		
				$imageSize = $CI->image_lib->get_image_properties($config['source_image'], TRUE);
		
				if ($imageSize['width'] > $imageSize['height']) {
					$config['width'] = $imageSize['height'];
					$config['height'] = $imageSize['height'];
					$config['x_axis'] = (($imageSize['width'] / 2) - ($config['width'] / 2));
				}
				else {
					$config['height'] = $imageSize['width'];
					$config['width'] = $imageSize['width'];
					$config['y_axis'] = (($imageSize['height'] / 2) - ($config['height'] / 2));
				}
				
		
		
				$CI->image_lib->initialize($config);
				
				$CI->image_lib->crop();
				$CI->image_lib->clear();
			 }
		
				$img_thumb2 = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '2.'.image_type_to_extension($type2,false);
		
				$config['source_image']     = $img_thumb;
				$config['new_image']        = $img_thumb2;
				$config['maintain_ratio']   = FALSE;
				$config['overwrite'] 		= TRUE;
				$config['height']           = $height;
				if($width!=NULL)
				$config['width']            = $width;
				$CI->image_lib->initialize($config);
				
				$CI->image_lib->resize();
				$CI->image_lib->clear();
			
		return '<img src="' .base_url(). '' . $img_thumb2 . '" />';
	}
}


function image_resize($image_path, $height, $width=NULL)
{
    $memory_limit='256M';
	ini_set('memory_limit', $memory_limit);

	// Get the CodeIgniter super object
    $CI =& get_instance();
	
	list($_width2, $_height2,$type2) = @getimagesize($image_path);
	
	
	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	$new_image_name = explode(".",$new_image_name);
	$new_image_name = $new_image_name[0];
	
	$img_thumb2 = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '2.'.image_type_to_extension($type2,false);	
	if (file_exists($img_thumb2))
	{
		$return_url = base_url(). '' . $image_path;	
		return $return_url;
	}
	else
	{
		
			// Path to image thumbnail
			//$image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
			$img_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.'.image_type_to_extension($type2,false);
		
			
		
			//if( ! file_exists($image_thumb))
			{
				// LOAD LIBRARY
				$CI->load->library('image_lib');
				
				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $image_path;
				$config['new_image']        = $img_thumb;
				$config['maintain_ratio']   = FALSE;
				$config['overwrite'] 		= TRUE; 
		
				$imageSize = $CI->image_lib->get_image_properties($config['source_image'], TRUE);
		
				if ($imageSize['width'] > $imageSize['height']) {
					$config['width'] = $imageSize['height'];
					$config['height'] = $imageSize['height'];
					$config['x_axis'] = (($imageSize['width'] / 2) - ($config['width'] / 2));
				}
				else {
					$config['height'] = $imageSize['width'];
					$config['width'] = $imageSize['width'];
					$config['y_axis'] = (($imageSize['height'] / 2) - ($config['height'] / 2));
				}
				
		
		
				$CI->image_lib->initialize($config);
				
				$CI->image_lib->crop();
				$CI->image_lib->clear();
			 }
		
				$img_thumb2 = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '2.'.image_type_to_extension($type2,false);
				
				$config['source_image']     = $img_thumb;
				$config['new_image']        = $img_thumb2;
				$config['maintain_ratio']   = FALSE;
				$config['overwrite'] 		= TRUE;
				$config['height']           = $height;
				if($width!=NULL)
				$config['width']            = $width;
				$CI->image_lib->initialize($config);
				
				$CI->image_lib->resize();
				$CI->image_lib->clear();
		$return_url = base_url(). '' . $image_path;	
		return $return_url;
	}
}


function image_thumb_orginal($image_path, $height, $width=NULL)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	
	// Path to image thumbnail
    $image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
	
	//if( ! file_exists($image_thumb))
    {
		// LOAD LIBRARY
        $CI->load->library('image_lib');
		
		// CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = FALSE;
		$config['overwrite'] 		= TRUE;
        $config['height']           = $height;
		if($width!=NULL)
        $config['width']            = $width;
        $CI->image_lib->initialize($config);
		
		//$CI->image_lib->crop();
		$CI->image_lib->resize();
        $CI->image_lib->clear();
	 }
	
	return '<img src="' .base_url(). '/' . $image_thumb . '" />';
}



function post_image_resize($image_path, $height, $width=NULL)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	
	// Path to image thumbnail
    $image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
	
	//if( ! file_exists($image_thumb))
    {
		// LOAD LIBRARY
        $CI->load->library('image_lib');
		
		// CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
		$config['overwrite'] 		= TRUE;
        $config['height']           = $height;
		if($width!=NULL)
        $config['width']            = $width;
        $CI->image_lib->initialize($config);
		
		$CI->image_lib->resize();
        $CI->image_lib->clear();
	 }
	
	return '<img src="' .base_url(). '/' . $image_thumb . '" />';
}


function image_thumb_teamlogo($image_path, $height, $width)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	
	// Path to image thumbnail
    $image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
	
	//if( ! file_exists($image_thumb))
    {
		// LOAD LIBRARY
        $CI->load->library('image_lib');
		
		// CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
		$config['overwrite'] 		= TRUE;
        $config['height']           = $height;
		if($width!=NULL)
        $config['width']            = $width;
        $CI->image_lib->initialize($config);
		
		$CI->image_lib->resize();
        $CI->image_lib->clear();
	 }
	
	return '<img src="' .base_url(). '/' . $image_thumb . '" />';
}


function image_thumb_post_attachment($image_path,$width=NULL,$height=NULL,$post_title=NULL)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

	list($org_width, $org_height, $org_type, $org_attr) = getimagesize($image_path);
	if($org_width > 540)
		$width = 540;
	else
		$width = $org_width;
		
	if($org_height > 540)
		$height = 540;
	else
		$height = $org_height;

	
	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];
	
	// Path to image thumbnail
    $image_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.jpg';
	
	//if( ! file_exists($image_thumb))
    {
		// LOAD LIBRARY
        $CI->load->library('image_lib');
		
		// CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
		$config['overwrite'] 		= TRUE;
		$config['height']           = $height;
		$config['width']            = $width;
        $CI->image_lib->initialize($config);
		
		$CI->image_lib->resize();
        $CI->image_lib->clear();
	 }
	
	return '<img src="' .base_url(). '/' . $image_thumb . '" title="'.$post_title.'" alt="'.$post_title.'" />';
	
}


function image_thumb_new1($image_path, $height, $width=NULL)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

	list($_width2, $_height2,$type2) = getimagesize($image_path); 

	//echo $type2;

	$image_name = explode("/",$image_path);
	$new_image_name = $image_name[(sizeof($image_name)-1)];

	$img_path = $image_path;

	// Path to image thumbnail
    $img_thumb = dirname($image_path) . '/' . $new_image_name . $height . '_' . $width . '.'.image_type_to_extension($type2,false);

    $config['image_library'] = 'gd2';
    $config['source_image'] = $img_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = FALSE;

    //$img = imagecreatefromjpeg($img_path);
    //$_width = imagesx($img);
    //$_height = imagesy($img);
	list($_width, $_height,$type) = getimagesize($img_path); 

	$img_type = '';
    $thumb_size = $height;

    if ($_width > $_height)
    {
        // wide image
        $config['width'] = intval(($_width / $_height) * $thumb_size);
        if ($config['width'] % 2 != 0)
        {
            $config['width']++;
        }
        $config['height'] = $thumb_size;
        $img_type = 'wide';
    }
    else if ($_width < $_height)
    {
        // landscape image
        $config['width'] = $thumb_size;
        $config['height'] = intval(($_height / $_width) * $thumb_size);
        if ($config['height'] % 2 != 0)
        {
            $config['height']++;
        }
        $img_type = 'landscape';
    }
    else
    {
        // square image
        $config['width'] = $thumb_size;
        $config['height'] = $thumb_size;
        $img_type = 'square';
    }

    $CI->load->library('image_lib');
    $CI->image_lib->initialize($config);
    $CI->image_lib->resize();

    // reconfigure the image lib for cropping
    $conf_new = array(
        'image_library' => 'gd2',
        'source_image' => $img_thumb,
        'create_thumb' => FALSE,
        'maintain_ratio' => FALSE,
        'width' => $thumb_size,
        'height' => $thumb_size
    );

    if ($img_type == 'wide')
    {
        $conf_new['x_axis'] = ($config['width'] - $thumb_size) / 2 ;
        $conf_new['y_axis'] = 0;
    }
    else if($img_type == 'landscape')
    {
        $conf_new['x_axis'] = 0;
        $conf_new['y_axis'] = ($config['height'] - $thumb_size) / 2;
    }
    else
    {
        $conf_new['x_axis'] = 0;
        $conf_new['y_axis'] = 0;
    }

    $CI->image_lib->initialize($conf_new);

    $CI->image_lib->crop();
	
	return '<img src="' .base_url(). '/' . $img_thumb . '" id="'.$_width.'" />';

}


function get_canonical_link()
{
	$CI =& get_instance();
	$CI->load->library('uri');
	$CI->load->model('match_model');
	$CI->load->model('post_model');
	$page_type=$CI->uri->segment(1);
	$ref_id=$CI->uri->segment(2);
	
	if($page_type=="match" && $ref_id!=NULL && is_numeric($ref_id))
	{
		$match_details = $CI->match_model->get_match_details($ref_id);
		if($match_details!=NULL)
		{
			$parmalink = base_url()."match/".$match_details[0]->match_id."/".$match_details[0]->home_team."-".$match_details[0]->guest_team."-".$match_details[0]->league."-by-".$match_details[0]->username;
			$parmalink = str_replace(" ","-",$parmalink);
		}
		else
			$parmalink = site_url($CI->uri->uri_string());
	}
	elseif($page_type=="post" && $ref_id!=NULL && is_numeric($ref_id))
	{
		$post_details = $CI->post_model->get_post_details($ref_id);
		if($post_details!=NULL)
		{
			$parmalink = base_url()."post/".$post_details[0]->post_id."/".clean_url($post_details[0]->post_title)."-by-".$post_details[0]->username;
			$parmalink = str_replace(" ","-",$parmalink);
		}
		else
			$parmalink = site_url($CI->uri->uri_string());	
	}
	else
	{
		$parmalink = site_url($CI->uri->uri_string());
	}	
	
	
	
	return $parmalink;
}


function clean_url($string){
	$string=strtolower($string);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
	$string = str_replace($code_entities_match, $code_entities_replace, $string);	
	return $string;
	/*return $matches[0][0];*/
	}
?>