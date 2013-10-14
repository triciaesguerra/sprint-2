<?php

class Class_model extends CI_Model{

	function get_class_by_id($class_id){

		$this->db->where('class_id' , $class_id);
		$query = $this->db->get('class');

		if($query->num_rows()>0){
			return $query;
		}else{
			return false;
		}


	}

	function create_folder(){

		$data = array('class_id' => $this->input->post('class_id'),
			'folder_name' => $this->input->post('folder_name'));

		$this->db->insert('classfolders',$data);

	}

	function get_folders($class_id){

		$this->db->where('class_id', $class_id);
		$query = $this->db->get('classfolders');

		if($query->num_rows()>0){
			return $query;
		}else{
			return false;
		}
	}

	function enlist_one(){

		$student_num = $this->input->post('student_num');
		$this->db->where('student_num', $student_num);
		$id = $this->db->get('membership');

		if($id->num_rows()>0){
			$idf = $id->row();
			$fid = $idf->id;
		
			$data = array('class_id' => $this->input->post('class_id'),
				'id' => $fid);
			$this->db->insert('enroll', $data);
			return true;
		}
		else{
			return false;
		}


	}
}