<?php

$sliders = $slider;

function limit_text($text, $limit, $link = null)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" style="display: none;">[...]</a>';
    }
    return $text;
}

?>

<div id="homeBanners" class="home-banner carousel slide section-top" data-ride="carousel">
    <!-- The slideshow -->
    <div class="carousel-inner">
        <?php foreach ($sliders as $key => $slider) { ?>
        <div class="carousel-item <?php if ($key == 0) {
                                            echo 'active';
                                        } ?>">
            <?php
                if (file_exists(FCPATH . $slider->image_name)) {
                    $image_temporary = '/caching' . $slider->image_name;
                    
                    if (file_exists(FCPATH . $image_temporary)) {
                        $img = base_url().$image_temporary;
                    } else {
                        $img = base_url() .'get_compress_slider.php?im='. $slider->image_name;
                    }
                    
                } else {
                    $url_slider_home = "https://www.eria.org" . $slider->image_name;
                    $response_slider_home = @get_headers($url_slider_home, 1);
                    $file_exists_slider_home = (strpos($response_slider_home[0], "404") === false);

                    if ($file_exists_slider_home == 1) {
                        $img = "https://www.eria.org" . $slider->image_name;
                    } else {
                        $img = base_url() . "/upload/Publication.jpg";
                    }
                }
                ?>

            <?php
                $texts = str_replace($slider->heading, "", $slider->content);
                $count_text = strip_tags($texts);

                if (strlen($count_text) > 316) {
                    $col = 'col-md-8';

                    $style_ = '
                        
                            @media screen and (max-width: 1441px) {
                                .col-md-8.contentHeroBanner {
                                    flex: 0 0 100% !important;
                                    max-width: 100% !important;
                                }
                            }
                        
                        ';
                } else {
                    $col = 'col-md-6';
                    $style_ = '';
                }

                ?>

            <style>
            <?=$style_;

            ?>@media screen and (max-width: 1441px) {
                .col-md-6.contentHeroBanner {
                    flex: 0 0 100% !important;
                    max-width: 100% !important;
                }
            }

            @media screen and (max-width: 769px) {
                .carousel-inner .carousel-item>div {
                    display: block;
                }
            }
            </style>

            <div class="imgCov">
                <img class="img-fluid imgBanner" src="<?= $img; ?>" alt="<?= $slider->heading; ?>">
                <div class="mobileCarouselCaption text-left">
                    <div class="mobileBoxCarouselCaption">
                        <div class="container pl-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="main-title mb-3"><?= $slider->heading; ?></h2>
                                    <p class="description mb-4">
                                        <?php
                                            $n = str_replace($slider->heading, "", $slider->content);
                                            $ns = strip_tags($n);
                                            echo limit_text($ns, 31);
                                            ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="container pl-1">
                            <div class="row">
                                <div class="col-md-12 position-relative" style="height:50px;">
                                    <div class="text-right position-absolute" style="bottom: 15px;">
                                        <a class="btnReadmore btn btn-outline-light" href="<?= $slider->banner_url; ?>"
                                            role="button">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 start-10 carousel-caption text-left d-none d-xl-block">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-8 contentHeroBanner px-4">
                            <h2 class="main-title mb-3"><?php echo $slider->heading; ?></h2>
                            <p class="description mb-4">
                                <?php
                                    $n = str_replace($slider->heading, "", $slider->content);
                                    $ns = strip_tags($n);

                                    echo limit_text($ns, 31);
                                    ?>
                            </p>
                            <a class="btn second-button" href="<?= $slider->banner_url; ?>" role="button">Read
                                more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#homeBanners" data-slide="prev">
        <!-- <span class="carousel-control-prev-icon"></span>-->
        <img class="img-fluid imgIcon iconLeft" src="<?= base_url() ?>v6/assets/Icons/chevron-left_white.svg">
    </a>
    <a class="carousel-control-next" href="#homeBanners" data-slide="next">
        <!-- <span class="carousel-control-next-icon"></span>-->
        <img class="img-fluid imgIcon iconRight" src="<?= base_url() ?>v6/assets/Icons/chevron-right_white.svg">
    </a>
</div>
<!-- Featured topics -->
<style>
.featured-topic-list {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    max-width: 768px;
}

.featured-topic-list::-webkit-scrollbar {
    display: none;
}

.featureed-topic-list-item {
    flex: 0 0 auto;
}
</style>

