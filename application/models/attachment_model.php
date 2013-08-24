<?php

class Attachment_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_attachment($data,$user_id=NULL){
		if(!empty($data) && $user_id!=NULL){
			$this->db->set('image_name',$data['file_name']);
			$this->db->set('image_height',$data['image_height']);
			$this->db->set('image_width',$data['image_width']);
			$this->db->set('image_size',$data['file_size']);
			$this->db->set('mime_type',$data['file_type']);
			$this->db->set('user_id',$user_id);
			$this->db->insert('attachments');
			return $this->db->insert_id();
		}
	}
	
	function get_offer_attachments($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers_attachments');
			$this->db->join('attachments','offers_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('offers_attachments.offer_id',$offer_id);
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return NULL;
		}
	}
	
	function get_profile_attachments($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('*');
			$this->db->from('profile_attachments');
			$this->db->join('attachments','profile_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('profile_attachments.profile_id',$user_id);
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return NULL;
		}
	}

	function get_offer_default_attachment($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers_attachments');
			$this->db->join('attachments','offers_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('offers_attachments.offer_id',$offer_id);
			$this->db->where('offers_attachments.is_featured','1');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->image_name;
			}
			else{
					$this->db->select('*');
					$this->db->from('offers_attachments');
					$this->db->join('attachments','offers_attachments.attachment_id=attachments.attachment_id','left');
					$this->db->where('offers_attachments.offer_id',$offer_id);
					$query = $this->db->get();
					if($query->num_rows() > 0){
						$result = $query->result();
						return $result[0]->image_name;
					}
					else{
						
					}
			}
		}
		else
			return NULL;
	}
	
	function get_hotelprofile_default_attachment($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->select('*');
			$this->db->from('profile_attachments');
			$this->db->join('attachments','profile_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('profile_attachments.profile_id',$profile_id);
			$this->db->where('profile_attachments.is_featured','1');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->image_name;
			}
			else{
					$this->db->select('*');
					$this->db->from('profile_attachments');
					$this->db->join('attachments','profile_attachments.attachment_id=attachments.attachment_id','left');
					$this->db->where('profile_attachments.profile_id',$profile_id);
					$query = $this->db->get();
					if($query->num_rows() > 0){
						$result = $query->result();
						return $result[0]->image_name;
					}
					else
						return NULL;
			}
		}
		else
			return NULL;
	}
	
	function get_hotelprofile_random_attachment($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->select('*');
			$this->db->from('profile_attachments');
			$this->db->join('attachments','profile_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('profile_attachments.profile_id',$profile_id);
			$this->db->order_by('rand()');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->image_name;
			}
			else
				return NULL;
		}
		else
			return NULL;
	}

	function delete_attachment($attachment_id=NULL,$user_id=NULL){
		if($attachment_id!=NULL && $user_id!=NULL){
			$this->db->where('attachment_id',$attachment_id);
			$this->db->where('user_id',$user_id);
			$this->db->delete('attachments');
		}
	}

	function get_attachment_details($attachment_id=NULL){
		if($attachment_id!=NULL){
			$this->db->select('*');
			$this->db->from('attachments');
			$this->db->where('attachment_id',$attachment_id);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0];
			}
			else
				return NULL;
		}
	}

	function set_as_croped($attachment_id=NULL){		
		if($attachment_id!=NULL){
			$this->db->set('croped','1');
			$this->db->where('attachment_id',$attachment_id);
			
			$this->db->update('attachments');
		}
	}
	
	function unset_as_croped($attachment_id=NULL){		
		if($attachment_id!=NULL){
			$this->db->set('croped','0');
			$this->db->where('attachment_id',$attachment_id);
			
			$this->db->update('attachments');
		}
	}
	
	function set_as_croped_all($user_id=NULL){
		if($user_id!=NULL){			
			$this->db->set('croped','1');
			$this->db->where('user_id',$user_id);
			
			$this->db->update('attachments');
		}		
	}
}
?>