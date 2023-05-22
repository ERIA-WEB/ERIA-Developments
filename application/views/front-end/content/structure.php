<style>
.experts-detail-page .author-detail .img-container {
    border-radius: 0;
}

.experts-detail-page .author-detail img {
    border-radius: 0;
}

@media (max-width: 575.98px) {
    .org-struct .career-op-collapse {
        padding: 12px !important;
        font-size: 14px !important;
    }

    .career-op .fa-angle-down {
        font-size: 20px !important;
        top: 2px !important;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .org-struct .career-op-collapse {
        padding: 12px !important;
        font-size: 14px !important;
    }

    .career-op .fa-angle-down {
        font-size: 20px !important;
        top: 2px !important;
    }
}
</style>
<div class="container experts-detail-page advisors-president section-top">
    <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail org-struct career-op">
            <div class="experts-page-title pb-3 mb-3">Organisational Structure</div>
            <div class="img-container pb-0">
                <img src="<?php echo base_url() ?>v6/assets/Images/About/structure.jpeg" class="img-fluid w-100">
            </div>
            <!-- Collapse one -->
            <?php foreach ($areaList as $areaList) { ?>
            <div style="position: relative;">
                <button class="career-op-collapse pub-tc"><?= $areaList->title ?><i
                        class="fa fa-angle-down"></i></button>
                <div style="padding-left: 12px; " class="careeropcontent pt-2">
                    <?= $areaList->content ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>