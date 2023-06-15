<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">

<div class="container experts-detail-page message-board-page key-staff-page section-top">
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail">
            <div class="container experts-page  ">
                <div class="experts-page-title pb-3 mb-3">Key Staff</div>
                <div class="about-content">
                    <?php
                        $content_details = $descriptions->content;
                    ?>
                    <?= $content_details; ?>
                </div>
                <div class="col-md-12 mt-3 px-0">
                    <div class="row view-profile">
                        <?php $x = 0;
                        foreach ($keystaffs as $experts) {
                            $x++; ?>
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 bg-main-grey h-100 rounded-0">
                                <div class="card-image py-3 d-flex justify-content-center">
                                    <img style="object-fit: cover;" class=" img-fluid img-round "
                                        src="<?php echo base_url() ?><?php echo $experts['image_name'] ?>">
                                </div>
                                <div class="card-body">
                                    <a href="<?php echo base_url() ?>experts/<?php echo $experts['uri'] ?>"
                                        class="card-title text-blue font-merriweather">
                                        <?php echo substr($experts['title'], 0, 30) ?>
                                    </a>
                                    <div class="status font-montserrat mt-2">
                                        <?php echo $experts['major'] ?>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <?php
                                        if (!empty($experts['email'])) {
                                            echo '<a href="mailto:lydia@' . $experts['email'] . '"><i class="fa fa-envelope-o"></i></a>';
                                        } else {
                                            echo '<a href="#"><i class="fa fa-envelope-o"></i></a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>