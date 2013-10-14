<?php

class Classes extends CI_Controller{

	function clear_cache(){
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache"); 
	}

	function index(){
		$this->clear_cache();
		$data['main_content'] = 'class_view';
		if($this->session->flashdata('flashSuccess')!='')
			$data['message'] =  $this->session->flashdata('flashSuccess');

		$this->load->model('classes_model');

		$courses = $this->classes_model->get_name();
		$courselist = array('' => 'Please select a course.');
		foreach ($courses->result_array() as $course) {
			$courselist[$course['course_id']] = $course['course_id'].' - '.$course['course_title'];
		}
		$data['courselist'] = $courselist;

		$classes = $this->classes_model->get_classes();
		if($classes){

			$classes = $classes->result();

			$data['classes'] = '<table><thead><tr><th>Class Id</th>
			<th>Course Id</th><th>Section</th><th>Actions</th></tr></thead><tbody>';
			foreach ($classes as $class){

				$data['classes'] = $data['classes'] . '<tr>';
				$data['classes'] = $data['classes'] . '<td>' . $class->class_id . '</td>';
				$data['classes'] = $data['classes'] . '<td>' . $class->course_id . '</td>';
				$data['classes'] = $data['classes'] . '<td>' . $class->section . '</td>';
				$data['classes'] = $data['classes'] . '<td>' . '<a href="view_class/main/'.$class->class_id.'">View</a>' . '</td>';
				$data['classes'] = $data['classes'] . '</tr>';

			}

			$data['classes'] = $data['classes'] . '</tbody></table>';

		}

		$enroll = $this->classes_model->get_enroll();
		if($enroll){
			$enroll = $enroll->result();
			

			$data['enroll'] = '<table><thead><tr><th>Class Id</th>
			<th>Course Id</th><th>Section</th><th>Actions</th></tr></thead><tbody>';
			foreach ($enroll as $enrol){

				$data['enroll'] = $data['enroll'] . '<tr>';
				$data['enroll'] = $data['enroll'] . '<td>' . $enrol->class_id . '</td>';
				$data['enroll'] = $data['enroll'] . '<td>' . $enrol->course_id . '</td>';
				$data['enroll'] = $data['enroll'] . '<td>' . $enrol->section . '</td>';
				$data['enroll'] = $data['enroll'] . '<td>' . '<a href="view_class/main/'.$enrol->class_id.'">View</a>' . '</td>';
				$data['enroll'] = $data['enroll'] . '</tr>';

			}

			$data['enroll'] = $data['enroll'] . '</tbody></table>';
		}

		$this->load->view('includes/template', $data);
	
	}
	

	function create_class(){
		$this->clear_cache();
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('section', 'Section', 'trim|required');
		//$this->form_validation->set_rules('prof_id', 'Instructor\'s ID', 'trim|required');
		

		if($this->form_validation->run() == FALSE){
			$this->classes();
		}
		else{
			$this->load->model('classes_model');
			if($query = $this->classes_model->create_class()){


				$this->session->set_flashdata('flashSuccess', 'Successfully created a class');
				redirect(site_url('classes'));
			}
			else{
				$this->load->view('class_view');
			}
		}
	}

	
}