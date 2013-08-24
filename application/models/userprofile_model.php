<?php

class Userprofile_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function create_user_profile($data,$user_id){
		$this->db->set('full_name',$data['full_name']);
		$this->db->set('country',$data['user_country']);
		$this->db->set('user_id',$user_id);	
		$this->db->insert('userprofiles');
	}
	
	function create_user_invoicing_profile($data,$user_id){
		$this->db->set('invoice_email',$data['email_address']);
		$this->db->set('invoice_attention',$data['full_name']);
		$this->db->set('invoice_country',$data['user_country']);
		$this->db->set('user_id',$user_id);	
		$this->db->insert('invoicing_profile');
	}
	
	function update_invoicing_profile_data($data,$user_id){		
		$this->db->set('vat_number',$data['vat_number']);
		$this->db->set('legal_name',$data['legal_name']);
		$this->db->set('invoice_email',$data['invoice_email']);
		$this->db->set('invoice_attention',$data['invoice_attention']);
		$this->db->set('invoice_address',$data['invoice_address']);
		$this->db->set('invoice_zipcode',$data['invoice_zipcode']);
		$this->db->set('invoice_city',$data['invoice_city']);
		$this->db->set('invoice_country',$data['invoice_country']);
		$this->db->set('invoice_profile_complete','1');		
		$this->db->where('user_id',$user_id);	
		$this->db->update('invoicing_profile');
	}
	
	function create_usershotel_profile($data,$user_id){
		$this->db->set('hotel_type','1');
		$this->db->set('hotel_country',$data['user_country']);
		$this->db->set('user_id',$user_id);	
		$this->db->insert('usershotel_profiles');
	}
	
	function update_usershotel_profile($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('hotel_type',$data['hotel_type']);
			$this->db->set('hotel_rating',$data['hotel_rating']);
			$this->db->set('hotel_name',$data['hotel_name']);
			$this->db->set('hotel_address',$data['hotel_address']);
			$this->db->set('hotel_zip',$data['hotel_zip']);
			$this->db->set('hotel_town',$data['hotel_town']);
			$this->db->set('hotel_city',$data['hotel_city']);
			$this->db->set('hotel_state',$data['hotel_state']);
			$this->db->set('hotel_country',$data['hotel_country']);
			$this->db->set('hotel_phone',$data['hotel_phone']);
			$this->db->set('hotel_fax',$data['hotel_fax']);
			$this->db->set('hotel_website',$data['hotel_website']);
			$this->db->set('hotel_description_en',$data['hotel_description_en']);
			$this->db->set('hotel_description_it',$data['hotel_description_it']);
			$this->db->set('hotel_description_fr',$data['hotel_description_fr']);
			$this->db->set('hotel_description_de',$data['hotel_description_de']);
			$this->db->set('hotel_description_es',$data['hotel_description_es']);
			
			$this->db->set('hotel_activities_en',$data['hotel_activities_en']);
			$this->db->set('hotel_activities_it',$data['hotel_activities_it']);
			$this->db->set('hotel_activities_fr',$data['hotel_activities_fr']);
			$this->db->set('hotel_activities_de',$data['hotel_activities_de']);
			$this->db->set('hotel_activities_es',$data['hotel_activities_es']);
			
			$this->db->set('map_address',$data['map_address']);
			$this->db->set('map_latitude',$data['map_latitude']);
			$this->db->set('map_longitude',$data['map_longitude']);
			
			$this->db->set('map_zoom_level',$data['map_zoomlevel']);
			$this->db->set('important_information_en',$data['hotel_importnat_information_en']);
			$this->db->set('important_information_it',$data['hotel_importnat_information_it']);
			$this->db->set('important_information_fr',$data['hotel_importnat_information_fr']);
			$this->db->set('important_information_de',$data['hotel_importnat_information_de']);
			$this->db->set('important_information_es',$data['hotel_importnat_information_es']);
			$this->db->set('nearest_airport_1',$data['nearest_airport_1']);
			$this->db->set('nearest_airport_2',$data['nearest_airport_2']);
			$this->db->set('nearest_airport_3',$data['nearest_airport_3']);
			$this->db->set('nearest_train_station',$data['nearest_train_station']);
			$this->db->set('nearest_bus_station',$data['nearest_bus_station']);
			$this->db->set('nearest_beach',$data['nearest_beach']);
			$this->db->set('nearest_restaurant',$data['nearest_restaurant']);
			
			$this->db->set('accept_privacy',$data['accept_privacy']);
			
			$this->db->where('user_id',$user_id);	
			
			$this->db->update('usershotel_profiles');
		}
	} 
	
	
	
	function update_usershotel_struttura($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('hotel_type',$data['hotel_type']);
			$this->db->set('hotel_rating',$data['hotel_rating']);
			$this->db->set('hotel_name',$data['hotel_name']);
			$this->db->set('hotel_address',$data['hotel_address']);
			$this->db->set('hotel_zip',$data['hotel_zip']);
			$this->db->set('hotel_town',$data['hotel_town']);
			$this->db->set('hotel_city',$data['hotel_city']);
			$this->db->set('hotel_state',$data['hotel_state']);
			$this->db->set('hotel_country',$data['hotel_country']);
			$this->db->set('hotel_phone',$data['hotel_phone']);
			$this->db->set('hotel_fax',$data['hotel_fax']);
			$this->db->set('hotel_website',$data['hotel_website']);
			
			$this->db->set('map_address',$data['map_address']);
			$this->db->set('map_latitude',$data['map_latitude']);
			$this->db->set('map_longitude',$data['map_longitude']);
			
			$this->db->set('map_zoom_level',$data['map_zoomlevel']);
			
			$this->db->set('accept_privacy',$data['accept_privacy']);
			
			$this->db->where('user_id',$user_id);	
			
			$this->db->update('usershotel_profiles');
		}
	} 
	
	
	function update_usershotel_profile_descrizione($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('hotel_description_en',$data['hotel_description_en']);
			$this->db->set('hotel_description_it',$data['hotel_description_it']);
			$this->db->set('hotel_description_fr',$data['hotel_description_fr']);
			$this->db->set('hotel_description_de',$data['hotel_description_de']);
			$this->db->set('hotel_description_es',$data['hotel_description_es']);
			
			$this->db->set('hotel_activities_en',$data['hotel_activities_en']);
			$this->db->set('hotel_activities_it',$data['hotel_activities_it']);
			$this->db->set('hotel_activities_fr',$data['hotel_activities_fr']);
			$this->db->set('hotel_activities_de',$data['hotel_activities_de']);
			$this->db->set('hotel_activities_es',$data['hotel_activities_es']);
			
			$this->db->set('important_information_en',$data['hotel_importnat_information_en']);
			$this->db->set('important_information_it',$data['hotel_importnat_information_it']);
			$this->db->set('important_information_fr',$data['hotel_importnat_information_fr']);
			$this->db->set('important_information_de',$data['hotel_importnat_information_de']);
			$this->db->set('important_information_es',$data['hotel_importnat_information_es']);
			
			$this->db->where('user_id',$user_id);	
			
			$this->db->update('usershotel_profiles');
		}
	} 
	
	function update_usershotel_profile_altro($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('nearest_airport_1',$data['nearest_airport_1']);
			$this->db->set('nearest_airport_2',$data['nearest_airport_2']);
			$this->db->set('nearest_airport_3',$data['nearest_airport_3']);
			$this->db->set('nearest_train_station',$data['nearest_train_station']);
			$this->db->set('nearest_bus_station',$data['nearest_bus_station']);
			$this->db->set('nearest_beach',$data['nearest_beach']);
			$this->db->set('nearest_restaurant',$data['nearest_restaurant']);
			
			$this->db->where('user_id',$user_id);	
			
			$this->db->update('usershotel_profiles');
		}
	} 
	
	function create_userspayment_profile($data,$user_id){
		$this->db->set('user_id',$user_id);	
		$this->db->insert('userspayment_profiles');
	} 
	
	function update_user_profile($data,$user_id){
		$this->db->set('gender',$data['gender']);
		$this->db->set('first_name',$data['first_name']);
		$this->db->set('last_name',$data['last_name']);
		$this->db->set('full_name',$data['full_name']);
		$this->db->set('address_line',$data['profile_address']);
		$this->db->set('zipcode',$data['profile_zipcode']);
		$this->db->set('city',$data['profile_city']);
		$this->db->set('country',$data['profile_country']);
		$this->db->set('phone',$data['profile_phone']);
		$this->db->set('fax',$data['profile_fax']);
		$this->db->set('localtion',$data['profile_city']);
		$this->db->where('user_id',$user_id);	
		$this->db->update('userprofiles');
	}
	
	function get_user_profile($user_id){
		$column1 = "hotel_description_".CURRENT_LANGUAGE;
		$column2 = "hotel_activities_".CURRENT_LANGUAGE;
		$column3 = "important_information_".CURRENT_LANGUAGE;
		$column4 = "hotel_type_".CURRENT_LANGUAGE;
		
		$this->db->select('*,'.$column1.' as hotel_description, '.$column2.' as hotel_activities, '.$column3.' as important_information, '.$column4.' as hotel_type');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('hotel_types','usershotel_profiles.hotel_type=hotel_types.hotel_type_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->join('invoicing_profile','userprofiles.user_id=invoicing_profile.user_id','left');
		$this->db->where('users.user_id',$user_id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function update_payment_profile_data($data,$user_id=NULL){
		if($user_id!=NULL){
			if($data['payment_method']==2){ // 2 means paypal
				$this->db->set('payment_method',$data['payment_method']);
				$this->db->set('paypal_email',$data['paypal_email']);
				$this->db->where('user_id',$user_id);
			}
			else{
				$this->db->set('payment_method',$data['payment_method']);
				$this->db->set('bank_name',$data['bank_name']);
				$this->db->set('swift_code',$data['swift_code']);
				$this->db->set('bank_code',$data['bank_code']);
				$this->db->set('benificiary_name',$data['benificiary_name']);
				$this->db->set('IBAN_number',$data['iban_number']);
				$this->db->set('bank_country',$data['bank_country']);				
				$this->db->where('user_id',$user_id);				
			}
			$this->db->update('userspayment_profiles');
		}
	}
	
	function update_profile_attachments($data,$profile_id=NULL){
		if($profile_id!=NULL){
			$attachments=$data['profile_attachment'];
			//$this->delete_profile_attachments($profile_id);
			if(!empty($attachments)){
				foreach($attachments as $key=>$value){
					$this->db->set('attachment_id',$value);
					$this->db->set('profile_id',$profile_id);
					if($key==0)
					$this->db->set('is_featured','1');
					$this->db->insert('profile_attachments');
				}
			}	
		}
	}
	
	function delete_all_profile_attachments($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->where('profile_id',$profile_id);
			$this->db->delete('profile_attachments');
		}
	}

	function delete_profile_attachment($profile_id=NULL, $attachment_id=NULL){
		if($profile_id!=NULL && $attachment_id!=NULL){
			$this->db->where('attachment_id',$attachment_id);
			$this->db->where('profile_id',$profile_id);
			$this->db->delete('profile_attachments');
		}
	}
	
	function get_hotel_profiles($limit=NULL, $offset=NULL){
		$column = "hotel_description_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_description, (trv_usershotel_profiles.total_profile_comment+(trv_usershotel_profiles.total_profile_like*0.1)+(trv_usershotel_profiles.total_profile_view*0.5)) as hotel_point');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->where('users.user_type','1');
		$this->db->where('userprofiles.is_complete','1');
		$this->db->order_by('hotel_point','desc');
		
		if($limit!=NULL)
		$this->db->limit($limit,$offset);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}

	function get_hotel_profiles_by_region($data=array(), $limit=NULL, $offset=NULL){
		$column = "hotel_description_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_description, (trv_usershotel_profiles.total_profile_comment+(trv_usershotel_profiles.total_profile_like*0.1)+(trv_usershotel_profiles.total_profile_view*0.5)) as hotel_point');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->where('users.user_type','1');
		$this->db->where('userprofiles.is_complete','1');
		
		
		if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
			if($data['lon1']!=NULL && $data['lon2']!=NULL && $data['lat1']!=NULL && $data['lat2']!=NULL){
				$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
				$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			}
			else{				
				if(array_key_exists('state', $data) && $data['state']==NULL && array_key_exists('country', $data) && $data['country']!=NULL)
					$this->db->like('country_name',$data['country']);
				else if(array_key_exists('city', $data) && $data['city']==NULL && array_key_exists('state', $data) && $data['state']!=NULL){
					$this->db->where('( state_name like "%'.$data['state'].'%" or city_name like "%'.$data['state'].'%" ) ');
				}	
				else if(array_key_exists('city', $data) && $data['city']!=NULL)	
					$this->db->where('( state_name like "%'.$data['city'].'%" or city_name like "%'.$data['city'].'%" ) ');	
			}
		}
		
		$this->db->order_by('hotel_point','desc');
		
		if($limit!=NULL)
		$this->db->limit($limit,$offset);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}

	function get_total_hotel_profiles_by_region($data=array()){
		$column = "hotel_description_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_description, (trv_usershotel_profiles.total_profile_comment+(trv_usershotel_profiles.total_profile_like*0.1)+(trv_usershotel_profiles.total_profile_view*0.5)) as hotel_point');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->where('users.user_type','1');
		$this->db->where('userprofiles.is_complete','1');
		
		
		if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
			if($data['lon1']!=NULL && $data['lon2']!=NULL && $data['lat1']!=NULL && $data['lat2']!=NULL){
				$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
				$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			}
			else{				
				if(array_key_exists('state', $data) && $data['state']==NULL && array_key_exists('country', $data) && $data['country']!=NULL)
					$this->db->like('country_name',$data['country']);
				else if(array_key_exists('city', $data) && $data['city']==NULL && array_key_exists('state', $data) && $data['state']!=NULL){
					$this->db->where('( state_name like "%'.$data['state'].'%" or city_name like "%'.$data['state'].'%" ) ');
				}	
				else if(array_key_exists('city', $data) && $data['city']!=NULL)	
					$this->db->where('( state_name like "%'.$data['city'].'%" or city_name like "%'.$data['city'].'%" ) ');	
			}
		}
		
		$this->db->order_by('hotel_point','desc');

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->num_rows();
		else
			return 0;
	}

	function get_total_hotel_profiles(){
		$column = "hotel_description_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_description, (trv_usershotel_profiles.total_profile_comment+(trv_usershotel_profiles.total_profile_like*0.1)+(trv_usershotel_profiles.total_profile_view*0.5)) as hotel_point');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usersettings','userprofiles.user_id=usersettings.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('userspayment_profiles','userprofiles.user_id=userspayment_profiles.user_id','left');
		$this->db->where('users.user_type','1');
		$this->db->where('userprofiles.is_complete','1');
		$this->db->order_by('hotel_point','desc');

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->num_rows();
		else
			return NULL;
	}
	
	function is_liked_this_profile($profile_id,$user_id){
		$this->db->select('*');
		$this->db->from('hotelprofile_likelog');
		$this->db->where('profile_id',$profile_id);
		$this->db->where('like_status','1');
		$this->db->where('liked_by_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function is_followed_this_profile($profile_id,$user_id){
		$this->db->select('*');
		$this->db->from('hotel_followlog');
		$this->db->where('hotel_id',$profile_id);
		$this->db->where('status','1');
		$this->db->where('follower_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function have_already_liked_this_hotel_indb($profile_id,$user_id){
		$this->db->select('*');
		$this->db->from('hotelprofile_likelog');
		$this->db->where('profile_id',$profile_id);
		$this->db->where('liked_by_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function have_already_follow_this_hotel_indb($profile_id,$user_id){
		$this->db->select('*');
		$this->db->from('hotel_followlog');
		$this->db->where('hotel_id',$profile_id);
		$this->db->where('follower_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function like_this_profile($profile_id,$user_id){
		$this->db->set('like_from_ip',$this->input->ip_address());
		$this->db->set('profile_id',$profile_id);
		$this->db->set('liked_by_id',$user_id);
		
		$this->db->insert('hotelprofile_likelog');
	}
	
	function follow_this_profile($profile_id,$user_id){
		$this->db->set('hotel_id',$profile_id);
		$this->db->set('follower_id',$user_id);		
		$this->db->insert('hotel_followlog');
	}
	
	function update_profile_like_number($profile_id=NULL){
		if($profile_id!=NULL)
		{
			$this->db->set('total_profile_like','total_profile_like+1',false);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
	
	function update_profile_follower_number($profile_id=NULL){
		if($profile_id!=NULL)
		{
			$this->db->set('total_profile_follower','total_profile_follower+1',false);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
	
	function update_profile_like_number_decrease($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->set('total_profile_like','total_profile_like-1',false);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
	
	function update_profile_follower_number_decrease($profile_id=NULL){
		if($profile_id!=NULL){
			$this->db->set('total_profile_follower','total_profile_follower-1',false);
			$this->db->where('user_id',$profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
	
	
	function get_profile_like_status($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->select('like_status');
			$this->db->from('hotelprofile_likelog');
			$this->db->where('profile_id',$profile_id);
			$this->db->where('liked_by_id ',$user_id);
		
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->like_status;
			}
			else
				return false;
		}
	}
	
	function get_profile_follow_status($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->select('status');
			$this->db->from('hotel_followlog');
			$this->db->where('hotel_id',$profile_id);
			$this->db->where('follower_id ',$user_id);
		
			$query = $this->db->get();
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0]->status;
			}
			else
				return false;
		}
	}
	
	function set_like_on_profile($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->set('like_status','1');
			$this->db->where('profile_id',$profile_id);
			$this->db->where('liked_by_id',$user_id);
		
			$this->db->update('hotelprofile_likelog');
		}
	}
	
	function set_follow_on_profile($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->set('status','1');
			$this->db->where('hotel_id',$profile_id);
			$this->db->where('follower_id',$user_id);
		
			$this->db->update('hotel_followlog');
		}
	}
	
	function unlike_profile($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->set('like_status','0');
			$this->db->where('profile_id',$profile_id);
			$this->db->where('liked_by_id',$user_id);
		
			$this->db->update('hotelprofile_likelog');
		}
	}
	
	function unfollow_profile($profile_id=NULL,$user_id=NULL){
		if($profile_id!=NULL && $user_id!=NULL){
			$this->db->set('status','0');
			$this->db->where('hotel_id',$profile_id);
			$this->db->where('follower_id',$user_id);
		
			$this->db->update('hotel_followlog');
		}
	}
	
	function search_hotel($city=NULL, $state=NULL, $country=NULL, $star_rating, $hotel_type, $hotel_theme, $hotel_facility,$data=array(),$limit=NULL,$offset=NULL){
		if($city!=NULL) { $city = explode("-",$city); $city = $city[0];}
		if($state!=NULL) { $state = explode("-",$state);  $state = $state[0];}
		if($country!=NULL) { $country = explode("-",$country); $country = $country[0];}
		
		$column = "hotel_description_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as hotel_description, (trv_usershotel_profiles.total_profile_comment+(trv_usershotel_profiles.total_profile_like*0.1)+(trv_usershotel_profiles.total_profile_view*0.5)) as hotel_point');
		$this->db->from('users');
		$this->db->join('userprofiles','userprofiles.user_id=users.user_id','left');
		$this->db->join('usershotel_profiles','userprofiles.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');		
		$this->db->where('users.user_type','1');
		$this->db->where('userprofiles.is_complete','1');	
		
		if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
			$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
			$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			
		}else{
			
			if($city!=NULL){
				$this->db->like('city_name',$city);
				$this->db->or_like('state_name',$city);
				$this->db->or_like('country_name',$city);
			}
			else if($state!=NULL){			
				$this->db->like('state_name',$state);
				$this->db->or_like('city_name',$state);
				$this->db->or_like('country_name',$state);
			}			
			else if($country!=NULL){
	           $this->db->like('country_name',$country);
	           $this->db->or_like('state_name',$country);
	           $this->db->or_like('city_name',$country);
	        }
				
		}
			
		if(!empty($star_rating))
		$this->db->where_in('hotel_rating',$star_rating);
		if($hotel_type!=NULL && is_array($hotel_type))
		$this->db->where_in('usershotel_profiles.hotel_type',$hotel_type);
		
		if($limit!=NULL)
		$this->db->limit($limit,$offset);
		
		$this->db->order_by('hotel_point','desc');

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}

	function is_complete_profile($user_id=NULL){
		if($user_id!=NULL){
			$this->db->select('is_complete');
			$this->db->from('userprofiles');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			if($query->num_rows()>0){
					$result = $query->result();
					if($result[0]->is_complete=="1")
						return TRUE;
					else
						return FALSE;
			}
			else{
				return FALSE;
			}
		}
	}
	
	function update_profile_to_complete($user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('is_complete','1');
			$this->db->where('user_id',$user_id);
			$this->db->update('userprofiles');
		}
	}
	
	function update_hotel_comment_number($hotel_profile_id=NULL){
		if($hotel_profile_id!=NULL){
			$this->db->set('total_comments','total_comments+1',false);
			$this->db->where('profile_id',$hotel_profile_id);
			$this->db->update('usershotel_profiles');
		}
	}
	
	function delete_profileattachment($profileattachment_id=NULL,$user_id=NULL){
		if($profileattachment_id!=NULL && $user_id!=NULL){
			$this->db->where('profileattachment_id',$profileattachment_id);
			$this->db->where('profile_id',$user_id);
			$this->db->delete('profile_attachments');
		}
	}
	
	function get_profile_uncroped_attachments($userID=NULL){
		if($userID!=NULL){
			$this->db->select('*');
			$this->db->from('profile_attachments');
			$this->db->join('attachments','profile_attachments.attachment_id=attachments.attachment_id','left');
			$this->db->where('profile_id',$userID);
			$this->db->where('attachments.croped','0');
			$this->db->limit(1);
			
			$query = $this->db->get();
			if($query->num_rows() > 0)
				return $query->result();
			else
				return NULL;			
		}
		else		
			return NULL;
	}
}
?>