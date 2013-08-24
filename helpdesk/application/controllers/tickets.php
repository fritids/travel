<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends CI_Controller {

    function Tickets() 
    {
         parent::__construct();
         
         $this->load->model("user_model"); // load user database model
         $this->load->model("ticket_model"); // load ticket database model
         $this->load->library('form_validation'); // load form validation library
         
         check_login();
    }
    /*
     * Listing and paging tickets.
     */
    function index()
    {
	
        if(is_numeric($this->uri->segment(3)))
		{
			$start = $this->uri->segment(3);
		}
		else
		{
			$start = 0;
		}
        
        $this->load->library('pagination');

        $config['base_url'  ] = base_url('tickets/index');
        $config['total_rows'] = $this->ticket_model->total_tickets();
        $config['per_page'  ] = config('tickets_per_page'); 
		$config['next_link' ] = $this->lang->line('next').' &rarr;';
		$config['prev_link' ] = '&larr; '.$this->lang->line('previous');

		$config['num_links' ] = 5;
        
        $this->pagination->initialize($config); 
        
        $data['links']         = $this->pagination->create_links();
        $data['open_tickets' ] = $this->ticket_model->open_tickets();
        $data['other_tickets'] = $this->ticket_model->other_tickets($start,$config['per_page']);
        
        $this->load->view('header');
        $this->load->view('tickets/ticket_list',$data);
        $this->load->view('footer');
    }
    /*
     * Shows new ticket form
     */
    function create()
    {
        $data['departments'] = $this->ticket_model->departments();
        
        $this->load->view('header');
        $this->load->view('tickets/create_ticket',$data);
        $this->load->view('footer');
    }
    /*
     * new ticket processing
     */
    function create_process()
    {
        
        
        if( $this->form_validation->run('create_ticket') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            $ticket_id = $this->ticket_model->create_ticket();
            
            
            if( $ticket_id > 0 )
            {
                
                
                
                // send e-mail
                $email = config('site_email');
                $subject = vlang('new_ticket_from_customer_subject',array($ticket_id,date('d F Y g:i a')));
                $message = $this->lang->line('new_ticket_from_customer');
                send_notice($email,$subject,$message);
                
                echo '<script>location.href="'.base_url('tickets/id/'.$ticket_id).'";</script>';
            }
            else
            {
                echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
            }
        }
    }
    /*
     * Checks whether the ticket is available in the system
     */
    function _exists_ticket( $ticket_id )
    {
        if( $this->ticket_model->exists_ticket($ticket_id) == 0 )
        {
            $this->form_validation->set_message('_exists_ticket', 'The ticket id hidden field is invalid.');
            return false;
        }
        else
        {
            return true;
        }
    }
    /*
     * Private Function - Checks whether the Department ID is available in the system
     * @param  a department id integer
     * @return bool
     */
    function _check_department_id( $id )
    {
        if( $this->ticket_model->check_department_id( $id ) == 0 )
        {
            $this->form_validation->set_message('_check_department_id', 'The Department field is required.');
            return false;
        }
        else
        {
            return true;
        }
    }
    /*
     * Private Function - check priority id
     * @param  a priority id integer
     * @return bool
     */
    function _check_priority_id( $id )
    {
        $priority = array(1,2,3);
        
        return in_array($id,$priority) ? true : false;
    }
    /*
     * Displays details of the ticket according to incoming ticket ID.
     * @param  a ticket id integer
     */
    function id( $ticket_id = 0)
    {
		
        if( is_numeric( $ticket_id ) && $this->ticket_model->exists_ticket( $ticket_id ) == 1)
        {
            $data['ticket']   = $this->ticket_model->ticket_details( $ticket_id );
			$data['messages'] = $this->ticket_model->ticket_messages( $ticket_id );
            
            
            if(is_object($data['ticket']))
            {
                $data['department'] = $this->ticket_model->get_department_name( $data['ticket']->department_id );
                
                $this->load->view('header');
                $this->load->view('tickets/ticket_details',$data);
                $this->load->view('footer');
            }
            else
            {
                echo 'Access Denied';
            }
            
        }
        else
        {
            echo 'Invalid ticket id';
        }
    }
    /*
     * reply message processing
     */
    function reply_process()
    {
        if( $this->form_validation->run('reply') == FALSE)
        {
			echo '<ul>'.validation_errors('<li>','</li>').'</ul>';
        }
        else
        {
			
            $insert_id = $this->ticket_model->new_message();
			
			$message_details = $this->ticket_model->message_details( $insert_id );
			
            if( userdata('department') == 0)
            {
                $email = config('site_email');
                $subject = vlang('new_message_from_customer_subject',array($this->input->post('ticket_id'),date('d F Y g:i a')));
                $message = $this->lang->line('new_message_from_customer');
                
                send_notice($email,$subject,$message);
				
				echo '<div class="chatline-customer">
    				<div class="profile">	
    					<img src="'.base_url().'images/customerimg.jpg" width="60" height="60" alt="customer" class="chatpicture"/>
    					<p class="chatname">'.$this->lang->line('customer').'</p>
    				</div>
    				<div class="ballon">'.$message_details->message;
                    
                    $files = json_decode($message_details->files,true);
                    
                    if(count($files) > 0)
                    {
                        echo '<div class="attachments">
                    <h4>'.$this->lang->line('attach').' : </h4>
                    <ul>';
                    
                        for($c = 0; $c <= count($files); $c++)
                        {
                            echo '<li><a href="'.base_url('attachments/'.$files[$c]).'" target="_blank">'.$files[$c].'</a></li>';
                        }
                    
                    echo '</ul></div>';
                    
                    }
                    
                    echo '</div>
    				<img src="'.base_url().'images/customer-ballon-arrow.png" alt="arrow" class="customer-arrow"/>
    				<div class="clear"></div>
    				<div class="customer-date">'.date('d F Y g:i a',$message_details->created_time).'</div>
    			</div>';
            }
            else
            {
                $email = config('site_email');
                $subject = vlang('new_message_from_support_subject',array($this->input->post('ticket_id'),date('d F Y g:i a')));
                $message = $this->lang->line('new_message_from_support');
                
				$ticket_detail = $this->ticket_model->ticket_details( $this->input->post('ticket_id') );
				
				send_notice($ticket_detail->email,$subject,$message);
				
				echo '<div class="chatline-support">
    				<div class="profile">	
    					<img src="'.base_url().'images/supportimg.jpg" width="60" height="60" alt="support" class="chatpicture"/>
    					<p class="chatname">'.$this->lang->line('support').'</p>
    				</div>
    				<div class="ballon">'.$message_details->message;
                    
                    $files = json_decode($message_details->files,true);
                    
                    if(count($files) > 0)
                    {
                        echo '<div class="attachments">
                    <h4>'.$this->lang->line('attach').' : </h4>
                    <ul>';
                    
                        for($c = 0; $c <= count($files); $c++)
                        {
                            echo '<li><a href="'.base_url('attachments/'.$files[$c]).'" target="_blank">'.$files[$c].'</a></li>';
                        }
                    
                    echo '</ul></div>';
                    
                    }
                    echo '</div>
    				<img src="'.base_url().'images/support-ballon-arrow.png" alt="arrow" class="support-arrow"/>
    				<div class="clear"></div>
    				<div class="support-date">'.date('d F Y g:i a',$message_details->created_time).'</div>
    			</div>';
            }
            
            
        }
    }
	
    /*
     * delete ticket and ticket's messages
     * @param  a ticket id integer
     * @return string for ajax
     */
    function delete( $ticket_id )
    {
        if( is_numeric( $ticket_id ) && $this->ticket_model->exists_ticket( $ticket_id ) == 1 && userdata('department') > 0)
        {
            if( $this->ticket_model->delete_ticket( $ticket_id ) )
            {
                echo 'deleted';
            }
        }
		else
		{
			echo 'Invalid request';
		}
    }
    /*
     * Close the ticket
     * @param  a ticket id integer
     * @return string for ajax
     */
    function close( $ticket_id )
    {
        if( is_numeric( $ticket_id ) && $this->ticket_model->exists_ticket( $ticket_id ) == 1)
        {
            if( $this->ticket_model->close_ticket( $ticket_id ) )
            {
                echo 'closed';
            }
        }
    }
	
	function upload( $ticket_id = 0 )
	{
	
		$files = $this->ticket_model->get_attachments_tmp($ticket_id);
        
		
		if( count($files) == config('max_upload_files') ) die(vlang('file_upload_limit_error',array(config('max_upload_files'))));
	
		$config['upload_path'] = './attachments/';
		$config['allowed_types'] = config('allowed_extensions');
		$config['max_size']	= config('max_upload_file_size');
		$config['encrypt_name']	= TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			$data  = $this->upload->data();
			
			$file_data	= array('ticket_id' => $ticket_id,
                                'user_id' => userdata(),
							    'file_name' => $data['file_name']);
				  
			$this->ticket_model->save_file( $file_data );
		}
	}
	
	function uploaded_files( $ticket_id = 0 )
	{
		if( $ticket_id != 0 && ! $this->_exists_ticket( $ticket_id ) ) die('Invalid Ticket ID'); 
		
		$files = $this->ticket_model->get_attachments_tmp( $ticket_id );
		
		if(! empty($files))
		{
			foreach( $files as $file )
			{
				echo '<a href="javascript:void(0)" onclick="delete_file(\''.$file->file_name.'\');"><img src="'.base_url('images/delete.gif').'" /></a> <a href="'.base_url('attachments/'.$file->file_name).'" target="_blank">'.$file->file_name.'</a><br>';
			}
		}
	}
	
	function delete_file($file_name)
	{
		if( $this->ticket_model->exists_file($file_name) == 0 ) die('Invalid file name');
		
		if( $this->ticket_model->delete_file($file_name) )
		{
			unlink('./attachments/'.$file_name); echo 'deleted'; // dont change !! This is key
		}
		
	}
    
}