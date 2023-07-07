<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        /*
        ** Get URL Last
        */
        $last = $this->uri->total_segments();
        $record_url = $this->uri->segment($last);
        /*
        ** ENd
        */
        $content = $this->Page_model->getPage_content(4);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.webp';
            $title_meta = ucwords(str_replace('-', ' ', $record_url));
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
        $data['nt'] = 'News';
        $data['m_menu'] = 'multi';
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
        $data['web'] = $this->frontModel->getMultimedia(243, null);
        $data['pod'] = $this->frontModel->getPodcast('Podcasts');

        $start = 0;
        $limit = 6;
        $type = 'press-releases';

        $data['pressRelease'] = $this->frontModel->get_press_release($start, $limit, $type);
        // $data['pressRelease'] = $this->frontModel->get_article(8, 'news', null, 'home'); // this is old
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
        $slider_row = $this->Page_model->getPage_content(4);
        $data['slider_row'] = $slider_row;
        // this is get cards
        $data['card'] = $this->frontModel->getPage_card_order(7);
        $data['content'] = 'front-end/content/press';

        $this->load->view('front-end/common/template', $data);
    }

    public function country($country)
    {
        $content = $this->Page_model->getPage_content(4);
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
        $data['m_menu'] = 'multi';
        $data['multimedia'] = $this->frontModel->getCountry_article($country);
        $data['country'] = $country;
        $data['content'] = 'front-end/content/country';

        $this->load->view('front-end/common/template', $data);
    }

    public function catogery($country)
    {
        /*
        ** Get URL Last
        */
        $last = $this->uri->total_segments();
        $record_url = $this->uri->segment($last);
        /*
        ** ENd
        */
        $content = $this->Page_model->getPage_content(4);
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.webp';
            $title_meta = ucwords(str_replace('-', ' ', $record_url));
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
        $data['m_menu'] = 'multi';
        $data['multimedia'] = $this->frontModel->getCat_homearticle($country);
        $data['country'] = $country;
        $data['content'] = 'front-end/content/country';

        $this->load->view('front-end/common/template', $data);
    }

    public function details($id)
    {
        $article = $this->frontModel->get_articles_detail_page($id, "news");
        $content = $this->Page_model->getPage_content(4);
        
        if (!empty($article)) {
            $image_meta = $article->image_name ? $article->image_name :'v6/assets/logo.webp';
            $title_meta = $article->title;
            $keyword_meta = $article->meta_keywords ? $article->meta_keywords: str_replace(array("'", "‘", "’"), '', str_replace(' ', ', ', $article->title));
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
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        
        $data['m_menu'] = 'news';
        
        if (!empty($article)) {
            $data['article'] = $article;
            $data['image_galleries'] = $this->frontModel->getArticleImageByArticleId($article->article_id);

            if ($article->tags) {
                $tag = explode(',', $article->tags);

                $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);

            } else {
                $data['tags'] = "";
                $tag = array();
            }
            
            $data['card'] = $this->frontModel->getArticle_card_order($article->article_id);
            $data['cat'] = $this->frontModel->get_articleCatogery($article->article_id);
            $pdf = $this->frontModel->load_pdf($id);
            $data['pdf'] = $pdf;
            $article_id = $article->article_id;
            $data['tags'] = $this->frontModel->tag_topic($article->article_id);

            // Related Articles
            $relateds = $this->frontModel->get_article_id_by_related($article_id);

            if (count($relateds) > 0 and count($relateds) == 3) {
                foreach ($relateds as $related_s) {
                    $relatedid[] = $related_s['to_article_id'];
                }

                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'news');
            } else {
                // $data['related'] = $this->frontModel->get_newlikeArticle('articles', $id);
                $data['related'] = $this->frontModel->get_related_article('news', $id); // before param is "articles"
            }

            $data['count_related'] = count($relateds);
            // Related Publication
            $related_publication = $this->frontModel->getRelatedArticleForPublication($article_id); // getPublicationByRelated

            if (count($related_publication) > 0 and count($related_publication) == 2) {

                $data['publ'] = $related_publication;
            } else {
                $data['publ'] = $this->frontModel->getRelatedPublicationLatestDate('publications', $id);
            }

            $data['count_related_publications'] = count($related_publication);
        }
        
        $data['content'] = 'front-end/content/News-details';

        $this->load->view('front-end/common/template', $data);
    }

    function load_page()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        $article_type = $_POST['article_type'];

        $output = '';
        $mm = $this->frontModel->get_press_release($start, $limit, $article_type);

        foreach ($mm as $news_) {
            /*
            ** Get Images
            */
            if (!empty($news_['image_name'])) {
                if (file_exists(FCPATH . $news_['image_name']) && $news_['image_name'] != '') {
                    $img = base_url() .'get_share_image.php?im='.$news_['image_name'];
                } elseif (file_exists(FCPATH . '/resources/images' . $news_['image_name']) && $news_['image_name'] != '') {
                    $img = base_url() .'get_share_image.php?im='.'/resources/images' . $news_['image_name'];
                } else {
                    if (!empty($news_['image_name'])) {
                        $url_ = "https://www.eria.org" . $news_['image_name'];
                        $response = file_get_contents($url_);
                        if (strlen($response)) {
                            $img = "https://www.eria.org" . $news_['image_name'];
                        } else {
                            $img = base_url() .'get_share_image.php?im='.'/upload/news.jpg';
                        }
                    } else {
                        $img = base_url() .'get_share_image.php?im='.'/upload/news.jpg';
                    }
                }
            } else {
                $img = base_url() .'get_share_image.php?im='.'/upload/news.jpg';
            }

            /*
            ** Get Categories
            */
            $cat = $this->frontModel->get_articleCat($news_['article_id']);
            if (substr($cat, 1) != '') {
                $ss = substr($cat, 1);
            } else {
                $ss = "News";
            }

            /*
            ** Get Tags
            */
            if (!empty($news_['tags'])) {
                $taging = $news_['tags'];
            } else {
                $taging = $this->frontModel->tag_topic_news_and_views($news_['article_id']); // tag_topic
            }

            /*
            ** Get Result Output Html
            */
            $output .= '<div class="col-md-6 pb-4">
                            <div class="card rounded-0 border-0 h-100">
                                <div class="pressroom-card-image">
                                    <a class="card-title" href="' . base_url() . 'news-and-views/' . $news_['uri'] . '">
                                        <img src="' . $img . '" alt="' . $news_['title'] . '" style="height: 252px;">
                                    </a>
                                </div>
                                <div class="card-body bg-light-blue">
                                    <div style="font-size:14px;" class="mb-2">' . ucfirst($ss) . $taging . '</div>
                                    <a class="card-title" href="' . base_url() . 'news-and-views/' . $news_['uri'] . '">
                                        ' . str_replace(array("â€˜", "â€™", "â€“"), "'", $news_['title']) . '
                                    </a>
                                </div>
                                <div class="card-footer bg-light-blue border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar mr-2" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                                    </svg>
                                    <small>' . date('j F Y', strtotime($news_['posted_date'])) . '</small>
                                </div>
                            </div>
                        </div>';
        }

        echo $output;
    }

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';
        // $author=$_POST['author'];
        $country = $_POST['region'];
        $key = $_POST['key'];

        $mm = $this->frontModel->get_pressNews($start, $limit, $country, $key);

        $x = 0;
        foreach ($mm as $mm) {
            $x++;

            if ($x == 0) {
                $cd = 'pb-4 my-5';
            } else {
                $cd = 'py-4';
            }

            $ns = substr(strip_tags($mm->content), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "(...)";

            if (file_exists(FCPATH . $mm->image_name)) {
                $img = base_url() .'get_share_image.php?im='.$mm->image_name;

                $output .= "<div style='  ' class='   medi row py-4 mt-1 bottom-section-divider'>";
                $output .= "<div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
                $output .= "<img class='responsive' src='$img'></div>";
                $output .= "<div class='col-md-7 col-xs-12'>";
                $output .= "<div class='category'>" . ucfirst($mm->article_type) . "</div>";
                $output .= "<div class='card-title'><a href=" . base_url() . 'news/' . $mm->uri . ">" . strip_tags($mm->title) . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
            } else {

                $img = base_url().'get_share_image.php?im='.'upload/news.jpg';

                $output .= "<div class='medi row py-4 mt-1 bottom-section-divider'>";
                $output .= "<div class='col-md-5 col-xs-12 m-0 pr-md-1'>";
                $output .= "<img class='responsive' src='$img'></div>";
                $output .= "<div class='col-md-7 col-xs-12'>";
                $output .= "<div class='category'>" . ucfirst($mm->article_type) . "</div>";
                $output .= "<div class='card-title'><a href=" . base_url() . 'news/' . $mm->uri . ">" . strip_tags($mm->title) . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
            }
        }

        echo $output;
    }
}