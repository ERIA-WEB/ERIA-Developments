<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Content_model', '', TRUE);
        $this->load->library("pagination");
    }

    public function resizeImage($file, $w, $h, $crop = FALSE)
    {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
    }

    public function index()
    {
        $content = $this->Content_model->getContent();
        
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->page_title);
            $keyword_meta = $content->meta_keywords ? $content->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content->meta_discriptions ? $content->meta_discriptions: 'Economic Research Institute for ASEAN and East Asia';

            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = $meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }

        $data['slider'] = $this->frontModel->get_Slider();
        // $data['experts'] = $this->frontModel->get_article(null,'experts',null,'home');
        $data['categories'] = $this->frontModel->get_catogery('categories');
        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['m_menu'] = 'home';
        $data['card_type'] = 1;
        $data['card'] = $this->frontModel->getPage_card_order(1);
        
        $news_update_homepage = $this->frontModel->get_recentArticle();
        
        if (count($news_update_homepage) == 6) {
            $data['newsall'] = $this->frontModel->get_recentArticle();
        } else {
            $check_count_for_limit = 6 - count($news_update_homepage);
            $latest_news_update = $this->frontModel->get_latest_article($check_count_for_limit);
            $merging_data = array_merge($news_update_homepage, $latest_news_update);
            
            $data['newsall'] = $merging_data;
        }
        
        
        $data['articles'] = $this->frontModel->get_article(5, 'articles', null, 'home');
        $data['publications'] = $this->frontModel->get_publicatio_article('home');
        // $data['publications'] = $this->frontModel->getPublicationForHighlight(1);
        // $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
         
        $data['podcasts']   = $this->frontModel->getMultimediaLatest('multimedia', 'Podcasts');
        $data['video']      = $this->frontModel->getMultimediaLatest('multimedia', 'Video');
        $data['webinar']    = $this->frontModel->getMultimediaLatest('multimedia', 'Webinar');
        $data['content'] = 'front-end/content/home';

        $this->load->view('front-end/common/template', $data);
    }

    function sentEmail()
    {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $result = false;
        } else {
            $result = true;

            $this->frontModel->assignNews($email);
        }

        echo $result;
    }

    function email_Sent($email)
    {
        $subject = '';
        $mail_body =  $this->load->view('front-end/content/subscribe');

        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('info@eria.com', 'Thank You');
        $this->email->to($email);
        $this->email->subject($subject . '  Thank You ');
        $this->email->message($mail_body);
        $this->email->send();
    }

    public function search($kword = null, $sdate = null, $fdate = null, $ptop = null, $country = null, $research = null, $l = 10, $sort = 'rel')
    {
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
            $data['title'] = $meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;

        $kword = strip_tags($this->input->get('msearch'));
        $kword = str_replace(array(
            '\'', '"',
            ',', ';', '<', '>'
        ), ' ', $kword);

        $sdate = $this->input->get('sdate');
        $fdate = $this->input->get('fdate');

        if ($this->input->get('limit')) {
            $data['lim'] = $this->input->post('limit');
        } else {
            $data['lim'] = $l;
        }

        $l = $this->input->get('limit');

        if (isset($_GET['ptop'])) {
            $ptop = $_GET['ptop'];
            $data['ptop'] = $ptop;
        } else {
            $ptop = null;
            $data['ptop'] = array();
        }

        if (isset($_GET['country'])) {
            $country = $_GET['country'];
            $data['cn'] = $country;
        } else {
            $country = null;
            $data['cn'] = array();
        }

        if (isset($_GET['research'])) {
            $research = $_GET['research'];
            $data['pser'] = $research;
        } else {
            $research = null;
            $data['pser'] = array();
        }

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $data['sort'] = $_GET['sort'];
        } else {
            $sort = null;
            $data['sort'] = $sort; // "rel"
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        } else {
            $offset = 0;
        }

        $num = $this->frontModel->searchCombine_count($kword, $sdate, $fdate, $ptop, $country, $research, $sort);
        
        $config = array();
        $config["per_page"] = 10;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'offset';
        $config['total_rows']  = $num;
        $config["base_url"] = base_url() . "Home/search?limit=10&msearch=" . $kword . "&sdate=" . $sdate . "&fdate=" . $fdate . "&sort=" . $sort . "&commit=Search";
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['full_tag_open'] = '<ul class="pagination pt-4  ">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item  ">';
        $config['num_tag_close'] = '</li>';
        $config['data_page_attr'] = 'class="page-link" ';
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>"; //tagl? should be tag
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['prev_tag_open'] = '<li class="page-item prev">';
        $config['prev_tag_close'] = '</li>';

        $r = $this->frontModel->searchCombine($kword, $sdate, $fdate, $ptop, $country, $research, 10, $offset, $sort);
        // echo "<pre>";
        // print_r($r);
        // exit();
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
        $data['searchData'] = $r;
        $data['m_menu'] = 'home';
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['nns'] = $this->get_paging_info(100, 5, 12);
        $data['kword'] = $kword;
        $data['sdate'] = $sdate;
        $data['fdate'] = $fdate;
        $data['content'] = 'front-end/content/search';

        $this->load->view('front-end/common/template', $data);
    }

    function get_paging_info($tot_rows, $pp, $curr_page)
    {
        $pages = ceil($tot_rows / $pp); // calc pages

        $data = array(); // start out array
        $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
        $data['pages']     = $pages;                   // add the pages
        $data['curr_page'] = $curr_page;               // Whats the current page

        return $data; //return the paging data

    }
}