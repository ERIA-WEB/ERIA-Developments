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

    .title {
        font-size: 23px;
        font-family: 'Merriweather';
        color: var(--primaryBlue);
    }

    .message-board-page .image-container {
        width: 100%;
        height: auto;
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
</style>
<div class="container experts-detail-page message-board-page section-top">
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"><?= $boardmessages->major ?></div>
            <!-- Cards -->
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?><?= $boardmessages->image_name ?>" style="width: 100%;border-radius: 0;">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="font-weight-bold pb-2 title">
                        <?= $boardmessages->title ?>
                    </div>
                    <?= $boardmessages->content ?>
                </div>
            </div>
        </div>
    </div>
</div>