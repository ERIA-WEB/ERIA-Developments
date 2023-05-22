<div class="research-page research-article-page news-multimedia-detail-page px-3 px-md-0">

    <?php


    $Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

    ?>


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
                                    <div class="toggle-btn panel-title" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
    <div class="section-top" id="dvContents">
        <!-- Donwload pdf 1 -->
        <div class="container top-cover">
            <div class="background-grey"></div>
            <div class="row">
                <div class="col-md-6 col-12 page-content">
                    <div>
                        <?php
                        ?>
                        <div class="category mr-5"><?php echo ucfirst($article->article_type) ?></div>
                        <h2 class="heading"><?php echo $article->title ?></h2>
                        <div>
                            <span class="date"> <?php echo date('j  F Y', strtotime($article->posted_date)) ?> </span>
                        </div>
                    </div>
                    <div class="row mt-4 authors">
                        <div style="display:none" class="col-md-12">
                            <div class="social-media-icons">
                                <span>Share Article</span>
                                <span><img src="<?= base_url() ?>resources/images/SocialMedia/facebook-icon.png"></span>
                                <span><img src="<?= base_url() ?>resources/images/SocialMedia/twitter-icon.png"></span>
                                <span><img src="<?= base_url() ?>resources/images/SocialMedia/linkdin-icon.png"></span>
                                <span><img
                                        src="<?= base_url() ?>resources/images/SocialMedia/instagram-icon.png"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 video-padding">
                    <div style="height: 350px" class="img-container">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/<?= substr($article->video_url, 17, 100) ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donwload pdf 2 -->
        <div class="container download-section-two bg-white mt-3 pr-0 pl-0">
            <div class="row">
                <div class="col-md-2 col-12">
                    <div class=" hidden-print sticky-top">

                        <?php if ($pdf) { ?>
                        <p class="small-text">You can download complete information about this publication</p>
                        <button data-toggle="modal" data-target="#downloadPdfModal1"
                            class="btn pdf-download-btn w-100">DOWNLOAD
                            PDF</button>
                        <?php } ?>
                        <p class="mb-2 font-weight-medium font-merriweather fs-sm">Share Article</p>
                        <div class="social-media-icons">
                            <span>
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo $Url ?>" target="_blank">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/facebook-icon.png"> </a>
                            </span>
                            <span>
                                <a target="_blank" href="https://twitter.com/share?url=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/twitter-icon.png">
                                </a>
                            </span>
                            <span>
                                <a target="_blank"
                                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/linkdin-icon.png">
                                </a>
                            </span>
                            <span>
                                <a target="_blank" href="https://www.instagram.com/sharer.php?u=<?php echo $Url; ?>">
                                    <img src="<?= base_url() ?>resources/images/SocialMedia/instagram-icon.png">
                                </a>
                            </span>
                        </div>
                        <div class="small-text">Print Article</div>
                        <div> <a id="btnPrint" href="#">
                                <img src="<?= base_url() ?>resources/images/SocialMedia/print-icon.png"> </a> </div>
                    </div>

                </div>
                <div class="col-md-10 col-12">
                    <div class="padding-right">

                        <?php

                        echo $article->content;

                        ?>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related articles -->
    <div class="row mr-md-2 mr-0 mr-md-0 ml-1">
        <div class="col-md-12">





            <div class="container related-article mb-4">
                <div class="container py-3">
                    <h3 class="main-title text-blue">Related Articles </h3>
                    <div class="row page-content pb-3">

                        <?php

                        for ($c = 0; $c <= 2; $c++) {




                            if (file_exists(FCPATH . $related[$c]->image_name)) {

                                $img = base_url() . $related[$c]->image_name;
                            } else {

                                if ($related[$c]->article_type == 'publications') {
                                    $img = "upload/Publication.jpg";
                                } else {
                                    $img = "upload/Article.jpg";
                                }
                            }


                        ?>


                        <div class="col-md-4 col-12 mb-4">
                            <img class="responsive" src="<?= $img ?>">
                            <div class="category mt-3"> <?= ucfirst($related[$c]->article_type) ?> </div>
                            <div class="heading"> <a href="<?= base_url() ?>news/details/<?= $related[$c]->uri ?>">
                                    <?= $related[$c]->title ?> </a> </div>
                            <div>

                                <?php if ($related[$c]->author != '') { ?>
                                <span class="date">by</span>
                                <span class="author"><?= $related[$c]->author ?></span>
                                <span class="date hori-line">---</span>
                                <?php } ?>

                                <span class="date"> <?php echo date('j  F Y', strtotime($related[$c]->posted_date)) ?>
                                </span>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
            </div>



            <!-- Related Publications -->
            <div class="container related-article mb-5">
                <div class="container page-content py-3">
                    <h3 class="main-title text-blue">Related Publications </h3>
                    <div class="row">
                        <?php for ($t = 0; $t <= 1; $t++) {

                            if (file_exists(FCPATH . $publ[$t]->image_name)) {

                                $img = base_url() . $publ[$t]->image_name;
                            } else {

                                if ($publ[$t]->article_type == 'publications') {
                                    $img = "upload/Publication.jpg";
                                } else {
                                    $img = "upload/Article.jpg";
                                }
                            }



                        ?>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="row pb-4 mx-1">
                                <div class="col-md-4 col-xs-12 pr-2 m-0 p-0">
                                    <img class="responsive" src="<?= $img ?>">
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <div class="category"><?= ucfirst($publ[$t]->article_type) ?></div>
                                    <div class="heading"><a
                                            href="<?= base_url() ?>Publications/Detail/<?= $publ[$t]->uri ?>"><?= $publ[$t]->title ?></a>
                                    </div>
                                    <div class="py-2">
                                        <?php if ($publ[$t]->author != '') { ?>
                                        <span class="date">by</span>
                                        <span class="author"><?= $publ[$t]->author ?></span>
                                        <span class="date hori-line">---</span>

                                        <?php } ?>
                                        <span class="date">
                                            <?php echo date('j  F Y', strtotime($publ[$t]->posted_date)) ?> </span>
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




        </div>
    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    $("#btnPrint").click(function() {




        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument
            .document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/css/style.css" rel="stylesheet" type="text/css" />'
        );


        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/css/animate.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />'
        );


        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />'
        );






        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />'
        );



        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/css/responsive.css" rel="stylesheet" type="text/css" />'
        );
        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />'
        );
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
</script>