<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{

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
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 1, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();

        $content = $this->Content_model->getContent();

        $data['contentData'] = $content;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/content/index';
        $data['active'] = 'home';
        $data['sub'] = 'content';
        $data['action'] = site_url('system-content/Content/content_edit');

        $this->load->view('back-end/common/template', $data);
    }

    public function social()
    {
        $data['profile'] = $this->profile->getProfile();
        $data['fb'] = $this->V_model->get_content('FB');
        $data['Flickr'] = $this->V_model->get_content('Flickr');
        $data['Google'] = $this->V_model->get_content('Google');
        $data['Linked'] = $this->V_model->get_content('Linked');
        $data['Scribe'] = $this->V_model->get_content('Scribe');
        $data['Twitter']    = $this->V_model->get_content('Twitter');
        $data['Youtube']    = $this->V_model->get_content('Youtube');
        $data['Academia']   = $this->V_model->get_content('Academia');
        $data['Instagram']  = $this->V_model->get_content('Instagram');
        $data['title']      = '  Dashboard - Profile';
        $data['content']    = 'back-end/content/content/social';
        $data['active']     = 'home';
        $data['sub']        = 'social';
        $data['action'] = site_url('system-content/Content/social_edit');

        $this->load->view('back-end/common/template', $data);
    }

    function social_edit()
    {
        $this->V_model->updatecat('FB', $this->input->post('faceook'));
        $this->V_model->updatecat('Flickr', $this->input->post('Flickr'));
        $this->V_model->updatecat('Google', $this->input->post('Google'));
        $this->V_model->updatecat('Linked', $this->input->post('Linked'));
        $this->V_model->updatecat('Scribe', $this->input->post('Scribe'));
        $this->V_model->updatecat('Twitter', $this->input->post('twitter'));
        $this->V_model->updatecat('Youtube', $this->input->post('Youtube'));
        $this->V_model->updatecat('Academia', $this->input->post('Academia'));
        $this->V_model->updatecat('Instagram', $this->input->post('instagram'));


        $this->HistoryModel->insertHistory("SM", "SM", "Home Page Social Media Content has been Edited");

        $this->session->set_flashdata('success-message', 'Your Social Media Content has been updated.');

        redirect('system-content/Content/social');
    }

    public function content_edit()
    {
        $this->form_validation->set_rules('home_title', 'home_title', 'required');
        $this->form_validation->set_rules('sort_order', 'sort_order', 'required');
        $this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'required');
        $this->form_validation->set_rules('meta_discriptions', 'meta_discriptions', 'required');
        $this->form_validation->set_rules('page_title', 'page_title', 'required');
        $this->form_validation->set_rules('sort_title', 'sort_title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

            $query = $this->Content_model->updateContent();
            $this->HistoryModel->insertHistory($this->input->post('home_title'), $this->input->post('home_title'), "Home Page Content and Page Title Content has been Edited   ");

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Your Home Page Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Content');
        }
    }

    public function header()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 2, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $content = $this->Content_model->getContent();
        $data['profile'] = $this->profile->getProfile();
        $data['contentData'] = $content;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/content/logo';
        $data['active'] = 'home';
        $data['sub'] = 'header';
        $data['action'] = site_url('system-content/Content/header_edit');

        $this->load->view('back-end/common/template', $data);
    }

    function header_edit()
    {
        $this->form_validation->set_rules('slogan', 'slogan', 'trim|required');

        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setImage();
        }

        if ($validate == FALSE) {
            $this->header();
        } else {
            $query = $this->Content_model->updateLogo($img);

            $this->HistoryModel->insertHistory($img, $img, "Home Page Content and Page Title Logo and Slogan has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Header has been update.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Content/header');
        }
    }

    public function footer()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 3, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['fb'] = $this->V_model->get_content('FB');
        $data['Flickr'] = $this->V_model->get_content('Flickr');
        $data['Google'] = $this->V_model->get_content('Google');
        $data['Linked'] = $this->V_model->get_content('Linked');
        $data['Scribe'] = $this->V_model->get_content('Scribe');
        $data['Twitter'] = $this->V_model->get_content('Twitter');
        $data['Youtube'] = $this->V_model->get_content('Youtube');
        $data['Academia'] = $this->V_model->get_content('Academia');
        $data['Instagram'] = $this->V_model->get_content('Instagram');
        $data['M'] = $this->V_model->get_content('M');

        $content = $this->Content_model->getContent();

        $data['profile'] = $this->profile->getProfile();
        $data['contentData'] = $content;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/content/footer';
        $data['active'] = 'home';
        $data['sub'] = 'footer';
        $data['action'] = site_url('system-content/Content/footer_edit');

        $this->load->view('back-end/common/template', $data);
    }


    function footer_edit()
    {
        $this->form_validation->set_rules('footer_copyrights', 'footer_copyrights', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->footer();
        } else {
            $this->V_model->updatecat('FB', $this->input->post('faceook'));
            $this->V_model->updatecat('M', $this->input->post('m'));
            $this->V_model->updatecat('Flickr', $this->input->post('Flickr'));
            $this->V_model->updatecat('Google', $this->input->post('Google'));
            $this->V_model->updatecat('Linked', $this->input->post('Linked'));
            $this->V_model->updatecat('Scribe', $this->input->post('Scribe'));
            $this->V_model->updatecat('Twitter', $this->input->post('twitter'));
            $this->V_model->updatecat('Youtube', $this->input->post('Youtube'));
            $this->V_model->updatecat('Academia', $this->input->post('Academia'));
            $this->V_model->updatecat('Instagram', $this->input->post('instagram'));
            $this->HistoryModel->insertHistory("SM", "SM", "Home Page Social Media Content has been Edited   ");
            $this->session->set_flashdata('success-message', 'Your Social Media Content has been updated.');

            $query = $this->Content_model->updateFooter();

            $this->HistoryModel->insertHistory($this->input->post('footer_copyrights'), $this->input->post('footer_copyrights'), "Footer Content and Copyrights Content has been Edited   ");
            
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Footer has been update.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Content/footer');
        }
    }

    public function banner()
    {
        $content = $this->Content_model->getBanners();

        $data['profile'] = $this->profile->getProfile();
        $data['areaList'] = $content;
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/content/banner';
        $data['active'] = 'home';
        $data['sub'] = 'banner';
        $data['action'] = site_url('system-content/Content/createBanner');

        $this->load->view('back-end/common/template', $data);
    }

    public function createBanner()
    {
        $this->form_validation->set_rules('caption', 'caption', 'trim|required');
        $this->form_validation->set_rules('banner_url', 'banner_url', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->banner();
        } else {
            $img = $this->setBanner();
            $query = $this->Content_model->insertBannner($img);
            $this->HistoryModel->insertHistory($this->input->post('caption'), $this->input->post('caption'), "New Banner has been Created : " . $this->input->post('caption'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Banner ' . $this->input->post('caption') . ' has been created.');
                redirect('system-content/Content/banner');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Content/banner');
            }
        }
    }

    function editBanner($id)
    {
        $content = $this->Content_model->getBanners();

        $data['areaList'] = $content;

        $banner_row = $this->Content_model->get_Banners($id);

        $data['banner_row'] = $banner_row;
        $data['profile'] = $this->profile->getProfile();
        $data['title'] = '  Dashboard - Profile';
        $data['content'] = 'back-end/content/content/banner';
        $data['active'] = 'home';
        $data['sub'] = 'banner';
        $data['action'] = site_url('system-content/Content/bannerEdit');

        $this->load->view('back-end/common/template', $data);
    }

    function bannerEdit()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('caption', 'caption', 'trim|required');
        $this->form_validation->set_rules('banner_url', 'banner_url', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');

        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setBanner();
        }

        if ($validate == FALSE) {
            $this->editBanner($id);
        } else {
            $query = $this->Content_model->updateBanner($img);
            $this->HistoryModel->insertHistory($img, $img, "Home Page Banner has been Edited");

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Banner has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Content/banner');
        }
    }

    public function setImage()
    {
        //upload and update the file
        $config['upload_path'] = './v6/assets/';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        //$config['max_size'] = '20000'; // in KB
        // $config['max_width'] = '145';
        // $config['max_height'] = '45';
        //$config['min_width'] = '32';
        //$config['min_height'] = '32';
        $config['file_name'] = 'logo' . uniqid();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('photo')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    public function setBanner()
    {
        //upload and update the file
        $config['upload_path'] = './resources/images/uploads/banners';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        //$config['max_size'] = '20000'; // in KB
        // $config['max_width'] = '145';
        // $config['max_height'] = '45';
        //$config['min_width'] = '32';
        //$config['min_height'] = '32';
        $config['file_name'] = 'logo' . uniqid();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('photo')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }
}