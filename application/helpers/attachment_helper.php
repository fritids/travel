<?php
function offer_default_attachment($offer_id=NULL){
	$ci = & get_instance();
	$ci->load->model('attachment_model','Attachment');
	$filename = $ci->Attachment->get_offer_default_attachment($offer_id);
	return $filename;
}

function offer_random_attachment($hotel_profile_id=NULL){
	$ci = & get_instance();
	$ci->load->model('attachment_model','Attachment');
	$filename = $ci->Attachment->get_hotelprofile_random_attachment($hotel_profile_id);
	return $filename;
}

function hotel_default_attachment($profile_id=NULL){
	$ci = & get_instance();
	$ci->load->model('attachment_model','Attachment');
	$filename = $ci->Attachment->get_hotelprofile_default_attachment($profile_id);
	return $filename;
}
?>