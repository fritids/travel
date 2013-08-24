<?php

class Geo_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_states($country_id=NULL){
		if($country_id!=NULL){
			$this->db->select('*');
			$this->db->from('states');
			$this->db->where('country_id',$country_id);
			$this->db->order_by('state_name','ASC');
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $result = $query->result();
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function get_cities($state_id=NULL){
		if($state_id!=NULL){
			$this->db->select('*');
			$this->db->from('cities');
			$this->db->where('state_id',$state_id);
			$this->db->order_by('city_name','ASC');
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $result = $query->result();
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function get_comuni($city_id=NULL){
		if($city_id!=NULL){
			$this->db->select('*');
			$this->db->from('comuni');
			$this->db->order_by('comune','ASC');
			$this->db->where('city_id',$city_id);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return $result = $query->result();
			}
			else
				return NULL;
		}
		else
			return NULL;
	}
	
	function get_all_city_names($search_with=NULL,$maxrows){
			if($search_with!=NULL)
				$query = "select city_name as name, state_name as stateName, country_name as countryName from trv_cities left join trv_states on trv_cities.state_id=trv_states.state_id left join trv_countries on trv_states.country_id=trv_countries.country_id where city_name like '".$search_with."%' group by city_name, state_name, country_name order by city_name asc limit ".$maxrows ;
			else
				$query = "select city_name as name, state_name as stateName, country_name as countryName from trv_cities left join trv_states on trv_cities.state_id=trv_states.state_id left join trv_countries on trv_states.country_id=trv_countries.country_id group by city_name, state_name, country_name order by city_name asc limit ".$maxrows ;
			
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $result = $query->result();
			}
			else{
					if($search_with!=NULL)
						$query = "select state_name as name, country_name as countryName from trv_states left join trv_countries on trv_states.country_id=trv_countries.country_id where state_name like '".$search_with."%' group by state_name, country_name order by state_name asc limit ".$maxrows ;
					else
						$query = "select state_name as name, country_name as countryName from trv_states left join trv_countries on trv_states.country_id=trv_countries.country_id group by state_name, country_name order by state_name asc limit ".$maxrows ;
					$query = $this->db->query($query);
					if($query->num_rows() > 0){
						return $result = $query->result();
					}
					else{
							if($search_with!=NULL)
								$query = "select country_name as name from trv_countries where country_name like '".$search_with."%' group by country_name order by country_name asc limit ".$maxrows ;
							else
								$query = "select country_name as name from trv_countries group by country_name order by country_name asc limit ".$maxrows ;
							$query = $this->db->query($query);
							if($query->num_rows() > 0){
								return $result = $query->result();
							}
							else{
								return NULL;
							}
					}
			}
	}
	
	function get_all_city_names_new($search_with=NULL,$maxrows){
			$column1 = "area_name_".CURRENT_LANGUAGE;
			$column2 = "country_name_".CURRENT_LANGUAGE;
			
			if($search_with!=NULL)
				$query = "select ".$column1." as name, ".$column2." as stateName, latitude, longitude from trv_search_area where ".$column1." like '".$search_with."%' or ".$column2." like '".$search_with."%' group by ".$column1." order by ".$column1." asc limit ".$maxrows ;
			else
				$query = "select ".$column1." as name, ".$column2." as stateName, latitude, longitude from trv_search_area group by ".$column1." order by ".$column1." asc limit ".$maxrows ;
			
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $result = $query->result();
			}
			else{
				return NULL;
			}
	}
	
	function get_area_lat_lon($area_name=NULL){
		if($area_name!=NULL){
			$column1 = "area_name_".CURRENT_LANGUAGE;	
			$this->db->select('*');
			$this->db->from('search_area');
			$this->db->where($column1,$area_name);
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				$result = $query->result();
				return $result[0];
			}
			else{
				return NULL;
			}						
		}
	}
}