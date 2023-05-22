<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Experts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/HistoryModel');
        $this->load->library('privilage');
        $this->load->model('admin/Page_model', '', TRUE);
        $this->load->model('admin/Experts_model', '', TRUE);
    }

    public function content()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 15, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $slider_row = $this->Page_model->getPage_content(19);
        $data['slider_row'] = $slider_row;
        $data['action'] = site_url('system-content/Experts/editContent');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/index';
        $data['active'] = 'experts';
        $data['sub'] = 'econtent';

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
            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'menu_title'        => $this->input->post('menu_title'),
                'title'             => $this->input->post('title'),
                'order_id'          => $this->input->post('order_id'),
                'published'         => $published,
                'meta_keywords'     => $this->input->post('meta_keywords'),
                'meta_description'  => $this->input->post('meta_description'),
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "Expert Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Experts/content');
        }
    }

    function index()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 17, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }
        
        $data['areaList'] = $this->Page_model->getExpert_catogeries('experts');
        $data['subCategoryList'] = $this->Page_model->getAllSubCategoryExpert();
        
        $data['action'] = site_url('system-content/Experts/createExperts');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/experts';
        $data['active'] = 'experts';
        $data['sub'] = 'experts';

        /*
        ** Events People Card
        */
        $data['people_id']          = '';
        $data['people_events']      = $this->Page_model->getEventPeople('events');
        $data['events_data']        = array();
        $data['action_event']       = site_url('system-content/Experts/editPeopleEvents');

        $this->load->view('back-end/common/template', $data);
    }

    function editA($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // } 
        
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/Experts/editAss');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/research';
        $data['active'] = 'experts';
        $data['sub'] = 'research';

        $this->load->view('back-end/common/template', $data);
    }

    function editAss()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('major', 'major', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();
        $img = -1;
        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setResearch();
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

            $data = array(
                'title' => $this->input->post('title'),
                'article_keywords' => $this->input->post('article_keywords'),
                'content' => $this->input->post('content'),
                'major' => $this->input->post('major'),
                'posted_date' => $this->input->post('posted_date'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            if ($img !== -1) {
                $img = "/uploads/associates/" . $img;
                $data['image_name'] = $img;
            }

            $eria_expert_subcategory = $this->input->post('subcategory');

            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, $eria_expert_subcategory);

            $this->HistoryModel->insertHistory($id, $id, "New Associates has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Associates has been updated.');
                redirect('system-content/experts/editA/'.$id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/researchlist');
            }
        }
    }

    function edit($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);
        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        //     $data['title'] = '  Dashboard';
        //     $data['content'] = 'content/error';
        //     $data['active'] = 'privacy';
        //     $data['sub'] = 'content';
        // } 
        
        $data['areaList']           = $this->Page_model->getExpert_catogeries('experts');
        $data['subCategoryList']    = $this->Page_model->getAllSubCategoryExpert();
        $data['slider_row']         = $this->Page_model->getPage_article($id);
        $data['action']             = site_url('system-content/Experts/editExperts');
        $data['title']              = 'Dashboard';
        $data['content']            = 'back-end/content/experts/experts';
        $data['active']             = 'experts';
        $data['sub']                = 'experts';

        /*
        ** Events People Card
        */
        $data['people_id']          = $id;
        $data['people_events']      = $this->Page_model->getEventPeople('events');
        $data['events_data']        = $this->Page_model->getEventDataByPeopleId($id);
        $data['action_event']       = site_url('system-content/Experts/editPeopleEvents');

        $this->load->view('back-end/common/template', $data);
    }

    function editExperts()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('major', 'major', 'trim|required');
        $this->form_validation->set_rules('sub_experts', 'sub_experts', 'trim|required');

        $validate = $this->form_validation->run();

        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setExperts();
        }

        if ($validate == FALSE) {
            $this->edit($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $eria_expert_category_id = $this->input->post('sub_experts');

            $this->db->select('*');
            $this->db->where('ec_id', $eria_expert_category_id);
            $query_expert_category = $this->db->get('eria_expert_categories');

            $expert_category = $query_expert_category->row();
            $article_type = $expert_category->article_types;

            $users = $this->session->userdata('logged_in');

            $data = array(
                'article_type'      => $article_type,
                'title'             => $this->input->post('title'),
                'article_keywords'  => $this->input->post('article_keywords'),
                'content'           => $this->input->post('content'),
                'education'         => $this->input->post('education'),
                'experience'        => $this->input->post('experience'),
                'publications'      => $this->input->post('publications'),
                'presentations'     => $this->input->post('presentations'),
                'others'            => $this->input->post('others'),
                'major'             => $this->input->post('major'),
                'posted_date'       => $this->input->post('posted_date'),
                'order_id'          => $this->input->post('order_id'),
                'published'         => $published,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'sub_experts'       => $eria_expert_category_id,
                'sc_id'             => $this->input->post('subcategory')[0],
                'majorEmail'        => $this->input->post('majorEmail'),
            );

            if ($img !== -1) {
                $img = "/uploads/experts/" . $img;
                $data['image_name'] = $img;
            } else {
                $data['image_name'] = $this->input->post('image');
            }

            $eria_expert_subcategory = $this->input->post('subcategory');

            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, $eria_expert_subcategory);

            $this->HistoryModel->insertHistory($id, $id, "New Expert has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert has been updated.');
                redirect('system-content/Experts/edit/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/expertlist');
            }
        }
    }

    function editPeopleEvents()
    {
        $input = $this->input->post();

        $this->form_validation->set_rules('people_id', 'people_id', 'trim|required');
        $this->form_validation->set_rules('event_id[]', 'event_id[]', 'trim|required');

        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->edit($input['people_id']);
        } else {

            $user_data = $this->session->userdata('logged_in');
            $data = [
                'people_id'     => $input['people_id'],
                'event_id'      => $input['event_id'],
                'modified_by'   => $user_data['user_id'],
            ];

            $result_event = $this->Page_model->insert_event_people($data);

            $this->HistoryModel->insertHistory($input['people_id'], $input['people_id'], "New Event For People has been Updated : ");

            if ($result_event == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert has been updated.');
                redirect('system-content/Experts/edit/' . $input['people_id']);
            } else {
                $this->session->set_flashdata('error-message', $result_event);
                redirect('system-content/Experts/expertlist');
            }
        }
    }

    function sub_catogeries()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 16, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['c_list'] = $this->Page_model->getExpert_catogeries('experts');
        $data['areaList'] = $this->Page_model->getExpertDepartement();
        
        $data['action'] = site_url('system-content/experts/createsCat');
        $data['title'] = 'Dashboard';
        $data['content'] = 'back-end/content/experts/s_catogery';
        $data['active'] = 'experts';
        $data['sub'] = 'expertssc';

        $this->load->view('back-end/common/template', $data);
    }

    function createsCat()
    {
        $input = $this->input->post();
        
        $this->form_validation->set_rules('s_catogery', 's_catogery', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->sub_catogeries();
        } else {
            $users = $this->session->userdata('logged_in');

            $data = array(
                'category_id'       => $input['category_name'],
                'name_departement'  => $input['s_catogery'],
            );

            $query = $this->Page_model->insert_departement($data);

            $this->HistoryModel->insertHistory("Sub Category", "CSub  ategory", "Experts Sub Category has been Created : " . $this->input->post('s_catogery'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Experts Sub Category has been created.');
                redirect('system-content/Experts/sub_catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/sub_catogeries');
            }
        }
    }

    function catogeries()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 16, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getExpert_catogeries('experts');

        $data['action'] = site_url('system-content/experts/createCat');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/catogery';
        $data['active'] = 'experts';
        $data['sub'] = 'expertsc';

        $this->load->view('back-end/common/template', $data);
    }

    function createCat()
    {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->catogeries();
        } else {
            $users = $this->session->userdata('logged_in');

            $data = array(
                'category' => $this->input->post('category_name'),
                'content' => $this->input->post('order_id'),
                'parent' => 'experts',
            );


            $query = $this->Page_model->insert_expertCat($data);

            $this->HistoryModel->insertHistory("Category", "Category", "Experts Category has been Created : " . $this->input->post('category_name'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Experts Category has been created.');
                redirect('system-content/Experts/catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/catogeries');
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
        
        $data['slider_row'] = $this->Page_model->getPage_expertCat($id);
        $data['areaList'] = $this->Page_model->getExpert_catogeries('experts');
        $data['action'] = site_url('system-content/Experts/editCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/catogery';
        $data['active'] = 'experts';
        $data['sub'] = 'expertsc';

        $this->load->view('back-end/common/template', $data);
    }

    function editscat($id)
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

        $data['slider_row'] = $this->Page_model->getExpertDepartementByID($id);
        $data['c_list'] = $this->Page_model->getExpert_catogeries('experts');
        $data['areaList'] = $this->Page_model->getExpertDepartement();
        $data['action'] = site_url('system-content/Experts/editsCatdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/s_catogery';
        $data['active'] = 'experts';
        $data['sub'] = 'expertssc';
        // $data['areaList'] = $this->Page_model->getExpert_subCatogeries('experts');

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
            $users = $this->session->userdata('logged_in');
            $input = $this->input->post();
            
            $data = array(
                'category_id'         => $input['category_name'],
                'name_departement'  => $input['s_catogery'],
            );

            $query = $this->Page_model->update_departement($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "New Experts Sub Catogery has been Updated : " . $this->input->post('s_catogery'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert Sub Catogery has been updated.');
                redirect('system-content/Experts/editscat/' . $id);
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/sub_catogeries');
            }
        }
    }

    function getDepartement()
    {
        $id = $this->input->post('id');

        $getRelatedDepartement = $this->Page_model->getExpertDepartementByCategoryID($id);

        if (!empty($getRelatedDepartement)) {
            foreach ($getRelatedDepartement as $value) {
                $departementIDs[] = $value->eria_departement_id;
            }

            $query = $this->Page_model->getDepartementByIDs($departementIDs);
        } else {
            $query = array();
        }

        $output = '';

        $output .= "<option value='' >--Select--</option>";

        foreach ($query as $query) {
            $output .= "<option value='" . $query->id . "' >" . $query->name . "</option>";
        }

        echo $output;
    }

    function getSub()
    {
        $id = $this->input->post('id');

        $article_type_sub = 'experts';

        $query = $this->Page_model->getSub($id, $article_type_sub);
        
        $output = '';

        $output .= "<option value='' >--Select--</option>";

        foreach ($query as $query) {
            $output .= "<option value='" . $query->es_id . "' >" . $query->s_catogery . "</option>";
        }
        
        echo $output;
    }

    function editCatdata()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->editcat($id);
        } else {
            $users = $this->session->userdata('logged_in');
            $data = array(
                'category' => $this->input->post('category_name'),
                'content' => $this->input->post('order_id'),
                'slug' => str_replace(' ', '-', strtolower($this->input->post('category_name'))),
            );
            $query = $this->Page_model->update_expertCat($id, $data);
            $this->HistoryModel->insertHistory($id, $id, "New Experts Catogery has been Updated : " . $this->input->post('category_name'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert Catogery has been updated.');
                redirect('system-content/Experts/catogeries');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/catogeries');
            }
        }
    }

    function deleteEsc()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->deleteDepartement($id);

        $this->HistoryModel->insertHistory($name, $name, "  Expert Category has been Deleted : " . $name);
        $this->session->set_flashdata('success-message', 'Expert Catogery has been deleted.');

        redirect('system-content/Experts/sub_catogeries');
        return $query;
    }

    function deleteEc()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->deleteec($id);
        $this->HistoryModel->insertHistory($name, $name, "  Expert Category has been Deleted : " . $name);
        return $query;
    }

    function deleteRese()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->deleteRese($id);
        $this->HistoryModel->insertHistory($name, $name, "  Expert  has been Deleted : " . $name);
        return $query;
    }

    function expertlist()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 18, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList_cat'] = $this->Page_model->getExpert_catogeries('experts');

        $title = $this->input->post('title');

        $article_type = ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified'];
        $data['areaList'] = $this->Page_model->getPage_expallarticle($article_type, $title); // experts

        $data['action'] = site_url('system-content/Experts/createExperts');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/list';
        $data['active'] = 'experts';
        $data['sub'] = 'expertslist';

        $this->load->view('back-end/common/template', $data);
    }

    function researchlist()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 20, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_allarticle('associates', 200);
        $data['action'] = site_url('system-content/Experts/createExperts');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/rlist';
        $data['active'] = 'experts';
        $data['sub'] = 'researchlist';
        $this->load->view('back-end/common/template', $data);
    }

    function createExperts()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('major', 'major', 'trim|required');
        $this->form_validation->set_rules('sub_experts', 'sub_experts', 'trim|required');

        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->index();
        } else {
            $img = $this->setExperts();

            if (!empty($img)) {
                $img = "/uploads/experts/" . $img;
            } else {
                $img = "/uploads/experts/person-4.png";
            }

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $eria_expert_category_id = $this->input->post('sub_experts');

            $this->db->select('*');
            $this->db->where('ec_id', $eria_expert_category_id);
            $query_expert_category = $this->db->get('eria_expert_categories');

            $expert_category = $query_expert_category->row();
            $article_type = $expert_category->article_types;

            $users = $this->session->userdata('logged_in');
            $data = array(
                'image_name' => $img,
                'title' => $this->input->post('title'),
                'uri' => str_replace(' ', '-', $this->input->post('title')),
                'article_type' => $article_type,
                'pub_type' => 3,
                'article_keywords' =>  $this->input->post('article_keywords'),
                'content' => $this->input->post('content'),
                'education' => $this->input->post('education'),
                'experience' => $this->input->post('experience'),
                'publications' => $this->input->post('publications'),
                'presentations' => $this->input->post('presentations'),
                'others' => $this->input->post('others'),
                'major' => $this->input->post('major'),
                'posted_date' =>  date('Y-m-d H:i:s'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'image_name' => $img,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s'),
                'sub_experts' => $eria_expert_category_id,
                'sc_id' => $this->input->post('sub_pexperts'),
                'majorEmail' => $this->input->post('majorEmail'),
            );

            $eria_expert_subcategory = $this->input->post('subcategory');

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, $eria_expert_subcategory);

            $this->HistoryModel->insertHistory("Article", "Article", "New Expert has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Expert has been created.');
                redirect('system-content/Experts');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts');
            }
        }
    }

    function research()
    {

        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 19, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['action'] = site_url('system-content/experts/createResearch');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/experts/research';
        $data['active'] = 'experts';
        $data['sub'] = 'research';

        $this->load->view('back-end/common/template', $data);
    }

    function createResearch()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        // $this->form_validation->set_rules('major', 'major', 'trim|required');
        // $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->research();
        } else {
            $img = $this->setResearch();
            $img = "/uploads/associates/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');
            $data = array(
                'image_name' => $img,
                'title' => $this->input->post('title'),
                'uri'               => str_replace(' ', '-', $this->input->post('title')),
                'article_type'      => 'associates',
                'pub_type'          => 3,
                'article_keywords'  => $this->input->post('article_keywords'),
                'content'           => $this->input->post('content'),
                'major'             => $this->input->post('major'),
                'posted_date'       => $this->input->post('posted_date'),
                'order_id'          => $this->input->post('order_id'),
                'published'         => $published,
                'image_name'        => $img,
                'modified_date'     => date('Y-m-d H:i:s'),
                'modified_by'       => $users['user_id'],
                'sub_experts'       => 2,
            );

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Associates has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Associates has been created.');
                redirect('system-content/Experts/research');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/Experts/research');
            }
        }
    }

    public function setExperts()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/experts';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['max_size'] = '2000000'; // in KB
        // $config['max_width'] = '145';
        // $config['max_height'] = '45';
        //$config['min_width'] = '32';
        //$config['min_height'] = '32';
        // $config['file_name'] = 'logo' . uniqid();

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

    public function setResearch()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/associates';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        //$config['max_size'] = '20000'; // in KB
        // $config['max_width'] = '145';
        // $config['max_height'] = '45';
        //$config['min_width'] = '32';
        //$config['min_height'] = '32';
        //   $config['file_name'] = 'logo' . uniqid();

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

    function publishAssociates()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishR($id, $pub);
        return $query;
    }
}