<?php
class Dashboard extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation'));
			$this->load->helper('recaptcha');
			
			$this->userauthentication->check_sessionexpire();
       }
	   
	
	
	function index()
	{
		$this->template->display('dashboard/index.tpl');
	}

}
?>