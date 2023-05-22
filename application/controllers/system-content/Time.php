<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Time extends CI_Controller {
	 public function __construct()
	{
		parent::__construct();

        $this->load->model('admin/HistoryModel');
		$this->load->library('privilage');
        $this->load->model('admin/Page_model', '', TRUE);
	}

    function index()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],14,$data_s['group_id']);

        // if($pri!=TRUE)
        // {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['action'] = site_url('system-content/Time/createTime');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/time/list';
        $data['active'] = 'about';
        $data['sactive'] = 'time';
        $data['sub'] = 'addtime';

        $this->load->view('back-end/common/template', $data);
    }

    function createTime()
    {
        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->index();
        } else {

            if($this->input->post('published')) {
                $published=1;
            } else {
                $published=0;
            }

            $data_s=$this->session->userdata('logged_in');
            $data = array(
                'title' => $this->input->post('menu_title'),
                'year' => $this->input->post('year'),
                'content' => $this->input->post('content'),
                'link' => $this->input->post('link'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->insertTime($data);

            $this->HistoryModel->insertHistory("Timeline","Timeline","New Timeline has been Created : ".$this->input->post('menu_title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Timeline has been created.');
                redirect('system-content/Time/add');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Time/add');
            }
        }
    }

    function edit($id)
    {
        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],'dashboard',$data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if($pri!=TRUE)
        // {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // }
        
        $data['slider_row'] = $this->Page_model->getPage_time($id);
        $data['action'] = site_url('system-content/Time/editData');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/time/list';
        $data['active'] = 'about';
        $data['sactive'] = 'time';
        $data['sub'] = 'addtime';

        $this->load->view('back-end/common/template', $data);
    }

    function editData()
    {
        $id=$this->input->post('id');

        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->edit($id);
        } else {
            if($this->input->post('published')) {
                $published=1;
            } else {
                $published=0;
            }

            $data_s=$this->session->userdata('logged_in');

            $data = array(
                'title' => $this->input->post('menu_title'),
                'year' => $this->input->post('year'),
                'content' => $this->input->post('content'),
                'link' => $this->input->post('link'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->updateTime($id,$data);

            $this->HistoryModel->insertHistory($id,$id,"New Timeline has been Updated : ".$this->input->post('menu_title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Timeline has been updated.');
                redirect('system-content/Time/add');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Time/add');
            }
        }
    }

    function add()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],14,$data_s['group_id']);

        // if($pri!=TRUE)
        // {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_timeLine();
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/time/timelist';
        $data['active'] = 'about';
        $data['sactive'] = 'time';
        $data['sub'] = 'timel';

        $this->load->view('back-end/common/template', $data);
    }

    function delete() {
        $id = $this->input->post('id');
        $query = $this->Page_model->delete_time($id);

        return $query;
    }

    function publish()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publish_time($id,$pub);
        return $query;

    }
}
