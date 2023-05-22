<?php

Class Profile_model extends CI_Model
{

	 
	
	function getProfile() {
		
		$data_s=$this->session->userdata('logged_in');



        try {
            $this->db->select('user_id,p_pic,email,username');
			//$this->db->where('status', 1);
             $this->db->where('user_id', $data_s['user_id']);
            $query = $this->db->get('users');
            return   $query->row(); 
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
	
	
	function updatePassword()
    {
		$data_s=$this->session->userdata('logged_in');
		
		$password = array(
            'passwd' => md5($this->input->post('n_password'))
        );
		
		
        try {
            $this->db->set($password);
              $this->db->where('username', $data_s['username']);
            $this->db->update('users');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

	
	function userExists($code) {
        $id = $this->input->post('id');

        $this->db->where_not_in('id', $id);
        $this->db->where('username', $code);
        $this->db->where('status', 0);
        $result = $this->db->get('user');

        if ($result->num_rows() == 0) {
            $bool = TRUE;
        } else {
            $bool = FALSE;
        }
        return $bool;
    }
	
	
	
	 
	 function isSame($o_password) {
        
		$data_s=$this->session->userdata('logged_in');

        $this->db->where('username', $data_s['username']);
        $this->db->where('passwd', md5($o_password));
       // $this->db->where('status', 1);
        $result = $this->db->get('users');

        //var_dump($result->num_rows()); die;


        if ($result->num_rows() == 1) {
            $bool = TRUE;
        } else {
            $bool = FALSE;
        }
        return $bool;
    }
	
	
	
	 function profile_pic($fileName) {
        
		$data_s=$this->session->userdata('logged_in');



			$this->db->set('p_pic',$fileName);
            $this->db->where('user_id', $data_s['user_id']);
            $this->db->update('users');
            $bool = TRUE;
			

        return $bool;
    }
	
	
	
	
	
	
	
	
	
	
	
}