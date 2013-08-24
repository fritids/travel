<?php
class Gcheck extends Controller {
	
     
	function Gcheck()
	{
		parent::Controller();
		$this->load->library(array('mysmarty','phpsession','formgenerator','AuthLib','pagination','btagslib'));
		$this->load->helper(array('form', 'url'));
		$this->mysmarty->assign('baseurl',base_url());
	}
	
	function index()
	{
		$con_type=$this->phpsession->get('registred_con_type');
		/*if($con_type=="Advanced")
			$paid_amount="50.0";
		if($con_type=="Professional")
			$paid_amount="100.0";
		*/
		$paid_amount=$this->phpsession->get('amount');
		$this->mysmarty->assign('contractor_type_choose',$con_type);
		$this->mysmarty->assign('paid_amount',$paid_amount);
		
		$this->mysmarty->display('payment/gcheck.tpl');
	}
}    
?>