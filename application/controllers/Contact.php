<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load session library
        $this->load->library('session');
        // Load the captcha helper
        // $this->load->helper('captcha');
        $this->load->helper(array('form', 'url', 'captcha'));
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(7);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.webp';
            $title_meta = ucfirst($content->menu_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.str_replace('About', 'Contact', $meta_data_contents['title_meta']);
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        $data['m_menu'] = 'contact-us';
        $data['left'] = 'contact-us';
        $data['action'] = site_url('contact/create');
        $data['content'] = 'front-end/content/contact';
        $this->load->view('front-end/common/template', $data);
    }


    public function refresh()
    {
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url() . 'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }


    public function create()
    {
        $this->form_validation->set_rules('g-recaptcha-response', 'g-recaptcha-response', 'trim|required');

        $validate = $this->form_validation->run();

        if ($validate == FALSE) {
            echo "<script>alert('Silahkan untuk mencentang CAPTCHA!')</script>";
            // redirect('contact/');
            $this->index();
        } else {

            $data = [
                'fullname'   => $this->input->post('fullName'),
                'email'     => $this->input->post('Email'),
                'phone'     => $this->input->post('Phone'),
                'message'   => $this->input->post('message'),
                'created'   => date('Y-m-d h:i:s'),
            ];

            $email = $this->input->post('Email');

            $subject = "Contact Form Eria";

            $inside['user'] = $this->input->post('fullName');
            $inside['email'] = $this->input->post('Email');
            $inside['phone'] = $this->input->post('Phone');
            $inside['message'] = $this->input->post('message');

            $mesg = $this->load->view('template/email/contact-form', $inside, true);

            $result = $this->frontModel->createContactUs($data);

            if ($result > 0) {

                $this->load->library('email');
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('infoeria@mailinator.com', 'Contact Form ERIA');
                $this->email->to('infoeria@mailinator.com');
                $this->email->subject($subject);
                $this->email->message($mesg);

                $mail = $this->email->send();

                $this->session->set_flashdata('success-message', 'Successfully Received your request.');

                redirect('contact');
            } else {
                echo "<script>alert('Data tidak berhasil disimpan!')</script>";
                redirect('contact');
            }
        }
    }
}