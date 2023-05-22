<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
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

<div class="container experts-detail-page history-page section-top">
    <div class="row">
        <div class="col-md-3">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <!-- right section -->
        <div class="test col-md-9 col-12 author-detail pr-md-5 pr-3">
            <div class="experts-page-title pb-3 mb-3">History</div>
            <div>
                <?= $contentData->content ?>
            </div>
            <div class="row d-none d-sm-block d-sm-none d-md-none">
                <div class="col-md-12">
                    <div class="carousel author container year-cards my-5"
                        style="margin-top:0px !important; padding-top:0px !important; margin-bottom:0px !important; padding-bottom:0px !important; ">
                        <div class="row mx-auto my-auto">
                            <div id="AuthorCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    <div class=" carousel-item  slide-wr active">
                                        <?php
                                        $time = $time;
                                        $x = 0;
                                        $ns = array();
                                        foreach ($time as $time) {
                                            $x++;
                                            if (!in_array($time->year, $ns)) {
                                                $ns[] = $time->year;
                                            }
                                        ?>
                                        <div class="slide col-md-4 pl-0 pr-md-4 item-inner">
                                            <div class="card card-body border-0 px-0">
                                                <div class="person-main pl-4 pr-4 py-4">
                                                    <div class="name mt-2"><?= $time->year ?></div>
                                                </div>
                                                <div class="person-description pl-4 pr-4 py-4  ">
                                                    <div style="color: black !important;" class="name mt-2">
                                                        <?= $time->title ?></div>
                                                    <div style="font-weight: normal" class="description mt-2 pr-2 pb-5">
                                                        <?= $time->content ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <a id="back" class="carousel-control-prev w-auto author-slider-btn-left"
                                    href="#AuthorCarousel" role="button" data-slide="prev">
                                    <img style="height: auto"
                                        src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_left.png">
                                    <!-- <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span> -->
                                </a>
                                <a id="forward" class="carousel-control-next w-auto author-slider-btn-right"
                                    href="#AuthorCarousel" role="button" data-slide="next">
                                    <img style="height: auto"
                                        src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_right.png">
                                    <!-- <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span> -->
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="container">
                        <div class="row">
                            <div class="flex-parent">
                                <div class="input-flex-container" style="width:90%">
                                    <?php
                                    $y = 0;
                                    foreach ($ns as $x => $year) {
                                        $y++;
                                    ?>
                                    <div style="background: none" data-year="<?= $year ?>"
                                        class="input_ yearInput input<?php if ($y == 1) { ?> active<?php  } ?>">
                                        <a>
                                            <span data-year="<?= $year ?>"></span>
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div style="display:none" class="history-bottom">
            <div class="bottom-title titleRelatedLinks">
                Related Links
            </div>
            <div class="row mx-0">
                <div class="heading w-100">
                    <span class="float-left">
                        ERIA Annual Report 2018
                    </span>
                    <span class="float-right">
                        <button type="submit" class="form-control btn mb-2">Download</button>
                    </span>
                </div>
            </div>

            <div class="row mx-0 border-0 mt-3">
                <div class="heading w-100">
                    <span class="float-left">
                        ERIA Annual Report 2018
                    </span>
                    <span class="float-right">
                        <button type="submit" class="form-control btn mb-2">Download</button>
                    </span>
                </div>
            </div>
            <!-- <div class="heading w-100">
                  <span class="float-left">
                    ERIA Publications Catalogue 2018-2019
                  </span>
                  <span class="float-right">
                    <button type="submit" class="form-control btn mb-2">Subscribe</button>
                  </span>
                </div> -->
        </div>
        <!--Author carousel -->
    </div>
</div>
</div>