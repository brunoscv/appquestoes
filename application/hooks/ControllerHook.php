<?php
class ControllerHook
{

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function preController(){

	}

	public function postController(){
		$this->loadView();
	}

	private function loadView(){
		if( $this->ci->output->get_output() != "" ){
			return;
		}
		
		if(strtolower(get_active_class()) == "rest"){
			return;
		}
		
		$fileModule = strtolower(get_active_class()) . _DS_ . get_active_method() . '.php';
		if( file_exists(FCPATH . APPPATH .'views'. _DS_ . MODULE._DS_.$fileModule) ){
			if(IS_AJAX)
			{
				if( file_exists(FCPATH . APPPATH .'views'. _DS_ . MODULE . _DS_ . strtolower(get_active_class()) . _DS_ . 'ajax' . _DS_ . get_active_method() . '.php') )
					$fileModule = strtolower(get_active_class()) . _DS_ . 'ajax' . _DS_ . get_active_method() . '.php';
				$this->ci->load->view(MODULE._DS_.$fileModule, $this->ci->data);
			}
			else
			{
				$this->ci->load->view(HEADER_TEMPLATE, $this->ci->data);
				$this->ci->load->view(MODULE._DS_.$fileModule, $this->ci->data);
				$this->ci->load->view(FOOTER_TEMPLATE, $this->ci->data);
			}
		}
	}
}