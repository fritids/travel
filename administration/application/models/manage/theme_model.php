<?php

class Theme_model extends CI_Model 
{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$query = $this->db->get('lastminutethemes');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function new_theme($data){
		$this->db->set('theme_name',$data['theme_name']);
		$this->db->insert('lastminutethemes');	
	}
	


	function delete_themes($id=NULL){   //delete facilities
		if($id!=NULL){
			$this->db->where('lastminutetheme_id',$id);
				$this->db->delete('lastminutethemes');
			
		}
	}


function get($id=NULL){
	 	if($id!=NULL){
	 	$this->db->select('*');
		$this->db->from('lastminutethemes');
		$this->db->where('lastminutetheme_id',$id);
   		$query = $this->db->get();
   		if($query->num_rows()>0)
   		{

   			$result=$query->result();
   			return $result[0];
   		}else
   		return NULL;
   }	  
 }



	function edit_theme($data,$theme_id=NULL){
		if($theme_id!=NULL){
			$this->db->set('lastminutetheme_id',$theme_id);
			$this->db->set('theme_name',$data['theme_name']);
			$this->db->where('lastminutetheme_id',$theme_id);
			$this->db->UPDATE('lastminutethemes');		
		}
	}
	


	function update_userprofile_themes($data,$user_id=NULL){
		if($user_id!=NULL){
			$themes=$data['hotel_themes'];
			$this->delete_userprofile_themes($user_id);
			if(!empty($themes)){
				foreach($themes as $key=>$value){
					$this->db->set('lastminutetheme_id',$value);
					$this->db->set('profile_id',$user_id);
					$this->db->insert('profile_themes');
				}
			}	
		}
	}
	
	function delete_userprofile_themes($user_id=NULL){
		if($user_id!=NULL){
			$this->db->where('profile_id',$user_id);
			$this->db->delete('profile_themes');
		}
	}
	


	function get_userprofile_hotel_themes($user_id=NULL){
		if($user_id!=NULL){
			$themes = array();
			$this->db->select('*');
			$this->db->from('profile_themes');
			$this->db->where('profile_id',$user_id);
			
			$query =$this->db->get();
			if($query->num_rows() > 0 ){
				foreach ($query->result_array() as $row){
 				  array_push($themes,$row['lastminutetheme_id']);
				}
			}
			return $themes;				
		}
	}
	



	function update_offer_themes($data,$offer_id=NULL){
		if($offer_id!=NULL){
			$themes=$data['offer_themes'];
			$this->delete_offer_themes($offer_id);
			if(!empty($themes)){
				foreach($themes as $key=>$value){
					$this->db->set('lastminutetheme_id',$value);
					$this->db->set('offer_id',$offer_id);
					$this->db->insert('offers_themes');
				}
			}	
		}
	}
	


	function delete_offer_themes($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_themes');
		}
	}




	function get_offer_themes($offer_id=NULL,$arr=FALSE){
		if($offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers_themes');
			$this->db->join('lastminutethemes','offers_themes.lastminutetheme_id=lastminutethemes.lastminutetheme_id','left');
			$this->db->where('offers_themes.offer_id',$offer_id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				if($arr){
					$themes = array();
					foreach ($query->result_array() as $row){
 				  		array_push($themes,$row['lastminutetheme_id']);
					}
					return $themes;
				}
				else
					return $query->result();
			}
			else{
				return NULL;
			}	
		}
	}
}

?>	