<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontModel');
        $this->load->model('admin/Page_model');
    }

    public function index()
    {
        $content = $this->Page_model->getPage_content(5);
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
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;

        $pastData = $this->frontModel->getEvent_list('past', 0, 6);

        $futu = $this->frontModel->getEvent_list('up', 0, 11);
        $data['m_menu'] = 'events';
        $data['pastData'] = $pastData;
        $data['futu'] = $futu;
        $data['content'] = 'front-end/content/events';

        $this->load->view('front-end/common/template', $data);
    }

    public function browse($type)
    {
        $content = $this->Page_model->getPage_content(5);
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
            $data['md'] = "Economic Research Institute for ASEAN and East Asia";
            $data['mk'] = "eria, economic research, economic research institute, research institute, asean, east asia";
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }
        
        $data['contentData'] = $content;
        $data['m_menu'] = 'events';
        $data['type'] = $type;
        $data['content'] = 'front-end/content/events_browse';

        $this->load->view('front-end/common/template', $data);
    }

    function details($id)
    {
        $article = $this->frontModel->get_articles_detail_page($id, 'events'); // get_inArticle($id)
        $content = $this->Page_model->getPage_content(5);

        if (!empty($article)) {
            $image_meta = $article->image_name ? $article->image_name :'v6/assets/logo.png';
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
            $data['image_meta'] = "v6/assets/logo.png";
            $data['title'] = "Economic Research Institute for ASEAN and East Asia";
        }

        $data['contentData'] = $content;

        $data['card'] = $this->frontModel->getArticle_card_order($id);

        $data['m_menu'] = 'events';
        
        if (!empty($article)) {
            // Related Articles
            $relateds = $this->frontModel->get_article_id_by_related($article->article_id);

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

            $data['article'] = $article;
            $data['id'] = $id;
            $data['agenda_list'] = $this->Page_model->getAgendaListByArticleId($article->article_id);
            $data['agenda_detail'] = $this->Page_model->getAgendaDetailByArticleId($article->article_id);
            $pdf = $this->frontModel->get_inPDF($id, null);
            $data['pdf'] = $pdf;
            $people_related = $this->frontModel->getPeopleRelatedEvent($article->article_id);
            $data['peoples'] = $people_related;
        }
        
        $data['content'] = 'front-end/content/event-details';

        $this->load->view('front-end/common/template', $data);
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

    function limit_text($text, $limit, $link = null)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            if ($link) {
                $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" ></a>';
            } else {
                $text  = substr($text, 0, $pos[$limit]);
            }
        }

        return $text;
    }

    function loadmSearchFuture()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $type = $_POST['type'];
        
        $past = $this->frontModel->getEvent_list($type, $start, $limit);
        
        $output = '';
        $x = 0;
        if (!empty($past)) {
            $output .= '<div class="row">';

            foreach ($past as $key => $past) {
                $x++;

                $date = date('j F Y', strtotime($past->start_date));

                if ($past->experts != "") {
                    $d = '<a href="' . base_url() . 'experts/detail/' . $past->link . '">' . $past->experts . '</a>';
                } else {
                    if ($past->majorEmail != "") {

                        $d = '<a href="mailto:' . $past->majorEmail . '" >' . $past->major . '</a>';
                    } else {
                        $d = $past->major;
                    }
                }

                $row = "";
                if ($x % 2 == 0) {
                    $row = "blue-tb";
                }

                $eria_event_agenda_detail = $this->frontModel->getAgendaDetailByEventId($past->article_id);
                
                if (!empty($eria_event_agenda_detail)) {
                    foreach ($eria_event_agenda_detail as $val) {
                        $eventType[] = $val->type;
                        $buttonEventBrite = $val->emmbed_rsvp;
                    }

                    $type_event = '<small>'. implode(', ', $eventType) .'</small>';
                } else {
                    $type_event = '';
                    $buttonEventBrite = '';
                }
                if ($type == 'up') {
                    if ($past->start_date == date('Y-m-d')) {
                        $ribbon = '<div class="ribbon-2 d-none" style="background: #0c620c;">On Going</div>';
                    } else {
                        $ribbon = '<div class="ribbon-2 d-none" style="background: #0f3979;">Upcoming</div>';
                    }
                    
                } else {
                    $ribbon = '<div class="ribbon-2 d-none" style="background: #BD1550;">Finished</div>';
                }

                // example images temporary
                
                $url_image = "https://www.eria.org/" . $past->image_name_2;
                $get_headers = @get_headers($url_image, 1);
                if (!$get_headers) {
                    if (!$get_headers) {
                        $img_temporary = "https://www.eria.org/" . $past->image_name_2;
                    } else {
                        $img_temporary = base_url() . "upload/Event.jpg";
                    }
                } else {
                    if (!empty($past->image_name_2)) {
                        $img_temporary = base_url() . $past->image_name_2;
                    } else {
                        $img_temporary = base_url() . "upload/Event.jpg";
                    }
                }
                
                if (!empty($past->content)) {
                    $output .= '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card upcoming-card-event rounded-0 border-0 bg-main-grey h-100">
                        '.$ribbon.'
                        <div class="bg-thumbnails bg-transparent border-0">
                            <img class="img-fluid" src="'.$img_temporary.'">
                        </div>
                        <a href="' . base_url() . 'events/' . $past->uri . '">
                            <div class="card-body pb-0">
                                <small>' . date('j F Y', strtotime($past->start_date)) . '</small>
                                <h6 class="card-title font-merriweather mb-0">' . mb_convert_encoding($this->RemoveBS($past->title), "HTML-ENTITIES", "UTF-8") . '</h6>
                            </div>
                        </a>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                '. $type_event .'
                                <small><i class="bi bi-geo-alt-fill mr-1"></i>' . $past->venue . '</small>
                            </div>
                            <div class="eventbrite-checkout-button">'.$buttonEventBrite.'</div>
                        </div>
                        </div>
                    </div>';
                } else {
                    $output .= '<div class="col-lg-4 col-md-6 mb-4">
                        <div class="card upcoming-card-event rounded-0 border-0 bg-main-grey h-100">
                            '.$ribbon.'
                            <div class="bg-thumbnails bg-transparent border-0">
                                <img class="img-fluid" src="'.$img_temporary.'">
                            </div>
                            <div class="card-body pb-0">
                                <small>' . date('j F Y', strtotime($past->start_date)) . '</small>
                                <h6 class="card-title font-merriweather mb-0">' . mb_convert_encoding($this->RemoveBS($past->title), "HTML-ENTITIES", "UTF-8") . '</h6>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                '. $type_event .'
                                <small><i class="bi bi-geo-alt-fill mr-1"></i>' . $past->venue . '</small>
                            </div>
                            <div class="eventbrite-checkout-button">'.$buttonEventBrite.'</div>
                        </div>
                        </div>
                    </div>';
                }
            }

            $output .= '</div>';
        } else {
            $output = "";
        }

        echo $output;
    }
    
    function loadmSearch()
    {
        $start = $_POST['start'];
        $limit = $_POST['limit'];
        $type = $_POST['type'];
        
        $past = $this->frontModel->getEvent_list($type, $start, $limit);
        
        $output = '';
        $x = 0;
        if (!empty($past)) {
            $output .= '<div class="row">';

            foreach ($past as $key => $past) {
                $x++;

                $date = date('j F Y', strtotime($past->start_date));

                if ($past->experts != "") {
                    $d = '<a href="' . base_url() . 'experts/detail/' . $past->link . '">' . $past->experts . '</a>';
                } else {
                    if ($past->majorEmail != "") {

                        $d = '<a href="mailto:' . $past->majorEmail . '" >' . $past->major . '</a>';
                    } else {
                        $d = $past->major;
                    }
                }

                $row = "";
                if ($x % 2 == 0) {
                    $row = "blue-tb";
                }

                $eria_event_agenda_detail = $this->frontModel->getAgendaDetailByEventId($past->article_id);
                
                if (!empty($eria_event_agenda_detail)) {
                    foreach ($eria_event_agenda_detail as $val) {
                        $eventType[] = $val->type;
                        $buttonEventBrite = $val->emmbed_rsvp;
                    }

                    $type_event = '<small>'. implode(', ', $eventType) .'</small>';
                } else {
                    $type_event = '';
                    $buttonEventBrite = '';
                }
                if ($type == 'up') {
                    if ($past->start_date == date('Y-m-d')) {
                        $ribbon = '<div class="ribbon-2 d-none" style="background: #0c620c;">On Going</div>';
                    } else {
                        $ribbon = '<div class="ribbon-2 d-none" style="background: #0f3979;">Upcoming</div>';
                    }
                    
                } else {
                    $ribbon = '<div class="ribbon-2 d-none" style="background: #BD1550;">Finished</div>';
                }

                // example images temporary
                
                $url_image = "https://www.eria.org" . $past->image_name_2;
                $get_headers = @get_headers($url_image, 1);
                if (!$get_headers) {
                    $file_exists_image == 0;
                } else {
                    $response_image = $get_headers;
                    $file_exists_image = (strpos($response_image[0], "404") === false);
                }
                
                if ($file_exists_image == 1) {
                    if (!empty($past->image_name_2)) {
                        $img_temporary = "https://www.eria.org" . $past->image_name_2;
                    } else {
                        $img_temporary = base_url() . "upload/Event.jpg";
                    }
                } else {
                    if (!empty($past->image_name_2)) {
                        $img_temporary = base_url() . $past->image_name_2;
                    } else {
                        $img_temporary = base_url() . "upload/Event.jpg";
                    }
                }
                
                if (!empty($past->content)) {
                    $output .= '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card upcoming-card-event rounded-0 border-0 bg-main-grey h-100">
                        '.$ribbon.'
                        <div class="bg-thumbnails bg-transparent border-0">
                            <img class="img-fluid" src="'.$img_temporary.'">
                        </div>
                        <a href="' . base_url() . 'events/' . $past->uri . '">
                            <div class="card-body pb-0">
                                <small>' . date('j F Y', strtotime($past->start_date)) . '</small>
                                <h6 class="card-title font-merriweather mb-0">' . mb_convert_encoding($this->RemoveBS($past->title), "HTML-ENTITIES", "UTF-8") . '</h6>
                            </div>
                        </a>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                '. $type_event .'
                                <small><i class="bi bi-geo-alt-fill mr-1"></i>' . $past->venue . '</small>
                            </div>
                            <div class="eventbrite-checkout-button">'.$buttonEventBrite.'</div>
                        </div>
                        </div>
                    </div>';
                } else {
                    $output .= '<div class="col-lg-4 col-md-6 mb-4">
                        <div class="card upcoming-card-event rounded-0 border-0 bg-main-grey h-100">
                            '.$ribbon.'
                            <div class="bg-thumbnails bg-transparent border-0">
                                <img class="img-fluid" src="'.$img_temporary.'">
                            </div>
                            <div class="card-body pb-0">
                                <small>' . date('j F Y', strtotime($past->start_date)) . '</small>
                                <h6 class="card-title font-merriweather mb-0">' . mb_convert_encoding($this->RemoveBS($past->title), "HTML-ENTITIES", "UTF-8") . '</h6>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                '. $type_event .'
                                <small><i class="bi bi-geo-alt-fill mr-1"></i>' . $past->venue . '</small>
                            </div>
                            <div class="eventbrite-checkout-button">'.$buttonEventBrite.'</div>
                        </div>
                        </div>
                    </div>';
                }
            }

            $output .= '</div>';
        } else {
            $output = "";
        }

        echo $output;
    }
}