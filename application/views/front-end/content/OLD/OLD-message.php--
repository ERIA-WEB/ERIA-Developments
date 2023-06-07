<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
<style>
    @media (min-width: 768px) and (max-width: 991.98px) {
        .author-detail .title.font-weight-bold {
            font-size: 0.9rem !important;
        }
    }
</style>
<div class="container experts-detail-page message-board-page section-top">
    <div class="row">

        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>

        </div>


        <div class="test col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"> Message from the Secretary-general of ASEAN</div>

            <!-- Cards -->
            <div class="row">
                <?php

                foreach ($boardmessages as $m) {
                ?>

                    <div class="col-md-5 col-12">
                        <div class="image-container">
                            <img src="<?php echo base_url() ?><?= $m['image_name'] ?>">
                        </div>
                        <div class="position py-2 pt-3"><a href="<?= base_url() ?>Message/details/<?= $m['uri'] ?>"> <?= $m['title'] ?></a></div>
                        <div class="title font-weight-bold"><?= $m['major'] ?></div>
                    </div>

                <?php } ?>
            </div>

        </div>

    </div>



</div>