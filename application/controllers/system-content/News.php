<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/HistoryModel');
        $this->load->library('privilage');
        $this->load->model('admin/Page_model', '', TRUE);
    }

    public function listnews()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 30, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_allarticle('news', 200); // 2197 ori getPage_allarticle => 1197
        $data['action'] = site_url('system-content/news/create');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/newslist';
        $data['active'] = 'news';
        $data['sub'] = 'newsl';

        $this->load->view('back-end/common/template', $data);
    }

    public function index()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 29, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['slider_row'] = array();
        $data['article_images'] = array();
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['eData'] = array();
        $data['areaList'] = $this->Page_model->getPage_catogeries('newscategories');
        $data['area_List'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['catData'] = array();
        $data['topData'] = array();
        $data['relatedData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedPublicationsData'] = array();
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['action'] = site_url('system-content/news/create');
        $data['title'] = 'Dashboard';
        $data['content'] = 'back-end/content/news/article';
        $data['active'] = 'news';
        $data['sub'] = 'news';
        $data['m_areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['_experts'] = array();
        $data['_multimedia'] = array();

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

    function duplication_page_multimedia()
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

    function editA($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard', $data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'news';
        //     $data['sub'] = 'news';
        // } 
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['eData'] = array();
        $data['areaList'] = $this->Page_model->getPage_catogeries('newscategories');
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['area_List'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['article_images'] = $this->Page_model->getArticleImageByArticleId($id);
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        // $data['relatedPublicationsData'] = $this->Page_model->getArticlePublicationRelated($id);
        $data['relatedPublicationsData'] = $this->Page_model->getRelatedArticleForPublication($id);

        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedData'] = $this->Page_model->get_articleRelated($id);
        
        $data['catData'] = $this->Page_model->get_articleCatogery($id);
        $data['topData'] = $this->Page_model->get_articleTopic($id);
        $data['action'] = site_url('system-content/news/edit_news');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/article';
        $data['active'] = 'news';
        $data['sub'] = 'news';
        $data['m_areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['_multimedia'] = $this->Page_model->get_articleMultimedia($id);

        $this->load->view('back-end/common/template', $data);
    }

    function edit_news()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();

        $img = -1;
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setEvent();
        }

        if ($validate == FALSE) {
            $this->editmA($id);
        } else {

            $data_s = $this->session->userdata('logged_in');
            
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if (!empty($_FILES['image_gallery']['name'][0])) {
                $this->uploadImageGallery($_FILES['image_gallery'], $id);

                $article_id = $id;

                for ($i = 0; $i < count($_FILES['image_gallery']); $i++) {

                    if (isset($_FILES['image_gallery']['name'][$i])) {
                        $gallery_image[] = [
                            'article_id'    => $id,
                            'image_name'    => '/uploads/news/' . $id . '/' . $_FILES['image_gallery']['name'][$i],
                            'modified_date' => date('Y-m-d h:i:s'),
                            'modified_by'   => $data_s['user_id'],
                        ];
                    }
                }

                $this->Page_model->insertGalleryImage($article_id, $gallery_image);
            }
            //$u=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\'\(\)%&-]/s', '', $this->input->post('title'));

            $data = array(
                'title'                 => $this->input->post('title'),
                'posted_date'           => $this->input->post('posted_date'),
                'editor'                => $this->input->post('editor'),
                'article_type'          => 'news',
                'pub_type'              => 0,
                'short_des'             => $this->input->post('short_des'),
                'content'               => $this->input->post('content'),
                'published'             => $published,
                'modified_by'           => $data_s['user_id'],
                'modified_date'         => date('Y-m-d H:i:s'),
                'meta_keywords'         => $this->input->post('meta_keywords'),
                'meta_description'      => $this->input->post('meta_description'),
            );

            if ($img !== -1) {
                $img = "/uploads/news/" . $img;
                $data['image_name'] = $img;
            }

            $related_publication = $this->input->post('related_publication');
            $mcategory = $this->input->post('mcatogery');
            $related = $this->input->post('related');
            $topic_s = $this->input->post('topics');
            $category_ = $this->input->post('catogery');

            $query = $this->Page_model->updateArticle($id, $data, $category_, $topic_s, $related, null, null, null, null, $mcategory, 'N', $related_publication, null);

            $this->HistoryModel->insertHistory($id, $id, "News has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'News has been updated.');
                redirect('system-content/News/editA/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/listnews');
            }
        }
    }

    public function listmnews()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 33, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        if (isset($_POST['category_id'])) {
            $category_id = $_POST['category_id'];
        } else {
            $category_id = '';
        }

        $multimedia = 'multimedia';

        $data['categories'] = $this->Page_model->getExpert_catogeries($multimedia);
        $data['areaList'] = $this->Page_model->getPage_multiallarticle($multimedia, $category_id);
        $data['action'] = site_url('system-content/news/create');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/newsmlist';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnewsl';

        $this->load->view('back-end/common/template', $data);
    }

    function multimedia()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 32, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['pubtypes'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['catData'] = array();
        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['eData'] = array();
        $data['areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['sub_category_multimedia'] = $this->Page_model->getSubCategoryMultimedia();
        $data['area_List'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['catData'] = array();
        $data['topData'] = array();
        $data['relatedData'] = array();
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedPublicationsData'] = array();
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['action'] = site_url('system-content/news/createm');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/m_article';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews';
        $data['_experts'] = array();

        $this->load->view('back-end/common/template', $data);
    }

    function createm()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->multimedia();
        } else {
            $img = $this->setEvent();

            if (!empty($img)) {
                $img = "/uploads/news/" . $img;
            } else {
                $img = NULL;
            }
            

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'title' => $this->input->post('title'),
                'uri' => str_replace(' ', '-', $this->input->post('title')),
                'posted_date' => $this->input->post('posted_date'),
                'editor' => $this->input->post('editor'),
                'video_url' => $this->input->post('video_url'),
                'pub_type' => 0,
                'content' => $this->input->post('content'),
                'published' => $published,
                'image_name' => $img,
                'sc_id' => $this->input->post('scat'),
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'article_type' => 'multimedia',
                'sub_experts'  => $this->input->post('catogery'),
                'sub_dep_experts'  => $this->input->post('scat'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
            );

            $category = $this->input->post('catogery');
            $topic_s = $this->input->post('topics');
            $related = $this->input->post('related');
            $mcategory = $this->input->post('mcatogery');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->insertArticle($data, $category, $topic_s, $related, null, null, null, null, $mcategory, 'C', $related_publication, null);

            $this->HistoryModel->insertHistory("Multimedia", "Multimedia", "New Multimedia has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia has been created.');
                redirect('system-content/News/listmnews');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/listmnews');
            }
        }
    }

    function mscat()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 31, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['cList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['areaList'] = $this->Page_model->getExpert_subCatogeries('multimedia');
        $data['action'] = site_url('system-content/news/createsCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/mscatogery';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews_sc';

        $this->load->view('back-end/common/template', $data);
    }
    function createsCat()
    {
        $this->form_validation->set_rules('s_catogery', 's_catogery', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            // $this->sub_catogeries();
            $this->mscat();
        } else {
            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'ec_id' => $this->input->post('category_name'),
                's_catogery' => $this->input->post('s_catogery'),

            );

            $query = $this->Page_model->insert_expert_sCat($data);

            $this->HistoryModel->insertHistory("Sub Category", "Sub category", "Multimedia Sub Category has been Created : " . $this->input->post('s_catogery'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia Sub Category has been created.');
                redirect('system-content/News/mscat');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/mscat');
            }
        }
    }

    function editscat($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard', $data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_expertssCat($id);
        $data['cList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['areaList'] = $this->Page_model->getExpert_subCatogeries('multimedia');
        $data['action'] = site_url('system-content/News/editsCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/mscatogery';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews_sc';

        $this->load->view('back-end/common/template', $data);
    }

    function editsCatdata()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('s_catogery', 's_catogery', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->editscat($id);
        } else {
            $data_s = $this->session->userdata('logged_in');
            $data = array(
                'ec_id' => $this->input->post('category_name'),
                's_catogery' => $this->input->post('s_catogery'),
            );

            $query = $this->Page_model->update_expertsCat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "New Multimedia Sub Catogery has been Updated : " . $this->input->post('s_catogery'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia Sub Catogery has been updated.');
                redirect('system-content/News/mscat');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/mscat');
            }
        }
    }

    function mcat()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 31, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['action'] = site_url('system-content/news/create_Cat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/mcatogery';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews_c';

        $this->load->view('back-end/common/template', $data);
    }

    function create_Cat()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->mcat();
        } else {
            $data_s = $this->session->userdata('logged_in');
            $data = array(
                'parent'        => 'multimedia',
                'category'      => $this->input->post('category_name'),
                'content'       => $this->input->post('order_id'),
                'article_types' => 'multimedia',
                'slug'          => strtolower($this->input->post('category_name')),
            );


            $query = $this->Page_model->insert_expertCat($data);

            $this->HistoryModel->insertHistory("Category", "Category", "Multimedia Category has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia Category has been created.');
                redirect('system-content/News/mcat');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/mcat');
            }
        }
    }

    function edit_cat($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 26, $data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // }

        $data['slider_row'] = $this->Page_model->getPage_expertCat($id);
        $data['areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['action'] = site_url('system-content/News/edit_Catdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/mcatogery';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews_c';

        $this->load->view('back-end/common/template', $data);
    }

    function edit_Catdata()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_cat($id);
        } else {
            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category' => $this->input->post('category_name'),
                'content' => $this->input->post('order_id'),
            );

            $query = $this->Page_model->update_expertCat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "New Multimedia Catogery has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia Catogery has been updated.');
                redirect('system-content/News/mcat');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/mcat');
            }
        }
    }

    function editmA($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 'dashboard', $data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'news';
        //     $data['sub'] = 'news';
        // } 

        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['pubtypes'] = $this->Page_model->getPage_catogeries('pubtypes');
        $data['catData'] = array();
        $data['areaList'] = $this->Page_model->getExpert_catogeries('multimedia');
        $data['sub_category_multimedia'] = $this->Page_model->getSubCategoryMultimedia();
        $data['area_List'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['relatedData'] = $this->Page_model->get_articleRelated($id);
        $data['related'] = $this->Page_model->getPage_allarticle('news', 200);
        $data['relatedPublicationsData'] = $this->Page_model->getArticlePublicationRelated($id);
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['catData'] = $this->Page_model->get_articleCatogery($id);
        $data['topData'] = $this->Page_model->get_articleTopic($id);

        $v = $this->Page_model->get_articleMultimedia($id);

        $data['_experts'] = $v;
        $data['action'] = site_url('system-content/news/edit_mul');
        $data['title'] = ' Dashboard';
        $data['content'] = 'back-end/content/news/m_article';
        $data['active'] = 'mnews';
        $data['sub'] = 'mnews';

        $this->load->view('back-end/common/template', $data);
    }

    function getSub()
    {
        $id = $this->input->post('id');
        $article_type_sub = 'multimedia';
        $query = $this->Page_model->getSub($id, $article_type_sub);

        $output = '';
        $output .= "<option value='' >--Select--</option>";

        foreach ($query as $query) {
            $output .= "<option value='" . $query->es_id . "' >" . $query->s_catogery . "</option>";
        }

        echo $output;
    }

    function delete_gallery_image()
    {
        $input = $this->input->post();

        $this->Page_model->deleteGalleryImage($input['image_id']);

        echo json_encode(1);
    }

    public function uploadImageGallery($file, $id)
    {
        // $imgGallery = array();
        if (isset($file)) {
            for ($i = 0; $i < count($file); $i++) {

                if (isset($file['name'][$i])) {
                    $target_dir = './uploads/news/' . $id . '/';
                    $target_file = $target_dir . basename($file['name'][$i]);

                    if (!move_uploaded_file($file["tmp_name"][$i], $target_file)) {
                        $result = FALSE;
                    } else {
                        $result = TRUE;
                    }
                } else {
                    $result = FALSE;
                }
            }
        } else {
            $result = FALSE;
        }


        return $result;
    }

    function edit_mul()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setEvent();
        }

        if ($validate == FALSE) {
            $this->editmA($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }
            $data_s = $this->session->userdata('logged_in');
            //$u=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\'\(\)%&-]/s', '', $this->input->post('title'));
            $data_s = $this->session->userdata('logged_in');

            $value_slug = $this->input->post('title');
            // $str_replace = preg_replace("/(\'|.)(,)(.*\'|)/", "$1.$3", $value_slug);
            $str_replace1 = str_replace("'", "-", $value_slug);
            $str_replace2 = str_replace("|", "-", $str_replace1);
            $str_replace3 = str_replace("`", "-", $str_replace2);
            $str_replace4 = str_replace(":", "-", $str_replace3);
            $str_replace5 = str_replace(" ", "-", $str_replace4);

            $uri = str_replace(' ', '-', $str_replace5);

            $data = array(
                'uri'           => $uri,
                'title'         => $this->input->post('title'),
                'posted_date'   => $this->input->post('posted_date'),
                'editor'        => $this->input->post('editor'),
                'video_url'     => $this->input->post('video_url'),
                'pub_type'      => 0,
                'content'       => $this->input->post('content'),
                'published'     => $published,
                'modified_by'   => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'article_type'      => 'multimedia',
                'sub_experts'       => $this->input->post('catogery'),
                'sub_dep_experts'   => $this->input->post('scat'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description'),
            );

            if ($img !== -1) {
                $img = "/uploads/news/" . $img;
                $data['image_name'] = $img;
            }

            $topic_s = $this->input->post('topics');
            $related = $this->input->post('related');
            $mcategory = $this->input->post('mcatogery');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->updateArticle($id, $data, null, $topic_s, $related, null, null, null, null, $mcategory, 'C', $related_publication, null);
            
            $this->HistoryModel->insertHistory($id, $id, "  Multimedia has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Multimedia has been updated.');
                redirect('system-content/News/editmA/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/listmnews');
            }
        }
    }

    function create()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');

        $validate = $this->form_validation->run();
        
        if ($validate == FALSE) {
            $this->index();
        } else {

            $img = $this->setEvent();
            $img = "/uploads/news/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'title' => $this->input->post('title'),
                'uri' => str_replace(' ', '-', $this->input->post('title')),
                'posted_date' => $this->input->post('posted_date'),
                'editor' => $this->input->post('editor'),
                'article_type' => 'news',
                'pub_type' => 0,
                'content' => $this->input->post('content'),
                'published' => $published,
                'image_name' => $img,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),

            );
            
            $category = $this->input->post('catogery');
            $topic_s = $this->input->post('topics');
            $related = $this->input->post('related');
            $mcategory = $this->input->post('mcatogery');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->insertArticle($data, $category, $topic_s, $related, null, null, null, null, $mcategory, 'N', $related_publication, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Associates has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Associates has been created.');
                redirect('system-content/News/listnews');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/listnews');
            }
        }
    }


    public function content()
    {

        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 26, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $slider_row = $this->Page_model->getPage_content(4);
        $data['slider_row'] = $slider_row;
        $data['action'] = site_url('system-content/News/editContent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/Events/index';
        $data['active'] = 'news';
        $data['sub'] = 'ncontent';




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
                'content' => $this->input->post('content'),
                'published' => $published,
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );



            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "News Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'News Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/News/content');
        }
    }


    function categories()
    {

        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 27, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }


        $data['areaList'] = $this->Page_model->getPage_catogeries('newscategories');

        $data['action'] = site_url('system-content/News/createCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/catogery';
        $data['active'] = 'news';
        $data['sub'] = 'ncat';

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
                'category_type' => 'newscategories',
                'uri' => str_replace(' ', '_', $this->input->post('category_name')),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );


            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Category", "Category", "News Catogery has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Category has been created.');
                redirect('system-content/News/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/categories');
            }
        }
    }


    function editcat($id)
    {

        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 26, $data_s['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 

        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('newscategories');
        $data['action'] = site_url('system-content/News/editCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/catogery';
        $data['active'] = 'news';
        $data['sub'] = 'ncat';


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
                redirect('system-content/news/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/news/categories');
            }
        }
    }
    function edittop($id)
    {

        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 26, $data_s['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'events';
        //     $data['sub'] = 'cat';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('newstopics');
        $data['action'] = site_url('system-content/News/editTopdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/topic';
        $data['active'] = 'news';
        $data['sub'] = 'topics';

        $this->load->view('back-end/common/template', $data);
    }

    function editTopdata()
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

            $this->HistoryModel->insertHistory($id, $id, "News Topic has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Topic has been updated.');
                redirect('system-content/news/topic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/news/topic');
            }
        }
    }

    function topic()
    {

        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 28, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('newstopics');

        $data['action'] = site_url('system-content/News/createTop');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/news/topic';
        $data['active'] = 'news';
        $data['sub'] = 'topics';

        $this->load->view('back-end/common/template', $data);
    }


    function createTop()
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
                'category_type' => 'newstopics',
                'uri' => str_replace(' ', '_', $this->input->post('category_name')),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );


            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Catogery", "Catogery", "News Catogery has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'News Topic has been created.');
                redirect('system-content/News/topic');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/News/topic');
            }
        }
    }

    function deleteNN()
    {
        $pid = $this->input->post('id');
        $details = $this->Page_model->deleteNN($pid);
        echo json_encode($details);
    }

    public function setEvent()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/news';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['max_size'] = '5000000'; // in KB
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

    function publishNewsPressRoom()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishR($id, $pub);
        return $query;
    }

    function publishMultimedia()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishR($id, $pub);
        return $query;
    }

    function deleteCat()
    {
        $pid = $this->input->post('id');
        $details = $this->Page_model->deleteCat($pid);
        echo json_encode($details);
    }
}