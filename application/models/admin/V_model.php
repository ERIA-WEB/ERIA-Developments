<?php

Class V_model extends CI_Model
{

	 
	


    function get_content($v)
    {


        try {
            $this->db->select('*');
            $this->db->where('v_name', $v);
            $query = $this->db->get('web_variales');

            return   $query->row('content');
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }













    function updatecat($v,$content)
    {



        try {
            $this->db->set('content',$content);
            $this->db->where('v_name', $v);
            $this->db->update('web_variales');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }



    }




}