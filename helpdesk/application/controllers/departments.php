<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departments extends CI_Controller {

    function Departments() 
    {
         parent::__construct();
         
         $this->load->model("departments_model"); // Load departments model
         $this->load->library('form_validation'); // Load form validation library
		 
		 check_login(); // session helper function
		 
		  if( userdata('department') != 1 ) die('Access Forbidden');
    }
	
	/*
     * Listing the Departments, displays new department adding form, makes controls for adding new department,
     */
	function index()
	{
		$data['departments'] = $this->departments_model->department_list();
		$this->load->view('header');
		$this->load->view('departments/index_view',$data);
		$this->load->view('footer');
	}
    /*
     * Displays department create form
     */
    function create()
    {
    	$this->load->view('header');
		$this->load->view('departments/create_view');
		$this->load->view('footer');
    }

    function create_process()
    {
        
        if( $this->form_validation->run('create_department') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
		elseif( $this->departments_model->exist_dep_name( $this->input->post('name') ) == 1)
		{
			echo '<div class="alert error">'.$this->lang->line('already_exists_dep').'</div>';
		}
        else
        {
            
            if( $this->departments_model->create() )
            {
                $this->session->set_flashdata('message','<div class="alert ok">'.$this->lang->line('create_succesful').'</div>');
                echo '<script>location.href="'.base_url('departments/index').'";</script>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
    }
	/*
     * Displays department update form
     */
	function update( $department_id )
	{
		$data['department'] = $this->departments_model->get_department( $department_id );
		
		$this->load->view('header');
		$this->load->view('departments/update_view',$data);
		$this->load->view('footer');
	}

	function update_process()
	{
		if( $this->form_validation->run('update_department') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
		elseif( $this->departments_model->exist_dep_name( $this->input->post('name') ) == 1)
		{
			echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
		}
        else
        {
            
            if( $this->departments_model->update() )
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
     * Checks the Departman ID.
     * @param  a department id, integer
     * @return bool
     */
	function _check_department_id($department_id)
	{
		if( $this->departments_model->check_department_id( $department_id ) == 0 )
		{
			$this->form_validation->set_message('_check_department_id', 'The department id hidden field is invalid.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/*
     * Deletes the Department and related items.
     * @param  a department id, integer
     * @return string for ajax
     */
	function delete( $department_id )
	{
		if( $this->_check_department_id($department_id) )
		{
			if( $this->departments_model->delete($department_id) )
			{
				echo 'deleted';
			}
		}
	}
	
    
    
}
