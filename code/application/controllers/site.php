<?php

class Site extends CI_Controller{

	function clear_cache(){
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache"); 
	}
	
	function __construct(){

		parent:: __construct();
		$this->is_logged_in();
	}

	function members_area(){
		$this->clear_cache();
		$data['main_content'] = 'members_area';
		$this->load->view('includes/template', $data);
		
		
	}

	function is_logged_in(){
		$this->clear_cache();
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in !== true){
			echo 'You don\'t have permission to access this page, <a href="../login">Login</a>';
			die();
		}
	}


}