<?php
/*************************************************
APIError.php

Displays error parameters.

Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.

*************************************************/


class APIError extends Controller {

	function APIError()
	{
		parent::Controller();
		$this->load->library(array('mysmarty','phpsession','formgenerator','AuthLib','pagination','btagslib'));
		$this->load->helper(array('form', 'url'));
		$this->mysmarty->assign('baseurl',base_url());
	}

	function index()
	{
        //session_start();
		//$resArray=$_SESSION['reshash']; 
		//sprint_r($_SESSION);
		$resArray=$this->phpsession->get('reshash');
		
		
		if($this->phpsession->get('curl_error_no')!=NULL)
		{
			$errorCode= $this->phpsession->get('curl_error_no');
			$errorMessage=$this->phpsession->get('curl_error_msg');	
			$this->mysmarty->assign('curl_error_no',$errorCode);
			$this->mysmarty->assign('curl_error_msg',$errorMessage);
		}
		else
		{
			$this->mysmarty->assign('ACK',$resArray['ACK']);
			$this->mysmarty->assign('CORRELATIONID',$resArray['CORRELATIONID']);
			$this->mysmarty->assign('VERSION',$resArray['VERSION']);
			$this->mysmarty->assign('resArray',$resArray);
			
			$count=0;
			$error_total=array();
			
			while (isset($resArray["L_SHORTMESSAGE".$count])) 
				{		
		  			$myarray=array();
					$errorCode_val    = $resArray["L_ERRORCODE".$count];
					$myarray['errorCode']=$errorCode_val;
		  			$shortMessage_val = $resArray["L_SHORTMESSAGE".$count];
					$myarray['shortMessage']=$shortMessage_val;
		  			$longMessage_val  = $resArray["L_LONGMESSAGE".$count]; 
					$myarray['longMessage']=$longMessage_val;
					array_push($error_total,$myarray);
		  			$count=$count+1;
				}
			$this->mysmarty->assign('count_total',$count);
			$this->mysmarty->assign('error_total',$error_total);
		}
		
		$this->mysmarty->display('payment/APIError.tpl');
		//$this->mysmarty->display('payment/about_us.tpl');
	}
	
	
	
}




?>