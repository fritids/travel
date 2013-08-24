<?php

class Hoteltype_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$column = "hotel_type_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_type');
		$this->db->from('hotel_types');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
}
?>