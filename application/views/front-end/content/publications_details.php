<?php if (isset($article)) { ?>
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

.icon-wrap .bi {
    color: #727272;
    font-size: 24px;
}

.icon-wrap .bi:hover {
    color: #1A3B70;
}
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

.top-cover .background {
    background: rgb(243, 248, 252) !important;
}
</style>

<div class="research-page research-publication-page px-3 px-md-0 section-top">
    <div id="dvContents">
        <!-- Breadcrumb -->
        <?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
        <!-- end Breadcrumb -->
        <div class="container download-section-two top-cover pt-0 pl-0 pr-0">
            <div class="row">
                <div class="col-lg-8 col-12 page-content">

                    <div class="gray-box p-4">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <h2 style="font-size: 28px;line-height: normal;" class="card-title text-blue">
                                    <?php
                                    $g = RemoveBS(str_replace(array("â€™", "â€”", "â€“", "â€˜"), "-", $article->title));

                                    $kl = RemoveBS(str_replace('â€“', "'", $g));
                                    echo str_replace(array("â€™", "â€”", "â€“", "â€˜"), "'", $article->title);
                                    ?>
                                </h2>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 mb-3">
                            <div class="col-12 col-md-5 mb-3 mb-md-0">
                                <?php if (!empty($article->image_name)) {
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
                                <img src="<?php echo $img ?>" class="img-fluid w-100"
                                    alt="<?= str_replace(array("â€™", "â€”", "â€“", "â€˜"), "'", $article->title) ?>">
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="mb-3">
                                    <h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                        Date:</h6>
                                    <span class="date"> <?php echo date('j  F Y', strtotime($article->posted_date)) ?>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                        Category:</h6>
                                    <span class="date">
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
                                    </span>
                                </div>
                                <?php
                                
                                $publication_type = $this->frontModel->get_articleCat($article->article_id);
                                
                                if (isset($publication_type)) {
                                    $publicationtype = explode(', ', $publication_type);
                                
                                    if(isset($publicationtype)) {
                                        
                                        foreach ($publicationtype as $key => $val_cat) {
                                            if (!empty($val_cat)) {
                                                $publicationType[$key] = '<a href="'.base_url().'publications/category/'.str_replace(array(" ", ": ", ", "), "-", strtolower($val_cat)).'">'.ucfirst($val_cat).'</a>';
                                            } else {
                                                $publicationType = array();
                                            }
                                            
                                        }
                                        
                                        if (!empty($publicationType)) {
                                            $headTitle =  implode(", ", array_slice($publicationType, 0, 1));
                                            $hidden = '';
                                            
                                        } else {
                                            $headTitle = '';
                                            $hidden = 'd-none';
                                        }

                                        echo '<div class="mb-3 '.$hidden.'">
                                        <h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                        Type:</h6>
                                                    <span class="date">'.$headTitle.'</span>
                                                </div>';
                                        
                                    }
                                }
                                
                                ?>
                                <?php
                                
                                // Get Data Author & Editor
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
                                    
                                    echo '<div class="highlight-author pb-2 pt-1 mb-3">
                                            <h6
                                                style="font-size: 12px;font-weight: bold !important;color: #0f3979;line-height: 5px;padding-bottom: 0;">
                                                Highlight Author/Editor(s):
                                            </h6>
                                        </div>';
                                    echo '<span class="date">'.implode(', ', $link_url).'</div>';
                                } else {
                                    
                                    // author
                                    if (!empty($article->author)) {
                                        $author_str = str_replace(array(',',', '), ', ', $article->author);
                                        $a2 = explode(', ', $author_str);
                                        
                                        foreach ($a2 as $value) {
                                            $this->db->select('*');
                                            $this->db->where('published', 1);
                                            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
                                            $this->db->where('title', $value);
                                            $peopleauthorresult = $this->db->get('articles')->row();

                                            if (isset($peopleauthorresult)) {
                                                $peoples_author[] = '<a href="' . base_url() . 'experts/' . $peopleauthorresult->uri . '">' . $peopleauthorresult->title . '</a>';
                                            } else {
                                                $peoples_author[] = $value;
                                            }
                                        }

                                        echo '<div class="highlight-author pb-2 pt-1 mb-3">';
                                            echo '<h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                                    Authors:
                                                </h6>';
                                            echo '<span class="date">'.implode(', ', $peoples_author).'</span>';
                                        echo '</div>';
                                    } else {
                                        echo '';
                                    }

                                    // editor
                                    if (!empty($article->editor)) {
                                        $editor_str = str_replace(array(',',', '), ', ', $article->editor);
                                        $a1 = explode(', ', $editor_str);
                                        
                                        foreach ($a1 as $value) {
                                            $this->db->select('*');
                                            $this->db->where('published', 1);
                                            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
                                            $this->db->where('title', $value);
                                            $peopleeditorresult = $this->db->get('articles')->row();

                                            if (isset($peopleeditorresult)) {
                                                $peoples_editor[] = '<a href="' . base_url() . 'experts/' . $peopleeditorresult->uri . '">' . $peopleeditorresult->title . '</a>';
                                            } else {
                                                $peoples_editor[] = $value;
                                            }
                                        }

                                        echo '<div class="highlight-author pb-2 pt-1 mb-3">';
                                            echo '<h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                                    Editors:
                                                </h6>';
                                            echo '<span class="date">'.implode(', ', $peoples_editor).'</span>';
                                        echo '</div>';
                                    } else {
                                        echo '';
                                    }
                                }
                                ?>

                                <div class="mb-3">
                                    <h6 class="text-uppercase font-merriweather font-weight-semibold fs-xs text-blue">
                                        Tags:</h6>
                                    <span class="date">
                                        <input value="<?php if ($cat) {
                                                            echo $cat->uri;
                                                        } ?>" id="ct" type="hidden">
                                        <?php echo str_replace(',', ', ', $article->tags); ?>
                                    </span>

                                </div>
                                <?php if (!empty($pdf)) { ?>
                                <div class="row mt-5 mb-4">
                                    <div class="col-md-7">
                                        <button style="background: #f8f8f8;" data-toggle="modal"
                                            data-target="#downloadPdfModal1"
                                            class="btn pdf-download-btn w-100 down-btn-p">DOWNLOAD PDF</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row row-cols-2">
                            <div class="col-sm-6">
                                <div style="padding-top:0px " class="social-media-icons">
                                    <p class="mb-2 font-weight-medium font-merriweather fs-sm">Share Article:</p>
                                    <div class="publications-share-icon d-flex">
                                        <?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                        <a class="mr-2"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link ?>"
                                            target="_blank"><i class="bi bi-facebook"></i>
                                        </a>
                                        <a class="mr-2"
                                            href="http://www.twitter.com/share?url=<?php echo $actual_link ?>?utm_source=Twitter"
                                            target="_blank"><i class="bi bi-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $actual_link ?>"
                                            target="_blank"><i class="bi bi-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column text-right">
                                <p class="mb-2 font-weight-medium font-merriweather fs-sm">Print Article:</p>
                                <div class="publications-share-icon">
                                    <a id="btnPrint" href="#"><i class="bi bi-printer-fill"></i>
                                    </a>
                                    </d>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                    .dow-content-col img {
                        width: 100%;
                    }
                    </style>
                    <div class="dow-content-col">
                        <p class="pb-c">
                            <?php echo $article->content ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 content-section-right d-none d-lg-block">
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
            <!-- Related Articles -->
            <?php $this->load->view('front-end/content/relateds/research_related'); ?>
            <!-- END -->
        </div>
    </div>

    <!-- Research area -->
    <?php $this->load->view('front-end/content/sections/research-areas'); ?>
    <!-- END Research area -->
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/publications/publications-detail.js"></script>

<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>