<?php

class emailtemplate_model extends CI_Model{

	function __construct(){
       // Call the Model constructor
		parent::__construct();
	}

	function get_email_template($email_cat=NULL){
		$column1 = "email_subject_".CURRENT_LANGUAGE;
		$column2 = "email_body_".CURRENT_LANGUAGE;
		
		$this->db->select('*,'.$column1.' as email_subject, '.$column2.' as email_body');
		$this->db->from('emailtemplates');
		$this->db->join('emailtemplatecategories','emailtemplates.email_cat_id=emailtemplatecategories.email_cat_id','left');
		$this->db->where('emailtemplatecategories.email_cat_id',$email_cat);
		
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
		else
			return NULL;
		}
	}
?>