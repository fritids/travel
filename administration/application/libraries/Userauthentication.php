<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * AuthLib Class
 *
 * Security handler that provides functionality to handle logins and logout
 * requests.  It also can verify the logged in status of a user and permissions.
 *
 * The class requires the use of the Database and Encrypt CI libraries and the
 * URL CI helper.  It also requires the use of the Session
 * library.  The Userauthentication library should be auto loaded in the core classes section
 * of the autoloader.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Security
 * @author      Ashish
 * @copyright   Copyright (c) 2011, Ideaincube Inc
 *
 */

// ------------------------------------------------------------------------
class Userauthentication
{
    public $username,$userid,$obj;
	public $no_of_dashboard_visit=0;
	public $user_authentication_counter=1;
	public $login_fail_counter=0;
	
    function Userauthentication()
    {
		$this->obj =& get_instance();
		$this->obj->load->library(array('phpsession'));
		$this->obj->load->model(array('user_model','user_profile_model'));
		$this->is_loggedin();
    }
	
	
	function authenticate_user($redirect=true)
	{
		$username=$this->obj->input->post('username_email');
		$user_id = $this->obj->user_model->get_userid($username);
		$salt = $this->obj->user_model->get_salt($user_id);
		$password=hash_password($this->obj->input->post('password_signup'),$salt);
		$recaptcha_validate = $this->obj->input->post('recaptcha_validate');
		
		$auth_result=$this->obj->user_model->authenticate_user($username,$password);
		if($recaptcha_validate=="yes")
			{
				$privatekey="6Lc82csSAAAAAJWTogEPyuf2Xh-Tjvt-ysxTnpOj";
				$resp =recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
				if (!$resp->is_valid) 
				{
  					if($this->obj->phpsession->get('login_fail_counter'))
					$this->login_fail_counter = $this->obj->phpsession->get('login_fail_counter');
					$this->login_fail_counter++;
					$this->obj->phpsession->save('login_fail_counter',$this->login_fail_counter);
				
					$this->obj->phpsession->save('display_error','yes');
					$this->obj->phpsession->save('error_message',$this->obj->lang->line('login_fail_for_captcha'));
					redirect('user/login','refresh');
				}
			}
		

		if($auth_result)
			{
				//echo "here";
				//exit(0);
				$loggedin_username = $this->obj->user_model->get_username($username);
				$this->obj->phpsession->save('loggedin_username', $loggedin_username);
				$this->obj->phpsession->save('no_of_dashboard_visit', $this->no_of_dashboard_visit);
				$this->obj->phpsession->save('user_authentication_counter', $this->user_authentication_counter);
				$autoLogin = $this->obj->input->post('sign_in_remember_me');
              
			    if ($autoLogin)
					{
						
						$username_cookie = array(
                   		'name'   => 'usercookie',
                   		'value'  => $username,
                   		'expire' => '1209600',
                   		'path'   => '/',
                   		'prefix' => 'foooblr_admin_',
                   		);
                   		$password_cookie = array(
                   		'name'   => 'pcookie',
                   		'value'  => $password,
                   		'expire' => '1209600',
                   		'path'   => '/',
                   		'prefix' => 'foooblr_admin_',
                   		);
                   		set_cookie($username_cookie);
						set_cookie($password_cookie);
						$remember_me='1';
					}
				else
					{
						delete_cookie("foooblr_admin_usercookie");
						delete_cookie("foooblr_admin_pcookie");
						$remember_me='0';
					}
			  
				$this->obj->user_model->update_keepmesignin($username,$remember_me);
				
				$usertype=$this->obj->user_model->getusertype($username);
				
				if($redirect)
					redirect('dashboard', 'refresh');
				else
					return true;
				
			}
		else
			{
				if($this->obj->phpsession->get('login_fail_counter'))
					$this->login_fail_counter = $this->obj->phpsession->get('login_fail_counter');	
				
				$this->login_fail_counter++;
				$this->obj->phpsession->save('login_fail_counter',$this->login_fail_counter);
				if($redirect)
				{
					//echo "there";
					//exit(0);
					$this->obj->phpsession->save('display_error','yes');
					$this->obj->phpsession->save('error_message',$this->obj->lang->line('login_fail_error'));
					redirect('user/login','refresh');
				}
				else
					return false;
			}
	}
	
    function is_loggedin()
    {
		$this->obj->phpsession->get('loggedin_username');
		//exit(0);
		if($this->obj->phpsession->get('loggedin_username'))
			{
				$this->set_loggedin_username();
				$this->set_loggedin_userid();
				$this->set_loggedin_usertype();
				
				$profile_details = $this->obj->user_profile_model->get_user_profile($this->userid);
				if($profile_details!=NULL)
						$this->obj->template->assign('profile_details',$profile_details[0]);

				$this->obj->template->assign('is_loggedin','true');
				$this->obj->template->assign('loggedin_username',$this->username);
				$this->obj->template->assign('loggedin_usertype',$this->usertype);
				$this->obj->template->assign('display_name',$this->obj->user_model->get_loggedin_display_name($this->username));
				
				return true;
			}
		else
			{
				
				$username_from_cookie = get_cookie('foooblr_admin_usercookie');
				$this->obj->template->assign('username_from_cookie',$username_from_cookie);
				$password_from_cookie = get_cookie('foooblr_admin_pcookie');
				$is_remember_username = $this->obj->user_model->get_remember_me($username_from_cookie);
				if($is_remember_username)
				{
					$auth_result=$this->obj->user_model->authenticate_user($username_from_cookie,$password_from_cookie);
					if($auth_result)
					{
						$loggedin_username = $this->obj->user_model->get_username($username_from_cookie);
						$this->obj->phpsession->save('loggedin_username', $loggedin_username);
						$this->obj->phpsession->save('no_of_dashboard_visit', $this->no_of_dashboard_visit);
						$usertype=$this->obj->user_model->getusertype($loggedin_username);
						redirect('dashboard', 'refresh');
					}
					
				}
				else
				{
					$this->obj->template->assign('is_loggedin','false');
					return false;
				}
			}
    }
	
	
	function is_exist_username($username)
	{
		$is_exist=$this->obj->user_model->is_exist_username($username);
		if($is_exist)
		return true;
		else
		return false;
	}
	
	function is_exist_email($email_address)
	{
		$is_exist=$this->obj->user_model->is_exist_email($email_address);
		if($is_exist)
			return true;
		else
			return false;
	}

    function set_loggedin_username()
    {
    	$this->username=$this->obj->phpsession->get('loggedin_username');
    }
	
    function get_loggedin_username()
    {
    	return $this->username;
    }

    function set_loggedin_userid()
    {
    	$this->userid=$this->obj->user_model->get_userid($this->username);
    }

    function get_loggedin_userid()
    {
		return $this->userid;
    }
	
	function get_loggedin_usertype()
	{
		return $this->usertype;
	}
	
	function set_loggedin_usertype()
	{
		$this->usertype=$this->obj->user_model->getusertype($this->username);
	}
	
	function check_uertype()
	{
		if($this->username!=NULL)
		{
			//0 normal user, 1 premium user //will use later not first phase
			if($this->usertype==1)
			{
				redirect('permissiondeny','refresh');
			}
		}
	}
	
	function check_sessionexpire()
	{
		if(!$this->is_loggedin())
		{
			$this->obj->phpsession->save('display_error','yes');
			$this->obj->phpsession->save('error_message',$this->obj->lang->line('session_expire_error'));
			redirect('user/login','refresh');
		}
	}
	
}
?>