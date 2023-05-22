<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/HistoryModel');
        $this->load->library('privilage');
        $this->load->model('admin/Slider_model', '', TRUE);
    }

    function listSlider()
    {
        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 4, $data_s['group_id']);


        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();
        $content = $this->Slider_model->getSlider();
        $settinng = $this->Slider_model->getSetting(1);
        $data['setting'] = $settinng->data;
        $data['areaList'] = $content;
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/slider/list';
        $data['active'] = 'home';
        $data['sactive'] = 'slider';
        $data['sub'] = 'list';

        $this->load->view('back-end/common/template', $data);
    }

    public function index()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 4, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['action'] = site_url('system-content/Slider/createSlider');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/slider/slider';
        $data['active'] = 'home';
        $data['sactive'] = 'slider';
        $data['sub'] = 'add';

        $this->load->view('back-end/common/template', $data);
    }

    public function createSlider()
    {
        $this->form_validation->set_rules('banner_url', 'banner_url', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $this->form_validation->set_rules('heading', 'heading', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->index();
        } else {
            $img = $this->setSlider();
            $query = $this->Slider_model->insertSlider($img);

            $this->HistoryModel->insertHistory("Slider", "Slider", "New Slider has been Created : " . $this->input->post('content'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Slider has been created.');
                redirect('system-content/slider/listSlider');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/slider/listSlider');
            }
        }
    }

    function editSlider($id)
    {
        $data['profile'] = $this->profile->getProfile();

        $slider_row = $this->Slider_model->get_Slider($id);
        $data['slider_row'] = $slider_row;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/slider/slider';

        $data['active'] = 'home';
        $data['sactive'] = 'slider';
        $data['sub'] = 'add';

        $data['action'] = site_url('system-content/slider/sliderEdit');
        $this->load->view('back-end/common/template', $data);
    }

    function sliderEdit()
    {

        $id = $this->input->post('id');

        $this->form_validation->set_rules('banner_url', 'banner_url', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        $this->form_validation->set_rules('heading', 'heading', 'trim|required');

        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setSlider();
        }

        if ($validate == FALSE) {
            $this->editSlider($id);
        } else {
            $query = $this->Slider_model->updateSlider($img);

            $this->HistoryModel->insertHistory($img, $img, "Home Page Slider has been Edited");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Slider has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/slider/listSlider');
        }
    }

    public function setSlider() // $msg
    {
        //upload and update the file
        $config['upload_path'] = './uploads/slides';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        //$config['max_size'] = '20000'; // in KB
        // $config['max_width'] = '145';
        // $config['max_height'] = '45';
        //$config['min_width'] = '32';
        //$config['min_height'] = '32';
        //$config['file_name'] = 'logo' . uniqid();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';
        
        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");

            $msg = "The upload directory does not exist.";
            $imgName = $msg;
        } elseif (!$this->upload->do_upload('photo')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = $msg;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    function delete()
    {
        $id = $this->input->post('id');
        $query = $this->Slider_model->deleteing($id);
        return $query;
    }

    function publish()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Slider_model->publish($id, $pub);

        return $query;
    }

    function settings()
    {
        $id = $this->input->post('id');
        $query = $this->Slider_model->settings($id);
        return $query;
    }
}