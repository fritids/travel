<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{
	
	private $number_of_profile_attachment =6;
	function __construct(){
	    parent::__construct();
		// Your own constructor code
		//$this->load->library(array('myvalidation','twitter/twitteroauth','facebook/facebook','tweet'));
		$this->load->library(array('myvalidation','myemaillibrary','fileuploader'));
		$this->load->helper('recaptcha');
		$this->load->model('user_model','User');
		$this->load->model('userprofile_model','UserProfile');
		$this->load->model('usersetting_model','UserSetting');
		$this->load->model('service_model','Service');
		$this->load->model('theme_model','LastminuteTheme');
		$this->template->set('selected_tab',"profile");
		$this->load->model('attachment_model','Attachment');
		$this->load->model('settings_model','Settings');
		$this->load->model('Hoteltype_model','Hoteltype');
		$this->load->model('country_model','Country');
		$this->load->model('geo_model','Geomodel');
		$this->template->set('settings',$this->Settings->load_settings());				
		$this->authentication->check_sessionexpire();
	}
	
	function edit(){
	//break;
		if($this->input->post('save_profile_data')){
			$submitok = $this->validate_profile_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				$this->upload_files($user_id);
				if(empty($this->fileuploader->error)){					
					//print_r($this->myvalidation->data);
					$this->UserProfile->update_usershotel_profile($this->myvalidation->data,$user_id);
					if(array_key_exists('avatar',$this->myvalidation->data) && $this->myvalidation->data['avatar']!=NULL)
					$this->User->update_avatar($this->myvalidation->data['avatar'],$user_id);
					$this->Service->update_userprofile_services($this->myvalidation->data,$user_id);
					$this->LastminuteTheme->update_userprofile_themes($this->myvalidation->data,$user_id);
					$this->UserProfile->update_profile_attachments($this->myvalidation->data,$user_id);
					$this->UserSetting->update_user_settings($this->myvalidation->data,$user_id);
					$this->UserProfile->update_profile_to_complete($user_id);
					$this->phpsession->save('display_message','yes');
					$this->phpsession->save('message',lang('hotel_profile_update_successfully'));
				}
			}	
		}
		
		if($this->input->post('save_profile_data_normal')){
			$submitok = $this->validate_normal_profile_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				$this->myvalidation->data['avatar'] = $this->upload_avatar($user_id);
				$this->template->set('avatar',$this->myvalidation->data['avatar']);
				if(empty($this->fileuploader->error)){
					$this->UserProfile->update_user_profile($this->myvalidation->data,$user_id);
					if($this->myvalidation->data['avatar']!=NULL)
					$this->User->update_avatar($this->myvalidation->data['avatar'],$user_id);
					$this->User->update_user_display_name($this->myvalidation->data,$user_id);
					$this->LastminuteTheme->update_userprofile_themes($this->myvalidation->data,$user_id);
					$this->UserProfile->update_profile_to_complete($user_id);
                                        //$this->UserProfile->update_profile_attachments($this->myvalidation->data,$user_id);
					$this->phpsession->save('display_message','yes');
					$this->phpsession->save('message',lang('hotel_profile_update_successfully'));
				}
			}
		}
		if($this->authentication->is_loggedin())
		$user_id = $this->authentication->get_loggedin_userid();
		
		$user_profile_hotel_services = $this->Service->get_userprofile_hotel_services($user_id,TRUE);
		$user_profile_hotel_themes = $this->LastminuteTheme->get_userprofile_hotel_themes($user_id,TRUE);
		$profile_attachments = $this->Attachment->get_profile_attachments($user_id);
		
		$this->template->set('user_profile_hotel_services',$user_profile_hotel_services);
		$this->template->set('user_profile_hotel_themes',$user_profile_hotel_themes);
		$this->template->set('user_profile_hotel_attachments',$profile_attachments);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		
		$display_message=$this->phpsession->get('display_message');
		$this->template->set('display_message',$display_message);
		$this->template->set('message',$this->phpsession->get('message'));
		$this->phpsession->clear('display_message');
		$this->phpsession->clear('message');
		
		$display_error=$this->phpsession->get('display_error');
		$this->template->set('display_error',$display_error);
		$this->template->set('error_message',$this->phpsession->get('error_message'));
		$this->phpsession->clear('display_error');
		$this->phpsession->clear('error_message');
		
		$this->template->set('show_profile_notification',$this->phpsession->get('show_profile_notification'));
		$this->phpsession->clear('show_profile_notification');
		$this->template->set('show_payment_notification',$this->phpsession->get('show_payment_notification'));
		$this->phpsession->clear('show_payment_notification');
		$this->template->set('payment_notification_message',$this->phpsession->get('payment_notification_message'));
		$this->template->set('profile_notification_message',$this->phpsession->get('profile_notification_message'));
		
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	}
	
	
	function descrizione(){
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	} 
	
	function servizi(){
		
		
		if($this->authentication->is_loggedin())
		$user_id = $this->authentication->get_loggedin_userid();
		
		$user_profile_hotel_services = $this->Service->get_userprofile_hotel_services($user_id,TRUE);
		$user_profile_hotel_themes = $this->LastminuteTheme->get_userprofile_hotel_themes($user_id,TRUE);
		$profile_attachments = $this->Attachment->get_profile_attachments($user_id);
		
		$this->template->set('user_profile_hotel_services',$user_profile_hotel_services);
		$this->template->set('user_profile_hotel_themes',$user_profile_hotel_themes);
		$this->template->set('user_profile_hotel_attachments',$profile_attachments);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	} 
	
	function distanze(){
		
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	} 
	
	function immagini(){
		
		if($this->authentication->is_loggedin())
		$user_id = $this->authentication->get_loggedin_userid();
		
		$user_profile_hotel_services = $this->Service->get_userprofile_hotel_services($user_id,TRUE);
		$user_profile_hotel_themes = $this->LastminuteTheme->get_userprofile_hotel_themes($user_id,TRUE);
		$profile_attachments = $this->Attachment->get_profile_attachments($user_id);
		
		$this->template->set('user_profile_hotel_services',$user_profile_hotel_services);
		$this->template->set('user_profile_hotel_themes',$user_profile_hotel_themes);
		$this->template->set('user_profile_hotel_attachments',$profile_attachments);
		
		$hotel_types = $this->Hoteltype->get_all();
		$services = $this->Service->get_all();
		$lastminute_themes = $this->LastminuteTheme->get_all();
		$this->template->set('hotel_types',$hotel_types);
		$this->template->set('services',$services);
		$this->template->set('lastminute_themes',$lastminute_themes);
		
		$this->template->set('page_js',array('profile','jquery.rating','account_profile'));
		$this->template->set('page_css',array('jquery.rating'));
		$this->template->render();
	} 
	
	
	
	function save_struttura(){
		if($this->input->post('save_profile_data')){
			$submitok = $this->validate_profile_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				//print_r($this->myvalidation->data);
				$this->UserProfile->update_usershotel_struttura($this->myvalidation->data,$user_id);
				$this->UserSetting->update_user_settings($this->myvalidation->data,$user_id);
				//$this->phpsession->save('display_message','yes');
				//$this->phpsession->save('message',lang('hotel_profile_update_successfully'));
				echo lang('hotel_profile_save_struttura_success');
			}else{
				echo lang('hotel_profile_save_struttura_error');
			}	
		}	
	}
	
	function save_descrizione(){
		if($this->input->post('save_profile_data')){
			$submitok = $this->validate_profile_data_descrizione();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				//print_r($this->myvalidation->data);
				$this->UserProfile->update_usershotel_profile_descrizione($this->myvalidation->data,$user_id);
				echo lang('hotel_profile_save_struttura_success');
			}else{
				echo lang('hotel_profile_save_struttura_error');
			}		
		}
	}
	
	function validate_profile_data_descrizione(){
		$this->myvalidation->validate_profile_data_descrizione();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function save_servizi(){
		if($this->input->post('save_profile_data')){
			$submitok = $this->validate_profile_data_servizi();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				//print_r($this->myvalidation->data);
				$this->Service->update_userprofile_services($this->myvalidation->data,$user_id);
				$this->LastminuteTheme->update_userprofile_themes($this->myvalidation->data,$user_id);
				echo lang('hotel_profile_save_struttura_success');
			}else{
				echo lang('hotel_profile_save_struttura_error');
			}	
		}
	}
	
	function validate_profile_data_servizi(){
		$this->myvalidation->validate_profile_data_servizi();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function save_altro(){
		if($this->input->post('save_profile_data')){
			$submitok = $this->validate_profile_data_altro();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();									
				//print_r($this->myvalidation->data);
				$this->UserProfile->update_usershotel_profile_altro($this->myvalidation->data,$user_id);
				echo lang('hotel_profile_save_struttura_success');
			}else{
				echo lang('hotel_profile_save_struttura_error');
			}		
		}
	}
	
	function validate_profile_data_altro(){
		$this->myvalidation->validate_profile_data_altro();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function save_attachment(){
		if($this->input->post('save_profile_data')){
			$submitok = true;
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				$this->upload_files($user_id);
				if(empty($this->fileuploader->error)){					
					//print_r($this->myvalidation->data);
					if(array_key_exists('avatar',$this->myvalidation->data) && $this->myvalidation->data['avatar']!=NULL)
					$this->User->update_avatar($this->myvalidation->data['avatar'],$user_id);
					$this->UserProfile->update_profile_attachments($this->myvalidation->data,$user_id);
					$this->UserProfile->update_profile_to_complete($user_id);
					$this->phpsession->save('selected_profile_edit_tab','immagini');
				}
			}
			redirect($this->config->item('user_profile_edit_url'),'refresh');	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	function upload_files($user_id){
		$profile_attachment=array();
		for($i=1;$i<$this->number_of_profile_attachment;$i++){
			$form_field_name="hotel_attachment_".$i;
			if($_FILES[$form_field_name]['name']!=NULL){
				$this->fileuploader->upload_profile_attachments($form_field_name,$user_id);
				$attachment_id = $this->Attachment->add_attachment($this->fileuploader->filedata,$user_id);
				array_push($profile_attachment,$attachment_id);
                                if($i==1)
                                    $this->myvalidation->data['avatar'] = $this->fileuploader->filedata['file_name'];
			}
		}
		 $this->myvalidation->data['profile_attachment'] = $profile_attachment;
	}
	
	function upload_avatar($user_id){
		$form_field_name="profile_avatar";
		if($_FILES[$form_field_name]['name']!=NULL){
			$this->fileuploader->upload_avatar($form_field_name,$user_id);
			return $this->fileuploader->filedata['file_name'];
		}
		else
			return NULL;
	}
	
	function validate_profile_data(){
		$this->myvalidation->validate_hotel_profile();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function validate_normal_profile_data(){
		$this->myvalidation->validate_normal_user_profile();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function save_payment_profile(){
		if($this->input->post('save_payment_information')){
			$submitok = $this->profile_payment_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				$this->UserProfile->update_payment_profile_data($this->myvalidation->data,$user_id);
				echo lang('payment_profile_update_success');
			}
			else{
				echo lang('payment_profile_update_error');
			}
		}
	}
	
	function profile_payment_data(){
		$this->myvalidation->validate_payment_profile();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	function save_account_profile(){
		$user_id = $this->authentication->get_loggedin_userid();
		if($this->input->post('save_account_information') && $user_id!=NULL){
			$data['full_name'] = $this->input->post('full_name');
			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');
			$data['old_password'] = $this->input->post('old_password');
			$data['password'] = $this->input->post('new_password');
			$data['existing_username'] = $this->input->post('existing_username');
			$data['user_id'] = $user_id;
			$this->User->update_user_display_name($data,$user_id);
			if($data['username']!=$data['existing_username'])
			$this->User->update_username($data['username'],$user_id);
			if($data['old_password']!=NULL && $data['password']!=NULL)
			$this->User->update_user_password($data,$user_id);
			echo lang('account_profile_update_successfully');
		}
		else{
				echo lang('payment_profile_update_error');
			}
	}
	
	function save_invoicing_profile(){
		if($this->input->post('save_invoice_information')){
			$submitok = $this->validate_invoicing_data();
			if($submitok){
				$user_id = $this->authentication->get_loggedin_userid();
				$this->UserProfile->update_invoicing_profile_data($this->myvalidation->data,$user_id);
				echo lang('invoicing_profile_update_success');
			}
			else{
				echo lang('invoicing_profile_update_error');
			}
		}
	}
	
	function validate_invoicing_data(){
		$this->myvalidation->validate_invoicing_profile();
		if(empty($this->myvalidation->error))
			return true;
		else
			return false;
	}
	
	
	function delete_profile_attachment($attachment_id=NULL){
		if($attachment_id!=NULL){
			$user_id = $this->authentication->get_loggedin_userid();
			$this->Attachment->delete_attachment($attachment_id,$user_id);
			$this->UserProfile->delete_profile_attachment($user_id,$attachment_id);
		}
	}
	
	function delete_avatar(){
		$user_id = $this->input->post('user_id');
		if($user_id!=NULL){
			$this->User->update_avatar($filename=NULL,$user_id);
			echo "1";
		}
	}
	
	function delete_profileattachment(){
		$profileattachment_id = $this->input->post('profileattachment_id');
		if($profileattachment_id!=NULL){
			$user_id = $this->authentication->get_loggedin_userid();
			$this->UserProfile->delete_profileattachment($profileattachment_id,$user_id);
			echo "1";
		}
	}
	
	function ByteSize($bytes) { 
    	$size = $bytes / 1024; 
    	if($size < 1024){ 
        	$size = number_format($size, 2); 
        	$size .= ' KB'; 
        }
        else{ 
        	if($size / 1024 < 1024){ 
            	$size = number_format($size / 1024, 2); 
            	$size .= ' MB'; 
			}  
        	else if ($size / 1024 / 1024 < 1024){ 
            	$size = number_format($size / 1024 / 1024, 2); 
            	$size .= ' GB'; 
        	}  
        } 
    	return $size; 
    }
	
	function getHeaders() {
    	$headers = array();
    	foreach ($_SERVER as $k => $v){
        	if (substr($k, 0, 5) == "HTTP_"){
            	$k = str_replace('_', ' ', substr($k, 5));
            	$k = str_replace(' ', '-', ucwords(strtolower($k)));
            	$headers[$k] = $v;
			}
		}
    	return $headers;
	} 
	
	function do_image_upload(){
		$user_id = $this->authentication->get_loggedin_userid();
		$target_path = "assets/profiles/".$user_id."/";
		$allowedExts = array();
		$maxFileSize = 0;
		
		if(!is_dir($target_path)) mkdir($target_path,0777,true);

		$headers = $this->getHeaders();

		if (array_key_exists("X-Requested-With", $headers) and $headers['X-Requested-With']=='XMLHttpRequest') { 
			$fileName = $headers['X-File-Name'];
			$fileSize = $headers['X-File-Size'];
			$ext = substr($fileName, strrpos($fileName, '.') + 1);
			if (in_array($ext,$allowedExts) or empty($allowedExts)) {
				if ($fileSize<$maxFileSize or empty($maxFileSize) or TRUE) {
					$input = fopen("php://input",'r');
					$output = fopen($target_path.$fileName,'a');
					if ($output!=false) {
						while (!feof($input)) {
							$buffer=fread($input, 4096);
							fwrite($output, $buffer);
						}
							fclose($output);
							
							$old = $target_path.$fileName;
							$new_filename = time().$ext;
							$new = $target_path.$new_filename;
							rename($old, $new);
							
							$filedata['file_name'] = $new_filename;
							$filedata['image_height'] = 0;
							$filedata['image_width'] = 0;
							$filedata['file_size'] = $fileSize;
							$filedata['file_type'] = $ext;
							$attachment_id = $this->Attachment->add_attachment($filedata,$user_id);
							$data['profile_attachment']=array();
							array_push($data['profile_attachment'],$attachment_id); 
							$this->UserProfile->update_profile_attachments($data,$user_id);
							$profile_avatar = $this->User->get_avatar_name($user_id);
							if($profile_avatar==NULL)
							$this->User->update_avatar($new_filename,$user_id);
							$this->UserProfile->update_profile_to_complete($user_id);
						echo '{"success":true, "file": "'.$target_path.$fileName.'"}';
					} 
					else 
						echo('{"success":false, "details": "Can\'t create a file handler."}');					
						fclose($input);
				} 
				else {
					echo('{"success":false, "details": "Maximum file size: '.$this->ByteSize($maxFileSize).'."}'); 
				}
			} 
			else {
				echo('{"success":false, "details": "File type '.$ext.' not allowed."}');
			}
		} 
		else {
			if ($_FILES['file']['name']!='') {
				$fileName= $_FILES['file']['name'];
				$fileSize = $_FILES['file']['size'];
				$ext = substr($fileName, strrpos($fileName, '.') + 1);
				if (in_array($ext,$allowedExts) or empty($allowedExts)) {
					if ($fileSize<$maxFileSize or empty($maxFileSize) or TRUE) {
						$target_path2 = $target_path;
						$target_path = $target_path . basename( $_FILES['file']['name']);
						if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
								
							$old = $target_path2.$fileName;
							$new_filename = time().".".$ext;
							$new = $target_path2.$new_filename;
							rename($old, $new);
							
							$filedata['file_name'] = $new_filename;
							$filedata['image_height'] = 0;
							$filedata['image_width'] = 0;
							$filedata['file_size'] = $_FILES['file']['size'];
							$filedata['file_type'] = $ext;
							$attachment_id = $this->Attachment->add_attachment($filedata,$user_id);
							$data['profile_attachment']=array();
							array_push($data['profile_attachment'],$attachment_id); 
							$this->UserProfile->update_profile_attachments($data,$user_id);
							$profile_avatar = $this->User->get_avatar_name($user_id);
							if($profile_avatar==NULL)
							$this->User->update_avatar($new_filename,$user_id);
							$this->UserProfile->update_profile_to_complete($user_id);
							echo '{"success":true, "file": "'.$target_path.'"}';
						} 
						else{
							echo '{"success":false, "details": "move_uploaded_file failed"}';
						}
					} 
					else {
						echo('{"success":false, "details": "Maximum file size: '.$this->ByteSize($maxFileSize).'."}'); 
					}
				} 
				else 
					echo('{"success":false, "details": "File type '.$ext.' not allowed."}');
			} 
			else 
				echo '{"success":false, "details": "No file received."}';
		}
	}

	function crop(){
		
		$user_id = $this->authentication->get_loggedin_userid();
		$profile_attachments = $this->UserProfile->get_profile_uncroped_attachments($user_id);
		if($profile_attachments==NULL) redirect('profile/edit/immagini','refresh');
		//print_r($profile_attachments);
		
		if($profile_attachments!=NULL)
			foreach($profile_attachments as $key=>$item){
				$file = PROFILE_ATTACHMENT_FILE_PATH_FOR_AVATAR.$item->profile_id."/".$item->image_name;
				list($width, $height, $type, $attr) = @getimagesize($file);
				$config['image_library'] = 'gd2';
				$config['source_image']	= $file;
				$config['maintain_ratio'] = TRUE;
				
				if($width>=680){
					$r = 680/$width;
					$config['width']	 = 680;
					$config['height']	 = floor($height*$r);
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				}
			}
		
		$this->template->set('show_flexslider','no');
		$this->template->set('profile_attachments',$profile_attachments);
		$this->template->set('page_js',array(''));
		$this->template->set('page_css',array(''));
		$this->template->render();
	} 

	function save_croped_images(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user_id = $this->authentication->get_loggedin_userid();
			$image_id = $_POST['image_id'];
			$targ_w = 660;
			$targ_h = 400;
			$jpeg_quality = 90;
			
			$image_details = $this->Attachment->get_attachment_details($image_id);
		
			$src = './assets/profiles/'.$user_id."/".$image_details->image_name;
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			
			imagejpeg($dst_r, 'assets/profiles/'.$user_id."/".$image_details->image_name, $jpeg_quality);
			imagedestroy($dst_r);
			//header('Content-type: image/jpeg');
			//imagejpeg($dst_r,null,$jpeg_quality);
			$this->Attachment->set_as_croped($image_id);
			redirect('profile/crop','refresh');
		}
	}
	
	function edit_image($image_id=NULL){
		if($image_id!=NULL){
			$user_id = $this->authentication->get_loggedin_userid();
			$this->Attachment->set_as_croped_all($user_id);
			$this->Attachment->unset_as_croped($image_id);
			redirect('profile/crop','refresh');
		}
	}
	
}
?>