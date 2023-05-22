<?php

Class Experts_model extends CI_Model
{

	 
	

	




    function getPage_content($id)
    {


        try {
            $this->db->select('*');
            $this->db->where('article_id', $id);
            $query = $this->db->get('articles');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }






    function updateSlider($img)
    {




        $data_s=$this->session->userdata('logged_in');

        $newBranch = array(
            'content' => $this->input->post('content'),
            'banner_url' => $this->input->post('banner_url'),
            'banner_target' => $this->input->post('banner_target'),
            'order_id' => $this->input->post('order_id'),
            'published' => $this->input->post('published'),
            'modified_by' => $data_s['user_id'],
            'modified_date' => date('Y-m-d H:i:s')

        );


        if ($img !== -1) {
            $img="/uploads/slides/".$img;
            $newBranch['image_name'] = $img;
        }

        try {
            $this->db->set($newBranch);
            $this->db->where('slide_id', $this->input->post('id'));
            $this->db->update('slides');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }



    }





	
	
}