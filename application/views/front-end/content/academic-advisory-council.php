<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
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
    <div class="row">
        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail author">
            <div class="experts-page-title pb-3 mb-3">Academic Advisory Council</div>
            <p><?= $content_data->content ?></p>
        </div>
    </div>
</div>