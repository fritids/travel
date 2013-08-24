<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication
{
    public $username,$userid,$obj;
	public $no_of_dashboard_visit=0;
	public $user_authentication_counter=1;
	public $login_fail_counter=0;

    function __construct(){
		$this->obj =& get_instance();
		$this->obj->load->library('phpsession');
		$this->obj->load->model('user_model','User');
		$this->obj->load->model('userprofile_model','UserProfile');
		$this->obj->load->model('settings_model','SiteSetting');
		$this->obj->load->model('message_model','Message');
		$this->is_loggedin();
    }

	function authenticate_user($redirect=true){
		$username=$this->obj->input->post('username_email');
		$user_id = $this->obj->User->get_userid($username);
		$salt = $this->obj->User->get_salt($user_id);
		$password=hash_password($this->obj->input->post('password_signup'),$salt);
		$recaptcha_validate = $this->obj->input->post('recaptcha_validate');

		$auth_result=$this->obj->User->authenticate_user($username,$password);
		if($recaptcha_validate=="yes"){
			$privatekey=$this->obj->config->item('recaptcha_private_key');
			$resp =recaptcha_check_answer($privatekey,
                                			$_SERVER["REMOTE_ADDR"],
                                			$_POST["recaptcha_challenge_field"],
                                			$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid){
  				
				if($this->obj->phpsession->get('login_fail_counter'))
					$this->login_fail_counter = $this->obj->phpsession->get('login_fail_counter');
				
				$this->login_fail_counter++;
				$this->obj->phpsession->save('login_fail_counter',$this->login_fail_counter);
				$this->obj->phpsession->save('display_error','yes');
				$this->obj->phpsession->save('error_message',$this->obj->lang->line('login_fail_for_captcha'));
				redirect($this->obj->config->item('login_url'),'refresh');
			}
		}

		if($auth_result){
			//echo "here";
			//exit(0);
			$loggedin_username = $this->obj->User->get_username($username);
			$this->obj->phpsession->save('loggedin_username', $loggedin_username);
			$this->obj->phpsession->save('no_of_dashboard_visit', $this->no_of_dashboard_visit);
			$this->obj->phpsession->save('user_authentication_counter', $this->user_authentication_counter);
			$autoLogin = $this->obj->input->post('sign_in_remember_me');
			if($autoLogin){
				$username_cookie = array('name'   => 'usercookie',
				                   		'value'  => $username,
										'expire' => '1209600',
										'path'   => '/',
										'prefix' => 'travelly_',
										);
				$password_cookie = array('name'   => 'pcookie',
										'value'  => $password,
										'expire' => '1209600',
										'path'   => '/',
										'prefix' => 'travelly_',
										);
				set_cookie($username_cookie);
				set_cookie($password_cookie);
				$remember_me='1';
			}
			else{
				delete_cookie("travelly_usercookie");
				delete_cookie("travelly_pcookie");
				$remember_me='0';
			}

			$this->obj->User->update_keepmesignin($username,$remember_me);
			$usertype=$this->obj->User->getusertype($username);
			if($redirect){
				$redirect_url = $this->obj->phpsession->get("redirect_url");
				$this->obj->phpsession->clear('redirect_url');
				if($redirect_url!=NULL)
					redirect($redirect_url, 'refresh');
				else
					redirect($this->obj->config->item('dashboard_url'), 'refresh');
			}else
				return true;
		}
		else{
			if($this->obj->phpsession->get('login_fail_counter'))
				$this->login_fail_counter = $this->obj->phpsession->get('login_fail_counter');	
				$this->login_fail_counter++;
				$this->obj->phpsession->save('login_fail_counter',$this->login_fail_counter);
				if($redirect){
					//echo "there";
					//exit(0);
					$this->obj->phpsession->save('display_error','yes');
					$this->obj->phpsession->save('error_message',$this->obj->lang->line('login_fail_error'));
					redirect($this->obj->config->item('login_url'),'refresh');
				}else
					return false;
		}
	}
	
	function is_loggedin(){
		//print_r($_SESSION);
		//exit(0);
		$this->obj->phpsession->get('loggedin_username');
		if($this->obj->phpsession->get('loggedin_username')){
			$this->set_loggedin_username();
			$this->set_loggedin_userid();
			$this->set_loggedin_usertype();
			
			$profile_details = $this->obj->UserProfile->get_user_profile($this->userid);
			if($profile_details!=NULL){
				$this->obj->template->set('profile_details',$profile_details[0]);
				$this->obj->load->model('country_model','Country');
				$this->obj->load->model('geo_model','Geomodel');
				
				$this->obj->template->set('countries',$this->obj->Country->get_all());
				if($profile_details[0]->hotel_country!=NULL)
				$this->obj->template->set('states',$this->obj->Geomodel->get_states($profile_details[0]->hotel_country));
				if($profile_details[0]->hotel_state!=NULL)
				$this->obj->template->set('cities',$this->obj->Geomodel->get_cities($profile_details[0]->hotel_state));
				//if($profile_details[0]->hotel_city!=NULL)
				//$this->obj->template->set('comuni',$this->obj->Geomodel->get_comuni($profile_details[0]->hotel_city));
				
				$total_message = $this->obj->Message->get_total_new_message($profile_details[0]->user_id,NULL);
				$this->obj->template->set('total_message',$total_message);
				
				
				if($profile_details[0]->is_first_login=="1" || $this->obj->phpsession->get('is_first_login')){
					$this->obj->phpsession->save('is_first_login',"1");
					$this->obj->template->set('is_first_login',"1");
				}
			}
			$this->obj->template->set('is_loggedin','true');
			$this->obj->template->set('loggedin_username',$this->username);
			$this->obj->template->set('loggedin_usertype',$this->usertype);
			$this->obj->template->set('display_name',$this->obj->User->get_loggedin_display_name($this->username));

			return true;
		}
		else{
			$username_from_cookie = get_cookie('travelly_usercookie');
			//echo "<br>";
			$this->obj->template->set('username_from_cookie',$username_from_cookie);
			$password_from_cookie = get_cookie('travelly_pcookie');
			//echo "<br>";
			$is_remember_username = $this->obj->User->get_remember_me($username_from_cookie);
			if($is_remember_username){
				$auth_result=$this->obj->User->authenticate_user($username_from_cookie,$password_from_cookie);
				if($auth_result){
					$loggedin_username = $this->obj->User->get_username($username_from_cookie);
					$this->obj->phpsession->save('loggedin_username', $loggedin_username);
					$this->obj->phpsession->save('no_of_dashboard_visit', $this->no_of_dashboard_visit);
					$this->obj->phpsession->save('come_from_cookie', 'yes');
					$usertype=$this->obj->User->getusertype($loggedin_username);
					redirect('dashboard', 'refresh');
				}
			}
			else{
				$this->obj->template->set('is_loggedin','false');
				return false;
			}
		}
	}

	function is_exist_username($username){
		$is_exist=$this->obj->User->is_exist_username($username);
		if($is_exist)
			return true;
		else
			return false;
	}

	function is_exist_email($email_address){
		$is_exist=$this->obj->User->is_exist_email($email_address);
		if($is_exist)
			return true;
		else
			return false;
	}

    function set_loggedin_username(){
    	$this->username=$this->obj->phpsession->get('loggedin_username');
    }

	function get_loggedin_username(){
    	return $this->username;
    }

    function set_loggedin_userid(){
    	$this->userid=$this->obj->User->get_userid($this->username);
    }

	function get_loggedin_userid(){
		return $this->userid;
	}

	function get_loggedin_usertype(){
		return $this->usertype;
	}

	function set_loggedin_usertype(){
		$this->usertype=$this->obj->User->getusertype($this->username);
	}

	function check_uertype(){
		if($this->username!=NULL){
			//0 normal user, 1 premium user //will use later not first phase
			if($this->usertype==1){
				redirect('permissiondeny','refresh');
			}
		}
	}

	function check_sessionexpire(){
		if(!$this->is_loggedin()){
			$this->obj->phpsession->save('display_error','yes');
			$this->obj->phpsession->save('error_message',$this->obj->lang->line('session_expire_error'));
			$this->obj->phpsession->save('redirect_url',$_SERVER['REQUEST_URI']);
			redirect('users/login','refresh');
		}
	}
	
	function check_hotel_profile_credit_to_add_offer(){
		if($this->is_loggedin()){
			$credit_per_offer = $this->obj->SiteSetting->get_credit_per_offer();
			$users_available_credit = $this->obj->User->get_available_credit($this->userid);
			$getusertype = $this->obj->User->getusertype($this->username);
			$account_expire_date = $this->obj->User->get_account_expire_date($this->userid);
			
			if($getusertype==1){
				if($account_expire_date!=NULL){
					$date1 = date("Y-m-d");
					$date2 = $account_expire_date;
					$diff = strtotime($date2) - strtotime($date1);
					if($diff>=0) {
							$is_profile_complete = $this->obj->UserProfile->is_complete_profile($this->userid);
							if($is_profile_complete)
								return true;
							else{
								$this->obj->phpsession->save('show_profile_notification','yes');
								$this->obj->phpsession->save('profile_notification_message',lang('please_complete_your_profile'));
								redirect($this->obj->config->item('user_profile_edit_url'),'refresh');	
							}
						} 
					else{
							$this->obj->phpsession->save('show_payment_notification','yes');
							$this->obj->phpsession->save('payment_notification_message',lang('please_recharge_your_account'));
							redirect($this->obj->config->item('subscribe_credit_url'),'refresh');	
						}
				}
				else{
					$this->obj->phpsession->save('show_payment_notification','yes');
					$this->obj->phpsession->save('payment_message',lang('please_recharge_your_account'));
					redirect($this->obj->config->item('subscribe_credit_url'),'refresh');	
				}
			}else{
				$this->obj->phpsession->save('display_error','yes');
				$this->obj->phpsession->save('error_message',$this->obj->lang->line('dont_have_permission_to_buy_credit'));
				redirect($this->obj->config->item('dashboard_url'),'refresh');
			}
			
		}
	}
}

?>