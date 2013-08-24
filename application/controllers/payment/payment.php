<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller{ {

	function __construct(){
	    parent::__construct();
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
		//print_r($_SESSION);

		//echo "ashish=".$this->phpsession->get('registered_zipcode');


		$username=$this->phpsession->get('username');

		if($username==NULL)
		{
			$this->phpsession->save('error_login','We apologize for the inconvenience, but our system has encountered an error.');
			redirect('','refresh');
		}

		$user_id=$this->contractor_regmodel->get_userid_from_user_name($username);

		$con_type=$this->phpsession->get('registred_con_type');
		$billing_cycle=$this->phpsession->get('billing_cycle');
		$this->mysmarty->assign('billing_cycle',$billing_cycle);
		if($con_type=="Advanced")
			{
				if($billing_cycle=="Yearly")
				$paid_amount="500.0";
				else
				$paid_amount="50.0";
			}
		if($con_type=="Professional")
			{
				if($billing_cycle=="Yearly")
				$paid_amount="1000.0";
				else
				$paid_amount="100.0";
			}

		$this->mysmarty->assign('contractor_type_choose',$con_type);
		$this->mysmarty->assign('paid_amount',$paid_amount);
		$this->mysmarty->display('payment/payment_method.tpl');
	}



	function credit_card()
	{
		//print_r($_SESSION);
		$con_type=$this->phpsession->get('registred_con_type');
		$this->mysmarty->assign('registered_con_type',$con_type);
		$username=$this->phpsession->get('username');
		if($username==NULL)
		{
			$this->phpsession->save('error_login','We apologize for the inconvenience, but our system has encountered an error.');
			redirect('','refresh');
		}


		if($username!=NULL)
		$user_id=$this->contractor_regmodel->get_userid_from_user_name($username);
		else
		$user_id=NULL;


		$this->mysmarty->assign('paid_user_id',$user_id);

		$membership_price=$this->phpsession->get('membership_price');
		$membership_billing_cycle=$this->phpsession->get('billing_cycle');
		$featured_price=$this->phpsession->get('featured_price');
		$featured_billing_cycle=$this->phpsession->get('featured_billing_cycle');
		$paid_amount=$membership_price+$featured_price;//$this->phpsession->get('amount');

		$this->mysmarty->assign('membership_price',$membership_price);
		$this->mysmarty->assign('billing_cycle',$membership_billing_cycle);
		$this->mysmarty->assign('featured_price',$featured_price);
		$this->mysmarty->assign('featured_billing_cycle',$featured_billing_cycle);
		$this->mysmarty->assign('contractor_type_choose',$con_type);
		$this->mysmarty->assign('paid_amount',$paid_amount);

		$invoice_number=$this->paymentmodel->invoicenumber_gen();
		$this->mysmarty->assign('invoice_no',$invoice_number);

		$paymentType = 'Sale';
		$this->mysmarty->assign('paymentType',$paymentType);



		$receive_error=$this->phpsession->get('receive_error');
		$this->mysmarty->assign('error_in_payment',$receive_error);


		$this->mysmarty->display('payment/credit_card_payment.tpl');
		//session_unset();

	}

	function option()
	{
		//print_r($_POST);
		$this->phpsession->save('pay_type',$this->input->post('pay_type'));

		$membership_price=$this->input->post('membership_price');
		$this->phpsession->save('membership_price',$membership_price);
		if($this->input->post('featured_listing_check')=="yes")
		{
			$featured_price=$this->input->post('featured_price');
			$featured_billing_cycle=$this->input->post('featured_listing');
			$this->phpsession->save('is_featured','yes');
		}
		else
		{
			$featured_price=0;
			$featured_billing_cycle=NULL;
		}
		$this->phpsession->save('featured_price',$featured_price);
		$this->phpsession->save('featured_billing_cycle',$featured_billing_cycle);

		$total=$membership_price+$featured_price;

		$this->phpsession->save('amount',$total);

		if($this->input->post('chk_card')=='credit')
		 {
			//redirect('index.php/secure/payment/credit_card','refresh');
                     $session_id=get_cookie('PHPSESSID');
                     header("Location: https://secure.renodigs.com/payment/index/".$session_id);
		 }
		 else if($this->input->post('chk_card')=='paypal')
		 {
		 	redirect('secure/paypal','refresh');
		 }
		 else
		 {
		  redirect('secure/gcheck','refresh');
		 }

	}

	function success()
	{
		$this->mysmarty->display('static_page/welcome2u.tpl');
	}

	function check_promocode($code=NULL)
	{
		if($code!=NULL)
		{
			$is_valid=$this->contractor_regmodel->check_promocode_validity($code);
			if($is_valid)
			{
				$this->phpsession->save('promocode',$code);
				echo $promo_details=$this->contractor_regmodel->get_promo_details($code);
			}
			else
			{
				echo "You entered an invalid promotion code. Please check the code and try again.";
			}
		}
	}

}
?>
