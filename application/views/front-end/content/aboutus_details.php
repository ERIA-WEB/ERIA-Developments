<?php if (!empty($contentData)) { ?>
<style>
.person-description {
    height: 260px;
    background-color: #F3F3F3;
    overflow-y: auto;
}
</style>

<style>
.titleRelatedLinks {
    margin-bottom: 20px;
}

iframe {
    width: 100%;
}

/* 
** hero Image
*/

.highlights-hero {
    height: 485px;
    padding: 0;
    position: relative;
    overflow: hidden;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background: #124797;
}

.highlights-hero img {
    height: 100%;
    width: 100%;
    margin: 0 auto;
    display: block;
    object-fit: cover;
}

.highlights-hero::before {
    -webkit-box-shadow: inset 0 0 140px 45px #000;
    box-shadow: inset 0 0 140px 45px #000;
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
    overflow: auto;
    border-top: 2px solid #fff;
    border-bottom: 2px solid #fff;
}

div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 0px 10px;
    text-decoration: none;
    font-weight: 600;
    border-right: 2px solid #fff;
    margin: 15px auto;
}

div.scrollmenu a:hover {
    color: #0f3979;
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
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
    $urlArray = explode('/', $parse_url);

    $end_urls = ['history', 'networks', 'leadership-and-staff', 'career-opportunities', 'logo-use-standards'];
?>
<div class="bg-light-blue pt-5">
    <div class="container-fluid px-0">
        <div class="row position-relative">
            <div class="highlights-hero research-topic-cover w-100">
                <img src="<?= base_url(); ?>v6/assets/Images/About/cover_2.png">

            </div>
            <div id="menuAbout" class="position-absolute menu-position">
                <div class="container">
                    <div class="row mx-3">
                        <div class="col-lg-8  col-12 mb-3 contentHeroBanner">
                            <h2 class="main-title mb-3" style="color:#fff;">Logo Use Standards</h2>
                            <p class="description mb-4" style="color:#fff;">
                                when an unknown printer took a galley of type and
                                scrambled it to
                                make a type
                                specimen book. It has survived not only five centuries, but also the leap into
                                electronic typesetting, remaining essentially unchanged.
                            </p>
                        </div>
                        <div class="col-lg-12 col-12 pl-0 pr-0">
                            <div class="scrollmenu">
                                <a href="<?= base_url().'about-us/history'; ?>">History</a>
                                <a href="<?= base_url().'about-us/leadership-and-staff'; ?>">Leadership and Staff</a>
                                <a href="<?= base_url().'about-us/networks'; ?>">Networks</a>
                                <a href="<?= base_url().'about-us/career-opportunities'; ?>">Career Opportunities</a>
                                <a href="<?= base_url().'about-us/logo-use-standards'; ?>">Logo Standards Use</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 experts-detail-page history-page mb-5">
    <div class="row">
        <!-- right section -->
        <div class="col-md-12 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"><?= ucfirst($contentData->title); ?></div>
            <div class="about-content">

                <?php
                    $content_details = $contentData->content;

                    echo $content_details;
                ?>
            </div>

            <!-- If organisational-structure showing -->
            <?php if ($contentData->uri == 'organisational-structure') { ?>
            <?php foreach ($areaList as $key => $value) { ?>
            <?php
                $departement = $this->frontModel->getDepartementByID($value->departement_id);
                
            ?>
            <div style="position: relative;">
                <button
                    class="career-op-collapse pub-tc d-flex justify-content-between"><?= strtoupper($departement->name); ?>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div style="padding-left: 12px; " class="careeropcontent pt-2">
                    <?php 
                        $all_peoples[$key] = $this->frontModel->getPeopleInOrganizationStructure($value->oid);
                        
                        foreach ($all_peoples[$key] as $i => $value) {
                            echo '<p><a href="'.base_url().'experts/'.$value->uri.'" style="text-decoration: underline;color:var(--primaryBlue);">'.ucfirst($value->title).'</a>, '.ucfirst($value->major).'</p>';
                        }
                    ?>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
            <!-- If career-opportunities showing -->
            <?php if ($contentData->uri == 'career-opportunities') { ?>
            <?php

                $Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                $Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

                ?>
            <?php foreach ($careers as $careers) { ?>
            <!-- Collapse one -->
            <button class="career-op-collapse pub-tc"> <?= $careers['title'] ?>
                <i class="fa fa-angle-down float-right"></i>
                <div style="clear:both;"></div>
            </button>
            <div style="padding-left: 12px; " class="careeropcontent pt-2">
                <?= $careers['content'] ?>
                <div class="row mt-4 authors mb-3">
                    <div class="col-md-12">
                        <div class="social-media-icons">
                            <span>Shared article</span>
                            <span>
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo $Url ?>" target="_blank">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/facebook-icon.png">
                                </a>
                            </span>
                            <span>
                                <a target="_blank" href="https://twitter.com/share?url=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/twitter-icon.png">
                                </a>
                            </span>
                            <span>
                                <a target="_blank"
                                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/linkdin-icon.png">
                                </a>
                            </span>
                            <span>
                                <a target="_blank" href="https://www.instagram.com/sharer.php?u=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/instagram-icon.png">
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>

            <!-- If organisations-we-work-with showing -->
            <?php if ($contentData->uri == 'organisations-we-work-with') { ?>
            <div class="container">
                <div class="row">
                    <?php foreach ($organizationWeWorksWith as $value) { ?>
                    <div class="col-md-6">
                        <figure class="bg-light-blue p-3">
                            <img src="<?php echo base_url().$value->image_name; ?>" style="width:auto;height:54px;"
                                alt="Association of Southeast Asian Nations">
                            <div class="upcoming-card-body bottom-0 pt-3 bg-light-blue">
                                <h5 style="font-size: 14px;font-weight: bold;color: #0f3979;">
                                    <?= ucfirst($value->title); ?></h5>

                            </div>
                        </figure>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>