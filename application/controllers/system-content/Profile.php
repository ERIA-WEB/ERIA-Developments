<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
 
	  function __construct()
	{
		parent::__construct();
		 
		$this->load->model('admin/Profile_model', '', TRUE);
        $this->load->model('admin/HistoryModel');
	}
	
	public function index()
	{
        $profile = $this->Profile_model->getProfile();
        $data['profile'] = $profile;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/personal/profile';
        $data['active'] = 'dashboard';
        $data['sub'] = 'dashboard';
        $data['action']=site_url('system-content/Profile/profile_edit');

        $this->load->view('back-end/common/template', $data);	
	}

	public function profile_edit()
	{
	
        $this->form_validation->set_rules('o_password', 'o_password', 'required|callback_isSame');	
        $this->form_validation->set_rules('n_password', 'n_password', 'trim|required|min_length[5]');	
        $this->form_validation->set_rules('c_password', 'c_password', 'trim|required|matches[n_password]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $query = $this->Profile_model->updatePassword();
            $this->HistoryModel->insertHistory($this->input->post('o_password'),$this->input->post('n_password'),"Profile has been Edited   ");

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Your Password has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Profile');
        }
	}
	
	function isSame($o_password) {
        $available = $this->Profile_model->isSame($o_password);
        $this->form_validation->set_message('isSame', 'Wrong Password.');
        return $available;
    }
	
	function profile()
	{
		if (!empty($_FILES['picture']['name'])) {
            //Include database configuration file
        
            
            //File uplaod configuration
            $result = 0;
            $uploadDir = "resources/images/profile/";
            $fileName = time().'_'.basename($_FILES['picture']['name']);
            $targetPath = $uploadDir. $fileName;
            
            //Upload file to server
            if(@move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)){
                
                
            $update = $this->Profile_model->profile_pic($fileName);

                $this->HistoryModel->insertHistory("Profile Image Changed","Profile Image Changed","Profile Image has been Edited   ");

                //Update status
                if($update){
                    $result = 1;
                }
            }
            
            //Load JavaScript function to show the upload status
            echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>  ';
        }	
	}
}
