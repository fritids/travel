<?php

class Country_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->where('show','1');
		$this->db->order_by('country_name','ASC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
}
?>