<?php

class Payment_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$this->db->select('*');
		$this->db->from('invoices');
		$this->db->join('usershotel_profiles','invoices.user_id = usershotel_profiles.user_id','left');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function get_invoice_details($invoice_number=NULL){
		if($invoice_number!=NULL){
			$this->db->select('*');
			$this->db->from('invoices');
			$this->db->where('invoice_number',$invoice_number);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result =  $query->result();
				return $result[0];
			}
			else
				return NULL;
		}
	}
}
?>