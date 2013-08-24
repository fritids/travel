<?php
class Periods extends CI_Controller{

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation','form_validation'));
			$this->load->model('manage/offerperiod_model','Period');
			$this->userauthentication->check_sessionexpire();
	}
	   
	
	function index(){
		$all_periods = $this->Period->get_all();
		$this->template->assign('periodlist',$all_periods);
		$this->template->display('manage/period/index.tpl');
	}

	function add_offerperiod($msg1=NULL){
		
		$all_periods = $this->Period->get_all();
		$all_services['msg']=$msg1;
		$this->template->assign('periodlist',$all_periods);
		$this->template->display('manage/period/add_period.tpl');
		}


	function insert_offerperiod(){

		$data=array("period_name"=>$this->input->post('period_name'));
		$this->form_validation->set_rules('period_name', 'period_name', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE){
            $msg="Problem!! Submit again";
    	    $this->add_offerperiod($msg);
                }
        else{
			$this->Period->new_offerperiod($data);
			$this->index();  
			   }
			}


	function delete_offerperiod(){

			$id=$this->uri->segment(4);
			$this->Period->delete_offerperiod($id);
			$this->index();
			}


	function edit_offerperiod(){

			$id=$this->uri->segment(4);
			 if($id>0){
			 	$query=$this->Period->get($id);
			 	$this->template->assign('data',$query);
			 		}
			$all_periods = $this->Period->get_all();
		    $this->template->assign('periodlist',$all_periods);
			$this->template->display('manage/period/edit_period.tpl');
				}

	function update_offerperiod(){
			$data=array(
			"period_id"=>$this->input->post('period_id'),
			"period_name"=>$this->input->post('period_name')
			  );
			$period_id= $data['period_id'];
			//echo $period_id;
			$this->Period->edit_offerperiod($data,$period_id);
			$this->index();
					}


}
?>