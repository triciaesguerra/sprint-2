<?php
class Membership_model extends CI_Model{

	function validate(){

		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('membership');

		if($query->num_rows == 1){
			$row = $query->row();
			$data = array(
				'id' => $row->id,
				'username' => $row->username,
				'usertype' => $row->usertype,
				'is_logged_in' => true
				);
			$this->session->set_userdata($data);

			return true;
		}

	}

	function create_member(){
		$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email_address'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'student_num' => $this->input->post('student_num'),
				'usertype' => $this->input->post('usertype')
			);

		$insert = $this->db->insert('membership', $new_member_insert_data);

		return $insert;
	}
}