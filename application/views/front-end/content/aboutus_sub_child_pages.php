<?php if (!empty($contentData)) { ?>
<style>
.person-description {
    height: 260px;
    background-color: #F3F3F3;
    overflow-y: auto;
}

.titleRelatedLinks {
    margin-bottom: 20px;
}

iframe {
    width: 100%;
}

.orange-text {
    color: #f88125;
}

.about-content {
    overflow: auto;
}

@media screen and (max-width: 767px) {
    .breadcrumb {
        margin-top: 20px;
        padding-right: 10px !important;
        padding-left: 10px !important;
    }

    .highlights-hero {
        height: 550px !important;
    }
}

.breadcrumb-item+.breadcrumb-item::before {
    display: inline-block;
    padding-right: 0.5rem;
    color: #f88125;
    content: "/";
}

.breadcrumb-item {
    font-size: 13px;
    font-weight: bold;
}

.breadcrumb-item>a,
.orange-text {
    font-weight: 600;
    font-size: 13px;
}

.breadcrumb-item>a:hover,
.orange-text:hover {
    color: #fff;
}

.contentHeroAbout {
    background: #0f3979ad;
    padding: 20px;
    font-size: 1.1em;
}

.main-title-abouts {
    font-size: 32px;
    font-weight: 600;
}

/* 
** hero Image
*/

.not-highlights-hero::before {
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
}

.highlights-hero {
    height: 485px;
    padding: 0;
    position: relative;
    overflow: hidden;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background: #0f3979;
}

.highlights-hero img {
    height: 100%;
    width: 100%;
    margin: 0 auto;
    display: block;
    object-fit: cover;
}

.highlights-hero::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    content: "";
    z-index: 1;
}


.menu-position {
    bottom: 35px;
    right: 0;
    left: 0;
    z-index: 1;
}

div.scrollmenu {
    background-color: transparent;
    border-top: 1px solid #fff;
    border-bottom: 1px solid #fff;
    width: 1024px;
}

div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 0px 10px;
    text-decoration: none;
    font-weight: 600;
    border-right: 1px solid #fff;
    margin: 5px auto;
    font-size: 14px;
}

div.scrollmenu a:hover {
    background: #0f3979;
}

/* 
** End
*/
@media (max-width: 767.98px) {
    .sticky_cha {
        top: 0px !important;
    }

    .pt-2.mobile-search {
        display: block !important;
    }

    .navbar-light .navbar-toggler {
        border-color: rgba(0, 0, 0, 0) !important;
    }

    .mobile-nav-bar {
        display: flex !important;
    }
}

@media (min-width: 601px) and (max-width: 767.98px) {
    .history-page .input-flex-container .input span::after {
        font-size: 11px !important;
    }
}

#AuthorCarousel .item-inner {
    padding-right: 10px !important;
    padding-left: 10px !important;
}

.history-page .carousel {
    margin-left: 0 !important;
}

.author .carousel-control-next {
    right: -40px !important;
}

.author .carousel-control-prev {
    left: -40px !important;
}

.active_ {
    background: #0e3680 !important;
}

.hid {
    display: none;
}

#AuthorCarousel .person-description {
    height: 236px;
}
</style>
<?php 
if ($contentData->uri != 'presidents-office') {
    echo '<style>
            .about-content img {
                max-width: 100%;
                width: 100%;
                height: 100%;
            }
        </style>';
}
?>
<?php 
    $whitelist = array('127.0.0.1', "::1", "localhost");
    if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
        $urlArray = explode('/', $parse_url);

        $getUrlArray = array_slice($urlArray, 4, 5);
        
        $urlString = implode('/', $getUrlArray);
        
    } else {
        $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
        $urlArray = explode('/', $parse_url);

        $getUrlArray = array_slice($urlArray, 1, 5);

        $urlString = implode('/', $getUrlArray);
    }
    
