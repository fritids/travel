<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Oturum kontrol�n� yapan, oturum a��k de�ilse istek yap�lan i�lemi iptal edip giri� sayfas�na y�nlendiren fonks.
    function check_login()
    {
        $CI =& get_instance();
        
        $CI->load->model("user_model");
            
        $username = $CI->session->userdata('username');
    	$userhash = $CI->session->userdata('userhash');
            
        if($username == '' || $userhash == '')
    	{
    		redirect(base_url().'member/login','refresh');
    		exit();
    	}
    	elseif( $CI->user_model->exists_email( $username ) == 0 )
    	{
    		redirect(base_url().'member/login','refresh');
    		exit();
    	}
    	else
    	{
    			
    		$userdata  = $CI->user_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
    			
    		if($userhash != $hash_db)
    		{
    			redirect(base_url().'member/login','refresh');
    			exit();
    		}
    	}
    }


// �ye giri�i yap�lm�� m� yap�lmam�� m� sadece d�nd�r�r. Y�nlendirme yapmaz. 
    function is_login()
	{
	   
        $CI =& get_instance();
        
		$CI->load->model("user_model");
		
		$username = $CI->session->userdata('username');
		$userhash = $CI->session->userdata('userhash');
		
		if( $username == '' || $userhash == '' )
		{
			return 0;	
		}
		else
		{
			$userdata  = $CI->user_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
			
			
			if( $CI->user_model->exists_email( $username ) == 0 )
			{
				return 0;
			}
			elseif( $userhash != $hash_db )
			{
				return 0;
			}
			elseif( ( $CI->user_model->exists_email( $username ) == 1 ) && $userhash == $hash_db )
			{
				return 1;
			}
		}
	}
    
    function userdata( $field = 'id' )
    {
        $CI =& get_instance();
        
		$CI->load->model("user_model");
		
		$username = $CI->session->userdata('username');
        
        $userdata = $CI->user_model->user_data( $username );
        
        return $userdata->$field;
    }
    
    function config( $field = 'id' )
    {
        $CI =& get_instance();
        
		$CI->load->model("user_model");
        
        $settings = $CI->user_model->get_settings();
        
        return $settings->$field;
    }
    
?>