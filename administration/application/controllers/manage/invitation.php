<?php
class Invitation extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->load->model(array('manage/invitationmodel'));			
			$this->load->library(array('myvalidation','myemaillibrary'));
			$this->load->helper('recaptcha');
			
			$this->userauthentication->check_sessionexpire();
       }
	   
	
	
	function index()
	{
		if($this->input->post('submit'))
		{
			$all_email_list = $this->input->post('email_address');
			$all_code = $this->input->post('invitation_code');
			for($i=0;$i<sizeof($all_email_list);$i++)
			{
				$this->send_code($all_email_list[$i],$all_code[$i]);
			}

		}

		$email_send_success = $this->phpsession->get('email_send_success');
		if($email_send_success=="yes")
		{
			$this->template->assign('email_send_success',$email_send_success);
			$this->template->assign('success_message',$this->lang->line('send_invitation_success'));
			$this->phpsession->clear('email_send_success');
		}
			
		$delete_item = $this->phpsession->get('delete_item');
		if($delete_item=="yes")
		{
			$this->template->assign('email_send_success', $delete_item);
			$this->template->assign('success_message',$this->lang->line('delete_item_success'));
			$this->phpsession->clear('delete_item');
		}

		$list_of_invitation = $this->invitationmodel->get_allinvitation_email();
		$this->template->assign('list_of_invitation',$list_of_invitation);

		$this->template->display('manage/invitation/index.tpl');
	}


	function send_code($email,$invitation_code)
	{
		//echo $email."---->".$invitation_code."<br>";
		$is_valid_email = $this->myvalidation->validEmail($email);
		if($is_valid_email)
		{
			$have_account = $this->userauthentication->is_exist_email($email);
			if($have_account)
			{
				echo $this->lang->line('email_already_registered');
			}
			else
			{
				if($invitation_code!=NULL)
				{
					$this->invitationmodel->save_code($email,$invitation_code); //activate this line
					
					$this->myemaillibrary->set_email_category('invitation_code');
					$replace['url']=$this->config->item('mainsite_url').'user/signup/'.$invitation_code;
					$replace['icode'] = $invitation_code;
					
					$this->invitationmodel->change_sendemail_status($email,$invitation_code); //activate this line
					//$email='ashish021@gmail.com'; //remove this line
					$this->myemaillibrary->send_email($email,$replace);
					$this->phpsession->save('email_send_success','yes');
				}
				else
					echo $this->lang->line('already_sent_invitation_code');		
			}
		}
		else
		{
			echo $this->lang->line('invalid_email');
		}
	}

	function send_invitation($id=NULL)
	{
		if($id!=NULL)
		{
			$details = $this->invitationmodel->get_details($id);
			if($details!=NULL)
			{
				$this->send_code($details[0]->email_address,$details[0]->invitation_code);
				redirect('manage/invitation','refresh');
			}

		}
	}

	function delete($id=NULL)
	{
		if($id!=NULL)
		{
			$this->invitationmodel->delete_item($id);
			$this->phpsession->save('delete_item','yes');
			redirect('manage/invitation','refresh');
		}
	}


}
?>