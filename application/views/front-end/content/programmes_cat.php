<style>
iframe {
    width: 100% !important;
}

@media screen and (max-width: 767px) {
    .btn-highlight1 {
        width: 100%;
    }
}
</style>

<?php if (isset($catData)) { ?>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <?php
            if ($catData) {
                $title_head = ucwords($catData->category_name);
            } else {
                $title_head = 'Programmes';
            }

            echo '<h1 class="event-title text-white font-merriweather">'.$title_head.'</h1>';
        ?>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="container experts-detail-page db-program-topic">
    <div class="row">
        <div class="col-md-4">
            <?php $this->load->view('front-end/common/dbleft'); ?>
        </div>
        <!-- right section -->
        <div class="col-md-8 col-12">
            <div class="container px-0 mb-4">
                <?php if ($catData) { ?>
                <div class="phara-database">
                    <?php echo $catData->description; ?>

                </div>
                <hr>
                <?php } ?>
            </div>
            <!-- drop sort -->
            <div class="container px-0 related-article">
                <h3 id="relatedArticles" class="font-merriweather text-blue mb-3 d-none">Related articles</h3>
                <div id="searchResult"></div>
                <div id="loadButton" class="loadButton" style="padding: 10px; text-align: center" class="d-none">
                    <button class="btn third-button d-none" id="ldmr">Load more </button>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/programmes/programmes-categories.js"></script>

<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>