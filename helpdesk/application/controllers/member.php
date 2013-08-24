<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

    function Member() 
    {
         parent::__construct();
         
         $this->load->model("user_model");
         $this->load->library('form_validation');
    }

	function index()
	{
		redirect(base_url('member/login'),'refresh');
	}
    /*
     * Displays form for new member
     */
    function create()
    {
	if( is_login() == 1 ){ redirect(base_url('tickets/index'),'refresh'); }
       
        $this->load->view('header');
        $this->load->view('user/create_user');
        $this->load->view('footer');
    }
    /*
     * Makes controls for new member.
     */
    function create_process()
    {
        
        if( $this->form_validation->run('create_user') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        elseif( $this->user_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">'.$this->lang->line('already_account').'</div>';
        }
        else
        {
            
            if( $this->user_model->create_user() )
            {
                // login process
                $session_data = array(
                                      "username" => $this->input->post('email'),
                                      "userhash" => md5( md5( $this->input->post('pass1')).$this->config->item('password_hash') ),
                                       );
                                      
                $this->session->set_userdata($session_data);
                
                echo '<script>location.href="'.base_url('member/register_succes').'";</script>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
    }

    function register_succes()
    {
        $userdata = $this->user_model->user_data( $this->session->userdata('username') );
        $data['name'] = $userdata->name;
        
        $this->load->view('header');
        $this->load->view('user/register_succes',$data);
        $this->load->view('footer');
    }

	function lostpw_succes()
    {
    	$this->load->view('header');
        $this->load->view('user/lostpw_succes');
        $this->load->view('footer');
    }
    /*
     * Displays the login form
     */
    function login()
    {
		if( is_login() == 1 ){ redirect(base_url('tickets/index'),'refresh'); }
        $this->load->view('header');
        $this->load->view('user/login_user');
        $this->load->view('footer');
    }

    function login_process()
    {
        if( $this->form_validation->run('login_user') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        elseif( $this->user_model->exists_email( $this->input->post('email') ) == 0 )
        {
            echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
        }
        elseif( $this->user_model->check_user_detail() == FALSE )
        {
            echo '<div class="alert error">'.$this->lang->line('invalid_email_or_pass').'</div>';
        }
        else
        {
            $userdata = $this->user_model->user_data( $this->input->post('email') );
            
            $session_data = array(
                                      "username"   => $userdata->email,
                                      "userhash"   => md5( $userdata->password.$this->config->item('password_hash')  ),
                                      "department" => $userdata->department
                                      );
                                      
            $this->session->set_userdata($session_data);
            
            echo '<script>location.href="'.base_url('tickets/index').'";</script>';
        }
    }
    /*
     * Logout function
     */
    function logout()
    {
        
        $session_items = array(
							'username' => '',
							'userhash'     => '',
                            'department'     => '',
							'logged_in'=> FALSE
							
							);
		
		$this->session->unset_userdata($session_items);
		
		redirect(base_url()."member/login","refresh");
    }
	/*
     * Displays the Password reset form
     */
	function lostpassword()
	{
		if( is_login() == 1 ){ redirect(base_url('tickets/index'),'refresh'); }
		
		$this->load->view('header');
		$this->load->view('user/lostpassword');
		$this->load->view('footer');
	}
	/*
     * Sends request for password reset
     */
	function lostpassword_process()
	{
		if( $this->form_validation->run('lostpassword') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		elseif( $this->user_model->exists_email( $this->input->post('email') ) == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
		}
		else
		{
			$lostpw_code = $this->user_model->create_lostpw_code();
			
			$subject = 'Reset password request';
            $message = 'Hello, <br> To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
            	
			send_notice($this->input->post('email'),$subject,$message);
			
			echo '<script>location.href="'.base_url('member/lostpw_succes').'";</script>';
		}
	}
	/*
     * Checks the reset password code
     */
	function check_code( $email, $code )
	{
		$status = $this->user_model->check_code( $email,$code );
		
		if( $status == 0 )
		{
			$this->session->set_flashdata('message','<div class="alert error">'.$this->lang->line('invalid_reset_code').'</div>');
			redirect(base_url('member/login'),'refresh');
		}
		else
		{
			$new_password = $this->user_model->create_new_password( $email );
			
			$subject = 'New Password';
            $message = 'Hello, <br><br> New password is <b>'.$new_password.'</b>. Please <a href="'.base_url('member/login').'">click here</a> for login';
            	
			send_notice($email,$subject,$message);
			
			$this->session->set_flashdata('message','<div class="alert ok">'.$this->lang->line('new_pass_sent').'</div>');
			redirect(base_url('member/login'),'refresh');
		}
	}
	/*
     * Displays the settings
     */

    
    function settings()
	{
		check_login();
		
		if( userdata('department') == 1 )
		{
			$this->load->model('ticket_model');
			$data['user']   = $this->user_model->user_data( userdata('email') );
			
			$this->load->view('header');
			$this->load->view('user/admin_settings',$data);
			$this->load->view('footer');
			
			
		}
		else
		{
			$data['user'] = $this->user_model->user_data( userdata('email') );
			
			$this->load->view('header');
			$this->load->view('user/user_settings',$data);
			$this->load->view('footer');
		}
	}

	function change_password()
	{
		check_login();
		
		if( $this->form_validation->run('change_password') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		elseif( $this->user_model->check_password() == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('invalid_pass').'</div>';
		}
		else
		{
			if( $this->user_model->password_update() )
			{
				
					$session_data = array(
										  "username"   => userdata('email'),
										  "userhash"   => md5( userdata('password').$this->config->item('password_hash')  ),
										  "department" => userdata('department')
										  );
										  
					$this->session->set_userdata($session_data);
					echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
					echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
		
		
	}
	
	function change_email()
	{
		check_login();
		
		if( $this->form_validation->run('change_email') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		else
		{
			$session_data = array(
								 "username"   => $this->input->post('email'),
								 "userhash"   => md5( userdata('password').$this->config->item('password_hash')  ),
								 "department" => userdata('department')
								 );
										  
			if( $this->user_model->change_email() )
			{
				$this->session->set_userdata($session_data);
				echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
				echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
		
		
	}
    
    
    
    function upload_settings()
    {
        check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
        
        if( $this->form_validation->run('upload_settings') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		else
		{
			 
			if( $this->user_model->upload_settings() )
			{
				echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
				echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
        
    }
    
    function general_settings()
    {
        check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
        
        if( $this->form_validation->run('general_settings') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		else
		{
			 
			if( $this->user_model->general_settings() )
			{
				echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
				echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
        
    }

	function user_list()
	{
		check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
		
		$data['users'] = $this->user_model->user_list();
		
		$this->load->view('header');
		$this->load->view('user/user_list',$data);
		$this->load->view('footer');
	}
	/*
     * Displays member update form
     */
	function update( $user_id )
	{
		check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
		
		$data['user'] = $this->user_model->get_user( $user_id );
		$data['departments'] = $this->user_model->department_list(); 
		
		$this->load->view('header');
		$this->load->view('user/update_user',$data);
		$this->load->view('footer');
	}
	/*
     * update processing
     */
	function update_process()
	{
		check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
		
		if( $this->form_validation->run('update_user') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->user_model->update_user() )
            {
                echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
	}
	/*
     * private function - Checks user ID
     * @param  a user id integer
     * @return bool
     */
	function _check_user_id($user_id)
	{
		if( $this->user_model->check_user_id( $user_id ) == 0 )
		{
			$this->form_validation->set_message('_check_user_id', 'The user id hidden field is invalid.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/*
     * deletes user
     * @param  a user id integer
     * @return string for ajax
     */
	function delete( $user_id )
	{
		check_login();  if( userdata('department') != 1 ) die('Access Forbidden');
		
		if( $this->_check_user_id($user_id) )
		{
			if( $this->user_model->delete($user_id) )
			{
				echo 'deleted';
			}
		}
	}
	
    
    
}
