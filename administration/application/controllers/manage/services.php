<?php
class Services extends CI_Controller {

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation','form_validation'));
			$this->load->model('manage/service_model','Service');
			
			$this->userauthentication->check_sessionexpire();
       }
	   
	
	
	function index(){
		$all_services = $this->Service->get_all();
		$this->template->assign('servicelist',$all_services);
		$this->template->display('manage/service/index.tpl');
	}
	
	
	function add_service($msg1=NULL){
		
		$all_services = $this->Service->get_all();
		$all_services['msg']=$msg1;
		$this->template->assign('servicelist',$all_services);
		$this->template->display('manage/service/add_services.tpl');
		
	}



		function edit_service(){
			$id=$this->uri->segment(4);
   		if((int)$id > 0){
     	$query = $this->Service->get($id);
     	$this->template->assign('data',$query);
 				}
		$all_services = $this->Service->get_all();
		$this->template->assign('servicelist',$all_services);
		$this->template->display('manage/service/edit_services.tpl');  

 			}


	function insert_services(){

		$data=array("facility_name"=>$this->input->post('facility_name'));
		$this->form_validation->set_rules('facility_name', 'facility_name', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE)
                {
                	$msg="Problem!! Submit again";
    	            $this->add_service($msg);
                }
                else{

					$this->Service->new_service($data);
					$this->index();  
			   }
			}


	public function delete_services(){
				$id=$this->uri->segment(4);
				$this->Service->delete_services($id);
				$this->index();
			}


	function update_services(){
			$data=array(
			"facility_id"=>$this->input->post('facility_id'),
			"facility_name"=>$this->input->post('facility_name')
			  );
			$facility_id= $data['facility_id'];
			$this->Service->edit_service($data,$facility_id);
			$this->index();
					}



}
?>