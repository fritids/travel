<?php
ini_set('max_execution_time',0);
/*
define('API_USERNAME', 'younus_1203492428_biz_api1.mbsoftbd.com');
define('API_PASSWORD', '1203492457');
define('API_SIGNATURE', 'AcviEVdBIDn9k9OzgdtQWvtdTah4A-4CChma1.ZO9KQqVwmBDKEdEIWx');
*/

define('API_USERNAME', 'mahbub_api1.noocleusmedia.com');
define('API_PASSWORD', 'JDC5XXYTJBPY3BSB');
define('API_SIGNATURE', 'A0ynxcqkk3ZOmK9G2jkxGfpTYx3OAPwWy3USpBHkzXdHiW2ITYbvQ5T-');


define('API_ENDPOINT', 'https://api-3t.paypal.com/nvp');
define('USE_PROXY',FALSE);
define('PROXY_HOST', '208.113.213.78');
define('PROXY_PORT', '808');
define('PAYPAL_URL', 'https://www.paypal.com/webscr&cmd=_express-checkout&token=');
define('VERSION', '3.0');

class DoDirectPaymentReceipt extends Controller {
	public $API_UserName=API_USERNAME;
	public $API_Password=API_PASSWORD;
	public $API_Signature=API_SIGNATURE;
	public $API_Endpoint =API_ENDPOINT;
	public $version=VERSION;

	function DoDirectPaymentReceipt()
	{
		parent::Controller();
		$this->load->model('paymentmodel');
		$this->load->library(array('mysmarty','phpsession','formgenerator','AuthLib','pagination','btagslib'));
		$this->load->helper(array('form', 'url'));
		$this->mysmarty->assign('baseurl',base_url());
		ini_set('max_execution_time',0);
	}

	function index()
	{
		//print_r($_POST);
		$firstName =urlencode( $_POST['firstName']);
		$lastName =urlencode( $_POST['lastName']);
		$creditCardType =urlencode( $_POST['creditCardType']);
		$creditCardNumber = urlencode($_POST['creditCardNumber']);
		$expDateMonth =urlencode( $_POST['expDateMonth']);

		// Month must be padded with leading zero
		$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

		$expDateYear =urlencode( $_POST['expDateYear']);
		$cvv2Number = urlencode($_POST['cvv2Number']);
		$address1 = urlencode($_POST['address1']);

		$address2 = urlencode($_POST['address2']);
		$city = urlencode($_POST['city']);
		$state =urlencode( $_POST['state']);
		$zip = urlencode($_POST['zip']);
		$amount = urlencode($_POST['amount']);
		//$currencyCode=urlencode($_POST['currency']);
		$currencyCode="USD";
		$paymentType=urlencode($_POST['paymentType']);
			//echo $creditCardType.'cc'.$creditCardNumber.'cc'.$cvv2Number.'cc'.$city.'cc'.$zip;

		$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         			$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
		"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

		$resArray=$this->hash_call("doDirectPayment",$nvpstr);
		$ack = strtoupper($resArray["ACK"]);

		if($ack=="SUCCESS")
		{
			$billing_cycle=$this->phpsession->get('billing_cycle');
			if($billing_cycle=="Monthly")
			$expire_date=date ("Y-m-d H:i:s",strtotime("+1 month"));
			if($billing_cycle=="Yearly")
			$expire_date=date ("Y-m-d H:i:s",strtotime("+1 year"));

			$code = 'p@$$word'; //Encryption code
			$encoded_card_no=$this->blowfish_crypt($_POST['creditCardNumber'],$code);


			$membership_price=$this->phpsession->get('membership_price');
			$con_zipcode=$this->phpsession->get('registered_zipcode');
			$sp_id=$this->paymentmodel->get_sp_id($con_zipcode);

			$insert_data=array(	'p_id'=>'',
								'invoice_no'=>$_POST['invoice_number'],
								'first_name'=>$_POST['firstName'],
								'last_name'=>$_POST['lastName'],
								'card_type'=>$_POST['creditCardType'],
								'card_number'=>$encoded_card_no[0],
								'expdatemonth'=>$_POST['expDateMonth'],
								'expdateyear'=>$_POST['expDateYear'],
								'cvv2number'=>$_POST['cvv2Number'],
								'billing_address_line1'=>$_POST['address1'],
								'billing_address_line2'=>$_POST['address2'],
								'billing_city'=>$_POST['city'],
								'billing_state'=>$_POST['state'],
								'billing_zipcode'=>$_POST['zip'],
								'country'=>'US',
								'amount'=>$membership_price,
								'currency_code'=>'USD',
								'payment_type'=>$_POST['paymentType'],
								'transaction_id'=>$resArray["TRANSACTIONID"],
								'timestamp'=>$resArray["TIMESTAMP"],
								'corelation_id'=>$resArray["CORRELATIONID"],
								'payment_status'=>$resArray["ACK"],
								'is_active'=>'1',
								'expiredate'=>$expire_date,
								'payment_recurring'=>$billing_cycle,
								'payment_for'=>'Membership',
								'sp_id'=>$sp_id,
								'id'=>$_POST['paid_user_id']);

			//print_r($insert_data);
			$insertok=$this->paymentmodel->insert_credit_card_info($insert_data);
			
			if($this->phpsession->get('is_featured')=="yes")
			{
				$featured_billing_cycle=$this->phpsession->get('featured_billing_cycle');
				$expire_date=date ("Y-m-d H:i:s",strtotime("+1 month"));
			
				$featured_price=$this->phpsession->get('featured_price');
				$con_zipcode=$this->phpsession->get('registered_zipcode');
				$sp_id=$this->paymentmodel->get_sp_id($con_zipcode);

			$insert_data=array(	'p_id'=>'',
								'invoice_no'=>$_POST['invoice_number'],
								'first_name'=>$_POST['firstName'],
								'last_name'=>$_POST['lastName'],
								'card_type'=>$_POST['creditCardType'],
								'card_number'=>$_POST['creditCardNumber'],
								'expdatemonth'=>$_POST['expDateMonth'],
								'expdateyear'=>$_POST['expDateYear'],
								'cvv2number'=>$_POST['cvv2Number'],
								'billing_address_line1'=>$_POST['address1'],
								'billing_address_line2'=>$_POST['address2'],
								'billing_city'=>$_POST['city'],
								'billing_state'=>$_POST['state'],
								'billing_zipcode'=>$_POST['zip'],
								'country'=>'US',
								'amount'=>$featured_price,
								'currency_code'=>'USD',
								'payment_type'=>$_POST['paymentType'],
								'transaction_id'=>$resArray["TRANSACTIONID"],
								'timestamp'=>$resArray["TIMESTAMP"],
								'corelation_id'=>$resArray["CORRELATIONID"],
								'payment_status'=>$resArray["ACK"],
								'is_active'=>'1',
								'expiredate'=>$expire_date,
								'payment_recurring'=>$featured_billing_cycle,
								'payment_for'=>'Featured Listing',
								'sp_id'=>$sp_id,
								'id'=>$_POST['paid_user_id']);
					$insertok=$this->paymentmodel->insert_credit_card_info($insert_data);
					
					$data2=array('fc_id'=>'',
								'fc_u_id'=>$_POST['paid_user_id'],
								'start_from'=>date ("Y-m-d H:i:s"),
								'start_to'=>$expire_date,
								'state'=>$_POST['state'],
								'fcon_city'=>$_POST['city'],
								'posting_datetime'=>date ("Y-m-d H:i:s"),
								'status'=>'1');
					$this->paymentmodel->set_featured($data2);
			}
			
			
			if($_POST['paid_user_id']!=NULL)
			$this->paymentmodel->update_user_membership($_POST['paid_user_id'],$expire_date);
			if($insertok)
			{
				redirect('index.php/secure/payment/success','refresh');
			}
		}
		else
		{
			$this->phpsession->save('reshash',$resArray);
			$this->phpsession->save("receive_error","There was an error processing your credit card information. Please ensure all information is correct. <br>If errors persist, try another credit card.");   ////  Change the messgae
			redirect('index.php/secure/payment/credit_card','refresh');
		}

		$this->mysmarty->assign('paymentType',$paymentType);
	 	$this->mysmarty->assign('resArrayTRANSID',$resArray['TRANSACTIONID']);
	 	$this->mysmarty->assign('currencyCode',$currencyCode);
	 	$this->mysmarty->assign('resArrayAMT',$resArray['AMT']);
	 	$this->mysmarty->assign('resArrayAVSCODE',$resArray['AVSCODE']);
	 	$this->mysmarty->assign('resArrayCVV2MATCH',$resArray['CVV2MATCH']);

		$this->mysmarty->display('payment/DoDirectPaymentReceipt.tpl');

	}



