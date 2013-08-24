<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
	private $first_limit = 20;
	private $second_limit = 12;
	private $first_offset = 0;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','myemaillibrary','twitter/twitteroauth'));
		$this->load->helper('recaptcha');
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('country_model','Country');
		$this->load->model('invitation_model','Invitation');
		
		$this->load->config('facebook');
		$facebook_config = array(
			'client_id' 	=> config_item('facebook_app_id'),
			'client_secret'	=> config_item('facebook_secret_key'),
			'callback_url'	=> base_url()."users/getFacebookData/",
			'access_token'	=> NULL
		);
		$this->load->library('facebook_oauth', $facebook_config);		
		
	}

	function login(){
		$is_loggedin_true = $this->authentication->is_loggedin();
		if($is_loggedin_true)
			redirect($this->config->item('dashboard_url'),'refresh');
			//print_r($_SESSION);
		if($this->input->post('signin')){
			$this->authentication->authenticate_user();
		}
		
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
		
		//$this->template->set('reference',$this->uri->segment(1)); //will use it later for reference login
		$login_fail_counter = $this->phpsession->get('login_fail_counter');
		if($login_fail_counter>=3 && $login_fail_counter<6){
			$this->template->set('recaptcha_html',recaptcha());
			$this->template->set('display_captcha','yes');
		}
		else if($login_fail_counter>=6){
			$this->phpsession->save('login_fail_counter',3);
			redirect($this->config->item('passrecover_url'),'refresh');
		}
		$this->template->set('page_js',array('login'));
		$this->template->render();
	}

	function logout(){
		$is_loggedin = $this->authentication->is_loggedin();
		if($is_loggedin){
			$logged_id_userid = $this->authentication->get_loggedin_userid();
			$this->User->update_first_login($logged_id_userid);
			$this->User->remove_keepmesignin($logged_id_userid);
		}
		$this->phpsession->clear();
		redirect('','refresh');
	}
	

	function signup($type=NULL, $invitation_code=NULL){
		$this->phpsession->save('signup_page_url',uri_string());		
		$is_loggedin_true = $this->authentication->is_loggedin();
		if($is_loggedin_true)
			redirect($this->config->item('dashboard_url'),'refresh');

		if($this->input->post('cretae_my_account')){
			//print_r($_POST);
			if($this->input->post('invitation_code'))
				$submitok=$this->validation($with_invitation_code=true);
			else
				$submitok=$this->validation($with_invitation_code=false);
			
			if($submitok){
				
				$user_id=$this->User->create_new_user($this->myvalidation->data);
				$this->UserProfile->create_user_profile($this->myvalidation->data,$user_id);
				$this->UserProfile->create_usershotel_profile($this->myvalidation->data,$user_id);
				$this->UserProfile->create_userspayment_profile($this->myvalidation->data,$user_id);
				$this->UserProfile->create_user_invoicing_profile($this->myvalidation->data,$user_id);
				$this->UserSetting->create_user_setting($this->myvalidation->data,$user_id);
				$this->Invitation->deactivate_code($this->myvalidation->data); //inactivate this line becasue fo removing invitation process
				if($this->input->post('invitation_code'))
					$this->User->update_users_account_permission($user_id);
				
				if($this->input->post("fb_uid") && $this->input->post("fb_oauth_token")){
					$fb_uid = $this->input->post('fb_uid');
					$fb_email = $this->input->post('fb_email');
					$fb_oauth_token = $this->input->post('fb_oauth_token');					
					$this->User->save_facebook_connection($fb_uid,$fb_email,$fb_oauth_token,$user_id);
					$this->UserSetting->set_facebook_connect($user_id);
				}
				
				if($this->input->post("tw_oauth_uid") && $this->input->post("tw_twitter_oauth_token")){
					$tw_oauth_uid = $this->input->post('tw_oauth_uid');
					$tw_twitter_oauth_token = $this->input->post('tw_twitter_oauth_token');
					$tw_twitter_oauth_token_secret = $this->input->post('tw_twitter_oauth_token_secret');					
					$this->User->save_twitter_connection($tw_oauth_uid,$tw_twitter_oauth_token,$tw_twitter_oauth_token_secret,$user_id);
					$this->UserSetting->set_twitter_connect($user_id);
				}
				
				$this->phpsession->save('loggedin_username',$this->myvalidation->data['username']);

				$toemail=$this->myvalidation->data['email_address'];				
				$replace['verify_link']=base_url().'users/verifyemail/'.md5($user_id).'/'.md5($this->myvalidation->data['email_address']);
				$this->myemaillibrary->set_email_category('user_signup');
				$this->myemaillibrary->send_email($toemail,$replace);
				redirect($this->config->item('dashboard_url'),'refresh');
			}
		}

		if($this->phpsession->get('facebook_data') && $this->phpsession->get('facebook_user_data')){
			$facebook_user_data = $this->phpsession->get('facebook_user_data');
			$facebook_data = $this->phpsession->get('facebook_data');
			$user_profile = $facebook_user_data['me'];
			if(isset($user_profile) && property_exists($user_profile, 'email')){
				if($user_profile->email!=""){
					$this->template->set('fb_email',$user_profile->email);
				}
				else{
					$this->template->set('fb_email_error',TRUE);
				}	
			}
			else
				$this->template->set('fb_email_error',TRUE);
							
			$this->template->set('fb_full_name',$user_profile->name);
			$this->template->set('fb_username',$user_profile->username);							
			$this->template->set('registration_through','facebook');
			$this->template->set('fb_uid',$user_profile->id);
			$this->template->set('fb_oauth_token',$facebook_data['fb_oauth_token']);
		}
		
		if($this->phpsession->get('twitter_data')){
			$twitter_data = $this->phpsession->get('twitter_data');
			if(array_key_exists('user_info',$twitter_data))
				$user_info = $twitter_data['user_info'];
				
			$this->template->set('tw_full_name',$user_info->name);
			$this->template->set('tw_username',$user_info->screen_name);							
			$this->template->set('registration_through','twitter');
			$this->template->set('tw_oauth_uid',$twitter_data['oauth_uid']);
			$this->template->set('tw_twitter_oauth_token',$twitter_data['twitter_oauth_token']);
			$this->template->set('tw_twitter_oauth_token_secret',$twitter_data['twitter_oauth_token_secret']);
		}
		
		$this->template->set('countries',$this->Country->get_all());
		$this->template->set('recaptcha_html',recaptcha());
		$this->template->set('page_js',array('signup','jquery.pstrength-min.1.2'));
		$this->template->set('account_type',$type);			
		$this->template->set('invitation_code',$invitation_code);			
		$this->template->render();
	}
	
	function validation($with_invitation_code=false){
		$this->myvalidation->validate_fullname();
		$this->myvalidation->validate_loginusername();
		$this->myvalidation->validate_loginemailaddress();
		if($with_invitation_code)
		$this->myvalidation->validate_invitation_code();
		$this->myvalidation->validate_loginpassword();
		//$this->myvalidation->validate_recaptcha();
		$this->myvalidation->data['send_newsletter'] = $this->input->post('send_newsletter');
		$this->myvalidation->data['timezone_offset'] = $this->input->post('timezone_offset');
		$this->myvalidation->data['account_type'] = $this->input->post('account_type');
		$this->myvalidation->data['user_country'] = $this->input->post('user_country');
		$this->template->set('account_type',$this->myvalidation->data['account_type']);
		$this->template->set('user_country',$this->myvalidation->data['user_country']);
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}

	function verifyemail($user_id=NULL,$md5_email=NULL){
		if($user_id!=NULL && $md5_email!=NULL){
			$is_valid = $this->User->validate_email_verification($user_id,$md5_email);
			if($is_valid){
				$this->User->set_email_as_verified($user_id,$md5_email);
				$userdetails = $this->User->get_user_details($user_id);
				if($userdetails!=NULL){
						$this->phpsession->save('loggedin_username', $userdetails[0]->username);
				}
				redirect($this->config->item('dashboard_url'),'refresh');
			}
			else{
				$this->phpsession->save('display_error','yes');
				$this->phpsession->save('error_message',$this->lang->line('not_valid_link_for_email_verification'));
				redirect($this->config->item('dashboard_url'),'refresh');
			}
		}
	}
	
	function invitation(){
		$is_loggedin_true = $this->authentication->is_loggedin();
		if($is_loggedin_true)
			redirect($this->config->item('dashboard_url'),'refresh');
		if($this->input->post('send_invitation_code')){
			$this->send_invitation_code();
		}
		//$this->template->set('recaptcha_html',recaptcha());
		$this->template->render();
	}
	
	function send_invitation_code(){
		$this->load->library('myvalidation');
		$this->load->model('invitation_model','Invitation');
		$email=$this->input->post('invitation_email');
		$is_valid_email = $this->myvalidation->validEmail($email);
		if(!$is_valid_email){
				$this->template->set('display_submit_error','yes');
				$this->template->set('display_message',$this->lang->line('invalid_email'));
				return false;
		}
		else{
				$userid=$this->User->get_userid_by_email($email);
				$email_get_invitation = $this->Invitation->have_already_code($email);
				if($userid!=NULL){
					$this->template->set('display_error','yes');
					$this->template->set('error_message',$this->lang->line('email_already_registered'));
				}
				else if($email_get_invitation!=NULL){
					$this->template->set('display_error','yes');
					$this->template->set('error_message',$this->lang->line('already_sent_invitation_code'));
				}
				else{
					$invitation_code = md5(uniqid(rand(), true));
					
					$this->Invitation->save_code($email, $invitation_code);
					$replace['url']= base_url().'users/signup/hotel-owner/'.$invitation_code;
					$replace['icode']= $invitation_code;
					
					$toemail=$email;
					$this->myemaillibrary->set_email_category('invitation_code');
					$this->myemaillibrary->send_email($toemail,$replace);
					$this->template->set('display_message','yes');
					$this->template->set('message',$this->lang->line('send_invitation_success'));
				}
			}
	}

	function recover(){
		$is_loggedin_true = $this->authentication->is_loggedin();
		if($is_loggedin_true)
			redirect($this->config->item('dashboard_url'),'refresh');
		if($this->input->post('recovery_email_send')){
			$this->recover_request();
		}
		$this->template->set('recaptcha_html',recaptcha());
		$this->template->render();
	}

	function recover_request(){
		$this->load->library('myvalidation');
		$email=$this->input->post('recovery_email');
		$this->myvalidation->validate_recaptcha();
		if(!empty($this->myvalidation->error)){
				$this->template->set('display_submit_error','yes');
				$this->template->set('display_message',$this->lang->line('invalid_email_change_pass'));
				return false;
		}
		else{
				$userid=$this->User->get_userid_by_email($email);
				if($userid==NULL){
					$this->template->set('email_not_registered',$this->lang->line('email_not_registered'));
				}
				else{
					$email = $this->User->get_useremail($email);
					$request_code = md5(uniqid(rand(), true));
					$this->User->update_password_request_code($userid, $request_code);
					$replace['url']=base_url().'users/changepassowrd/'.md5($userid).'/'.$request_code;
					
					$toemail=$email;
					$this->myemaillibrary->set_email_category('user_forgot_password');
					$this->myemaillibrary->send_email($toemail,$replace);
					$this->template->set('display_message','yes');
					$this->template->set('message',$this->lang->line('recover_email_sent_success'));
				}
			}
	}
	
	function changepassowrd($user_id=NULL,$request_code=NULL){
		if($user_id!=NULL && $request_code!=NULL){
			$is_valid = $this->User->validate_change_password_request($user_id,$request_code);
			if($is_valid){
				if($this->input->post('save_settings')){
					$submitok=$this->validation_change_password();
					if($submitok){
						$this->User->update_user_password($this->myvalidation->data,$this->authentication->get_loggedin_userid());
						$this->User->update_password_request_code_after_change($this->authentication->get_loggedin_userid());
						
						$this->phpsession->clear();
						$this->phpsession->save('display_message','yes');
						$this->phpsession->save('message',$this->lang->line('update_password_success'));

						redirect($this->config->item('login_url'),'refresh');
					}
				}
				$userdetails = $this->User->get_user_details($user_id);
				if($userdetails!=NULL){
					$this->phpsession->save('loggedin_username', $userdetails[0]->username);
					$this->authentication->is_loggedin();
					$this->template->set('old_password_from_link', "true");
				}
				$this->template->set('page_js',array('changepassword2','jquery.pstrength-min.1.2'));
				$this->template->render();
			}
			else{
				$this->phpsession->save('display_error','yes');
				$this->phpsession->save('error_message',$this->lang->line('not_valid_link_for_cp'));
				redirect($this->config->item('login_url'),'refresh');
			}
		}
		else{
				$this->phpsession->save('display_error','yes');
				$this->phpsession->save('error_message',$this->lang->line('not_valid_link_for_cp'));
				redirect($this->config->item('login_url'),'refresh');
			}
	}

	function validation_change_password(){
		$this->myvalidation->validate_loginpassword();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}

	function popuplogin(){
		if($this->input->post('signin')){
			$is_true = $this->authentication->authenticate_user($redirect=false);
			if($is_true)
				echo "1";
			else
				echo $this->lang->line('login_fail_error');
		}
	}

	

	

	
	

	

	

	function avatar($user_id=NULL,$height=NULL,$width=NULL){
		$avatar_name = $this->User->get_avatar_name($user_id);
		if($avatar_name!=NULL)
			$file_source = 'assets/avatar/'.$user_id."/".$avatar_name;
		else
			$file_source = 'assets/images/default_user_img.png';
		echo image_thumb($file_source, $height, $width);
	}

	function twitterlogin(){
		$twitteroauth = $this->twitteroauth->TwitterOAuth($this->config->item('YOUR_CONSUMER_KEY'),$this->config->item('YOUR_CONSUMER_SECRET'));
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$callback_url = base_url()."users/getTwitterData";
		$request_token = $this->twitteroauth->getRequestToken($callback_url);
		// Saving them into the session
		$this->phpsession->save('oauth_token',$request_token['oauth_token']);
		$this->phpsession->save('oauth_token_secret',$request_token['oauth_token_secret']);
		// If everything goes well..
		if ($this->twitteroauth->http_code == 200) {
			// Let's generate the URL and redirect
			$url = $this->twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			redirect($url,'refresh');
			//header('Location: ' . $url);
		} else {
			// It's a bad idea to kill the script, but we've got to know when there's an error.
			die('Something wrong happened.');
		}
	}


	function getTwitterData(){		
		if ($this->phpsession->get('oauth_token')!=NULL && $this->phpsession->get('oauth_token_secret')!=NULL ){
			// We've got everything we need
			$twitteroauth = $this->twitteroauth->TwitterOAuth($this->config->item('YOUR_CONSUMER_KEY'),$this->config->item('YOUR_CONSUMER_SECRET'), $this->phpsession->get('oauth_token'), $this->phpsession->get('oauth_token_secret'));
			// Let's request the access token
			$access_token = $this->twitteroauth->getAccessToken($_GET['oauth_verifier']);
			// Save it in a session var
			$_SESSION['access_token'] = $access_token;
			// Let's get the user's info
			$user_info = $this->twitteroauth->get('account/verify_credentials');
			// Print user's info
			if (isset($this->twitteroauth->error) && $this->twitteroauth->error==true) {
				// Something's wrong, go back to square 1  
				//header('Location: login-twitter.php');
				//redirect('user/login','refresh');
				echo $this->twitteroauth->error;
			} else {
				$user_oauth_id = $user_info->id;
				$is_already_authenticate = $this->User->is_already_connect_with_twitter($user_oauth_id);
				if($is_already_authenticate)
				{
					$authenticate_username = $this->User->get_username_from_oauth_id($user_oauth_id);
					$this->phpsession->save('loggedin_username', $authenticate_username);
					redirect($this->config->item('dashboard_url'), 'refresh');
				}
				else
				{	
					$twitter_data = array('oauth_uid'=>$user_info->id,
										'oauth_provider'=>'twitter',
										'twitter_oauth_token'=>$this->phpsession->get('oauth_token'),
										'twitter_oauth_token_secret'=>$this->phpsession->get('oauth_token_secret'),
										'user_info'=>$user_info);						
					$this->phpsession->save('twitter_data',$twitter_data);
						redirect($this->phpsession->get('signup_page_url'), 'refresh');
					

				}
				/*
				$username = $user_info->name;
				$user = new User();
				$userdata = $user->checkUser($uid, 'twitter', $username);
				if(!empty($userdata)){
					session_start();
					$_SESSION['id'] = $userdata['id'];
					$_SESSION['oauth_id'] = $uid;
					$_SESSION['username'] = $userdata['username'];
					$_SESSION['oauth_provider'] = $userdata['oauth_provider'];
					header("Location: home.php");
				}
				*/				
			}
		} 
		else 
		{
			// Something's missing, go back to square 1
			//header('Location: login-twitter.php');
			redirect($this->config->item('login_url'),'refresh');
		}
	}

	function facebooklogin(){
		$data = array();
		$this->phpsession->clear('facebook_user_data');
		$this->phpsession->clear('facebook_data');		
		if (isset($_GET['code'])) {						
			$this->data['token'] = $this->facebook_oauth->getAccessToken($_GET['code']);
			$this->data['me'] = $this->facebook_oauth->get('/me');
			//$this->data['friends'] = $this->facebook_oauth->get('/me/friends');
			var_dump($this->data);
		} 
		else {
			$scope = "email,publish_stream,offline_access,publish_stream";
			$this->data['auth_url'] = $this->facebook_oauth->getAuthorizeUrl($scope);
			redirect($this->data['auth_url'],'refresh');
		}
	}
	
	
	function getFacebookData(){
		$data = array();		
		if (isset($_GET['code'])) {
			if($this->phpsession->get('facebook_user_data')!=NULL){
				$this->data = $this->phpsession->get('facebook_user_data');
			}
			else{
				$this->data['token'] = $this->facebook_oauth->getAccessToken($_GET['code']);
				$this->data['me'] = $this->facebook_oauth->get('/me');
				//$this->data['friends'] = $this->facebook_oauth->get('/me/friends');
				$this->phpsession->save('facebook_user_data',$this->data);	
			}
			$user_profile = $this->data['me']; 
			$access_token = $this->data['token'];
			$uid="";
			$full_name="";
			$username="";
			$email="";
			if(isset($user_profile) && property_exists($user_profile, 'id'))
			$uid = $user_profile->id;
			if(isset($user_profile) && property_exists($user_profile, 'name'))
			$full_name = $user_profile->name;
			if(isset($user_profile) && property_exists($user_profile, 'username'))
			$username = $user_profile->username;
			if(isset($user_profile) && property_exists($user_profile, 'email'))
			$email = $user_profile->email;
			
			if($this->User->is_exist_facebook_email($email)){
				if(!$this->User->is_already_connect_with_facebook($email)){
					$user_id = $this->User->get_userid_by_email($email);
					$this->User->save_facebook_connection($uid,$email,$access_token,$user_id);
					$this->UserSetting->set_facebook_connect($user_id);
					$loggedin_username = $this->User->get_username($email);
					$this->phpsession->save('loggedin_username', $loggedin_username);
					$redirect_url = $this->phpsession->get("redirect_url");
					$this->phpsession->clear('redirect_url');
					if($redirect_url!=NULL)
						redirect($redirect_url, 'refresh');
					else
						redirect($this->config->item('dashboard_url'), 'refresh');
				}
				else{
						$loggedin_username = $this->User->get_username($email);
						$this->phpsession->save('loggedin_username', $loggedin_username);
						$redirect_url = $this->phpsession->get("redirect_url");
						$this->phpsession->clear('redirect_url');
						if($redirect_url!=NULL)
							redirect($redirect_url, 'refresh');
						else
							redirect($this->config->item('dashboard_url'), 'refresh'); 
				}
			}
			else{
					if($this->User->is_already_connect_with_facebook($email)){
						$loggedin_username = $this->User->get_username($email);
						$this->phpsession->save('loggedin_username', $loggedin_username);
						$redirect_url = $this->phpsession->get("redirect_url");
						$this->phpsession->clear('redirect_url');
						if($redirect_url!=NULL)
							redirect($redirect_url, 'refresh');
						else
							redirect($this->config->item('dashboard_url'), 'refresh'); 
					}
					else{
						$facebook_data = array(	'fb_uid'=>$uid,
												'fb_email'=>$email,
												'fb_oauth_token'=>$access_token,
												'fb_oauth_token_secret'=>NULL,
												'fb_full_name'=>$full_name);
						$this->phpsession->save('facebook_data',$facebook_data);
						redirect($this->phpsession->get('signup_page_url'), 'refresh');
					}
			}				
		} 
		else {
			$scope = "email,publish_stream,offline_access,publish_stream";
			$this->data['auth_url'] = $this->facebook_oauth->getAuthorizeUrl($scope);
			redirect($this->data['auth_url'],'refresh');
		}
	}
	
	
	
	function is_valid_old_password(){
		$password = $this->input->post("old_password");
		$user_id = $this->authentication->get_loggedin_userid();
		if($password!=NULL){
			if($this->User->is_valid_old_password($password,$user_id))
				echo "0";
			else
				echo "1";
		}	
	}
	
	function is_exist_username(){
		$username = $this->input->post("username");
		if($username!=NULL){
			if($this->User->is_exist_username($username))
				echo "0";
			else
				echo "1";
		}	
	}
	

	function is_exist_email(){
		$email = $this->input->post("email");
		if($email!=NULL){
			if($this->User->is_exist_email($email))
				echo "0";
			else
				echo "1";
		}
	}
}

?>