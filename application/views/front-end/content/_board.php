<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">
<style>
    html, body
    {
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }

    @media (max-width: 767.98px){
        .sticky_cha {
            top: 0px !important;
        }
        .pt-2.mobile-search {
            display: block !important;
        }
        .navbar-light .navbar-toggler {
            border-color: rgba(0,0,0,0) !important;
        }
        .mobile-nav-bar {
            display: flex !important;
        }
    }

    @media (max-width: 575.98px) {
        .message-board-page .author-detail p:nth-child(2) {
            padding-bottom: 1px !important;
        }
    }
</style>


<div class="container experts-detail-page message-board-page govering-board  ">
    <div class="row">


        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>

        </div>

        <div class="test col-md-8 col-12 author-detail author">
            <div class="experts-page-title pb-3 mb-3">Governing Board</div>

            <p><?=$content_data->content?></p>

            <div class="experts-page-title pb-3 mb-3">Governing Board Members</div>

            <!-- cards -->
            <div class="all-cards">

                <div class="row pl-md-3 pl-4">


                    <?php foreach ($board as $board) { ?>


                    <div class="col-md-6 col-12 pl-0 padding-right member-card item-inner">
                        <div class="card card-body border-0 px-0">
                            <div class="person-main pl-5 pr-4 py-4">
                                <div class="image-container">
                                    <img class="img-fluid" src="<?=base_url()?>resources/images<?=$board->image_name?>">
                                </div>
                                <div class="name mt-2"><?=$board->title?></div>
                                <div class="status"><?=$board->major?></div>
                            </div>
                            <div class="person-description pl-5 pr-4 py-2">
                                <div>
                                    <span class="date"><strong>  <?=substr(strip_tags($board->content),0,150)?> </strong></span>
                                </div>
                                <div class="view-more"><a href="<?=base_url()?>Experts/detail/<?=$board->uri?>">VIEW PROFILE</a></div>
                                <div class="fa fa-angle-right"></div>
                            </div>
                        </div>
                    </div>


                    <?php } ?>










                </div>

            </div>

            <!-- Downloads -->
            <div class="experts-page-title pb-3 mb-3">Governing Board Statements</div>
            <div class="row downloads">
                <div class="my-1 list-content">

                   <?php foreach ($down as $down) { ?>

                    <div class="row ml-4 my-1 list">
                        <div class="d-flex justify-content-between p-0 m-o">
                            <div><span class="pr-1"><?=$down->heading?></span  > </div>
                            <a href="<?=base_url()?><?=$down->pdf?>" target="_blank" class="btn text-light drop-btn w-100 expert-publications-btn px-4"
                                    type="button">Download</a>
                        </div>
                    </div>

                    <?php } ?>



                </div>
            </div>

        </div>


    </div>

</div>

