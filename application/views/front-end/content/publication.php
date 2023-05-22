<div class="modal downloadPdfModal1 fade" id="downloadPdfModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title p-2" id="exampleModalLongTitle">Download document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">

                <!-- dropdown 1 -->
                <div id="accordion">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Full Report
                                </div>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="container p-0">
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dropdown 2 -->
                <div id="accordion2">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Content
                                </div>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion2">
                            <div class="container p-0">
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-------------------------------------------- Research publications page ------------------------------------------------------------------>



<div class="research-page research-publication-page px-3 px-md-0 section-top">

    <!-- Donwload pdf 1 -->
    <div class="container top-cover">
        <div class="background-grey"></div>
        <div class="row">
            <div class="col-md-7 col-12 page-content pr-md-5 pr-0">
                <div>
                    <div class="category"><?= $article->article_type ?></div>
                    <h2 class="heading pr-5"><?= $article->title ?></h2>
                    <div>
                        <span class="date cover-date"> <?php echo date('j  F Y', strtotime($article->posted_date)) ?> </span>
                    </div>
                    <!-- <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Maecenas varius tortor
                      nibh, sit amet tempor nibh finibus et. Aenean eu enim justo.
                    </div> -->
                </div>
                <div class="row authors mt-4">
                    <div class="col-md-1 text-dark author pb-md-0 pb-2">
                        Author
                    </div>
                    <div class="col-md-11">
                        <div>
                            <?= $article->author ?>
                        </div>
                        <div class="mt-3">
                            <?= $article->editor ?>
                        </div>
                    </div>
                </div>
                <div class="row authors mt-4">
                    <div class="col-md-1 text-dark author pb-md-0 pb-2">
                        Editor
                    </div>
                    <div class="col-md-11">
                        <span>Hu Hyon-Suk </span>
                    </div>
                </div>
                <div class="row mt-4 authors">
                    <div class="col-md-4">
                        <button data-toggle="modal" data-target="#downloadPdfModal1" class="btn pdf-download-btn w-100 mb-4">DOWNLOAD PDF</button>
                    </div>
                    <div class="col-md-8">
                        <div class="social-media-icons">
                            <span>Share Article</span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/facebook-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/twitter-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/linkdin-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/instagram-icon.png"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12 main-img-adjust">
                <div style=" height: 458px" class="img-container">
                    <img src="<?php echo base_url() ?><?= $article->image_name ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Donwload pdf 2 -->
    <div class="container download-section-two bg-white mt-5">
        <div class="row">
            <div class="col-md-2 col-12">

                <button data-toggle="modal" data-target="#downloadPdfModal1" class="btn pdf-download-btn1">DOWNLOAD
                    PDF</button>
                <div class="small-text">Share Article</div>
                <div class="social-media-icons">
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/facebook-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/twitter-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/linkdin-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/instagram-icon.png"></span>
                </div>
                <div class="small-text">Print Article</div>
                <div><img src="<?php echo base_url() ?>v6/assets/SocialMedia/print-icon.png"></div>
            </div>
            <div class="col-md-9 col-12">
                <p class="publication-paragraph">


                    <?= $article->content ?>


                </p>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>

    <!-- Related Publications -->
    <div class="container related-article my-4">
        <div class="container page-content py-3">
            <h3 class="py-4">Related Publications</h3>
            <div class="row">


                <?php for ($t = 0; $t <= 1; $t++) { ?>
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row pb-4 mx-1">
                            <div class="col-md-4 col-xs-12 pr-2 m-0 p-0">
                                <img class="responsive" src="<?php echo base_url() ?><?= $publ[$t]->image_name ?>">
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <div class="category"><?= $publ[$t]->article_type ?></div>
                                <div class="heading"><?= $publ[$t]->title ?></div>
                                <div class="py-2">
                                    <?php if ($publ[$t]->author != '') { ?>
                                        <span class="date">by</span>
                                        <span class="author"><?= $publ[$t]->author ?></span>
                                        <span class="date hori-line">---</span>

                                    <?php } ?>
                                    <span class="date"> <?php echo date('j  F Y', strtotime($publ[$t]->posted_date)) ?> </span>
                                </div>
                                <div class="description">

                                    <?php
                                    $ns = strip_tags(substr($publ[$t]->content, 0, 150));


                                    $str = substr($ns, 0, strrpos($ns, ' '));

                                    echo $str . "(...)";

                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Related articles -->


    <div class="container related-article">
        <div class="container py-3">
            <h3 class="py-4">Related Articles</h3>
            <div class="row page-content pb-3">

                <?php

                for ($c = 0; $c <= 2; $c++) {

                ?>


                    <div class="col-md-4 col-12 mb-4">
                        <img class="responsive" src="<?= base_url() ?><?= $related[$c]->image_name ?>">
                        <div class="category mt-3"> <?= $related[$c]->article_type ?> </div>
                        <div class="heading"> <?= $related[$c]->title ?> </div>
                        <div>

                            <?php if ($related[$c]->author != '') { ?>
                                <span class="date">by</span>
                                <span class="author"><?= $related[$c]->author ?></span>
                                <span class="date hori-line">---</span>
                            <?php } ?>

                            <span class="date"> <?php echo date('j  F Y', strtotime($related[$c]->posted_date)) ?> </span>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>



    <!-- Research area -->



    <div class="research-areas p-4 mt-5">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-3 col-xs-12 mr-5">
                    <div style="font-size: 28px;">Research Areas</div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <div class="research-items">

                        <?php $rarea = $this->header->get_menuTopic('topics', 9)  ?>

                        <?php foreach ($rarea as $rarea) { ?>
                            <div class="research-item"> <?= $rarea->category_name ?> </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>