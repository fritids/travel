<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotels extends CI_Controller {
	private $first_limit = 9;
	private $first_offset = 0;
	public $search_radius = 20;
	
	function __construct(){
		parent::__construct();
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->load->model('Hoteltype_model','Hoteltype');
		$this->load->model('offer_model','Offer');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('service_model','Service');
		$this->load->model('attachment_model','Attachment');
		$this->load->model('comment_model','Comment');
		$this->template->set('page','hotels');
		$this->load->library('myemaillibrary');
		$this->load->model('country_model','Country');
		$this->load->model('geo_model','Geomodel');
		$this->load->library('pagination');
		$this->template->set('seo_title', lang('seo-title'));
		$this->template->set('countries',$this->Country->get_all());
		$this->template->set('states',$this->Geomodel->get_states());
		$this->template->set('cities',$this->Geomodel->get_cities());
	}
	
	function index(){
			
		if($this->uri->segment(3)==NULL)
			$offset = 0;
		else
			$offset = $this->first_limit*($this->uri->segment(3)-1);
		
		$total_hotels = $this->UserProfile->get_total_hotel_profiles();
		
		$config['base_url'] = base_url()."hotels/page";
		$config['total_rows'] = $total_hotels;
		$config['per_page'] = $this->first_limit;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
				
		$this->load_hotel_list($this->first_limit,$offset);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);		
		$this->template->set('total_hotels', $total_hotels);
		
		$this->template->set('pagination_link', $this->pagination->create_links());
		
		$this->template->set('page_js',array('jquery.rating','hotel_listing','search_hotel','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
	
	function load_hotel_list($limit,$offset){
		$hotel_list = $this->UserProfile->get_hotel_profiles($limit,$offset);
		$this->template->set('hotel_list',$hotel_list);
	}
	
	function view($hotel_id=NULL){
		if($hotel_id!=NULL){
			$this->load_hotel_information($hotel_id);
			$this->load_users_active_offers($hotel_id);
			
			$services = $this->Service->get_all();
			$this->template->set('services',$services);
			$this->template->set('page_js',array('jquery.rating','hotel_listing'));
			$this->template->set('page_css',array('jquery.rating'));
			$this->template->render();
		}
	}
	
	function load_hotel_information($user_id=NULL){
		if($user_id!=NULL){
			$hotel_profile_information = $this->UserProfile->get_user_profile($user_id);
			$hotel_profile_services = $this->Service->get_userprofile_hotel_services($user_id,$arr=TRUE);
			$hotel_profile_themes = $this->LastminuteTheme->get_userprofile_hotel_themes($user_id,$arr=FALSE);
			$hotel_profile_attachments = $this->Attachment->get_profile_attachments($user_id);
			$hotel_comments = $this->Comment->get_hotel_commetns($user_id,$this->first_limit,$this->first_offset);
		
			if($hotel_profile_information==NULL)
				show_404();
			
			$this->template->set('seo_title',hotel_seo_title($hotel_profile_information[0]));
			$this->template->set('seo_description',hotel_seo_description($hotel_profile_information[0]));
			
			$this->template->set('hotel_profile_information',$hotel_profile_information);
			$this->template->set('hotel_profile_services',$hotel_profile_services);
			$this->template->set('hotel_profile_themes',$hotel_profile_themes);
			$this->template->set('hotel_profile_attachments',$hotel_profile_attachments);
			$this->template->set('comments',$hotel_comments);
		}
	}
	
	function load_users_active_offers($user_id=NULL){
		if($user_id!=NULL){
			$user_active_offers = $this->Offer->get_active_offers($user_id);
			$this->template->set('user_active_offers',$user_active_offers);	
		}
	}
	
	function like_profile(){
		$profile_id = $this->input->post('profile_id');
		if($profile_id!=NULL){
			if($this->authentication->is_loggedin()){
				$profile_details = $this->UserProfile->get_user_profile($profile_id);
				$user_id = $this->authentication->get_loggedin_userid();
				
				if(!$this->UserProfile->have_already_liked_this_hotel_indb($profile_id,$user_id)){
					$this->UserProfile->like_this_profile($profile_id,$user_id);
					$this->UserProfile->update_profile_like_number($profile_id);
					echo "1";
				}
				else{
					$like_status = $this->UserProfile->get_profile_like_status($profile_id,$user_id);
					if($like_status=="0"){
						$this->UserProfile->set_like_on_profile($profile_id,$user_id);
						$this->UserProfile->update_profile_like_number($profile_id);
						echo "1";
					}
					elseif($like_status=="1"){
						$this->UserProfile->unlike_profile($profile_id,$user_id);
						$this->UserProfile->update_profile_like_number_decrease($profile_id);
						echo "0";
					}
				}
			}
			else
				echo "You have to log into the system for like match.";
		}
	}
	
	function follow_profile(){
		$hotelprofile_id = $this->input->post('hotelprofile_id');
		if($hotelprofile_id!=NULL){
			if($this->authentication->is_loggedin()){
				$profile_details = $this->UserProfile->get_user_profile($hotelprofile_id);
				$user_id = $this->authentication->get_loggedin_userid();
				
				if(!$this->UserProfile->have_already_follow_this_hotel_indb($hotelprofile_id,$user_id)){
					$this->UserProfile->follow_this_profile($hotelprofile_id,$user_id);
					$this->UserProfile->update_profile_follower_number($hotelprofile_id);
					echo "1";
				}
				else{
					$follow_status = $this->UserProfile->get_profile_follow_status($hotelprofile_id,$user_id);
					if($follow_status=="0"){
						$this->UserProfile->set_follow_on_profile($hotelprofile_id,$user_id);
						$this->UserProfile->update_profile_follower_number($hotelprofile_id);
						echo "1";
					}
					elseif($follow_status=="1"){
						$this->UserProfile->unfollow_profile($hotelprofile_id,$user_id);
						$this->UserProfile->update_profile_follower_number_decrease($hotelprofile_id);
						echo "0";
					}
				}
			}
			else
				echo "You have to log into the system for like match.";
		}
	}

	function send_request_information(){
		if($this->input->post()){
			$email = $this->input->post('request_information_email');
			$name = $this->input->post('request_information_name');
			$phone = $this->input->post('request_information_phone');
			$message = $this->input->post('message');
			$hotel_id = $this->input->post('hotel_id');
			$hotel_details = $this->UserProfile->get_user_profile($hotel_id);
			if($hotel_details!=NULL && $name!=NULL && $email!=NULL){
				$toemail=$hotel_details[0]->email;				
				$replace['hotel_profile_link'] = base_url().hotel_url($hotel_details[0]);
				$replace['requester_name'] = $name;
				$replace['requester_email'] = $email;
				$replace['requester_phone'] = $phone;
				$replace['requester_message'] = $message;
				$replace['hotel_name'] = $hotel_details[0]->hotel_name;
				$this->myemaillibrary->set_email_category('request_hotel_information');
				$this->myemaillibrary->send_email($toemail,$replace);
				echo "1";
			}
			else
				echo "0";
		}
	}
	
	function search_hotel(){
		$search_text = $this->input->post('city');
		$data['search_latitude'] = $this->input->post('search_latitude');
		$data['search_longitude'] = $this->input->post('search_longitude');
		$data['search_facility'] = $this->input->post('search_by_hotel_facility');
		$data['search_theme'] = $this->input->post('search_by_hotel_theme');		
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
		
		if($data['search_latitude']!=NULL && $data['search_longitude']!=NULL){		
			$data['lon1'] = $data['search_longitude'] - $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lon2'] = $data['search_longitude'] + $this->search_radius/abs(cos(deg2rad($data['search_latitude']))*69);
			$data['lat1'] = $data['search_latitude']-($this->search_radius/69); 
			$data['lat2'] = $data['search_latitude']+($this->search_radius/69);
			$this->phpsession->save('searched_parameter',$data);
		}
		
		$star_rating = $this->input->post('area');
		$hotel_type = $this->input->post('search_by_hotel_type');
		$hotel_theme = $this->input->post('search_by_hotel_theme');
		$hotel_facility = $this->input->post('search_by_hotel_facility');
		$star_rating = $this->input->post('search_by_hotel_star');
		
		$return_result = array();
		$hotel_list = $this->UserProfile->search_hotel($city, $state, $country, $star_rating, $hotel_type, $hotel_theme, $hotel_facility,$data);
		if($hotel_list!=NULL)
		foreach($hotel_list as $key=>$value){
			$each_hotel_services = $this->Service->get_userprofile_hotel_services($value->user_id,TRUE);
			$each_hotel_theme = $this->LastminuteTheme->get_userprofile_hotel_themes($value->user_id,TRUE);
			if($each_hotel_services==NULL) $each_hotel_services=array();
			if($each_hotel_theme==NULL) $each_hotel_theme=array();
			
			if(array_key_exists('search_facility',$data) && $data['search_facility']!=NULL && !empty($data['search_facility']))
				$filter_by_service = array_intersect($data['search_facility'], $each_hotel_services);
			if(array_key_exists('search_theme',$data) && $data['search_theme']!=NULL && !empty($data['search_theme']))
				$filter_by_theme = array_intersect($data['search_theme'], $each_hotel_theme);
			
			
			if(!empty($filter_by_service) || !empty($filter_by_theme))
				array_push($return_result,$value);
			else if(empty($data['search_facility']) && empty($data['search_theme']))
				array_push($return_result,$value);
			
		}
		
		$this->template->set('hotel_list',$return_result);
		
		$this->template->set('page_js',array('jquery.rating'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->current_view = 'hotels/_hotel_list_search';
		$this->template->render();
	}
	
	function direct_search(){
		$city = $this->uri->segment(5);
		$state = $this->uri->segment(4);
		$country = $this->uri->segment(3);
		$star_rating = $this->uri->segment(7);
		
		if($city=="any") $city=NULL;
		if($state=="any") $state=NULL;
		if($country=="any") $country=NULL;
		if(!is_numeric($star_rating)) $star_rating=array('1','2','3','4','5');
		else $star_rating=array($star_rating);
		
		$search_text="";
		if($city!=NULL) $search_text = $city.",";
		if($state!=NULL) $search_text .= $state.",";
		if($country!=NULL) $search_text .= $country;
		
		$searched_parameter = $this->phpsession->get('searched_parameter');
		if($searched_parameter!=NULL && is_array($searched_parameter)){
			if(array_key_exists('lon1', $searched_parameter)) $data['lon1'] = $searched_parameter['lon1'];
			if(array_key_exists('lon2', $searched_parameter)) $data['lon2'] = $searched_parameter['lon2'];
			if(array_key_exists('lat1', $searched_parameter)) $data['lat1'] = $searched_parameter['lat1'];
			if(array_key_exists('lat2', $searched_parameter)) $data['lat2'] = $searched_parameter['lat2'];			
		}
		else
			$data = array();
		
		$hotel_list = $this->UserProfile->search_hotel($city, $state, $country, $star_rating, $hotel_type=NULL, $hotel_theme=NULL, $hotel_facility=NULL,$data,$this->first_limit,$this->first_offset);
		$this->template->set('hotel_list',$hotel_list);
		
		
		$this->template->set('search_text',$search_text);
		$this->template->set('search_rating',$star_rating);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		
		$this->template->set('page_js',array('jquery.rating','hotel_listing','search_hotel','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}

	function load_hotel_search_map(){
		$city = $this->uri->segment(5);
		$state = $this->uri->segment(4);
		$country = $this->uri->segment(3);
		$star_rating = $this->uri->segment(7);
		
		if($city=="any") $city=NULL;
		if($state=="any") $state=NULL;
		if($country=="any") $country=NULL;
		if(!is_numeric($star_rating)) $star_rating=array('1','2','3','4','5');
		else $star_rating=array($star_rating);
		
		$search_text="";
		if($city!=NULL) $search_text = $city.",";
		if($state!=NULL) $search_text .= $state.",";
		if($country!=NULL) $search_text .= $country;
		
		$searched_parameter = $this->phpsession->get('searched_parameter');
		if($searched_parameter!=NULL && is_array($searched_parameter)){
			if(array_key_exists('lon1', $searched_parameter)) $data['lon1'] = $searched_parameter['lon1'];
			if(array_key_exists('lon2', $searched_parameter)) $data['lon2'] = $searched_parameter['lon2'];
			if(array_key_exists('lat1', $searched_parameter)) $data['lat1'] = $searched_parameter['lat1'];
			if(array_key_exists('lat2', $searched_parameter)) $data['lat2'] = $searched_parameter['lat2'];			
		}
		
		
		$hotel_list = $this->UserProfile->search_hotel($city, $state, $country, $star_rating, $hotel_type=NULL, $hotel_theme=NULL, $hotel_facility=NULL,$data,$this->first_limit,$this->first_offset);
		$this->template->set('hotel_list',$hotel_list);
                
                $this->template->current_view = 'hotels/_hotels_large_map';
                $this->template->render('ajax');
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
			$page_url = base_url()."hotels/".$country;
			if($this->uri->segment(3)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(3)-1);
			$config['uri_segment'] = 3;
		} 
		else if($city==NULL){
			$page_url = base_url()."hotels/".$country."/".$region;
			if($this->uri->segment(4)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(4)-1);
			$config['uri_segment'] = 4;
		} 
		else{
			$page_url = base_url()."hotels/".$country."/".$region."/".$city;
			if($this->uri->segment(5)==NULL)
				$offset = 0;
			else
				$offset = $this->first_limit*($this->uri->segment(5)-1);
			$config['uri_segment'] = 5;
		}  
		
		
		
		$total_hotels = $this->UserProfile->get_total_hotel_profiles_by_region($data);
		
		
		
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total_hotels;
		$config['per_page'] = $this->first_limit;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		
		$this->pagination->initialize($config);
				
		$hotel_list = $this->UserProfile->get_hotel_profiles_by_region($data, $this->first_limit,$offset);
		$this->template->set('hotel_list',$hotel_list);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);		
		$this->template->set('total_hotels', $total_hotels);
		
		$this->template->set('pagination_link', $this->pagination->create_links());
		
		$this->template->set('page_js',array('jquery.rating','hotel_listing','search_hotel','left_searchpanel'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->current_view = 'hotels/index';
		$this->template->render();
					
	}
	
	
}
?>