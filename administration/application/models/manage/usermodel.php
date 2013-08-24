<?php
/*
 * Created on Jul 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Usermodel extends CI_Model 
{

	public $display_name;
	public $username;	
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all_users($limit=NULL,$offset=NULL)
	{
		$this->db->select('*');
		$this->db->from('users');
		

		if($limit!=NULL)
		$this->db->limit($limit,$offset);

		$query =$this->db->get();

		if($query->num_rows()>0)
			return $query->result();
		else
			return NULL;
	}
	
	function get_allhotel_profiles($user_id=NULL){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->where('users.user_type','1');
		$this->db->where('users.user_id',$user_id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function save_invoice_attachment($filename=NULL,$userid=NULL,$pk_invoice=NULL){
		if($filename!=NULL && $userid!=NULL && $pk_invoice!=NULL){
			$this->db->set('invoice_attachment',$filename);
			$this->db->set('payment_status','Success');
			$this->db->where('user_id',$userid);
			$this->db->where('pk_invoice',$pk_invoice);
			
			$this->db->update('invoices');
		}
	}
	
	function update_users_account_permission($userid=NULL){
		if($userid!=NULL){
			$this->db->set('available_credit','available_credit+request_credit',FALSE);
			$this->db->set('request_credit',0);
			$this->db->set('account_expiry_date',date('Y-m-d',strtotime('+1 year')));
			$this->db->where('user_id',$userid);
			$this->db->update('users');
		}
	}




	function delete_user($user_id=NULL){
		if($user_id!=NULL){
			$this->db->where('user_id',$user_id);
			$this->db->delete('users');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('userprofiles');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('usershotel_profiles');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('userspayment_profiles');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('invoicing_profile');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('usersettings');	
			
			$this->db->where('ref_user_id',$user_id);
			$this->db->delete('twitterconnects');
			
			$this->db->where('profile_id',$user_id);
			$this->db->delete('profile_themes');
			
			$this->db->where('profile_id',$user_id);
			$this->db->delete('profile_services');
			
			$this->db->where('profile_id',$user_id);
			$this->db->delete('profile_attachments');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('offers');
			
			$this->db->where('ref_user_id',$user_id);
			$this->db->delete('facebookconnects');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('booking_request');
		}		
	}
	
	function block_user($user_id=NULL){
		if($user_id!=NULL){
			
			
		}		
	}



}
?>