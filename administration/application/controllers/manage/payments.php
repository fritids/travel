<?php
class Payments extends CI_Controller {

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation','fileuploader'));
			$this->load->helper('recaptcha');			
			$this->load->model('manage/usermodel');
			$this->load->model('manage/payment_model');
			
			$this->userauthentication->check_sessionexpire();
	}
	
	function index(){
		$list_of_payments = $this->payment_model->get_all();
		$this->template->assign('list_of_payments',$list_of_payments);
		$this->template->display('manage/payments/index.tpl');
	}
	
	
	function invoice($invoice_number=NULL){
		if($this->input->post('upload')){
			$form_field_name="bills_file";
			$user_id = $this->input->post('user_id');
			$pk_invoice = $this->input->post('pk_invoice');
			if($_FILES[$form_field_name]['name']!=NULL){
				$this->fileuploader->upload_bills($form_field_name,$user_id);
				$filename = $this->fileuploader->filedata['file_name'];
				$this->usermodel->save_invoice_attachment($filename,$user_id,$pk_invoice);
				$this->usermodel->update_users_account_permission($user_id);
				//redirect('index.php/manage/payments','refresh');
			}
		}
		$invoice_details = $this->payment_model->get_invoice_details($invoice_number);
		$this->template->assign('invoice_details',$invoice_details);
		
		$all_hotels = $this->usermodel->get_allhotel_profiles($invoice_details->user_id);
		$this->template->assign('all_hotels',$all_hotels);
		$this->template->display('manage/payments/upload_invoice.tpl');
	}
}
?>