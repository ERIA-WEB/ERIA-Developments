<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('privilage');
        $this->load->model('admin/Page_model', '', TRUE);
	}
	 		
			 
	public function index()
	{
		$data_s = $this->session->userdata('logged_in');
		$pri = $this->privilage->login($data_s['username'],$data_s['user_id'],'dashboard',$data_s['group_id']);

        // if($pri!=TRUE)
        // {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

		$data['areaList'] = $this->Page_model->getPage_dash_allarticle('news');
		$data['mareaList'] = $this->Page_model->getPage_dash_allarticle('multimedia');
		$data['profile'] = $this->profile->getProfile();
		$data['title'] = '  Dashboard';
		$data['content'] = 'back-end/content/dashboard';
		$data['active'] = 'dashboard';
		$data['sub'] = 'dashboard';	

		$this->load->view('back-end/common/template', $data);
	}
}