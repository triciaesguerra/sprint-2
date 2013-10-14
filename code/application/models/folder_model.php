<?php

class Folder_model extends CI_Model{

	function get_folder_by_id($folder_id){
		$this->db->where('folder_id' , $folder_id);
		$query = $this->db->get('classfolders');

		if($query->num_rows()>0){
			return $query;
		}else{
			return false;
		}
	}

	function get_class_by_id($class_id){

		$this->db->where('class_id' , $class_id);
		$query = $this->db->get('class');

		if($query->num_rows()>0){
			return $query;
		}else{
			return false;
		}


	}

	function create_subfolder(){

		$data = array('folder_id' => $this->input->post('folder_id'),
			'fname' => $this->input->post('fname'));

		$this->db->insert('folder',$data);

	}

	function get_folders($folder_id){

		$this->db->where('folder_id', $folder_id);
		$query = $this->db->get('folder');

		if($query->num_rows()>0){
			return $query;
		}else{
			return false;
		}
	}
}