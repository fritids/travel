<?php

class User_model extends CI_Model 
{

	public $display_name;
	public $username;	
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function create_new_user($data){
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
		$this->db->set('user_type',$data['account_type']); //1= Hotel Owner 2= Standard User
		$this->db->set('user_activation_key',md5(uniqid(rand(), true)));
		$this->db->set('password_request_code',md5(uniqid(rand(), true)));
		$this->db->set('user_auto_signin','0');
		$this->db->set('is_admin','0');
		$this->db->set('is_active','1'); //2=account deactivate by user himself and all data would be delete after 30 days, 1=active, 0=deactivated by admin or content admin for violation
			
		$this->db->insert('users');
			
		return $this->db->insert_id();
	}
		
	function update_avatar($filename=NULL,$userid=NULL){
		if($userid!=NULL || $userid!=""){
			$this->db->set('avatar',$filename);
			$this->db->where('user_id',$userid);
			$this->db->update('users');
		}
	}

	function update_user_display_name($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('display_name',$data['full_name']);
			$this->db->where('user_id',$user_id);	
			$this->db->update('users');
			
			$this->db->set('full_name',$data['full_name']);
			$this->db->where('user_id',$user_id);	
			$this->db->update('userprofiles');
		}
	}
	
	function get_avatar_name($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('avatar');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);
		
			$query = $this->db->get();
		
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->avatar;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}

	function get_account_expire_date($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('account_expiry_date');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);
		
			$query = $this->db->get();
		
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->account_expiry_date;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
		
	function authenticate_user($username_email=NULL,$password=NULL){
		if($username_email!=NULL && $password!=NULL){
			$query = $this->db->get_where('users', array('username' => $username_email,'password'=>$password,'is_active'=>'1'));
			$num_row=$query->num_rows();
			if( $num_row > 0){
				return true;
			}
			else{
				$query = $this->db->get_where('users', array('email' => $username_email,'password'=>$password,'is_active'=>'1'));
				$num_row=$query->num_rows();
				if( $num_row > 0)
					return true;
				else
					return false;
			}
		}
		else
			return false;
	}
	
	function update_keepmesignin($user_name=NULL,$remember_me=NULL){
		if($user_name!=NULL){
			//$data=array('user_auto_signin'=>$remember_me,'last_login'=>CURRENT_TIMESTAMP,'last_login_ip'=>$this->input->ip_address());
			$this->db->set('user_auto_signin',$remember_me);
			$this->db->set('last_login_ip',$this->input->ip_address());
			$this->db->where('username',$user_name);
			$this->db->or_where('email',$user_name);
			$this->db->update('users');
		}
		else
			return NULL;
	}
	
	function remove_keepmesignin($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('user_auto_signin','0');
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function update_last_login($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('last_login','CURRENT_TIMESTAMP',false);
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function get_userid_by_email($email=NULL){
		if($email!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$email);
			$this->db->or_where('email',$email);
			
			$query=$this->db->get();
			
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->user_id;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function getusertype($username=NULL){
		if($username!=NULL){
			$usertype=0;
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->or_where('email',$username);		
			$query=$this->db->get();
		
			foreach($query->result()as $row){
				$usertype=$row->user_type;
			}
			return $usertype;    //usertype 1= hotel, 2 = Normal user 3= tourist office
		}
		else
			return false;
	}
	
	function get_userid($username=NULL){
		if($username!=NULL){
			//$query=$this->db->get_where('users',array('username' => $username));
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->or_where('email',$username);		
			$query=$this->db->get();
		
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->user_id;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function get_username($username_email=NULL){
		if($username_email!=NULL){
			//$query=$this->db->get_where('users',array('username' => $username));
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username_email);
			$this->db->or_where('email',$username_email);		
			$query=$this->db->get();
		
			foreach($query->result()as $row){
				$this->username=$row->username;
			}
			return $this->username;
		}
		else
			return NULL;
	}
	
	function get_username_from_userid($user_id=NULL){
		if($user_id!=NULL){
			//$query=$this->db->get_where('users',array('username' => $username));
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);		
			$query=$this->db->get();
		
			foreach($query->result()as $row){
				$this->username=$row->username;
			}
			return $this->username;
		}
		else
			return NULL;
	}
	
	
	function get_loggedin_display_name($username=NULL){
		if($username!=NULL){
			$query=$this->db->get_where('users',array('username' => $username));
			foreach($query->result()as $row){
				$this->display_name=$row->display_name;
			}
			return $this->display_name;
		}
		else
			return NULL;
	}
	
	function is_exist_username($username=NULL){
		if($username!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username);
			$query=$this->db->get();
			if($query->num_rows()>0){
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	function is_exist_email($email_address=NULL){
		if($email_address!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email',$email_address);
			$query=$this->db->get();
			if($query->num_rows()>0){
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	function get_useremail($username=NULL){
		if($username!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->or_where('email',$username);
			
			
			$query=$this->db->get();
			
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->email;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
		
	function is_valid_old_password($password=NULL,$user_id=NULL){
		if($password!=NULL && $user_id!=NULL){
			$salt = $this->get_salt($user_id);
			$hash_password = hash_password($password,$salt);
			$query = $this->db->get_where('users', array('user_id' => $user_id,'password'=>$hash_password,'is_active'=>'1'));
			$num_row=$query->num_rows();
		
			if( $num_row > 0)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	function update_user_password($data,$user_id=NULL){
		if($user_id!=NULL && $data['password']!=NULL){
			$salt = $this->get_salt($user_id);
			$password = $data['password'];
			$hash_password = hash_password($password,$salt);
			$this->db->set('password',$hash_password);
			$this->db->where('user_id',$user_id);
			
			$this->db->update('users');
		}
	}
	
	function update_username($username=NULL,$user_id=NULL){
		if($username!=NULL && $user_id!=NULL){
			$this->db->set('username',$username);
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function update_email($email=NULL, $user_id=NULL){
		if($email!=NULL && $user_id!=NULL){
			$this->db->set('email',$email);
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function update_display_name($full_name=NULL, $user_id=NULL){
		if($full_name!=NULL && $user_id!=NULL){
			$this->db->set('display_name',$full_name);
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function get_salt($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('salt');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result=$query->result();
				return $result[0]->salt;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function update_password_request_code($user_id,$request_code){
		if($user_id!=NULL){
			$this->db->set('password_request_code',$request_code);
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	function validate_change_password_request($user_id=NULL,$request_code=NULL){
		if($user_id!=NULL && $request_code!=NULL){
			$this->db->select('username');
			$this->db->from('users');
			$this->db->where('md5(user_id)',$user_id);
			$this->db->where('password_request_code',$request_code);
			$this->db->where('is_active','1');
			$query = $this->db->get();
		
			if($query->num_rows() > 0)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	function get_user_details($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('md5(user_id)',$user_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				return $query->result();
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function deactivate_account($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('is_active','2');
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}
	
	
	function get_total_numberof_users(){
		$this->db->select('count(fblr_users.user_id) as total');
		$this->db->from('users');
		$this->db->join('userprofiles','users.user_id=userprofiles.user_id','left');
		$this->db->order_by('display_name','desc');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->total;
			}
		else
			return 0;
	}
	
	function get_remember_me($username=NULL){
		if($username!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username',$username);
			$this->db->or_where('email',$username);
			$query=$this->db->get();

			if($query->num_rows()>0){
				$row = $query->row();
				return $row->user_auto_signin;;
			}
			else
				return false;
		}
		else
			return false;
	}

	function update_password_request_code_after_change($userid=NULL){
		if($userid!=NULL){
			$this->db->set('password_request_code',md5(uniqid(rand(), true)));
			$this->db->where('user_id',$userid);
			$this->db->update('users');
		}
	}

	function get_username_from_oauth_id($user_oauth_id=NULL){
		if($user_oauth_id!=NULL){
			$this->db->select('*');
			$this->db->from('twitterconnects');
			$this->db->join('users','twitterconnects.ref_user_id=users.user_id','left');
			$this->db->where('oauth_uid',$user_oauth_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->username;
			}
			else
				return NULL;
		}
	}
	
	function update_first_login($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('is_first_login','0');
			$this->db->where('user_id',$user_id);
			$this->db->update('users');
		}
	}


	function validate_email_verification($user_id,$md5_email){
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('md5(user_id)',$user_id);
		$this->db->where('md5(email)',$md5_email);
		$this->db->where('is_active','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function set_email_as_verified($user_id,$md5_email){
		$this->db->set('is_email_verified','1');
		$this->db->where('md5(user_id)',$user_id);
		$this->db->where('md5(email)',$md5_email);

		$this->db->update('users');
	}

	function set_email_as_unverified($user_id){
		$this->db->set('is_email_verified','0');
		$this->db->where('user_id',$user_id);

		$this->db->update('users');
	}
	

	function is_exist_facebook_email($email=NULL){
   		if($email!=NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email',$email);
			$query=$this->db->get();
			if($query->num_rows()>0)
				return true;
			else
				return false;
		}
		else
			return false;
   }
   
   function save_facebook_connection($facebook_id=NULL, $facebook_email=NULL, $facebook_oauth_token=NULL,$user_id=NULL){
   		if($facebook_id!=NULL && $facebook_email!=NULL && $user_id!=NULL){
			$this->db->set('facebook_id',$facebook_id);
			$this->db->set('facebook_email',$facebook_email);
			$this->db->set('facebook_oauth_token',$facebook_oauth_token);
			$this->db->set('facebook_oauth_token_secret',NULL);
			$this->db->set('ref_user_id',$user_id);
		
			$this->db->insert('facebookconnects');
		}
   }
   
   function save_twitter_connection($tw_oauth_uid=NULL,$tw_twitter_oauth_token=NULL,$tw_twitter_oauth_token_secret=NULL,$user_id=NULL){
   		if($tw_oauth_uid!=NULL && $tw_twitter_oauth_token!=NULL && $user_id!=NULL){
			$this->db->set('oauth_uid',$tw_oauth_uid);
			$this->db->set('oauth_provider','twitter');
			$this->db->set('twitter_oauth_token',$tw_twitter_oauth_token);
			$this->db->set('twitter_oauth_token_secret',$tw_twitter_oauth_token_secret);
			$this->db->set('ref_user_id',$user_id);
		
			$this->db->insert('twitterconnects');
		}
   }
   
   function is_already_connect_with_facebook($email){
   		if($email!=NULL){
			$this->db->select('*');
			$this->db->from('facebookconnects');
			$this->db->where('facebook_email',$email);
			$query=$this->db->get();
			if($query->num_rows()>0)
				return true;
			else
				return false;
		}
		else
			return false;
   }
   
   function is_already_connect_with_twitter($oauth_uid){
   		if($oauth_uid!=NULL){
			$this->db->select('*');
			$this->db->from('twitterconnects');
			$this->db->where('oauth_uid',$oauth_uid);
			$query=$this->db->get();
			if($query->num_rows()>0)
				return true;
			else
				return false;
		}
		else
			return false;
   }
   
   
   
   function get_referenced_username_from_fbdata($fb_email=NULL){
   		if($fb_email!=NULL){
			$this->db->select('*');
			$this->db->from('facebook_connect');
			$this->db->join('users','facebook_connect.ref_user_id=users.user_id','left');
			$this->db->where('facebook_email',$fb_email);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->username;
			}
			else
				return NULL;
		}
   }
   
   function get_available_credit($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('available_credit');
			$this->db->from('users');
			$this->db->where('user_id',$user_id);
			$this->db->where('is_active','1');
			$this->db->where('user_type','1');
			
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->available_credit;
			}
			else
				return 0;
		}
   }
   
   function invoicenumber_gen($user_id){
		$invoicenumber_date = date('d').date('m').date('Y');
		$invoicenumber_random=$this->randomgen(5);
		$invoicenumber = $invoicenumber_date.$invoicenumber_random.$user_id;
		$ok=$this->check($invoicenumber);
		$ok=1;
		while($ok != 0){
		    $invoicenumber_date = date('d').date('m').date('Y');
			$invoicenumber_random=$this->randomgen(5);
			$invoicenumber = $invoicenumber_date.$invoicenumber_random.$user_id;
			$ok=$this->check($invoicenumber);
		}
		$invoicenumber = $invoicenumber;
		return $invoicenumber;
	}

	function randomgen($length){
		  $retval='';
		  $fixed_str='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		  for($i=0;$i<$length;$i++){
			$shuffled_str=str_shuffle($fixed_str);
			$retval = $retval.$shuffled_str{mt_rand(0,35)};
		  }
		  return $retval;
	}
	
	
	function check($invoicenumber){
			$this->db->select('invoice_number');
			$this->db->from('invoices');
			$this->db->where('invoice_number',$invoicenumber);
	
			$query=$this->db->get();
	
			return $query->num_rows();
	}
	
	function save_payment_request_through_bank($data=array()){
		if(!empty($data)){
			$this->db->set('invoice_number',$data['invoice_number']);
			$this->db->set('payment_through',$data['payment_through']);
			$this->db->set('total_amount',$data['total_amount']);
			$this->db->set('payment_status',$data['payment_status']);
			$this->db->set('first_name',$data['first_name']);
			$this->db->set('last_name',$data['last_name']);
			$this->db->set('full_name',$data['full_name']);
			$this->db->set('payer_email',$data['payer_email']);
			$this->db->set('payer_id',$data['payer_id']);
			$this->db->set('mc_currency',$data['mc_currency']);
			$this->db->set('item_name',$data['item_name']);
			$this->db->set('transaction_subject',$data['transaction_subject']);
			$this->db->set('user_id',$data['user_id']);
			
			$this->db->insert('invoices');
		}
	}
	
	function update_user_request_credit($data=array()){
		if(!empty($data)){
			$this->db->set('request_credit',$data['total_amount']);
			$this->db->where('user_id',$data['user_id']);
			
			$this->db->update('users');
		}
	}
	
	function get_list_of_payments($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('*');
			$this->db->from('invoices');
			$this->db->where('user_id',$user_id);
			
			$query = $this->db->get();
			if($query->num_rows()>0){
				return $query->result();
			}
			else
				return NULL;
		}
	}
	
	
	function update_users_account_permission($userid=NULL){
		if($userid!=NULL){
			$this->db->set('available_credit','available_credit+100',FALSE);
			$this->db->set('request_credit',0);
			$this->db->set('account_expiry_date',date('Y-m-d',strtotime('+2 months')));
			$this->db->where('user_id',$userid);
			$this->db->update('users');
		}
	}


  
}
?>