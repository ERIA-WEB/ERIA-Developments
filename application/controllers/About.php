<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $time_row = $this->frontModel->getPage_timeline();
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
            $data['title'] = 'ERIA: '. $meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;

        $slider_nrow = $this->Page_model->getPage_subcontent(1);

        $nsr = $this->Page_model->getPage_r_subcontent(1);

        $data['pc'] = $content;
        $data['ac'] = $slider_nrow;
        $data['rc'] = $nsr;
        $data['times'] = $time_row;
        $data['m_menu'] = 'about';
        $data['publications'] = $this->frontModel->get_article(2, 'publications', 1, 'home');
        $data['content'] = 'front-end/content/about';

        $this->load->view('front-end/common/template', $data);
    }
}