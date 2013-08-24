<?php
class Offers extends CI_Controller{

	public function __construct(){
            parent::__construct();
            // Your own constructor code
			$this->load->library(array('myvalidation'));
			$this->load->model('manage/offer_model','Offer');
			$this->userauthentication->check_sessionexpire();
	}
	   
	
	function index(){
		$all_offers = $this->Offer->get_all_offers();
		$this->template->assign('Offerlist',$all_offers);
		$this->template->display('manage/offer/index.tpl');
	}
	
	function delete($offer_id=NULL){
		if($offer_id!=NULL){
			$this->Offer->delete_offer($offer_id);
			redirect('index.php/manage/offers','refresh');
		}
	}

	function add_offer(){

		echo "add offer";
	}


}
?>