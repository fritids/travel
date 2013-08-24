<?php

class Usersetting_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	function create_user_setting($data,$user_id){
		if($data['send_newsletter']==1) $this->db->set('send_newsletter','1'); else $this->db->set('send_newsletter','0');
		$this->db->set('user_id',$user_id);
		if($data['timezone_offset']!=NULL)
		$this->db->set('timezone',$this->get_timezone_value($data['timezone_offset']));	
		$this->db->insert('usersettings');
	}

	function get_user_setting($user_id){
		$this->db->select('*');
		$this->db->from('usersettings');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function update_user_settings($data,$user_id=NULL){
		if($user_id!=NULL){
			if($data['send_newsletter']==1) $this->db->set('send_newsletter','1'); else $this->db->set('send_newsletter','0');
			$this->db->where('user_id',$user_id);			
			$this->db->update('usersettings');
		}
	}

	function get_user_timezone($user_id){
		$this->db->select('timezone');
		$this->db->from('usersettings');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result=$query->result();
			return $result[0]->timezone;
		}
		else	
			return 'UP1';
	}

	function get_timezone_value($offset){
		$timezone_offset = array('-12:00' =>'UM12',
        '-11:00' =>'UM11',
        '-10:00' =>'UM10',
        '-09:30' =>'UM9',
		'-09:00' =>'UM9',
        '-08:00' =>'UM8',
        '-07:00' =>'UM7',
        '-06:00' =>'UM6',
        '-05:00' =>'UM5',
        '-04:30' =>'UM4',
        '-04:00' =>'UM4',
        '-03:30' =>'UM25',
        '-03:00' =>'UM3',
        '-02:00' =>'UM2',
        '-01:00' =>'UM1',
        '00:00' =>'UTC',
        '+01:00' =>'UP1',
        '+02:00' =>'UP2',
        '+03:00' =>'UP3',
        '+03:30' =>'UP25',
        '+04:00' =>'UP4',
        '+04:30' =>'UP35',
        '+05:00' =>'UP5',
        '+05:30' =>'UP45',
        '+05:45' =>'UP45',
        '+06:00' =>'UP6',
        '+06:30' =>'UP6',
        '+07:00' =>'UP7',
        '+08:00' =>'UP8',
        '+08:45' =>'UP9',
        '+09:00' =>'UP9',
        '+09:30' =>'UP85',
        '+10:00' =>'UP10',
        '+10:30' =>'UP10',
        '+11:00' =>'UP11',
        '+11:30' =>'UP11',
        '+12:00' =>'UP12',
        '+12:45' =>'UP12',
        '+13:00' =>'UP12',
        '+14:00' =>'UP12');
		
		return $timezone_offset[$offset];
	}

	

	function is_set_twitter_connect($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('twitter_connect');
			$this->db->from('usersettings');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				if($result[0]->twitter_connect=="1") return true; else return false;
			}else
				return false;
		}
	}

	function set_twitter_connect($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('twitter_connect','1');
			$this->db->where('user_id',$user_id);
			$this->db->update('usersettings');
		}
	}

	

	function set_facebook_connect($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('facebook_connect','1');
			$this->db->where('user_id',$user_id);
			$this->db->update('usersettings');
		}
	}

	

	function unset_twitter_connect($user_id=NULL)

	{

		if($user_id!=NULL)

		{

			$this->db->set('twitter_connect','0');

			$this->db->where('user_id',$user_id);

			$this->db->update('user_setting');

		}

	}

	

	

	function is_exists_twitter_connection($data)

	{

		$this->db->select('*');

		$this->db->from('twitter_connect');

		$this->db->where('ref_user_id',$data['ref_user_id']);

		

		$query = $this->db->get();

		if($query->num_rows()>0)

			return true;

		else

			return false;

	}

	

	function save_twitter_data($data)

	{

		$this->db->insert('twitter_connect',$data);

	}

	

	function save_facebook_data($data)

	{

		$this->db->insert('facebook_connect',$data);

	}

	

	function update_twitter_data($data)

	{

		$this->db->where('ref_user_id',$data['ref_user_id']);

		$this->db->update('twitter_connect',$data);

		

	}

	

	function get_tokens($user_id)

	{

		$this->db->select('*');

		$this->db->from('twitter_connect');

		$this->db->where('ref_user_id',$user_id);

		$query = $this->db->get();

		if($query->num_rows()>0)

			{

				$result=$query->result();

				$twitter_oauth_tokens = array('access_key'=>$result[0]->twitter_oauth_token,

			 								'access_secret'=>$result[0]->twitter_oauth_token_secret);

				return $twitter_oauth_tokens;

			}

		else

			return NULL;

	}

	

	

}
?>