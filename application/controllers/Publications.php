<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publications extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(6);
        
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

        $data['topics'] = $this->frontModel->getTopic('topics', null); //$this->frontModel->get_catogery('topics');
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['m_menu'] = 'pub';
        $data['news'] = $this->frontModel->getPublicationForHighlight(1);
        $data['latest'] = $this->frontModel->get_article(12, 'publications', null, 'home');
        $data['new'] = $this->frontModel->get_article(2, 'co-publications', null, 'home');

        $start = 0;
        $limit = 4;
        $type = 'all';
        $cato = 'all';
        $key = '';
        $latest_publications = $this->frontModel->get_newsearchCat_article($type, $start, $limit, $cato, $key);

        $data['latest_publications'] = $latest_publications;
        $data['content'] = 'front-end/content/publications';

        $this->load->view('front-end/common/template', $data);
    }

    public function Detail($id)
    {
        // $article = $this->frontModel->get_inArticle($id);
        $article = $this->frontModel->getInArticleResearch($id, 'publications');
        $content = $this->Page_model->getPage_content(6);
        if (!empty($article)) {
            $image_meta = $article->thumbnail_image ? $article->thumbnail_image :$article->image_name;
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
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "ERIA: Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;

        if (!empty($article)) {    
            $data['article'] = $article;
            
            $ed = $this->frontModel->getPerson($article->article_id, 'Editor', 'Inside');

            $data['editor'] = $ed;

            $au = $this->frontModel->getPerson($article->article_id, 'Author', 'Inside');

            $data['author'] = $au;

            $tag = explode(',', $article->tags);

            $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);
            $data['cat'] = $this->frontModel->get_articleCatogery($article->article_id);
            
            $pdf = $this->frontModel->load_pdf($id);
            $data['pdf'] = $pdf;

            $cards = $this->frontModel->getArticle_card_order($article->article_id);
            $data['card'] = $cards;

            $article_id = $article->article_id;
            $relateds = $this->frontModel->get_article_id_by_related($article_id);

            // Related Article
            if (count($relateds) > 0 and count($relateds) == 3) {
                foreach ($relateds as $related_s) {
                    $relatedid[] = $related_s['to_article_id'];
                }
                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'news');
            } else {
                // $data['related'] = $this->frontModel->get_newlikeArticle('articles', $id);
                $data['related'] = $this->frontModel->get_related_article('news', $id);
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
        
        $topicData = $this->frontModel->getTopicData($id);
        $data['topics'] = $topicData;
        $data['m_menu'] = 'pub';
        $data['content'] = 'front-end/content/publications_details';

        $this->load->view('front-end/common/template', $data);
    }

    function countLimitSession()
    {
        $input = $_GET;

        // echo "<pre>";
        // print_r($input['start']);
        // exit(); 
        $cookie_limit = $input['limit'];
        $cookie_start = $input['start'];
        $cookies = [
            'start'     => $cookie_limit,
            'limit'     => $cookie_start,
        ];

        // setcookie("param", json_encode($cookies), time()+15*24*60*60);
        
        $data = [
            'startclick'    => $cookie_start,
            'limitclick'   => $cookie_limit,
        ];
        
        echo json_encode($data);
    }
    
    public function Brows($type, $stype = null, $country = null, $start = 0, $limit = 10, $key = null)
    {
        $content = $this->Page_model->getPage_content(6);
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
        $data['card_type'] = 6;
        $data['card'] = $this->frontModel->getPage_card_order(6);

        if ($this->input->get('author')) {
            $author = $this->input->get('author');
        } else {
            $author = null;
        }

        $data['country'] = $country;

        $data['sub'] = $stype;

        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('topics');

        $data['author'] = $this->frontModel->getExpert_su();

        $data['key'] = $key;

        $data['m_menu'] = 'pub';
        $data['pub'] = $this->frontModel->get_catogery('pubtypes');
        $data['related'] = $this->frontModel->getCat_article($type, $start, $limit, $author);
        $data['nt'] = $type;
        $data['content'] = 'front-end/content/publications_brows';
        $this->load->view('front-end/common/template', $data);
    }


    public function type($type, $stype = null, $country = null, $start = 0, $limit = 10, $key = null)
    {
        // $content = $this->Page_model->getPage_content(6);
        $content = $this->Page_model->getMetaContentPublicationSEO($type);
        
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
        $data['card_type'] = 6;
        $data['card'] = $this->frontModel->getPage_card_order(6);


        if ($this->input->get('author')) {
            $author = $this->input->get('author');
        } else {
            $author = null;
        }

        $data['country'] = $country;

        $data['sub'] = $stype;

        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('topics');

        $article_type = ['experts', 'associates', 'keystaffs', 'fellows', 'unclassified']; // , 'boardmessages'
        $data['author'] = $this->frontModel->getPeopleAuthorEditorByArticleTypes($article_type);
        // $data['author'] = $this->frontModel->getExpert_su();

        $data['key'] = $key;

        $data['m_menu'] = 'pub';
        $data['pub'] = $this->frontModel->get_catogery('pubtypes');


        if ($type == 'co-publications') {
            $get_categories = $this->frontModel->getCategoryByCategoryType('pubtypes');
            
            foreach ($get_categories as $cat_) {
                
                if ($cat_->category_name != 'Co-Publications') {
                    $uri[] = $cat_->uri;
                } else {
                    $uri = array();
                }
            }
            
            $type = $uri;
            $data['nt'] = 'co-publications';
        } else {
            $data['nt'] = $type;
            $type = $type;
        }

        $data['related'] = $this->frontModel->getCat_article($type, $start, $limit, $author);
        $data['content'] = 'front-end/content/publications_brows';

        $this->load->view('front-end/common/template', $data);
    }


    public function Brows_with_out_cover()
    {
        $data['m_menu'] = 'pub';
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/brows_with_out_cover';
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

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        
        if (isset($_POST['research_type'])) {
            $type = $_POST['research_type'];
            $count_research_type = count($_POST['research_type']);
        } else {
            if ($_POST['publication'] == 'co-publications') {
                $get_categories = $this->frontModel->getCategoryByCategoryType('pubtypes');

                foreach ($get_categories as $cat_) {
                    if (strpos($cat_->uri, 'co-publications') !== false) {
                        $uri[] = $cat_->uri;
                    }
                }

                $type = $uri;
            } else {
                $type = $_POST['publication'];
            }

            $count_research_type = 0;
        }
        
        $author['id'] = $_POST['author'];
        
        $authornames = $this->frontModel->getPeopleByArticleId($author['id']);
        
        foreach ($authornames as $value) {
            $author['name'][] = $value->name_people;
        }
        
        if (isset($authornames)) {
            $count_author = count($authornames);
        } else {
            $count_author = 0;
        }
        $country = $_POST['region'];
        
        if (isset($country) AND $country != 'all') {
            $count_region = count($_POST['region']);
        } else {
            $count_region = 0;
        }

        $key = $_POST['key'];

        $ty = null;

        $mm = $this->frontModel->get_new_searchCat_article($type, $start, $limit, null, $author, $country, $key, $ty);

        $output = '';

        $output = '<input type="hidden" id="count_author" value='.$count_author.'>
                    <input type="hidden" id="count_research_type" value='.$count_research_type.'>
                    <input type="hidden" id="count_region" value='.$count_region.'>
                    <script>
                        var count_author = $("#count_author").val();
                        var count_publication_type = $("#count_research_type").val();
                        var count_region = $("#count_region").val();
                        if (count_author > 0) {
                            $("#countAuthor").html("(" + count_author + ")");
                        }
                        
                        if (count_publication_type > 0) {
                            $("#countPublicationType").html("(" + count_publication_type + ")");
                        }
                        
                        if (count_region > 0) {
                            $("#countRegion").html("(" + count_region + ")");
                        }
                        
                    </script>';

        if (!empty($mm)) {
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
                $output .= "<div   style=' height:220px;  text-align: center;  position: relative; z-index: 5;  ' class='has-bg-img col-md-5 col-xs-12 mr-md-2 m-0 p-0'>";
                $output .= "<div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div>";
                $output .= "<img style='width: 55%; height: 100%; '  class='responsive' src='" . $img . "' alt='" . str_replace(array('â€™','â€“'), "'", $mm->title)  . "'></div>";
                $output .= "<div class='col-md-6 col-xs-12'><div style='margin-top: 0px; padding-top: 0px' class='card-title text-blue'><a href='" . base_url() . "publications/" . $mm->uri . "' > " . str_replace(array('â€™','â€“'), "'", $mm->title)  . "</a></div>";
                $output .= "<div><span class='date'>" . date('j F Y', strtotime($mm->posted_date)) . "</span></div>";
                $output .= "<div class='description'>" . $str . "</div></div></div>";
            }
        } else {
            // $this->load->view('front-end/content/404/notFound');

            $output .= '';
        }
        

        echo $output;
    }

    function RemoveBS($Str)
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

    function get_author($authors)
    {
        $author_str = str_replace(array(',',', '), ', ', $authors);

        $a2 = explode(', ', $author_str);
        
        foreach ($a2 as $key_author => $value_author) {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
            $this->db->where('title', $value_author);
            $peopleauthorresult = $this->db->get('articles')->row();

            if (isset($peopleauthorresult)) {
                $peoples_author[] = '<a href="' . base_url() . 'experts/' . $peopleauthorresult->uri . '">' . $peopleauthorresult->title . '</a>';
            } else {
                $peoples_author[] = $value_author;
            }
        }

        $authors = implode(', ', $peoples_author);

        return $peoples_author;
    }

    function get_editor($editors)
    {
        $editor_str = str_replace(array(',',', '), ', ', $editors);
        $a1 = explode(', ', $editor_str);
        
        foreach ($a1 as $key_editor => $value_editor) {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
            $this->db->where('title', $value_editor);
            $peopleeditorresult = $this->db->get('articles')->row();

            if (isset($peopleeditorresult)) {
                $peoples_editor[$key_editor] = '<a href="' . base_url() . 'experts/' . $peopleeditorresult->uri . '">' . $peopleeditorresult->title . '</a>';
            } else {
                $peoples_editor[$key_editor] = $value_editor;
            }
        }
        
        $editors = implode(', ', $peoples_editor);

        return $peoples_editor;
    }

    function getDataLatestPublications()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        $type = $_POST['publication'];
        $cato = $_POST['cato'];
        $key = $_POST['key'];

        $latestpublications = $this->frontModel->get_newsearchCat_article($type, $start, $limit, $cato, $key);
        
        $x = 0;
        foreach ($latestpublications as $key => $mm) {
            $x++;
            $ath = '';
            $nresult = '';
            $nnresult = '';

            $nc =  count($mm['editornew']) + count($mm['authornew']);
            $ath .= "<div style='padding-top:10px; display: none'>";
            $ath .= "<span class='font-merriweather fs-xs'>Editor(s)/Author(s) : </span>";
            $ath .= "</div>";
            $ath .= "<div class='pb-au-sec' style=' '><span class='author'>";

            foreach ($mm['editornew'] as $ed) {
                $nresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
            }

            $ath .= rtrim($nresult, ', ') . "</span><span class='author'>";
            foreach ($mm['authornew'] as $ed) {
                $nnresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
            }

            $ath .= rtrim($nnresult, ', ') . "</span><span style='color: black' class='book-by-author'>" . $mm['author'] . "</span><span style='color: black' class='book-by-author'>" . $mm['editor'] . "</span></div>";

            if ($x % 2 == 0) {
                $o = '';
            } else {
                $o = 'nborder';
            }

            if ($mm['cat'])
            {
                $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
            } else {
                $at = 'Publication' . str_replace(',', ', ', $mm['tags']);
            }
                 
            if ($mm['thumbnail_image'] != '') {
                $img = base_url() . $mm['thumbnail_image'];
            } else {
                if ($mm['image_name'] != '') {
                    if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                        $img = base_url() . $mm['image_name'];
                    } elseif (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                        $img = base_url() . $mm['image_name'];
                    } else {
                        $url_img_detail = "https://www.eria.org" . $mm['image_name'];
                        $response_img_detail = get_headers($url_img_detail, 1);
                        $file_exists_img_detail = (strpos($response_img_detail[0], "404") === false);

                        if ($file_exists_img_detail == 1) {
                            $img = "https://www.eria.org" . $mm['image_name'];
                        } else {
                            $img = base_url() . "/upload/thumbnails-pub.jpg";
                        }
                    }
                } else {

                    $img = base_url() . "/upload/thumbnails-pub.jpg";
                }
            }
            
            $c = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $mm['title']);
            $output .= "<div class='col-md-6 d-lg-flex align-items-lg-start mb-4 mb-lg-5" . $o . " '>";
            $output .= "<div class='publications-image'>
                            <a href='" . base_url() . "publications/" . $mm['uri'] . "'>
                                <img class='responsive pub-img' src='" . $img . "' alt='".$c."'>
                            </a>
                        </div>";

            $output .= '<div class="mt-3 mt-lg-0 pl-lg-4">';
            $output .= "<div class='category mb-2'>" . $at . "</div>";
            $output .= "<div class='card-title'><a href='" . base_url() . "publications/" . $mm['uri'] . "'>" . str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($c, 50)) . "</a></div>";
            $output .= "<p class='date mb-2'> " . $mm['posted_date'] . " </p>";

            // author
            if (!empty($mm['author'])) {
                $authors[$key] = $this->get_author($mm['author']);
            } else {
                $authors[$key] = array();
            }
            
            // editor
            if (!empty($mm['editor'])) {
                $editors[$key] = $this->get_editor($mm['editor']);
            } else {
                $editors[$key] = array();
            }

            if (!empty($authors[$key]) AND !empty($editors[$key])) {
                $author_editor_merge = array_unique(array_merge($authors[$key], $editors[$key]));
                $people_author_editors = implode(', ', $author_editor_merge);
            } elseif (!empty($authors[$key]) OR empty($editors[$key])) {
                $people_author_editors = implode(', ', $authors[$key]);
            } elseif (empty($authors[$key]) OR !empty($editors[$key])) {
                $people_author_editors = implode(', ', $editors[$key]);;
            } else {
                $people_author_editors = '';
            }

            if (!empty($people_author_editors)) {
                
                $output .= '<div>
                                <span class="font-merriweather fs-xs text-blue">Editor(s)/Author(s) : </span>
                            </div>
                            <div class="pb-au-sec d-block">
                                <span class="author">
                                    '.$people_author_editors.'
                                </span>
                            </div>';
            } else {
                $output .= '';
            }
            

            // $getAuthorEditorHighLIght = $this->frontModel->getHighlightByArticleId($mm['article_id']);
            
            // if (!empty($getAuthorEditorHighLIght) and count($getAuthorEditorHighLIght) > 0) {

            //     foreach ($getAuthorEditorHighLIght as $value) {
            //         $getAuthorEditor = $this->frontModel->getPeopleAuthorEditorByArticleId($value->ec_id);

            //         $people_data[] = [
            //             'article_id' => $getAuthorEditor->article_id,
            //             'title' => $getAuthorEditor->title,
            //             'uri'   => $getAuthorEditor->uri,
            //         ];
            //     }

            //     foreach ($people_data as $value) {
            //         $people_title[] = $value['title'];
            //         $people_uri[] = $value['uri'];
            //     }

            //     $output .= '<div>
            //                     <span class="font-merriweather fs-xs text-blue">Editor(s)/Author(s) : </span>
            //                 </div>
            //                 <div class="pb-au-sec d-block">
            //                     <span class="author">
            //                         <a href="' . base_url() . 'experts/' . $people_uri . '">' . implode(' , ', $people_title) . '</a>
            //                     </span>
            //                 </div>';
            // } else {
            //     $slug_author = str_replace(",", ", ", $mm['author']);
            //     $get_slug_author = explode(', ', $slug_author);

            //     $sortir_author = array_unique($get_slug_author, SORT_REGULAR);

            //     $slug_editor = str_replace(",", ", ", $mm['editor']);
            //     $get_slug_editor = explode(', ', $slug_editor);

            //     $sortir_editor = array_unique($get_slug_editor, SORT_REGULAR);

            //     $merging = array_unique(array_merge($sortir_author, $sortir_editor), SORT_REGULAR);
                
            //     $output .=
            //     '<div>
            //             <span class="font-merriweather fs-xs text-blue font-weight-semibold">Editor(s)/Author(s): </span>
            //         </div>
            //         <div class="pb-au-sec d-block">';

            //     if (isset($merging) and count($merging) > 0) {
            //         for ($i = 0; $i < count($merging); $i++) {
            //             if (!empty($merging[$i])) {
            //                 $merge_people[$i] = '<a href="' . base_url() . 'experts/' . str_replace(array(" ", ".", "--"), "-", preg_replace('/ /', ' ',  strtolower($merging[$i]), 1)) . '" target="_blank"><span class="author">' . $merging[$i] . '</span></a>';
            //             }
            //         }

            //         if (isset($merge_people)) {
            //             $output .= implode(', ', $merge_people);
            //         }
                    
            //     } else {
            //         $output .= "";
            //     }
                
            //     $output .= '</div>';
            // }
            
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
        }
        
        echo $output;
    }

    function loadinsideSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        if (isset($_POST['key'])) {
            $key = $_POST['key'];
        } else {
            $key = '';
        }
        
        if (isset($_POST['research_type'])) {
            $publication = $_POST['research_type'];
            $count_research_type = count($_POST['research_type']);
        } else {
            $publication = 'all';
            $count_research_type = 0;
        }

        if (isset($_POST['region'])) {
            $region = $_POST['region'];
            $count_region = count($_POST['region']);
        } else {
            $region = 'all';
            $count_region = 0;
        }

        if (isset($_POST['research'])) {
            $cato = $_POST['research'];
            $count_research = count($_POST['research']);
        } else {
            $cato = 'all';
            $count_research = 0;
        }

        $mm = $this->frontModel->getResearch_Search('topics', $start, $limit, $publication, $region, $key, $cato);
        
        $output = '';

        $output = '<input type="hidden" id="count_topics" value='.$count_research.'>
                    <input type="hidden" id="count_research_type" value='.$count_research_type.'>
                    <input type="hidden" id="count_region" value='.$count_region.'>
                    <script>
                        var count_topics = $("#count_topics").val();
                        var count_publication_type = $("#count_research_type").val();
                        var count_region = $("#count_region").val();
                        if (count_topics > 0) {
                            $("#countTopics").html("(" + count_topics + ")");
                        }
                        
                        if (count_publication_type > 0) {
                            $("#countPublicationType").html("(" + count_publication_type + ")");
                        }
                        
                        if (count_region > 0) {
                            $("#countRegion").html("(" + count_region + ")");
                        }
                        
                    </script>';

        if (!empty($mm)) {
            foreach ($mm as $mm) {
                $n = preg_replace("/<h2(.*)<\/h2>/iUs", "", $mm['content']);

                $ns = substr(strip_tags($n), 0, 130);
                $str = substr($ns, 0, strrpos($ns, ' '));
                $cn = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $str);

                if (file_exists(FCPATH . $mm['image_name'])) {
                    $img = $mm['image_name'];
                } else {
                    if ($mm['article_type'] == 'articles') {
                        $img = 'upload/Article.jpg';
                    }
                }

                $s = '';
                $nc =  count($mm['editornew']) + count($mm['authornew']);

                if ($nc != 0) {
                    $s .= "<span class='author'>Writer(s)/Editor(s) : ";

                    if (count($mm['editornew']) != 0) {
                        foreach ($mm['editornew'] as $ed) {
                            $s .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $ed->title) . "</a>, ";
                        }
                    }

                    if (count($mm['authornew']) != 0) {
                        foreach ($mm['authornew'] as $ed) {
                            $s .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $ed->title) . "</a>, ";
                        }
                    }

                    $s = $s . "</span><br>";
                }


                $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm['content']);
                $ns = strip_tags($n);
                $cn = $this->limit_text($ns, 18, base_url() . "publications/" . $mm['uri']);
                $nk = str_replace("â€”", "-", $mm['title']);
                $k =  str_replace("â€™", "'", $this->limit_text($nk, 50));

                if (substr($mm['cat'], 1) != '') {
                    if(!empty($mm['cat'])) {
                        $publication_type = explode(', ', $mm['cat']);
                        foreach ($publication_type as $key => $val_cat) {
                            if (!empty($val_cat)) {
                                $publicationType[$key] = '<a href="'.base_url().'publications/category/'.str_replace(array(" ", ": ", ", "), "-", strtolower($val_cat)).'">'.ucfirst($val_cat).'</a>:<br>';
                            } else {
                                $publicationType = array();
                            }
                        }
                        
                        if (!empty($publicationType)) {
                            $headTitle =  implode(", ", array_slice($publicationType, 0, 1));
                        } else {
                            $headTitle = '';
                        }
                    } else {
                        $headTitle = "";
                    }
                    
                } else {
                    $headTitle = "";
                }

                $tag_limit = implode(', ', $mm['tags']);
                
                if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                    $img_thumb = base_url() . $mm['image_name'];
                } else {
                    $url_image = "https://www.eria.org" . $mm['image_name'];
                    $get_headers = @get_headers($url_image, 1);
                    
                    if ($get_headers == 1) {
                        if (!empty($mm['image_name'])) {
                            $img_thumb = "https://www.eria.org" . $mm['image_name'];
                        } else {
                            $img_thumb = base_url() . "upload/Publication.jpg";
                        }
                    } else {
                        $img_thumb = base_url() . "upload/Publication.jpg";
                    }
                }
                
                // if ($mm['article_type'] == 'publications' && file_exists(FCPATH . $mm['image_name'])) {
                    
                //     if (file_exists(FCPATH . $mm['image_name'])) {
                //         $img_thumb = base_url().$mm['image_name'];
                //     } else {
                //         $img_thumb = base_url().'upload/Publication.jpg';
                //     }
                // } else {

                //     if (!empty($mm['image_name']) and file_exists(FCPATH . $mm['image_name'])) {
                //         $img_thumb = base_url().$mm['image_name'];
                //     } else {
                //         $img_thumb = base_url().'upload/Publication.jpg';
                //     }
                // }

                if ($mm['article_type'] === 'publications') {
                    $output .= '<div class="col-md-6 d-lg-flex align-items-lg-start mb-4 mb-lg-5nborder">
                                <div class="publications-image">
                                    <img class="responsive pub-img" src="' . $img_thumb . '" alt="'. str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $k) .'">
                                </div>
                                <div class="mt-3 mt-lg-0 pl-lg-4">
                                    <div class="card-title text-blue">
                                        <a href="'. base_url() . "publications/" . $mm['uri'] .'">'. str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $k) .'</a>
                                    </div>
                                    <div class="category mb-2">
                                        '. $headTitle . $tag_limit .'
                                    </div>
                                    <p class="date font-merriweather mb-0">'. $mm['posted_date'] .'</p>
                                    <div class="description">
                                        '. $cn .'
                                    </div>
                                    <div class="d-none">
                                        <span>Editor(s)/Author(s) : </span>
                                    </div>
                                    <div class="pb-au-sec d-none">
                                        <span class="author"></span>
                                        <span class="author"></span>
                                    </div>
                                </div>
                            </div>';
                }
                
            }
        } else {
            
            $output .= "<style>#ldmrSearch { display: none; }</style>";
        }

        echo $output;
    }
    
    function loadMPublicationSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';
        $key = $_POST['key'];

        if (!empty($_POST['cato']) & isset($_POST['cato'])) {
            $cato = $_POST['cato'];

            $article_topics = $this->frontModel->getArticleTopics($cato);

            foreach ($article_topics as $topic_) {
                $topicID[] = $topic_->article_id;
            }
        } else {
            $topicID = [];
        }

        if (!empty($_POST['publication']) & isset($_POST['publication'])) {
            $type = $_POST['publication'];
            $article_categories = $this->frontModel->getArticleCategories($type);

            foreach ($article_categories as $publicationtype_) {
                $publicationType[] = $publicationtype_->article_id;
            }
        } else {
            $publicationType = [];
        }

        $articleID = array_merge($topicID, $publicationType);

        $articles_data = $this->frontModel->getResultSearchPublicationData($start, $limit, $articleID, $key);

        $x = 0;

        if (!empty($articles_data)) {
            foreach ($articles_data as $mm) {
                $x++;
                $ath = '';
                $nresult = '';
                $nnresult = '';

                if ($x == 0) {
                    $cd = 'pb-4 my-5';
                } else {
                    $cd = 'py-4';
                }
                $ns = substr(strip_tags($mm['content']), 0, 200);
                $str = substr($ns, 0, strrpos($ns, ' ')) . "...";

                $nc =  count($mm['editornew']) + count($mm['authornew']);
                $ath .= "<div style='padding-top:10px; display: none'>";
                $ath .= "<span class='font-merriweather fs-xs'>Editor(s)/Author(s) : </span>";
                $ath .= "</div>";
                $ath .= "<div class='pb-au-sec' style=' '><span class='author'>";


                foreach ($mm['editornew'] as $ed) {


                    $nresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                }

                $ath .= rtrim($nresult, ', ') . "</span><span class='author'>";



                foreach ($mm['authornew'] as $ed) {


                    $nnresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                }

                $ath .= rtrim($nnresult, ', ') . "</span><span style='color: black' class='book-by-author'>" . $mm['author'] . "</span><span style='color: black' class='book-by-author'>" . $mm['editor'] . "</span></div>";

                if ($x % 2 == 0) {
                    $o = '';
                } else {
                    $o = 'nborder';
                }

                if ($mm['cat'])
                    $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
                else
                    $at = 'Publication';

                $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm['content']);
                $ns = strip_tags($n);

                if ($mm['image_name'] != '') {
                    if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                        $img = base_url() . $mm['image_name'];
                    } elseif (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                        $img = base_url() . $mm['image_name'];
                    } else {
                        $url_img_detail = "https://www.eria.org" . $mm['image_name'];
                        $response_img_detail = get_headers($url_img_detail, 1);
                        $file_exists_img_detail = (strpos($response_img_detail[0], "404") === false);

                        if ($file_exists_img_detail == 1) {
                            $img = "https://www.eria.org" . $mm['image_name'];
                        } else {
                            $img = base_url() . "/resources/images/default-image.jpg";
                        }
                    }
                } else {

                    $img = base_url() . "/resources/images/default-image.jpg";
                }

                $c = str_replace('â€™', "-", $mm['title']);
                $output .= "<div class='col-md-6 d-lg-flex align-items-lg-start mb-4 mb-lg-5" . $o . " '>";
                $output .= "<div class='publications-image'>
                        <img class='responsive pub-img' src='" . $img . "' alt='".$c."'>
                    </div>";

                $output .= '<div class="mt-3 mt-lg-0 pl-lg-4">';
                $output .= "<div class='category mb-2'>" . $at . $mm['tags'] . "</div>";
                $output .= "<div class='card-title'><a href='" . base_url() . "publications/" . $mm['uri'] . "'>" . str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($c, 50)) . "</a></div>";
                $output .= "<p class='date font-merriweather mb-0'> " . $mm['posted_date'] . " </p>";

                $nc =  count($mm['editornew']) + count($mm['authornew']);
                if ($nc != 0) {
                    $output .= "<p class='font-merriweather fs-xs'>Editor(s)/Author(s) : </p>";
                    $output .= "<div class='pb-au-sec d-block'>
                            <p class='author font-montserrat mb-0'>";
                    foreach ($mm['editornew'] as $ed) {
                        $output .= "<a href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                    }
                    $output .= '</p>';
                    $output .= '<span class="author">';

                    foreach ($mm['authornew'] as $ed) {
                        $output .= "<a href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                    }
                    // echo rtrim($_result, ', ');
                    $output .= '</span>';
                } else {
                    $output .= '<div>
                            <span class="font-merriweather fs-xs">Editor(s)/Author(s) : </span>
                        </div>
                        <div class="pb-au-sec d-block">
                            <span class="author">' . str_replace(",", ",  ", $mm['author']) . '</span>
                            <span class="author">' . str_replace(",", ",  ", $mm['editor']) . '</span>
                        </div>';
                }
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
            }
        } else {
            $output = "<style>#ldmrdown { display: none; }</style>";
        }

        echo $output;
    }

    function loadm_Search()
    {

        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $output = '';

        $type = $_POST['publication'];
        $cato = $_POST['cato'];
        $key = $_POST['key'];

        $mm = $this->frontModel->get_newsearchCat_article($type, $start, $limit, $cato, $key);

        $x = 0;
        foreach ($mm as $mm) {
            $x++;
            $ath = '';
            $nresult = '';
            $nnresult = '';

            if ($x == 0) {
                $cd = 'pb-4 my-5';
            } else {
                $cd = 'py-4';
            }
            $ns = substr(strip_tags($mm['content']), 0, 200);
            $str = substr($ns, 0, strrpos($ns, ' ')) . "...";

            $nc =  count($mm['editornew']) + count($mm['authornew']);
            $ath .= "<div style='padding-top:10px; display: none'>";
            $ath .= "<span class='font-merriweather fs-xs'>Editor(s)/Author(s): </span>";
            $ath .= "</div>";
            $ath .= "<div class='pb-au-sec' style=' '><span class='author'>";


            foreach ($mm['editornew'] as $ed) {


                $nresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
            }

            $ath .= rtrim($nresult, ', ') . "</span><span class='author'>";



            foreach ($mm['authornew'] as $ed) {


                $nnresult .= "<a style=' '  href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
            }

            $ath .= rtrim($nnresult, ', ') . "</span><span style='color: black' class='book-by-author'>" . $mm['author'] . "</span><span style='color: black' class='book-by-author'>" . $mm['editor'] . "</span></div>";

            if ($x % 2 == 0) {
                $o = '';
            } else {
                $o = 'nborder';
            }

            if ($mm['cat'])
                $at = "<a href='" . base_url() . "Publications/Brows/" . $mm['cat']->uri . "'>" . $mm['cat']->category_name . "</a>";
            else
                $at = 'Publication';

            $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm['content']);
            $ns = strip_tags($n);
            $t = $this->limit_text($ns, 20);

            /*if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
            $img = base_url() . $mm['image_name'];
        } elseif (file_exists(FCPATH . '/resources/images' . $mm['image_name']) && $mm['image_name'] != '') {
            $img = base_url() . 'resources/images' . $mm['image_name'];
        } else {
            $url = "https://www.eria.org" . $mm['image_name'];
            $response = get_headers($url, 1);
            $file_exists = (strpos($response[0], "404") === false);
            if ($file_exists == 1) {
                $img = "https://www.eria.org" . $mm['image_name'];
            } else {
                $img = base_url() . "/resources/images/default-image.jpg";
            }
        }*/
            if ($mm['image_name'] != '') {
                if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                    $img = base_url() . $mm['image_name'];
                } elseif (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                    $img = base_url() . $mm['image_name'];
                } else {
                    $url_img_detail = "https://www.eria.org" . $mm['image_name'];
                    $response_img_detail = get_headers($url_img_detail, 1);
                    $file_exists_img_detail = (strpos($response_img_detail[0], "404") === false);

                    if ($file_exists_img_detail == 1) {
                        $img = "https://www.eria.org" . $mm['image_name'];
                    } else {
                        $img = base_url() . "/resources/images/default-image.jpg";
                    }
                }
            } else {

                $img = base_url() . "/resources/images/default-image.jpg";
            }

            $c = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $mm['title']);
            $output .= "<div class='col-md-6 d-lg-flex align-items-lg-start mb-4 mb-lg-5" . $o . " '>";
            $output .= "<div class='publications-image'>
                        <img class='responsive pub-img' src='" . $img . "' alt='".$c."'>
                    </div>";

            $output .= '<div class="mt-3 mt-lg-0 pl-lg-4">';
            $output .= "<div class='category mb-2'>" . $at . $mm['tags'] . "</div>";
            $output .= "<div class='card-title'><a href='" . base_url() . "publications/" . $mm['uri'] . "'>" . str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($c, 50)) . "</a></div>";
            $output .= "<p class='date font-merriweather'> " . $mm['posted_date'] . " </p>";

            $nc =  count($mm['editornew']) + count($mm['authornew']);
            if ($nc != 0) {
                $output .= "<p class='author font-merriweather fs-xs'>Editor(s)/Author(s) : </p>";
                $output .= "<div class='pb-au-sec d-block'>
                            <p class='author font-montserrat mb-0'>";
                foreach ($mm['editornew'] as $ed) {
                    $output .= "<a href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                }
                $output .= '</p>';
                $output .= '<span class="author">';

                foreach ($mm['authornew'] as $ed) {
                    $output .= "<a href='" . base_url() . "experts/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                }
                // echo rtrim($_result, ', ');
                $output .= '</span>';
            } else {
                $output .= '<div>
                            <span class="font-merriweather fs-xs">Editor(s)/Author(s) : </span>
                        </div>
                        <div class="pb-au-sec d-block">
                            <span class="author">' . str_replace(",", ",  ", $mm['author']) . '</span>
                            <span class="author">' . str_replace(",", ",  ", $mm['editor']) . '</span>
                        </div>';
            }
            
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
        }

        echo $output;
    }
}