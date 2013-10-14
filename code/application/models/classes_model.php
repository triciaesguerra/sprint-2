<?php

class Classes_model extends CI_Model{

	function create_class(){
		//$prof_id = $this->session->userdata('student_num');
		$new_class_insert_data = array(
			'course_id' => $this->input->post('course_id'),
			'section' => $this->input->post('section'),
			'prof_name' => $this->session->userdata('username')
		);

		$insert = $this->db->insert('class', $new_class_insert_data);
		return $insert;
	}

	function get_classes(){
		$username = $this->session->userdata('username');
		$this->db->where('prof_name', $username);
		$query = $this->db->get('class');

		if($query->num_rows()>0)
			return $query;

		else

			return false;

	}

	function get_enroll(){
		$id = $this->session->userdata('id');
		/*$this->db->where('id', $id);
		$q = $this->db->get('enroll');
		$this->db->join('class','$q.class_id = class.class_id');
		$query = $this->db->get();
		//$this->session->set_userdata('try', $query);*/

		$q = $this->db->query("SELECT *
						  FROM enroll e, class c
						  WHERE e.id = ? AND e.class_id = c.class_id", $id);
		$this->session->set_userdata('sess',$q->result_array());

		if($q->num_rows()>0)
			return $q;

		else
			return false;
	}

	function get_name(){
		
		$display = $this->db->get('courses');

		return $display;
	}

	function enlist(){
		
	}

}