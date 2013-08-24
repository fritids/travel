<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Offers extends CI_Controller{
	private $first_limit = 10;
	private $second_limit = 10;
	private $first_offset = 0;
	private $number_of_offer_attachment =10;
	public $number_of_random_offer=4;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','fileuploader','myemaillibrary'));
		$this->load->helper('recaptcha');
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Offerperiod_model','OfferPeriod');
		$this->load->model('offer_model','Offer');
		$this->load->model('settings_model','Settings');
		$this->template->set('selected_tab','lastminute');
		$this->load->model('attachment_model','Attachment');
	}
	
	function page(){
		$this->phpsession->clear('searched_parameter');
		redirect('offers','redirect');
	}
	
	function create(){
		$this->authentication->check_sessionexpire();
		$this->authentication->check_hotel_profile_credit_to_add_offer();
		$this->save_offer_information();
		
		$this->prepare_page_data();
		//$this->template->set('load_bootstrap_css',true);
		$this->template->set('settings',$this->Settings->load_settings());
		$this->template->set('page_js',array('lastminute'));
		$this->template->render();
	}
	
	function validate_offer_data(){
		$this->myvalidation->validate_offer_data();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function edit($offer_id=NULL){
		$this->authentication->check_sessionexpire();
		$this->save_offer_information();
		
		$this->load_offer_data($offer_id);
		$this->prepare_page_data();
		//$this->template->set('load_bootstrap_css',true);
		$this->template->set('offer_id',$offer_id);
		$this->template->set('settings',$this->Settings->load_settings());
		$this->template->set('page_js',array('lastminute'));
		$this->template->set('seo_title', lang('seo-title'));
		$this->template->set('seo_description', lang('seo_description'));
		$this->template->set('site_keywords', lang('site_keywords'));
		$this->template->render();
	}
	
	function cancel(){
		$user_id = $this->authentication->get_loggedin_userid();
		$offer_id=$this->input->post('offer_id');
		$is_owner = $this->Offer->is_owner($user_id,$offer_id);
		if($user_id!=NULL && $offer_id!=NULL){
			if($is_owner){
				$canceled = $this->Offer->cancel_offer($user_id,$offer_id);
				echo "1";	
			}
			else{
				echo lang('you_are_not_owner_of_this_offer');
			}
		}
	}
	
	function delete(){
		$user_id = $this->authentication->get_loggedin_userid();
		$offer_id=$this->input->post('offer_id');
		$is_owner = $this->Offer->is_owner($user_id,$offer_id);
		if($user_id!=NULL && $offer_id!=NULL){
			if($is_owner){
				$this->Offer->delete_offer($user_id,$offer_id);
				echo "1";	
			}
			else{
				echo lang('you_are_not_owner_of_this_offer');
			}
		}
	}
	
	function save_offer_information(){
		if($this->input->post('save_offer_informaiton')){
			$submitok = $this->validate_offer_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				//$this->upload_files($user_id);
				if(empty($this->fileuploader->error)){
					if($this->input->post('offer_id')){
						$this->myvalidation->data['offer_id'] = $this->input->post('offer_id'); 
						$this->Offer->update_offer($this->myvalidation->data,$user_id);
						$this->Service->update_offer_services($this->myvalidation->data,$this->myvalidation->data['offer_id']);
						$this->LastminuteTheme->update_offer_themes($this->myvalidation->data,$this->myvalidation->data['offer_id']);
						$this->OfferPeriod->update_offer_periods($this->myvalidation->data,$this->myvalidation->data['offer_id']);
						$this->Offer->update_offer_attachments($this->myvalidation->data,$this->myvalidation->data['offer_id']);
						$this->phpsession->save('display_message','yes');
						$this->phpsession->save('message',lang('offer_created_successfully'));
						redirect($this->config->item('dashboard_lastminute_url'),'refresh');
					}
					else{
						$offer_id = $this->Offer->create_new_offer($this->myvalidation->data,$user_id);
						$this->Service->update_offer_services($this->myvalidation->data,$offer_id);
						$this->LastminuteTheme->update_offer_themes($this->myvalidation->data,$offer_id);
						$this->OfferPeriod->update_offer_periods($this->myvalidation->data,$offer_id);
						$this->Offer->update_offer_attachments($this->myvalidation->data,$offer_id);
						$this->phpsession->save('display_message','yes');
						$this->phpsession->save('message',lang('offer_edit_successfully'));
						redirect($this->config->item('dashboard_lastminute_url'),'refresh');	
					}
				}
				else{
					$this->template->set('display_error',TRUE);
					$this->template->set('error_message',lang('file_size_limit_error'));
					$this->template->set('file_zise_limit_error','true');	
				}
			}
		}
	}
	
	function load_offer_data($offer_id=NULL){
		if($offer_id!=NULL){
			$offer_details = $this->Offer->get_offer_details($offer_id);
			$offer_services = $this->Service->get_offer_services($offer_id,$arr=TRUE);
			$offer_services_view = $this->Service->get_offer_services($offer_id,$arr=TRUE);			
			$offer_themes = $this->LastminuteTheme->get_offer_themes($offer_id,$arr=TRUE);
			$offer_periods = $this->OfferPeriod->get_offer_periods($offer_id,$arr=TRUE);
			$offer_attachments = $this->Attachment->get_offer_attachments($offer_id);
			
			if($offer_details!=NULL){
				$hotel_services_view = $this->Service->get_userprofile_hotel_services($offer_details->user_id,$arr=TRUE);
				$this->template->set('hotel_services_view',$hotel_services_view);	
				$this->load_users_active_offers($offer_details->user_id);
				$this->load_hotel_information($offer_details->user_id);
				
				$this->template->set('seo_title',offer_seo_title($offer_details));
				$this->template->set('seo_description',offer_seo_description($offer_details));
			}
			
			$this->template->set('offer_details',$offer_details);
			$this->template->set('existence_offer_services',$offer_services);
			$this->template->set('existence_offer_services_view',$offer_services_view);
			$this->template->set('existence_offer_themes',$offer_themes);
			$this->template->set('existence_offer_periods',$offer_periods);
			$this->template->set('existence_offer_attachments',$offer_attachments);
		}
	}
	
	function upload_files($user_id){
		$offer_attachment=array();
		for($i=1;$i<$this->number_of_offer_attachment;$i++){
			$form_field_name="offer_attachments_".$i;
			if($_FILES[$form_field_name]['name']!=NULL){
				$this->fileuploader->upload_offer_attachments($form_field_name,$user_id);
				$user_id = $this->authentication->get_loggedin_userid();
				$attachment_id = $this->Attachment->add_attachment($this->fileuploader->filedata,$user_id);
				array_push($offer_attachment,$attachment_id);
			}
		}
		 $this->myvalidation->data['offer_attachment'] = $offer_attachment;
	}
	
	function delete_offer_attachment($offer_id=NULL,$attachment_id=NULL){
		if($offer_id!=NULL && $attachment_id!=NULL){
			$user_id = $this->authentication->get_loggedin_userid();
			$this->Attachment->delete_attachment($attachment_id,$user_id);
			$this->Offer->delete_offer_attachment($offer_id,$attachment_id);
		}
	}
	
	function prepare_page_data(){
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$offer_peroids = $this->OfferPeriod->get_all();
		$offer_include_options =  $this->Offer->get_offer_include_options();
		
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		$this->template->set('offer_peroids',$offer_peroids);
		$this->template->set('offer_include_options',$offer_include_options);
	}
	
	function view($offer_id=NULL){
		if($offer_id!=NULL){
			$this->prepare_page_data();
			$this->load_offer_data($offer_id);
			$this->load_related_offers($offer_id);			
			$this->template->set('page_js',array('jquery.rating','listing'));
			$this->template->set('page_css',array('jquery.rating'));
			$this->template->render();
		}
	}
	
	function load_users_active_offers($user_id=NULL){
		if($user_id!=NULL){
			$user_active_offers = $this->Offer->get_active_offers($user_id);
			$this->template->set('user_active_offers',$user_active_offers);	
		}
	}
	
	function load_hotel_information($user_id=NULL){
		if($user_id!=NULL){
			$hotel_profile_information = $this->UserProfile->get_user_profile($user_id);
			$hotel_profile_services = $this->Service->get_userprofile_hotel_services($user_id,$arr=FALSE);
			$hotel_profile_themes = $this->LastminuteTheme->get_userprofile_hotel_themes($user_id,$arr=TRUE);
			$hotel_profile_attachments = $this->Attachment->get_profile_attachments($user_id);
			
			$this->template->set('hotel_profile_information',$hotel_profile_information);
			$this->template->set('hotel_profile_services',$hotel_profile_services);
			$this->template->set('hotel_profile_themes',$hotel_profile_themes);
			$this->template->set('hotel_profile_attachments',$hotel_profile_attachments);
		}
	}
	
	function load_related_offers($offer_id=NULL){
		$related_offers = $this->Offer->get_random_offer($offer_id,$this->number_of_random_offer, $offset=0);
		$this->template->set('related_offers',$related_offers);
	}
	
	
	
	
	function like_offer(){
		$offer_id = $this->input->post('offer_id');
		if($offer_id!=NULL){
			if($this->authentication->is_loggedin()){
				$offer_details = $this->Offer->get_offer_details($offer_id);
				$user_id = $this->authentication->get_loggedin_userid();
				
				if(!$this->Offer->have_already_liked_indb($offer_id,$user_id)){
					$this->Offer->like_offer($offer_id,$user_id);
					$this->Offer->update_offer_like_number($offer_id);
					echo "1";
				}
				else{
					$like_status = $this->Offer->get_offer_like_status($offer_id,$user_id);
					if($like_status=="0"){
						$this->Offer->set_like_on_offer($offer_id,$user_id);
						$this->Offer->update_offer_like_number($offer_id);
						echo "1";
					}
					elseif($like_status=="1"){
						$this->Offer->unlike_offer($offer_id,$user_id);
						$this->Offer->update_offer_like_number_decrease($offer_id);
						echo "0";
					}
				}
			}
			else
				echo "You have to log into the system for like match.";
		}
	}
	
	function bookong_request(){
		if($this->input->post('request_booking')){
			$submitok = $this->validate_booking_form();
			if($submitok){
				$this->Offer->save_booking_request($this->myvalidation->data);
				$offer_id = $this->input->post('offer_id');
				$offer_details = $this->Offer->get_offer_details($offer_id);
				if($offer_details!=NULL){
					$toemail=$offer_details->email;				
					$replace['hotel_offer_link'] = base_url().offers_url($offer_details);
					$replace['requester_name']= $this->myvalidation->data['booking_name'];
					$replace['offer_name']= $offer_details->offer_title;
					foreach($this->myvalidation->data as $key=>$value){
						$replace[$key] = $value;
					}
					//$toemail = "ashish021@gmail.com";					
					$this->myemaillibrary->set_email_category('booking_request');
					$this->myemaillibrary->send_email($toemail,$replace);
					$this->template->current_view = 'offers/booking_request_success';
					$this->template->render();
				}
			}
		}
	}
	
	function validate_booking_form(){
		$this->myvalidation->validate_booking_data();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function delete_offerattachment(){
		$offerattachment_id = $this->input->post('offerattachment_id');
		$offer_id = $this->input->post('offer_id');
		if($offerattachment_id!=NULL && $offer_id!=NULL){
			$this->Offer->delete_offerattachment($offer_id,$offerattachment_id);
			echo "1";
		}
	}
	
	
	
}
?>