<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller{
	public $user_id;
	private $first_limit = 20;
	private $second_limit = 12;
	private $first_offset = 0;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','myemaillibrary'));
		$this->load->helper('recaptcha');
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('comment_model','Comment');
		$this->template->set('selected_tab','comments');
	}
	
	function index($username=NULL){
		$this->authentication->check_sessionexpire();
		$this->user_id = $this->authentication->get_loggedin_userid();
		$comments_list = $this->Comment->get_user_comments($this->user_id,$this->first_limit,$this->first_offset);
		$this->template->set('comments_list',$comments_list);
		
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating','comments'));
		$this->template->render();
	}
	
	function create(){
	 	if($this->authentication->is_loggedin()){
			$loggedin_userid = $this->authentication->get_loggedin_userid();
			$hotel_id = $this->input->post('commented_hotel_id');
			if($hotel_id!=NULL){
				$hotel_details = $this->UserProfile->get_user_profile($hotel_id);
				
				$data['comment'] = $this->input->post('comment_content');
				$data['parent_id'] = $this->input->post('comment_parent');
				$data['comment_by'] = $loggedin_userid;
				$data['hotel_id'] = $hotel_id;
				$data['insert_comment_id'] = $this->Comment->add_new_comment_for_hotel($data);
				
				$this->UserProfile->update_hotel_comment_number($data['hotel_id']);
				$comment_details = $this->Comment->get_comment($data['insert_comment_id']);
				$this->template->set('comment',$comment_details);
				$this->template->render();
			}
			else{
				echo "0";
			}
	 	}
	}
	
	function delete_comment(){
		$user_id = $this->authentication->get_loggedin_userid();
		$comment_id = $this->input->post('comment_id'); 
		if($comment_id!=NULL && $user_id!=NULL){
			$this->Comment->delete_comment_root_comment($comment_id,$user_id);
			echo "1";	
		}
	}
}
?>