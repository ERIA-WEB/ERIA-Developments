<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Programmes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(3);
        
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.webp';
            $title_meta = 'Database And Programmes';
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

        $data['m_menu'] = 'about';
        $data['categories'] = $this->frontModel->get_catogery('categories');
        $data['content'] = 'front-end/content/programmes';

        $this->load->view('front-end/common/template', $data);
    }

    public function Programmes_article_detail($id)
    {
        $article_type = 'articles';
        $article = $this->frontModel->getArticleInProgrammes($id, $article_type);

        $content = $this->Page_model->getPage_content(7);
        
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
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;
        $data['m_menu'] = 'about';

        if (!empty($article)) {
            $data['article'] = $article;

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

                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'articles');
            } else {
                // $data['related'] = $this->frontModel->get_newlikeArticle('articles', $id);
                $data['related'] = $this->frontModel->get_related_article('articles', $id); // before param is "articles"
            }

            $data['count_related'] = count($relateds);

            // Related Publication
            $publication_related = $this->frontModel->getRelatedArticleForPublication($article_id);

            if (count($publication_related) > 0 and count($publication_related) == 2) {
                $data['publ'] = $publication_related;
            } else {
                $data['publ'] = $this->frontModel->getRelatedPublicationLatestDate('publications', $id);
            }
            $data['count_related_publications'] = count($publication_related);
        }
        
        $data['content'] = 'front-end/content/programmes_details';

        $this->load->view('front-end/common/template', $data);
    }

    public function category($id)
    {
        // $content = $this->Page_model->getPage_content(7);
        $content = $this->Page_model->getMetaContentProgrammesSEO($id);
        
        if (!empty($content)) {
            $image_meta = $content['image_name'] ? $content['image_name'] :'v6/assets/logo.webp';
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
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.webp";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;
        $uri2 = $id;
        
        $data['m_menu'] = 'about';
        $data['randome'] = $this->frontModel->get_randomeArticle();
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['categories'] = $this->frontModel->get_catogery('categories');
        $data['catData'] = $this->frontModel->get_pCat($uri2);
        $data['id'] = $uri2;
        $data['content'] = 'front-end/content/programmes_cat';

        $this->load->view('front-end/common/template', $data);
    }

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        if (isset($_POST['region'])) {
            $region = $_POST['region'];
        } else {
            $region = 'all';
        }

        if (isset($_POST['key'])) {
            $key = $_POST['key'];
        } else {
            $key = null;
        }

        if (isset($_POST['sd'])) {
            $sd = $_POST['sd'];
        } else {
            $sd = null;
        }

        if (isset($_POST['ed'])) {
            $ed = $_POST['ed'];
        } else {
            $ed = null;
        }

        // replace caracther string all
        $key_replace = preg_replace('/[^\p{L}\p{N}]/u', '-', $key);

        $get_categories = $this->frontModel->getCategoryByUri(strtolower($key_replace), ['categories', 'subcategories']);
        
        if (!empty($get_categories)) {
            foreach ($get_categories as $categories) {
                $category_id = $categories->category_id;
            }

            $get_topic = $this->frontModel->getTopicByID($category_id);
            
            if (!empty($get_topic)) {
                foreach ($get_topic as $topic_) {
                    $topicId[] = $topic_->article_id;
                }

                $mm = $this->frontModel->getRelatedArticleForProgrammesTopic($topicId, $start, $limit);
                
            } else {
                $mm = array();
            }
        } else {
            $mm = array();
        }
        $output = '';

        $x = 0;

        if (!empty($mm)) {
            $output .= '<div class="row page-content">';
            foreach ($mm as $mm) {
                $x++;
                $author = '';
                if ($mm->author != '') {
                    $author = "<span class='date'>by</span><span class='author'>" . $mm->author . "</span>";
                }

                //  echo $mm->image_name."<br>";
                if ($mm->image_name != '') {
                    if (file_exists(FCPATH . $mm->image_name) && $mm->image_name != '') {
                        $img = base_url() .'get_share_image.php?im='. $mm->image_name;
                    } elseif (file_exists(FCPATH . $mm->image_name) && $mm->image_name != '') {
                        $img = base_url() .'get_share_image.php?im='. $mm->image_name;
                    } else {
                        $url_img_detail = "https://www.eria.org" . $mm->image_name;
                        $response_img_detail = get_headers($url_img_detail, 1);
                        $file_exists_img_detail = (strpos($response_img_detail[0], "404") === false);

                        if ($file_exists_img_detail == 1) {
                            $img = "https://www.eria.org" . $mm->image_name;
                        } else {
                            $img = base_url() . 'get_share_image.php?im='.'/upload/Article.jpg';
                        }
                    }
                } else {

                    $img = base_url() . 'get_share_image.php?im='.'upload/Article.jpg';
                }

                if ($mm->article_type == 'articles') {
                    $type = "Article";
                } else {
                    $type = $mm->article_type;
                }

                $output .= "<div class='col-md-6 col-12 mb-4'>";

                if ($type == 'publications') {
                    $output .= "<div style=' height:220px;  text-align: center;  position: relative; z-index: 5;'> 
                                    <a href='" . base_url() . "database-and-programmes/" . $mm->uri . "'>
                                        <div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div>
                                        <img style='width: 55%; height: 100%; object-fit: contain ' class='responsive' src=" . $img . ">
                                    </a>
                                </div>";
                } else {
                    $output .= "<a href='" . base_url() . "database-and-programmes/" . $mm->uri . "'>
                                    <img class='responsive mb-2' src='" . $img . "' style='height:235px' >
                                </a>";
                }

                // $t = mb_convert_encoding($mm->title, 'HTML-ENTITIES','utf-8');
                $t = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $mm->title);

                $output .= "<div class='category mt-2 d-none'>" . ucfirst($type) . "</div>";
                $output .= "<div class='card-title text-blue'><a href='" . base_url() . "database-and-programmes/" . $mm->uri . "'>" . $t . "</a></div>";
                $output .= "<div>" . $author . "<span class='date hori-line'></span><span class='date'>" . date('j  F Y', strtotime($mm->posted_date)) . "</spa></div></div>";
            }

            $output .= '</div>';
            
        } else {
            $output = '';
        }

        echo $output;
    }
}