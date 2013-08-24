<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('smarty/libs/Smarty.class.php');

class Template extends Smarty
{
	function Template()
	{
		$this->Smarty();
		$this->obj =& get_instance();
		
		$this->assign('baseurl',$this->obj->config->item('base_url'));
		$this->assign('mainsite_url',$this->obj->config->item('mainsite_url'));
		$this->template_language_variable();
		
		$this->template_dir = $_SERVER['DOCUMENT_ROOT']."/administration/application/views";
		$this->config_dir = $_SERVER['DOCUMENT_ROOT']."/administration/application/views/conf";
		$this->compile_dir = $_SERVER['DOCUMENT_ROOT']."/administration/application/cache/";
	}
	
	function template_language_variable()
	{
		foreach($this->obj->lang->language as $key=>$value)
			$this->assign($key,$value);
	}

}
?>