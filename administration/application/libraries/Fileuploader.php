<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fileuploader
{
	public $error=array(),$data,$filedata;
	
	function Fileuploader(){
    	$this->obj =& get_instance();
    }
	
	function upload_bills($form_field_name,$user_id){
		$upload_path = BILLS_ATTACHMENT_UPLOAD_PATH."/".$user_id;
		if(!is_dir($upload_path)) mkdir($upload_path,0777,true);
		$config['upload_path'] = $upload_path; // after baseurl, ./uploads/
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['encrypt_name']=TRUE;
		$config['remove_spaces'] = true;
		$config['max_size']	= 1000;
		$this->obj->load->library('upload', $config);
	
		if ( ! $this->obj->upload->do_upload($form_field_name)){
			array_push($this->error,$this->obj->upload->display_errors());
			$this->obj->template->set('file_upload_error',$this->error[0]);
		}	
		else{	
			$data = array('upload_data' => $this->obj->upload->data());
			$this->filedata=$data['upload_data'];
			//print_r($this->filedata);
		}
	}
}
?>