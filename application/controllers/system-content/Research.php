<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Research extends CI_Controller
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
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard');

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('eventcategories');
        $data['action'] = site_url('system-content/Events/create');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/article';
        $data['active'] = 'events';
        $data['sub'] = 'event';

        $this->load->view('back-end/common/template', $data);
    }

    function create()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->index();
        } else {
            $img = $this->setTopics();
            $img = "/uploads/events/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'title' => $this->input->post('title'),
                'posted_date' => $this->input->post('posted_date'),
                'end_date' => $this->input->post('end_date'),
                'tags' => $this->input->post('tags'),
                'article_type' => 'events',
                'pub_type' => 3,
                'article_keywords' => $this->input->post('article_keywords'),
                'content' => $this->input->post('content'),
                'major' => $this->input->post('major'),
                'venue' => $this->input->post('venue'),
                'organizer' => $this->input->post('organizer'),
                'published' => $published,
                'image_name' => $img,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $category = $this->input->post('catogery');
            $query = $this->Page_model->insertArticle($data, $category, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Associates has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Associates has been created.');
                redirect('system-content/Events/list');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/list');
            }
        }
    }

    public function content()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 35, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $slider_row = $this->Page_model->getPage_content(2);
        $data['slider_row'] = $slider_row;
        $data['action'] = site_url('system-content/Research/editContent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/index';
        $data['active'] = 'research';
        $data['sub'] = 'rcontent';

        $this->load->view('back-end/common/template', $data);
    }

    function editContent()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
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
            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'menu_title' => $this->input->post('menu_title'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "Research Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Research Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Research/content');
        }
    }

    function topic()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 36, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('topics');
        $data['action'] = site_url('system-content/research/createTop');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/topic';
        $data['active'] = 'research';
        $data['sub'] = 'topic';

        $this->load->view('back-end/common/template', $data);
    }

    function listpublication_Slider()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 36, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_pslider();
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/topic_slider';
        $data['active'] = 'research';
        $data['sub'] = 'listlpublication';

        $this->load->view('back-end/common/template', $data);
    }

    function createTop()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');

        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            // $this->catogeries();
        } else {
            $img = $this->setTopics();
            $img = "/uploads/topics/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'topics',
                'uri' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id' => $this->input->post('order_id'),
                'description' => $this->input->post('content'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'image_name'  => $img,
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Catogery", "Catogery", "New Topic has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Topic has been created.');
                redirect('system-content/Research/topic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/topic');
            }
        }
    }

    function edittop($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 36, $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // }
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('topics');
        $data['action'] = site_url('system-content/Research/edittopdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/topic';
        $data['active'] = 'research';
        $data['sub'] = 'topic';

        $this->load->view('back-end/common/template', $data);
    }

    function edittopdata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edittop($id);
        } else {
            if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
                $img = $this->setTopics();
                $img = "/uploads/topics/" . $img;
            } else {
                $img = $this->input->post('image');

                $title_image_article = str_replace(array(' ','/','@','(',')','%','%20', ':', ';', '#'), '-', strtolower($this->input->post('category_name')));

                if (is_dir('caching/uploads/'))
                {
                    mkdir('./caching/uploads/topics/', 0777, true);
                    $dir_exist = true; // dir exist
                } else {
                    $date_folder = '';
                    $dir_exist = false; // dir not exist
                }

                $image_cover_data = [
                    'base_image'    => $img,
                    'title_image'   => $title_image_article,
                    'type_page'     => '/uploads/topics',
                    'width'         => 1024,
                    'height'        => 431,
                ];
                
                $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);
            }
            
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name'        => $img,
                'category_name'     => $this->input->post('category_name'),
                'category_type'     => 'topics',
                'uri'               => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id'          => $this->input->post('order_id'),
                'description'       => $this->input->post('content'),
                'published'         => $published,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description')
            );
            
    
            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "Topic has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Topic has been updated.');
                redirect('system-content/Research/topic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/topic');
            }
        }
    }

    function stopic()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 37, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('subtopics');
        $data['action'] = site_url('system-content/Research/create_Top');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/stopic';
        $data['active'] = 'research';
        $data['sub'] = 'stopic';

        $this->load->view('back-end/common/template', $data);
    }

    function create_Top()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->stopic();
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'subtopics',
                'uri' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Catogery", "Sub Topc", "New Topic has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Sub Topic has been created.');
                redirect('system-content/Research/stopic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/stopic');
            }
        }
    }

    function edit_stop($id)
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 36, $users['group_id']);
        $data['profile'] = $this->profile->getProfile();
        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
            $data['areaList'] = $this->Page_model->getPage_catogeries('subtopics');
            $data['action'] = site_url('system-content/Research/edit_topdata');
            $data['title'] = '  Dashboard';
            $data['content'] = 'back-end/content/research/stopic';
            $data['active'] = 'research';
            $data['sub'] = 'stopic';

        $this->load->view('back-end/common/template', $data);
    }

    function edit_topdata()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edittop($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'uri' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "Sub Topic has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Sub Topic has been updated.');
                redirect('system-content/Research/stopic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/stopic');
            }
        }
    }

    function edittype($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', null);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['action'] = site_url('system-content/Research/edittypedata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/ptype';
        $data['active'] = 'research';
        $data['sub'] = 'ptype';

        $this->load->view('back-end/common/template', $data);
    }

    function edittypedata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');

        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setType();
        }

        if ($validate == FALSE) {
            $this->edittype($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }
            $users = $this->session->userdata('logged_in');
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'uri' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            if ($img !== -1) {
                $img = "/uploads/pubtypes/" . $img;
                $data['image_name'] = $img;
            }

            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "Type has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Type has been updated.');
                redirect('system-content/Research/ptype');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/ptype');
            }
        }
    }

    function ptype()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 38, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['action'] = site_url('system-content/research/createType');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/ptype';
        $data['active'] = 'research';
        $data['sub'] = 'ptype';

        $this->load->view('back-end/common/template', $data);
    }

    function createType()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            // $this->catogeries();
        } else {
            $img = $this->setType();
            $img = "/uploads/pubtypes/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'pubtypes',
                'uri' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'image_name'  => $img,
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );

            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Catogery", "Catogery", "New Type has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Type has been created.');
                redirect('system-content/Research/ptype');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/ptype');
            }
        }
    }

    function publication()
    {

        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 39, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['slider_row'] = array();
        $data['topData'] = array();
        $data['catData'] = array();
        $data['ahData'] = array();
        $data['aData'] = array();
        $data['ehData'] = array();
        $data['eData'] = array();
        $data['relatedData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedPublicationsData'] = array();
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['sub_experts'] = array();

        $d = $this->Page_model->getExpert_catogeries('multimedia');

        $data['topics'] = $this->Page_model->getPage_catogeries('topics');
        $data['pubtypes'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['areaListd'] = $d;
        $data['country'] = $this->Page_model->getPage_country();
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['author_'] = $this->Page_model->getPage_allsubArticle();
        $data['action'] = site_url('system-content/research/createP');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/publication';
        $data['active'] = 'research';
        $data['sub'] = 'publication';

        $this->load->view('back-end/common/template', $data);
    }

    function createP()
    {
        $input = $this->input->post();
        
        $pt = $this->input->post('pub_type');

        if (count($pt) == 1) {
            $ptp = $this->input->post('pub_type')[0];
        } else {
            $ptp = 3;
        }

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->publication();
        } else {
            
            $title_image_article = str_replace(array(' ','/','@','(',')','%','%20', ':', ';', '#'), '-', strtolower($this->input->post('title')));

            $date_folder = date('Ymd');
            if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
                
                $img_data = $this->setPublication($title_image_article);
                
                $img = "/uploads/publications/".$date_folder."/". $img_data;
                
            } else {
                if ($validate == TRUE && (file_exists($_FILES['thumbnail_image']['tmp_name']) || is_uploaded_file($_FILES['thumbnail_image']['tmp_name']))) {
            
                    $resizeImage = $this->setThumbnailPublication($title_image_article);
                    
                    $thumbnail_img = "/caching/uploads/publications/".$date_folder."/".$resizeImage;
                    
                } else {
                    if (file_exists(FCPATH . $this->input->post('image_old') == 1) AND !empty($this->input->post('image_old'))) {
                            
                            $image_cover_data = [
                                'base_image'    => $this->input->post('image_old'),
                                'title_image'   => $title_image_article,
                                'type_page'     => '/uploads/publications',
                                'width'         => 360,
                                'height'        => 235,
                            ];
                            
                            $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);

                    } elseif (file_exists(FCPATH. $img) == 1) {
                        $image_cover_data = [
                            'base_image'    => $img,
                            'title_image'   => $title_image_article,
                            'type_page'     => '/uploads/publications',
                            'width'         => 248,
                            'height'        => 349,
                        ];
                    
                        $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);
                    } else {
                        $thumbnail_img = $this->input->post('thumbnail_image_old');
                    }
                    
                }
            }

            if ($validate == TRUE && (file_exists($_FILES['thumbnail_image']['tmp_name']) || is_uploaded_file($_FILES['thumbnail_image']['tmp_name']))) {
                        
                $resizeImage = $this->setThumbnailPublication($title_image_article);
                
                $thumbnail_img = "/caching/uploads/publications/".$date_folder."/".$resizeImage;
                
            } else {
                if (file_exists(FCPATH . $this->input->post('image_old') == 1) AND !empty($this->input->post('image_old'))) {
                        
                        $image_cover_data = [
                            'base_image'    => $this->input->post('image_old'),
                            'title_image'   => $title_image_article,
                            'type_page'     => '/uploads/publications',
                            'width'         => 360,
                            'height'        => 235,
                        ];
                        
                        $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);

                } elseif (file_exists(FCPATH. $img) == 1) {
                    $image_cover_data = [
                        'base_image'    => $img,
                        'title_image'   => $title_image_article,
                        'type_page'     => '/uploads/publications',
                        'width'         => 248,
                        'height'        => 349,
                    ];
                
                    $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);
                } else {
                    $thumbnail_img = $this->input->post('thumbnail_image_old');
                }
                
            }
            
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if ($this->input->post('highlight')) {
                $highlight = 1;
            } else {
                $highlight = 0;
            }

            
            if (!empty($this->input->post('venue'))) {
                $tags = implode(', ', $this->input->post('venue'));
            } else {
                $tags = '';
            }
            
            $users = $this->session->userdata('logged_in');

            $uri = $this->privilage->clean_caracther(str_replace(' ', '-', strtolower($this->input->post('title'))));

            if (!empty($this->input->post('author'))) {
                $author_name = implode(', ', $this->input->post('author'));
            } else {
                $author_name = '';
            }

            if (!empty($this->input->post('editor'))) {
                $editor_name = implode(', ', $this->input->post('editor'));
            } else {
                $editor_name = '';
            }
            
            $data = array(
                'image_name'        => $img,
                'thumbnail_image'   => $thumbnail_img,
                'pub_type'          => $ptp,
                'title'             => $this->input->post('title'),
                'uri'               => $uri,
                'posted_date'       => $this->input->post('posted_date'),
                'author'            => $author_name,
                'article_type'      => 'publications',
                'content'           => $this->input->post('content'),
                'tags'              => $this->input->post('tags'),
                'editor'            => $editor_name,
                'published'         => $published,
                'start_date'        => $this->input->post('start_date'),
                'doc_no'            => $this->input->post('doc_no'),
                'period'            => $this->input->post('period'),
                'article_status'    =>  $this->input->post('article_status'),
                'venue'             => $tags,
                'highlight'         => $highlight,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description'),
            );

            $category = $this->input->post('catogery');
            $topic_s = $this->input->post('topics');
            $related = $this->input->post('related');
            $editor = $this->input->post('editor');
            $h_editor = $this->input->post('h_editor');
            $author = $this->input->post('author');
            $h_author = $this->input->post('h_author');
            $mcategory = $this->input->post('mcatogery');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->insertArticle($data, $category, $topic_s, $related, $editor, $h_editor, $author, $h_author, $mcategory, 'M', $related_publication, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Publicationn has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Publicationn has been created.');
                redirect('system-content/Research/listpublication');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/listpublication');
            }
        }
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
            $current_page = 'News/listmnews';
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

    function publication_slider()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 39, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['topData'] = array();
        $data['catData'] = array();
        $data['relatedData'] = array();
        $data['ahData'] = array();
        $data['aData'] = array();
        $data['ehData'] = array();
        $data['eData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('publications', 1000);
        
        $data['action'] = site_url('system-content/research/createPs');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/publication_slider';
        $data['active'] = 'research';
        $data['sub'] = 'addlpublication';

        $this->load->view('back-end/common/template', $data);
    }

    function editpubtop($id)
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 39, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['topData'] = array();
        $data['catData'] = array();
        $data['relatedData'] = array();
        $data['ahData'] = array();
        $data['aData'] = array();
        $data['ehData'] = array();
        $data['eData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['slider_row'] = $this->Page_model->getPage_content_id($id);
        $data['action'] = site_url('system-content/research/editPs');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/publication_slider';
        $data['active'] = 'research';
        $data['sub'] = 'addlpublication';

        $this->load->view('back-end/common/template', $data);
    }


    function editPs()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('n_title', 'n_title', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->editpubtop($id);
        } else {
            if ($this->input->post('home')) {
                $home = 1;
            } else {
                $home = 0;
            }

            if ($this->input->post('inside')) {
                $inside = 1;
            } else {
                $inside = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'pub_id' => $this->input->post('publication'),
                'n_content' => $this->input->post('n_content'),
                'n_title' => $this->input->post('n_title'),
                'home' => $home,
                'inside' => $inside,
            );

            $query = $this->Page_model->update_Pslider($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "  Publication has been Updated : " . $this->input->post('n_title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Publication Slider has been updated.');
                redirect('system-content/Research/listpublication_Slider');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/listpublication_Slider');
            }
        }
    }

    function editPub($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 39, $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // }

        $data['catData'] = $this->Page_model->get_articleCatogery($id);
        $data['topData'] = $this->Page_model->get_articleTopic($id);
        $data['sub_experts'] = $this->Page_model->get_articleMultimedia($id);

        $d = $this->Page_model->getExpert_catogeries('multimedia');
        $data['areaListd'] = $d;
        
        $data['country'] = $this->Page_model->getPage_country();
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['author_'] = $this->Page_model->getPage_allsubArticle();
        $data['ahData'] = $this->Page_model->getArticle_sub($id, 'Author', 'Highlite');
        $data['aData'] = $this->Page_model->getArticle_sub($id, 'Author', 'Inside');
        $data['ehData'] = $this->Page_model->getArticle_sub($id, 'Editor', 'Highlite');
        $data['eData'] = $this->Page_model->getArticle_sub($id, 'Editor', 'Inside');
        $data['relatedData'] = $this->Page_model->get_articleRelated($id);
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedPublicationsData'] = $this->Page_model->getRelatedArticleForPublication($id);
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', null);
        $data['topics'] = $this->Page_model->getPage_catogeries('topics');
        $data['pubtypes'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/Research/editPubdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/publication';
        $data['active'] = 'research';
        $data['sub'] = 'publication';
        // $data['editor_'] = $this->Page_model->getPage_subArticle('Editor');
        // $data['author_'] = $this->Page_model->getPage_subArticle('Author');
        // $data['relatedPublicationsData'] = $this->Page_model->getArticlePublicationRelated($id);

        $this->load->view('back-end/common/template', $data);
    }

    function editPubdata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();
        
        $title_image_article = str_replace(array(' ','/','@','(',')','%','%20', ':', ';', '#'), '-', strtolower($this->input->post('title')));

        $date_folder = date('Ymd');
       
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img_data = $this->setPublication($title_image_article);
                
            $img = "/uploads/publications/".$date_folder."/". $img_data;
            
        } else {
            $img = $this->input->post('image_old');
        }
    
        if ($validate == TRUE && (file_exists($_FILES['thumbnail_image']['tmp_name']) || is_uploaded_file($_FILES['thumbnail_image']['tmp_name']))) {
            
            $resizeImage = $this->setThumbnailPublication($title_image_article);
            
            $thumbnail_img = "/caching/uploads/publications/".$date_folder."/".$resizeImage;
            
        } else {
            if (file_exists(FCPATH . $this->input->post('image_old') == 1) AND !empty($this->input->post('image_old'))) {
                    
                    $image_cover_data = [
                        'base_image'    => $this->input->post('image_old'),
                        'title_image'   => $title_image_article,
                        'type_page'     => '/uploads/publications',
                        'width'         => 360,
                        'height'        => 235,
                    ];
                    
                    $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);

            } elseif (file_exists(FCPATH.$img) == 1) {
                $image_cover_data = [
                    'base_image'    => $img,
                    'title_image'   => $title_image_article,
                    'type_page'     => '/uploads/publications',
                    'width'         => 248,
                    'height'        => 349,
                ];
            
                $thumbnail_img = $this->Page_model->resizeImageCover($image_cover_data);
            } else {
                $thumbnail_img = $this->input->post('thumbnail_image_old');
            }
            
        }
        
        $pt = $this->input->post('pub_type');

        if (count($pt) == 1) {
            $ptp = $this->input->post('pub_type')[0];
        } else {
            $ptp = 3;
        }

        if ($validate == FALSE) {
            $this->editPub($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if ($this->input->post('highlight')) {
                $highlight = 1;
            } else {
                $highlight = 0;
            }

            if ($this->input->post('venue')) {
                $tags = implode(', ', $this->input->post('venue'));
            } else {
                $tags = '';
            }

            if ($this->input->post('editor')) {
                $ed = implode(', ', $this->input->post('editor'));
            } else {
                $ed = '';
            }

            if ($this->input->post('author')) {
                $na = implode(', ', $this->input->post('author'));
            } else {
                $na = '';
            }

            $users = $this->session->userdata('logged_in');

            $uri = $this->privilage->clean_caracther(str_replace(' ', '-', strtolower($this->input->post('title'))));
            
            $data = array(
                'image_name'        => $img,
                'thumbnail_image'   => $thumbnail_img,
                'pub_type'          => $ptp,
                'title'             => $this->input->post('title'),
                'uri'               => $uri,
                'posted_date'       => $this->input->post('posted_date'),
                'author'            => $na,
                'article_type'      => 'publications',
                'content'           => $this->input->post('content'),
                'tags'              => $this->input->post('tags'),
                'editor'            => $ed,
                'published'         => $published,
                'start_date'        => $this->input->post('start_date'),
                'doc_no'            => $this->input->post('doc_no'),
                'period'            => $this->input->post('period'),
                'article_status'    =>  $this->input->post('article_status'),
                'venue'             => $tags,
                'highlight'         => $highlight,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description'),
            );
            
            $category = $this->input->post('catogery');
            $topic_s = $this->input->post('topics');
            $related = $this->input->post('related');

            if (!empty($this->input->post('editor'))) {
                $getEditorID = $this->Page_model->getAuthorIDByName($this->input->post('editor'));
                
                if (!empty($getEditorID)) {
                    foreach ($getEditorID as $value) {
                        $editors_[] = $value->article_id;
                    }
                    $ecID = $editors_;
                } else {
                    $ecID = $this->input->post('editor');
                }
            } else {
                $ecID = array();
            }
            
            $editor = $ecID;

            if (!empty($this->input->post('h_editor'))) {
                $h_editor = $this->input->post('h_editor');
            } else {
                $h_editor = array();
            }
            
            if (!empty($this->input->post('author'))) {
                

                $getAuthorID = $this->Page_model->getAuthorIDByName($this->input->post('author'));

                if (!empty($getAuthorID)) {
                    foreach ($getAuthorID as $value) {
                        $authors_[] = $value->article_id;
                    }
                    $ecAuthorID = $authors_;
                } else {
                    $ecAuthorID = $this->input->post('author');
                }
            } else {
                
                $ecAuthorID = array();
            }
            
            $author = $ecAuthorID;

            if (!empty($this->input->post('h_author'))) {
                $h_author = $this->input->post('h_author');
            } else {
                $h_author = array();
            }
            
            $mcategory = $this->input->post('mcatogery');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->updateArticle($id, $data, $category, $topic_s, $related, $editor, $h_editor, $author, $h_author, $mcategory, 'M', $related_publication, null);

            $this->HistoryModel->insertHistory($id, $id, "  Publication has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Publication has been updated.');
                redirect('system-content/Research/editPub/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/listpublication');
            }
        }
    }

    function createPs()
    {
        $this->form_validation->set_rules('n_content', 'n_content', 'trim|required');
        $this->form_validation->set_rules('publication', 'publication', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->publication_slider();
        } else {
            // $img = $this->setPublication();
            if ($this->input->post('home')) {
                $home = 1;
            } else {
                $home = 0;
            }

            if ($this->input->post('inside')) {
                $inside = 1;
            } else {
                $inside = 0;
            }
            $users = $this->session->userdata('logged_in');

            $data = array(
                'pub_id' => $this->input->post('publication'),
                'n_content' => $this->input->post('n_content'),
                'n_title' => $this->input->post('n_title'),
                'home' => $home,
                'inside' => $inside,
            );

            $query = $this->Page_model->insertpSlider($data);

            $this->HistoryModel->insertHistory(
                "Associates",
                "Associates",
                "New Publication Slider has been Created : " . $this->input->post('n_title')
            );

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Publication Slider has been created.');
                redirect('system-content/Research/listpublication_Slider');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Research/listpublication_Slider');
            }
        }
    }

    function listpublication()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 40, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_allarticle('publications', 200); // 1078
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/research/publicationlist';
        $data['active'] = 'research';
        $data['sub'] = 'lpublication';

        $this->load->view('back-end/common/template', $data);
    }

    function editcat($id)
    {

        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard');

        $data['profile'] = $this->profile->getProfile();

        if ($pri != TRUE) {
            $data['title'] = '  Dashboard';
            $data['content'] = 'content/error';
            $data['active'] = 'events';
            $data['sub'] = 'cat';
        } 
        
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
                redirect('system-content/Events/catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Events/catogeries');
            }
        }
    }

    public function setTopics()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/topics';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF;
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

    public function setType()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/pubtypes';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF;
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
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

    public function setThumbnailPublication($title_image)
    { 
        $dir_exist = false; // flag for checking the directory exist or not
        
        if (is_dir('caching/uploads/publications/'))
        {
            $date_folder = "/".date('Ymd');
            mkdir('./caching/uploads/publications/' . $date_folder, 0777, true);
            $dir_exist = true; // dir exist
        } else {
            $date_folder = '';
            $dir_exist = false; // dir not exist
        }
        
        //upload and update the file
        $config['upload_path'] = './caching/uploads/publications'.$date_folder.'';
        $config['allowed_types'] = '*';
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = $title_image.'.png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('thumbnail_image')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    public function setPublication($title_image)
    {
        $dir_exist = false; // flag for checking the directory exist or not
        
        if (is_dir('uploads/publications/'))
        {
            $date_folder = "/".date('Ymd');
            mkdir('./uploads/publications/' . $date_folder, 0777, true);
            $dir_exist = true; // dir exist
        } else {
            $date_folder = '';
            $dir_exist = false; // dir not exist
        }
        //upload and update the file
        $config['upload_path'] = './uploads/publications/'.$date_folder.'';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = $title_image.'.png';

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

    function deletetopic()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deletetopic($id);
        return $query;
    }

    function deleter()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleter($id);
        return $query;
    }

    function deletePub()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deletePub($id);
        return $query;
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
}