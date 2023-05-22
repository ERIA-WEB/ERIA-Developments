<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {
 
	  function __construct()
	{
		parent::__construct();

		$this->load->model('admin/Content_model', '', TRUE);
        $this->load->model('admin/HistoryModel');
        $this->load->model('admin/V_model');
        $this->load->library('privilage');
	}

	public function index()
	{
        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],49,$data_s['group_id']);

        // if($pri!=TRUE)
        // {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['google_analytic_tag'] = $this->V_model->get_content('google_analytic_tag');
        $data['google_map_api'] = $this->V_model->get_content('google_map_api');
        $data['email'] = $this->V_model->get_content('email');
        $data['map_lat_long'] = $this->V_model->get_content('map_lat_long');
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/config/index';
        $data['active'] = 'config';
        $data['sub'] = 'indexc';
        $data['action']=site_url('system-content/Configuration/content_edit');

        $this->load->view('back-end/common/template', $data);
	}

    public function vdata()
    {
        $data['profile'] = $this->profile->getProfile();
        $data['fb'] = $this->V_model->get_content('FB');
        $data['Flickr'] = $this->V_model->get_content('Flickr');
        $data['Google'] = $this->V_model->get_content('Google');
        $data['Linked'] = $this->V_model->get_content('Linked');
        $data['Scribe'] = $this->V_model->get_content('Scribe');
        $data['Twitter'] = $this->V_model->get_content('Twitter');
        $data['Youtube'] = $this->V_model->get_content('Youtube');
        $data['Academia'] = $this->V_model->get_content('Academia');
        $data['Instagram'] = $this->V_model->get_content('Instagram');
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/config/vdata';
        $data['active'] = 'config';
        $data['sub'] = 'vdata';
        $data['action']=site_url('system-content/Content/social_edit');

        $this->load->view('back-end/common/template', $data);
    }

    function social_edit()
    {
        $this->V_model->updatecat('FB',$this->input->post('faceook'));
        $this->V_model->updatecat('Flickr',$this->input->post('Flickr'));
        $this->V_model->updatecat('Google',$this->input->post('Google'));
        $this->V_model->updatecat('Linked',$this->input->post('Linked'));
        $this->V_model->updatecat('Scribe',$this->input->post('Scribe'));
        $this->V_model->updatecat('Twitter',$this->input->post('twitter'));
        $this->V_model->updatecat('Youtube',$this->input->post('Youtube'));
        $this->V_model->updatecat('Academia',$this->input->post('Academia'));
        $this->V_model->updatecat('Instagram',$this->input->post('instagram'));
        $this->HistoryModel->insertHistory("SM","SM","Home Page Social Media Content has been Edited   ");
        $this->session->set_flashdata('success-message', 'Your Social Media Content has been updated.');

        redirect('system-content/Content/social');
    }

    public function content_edit()
	{
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $query = $this->Content_model->updateContent();
            $this->HistoryModel->insertHistory($this->input->post('home_title'),$this->input->post('home_title'),"Home Page Content and Page Title Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Your Home Page Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }    
            redirect('system-content/Content');
        }
	}
	


	








}
