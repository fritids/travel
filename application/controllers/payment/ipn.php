<?php

class Ipn extends Controller {

	function Ipn()
	{
		parent::Controller();
		$this->load->library(array('mysmarty','phpsession','formgenerator','AuthLib','pagination','btagslib','iptocity'));
		//$this->load->helper(array('form', 'url'));
		$this->load->helper(array('form', 'url','cookie'));
        $this->load->model('paymentmodel');
		$this->load->model('user/contractor_regmodel');
		$this->mysmarty->assign('baseurl',base_url());
		//print_r($_SESSION);
	}
	
	
	function index()
	{
		 $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'mahbub@noocleusmedia.com';    //  your email
         


		if($this->input->post('payment_status')=="Completed" && $this->input->post('txn_type')=="recurring_payment")
			{
			  
				$body =  "You Receive payment successfully \n";
         		$body .= "from paypal profile ID:".$this->input->post('recurring_payment_id')." on ".date('m/d/Y');
         		$body .= " at ".date('g:i A')."\n\nTransaction Details:\n";

			  $data['p_id']='';
			  $data['mc_gross']=$this->input->post('mc_gross');
			  $data['outstanding_balance']=$this->input->post('outstanding_balance');
			  $data['period_type']=$this->input->post('period_type');
			  $data['next_payment_date']=$this->input->post('next_payment_date');
			  $data['payment_cycle']=$this->input->post('payment_cycle');
			  $data['payer_id']=$this->input->post('payer_id');
			  $data['payment_date']=$this->input->post('payment_date');
			  $data['charset']=$this->input->post('charset');
			  $data['invoice_no']=$this->input->post('rp_invoice_id');
			  $data['recurring_payment_id']=$this->input->post('recurring_payment_id');
			  $data['first_name']=$this->input->post('first_name');
			  $data['mc_fee']=$this->input->post('mc_fee');
			  $data['notify_version']=$this->input->post('notify_version');
			  $data['amount_per_cycle']=$this->input->post('amount_per_cycle');
			  $data['payer_status']=$this->input->post('payer_status');
			  $data['business']=$this->input->post('business');
			  $data['verify_sign']=$this->input->post('verify_sign');
			  $data['payer_email']=$this->input->post('payer_email');
			  $data['initial_payment_amount']=$this->input->post('initial_payment_amount');
			  $data['profile_status']=$this->input->post('profile_status');
			  $data['txn_id']=$this->input->post('txn_id');
			  $data['mc_currency']=$this->input->post('mc_currency');
			  $data['receiver_email']=$this->input->post('receiver_email');
			  $data['payment_fee']=$this->input->post('payment_fee');
			  $data['receiver_id']=$this->input->post('receiver_id');
			  $data['txn_type']=$this->input->post('txn_type');
			  $data['last_name']=$this->input->post('last_name');
			  $data['country']=$this->input->post('residence_country');
			  $data['test_ipn']=$this->input->post('test_ipn');
			  $data['receipt_id']=$this->input->post('receipt_id');
			  $data['payment_gross']=$this->input->post('payment_gross');
			  $data['product_type']=$this->input->post('product_type');
			  $data['time_created']=$this->input->post('time_created');
			  $data['amount']=$this->input->post('amount');////////////////IMPORTANT
			  $data['currency_code']=$this->input->post('currency_code');
			  $data['payment_type']=$this->input->post('payment_type');
			  $data['timestamp']=$this->input->post('');/////IMPORTANT
			  $data['payment_status']=$this->input->post('payment_status');
			  $data['is_active']='1';
			  $data['expiredate']='2018-01-01 12:00:00'; //it's first life time and will be updated when user cancel profile
			  $data['payment_recurring']=$this->input->post('payment_cycle');
			  $data['payment_for']=$this->input->post('product_name');
			  
			  $recurring_payment_id=$data['recurring_payment_id'];
			  $data['id']=$this->paymentmodel->get_u_id($recurring_payment_id);
			  
			  $id=$data['id'];
			  $con_zipcode=$this->contractor_regmodel->get_contractor_zipcode($id);
			  $data['sp_id']=$this->paymentmodel->get_sp_id($con_zipcode);
			  
			  $this->paymentmodel->insert_data_into_paypal_bycreditcard($data);	

				foreach ($data as $key => $value) { $body .= "\n$key: $value"; } 
				mail($to, $subject, $body);				  
			}
		

		if($this->input->post('txn_type')=="recurring_payment_profile_created")
			{
               	$body =  "A Paypal Profile is Created in your account.\n";
         		$body .= "Account's paypal profile ID:".$this->input->post('recurring_payment_id')." Created on ".date('m/d/Y');
         		$body .= " at ".date('g:i A')."\n\nProfile Details are below:\n";	

				foreach ($_POST as $key => $value) { $body .= "\n$key: $value"; } 
				mail($to, $subject, $body);	
			}
        
		
     }
	
}
?>