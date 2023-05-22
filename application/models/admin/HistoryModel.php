<?php

class HistoryModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllhis($users, $date)
    {
        try {
            $this->db->select('user_logs.*, users.username');
            $this->db->join('users', 'users.user_id = user_logs.user_id', 'left');

            if ($users != 0) {
                $this->db->where('user_logs.user_id', $users);
            }

            if ($date != null) {
                $this->db->where('DATE(user_logs.log_date)', $date);
            } else {
                $date = date('Y-m-d');
                $this->db->where('DATE(user_logs.log_date)', $date);
            }

            $query = $this->db->get('user_logs');
            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertHistory($odata, $ndata, $discription)
    {

        $data_s = $this->session->userdata('logged_in');
        if ($data_s) {
            $uid = $data_s['user_id'];
        } else {
            $uid = 0;
        }
        $newHistory = array(
            'user_id' => $uid,
            'description' => $discription,
            'old_data' => $odata,
            'new_data' => $ndata,
            'log_date' => date("Y-m-d h:i:sa"),
            'from_ip' => $_SERVER['REMOTE_ADDR'],
            'browser' => $_SERVER['HTTP_USER_AGENT']

        );
        
        try {
            $this->db->insert('user_logs', $newHistory);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
}
