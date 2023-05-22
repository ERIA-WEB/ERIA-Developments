<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('admin/AuthenticationModel');
        $this->load->model('admin/HistoryModel');
    }

    function index() {
		$data['title']="Login Page";
		$data['error']='';
		$data['message']='';
		
        $this->load->view('back-end/content/login_new',$data);
		//$this->load->view('development');
    }

    function validate() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->index();
			
        } else {
            //query the database
            $result = $this->AuthenticationModel->login();

            if (isset($result['authentication']) && $result['authentication'] == TRUE) {
                
				$data['user_id'] = $result['user_id'];
                $data['username'] = $result['username'];
                $data['email'] = $result['email'];
				$data['full_name'] = $result['full_name'];
				$data['group_id'] = $result['group_id'];
                $data['is_logged_in'] = TRUE;
                $data['edit'] = $result['edit'];
                $data['delete'] = $result['delete'];
                $data['main_privilages']=$result['main_privilages'];
                $data['sub_privilages']=$result['sub_privilages'];

                $_SESSION["admin_user"]['username'] = $result['user_id'];
                $this->HistoryModel->insertHistory($result['username'], $result['username'], $result['username'] . "Loged in to the System");
				$this->session->set_userdata('logged_in',$data);
                redirect('system-content/dashboard');
				
            } elseif (isset($result['authentication']) && $result['authentication'] == FALSE) {
                $this->session->set_flashdata('error-message', 'Your account is not active');
                $this->HistoryModel->insertHistory($this->input->post('username'),$this->input->post('username'),$this->input->post('username')."Loged in to the System with Wrong Password");
                redirect('system-content/login');
            } elseif (!isset($result['authentication']) && is_null($result)) {
                $this->session->set_flashdata('error-message', 'Invalid Username or Password');
                $this->HistoryModel->insertHistory($this->input->post('username'),$this->input->post('username'),$this->input->post('username')."Loged in to the System with Wrong Password");
                redirect('system-content/login');
            }
        }
    }

    function forgot_password()
    {
        $this->form_validation->set_rules('forgot_email', 'forgot_email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {} 
        else {
            $result = $this->AuthenticationModel->forgot();
            
            if ($result) {
                $this->session->set_flashdata('success-message', 'Please Check your email, Password has been Send ...  ');
                redirect('system-content/login');
            } else {
                $this->session->set_flashdata('error-message', 'Invalid Email');
                redirect('system-content/login');
            }
        }
    }
}