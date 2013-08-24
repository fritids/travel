<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller{
	private $first_limit = 10;
	private $second_limit = 10;
	private $first_offset = 0;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','fileuploader','myemaillibrary','pagination')); 
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Offerperiod_model','OfferPeriod');
		$this->load->model('offer_model','Offer');
		$this->load->model('settings_model','Settings');
		$this->template->set('selected_tab','messages');
		$this->load->model('attachment_model','Attachment');
		$this->load->model('message_model','Message');
	}

	function index($offset=NULL){
		$this->authentication->check_sessionexpire();
		$user_id = $this->authentication->get_loggedin_userid();
		$total_message = $this->Message->get_total_new_message($user_id,NULL);
		
		if($offset!=NULL)
			$offset = $offset;
		else
			$offset = $this->first_offset;
		
		$config['base_url'] = base_url().'messages/';
		$config['uri_segment'] = 2;
		$config['total_rows'] = $total_message;
		$config['per_page'] = $this->first_limit; 

		$this->pagination->initialize($config); 
		
		
		$new_messages = $this->Message->get_new_messages($user_id,NULL,$this->first_limit,$offset);
		$old_messages = $this->Message->get_old_messages($user_id,NULL);
		
		$this->template->set('total_message',$total_message);
		$this->template->set('new_messages',$new_messages);
		$this->template->set('old_messages',$old_messages);
		$this->template->set('pagination_links',$this->pagination->create_links());
		$this->template->render();
	}

	function delete($booking_request_id=NULL){
		$this->authentication->check_sessionexpire();
		$user_id = $this->authentication->get_loggedin_userid();
		$is_own_this_message = $this->Message->is_own_this_message($user_id,$booking_request_id);
		if($is_own_this_message && $booking_request_id!=NULL){
			$this->Message->delete($booking_request_id);
			redirect("messages","refresh");
		}
	}
	
}
?>