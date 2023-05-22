<?php

class UserModel extends CI_Model {

    function __construct() {
        parent::__construct();
		
	 
		 
    }





function getAll_group() {

        try {


			$this->db->select('*');
		    $this->db->from('user_groups');
		    $this->db->where('status', 1);
			$query = $this->db->get();
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }



    function getAll_user() {

        try {


            $this->db->select('users.*,user_groups.group_name');
            $this->db->from('users');
            $this->db->where('users.status', 1);
            $this->db->join('user_groups', 'user_groups.group_id = users.group_id', 'left');
            $query = $this->db->get();
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }




    function getUser($id) {
        try {
            $this->db->select('user_id,group_id,username,full_name,email,p_pic');
            $this->db->where('user_id', $id);
            $query = $this->db->get('users');
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }



    function getGroup($id) {
        try {
            $this->db->select('*');
            $this->db->where('group_id', $id);
            $query = $this->db->get('user_groups');
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertGroup($user) {

        $edit=0;
        $delete=0;
        if($this->input->post('edit'))
        {
            $edit=1;
        }
        if($this->input->post('delete'))
        {
            $delete=1;
        }


        $newBranch = array(
            'group_name' => $this->input->post('group'),
            'modified_by' => $user,
            'edit' => $edit,
            'delete' => $delete,
            'modified_date' => date('Y-m-d H:i:s')

        );

        try {
            $this->db->insert('user_groups', $newBranch);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }


    function insertUser() {

        $data_s=$this->session->userdata('logged_in');

        $newBranch = array(
            'group_id' => $this->input->post('group'),
            'username' => $this->input->post('username'),
            'passwd' => md5($this->input->post('c_password')),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'modified_date' => date('Y-m-d H:i:s')

        );

        try {
            $this->db->insert('users', $newBranch);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }




    function updateUser() {
        $id = $this->input->post('id');
        $data_s=$this->session->userdata('logged_in');
        $branch = array(
            'group_id' => $this->input->post('group'),
            'username' => $this->input->post('username'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'modified_date' => date('Y-m-d H:i:s')
        );

        if($this->input->post('n_password')!='')
        {
            $branch['passwd'] =  md5($this->input->post('n_password'));

        }

        //var_dump($branch); die;

        try {
            $this->db->set($branch);
            $this->db->where('user_id', $id);
            $this->db->update('users');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }





    function updateGroup() {

        $edit=0;
        $delete=0;
        if($this->input->post('edit'))
        {
            $edit=1;
        }
        if($this->input->post('delete'))
        {
            $delete=1;
        }


        $id = $this->input->post('id');
        $data_s=$this->session->userdata('logged_in');
        $branch = array(
            'group_name' => $this->input->post('group'),
            'edit' => $edit,
            'delete' => $delete,
            'modified_by' => $data_s['user_id'],
            'modified_date' => date('Y-m-d H:i:s')
        );

        try {
            $this->db->set($branch);
            $this->db->where('group_id', $id);
            $this->db->update('user_groups');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }



    function getAllPri($id)
    {
        try {


            $this->db->select('privilages.mpname');
            $this->db->distinct('privilages.mpname');
            $this->db->from('privilages');
            $this->db->where('privilages.status', 1);
            $query = $this->db->get();

            $collData=array();



            foreach ($query->result() AS $aid => $query) {


                $collData[$aid]['main'] = $query->mpname;

                $this->db->select('privilages.*');
                $this->db->from('privilages');
                $this->db->where('privilages.status', 1);
                $this->db->where('privilages.mpname', $query->mpname);

                //$this->db->join('user_privilage', 'user_privilage.prid = privilages.id','left');
                $this->db->order_by('privilages.id','asc');
                // $this->db->group_by('privilages.id');

                //$query = $this->db->get();
                // return $query;
                $queryS = $this->db->get();
                $collData[$aid]['subdata']=array();

                foreach($queryS->result() AS $bid => $privilages )
                {
                    $collData[$aid]['subdata'][$bid]['name']=$privilages->name;
                    $collData[$aid]['subdata'][$bid]['id']=$privilages->id;


                    $userp=$this->getsetAllPriN($id,$privilages->id);

                    $collData[$aid]['subdata'][$bid]['cnt']=$userp->num_rows();



                    $collData[$aid]['subdata'][$bid]['ud']=$id;





                }



            }
            return $collData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }

    }


    function getsetAllPriN($id,$pid) {
        try {
            $this->db->select('prid');
            $this->db->where('group_id', $id);
            $this->db->where('prid', $pid);
            $this->db->where('status', 1);
            $query = $this->db->get('group_privilage');
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }


    function deleteingGroup($id) {

        $data_s=$this->session->userdata('logged_in');

        try {
            $this->db->set('status', 0);
            $this->db->set('modified_by', $data_s['user_id']);
            $this->db->where('group_id', $id);
            $this->db->update('user_groups');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleteUser($id) {

        $data_s=$this->session->userdata('logged_in');

        try {
            $this->db->set('status', 0);
            $this->db->where('user_id', $id);
            $this->db->update('users');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function codeExists($code) {
        $id = $this->input->post('id');

        $this->db->where_not_in('group_id', $id);
        $this->db->where('group_name', $code);
        $this->db->where('status', 1);
        $result = $this->db->get('user_groups');

        if ($result->num_rows() == 0) {
            $bool = TRUE;
        } else {
            $bool = FALSE;
        }
        return $bool;
    }

	function usernameExists($code) {
        $id = $this->input->post('id');

        $this->db->where_not_in('user_id', $id);
        $this->db->where('username', $code);
        $this->db->where('status', 1);
        $result = $this->db->get('users');

        if ($result->num_rows() == 0) {
            $bool = TRUE;
        } else {
            $bool = FALSE;
        }
        return $bool;
    }
	function emailExists($code) {
        $id = $this->input->post('id');

        $this->db->where_not_in('user_id', $id);
        $this->db->where('email', $code);
        $this->db->where('status', 1);
        $result = $this->db->get('users');

        if ($result->num_rows() == 0) {
            $bool = TRUE;
        } else {
            $bool = FALSE;
        }
        return $bool;
    }


    function insertPrivilages($id,$privilages)
    {
        $newUser = array(
            'group_id' => $id,
            'prid' => $privilages,
            'status' => 1,

        );

        try {
            $this->db->insert('group_privilage', $newUser);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }

    }



    function deletePrivilages($id,$privilages)
    {


        try {

            $this -> db -> where('group_id', $id);
            $this -> db -> where('prid', $privilages);
            $this -> db -> delete('group_privilage');


            //$this->db->insert('user_privilage', $newUser);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }

    }





}
