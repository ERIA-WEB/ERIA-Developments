<?php

class Content_model extends CI_Model
{
    function getContent()
    {
        $data_s = $this->session->userdata('logged_in');
        try {
            $this->db->select('*');
            $query = $this->db->get('content');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getBanners()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('banners');
            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_Banners($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('banner_id', $id);
            $query = $this->db->get('banners');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateContent()
    {
        $content = array(
            'home_title'        =>  $this->input->post('home_title'),
            'sort_order'        =>  $this->input->post('sort_order'),
            'published'         =>  1,
            'meta_keywords'     =>  $this->input->post('meta_keywords'),
            'meta_discriptions' =>  $this->input->post('meta_discriptions'),
            'page_title'        =>  $this->input->post('page_title'),
            'sort_title'        =>  $this->input->post('sort_title'),
            'modified_date'     =>  date("Y-m-d h:i:sa"),
        );

        try {
            $this->db->set($content);
            $this->db->where('id', 1);
            $this->db->update('content');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateLogo($img)
    {
        $content = array(
            'slogan' =>  $this->input->post('slogan'),
            'modified_date' =>  date("Y-m-d h:i:sa"),
        );

        if ($img !== -1) {
            $content['logo'] = $img;
        }

        try {

            $this->db->set($content);
            $this->db->where('id', 1);
            $this->db->update('content');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateBanner($img)
    {
        $data_s = $this->session->userdata('logged_in');

        $newBranch = array(
            'caption' => $this->input->post('caption'),
            'banner_url' => $this->input->post('banner_url'),
            'banner_target' => $this->input->post('banner_target'),
            'order_id' => $this->input->post('order_id'),
            'published' => $this->input->post('published'),
            'modified_by' => $data_s['user_id'],
            'modified_date' => date('Y-m-d H:i:s')
        );

        if ($img !== -1) {
            $img = "/uploads/banners/" . $img;
            $newBranch['image_name'] = $img;
        }

        try {
            $this->db->set($newBranch);
            $this->db->where('banner_id', $this->input->post('id'));
            $this->db->update('banners');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateFooter()
    {
        $content = array(
            'footer_Content' =>  $this->input->post('footer_Content'),
            'footer_copyrights' =>  $this->input->post('footer_copyrights'),
            'footer_about' =>  $this->input->post('footer_about'),
            'modified_date' =>  date("Y-m-d h:i:sa"),
        );

        try {
            $this->db->set($content);
            $this->db->where('id', 1);
            $this->db->update('content');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertBannner($img)
    {
        $img = "/uploads/banners/" . $img;

        $data_s = $this->session->userdata('logged_in');

        $newBranch = array(
            'image_name' => $img,
            'caption' => $this->input->post('caption'),
            'banner_url' => md5($this->input->post('banner_url')),
            'banner_target' => $this->input->post('banner_target'),
            'order_id' => $this->input->post('order_id'),
            'published' => $this->input->post('published'),
            'modified_by' => $data_s['user_id'],
            'modified_date' => date('Y-m-d H:i:s')
        );

        try {
            $this->db->insert('banners', $newBranch);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
}