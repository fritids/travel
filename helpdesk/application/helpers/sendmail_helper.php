<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
     * test if the date is today
     * @param  a date string
     * @return bool
     */
	function send_notice($email,$subject,$message)
    {
		$CI =& get_instance();
        
        $CI->load->model("ticket_model");
        
        $CI->load->library('email');
        $config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);

			
		$CI->email->from( config('site_email') , $CI->config->item('site_name') );
		$CI->email->to( $email );
			
		$CI->email->subject( $subject );
		$CI->email->message( $message );
			
		$CI->email->send();

		
        
    }



    
?>