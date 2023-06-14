<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">
<style>
html,
body {
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
}

table,
th,
tr,
td {
    border: none !important;
}

.test.col-md-8.col-12.author-detail.author>h1>span {
    font-size: 23px;
    font-family: 'Merriweather';
    font-weight: bold;
}

.test.col-md-8.col-12.author-detail.author>h1 {
    font-size: 23px;
    font-family: 'Merriweather';
    font-weight: bold;
    color: #003366;
}

@media screen and (max-width: 767px) {
    .test.col-md-8.col-12.author-detail.author {
        overflow: auto;
    }
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
    .message-board-page .author-detail p:nth-child(2) {
        padding-bottom: 1px !important;
    }
}
</style>
<div class="container experts-detail-page message-board-page govering-board section-top">
    <div class="row mt-3">
        <div class="col-md-4 mb-5">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail author">
            <div class="experts-page-title pb-3 mb-3">Messages from the Board</div>
            <div class="about-content">

                <?php
                    $content_details = $descriptions->content;
                ?>
                <?= $content_details; ?>
            </div>
            <div class="row row-cols-3">
                <?php
                    $people_message_boards = $this->frontModel->getPeopleByMessageBoard('boardmessages');
                ?>
                <?php foreach ($people_message_boards as $key => $value) { ?>
                <div class="col">
                    <figure>
                        <a href="<?php echo base_url(); ?>about-us/<?= $value->uri; ?>" title="<?= $value->title; ?>">
                            <img itemprop="image" src="<?= base_url().$value->image_name; ?>"
                                alt="<?= $value->title; ?>" class="img-fluid w-100">
                        </a>
                        <figcaption>
                            <?php 
                                if ($value->uri == 'message-from-secretary-general-of-asean-1') {
                                    $uri_slug = 'message-from-secretary-general-of-asean';
                                } else {
                                    $uri_slug = $value->uri;
                                }
                            ?>
                            <a href="<?php echo base_url(); ?>about-us/<?= $uri_slug; ?>"
                                title="<?= $value->title; ?>"><?= $value->title; ?></a>
                            <p class="bname"><?= $value->major; ?></p>
                        </figcaption>
                    </figure>
                </div>
                <?php } ?>
            </div>
        </div>
        </article>
    </div>
</div>