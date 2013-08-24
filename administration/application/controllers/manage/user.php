<?php
class User extends CI_Controller {

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation','fileuploader'));
			$this->load->helper('recaptcha');			
			$this->load->model('manage/usermodel');
			
			$this->userauthentication->check_sessionexpire();
	}
	   
	function index(){
		$all_users = $this->usermodel->get_all_users();
		$this->template->assign('userlist',$all_users);
		$this->template->display('manage/user/index.tpl');
	}
	
	function delete($user_id=NULL){
		if($user_id!=NULL){			
			$this->usermodel->delete_user($user_id);
			redirect('index.php/manage/user','refresh');
		}
	}
	
	function block($user_id=NULL){
		if($user_id!=NULL){			
			$this->usermodel->block_user($user_id);
			redirect('index.php/manage/user','refresh');
		}
	}
}
?>