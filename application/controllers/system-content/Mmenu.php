<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/HistoryModel');
        $this->load->library('privilage');
        $this->load->model('admin/Card_model', '', TRUE);
        $this->load->model('admin/Page_model', '', TRUE);
        $this->load->model('frontModel');
    }

    public function index()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 59, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $asean = $this->Page_model->getFeature('asean');
        $pub = $this->Page_model->getFeature('pub');
        $updates = $this->Page_model->getFeature('updates');
        $multimedia = $this->Page_model->getFeatureMultimedia('multimedia');
        
        $data['asean_t'] = $asean;
        $data['pub_t'] = $pub;
        $data['updates_t'] = $updates;
        $data['multimedia_t'] = $multimedia;
        $data['pub'] = $this->frontModel->get_article(null, 'publications', null, 'home');
        $data['update'] = $this->frontModel->get_article(null, 'news', null, 'home');
        $data['multi'] = $this->frontModel->getMultimediaContent('multimedia');
        $data['action'] = site_url('system-content/Mmenu/create');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/menu';
        $data['active'] = 'mmenu';
        $data['sub'] = 'fe';
        // $data['asean'] = $this->Card_model->get_menu_asean();

        $this->load->view('back-end/common/template', $data);
    }

    function create()
    {
        $input = $this->input->post();
        
        if (isset($input['asean'])) {
            $asean = $input['asean'];
        } else {
            $asean = '';
        }
        
        if (isset($input['pub'])) {
            $pub = $input['pub'];
        } else {
            $pub = '';
        }
        
        if (isset($input['updates'])) {
            $updates = $input['updates'];
        } else {
            $updates = '';
        }
        
        if (isset($input['multimedia'])) {
            $multimedia = $input['multimedia'];
        } else {
            $multimedia = '';
        }
        
        $query = $this->Page_model->updateFeature($asean, $pub, $updates, $multimedia);

        $this->HistoryModel->insertHistory("Feature Menu", "Feature Menu", "Feature Menu has been Created ");

        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Feature Menu has been changed.');
            redirect('system-content/Mmenu');
        } else {
            $this->session->set_flashdata('error-message', $query);
            redirect('system-content/Mmenu');
        }
    }

    public function recent()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 5, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }   

        $asean = $this->Page_model->getFeature('asean');
        $pub = $this->Page_model->getFeature('pub');
        $updates = $this->Page_model->getFeature('updates');
        $multimedia = $this->Page_model->getFeature('multimedia');

        $data['asean_t'] = $asean;
        $data['asean'] = $this->Card_model->get_All_recent();
        $data['rs'] = $this->Card_model->get_Allassigned_recent();
        $data['action'] = site_url('system-content/Mmenu/createRecent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/recent';
        $data['active'] = 'home';
        $data['sub'] = 'rupd';

        $this->load->view('back-end/common/template', $data);
    }

    function createRecent()
    {
        $asean = $this->input->post('asean');
        $sort = $this->input->post('sort');
        $query = $this->Page_model->inserRecent($asean, $sort);

        $this->HistoryModel->insertHistory("Home page Recent", "Recent Update has been Created", "Recent Update has been Created ");

        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Recent Update has been Created.');
            redirect('system-content/Mmenu/recent');
        } else {
            $this->session->set_flashdata('error-message', $query);
            redirect('system-content/Mmenu/recent');
        }
    }

    public function content()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard');

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // } 
        
        $slider_row = $this->Page_model->getPage_content(5);
        $data['slider_row'] = $slider_row;
        $data['action'] = site_url('system-content/Events/editContent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/index';
        $data['active'] = 'events';
        $data['sub'] = 'evcontent';

        $this->load->view('back-end/common/template', $data);
    }

    function editContent()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        $this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'meta_description', 'trim|required');

        if ($this->input->post('published')) {
            $published = 1;
        } else {
            $published = 0;
        }

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->content();
        } else {
            $data_s = $this->session->userdata('logged_in');
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

            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "Events Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Events Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Events/content');
        }
    }

    function catogeries()
    {
        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard');

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'content';
        // } 
        
        $data['areaList'] = $this->Page_model->getPage_catogeries('eventcategories');
        $data['action'] = site_url('system-content/Events/createCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/catogery';
        $data['active'] = 'events';
        $data['sub'] = 'cat';

        $this->load->view('back-end/common/template', $data);
    }

    function createCat()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->catogeries();
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'eventcategories',
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );

            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Catogery", "Catogery", "New Catogery has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Catogery has been created.');
                redirect('system-content/Events/catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/catogeries');
            }
        }
    }

    function editcat($id)
    {

        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard');

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('categories');
        $data['action'] = site_url('system-content/Events/editCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/catogery';
        $data['active'] = 'events';
        $data['sub'] = 'cat';

        $this->load->view('back-end/common/template', $data);
    }

    function editCatdata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->editcat($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "New Events Catogery has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Events Catogery has been updated.');
                redirect('system-content/Events/catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/catogeries');
            }
        }
    }

    public function setEvent()
    {
        //upload and update the file
        $config['upload_path'] = './resources/images/uploads/events';
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

    function deleteR()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->delete_R($id);
        $this->HistoryModel->insertHistory($name, $name, "  Home Recent article has been Deleted : " . $name);
        return $query;
    }
}