<?php 
foreach ($topics as $value) {
    $slugs[] = $value->uri;
} 

$current_url = explode('/', current_url());

if (!in_array('all', $current_url)) {
    $_category = end($current_url);
} else {
    $_category = '';
}
?>
<!-- check url topics parameter when not found -->
<?php if (!in_array('all', $current_url) or in_array(urldecode($top), $slugs)) { ?>
<!-- end -->
<style>
.category a {
    color: #69AAB4 !important;
}

.new_publication {
    position: absolute;
    z-index: 9999;
    height: 310px;
    width: 100%;
}

.new_publication_inside {
    border: solid 1px #ced4da;
    border-radius: 0;
    /*8px*/
}

.check-btns {

    padding: 10px;
}

.publication-collapsible:after {
    margin-top: -6px;
}

.publication-collapsible:after {

    margin-top: -6px;
}

.has-bg-img :after {
    content: '';
    background-image: url('https://eria-development.website/eria/uploads/publications/20181112/0.jpg') !important;
    opacity: 0.6;
    background-size: cover;
    z-index: 1;
    height: 220px;
}

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

@media (max-width: 575.98px) {
    .new_publication {
        width: 100% !important;
        position: relative !important;
    }

    .search-result-btn {
        width: 100% !important;
    }

    .publication-browse-page .mb-4 {
        margin-bottom: 1rem !important;
    }

    .research-page .latest-news {
        padding-top: 10px;
    }

    .research-page {
        padding-bottom: 0 !important;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    .new_publication {
        width: 100% !important;
        position: relative !important;
    }

    .publication-browse-page .row .mb-2 {
        margin-bottom: 0 important;
    }

    .search-result-btn {
        width: 100% !important;
    }

    .publication-browse-page .mb-4 {
        margin-bottom: 1rem !important;
    }

    .research-page .latest-news {
        padding-top: 10px;
    }

    .research-page {
        padding-bottom: 0 !important;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .page-content .heading {
        font-size: 18px !important;
    }

    .subscriber .heading {
        font-size: 15px !important;
    }

    .subscriber .description {
        font-size: 12px !important;
    }

    .search-result-btn {
        width: 100% !important;
    }

    .publication-browse-page .mb-4 {
        margin-bottom: 0 !important;
    }

    .research-page .latest-news {
        padding-top: 10px;
    }

    .publication-browse-page .search-section .has-bg-img {
        padding-left: 0 !important;
    }

    .research-page .latest-news .headline {
        margin-bottom: 0.5rem !important;
    }

    .research-page .latest-news iframe {
        height: 110px;
    }

    .latest-news .heading {
        font-size: 16px !important;
    }
}

@media (min-width: 460px) and (max-width: 767.98px) {
    .research-page .latest-news iframe {
        height: 280px !important;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    .search-result-btn {
        width: 100% !important;
    }

    .publication-browse-page .mb-4 {
        margin-bottom: .8rem !important;
    }

    .publication-browse-page .mt-4 {
        margin-top: 0 !important;
    }

    .research-page .latest-news .headline {
        margin-bottom: 0.5rem !important;
    }



}

@media (min-width: 1200px) {
    .publication-browse-page .mb-4 {
        margin-bottom: .8rem !important;
    }

    .publication-browse-page .mt-4 {
        margin-top: 0 !important;
    }

    .research-page .latest-news .headline {
        margin-bottom: 0.5rem !important;
    }

}

#button-addon2 {
    border: 1px solid #ced4da !important;
}

.publication-browse-page #button-addon2 {
    z-index: 0 !important;
    border-radius: 0;
    /*8px 0px 0px 8px !important*/
}

.publication-browse-page .sorrt-tittle {
    padding-left: 0 !important;
}

.publication-browse-page .sort-section .dropdown {
    margin-top: 4px;
    margin-left: 8px;
}

/* .publication-browse-page .search-section .has-bg-img {
        height: auto !important;
    } */

.publication-collapsible:after {
    margin-top: -13px;
    margin-right: 5px;
}

.publicationactive:after {
    margin-top: -3px !important;
    margin-right: 5px !important;
}

.new_publication {
    z-index: 99 !important;
    overflow-y: auto;
}


.publication-collapsible:after {

    background-image: url('<?= base_url() ?>resources/images/SocialMedia/down.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}

.publicationactive:after {

    background-image: url('<?= base_url() ?>resources/images/SocialMedia/up.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}
</style>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <?php 
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
            
            $urlCategories = explode('/', $parse_url);
            if (isset($urlArray) || !empty($urlCategories)) {
                $title_head = ucwords(str_replace('-', ' ', end($urlCategories)));
            } else {
                $title_head = 'ERIA Updates';
            }

            echo '<h1 class="event-title text-white font-merriweather">'.$title_head.'</h1>';
        ?>
        <p class="subtitle text-white">The latest News and Updates from ERIA</p>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="research-page mb-5">
    <div class="container">
        <div class="row">
            <!-- left section -->
            <div class="col-lg-8 col-12 publication-browse-page">
                <div class="container-fluid px-0">
                    <form class="bottom-divider" id="form_id" method="post">
                        <input type="hidden" class="publication" name="publication" id="publication" value="<?= $nt ?>">
                        <input type="hidden" class="author" name="author" id="author" value="all">
                        <input type="hidden" name="region" class="region" id="region" value="all">
                        <input type="hidden" name="kw" value="<?= $nt ?>">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="button-addon2" type="submit"
                                            class="btn btn-link text-secondary border border-right-0">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <?php ?>
                                    <input type="search" placeholder="Keywords" aria-describedby="button-addon2"
                                        id="key" value="<?= $key ?>" name="key" class="form-control border-left-0">
                                </div>
                            </div>
                        </div>
                        <div class="d-none row mb-2">
                            <div class="col-md-6 mb-2">
                                <div class="dropdown">
                                    <button class="btn bg-white border athd  w-100" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Author
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div style="height: 500px; overflow: auto" class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <a data-id="all" class="dropdown-item ath" href="#">All</a>
                                        <?php foreach ($author as $author) { ?>
                                        <a class="dropdown-item ath  " data-nm="<?= $author->category ?>"
                                            data-id="<?= $author->article_id ?>" href="#"><?= $author->category ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="dropdown">
                                    <button class="publi btn bg-white border  w-100" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <?php
                                        if (strtoupper(str_replace("_", " ", $nt)) == 'ALL') {
                                            echo "Publication type";
                                        } else {
                                            echo strtoupper(str_replace("_", " ", $nt));
                                        }
                                        ?>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="<?php echo base_url() ?>Publications/Brows/all" data-type="all"
                                            class="dropdown-item type "> All </a>
                                        <?php foreach ($ptype as $pub) { ?>
                                        <a data-type="<?php echo $pub->category_name; ?>"
                                            href="<?php echo base_url() ?>Publications/Brows/<?php echo ($pub->uri); ?>"
                                            class="dropdown-item type"> <?php echo $pub->category_name; ?> </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="dropdown">
                                    <input type="hidden" value="all" id="cb">
                                    <button type="button"
                                        class="publication-collapsible  profile-overView1 search-result-btn">
                                        Categories
                                        <span id="countCategories"></span>
                                    </button>
                                    <div class="new_publication publicationcontent">
                                        <div class="new_publication_inside">
                                            <div class="check-btns">
                                                <label class="container-check">
                                                    Select All <input type="checkbox" id="call"> <span
                                                        class="checkmark"></span>
                                                </label>
                                                <?php foreach ($cato as $cato) { ?>
                                                <?php 
                                                    if (urldecode($_category) == $cato->uri) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = '';
                                                    }
                                                ?>
                                                <?php 
                                                    if ($cato->category_name != 'Multimedia') {
                                                        echo '<label class="container-check">
                                                                '.$cato->category_name.' <input class="call" type="checkbox" name="topic_new_cat[]" '.$checked.'
                                                                value="'.$cato->category_id .'"> 
                                                                <span class="checkmark"></span>
                                                            </label>';
                                                    }
                                                ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="dropdown">
                                    <button type="button"
                                        class="publication-collapsible profile-overView1 search-result-btn">
                                        Topics
                                        <span id="countTopics"></span>
                                    </button>
                                    <div class="new_publication publicationcontent">
                                        <div class="new_publication_inside">
                                            <div class="check-btns">
                                                <label class="container-check">
                                                    Select All <input type="checkbox" id="tall"> <span
                                                        class="checkmark"></span>
                                                </label>
                                                <?php foreach ($topics as $topics) { ?>
                                                <?php 
                                                        if (urldecode($top) == $topics->uri) {
                                                            $checked = 'checked';
                                                        } else {
                                                            $checked = '';
                                                        }
                                                    ?>
                                                <label class="container-check">
                                                    <?= $topics->category_name ?>
                                                    <input type="checkbox" class="tall" name="topic_cat[]"
                                                        <?= $checked  ?> value="<?= $topics->category_id ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <button class="btn third-button w-100" type="button" id="_msearch">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- drop sort -->
                <!-- Articles -->
                <div id="searchResult" class="sorteren row page-content pb-3"></div>
                <div class="loadButton" style="padding: 10px; text-align: center">
                    <button id="ldmr" class="btn third-button">Load more... </button>
                </div>
            </div>
            <!-- Content section right -->
            <div class="content-section-right latest-news col-md-4 d-none d-lg-block">
                <?php
                $last = $this->uri->total_segments();
                $record_url = $this->uri->segment($last);
                ?>
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/news-and-views/news-and-views.js"></script>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>