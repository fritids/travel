<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public $latest_offer_limit=4;
	public $hotel_profile_for_map=50;
	function __construct(){
	    parent::__construct();
		// Your own constructor code
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Offerperiod_model','OfferPeriod');
		$this->load->model('offer_model','Offer');
		$this->load->model('settings_model','Settings');
		$this->load->model('attachment_model','Attachment');
		
	}
	
	public function index(){
		$this->template->set('dont_load_extra_js','true');
		$this->template->set('dont_load_extra_css','true');
		$this->load_latest_offers();
		$this->load_hotel_list_for_map($this->hotel_profile_for_map,0);
		
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->set('seo_title', lang('seo-title'));
		$this->template->set('seo_description', lang('seo_description'));
		$this->template->set('seo_keywords', lang('seo_keywords'));

		$this->template->render();
	}
	
	function load_latest_offers(){
		$latest_offers = $this->Offer->get_active_offers($user_id=NULL,$this->latest_offer_limit,$offset=0);
		$this->template->set('latest_offers',$latest_offers);
	}
	
	function load_hotel_list_for_map($limit,$offset){
		$hotel_list = $this->UserProfile->get_hotel_profiles($limit,$offset);		
		$this->template->set('hotel_list',$hotel_list);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */