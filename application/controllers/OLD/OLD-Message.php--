<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(7);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->menu_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData']    = $content;
        $data['m_menu']         = 'message';
        $data['boardmessages']  = $this->frontModel->get_article(null, 'boardmessages', null, 'boardmessages');
        $data['left']           = 'board';
        $data['content'] = 'front-end/content/message';

        $this->load->view('front-end/common/template', $data);
    }


    public function details($id)
    {
        $content = $this->Page_model->getPage_content(7);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->menu_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;

        if ($id == 'message-from-secretary-general-of-asean') {
            $id = 'message-from-secretary-general-of-asean-1';
        }

        $data['m_menu']     = 'message';
        $data['m']          = $this->frontModel->get_inArticle($id);
        $data['left']       = 'board';
        $data['content']    = 'front-end/content/message_detail';

        $this->load->view('front-end/common/template', $data);
    }

    public function president()
    {
        $content = $this->Page_model->getPage_content(7);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->menu_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData']    = $content;
        $data['m_menu']         = 'message';
        $data['left']           = 'president';
        $data['boardmessages']  = $this->frontModel->get_messageinArticle(4099);
        $data['content']        = 'front-end/content/president';

        $this->load->view('front-end/common/template', $data);
    }
}