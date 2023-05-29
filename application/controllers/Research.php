<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Research extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
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
        $content = $this->Page_model->getPage_content(2);
        
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($content->title);
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

        $start_ = 0;
        $limit_ = 30;
        $topic = 'all';
        $key = '';

        $research_data = $this->frontModel->get_catogery_search('topics', $limit_, $start_, $topic, $key);
        
        $data['ptype']          = $this->frontModel->get_catogery('pubtypes');
        $data['topics']         = $this->frontModel->get_catogery('topics');
        $data['card_type']      = 2;
        $data['card']           = $this->frontModel->getPage_card_order(2);
        $data['m_menu']         = 'research';
        $data['page_row']       = $this->frontModel->getPage_content(2);
        $data['news']           = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['multimedia']     = $this->frontModel->getMultimedia(178, null);
        // $data['experts']        = $this->frontModel->get_article(null, 'experts', null, 'home');
        $data['experts']        = $this->frontModel->getExpertsData('experts');
        $data['research_data']  = $research_data;
        $data['content']        = 'front-end/content/research';

        $this->load->view('front-end/common/template', $data);
    }

    function Detail($id)
    {
        $content = $this->Page_model->getPage_content(6);
        
        $article = $this->frontModel->getInArticleResearch($id, 'publications');
        
        if (!empty($article)) {
            $image_meta = $article->thumbnail_image ? $article->thumbnail_image :$article->image_name;
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
        $topicData = $this->frontModel->getTopicData($id);
        $data['topics'] = $topicData;
        $data['m_menu'] = 'pub';
        $data['article'] = $article;

        if (isset($article->article_id)) {
            $ed = $this->frontModel->getPerson($article->article_id, 'Editor', 'Inside');
            $au = $this->frontModel->getPerson($article->article_id, 'Author', 'Inside');

            $data['editor'] = $ed;
            $data['author'] = $au;
            
            $tag = explode(',', $article->tags);

            $data['tags'] = $this->frontModel->taglink($tag, $article->article_type, $article->pub_type);
            $data['cat'] = $this->frontModel->get_articleCatogery($article->article_id);

            $data['card'] = $this->frontModel->getArticle_card_order($article->article_id);

            $article_id = $article->article_id;

            $relateds = $this->frontModel->get_article_id_by_related($article_id);

            // Related Article
            if (count($relateds) > 0 and count($relateds) == 3) {
                foreach ($relateds as $related_s) {
                    $relatedid[] = $related_s['to_article_id'];
                }
                $data['related'] = $this->frontModel->getArticleByArticleId($relatedid, 'news');
            } else {
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
        
        $pdf = $this->frontModel->load_pdf($id);
        $data['pdf'] = $pdf;
        $data['content'] = 'front-end/content/research_details';
        
        $this->load->view('front-end/common/template', $data);
    }

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        if (isset($_POST['research'])) {
            $topic = $_POST['research'];
        } else {
            $topic = 'all';
        }

        $key = $_POST['key'];

        $mm = $this->frontModel->get_catogery_search('topics', $limit, $start, $topic, $key);

        $output = '';

        foreach ($mm as $mm) {


            if (file_exists(FCPATH . $mm->image_name)) {
                $img = $mm->image_name;
            } else {
                $img = 'upload/Research_baer.jpg';
            }

            if ($mm->uri != 'Call_for_Proposals' and  $mm->uri != 'co-publications') {
                $output .= "<div class='col-md-6 research-card-wrapper'>
                            <a href='" . base_url() . "research/category/" . $mm->uri . "'>
                                <div class='img-container'>";
                $output .= "        <img src='" . base_url() . $img . "'>
                                    <div class='overlay-effect h-100 w-100'>
                                        <div class='text-light overlay-text'>" . $mm->category_name . "</div>
                                    </div>
                                </div>
                            </a>
                            </div>";
            }
        }

        echo $output;
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

    function loadPublicationData()
    {
        $input = $_POST;
        
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        $article_type = 'publications';

        if (!empty($input['topics'])) {
            $category_type = 'topics';
            
            if ($input['topics'] == 'education') {
                $topics = 'education-training-and-human-capital';
            } else {
                $topics = $input['topics'];
            }
            $topics = $this->frontModel->getTopicBySlug($topics, $category_type);
            $topic_id = $topics->category_id;
        } else {
            $topic_id = '';
        }

        $results = $this->frontModel->getPublicationResearchByTopics($article_type, $start, $limit, $topic_id);
        
        $output = '';

        foreach ($results as $mm) {
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
            $cn = $this->limit_text($ns, 10, base_url() . "research/" . $mm['uri']);
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
            
            if ($mm['article_type'] == 'publications' && file_exists(FCPATH . $mm['image_name'])) {
                
                if (file_exists(FCPATH . $mm['image_name'])) {
                    $img_thumb = $mm['image_name'];
                } else {
                    $img_thumb = 'upload/Publication.jpg';
                }
            } else {


                if (!empty($mm['image_name']) and file_exists(FCPATH . $mm['image_name'])) {
                    $img_thumb = $mm['image_name'];
                } else {
                    $img_thumb = 'upload/Publication.jpg';
                }
            }

            $output .= '<div class="col-md-6">
                            <div class="row pt-3 pb-3">
                                <div class="col-md-4 col-xs-12 mr-md-2 m-0 p-0" style="text-align: center">
                                    <div style=" position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(' . base_url() . $img_thumb . ') center center; opacity: 0.1; width: 100%; height: 100%;" class="bg"></div>
                                    <img style="width: 100%;height: 100%;" class="responsive" src="'. base_url() . $mm['image_name'] .'">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="category mb-2" style="font-size:12px;">
                                        '. $headTitle . $tag_limit .'
                                    </div>
                                    <div class="card-title text-blue">
                                        <a href="'. base_url() . "research/" . $mm['uri'] .'">'. str_replace("â€“", "'", $k) .'</a>
                                    </div>
                                    <div>
                                    '. $s .'
                                        <span class="date">'. date('j  F Y', strtotime($mm['posted_date'])) .'</span>
                                    </div>
                                    <div class="description">
                                        '. $cn .'
                                    </div>
                                </div>
                            </div>
                        </div>';
        }

        echo $output;
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
        
        $count_article = $this->frontModel->countContentResearchSearch('topics', $publication, $region, $key, $cato);
        
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

        $output .= '<div class="row">';
        
        if (!empty($mm)) {
            foreach ($mm as $key_category => $mm) {
                $n = preg_replace("/<h2(.*)<\/h2>/iUs", "", $mm['content']);

                $ns = substr(strip_tags($n), 0, 130);
                $str = substr($ns, 0, strrpos($ns, ' '));
                $cn = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $str);

                if (file_exists(FCPATH . $mm['image_name'])) {
                    $img = base_url().$mm['image_name'];
                } else {
                    if ($mm['article_type'] == 'articles') {
                        $img = base_url().'upload/Article.jpg';
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
                $cn = $this->limit_text($ns, 18, base_url() . "research/" . $mm['uri']);
                $nk = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $mm['title']);
                $k =  str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($nk, 50));

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
                
                /*
                ** Get Image
                */
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
                // if (!empty($mm['image_name'])) {
                //     if (file_exists(FCPATH . $mm['image_name'])) {
                //         $img_thumb = base_url() . $mm['image_name'];
                //     } else if ($mm['image_name']) {
                //         $img_thumb = "https://www.eria.org" . $mm['image_name'];
                //     } else {

                //         if ($mm['article_type'] == 'publications') {
                //             $img_thumb = base_url() . "upload/Publication.jpg";
                //         } else {
                //             $img_thumb = base_url() . "upload/Article.jpg";
                //         }
                //     }
                // } else {
                //     $img_thumb = base_url() . "upload/Publication.jpg";
                // }

                /*
                ** Author
                */ 
                if (!empty($mm['author'])) {
                    $authors[$key_category] = $this->get_author($mm['author']);
                } else {
                    $authors[$key_category] = array();
                }
                
                /*
                ** Editor
                */
                if (!empty($mm['editor'])) {
                    $editors[$key_category] = $this->get_editor($mm['editor']);
                } else {
                    $editors[$key_category] = array();
                }

                /*
                ** Merge Author & Editor
                */
                if (!empty($authors[$key_category]) AND !empty($editors[$key_category])) {
                    $author_editor_merge = array_unique(array_merge($authors[$key_category], $editors[$key_category]));
                    $people_author_editors = implode(', ', $author_editor_merge);
                } elseif (!empty($authors[$key_category]) OR empty($editors[$key_category])) {
                    $people_author_editors = implode(', ', $authors[$key_category]);
                } elseif (empty($authors[$key_category]) OR !empty($editors[$key_category])) {
                    $people_author_editors = implode(', ', $editors[$key_category]);;
                } else {
                    $people_author_editors = '';
                }

                if (!empty($people_author_editors)) {
                    $authorsAndEditors = '<div class="pb-au-sec d-block">
                                            <p class="font-merriweather fs-xs text-blue mb-0 font-weight-semibold">Editor(s)/Author(s):</p>
                                            <small>'.$people_author_editors.'</small>
                                        </div>';
                } else {
                    $authorsAndEditors = '';
                }
                
                if ($mm['article_type'] == 'publications') {
                    $output .= '<div class="col-md-6">
                                <div class="row pt-3 pb-3 pr-3 pl-3">
                                    <div class="col-md-4 col-xs-12 mr-md-2 m-0 p-0" style="text-align: center">
                                        <a href="'. base_url() . "research/" . $mm['uri'] .'">
                                            <div style=" position: absolute; z-index: -1; top: 0; bottom: unset; left: 0; right: 0; background: url(' . base_url() . $img_thumb . ') center center; opacity: 0.1; width: 100%; height: auto;" class="bg"></div>
                                            <img style="width: 100%;height: auto;" class="responsive" src="'. $img_thumb .'">
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-12 position-relative">
                                        <div class="category mb-2" style="font-size:12px;">
                                            '. $headTitle . $tag_limit .'
                                        </div>
                                        <div class="card-title text-blue">
                                            <a href="'. base_url() . "research/" . $mm['uri'] .'">'. str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $k) .'</a>
                                        </div>
                                        <div>
                                        '. $s .'
                                            <p class="date mb-2">'. date('j  F Y', strtotime($mm['posted_date'])) .'</p>
                                        </div>
                                        '.$authorsAndEditors.'
                                        <div class="description d-none">
                                            '. $cn .'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                } else {
                    $output .= '';
                }
                
            }
        } else {
            $output .= '';
            $output .= '<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                    <script type="text/javascript">
                        $("#ldmrNextSession").remove();
                        $("#ldmr").remove();
                    </script>';
        }
        
        $output .= '</div>';
        
    
        echo $output;
    }

    public function category($id, $key = NULL)
    {
        // $content = $this->Page_model->getPage_content(6);
        $content = $this->Page_model->getMetaContenSEO($id);
        
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
        
        if (!empty($this->frontModel->getCat($id))) {
            $research_categories_data = $this->frontModel->getCat($id);
        } else {
            $research_categories_data = '';
        }
        
        if (isset($_GET['start_rec']) AND isset($_GET['page_size'])) {
            
            $data['start'] = 0;
            $data['limit'] = $_GET['page_size'] + 4;

            if (isset($research_categories_data->category_id)) {
                $topic_research = array($research_categories_data->category_id);
            } else {
                $topic_research = "";
            }
            
            $start = 0;
            $limit = $_GET['page_size'] + 4 - 4;
            $publication_type = 'all';
            $region_ = 'all';
            $key = '';
            
        } else {
            $page = 4;
            $data['start'] = 0;
            $data['limit'] = 8;

            if (isset($research_categories_data->category_id)) {
                $topic_research = array($research_categories_data->category_id);
            } else {
                $topic_research = "";
            }
            
            $start = 0;
            $limit = 4;
            $publication_type = 'all';
            $region_ = 'all';
            $key = '';
            
        }
        
        $result_publications = $this->frontModel->getResearch_Search('topics', $start, $limit, $publication_type, $region_, $key, $topic_research);
        
        if (!empty($result_publications)) {
            $data['result_publications'] = $result_publications;
        } else {
            $data['result_publications'] = array();
        }
    
        $data['card_type'] = 3;
        $data['card'] = $this->frontModel->getPage_card_order(3);
        $data['m_menu'] = 'research';
        
        $recent_news_articles = $this->frontModel->getArticleInResearchPage('news', $id, 3, 3);
        if (!empty($recent_news_articles)) {
            $data['count_recent_news_articles'] = count($recent_news_articles);
        } else {
            $data['count_recent_news_articles'] = 0;
        }
        
        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);
        $data['research_categories_data'] = $research_categories_data;

        if ($id == 'education-training-and-human-capital') {
            $uri = 'education';
        } else {
            $uri = $id;
        }

        $data['slug'] = $uri;
        $data['related'] = $this->frontModel->getArticleInResearchPage('publications', $uri, 0, 6);
        $data['count_related'] = $this->frontModel->countArticleInResearchPage('publications', $uri);
        
        $data['res'] = $id;
        $data['key'] = $key;
        $data['topics'] = $this->frontModel->get_catogery('topics');
        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['content'] = 'front-end/content/research_cat';

        $this->load->view('front-end/common/template', $data);
    }

    function loadRecentArticles()
    {
        $input = $this->input->post();
        
        $article_type = $input['article_type'];
        $uri = $input['uri'];
        $start = $input['start'];
        $limit = $input['limit'];
        
        $related = $this->frontModel->getArticleInResearchPage('news', $uri, $start, $limit);

        $output = '';
        foreach ($related as $value) {

            
            if (file_exists(FCPATH . $value['image_name'])) {
                if (!empty($value['image_name'])) {
                    $img = base_url() . $value['image_name'];
                } else {
                    $img = base_url() . '/upload/news.jpg';
                }
            } else if (empty($value['image_name'])) {
                $img = base_url() . '/upload/news.jpg';
                if ($value['article_type'] == 'articles') {
                    $img = base_url() . 'upload/Article.jpg';
                }

                if ($value['article_type'] == 'publications') {
                    if ($value['pub_type'] == 1) {
                        $img = base_url() . 'upload/Research_b.jpg';
                        $at = "Research";
                    } else {
                        $img = base_url() . 'upload/Publication.jpg';
                        $at = "Publications";
                    }
                }
            } else if ("https://www.eria.org/" . $value['image_name']) {
                $img = "https://www.eria.org/" . $value['image_name'];
            } else {
                $img = base_url() . '/upload/news.jpg';
                if ($value['article_type'] == 'articles') {
                    $img = base_url() . 'upload/Article.jpg';
                }

                if ($value['article_type'] == 'publications') {
                    if ($value['pub_type'] == 1) {
                        $img = base_url() . 'upload/Research_b.jpg';
                        $at = "Research";
                    } else {
                        $img = base_url() . 'upload/Publication.jpg';
                        $at = "Publications";
                    }
                }
            }

            if (substr($value['cat'], 1) != '') {
                if(!empty($value['cat'])) {
                    $publication_type = explode(', ', $value['cat']);
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

            $tag_limit = implode(', ', $value['tags']);

            $t = $this->RemoveBS($value['title']);
            $g =  str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "", $this->limit_text($t, 50));
            $f = str_replace('EUâ€“China', "EU-China", $this->limit_text($g, 50));
            $k = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($f, 50));
            $kl = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $this->limit_text($k, 50));

            $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $value['content']);
            $ns = strip_tags($n);

            // $headTitle
            $output .= '<div class="col-md-6 col-12 mb-4">
                            <a href="'.base_url().'news-and-views/'.$value['uri'].'">
                                <div class="mb-2" style="text-align: center;position: relative;">
                                        <div style=" position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url('.$img.') center center; opacity: 0.1; width: 100%; height: 100%;" class="bg"></div>
                                        <img style="width: 55%; height: 100%; " class="responsive" src="'.$img.'" alt="'.$value['title'].'">
                                </div>
                            </a>
                            <div class="card-title text-blue">
                                <a href="'.base_url().'news-and-views/'.$value['uri'].'">
                                    '.str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "-", $this->limit_text($kl, 50)).'                  
                                </a>
                            </div>
                            <div class="category mb-2">
                                '.$tag_limit.'
                            </div>
                            <div style="display: grid;">
                                <span class="date">
                                '.date('j  F Y', strtotime($value['posted_date'])).'
                                </span>
                            </div>
                            <div class="description">
                                '.$this->limit_text($ns, 11, base_url() . 'news-and-views/' . $value['uri']).'
                            </div>
                        </div>';
        }

        echo $output;
    }

    public function article()
    {
        $article = $this->frontModel->get_inArticle(5182);
        $data['article'] = $article;
        $data['related'] = $this->frontModel->getlikeArticle(null, null);
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/article';

        $this->load->view('front-end/common/template', $data);
    }

    public function publication()
    {
        $article = $this->frontModel->get_inArticle(953);
        $data['article'] = $article;
        $data['related'] = $this->frontModel->getlikeArticle(null, null);
        $data['publ'] = $this->frontModel->getlikeArticle('publications', null);
        $data['title'] = 'ERIA: Economic Research Institute for ASEAN and East Asia';
        $data['content'] = 'front-end/content/publication';

        $this->load->view('front-end/common/template', $data);
    }
}