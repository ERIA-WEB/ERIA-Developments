<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update extends CI_Controller
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

    public function Brows($type, $top = null)
    {
        $last = $this->uri->total_segments();
        $record_url = $this->uri->segment($last);
        
        $content = $this->Page_model->getPage_content(7);
        
        if (!empty($content)) {
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucfirst($record_url);
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

        $data['card_type'] = 7;
        $data['card'] = $this->frontModel->getPage_card_order(7);
        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);

        if ($this->input->get('author')) {
            $author = $this->input->get('author');
        } else {
            $author = null;
        }

        if (isset($_POST['key'])) {
            $data['key'] = $_POST['key'];
        } else {
            $data['key'] = null;
        }

        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('newstopics');
        $data['cato'] = $this->frontModel->get_catogery('newscategories');
        $data['author'] = $this->frontModel->getExpert_su();
        $data['m_menu'] = 'pub';
        $data['top'] = $top;
        $data['pub'] = $this->frontModel->get_Updatecatogery();
        // $data['related'] = $this->frontModel->getCat_article($type,$start,$limit,$author);
        $data['nt'] = $type;
        $data['content'] = 'front-end/content/news_brows';

        $this->load->view('front-end/common/template', $data);
    }

    public function type($type, $top = null)
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
            $image_meta = 'v6/assets/logo.png';
            $title_meta = ucwords(str_replace('-', ' ', $record_url));
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

        /*
        ** Get URL Last
        */
        $data['card_type'] = 7;
    
        if ($record_url == 'press-releases') {
            $data['card'] = $this->frontModel->getPage_card_order(1);
        } else {
            $data['card'] = $this->frontModel->getPage_card_order(7);
        }

        $data['news'] = $this->frontModel->get_article(4, 'news', null, 'home');
        $data['multimedia'] = $this->frontModel->getMultimedia(178, null);

        if ($this->input->get('author')) {
            $author = $this->input->get('author');
        } else {
            $author = null;
        }

        if (isset($_POST['key'])) {
            $data['key'] = $_POST['key'];
        } else {
            $data['key'] = null;
        }

        $data['ptype'] = $this->frontModel->get_catogery('pubtypes');
        $data['topics'] = $this->frontModel->get_catogery('newstopics');
        $data['cato'] = $this->frontModel->get_catogery('newscategories');
        $data['author'] = $this->frontModel->getExpert_su();
        $data['m_menu'] = 'pub';
        $data['top'] = $top;
        $data['pub'] = $this->frontModel->get_Updatecatogery();
        // $data['related'] = $this->frontModel->getCat_article($type,$start,$limit,$author);
        $data['nt'] = $type;
        $data['content'] = 'front-end/content/news_brows';

        $this->load->view('front-end/common/template', $data);
    }

    function limit_text($text, $limit, $link = null)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >[...]</a>';
        }
        return $text;
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

    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        
        $output = '';
        
        if (isset($_POST['topic_cat'])) {
            $ntype = $_POST['topic_cat'];
            $count_topics = count($_POST['topic_cat']);
        } else {
            $ntype = null;
            $count_topics = 0;
        }

        if (isset($_POST['topic_new_cat'])) {
            $n_type = $_POST['topic_new_cat'];
            $count_categories = count($_POST['topic_new_cat']);
        } else {
            $n_type = null;
            $count_categories = 0;
        }

        $type = $_POST['publication'];
        $country = $_POST['region'];

        $key = $_POST['key'];

        $mm = $this->frontModel->get_new_updateNews($start, $limit, $type, $n_type, $key, $ntype);
        
        $output = '<input type="hidden" id="count_topics" value='.$count_topics.'>
                    <input type="hidden" id="count_categories" value='.$count_categories.'>
                    <script>
                        var count_topics = $("#count_topics").val();
                        var count_categories = $("#count_categories").val();
                        if (count_topics > 0) {
                            $("#countTopics").html("(" + count_topics + ")");
                        }
                        
                        if (count_categories > 0) {
                            $("#countCategories").html("(" + count_categories + ")");
                        }
                        
                    </script>';
        $x = 0;
        if (!empty($mm)) {
            foreach ($mm as $key => $mm) {
                $x++;

                if ($x == 0) {
                    $cd = 'pb-4 my-5';
                } else {
                    $cd = 'py-4';
                }
                // $ns = substr(strip_tags($mm['content']), 0, 200);
                // $str = substr($ns, 0, strrpos($ns, ' ')) . "...";

                if (!empty($mm['short_des'])) {
                    $nd = $mm['short_des'];
                    $nsd = str_replace('â€˜', "-", strip_tags($this->RemoveBS($nd)));
                    $str = $this->limit_text($nsd, 200, "news-and-views/" . $mm['uri']);
                } else {
                    $nd = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $mm['content']);
                    $nsd = str_replace('â€˜', "-", strip_tags($this->RemoveBS($nd)));
                    $str = $this->limit_text($nsd, 25, "news-and-views/" . $mm['uri']);
                }
                
                if (substr($mm['cat'], 1) != '') {
                    foreach (array_unique(explode(', ', $mm['cat'])) as $x => $value) {
                        if (!empty($value)) {
                            $ss[$x] = '<a href="' . base_url() . 'news-and-views/category/' . strtolower(substr($value, 0)) . '">' . substr($value, 0) . '</a>';
                            $categoryInTheNews[$x] = substr($value, 0);
                        }
                    }
                } else {
                    $ss[$key] = '<a href="' . base_url() . 'news-and-views/category/news">News</a>';
                }

                $t = str_replace('â€˜', "-", $this->limit_text($mm['title'], 50)); // $this->RemoveBS($mm['title'])

                if (file_exists(FCPATH . $mm['image_name']) && $mm['image_name'] != '') {
                    $img = base_url() . $mm['image_name'];
                } else if ($mm['image_name']) {
                    $img = "https://www.eria.org" . $mm['image_name'];
                } else {
                    $img = base_url() . "upload/news.jpg";
                }

                if (!empty($mm['by_editor'])) {
                    $by_editor = '<span class="date">By: <a href="' . base_url() . 'experts/' . str_replace(' ', '-', strtolower($mm['by_editor'])) . '" target="_blank">' . ucfirst($mm['by_editor']) . '</a></span>';
                } else {
                    $by_editor = '';
                }
                
                $categories_updates[$key] = explode(', ', $mm['cat']);
                
                
                for ($i=0; $i < count($categories_updates[$key]); $i++) { 
                    
                    $inTheNews[$key] = $categories_updates[$key][$i];
                }
                
                if ($count_categories == 0 || $count_categories > 1 AND $count_categories != 1) {
                    if (in_array('In the News', $inTheNews)) {
                        if (!empty($mm['link_website'])) {
                            $link_website[$key] = $mm['link_website'];
                        } else {
                            $link_website[$key] = base_url() . 'news-and-views/' . $mm['uri'];
                        }
                    } else {
                        if (!empty($mm['link_website'])) {
                            $link_website[$key] = $mm['link_website'];
                        } else {
                            $link_website[$key] = base_url() . 'news-and-views/' . $mm['uri'];
                        }
                    }

                    $output .= '<div class="col-md-6 search-section ' . $cd . ' p-3">
                                    <div class="mb-2">
                                        <a href="' . $link_website[$key] . '">
                                            <img class="img-fluid" src="' . $img . '" style="aspect-ratio:9/6; object-fit:cover;">
                                        </a>
                                    </div>
                                    <div>
                                        <div style="height: auto" class="category mb-1">' . implode(', ', array_unique($ss)) . $mm['tags'] . '</div>
                                        <div style="height: auto" class="card-title mb-0">
                                            <a href="' . $link_website[$key] . '">' . str_replace(array("â€™"), "’", $t) . '</a>
                                        </div>
                                        <div>
                                        ' . $by_editor . '
                                        </div>
                                        <div>
                                            <span class="date">' . date('j F Y', strtotime($mm['posted_date'])) . '</span>
                                        </div>
                                        <div class="description">
                                            ' . $str . '
                                        </div>
                                    </div>
                                </div>';
                } else {
                    if ($count_categories == 1) {
                        if (!empty($mm['link_website'])) {
                            $link_website[$key] = $mm['link_website'];
                        } else {
                            $link_website[$key] = base_url() . 'news-and-views/' . $mm['uri'];
                        }
                        if (in_array('In the News', $inTheNews)) {
                            $output .= '<div class="col-md-12 search-section ' . $cd . ' p-3">
                                            
                                            <div>
                                                <div style="height: auto" class="card-title mb-0">
                                                    <a href="' . $link_website[$key] . '" target="_blank">' . str_replace(array("â€™"), "’", $t) . '</a>
                                                </div>
                                                <div>
                                                ' . $by_editor . '
                                                </div>
                                                <div>
                                                    <span class="date">' . date('j F Y', strtotime($mm['posted_date'])) . '</span>
                                                </div>
                                                <div class="description">
                                                    ' . $str . '
                                                </div>
                                            </div>
                                        </div>';
                        } else {
                            $output .= '<div class="col-md-6 search-section ' . $cd . ' p-3">
                                    <div class="mb-2">
                                        <a href="' . $link_website[$key] . '">
                                            <img class="img-fluid" src="' . $img . '" style="aspect-ratio:9/6; object-fit:cover;">
                                        </a>
                                    </div>
                                    <div>
                                        <div style="height: auto" class="category mb-1">' . implode(', ', array_unique($ss)) . $mm['tags'] . '</div>
                                        <div style="height: auto" class="card-title mb-0">
                                            <a href="' . $link_website[$key] . '">' . str_replace(array("â€™"), "’", $t) . '</a>
                                        </div>
                                        <div>
                                        ' . $by_editor . '
                                        </div>
                                        <div>
                                            <span class="date">' . date('j F Y', strtotime($mm['posted_date'])) . '</span>
                                        </div>
                                        <div class="description">
                                            ' . $str . '
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                }
            }
        } else {
            $output .= '<section id="404notFound" class="w-100 text-center">
                            <div class="container">
                                <div class="col-md-12 text-center">
                                    <h1 class="font-montserrat" style=" margin: 25% 0;font-weight: bold;color: #0f3979;">404 Not Found.!</h1>
                                </div>
                            </div>
                        </section>
                        <script>$(".loadButton").css("display", "none")</script>';
        }
        

        echo $output;
    }
}