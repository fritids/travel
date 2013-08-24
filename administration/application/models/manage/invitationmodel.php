<?php
/*
 * Created on Jul 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Invitationmodel extends CI_Model 
{
		
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function get_allinvitation_email()
	{
		$this->db->select('*');
		$this->db->from('invitationemail_collect');
		$this->db->where('status','0');
		
		$query = $this->db->get();

		if($query->num_rows()>0)
			return 	$query->result();		
		else
			return NULL;
	}


	function get_details($id=NULL)
	{
		if($id!=NULL)
		{
			$this->db->select('*');
			$this->db->from('invitationemail_collect');
			$this->db->where('invitation_id',$id);

			$query = $this->db->get();
	
			if($query->num_rows()>0)
				return 	$query->result();		
			else
				return NULL;
		}
	}

	function delete_item($id=NULL)
	{
		if($id!=NULL)
		{
			$this->db->where('invitation_id',$id);
			$this->db->delete('invitationemail_collect');
		}
	}

	function change_sendemail_status($email=NULL,$code=NULL)
	{	
		if($email!=NULL && $code!=NULL)
		{
			$this->db->set('status','1');
			$this->db->where('email_address',$email);
			$this->db->where('invitation_code',$code);
		
			$this->db->update('invitationemail_collect');
		}
	}

	function save_code($email,$invitation_code)
	{
		$this->db->set('email_address',$email);
		$this->db->set('invitation_code',$invitation_code);
		$this->db->insert('invitation');
	}
	
	function is_taken($invitation_code)
	{
		$this->db->select('*');
		$this->db->from('invitation');
		$this->db->where('invitation_code',$invitation_code);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function check_invitation_code($data)
	{
		$this->db->select('*');
		$this->db->from('invitation');
		$this->db->where('email_address',$data['email_address']);
		$this->db->where('invitation_code',$data['invitation_code']);
		$this->db->where('status','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	function is_active_code($invitation_code)
	{
		$this->db->select('*');
		$this->db->from('invitation');
		$this->db->where('invitation_code',$invitation_code);
		$this->db->where('status','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	function deactivate_code($data)
	{
		$this->db->set('status','0');
		$this->db->where('email_address',$data['email_address']);
		$this->db->where('invitation_code',$data['invitation_code']);
		
		$this->db->update('invitation');
	}
	
	function have_already_code($email)
	{
		$this->db->select('*');
		$this->db->from('invitation');
		$this->db->where('email_address',$email);
		$this->db->set('status','1');
		$query = $this->db->get();
		
		if($query->num_rows()>0)
			{
				$result=$query->result();
				return $result[0]->invitation_code;
			}
		else
			return NULL;
	}
	
}
?>