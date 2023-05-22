<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privacy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Content_model', '', TRUE);
        $this->load->library("pagination");
        $this->load->model('admin/Page_model', '', TRUE);
    }

    public function index()
    {
        $slider_row = $this->Page_model->getPage_content(20);
        $content = $this->Content_model->getContent();
        
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->home_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_discriptions ? $content->meta_discriptions: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.str_replace('About', 'Contact', $meta_data_contents['title_meta']);
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        

        $data['contentData'] = $content;
        $data['slider_row'] = $slider_row;
        $data['m_menu'] = '';
        $data['content'] = 'front-end/content/privacy';

        $this->load->view('front-end/common/template', $data);
    }
}