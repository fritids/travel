<?php
/*
 * Created on Jul 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class User_profile_model extends CI_Model 
{
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function create_user_profile($data,$user_id)
		{
			$this->db->set('full_name',$data['full_name']);
			$this->db->set('user_id',$user_id);	
					
			$this->db->insert('admin_userprofile');
		} 
	
	function get_user_profile($user_id)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->join('admin_userprofile','admin_userprofile.user_id=admin_user.user_id','left');
		$this->db->where('admin_user.user_id',$user_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
		
	}
	
	function update_user_profile($data,$user_id)
	{
		$this->db->set('full_name',$data['full_name']);
		$this->db->set('localtion',$data['location']);
		$this->db->set('website',$data['website']);
		$this->db->set('favourite_team',$data['favourite_team']);
		$this->db->set('biodata',$data['biodata']);
		
		$this->db->where('user_id',$user_id);	
					
		$this->db->update('admin_userprofile');
	}
	
}
?>