<?php

use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

class Card extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/HistoryModel');
        $this->load->library('privilage');
        $this->load->model('admin/Card_model', '', TRUE);
        $this->load->model('admin/Page_model', '', TRUE);
    }

    public function assignCard($id)
    {
        if ($id == 1) {
            $data['profile'] = $this->profile->getProfile();
            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 51, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
            $data['sub'] = 'addc1';
            $data['active'] = 'home';
        }

        if ($id == 2) {
            $data['sub'] = 'addc2';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'research';

            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 52, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }
        if ($id == 3) {
            $data['sub'] = 'addc3';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'research';

            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 53, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }
        if ($id == 4) {
            $data['sub'] = 'addc4';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'card';

            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 54, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }
        if ($id == 5) {
            $data['sub'] = 'addc5';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'card';
            
            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 55, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }

        if ($id == 6) {
            $data['sub'] = 'addc6';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'research';

            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 56, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }

        if ($id == 7) {
            $data['sub'] = 'addc7';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'news';

            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 57, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }

        if ($id == 8) {
            $data['sub'] = 'addc8';
            $data['profile'] = $this->profile->getProfile();
            $data['active'] = 'mnews';
            $users = $this->session->userdata('logged_in');
            $pri = $this->privilage->login($users['username'], $users['user_id'], 58, $users['group_id']);

            // if ($pri != TRUE) {
            //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            //     redirect('system-content/Dashboard');
            // }
        }

        $data['contentData'] = $this->Card_model->getPage_inside_card($id);
        $data['card'] = $this->Card_model->getAll_a_card($id); // 
        $data['action'] = site_url('system-content/Card/editsub_inside');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/assig_cart';
        

        $this->load->view('back-end/common/template', $data);
    }

    public function assignCard_article($id)
    {
        $data['profile'] = $this->profile->getProfile();
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 57, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['cardD'] = $this->Card_model->getAll_article($id);
        
        $data['card'] = $this->Card_model->getAll_article_card($id);
        $data['action'] = site_url('system-content/Card/editsub_inside');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/assig_article_cart';
        $data['active'] = 'research';
        $data['sub'] = 'lpublication';
        $this->load->view('back-end/common/template', $data);
    }

    function editsub_inside()
    {
        $id = $this->input->post('id');
        $validate = TRUE;
        if ($validate == FALSE) {
            $this->assignCard($id);
        } else {
            // var_dump($this->input->post('topics'));
            $card = implode(',', $this->input->post('topics'));
            // var_dump($card);
            // die;
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'card' => $card,
            );

            $query = $this->Card_model->update_inside_card($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card/assignCard/' . $id);
        }
    }

    public function index()
    {
        $data['profile'] = $this->profile->getProfile();
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 50, $users['group_id']);

        // if ($pri != TRUE) {
        //     $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
        //     redirect('system-content/Dashboard');
        // }

        $data['card'] = $this->Card_model->getAll_card();
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/index';
        $data['active'] = 'card';
        $data['sub'] = 'addc';

        $this->load->view('back-end/common/template', $data);
    }

    public function randoms()
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 50, $users['group_id']);
        
        $data['pages'] = $this->Card_model->getAllPages();
        $data['card'] = $this->Card_model->getAllCardRandom();
        $data['card_files'] = $this->Card_model->getAllCardRandomByTypeCard('files');
        $data['card_images'] = $this->Card_model->getAllCardRandomByTypeCard('images');
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/random_cards';
        $data['active'] = 'card';
        $data['sub'] = 'random_card';
        
        $this->load->view('back-end/common/template', $data);
    }

    function create_card()
    {
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/create_card';
        $data['active'] = 'card';
        $data['sub'] = 'addc';

        $this->load->view('back-end/common/template', $data);
    }

    function create_card_randoms()
    {
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/randoms/create_card_random';
        $data['active'] = 'card';
        $data['sub'] = 'random_card';

        $this->load->view('back-end/common/template', $data);
    }

    function insert_card_random()
    {
        $users = $this->session->userdata('logged_in');
        $input = $this->input->post();
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('link_image', 'link_image', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            return redirect(base_url() . '/system-content/card/randoms');
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }
            
            $data = array(
                'ref'               => $input['title'],
                'c_name'            => $input['title'],
                'headinng'          => $input['title'],
                'headinng'          => $input['link_image'],
                'sub_heading'       => null,
                'published'         => $published,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'path'              => 'front-end/common/',
                'file'              => 'card-image.php',
                'is_delete'         => 2
            );
            
            if (file_exists($_FILES['file_card']['tmp_name']) || is_uploaded_file($_FILES['file_card']['tmp_name'])) {
                $time = time();
                $file = $this->uploadFileCardRandoms($time);

                $data['content'] = 'uploads/card_randoms/'.$file;
            }
            
            $result = $this->Card_model->insert_card_random($data);
            
            if ($result) {
               $this->session->set_flashdata('success-message', 'Card has been updated.');
                redirect('system-content/card/randoms');
            } else {
                $this->session->set_flashdata('error-message', $query_update);
                redirect('system-content/card/create_card_randoms');
            }
        }
    }

    function insert_card()
    {
        $input = $this->input->post();

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();


        if ($validate == FALSE) {
            return redirect(base_url() . '/system-content/card');
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $users = $this->session->userdata('logged_in');

            if (isset($input['template_content'])) {
                $template_content = $input['template_content'];
            } else {
                $template_content = null;
            }

            $data = array(
                'ref'               => $input['title'],
                'c_name'            => $input['title'],
                'published'         => $published,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'template'          => $template_content,
            );

            $resultID = $this->Card_model->insert_card($data);

            if ($resultID > 0) {

                $data_updated = array();

                $file = -1;
                if (file_exists($_FILES['file_card']['tmp_name']) || is_uploaded_file($_FILES['file_card']['tmp_name'])) {
                    $file = $this->uploadFile($resultID);
                }

                $data_updated = array(
                    'path' => 'front-end/common/',
                );

                if ($file !== -1) {
                    $data_updated['file'] = $file;
                }

                if (!empty($this->input->post('template_content'))) {
                    $data_updated['template'] = $this->input->post('template_content');
                } else {
                    $data_updated['template'] = '';
                }

                $query_update = $this->Card_model->update_card($resultID, $data_updated);

                if ($query_update == TRUE) {
                    $this->session->set_flashdata('success-message', 'Card has been updated.');
                    redirect('system-content/card');
                } else {
                    $this->session->set_flashdata('error-message', $query_update);
                    redirect('system-content/card');
                }
            }
        }
    }

    function edit_card($id)
    {
        $data['profile'] = $this->profile->getProfile();

        if (!empty($this->Card_model->getOneCard($id))) {
            $cards = $this->Card_model->getOneCard($id)[0];
        } else {
            $cards = array();
        }

        $data['cards'] = $cards;
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/edit_card';
        $data['active'] = 'card';
        $data['sub'] = 'addc';

        $this->load->view('back-end/common/template', $data);
    }

    function edit_card_randoms()
    {
        $users = $this->session->userdata('logged_in');
        $pri = $this->privilage->login($users['username'], $users['user_id'], 50, $users['group_id']);

        $input = $this->input->post();

        
        $data = [
            'page_id'   => $input['pages'],
            'card_id'   => $input['card_id'],
        ];

        $query = $this->Card_model->update_card_randoms_pages($data);
        
        $this->HistoryModel->insertHistory($input['card_id'], $input['card_id'], "Card  Content has been Edited");
        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Pages has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }

        redirect('system-content/card/randoms');
    }

    function update_card_randoms()
    {
        $input = $this->input->post();

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            return redirect(base_url() . '/system-content/card/randoms');
        } else {
            if (isset($input['published'])) {
                $published = 1;
            } else {
                $published = 0;
            }

            if (isset($input['template_content'])) {
                $template_content = $input['template_content'];
            } else {
                $template_content = null;
            }

            $file = -1;
            if (isset($_FILES['file_card']) and file_exists($_FILES['file_card']['tmp_name']) || is_uploaded_file($_FILES['file_card']['tmp_name'])) {
                $file = $this->uploadFile($input['id']);
            } else {
                if (isset($input['file_card_old'])) {
                    $file = $input['file_card_old'];
                } else {
                    $file = null;
                }
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'c_name'            => $input['title'],
                'published'         => $published,
                'modified_date'     => date('Y-m-d H:i:s'),
                'modified_by'       => $users['user_id'],
                'path'              => 'front-end/common/',
                'file'              => $file,
                'template'          => $template_content,
                'sorted'            => $input['sorted'],
            );

            $query = $this->Card_model->update_card_randoms($input['id'], $data);

            $this->HistoryModel->insertHistory($input['id'], $input['id'], "Card  Content has been Edited");

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/card/edit_random_card_sub/'.$input['id']);
        }
    }
    
    function update_card_random()
    {
        $users = $this->session->userdata('logged_in');
        $input = $this->input->post();
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('link_image', 'link_image', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            return redirect(base_url() . '/system-content/card/edit_random/11');
        } else {
            if ($this->input->post('published')) {
                $published = 1;
            } else {
                $published = 0;
            }

            $data = array(
                'ref'               => $input['title'],
                'c_name'            => $input['title'],
                'headinng'          => $input['title'],
                'headinng'          => $input['link_image'],
                'sub_heading'       => null,
                'published'         => $published,
                'modified_by'       => $users['user_id'],
                'modified_date'     => date('Y-m-d H:i:s'),
                'is_delete'         => 2
            );            

            if (file_exists($_FILES['file_card']['tmp_name']) || is_uploaded_file($_FILES['file_card']['tmp_name'])) {
                $time = time();
                $file = $this->uploadFileCardRandoms($time);

                $data['content'] = 'uploads/card_randoms/'.$file;
            } else {
                $data['content'] = $input['file_card_old'];
            }
            
            $result = $this->Card_model->update_card_random($input['id'], $data);

            if ($result) {
               $this->session->set_flashdata('success-message', 'Card has been updated.');
                redirect('system-content/card/edit_random/'.$input['id']);
            } else {
                $this->session->set_flashdata('error-message', $query_update);
                redirect('system-content/card/edit_random/'.$input['id']);
            }
        }
    }

    function update_card()
    {
        $input = $this->input->post();

        $this->form_validation->set_rules('title', 'title', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            return redirect(base_url() . '/system-content/card');
        } else {
            if (isset($input['published'])) {
                $published = 1;
            } else {
                $published = 0;
            }

            if (isset($input['template_content'])) {
                $template_content = $input['template_content'];
            } else {
                $template_content = null;
            }

            $file = -1;
            if (isset($_FILES['file_card']) and file_exists($_FILES['file_card']['tmp_name']) || is_uploaded_file($_FILES['file_card']['tmp_name'])) {
                $file = $this->uploadFile($input['id']);
            } else {
                if (isset($input['file_card_old'])) {
                    $file = $input['file_card_old'];
                } else {
                    $file = null;
                }
            }

            $users = $this->session->userdata('logged_in');

            $data = array(
                'c_name'            => $input['title'],
                'published'         => $published,
                'modified_date'     => date('Y-m-d H:i:s'),
                'modified_by'       => $users['user_id'],
                'path'              => 'front-end/common/',
                'file'              => $file,
                'template'          => $template_content,
            );

            $query = $this->Card_model->update_card($input['id'], $data);

            $this->HistoryModel->insertHistory($input['id'], $input['id'], "Card  Content has been Edited");

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/card');
        }
    }

    function uploadFileCardRandoms($id)
    {
        //upload and update the file
        $config['upload_path'] = './uploads/card_randoms';
        $config['allowed_types'] = '*'; // gif|jpg|jpeg|png|bmp|PNG|JPG|jfif|JFIF
        $config['overwrite'] = FALSE;
        $config['file_name'] = 'card_random_' . $id;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('file_card')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }
        
        return $imgName;
    }

    function uploadFile($id)
    {
        //upload and update the file
        $config['upload_path'] = './application/views/front-end/common';
        $config['allowed_types'] = '*'; // application/octet-stream|php|text/html
        $config['overwrite'] = TRUE;
        // $config['remove_spaces'] = true;
        $config['file_name'] = 'card_' . $id;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $imgName = '';

        if (!is_dir($config['upload_path'])) {
            $this->session->set_flashdata('msg', "The upload directory does not exist.");
            $imgName = FALSE;
        } elseif (!$this->upload->do_upload('file_card')) {
            $msg = $this->upload->display_errors();
            $this->session->set_flashdata('msg', $msg);
            $imgName = FALSE;
        } else {
            $imgName = $this->upload->data('file_name');
        }
        
        return $imgName;
    }

    function edit_random($id) {
        $data['profile'] = $this->profile->getProfile();

        if (!empty($this->Card_model->getOneCardRandom($id))) {
            $cards = $this->Card_model->getOneCardRandom($id)[0];
        } else {
            $cards = array();
        }

        $data['cards'] = $cards;
        $data['title'] = '  Dashboard';
        $data['content'] = 'back-end/content/card/randoms/edit_card_random';
        $data['active'] = 'card';
        $data['sub'] = 'random_card';

        $this->load->view('back-end/common/template', $data);
    } 
      
    function edit_random_card_sub($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        // ['2', '3', '4', '5', '6', '7', '81']
        $page_ids = $this->privilage->getPageAction($id);
        
        foreach ($page_ids as $value) {
            $card_ids[] = $value['card_id'];
        }

        if (in_array($id, $card_ids)) {
            foreach ($page_ids as $key => $value) {
                
                if ($value['card_id'] == $id) {
                    $data['areaList'] = $value['areaList'];
                    $data['contentData'] = $value['contentData'];
                    $data['action'] = $value['action'];
                    $data['content'] = $value['content'];
                } 
                
            }
        } else {
            if (!empty($this->Card_model->getOneCardRandom($id))) {
                $cards = $this->Card_model->getOneCardRandom($id)[0];
            } else {
                $cards = array();
            }

            $data['cards'] = $cards;
            $data['action'] = site_url('system-content/card/update_card_randoms');
            $data['content'] = 'back-end/content/card/randoms/edit-card-randoms';
        }

        $data['title'] = '  Dashboard';
        $data['active'] = 'card';
        $data['sub'] = 'card_randoms';
        
        $this->load->view('back-end/common/template', $data);
    }

    function edit_sub($id)
    {
        $users = $this->session->userdata('logged_in');

        $pri = $this->privilage->login($users['username'], $users['user_id'], 'dashboard', $users['group_id']);

        $data['profile'] = $this->profile->getProfile();

        if ($pri != TRUE) {
            $data['title'] = '  Dashboard';
            $data['content'] = 'content/error';
            $data['active'] = 'events';
            $data['sub'] = 'cat';
        } else {
            if ($id == 1) {
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editCard');
                $data['content'] = 'back-end/content/Card/sub';
            } else if ($id == 2) {
                $data['areaList'] = $this->Page_model->getPage_allarticle('news', 200)->result();
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editCardnews');
                $data['content'] = 'back-end/content/Card/news_sub';
            } else if ($id == 3) {
                $data['areaList'] = $this->Page_model->getMultimediaByCategory('multimedia');
                // $data['areaList'] = $this->Page_model->getPage_allarticle('multimedia', 200)->result();
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editCardm');
                $data['content'] = 'back-end/content/Card/multi_sub';
            } else if ($id == 4) {
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editCardsub');
                $data['content'] = 'back-end/content/Card/sub_sub';
            } else if ($id == 5) {
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editOtherTopics');
                $data['content'] = 'back-end/content/Card/top_sub';
                // $data['action'] = site_url('system-content/Card/editCardtop');
                
            } else if ($id == 6) {
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editCardtop');
                $data['content'] = 'back-end/content/Card/top_sub';
            } else if ($id == 7) {
                $data['contentData'] = $this->Card_model->getPage_card($id);
                $data['action'] = site_url('system-content/Card/editsub_heading');
                $data['content'] = 'back-end/content/Card/so_sub';
            } else {
                if (!empty($this->Card_model->getOneCard($id))) {
                    $cards = $this->Card_model->getOneCard($id)[0];
                } else {
                    $cards = array();
                }

                $data['cards'] = $cards;
                $data['action'] = site_url('system-content/card/update_card');
                $data['content'] = 'back-end/content/card/edit_card';
            }

            $data['title'] = '  Dashboard';
            $data['active'] = 'card';
            $data['sub'] = 'addc';
        }
        $this->load->view('back-end/common/template', $data);
    }

    function editsub_heading()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');
        $this->form_validation->set_rules('headinng', 'headinng', 'trim|required');
        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'headinng' => $this->input->post('home_title'),
                'sub_heading' => $this->input->post('headinng'),
            );

            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card');
        }
    }

    function editCardRandomRelatedCategories()
    {
        $id = $this->input->post('id');

        $users = $this->session->userdata('logged_in');
        $newCard = array(
            'c_name'        => $this->input->post('home_title'),
            'sub_heading'   => implode(', ', $this->input->post('sub_heading')),
            'content'       => implode(', ', $this->input->post('sub_heading')),
            'sorted'        => $this->input->post('sorted'),
        );
        
        $query = $this->Card_model->updateCardRandoms($id, $newCard);

        $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }
        redirect('system-content/card/edit_random_card_sub/'.$id);
    }
    
    function editCardtop()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');
        $this->form_validation->set_rules('headinng', 'headinng', 'trim|required');

        $validate = $this->form_validation->run();
        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'c_name' => $this->input->post('home_title'),
                'sub_heading' => implode(', ', $this->input->post('sub_heading')),
                'content' => implode(', ', $this->input->post('sub_heading')),
            );
            
            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card');
        }
    }

    function editCardsub()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');
        $this->form_validation->set_rules('headinng', 'headinng', 'trim|required');
        $this->form_validation->set_rules('sub_heading', 'sub_heading', 'trim|required');
        $this->form_validation->set_rules('button', 'button', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'c_name' => $this->input->post('home_title'),
                'headinng' => $this->input->post('headinng'),
                'sub_heading' => $this->input->post('sub_heading'),
                'content' => $this->input->post('button'),
            );

            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card');
        }
    }

    function editCardRandomMultimedia()
    {
        $id = $this->input->post('id');

        $sub_heading = implode(',', $this->input->post('topics'));
        $users = $this->session->userdata('logged_in');
        $newCard = array(
            'c_name'        => $this->input->post('home_title'),
            'sub_heading'   => $sub_heading,
            'sorted'        => $this->input->post('sorted'),
        );
        
        $query = $this->Card_model->updateCardRandoms($id, $newCard);

        $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }
        redirect('system-content/card/edit_random_card_sub/'.$id);
    }

    function editCardm()
    {

        $id = $this->input->post('id');

        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            // echo "<pre>";
            // print_r($this->input->post('topics'));
            // exit();
            $sub_heading_data = $this->input->post('topics');
            
            foreach ($sub_heading_data as $value) {
                if (!empty($value)) {
                    $subheading[] = $value;
                }
            }
            
            if (!empty($subheading)) {
                $sub_heading = implode(',', $subheading);
            } else {
                $sub_heading = Null;
            }
            
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'c_name' => $this->input->post('home_title'),
                'sub_heading' => $sub_heading,
            );
            
            
            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card');
        }
    }

    function editCardRandomLatesNews()
    {
        $id = $this->input->post('id');
        $sub_heading = implode(',', $this->input->post('topics'));
        $users = $this->session->userdata('logged_in');
        $newCard = array(
            'c_name'        => $this->input->post('home_title'),
            'headinng'      => $this->input->post('headinng'),
            'sub_heading'   => $sub_heading,
            'sorted'        => $this->input->post('sorted'),
        );

        $query = $this->Card_model->updateCardRandoms($id, $newCard);

        $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
        if ($query == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }

        redirect('system-content/card/edit_random_card_sub/'.$id);
    }

    function editCardnews()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');
        $this->form_validation->set_rules('headinng', 'headinng', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            $sub_heading = implode(',', $this->input->post('topics'));
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'c_name' => $this->input->post('home_title'),
                'headinng' => $this->input->post('headinng'),
                'sub_heading' => $sub_heading,
            );

            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }

            redirect('system-content/Card');
        }
    }

    function editCardRandomQuicklinks()
    {
        $input = $this->input->post();
        
        $id = $input['id'];
        $sub_heading = implode(', ', $input['sub_heading']);
        $data = [
            'ref'           => $input['home_title'],
            'c_name'        => $input['home_title'],
            'headinng'      => NULL,
            'sub_heading'   => $sub_heading,
            'sorted'        => $this->input->post('sorted'),
        ];

        $result = $this->Card_model->updateCardRandoms($id, $data);

        $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }

        redirect('system-content/card/edit_random_card_sub/'. $id);
    }

    function editOtherTopics()
    {
        $input = $this->input->post();
        
        $id = $input['id'];
        $sub_heading = implode(', ', $input['sub_heading']);
        $data = [
            'ref'           => $input['home_title'],
            'c_name'        => $input['home_title'],
            'headinng'      => NULL,
            'sub_heading'   => $sub_heading,
        ];

        $result = $this->Card_model->updateCard($id, $data);

        $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
        if ($result == TRUE) {
            $this->session->set_flashdata('success-message', 'Card Content has been updated.');
        } else {
            $this->session->set_flashdata('error-message', $query);
        }

        redirect('system-content/card/edit_sub/'. $id);
    }

    function editCard()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('home_title', 'home_title', 'trim|required');
        $this->form_validation->set_rules('headinng', 'headinng', 'trim|required');
        $this->form_validation->set_rules('sub_heading', 'sub_heading', 'trim|required');
        $this->form_validation->set_rules('button', 'button', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            $this->edit_sub($id);
        } else {
            $users = $this->session->userdata('logged_in');
            $newCard = array(
                'c_name' => $this->input->post('home_title'),
                'headinng' => $this->input->post('headinng'),
                'sub_heading' => $this->input->post('sub_heading'),
                'button' => $this->input->post('button'),
            );

            $query = $this->Card_model->updateCard($id, $newCard);

            $this->HistoryModel->insertHistory($id, $id, "Cart  Content has been Edited   ");
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Card Content has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/Card');
        }
    }

    function assignCart()
    {
        $id = $this->input->post('id');
        $page = $this->input->post('page');
        $num = $this->input->post('num');
        $emptyChq = $this->Card_model->assignCart($id, $page, $num);
        echo json_encode($emptyChq);
    }

    function assign_Cart()
    {
        $id = $this->input->post('id');
        $page = $this->input->post('page');
        $num = $this->input->post('num');
        $emptyChq = $this->Card_model->assign_Cart($id, $page, $num);
        
        echo json_encode($emptyChq);
    }

    function publishR()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishRCard($id, $pub);
        return $query;
    }

    function publishRandom()
    {
        $id = $this->input->post('id');
        $pub = $this->input->post('pub');
        $query = $this->Page_model->publishCardRandom($id, $pub);
        return $query;
    }

    function deleteRese()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->deleteCardRese($id);
        $this->HistoryModel->insertHistory($name, $name, "  Card  has been Deleted : " . $name);
        return $query;
    }

    function deleteCardRandoms()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->Page_model->deleteCardRandom($id);
        $this->HistoryModel->insertHistory($name, $name, "  Card  has been Deleted : " . $name);
        return $query;
    }
}