<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function exists_email( $email )
    {
		$email_count = $this->db->get_where('users',array('email' => $email))->num_rows();
		return $email_count;
        
    }
	
	function change_email()
	{
		$data = array('email' => $this->input->post('email'));
		$condition = array('id' => userdata());
		
		return $this->db->update('users',$data,$condition);
	}

	function create_user()
    {
        $member_details = array(
                                    'name' => $this->input->post('name'),
                                    'email' => $this->input->post('email'),
                                    'password' => md5( $this->input->post('pass1') ),
                                    'register_time' => strtotime( date('d F Y g:i a') ),
                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
                                    'status' => '1'
                                    );
                                    
        return $this->db->insert('users',$member_details);
    }
	
	function update_user()
    {
		if($this->input->post('banned') == 1){ $status = 0; }else{ $status = 1; }
        
		$member_details = array(
                                    'name' => $this->input->post('name'),
                                    'email' => $this->input->post('email'),
                                    'department' => $this->input->post('department'),
                                    'status' => $status
                                    );
                                    
        return $this->db->update('users',$member_details,array('id' => $this->input->post('user_id')));
    }
    
    function user_data( $username )
    {
        return $this->db->get_where('users',array('email' => $username))->row();
    }
    
    function check_user_detail()
    {
        $username = $this->input->post('email');
        $password = $this->input->post('password');
        
        $userdata = $this->user_data( $username );
        
        if( $userdata->email == $username && $userdata->password == md5($password) && $userdata->status == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	function create_lostpw_code()
	{
		$lostpw_code = md5( microtime().'-'.rand(10,10000).'-'.$this->input->post('email') );
		
		$this->db->update('users',array('lostpw' => $lostpw_code),array('email' => $this->input->post('email') ));
		
		return $lostpw_code;
	}
	
	function check_code( $email,$code )
	{
		return $this->db->get_where('users',array('email' => $email,'lostpw' => $code))->num_rows();
	}
	
	function create_new_password( $email )
	{
		$new_password = substr( strtoupper( md5( microtime().'-'.rand(100,10000) ) ),0,6 );
		
		if( $this->db->update('users',array('password' => md5($new_password),'lostpw' => ''),array('email' => $email)) )
		{
			return $new_password;
		}
	}
	
	function check_password()
	{
		return $this->db->get_where('users',array('email' => userdata('email'), 'password' => md5( $this->input->post('currentpass') ) ))->num_rows();
	}
	
	function password_update()
	{
		return $this->db->update('users', array('password' => md5($this->input->post('pass1'))), array('email' => userdata('email')));
	}
	
	function user_list()
	{
		$this->db->order_by("users.id", "desc"); 
		$this->db->where('users.id !=',14); // ID 14 : First Admin user. You can't delete. 
        $this->db->select('users.id, users.name, users.email, users.department, users.register_time, departments.department_name');
        $this->db->from('users');
        $this->db->join('departments', 'users.department = departments.id','left');
        
        return $this->db->get()->result();
	}
	
	function department_list()
	{
		return $this->db->get('departments')->result();
	}
	
	function get_user( $user_id )
	{
		return $this->db->get_where('users',array('id' => $user_id))->row();
	}
	
	function check_user_id( $user_id )
    {
        return $this->db->get_where('users',array('id' => $user_id))->num_rows();
    }
	
	function delete( $user_id )
	{
		if( $this->db->delete('users',array('id' => $user_id)) )  // Delete user
		{
			$this->db->delete('tickets',array('user_id' => $user_id));
			$this->db->delete('messages',array('user_id' => $user_id));
			return true;
		}
	}
    
    function get_settings()
    {
        return $this->db->get_where('settings',array('id' => 1))->row();
    }
    
    function upload_settings()
    {
		$data = array(
        'allowed_extensions' => $this->input->post('allowed_extensions'),
        'max_upload_files' => $this->input->post('max_upload_files'),
        'max_upload_file_size' => $this->input->post('max_upload_file_size')
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
    
    function general_settings()
    {
		$data = array(
        'site_name' => $this->input->post('site_name'),
        'site_email' => $this->input->post('site_email'),
        'tickets_per_page' => $this->input->post('tickets_per_page')
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}

}



?>