<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Multimedia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index($type = NULL)
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
            $data['title'] = 'ERIA: '. $meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        $data['article'] = '';
        if ($type) {
            $data['type'] = $type;
        } else {
            $data['type'] = '';
        }

        // Content data
        $type_video = 'Video';
        $type_webinar = 'Webinar';
        $type_podcasts = 'Podcasts';
        $type_unclassified = 'Unclassified';

        $start = 0;
        $limit = 3;

        $video_data = $this->frontModel->get_all_multimedia($type_video, $start, $limit);
        $webinar_data = $this->frontModel->get_all_multimedia($type_webinar, $start, $limit);
        $podcast_data = $this->frontModel->get_all_multimedia($type_podcasts, $start, $limit);

        $unclassified_data = $this->frontModel->get_all_multimedia($type_unclassified, $start, $limit); // get_unclassified_multimedia

        $data['video_data'] = $video_data;
        $data['webinar_data'] = $webinar_data;
        $data['podcast_data'] = $podcast_data;
        $data['unclassified_data'] = $unclassified_data;
        $data['card_type'] = 8;
        $data['card'] = $this->frontModel->getPage_card_order(8);
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        // $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['topics'] = $this->frontModel->get_catogery('newstopics');
        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['cat'] = $this->frontModel->get_subcatogery('multimedia');
        $data['author'] = $this->frontModel->getExpert_su();
        $data['multimedia'] = $this->frontModel->getPage_multiallarticle('Multimedia', 0, 4);
        $data['web'] = $this->frontModel->getPage_multiallarticle('Podcasts', 0, 4);
        $data['pod'] = $this->frontModel->getPage_multiallarticle('Webinar', 0, 4);
        $data['nt'] = 'Multimedia';
        $data['m_menu'] = 'multi';
        $data['content'] = 'front-end/content/News-Multimedia';

        $this->load->view('front-end/common/template', $data);
    }

    public function views_category()
    {
        $record_num = $this->uri->segment_array();
        $url = end($record_num);

        $type_multimedia = ucfirst($url);

        $content = $this->Page_model->getMetaContenSEO($type_multimedia);
        
        // $content = $this->Page_model->getPage_content(7);
        if (!empty($content)) {
            $image_meta = $content['image_name'] ? $content['image_name'] :'v6/assets/logo.png';
            $title_meta = ucfirst($content['meta_title']);
            $keyword_meta = $content['meta_keywords'] ? $content['meta_keywords']: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $content['meta_description'] ? $content['meta_description']: 'Economic Research Institute for ASEAN and East Asia';

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
        $data['article'] = '';
        if ($type_multimedia == 'unclassified') {
            $multimedia_data = $this->frontModel->getAllCategoryMultimedia($type_multimedia);
            $data['title_category'] = 'Others';
        } else {
            $multimedia_data = $this->frontModel->getAllCategoryMultimedia($type_multimedia);
            $data['title_category'] = $type_multimedia;
        }

        $data['multimedia_data'] = $multimedia_data;

        $type = $type_multimedia;

        if ($type) {
            $data['type'] = $type;
        } else {
            $data['type'] = $type;
        }

        $data['card_type'] = 8;
        $data['card'] = $this->frontModel->getPage_card_order(8);
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        // $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['topics'] = $this->frontModel->get_catogery('newstopics');
        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['cat'] = $this->frontModel->get_subcatogery('multimedia');
        $data['author'] = $this->frontModel->getExpert_su();
        $data['multimedia'] = $this->frontModel->getPage_multiallarticle('Multimedia', 0, 4);
        $data['web'] = $this->frontModel->getPage_multiallarticle('Podcasts', 0, 4);
        $data['pod'] = $this->frontModel->getPage_multiallarticle('Webinar', 0, 4);
        $data['nt'] = 'Multimedia';
        $data['m_menu'] = 'multi';
        $data['content'] = 'front-end/content/NewsCategoryMultimedia';

        $this->load->view('front-end/common/template', $data);
    }

    function limit_text($text, $limit, $link = null)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '<a href="' . $link . '" >[...]</a>';
        }

        return $text;
    }

    function loadm()
    {
        $ty = $_POST['type'];
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        $mm_data = $this->frontModel->getPage_multiallarticle($ty, $start, $limit);

        foreach ($mm_data as $mm) {
            if ($mm->published == 1) {
                if (file_exists(FCPATH . $mm->image_name)) {
                    $img = base_url().'get_share_image.php?im='.$mm->image_name;
                } elseif (file_exists(FCPATH . "resources/images" . $mm->image_name)) {
                    $img = base_url().'get_share_image.php?im='."/resources/images" . $mm->image_name;
                } else {
                    if ($mm->category == 'Webinar') {
                        $img = base_url().'get_share_image.php?im='.'/upload/webinar.jpg';
                    } else {
                        $img = base_url().'get_share_image.php?im='.'/upload/video.jpg';
                    }
                }

                $nd = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm->content);
                $nsd = strip_tags($nd);
                $str = $this->limit_text($nsd, 24, "multimedia/" . $mm->uri);

                $tag = $this->frontModel->tag_topic($mm->article_id);

                $output .= "<div class='medi row pt-4 pb-4 bottom-section-divider'><div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
                $output .= "<img class='responsive' src='" . $img . "' ></div>";
                $output .= "<div class='col-md-7 col-xs-12'><div class='category'>" . ucfirst($mm->article_type) . $tag . "</div>";
                $output .= "<div class='card-title text-blue'><a href='" . base_url() . "multimedia/" . $mm->uri . "'>" . $mm->title . "</a></div><div>";
                $output .= "<span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . str_replace("â€™", "'", $str) . "</div>";
                $output .= "</div></div>";
            }
        }

        echo $output;
    }

    function loadm_web()
    {

        $ty = $_POST['type'];
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        $mm = $this->frontModel->getPage_multiallarticle($ty, $start, $limit);

        foreach ($mm as $mm) {
            if (file_exists(FCPATH . $mm->image_name)) {
                $img = base_url().'get_share_image.php?im='.$mm->image_name;
            } else {
                $img = base_url().'get_share_image.php?im='.'upload/podcast.jpg';
            }

            $ns = substr(strip_tags($mm->content), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "<a href='" . base_url() . "multimedia/" . $mm->uri . "'>[...]</a>";
            $tag = $this->frontModel->tag_topic($mm->article_id);

            $output .= "<div class=' col-md-4 col-12 mb-4 '>";
            $output .= "<img class='responsive' src='" . $img . "' >";
            $output .= "<div class='category mt-3'>" . ucfirst($mm->article_type) . $tag . "</div>";
            $output .= "<div class='card-title text-blue'><a href='" . base_url() . "multimedia/" . $mm->uri . "'>" . $mm->title . "</a></div>";
            $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
            $output .= "</div>";
        }

        echo $output;
    }

    function loadmSearch()
    {
        if (isset($_POST['research'])) {
            $topic = $_POST['research'];
        } else {
            $topic = 'all';
        }

        $cat = 'all';
        $key = $_POST['key'];

        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        $mm = $this->frontModel->getPage_multiallarticle_search($key, $topic, $cat, $start, $limit);

        foreach ($mm as $mm) {
            //echo base_url().$mm->image_name."<br>";
            if (file_exists(FCPATH . $mm->image_name)) {
                $img = base_url().'get_share_image.php?im='.$mm->image_name;
            } else {
                if ($mm->sub_experts == 7)
                    $img = base_url().'get_share_image.php?im='.'upload/webinar.jpg';
                else
                    $img = base_url().'get_share_image.php?im='.'upload/video.jpg';
            }

            $ns = substr(strip_tags($mm->content), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "<a href='" . base_url() . "multimedia/" . $mm->uri . "'>[...]</a>";

            $output .= "<div class='medi row pt-4 pb-4 bottom-section-divider'><div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
            $output .= "<img class='responsive' src='" . $img . "' ></div>";
            $output .= "<div class='col-md-7 col-xs-12'><div class='category'>" . ucfirst($mm->article_type) . "</div>";
            $output .= "<div class='card-title text-blue'><a href='" . base_url() . "multimedia/" . $mm->uri . "'>" . $mm->title . "</a></div><div>";
            $output .= "<span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
            $output .= "<div class='description'>" . str_replace("â€™", "'", $str) . "</div>";
            $output .= "</div></div>";
        }

        echo $output;
    }

    public function pressrelease()
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
            $data['title'] = 'ERIA: '. $meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        $data['m_menu'] = 'multi';
        $data['content'] = 'front-end/content/pressrelease';

        $this->load->view('front-end/common/template', $data);
    }

    function detail_multimedia()
    {
        $record_num = $this->uri->segment_array();
        $url = end($record_num);
        
        $slug = $url;
        // $article = $this->frontModel->get_inArticle($slug);
        $article = $this->frontModel->getArticleDetails($slug, 'multimedia'); // getArticleMultimediaDetail

        $content = $this->Page_model->getPage_content(7);

        if (!empty($article)) {
            $image_meta = $article->image_name ? $article->image_name :'v6/assets/logo.png';
            $title_meta = $article->title;
            $keyword_meta = $article->meta_keywords ? $article->meta_keywords: $article->title;
            $description_meta = $article->meta_description ? $article->meta_description: $article->title;
            
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
        
        if (!empty($article)) {
            $data['m_menu'] = 'multi';
            $data['article'] = $article;

            if ($article->tags) {
                $tag = explode(',', $article->tags);
                $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);
            } else {
                $data['tags'] = "";
            }

            $data['card'] = $this->frontModel->getArticle_card_order($article->article_id);

            $pdf = $this->frontModel->get_inPDF($slug, null);
            $data['pdf'] = $pdf;

            $article_id = $article->article_id;

            // Related Articles
            $relateds = $this->frontModel->get_article_id_by_related($article_id);

            if (count($relateds) > 0 and count($relateds) == 3) {
                foreach ($relateds as $related_s) {
                    $relatedid[] = $related_s['to_article_id'];
                }

                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'news');
            } else {
                $data['related'] = $this->frontModel->get_related_article('news', $slug);
            }
            $data['count_related'] = count($relateds);
            
            // Related Publication
            $related_publication = $this->frontModel->getRelatedArticleForPublication($article_id); // getPublicationByRelated

            if (count($related_publication) > 0 and count($related_publication) == 2) {

                $data['publ'] = $related_publication;
            } else {
                $data['publ'] = $this->frontModel->getRelatedPublicationLatestDate('publications', $article_id);
            }
            $data['count_related_publications'] = count($related_publication);
        }
    
        $data['content'] = 'front-end/content/multimedia_details';
        
        $this->load->view('front-end/common/template', $data);
    }

    public function detail($id)
    {
        $article = $this->frontModel->get_inArticle($id);
        $content = $this->Page_model->getPage_content(7);
        if (!empty($article)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($article->title);
            $keyword_meta = $article->meta_keywords ? $article->meta_keywords: 'eria, economic research, economic research institute, research institute, asean, east asia';
            $description_meta = $article->meta_description ? $article->meta_description: 'Economic Research Institute for ASEAN and East Asia';

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

        if (!empty($article)) {
            $data['m_menu'] = 'multi';
            $article = $this->frontModel->get_inArticle($id);

            $data['article'] = $article;

            if ($article->tags) {
                $tag = explode(',', $article->tags);
                $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);
            } else {
                $data['tags'] = "";
            }

            $data['card'] = $this->frontModel->getArticle_card_order($article->article_id);

            $pdf = $this->frontModel->get_inPDF($id, null);
            $data['pdf'] = $pdf;

            $article_id = $article->article_id;
            $relateds = $this->frontModel->get_article_id_by_related($article_id);

            if (count($relateds) > 0) {
                foreach ($relateds as $related_s) {
                    $relatedid[] = $related_s['to_article_id'];
                }

                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'news');
            } else {
                // $data['related'] = $this->frontModel->get_newlikeArticle('articles', $id);
                $data['related'] = $this->frontModel->get_related_article('articles', $id);
            }

            $data['publ'] = $this->frontModel->get_newlikeArticle('publications', null);
        }
        
        $data['content'] = 'front-end/content/News-Multimedia-detailsv2'; 
        
        $this->load->view('front-end/common/template', $data);
    }
}