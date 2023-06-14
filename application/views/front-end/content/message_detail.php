<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">
<style>
.message-board-page .image-container {
    width: 100%;
    height: auto;
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .author-detail .title.font-weight-bold {
        font-size: 0.9rem !important;
    }
}
</style>
<div class="container experts-detail-page message-board-page section-top">
    <div class="row mt-3">
        <div class=" col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3"><?php echo $m->major; ?></div>
            <!-- Cards -->
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?><?php echo $m->image_name; ?>" style="width:100%;">

                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="experts-page-title mb-3" style="border-bottom:none;font-size: 18px;">
                        <?php echo $m->title; ?></div>
                    <?php echo $m->content; ?>
                </div>
            </div>

        </div>

    </div>



</div>