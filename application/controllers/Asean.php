<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asean extends CI_Controller
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
            $image_meta = 'v6/assets/logo.webp';
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
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        $data['contentData'] = $content;
        $data['card_type'] = 4;
        $data['card'] = $this->frontModel->getPage_card_order(4);
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['news'] = $this->frontModel->get_highasianArticle();
        $data['latest'] = $this->frontModel->get_latestasianArticle();
        $data['new'] = $this->frontModel->get_article(2, 'publications', null, 'home');
        $data['rg'] = 'all';
        $data['m_menu'] = 'multi';
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
        $data['web'] = $this->frontModel->getMultimedia(243, null);
        $data['pod'] = $this->frontModel->getPodcast('Podcasts');
        $data['news_side'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['nt'] = 'Asean';
        $data['content'] = 'front-end/content/asean';

        $this->load->view('front-end/common/template', $data);
    }

    public function country($type, $stype = null, $country = null, $start = 0, $limit = 10, $key = null)
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
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;
        $data['card_type'] = 5;
        $data['card'] = $this->frontModel->getPage_card_order(5);
        $data['rg'] = urldecode($country);
        $data['m_menu'] = 'multi';
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
        $data['web'] = $this->frontModel->getMultimedia(243, null);
        $data['pod'] = $this->frontModel->getPodcast('Podcasts');
        $data['nt'] = urldecode($country);
        $data['author'] = $this->frontModel->getExpert_su();
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['content'] = 'front-end/content/asean_brows';
        $data['country'] = $country;
        $data['key'] = $key;
        $article_type = ['experts', 'associates', 'keystaffs', 'fellows', 'unclassified']; // , 'boardmessages'
        $data['author'] = $this->frontModel->getPeopleAuthorEditorByArticleTypes($article_type);
        $data['nt'] = $type;

        $this->load->view('front-end/common/template', $data);
    }

    function loadmSearchAsean()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        if (isset($_POST['research_type'])) {
            $type = $_POST['research_type'];
        } else {
            $type = '';
        }

        $author['id'] = $_POST['author'];

        
        $authornames = $this->frontModel->getPeopleByArticleId($author['id']);

        foreach ($authornames as $value) {
            $author['name'][] = $value->name_people;
        }
        
        $country = str_replace('%20', '-', $_POST['region']);
        $key = $_POST['key'];

        $ty = null;

        $mm = $this->frontModel->get_new_searchCat_article_asean($type, $start, $limit, null, $author, $country, $key, $ty);

        $x = 0;
        foreach ($mm as $mm) {
            $x++;

            if ($x == 0) {
                $cd = 'pb-4 my-5';
            } else {
                $cd = 'py-4';
            }

            $nd = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm->content);
            $nsd = strip_tags($nd);
            $str = $this->limit_text($nsd, 25, base_url() . "publications/" . $mm->uri);

            if (file_exists(FCPATH . $mm->image_name) && $mm->image_name != '') {
                $img = base_url() . $mm->image_name;
            } elseif (file_exists(FCPATH . '/resources/images' . $mm->image_name) && $mm->image_name != '') {
                $img = base_url() . 'resources/images' . $mm->image_name;
            } else {
                $url = "https://www.eria.org" . $mm->image_name;
                $response = get_headers($url, 1);
                $file_exists = (strpos($response[0], "404") === false);

                if ($file_exists == 1) {
                    $img = "https://www.eria.org" . $mm->image_name;
                } else {
                    $img = base_url() . "/resources/images/default-image.jpg";
                }
            }

            $output .= "<div class='row search-section " . $cd . " bottom-section-divider p-3' >";
            $output .= "<div   style=' height:220px;  text-align: center;  position: relative; z-index: 5;' class='has-bg-img col-md-5 col-xs-12 mr-md-2 m-0 p-0'>";
            $output .= "<div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div>";
            $output .= "<img style='width: 55%; height: 100%; '  class='responsive' src='" . $img . "'></div>";
            $output .= "<div class='col-md-6 col-xs-12'><div style='margin-top: 0px; padding-top: 0px' class='card-title text-blue'><a href='" . base_url() . "research/" . $mm->uri . "' > " . str_replace(array('â€™','â€“'), "'", $mm->title)  . "</a></div>";
            $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
            $output .= "<div class='description'>" . $str . "</div></div></div>";
        }

        echo $output;
    }

    function loadm_asianSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';
        $type = $_POST['publication'];
        $author = $_POST['author'];
        $country = $_POST['region'];
        $key = $_POST['key'];

        $mm = $this->frontModel->get_searchCat_aseanarticle($type, $start, $limit, null, $author, $country, $key);
        $x = 0;
        foreach ($mm as $mm) {
            $x++;
            if ($x == 0) {
                $cd = 'pb-4 my-5';
            } else {
                $cd = 'py-4';
            }
            $ns = substr(strip_tags($mm->content), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "...";

            if (file_exists(FCPATH . $mm->image_name)) {
                $img = base_url() . $mm->image_name;

                $output .= "<div class='row search-section " . $cd . " bottom-section-divider p-3' >";
                $output .= "<div   style=' height:220px;  text-align: center;  position: relative; z-index: 5;  ' class='has-bg-img col-md-5 col-xs-12 mr-md-2 m-0 p-0'>";
                $output .= "<div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . base_url() . $mm->image_name . ") center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div>";
                $output .= "<img style='width: 55%; height: 100%; '  class='responsive' src='" . $img . "'></div>";
                $output .= "<div class='col-md-6 col-xs-12'><div class='publication-browsing-heading'><a href='" . base_url() . "publications/" . $mm->uri . "' > " . $mm->title . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
            } else {

                $img = "upload/Publication.jpg";

                $output .= "<div class='row search-section  " . $cd . " bottom-section-divider p-3' >";
                $output .= "<div   style=' height:220px;  text-align: center;  position: relative; z-index: 5;  ' class='has-bg-img col-md-5 col-xs-12 mr-md-2 m-0 p-0'>";
                $output .= "<div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url('" . $img . "') center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div>";
                $output .= "<img style='  '  class='responsive' src='" . base_url() . $img . "'></div>";
                $output .= "<div class='col-md-6 col-xs-12'><div class='publication-browsing-heading'><a href='" . base_url() . "publications/" . $mm->uri . "' > " . $mm->title . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
            }
        }

        echo $output;
    }

    function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $region = null;
        $key = $_POST['key'];

        if (isset($_POST['research_type'])) {
            $research_type = $_POST['research_type'];
        } else {
            $research_type = null;
        }
        if (isset($_POST['research'])) {
            $research = $_POST['research'];
        } else {
            $research = null;
        }
        if (isset($_POST['c_type'])) {
            $c_type = $_POST['c_type'];
        } else {
            $c_type = null;
        }

        $output = '';

        $mm = $this->frontModel->get_asianArticle($start, $limit, $region, $key, $research, $research_type, $c_type);

        $x = 0;
        foreach ($mm as $mm) {
            $x++;

            if (file_exists(FCPATH . $mm['image_name'])) {
                $img = $mm['image_name'];
            } else {
                if ($mm['article_type'] == 'articles') {
                    $img = 'upload/Article.jpg';
                }

                if ($mm['article_type'] == 'publications') {

                    if ($mm['pub_type'] == 1) {
                        $img = 'upload/Research_b.jpg';
                        $at = "<a href='" . base_url() . "Research/catogery/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
                    } else {
                        $img = 'upload/Publication.jpg';
                        $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
                    }
                }
            }

            if ($mm['article_type'] == 'publications') {
                if ($mm['pub_type'] == 1) {
                    $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
                } else {
                    $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
                }
            }

            $nc =  count($mm['editornew']) + count($mm['authornew']);
            $aut = '';
            if ($nc != 0) {
                $aut .= "<span class='author'> Writer(s)/Editor(s) : </span>";

                if (count($mm['editornew']) != 0) {

                    $nresult = '';
                    foreach ($mm['editornew'] as $ed) {
                        $nresult .= "<a style=' '  href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                    }

                    $aut .= "<span class='author'>" . rtrim($nresult, ', ') . "</span>";



                    if (count($mm['authornew']) != 0) {
                    }
                }

                if (count($mm['authornew']) != 0) {
                    $fresult = '';
                    foreach ($mm['authornew'] as $ed) {
                        $fresult .= "<a style=' '  href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                    }

                    $aut .= "<span class='author'>" . rtrim($fresult, ', ') . "</span>";
                }
                $aut .= "<br>";
            }

            if ($mm['article_type'] == 'publications') {
                $n = $at . $mm['tags'];
            } else {
                $n = $mm['article_type'] . $mm['tags'];
            }

            $nd = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm['content']);
            $nsd = strip_tags($nd);
            $str = $this->limit_text($nsd, 12);
            $h = $this->limit_text($mm['title'], 9);
            if ($mm['article_type'] == 'publications') {
                if (file_exists(FCPATH . $mm['image_name'])) {
                    $bimg = "<div style='height:220px;  text-align: center;  position: relative; z-index: 5; '><div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;'></div><img style='width: 55%; height: 100%; object-fit: contain ' class='responsive' src=" . base_url() . $img . "></div>";
                } else if ($mm['image_name']) {
                    $bimg = "<div style='height:220px;  text-align: center;  position: relative; z-index: 5; '><div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . "https://www.eria.org" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;'></div><img style='width: 55%; height: 100%; object-fit: contain ' class='responsive' src=" . "https://www.eria.org" . $img . "></div>";
                } else {
                    $bimg = "<img class='responsive' src=" . base_url() . $img . ">";
                }
            } else {
                $bimg = "<img style='height:235px' class='responsive' src=" . base_url() . $img . ">";
            }

            if ($n == "publication") {
                $output .= "<div class='col-md-6 col-12 mb-4 '> " . $bimg;
                $output .= "<div class='category mt-2'>" . $n . "</div>";
                $output .= "<div class='card-title text-blue'>";
                $output .= "<a  href='" . base_url() . "news/details/" . $mm['uri'] . "' >" . str_replace("â€™", "'", $h) . "</a>";
                $output .= "</div>";
                $output .= "<div style='display: grid;'>" . $aut;
                $output .= "<span class='date'>" . date('j  F Y', strtotime($mm['posted_date'])) . "</span></div>";
                $output .= "<div class='description'>ss" . $str;
                $output .= "</div></div>";
            } else {
                $output .= "<div class='col-md-6 col-12 mb-4'> " . $bimg;
                $output .= "<div class='category mt-2'>" . ucfirst($n) . "</div>";
                $output .= "<div class='card-title text-blue'>";
                $output .= "<a href='" . base_url() . "news/details/" . $mm['uri'] . "'>" . str_replace("â€™", "'", $h) . "</a>";
                $output .= "</div>";
                $output .= "<div style='display: grid;'>" . $aut;
                $output .= "<span class='date'>" . date('j  F Y', strtotime($mm['posted_date'])) . "</span></div>";
                $output .= "<div class='description'>" . $str;
                $output .= "</div></div>";
            }
        }

        echo $output;
    }
}