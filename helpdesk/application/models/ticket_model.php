<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function departments()
    {
        return $this->db->get('departments')->result();
    }
    
    function check_department_id( $id )
    {
        return $this->db->get_where('departments',array('id' => $id))->num_rows();
    }
    
    function open_tickets()
    {
        if( userdata('department') == 0)
        {
            $where = "(ticket_status = 1 || ticket_status = 2) && user_id = ".userdata();
			$this->db->order_by("tickets.id", "desc"); 
        }
        else
        {
            $where = "(ticket_status = 1 || ticket_status = 2)";
			$this->db->order_by("tickets.priority", "desc"); 
        }
        
        $this->db->where( $where );
		$this->db->select('tickets.id, tickets.department_id, tickets.created_time, tickets.title, tickets.ticket_status, departments.department_name');
        $this->db->from('tickets');
        $this->db->join('departments', 'tickets.department_id = departments.id','left');
        
        return $this->db->get()->result();
    }
    
    function other_tickets($start,$end)
    {
        if( userdata('department') == 0)
        {
            $where = "tickets.ticket_status = 3 && tickets.user_id = ".userdata();
        }
        else
        {
            $where = "tickets.ticket_status = 3";
        }
        
        
        $this->db->where( $where );
        $this->db->order_by("tickets.id", "desc"); 
        $this->db->limit($end,$start); 
        $this->db->select('tickets.id, tickets.department_id, tickets.created_time, tickets.title, tickets.ticket_status, departments.department_name');
        $this->db->from('tickets');
        $this->db->join('departments', 'tickets.department_id = departments.id','left');
        
        return $this->db->get()->result();
    }
    
    function total_tickets()
    {
        if( userdata('department') == 0 )
        {
            return $this->db->get_where('tickets',array('ticket_status' => 3, 'user_id' => userdata()))->num_rows();
        }
        else
        {
            return $this->db->get_where('tickets',array('ticket_status' => 3))->num_rows();
        }
        
    }
   
    
    function create_ticket()
    {
        
        $data = array(
                      "department_id" => $this->input->post('department'),
                      "user_id"       => userdata(),
                      "title"         => $this->input->post('title'),
                      "priority"      => $this->input->post('priority'),
                      "created_time"  => strtotime( date('d F Y g:i a') ),
                      "ip_address"    => $this->input->server('REMOTE_ADDR'),
                      "ticket_status"        => 2
                      );
        $this->db->insert('tickets',$data);
        
        $ticket_id = $this->db->insert_id();
        
        $message = array(
                      "ticket_id"     => $ticket_id,
                      "user_id"       => userdata(),
                      "message"       => strip_tags($this->input->post('message'),'<a><b><i><u><ul><li><ol><pre>'),
                      "ip_address"    => $this->input->server('REMOTE_ADDR'),
                      "created_time"  => strtotime( date('d F Y g:i a') )
                      );
                      
        $this->db->insert('messages',$message);
        
        $message_id = $this->db->insert_id();
        
        $this->transfer_attachments(0,$message_id);
        
        return $ticket_id;
        
    }
    
    function new_message()
    {
        //$msg_text =  ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $this->input->post('message'));
        
        $message = array(
                      "ticket_id"     => $this->input->post('ticket_id'),
                      "user_id"       => userdata(),
                      "message"       => strip_tags($this->input->post('message'),'<a><b><i><u><ul><li><ol><pre>'),
                      "ip_address"    => $this->input->server('REMOTE_ADDR'),
                      "created_time"  => strtotime( date('d F Y g:i a') )
                      );
                      
        $this->db->insert('messages',$message);
        $insert_id = $this->db->insert_id();
        
        $this->transfer_attachments( $this->input->post('ticket_id'), $insert_id );
		
        if( userdata('department') != 0)
        {
            $this->db->update('tickets',array('ticket_status' => 1),array('id' => $this->input->post('ticket_id')));
        }
        else
        {
            $this->db->update('tickets',array('ticket_status' => 2),array('id' => $this->input->post('ticket_id')));
        }
		
		return $insert_id;
    }
    
    function transfer_attachments( $ticket_id, $message_id )
    {
        $attach_count = $this->db->get_where('attachments_tmp',array('ticket_id' => $ticket_id))->num_rows();
        
        if($attach_count > 0)
        {
            $attachments = $this->db->get_where('attachments_tmp',array('ticket_id' => $ticket_id))->result();
            
            $attach_data = array();
            
            foreach( $attachments as $attach )
            {
                $attach_data[] = $attach->file_name;
            }
            
            if( $this->db->update('messages', array('files' => json_encode($attach_data)), array('id' => $message_id)) )
            {
                $this->db->delete('attachments_tmp',array('ticket_id' => $ticket_id));
            }
            
        }
        
        
    }
    
    function exists_ticket( $ticket_id )
    {
        // if customer
        if(userdata('department') == 0)
        {
            $condition = array('id' => $ticket_id,'user_id' => userdata());
        }
        // if support team
        else 
        {
            $condition = array('id' => $ticket_id);
        }
        
        return $this->db->get_where('tickets',$condition)->num_rows();
    }
    
    function ticket_details( $ticket_id )
    {
        // if customer
        if(userdata('department') == 0)
        {
            $condition = array('tickets.id' => $ticket_id, 'tickets.user_id' => userdata() );
        }
        // if support team
        else 
        {
            $condition = array('tickets.id' => $ticket_id );
        }
		
        $this->db->where( $condition );
        $this->db->select('tickets.id, tickets.department_id, tickets.title, tickets.priority, tickets.created_time, tickets.ticket_status, users.name, users.email, ');
        $this->db->from('tickets');
        $this->db->join('users', 'tickets.user_id = users.id');
        
        return $this->db->get()->row();
		//print_r($this->db->get()->row()); die();
    }
    
    function ticket_messages( $ticket_id )
    {
	
        $condition = array('messages.ticket_id' => $ticket_id );
        $this->db->where( $condition );
		$this->db->order_by('messages.id','asc');
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->join('users', 'messages.user_id = users.id');
        
        return $this->db->get()->result();
        
    }
    
    function get_department_name( $department_id )
    {
        $department_detail = $this->db->get_where('departments',array('id' => $department_id))->row();
        return $department_detail->department_name;
    }
    
    function delete_ticket( $ticket_id )
    {
        if( userdata('department') == 0)
        {
            $this->db->delete('tickets',array('id' => $ticket_id, 'user_id' => userdata()));
            $this->db->delete('messages',array('ticket_id' => $ticket_id, 'user_id' => userdata()));
        }
        else
        {
            $this->db->delete('tickets',array('id' => $ticket_id));
            $this->db->delete('messages',array('ticket_id' => $ticket_id));
        }
        
        return true;
    }
    
    function close_ticket( $ticket_id )
    {
        if( userdata('department') == 0 )
        {
            return $this->db->update('tickets',array('ticket_status' => 3),array('id' => $ticket_id, 'user_id' => userdata()));
        }
        else
        {
            return $this->db->update('tickets',array('ticket_status' => 3),array('id' => $ticket_id));
        }
        
    }
	
	function userdata_with_id( $user_id )
    {
        return $this->db->get_where('users',array('id' => $user_id))->row();
    }
	
	function message_details( $message_id )
	{
		return $this->db->get_where('messages',array('id' => $message_id ))->row();
	}
	
	function get_attachments_tmp( $ticket_id = 0 )
	{
		return $this->db->get_where('attachments_tmp',array('ticket_id' => $ticket_id, 'user_id' => userdata()))->result();
	}
	
	function save_file( $file_data )
	{
		return $this->db->insert('attachments_tmp',$file_data);
	}
	
	function exists_file( $file_name )
    {
        return $this->db->get_where('attachments_tmp',array('file_name' => $file_name))->num_rows();
    }
	
	function delete_file( $file_name )
	{
		return $this->db->delete('attachments_tmp',array('file_name' => $file_name));
	}
    

}



?>