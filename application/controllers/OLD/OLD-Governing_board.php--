<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Governing_board extends CI_Controller
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
        
        $data['contentData'] = $content;

        $memberboards = $this->frontModel->getAllMemberGoverningBoards(10);

        foreach ($memberboards as $member) {
            $memberids[] = $member->article_id;
        }

        $member_board = $this->frontModel->getMemberBoardByID($memberids);

        $data['board'] = $this->frontModel->get_Gboard();
        $data['member_board'] = $member_board;
        $data['content_data'] = $this->frontModel->get_Gboard_content(10);
        $data['down'] = $this->frontModel->get_Gboard_down(10);
        $data['m_menu'] = 'message';
        $data['left'] = 'gboard';
        $data['content'] = 'front-end/content/board';

        $this->load->view('front-end/common/template', $data);
    }
}