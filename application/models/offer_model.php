<?php

class Offer_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
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
			$this->db->set('offer_included',$data['offer_included']);
			$this->db->set('offer_package_description_en',$data['offer_package_description_en']);
			$this->db->set('offer_package_description_it',$data['offer_package_description_it']);
			$this->db->set('offer_package_description_fr',$data['offer_package_description_fr']);
			$this->db->set('offer_package_description_de',$data['offer_package_description_de']);
			$this->db->set('offer_package_description_es',$data['offer_package_description_es']);
			$this->db->set('offer_updated_on',date("Y-m-d H:i:s"));
			$this->db->set('user_id',$user_id);
		
			$this->db->insert('offers');
			return $this->db->insert_id();
		}
	}
	
	function update_offer($data,$user_id=NULL){
		if($user_id!=NULL){
			$this->db->set('offer_title',$data['offer_title']);
			$this->db->set('offer_duration',$data['offer_duration']);
			$this->db->set('offer_availability',$data['offer_availability']);
			$this->db->set('offer_start_date',date('Y-m-d',strtotime($data['offer_start_date'])));
			$this->db->set('offer_finish_date',date('Y-m-d',strtotime($data['offer_finish_date'])));
			$this->db->set('offer_end_price',$data['offer_end_price']);
			$this->db->set('offer_price_adult',$data['offer_price_adult']);
			$this->db->set('offer_price_children',$data['offer_price_children']);
			$this->db->set('offer_included',$data['offer_included']);
			$this->db->set('offer_package_description_en',$data['offer_package_description_en']);
			$this->db->set('offer_package_description_it',$data['offer_package_description_it']);
			$this->db->set('offer_package_description_fr',$data['offer_package_description_fr']);
			$this->db->set('offer_package_description_de',$data['offer_package_description_de']);
			$this->db->set('offer_package_description_es',$data['offer_package_description_es']);
			
			$this->db->set('offer_status','1');
			$this->db->set('offer_updated_on',date("Y-m-d H:i:s"));
			$this->db->where('user_id',$user_id);
			$this->db->where('offer_id',$data['offer_id']);
		
			$this->db->update('offers');
		}
	}
	
	function update_offer_attachments($data,$offer_id=NULL){
		if($offer_id!=NULL){
			if(array_key_exists('offer_attachment',$data))
				$attachments=$data['offer_attachment'];
			else
				$attachments=array();
			//$this->delete_offer_attachments($offer_id);
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
			$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','users.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('hotel_types','usershotel_profiles.hotel_type=hotel_types.hotel_type_id','left');
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
	
	function is_owner($user_id=NULL, $offer_id=NULL){
		if($user_id!=NULL && $offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers');
			$this->db->where('offer_id',$offer_id);
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else
			return FALSE;
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
	
	function delete_offer($user_id=NULL, $offer_id=NULL){
		if($user_id!=NULL && $offer_id!=NULL){
			
			$this->db->delete('offers', array('offer_id' => $offer_id)); 
			$this->db->delete('offers_facilities', array('offer_id' => $offer_id));
			$this->db->delete('offers_attachments', array('offer_id' => $offer_id));
			$this->db->delete('offers_likelog', array('offer_id' => $offer_id));
			$this->db->delete('offers_periods', array('offer_id' => $offer_id));	
			$this->db->delete('offers_themes', array('offer_id' => $offer_id));
			
		}
		else
			return FALSE;
	}
	
	function get_most_viewed_offers($user_id=NULL,$limit=NULL,$offset=NULL){
			$this->db->select('*');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			$this->db->order_by('offers.total_view','DESC');
			$this->db->order_by('offer_created_on','DESC');
			if($limit!=NULL && $offset!=NULL)
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;
	}
	
	function get_active_offers($user_id=NULL,$limit=NULL,$offset=NULL,$sort_by=NULL,$sort_order=NULL,$data=array()){
			$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			
			if((array_key_exists('search_from_date',$data) && ($data['search_from_date']!=NULL && $data['search_from_date']!="Checkin")) &&
			(array_key_exists('search_to_date',$data) && ($data['search_to_date']!=NULL && $data['search_to_date']!="Checkout")))
			$this->db->where('( offer_start_date >= '.date("Y-m-d",strtotime($data['search_from_date'])).' or offer_finish_date <= '.date("Y-m-d",strtotime($data['search_to_date'])).')');	
		
			
			if(array_key_exists('search_price_min',$data) && is_numeric($data['search_price_min']))
			$this->db->where('offer_price_adult >=', $data['search_price_min'],false);
			if(array_key_exists('search_price_max',$data) && is_numeric($data['search_price_max']))
			$this->db->where('offer_price_adult <=', $data['search_price_max'],false);
			
			if(array_key_exists('search_nights_max',$data) && is_numeric($data['search_nights_max']))
			if($data['search_nights_max']!=0 && $data['search_nights_max']!=30)
			$this->db->like('offer_duration', $data['search_nights_max']);
			
			if(array_key_exists('search_star',$data) && !empty($data['search_star']))
			$this->db->where_in('hotel_rating',$data['search_star']); 
			if(array_key_exists('search_hotel_type',$data) && !empty($data['search_hotel_type']))
			$this->db->where_in('hotel_type',$data['search_hotel_type']);
			
			if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
				$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
				$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			
			}else{
				
				if(array_key_exists('city',$data) && $data['city']!=NULL){
		                    $this->db->like('city_name',$data['city']);
		                    $this->db->or_like('state_name',$data['city']);
		                    $this->db->or_like('country_name',$data['city']);
		                }
				else if(array_key_exists('state',$data) && $data['state']!=NULL){
		                    $this->db->like('state_name',$data['state']);
		                    $this->db->or_like('city_name',$data['state']);
		                    $this->db->or_like('country_name',$data['state']);
		                }
				else if(array_key_exists('country',$data) && $data['country']!=NULL){
						$this->db->like('country_name',$data['country']);
						$this->db->or_like('state_name',$data['country']);
						$this->db->or_like('city_name',$data['country']);
				}
					
			}
			
			if($sort_by=="durata")
				$this->db->order_by('offer_duration',$sort_order);
			else if($sort_by=="data")
				$this->db->order_by('offer_start_date',$sort_order);
			else if($sort_by=="stelle")
				$this->db->order_by('hotel_rating',$sort_order);
			else
				$this->db->order_by('offer_price_adult * 1',$sort_order, TRUE);
			
			if($limit!=NULL)
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;
	}

	function get_active_offers_by_region($data=array(),$limit=NULL,$offset=NULL,$sort_by,$sort_order){
			$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			
			if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
				if($data['lon1']!=NULL && $data['lon2']!=NULL && $data['lat1']!=NULL && $data['lat2']!=NULL){
					$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
					$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
				}
				else{							
					if(array_key_exists('state', $data) && $data['state']==NULL && array_key_exists('country', $data) && $data['country']!=NULL)
						$this->db->like('country_name',$data['country']);
					else if(array_key_exists('city', $data) && $data['city']==NULL && array_key_exists('state', $data) && $data['state']!=NULL){
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}	
					else if(array_key_exists('city', $data) && $data['city']!=NULL){	
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}
				}
			}
			
			if($sort_by=="durata")
				$this->db->order_by('offer_duration',$sort_order);
			else if($sort_by=="data")
				$this->db->order_by('offer_start_date',$sort_order);
			else if($sort_by=="stelle")
				$this->db->order_by('hotel_rating',$sort_order);
			else
				$this->db->order_by('offer_price_adult * 1',$sort_order, TRUE);
			
			if($limit!=NULL)
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;
	}

	function get_total_active_offers_by_region($data=array()){
			$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			
			if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
				if($data['lon1']!=NULL && $data['lon2']!=NULL && $data['lat1']!=NULL && $data['lat2']!=NULL){
					$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
					$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
				}
				else{							
					if(array_key_exists('state', $data) && $data['state']==NULL && array_key_exists('country', $data) && $data['country']!=NULL)
						$this->db->like('country_name',$data['country']);
					else if(array_key_exists('city', $data) && $data['city']==NULL && array_key_exists('state', $data) && $data['state']!=NULL){
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}	
					else if(array_key_exists('city', $data) && $data['city']!=NULL){	
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}
				}
			}
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->num_rows();
			}
			else
				return 0;
	}
	
	function get_total_active_offers($user_id=NULL,$data=array()){
			$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			$this->db->order_by('offer_end_price','ASC');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->num_rows();
			}
			else
				return 0;
	}
	
	function get_past_offers($user_id=NULL,$limit=NULL,$offset=NULL){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
			$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');
			$this->db->where('offer_status','2'); //offer status 1 means active, 0 means delete, 2 means inactive
			if($user_id!=NULL)
			$this->db->where('offers.user_id',$user_id);
			$this->db->order_by('offer_end_price','ASC');
			if($limit!=NULL)
			$this->db->limit($limit,$offset);
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;
	}
	
	function get_random_offer($offer_id=NULL,$limit=NULL,$offset=NULL){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
		$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
		$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
		$this->db->from('offers');
		$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
		$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means expired
		if($offer_id!=NULL)
		$this->db->where('offer_id!=',$offer_id, FALSE);
		
		$this->db->order_by('offer_id','random');
		if($limit!=NULL)
			$this->db->limit($limit,$offset);
			
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else
			return NULL;
		
	}
	
	function delete_offer_attachment($offer_id=NULL, $attachment_id=NULL){
		if($offer_id!=NULL && $attachment_id!=NULL){
			$this->db->where('attachment_id',$attachment_id);
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_attachments');
		}
	}
	
	function get_offer_include_options(){
		$column = "offerinclude_option_".CURRENT_LANGUAGE;
		$this->db->select('*,'.$column.' as offerinclude_option');
		$this->db->from('offerincludeoptions');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	
	function is_liked_this_offer($offer_id,$user_id){
		$this->db->select('*');
		$this->db->from('offers_likelog');
		$this->db->where('offer_id',$offer_id);
		$this->db->where('like_status','1');
		$this->db->where('liked_by_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function have_already_liked_indb($offer_id,$user_id){
		$this->db->select('*');
		$this->db->from('offers_likelog');
		$this->db->where('offer_id',$offer_id);
		$this->db->where('liked_by_id',$user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}
	
	function like_offer($offer_id,$user_id){
		$this->db->set('like_from_ip',$this->input->ip_address());
		$this->db->set('offer_id',$offer_id);
		$this->db->set('liked_by_id',$user_id);
		
		$this->db->insert('offers_likelog');
	}
	
	function update_offer_like_number($offer_id=NULL){
		if($offer_id!=NULL)
		{
			$this->db->set('total_like','total_like+1',false);
			$this->db->where('offer_id',$offer_id);
			$this->db->update('offers');
		}
	}
	
	function update_offer_like_number_decrease($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->set('total_like','total_like-1',false);
			$this->db->where('offer_id',$offer_id);
			$this->db->update('offers');
		}
	}
	
	
	function get_offer_like_status($offer_id=NULL,$user_id=NULL){
		if($offer_id!=NULL && $user_id!=NULL){
			$this->db->select('like_status');
			$this->db->from('offers_likelog');
			$this->db->where('offer_id',$offer_id);
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
	
	function set_like_on_offer($offer_id=NULL,$user_id=NULL){
		if($offer_id!=NULL && $user_id!=NULL){
			$this->db->set('like_status','1');
			$this->db->where('offer_id',$offer_id);
			$this->db->where('liked_by_id',$user_id);
		
			$this->db->update('offers_likelog');
		}
	}
	
	function unlike_offer($offer_id=NULL,$user_id=NULL){
		if($offer_id!=NULL && $user_id!=NULL){
			$this->db->set('like_status','0');
			$this->db->where('offer_id',$offer_id);
			$this->db->where('liked_by_id',$user_id);
		
			$this->db->update('offers_likelog');
		}
	}
	
	function get_offers_user_like($user_id=NULL,$limit=NULL,$offset=NULL){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
		$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
		$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
		$this->db->from('offers_likelog');
		$this->db->join('offers','offers_likelog.offer_id=offers.offer_id','left');
		$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
		$this->db->join('users','offers.user_id=users.user_id','left');
		$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');	
		
		$this->db->where('like_status','1'); //0 means like is not valid 1 means like is valid
		$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
		$this->db->where('offers_likelog.liked_by_id',$user_id);
		$this->db->order_by('offer_created_on','DESC');
		
		if($limit!=NULL && $offset!=NULL)
		$this->db->limit($limit,$offset);
			
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else
			return NULL;
	}
	
	function add_comment($data){
		$this->db->set('comments',$data['comment']);
		if($data['parent_id']==NULL)
			$this->db->set('parent_id',0);
		else
			$this->db->set('parent_id',$data['parent_id']);
		
		$this->db->set('posted_by_id',$data['comment_by']);
		$this->db->set('offer_id',$data['offer_id']);
		
		$this->db->insert('offers_commentlog');
		return $this->db->insert_id();
	}
	
	function update_offer_comment_number($offer_id=NULL){
		if($offer_id!=NULL){
			$this->db->set('total_comment','total_comment+1',false);
			$this->db->where('offer_id',$offer_id);
			$this->db->update('offers');
		}
	}
	
	function total_search_offer($data=array()){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
		$column2 = "offer_package_description_".CURRENT_LANGUAGE;
		
		$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
		$this->db->from('offers');
		$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
		$this->db->join('users','offers.user_id=users.user_id','left');
		$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');		
		$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
		
		if((array_key_exists('search_from_date',$data) && ($data['search_from_date']!=NULL && $data['search_from_date']!="Checkin")) &&
			(array_key_exists('search_to_date',$data) && ($data['search_to_date']!=NULL && $data['search_to_date']!="Checkout")))
		$this->db->where('( offer_start_date >= '.date("Y-m-d",strtotime($data['search_from_date'])).' or offer_finish_date <= '.date("Y-m-d",strtotime($data['search_to_date'])).')');	
		
		if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
			$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
			$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			
		}else{
			
			if(array_key_exists('city',$data) && $data['city']!=NULL){
	                    $this->db->like('city_name',$data['city']);
	                    $this->db->or_like('state_name',$data['city']);
	                    $this->db->or_like('country_name',$data['city']);
	                }
			else if(array_key_exists('state',$data) && $data['state']!=NULL){
	                    $this->db->like('state_name',$data['state']);
	                    $this->db->or_like('city_name',$data['state']);
	                    $this->db->or_like('country_name',$data['state']);
	                }
			else if(array_key_exists('country',$data) && $data['country']!=NULL){
					$this->db->like('country_name',$data['country']);
					$this->db->or_like('state_name',$data['country']);
					$this->db->or_like('city_name',$data['country']);
			}
				
		}
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->num_rows();
		}
		else
			return 0;
		
	}
	
	function search_offer($data=array(), $limit=NULL, $offset=NULL){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
		$column2 = "offer_package_description_".CURRENT_LANGUAGE;
		
		$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
		$this->db->from('offers');
		$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
		$this->db->join('users','offers.user_id=users.user_id','left');
		$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
		$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
		$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
		$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');		
		$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
		
		if((array_key_exists('search_from_date',$data) && ($data['search_from_date']!=NULL && $data['search_from_date']!="Checkin")) &&
			(array_key_exists('search_to_date',$data) && ($data['search_to_date']!=NULL && $data['search_to_date']!="Checkout")))
		$this->db->where('( offer_start_date >= '.date("Y-m-d",strtotime($data['search_from_date'])).' or offer_finish_date <= '.date("Y-m-d",strtotime($data['search_to_date'])).')');	
		
		if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
			$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
			$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			
		}else{
			
			if(array_key_exists('city',$data) && $data['city']!=NULL){
	                    $this->db->like('city_name',$data['city']);
	                    $this->db->or_like('state_name',$data['city']);
	                    $this->db->or_like('country_name',$data['city']);
	                }
			else if(array_key_exists('state',$data) && $data['state']!=NULL){
	                    $this->db->like('state_name',$data['state']);
	                    $this->db->or_like('city_name',$data['state']);
	                    $this->db->or_like('country_name',$data['state']);
	                }
			else if(array_key_exists('country',$data) && $data['country']!=NULL){
					$this->db->like('country_name',$data['country']);
					$this->db->or_like('state_name',$data['country']);
					$this->db->or_like('city_name',$data['country']);
			}
				
		}
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else
			return NULL;
		
	}

	function load_left_search_result($data=array(), $limit=NULL, $offset=NULL){
		$column1 = "offerinclude_option_".CURRENT_LANGUAGE;
		$column2 = "offer_package_description_".CURRENT_LANGUAGE;
			
			$this->db->select('*, '.$column1.' as offerinclude_option, '.$column2.' as offer_package_description');
			$this->db->from('offers');
			$this->db->join('offerincludeoptions','offers.offer_included=offerincludeoptions.offerincludeoption_id','left');
			$this->db->join('users','offers.user_id=users.user_id','left');
			$this->db->join('usershotel_profiles','offers.user_id=usershotel_profiles.user_id','left');
			$this->db->join('cities','usershotel_profiles.hotel_city=cities.city_id','left');
			$this->db->join('states','usershotel_profiles.hotel_state=states.state_id','left');
			$this->db->join('countries','usershotel_profiles.hotel_country=countries.country_id','left');	
			$this->db->where('offer_status','1'); //offer status 1 means active, 0 means delete, 2 means inactive
			
			if((array_key_exists('search_from_date',$data) && ($data['search_from_date']!=NULL && $data['search_from_date']!="Checkin")) &&
			(array_key_exists('search_to_date',$data) && ($data['search_to_date']!=NULL && $data['search_to_date']!="Checkout")))
			$this->db->where('( offer_start_date >= '.date("Y-m-d",strtotime($data['search_from_date'])).' or offer_finish_date <= '.date("Y-m-d",strtotime($data['search_to_date'])).')');	
		
			
			if(array_key_exists('search_price_min',$data) && is_numeric($data['search_price_min']))
			$this->db->where('offer_price_adult >=', $data['search_price_min'],false);
			if(array_key_exists('search_price_max',$data) && is_numeric($data['search_price_max']))
			$this->db->where('offer_price_adult <=', $data['search_price_max'],false);
			
			if(array_key_exists('search_nights_max',$data) && is_numeric($data['search_nights_max']))
			if($data['search_nights_max']!=0 && $data['search_nights_max']!=30)
			$this->db->like('offer_duration', $data['search_nights_max']);
			
			if(array_key_exists('search_star',$data) && !empty($data['search_star']))
			$this->db->where_in('hotel_rating',$data['search_star']); 
			if(array_key_exists('search_hotel_type',$data) && !empty($data['search_hotel_type']))
			$this->db->where_in('hotel_type',$data['search_hotel_type']);
			
			if(array_key_exists('lon1', $data) && array_key_exists('lon2', $data) && array_key_exists('lat1', $data) && array_key_exists('lat2', $data)){
				$this->db->where('(map_longitude between '.$data['lon1'].' and '.$data['lon2'].' )');
				$this->db->where('(map_latitude between '.$data['lat1'].' and '.$data['lat2'].' )');
			
			}else if(array_key_exists('search_by_state_multiple',$data) && !empty($data['search_by_state_multiple'])){
					$data['state'] = implode(",",$data['search_by_state_multiple']);
					$data['country'] = NULL;
					$data['city'] = NULL;							
					if(array_key_exists('state', $data) && $data['state']==NULL && array_key_exists('country', $data) && $data['country']!=NULL)
						$this->db->like('country_name',$data['country']);
					else if(array_key_exists('city', $data) && $data['city']==NULL && array_key_exists('state', $data) && $data['state']!=NULL){
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}	
					else if(array_key_exists('city', $data) && $data['city']!=NULL){	
						$state_name_list = explode(',',$data['state']);
						$qstr = '( ';
						foreach($state_name_list as $key=>$value){
							if(sizeof($state_name_list)==1 || ($key+1)==sizeof($state_name_list))
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%"';	
							else
								$qstr .= 'state_name like "%'.$value.'%" or city_name like "%'.$value.'%" or ';	
						}
						$qstr .= ') ';
						$this->db->where($qstr);
					}
				}			
			else{
				
				if(array_key_exists('city',$data) && $data['city']!=NULL){
		                    $this->db->like('city_name',$data['city']);
		                    $this->db->or_like('state_name',$data['city']);
		                    $this->db->or_like('country_name',$data['city']);
		                }
				else if(array_key_exists('state',$data) && $data['state']!=NULL){
		                    $this->db->like('state_name',$data['state']);
		                    $this->db->or_like('city_name',$data['state']);
		                    $this->db->or_like('country_name',$data['state']);
		                }
				else if(array_key_exists('country',$data) && $data['country']!=NULL){
						$this->db->like('country_name',$data['country']);
						$this->db->or_like('state_name',$data['country']);
						$this->db->or_like('city_name',$data['country']);
				}
					
			}
			
			if(array_key_exists('sort_by',$data) && $data['sort_by']=="date")
				$this->db->order_by('offer_created_on','DESC');
			else
				$this->db->order_by('offer_end_price','ASC');
		
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $query->result();
			}
			else
				return NULL;
	}
	
	function is_valid_date($value, $format = 'dd-mm-yyyy'){
    	if(strlen($value) >= 6 && strlen($format) == 10){
       
        // find separator. Remove all other characters from $format
        $separator_only = str_replace(array('m','d','y'),'', $format);
        $separator = $separator_only[0]; // separator is first character
       
        	if($separator && strlen($separator_only) == 2){
            // make regex
	            $regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
	            $regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
	            $regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
	            $regexp = str_replace($separator, "\\" . $separator, $regexp);
	            	if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){
					// check date
	                $arr=explode($separator,$value);
	                $day=$arr[0];
	                $month=$arr[1];
	                $year=$arr[2];
	                if(@checkdate($month, $day, $year))
	                    return true;
	            	}
        	}
    	}
    	return false;
	} 
	
	
	function save_booking_request($data){
		$this->db->set('booking_checkin_date',date('Y-m-d',strtotime($data['booking_checkin'])));
		$this->db->set('booking_checkout_date',date('Y-m-d',strtotime($data['booking_checkout'])));
		$this->db->set('booking_adult',$data['booking_adults']);
		$this->db->set('booking_children',$data['booking_children']);
		$this->db->set('booking_name',$data['booking_name']);
		$this->db->set('booking_address',$data['booking_address']);
		$this->db->set('booking_country',$data['booking_country']);
		$this->db->set('booking_email',$data['booking_email']);
		$this->db->set('booking_phone',$data['booking_phone']);
		$this->db->set('booking_message',$data['booking_message']);
		$this->db->set('offer_id',$data['offer_id']);
		$this->db->set('booking_created_on',date('Y-m-d H:i:s'));
		$this->db->set('user_id',$data['user_id']);
		
		$this->db->insert('booking_request');
		
	}
	
	function delete_offerattachment($offer_id=NULL, $offersattachment_id=NULL){
		if($offer_id!=NULL && $offersattachment_id!=NULL){
			$this->db->where('offersattachment_id',$offersattachment_id);
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_attachments');
		}
	}
}
?>