<div class="featured-topic font-merriweather d-none">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-12 feature-slide-swiper">
                <div class="swiper feature-swiper">
                    <div class="swiper-wrapper">
                        <?php 
                            $new_rarea = $this->header->getMenuShortCutLinkCategories(array('newscategories', 'topics'), 0);
                        ?>
                        <?php foreach ($new_rarea as $value) { ?>
                        <?php if ($value->published == 1) { ?>
                        <?php
                                    if ($value->category_type == 'newscategories') {
                                        echo '<div class="swiper-slide featureed-topic-list-item w-auto">
                                                <a href="'.base_url().'news-and-views/category/'.$value->uri.'"
                                                    target="_blank">'.strtoupper($value->category_name).'</a>
                                            </div>';
                                    } else {
                                        echo '<div class="swiper-slide featureed-topic-list-item w-auto">
                                                <a href="'.base_url().'research/topic/'.$value->uri.'"
                                                    target="_blank">'.strtoupper($value->category_name).'</a>
                                            </div>';
                                    }
                                ?>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-none d-md-flex swiper-button-prev" id="feature-button-prev" style="left:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </div>
                <div class="d-none d-md-flex swiper-button-next" id="feature-button-next" style="right:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                    </svg>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>

<!-- Page content -->
<div class="page-content mt-3 pt-1">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?= base_url() ?>news-and-views" class="main-title text-blue">Updates</a>
            </div>
        </div>
        <div class="row">
            <!-- Content section left -->
            <div class="col-lg-8">
                <div class="container-fluid px-0">
                    <div class="row">
                        <?php $s = 0;
                        foreach ($newsall as $news) {
                            if (strip_tags($news['title']) != 'Inaugural Meeting of APEN Business Club') {
                                $s++;
                        ?>
                        <?php
                        
                        if (!empty($news['image_name'])) {
                            if (file_exists(FCPATH . $news['image_name'])) {
                                $image_temporary = '/caching' . $news['image_name'];
                                
                                if (file_exists(FCPATH . $image_temporary)) {
                                    $img = base_url().$image_temporary;
                                } else {
                                    $img = base_url() .'get_compress_slider.php?im='. $news['image_name'];
                                }
                                
                            } else {
                                $url_news_home = "https://www.eria.org" . $news['image_name'];
                                $response_news_home = @get_headers($url_news_home, 1);
                                $file_news_home = (strpos($response_news_home[0], "404") === false);

                                if ($file_news_home == 1) {
                                    $img = "https://www.eria.org" . $news['image_name'];
                                } else {
                                    $img = base_url() . "/upload/news.jpg";
                                }
                            }
                        } else {
                            $img = base_url() . "/upload/news.jpg";
                        }
                        ?>
                        <div class="col-md-6 recent-update-wrapper">
                            <?php
                            if ($news['article_type'] == 'news') {
                                $url = 'news-and-views/' . $news['uri'];
                            } else {
                                $url = 'news-and-views/' . $news['uri'];
                            }
                            ?>
                            <div class="card recent-update-card boxContent" style="cursor:unset;">
                                <a href="<?= base_url() ?><?= $url ?>" style="color: #fff;">
                                    <img id="imgCardHover<?= $s; ?>" class="card-img-top" src="<?= $img ?>"
                                        alt="<?= strip_tags(str_replace('Call for Proposals:', '', $news['title'])) ?>" />
                                </a>
                                <div class="card-body">
                                    <div class="card-items">
                                        <small class="text-uppercase bg-blue p-2">
                                            <?php
                                            echo ucfirst($news['article_type']);
                                            ?>
                                        </small>
                                        <h5 class="card-title my-2">
                                            <a href="<?= base_url() ?><?= $url ?>" style="color: #fff;">
                                                <?php
                                                $title_recent_update = strip_tags(str_replace('Call for Proposals:', '', $news['title']));
                                                ?>
                                                <?= limit_text($title_recent_update, 18, null); ?>
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="card-description" class="mb-0" style="font-size:14px;">
                                        <?= $news['short_des']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Content section right -->
            <div class="col-md-4 content-section-right d-none d-lg-block">
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
</div>

<!--Author carousel -->
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/home-swipper.min.css">

<div class="programmes py-3 py-lg-5" style="background: #efefef;">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6">
                <a href="<?= base_url() ?>database-and-programmes" class="main-title text-blue">Programmes</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 programmes-slide-swiper">
                <div class="swiper programmes-swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        $e = 0;
                        foreach ($categories as $key => $categories) {
                            $e++;
                        ?>
                        <?php
                        $image_caching = '/caching'.str_replace(array('jpg', 'jpeg'), 'png', $categories->image_name);
                        
                        if (file_exists(FCPATH . $categories->image_name)) {
                            $image_temporary = '/caching' . $categories->image_name;
                            
                            if (file_exists(FCPATH . $image_caching)) {
                                $img = base_url().$image_caching;
                            } else {
                                $img = base_url() .'get_compress_slider.php?im='. $categories->image_name;
                            }
                            
                        } else {
                            $url_programmes_home = "https://www.eria.org" . $categories->image_name;
                            $response_programmes_home = @get_headers($url_programmes_home, 1);
                            $file_exists_programmes_home = (strpos($response_programmes_home[0], "404") === false);

                            if ($file_exists_programmes_home == 1) {
                                $img = "https://www.eria.org" . $categories->image_name;
                            } else {
                                $img = base_url() . "/upload/thumbnails-pub.jpg";
                            }
                        }
                        ?>
                        <div class="swiper-slide">
                            <a href="<?= base_url() ?>database-and-programmes/topic/<?= $categories->uri ?>">
                                <div class="programmes-card card rounded-0 h-100">
                                    <div class="card-image">
                                        <img src="<?= $img ?>" alt="<?= $categories->category_name; ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php
                                                $n = $categories->category_name;
                                                $ns = strip_tags($n);

                                                echo limit_text($ns, 15, null);
                                                $str = substr($ns, 0, 260);
                                                ?>
                                        </h5>
                                    </div>
                                </div>
                        </div>
                        </a>
                        <?php } ?>
                    </div>

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination d-block d-md-none" id="programmes-pagination" style="bottom:-40px"></div>
                <!-- If we need navigation buttons -->
                <div class="d-none d-md-flex swiper-button-prev" id="programmes-button-prev" style="left:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </div>
                <div class="d-none d-md-flex swiper-button-next" id="programmes-button-next" style="right:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- highlights -->
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/home-highlight.min.css">
<div class="highlights pt-5 pb-5 mb-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6">
                <a href="<?= base_url() ?>publications" class="main-title text-white text-left">Highlighted
                    Publications</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 highlight-slide-swiper">
                <div class="swiper highlight-swiper mb-4">
                    <div class="swiper-wrapper">
                        <?php $x = 0;
                        $pu = array();
                        foreach ($publications as $pub) {
                            $x++;
                            $result = '';
                            $nresult = '';
                            $pu[] = $x;
                        ?>
                        <?php
                            if (file_exists(FCPATH . $pub['image_name'])) {
                                $img = base_url() . $pub['image_name'];
                            } else {
                                $img = "https://www.eria.org" . $pub['image_name'];
                            }
                            ?>

                        <div class="swiper-slide d-md-flex align-items-md-center">
                            <div class="higlight-swiper-slider-image mb-3 mb-md-0">
                                <img src="<?= $img ?>" alt="<?= str_replace("â€™", "'", $pub['title']) ?>"
                                    class="w-100">
                            </div>
                            <div class="highlight-swiper-slider-content text-white pr-lg-5">
                                <h3 class="second-title text-white">
                                    <?= str_replace("â€™", "'", $pub['title']) ?></h3>
                                <div class="highlight-author font-merriweather pb-4 pt-1">
                                    <?php
                                        $getAuthorEditorHighLIght = $this->frontModel->getHighlightByArticleId($pub['article_id']);

                                        if (isset($getAuthorEditorHighLIght) and count($getAuthorEditorHighLIght) > 0) {

                                            foreach ($getAuthorEditorHighLIght as $value) {
                                                $getAuthorEditor = $this->frontModel->getPeopleAuthorEditorByArticleId($value->ec_id);

                                                $people_data[] = [
                                                    'article_id' => $getAuthorEditor->article_id,
                                                    'title' => $getAuthorEditor->title,
                                                    'uri'   => $getAuthorEditor->uri,
                                                ];
                                            }

                                            foreach ($people_data as $value) {
                                                $people_title[] = $value['title'];
                                                $people_uri[] = $value['uri'];
                                            }

                                            if (count($people_title) > 0) {
                                                echo 'Author(s) / Editor(s): ' . implode(', ', $people_title);
                                            } else {
                                                echo 'Author(s) / Editor(s): ';
                                            }
                                        } else {
                                            if (!empty($pub['editor']) || !empty($pub['author'])) {
                                                $a1 = explode(', ', $pub['editor']);
                                                $a2 = explode(', ', $pub['author']);
                                                $mergingPeople = array_merge($a1, $a2);
                                                
                                                for ($i=0; $i < count($mergingPeople); $i++) { 
                                                    if (!empty($mergingPeople[$i])){
                                                        $author[]= $mergingPeople[$i];
                                                    }
                                                }
                                                echo 'Author(s)/Editor(s): ' . implode(', ', $author);
                                            } else {
                                                echo 'Author(s)/Editor(s): ';
                                            }
                                        }
                                        ?>
                                </div>
                                <small class="font-montserrat"><?= $pub['posted_date'] ?></small>
                                <p class="description mt-3">
                                    <?php
                                        $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $pub['content']);
                                        $ns = strip_tags($n);
                                        echo limit_text($ns, 50, 'publications/' . $pub['uri']);
                                        ?>
                                </p>
                                <a href="<?= base_url() . 'publications/' . $pub['uri'] ?>"
                                    class="btn second-button mt-4">
                                    Read more
                                </a>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="swiper-pagination d-block d-md-none mb-4" id="highlight-pagination" style="bottom:-40px">
                </div>
                <div class="d-none d-md-flex swiper-button-prev" id="highlight-button-prev" style="left:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </div>
                <div class="d-none d-md-flex swiper-button-next" id="highlight-button-next" style="right:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MultiMedia -->

<div class="mt-5 multimedia pb-lg-5 py-py-3">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6">
                <a href="<?= base_url() ?>multimedia" class="main-title text-blue">Multimedia</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 pt-3 mb-lg-0 order-2 order-lg-1">
                <div class="card-audio border-0">
                    <?php 
                        if (!empty($podcasts->video_url)) {
                            $iframing = $podcasts->video_url;
                        } else {
                            $iframing = '<img src="'.base_url().$podcasts->image_name.'" class="rounded-0" width="100%">';
                        }

                        echo $iframing;
                    ?>
                </div>
                <div>
                    <small class="text-uppercase mb-2"><?= ucfirst($podcasts->category) ?></small>
                    <h5 class="card-title"><?= $podcasts->title ?></h5>
                </div>
                <a href="<?= base_url() ?>multimedia/podcasts">
                    <button class="btn main-button w-responsive">More podcasts</button>
                </a>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="card-videos">
                            <?php 
                                if (!empty($video->video_url)) {
                                    $iframing_video = $video->video_url;
                                } else {
                                    $iframing_video = '<img src="'.base_url().$video->image_name.'" class="rounded-0" width="100%">';
                                }

                                echo $iframing_video;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-3 px-lg-0 d-flex flex-column justify-content-between">
                        <div>
                            <small class="text-uppercase mb-2"><?= ucfirst($video->category) ?></small>
                            <h5 class="card-title"><?= $video->title ?></h5>
                        </div>
                        <a href="<?= base_url() ?>multimedia/video">
                            <button class="btn main-button w-100">More videos</button>
                        </a>
                    </div>
                </div>
                <div class="row mb-4 mb-lg-0">
                    <div class="col-lg-8">
                        <div class="card-videos border-0">
                            <?php 
                                if (!empty($webinar->video_url)) {
                                    $iframing_webinar = $webinar->video_url;
                                } else {
                                    $iframing_webinar = '<img src="'.base_url().$webinar->image_name.'" class="rounded-0" width="100%">';
                                }

                                echo $iframing_webinar;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 pt-3 px-lg-0 d-flex flex-column justify-content-between">
                        <div>
                            <small class="text-uppercase mb-2"><?= ucfirst($webinar->category).'s'; ?></small>
                            <h5 class="card-title mb-3"><?= $webinar->title ?></h5>
                        </div>
                        <a href="<?= base_url() ?>multimedia/webinar">
                            <button class="btn main-button w-100">More webinars</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Research area -->
<?php $this->load->view('front-end/content/sections/research-areas'); ?>
<!-- END Research area -->
<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/home-main.min.js"></script>