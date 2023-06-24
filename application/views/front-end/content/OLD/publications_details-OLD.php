<style>
.page-content {
    z-index: 1;
}

.sticky-top {
    top: 120px !important;
}

.page-content .content-section-right .heading {
    font-weight: 700 !important;
    font-size: 22px !important;
    line-height: 1.23 !important;
}

/* === */
.publications-share-icon {
    font-size: 20px;
}

.publications-share-icon .bi {
    color: #000000;
    opacity: 50%;
}

.publications-share-icon .bi-facebook:hover {
    color: #3a559f;
}

.publications-share-icon .bi-twitter:hover {
    color: #179cf0;
}

.publications-share-icon .bi-linkedin:hover {
    color: #0077b7;
}

.print-icon {
    font-size: 20px;
    color: #666666;
}

.print-icon:hover {
    color: #1E427B;
}

/* === */
</style>
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


$Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];


function htmlallentities($str)
{
    $res = '';
    $strlen = strlen($str);
    for ($i = 0; $i < $strlen; $i++) {
        $byte = ord($str[$i]);
        if ($byte < 128) // 1-byte char
            $res .= $str[$i];
        elseif ($byte < 192); // invalid utf8
        elseif ($byte < 224) // 2-byte char
            $res .= '&#' . ((63 & $byte) * 64 + (63 & ord($str[++$i]))) . ';';
        elseif ($byte < 240) // 3-byte char
            $res .= '&#' . ((15 & $byte) * 4096 + (63 & ord($str[++$i])) * 64 + (63 & ord($str[++$i]))) . ';';
        elseif ($byte < 248) // 4-byte char
            $res .= '&#' . ((15 & $byte) * 262144 + (63 & ord($str[++$i])) * 4096 + (63 & ord($str[++$i])) * 64 + (63 & ord($str[++$i]))) . ';';
    }
    return $res;
}


?>


<?php $this->load->view('front-end/content/modals/modal-pdf-publications'); ?>
<!-------------------------------------------- Research page ------------------------------------------------------------------>
<style>
._research-publication-page {
    z-index: -111111;
}

.gray-box {
    height: auto;
    background: #F8F8F8;
    width: 100%;
    position: static;
    top: 30px;
    right: 112px;
}
</style>

<style>
@media (max-width: 575.98px) {
    .download-section-two .page-content .dow-content-col {
        padding-top: 1rem !important;
    }

    .research-areas .research-items {
        flex-direction: column !important;
    }

    .research-areas {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .icon-wrap .col-md-5 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
        text-align: left !important;
        padding-top: 15px !important;
    }

    .related-publication-col .page-content .category {
        padding-top: 1rem !important;
    }

}

