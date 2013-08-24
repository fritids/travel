<?php

class Comment_model extends CI_Model 
{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_new_comment_for_hotel($data){
		$this->db->set('comments',$data['comment']);
		if($data['parent_id']==NULL)
			$this->db->set('parent_id',0);
		else
			$this->db->set('parent_id',$data['parent_id']);		
		$this->db->set('posted_by_id',$data['comment_by']);
		$this->db->set('profile_id',$data['hotel_id']);
		$this->db->insert('hotelprofile_commentlog');
		return $this->db->insert_id();
	}
	
	function get_comments_posted_on($comments_id){
		$this->db->select('posted_on');
		$this->db->from('hotelprofile_commentlog');
		$this->db->where('comment_id',$comments_id);
		$query = $this->db->get();
		if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->posted_on;
		}
		else
			return NULL;
	}
	
	function get_comment($comment_id=NULL){
		$this->db->select('*');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('users','hotelprofile_commentlog.posted_by_id=users.user_id','left');
		$this->db->where('comment_id',$comment_id);
		$this->db->where('comments_status','1');
		$this->db->where('parent_id','0');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result[0];
		}
		else
			return NULL;
	}
	
	
	function get_user_comments($user_id,$limit=NULL,$offset=NULL){
		$this->db->select('*');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('usershotel_profiles','hotelprofile_commentlog.profile_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->where('hotelprofile_commentlog.posted_by_id',$user_id);
		$this->db->where('comments_status','1');
		$this->db->where('parent_id','0');
		if($limit!=NULL)
		$this->db->limit($limit,$offset);
		$this->db->order_by('posted_on','desc');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function get_hotel_commetns($hotel_id,$limit=NULL,$offset=NULL){
		$this->db->select('*');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('users','hotelprofile_commentlog.posted_by_id=users.user_id','left');
		$this->db->where('profile_id',$hotel_id);
		$this->db->where('comments_status','1');
		$this->db->where('parent_id','0');
		if($limit!=NULL)
		$this->db->limit($limit,$offset);
		$this->db->order_by('posted_on','desc');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function total_root_comments_in_a_offer($offer_id){
		$this->db->select('count(comment_id) as total');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('users','hotelprofile_commentlog.posted_by_id=users.user_id','left');
		$this->db->where('offer_id',$offer_id);
		$this->db->where('comments_status','1');
		$this->db->where('parent_id','0');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result[0]->total;
		}
		else
			return 0;
	}
	
	function get_total_comments_in_a_offer($offer_id){
		$this->db->select('count(comment_id) as total');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('users','hotelprofile_commentlog.posted_by_id=users.user_id','left');
		$this->db->where('offer_id',$offer_id);
		$this->db->where('comments_status','1');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result[0]->total;
		}
		else
			return 0;
	}
	
	function get_comments_child($parent_id){
		$this->db->select('*');
		$this->db->from('hotelprofile_commentlog');
		$this->db->join('users','hotelprofile_commentlog.posted_by_id=users.user_id','left');
		$this->db->where('comments_status','1');
		$this->db->where('parent_id',$parent_id);
		$this->db->order_by('posted_on','asc');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	
	function update_profile_comment_number($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->set('total_profile_comment','total_profile_comment+1',false);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}

	
	
	function delete_comment_root_comment($comment_id=NULL,$user_id=NULL){
		if($comment_id!=NULL && $user_id!=NULL){
			$this->db->where('comment_id',$comment_id);
			$this->db->where('posted_by_id',$user_id);
			$this->db->delete('hotelprofile_commentlog');
		}
	}
	
	function delete_child_comment($parent_id=NULL){
		if($parent_id!=NULL && $parent_id!=0){
			$this->db->where('parent_id',$parent_id);
			$this->db->delete('hotelprofile_commentlog');
		}
	}

	function make_child_as_root($parent_id=NULL){
		if($parent_id!=NULL && $parent_id!=0){
			$this->db->set('parent_id','0');
			$this->db->where('parent_id',$parent_id);
			$this->db->update('hotelprofile_commentlog');
		}
	}

	function get_offer_id_from_comment_id($comment_id=NULL){
		if($comment_id!=NULL){
			$this->db->select('profile_id');
			$this->db->from('hotelprofile_commentlog');
			$this->db->where('comment_id',$comment_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->offer_id;
			}
			else
				return NULL;
		}
	}
	
	function get_total_offer_comment_for_upadte($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->select('count(comment_id) as total_comment');
			$this->db->from('hotelprofile_commentlog');
			$this->db->where('profile_id',$offer_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->total_comment;
			}
			else
				return NULL;
		}
	}
	
	function update_total_profile_comment_after_delete($profile_id=NULL,$total_comment){
		if($profile_id!=NULL){
			$this->db->set('total_profile_comment',$total_comment);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
}
?>