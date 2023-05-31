<?php 
foreach ($pub as $value) {
    $slugs[] = $value->uri;
}
?>
<?php if (isset($nt) AND in_array($nt, $slugs)) { ?>
<style>
.category a {
    color: #69AAB4 !important;
}

.new_publication {
    position: absolute;
    z-index: 10;
    height: 310px;
    overflow: auto;
}

.subscribe-description {
    color: #ffffff !important;
}

.headline {
    font-weight: bold !important;
    font-size: 22px !important;
}

.new_publication_inside {
    border: solid 1px #ced4da;
    border-radius: 0;
}

.check-btns {
    padding: 10px;
}

.publication-collapsible:after {
    margin-top: -13px;
    margin-right: 5px;
    font-size: 20px;
    font-weight: bold;
}

.publicationactive:after {
    margin-top: -3px !important;
    margin-right: 5px !important;
    font-size: 15px;
}

/*
    ** Update Css Style
    */

#keywords {
    font-size: 12px;
}

.search-result-btn {
    font-size: 12px;
}

.publication-collapsible:hover {
    background-color: #ffffff;
    color: #6c757d !important;
    font-size: 12px;
}

/* shold write the export.css file. this is resuce the gap between page header and page items*/

.experts-detail-page {
    position: relative;
    background-color: #ffffff;
    top: -32px !important;
}

@media (min-width: 1200px) {
    div.loadButton {
        padding-top: 25px !important;
    }
}

@media only screen and (min-device-width: 869px) and (max-device-width: 1190px) {
    div.loadButton {
        padding-top: 25px !important;
    }
}

@media only screen and (min-width: 768px) and (max-width: 868px) {
    div.loadButton {
        padding-top: 25px !important;
        margin-bottom: -30px !important;
    }
}

@media only screen and (max-width: 668px) {
    div.loadButton {
        padding-top: 25px !important;
        margin-bottom: -25px !important;
    }

    .publication-browse-tittle.mb-3 {
        padding-top: 27px !important;
    }

    .col-md-6.col-xs-12.mb-md-0.mb-2 {
        margin-top: -26px !important;
    }

    .publication-browsing-heading {
        margin-top: 25px !important;
    }
}
</style>

<style>
.publication-collapsible:after {
    background-image: url('../../resources/images/SocialMedia/down.png');
    background-size: 11px 11px;
    display: inline-block;
    width: 11px;
    height: 11px;
    content: "";
    margin-top: 4px;
}

.publicationactive:after {
    background-image: url('../../resources/images/SocialMedia/up.png');
    background-size: 11px 11px;
    display: inline-block;
    width: 11px;
    height: 11px;
    content: "";
    margin-top: 4px !important;
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .has-bg-img img {
        width: 60% !important;
        object-fit: contain !important;
    }
}

.experts-detail-page {
    padding-right: 16px !important;
    padding-left: 16px !important;
    top: 0 !important;
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
                $title_head = 'Publications';
            }

            echo '<h1 class="event-title text-white font-merriweather">'.$title_head.'</h1>';
        ?>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="container experts-detail-page mb-5 pr-md-5 pr-1">
    <div class="row">
        <div class="col-md-4 col-12">
            <input type="hidden" value="<?= $sub ?>" name="ty" id="ty">
            <div class="profile-overView pt-3">
                <span class="publication-type-tittle mb-3 pl-3">Publication Type</span>
                <div class="pt-3 <?php if ($nt == "all") { ?> selected  <?php } ?>"> <a
                        href="<?php echo base_url() ?>publications/category/all"> All </a></div>
                <?php foreach ($pub as $pub) { ?>
                <div class="pt-3  <?php if ($nt == $pub->uri) { ?> selected  <?php } ?>"> <a
                        href="<?php echo base_url() ?>publications/category/<?= $pub->uri ?>">
                        <?php echo $pub->category_name; ?> </a> </div>
                <?php } ?>
            </div>
            <div style="margin: 0; padding: 0"
                class="content-section-right latest-news col-md-12 col-xs-12 pl- md-4 m-0">
                <br>
                <br>
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
        <!-- right section -->
        <!-- Search Publications Brows -->
        <?php $this->load->view('front-end/content/search-publications/searchPublicationsBrows'); ?>
        <!-- end Search Publications Brows -->
    </div>
</div>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>