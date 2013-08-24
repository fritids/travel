<?php
  
class launcher extends CI_Controller {

	
	
   function __construct()
       {
     		parent::__construct();
	   }
	        
	function index()
	{
		$this->load->model('sitemaper_model');
		$this->sitemaper_model->makeSitemapBlock('hotelsList');
		$this->sitemaper_model->makeSitemapBlock('offersList');
		$this->sitemaper_model->makeSitemapBlock('sitemap_builder');

	}
}