<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	private $first_limit = 9;
	private $first_offset = 0;
	public $search_radius = 25;
	
	function __construct(){
		parent::__construct();
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Hoteltype_model','Hoteltype');
		$this->load->model('Offerperiod_model','OfferPeriod');
		$this->load->model('offer_model','Offer');
		$this->load->model('country_model','Country');
		$this->load->model('geo_model','Geomodel');
		$this->load->library('pagination');
		
		$this->template->set('countries',$this->Country->get_all());
		$this->template->set('states',$this->Geomodel->get_states());
		$this->template->set('cities',$this->Geomodel->get_cities());
	}
	
	function index(){
		
		if($this->uri->segment(3)==NULL)
			$offset = 0;
		else
			$offset = $this->first_limit*($this->uri->segment(3)-1);
		
		$this->load_search_result($this->first_limit,$offset);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$offer_peroids = $this->OfferPeriod->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		$this->template->set('offer_peroids',$offer_peroids);
		
		$this->template->set('page_js',array('jquery.rating','listing','search','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
	
	function load_search_result($limit=NULL,$offset=NULL){			
		if(isset($_POST['search_city'])){
			$data['search_city'] = $this->input->post('search_city');
			$data['search_from_date'] = $this->input->post('search_form_date');		
			$data['search_to_date'] = $this->input->post('search_to_date');
			$data['search_latitude'] = $this->input->post('search_latitude');
			$data['search_longitude'] = $this->input->post('search_longitude');
		}
		else if($this->phpsession->get('searched_parameter')){
			$searched_parameter = $this->phpsession->get('searched_parameter');
			$data['search_city'] = $searched_parameter['search_city'];
			$data['search_from_date'] = $searched_parameter['search_from_date'];		
			$data['search_to_date'] = $searched_parameter['search_to_date'];
			$data['search_latitude'] = $searched_parameter['search_latitude'];
			$data['search_longitude'] = $searched_parameter['search_longitude'];				
		}

		
		
		$search_text = $data['search_city'];
		$segment = explode(", ",$search_text);
		$city = NULL;
		$state = NULL;
		$country = NULL;
		if($search_text!=NULL){
			if(sizeof($segment)==3){
				$city = $segment[0];
				$state = $segment[1];
				$country = $segment[2];
			}
			else if(sizeof($segment)==2){
				$city = NULL;
				$state = $segment[0];
				$country = $segment[1];
			}
			else if(sizeof($segment)==1){
				$city = NULL;
				$state = NULL;
				$country = $segment[0];
			}
		}
		$data['city'] = $city;
		$data['state'] = $state;
		$data['country'] = $country;
		
		if($data['search_latitude']==NULL && $data['search_longitude']==NULL){
			$latitude_longitude_value = $this->Geomodel->get_area_lat_lon($data['state']);
			if($latitude_longitude_value!=NULL){
				$data['search_latitude'] = $latitude_longitude_value->latitude;				
				$data['search_longitude'] = $latitude_longitude_value->longitude;
			}
		}
		
		if($data['search_latitude']!=NULL && $data['search_longitude']!=NULL){		
			$data['lon1'] = $data['search_longitude'] - $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lon2'] = $data['search_longitude'] + $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lat1'] = $data['search_latitude'] - ($this->search_radius/69); 
			$data['lat2'] = $data['search_latitude'] + ($this->search_radius/69);
		}
		
		$this->phpsession->save('searched_parameter',$data);
		
		foreach($data as $key=>$value){
			$this->template->set($key,$value);
		}
		
		
		$total_searched_offers = $this->Offer->total_search_offer($data);
		
		$config['base_url'] = base_url()."search/page";
		$config['total_rows'] = $total_searched_offers;
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		$this->template->set('pagination_link', $this->pagination->create_links());
		$searched_offers = $this->Offer->search_offer($data,$limit,$offset);
		$this->template->set('latest_offers',$searched_offers);
	}

	function search_offers(){
		$data['search_price'] = $this->input->post('search_by_offer_price');
		$data['search_nights'] = $this->input->post('search_by_offer_nights');
		$data['search_star'] = $this->input->post('search_by_offers_hotel_star');
		$data['search_hotel_type'] = $this->input->post('search_by_offers_hotel_type');
		$data['search_hotel_theme'] = $this->input->post('search_by_offesr_hotel_theme');
		$data['search_offer_period'] = $this->input->post('search_by_offesr_period');
		$data['search_hotel_service'] = $this->input->post('search_by_offers_hotel_facility');
		$data['sort_by'] = $this->input->post('result_sort_by');
		
		
		if(isset($_POST['search_city'])){
			$data['search_city'] = $this->input->post('search_city');
			$data['search_from_date'] = $this->input->post('search_form_date');		
			$data['search_to_date'] = $this->input->post('search_to_date');
			$data['search_latitude'] = $this->input->post('search_latitude');
			$data['search_longitude'] = $this->input->post('search_longitude');
			//print_r($data);
		}
		else if($this->phpsession->get('searched_parameter')){
			$searched_parameter = $this->phpsession->get('searched_parameter');
			if(array_key_exists("search_city", $searched_parameter))
				$data['search_city'] = $searched_parameter['search_city'];
			else
				$data['search_city'] = "";
			if(array_key_exists("search_from_date", $searched_parameter))
				$data['search_from_date'] = $searched_parameter['search_from_date'];
			else		
				$data['search_from_date'] = "";
			
			if(array_key_exists("search_to_date", $searched_parameter))
				$data['search_to_date'] = $searched_parameter['search_to_date'];
			else
				$data['search_to_date'] = "";
				
			if(array_key_exists("search_latitude", $searched_parameter))	
				$data['search_latitude'] = $searched_parameter['search_latitude'];
			else
				$data['search_latitude'] = "";
			
			if(array_key_exists("search_longitude", $searched_parameter))
				$data['search_longitude'] = $searched_parameter['search_longitude'];
			else				
				$data['search_longitude'] = "";
		}
		
		//$data['search_city'] = $this->input->post('search_city');
		//$data['search_from_date'] = $this->input->post('search_form_date');
		//$data['search_to_date'] = $this->input->post('search_to_date');
		$search_text = $data['search_city'];
		$segment = explode(",",$search_text);
		$city = NULL;
		$state = NULL;
		$country = NULL;
		if($search_text!=NULL){
			if(sizeof($segment)==3){
				$city = $segment[0];
				$state = $segment[1];
				$country = $segment[2];
			}
			else if(sizeof($segment)==2){
				$city = NULL;
				$state = $segment[0];
				$country = $segment[1];
			}
			else if(sizeof($segment)==1){
				$city = NULL;
				$state = NULL;
				$country = $segment[0];
			}
		}
		$data['city'] = $city;
		$data['state'] = $state;
		$data['country'] = $country;
		
		if($data['search_latitude']==NULL && $data['search_longitude']==NULL){
			$latitude_longitude_value = $this->Geomodel->get_area_lat_lon($data['state']);
			if($latitude_longitude_value!=NULL){
				$data['search_latitude'] = $latitude_longitude_value->latitude;				
				$data['search_longitude'] = $latitude_longitude_value->longitude;
			}
		}
		
		if($data['search_latitude']!=NULL && $data['search_longitude']!=NULL){		
			$data['lon1'] = $data['search_longitude'] - $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lon2'] = $data['search_longitude'] + $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lat1'] = $data['search_latitude'] - ($this->search_radius/69); 
			$data['lat2'] = $data['search_latitude'] + ($this->search_radius/69);
		}
		$data['search_by_state_multiple'] = $this->input->post('search_by_state_multiple');
		//print_r($data);		
		$this->phpsession->save('searched_parameter',$data);
				
		$return_result = array();
		$search_result = $this->Offer->load_left_search_result($data);
		//print_r($search_result);
		
		if($search_result!=NULL)
		foreach($search_result as $key=>$value){
			$each_offer_services = $this->Service->get_userprofile_hotel_services($value->offer_id,TRUE);
			$each_offer_theme = $this->LastminuteTheme->get_offer_themes($value->offer_id,TRUE);
			$each_offer_periods = $this->OfferPeriod->get_offer_periods($value->offer_id,TRUE);
			if($each_offer_services==NULL) $each_offer_services=array();
			if($each_offer_theme==NULL) $each_offer_theme=array();
			if($each_offer_periods==NULL) $each_offer_periods=array();
			
			if(array_key_exists('search_hotel_service',$data) && $data['search_hotel_service']!=NULL && !empty($data['search_hotel_service']))
				$filter_by_service = array_intersect($data['search_hotel_service'], $each_offer_services);
			if(array_key_exists('search_hotel_theme',$data) && $data['search_hotel_theme']!=NULL && !empty($data['search_hotel_theme']))
				$filter_by_theme = array_intersect($data['search_hotel_theme'], $each_offer_theme);
			if(array_key_exists('search_offer_period',$data) && $data['search_offer_period']!=NULL && !empty($data['search_offer_period']))
				$filter_by_period = array_intersect($data['search_offer_period'], $each_offer_periods);
			
			if(!empty($filter_by_service) || !empty($filter_by_theme) || !empty($filter_by_period))
				array_push($return_result,$value);
			else if(empty($data['search_hotel_service']) && empty($data['search_hotel_theme']) && empty($data['search_offer_period']))
				array_push($return_result,$value);
			
		}
		
		$this->template->set('latest_offers',$return_result);
		
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating'));
		//print_r($data);
		$this->template->current_view = 'lastminute/_offerte_lastminute';
		$this->template->render();	
	}
	
	function direct_search(){
		//$city = $this->uri->segment(5);
		$city = "any";
		$state = $this->uri->segment(4);
		$country = $this->uri->segment(3);
		
		if($city=="any") $city=NULL;
		if($state=="any") $state=NULL;
		if($country=="any") $country=NULL;
		
		$search_text="";
		if($city!=NULL) $search_text = $city.",";
		if($state!=NULL) $search_text .= $state.",";
		if($country!=NULL) $search_text .= $country;
		
		$data['search_city'] = $search_text;
		$data['search_from_date'] = $this->uri->segment(7);
		$data['search_to_date'] = $this->uri->segment(9);
		$data['city'] = $city;
		$data['state'] = $state;
		$data['country'] = $country;
		
		$searched_parameter = $this->phpsession->get('searched_parameter');
		if($searched_parameter!=NULL && is_array($searched_parameter)){
			if(array_key_exists('lon1', $searched_parameter)) $data['lon1'] = $searched_parameter['lon1'];
			if(array_key_exists('lon2', $searched_parameter)) $data['lon2'] = $searched_parameter['lon2'];
			if(array_key_exists('lat1', $searched_parameter)) $data['lat1'] = $searched_parameter['lat1'];
			if(array_key_exists('lat2', $searched_parameter)) $data['lat2'] = $searched_parameter['lat2'];			
		}
		
		foreach($data as $key=>$value){
			$this->template->set($key,$value);
		}
		
		$searched_offers = $this->Offer->search_offer($data,$this->first_limit,$this->first_offset);
		$this->template->set('latest_offers',$searched_offers);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$offer_peroids = $this->OfferPeriod->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		$this->template->set('offer_peroids',$offer_peroids);
		
		$this->template->set('page_js',array('jquery.rating','listing','search','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
        
        function load_direct_search_map(){
        
		$city = $this->uri->segment(5);
		$city = "any";
		$state = $this->uri->segment(4);
		$country = $this->uri->segment(3);
		
		if($city=="any") $city=NULL;
		if($state=="any") $state=NULL;
		if($country=="any") $country=NULL;
		
		$search_text="";
		if($city!=NULL) $search_text = $city.",";
		if($state!=NULL) $search_text .= $state.",";
		if($country!=NULL) $search_text .= $country;
		
		$data['search_city'] = $search_text;
		$data['search_from_date'] = $this->uri->segment(7);
		$data['search_to_date'] = $this->uri->segment(9);
		$data['city'] = $city;
		$data['state'] = $state;
		$data['country'] = $country;
		
		$searched_parameter = $this->phpsession->get('searched_parameter');
		if($searched_parameter!=NULL && is_array($searched_parameter)){
			if(array_key_exists('lon1', $searched_parameter)) $data['lon1'] = $searched_parameter['lon1'];
			if(array_key_exists('lon2', $searched_parameter)) $data['lon2'] = $searched_parameter['lon2'];
			if(array_key_exists('lat1', $searched_parameter)) $data['lat1'] = $searched_parameter['lat1'];
			if(array_key_exists('lat2', $searched_parameter)) $data['lat2'] = $searched_parameter['lat2'];			
		}
		
		foreach($data as $key=>$value){
			$this->template->set($key,$value);
		}
		
		$searched_offers = $this->Offer->search_offer($data,$this->first_limit,$this->first_offset);
		$this->template->set('latest_offers',$searched_offers);
                
                $this->template->current_view = 'lastminute/_offers_large_map';
                $this->template->render('ajax');            
        }
}
?>