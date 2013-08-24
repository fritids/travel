<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller{
	private $first_limit = 20;
	private $second_limit = 12;
	private $first_offset = 0;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		$this->authentication->check_sessionexpire();
		$this->template->set('selected_tab','payment_settings');
	}
	
	function settings(){
		$user_id = $this->authentication->get_loggedin_userid();
		$list_of_payments = $this->User->get_list_of_payments($user_id);
		$this->template->set('list_of_payments',$list_of_payments);
		$this->template->render();
	}
	
	function bank(){
		$invoice_number = $this->phpsession->get('invoice_number');
		$this->template->set('invoice_number',$invoice_number);
		$this->template->render();
	}
}
?>