<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publications extends CI_Controller
{
	 public function __construct()
	{
        parent::__construct();
        $this->load->model('admin/HistoryModel');
		$this->load->library('privilage');
        $this->load->model('admin/Page_model', '', TRUE);
	}

    public function index()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],34,$data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }
        
        $data['profile'] = $this->profile->getProfile();
        $slider_row= $this->Page_model->getPage_content(6);

        $data['slider_row']=$slider_row;
        $data['action'] = site_url('system-content/Publications/editPublic');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/publications/index';
        $data['active'] = 'research';
        $data['sub'] = 'content';

        $this->load->view('back-end/common/template', $data);
    }

    function editPublic()
    {

        $id=$this->input->post('id');

        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        $this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'meta_description', 'trim|required');

        if($this->input->post('published'))
        {
            $published=1;
        }
        else
        {
            $published=0;
        }

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->index();
        }
        else {

            $data_s=$this->session->userdata('logged_in');
            $newBranch = array(
                'menu_title' => $this->input->post('menu_title'),
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            $query = $this->Page_model->updatePage($id,$newBranch);

            $this->HistoryModel->insertHistory($id,$id,"Publication Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Publications');
        }
    }
}
