<?php
// this is remove special character in html
$ci =& get_instance();
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

// function limit_text($text, $limit, $link = null)
// {
//     if (str_word_count($text, 0) > $limit) {
//         $words = str_word_count($text, 2);
//         $pos   = array_keys($words);
//         if ($link) {
//             $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >[...]</a>';
//         } else {
//             $text  = substr($text, 0, $pos[$limit]) . '[...]';
//         }
//     }
//     return $text;
// }

?>
<style>
.publication-collapsible:hover {
    color: #003680 !important;
}

@media screen and (max-width: 767px) {
    .page-content .heading {
        margin-bottom: 15px !important;
        font-size: 18px !important;
    }
}
</style>

<?php if (!empty($research_categories_data)) { ?>
<!-- Banner Category -->
<section class="research-hero-section position-relative overflow-hidden section-top">
    <div class="research-hero-background">
        <?php 
            if (file_exists(FCPATH . $research_categories_data->image_name)) {
                $img = base_url().$research_categories_data->image_name;
            } else {
                $img = base_url().'upload/Research_baer.jpg';
            }
        ?>
        <img class="h-100 w-100" src="<?= $img ?>" alt="<?= ucfirst($research_categories_data->category_name) ?>">
    </div>

    <div class="container-fluid h-100 position-relative px-0 py-xl-5">
        <div class="research-hero-content">
            <p class="mb-3 text-uppercase font-weight-medium">Research</p>
            <h2 class="main-title"><?= ucfirst($research_categories_data->category_name) ?></h1>
                <?= ucwords(str_replace(',', ' | ', ucfirst($research_categories_data->meta_keywords))) ?>
                <p class="description"><?= $research_categories_data->description ?></p>

        </div>
    </div>

</section>
<!-- End -->
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="research-page research-topic-page mt-0 px-3 px-md-0">
    <div class="container pt-0 pb-4">
        <h3 class="main-title text-blue pt-0 pb-2">Publications</h3>
        <?php $this->load->view('front-end/content/search-publications/searchResearchCategories'); ?>
        <!-- Result Search -->
        <div id="searchResult" class="container-fluid px-0"></div>
        <div class="container-fluid px-0 d-none">
            <div class="row">
                <?php 
                foreach ($result_publications as $key => $mm) {
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
                    $cn = $ci->limit_text($ns, 18, base_url() . "research/" . $mm['uri']);
                    $nk = str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $mm['title']);
                    $k =  str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $ci->limit_text($nk, 50));

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

                    
                    echo '<div class="col-md-6">
                            <div class="row pt-3 pb-3 pr-3 pl-3">
                                <div class="col-md-4 col-xs-12 mr-md-2 m-0 p-0" style="text-align: center">
                                    <a href="'. base_url() . "research/" . $mm['uri'] .'">
                                        <div style=" position: absolute; z-index: -1; top: 0; bottom: unset; left: 0; right: 0; background: url(' . base_url() . $img_thumb . ') center center; opacity: 0.1; width: 100%; height: auto;" class="bg"></div>
                                        <img style="width: 100%;height: auto;" class="responsive" src="'. base_url() . $mm['image_name'] .'">
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
                                        <span class="date">'. date('j  F Y', strtotime($mm['posted_date'])) .'</span>
                                    </div>
                                    
                                    <div class="description d-none">
                                        '. $cn .'
                                    </div>
                                </div>
                            </div>
                        </div>'; // '.$people_link.'
                }
                ?>
            </div>
        </div>
        <div class="loadButton text-center">
            <button id="ldmr" class="btn third-button">Load more</button>
            <button id="ldmrNextSession" class="btn third-button d-none">Load more</button>
            <input type="hidden" id="limitNextSession">
            <input type="hidden" id="startNextSession">
        </div>
    </div>
    <!-- content -->
    <style>
    .publication-collapsible:after {
        background-image: url('../../resources/images/SocialMedia/down.png');
    }
    </style>
    <?php if ($count_recent_news_articles > 0) { ?>
    <div class="container">
        <hr>
    </div>
    <div id="n_req" class="container pb-3">
        <div class="row">
            <!-- content left section -->
            <div class="col-md-8 page-content mb-3 mb-md-0">
                <!-- recent articles -->
                <?php 
                    if ($count_recent_news_articles > 0) {
                        echo '<div id="contentRecentArticle" class="container">
                                    <h3 class="main-title text-blue pb-4">Recent Articles</h3>
                                    <div id="searchResultRecentArticle" class="row page-content pb-3"></div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="loadButton text-center pb-4">
                                                <button id="loadMoreRecentArticle" class="btn third-button">Load more</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                ?>
            </div>
            <!-- Content section right -->
            <div class="content-section-right d-none d-md-block latest-news col-md-4 pl-md-4 m-0">
                <?php
                    if (!empty($card)) {
                        foreach ($card as $c) {
                            if (!empty($c->file)) {
                                $this->load->view($c->path . $c->file);
                            } else {
                                echo '<div class="container background d-none d-sm-block" style="background: #F3F8FC;">
                                        <div class="row d-none d-sm-block">
                                            <div class="col-md-12 col-xs-12 d-none d-sm-block">
                                                '.$c->template.'
                                            </div>
                                        </div>

                                    </div>';
                            }
                        }
                    } else {
                        $this->load->view('front-end/common/card-randoms/cards');
                    }
                ?>
            </div>

        </div>
    </div>
    <?php } ?>
</div>
<input type="hidden" id="uri" value="<?= $res; ?>">
<input type="hidden" id="slug" value="<?= $slug; ?>">

<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/research/research-categories.min.js" async></script>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>