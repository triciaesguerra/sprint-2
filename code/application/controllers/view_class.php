<?php

class View_class extends CI_Controller{

	function clear_cache(){
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache"); 
	}

	function index(){
		$this->clear_cache();
	}
	
	function alpha_dash_space($str){
    	$this->form_validation->set_message('alpha_dash_space' ,'The folder name is invalid.');
        return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
    } 


	function main(){

		$this->clear_cache();
		$this->load->model('class_model');

		if($this->session->flashdata('error')!='')
			$data['error'] = $this->session->flashdata('error');

		if($this->session->flashdata('success')!='')
			$data['success'] = $this->session->flashdata('success');

		$class_id = $this->uri->segment(3);
		$class= $this->class_model->get_class_by_id($class_id);

		if(!$class){
			redirect('welcome');
		}else{
			$class = $class->row();
		}
		$class_name = $class->course_id . ' '. $class->section;

		$this->load->model('class_model');
		$folders = $this->class_model->get_folders($class_id);
		if($folders){

			$folders = $folders->result();

			$data['folders'] = '<table><thead><tr><th>Folder Id</th>
			<th>Folder Name</th><th>Actions</th><th>Privacy</th></tr></thead><tbody>';
			foreach ($folders as $folder){

				$data['folders'] = $data['folders'] . '<tr>';
		
				$data['folders'] = $data['folders'] . '<td>' . $folder->folder_id . '</td>';
				$data['folders'] = $data['folders'] . '<td>' . $folder->folder_name . '</td>';
				$data['folders'] = $data['folders'] . '<td>' . '<a href="'.base_url().'view_folder/main/'.$folder->folder_id.'">View</a>' . '</td>';
				//$data['folders'] = $data['folders'] . '<td>' . $folder->folder_id . '</td>';
				$data['folders'] = $data['folders'] . '</tr>';

			}

			$data['folders'] = $data['folders'] . '</tbody></table>';

		}


		$data['class_name'] = $class_name;
		$data['class_id'] = $class->class_id;
		$data['main_content'] = 'class_main_view';
		$this->load->view('includes/template',$data);



	}

	function create_folder(){

		$this->form_validation->set_rules('class_id' , 'Class id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('folder_name','Folder name', 'trim|required|max_length[20]|callback_alpha_dash_space|xss_clean');

		if($this->form_validation->run() != FALSE){

			$this->load->model('class_model');
			$this->class_model->create_folder();

			$this->session->set_flashdata('success','Successfully created a folder.');
			redirect('view_class/main/'.$this->input->post('class_id'));


		}else{

			$error = validation_errors();
			$this->session->set_flashdata('error',$error);
			redirect('view_class/main/'.$this->input->post('class_id'));

		}
	}

	function enlist(){
		$this->form_validation->set_rules('class_id' , 'Class id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('student_num','Student Number', 'trim|required|max_length[9]|callback_alpha_dash_space|xss_clean');
		$this->load->model('class_model');

		if($this->form_validation->run() != FALSE){
			$q = $this->class_model->enlist_one();
			if($q){
				$this->session->set_flashdata('success','Successfully enlisted.');
				redirect('view_class/main/'.$this->input->post('class_id'));
			}
			else{
				$this->session->set_flashdata('success','Error.');
				redirect('view_class/main/'.$this->input->post('class_id'));
			}
		}
		else{
			$error = validation_errors();
			$this->session->set_flashdata('error',$error);
			redirect('view_class/main/'.$this->input->post('class_id'));
		}
	}

}