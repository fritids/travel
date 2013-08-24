<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Myemaillibrary{
    
	public $from = "From: Travelly <support@travelly.com>\r\n";
	public $email_cat;
	
	function Myemaillibrary(){
    	$this->obj =& get_instance();
    	$this->obj->load->model('user_model','User');
		$this->obj->load->model('emailtemplate_model','EmailTemplate');
    }
	
	function index(){}
	
	function set_email_category($type=NULL){
		switch($type){
			case 'user_signup':	$this->email_cat='1'; break;
			case 'user_forgot_password':	$this->email_cat='2'; break;
			case 'invitation_code': $this->email_cat = '3'; break;
			case 'comment_post_notification':  $this->email_cat = '4'; break;
			case 'like_post_notification':  $this->email_cat = '5'; break;
			case 'user_follow_notification':  $this->email_cat = '6'; break;
			case 'change_email_notification':  $this->email_cat = '7'; break;
			case 'user_mention': $this->email_cat = '8'; break;
			case 'request_hotel_information': $this->email_cat = '9'; break;
			case 'booking_request': $this->email_cat = '10'; break;
			default:
		}
	}
	
	function send_email($toemail,$replace=NULL){
		$emailbody=$this->obj->EmailTemplate->get_email_template($this->email_cat);
		
		if($emailbody!=NULL){
			$to = $toemail;
	  		$subject = $emailbody[0]->email_subject;
     		$message = $emailbody[0]->email_body;
			if($replace!=NULL){
			foreach($replace as $key=>$value){
				$subject=str_replace('{$'.$key.'}',$replace[$key],$subject);
				$message=str_replace('{$'.$key.'}',$replace[$key],$message);
				}
			}
			
			$this->from .= "MIME-Version: 1.0\r\n";
			$this->from .= "Content-type: text/html; charset=utf-8\r\n";
			$this->from .="Content-Transfer-Encoding: 8bit";
	      	
			if(mail($to, $subject, $message, $this->from))
				$mail='send';
		}
		return true;
	}
}
?>