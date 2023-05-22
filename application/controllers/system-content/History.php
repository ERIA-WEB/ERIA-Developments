<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
 
 	 function __construct() {
        parent::__construct();
        
		$this->load->model('admin/HistoryModel');
		$this->load->model('admin/UserModel');
		$this->load->model('admin/Profile_model');
		$this->load->library('privilage');
    }
	
	public function index($users=0,$date=null)
	{
		$data_s=$this->session->userdata('logged_in');
        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],48,$data_s['group_id']);

        // if($pri!=TRUE)
        // {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }
	   	$users = $this->input->post('user');
	   	$date = $this->input->post('date');
		
		$data['profile'] = $this->Profile_model->getProfile();
		
		$user = $this->UserModel->getAll_user();
		$query = $this->HistoryModel->getAllhis($users, $date);
		$data['title'] = '  Dashboard - History';
		$data['content'] = 'back-end/content/history/listHistory';
		$data['active'] = 'admin';
		$data['sub'] = 'history';
		$data['activity']=$query;
		$data['user']=$user;
			
		$this->load->view('back-end/common/template', $data);
	}
}