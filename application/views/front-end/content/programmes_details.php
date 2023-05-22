<?php if (isset($article)) { ?>
<?php
function RemoveBS($Str)
{
    $StrArr = str_split($Str);
    $NewStr = '';
    foreach ($StrArr as $Char) {
        $CharNo = ord($Char);
        if ($CharNo == 163) {
            $NewStr .= $Char;
            continue;
        } // keep £ 
        if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
        }
    }
    return $NewStr;
}
?>
<?php
$whitelist = array('127.0.0.1', "::1", "localhost");

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);

    if (in_array('database-and-programmes', $urlArray)) {
        $breadcumb = 'database-and-programmes';
    } else {
        $breadcumb = 'database-and-programmes';
    }
} else {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    if (in_array('database-and-programmes', $urlArray)) {
        $breadcumb = 'database-and-programmes';
    } else {
        $breadcumb = 'database-and-programmes';
    }
}

?>
<style>
.card-image-background {
    left: 0;
    right: 0;
    opacity: .1;
}

.responsive {
    z-index: 20;
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

    <div id="dvContents">
        <!-- Donwload pdf 1 -->
        <!-- Donwload pdf 2 -->
        <!-- Breadcrumb -->
        <?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
        <!-- end Breadcrumb -->
        <div class="container download-section-two bg-white mt-3 pl-0 pr-0">
            <div class="row">
                <div class="col-md-8 col-12">

                    <?php if (!empty($article->video_url)) { ?>
                    <div style="height: 350px" class="img-container">
                        <iframe width="100%" height="100%"
                            src="https://www.youtube.com/embed/<?= substr($article->video_url, 17, 100) ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <?php } else {  ?>
                    <?php
                            if ($article->image_name != '') {
                                if (file_exists(FCPATH . $article->image_name) && $article->image_name != '') {
                                    $img = base_url() . $article->image_name;
                                } elseif (file_exists(FCPATH . '/resources/images' . $article->image_name) && $article->image_name != '') {
                                    $img = base_url() . 'resources/images' . $article->image_name;
                                } else {
                                    if (!empty($article->image_name)) {
                                        $url_articles = "https://www.eria.org" . $article->image_name;
                                        $response_articles = file_get_contents($url_articles);
                                        if (strlen($response_articles)) {
                                            $img = "https://www.eria.org" . $article->image_name;
                                        } else {
                                            $img = base_url() . "/upload/news.jpg";
                                        }
                                    } else {
                                        $img = base_url() . "/upload/news.jpg";
                                    }
                                }

                                echo '<div style="height: auto" class="img-container"> <img class="responsive mb-2" src="' . $img . '"> </div>';
                            } else {
                                $img = base_url() . "/upload/news.jpg";
                                echo '<div style="height: auto" class="img-container"> <img class="responsive mb-2" src="' . $img . '"> </div>';
                            }
                            ?>

                    <?php } ?>
                    <div class="page-content">
                        <div class="gray-bg pt-2 pl-3 pr-3 pb-2">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <h2 style="font-size: 28px;" class="second-title text-blue">
                                        <?php echo RemoveBS(str_replace("â€™", "'", $article->title));  ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6
                                            class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                            Date:</h6>
                                        <span class="date">
                                            <?php
                                            if (!empty($article->posted_date)) {
                                                echo date('j  F Y', strtotime($article->posted_date));
                                            } else {
                                                echo " - ";
                                            }

                                            ?>
                                        </span>
                                    </div>
                                    <?php if (!empty($article->editor)) { ?>
                                    <div class="mb-3">
                                        <h6 class="date"
                                            style="font-size: 12px;font-weight: bold !important;color: #0f3979;line-height: 5px;padding-bottom: 0;">
                                            <?php 
                                                $_categories = explode(',', $cats);
                                                foreach ($_categories as $value) {
                                                    if (!empty($value)) {
                                                        $categories_[] = $value;
                                                    }
                                                }
                                                
                                                if (!in_array('Opinions', $categories_)) {
                                                    echo 'By: ';
                                                } else {
                                                    echo 'Author/Editor(s): ';
                                                }
                                            ?>
                                        </h6>
                                        <span class="date">
                                            <?php
                                            if (!empty($article->editor)) {
                                                echo '<a href="' . base_url() . 'experts/' . str_replace(" ", "-", strtolower(RemoveBS(str_replace("â€™", "'", $article->editor)))) . '" target="_blank">' . RemoveBS(str_replace("â€™", "'", $article->editor)) . '</a>';
                                            } else {
                                                echo " - ";
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <style>
                                @media (max-width: 767px) {
                                    #textMobileLeft.col-md-6.text-right .mb-3 {
                                        text-align: left !important;
                                    }
                                }
                                </style>
                                <div id="textMobileLeft" class="col-md-6 text-right">
                                    <?php 
                                        $cats = $this->frontModel->get_articleCat($article->article_id); 
                                        if (!empty($cats)) {
                                            $hide_category = '';
                                        } else {
                                            $hide_category = 'd-none';
                                        }
                                    ?>

                                    <div class="mb-3 <?php echo $hide_category; ?>">
                                        <h6
                                            class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                            Category:</h6>
                                        <span class="date">
                                            <?php
                                            if (!empty($cats)) {
                                                foreach (explode(',', $cats) as $value) {
                                                    if (!empty($value)) {
                                                        $categories_data[] = '<a href="' . base_url() . 'news-and-views/category/' . strtolower(str_replace(' ', '-', substr($value, 1))) . '">' . substr($value, 1) . '</a>';   
                                                    }
                                                }

                                                echo implode(', ', $categories_data);
                                            } else {
                                                echo " - ";
                                            }

                                            ?>
                                        </span>
                                    </div>
                                    <?php 
                                        if (!empty($tags)) {
                                            $hide_topic = '';
                                        } else {
                                            $hide_topic = 'd-none';
                                        }
                                    ?>
                                    <div class="mb-3 <?php echo $hide_topic; ?>">
                                        <h6
                                            class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                            Topics:</h6>
                                        <span class="date">
                                            <?php
                                            if (!empty($tags)) {
                                                echo str_replace('<br>', '', ltrim($tags, ':'));
                                            } else {
                                                echo " - ";
                                            }

                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-6">
                                    <p class="mb-2 font-weight-medium font-merriweather fs-sm">Share Article:</p>
                                    <div class="publications-share-icon">
                                        <?php
                                        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        ?>
                                        <a class="mr-2" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                        <a class="mr-2" target="_blank"
                                            href="http://www.twitter.com/share?url=<?= $actual_link ?>?utm_source=Twitter">
                                            <i class="bi bi-twitter"></i>
                                        </a>
                                        <a target="_blank"
                                            href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $actual_link ?>">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex flex-column text-right">
                                    <p class="mb-2 font-weight-medium font-merriweather fs-sm">Print Article:</p>
                                    <div class="publications-share-icon">
                                        <a id="btnPrint" href="#"><i class="bi bi-printer-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class='has-dropcap'>
                            <?php
                            echo  $article->content;
                            ?>
                        </p>
                    </div>

                </div>
                <div class="col-md-4 content-section-right col-12">
                    <?php
                        if (!empty($card)) {
                            foreach ($card as $c) {
                                if (!empty($c->file)) {
                                    $this->load->view($c->path . $c->file);
                                } else {
                                    echo '<div class="container background d-none d-sm-block" style="background: #F3F8FC;">
                                            <div class="row d-none d-sm-block">
                                                <div class="col-md-12 col-xs-12 d-none d-sm-block">
                                                    '.$c->template.'
                                                </div>
                                            </div>

                                        </div>';
                                }
                            }
                        } else {
                            $this->load->view('front-end/common/card-randoms/cards');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mr-md-2 mr-0 mr-md-0 ml-1">
        <div class="col-md-12 pl-0 pr-0">
            <!-- Related articles -->
            <?php $this->load->view('front-end/content/relateds/articles_related'); ?>
            <!-- Related Publications -->
            <?php $this->load->view('front-end/content/relateds/publications_related'); ?>
            <!-- END -->
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
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>