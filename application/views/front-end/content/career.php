<?php

$Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

?>


<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">

<div class="container experts-detail-page org-struct career-op mb-5 section-top">
    <div class="row pt-4">
        <div id=" " class="col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 pr-md-5 pr-3">
            <div class="experts-page-title pb-3 mb-3">Career Opportunities</div>

            <div class="title">Why Join Us?</div>
            <p style="padding-left: 0 !important;">ERIA is a leading international research institution where top
                economists work together and conduct
                research
                to develop practical policy recommendations for economic integration among the economies of ASEAN and
                East
                Asia. ERIA provides great opportunities for staff to tackle and study a broad range of subjects and meet
                academic and non-academic interests.</p>

            <div class="title">Job Opportunities</div>

            <?php foreach ($careers as $careers) { ?>
            <!-- Collapse one -->
            <button class="career-op-collapse pub-tc"> <?= $careers['title'] ?> <i
                    class="fa fa-angle-down"></i></button>
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
            <!-- collapse two -->
        </div>
    </div>
</div>