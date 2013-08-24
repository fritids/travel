<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Myvalidation
{
public $error=array();
public $data;

    function Myvalidation()
    {
    	$this->obj =& get_instance();
		$this->obj->load->model('user_model');
    }
	
	function validate_fullname()
	{
		$this->data['full_name']=$this->obj->input->post('ful_name');
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if(strlen($this->data['full_name']) < 2)
			{
				array_push($this->error,'fullname_length'); 	
			}
			
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	function validate_full_biodata()
	{
		$this->data['biodata']= $this->obj->input->post('biodata');
		if($this->data['biodata']!=NULL && strlen($this->data['biodata']) > 200)
		{
			array_push($this->error,'biodata_length'); 
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	function validate_loginusername()
	{
		$this->data['username']=$this->obj->input->post('signup_username');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if($this->data['username']=='')
		{
			array_push($this->error,'username_blank');
		}
		else
		{
			if($this->obj->userauthentication->is_exist_username($this->data['username']))
			{
				array_push($this->error,'exist_this_username');
			}
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	function validate_old_password()
	{
		$this->data['old_password']=$this->obj->input->post('old_password');
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if(!$this->obj->user_model->is_valid_old_password($this->data['old_password'],$this->obj->userauthentication->get_loggedin_userid()))
		{
			array_push($this->error,'old_password_invalid'); 	
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	function validate_loginpassword()
	{
		$this->data['password']=$this->obj->input->post('signup_password');
		$this->data['retyped_password']=$this->obj->input->post('retype_password');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if ($this->data['password'  ] == '' )
		{
			array_push($this->error,'password_blank'); 		
		}
		else
		{
			if(strlen($this->data['password']) < 6)
			{
				array_push($this->error,'password_length'); 	
			}
		}
		
		
		if ($this->data['retyped_password'  ] == '')
		{
			array_push($this->error,'retyped_password_blank'); 		
		}
		
		if ($this->data['retyped_password'] != $this->data['password'])
		{
			array_push($this->error,'password_not_matched'); 		
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	
	function validate_loginemailaddress()
	{
		$this->data['email_address']=$this->obj->input->post('email');
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if ($this->data['email_address'	  ] == '')
		{ 		
			array_push($this->error,'email_blank');
		}
		else
		{
			if(!$this->validEmail($this->data['email_address']) )
			{
				array_push($this->error,'invalid_email');
			}
			else
			{
				if($this->obj->userauthentication->is_exist_email($this->data['email_address']))
				{
					array_push($this->error,'email_already_use');
				}
			}
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	function validate_user_settings()
	{
		$this->data['language']=$this->obj->input->post('user_lang');
		$this->data['timezone']=$this->obj->input->post('timezones');
		$this->data['email_links']=0; if($this->obj->input->post('email_likes')) $this->data['email_links']=1;
		$this->data['email_comments']=0; if($this->obj->input->post('email_comments')) $this->data['email_comments']=1;
		$this->data['email_subscriptions']=0; if($this->obj->input->post('email_subscriptions')) $this->data['email_subscriptions']=1;
		$this->data['email_follows']=0; if($this->obj->input->post('email_follows')) $this->data['email_follows']=1;
		$this->data['email_mentions']=0; if($this->obj->input->post('email_mentions')) $this->data['email_mentions']=1;
		
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if ($this->data['language'] == '')
		{ 		
			array_push($this->error,'language_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	function validate_invitation_code()
	{
		$this->obj->load->model('invitation_model');
		$this->data['invitation_code']=$this->obj->input->post('invitation_code');
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		if(!$this->obj->invitation_model->check_invitation_code($this->data))
			array_push($this->error,'invalid_invitation_code');
		else
			$this->obj->template->assign('invitation_code__is_valid', "true");
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	function validate_post_details()
	{
		$this->data['post_title']	= $this->obj->input->post('post_title');
		$this->data['post_body']	= $this->obj->input->post('post_body');
		$this->data['related_url']	= $this->obj->input->post('related_url');
		$this->data['post_tags']	= $this->obj->input->post('post_tags');
		$this->data['is_email_verified']= $this->obj->input->post('is_email_verified');		

		if($this->obj->input->post('is_public'))
			$this->data['is_public']	= "1";
		else
			$this->data['is_public']	= "0";
		
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if($this->data['is_email_verified'] == '0')
		{ 		
			array_push($this->error,'email_not_verified');
		}
		

		if ($this->data['post_title'] == '')
		{ 		
			array_push($this->error,'post_title_blank');
		}
		
		if ($this->data['post_body'] == '' || strlen($this->data['post_body']) < 80)
		{ 		
			array_push($this->error,'post_body_blank');
		}
		
		if ($this->data['related_url'] != '' && !$this->isValidURL($this->data['related_url']))
		{ 		
			array_push($this->error,'not_valid_url');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	function validate_match_details()
	{
		$this->data['date']	= $this->obj->input->post('date');
		$this->data['time']	= $this->obj->input->post('time');
		$this->data['timezone_offset']	= $this->obj->input->post('timezone_offset');
		$this->data['league']	= $this->obj->input->post('league');
		$this->data['home_team']	= $this->obj->input->post('home_team');
		$this->data['guest_team']	= $this->obj->input->post('guest_team');
		$this->data['is_email_verified']= $this->obj->input->post('is_email_verified');		

		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if($this->data['is_email_verified'] == '0')
		{ 		
			array_push($this->error,'email_not_verified');
		}		

		if ($this->data['date'] == NULL)
		{ 		
			array_push($this->error,'date_blank');
		}
		
		if ($this->data['time'] == NULL)
		{ 		
			array_push($this->error,'time_blank');
		}
		else
		{
			if (!$this->isvalid_match_time($this->data['time']))
    		{
				array_push($this->error,'wrong_match_time_format');
			}
		}
		
		if ($this->data['league'] == NULL)
		{ 		
			array_push($this->error,'league_blank');
		}
		
		if ($this->data['home_team'] == NULL)
		{ 		
			array_push($this->error,'home_team_blank');
		}
		
		if ($this->data['guest_team'] == NULL)
		{ 		
			array_push($this->error,'guest_team_blank');
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
	}
	
	function match_update_validate()
	{
		$this->data['match_id']	= $this->obj->input->post('update_match_id');
		$this->data['match_time']	= $this->obj->input->post('match_time');
		$this->data['match_event']	= $this->obj->input->post('match_event');
		$this->data['event_player']	= $this->obj->input->post('event_player');
		$this->data['team_radio']	= $this->obj->input->post('team_radio');
		$this->data['add_update_text']	= $this->obj->input->post('add_update_text');
		
		foreach($this->data as $key=>$value){
			$this->obj->template->assign($key, $value);
		}
		
		if ($this->data['match_time'] == NULL)
		{ 		
			array_push($this->error,'match_time_blank');
		}
		
		if($this->data['match_event']==NULL)
		{
			if ($this->data['add_update_text'] == NULL)
			{	 		
				array_push($this->error,'add_update_text_blank');
			}
		}
		
		if($this->data['add_update_text']!=NULL)
		{
			if(strlen($this->data['add_update_text']) > 340)
			{
				array_push($this->error,'add_update_text_length');
			}
		}
		
		if($this->data['match_event']!=NULL)
		{
			if($this->data['event_player']==NULL)
			{
				array_push($this->error,'event_player_blank');
			}
			if($this->data['team_radio'] == NULL)
			{
				array_push($this->error,'event_player_team_blank');
			}
		}
		
		foreach($this->error as $key=>$value){
			$this->obj->template->assign($value, 'true');
		}
		
	}
	
	
	
	
	function recaptcha_matches()
    {
        $this->obj->config->load('recaptcha');
        $public_key = $this->obj->config->item('recaptcha_public_key');
        $private_key = $this->obj->config->item('recaptcha_private_key');
        $response_field = $this->obj->input->post('recaptcha_response_field');
        $challenge_field = $this->obj->input->post('recaptcha_challenge_field');
        $response = recaptcha_check_answer($private_key,
                                           $_SERVER['REMOTE_ADDR'],
                                           $challenge_field,
                                           $response_field);
        if ($response->is_valid)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	
	
	function validEmail($data, $strict = false) 
	{ 
  		$regex = $strict? 
      	'/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' : 
       	'/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' 
  		; 
  		if (preg_match($regex, trim($data), $matches)) { 
    		return array($matches[1], $matches[2]); 
  		} else { 
    		return false; 
  		} 
	}
	
	function isvalid_match_time($time)
	{
		 return (bool)preg_match("/^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/",$time);
		//return preg_match('^([0-1][0-9]|[2][0-3])(:([0-5][0-9])){1,2}$', $url);
	}
	
	function isValidURL($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
	
}