<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends CI_Controller {
 
 
 
	 public function __construct()
	{
		parent::__construct();

        $this->load->model('admin/UserModel');
        $this->load->model('admin/HistoryModel');
		$this->load->library('privilage');
        $this->load->model('admin/Profile_model', '', TRUE);


	}



    public function index()
    {

        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],46,$data_s['group_id']);

        if($pri!=TRUE)
        {
            $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            redirect('system-content/Dashboard');
        }

            $group = $this->UserModel->getAll_group();
            $data['glist']=$group;

            $query = $this->UserModel->getAll_user();
            $data['areaList']=$query;
            $data['action'] = site_url('system-content/user/createUser');
            $data['title'] = '  Dashboard';
            $data['content'] = 'back-end/content/user/index';
            $data['active'] = 'admin';
            $data['sub'] = 'index';



        $this->load->view('back-end/common/template', $data);


    }


    public function createUser() {

        $data_s=$this->session->userdata('logged_in');



        $this->form_validation->set_rules('username', 'username', 'trim|required|alpha|is_unique[users.username]');
        $this->form_validation->set_rules('n_password', 'n_password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('c_password', 'c_password', 'trim|required|matches[n_password]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('full_name', 'full_name', 'trim|required');


        $validate = $this->form_validation->run();



        if ($validate == FALSE ) {
            $this->index();

        }
        else

        {
            $query = $this->UserModel->insertUser();
            $this->HistoryModel->insertHistory($this->input->post('username'),$this->input->post('username'),"New User has been Created : ".$this->input->post('username'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Group ' . $this->input->post('username') . ' has been created.');
                redirect('system-content/User');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/User');
            }

        }

    }


    function editUser($id)
    {

        $data_s=$this->session->userdata('logged_in');

       // $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],'dashboard');

        if ($id == null) {
            $this->session->set_flashdata('warning-message', 'User Id missing');
            redirect('system-content/User');
        } else {

            $data['profile'] = $this->profile->getProfile();

            $group = $this->UserModel->getUser($id);
            $data['user_row'] = $group->row();




            $group = $this->UserModel->getAll_group();
            $data['glist']=$group;

            $query = $this->UserModel->getAll_user();
            $data['areaList']=$query;
            $data['action'] = site_url('system-content/user/editUserdata');
            $data['title'] = '  Dashboard';
            $data['content'] = 'back-end/content/user/index';
            $data['active'] = 'admin';
            $data['sub'] = 'index';
        }


        $this->load->view('back-end/common/template', $data);

    }


    public function editUserdata()
    {
        $data_s=$this->session->userdata('logged_in');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('username', 'username', 'trim|required|alpha|callback_isuserUnique');
        $this->form_validation->set_rules('email', 'email', 'trim|required|callback_isemailUnique');
        $this->form_validation->set_rules('full_name', 'full_name', 'trim|required');


        if($this->input->post('n_password')!='' || $this->input->post('c_password')!='')
        {
            $this->form_validation->set_rules('n_password', 'n_password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('c_password', 'c_password', 'trim|required|matches[n_password]');
        }


        $validate = $this->form_validation->run();


        if ($validate == FALSE) {
            $this->editUser($id);
        }

        else {
            $this->HistoryModel->insertHistory($this->input->post('username'),$this->input->post('username'),"  User has been Edited : ".$this->input->post('username'));
            $query = $this->UserModel->updateUser();
            
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Group ' . $this->input->post('username') . ' has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/user');
        }
    }




    public function group()
	{

        $data['profile'] = $this->profile->getProfile();

        $data_s=$this->session->userdata('logged_in');
        $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],47,$data_s['group_id']);

        if($pri!=TRUE)
        {
            $this->session->set_flashdata('error-message', 'Please Contact Administrator.');
            redirect('system-content/Dashboard');
        }

            $data['profile'] = $this->profile->getProfile();
            $query = $this->UserModel->getAll_group();
            $data['areaList']=$query;
            $data['action'] = site_url('system-content/user/createGroup');
			$data['title'] = '  Dashboard';
            $data['content'] = 'back-end/content/user/group';
            $data['active'] = 'admin';
			$data['sub'] = 'group';

		
			
			$this->load->view('back-end/common/template', $data);
			
			
	}



    public function createGroup() {

        $data_s=$this->session->userdata('logged_in');




        $this->form_validation->set_rules('group', 'group', 'trim|required|alpha|is_unique[user_groups.group_name]');


        $validate = $this->form_validation->run();



        if ($validate == FALSE ) {
            $this->group();

        }
        else

        {
            $query = $this->UserModel->insertGroup($data_s['user_id']);
            $this->HistoryModel->insertHistory($this->input->post('group'),$this->input->post('group'),"New User Group has been Created : ".$this->input->post('group'));
            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Group ' . $this->input->post('group') . ' has been created.');
                redirect('system-content/User/group');
            } else {
                $this->session->set_flashdata('error-message', $query);
                redirect('system-content/User/group');
            }

        }

    }



    function editGroup($id)
    {

        $data_s=$this->session->userdata('logged_in');



        if ($id == null) {
            $this->session->set_flashdata('warning-message', 'Group Id missing');
            redirect('system-content/User/group');
        } else {


            $data['profile'] = $this->profile->getProfile();
            $group = $this->UserModel->getGroup($id);
            $data['group_row'] = $group->row();
            $query = $this->UserModel->getAll_group();
            $data['areaList']=$query;
            $data['title'] = '  Dashboard - Group List';
            $data['content'] = 'back-end/content/user/group';
            $data['active'] = 'admin';
            $data['sub'] = 'group';

            $data['action'] = site_url('system-content/User/editGroup_Data');



            $this->load->view('back-end/common/template', $data);
        }

    }


    public function editGroup_Data() {

        $data_s=$this->session->userdata('logged_in');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('group', 'group', 'trim|required|alpha|callback_isUnique');


        $validate = $this->form_validation->run();



        if ($validate == FALSE) {
            $this->editGroup($id);
        }

        else {
            $this->HistoryModel->insertHistory($this->input->post('group'),$this->input->post('group'),"  User Group has been Edited : ".$this->input->post('group'));
            $query = $this->UserModel->updateGroup();

            if ($query == TRUE) {
                $this->session->set_flashdata('success-message', 'Group ' . $this->input->post('group') . ' has been updated.');
            } else {
                $this->session->set_flashdata('error-message', $query);
            }
            redirect('system-content/user/group');
        }
    }


    public function privilages($id)
    {
        $i='';
        $data_s=$this->session->userdata('logged_in');
      //  $pri = $this->privilage->login($data_s['username'],$data_s['user_id'],'9');

        $pri=TRUE;
        $data['profile'] = $this->Profile_model->getProfile();

        if($pri!=TRUE)
        {
            $data['title'] = '  Dashboard';
            $data['content'] = 'content/error';
            $data['active'] = 'user';
            $data['sub'] = 'userL';
        }
        else
        {

          //  $setprivilages = $this->UserModel->getsetAllPri($id);


            $privilages = $this->UserModel->getAllPri($id);


           // $mainUser = $this->UserModel->getUser_Details($id);

            $data['title'] = '  Dashboard - Group Privilages';
            $data['content'] = 'back-end/content/user/privilages';
            $data['active'] = 'admin';
            $data['sub'] = 'group';
            $data['priid']=$id;
            $data['cdata']=$privilages;

           // $data['muser']=$mainUser;





            //$data['setprivilages'] = $setprivilages->result();
        }
        $this->load->view('back-end/common/template', $data);



    }



    public function deleteGroup()
    {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->UserModel->deleteingGroup($id);
        $this->HistoryModel->insertHistory($name,$name,"  User Group has been Deleted : ".$name);
        return $query;
    }


    public function deleteUser()
    {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $query = $this->UserModel->deleteUser($id);
        $this->HistoryModel->insertHistory($name,$name,"  User Name has been Deleted : ".$name);
        return $query;
    }




    function isUnique($code) {
        $available = $this->UserModel->codeExists($code);
        $this->form_validation->set_message('isUnique', 'The Group Name field must contain a unique value.');
        return $available;
    }


    function isuserUnique($code) {
        $available = $this->UserModel->usernameExists($code);
        $this->form_validation->set_message('isUnique', 'The User Name field must contain a unique value.');
        return $available;
    }



    function isemailUnique($code) {
        $available = $this->UserModel->emailExists($code);
        $this->form_validation->set_message('isUnique', 'The Email field must contain a unique value.');
        return $available;
    }

    public function userprivilage(){
        $id = $this->input->post('id');
        $privilage = $this->input->post('privilage');
        $this->HistoryModel->insertHistory($privilage,$privilage,"  User Group Privilage has been Assiged : ".$id);
        $query = $this->UserModel->insertPrivilages($id,$privilage);


    }

    public function userprivilageD(){
        $id = $this->input->post('id');
        $privilage = $this->input->post('privilage');
        $this->HistoryModel->insertHistory($privilage,$privilage,"  User Group Privilage has been Removed : ".$id);
        $query = $this->UserModel->deletePrivilages($id,$privilage);


    }



}
