<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	private $first_limit = 50;
	private $second_limit = 10;
	private $first_offset = 0;
	public $max_number_of_list = 250;
	public $user_id;
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('offer_model','Offer');
		$this->load->model('comment_model','Comment');
		
		$this->authentication->check_sessionexpire();
		$this->user_id = $this->authentication->get_loggedin_userid();
		$this->template->set('is_dashboard',"true");
		
	}
	   
	function index(){
		$this->load_users_offers($this->user_id);
		$this->load_offers_you_like($this->user_id);
		$this->load_recent_comments($this->user_id);
		
		$display_error=$this->phpsession->get('display_error');
		$this->template->set('display_error',$display_error);
		$this->template->set('error_message',$this->phpsession->get('error_message'));
		$this->phpsession->clear('display_error');
		$this->phpsession->clear('error_message');
		
		$display_message = $this->phpsession->get('display_message');
		$this->template->set('display_message',$display_message);
		$this->template->set('message',$this->phpsession->get('message'));
		$this->phpsession->clear('display_message');
		$this->phpsession->clear('message');
		
		$this->template->set('selected_tab',"dashboard");
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating','comments'));
		$this->template->render();
	}
	
	function lastminute()
	{
		$this->load_users_offers($this->user_id);
		
		$display_error=$this->phpsession->get('display_error');
		$this->template->set('display_error',$display_error);
		$this->template->set('error_message',$this->phpsession->get('error_message'));
		$this->phpsession->clear('display_error');
		$this->phpsession->clear('error_message');
		
		$display_message = $this->phpsession->get('display_message');
		$this->template->set('display_message',$display_message);
		$this->template->set('message',$this->phpsession->get('message'));
		$this->phpsession->clear('display_message');
		$this->phpsession->clear('message');
		
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->set('selected_tab',"lastminute");
		$this->template->render();
	}


	function load_users_offers($user_id=NULL){
		$user_active_offers = $this->Offer->get_active_offers($user_id);
		$user_past_offers = $this->Offer->get_past_offers($user_id);
				
		$this->template->set('user_active_offers',$user_active_offers);
		$this->template->set('user_past_offers',$user_past_offers);
	}
	
	function load_offers_you_like($user_id){
		$offers_you_like = $this->Offer->get_offers_user_like($user_id);
		$this->template->set('offers_you_like',$offers_you_like);
	}
	
	function load_recent_comments($user_id){
		$my_recent_comments = $this->Comment->get_user_comments($user_id,$limit=NULL,$offset=NULL);
		$this->template->set('my_recent_comments',$my_recent_comments);
	}
	
	function account(){
		$this->template->set('selected_tab',"account");
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
	 
}
?>