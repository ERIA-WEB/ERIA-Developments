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

/*
** This is a Testing & Experimental For text language Japan .. Please try again because not success!!
*/
$profile = 'ãƒ‰ã‚¤ãƒ„ã®ç–¾ç—…é‡‘åº«ã«ã‚ˆã‚‹è·åŸŸå¥åº·ç®¡ç†ã®çŠ¶æ³ã¨äºˆé˜²æ³•ã®æˆç«‹';
$text = '\u30c9\u30a4\u30c4\u306e\u75be\u75c5\u91d1\u5eab\u306b\u3088\u308b\u8077\u57df\u5065\u5eb7\u7ba1\u7406\u306e\u72b6\u6cc1\u3068\u4e88\u9632\u6cd5\u306e\u6210\u7acb';
function isJapanese($word)
{
    return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $word);
}

function safeDisplayEditor($str)
{
    $str = stripslashes($str);
    $str = str_replace("\n", "", $str);
    $str = str_replace("\r", "", $str);
    $str = str_replace(array('?quot;'), array('"'), $str);
    $str = str_replace(array('?gt;'), array('>'), $str);
    $str = str_ireplace(array('<p>&nbsp;</p>', '&#65533;'), array('', '&bull;'), $str);
    return $str;
}

function createDomDocumentFromHtml($html)
{
    $document = new DOMDocument();
    $internalErrors = libxml_use_internal_errors(true);
    $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_use_internal_errors($internalErrors);
    $document->formatOutput = true;

    return $document;
}

$final = $article->publications;
// $final = utf8_encode($final);

$final = htmlspecialchars_decode($final);

$final = html_entity_decode($final, ENT_QUOTES, "UTF-8");

$final = utf8_decode($final);

?>

<style>
.experts-detail-page .experts-page-title {
    font-family: 'Merriweather';
}

a:hover {
    cursor: pointer;
}

.author-image {
    height: 300px;
    width: 250px;
}

.author-image img {
    width: auto;
    /*100%*/
    height: 100%;
    object-fit: cover;
}

.pd-95 {
    padding-top: 95px;
}

#detailPeople>table,
tr,
td {
    background-color: #f3f8fc;
}

.section-content {
    background-color: #f3f8fc;
    padding: 20px;
}

.exprience-content-body {
    border-left: 1px solid #cbcbcb;
}

.exprience-content-body:last-child {
    border-left: none;
}

.exprience-content-body::before {
    content: "";
    position: absolute;
    top: 0px;
    left: -10px;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background-color: #fff;
    border: 4px solid #0E3979;
}

.dot-fill::after {
    content: "";
    position: absolute;
    left: 0;
    height: 10px;
    width: 10px;
    background-color: #cbcbcb;
    border-radius: 50%;
}

.dot-outline::after {
    content: "";
    position: absolute;
    left: 0;
    height: 10px;
    width: 10px;
    border: 3px solid #CBCBCB;
    border-radius: 50%;
}

.profile-text-detail1 {
    width: 100%;
    padding: 10px;
}

.profile-text-detail1 ul li {
    list-style: disc;
}

table,
th,
tr,
td {
    border: none !important;
}

table.researcher-table {
    width: 100% !important;
}

.experts-detail-page .description,
.experts-detail-page .description span,
.experts-detail-page .description p {
    font-family: "Montserrat", sans-serif !important;
    font-size: 13px !important;
}

table.researcher-table span,
table.researcher-table p,
#expertise p,
#expertise span,
#publications p,
#publications span,
#education p,
#education span,
#others p,
#others span,
#experience p,
#experience span {
    font-family: "Montserrat", sans-serif !important;
    font-size: 15px !important;
    font-weight: 600 !important;
}

@media (max-width: 575.98px) {
    .experts-detail-page .author-detail .img-container {
        padding-bottom: 0 !important;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    .experts-detail-page .author-detail .img-container {
        padding-bottom: 0 !important;
    }
}

.experts-detail-page {
    padding-top: 2rem !important;
}

.researcher-table span,
#expertise p {
    font-family: "Montserrat", sans-serif !important;
}

