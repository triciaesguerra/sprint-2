<?php

class View_folder extends CI_Controller{

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
    	$this->load->model('folder_model');

    	

		if($this->session->flashdata('error')!='')
			$data['error'] = $this->session->flashdata('error');

		if($this->session->flashdata('success')!='')
			$data['success'] = $this->session->flashdata('success');

		$folder_id = $this->uri->segment(3);
		$folder= $this->folder_model->get_folder_by_id($folder_id);

		if(!$folder){
			redirect('welcome');
		}else{
			$folder = $folder->row();
		}
		$folder_name = $folder->folder_id . ' '. $folder->folder_name;
		$folders = $this->folder_model->get_folders($folder_id);

		if($folders){

			$folders = $folders->result();

			$data['folders'] = '<table><thead><tr><th>Folder Id</th>
			<th>Folder Name</th><th>Actions</th></tr></thead><tbody>';
			foreach ($folders as $folder){

				$data['folders'] = $data['folders'] . '<tr>';
		
				$data['folders'] = $data['folders'] . '<td>' . $folder->folderid . '</td>';
				$data['folders'] = $data['folders'] . '<td>' . $folder->fname . '</td>';
				$data['folders'] = $data['folders'] . '<td>' . '<a href="'.base_url().'view_folder/main/'.$folder->folderid.'">View</a>' . '</td>';
				$data['folders'] = $data['folders'] . '</tr>';

			}

			$data['folders'] = $data['folders'] . '</tbody></table>';

		}


		$data['folder_name'] = $folder_name;
		$data['folder_id'] = $folder->folder_id;
		$data['main_content'] = 'folder_view';
		$this->load->view('includes/template',$data);
    }

    function subfolder_create(){
    	$this->form_validation->set_rules('fname','Folder name', 'trim|required|max_length[20]|callback_alpha_dash_space|xss_clean');

    	if($this->form_validation->run() != FALSE){

			$this->load->model('folder_model');
			$this->folder_model->create_subfolder();

			$this->session->set_flashdata('success','Successfully created a folder.');
			redirect('view_folder/main/'.$this->input->post('folder_id'));


		}else{

			$error = validation_errors();
			$this->session->set_flashdata('error',$error);
			redirect('view_folder/main/'.$this->input->post('folder_id'));

		}
    }

}