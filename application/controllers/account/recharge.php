<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller{
	private $first_limit = 20;
	private $second_limit = 12;
	private $first_offset = 0;

	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','myemaillibrary'));
		$this->load->helper('recaptcha');
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('country_model','Country');
		$this->authentication->check_sessionexpire();
		
	}
	
	function index(){
		
		$profile_details = $this->UserProfile->get_user_profile($this->authentication->get_loggedin_userid());
		if($profile_details!=NULL && array_key_exists(0, $profile_details)){
			if($profile_details[0]->invoice_profile_complete==0)	
				redirect($this->config->item('dashboard_account_url'),'refresh');
		}
		
		
		if($this->input->post('buy_credit_for_account')){
			$credit = $this->input->post('credit_amount');
			$payment_method = $this->input->post('payment_methods');
			if($payment_method=="paypal"){
				redirect('paypal','refresh');
			}
			else if($payment_method=="bank_transfer"){
				$user_id = $this->authentication->get_loggedin_userid();
				$invoice_number = $this->User->invoicenumber_gen($user_id);
				$profile_details = $this->UserProfile->get_user_profile($user_id);
				$data['invoice_number'] = $invoice_number;
				$data['payment_through'] = 'Bank Transfer';
				$data['total_amount'] = $credit;
				$data['payment_status'] = 'Pending';
				$data['first_name'] = $profile_details[0]->first_name;
				$data['last_name'] = $profile_details[0]->last_name;
				$data['full_name'] = $profile_details[0]->full_name;
				$data['payer_email'] = $profile_details[0]->email;
				$data['payer_id'] = $user_id;
				$data['mc_currency'] = "EUR";
				$data['item_name'] = "Subscribe Yearly Package";
				$data['transaction_subject'] = "Subscribe Yearly Package";
				$data['user_id'] = $user_id;
				$this->phpsession->save('invoice_number',$invoice_number);
				$this->User->save_payment_request_through_bank($data);
				$this->User->update_user_request_credit($data);
				redirect('payment/bank','refresh');
			}
			
		}

		$display_error=$this->phpsession->get('display_error');
		$this->template->set('display_error',$display_error);
		$this->template->set('error_message',$this->phpsession->get('error_message'));
		$this->phpsession->clear('display_error');
		$this->phpsession->clear('error_message');
		
		$display_message = $this->phpsession->get('display_message');
		$this->template->set('display_message',$display_message);
		$this->template->set('message',$this->phpsession->get('message'));
		$this->phpsession->clear('display_message');
		$this->phpsession->clear('message');
		
		$this->template->set('show_profile_notification',$this->phpsession->get('show_profile_notification'));
		$this->phpsession->clear('show_profile_notification');
		$this->template->set('show_payment_notification',$this->phpsession->get('show_payment_notification'));
		$this->phpsession->clear('show_payment_notification');
		$this->template->set('payment_notification_message',$this->phpsession->get('payment_notification_message'));
		$this->template->set('profile_notification_message',$this->phpsession->get('profile_notification_message'));
		
		$this->template->render();
	}
	
}	
?>