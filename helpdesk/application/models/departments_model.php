<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departments_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function create()
    {
        $department_details = array( 'department_name' => $this->input->post('name') );
                                    
        return $this->db->insert('departments',$department_details);
    }
	
	function update()
    {
		$department_details = array( 'department_name' => $this->input->post('name') );
                                    
        return $this->db->update('departments',$department_details,array('id' => $this->input->post('department_id')));
    }
    
    function department_list()
	{
		return $this->db->get('departments')->result();
	}
	
	function get_department( $department_id )
	{
		return $this->db->get_where('departments',array('id' => $department_id))->row();
	}
	
	function check_department_id( $department_id )
    {
        return $this->db->get_where('departments',array('id' => $department_id))->num_rows();
    }
	
	function delete( $department_id )
	{
		$this->db->delete('departments',array('id' => $department_id));
        
        $tickets = $this->db->get_where('tickets',array('department_id' => $department_id))->result();
        
        if(!empty($tickets))
        {
            foreach($tickets as $ticket)
            {
                $this->db->delete('tickets',array('id' => $ticket->id));
                $this->db->delete('messages',array('ticket_id' => $ticket->id));
            }
        }
        
        
        return true;
	}
	
	function exist_dep_name( $name )
	{
		return $this->db->get_where('departments',array('department_name' => $name))->num_rows();
	}

}



?>