<style>
.img-container {
    height: auto !important;
}

.category a {
    color: #69AAB4 !important;
}

.related-cat-topic {

    color: #69AAB4;
    font-size: 12px;
}

.has-dropcap:first-letter {
    font-family: "Source Sans Pro", Arial, Helvetica, sans-serif;
    float: left;
    font-size: 6rem;
    line-height: 0.65;
    margin: 0.1em 0.1em 0.2em 0;
}

.dropcap {
    font-family: "Source Sans Pro", Arial, Helvetica, sans-serif;
    background: #303030;
    color: #FDF9F2;
    float: left;
    font-size: 6rem;
    line-height: 1;
    margin: 0.1em 0.1em 0.2em 0;
    padding: 0.1em;
}

.dropcap:before,
.dropcap:after {
    content: "";
    display: block;
}

.dropcap:before {
    margin-top: -0.2em;
}

.dropcap:after {
    margin-bottom: -0.15em;
}

/* https://www.scottohara.me/blog/2017/04/14/inclusively-hidden.html */
.sr-only:not(:focus):not(:active) {
    clip: rect(0 0 0 0);
    clip-path: inset(50%);
    height: 1px;
    overflow: hidden;
    position: absolute;
    white-space: nowrap;
    width: 1px;
}

.sosMedShare {
    width: 30px;
    height: 30px;
    display: inline-flex;
    border-radius: 50%;
    border: 1px solid #0f3979;
    padding: 4px;
    line-height: 1;
    margin: 0px 5px;
}
</style>
<div class="modal downloadPdfModal1 fade" id="downloadPdfModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <!-- dropdown 2 -->
                <div id="accordion2">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="true" aria-controls="collapseTwo">
                                    Content
                                </div>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion2">
                            <div class="container p-0">

                                <?php foreach ($pdf as $pdf) {  ?>


                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        <?php echo $pdf->pdf_title ?>
                                        <p> <?php echo $pdf->pdf_discription ?> </p>
                                    </div>
                                    <div class="col-md-3">

                                        <button href="<?= base_url() ?><?php echo $pdf->pdf ?>" target="_blank"
                                            class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="research-page research-article-page news-multimedia-detail-page px-3 px-md-0 section-top">

    <?php


    $Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

    ?>
    <div class=" " id="dvContents">
        <!-- Donwload pdf 1 -->
        <!-- Donwload pdf 2 -->
        <div class="container download-section-two bg-white mt-3 pr-0 pl-0">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="img-container">
                        <?php if ($article->video_url != '') { ?>
                        <!-- // echo substr($article->video_url,32,11); -->
                        <?php echo $article->video_url; ?>
                        <?php } else { ?>
                        <img class="responsive" src="<?= base_url() ?><?= $article->image_name ?>">
                        <?php } ?>
                    </div>
                    <div class="page-content">
                        <div class="category mt-3 mr-5">
                            <?php
                            if ($article->article_type != 'publications') {
                                if ($article->article_type == 'articles') {
                                    $type = "Article";
                                } else {
                                    $type = $article->article_type;
                                }
                                echo ucfirst($type);
                            } else {
                                echo "Publication";
                            }
                            ?>
                        </div>
                        <h2 style="font-size: 28px; " class="heading"><?php $k = str_replace("â€™", "'", $article->title);
                                                                        echo (str_replace("â€˜", "", $k));   ?></h2>
                        <div>
                            <span class="date"> <?php echo date('j  F Y', strtotime($article->posted_date)) ?> </span>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-12">
                                <div style=" padding-top: 10px; " class="category"><?= ltrim($tags, ':') ?> </div>
                            </div>

                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-6" style="width: 58%; float: left">
                                <div class="social-media-icons">
                                    <span>Share Article</span>
                                    <br>
                                    <div class="sosMedShare">
                                        <img style="width: 22px"
                                            src="<?= base_url() ?>resources/images/SocialMedia/4.png">
                                    </div>
                                    <div class="sosMedShare">
                                        <img style="width: 22px"
                                            src="<?= base_url() ?>resources/images/SocialMedia/3.png">
                                    </div>
                                    <div class="sosMedShare">
                                        <img style="width: 22px"
                                            src="<?= base_url() ?>resources/images/SocialMedia/5.png">
                                    </div>
                                    <div class="sosMedShare">
                                        <img style="width: 22px"
                                            src="<?= base_url() ?>resources/images/SocialMedia/1.png">
                                    </div>
                                </div>
                            </div>


                            <div style="text-align: right; width: 42%; float: right" class="col-md-6">
                                <span class="small-text">Print Article</span>
                                <span> &nbsp<a id="btnPrint" href="#"><img style="width: 33px"
                                            src="<?= base_url() ?>resources/images/SocialMedia/2.png"> </a> </span>
                            </div>
                        </div>


                        <p class='has-dropcap'>
                            <?php

                            echo  $article->content;

                            ?>
                        </p>
                    </div>

                </div>
                <div class="col-md-4 content-section-right  col-12">
                    <?php foreach ($card as $c) { ?>
                    <?php if (!empty($c->file)) { ?>
                    <?php $this->load->view($c->path . $c->file); ?>
                    <?php } else { ?>
                    <div class="container background d-none d-sm-block" style="background: #F3F8FC;">
                        <div class="row d-none d-sm-block">
                            <div class="col-md-12 col-xs-12 d-none d-sm-block">
                                <?php echo $c->template; ?>
                            </div>
                        </div>

                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>







    <!-- Related articles -->
    <div class="row mr-md-2 mr-0 mr-md-0 ml-1">
        <div class="col-md-12">
            <div class="container related-article mb-4">
                <div class="container py-5">
                    <h3 class="main-title text-blue mb-3">Related Articles </h3>
                    <div class="row page-content">
                        <?php
                        for ($c = 0; $c <= 2; $c++) {
                            if (isset($related[$c])) {
                                if (file_exists(FCPATH . $related[$c]->image_name)) {
                                    $img = base_url() . $related[$c]->image_name;
                                    $nm = "<img class='responsive' style='height:200px'  src=" . $img . ">";
                                } else if ($related[$c]->image_name) {
                                    $img = "https://www.eria.org" . $related[$c]->image_name;
                                    $nm = "<img class='responsive' style='height:200px'  src=" . $img . ">";
                                } else {

                                    if ($related[$c]->article_type == 'publications') {
                                        $img = "upload/Publication.jpg";

                                        $nm = "<div style='' height:220px;  text-align: center;  position: relative; z-index: 5;'>  <div style=' position: absolute; z-index: -1; top: 0; bottom: 0; left: 0; right: 0; background: url(" . $img . ") center center; opacity: 0.1; width: 100%; height: 100%;' class='bg'></div> <img style='width: 55%; height: 100%; object-fit: contain ' class='responsive' src=" . $img . "></div>";
                                    } else {
                                        $img = "upload/Article.jpg";
                                        $nm = "<img class='responsive' src=" . $img . ">";
                                    }
                                }
                        ?>

                        <div class="col-md-4 col-12 mb-4 mb-md-0">
                            <?= $nm ?>
                            <div class="category mt-3"> Article </div>
                            <div class="card-title text-blue"> <a
                                    href="<?= base_url() ?>news/details/<?= $related[$c]->uri ?>">
                                    <?= str_replace("â€™", "'", $related[$c]->title) ?> </a> </div>
                            <div>

                                <?php if ($related[$c]->author != '') { ?>
                                <span class="date">Editor(s)/Author(s) : </span>
                                <span class="author"><?= substr($related[$c]->author, 0, 20) ?></span>
                                <span class="date hori-line">---</span>
                                <?php } ?>

                                <span class="date"> <?php echo date('j  F Y', strtotime($related[$c]->posted_date)) ?>
                                </span>
                            </div>
                        </div>

                        <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Related Publications -->
            <div class="container related-article mb-5">
                <div class="container page-content py-5">
                    <h3 class="main-title text-blue mb-3">Related Publications </h3>
                    <div class="row">
                        <?php for ($t = 0; $t <= 1; $t++) {
                            if (isset($publ[$t])) {
                                if (file_exists(FCPATH . $publ[$t]->image_name)) {

                                    $img = base_url() . $publ[$t]->image_name;
                                } else if ($publ[$t]->image_name) {
                                    $img = "https://www.eria.org" . $publ[$t]->image_name;
                                } else {

                                    if ($publ[$t]->article_type == 'publications') {
                                        $img = "upload/Publication.jpg";
                                    } else {
                                        $img = "upload/Article.jpg";
                                    }
                                }
                        ?>
                        <div class="col-md-6 col-12">
                            <div class="d-flex">
                                <div class="col-md-4 col-xs-12 pr-2 m-0 p-0">
                                    <img class="responsive" src="<?= $img ?>">
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <div class="category">Publication</div>
                                    <div class="card-title">

                                        <a href="<?= base_url() ?>Publications/Detail/<?= $publ[$t]->uri ?>">
                                            <?= str_replace("â€™", "'", $publ[$t]->title) ?>
                                        </a>
                                    </div>
                                    <div class="py-2">
                                        <?php if ($publ[$t]->author != '') { ?>
                                        <span class="date">by</span>
                                        <span class="author"><?= substr($publ[$t]->author, 0, 20) ?></span>
                                        <span class="date hori-line">---</span>

                                        <?php } ?>
                                        <span class="date">
                                            <?php echo date('j  F Y', strtotime($publ[$t]->posted_date)) ?> </span>
                                    </div>
                                    <div class="description ">

                                        <?php
                                                $ns = strip_tags(substr($publ[$t]->content, 0, 150));


                                                $str = substr($ns, 0, strrpos($ns, ' '));

                                                echo $str . "[...]";

                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/multimedia/news-multimedia-detail-V2.js"></script>