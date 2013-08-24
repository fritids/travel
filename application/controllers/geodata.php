<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Geodata extends CI_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->model('geo_model','Geomodel');
	}
	
	function states($country_id=NULL){
		if($country_id==NULL)
		$country_id = $this->input->post('country_id');
		
		$states = $this->Geomodel->get_states($country_id);
		$this->template->set('states',$states);
		$this->template->set('ajax_load','true');
		$this->template->render();
	}
	
	function searchstates($country_id=NULL){
		if($country_id==NULL)
		$country_id = $this->input->post('country_id');
		
		$states = $this->Geomodel->get_states($country_id);
		$this->template->set('states',$states);
		$this->template->current_view = 'geodata/states_forsearchpage';
		$this->template->render();
	}
	
	function cities($state_id=NULL){
		if($state_id==NULL)
		$state_id = $this->input->post('state_id');
		
		$cities = $this->Geomodel->get_cities($state_id);
		$this->template->set('cities',$cities);
		$this->template->set('ajax_load','true');
		$this->template->render();
	}
	
	function searchcities($state_id=NULL){
		if($state_id==NULL)
		$state_id = $this->input->post('state_id');
		
		$cities = $this->Geomodel->get_cities($state_id);
		$this->template->set('cities',$cities);
		$this->template->current_view = 'geodata/cities_forsearchpage';
		$this->template->render();
	}
	
	function comune($city_id=NULL){
		if($city_id==NULL)
		$city_id = $this->input->post('city_id');
		
		$comuni = $this->Geomodel->get_comuni($city_id);
		$this->template->set('comuni',$comuni);
		$this->template->render();
	}
	
	function searchJSON(){
		$search_with = $this->input->get('name_startsWith');
		$maxrows = $this->input->get('maxRows');
		if($maxrows==NULL) $maxrows = 12;
		$cities = $this->Geomodel->get_all_city_names_new($search_with,$maxrows);
		$data['geonames'] = $cities;
		$data['totalResultsCount'] = $maxrows;
		echo json_encode($data);
	}
}
?>