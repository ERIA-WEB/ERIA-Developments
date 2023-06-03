<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
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
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 43, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }
        $data['relatedData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);

        $data['peoples'] = $this->Page_model->getAllPeoples(); 
        $data['peopleData'] = array();
        $data['expert'] = $this->Page_model->getPage_allarticle('experts', 200);
        $data['catData'] = array();
        $data['areaList'] = $this->Page_model->getPage_catogeries('eventcategories');
        $data['action'] = site_url('system-content/Events/create');
        $data['action_event_detail'] = site_url('system-content/Events/event_details');
        $data['action_event_agenda'] = site_url('system-content/Events/event_agenda');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/article';
        $data['active'] = 'events';
        $data['sub'] = 'event';

        $this->load->view('back-end/common/template', $data);
    }

    function create()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required|is_unique[articles.title]');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->index();
        } else {
            $img = $this->setEvent();

            $img2 = $this->setEvent2();

            if (!empty($img2) or !empty($img)) {
                $img2 = "/uploads/events/" . $img2;
                $img = "/uploads/events/" . $img;
            } else {
                $img2 = '';
                $img = '';
            }

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name'            => $img,
                'title'                 => $this->input->post('title'),
                'uri'                   => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $this->input->post('title'))),
                'posted_date'           => date('Y-m-d'),
                'start_date'            => $this->input->post('start_date'),
                'end_date'              => $this->input->post('end_date'),
                'tags'                  => $this->input->post('tags'),
                'article_type'          => 'events',
                'video_url'             => $this->input->post('video_url'),
                'pub_type'              => 3,
                'article_keywords'      => $this->input->post('article_keywords'),
                'content'               => $this->input->post('content'),
                'major'                 => $this->input->post('major'),
                'venue'                 => $this->input->post('venue'),
                'organizer'             => $this->input->post('organizer'),
                'presentations'         => $this->input->post('presentations'),
                'old_url'               => $this->input->post('link_event_summary'), // 'old_url'               => $this->input->post('RSVP'),
                'published'             => $published,
                'image_name_2'          => $img2,
                'modified_by'           => $users['user_id'],
                'modified_date'         => date('Y-m-d H:i:s'),
            );

            $category = $this->input->post('catogery');
            $related = $this->input->post('related');
            $query = $this->Page_model->insertArticle($data, $category, null, $related, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Event has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Event has been created.');
                redirect('system-content/Events/listevent');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/listevent');
            }
        }
    }

    public function content()
    {

        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 41, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
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
        // $this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'trim|required');
        // $this->form_validation->set_rules('meta_description', 'meta_description', 'trim|required');

        if ($this->input->post('published')) {
            $published = 1;
        } else {
            $published = 0;
        }

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->content();
        } else {
            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'menu_title' => $this->input->post('menu_title'),
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'modified_by' => $users['user_id'],
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

    function categories()
    {

        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 42, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('eventcategories');

        $data['action'] = site_url('system-content/Events/createCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/catogery';
        $data['active'] = 'events';
        $data['sub'] = 'cat';

        $this->load->view('back-end/common/template', $data);
    }

    function listevent()
    {
        $data['profile'] = $this->profile->getProfile();
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 44, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_allarticle('events', 200);
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/newslist';
        $data['active'] = 'events';
        $data['sub'] = 'eventl';

        $this->load->view('back-end/common/template', $data);
    }

    function duplication_pages()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 39, $users['group_id']);

        $input = $this->input->post();
        if ($input['current_page'] == 'publications') {
            $current_page = 'Research/listpublication';
        } elseif ($input['current_page'] == 'articles') {
            $current_page = 'Programmes/a_list';
        } elseif ($input['current_page'] == 'news') {
            $current_page = 'News/listnews';
        } elseif ($input['current_page'] == 'events') {
            $current_page = 'Events/listevent';
        } else {
            $current_page = 'News/listmnews';
        }

        // Parsing Insert Data to helper library
        $result = $this->privilage->insertDuplicatePage($input, $users);
        
        $this->HistoryModel->insertHistory("Duplicate", "Duplicate", "New Duplicate has been Created : " . $input['article_id']);

        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Duplicate has been created.');
            redirect('system-content/'.$current_page);
        } else {
            $this->session->set_flashdata('error-message', $result);
            redirect('system-content/'.$current_page);
        }
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

            $users = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'eventcategories',
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );

            $query = $this->Page_model->insertCat($data);
            $this->HistoryModel->insertHistory("Catogery", "Catogery", "New Catogery has been Created : " . $this->input->post('category_name'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Catogery has been created.');
                redirect('system-content/events/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/events/categories');
            }
        }
    }

    function editcat($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

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

            $users = $this->session->userdata('logged_in');
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->updatecat($id, $data);
            $this->HistoryModel->insertHistory($id, $id, "New Events Catogery has been Updated : " . $this->input->post('category_name'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Events Catogery has been updated.');
                redirect('system-content/events/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/events/categories');
            }
        }
    }

    function cropImageThumbnails()
    {
        if(isset($_POST["image"])) {
            $data = $_POST["image"];
            
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            
            $data = base64_decode($image_array_2[1]);
            
            // $imageName = $this->setCropImage();
            $imageName =  time() . '.jpg';
            file_put_contents('uploads/crop-image/' .$imageName, $data);

            echo base_url() . 'uploads/crop-image/' .$imageName;
        }
    }

    function setCropImage()
    {
        $config['upload_path'] = './uploads/crop-images';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['max_size'] = '5000000'; // in KB
        $config['file_name'] = 'crop-image-' . uniqid();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('image')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    function editA($id)
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);
        $data['profile'] = $this->profile->getProfile();
        
        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'news';
        //     $data['sub'] = 'news';
        // } 
        
        $article_type = ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified'];
        $data['peoples'] = $this->Page_model->getAllPeoples(); 
        $people_related = $this->Page_model->getPeopleRelatedAgendaId($id);
        if (!empty($people_related)) {
            foreach($people_related as $value)
            {
                $peopleData[] = $value->people_id;
            }
        } else {
            $peopleData = array();
        }
        $data['peopleData'] = $peopleData;
        $data['expert'] = $this->Page_model->getPage_allarticle('experts', 200);
        $data['areaList'] = $this->Page_model->getPage_catogeries('eventcategories');
        $data['area_List'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        
        $data['relatedData'] = $this->Page_model->get_articleRelated($id);
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['catData'] = $this->Page_model->get_articleCatogery($id);
        $data['topData'] = $this->Page_model->get_articleTopic($id);
        $data['action'] = site_url('system-content/Events/editEve');
        $data['action_event_detail'] = site_url('system-content/Events/event_agenda_details');
        $data['action_event_agenda'] = site_url('system-content/Events/event_agenda');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/article';
        $data['active'] = 'events';
        $data['sub'] = 'event';
        $data['agenda_list'] = $this->Page_model->getAgendaListByArticleId($id);
        $data['agenda_detail'] = $this->Page_model->getAgendaDetailByArticleId($id);

        $this->load->view('back-end/common/template', $data);
    }

    function editEve()
    {
        $input = $this->input->post();
        
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();
        $img = -1;
        $imgs = -1;
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setEvent();
        }

        if ($validate == TRUE && (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))) {
            $imgs = $this->setEvent2();
        }

        if ($validate == FALSE) {
            $this->editA($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');
            $users = $this->session->userdata('logged_in');
            $data = array(
                'title'             => $this->input->post('title'),
                'posted_date'       => date('Y-m-d'),
                'start_date'        => $this->input->post('start_date'),
                'video_url'         => $this->input->post('video_url'),
                'end_date'          => $this->input->post('end_date'),
                'tags'              => $this->input->post('tags'),
                'article_type'      => 'events',
                'pub_type'          => 3,
                'article_keywords'  => $this->input->post('article_keywords'),
                'content'           => $this->input->post('content'),
                'major'             => $this->input->post('major'),
                'venue'             => $this->input->post('venue'),
                'organizer'         => $this->input->post('organizer'),
                'presentations'     => implode(', ', $this->input->post('presentations')),
                'old_url'           => $this->input->post('link_event_summary'), //this field before 'old_url'           => $this->input->post('RSVP'),
                'published'         => $published,
            );
            
            if ($img !== -1) {
                $img = "/uploads/events/" . $img;
                $data['image_name'] = $img;
            }

            if ($imgs !== -1) {
                $img = "/uploads/events/" . $imgs;
                $data['image_name2'] = $imgs;
            }

            $category = $this->input->post('catogery');
            $related = $this->input->post('related');
            $query = $this->Page_model->updateArticle($id, $data, $category, null, $related, null, null, null, null, null, null, null, null);
            $this->HistoryModel->insertHistory($id, $id, "Events has been Updated : " . $this->input->post('title'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Event has been updated.');
                redirect('system-content/Events/editA/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/listevent');
            }
        }
    }

    function event_agenda()
    {
        $input = $this->input->post();
        
        $id = $input['id'];

        foreach($input['title_event_agenda'] as $key => $value)
        {    
            $data[] = [
                'event_id'  => $id,
                'title'     => $value,
                'content'   => $input['content'][$key],
                'created'   => date('Y-m-d H:i:s'),
                'updated'   => date('Y-m-d H:i:s'),
            ];
        }
        
        $result = $this->Page_model->create_agenda_event($id, $data);

        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Event has been updated.');
            redirect('system-content/Events/editA/' . $id);
        } else {
            $this->session->set_flashdata('error-message', $query);
            redirect('system-content/Events/listevent');
        }
        
    }

    function event_agenda_details()
    {
        $input = $this->input->post();

        $id = $input['id'];
        $data = [
            'event_id'  => $id,
            'title'     => $input['title_event_detail'],
            'type'      => $input['time_event_detail'],
            'date'      => $input['date_event_detail'],
            'time_from' => $input['time_from_event_detail'],
            'time_to'   => $input['time_to_event_detail'],
            'zone_time' => $input['zone_time_event_detail'],
            'emmbed_rsvp'               => $input['embed_rsvp_event_detail'],
            'emmbed_google_calendar'    => $input['embed_google_calendar_event_detail'],
            'emmbed_outlook_calendar'   => $input['embed_outlook_calendar_event_detail'],
            'created'                   => date('Y-m-d H:i:s'),
            'updated'                   => date('Y-m-d H:i:s'),
        ];

        $result = $this->Page_model->create_agenda_detail($id, $data);
        
        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Event has been updated.');
            redirect('system-content/Events/editA/' . $id);
        } else {
            $this->session->set_flashdata('error-message', $query);
            redirect('system-content/Events/listevent');
        }
    }

    public function setEvent()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/events';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['max_size'] = '5000000'; // in KB
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

    public function setEvent2()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/events';
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
        } elseif (!$this->upload->do_upload('photo_')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    function publish()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publish($id, $pub);
        return $query;
    }

    function publishR()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishR($id, $pub);
        return $query;
    }

    function  deleteCategory()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleteCategory($id);
        return $query;
    }

    function deleter()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleter($id);
        return $query;
    }
}