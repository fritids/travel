<?php
/*
 * Created on Jul 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class emailtemplate_model extends CI_Model 
	{
		function __construct()
    	{
        	// Call the Model constructor
        	parent::__construct();
    	}
		
		function get_email_template($email_cat=NULL)
		{
			$this->db->select('*');
			$this->db->from('emailtemplate');
			$this->db->join('emailtemplate_category','emailtemplate.email_cat_id=emailtemplate_category.email_cat_id','left');
			$this->db->where('emailtemplate_category.email_cat_id',$email_cat);
			
			$query=$this->db->get();
			
			if($query->num_rows()>0)
			{
				return $query->result();
			}
			else
			return NULL;
		}
		
	
		
	
	}
?>