<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Experts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function safeDisplayEditor($str)
    {
        $str = stripslashes($str);
        $str = str_replace("\n", "", $str);
        $str = str_replace("\r", "", $str);
        $str = str_replace(array('?quot;'), array('"'), $str);
        $str = str_replace(array('?gt;'), array('>'), $str);
        $str = str_ireplace(array('<p>&nbsp;</p>', '&#65533;'), array('', '&bull;'), $str);
        return $str;
    }

    public function RemoveBS($Str)
    {
        $StrArr = str_split($Str);
        $NewStr = '';
        foreach ($StrArr as $Char) {
            $CharNo = ord($Char);
            if ($CharNo == 163) {
                $NewStr .= $Char;
                continue;
            } // keep £ 
            if ($CharNo > 31 && $CharNo < 127) {
                $NewStr .= $Char;
            }
        }

        return $NewStr;
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(19);
        
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
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        } else {
            $key = '';
        }

        if (isset($_GET['cn'])) {
            $catogery = $_GET['cn'];
        } else {
            $catogery = '';
        }

        if (isset($_GET['cn'])) {
            $catogery_id = $_GET['catogery'];
        } else {
            $catogery_id = '';
        }
        
        $data['m_menu'] = 'about';
        $data['catogery'] = $catogery;
        $data['key'] = $key;
        $data['catogeryID'] = $catogery_id;
        $data['ex_cat'] = $this->frontModel->getSub_cat('experts');
        $data['sub_cat'] = $this->frontModel->getAllDepartement(); // getSubExpert

        $article_type = ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified'];
        $data['experts'] = $this->frontModel->get_pageexperts('experts', $key, $catogery_id); // 'experts'
        $data['associates'] = $this->frontModel->get_pageexperts('associates', $key, $catogery_id);
        $data['keystaffs'] = $this->frontModel->get_pageexperts('keystaffs', $key, $catogery_id);
        $data['boardmessages'] = $this->frontModel->get_pageexperts('boardmessages', $key, $catogery_id);
        $data['fellows'] = $this->frontModel->get_pageexperts('fellows', $key, $catogery_id);
        // $data['associates'] = $this->frontModel->get_article(null, 'associates', null, 'associates');
        $data['content'] = 'front-end/content/experts';

        $this->load->view('front-end/common/template', $data);
    }

    private function loadexpert($keyword, $category, $subcategory)
    {
        $result = $this->frontModel->get_search_page_experts_($keyword, $category, $subcategory);

        return $result;
    }

    function getSubCatExpert()
    {
        $keyword = $this->input->post('keyword');
        $category = $this->input->post('category');
        $subcategory = $this->input->post('subcategory');
        $result_experts = $this->loadexpert($keyword, $category, $subcategory);

        $id = $this->input->post('id');

        $article_type_sub = 'experts';

        $query = $this->Page_model->getSub($id, $article_type_sub);

        $output = '';

        $output .= "<a class='dropdown-item cdss ' data-cid='all' data-nme='all' href='#'>All</a>";

        foreach ($query as $query) {
            $output .= '<a class="dropdown-item" href="#" data-cid="' . $query->es_id . '" data-nme="' . $query->s_catogery . '">' . $query->s_catogery . '</a>';
        }

        $resultexperts = '';
        $resultexperts .= "<div id='associates' class='px-3 w-100'><h2 class='main-title text-blue w-100'>Search Results</h2><hr></div>";
        $x = 0;
        $resultexperts .= "<div class='row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3'>";
        foreach ($result_experts as $mm) {
            $this->db->select('article_types');
            $this->db->where('ec_id', $mm['sub_experts']);
            $query_expert_category = $this->db->get('eria_expert_categories');

            $expert_category = $query_expert_category->row();
            $article_type = $expert_category->article_types;

            if ($mm['article_type'] == $article_type) {
                $x++;
                if (strip_tags($mm['major']) !== 'Authors' AND strip_tags($mm['major']) !== 'Author' AND strip_tags($mm['major']) !== 'Editor') {
                    if (isset($mm['major'])) {
                        $ns = substr(strip_tags($mm['major']), 0, 75);

                        $c = strip_tags($mm['major']);
                        if (strlen($c) > 90) {
                            $nd = substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $mm['uri'] . "'>[...]</a>";
                        } else {
                            $nd = $c;
                        }
                    }

                    $resultexperts .= '<div class="col mb-4">';
                    $resultexperts .= '<a href="' . base_url() . "experts/" . $mm['uri'] . '">';
                    $resultexperts .= '<div class="card people-card border-0 rounded-0 h-100">';
                    $resultexperts .= '<div class="people-card-image bg-lg-light pt-3 px-3">';
                    $resultexperts .= "<img src='" . base_url() . $mm['image_name'] . "' alt='expert-image' class='img-fluid w-100'></div>";
                    $resultexperts .= '<div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">';
                    $resultexperts .= '<h5 class="card-title text-blue">' . str_replace('Message from', '', $mm['title']);
                    $resultexperts .= '</h5>';
                    $resultexperts .= '<p class="text-secondary" style="font-weight:500">' . $nd . '</p>';

                    if (!empty($mm['majorEmail'])) {
                        $mailto = 'mailto:' . $mm['majorEmail'];
                    } else {
                        $mailto = 'mailto:contactus@eria.org';
                    }
                    $resultexperts .= '<a href="' . $mailto . '"><i class="fa fa-envelope" style="color: var(--primaryBlue);"></i></a>';
                    $resultexperts .= '</div>';
                    $resultexperts .= '</div>';
                    $resultexperts .= '</a>';
                    $resultexperts .= '</div>';
                }
            }
        }
        $resultexperts .= '</div>';

        $results['selectoption'] = $output;
        $results['resultexperts'] = $resultexperts;

        echo json_encode($results);
    }

    private function loadsubcategorydepartement($keyword, $category, $subcategory)
    {
        $result = $this->frontModel->get_search_page_experts_($keyword, $category, $subcategory);

        return $result;
    }

    function getSubCatDept()
    {
        $keyword = $this->input->post('keyword');
        $category = $this->input->post('category');
        $subcategory = $this->input->post('subcategory');

        $result_experts = $this->loadsubcategorydepartement($keyword, $category, $subcategory);
        
        $id = $this->input->post('id');
        $article_type_sub = 'experts';

        $query = $this->Page_model->getSub($id, $article_type_sub);

        $output = '';

        $output .= "<a class='dropdown-item cdss ' data-cid='all' data-nme='all' href='#'>All</a>";

        foreach ($query as $query) {
            $output .= '<a class="dropdown-item" href="#" data-cid="' . $query->es_id . '" data-nme="' . $query->s_catogery . '">' . $query->s_catogery . '</a>';
        }

        $resultexperts = '';
        $resultexperts .= "<div id='associates' class='px-3 w-100'><h2 class='main-title text-blue w-100'>Search Results</h2><hr></div>";
        $x = 0;
        $resultexperts .= "<div class='row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3'>";
        foreach ($result_experts as $mm) {
            $this->db->select('article_types');
            $this->db->where('ec_id', $mm['sub_experts']);
            $query_expert_category = $this->db->get('eria_expert_categories');

            $expert_category = $query_expert_category->row();
            $article_type = $expert_category->article_types;
            
            if ($mm['article_type'] == $article_type) {
                if (strip_tags($mm['major']) !== 'Authors' AND strip_tags($mm['major']) !== 'Author' AND strip_tags($mm['major']) !== 'Editor') {
                    $x++;
                    if (isset($mm['major'])) {
                        $ns = substr(strip_tags($mm['major']), 0, 75);

                        $c = strip_tags($mm['major']);
                        if (strlen($c) > 90) {
                            $nd = substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $mm['uri'] . "'>[...]</a>";
                        } else {
                            $nd = $c;
                        }
                    }

                    $resultexperts .= '<div class="col mb-4">';
                    $resultexperts .= '<a href="' . base_url() . "experts/" . $mm['uri'] . '">';
                    $resultexperts .= '<div class="card people-card border-0 rounded-0 h-100">';
                    $resultexperts .= '<div class="people-card-image bg-lg-light pt-3 px-3">';
                    $resultexperts .= "<img src='" . base_url() . $mm['image_name'] . "' alt='expert-image' class='img-fluid w-100'></div>";
                    $resultexperts .= '<div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">';
                    $resultexperts .= '<h5 class="card-title text-blue">' . str_replace('Message from', '', $mm['title']);
                    $resultexperts .= '</h5>';
                    $resultexperts .= '<p class="text-secondary" style="font-weight:500">' . $nd . '</p>';

                    if (!empty($mm['majorEmail'])) {
                        $mailto = 'mailto:' . $mm['majorEmail'];
                    } else {
                        $mailto = 'mailto:contactus@eria.org';
                    }
                    $resultexperts .= '<a href="' . $mailto . '"><i class="fa fa-envelope" style="color: var(--primaryBlue);"></i></a>';
                    $resultexperts .= '</div>';
                    $resultexperts .= '</div>';
                    $resultexperts .= '</a>';
                    $resultexperts .= '</div>';
                }
            }
            
            
        }
        $resultexperts .= '</div>';

        $results['selectoption'] = $output;
        $results['resultexperts'] = $resultexperts;

        echo json_encode($results);
    }

    function getSub()
    {
        $id = $this->input->post('id');
        $query = $this->Page_model->getSub($id);

        $output = '';

        $output .= "<a class='dropdown-item cdss ' data-cid='all' data-nme='all' href='#'>All</a>";

        foreach ($query as $query) {
            $output .= "<a class='dropdown-item  cdss '  href='#' data-cid='" . $query->es_id . "' data-nme='" . $query->s_catogery . "'   >" . $query->s_catogery . "</a>";
        }

        echo $output;
    }

    public function detail($id)
    {
        $article = $this->frontModel->get_inArticle($id);
        $content = $this->Page_model->getPage_content(7);

        if (!empty($article)) {
            $image_meta = $article->image_name ? $article->image_name :'v6/assets/logo.webp';
            $title_meta = $article->title;
            $keyword_meta = $article->meta_keywords ? $article->meta_keywords: $article->title;
            $description_meta = $article->meta_description ? $article->meta_description: $article->title;
            
            $meta_data_contents = $this->header->getMetaDataContents($image_meta, $title_meta, $keyword_meta, $description_meta);
            
            $data['contentData'] = $content;
            $data['md'] = $meta_data_contents['description_meta'];
            $data['mk'] = $meta_data_contents['keyword_meta'];
            $data['image_meta'] = $meta_data_contents['image_meta'];
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        $data['m_menu'] = 'about';
        
        if (!empty($article)) {
            $data['article'] = $article;

            $data['publications_expert'] = $this->frontModel->getPublicationsExpertByTitle($article->title, 0, 4);
            $data['events_card'] = $this->frontModel->getEventCardForPeople($article->article_id);
        }
        
        $data['content'] = 'front-end/content/expert_details';

        $this->load->view('front-end/common/template', $data);
    }

    function get_publication_expert()
    {
        $input = $this->input->post();

        $start = $input['start'];
        $limit = $input['limit'];
        $expert_publications = $this->frontModel->getPublicationsExpertByTitle($input['title'], $start, $limit);

        $output = '';
        foreach ($expert_publications as $value) {
            if (!empty($value->image_name)) {
                if (file_exists(FCPATH . base_url() . $value->image_name)) {
                    $img = base_url() . $value->image_name;
                } else {
                    $img = "https://www.eria.org" . $value->image_name;
                }
            } else {
                $img = base_url() . 'upload/Publication.jpg';
            }
            $output .= '<ul class="col-md-12 d-lg-flex align-items-lg-start m-0">
                            <li class="card-title" style="font-size:12px;font-family: montserrat, sans-serif !important;">
                                <a href="' . base_url() . 'publications/' . $value->uri . '" style="font-family: "Montserrat", sans-serif !important;">' . $this->RemoveBS($value->title) .
            '</a>
                            </li>
                        </ul>';
        }

        echo $output;
    }

    function load_expert()
    {
        if (isset($_POST['key'])) {
            $key = $_POST['key'];
        } else {
            $key = null;
        }

        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        } else {
            $role = null;
        }

        if (isset($_POST['srole'])) {
            $srole = $_POST['srole'];
        } else {
            $srole = null;
        }

        $resultexperts = '';
        $resultexperts .= "<div id='associates' class='px-3 pb-3' style='width: 100%'><div class='main-title text-blue w-100'>Search Results</div></div>";

        $mm_data = $this->frontModel->get_search_page_experts_($key, $role, $srole);
        
        $x = 0;
        if (count($mm_data) == 0) {
            $result_data = $this->frontModel->get_search_page_expert_by_content($key);
            
            if (!empty($result_data)) {
                
                $people_str = str_replace(", ", ",", $result_data->editor);
                $peoples = explode(',' , $people_str);

                $resultexperts .= "<div class='row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3'>";

                $result_people_data = $this->frontModel->getPeopleExperts($peoples);
                
                if (!empty($result_people_data)) {
                    $result_contents = $result_people_data;
                } else {
                    $result_contents = $this->frontModel->getPeopleExpertsByContent($key);
                }

                foreach ($result_contents as $mm) {
                    if ($mm['sub_experts'] != '19') {
                        $this->db->select('article_types');
                        $this->db->where('ec_id', $mm['sub_experts']);
                        $query_expert_category = $this->db->get('eria_expert_categories');

                        $expert_category = $query_expert_category->row();
                        if (!empty($expert_category)) {
                            $article_type = $expert_category->article_types;

                            if (isset($article_type)) {
                                if ($mm['article_type'] == $article_type) {
                                    $x++;

                                    if (isset($mm['major'])) {
                                        $ns = substr(strip_tags($mm['major']), 0, 75);
                                        $str = substr($ns, 0, strrpos($ns, ' '));
                                        // echo $str."(...)";
                                        $c = strip_tags($mm['major']);
                                        if (strlen($c) > 90) {
                                            $nd = substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $mm['uri'] . "'>[...]</a>";
                                        } else {
                                            $nd = $c;
                                        }
                                    }

                                    $resultexperts .= '<div class="col mb-4">';
                                    $resultexperts .= '<a href="' . base_url() . "experts/" . $mm['uri'] . '">';
                                    $resultexperts .= '<div class="card people-card border-0 rounded-0 h-100">';
                                    $resultexperts .= '<div class="people-card-image bg-lg-light pt-3 px-3">';
                                    // $resultexperts .= '"<div class='image-container'>"';
                                    $resultexperts .= "<img src='" . base_url() . $mm['image_name'] . "' alt='expert-image' class='img-fluid w-100'></div>";
                                    $resultexperts .= '<div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">';
                                    $resultexperts .= '<h5 class="card-title text-blue">' . implode(' ', array_slice(explode(' ', $mm['title']), 0, 6));
                                    $resultexperts .= '</h5>';
                                    $resultexperts .= '<p class="text-secondary" style="font-weight:500">' . $nd . '</p>';
                                    if (!empty($mm['majorEmail'])) {
                                        $mailto = 'mailto:' . $mm['majorEmail'];
                                    } else {
                                        $mailto = 'mailto:contactus@eria.org';
                                    }
                                    $resultexperts .= '<p class="mail-people"><a href="' . $mailto . '"><i class="fa fa-envelope" style="color: var(--primaryBlue);"></i></a></p>';
                                    $resultexperts .= '</div>';
                                    $resultexperts .= '</div>';
                                    $resultexperts .= '</a>';
                                    $resultexperts .= '</div>';
                                }
                            }
                        }
                    }
                }

                $resultexperts .= '</div>';
                
            } else {
                $resultexperts .= "<div style='text-align: center;font-size: 22px;font-weight: bold;' class='col-md-12 mb-4'>Result Not Found</div>";
            }
        } else {
            $resultexperts .= "<div class='row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3'>";
            
            foreach ($mm_data as $mm) {
                if ($mm['sub_experts'] != '19') {
                    $this->db->select('article_types');
                    $this->db->where('ec_id', $mm['sub_experts']);
                    $query_expert_category = $this->db->get('eria_expert_categories');

                    $expert_category = $query_expert_category->row();
                    if (!empty($expert_category)) {
                        $article_type = $expert_category->article_types;

                        if (isset($article_type)) {
                            if ($mm['article_type'] == $article_type) {
                                $x++;
                                if (isset($mm['major'])) {
                                    $ns = substr(strip_tags($mm['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags($mm['major']);
                                    if (strlen($c) > 90) {
                                        $nd = substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $mm['uri'] . "'>[...]</a>";
                                    } else {
                                        $nd = $c;
                                    }
                                }

                                $resultexperts .= '<div class="col mb-4">';
                                $resultexperts .= '<a href="' . base_url() . "experts/" . $mm['uri'] . '">';
                                $resultexperts .= '<div class="card people-card border-0 rounded-0 h-100">';
                                $resultexperts .= '<div class="people-card-image bg-lg-light pt-3 px-3">';
                                // $resultexperts .= '"<div class='image-container'>"';
                                $resultexperts .= "<img src='" . base_url() . $mm['image_name'] . "' alt='expert-image' class='img-fluid w-100'></div>";
                                $resultexperts .= '<div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">';
                                $resultexperts .= '<h5 class="card-title text-blue">' . implode(' ', array_slice(explode(' ', $mm['title']), 0, 6));
                                $resultexperts .= '</h5>';
                                $resultexperts .= '<p class="text-secondary" style="font-weight:500">' . $nd . '</p>';
                                if (!empty($mm['majorEmail'])) {
                                    $mailto = 'mailto:' . $mm['majorEmail'];
                                } else {
                                    $mailto = 'mailto:contactus@eria.org';
                                }
                                $resultexperts .= '<p class="mail-people"><a href="' . $mailto . '"><i class="fa fa-envelope" style="color: var(--primaryBlue);"></i></a></p>';
                                $resultexperts .= '</div>';
                                $resultexperts .= '</div>';
                                $resultexperts .= '</a>';
                                $resultexperts .= '</div>';
                            }
                        }
                    }
                }
            }
            
            $resultexperts .= '</div>';
        }

        echo $resultexperts;
    }
}