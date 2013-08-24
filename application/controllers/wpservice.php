<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wpservice extends CI_Controller {
	
	function __construct(){
	    parent::__construct();
		// Your own constructor code
	}
	
	public function get_header(){
		$this->template->current_view = 'layouts/_header';
		$this->template->render('ajax.php');
	}
	
	public function get_stylesheets(){
		$this->template->current_view = 'layouts/_stylesheets';
		$this->template->render('ajax.php');
	}
	
	public function get_javascripts(){
		$this->template->current_view = 'layouts/_javascripts';
		$this->template->render('ajax.php');
	}
	
	public function get_footer(){
		$this->template->current_view = 'layouts/_footer';
		$this->template->render('ajax.php');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */