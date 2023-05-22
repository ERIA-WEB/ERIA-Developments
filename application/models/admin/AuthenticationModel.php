<?php

Class AuthenticationModel extends CI_Model {

	    function __construct() {
        parent::__construct();

            $this->load->model('admin/UserModel');


    }
	
    function login() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('passwd', md5($this->input->post('password')));
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {


            $row=$query->row();

                $userId = $row->user_id;
                $user = $row->username;
                $email = $row->email;
				$full_name = $row->full_name;
				$group_id = $row->group_id;

                $group = $this->UserModel->getGroup($group_id)->row();

                $main_privilages=$this->get_Main_Privilages($group_id);
                $data['main_privilages'] = $main_privilages;

                $sub_privilages=$this->get_Sub_Privilages($group_id);
                $data['sub_privilages'] = $sub_privilages;

                $data['edit'] = $group->edit;
                $data['delete'] = $group->delete;

                $data['authentication'] = TRUE;
                $data['user_id'] = $userId;
                $data['username'] = $user;
                $data['email'] = $email;
				$data['full_name'] = $full_name;
				$data['group_id'] = $group_id;

                return $data;
				
            } else {
                $data['authentication'] = FALSE;
                return $data;
            }
        }


    function get_Main_Privilages($groupId)
    {


        $this->db->distinct('privilages.mpname');

        $this->db->select('mpname');
        $this->db->join('group_privilage', 'group_privilage.prid = privilages.id', 'left');
        $this->db->where('group_privilage.group_id', $groupId);
        $query = $this->db->get('privilages');

        $data=array();
        foreach($query->result() as $result)
        {
            $data[]=$result->mpname;
        }
        return $data;



    }

    function get_Sub_Privilages($userId)
    {
        $this->db->select('name');
        $this->db->join('privilages', 'privilages.id = group_privilage.prid', 'left');
        $this->db->where('group_privilage.group_id', $userId);
        $query = $this->db->get('group_privilage');

        $data=array();
        foreach($query->result() as $result)
        {
            $data[]=$result->name;
        }
        return $data;



    }
    public function forgot()
    {
        $this->db->where('email', $this->input->post('forgot_email'));
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {


            $np=$this->randomPassword();

            $this->db->set('passwd',md5($np));
            $this->db->where('email', $this->input->post('forgot_email'));
            $this->db->update('users');

            $this->email($this->input->post('forgot_email'),$np);

            return TRUE;


        }
        else
        {

            return FALSE;
        }

    }




    function email($email,$np)
    {

        $subject='';
        $data['np']=$np;

        $mail_body =  $this->load->view('login_new', $data, TRUE);

        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('info@eria.com', 'Reset Password');
        $this->email->to($email);
        //$this->email->cc('amal@uthayan.com');
        $this->email->bcc('balamohansivagnanam@yahoo.com');

        $this->email->subject($subject.'  Reset Password');
        $this->email->message($mail_body);

        $this->email->send();
    }



    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }




	function logHistory($userId,$sts,$nkey,$user)
	{
		
		 $newLog = array(
            'uid' => $userId,
			'udate' => date('Y-m-d'),
			'lip' => $_SERVER['REMOTE_ADDR'],
			'sip' => $_SERVER['SERVER_ADDR'],
			'mkey' => $nkey,
			'ustatus' => 1,
			 
        );

        try {
            $this->db->insert('login_history', $newLog);
			$lid=$this->db->insert_id();
			
			$this->db->set('status', $sts);
           	$this->db->where('id', $userId);
           	$this->db->set('l_history', $lid);
			$this->db->update('user');
			
			if($sts==3)
			{
			
			$message=$user."-".$nkey;
			$this->dialog->message($message);
			
			}
			
			
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }








    }




}
