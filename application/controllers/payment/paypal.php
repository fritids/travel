<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class paypal extends CI_Controller {
	
    var $last_error;                 // holds the last error encountered
    var $ipn_log;                    // bool: log IPN results to text file?
    var $ipn_log_file;               // filename of the IPN log
    var $ipn_response;               // holds the IPN response from paypal   
    var $ipn_data = array();         // array contains the POST values for IPN
	var $fields = array();           // array holds the fields to submit to paypal
	var $paid_amount='50.00';
   
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
	  $this->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
      $this->last_error = '';
      $this->ipn_log_file = $_SERVER['DOCUMENT_ROOT'].'/renodigs/system/application/controllers/secure/.ipn_results.log';
      $this->ipn_log = true; 
      $this->ipn_response = '';
     
	 $pay_type=$this->phpsession->get('pay_type'); 
      // populate $fields array with a few default values.  See the paypal
      // documentation for a list of fields and their data types. These defaul
      // values can be overwritten by the calling script.

      //$this->add_field('rm','2');           // Return method = POST
     // $this->add_field('cmd','_xclick'); 
	  
	  $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];


// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process':      // Process and order...

      
	  if($pay_type=="monthly")
	  {
	  	$this->add_field('cmd', '_xclick-subscriptions');
		$this->add_field('a3',$this->paid_amount);
	    $this->add_field('p3','1');
		$this->add_field('t3','M');
		$this->add_field('src', '1');
		$this->add_field('sra', '1');
		$this->add_field('no_shipping', '1');
		$this->add_field('currency_code', 'USD');
		$this->add_field('business', 'younus_1203492428_biz@mbsoftbd.com');
		$this->add_field('payer_id',$this->user_id);
	  }
	  else
	  {
	  	  $this->add_field('rm','2');           
     	  $this->add_field('cmd','_xclick');
		  $this->add_field('business', 'younus_1203492428_biz@mbsoftbd.com');
		  $this->add_field('return', $this_script.'/secure/paypal/success');
		  $this->add_field('cancel_return', $this_script.'/secure/paypal/cancel');
		  $this->add_field('notify_url', 'http://www.noocleusmedia.com/paypal/paypal.php?action=ipn');
		  $this->add_field('item_name', 'Paypal Test Transaction');
		  
		  $this->add_field('payer_id',$this->user_id);
		  $this->add_field('amount',  $this->paid_amount);
	  }

      $this->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  
 
      echo "<html><head><title>Success</title></head><body><h3>Thank you for your order.</h3>";
      foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      echo "</body></html>";
	  
      
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...

      // The order was canceled before being completed.
 
      echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
      echo "</body></html>";
      
      break;
      
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calling this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, update your database to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      
      if ($p->validate_ipn()) {
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
  
         // For this example, we'll just email ourselves ALL the data.
		 echo'mail sent !!';
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'younus.sardar@mbsoftbd.com';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
         foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
         mail($to, $subject, $body);
      }
      break;
 }  
	  
	  
	  
	}


	function success()
	{
		  echo "<html><head><title>Success</title></head><body><h3>Thank you for your order.</h3>";
      		foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      		echo "</body></html>";
	}
	
	function ipn()
	{
	  if ($this->validate_ipn()) {
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
  
         // For this example, we'll just email ourselves ALL the data.
		 echo'mail sent !!';
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'ashish.basak@mbsoftbd.com';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$this->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
         foreach ($this->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
         mail($to, $subject, $body);
      }
	  else
	  {
	 	 echo'mail sent !!';
         $subject = 'Instant Payment Notification - Recieved Payment ERROR';
         $to = 'ashish.basak@mbsoftbd.com';    //  your email
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
   
   function validate_ipn() 
   {

      // parse the paypal URL
      $url_parsed=parse_url($this->paypal_url);        

      // generate the post string from the _POST vars aswell as load the
      // _POST vars into an arry so we can play with them from the calling
      // script.
      $post_string = '';    
      foreach ($_POST as $field=>$value) 
	  { 
         $this->ipn_data["$field"] = $value;
         $post_string .= $field.'='.urlencode(stripslashes($value)).'&'; 
      }
      $post_string.="cmd=_notify-validate"; // append ipn command

      // open the connection to paypal
      $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30); 
      if(!$fp) 
	  {
          
         // could not open the connection.  If loggin is on, the error message
         // will be in the log.
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->log_ipn_results(false);       
         return false;
         
      } else 
	  { 
 
         // Post the data back to paypal
         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n"); 
         fputs($fp, "Host: $url_parsed[host]\r\n"); 
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n"); 
         fputs($fp, "Connection: close\r\n\r\n"); 
         fputs($fp, $post_string . "\r\n\r\n"); 

         // loop through the response from the server and append to variable
         while(!feof($fp)) 
		 { 
            $this->ipn_response .= fgets($fp, 1024); 
         } 

         fclose($fp); // close connection

      }
      
      if (eregi("VERIFIED",$this->ipn_response)) 
	  {
  
         // Valid IPN transaction.
         $this->log_ipn_results(true);
         return true;       
         
      } else 
	  {
  
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