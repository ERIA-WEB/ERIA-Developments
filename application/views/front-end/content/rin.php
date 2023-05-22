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

    .boardMessage>h1>span {
        font-size: 23px;
        font-family: 'Merriweather';
        font-weight: bold;
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

        /*
        ** New Css
        */

        .boardMessage {
            text-align: justify;
            letter-spacing: 0.1px;
            line-height: 1.2;
        }

        .ul-li-p-b-15 {
            letter-spacing: 0.1px;
            line-height: 1.2;
        }

        .boardMessage h1 {
            font-size: 17px;
            text-align: justify;
        }
    }

    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {
        table {
            width: 100% !important;
        }

        /* Force table to not be like tables anymore */
        table.research-networks,
        table.research-networks thead,
        table.research-networks tbody,
        table.research-networks th,
        table.research-networks td,
        table.research-networks tr {
            font-size: 16px;
            padding: 6px;
            margin: 0;
            border: 1px solid;
            text-align: center;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        /* thead tr {
        }
        tr {  } */
        td {
            /* Behave  like a "row" */
            font-size: 16px;
            padding: 1px;
            margin: 0;
        }

        /* td:before {

        } */
    }
</style>
<div class="container experts-detail-page message-board-page section-top">
    <div class="row">
        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"><?= $boardmessages->title ?></div>
            <!-- Cards -->
            <div class="row">
                <div class="col-md-12 col-12 boardMessage">
                    <?= $boardmessages->content ?>
                </div>
            </div>
        </div>
    </div>
</div>