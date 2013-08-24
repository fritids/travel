<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lastminute extends CI_Controller {
	private $first_limit = 9;
	private $first_offset = 0;
	public $search_radius = 20;
	
	function __construct(){
		parent::__construct();
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Hoteltype_model','Hoteltype');
		$this->load->model('Offerperiod_model','OfferPeriod');
		$this->load->model('offer_model','Offer');
		$this->template->set('page','lastminute');
		$this->load->model('country_model','Country');
		$this->load->model('geo_model','Geomodel');
		$this->load->library('pagination');
		
		$this->template->set('countries',$this->Country->get_all());
		$this->template->set('states',$this->Geomodel->get_states());
		$this->template->set('cities',$this->Geomodel->get_cities());
		$this->template->set('seo_title', lang('seo-title'));
		$this->template->set('seo_description', lang('seo_description'));
		$this->template->set('seo_keywords', lang('seo_keywords'));
	}
	
	function index(){
		$data = array();
		if($this->phpsession->get('searched_parameter')){				
			$searched_parameter = $this->phpsession->get('searched_parameter');
			$data['search_city'] = $searched_parameter['search_city'];
			$data['search_from_date'] = $searched_parameter['search_from_date'];		
			$data['search_to_date'] = $searched_parameter['search_to_date'];
			$data['search_latitude'] = $searched_parameter['search_latitude'];
			$data['search_longitude'] = $searched_parameter['search_longitude'];				
				
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
		
			if(array_key_exists('search_price', $searched_parameter)) $data['search_price'] = $searched_parameter['search_price'];
			if(array_key_exists('search_nights', $searched_parameter)) $data['search_nights'] = $searched_parameter['search_nights'];
			if(array_key_exists('search_star', $searched_parameter)) $data['search_star'] = $searched_parameter['search_star'];
			if(array_key_exists('search_hotel_type', $searched_parameter)) $data['search_hotel_type'] = $searched_parameter['search_hotel_type'];
			if(array_key_exists('search_hotel_theme', $searched_parameter)) $data['search_hotel_theme'] = $searched_parameter['search_hotel_theme'];
			if(array_key_exists('search_offer_period', $searched_parameter)) $data['search_offer_period'] = $searched_parameter['search_offer_period'];
			if(array_key_exists('search_hotel_service', $searched_parameter)) $data['search_hotel_service'] = $searched_parameter['search_hotel_service'];
			
			$this->phpsession->save('searched_parameter',$data);
			foreach($data as $key=>$value){
				$this->template->set($key,$value);
			}
		}
		//$this->phpsession->clear('searched_parameter');
		//print_r($data);
		
						
		if(isset($_GET['sort'])) $sort_by = $_GET['sort']; else $sort_by = "data";
		$sort_order = 'desc';$s_o="desc";
		if(isset($_GET['asc'])) {$sort_order = 'asc'; $s_o="asc";} 
		if(isset($_GET['desc'])) {$sort_order = 'desc';$s_o="desc";}
		
		if(!isset($_GET['p']) || $_GET['p']==NULL)
			$offset = 0;
		else
			$offset = $this->first_limit*($_GET['p']-1);
		
		if(empty($data))
			$total_offer = $this->Offer->get_total_active_offers($user_id=NULL,$data);
		else{
			$this->first_limit = NULL;
			$total_offer = 0;
		}
					
		$config['base_url'] = base_url()."offers/page?sort=".$sort_by."&".$s_o."=".$sort_order;
		$config['total_rows'] = $total_offer;
		$config['per_page'] = $this->first_limit;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		
		$this->pagination->initialize($config);	
			
		
		$latest_offers = $this->Offer->get_active_offers($user_id=NULL,$this->first_limit,$offset,$sort_by,$sort_order,$data);
		$return_result = array();
		if($latest_offers!=NULL)
		foreach($latest_offers as $key=>$value){
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
			
		$this->load_most_viewed_offer($this->first_limit,$this->first_offset);
				
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$offer_peroids = $this->OfferPeriod->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		$this->template->set('offer_peroids',$offer_peroids);
		$this->template->set('total_latest_offer', $total_offer);
		
		$this->template->set('pagination_link', $this->pagination->create_links());
		
		$this->template->set('page_js',array('jquery.rating','listing','search','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
	
	function load_latest_offers($limit=NULL,$offset=NULL,$sort_by,$sort_order){
		$latest_offers = $this->Offer->get_active_offers($user_id=NULL,$limit,$offset,$sort_by,$sort_order);		
		$this->template->set('latest_offers',$latest_offers);
	}
	
	function load_most_viewed_offer($limit=NULL,$offset=NULL){
		$most_viewed_offers = $this->Offer->get_most_viewed_offers($user_id=NULL,$limit,$offset);
		$this->template->set('most_viewed_offers',$most_viewed_offers);
	}

	function search($country=NULL,$region=NULL,$city=NULL){
		
		if(is_numeric($region)) $region=NULL;
		if(is_numeric($city)) $city=NULL;
			
		$data['city'] = $city;
		$data['state'] = $region;
		$data['country'] = $country;
		//else{
			$data['lon1'] = NULL;
			$data['lon2'] = NULL;
			$data['lat1'] = NULL; 
			$data['lat2'] = NULL;
		//}
				
		if($region==NULL && $city==NULL){
			$page_url = base_url()."offers/".$country;
			if($this->uri->segment(3)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(3)-1);
			$config['uri_segment'] = 3;
		} 
		else if($city==NULL){
			$page_url = base_url()."offers/".$country."/".$region;
			if($this->uri->segment(4)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(4)-1);
			$config['uri_segment'] = 4;
		} 
		else{
			$page_url = base_url()."offers/".$country."/".$region."/".$city;
			if($this->uri->segment(5)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(5)-1);
			$config['uri_segment'] = 5;
		}
					
		if(isset($_GET['sort'])) $sort_by = $_GET['sort']; else $sort_by = "data";
		$sort_order = 'desc';$s_o="desc";
		if(isset($_GET['asc'])) {$sort_order = 'asc'; $s_o="asc";} 
		if(isset($_GET['desc'])) {$sort_order = 'desc';$s_o="desc";}
		
		$this->phpsession->clear('searched_parameter');	
		if(!isset($_GET['p']) || $_GET['p']==NULL)
			$offset = 0;
		else
			$offset = $this->first_limit*($_GET['p']-1);
		
		$total_offer = $this->Offer->get_total_active_offers_by_region($data);
		
		
		$config['base_url'] = $page_url."?sort=".$sort_by."&".$s_o."=".$sort_order;
		$config['total_rows'] = $total_offer;
		$config['per_page'] = $this->first_limit;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		
		$this->pagination->initialize($config);	
			
			
		$latest_offers = $this->Offer->get_active_offers_by_region($data,$this->first_limit,$offset,$sort_by,$sort_order);		
		$this->template->set('latest_offers',$latest_offers);
		
		$this->load_most_viewed_offer($this->first_limit,$this->first_offset);
				
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$offer_peroids = $this->OfferPeriod->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		$this->template->set('offer_peroids',$offer_peroids);
		$this->template->set('total_latest_offer', $total_offer);
		
		$this->template->set('pagination_link', $this->pagination->create_links());
		
		$this->template->set('page_js',array('jquery.rating','listing','search','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->set('selected_region',$region);
		
		if($city!=NULL) $seo_text = $city;
		else if($region!=NULL) $seo_text = $region;
		else if($country!=NULL) $seo_text = $country;
		
		$this->template->set('seo_title',"Travel offers in ".$seo_text);
		$this->template->current_view = 'lastminute/index';
		$this->template->render();
	}
}
?>