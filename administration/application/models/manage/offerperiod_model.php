<?php

class Offerperiod_model extends CI_Model 
{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all(){
		$query = $this->db->get('offerperiods');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	


	function new_offerperiod($data){
		$this->db->set('period_name',$data['period_name']);
		$this->db->insert('offerperiods');	
	}


	function delete_offerperiod($id=NULL){
		if ($id!=NULL) {
			$this->db->where('period_id',$id);
			$this->db->delete('offerperiods');
		}
	}


 	function get($id=NULL){
		 	if($id!=NULL){
		 	$this->db->select('*');
			$this->db->from('offerperiods');
			$this->db->where('period_id',$id);
			$query = $this->db->get();
				if($query->num_rows()>0)
				{

					$result=$query->result();
					return $result[0];
				}else
				return NULL;
		   }	  
		}


	
	function edit_offerperiod($data,$period_id=NULL){
		if($period_id!=NULL){
			$this->db->set('period_id',$period_id);
			$this->db->set('period_name',$data['period_name']);
			$this->db->where('period_id',$period_id);
			$this->db->UPDATE('offerperiods');		
		}
	}


	function delete_offer_periods($offer_id=NULL){
		
		if($offer_id!=NULL){
			$this->db->where('offer_id',$offer_id);
			$this->db->delete('offers_periods');
		}
	}

	
	function update_offer_periods($data,$offer_id=NULL){
		if($offer_id!=NULL){
			$periods=$data['offer_periods'];
			$this->delete_offer_periods($offer_id);
			if(!empty($periods)){
				foreach($periods as $key=>$value){
					$this->db->set('period_id',$value);
					$this->db->set('offer_id',$offer_id);
					$this->db->insert('offers_periods');
				}
			}	
		}
	}
	

	
	function get_offer_periods($offer_id=NULL,$arr=FALSE){
		if($offer_id!=NULL){
			$this->db->select('*');
			$this->db->from('offers_periods');
			$this->db->join('offerperiods','offers_periods.period_id=offerperiods.period_id','left');
			$this->db->where('offers_periods.offer_id',$offer_id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				if($arr){
					$periods = array();
					foreach ($query->result_array() as $row){
 				  		array_push($periods,$row['period_id']);
					}
					return $periods;
				}
				else
					return $query->result();
			}
			else{
				return NULL;
			}	
		}
	}
}

?>