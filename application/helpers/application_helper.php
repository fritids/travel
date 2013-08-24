<?php
function short_description($text,$number_of_words=NULL){
	if($number_of_words==NULL) $number_of_words = 25;	
	$content_body = strip_tags($text);
	preg_match('/^([^.!?\s]*[\.!?\s]+){0,'.$number_of_words.'}/', strip_tags($content_body), $abstract);
	return $abstract[0].'...';
}

function short_title($title,$number_of_letter=NULL){
	if($number_of_letter==NULL) $number_of_letter = 30;	
	$title = strip_tags($title);
	if(strlen($title)<=$number_of_letter) return $title;
	else return substr($title, 0,$number_of_letter).'...';
	return $title;
}

function offer_seo_description($offer){
	$seo_description = strip_tags($offer->offer_package_description);
	return $seo_description;
}

function hotel_seo_description($hotel){
	$seo_description = strip_tags($hotel->hotel_description);
	return "";
}

function offer_seo_title($offer){
	$CI =& get_instance(); //offer %hotel_name% %city% - %offer_title%
	$seo_title = str_replace('%id%',$offer->offer_id,$CI->config->item('offers_seo_title'));
	$seo_title = str_replace('%city%',$offer->city_name,$seo_title);
	$seo_title = str_replace('%hotel_name%',$offer->hotel_name,$seo_title);
	$seo_title = str_replace('%offer_title%',$offer->offer_title,$seo_title);
	return $seo_title;
}

function hotel_seo_title($hotel){
	$CI =& get_instance(); //%hotel_type% a %city% - %hotel_name%
	$seo_title = str_replace('%id%',$hotel->user_id,$CI->config->item('hotel_seo_title'));
	if($hotel->hotel_city=="-1") $city = $hotel->hotel_town; else $city = $hotel->city_name;
	$seo_title = str_replace('%city%',$city,$seo_title);
	$seo_title = str_replace('%hotel_type%',$hotel->hotel_type,$seo_title);
	$seo_title = str_replace('%hotel_name%',$hotel->hotel_name,$seo_title);
	//$seo_title = str_replace(' ','-',$seo_title);
	return $seo_title;
}

function offers_url($offer){
	$CI =& get_instance();
	$url = str_replace('%id%',$offer->offer_id,$CI->config->item('offers_detail_url'));
	$url = str_replace('%location%',$offer->city_name,$url);
	$url = str_replace('%name%',$offer->hotel_name,$url);
	$url = str_replace('%title%',$offer->offer_title,$url);
	$url = str_replace(' ','-',$url);
	return $url;
}

function hotel_url($hotel){
	$CI =& get_instance();
	$url = str_replace('%id%',$hotel->user_id,$CI->config->item('hotel_detail_url'));
	if($hotel->hotel_city=="-1") $city = $hotel->hotel_town; else $city = $hotel->city_name;
	$url = str_replace('%location%',$city,$url);
	$url = str_replace('%star%',$hotel->hotel_rating,$url);
	$url = str_replace('%name%',$hotel->hotel_name,$url);
	$url = str_replace(' ','-',$url);
	return $url;
}

function is_liked_this_offer($offer_id,$user_id){
	$CI =& get_instance();
	$CI->load->model('offer_model','Offer');
	return $CI->Offer->is_liked_this_offer($offer_id,$user_id);
}

function is_liked_this_profile($hotel_id,$user_id){
	$CI =& get_instance();
	$CI->load->model('userprofile_model','UserProfile');
	return $CI->UserProfile->is_liked_this_profile($hotel_id,$user_id);
}

function is_followed_this_profile($hotel_id,$user_id){
	$CI =& get_instance();
	$CI->load->model('userprofile_model','UserProfile');
	return $CI->UserProfile->is_followed_this_profile($hotel_id,$user_id);
}
?>