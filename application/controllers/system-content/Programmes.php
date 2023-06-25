<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Programmes extends CI_Controller
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
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 21, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $slider_row = $this->Page_model->getPage_content(3);

        $data['slider_row'] = $slider_row;
        $data['action'] = site_url('system-content/programmes/editContent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/index';
        $data['active'] = 'db';
        $data['sub'] = 'dbcontent';

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
            $this->index();
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
            $this->HistoryModel->insertHistory($id, $id, "Programme Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Programme Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/programmes');
        }
    }

    function categories()
    {
        $data['profile'] = $this->profile->getProfile();
        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 22, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_catogeries('categories');
        $data['action'] = site_url('system-content/programmes/createCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/catogery';
        $data['active'] = 'db';
        $data['sub'] = 'dbcat';

        $this->load->view('back-end/common/template', $data);
    }

    function editcat($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 24, $data_s['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['areaList'] = $this->Page_model->getPage_catogeries('categories');
        $data['action'] = site_url('system-content/programmes/editCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/catogery';
        $data['active'] = 'db';
        $data['sub'] = 'dbcat';

        $this->load->view('back-end/common/template', $data);
    }

    function editCatdata()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 24, $data_s['group_id']);
        
        $id = $this->input->post('id');
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');

        $validate = $this->form_validation->run();
        
        $img = -1;

        $title_image_category = str_replace(array(' ','/','@','(',')','%','%20'), '-', strtolower($this->input->post('category_name')));
        
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setCat($title_image_category);

            $img = "/uploads/categories/" . $img;
            
            $this->resizeImageNewCategory($title_image_category);
            
        } else {
            
            if (file_exists(FCPATH . $this->input->post('image'))) {

                $image_cover_data = [
                    'base_image'    => $this->input->post('image'),
                    'title_image'   => $title_image_category,
                    'type_page'     => '/uploads/categories',
                    'width'         => 359,
                    'height'        => 270,
                ];
                
                $this->Page_model->resizeImageCover($image_cover_data);

                $new_image_data = [
                    'base_image'    => $this->input->post('image'),
                    'title_image'   => $title_image_category,
                    'type_page'     => '/uploads/categories',
                    'width'         => 970,
                    'height'        => 270,
                ];

                $img = $this->Page_model->updateNewImage($new_image_data);

            }
        }

        if ($validate == FALSE) {
            $this->editcat($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if ($this->input->post('external_link')) {
                $external_link = 1;
            } else {
                $external_link = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'categories',
                'external_link' => $external_link,
                'image_name'    => $img,
                'description'   => $this->input->post('description'),
                'order_id'      => $this->input->post('order_id'),
                'published'     => $published,
                'modified_by'   => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "New Catogery has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Catogery has been updated.');
                redirect('system-content/programmes/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/programmes/categories');
            }
        }
    }

    function createCat()
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 24, $data_s['group_id']);

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->catogeries();
        } else {
            $title_image_category = str_replace(array(' ','/','@','(',')','%','%20'), '-', strtolower($this->input->post('category_name')));
            
            if ($validate == TRUE && file_exists($_FILES['photo']['tmp_name'])) {
            
                $img_data = $this->setCat($title_image_category);
                
                $img = "/uploads/categories/" . $img_data;
                
                $resizeImage = "/caching/uploads/categories/" .$this->resizeImageNewCategory($title_image_category);
                
            } else {
                $img = $this->input->post('image');
            }
            

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if ($this->input->post('external_link')) {
                $external_link = $this->input->post('external_link');
            } else {
                $external_link = $this->input->post('external_link');
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'image_name'        => $img,
                'category_name'     => $this->input->post('category_name'),
                'category_type'     => 'categories',
                'uri'               => str_replace(' ', '-', $this->input->post('category_name')),
                'external_link'     => $external_link,
                'description'       => $this->input->post('description'),
                'order_id'          => $this->input->post('order_id'),
                'published'         => $published,
                'modified_by'       => $data_s['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description')
            );
            
            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Category", "Category", "New Category has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Category has been created.');
                redirect('system-content/Programmes/categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Programmes/categories');
            }
        }
    }

    public function setCat($title_image)
    {
        //upload and update the file
        $config['upload_path']      = './uploads/categories';
        $config['allowed_types']    = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF;
        $config['overwrite']        = false;
        $config['remove_spaces']    = true;
        $config['file_name']        = $title_image.'.png';

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

    function resizeImageNewCategory($title_image)
    {
        $this->load->library('image_lib');
        //upload and update the file
        $config['upload_path']      = './caching/uploads/categories';
        $config['allowed_types']    = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF;
        $config['overwrite']        = false;
        $config['remove_spaces']    = true;
        $config['file_name']        = $title_image.'.png';
        $config['image_library']    = 'gd2';
        $config['maintain_ratio']   =  TRUE;
        $config['width']            = 250;
        $config['height']           = 250;

        $image_data = $this->upload->data();
        $config['source_image']     = $image_data['full_path'];
        $this->load->library('upload', $config);
        
        
        // $config =  array(
        //     'image_library'   => 'gd2',
        //     'source_image'    =>  $image_data['full_path'],
        //     'maintain_ratio'  =>  TRUE,
        //     'width'           =>  250,
        //     'height'          =>  250,
        // );
        
        $this->image_lib->clear();
        $this->upload->initialize($config);
        $this->image_lib->resize();
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

    function s_categories()
    {

        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 24, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['catogery'] = $this->Page_model->getPage_catogeries('categories');
        $data['areaList'] = $this->Page_model->getPage_subcatogeries('subcategories');
        $data['action'] = site_url('system-content/programmes/createsubCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/sucatogery';
        $data['active'] = 'db';
        $data['sub'] = 'dbscat';

        $this->load->view('back-end/common/template', $data);
    }


    function createsubCat()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->s_catogeries();
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'subcategories',
                'parent_id' => $this->input->post('parent'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')

            );

            $query = $this->Page_model->insertCat($data);

            $this->HistoryModel->insertHistory("Sub Catogery", "Sub Category", "New Sub Category has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Sub Category has been created.');
                redirect('system-content/Programmes/s_categories');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Programmes/s_categories');
            }
        }
    }


    function edit_subcat($id)
    {
        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 24, $data_s['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_cat($id);
        $data['catogery'] = $this->Page_model->getPage_catogeries('categories');
        $data['areaList'] = $this->Page_model->getPage_subcatogeries('subcategories');
        $data['action'] = site_url('system-content/programmes/editsubCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/sucatogery';
        $data['active'] = 'db';
        $data['sub'] = 'dbscat';

        $this->load->view('back-end/common/template', $data);
    }

    function editsubCatdata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_subcat($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'category_name' => $this->input->post('category_name'),
                'category_type' => 'subcategories',
                'parent_id' => $this->input->post('parent'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $data_s['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description')
            );

            $query = $this->Page_model->updatecat($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "Sub Catogery has been Updated : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Sub Catogery has been updated.');
                redirect('system-content/programmes/edit_subcat/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/programmes/edit_subcat/' . $id);
            }
        }
    }

    function article()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 23, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        // $slider_row = $this->Page_model->getPage_content(3);
        // $data['slider_row'] = $slider_row;
        $data['slider_row'] = array();
        $data['catData'] = array();
        $data['subCatData'] = array();

        $c = $this->Page_model->getPage_catogeries('categories');
        $t = $this->Page_model->getPage_subcatogeries('subcategories');

        $data['relatedData'] = array();
        $data['areaList'] = $this->Page_model->getPage_allarticle('articles', 300);
        $data['relatedPublicationsData'] = array();
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 300);
        
        $v = array_merge($c->result(), $t->result());

        $data['catogery'] = $this->Page_model->getPage_catogeries('categories')->result(); // $v
        $data['subcategory'] = $this->Page_model->getPage_subcatogeries('subcategories')->result();
        $data['action'] = site_url('system-content/Programmes/createP');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/article';
        $data['active'] = 'db';
        $data['sub'] = 'article';

        $this->load->view('back-end/common/template', $data);
    }

    function createP()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->article();
        } else {
            $img = $this->setArt();
            $img = "/uploads/articles/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'image_name'            => $img,
                'pub_type'              => 0,
                'title'                 => $this->input->post('title'),
                'uri'                   => str_replace(' ', '-', strtolower($this->input->post('title'))),
                'posted_date'           => $this->input->post('posted_date'),
                'article_type'          => 'articles',
                'content'               => $this->input->post('content'),
                'short_des'             => $this->input->post('short_des'),
                'tags'                  => $this->input->post('tags'),
                'published'             => $published,
                'event_time'            => $this->input->post('event_time'),
                'venue'                 => $this->input->post('venue'),
                'modified_by'           => $data_s['user_id'],
                'modified_date'         => date('Y-m-d H:i:s'),
                'meta_keywords'         => $this->input->post('meta_keywords'),
                'meta_description'      => $this->input->post('meta_description'),
            );
            
            $category = $this->input->post('catogery');
            $subcategory = $this->input->post('subcategory');
    
            // if empty category
            if (isset($category)) {
                $categories_data = $this->input->post('catogery');
            } else {
                $categories_data = array();
            }

            // if empty subcategory
            if (isset($subcategory)) {
                $subcategories_data = $this->input->post('subcategory');
            } else {
                $subcategories_data = array();
            }

            $topics = array_merge($categories_data, $subcategories_data);
            
            $related = $this->input->post('related');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->insertArticle($data, $category, $topics, $related, null, null, null, null, null, null, $related_publication, null);

            $this->HistoryModel->insertHistory("Articles", "Articles", "New Articles has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Article has been created.');
                redirect('system-content/Programmes/article');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Programmes/article');
            }
        }
    }

    function editArt($id)
    {
        $data_s = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 25, $data_s['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // }

        $slider_row = $this->Page_model->getPage_article($id);
        $data['slider_row'] = $slider_row;

        $c = $this->Page_model->getPage_catogeries('categories');
        $t = $this->Page_model->getPage_subcatogeries('subcategories');
        $v = array_merge($c->result(), $t->result());

        $data['catogery'] = $this->Page_model->getPage_catogeries('categories')->result();
        $data['catData'] = $this->Page_model->getArticleTopicByArticleId($id, 'categories');
        $data['subCatData'] = $this->Page_model->getArticleTopicByArticleId($id, 'subcategories');
        $data['subcategory'] = $this->Page_model->getPage_subcatogeries('subcategories')->result();
        $data['areaList'] = $this->Page_model->getPage_allarticle('articles', 200);
        $data['relatedData'] = $this->Page_model->get_articleRelated($id);
        $data['related'] = $this->Page_model->getPage_allarticle('articles', 200);
        $data['relatedPublicationsData'] = $this->Page_model->getArticlePublicationRelated($id);
        $data['publicationList'] = $this->Page_model->getPage_allarticle('publications', 200);
        $data['action'] = site_url('system-content/Programmes/edit_Art');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/programmes/article';
        $data['active'] = 'db';
        $data['sub'] = 'article';

        $this->load->view('back-end/common/template', $data);
    }

    function edit_Art()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();
        $img = -1;
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setArt();
        }

        if ($validate == FALSE) {
            $this->editArt($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data_s = $this->session->userdata('logged_in');

            $data = array(
                'pub_type'          => 0,
                'title'             => $this->input->post('title'),
                'uri'               => str_replace(array(" ", "'"), '-', strtolower($this->input->post('title'))),
                'posted_date'       => $this->input->post('posted_date'),
                'article_type'      => 'articles',
                'content'           => $this->input->post('content'),
                'tags'              => $this->input->post('tags'),
                'published'         => $published,
                'event_time'        => $this->input->post('event_time'),
                'venue'             => $this->input->post('venue'),
                'modified_by'       => $data_s['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description'),
            );

            if ($img !== -1) {
                $img = "/uploads/articles/" . $img;
                $data['image_name'] = $img;
            }

            $category = $this->input->post('catogery');

            $category = $this->input->post('catogery');
            $subcategory = $this->input->post('subcategory');
    
            // if empty category
            if (isset($category)) {
                $categories_data = $this->input->post('catogery');
            } else {
                $categories_data = array();
            }

            // if empty subcategory
            if (isset($subcategory)) {
                $subcategories_data = $this->input->post('subcategory');
            } else {
                $subcategories_data = array();
            }

            $topics = array_merge($categories_data, $subcategories_data);

            $related = $this->input->post('related');
            $related_publication = $this->input->post('related_publication');

            $query = $this->Page_model->updateArticle($id, $data, $category, $topics, $related, null, null, null, null, null, null, $related_publication, null);

            $this->HistoryModel->insertHistory($id, $id, "  Article has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Article has been updated.');
                redirect('system-content/Programmes/editArt/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Programmes/a_list');
            }
        }
    }

    function a_list()
    {
        $data['profile'] = $this->profile->getProfile();

        $data_s = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'], $data_s['user_id'], 25, $data_s['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['editor_'] = $this->Page_model->getPage_allsubArticle();
        $data['areaList'] = $this->Page_model->getPage_allarticle('articles', 300);
        $data['action'] = site_url('system-content/programmes/createCat');
        $data['title'] = 'Dashboard';
        $data['content'] = 'back-end/content/programmes/alist';
        $data['active'] = 'db';
        $data['sub'] = 'articlel';

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

    function viewPdf()
    {
        $id = $this->input->post('id');
        $details = $this->Page_model->viewPdf($id);
        echo json_encode($details);
    }

    function sliderEdit()
    {

        $id = $this->input->post('id');

        $this->form_validation->set_rules('banner_url', 'banner_url', 'trim|required');
        $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        $validate = $this->form_validation->run();
        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            // $img = $this->setSlider();
            redirect('system-content/slider/listSlider');
        }

        if ($validate == FALSE) {
            // $this->editSlider($id);
            redirect('system-content/slider/listSlider');
        } else {
            $query = $this->Slider_model->updateSlider($img);

            $this->HistoryModel->insertHistory($img, $img, "Home Page Slider has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Slider has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/slider/listSlider');
        }
    }

    public function setArt()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/articles';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF;
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

    public function setPdf()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/pdf';
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

    public function uploadPDF($filename)
    {
        //upload and update the file
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'application/pdf|pdf';
        $config['overwrite'] = true;
        $config['remove_spaces'] = true;
        $config['file_name'] = $filename['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('file')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }

        return $imgName;
    }

    function pdf()
    {
        // file name
        $filename = $_FILES['file'];
       
        $img = $this->uploadPDF($filename);

        $location = 'uploads/' . $img;
        $pdf_dis = $_POST['pdf_dis'];
        $aid = $_POST['aid'];
        $ptype = $_POST['ptype'];
        $pdf_title = $_POST['pdf_title'];
        $orderid = $_POST['order_id'];

        $author = $_POST['author'];

        /*
        ** Update sort automatic
        */ 
        $getpdf = $this->Page_model->getPdfByArticleId($aid);

        foreach ($getpdf as $value) {
            if ($value->order_id === $orderid) {
                $sort_order_old = $value->order_id;
                $lastorder = count($getpdf) + 1;

                $data_old = [
                    'order_id'  => $lastorder,
                ];

                $this->Page_model->update_order($value->pdf_id, $data_old);
            }
        }

        if (!empty($sort_order_old)) {
            $order_id = $sort_order_old;
        } else {
            if (!empty($orderid)) {
                $order_id = $orderid;
            } else {
                $order_id = count($getpdf) + 1;
            }
        }

        $data = array(
            'pdf_title'         => $pdf_title,
            'pdf'               => $location,
            'pdf_discription'   => $pdf_dis,
            'pdf_type'          => $ptype,
            'article_id'        => $aid,
            'order_id'          => $order_id,
        );

        $query = $this->Page_model->insertPdf($data, $author);

        if ($query > 0) {
            $response = 1;
            // if (in_array($file_extension, $image_ext)) {
                // Upload file
                // if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                //     $response = $location;
                // }
            // }

            echo $response;
        } else {
            $response = 0;
            echo $response;
        }
    }

    function deletepdf()
    {
        $pid = $this->input->post('pid');
        $details = $this->Page_model->delPDF($pid);
        echo json_encode($details);
    }

    function editpdf()
    {
        $pid = $this->input->post('pid');
        $getpdf = $this->Page_model->getEditPDF($pid)[0];

        // $getauthor = $this->Page_model->getAuthorPDF($getpdf->pdf_id);
        $getauthor = $this->Page_model->get_pdfAuthor($getpdf['pdf_id']);
        $getallauthor = $this->Page_model->getPage_allsubArticle();
        $data = [
            'pdf_id'    => $getpdf['pdf_id'],
            'pdf_title'         => $getpdf['pdf_title'],
            'pdf_discription'   => $getpdf['pdf_discription'],
            'pdf'               => $getpdf['pdf'],
            'pdf_type'          => $getpdf['pdf_type'],
            'article_id'        => $getpdf['article_id'],
            'order_id'          => $getpdf['order_id'],
            'author'            => $getauthor,
            'all_author'        => $getallauthor->result(),
        ];

        echo json_encode($data);
    }

    function updatepdf()
    {
        $input = $this->input->post();

        /*
        ** Update sort automatic
        */
        $getpdf = $this->Page_model->getPdfByArticleId($input['article_id']);

        $orderid = $input['order_id'];
        foreach ($getpdf as $value) {
            if ($value->order_id === $orderid) {
                $sort_order_old = $value->order_id;

                $pdf_get = $this->Page_model->getPdfByPdfId($input['id'])[0];

                $lastorder = $pdf_get->order_id;
                $data_old = [
                    'order_id'  => $lastorder,
                ];

                $this->Page_model->update_order($value->pdf_id, $data_old);
            }
        }

        if (!empty($sort_order_old)) {
            $order_id = $sort_order_old;
        } else {
            $order_id = $orderid;
        }
        
        if (isset($_FILES['file'])) {
            $filename = $_FILES['file'];
            $img = 'uploads/' . $this->uploadPDF($filename);
        } else {
            $img = $input['file_pdf_old'];
        }

        $location = $img;
        $pdf_dis = $input['pdf_discription'];
        $pdf_title = $input['pdf_title'];

        if (count(array_unique(explode(',', $input['author']))) === 1) {
            if (count(explode(',', $input['author'])) > 1) {
                $author = array_unique(explode(',', $input['author']));
            } else {
                $author = explode(',', $input['author']);
            }
            
        } else {
            $author = array_unique(explode(',', $input['author']));
        }
        
        $data = array(
            'pdf_title'         => $pdf_title,
            'pdf'               => $location,
            'pdf_discription'   => $pdf_dis,
            'order_id'          => $order_id,
        );

        $query = $this->Page_model->updatePdf($input['id'], $data, $author);

        if ($query > 0) {
            $details = $this->Page_model->viewPdf($input['article_id']);
            echo json_encode($details);
        } else {
            $response = 0;
            echo json_encode($response);
        }
        
    }

    function publishProgrammes()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->statusProgrammesCategory($id, $pub);
        return $query;
    }

    function deleteCat()
    {
        $pid = $this->input->post('id');
        $details = $this->Page_model->deleteCat($pid);
        echo json_encode($details);
    }

    function deletepdfAuthor()
    {
        $pid = $this->input->post('pid');
        $details = $this->Page_model->deletepdfAuthor($pid);
        echo json_encode($details);
    }
}