<?php
/*
 * Created on Jul 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class User_model extends CI_Model 
{

	public $display_name;
	public $username;	
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function create_new_user($data)
		{
			$salt = sha1(uniqid(rand(), true));
			$password = $data['password'];
			
			$this->db->set('username',$data['username']);
			$this->db->set('email',$data['email_address']);
			$this->db->set('password',hash_password($password,$salt));
			$this->db->set('salt',$salt);
			$this->db->set('display_name',$data['full_name']);
			$this->db->set('avatar','');
			$this->db->set('u_created_on',date("Y-m-d H:m:s"));
			$this->db->set('created_on_ip',$this->input->ip_address());
			$this->db->set('last_updated',date("Y-m-d H:m:s"));
			$this->db->set('last_login_ip',$this->input->ip_address());
			$this->db->set('user_type','0'); //0 = normal user, 1=premium user 2= admin and content development
			$this->db->set('user_activation_key',md5(uniqid(rand(), true)));
			$this->db->set('password_request_code',md5(uniqid(rand(), true)));
			$this->db->set('user_auto_signin','0');
			$this->db->set('is_admin','1');
			$this->db->set('is_active','1'); //2=account deactivate by user himself and all data would be delete after 30 days, 1=active, 0=deactivated by admin or content admin for violation
			
			$this->db->insert('admin_user');
			
			return $this->db->insert_id();
		}
		
	function update_avatar($filename=NULL,$userid=NULL)
		{
			if($userid!=NULL || $userid!="")
			{
				$this->db->set('avatar',$filename);
				$this->db->where('user_id',$userid);
				$this->db->where('is_admin','1');
				$this->db->update('admin_user');
			}
		}
	function update_user_display_name($data,$user_id=NULL)
	{
		if($user_id!=NULL)
		{
			$this->db->set('display_name',$data['full_name']);
			$this->db->where('user_id',$user_id);	
			$this->db->where('is_admin','1');
			$this->db->update('admin_user');
		}
	}
	
	function get_avatar_name($user_id=NULL)
	{
		$this->db->select('avatar');
		$this->db->from('admin_user');
		$this->db->where('user_id',$user_id);
		$this->db->where('is_admin','1');
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
			{
				$result=$query->result();
				return $result[0]->avatar;
			}
		else
			return NULL;
		
	}
		
	function authenticate_user($username_email,$password)
    {
		$query = $this->db->get_where('admin_user', array('username' => $username_email,'password'=>$password,'is_active'=>'1','is_admin'=>'1'));
		$num_row=$query->num_rows();
		if( $num_row > 0)
		{
			return true;
			
		}
		else
		{
			$query = $this->db->get_where('admin_user', array('email' => $username_email,'password'=>$password,'is_active'=>'1','is_admin'=>'1'));
			$num_row=$query->num_rows();
			if( $num_row > 0)
				return true;
			else
				return false;
		}
	}
	
	function update_keepmesignin($user_name,$remember_me)
	{
		//$data=array('user_auto_signin'=>$remember_me,'last_login'=>CURRENT_TIMESTAMP,'last_login_ip'=>$this->input->ip_address());
		$this->db->set('user_auto_signin',$remember_me);
		$this->db->set('last_login_ip',$this->input->ip_address());
		$this->db->where('username',$user_name);
		$this->db->or_where('email',$user_name);
		$this->db->update('admin_user');
	}
	
	function remove_keepmesignin($user_id=NULL)
	{
		if($user_id!=NULL)
		{
			$this->db->set('user_auto_signin','0');
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	function update_last_login($user_id)
	{
		$this->db->set('last_login','CURRENT_TIMESTAMP',false);
		$this->db->where('user_id',$user_id);
		$this->db->update('admin_user');
	}
	
	
	function getusertype($username)
	{
		$usertype=NULL;
		//$query=$this->db->get_where('admin_user',array('username' => $username));
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username);
		$this->db->or_where('email',$username);		
		$query=$this->db->get();
		
		foreach($query->result()as $row)
		{
			$usertype=$row->user_type;
		}
		return $usertype;    //usertype 0= employee, 1 = employers
	}
	
	function get_userid($username)
	{
		//$query=$this->db->get_where('admin_user',array('username' => $username));
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username);
		$this->db->or_where('email',$username);		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
			{
				$result=$query->result();
				return $result[0]->user_id;
			}
		else
			return NULL;
	}
	
	function get_username($username_email)
	{
		//$query=$this->db->get_where('admin_user',array('username' => $username));
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username_email);
		$this->db->or_where('email',$username_email);		
		$query=$this->db->get();
		
		foreach($query->result()as $row)
		{
			$this->username=$row->username;
		}
		return $this->username;
	}
	
	function get_username_from_userid($user_id)
	{
		//$query=$this->db->get_where('admin_user',array('username' => $username));
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('user_id',$user_id);		
		$query=$this->db->get();
		
		foreach($query->result()as $row)
		{
			$this->username=$row->username;
		}
		return $this->username;
	}
	
	
	function get_loggedin_display_name($username)
	{
		$query=$this->db->get_where('admin_user',array('username' => $username));
		foreach($query->result()as $row)
		{
			$this->display_name=$row->display_name;
		}
		return $this->display_name;
	}
	
	
	
	function is_exist_username($username)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username);

		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
		else
			return false;
	}
	
	function is_exist_email($email_address)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('email',$email_address);

		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
		else
			return false;
	}
	
	function get_useremail($username)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username);
			
		$query=$this->db->get();
			
		if($query->num_rows()>0)
			{
				$result=$query->result();
				return $result[0]->email;
			}
		else
			return NULL;
	}
	
	function get_userid_by_email($email)
		{
			$this->db->select('*');
			$this->db->from('admin_user');
			$this->db->where('email',$email);
			
			$query=$this->db->get();
			
			if($query->num_rows()>0)
				{
					$result=$query->result();
					return $result[0]->user_id;
				}
			else
				return NULL;
		}
		
	function is_valid_old_password($password,$user_id)
	{
		$salt = $this->get_salt($user_id);
		$hash_password = hash_password($password,$salt);
		$query = $this->db->get_where('admin_user', array('user_id' => $user_id,'password'=>$hash_password,'is_active'=>'1'));
		$num_row=$query->num_rows();
		
		if( $num_row > 0)
			return true;
		else
			return false;
	}
	
	function update_user_password($data,$user_id=NULL)
	{
		if($user_id!=NULL && $data['password']!=NULL)
		{
			$salt = $this->get_salt($user_id);
			$password = $data['password'];
			$hash_password = hash_password($password,$salt);
			$this->db->set('password',$hash_password);
			$this->db->where('user_id',$user_id);
			
			$this->db->update('admin_user');
		}
	}
	
	function update_username($username=NULL,$user_id=NULL)
	{
		if($username!=NULL && $user_id!=NULL)
		{
			$this->db->set('username',$username);
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	function update_email($email=NULL, $user_id=NULL)
	{
		if($email!=NULL && $user_id!=NULL)
		{
			$this->db->set('email',$email);
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	function update_display_name($full_name=NULL, $user_id=NULL)
	{
		if($full_name!=NULL && $user_id!=NULL)
		{
			$this->db->set('display_name',$full_name);
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	function get_salt($user_id=NULL)
	{
		if($user_id!=NULL)
		{
			$this->db->select('salt');
			$this->db->from('admin_user');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			if($query->num_rows()>0)
				{
					$result=$query->result();
					return $result[0]->salt;
				}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function update_password_request_code($user_id,$request_code)
	{
		if($user_id!=NULL)
		{
			$this->db->set('password_request_code',$request_code);
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	function validate_change_password_request($user_id,$request_code)
	{
		$this->db->select('username');
		$this->db->from('admin_user');
		$this->db->where('md5(user_id)',$user_id);
		$this->db->where('password_request_code',$request_code);
		$this->db->where('is_active','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
		
	}
	
	function get_user_details($user_id)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('md5(user_id)',$user_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
			return NULL;
	}
	
	function deactivate_account($user_id=NULL)
	{
		if($user_id!=NULL)
		{
			$this->db->set('is_active','2');
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	function get_remember_me($username)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('username',$username);
		$this->db->or_where('email',$username);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			return $row->user_auto_signin;;
		}
		else
			return NULL;
	}

	function update_password_request_code_after_change($userid=NULL)
	{
		if($userid!=NULL)
		{
			$this->db->set('password_request_code',md5(uniqid(rand(), true)));
			$this->db->where('user_id',$userid);
			$this->db->update('admin_user');
		}
	}

	
	
	function update_first_login($user_id=NULL)
	{
		if($user_id!=NULL)
		{
			$this->db->set('is_first_login','0');
			$this->db->where('user_id',$user_id);
			$this->db->update('admin_user');
		}
	}


	function validate_email_verification($user_id,$md5_email)
	{
		$this->db->select('username');
		$this->db->from('admin_user');
		$this->db->where('md5(user_id)',$user_id);
		$this->db->where('md5(email)',$md5_email);
		$this->db->where('is_active','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
		
	}

	function set_email_as_verified($user_id,$md5_email)
	{
		$this->db->set('is_email_verified','1');
		$this->db->where('md5(user_id)',$user_id);
		$this->db->where('md5(email)',$md5_email);

		$this->db->update('admin_user');
	}

	function set_email_as_unverified($user_id)
	{
		$this->db->set('is_email_verified','0');
		$this->db->where('user_id',$user_id);

		$this->db->update('admin_user');
	}



}
?>