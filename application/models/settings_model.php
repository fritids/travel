<?php

class Settings_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function load_settings(){
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->where('id','1');
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result[0];
		}
		else
			return NULL;
	} 
	
	function get_credit_per_offer(){
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->where('id','1');
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result[0]->credit_per_offer;
		}
		else
			return 0;
	}
}
?>