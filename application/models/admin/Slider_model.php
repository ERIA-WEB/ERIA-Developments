<?php

class Slider_model extends CI_Model
{
    function getSlider()
    {
        try {
            $this->db->select('*');
            $this->db->order_by("slide_id", "desc");
            $query = $this->db->get('slides');


            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSetting($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('setting_id', $id);
            $query = $this->db->get('settings');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_Slider($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('slide_id', $id);
            $query = $this->db->get('slides');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateSlider($img)
    {
        $data_s = $this->session->userdata('logged_in');

        $newBranch = array(
            'content' => $this->input->post('content'),
            'heading' => $this->input->post('heading'),
            'banner_url' => $this->input->post('banner_url'),
            'banner_target' => $this->input->post('banner_target'),
            'order_id' => $this->input->post('order_id'),
            'published' => $this->input->post('published'),
            'modified_by' => $data_s['user_id'],
            'modified_date' => date('Y-m-d H:i:s')

        );


        if ($img !== -1) {
            $img = "/uploads/slides/" . $img;
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

    function insertSlider($img)
    {
        if ($this->input->post('published')) {
            $published = 1;
        } else {
            $published = 0;
        }

        $img = "/uploads/slides/" . $img;

        $data_s = $this->session->userdata('logged_in');

        $newBranch = array(
            'image_name'        => $img,
            'heading'           => $this->input->post('heading'),
            'content'           => $this->input->post('content'),
            'banner_url'        => $this->input->post('banner_url'), // md5($this->input->post('banner_url'))
            'banner_target'     => $this->input->post('banner_target'),
            'order_id'          => $this->input->post('order_id'),
            'published'         => $published,
            'modified_by'       => $data_s['user_id'],
            'modified_date'     => date('Y-m-d H:i:s'),
        );

        try {
            $this->db->insert('slides', $newBranch);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleteing($id)
    {
        try {
            $this->db->where('slide_id', $id);
            $this->db->delete('slides');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function publish($id, $pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('slide_id', $id);
        $this->db->update('slides');
    }

    function settings($data)
    {
        $this->db->set('data', $data);
        $this->db->where('setting_id', 1);
        $this->db->update('settings');
    }
}
