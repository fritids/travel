<?php
class Themes extends CI_Controller {

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation','form_validation'));			
			$this->load->model('manage/theme_model','Theme');			
			$this->userauthentication->check_sessionexpire();
    }
	
	function index(){
		$all_themes = $this->Theme->get_all();
		$this->template->assign('themelist',$all_themes);
		$this->template->display('manage/theme/index.tpl');
	}

	function add_theme($msg1=NULL){
		
		$all_themes = $this->Theme->get_all();
		$all_themes['msg']=$msg1;
		$this->template->assign('themelist',$all_themes);
		$this->template->display('manage/theme/add_theme.tpl');
		
	}


	function insert_themes(){

		$data=array("theme_name"=>$this->input->post('theme_name'));
		$this->form_validation->set_rules('theme_name', 'theme_name', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE)
                {
                	$msg="Problem!! Submit again";
    	            $this->add_theme($msg);
                }
                else{
				$this->Theme->new_theme($data);
				$this->index();  
			}
			}

	function delete_themes(){
		$id=$this->uri->segment(4);
		//echo $id;
		$this->Theme->delete_themes($id);
		$this->index();
		}


	function edit_themes(){
			$id=$this->uri->segment(4);
   		if((int)$id > 0){
     	$query = $this->Theme->get($id);
     	$this->template->assign('data',$query);
 				}
		$all_themes = $this->Theme->get_all();
		$this->template->assign('themelist',$all_themes);
		$this->template->display('manage/theme/edit_theme.tpl');  

 			}

 	function update_themes(){
			$data=array(
			"lastminutetheme_id"=>$this->input->post('lastminutetheme_id'),
			"theme_name"=>$this->input->post('theme_name')
			  );
			$theme_id= $data['lastminutetheme_id'];
			$this->Theme->edit_theme($data,$theme_id);
			$this->index();
					}		


}
?>