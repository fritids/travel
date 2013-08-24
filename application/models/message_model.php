<?php

class Message_model extends CI_Model 
{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_total_new_message($user_id=NULL, $offer_id=NULL){
			$this->db->select('*');
			$this->db->from('booking_request');
			$this->db->join('offers','booking_request.offer_id=offers.offer_id','left');
			if($offer_id!=NULL)
			$this->db->where('booking_request.offer_id',$offer_id);
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			
			$this->db->where('booking_request.message_status','0');
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->num_rows();
			else
				return 0;
	}
	
	function get_new_messages($user_id=NULL, $offer_id=NULL,$limit=NULL,$offset=NULL){
			$this->db->select('*');
			$this->db->from('booking_request');
			$this->db->join('offers','booking_request.offer_id=offers.offer_id','left');
			if($offer_id!=NULL)
			$this->db->where('booking_request.offer_id',$offer_id);
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			
			$this->db->where('booking_request.message_status','0');
			$this->db->order_by('booking_request.booking_created_on','desc');
			
			
			if($limit!=NULL)
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return NULL;
	}
	
	function get_old_messages($user_id=NULL, $offer_id=NULL){
			$this->db->select('*');
			$this->db->from('booking_request');
			$this->db->join('offers','booking_request.offer_id=offers.offer_id','left');
			if($offer_id!=NULL)
			$this->db->where('booking_request.offer_id',$offer_id);
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			
			$this->db->where('booking_request.message_status','1');
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return NULL;
	}

	function is_own_this_message($user_id=NULL, $booking_request_id=NULL){
		$this->db->select('*');	
		$this->db->from('booking_request');
		$this->db->join('offers','booking_request.offer_id=offers.offer_id','left');
		$this->db->where('booking_request.booking_request_id',$booking_request_id);
		$this->db->where('offers.user_id',$user_id);
			
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;		
	}

	function delete($booking_request_id=NULL){
		if($booking_request_id!=NULL){
			$this->db->set('booking_request.message_status','1');
			$this->db->where('booking_request.booking_request_id',$booking_request_id);
			$this->db->update('booking_request');			
		}
	}
	
}
?>
