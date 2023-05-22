<?php


function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '(...)';
    }
    return $text;
}


?>


<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">

<style>
    @media screen and (max-width: 767px) {
        .img-container-col {
            width: 100%;
            height: auto !important;
        }

        .img-container-col img {
            width: 100% !important;
            object-fit: contain;
            height: 150px !important;
        }

        .description {
            height: auto !important;
            overflow-y: auto !important;
        }

        .organizations-we-work .description {
            text-align: left;
        }
    }

    @media (max-width: 575.98px) {

        .organizations-we-work .mt-5 .col-md-6:nth-child(2) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(3) img {
            max-width: 300px !important;
        }
    }

    @media (min-width: 576px) and (max-width: 767.98px) {

        .organizations-we-work .mt-5 .col-md-6:nth-child(2) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(3) img {
            max-width: 380px !important;
            /*300px !important*/
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {

        .organizations-we-work .mt-5 .col-md-6:nth-child(2) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(3) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(4) img {
            max-width: 200px !important;
        }

        .img-container-col {
            height: 60px !important;
        }
    }

    @media (min-width: 992px) and (max-width: 1199.98px) {

        .organizations-we-work .mt-5 .col-md-6:nth-child(2) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(3) img {
            max-width: 250px !important;
        }
    }

    @media (min-width: 1200px) {

        .organizations-we-work .mt-5 .col-md-6:nth-child(2) img,
        .organizations-we-work .mt-5 .col-md-6:nth-child(3) img {
            max-width: 350px !important;
        }
    }

    .img-container-col {
        width: 100%;
        height: 80px;
    }

    .organizations-we-work .mt-5 .col-md-6 img {
        width: auto !important;
        height: 100%;
        object-fit: contain;
    }
</style>
<div class="container experts-detail-page org-structure-page section-top">
    <div class="row">
        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 organizations-we-work">
            <div class="experts-page-title pb-3 mb-3"> Partners and Networks </div>
            <div style="display: none" class="row">
                <div class="col-md-3 col-12">
                    <img style="width:80%; margin-top:10px;  " src="<?php echo base_url() ?><?= $organizations[0]['image_name'] ?>">
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">
                        <!-- my-2-->
                        <?= $organizations[0]['title'] ?>
                    </div>
                    <div class="description"> <?= substr($organizations[0]['content'], 0, 200) ?> … </div>
                    <a href="<?= $organizations[0]['major'] ?>" target="_blank">
                        <div class="up-search-db mt-4">
                            LEARN MORE &nbsp; &nbsp; <i class="db-arrow fa fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mt-5">
                <?php $x = 0;
                foreach ($organizations as $organizations) {
                    $x++; { ?>
                        <div class="col-md-6 col-12" style="padding-bottom:50px; ">
                            <div class="img-container-col">
                                <img style="width: 100% !important; " src="<?php echo base_url() ?><?= $organizations['image_name'] ?>">
                            </div>
                            <div class="title">
                                <?= substr($organizations['title'], 0, 41) ?>
                            </div>
                            <div style="height: 85px; overflow-y: auto" class="description">
                                <?php
                                $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $organizations['content']);
                                $ns = strip_tags($n);
                                //echo limit_text($ns, 15);
                                echo $ns;
                                ?>
                            </div>
                            <a href="<?= $organizations['major'] ?>" target="_blank">
                                <div class="up-search-db mt-4">
                                    LEARN MORE &nbsp; &nbsp; <i class="db-arrow fa fa-angle-right"></i>
                                </div>
                            </a>
                        </div>
                <?php }
                } ?>
            </div>

        </div>

    </div>

</div>