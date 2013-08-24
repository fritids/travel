<?php

class Invitation_model extends CI_Model {

	public $display_name;
	public $username;	

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	function save_code($email,$invitation_code){
		$this->db->set('email_address',$email);
		$this->db->set('invitation_code',$invitation_code);
		$this->db->insert('invitations');
	}

	function save_code_as_pending($email,$invitation_code){
		$this->db->set('email_address',$email);
		$this->db->set('invitation_code',$invitation_code);
		$this->db->set('status','0');
		$this->db->insert('invitationemails');
	}
	
	function is_taken($invitation_code){
		$this->db->select('*');
		$this->db->from('invitations');
		$this->db->where('invitation_code',$invitation_code);
		$query = $this->db->get();

		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function is_taken_in_collect($invitation_code){
		$this->db->select('*');
		$this->db->from('invitationemails');
		$this->db->where('invitation_code',$invitation_code);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function check_invitation_code($data){
		$this->db->select('*');
		$this->db->from('invitations');
		$this->db->where('email_address',$data['email_address']);
		$this->db->where('invitation_code',$data['invitation_code']);
		$this->db->where('status','1');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}

	function is_active_code($invitation_code){
		if($invitation_code!=NULL){
			$this->db->select('*');
			$this->db->from('invitations');
			$this->db->where('invitation_code',$invitation_code);
			$this->db->where('status','1');
			$query = $this->db->get();
	
			if($query->num_rows() > 0)
				return true;
			else
				return false;	
		}
		else{
			return false;
		}
	}

	function deactivate_code($data){
		if(array_key_exists("invitation_code", $data) && array_key_exists("email_address", $data)){
			$this->db->set('status','0');
			$this->db->where('email_address',$data['email_address']);
			$this->db->where('invitation_code',$data['invitation_code']);
			
			$this->db->update('invitations');	
		}
	}

	function have_already_code($email){
		$this->db->select('*');
		$this->db->from('invitations');
		$this->db->where('email_address',$email);
		$this->db->set('status','1');
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$result=$query->result();
			return $result[0]->invitation_code;
		}
		else
			return NULL;
	}

	function have_already_code_in_collect($email){
		$this->db->select('*');
		$this->db->from('invitationemails');
		$this->db->where('email_address',$email);
		$this->db->set('status','0');
		$query = $this->db->get();

		if($query->num_rows()>0){
			$result=$query->result();
			return $result[0]->invitation_code;
		}
		else
			return NULL;
	}
}
?>