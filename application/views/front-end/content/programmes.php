<link rel="stylesheet" href="<?= base_url() ?>v6/css/about-update.css">
<!-- <link rel="stylesheet" href="<?= base_url() ?>v6/css/history-update.css"> -->
<link rel="stylesheet" href="<?= base_url() ?>v6/css/database-update.css">

<style>
.card-img-top {
    aspect-ratio: 16/9;
    object-fit: cover;
}
</style>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <h1 class="event-title text-white font-merriweather">ERIA Programmes</h1>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="research-page research-topic-page px-3 px-md-0">
    <!-- related articles -->
    <div class="container-fluid pr-0 pl-0">
        <div class="container py-3 pr-0 pl-0">
            <div class="row page-content pb-3">
                <?php foreach ($categories as $categories) { ?>
                <div class="col-md-4 mb-lg-4 ">
                    <div class="col db-card">
                        <?php
                            if ($categories->uri == 'Organisation_for_Economic_Co-operation_and_Development_(OECD)') {
                                $uri = strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $categories->uri)));
                            } else {
                                $uri = $categories->uri;
                            }
                            ?>
                        <a href="<?= base_url() ?>database-and-programmes/topic/<?= $uri; ?>">
                            <div class="card border-0">
                                <img src="<?= base_url().'get_share_image.php?im='.$categories->image_name ?>"
                                    class="card-img-top db-image-top border" alt="<?= $categories->image_name ?>">
                                <div class="card-body px-0 bg-transparent">
                                    <h5 class="card-title "> <?= $categories->category_name ?>
                                    </h5>
                                    <p class="card-text db-crd-text d-none">
                                        <?= substr(strip_tags($categories->description), 0, 180) ?><a
                                            href="<?= base_url() ?>programmes/category/<?= $categories->uri ?>">
                                            [...]</a></p>
                                    <div class="up-search-db mt- d-none">
                                        <a href="<?= base_url() ?>programmes/category/<?= $categories->uri ?>"> FIND OUT
                                            MORE &nbsp; &nbsp; <i class="db-arrow fa fa-angle-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------- Research page ------------------------------------------------------------------>