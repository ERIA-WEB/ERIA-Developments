<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
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
        $pri = $this->privilage->login($users['username'], $users['user_id'], 6, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();
        $slider_row = $this->Page_model->getPage_content(7);
        $slider_nrow = $this->Page_model->getPage_subcontent(1);
        $nsr = $this->Page_model->getPage_r_subcontent(1);

        $data['slider_row'] = $slider_row;
        $data['ns'] = $slider_nrow;
        $data['nsr'] = $nsr;
        $data['action'] = site_url('system-content/About/editPublic');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/index';
        $data['active'] = 'about';
        $data['sub'] = 'acontent';

        $this->load->view('back-end/common/template', $data);
    }

    function editPublic()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu_title', 'menu_title', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');

        if ($this->input->post('published')) {
            $published = 1;
        } else {
            $published = 0;
        }

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->index();
        } else {
            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'menu_title' => $this->input->post('menu_title'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'order_id' => $this->input->post('order_id'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            $newA = array(
                'discription' => $this->input->post('discription'),
                'buttonn' => $this->input->post('buttonn'),
                'lik' => $this->input->post('lik'),
                'he1' => $this->input->post('he1'),
                'he1_dis' => $this->input->post('he1_dis'),
                'he1_butt' => $this->input->post('he1_butt'),
                'he1_link' => $this->input->post('he1_link'),
                'he2' => $this->input->post('he2'),
                'he2_dis' => $this->input->post('he2_dis'),
                'he2_butt' => $this->input->post('he2_butt'),
                'he2_link' => $this->input->post('he2_link'),
                'he3' => $this->input->post('he3'),
                'he3_dis' => $this->input->post('he3_dis'),
                'he3_butt' => $this->input->post('he3_butt'),
                'he3_link' => $this->input->post('he3_link'),
                'hig_menu1' => $this->input->post('hig_menu1'),
                'hig_menu_h1' => $this->input->post('hig_menu_h1'),
                'hig_menu_b1' => $this->input->post('hig_menu_b1'),
                'hig_menu_b1_link' => $this->input->post('hig_menu_b1_link'),
                'hig_menu2' => $this->input->post('hig_menu2'),
                'hig_menu_h2' => $this->input->post('hig_menu_h2'),
                'hig_menu_b2' => $this->input->post('hig_menu_b2'),
                'hig_menu_b2_link' => $this->input->post('hig_menu_b2_link'),
            );

            $newR = array(
                'r_head' => $this->input->post('r_head'),
                'rdis' => $this->input->post('rdis'),
                'rbbutton' => $this->input->post('rbbutton'),
                'r_link' => $this->input->post('r_link'),
                'h_1' => $this->input->post('h_1'),
                'h_1_dis' => $this->input->post('h_1_dis'),
                'h_1_b' => $this->input->post('h_1_b'),
                'h_1_l' => $this->input->post('h_1_l'),
                'h_2' => $this->input->post('h_2'),
                'h_2_dis' => $this->input->post('h_2_dis'),
                'h_2_b' => $this->input->post('h_2_b'),
                'h_2_l' => $this->input->post('h_2_l'),
                'h_3' => $this->input->post('h_3'),
                'h_3_dis' => $this->input->post('h_3_dis'),
                'h_3_b' => $this->input->post('h_3_b'),
                'h_3_l' => $this->input->post('h_3_l'),
                'h_4' => $this->input->post('h_4'),
                'h_4_dis' => $this->input->post('h_4_dis'),
                'h_4_b' => $this->input->post('h_4_b'),
                'h_4_l' => $this->input->post('h_4_l'),
                'h_5' => $this->input->post('h_5'),
                'h_5_dis' => $this->input->post('h_5_dis'),
                'h_5_b' => $this->input->post('h_5_b'),
                'h_5_l' => $this->input->post('h_5_l'),
                'h_6' => $this->input->post('h_6'),
                'h_6_dis' => $this->input->post('h_6_dis'),
                'h_6_b' => $this->input->post('h_6_b'),
                'h_6_l' => $this->input->post('h_6_l'),
            );

            $this->Page_model->updateAbout(1, $newA);
            $this->Page_model->updateResearch(1, $newR);
            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "About US Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/About');
        }
    }

    function board()
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 7, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();
        $data['areaList'] = $this->Page_model->getPage_allarticle('boardmessages', 200);
        $data['action'] = site_url('system-content/About/createBo');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/board';
        $data['active'] = 'about';
        $data['sub'] = 'board';

        $this->load->view('back-end/common/template', $data);
    }

    function createBo()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->board();
        } else {
            $img = $this->setBoard();
            $img = "/uploads/boardmessages/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'boardmessages',
                'pub_type' => 0,
                'content' => $this->input->post('content'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Board Message has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Board Message has been created.');
                redirect('system-content/About/board');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/board');
            }
        }
    }

    function edit($id)
    {
        $users = $this->session->userdata('logged_in');
        $data['profile'] = $this->profile->getProfile();
        $data['areaList'] = $this->Page_model->getPage_allarticle('boardmessages', 200);
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/About/editBoard');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/board';
        $data['active'] = 'about';
        $data['sub'] = 'board';

        $this->load->view('back-end/common/template', $data);
    }

    function editBoard()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');

        $validate = $this->form_validation->run();

        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setBoard();
        }

        if ($validate == FALSE) {
            $this->edit($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                // 'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'boardmessages',
                'pub_type' => 0,
                'content' => $this->input->post('content'),
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            if ($img !== -1) {
                $img = "/uploads/boardmessages/" . $img;
                $data['image_name'] = $img;
            }

            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory($id, $id, "  Board Message has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', ' Board Message has been updated.');
                redirect('system-content/About/board');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/board');
            }
        }
    }

    function editabout($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
//            $data['title'] = '  Dashboard';
//           $data['content'] = 'content/error';
//            $data['active'] = 'privacy';
//            $data['sub'] = 'content';
//        }

        $data['areaList'] = $this->Page_model->getPage_allarticle('organizations', 200);
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/About/editOrg');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/organization';
        $data['active'] = 'about';
        $data['sub'] = 'organization';

        $this->load->view('back-end/common/template', $data);
    }


    function editOrg()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setOrg();
        }

        if ($validate == FALSE) {
            $this->editabout($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'content' => $this->input->post('content'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'organizations',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            if ($img !== -1) {
                $img = "/uploads/organizations/" . $img;
                $data['image_name'] = $img;
            }


            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory($id, $id, "  Organization has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', ' Organization has been updated.');
                redirect('system-content/About/organization');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/organization');
            }
        }
    }

    function editS($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
//            $data['title'] = '  Dashboard';
//           $data['content'] = 'content/error';
//            $data['active'] = 'privacy';
//            $data['sub'] = 'content';
//        }

        $data['areaList'] = $this->Page_model->getPage_allarticle('keystaffs', 200);
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/About/editStaff');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/staff';
        $data['active'] = 'about';
        $data['sub'] = 'staff';

        $this->load->view('back-end/common/template', $data);
    }

    function editStaff()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        $img = -1;

        if ($validate == TRUE && (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))) {
            $img = $this->setStaff();
        }

        if ($validate == FALSE) {
            $this->editS($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                'majorEmail' =>  $this->input->post('majorEmail'),
                'order_id' => $this->input->post('order_id'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'keystaffs',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            if ($img !== -1) {
                $img = "/uploads/keystaffs/" . $img;
                $data['image_name'] = $img;
            }

            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory($id, $id, "  Key Staff has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', ' Key Staff has been updated.');
                redirect('system-content/About/staff');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/staff');
            }
        }
    }

    function staff()
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 8, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();
        $data['areaList'] = $this->Page_model->getPage_allarticle('keystaffs', 200);
        $data['action'] = site_url('system-content/About/createStaff');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/staff';
        $data['active'] = 'about';
        $data['sub'] = 'staff';

        $this->load->view('back-end/common/template', $data);
    }

    function createStaff()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->staff();
        } else {
            $img = $this->setStaff();

            $img = "/uploads/keystaffs/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                'majorEmail' =>  $this->input->post('majorEmail'),
                'order_id' => $this->input->post('order_id'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'keystaffs',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "New Key Staff Message has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Key Staff has been created.');
                redirect('system-content/About/staff');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/staff');
            }
        }
    }

    function organization()
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 9, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['profile'] = $this->profile->getProfile();
        $data['areaList'] = $this->Page_model->getPage_allarticle('organizations', 200);
        $data['action'] = site_url('system-content/About/createOrg');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/organization';
        $data['active'] = 'about';
        $data['sub'] = 'organization';

        $this->load->view('back-end/common/template', $data);
    }

    function createOrg()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->organization();
        } else {
            $img = $this->setOrg();
            $img = "/uploads/organizations/" . $img;

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'image_name' => $img,
                'major' =>  $this->input->post('major'),
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'content' => $this->input->post('content'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'organizations',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "Organization has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Organization has been created.');
                redirect('system-content/About/organization');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/organization');
            }
        }
    }

    function ostructure()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 10, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['departements']   = $this->Page_model->getAllDepartementByActive();
        $data['peoples']        = $this->Page_model->getAllPeoplesByActive();
        $data['areaList']       = $this->Page_model->get_OG();
        $data['action']         = site_url('system-content/About/create_Org');
        $data['title']          = 'Dashboard';
        $data['content']        = 'back-end/content/about/orgn';
        $data['active']         = 'about';
        $data['sub']            = 'ostructure';

        $this->load->view('back-end/common/template', $data);
    }

    function getAllPeople()
    {
        $input = $this->input->post();
        $peoples = $this->Page_model->getAllPeoplesByActive();
        $output = '';
        foreach ($peoples as $value) {
            if ($value->article_id != '4101' and $value->article_id != '6563') {
                $output .= '<option value="'.$value->article_id.'">'.ucfirst($value->title).'</option>';
            }
        }

        echo $output;
    }

    function create_Org()
    {
        $this->form_validation->set_rules('departement_id', 'departement_id', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->ostructure();
        } else {
            $input = $this->input->post();
            
            $users = $this->session->userdata('logged_in');
            
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if (!empty($input['people_id'])) {

                $peoples = $input['people_id'];
            } else {
                $peoples = '';
            }

            $data = array(
                'departement_id'    => $input['departement_id'],
                'people_id'         => $peoples,
                'published'         => $published,
                'modified_date'     => date('Y-m-d h:i:s'),
                'modified_by'       => $users['user_id'],
            );

            $query = $this->Page_model->insertStructure($data);

            $this->HistoryModel->insertHistory("New Structure", "New Structure", "New Structure has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'New Structure has been created.');
                redirect('system-content/About/ostructure');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/ostructure');
            }
        }
    }

    function edit_Org($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
        // $data['title'] = '  Dashboard';
        // $data['content'] = 'content/error';
        // $data['active'] = 'privacy';
        // $data['sub'] = 'content';
        // } 

        $data['departements']   = $this->Page_model->getAllDepartementByActive();
        $data['peoples']        = $this->Page_model->getAllPeoplesByActive();
        $data['areaList'] = $this->Page_model->get_OG();
        $data['slider_row'] = $this->Page_model->get_organization($id);
        $data['action'] = site_url('system-content/About/editOrga');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/orgn';
        $data['active'] = 'about';
        $data['sub'] = 'career';

        $this->load->view('back-end/common/template', $data);
    }

    function editOrga()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('departement_id', 'departement_id', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_Org($id);
        } else {
            $input = $this->input->post();
            
            $users = $this->session->userdata('logged_in');
            
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            if (!empty($input['people_id'])) {

                $peoples = $input['people_id'];
            } else {
                $peoples = '';
            }

            $data = array(
                'departement_id'    => $input['departement_id'],
                'people_id'         => $peoples,
                'published'         => $published,
                'modified_date'     => date('Y-m-d h:i:s'),
                'modified_by'       => $users['user_id'],
            );

            $query = $this->Page_model->updateOrg($id, $data);

            $this->HistoryModel->insertHistory($id, $id, "  Structure has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Structure has been updated.');
                redirect('system-content/About/ostructure');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/ostructure');
            }
        }
    }

    function gb()
    {
        $data['profile'] = $this->profile->getProfile();
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 11, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['slider_row']             = $this->Page_model->getPage_content(10);
        $article_type                   = ['boardmessages']; // ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified'];
        $data['members']                = $this->Page_model->getMembers($article_type);

        $memberGovernBoardData = $this->Page_model->getMemberByPageID(10);

        if (isset($memberGovernBoardData) and !empty($memberGovernBoardData)) {
            foreach ($memberGovernBoardData as $member_govern) {
                $member_govern_board[] = $member_govern->article_id;
            }
        } else {
            $member_govern_board = array();
        }

        $data['member_govern_board']    = $member_govern_board;
        $data['action']                 = site_url('system-content/About/edit_Subdata');
        $data['title']                  = 'Dashboard';
        $data['content']                = 'back-end/content/about/sub_page';
        $data['active']                 = 'about';
        $data['sub']                    = 'gb';

        $this->load->view('back-end/common/template', $data);
    }

    function career()
    {
        $data['profile'] = $this->profile->getProfile();
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 12, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getPage_allarticle('careers', 200);
        $data['action'] = site_url('system-content/About/createCar');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/career';
        $data['active'] = 'about';
        $data['sub'] = 'career';

        $this->load->view('back-end/common/template', $data);
    }

    function createCar()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->career();
        } else {

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'content' => $this->input->post('content'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'careers',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            $query = $this->Page_model->insertArticle($data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory("Associates", "Associates", "Career has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Career has been created.');
                redirect('system-content/About/Career');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/Career');
            }
        }
    }

    function editCar($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // if ($pri != TRUE) {
//            $data['title'] = '  Dashboard';
//           $data['content'] = 'content/error';
//            $data['active'] = 'privacy';
//            $data['sub'] = 'content';
//        } 
        $data['areaList'] = $this->Page_model->getPage_allarticle('careers', 200);
        $data['slider_row'] = $this->Page_model->getPage_article($id);
        $data['action'] = site_url('system-content/About/editCa');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/career';
        $data['active'] = 'about';
        $data['sub'] = 'career';

        $this->load->view('back-end/common/template', $data);
    }

    function editCa()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->editCar($id);
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'content' => $this->input->post('content'),
                'uri' => str_replace(' ', '_', $this->input->post('title')),
                'article_type' => 'careers',
                'pub_type' => 0,
                'published' => $published,
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')
            );

            $query = $this->Page_model->updateArticle($id, $data, null, null, null, null, null, null, null, null, null, null, null);

            $this->HistoryModel->insertHistory($id, $id, "  Career has been Updated : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Career has been updated.');
                redirect('system-content/About/Career');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/Career');
            }
        }
    }

    function subpage()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 13, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['action'] = site_url('system-content/About/createSub');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/subpage';
        $data['active'] = 'about';
        $data['sub'] = 'subpage';

        $this->load->view('back-end/common/template', $data);
    }
    

    function edit_subpage($id)
    {
        $users = $this->session->userdata('logged_in');
        $data['profile'] = $this->profile->getProfile();
        $data['slider_row'] = $this->Page_model->getPage_content($id);
        $data['action'] = site_url('system-content/About/editSubdata');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/subpage';
        $data['active'] = 'about';
        $data['sub'] = 'subpage';

        $this->load->view('back-end/common/template', $data);
    }

    function subpagechild()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 13, $users['group_id']);

        $data['parent_data'] = array();
        $data['page_parent'] = $this->Page_model->getAllPageByParentID(7);
        $data['action'] = site_url('system-content/About/createSubChild');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/subpagechild';
        $data['active'] = 'about';
        $data['sub'] = 'subpagechild';

        $this->load->view('back-end/common/template', $data);

    }

    function createSubChild()
    {
        $input = $this->input->post();
        $users = $this->session->userdata('logged_in');
        
        if (isset($input['published'])) {
            $published = $input['published'];
        } else {
            $published = 0;
        }

        $data = [
            'page_id'   => $input['page_id'],
            'uri'       => str_replace(' ', '-', strtolower($input['menu_title'])),
            'menu_title'    => $input['menu_title'],
            'title'         => $input['title'],
            'content'       => $input['content'],
            'order_id'      => $input['order_id'],
            'published'     => $published,
            'meta_keywords'     => $input['meta_keywords'],
            'meta_description'  => $input['meta_description'],
            'modified_date'     => date('Y-m-d H:i:s'),
            'modified_by'       => $users['user_id'],
        ];
        
        $result = $this->Page_model->create_submenu_child($data);

        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Submenu page has been updated.');
            redirect('system-content/About/listsubpagechild');
        } else {
            $this->session->set_flashdata('error-message', $result);
            redirect('system-content/About/listsubpagechild');
        }
    }

    function editsubchildpage($id)
    {
        $users = $this->session->userdata('logged_in');
        $data['profile'] = $this->profile->getProfile();

        $submenu_data = $this->Page_model->getSubMenuPageChildById($id);

        $data['parent_data'] = $this->Page_model->getSubPagesById($submenu_data->page_id);
        $data['slider_row'] = $submenu_data;
        $data['page_parent'] = $this->Page_model->getAllPageParents();
        $data['action'] = site_url('system-content/About/updatesubchildpage');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/subpagechild';
        $data['active'] = 'about';
        $data['sub'] = 'subpagechild';

        $this->load->view('back-end/common/template', $data);
    }

    function updatesubchildpage()
    {
        $input = $this->input->post();
        $users = $this->session->userdata('logged_in');
        
        if (isset($input['published'])) {
            $published = $input['published'];
        } else {
            $published = 0;
        }

        $id = $input['id'];
        $data = [
            'page_id'   => $input['page_id'],
            'menu_title'    => $input['menu_title'],
            'title'         => $input['title'],
            'content'       => $input['content'],
            'order_id'      => $input['order_id'],
            'published'     => $published,
            'meta_keywords'     => $input['meta_keywords'],
            'meta_description'  => $input['meta_description'],
            'modified_date'     => date('Y-m-d H:i:s'),
            'modified_by'       => $users['user_id'],
        ];

        $result = $this->Page_model->update_submenu_child($id, $data);
        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', ' Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $result);
        }

        redirect('system-content/About/editsubchildpage/' . $id);
    }

    function publishR()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishSubPageChild($id, $pub);
        return $query;
    }

    function editSubdata()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('content', 'content', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->gb();
        } else {

            if (!empty($this->input->post('published'))) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'content'               => $this->input->post('content'),
                'menu_title'            => $this->input->post('menu_title'),
                'title'                 => $this->input->post('title'),
                'published'             => $this->input->post('published'),
                'meta_keywords'         => $this->input->post('meta_keywords'),
                'meta_description'      => $this->input->post('meta_description'),
                'order_id'              => $this->input->post('order_id'),
                'published'             => $published,
                'meta_keywords'         => $this->input->post('meta_keywords'),
                'meta_description'      => $this->input->post('meta_description'),
            );

            $query = $this->Page_model->updatePage($id, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', ' Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/About/edit_subpage/' . $id);
        }
    }

    function edit_Subdata()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->gb();
        } else {
            $users = $this->session->userdata('logged_in');
            $newBranch = array(
                'content' => $this->input->post('content'),
            );

            
            $query = $this->Page_model->updatePage(10, $newBranch);

            $this->HistoryModel->insertHistory($id, $id, "Governing Board Content has been Edited");
            if ($query == TRUE) {

                $this->db->where('page_id', 10);
                $this->db->delete('members');

                foreach ($this->input->post('member_id') as $member) {

                    $member_data = [
                        'page_id'   => '10',
                        'article_id'    => $member,
                        'created'       => date('Y-m-d H:i:s'),
                        'updated'       => date('Y-m-d H:i:s'),
                    ];

                    $this->Page_model->createMemberGovernBoard($member_data);
                }
                
                $this->session->set_flashdata('success-message', 'Governing Board Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/About/gb');
        }
    }

    function createSub()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->subpage();
        } else {

            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'menu_title' => $this->input->post('menu_title'),
                'title' => $this->input->post('title'),
                'order_id' => $this->input->post('order_id'),
                'content' => $this->input->post('content'),
                'uri' => str_replace(' ', '-', $this->input->post('title')),
                'template' => 'page',
                'parent_id' => 7,
                'published' => $published,
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'modified_by' => $users['user_id'],
                'modified_date' => date('Y-m-d H:i:s')

            );

            $query = $this->Page_model->insertPage($data);

            $this->HistoryModel->insertHistory("Associates", "Associates", "Sub Page has been Created : " . $this->input->post('title'));

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Sub Page has been created.');
                redirect('system-content/About/listsubpage');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/About/listsubpage');
            }
        }
    }

    function listsubpage()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 60, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['areaList'] = $this->Page_model->getSub_pages(7);
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/listsubpage';
        $data['active'] = 'about';
        $data['sub'] = 'lsubpage';

        $this->load->view('back-end/common/template', $data);
    }

    function listsubpagechild()
    {
        $data['profile'] = $this->profile->getProfile();

        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 60, $users['group_id']);

        $data['areaList'] = $this->Page_model->getSubChildPages();
        $data['_getAllSubPage'] = $this->Page_model->_getAllSubPage();
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/about/listsubchildpage';
        $data['active'] = 'about';
        $data['sub'] = 'listsubpagechild';

        $this->load->view('back-end/common/template', $data);
    }

    function pdf()
    {
        // file name
        $filename = $_FILES['file']['name'];

        $location = 'uploads/' . $filename;
        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        // Valid image extensions
        $image_ext = array("jpg", "png", "jpeg", "gif", "pdf");
        $pdf_dis = $_POST['pdf_dis'];
        $aid = $_POST['aid'];
        $ptype = $_POST['ptype'];
        $pdf_title = $_POST['pdf_title'];

        $data = array(
            'heading' => $pdf_title,
            'pdf' => $location,
            'page_id' => $aid,
        );

        $query = $this->Page_model->insert_govPdf($data);

        $response = 0;
        if (in_array($file_extension, $image_ext)) {
            // Upload file
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $response = $location;
            }
        }

        echo $response;
    }

    function viewPdf()
    {
        $id = $this->input->post('id');
        $details = $this->Page_model->view_pagePdf($id);
        echo json_encode($details);
    }

    function deletepdf()
    {
        $pid = $this->input->post('pid');
        $details = $this->Page_model->del_PDF($pid);
        echo json_encode($details);
    }

    public function setBoard()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/boardmessages';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        //$config['max_size'] = '20000'; // in KB
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

    public function setStaff()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/keystaffs';
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

    public function setOrg()
    {
        //upload and update the file
        $config['upload_path'] = './uploads/organizations';
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

    function deleter()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleter($id);
        return $query;
    }

    function deleteorg()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleteorg($id);
        return $query;
    }

    function deletePage()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deletePage($id);
        return $query;
    }

    function deleteSubPageChild()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->deleteSubPageChild($id);
        return $query;
    }

    function publishO()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub'); // 1
        $query = $this->Page_model->publishO($id, $pub);

        return $query;
    }

    function publish_sub()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishSubPage($id, $pub);
        return $query;
    }
}