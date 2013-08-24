<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
		
	function __construct(){
		parent::__construct();
	}

	function about_us(){
		$this->template->set('seo_title',lang('about_us_page_title'));
		$this->template->set('select','about');
		$this->template->render();
	}
	
	function support(){
		$this->template->set('seo_title',lang('support_page_title'));
		$this->template->set('select','support');
		$this->template->render();
	}
	
	function contact(){
		$this->template->set('seo_title',lang('contact_page_title'));
		$this->template->set('select','contact');
		$this->template->render();
	}
	
	function conditions(){
		$this->template->set('seo_title',lang('conditions_page_title'));
		$this->template->set('select','conditions');
		$this->template->render();
	}
	
	function privacy(){
		$this->template->set('seo_title',lang('privacy_page_title'));
		$this->template->set('select','privacy');
		$this->template->render();
	}
	
	function how_it_works(){
		$this->template->set('seo_title',lang('how_it_works_page_title'));
		$this->template->set('select','how_it_works');
		$this->template->render();
	}
	
	function how_it_works_tourist(){
		$this->template->set('seo_title',lang('how_it_works_tourist_page_title'));
		$this->template->set('select','how_it_works_tourist');
		$this->template->render();
	}
	
	function how_it_works_hotel_owner(){
		$this->template->set('seo_title',lang('how_it_works_hotel_page_title'));
		$this->template->set('select','how_it_works_hotel');
		$this->template->render();
	}
	
	function how_it_works_tourist_office(){
		$this->template->set('seo_title',lang('how_it_works_office_page_title'));
		$this->template->set('select','how_it_works_office');
		$this->template->render();
	}
	
	function get_started(){
		$this->template->set('seo_title',lang('get_started_page_title'));
		$this->template->set('select','get_started');
		$this->template->render();
	}
	
	function jobs(){
		$this->template->set('seo_title',lang('career_page_title'));
		$this->template->set('select','jobs');
		$this->template->render();
	}
}