<?php
class User extends CI_Controller {
	private $first_limit = 12;
	private $second_limit = 5;
	private $first_offset = 0;
	public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation'));
			$this->load->helper('recaptcha');
       }
	   
	
	
	function login()
	{
		//$this->phpsession->clear();
		//print_r($_SESSION);
		if($this->input->post('signin'))
		{
			$this->userauthentication->authenticate_user();
		}
		
		$display_error=$this->phpsession->get('display_error');
		$this->template->assign('display_error',$display_error);
		$this->template->assign('error_message',$this->phpsession->get('error_message'));
		$this->phpsession->clear('display_error');
		$this->phpsession->clear('error_message');
		//$this->template->assign('reference',$this->uri->segment(1)); //will use it later for reference login
		$login_fail_counter = $this->phpsession->get('login_fail_counter');
		if($login_fail_counter>=3 && $login_fail_counter<6)
		{
			$this->template->assign('recaptcha_html',recaptcha());
			$this->template->assign('display_captcha','yes');
		}
		else if($login_fail_counter>=6)
		{
			$this->phpsession->save('login_fail_counter',3);
			redirect('user/recover','refresh');
			
		}
		$this->template->display('user/login.tpl');
	}
	
	
	
	function recover()
	{
		if($this->input->post('recovery_email_send'))
		{
			$this->recover_request();
		}
		
		$this->template->display('user/recover.tpl');
	}
	
	function recover_request()
	{
		$this->load->library('myvalidation');
		$email=$this->input->post('recovery_email');
		$valid_result=$this->myvalidation->validEmail($email);
		if($valid_result==FALSE)
			{
				$this->template->assign('display_submit_error','yes');
				$this->template->assign('display_message',$this->lang->line('invalid_email_change_pass'));
				return false;
			}
		else
			{
				$userid=$this->user_model->get_userid_by_email($email);
				if($userid==NULL)
				{
					$this->template->assign('display_submit_error','yes');
					$this->template->assign('display_message',$this->lang->line('email_not_registered'));
				}
				else
				{
					$request_code = md5(uniqid(rand(), true));
					$this->user_model->update_password_request_code($userid, $request_code);
					$replace['url']=base_url().'administration/user/changepassowrd/'.md5($userid).'/'.$request_code;
					
					$toemail=$email;
					$this->myemaillibrary->set_email_category('user_forgot_password');
					$this->myemaillibrary->send_email($toemail,$replace);
					$this->template->assign('success_message','yes');
					$this->template->assign('display_message',$this->lang->line('recover_email_sent_success'));
				}
			}
	}
	
	function changepassowrd($user_id=NULL,$request_code=NULL)
	{
		if($user_id!=NULL && $request_code!=NULL)
		{
			$is_valid = $this->user_model->validate_change_password_request($user_id,$request_code);
			if($is_valid) 
			{
				
				if($this->input->post('save_settings'))
				{
					$submitok=$this->validation_change_password();
					if($submitok)
					{
						$this->user_model->update_user_password($this->myvalidation->data,$this->userauthentication->get_loggedin_userid());
						$this->user_model->update_password_request_code_after_change($this->userauthentication->get_loggedin_userid());
						$this->template->assign('message',$this->lang->line('update_password_success'));
						$this->template->assign('update_success','true');
						
						$this->phpsession->clear();
						
						$this->phpsession->save('display_error','yes');
						$this->phpsession->save('error_message',$this->lang->line('update_password_success'));
						redirect('user/login','refresh');
					}
				}
				
				
				$userdetails = $this->user_model->get_user_details($user_id);
				if($userdetails!=NULL)
					{
						$this->phpsession->save('loggedin_username', $userdetails[0]->username);
						$this->template->assign('old_password_from_link', "true");
					}
				
				$this->template->assign('acocunt_head',$this->lang->line('user_settings'));	
				$this->template->assign('header','layout/header_inner.tpl');
				$this->template->assign('page','user/change_password.tpl');
				$this->template->display('layout/layout.tpl');
			}
			else
			{
				$this->phpsession->save('display_error','yes');
				$this->phpsession->save('error_message',$this->lang->line('not_valid_link_for_cp'));
				redirect('user/login','refresh');
			}
		}
	}
	
	function validation_change_password()
	{
		$this->myvalidation->validate_loginpassword();
		
		//print_r($this->myvalidation->data);
		//print_r($this->myvalidation->error);
		
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	
	
	function logout()
	{
		$is_loggedin = $this->userauthentication->is_loggedin();
		if($is_loggedin)
		{
			$logged_id_userid = $this->userauthentication->get_loggedin_userid();
			$this->user_model->remove_keepmesignin($logged_id_userid);
		}
		$this->phpsession->clear();
		redirect('','refresh');
	}
	
	function is_exist_username()
	{
		$username = $this->input->post("username");
		if($username!=NULL)
		{
			if($this->user_model->is_exist_username($username))
				echo "0";
			else
				echo "1";
		}
		
	}
	
	function is_exist_email()
	{
		$email = $this->input->post("email");
		if($email!=NULL)
		{
			if($this->user_model->is_exist_email($email))
				echo "0";
			else
				echo "1";
		}
	}
}
?>