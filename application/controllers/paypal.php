<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class paypal extends CI_Controller {
	
    var $last_error;                 // holds the last error encountered
    var $ipn_log;                    // bool: log IPN results to text file?
    var $ipn_log_file;               // filename of the IPN log
    var $ipn_response;               // holds the IPN response from paypal   
    var $ipn_data = array();         // array contains the POST values for IPN
	var $fields = array();           // array holds the fields to submit to paypal
	var $paid_amount='99.00';
	var $user_id=NULL;
	var $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
   
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->authentication->check_sessionexpire();
		$is_loggedin = $this->authentication->is_loggedin();
		if($is_loggedin){
			$this->user_id = $this->authentication->get_loggedin_userid();
		}
	}
	
	function index(){
		$this->last_error = '';
		$this->ipn_log_file = $_SERVER['DOCUMENT_ROOT'].'/system/application/controllers/secure/.ipn_results.log';
		$this->ipn_log = true; 
		$this->ipn_response = '';
     	
		$pay_type = "yearly"; 
		if($pay_type=="monthly"){
				$this->add_field('cmd', '_xclick-subscriptions');
				$this->add_field('a3',$this->paid_amount);
				$this->add_field('p3','1');
				$this->add_field('t3','M');
				$this->add_field('src', '1');
				$this->add_field('sra', '1');
				$this->add_field('no_shipping', '1');
				$this->add_field('currency_code', 'EUR');
				$this->add_field('business', 'ashish.kumar.basak@gmail.com');
				$this->add_field('payer_id',$this->user_id);
		}else
			{
			  $this->add_field('rm','2');           
			  $this->add_field('cmd','_xclick');
			  $this->add_field('business', 'matthias.gutsch@gmail.com'); 
			  $this->add_field('no_shipping', '1');
			  $this->add_field('currency_code', 'EUR');
			  $this->add_field('return', base_url().'paypal/success');
			  $this->add_field('cancel_return', base_url().'paypal/cancel');
			  $this->add_field('notify_url', base_url().'paypal/ipn');
			  $this->add_field('item_name', 'Subscribe Yearly Package');
			  
			  $this->add_field('payer_id',$this->user_id);
			  $this->add_field('amount',  $this->paid_amount);
		}
		$this->submit_paypal_post(); // submit the fields to paypal
	}

	function success(){
		  	
      		//foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      		//echo "</body></html>";
			
			$this->template->render();
	}
	
	function ipn(){
	  if($this->validate_ipn()) 
	  {
          foreach ($_POST as $field=>$value){ 
	         $this->ipn_data[$field] = $value;
	      }
         $this->ipn_data['payer_email'] = "info@travelly.me";
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'ashish021@gmail.com';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$this->ipn_data['payer_email']." on ".date('m/d/Y');
		 $body .= "from ".$this->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
         foreach ($_POST as $key => $value) { $body .= "\n".$key.": $value"; }
         mail($to, $subject, $body);
		 echo'mail sent !!';
      }
	  else{
	 	 echo'mail sent !!';
         $subject = 'Instant Payment Notification - Recieved Payment ERROR';
         $to = 'ashish021@gmail.com';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$this->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
         foreach ($this->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
         mail($to, $subject, $body);
	  }
	}
	
   
   function add_field($field, $value) 
   {
      
      // adds a key=>value pair to the fields array, which is what will be 
      // sent to paypal as POST variables.  If the value is already in the 
      // array, it will be overwritten.
            
      $this->fields["$field"] = $value;
   }

   function submit_paypal_post() 
   	{
 
      // this function actually generates an entire HTML page consisting of
      // a form with hidden elements which is submitted to paypal via the 
      // BODY element's onLoad attribute.  We do this so that you can validate
      // any POST vars from you custom form before submitting to paypal.  So 
      // basically, you'll have your own form which is submitted to your script
      // to validate the data, which in turn calls this function to create
      // another hidden form and submit to paypal.
 
      // The user will briefly see a message on the screen that reads:
      // "Please wait, your order is being processed..." and then immediately
      // is redirected to paypal.

      echo "<html>\n";
      echo "<head><title>Processing Payment...</title></head>\n";
      echo "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
     // echo "<center><h2>Please wait, your order is being processed and you";
      //echo " will be redirected to the paypal website.</h2></center>\n";
      echo "<form method=\"post\" name=\"paypal_form\" ";
      echo "action=\"".$this->paypal_url."\">\n";

      foreach ($this->fields as $name => $value) 
	  {
         echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
      }
     // echo "<center><br/><br/>If you are not automatically redirected to ";
     // echo "paypal within 5 seconds...<br/><br/>\n";
     // echo "<input type=\"submit\" value=\"Click Here\"></center>\n";
      
      echo "</form>\n";
      echo "</body></html>\n";
    
   	}
   
   function validate_ipn(){
      $url_parsed=parse_url($this->paypal_url);        
      $post_string = '';    
      foreach ($_POST as $field=>$value){ 
         $this->ipn_data[$field] = $value;
         $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
      }
      $post_string.="cmd=_notify-validate"; // append ipn command
      $fp = fsockopen($url_parsed['host'],"80",$err_num,$err_str,30); 
      if(!$fp) {
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->log_ipn_results(false);       
         return false;
      } 
	  else{ 
         fputs($fp, "POST ".$url_parsed['path']." HTTP/1.1\r\n"); 
         fputs($fp, "Host: ".$url_parsed['host']."\r\n"); 
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
         fputs($fp, "Connection: close\r\n\r\n"); 
         fputs($fp, $post_string . "\r\n\r\n"); 
         // loop through the response from the server and append to variable
         while(!feof($fp)) { 
            $this->ipn_response .= fgets($fp, 1024); 
         } 

         fclose($fp); // close connection

      }
          ;
      if (preg_match('VERIFIED', $this->ipn_response, $extension)) {
  		// Valid IPN transaction.
         $this->log_ipn_results(true);
         return true;                
      }
	  else {
         // Invalid IPN transaction.  Check the log for details.
         $this->last_error = 'IPN Validation Failed.';
         $this->log_ipn_results(false);   
         return false;         
      }      
   }
   
   function log_ipn_results($success) 
   {
       
      if (!$this->ipn_log) return;  // is logging turned off?
      
      // Timestamp
      $text = '['.date('m/d/Y g:i A').'] - '; 
      
      // Success or failure being logged?
      if ($success) $text .= "SUCCESS!\n";
      else $text .= 'FAIL: '.$this->last_error."\n";
      
      // Log the POST variables
      $text .= "IPN POST Vars from Paypal:\n";
      foreach ($this->ipn_data as $key=>$value) 
	  {
         $text .= "$key=$value, ";
      }
 
      // Log the response from the paypal server
      $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;
      
      // Write to log
      $fp=fopen($this->ipn_log_file,'a');
      fwrite($fp, $text . "\n\n"); 

      fclose($fp);  // close file
   }

   function dump_fields() 
   {
 
      // Used for debugging, this function will output all the field/value pairs
      // that are currently defined in the instance of the class using the
      // add_field() function.
      
      echo "<h3>paypal_class->dump_fields() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>"; 
      
      ksort($this->fields);
      foreach ($this->fields as $key => $value)
	  {
      		echo "<tr><td>$key</td><td>".urldecode($value)."&nbsp;</td></tr>";
      }
 
      echo "</table><br>"; 
   }





}
?>