.content-expetise ul li,
#education ul li,
#experience ul li,
#publications ul li,
#publications ol li,
#others ul li,
#presentations ul li {
    list-style: initial;
    margin-left: 15px;
    margin-bottom: 10px;
    font-size: 13px;
}

ul,
h1,
h2,
h3,
h4,
h5,
span {
    width: 100%;
    font-size: 13px;
}

.active-click {
    background: var(--primaryBlue);
    color: #fff !important;
    padding: 10px;
}

.active-border {
    background: none;
    color: var(--primaryBlue) !important;
    padding: 18px;
    border-left: 2px solid var(--primaryBlue);
    margin-left: -21px;
}

.sticky-top {
    top: 75px;
}
</style>

<div id="detailPeople" class="px-md-0 pb-5 section-top">
    <div class="container experts-detail-page">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="sticky-top">
                    <!-- class=" sticky-top"-->
                    <div id="stickyTop" class="profile-overView list-content p-4 mb-3">
                        <div>Profile Overview</div>
                        <?php 
                            if (!empty($article->article_keywords) && !empty($article->content)) {
                                echo '<div id="overviewBtn" data-overview="overview">
                                        <a id="overviewSticky" class="active-border">
                                            Profile
                                        </a>
                                    </div>';
                            }

                            if (!empty($article->article_keywords) && !empty($article->content)) {
                                echo '<div id="expertiseBtn" data-expertise="expertise">
                                        <a id="expertiseSticky">Expertise</a><!--  href="#expertise" -->
                                    </div>';
                            }

                            if (!empty($article->education)) {
                                echo '<div id="educationBtn" data-education="education">
                                        <a id="educationSticky"> Education </a>
                                        <!--href="#education"-->
                                    </div>';
                            }

                            if (!empty($article->experience)) {
                                echo '<div id="experienceBtn" data-experience="experience">
                                        <a id="experienceSticky">Experience</a><!-- href="#experience"-->
                                    </div>';
                            }

                            if (!empty($publications_expert)) {
                                echo '<div id="publicationsBtn" data-publications="publications">
                                        <a id="publicationsSticky">Publications</a>
                                        <!--href="#publications"-->
                                    </div>';
                            }

                            if (!empty($article->publications)) {
                                echo '<div id="otherPublicationsBtn" data-publications="otherpublications">
                                        <a id="otherPublicationsSticky">Select Publications</a>
                                        <!--href="#other-publications"-->
                                    </div>';
                                
                            }
                            
                            if (!empty($article->others)) {
                                echo '<div id="othersBtn" data-others="others">
                                        <a id="othersSticky">Others</a> <!-- href="#others"-->
                                    </div>';
                            }

                            if (!empty($article->presentations)) { 
                                echo '<div id="presentationsBtn" data-presentations="presentations">
                                        <a id="presentationsSticky">Presentations</a> <!-- href="#presentations"-->
                                    </div>';
                            }
                            
                        ?>

                    </div>
                    <style>
                    .latest-news-card:last-child hr {
                        display: none;
                    }
                    </style>
                    <?php if (!empty($events_card)) { ?>
                    <div class="latest-news-card bg-light-blue px-3 py-4">
                        <h4 class="font-merriweather text-bold text-blue mb-4">Upcoming Events</h4>
                        <?php foreach ($events_card as $value) { ?>
                        <div class="latest-news-card">
                            <p class="mb-1"><small>Events</small></p>
                            <a href="<?php echo base_url() . 'events/' . $value->uri; ?>"
                                class="font-merriweather font-weight-normal text-blue">
                                <?php echo $value->title; ?>
                            </a>
                            <p><small><?php echo date('j F Y', strtotime($value->posted_date)) ?></small></p>
                            <hr>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>

            </div>
            <div id="contentRight" class="col-md-8 col-12 author-detail">
                <div class="d-md-flex align-items-center section-content mb-4">
                    <div class="col-md-4">
                        <!--this is class before => author-image mr-4 -->
                        <img src="<?php echo base_url() ?><?php echo $article->image_name ?>" style="width: 100%;">
                    </div>
                    <div class="col-md-8 author-content">
                        <h5 class="second-title text-blue mb-0"> <?php echo $article->title ?> </h5>
                        <p class="text-bold"><?php echo $article->major ?></p>
                        <?php if (!empty($article->majorEmail)) { ?>
                        <a href="mailto:<?php echo $article->majorEmail; ?>">
                            <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                        </a>
                        <?php } else { ?>
                        <!-- <a href="mailto:contactus@eria.org">
                            <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                        </a> -->
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($article->article_keywords) and !empty($article->content)) { ?>
                <div id="overview" class="author-profile section-content">
                    <div class="experts-page-title pb-3 mt-3 w-100">Profile</div>
                    <div class="description mt-3">
                        <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->article_keywords)); ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (!empty($article->content)) { ?>
                <!-- <hr class="mb-4"> -->
                <div id="expertise" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 w-100">Expertise</div>
                    <style>
                    .content-expertise>p {
                        width: 100%;
                    }
                    </style>
                    <div class="content-expetise my-3">
                        <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->content)); ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (!empty($article->education)) { ?>
                <div id="education" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">Education</div>
                    <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->education)); ?>
                </div>
                <?php } ?>
                <?php if (!empty($article->experience)) { ?>
                <div id="experience" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">Experience</div>
                    <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->experience)); ?>
                </div>
                <?php } ?>
                <?php if (!empty($publications_expert)) { ?>
                <div id="publications" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">ERIA Publications</div>
                    <div class="container">
                        <input type="hidden" id="title_expert" value="<?php echo $article->title; ?>">
                        <div class="row" id="experts-publications"></div>
                        <div class="row justify-content-center mb-4">
                            <button id="loadmore" class="btn third-button mx-auto">Load more</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if (!empty($final)) { ?>
                <div id="other-publications" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">Select Publications</div>
                    <?php
                    
                    $encodings = ["EUC-JP"];
                    $textJapan = mb_convert_encoding(
                        $final,
                        "UTF-8",
                        $encodings
                    );

                    if ($article->uri == 'yanfei-li') {
                        $convert1 = str_replace('<li>????<strong>???</strong>???????????????????[J], ?????????, 21, 14-24.</li>', '<li>谭建生，李谚斐，碳中和背景下中蒙日韩绿氢战略合作构想[J], 电力决策与舆情参考, 21, 14-24.</li>', $textJapan);
                        $convert2 = str_replace('<li>????<strong>????</strong>???????????????????????[J], ?????2021, 321(4), 1-16.</li>', '<li>谭建生，李谚斐，碳中和及内蒙治沙背景下中蒙日韩绿氢战略合作构想[J], 综研快参，2021, 321(4), 1-16.</li>', $convert1);
                        echo $convert2;
                        
                    } elseif ($article->uri == 'yoshie-hirose') {
                        $convert1 = str_replace('?ゃ???丞???綺???桁??ュ嵯膊∞??倶我?腴?,', 'ドイツの疾病金庫による職域健康管理の状況と予防法の成立,', $textJapan);
                        $convert2 = str_replace('医??腱肢罘?遵七??罍??羇紫???膕丞腱??≪拷 ', '地域移行機能強化病棟を活用した精神科病院の構造改革 ', $convert1);
                        echo $convert2;
                    } else {
                        $convert1 = str_replace('?ゃ???丞???綺???桁??ュ嵯膊∞??倶我?腴?', 'ドイツの疾病金庫による職域健康管理の状況と予防法の成立', $textJapan);
                        $convert2 = str_replace('医??腱肢罘?遵七??罍??羇紫???膕丞腱??≪拷', '地域移行機能強化病棟を活用した精神科病院の構造改革,', $convert1);

                        echo RemoveBS(str_replace(array("?"), "'", $convert2));
                    }
                    ?>
                </div>
                <?php } ?>
                <?php if (!empty($article->others)) { ?>
                <div id="others" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">Others</div>
                    <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->others)); ?>
                </div>
                <?php } ?>
                <?php if (!empty($article->presentations)) { ?>
                <div id="presentations" class="row mt-4 ml-1 mr-1 section-content">
                    <div class="experts-page-title pb-3 mb-3 w-100">Presentations</div>
                    <?php echo html_entity_decode(str_replace(array('ã€€', 'ã€'), "", $article->presentations)) ?>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="<?php echo base_url() ?>resources/js/vanillajs-scrollspy.min.js"></script> -->

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/experts/experts-detail.js"></script>

<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>