	function hash_call($methodName,$nvpStr)
	{
		//declaring of global variables
		//global $API_Endpoint,$version,$API_UserName,$API_Password,$API_Signature,$nvp_Header;

		//setting the curl parameters.
		$ch = curl_init();

		//print_r($ch);

		//echo 'unuss'.$ch.'cc'.$this->API_Endpoint;
		curl_setopt($ch, CURLOPT_URL,$this->API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php
		if(USE_PROXY)
		curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT);

		//NVPRequest for submitting to server
		$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($this->version)."&PWD=".urlencode($this->API_Password)."&USER=".urlencode($this->API_UserName)."&SIGNATURE=".urlencode($this->API_Signature).$nvpStr;

	//echo $nvpreq;
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

		//getting response from server
		$response = curl_exec($ch);
	    	//echo '<br>';
//print($response);
		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;

		if (curl_errno($ch)) {
			// moving to display page to display curl errors
			  $this->phpsession->save('curl_error_no',curl_errno($ch));
			  $this->phpsession->save('curl_error_msg',curl_error($ch));
			  
				$this->phpsession->save("receive_error","There was an error processing your credit card information. Please ensure all information is correct. <br>If errors persist, try another credit card.");  ////  Change the messgae
				redirect('index.php/secure/payment/credit_card','refresh');

				//redirect('index.php/secure/APIError','refresh');
			 /* $location = "APIError.php";
			  header("Location: $location");*/
		 } else {
			 //closing the curl
				curl_close($ch);
		  }

	return $nvpResArray;
	}

	function deformatNVP($nvpstr)
	{

		$intial=0;
		$nvpArray = array();


		while(strlen($nvpstr)){
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		 }
		return $nvpArray;
	}



	function blowfish_crypt($string, $key)
	{
   		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
   		$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
   		$string = mcrypt_encrypt(MCRYPT_BLOWFISH, $key,
                            $string, MCRYPT_MODE_CBC, $iv);

   		return array(base64_encode($string), base64_encode($iv));
 	}

	function blowfish_decrypt($cyph_arr, $key)
	{
   		$out = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, base64_decode($cyph_arr[0]),
                         MCRYPT_MODE_CBC, base64_decode($cyph_arr[1]));

   		return trim($out);
 	}


}


?>