@media (min-width: 576px) and (max-width: 767.98px) {
    .download-section-two .page-content .dow-content-col {
        padding-top: 1rem !important;
    }

    .icon-wrap .col-md-7 {
        flex: 0 0 60%;
        max-width: 60%;
    }

    .icon-wrap .col-md-5 {
        flex: 0 0 40%;
        max-width: 40%;
    }

    .related-articles-col img {
        width: 100%;
        height: 300px !important;
        object-fit: cover !important;
    }

    .research-areas .research-items {
        flex-direction: column !important;
    }

    .research-areas {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .related-publication-col .page-content .category {
        padding-top: 1rem !important;
    }

}

@media (min-width: 768px) and (max-width: 991.98px) {
    .col-100-w {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }

    .related-publication-col .page-content .category {
        padding-top: 1rem !important;
    }

    .down-btn-p {
        width: 200px !important;
    }

    .content-section-right .heading,
    .top-cover .heading {
        font-size: 18px !important;
    }

    .icon-wrap {
        width: 400px !important;
    }

    .download-section-two .page-content .dow-content-col {
        padding-top: 1rem !important;
    }

    .page-content .heading {
        font-size: 18px !important;
    }

    .related-articles-col img {
        width: 100%;
        height: 140px !important;
        object-fit: cover !important;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    .icon-wrap {
        width: 100% !important;
    }

    .related-articles-col img {
        width: 100%;
        height: 200px !important;
        object-fit: cover !important;
    }
}

@media (min-width: 1200px) {
    .related-articles-col img {
        width: 100%;
        height: 200px !important;
        object-fit: cover !important;
    }
}

.related-cat-topic {
    color: #003680 !important;
}

.page-content .heading {
    margin-top: 0 !important;
}

/*.page-content .date {
        padding-left: 25px !important;
    }*/
.related-topic {
    margin-top: 0 !important;
    margin-bottom: .25rem !important;
}

.related-topic-owner {
    margin-top: 0 !important;
}

.category a {
    color: #69AAB4 !important;
}

.category-pb a {
    color: #69AAB4 !important;
}

iframe {
    width: 100% !important;
}
</style>
<div class="research-page research-publication-page px-3 px-md-0 section-top">

    <!-- Breadcrumb -->
    <?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
    <!-- end Breadcrumb -->

    <div class="container download-section-two top-cover pt-0 mb-4">
        <div class="row mb-4">
            <div class="col-lg-9">
                <h2 class="main-title text-blue">
                    <?php
                        $g = RemoveBS(str_replace(array("â€™", "â€”", "â€“", "â€˜"), "-", $article->title));
                        $kl = RemoveBS(str_replace('â€“', "'", $g));
                        echo str_replace(array("â€™", "â€”", "â€“", "â€˜"), "'", $article->title);
                    ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 ">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-3 mb-4 mb-lg-0">
                        <div style="height: auto !important;" class="img-container mb-3">
                            <?php 
                            if (!empty($article->image_name)) {
                                if (file_exists(FCPATH . $article->image_name)) {
                                    $img = base_url() . $article->image_name;
                                } else if ($article->image_name) {
                                    $img = "https://www.eria.org" . $article->image_name;
                                } else {

                                    if ($article->article_type == 'publications') {
                                        $img = base_url() . "upload/Publication.jpg";
                                    } else {
                                        $img = base_url() . "upload/Article.jpg";
                                    }
                                }
                            } else {
                                $img = base_url() . "upload/Publication.jpg";
                            }
                            ?>
                            <img src="<?php echo $img ?>">
                        </div>
                        <div>
                            <p class="text-uppercase font-weight-semibold mb-0" style="font-size:14px">Date:</p>
                            <p class="text-black-50" style="font-size:14px">
                                <?php echo date('j  F Y', strtotime($article->posted_date)) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-uppercase font-weight-semibold mb-0" style="font-size:14px">Category:</p>
                            <p class="text-black-50" style="font-size:14px">
                                <?php
                                if (!empty($topics)) {
                                    $countries_asean = $this->frontModel->getCountriesAsean(16);

                                    $not_asean = ['Australia', 'China', 'India', 'Japan', 'New Zealand', 'Republic of Korea'];

                                    foreach ($countries_asean as $value) {
                                        
                                        if (!in_array($value->venue, $not_asean)) {
                                            $asean[] = $value->venue;
                                        }
                                    }
                                    foreach ($topics as $topic_) {
                                        if (in_array($topic_->category_name, $asean)) {
                                            $topic_data[] = '<a href="' . base_url() . 'research/topic/asean/' . $topic_->category_name . '">' . $topic_->category_name . '</a>';
                                        } else {
                                            $topic_data[] = '<a href="' . base_url() . 'research/topic/' . $topic_->uri . '">' . $topic_->category_name . '</a>';
                                        }
                                        
                                    }
                                    echo implode(', ', $topic_data);
                                }
                                ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-uppercase font-weight-semibold mb-0" style="font-size:14px">Type:</p>
                            <p class="text-black-50" style="font-size:14px">
                                <?php
                                $category_type = $this->frontModel->get_articleCatogery($article->article_id);

                                if (!empty($category_type)) {
                                    echo '<a href="' . base_url() . 'publications/category/' . $category_type->uri . '">
                                                ' . $category_type->category_name  . ' 
                                            </a>';
                                }
                                ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-uppercase font-weight-semibold mb-0" style="font-size:14px">
                                Author(s)/Editor(s):</p>
                            <p class="text-black-50" style="font-size:14px">
                                <?php
                                        $getAuthorEditorHighLIght = $this->frontModel->getHighlightByArticleId($article->article_id);

                                        if (isset($getAuthorEditorHighLIght) and count($getAuthorEditorHighLIght) > 0) {

                                            foreach ($getAuthorEditorHighLIght as $value) {
                                                $getAuthorEditor = $this->frontModel->getPeopleAuthorEditorByArticleId($value->ec_id);

                                                $people_data[] = [
                                                    'article_id' => $getAuthorEditor->article_id,
                                                    'title' => $getAuthorEditor->title,
                                                    'uri'   => $getAuthorEditor->uri,
                                                ];
                                            }

                                            foreach ($people_data as $value) {
                                                $link_url[] = ' <a href="' . base_url() . 'experts/' . $value['title'] . '">' . $value['uri']. '</a>';
                                            }
                                            
                                            echo implode(', ', $link_url);
                                        } else {
                                            if (!empty($article->editor) || !empty($article->author)) {
                                                $a1 = explode(', ', $article->editor);
                                                $a2 = explode(', ', $article->author);
                                                $mergingPeople = array_merge($a1, $a2);

                                                foreach ($mergingPeople as $value) {
                                                    $this->db->select('*');
                                                    $this->db->where('published', 1);
                                                    $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
                                                    $this->db->where('title', $value);
                                                    $peopleresult = $this->db->get('articles')->row();

                                                    if (isset($peopleresult)) {
                                                        $peoples[] = '<a href="' . base_url() . 'experts/' . $peopleresult->uri . '">' . $peopleresult->title . '</a>';
                                                    } else {
                                                        $peoples[] = $value;
                                                    }
                                                }

                                                echo preg_replace('/,/', '',  implode(', ', $peoples), 1);
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-weight-semibold mb-0" style="font-size:14px">Tags:</p>
                            <input class="text-black-50" value="<?php if ($cat) {
                                                            echo $cat->uri;
                                                        } ?>" id="ct" type="hidden">
                            <?php echo str_replace(',', ', ', $article->tags); ?>
                            </input>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase font-weight-semibold mb-1" style="font-size:14px">Share:</p>
                                <div class="publications-share-icon d-flex">
                                    <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                    <a class="mr-2"
                                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link ?>"
                                        target="_blank"><i class="bi bi-facebook"></i>
                                    </a>
                                    <a class="mr-2" href="http://www.twitter.com/share?url=<?php echo $actual_link ?>"
                                        target="_blank"><i class="bi bi-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $actual_link ?>"
                                        target="_blank"><i class="bi bi-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <p class="text-uppercase font-weight-semibold mb-1" style="font-size:14px">Print:</p>
                                <a class="print-icon" id="btnPrint" href="#">
                                    <i class="bi bi-printer"></i>
                                </a>

                            </div>
                        </div>
                        <hr class="d-block d-lg-none">
                    </div>

                    <div class="col-md-9">
                        <div class="dow-content-col">
                            <?php echo $article->content ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 content-section-right col-12">
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


    <div class="row mr-md-2 mr-0 mr-md-0 ml-1">
        <div class="col-md-12 pl-0 pr-0">
            <!-- Related articles -->
            <div class="d-none">
                <?php $this->load->view('front-end/content/relateds/articles_related'); ?>
            </div>

            <!-- Related Publications -->
            <?php $this->load->view('front-end/content/relateds/publications_related'); ?>
            <!-- END -->
        </div>
    </div>

    <!-- Research area -->
    <?php $this->load->view('front-end/content/sections/research-areas'); ?>
    <!-- END Research area -->
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




<script>
$('.n_related').click(function() {

    var dat = $(this).data('key');
    var ct = $('#ct').val();
    if (ct != '') {
        var n = ct;
    } else {
        var n = 'all';

    }


    var url = '<?php echo base_url() ?>Publications/Brows/' + n + '/' + dat;

    window.location.replace(url);


})
</script>