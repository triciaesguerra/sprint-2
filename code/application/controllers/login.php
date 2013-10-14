<?php

class Login extends CI_Controller{

	function clear_cache(){
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache"); 
	}

	function index(){
		$this->clear_cache();
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);

	}

	function validate_credentials(){
		$this->clear_cache();
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();

		if($query){
			/*
			$data = array(
					'username' => $this->input->post('username'),
					'is_logged_in' => true
				);

			$this->session->set_userdata($data);
			*/
			redirect('site/members_area');		
		}
		else{
			$this->index();
		}
	}

	function signup(){
		$this->clear_cache();
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}

	function create_member(){
		$this->clear_cache();
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('student_num', 'Student Number', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|unique[membership.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_lenght[4]');
		$this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|matches[password]');


		if($this->form_validation->run() == FALSE){
			$this->signup();
		}
		else{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member()){
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else{
				$this->load->view('signup_form');
			}
		}
	}

	

	 function logout() {
	 	$this->clear_cache();
   		$this->session->sess_destroy();
   		redirect('login', 'refresh');

 	}



}