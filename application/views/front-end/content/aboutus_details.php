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
<div class="container experts-detail-page history-page section-top mb-5">
    <div class="row">
        <div class="col-md-4 mb-4 px-0">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <!-- right section -->
        <div class="test col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"><?= ucfirst($contentData->title); ?></div>
            <div class="about-content">

                <?php
                $content_details = $contentData->content;
            ?>
                <?= $content_details; ?>
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