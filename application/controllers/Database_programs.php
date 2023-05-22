<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database_programs extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/database_programs';

        $this->load->view('front-end/common/template', $data);
    }

    public function Asia()
    {
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/asia';
        $this->load->view('front-end/common/template', $data);
    }

    public function Topic()
    {
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/topic';
        $this->load->view('front-end/common/template', $data);
    }

    public function Covid19()
    {
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/covid';
        $this->load->view('front-end/common/template', $data);
    }
}