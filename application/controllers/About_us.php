<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {


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
            $image_meta = 'v6/assets/logo.png';
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
            $data['image_meta'] = "v6/assets/logo.png";
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
        // $data['publications'] = $this->frontModel->get_article(2,'publications','','');

        // Related Publication
        $publication_related = $this->frontModel->get_article(2,'publications','','');

        $data['publ'] = $this->frontModel->getRelatedPublicationLatestDate('publications', '');
        $data['count_related_publications'] = count($publication_related);
        
        $data['content'] = 'front-end/content/about';
        $this->load->view('front-end/common/template', $data);
	}

    public function details($uri)
    {
        $content = $this->frontModel->getAboutUsPagesDetailByURI($uri);
        
        if (!empty($content)) {
            $slug = $content->uri;
            
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->menu_title);
            $menu_title = $content->menu_title ? $content->menu_title : "ERIA: Economic Research Institute for ASEAN and East Asia";
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '. $meta_data_contents['title_meta'];
        } else {
            $content_subpage = $this->frontModel->getAboutUsSubPagesDetailByURI($uri);
            
            $content = $content_subpage;

            $slug = $content->uri;
            $title = $content->title ? $content->title: "ERIA: Economic Research Institute for ASEAN and East Asia";
            
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->menu_title);
            $menu_title = $content->menu_title ? $content->menu_title : "ERIA: Economic Research Institute for ASEAN and East Asia";
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_description ? $content->meta_description: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '. $meta_data_contents['title_meta'];
        }
        
        $data['contentData']                = $content; //$this->frontModel->get_Gboard_content(12);
        $data['careers']                    = $this->frontModel->get_article(null, 'careers', null, 'career');
        $data['organizationWeWorksWith']    = $this->frontModel->getWeWorksWithcontent('organizations');
        $data['areaList']                   = $this->frontModel->get_OG();
        $data['time']                       = $this->frontModel->getTimeline();
        $data['m_menu']                     = $menu_title;
        if ($content->uri == 'contact-us') {
            $data['action'] = site_url('contact/create');
            $data['content']                = 'front-end/content/contact';
        } else {
            $data['content']                = 'front-end/content/aboutus_details';
        }
        
        $data['m_menu']                     = $slug;
        $data['left']                       = $slug;
        
        $this->load->view('front-end/common/template', $data);
    }

    public function Academic_advisory_council()
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
        $data['m_menu'] = 'Academic advisory council';
        $data['content'] = 'front-end/content/academic-advisory-council';
        $data['content_data'] = $this->frontModel->get_Gboard_content(12);
        $data['m_menu'] = 'academic-advisory-council';
        $data['left'] = 'academic-advisory-council';

        $this->load->view('front-end/common/template', $data);
    }

    public function Logo_use_standards()
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
        $data['m_menu']         = 'Logo Use Standards';
        $data['content']        = 'front-end/content/logo-use-standards';
        $data['content_data']   = $this->frontModel->get_Gboard_content(24);
        $data['m_menu']         = 'logo-use-standards';
        $data['left']           = 'logo-use-standards';

        $this->load->view('front-end/common/template', $data);
    }

    public function Messages_from_the_board()
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
        $uri = 'messages-from-the-board';
        $content_data = $this->frontModel->getAboutUsPagesDetailByURI($uri);
        $data['descriptions'] = $content_data;
        $data['m_menu'] = 'Messages from the Board';
        $data['content'] = 'front-end/content/messages-from-the-board';
        $data['m_menu'] = 'messages-from-the-board';
        $data['left'] = 'messages-from-the-board';

        $this->load->view('front-end/common/template', $data);
    }

    function Message_from_the_chairman_of_the_governing_board()
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

        $data['m_menu'] = 'Message from the Chairman of the Governing Board';
        $data['content'] = 'front-end/content/message-from-the-chairman-of-the-governing-board';
        $data['m_menu'] = 'message-from-the-chairman-of-the-governing-board';
        $data['left'] = 'message-from-the-chairman-of-the-governing-board';

        $this->load->view('front-end/common/template', $data);
    }

    public function Organisations_we_work_with()
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
        $data['m_menu'] = 'Message from the Chairman of the Governing Board';
        $data['content'] = 'front-end/content/organisations-we-work-with';
        $data['content_data'] = $this->frontModel->get_Gboard_content(16);
        $data['m_menu'] = 'organisations-we-work-with';
        $data['left'] = 'organisations-we-work-with';

        $this->load->view('front-end/common/template', $data);
    }
}