?>
<div class="bg-light-blue pt-5">
    <div class="container-fluid px-0">
        <div class="row position-relative">
            <?php 
                if (!empty($contentData->banner_image)) {
                    $img_banner = '<img src="'.base_url().$contentData->banner_image.'">';
                    $highlight_shadow = 'highlights-hero';
                    $box_content_shadow = '';
                    $media_query_css = '<style>
                        div.scrollmenu a:hover {
                            background: #0f3979;
                        }

                        @media screen and (max-width: 767px) {
                            .contentHeroAbout {
                                background: none;
                                padding: 0;
                                font-size: 1.1em;
                                margin-bottom: 15% !important;
                            }

                            #menuAbout {
                                background: #0f397942;
                                height: auto;
                                bottom: 0;
                                top: 0;
                            }

                            #rowMenu {
                                margin-top: 15%;
                                padding-right: 15px;
                                padding-left: 15px;
                            }

                        }
                    </style>';
                } else {
                    $img_banner = '';
                    $highlight_shadow = 'not-highlights-hero highlights-hero';
                    $box_content_shadow = '<style>
                        div.scrollmenu a:hover {
                            background: #fff;
                            color: #0f3979;
                        }
                        
                        .contentHeroAbout {
                            background: none;
                            padding: 20px 0;
                            font-size: 1.1em;
                        }
                    </style>';
                    $media_query_css = '<style>
                        @media screen and (max-width: 767px) {
                            #menuAbout {
                                background: none;
                                height: auto;
                                top: 0;
                                bottom: 0;
                            }

                            #rowMenu {
                                margin-top: 5%;
                                padding-right: 10px;
                                padding-left: 10px;
                            }
                        }
                    </style>';
                }

                echo $box_content_shadow;
                echo $media_query_css;
                echo '<div class="'.$highlight_shadow.' research-topic-cover w-100">';
                    echo $img_banner;
                echo '</div>';
            ?>
            <div id="menuAbout" class="position-absolute menu-position">
                <div class="container">
                    <div class="col-md-12 mx-0 px-1">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent px-0">
                                <li class="breadcrumb-item align-items-center">
                                    <a href="<?= base_url(); ?>" class="orange-text text-uppercase">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-house mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= base_url().'about-us/'; ?>" class="orange-text text-uppercase">
                                        ABOUT US
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= base_url().'about-us/'.$getUrlArray[count($getUrlArray)-3]; ?>"
                                        class="orange-text text-uppercase">
                                        <?= str_replace('-', ' ', strtoupper($getUrlArray[count($getUrlArray)-3])); ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= base_url().'about-us/'.$getUrlArray[count($getUrlArray)-3].'/'.$getUrlArray[count($getUrlArray)-2]; ?>"
                                        class="orange-text text-uppercase">
                                        <?= str_replace('-', ' ', strtoupper($getUrlArray[count($getUrlArray)-2])); ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url().'about-us/'.$getUrlArray[count($getUrlArray)-3].'/'.$getUrlArray[count($getUrlArray)-2].'/'.$getUrlArray[count($getUrlArray)-1]; ?>"
                                        class="orange-text text-uppercase">
                                        <?= str_replace('-', ' ', strtoupper(str_replace('presidents-office', 'President’s Office', $getUrlArray[count($getUrlArray)-1]))); ?>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div id="rowMenu" class="row mx-1">
                        <div class="col-lg-8  col-12 mb-3 contentHeroAbout" style="color:#fff !important;">
                            <h2 class="main-title mb-3" style="color:#fff;">
                                <?= $contentData->title; ?>
                            </h2>
                            <?= $contentData->short_desc; ?>
                        </div>
                        <?php 
                            echo '<div class="col-lg-12 col-12 pl-0 pr-0 d-none" style="overflow:auto;width:100%;">
                                    <div class="scrollmenu">';

                                // $aboutus = $this->header->getPageAllAboutPage();
                                // $numItems = count($aboutus);
                                // foreach ($aboutus as $key => $value) {
                                //     if(++$key === $numItems) {
                                //         $style_css = 'style="border-right: none;"';
                                //     } else {
                                //         $style_css = '';
                                //     }
                                //     echo '<a href="'.base_url().'about-us/'.$value->uri.'" '.$style_css.'>'.$value->title.'</a>';
                                // }
                            
                            echo '  </div>
                                </div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4 experts-detail-page history-page mb-5">
    <div class="row">
        <!-- right section -->
        <div class="col-md-8 col-12">
            <div class="experts-page-title pb-3 mb-3 d-none"><?= ucwords($contentData->title); ?></div>
            <div class="about-content">
                <?php
                    $content_details = $contentData->content;

                    echo $content_details;
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>