<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsMultimedia extends CI_Controller
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
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;

        if ($type) {
            $data['type'] = $type;
        } else {
            $data['type'] = '';
        }

        // Content data
        $type_video = 'Video';
        $type_webinar = 'Webinar';
        $type_podcasts = 'Podcasts';

        $start = 0;
        $limit = 5;

        $video_data = $this->frontModel->get_all_multimedia($type_video, $start, $limit);
        $webinar_data = $this->frontModel->get_all_multimedia($type_webinar, $start, $limit);
        $podcast_data = $this->frontModel->get_all_multimedia($type_podcasts, $start, $limit);

        $data['video_data']     = $video_data;
        $data['webinar_data']   = $webinar_data;
        $data['podcast_data']   = $podcast_data;
        $data['card_type']      = 8;
        $data['card']           = $this->frontModel->getPage_card_order(8);
        $data['ptype']          = $this->frontModel->get_catogery('pubtypes');
        // $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['topics']         = $this->frontModel->get_catogery_multimedia('newstopics');
        $data['news']           = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['cat']            = $this->frontModel->get_subcatogery('multimedia');
        $data['author']         = $this->frontModel->getExpert_su();
        $data['multimedia']     = $this->frontModel->getPage_multiallarticle('Multimedia', 0, 4);
        $data['web']            = $this->frontModel->getPage_multiallarticle('Podcasts', 0, 4);
        $data['pod']            = $this->frontModel->getPage_multiallarticle('Webinar', 0, 4);
        $data['nt']             = 'Multimedia';
        $data['m_menu']         = 'multi';
        $data['content']        = 'front-end/content/News-Multimedia';

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
                    $img = $mm->image_name;
                } elseif (file_exists(FCPATH . "resources/images" . $mm->image_name)) {
                    $img = "resources/images" . $mm->image_name;
                } else {
                    if ($mm->category == 'Webinar') {
                        $img = 'upload/webinar.jpg';
                    } else {
                        $img = 'upload/video.jpg';
                    }
                }

                $nd = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm->content);
                $nsd = strip_tags($nd);
                $str = $this->limit_text($nsd, 24, "NewsMultimedia/detail/" . $mm->uri);
                $tag = $this->frontModel->tag_topic($mm->article_id);
                $output .= "<div class='medi row pt-4 pb-4 bottom-section-divider'><div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
                $output .= "<img class='responsive' src='" . base_url() . $img . "' ></div>";
                $output .= "<div class='col-md-7 col-xs-12'><div class='category'>" . ucfirst($mm->article_type) . $tag . "</div>";
                $output .= "<div class='heading'><a href='" . base_url() . "NewsMultimedia/detail/" . $mm->uri . "'>" . $mm->title . "</a></div><div>";
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

            if ($mm->published == 1) {
                if (file_exists(FCPATH . $mm->image_name)) {
                    $img = $mm->image_name;
                } elseif (file_exists(FCPATH . "resources/images" . $mm->image_name)) {
                    $img = "resources/images" . $mm->image_name;
                } else {
                    $img = 'upload/podcast.jpg';
                }

                $ns = substr(strip_tags($mm->content), 0, 200);
                $str = substr($ns, 0, strrpos($ns, ' ')) . "<a href='" . base_url() . "NewsMultimedia/detail/" . $mm->uri . "'>[...]</a>";
                $tag = $this->frontModel->tag_topic($mm->article_id);

                $output .= "<div class=' col-md-4 col-12 mb-4 '>";
                $output .= "<img class='responsive' src='" . base_url() . $img . "' >";
                $output .= "<div class='category mt-3'>" . ucfirst($mm->article_type) . $tag . "</div>";
                $output .= "<div class='heading'><a href='" . base_url() . "NewsMultimedia/detail/" . $mm->uri . "'>" . $mm->title . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "</div>";
            }
        }

        echo $output;
    }

    function loadmSearch()
    {
        
        if (isset($_POST['topics'])) {
            $_topic = $_POST['topics'];

            foreach ($_topic as $topic_) {
                $topic_id[] = $topic_;
            }

            $topic = $topic_id;
            $count_topics = count($_POST['topics']);
        } else {
            $topic = 'all';
            $count_topics = 0;
        }
        
        if (isset($_POST['cat']) AND $_POST['cat'] != 'Category') {
            $cat = $_POST['cat'];
        } else {
            $cat = 'all';
        }

        $key = $_POST['key'];

        $start = $_POST['start'];
        if (isset($_POST['cat']) || $_POST['cat'] != 'Category' and !empty($_POST['key'])) {
            $limit = $_POST['limit'];
        } else {
            $limit = '';
        }

        if (isset($_POST['subcat'])) {
            $subcat = $_POST['subcat'];
        } else {
            $subcat = '';
        }

        $output = '';
        
        $mm = $this->frontModel->multimedia_search($key, $topic, $cat, $subcat, $start, $limit);
       
        $output = '<input type="hidden" id="count_topics" value='.$count_topics.'>
                    <script>
                        var count_topics = $("#count_topics").val();
                        var count_categories = $("#count_categories").val();
                        if (count_topics > 0) {
                            $("#countTopics").html("(" + count_topics + ")");
                        }
                    </script>';

        $output .= "<div id='multimediaPage' class='pb-3' style='width: 100%'><h2 class='second-title text-blue'>Search Results</h2></div>";
        $output .= '<div class="row">';
        
        foreach ($mm as $mm) {
            if (file_exists(FCPATH . $mm->image_name) AND !empty($mm->image_name)) {
                $img = $mm->image_name;
            } else {
                if ($mm->sub_experts == 7) {
                    $img = 'upload/webinar.jpg';
                } else {
                    $img = 'upload/video.jpg';
                }
            }

            $topics_data = $this->frontModel->getTopicsByArticleId($mm->article_id);

            if (!empty($topics_data)) {
                for ($i = 0; $i < count($topics_data); $i++) {
                    $topic_s[$i] = $topics_data[$i]->category_name;
                }

                $topics_ = implode(', ', $topic_s);
            } else {
                $topics_ = '';
            }
            
            $ns = substr(strip_tags($mm->content), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "<a href='" . base_url() . "multimedia/" . strtolower($mm->category) . "/" . $mm->uri . "'>[...]</a>";

            if ($mm->category == 'Unclassified') {
                $category_multimedia = 'Others';
            } else {
                $category_multimedia = $mm->category;
            }

            $output .= '<div class="col-md-4">
                            <a href="' . base_url() . 'multimedia/' . strtolower($mm->category) . '/' . $mm->uri . '">
                                <div class="card multimedia-video-card rounded-0 border-0">
                                    <div class="video-card-header mb-2">
                                        <img src="' . base_url() . $img . '" alt="' . $mm->title . '">
                                    </div>
                                    <div class="video-card-body">
                                        <small class="category text-uppercase mb-2">' . ucfirst($category_multimedia) . '</small>
                                        <p class="mb-2" style="font-size: 10px;">' . $topics_ . '</p>
                                        <p class="card-title text-blue">' . $mm->title . '</p>
                                        <p class="date">' . date('j F Y', strtotime($mm->posted_date)) . '</p>
                                    </div>
                                </div>
                            </a>
                        </div>';

            // $output.="<div class='medi row pt-4 pb-4 bottom-section-divider'><div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
            // $output.="<img class='responsive' src='".base_url().$img."' ></div>";
            // $output.="<div class='col-md-7 col-xs-12'><div class='category'>".ucfirst($mm->article_type)."</div>";
            // $output.="<div class='heading'><a href='".base_url()."NewsMultimedia/detail/".$mm->uri."'>".$mm->title."</a></div><div>";
            // $output.="<span class='date'>".date('j F Y', strtotime($mm->posted_date))."</span></div>";
            // $output.="<div class='description'>".str_replace("â€™", "'", $str)."</div>";
            // $output.="</div></div>";
        }

        $output .= '</div>';
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
            $data['title'] = 'ERIA: '.$meta_data_contents['title_meta'];
        } else {
            $data['md'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData']    = $content;
        $data['m_menu']         = 'multi';
        $data['content']        = 'front-end/content/pressrelease';

        $this->load->view('front-end/common/template', $data);
    }

    public function detail($id)
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
        $article = $this->frontModel->get_inArticle($id);

        $data['m_menu'] = 'multi';
        $article = $this->frontModel->get_inArticle($id);

        $data['article'] = $article;

        if ($article->tags) {
            $tag = explode(',', $article->tags);

            $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);
        } else {
            $data['tags'] = "";
        }

        $data['card']       = $this->frontModel->getArticle_card_order($article->article_id);
        $pdf = $this->frontModel->get_inPDF($id, null);
        $data['pdf']        = $pdf;
        $data['related']    = $this->frontModel->get_newlikeArticle('articles', null);
        $data['publ']       = $this->frontModel->get_newlikeArticle('publications', null);
        $data['content']    = 'front-end/content/News-Multimedia-detailsv2';
        
        $this->load->view('front-end/common/template', $data);
    }
}