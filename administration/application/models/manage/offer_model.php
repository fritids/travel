<?php

class Offer_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all_offers(){
		$query = $this->db->get('offers');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function create_new_offer($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('offer_title',$data['offer_title']);
			$this->db->set('offer_duration',$data['offer_duration']);
			$this->db->set('offer_availability',$data['offer_availability']);
			$this->db->set('offer_start_date',date('Y-m-d',strtotime($data['offer_start_date'])));
			$this->db->set('offer_finish_date',date('Y-m-d',strtotime($data['offer_finish_date'])));
			$this->db->set('offer_end_price',$data['offer_end_price']);
			$this->db->set('offer_price_adult',$data['offer_price_adult']);
			$this->db->set('offer_price_children',$data['offer_price_children']);
			$this->db->set('offer_package_description',$data['offer_package_description']);
			$this->db->set('user_id',$user_id);
		
			$this->db->insert('offers');
			return $this->db->insert_id();
		}
	}
	function delete_offer($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers');
			
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_attachments');
			
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_facilities');
			
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_likelog');
			
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_periods');
			
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_themes');
		}		
	}
	
	function update_offer_attachments($data,$offer_id=NULL){
		if($offer_id!=NULL){
			$attachments=$data['offer_attachment'];
			$this->delete_offer_attachments($offer_id);
			if(!empty($attachments)){
				foreach($attachments as $key=>$value){
					$this->db->set('attachment_id',$value);
					$this->db->set('offer_id',$offer_id);
					if($key==0)
					$this->db->set('is_featured','1');
					$this->db->insert('offers_attachments');
				}
			}	
		}
	}
	
	function delete_offer_attachments($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_attachments');
		}
	}
	
	function get_offer_details($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers');
			$this->db->where('offer_id', $offer_id);
			$this->db->where('offer_status!=','0',FALSE); //offer status 1 means active, 0 means delete, 2 means inactive
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0];
			}
			else
				return NULL;
		}
	}
	
	function cancel_offer($user_id=NULL, $offer_id=NULL){
		if($user_id!=NULL && $offer_id!=NULL){
			$this->db->set('offer_status','2');
			$this->db->where('offer_id',$offer_id);
			$this->db->where('user_id',$user_id);
			return $this->db->update('offers');
		}
		else
			return FALSE;
	}
	
	function get_active_offers($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			$this->db->where('offers.user_id',$user_id);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;	
		}
	}
	
	function get_past_offers($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->where('offer_status','2'); //offer status 1 means active, 0 means delete, 2 means expired
			$this->db->where('offers.user_id',$user_id);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;	
		}
	}
}
?>