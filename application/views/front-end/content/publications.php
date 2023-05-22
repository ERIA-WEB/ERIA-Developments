<?php

$ptype = $ptype;


$topics = $topics;

function limit_text($text, $limit, $link = null)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >[...]</a>';
    }
    return $text;
}

?>
<style>
#button-addon2:hover {
    color: #6c757d !important;
}

.ntext a {
    color: white !important;
}

.category a {
    color: #69AAB4 !important;
}

.pdots {
    cursor: pointer;
    height: 10px;
    width: 10px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
}

.actives,
.pdots:hover {
    background-color: #717171;
}


.nborder {

    border-right: solid #c7c7c7 1px;
}


.btn.btn-highlight.py-2.px-4.publication-btn {

    width: 143px !important;
    height: 39px !important;
}

.btnBrowse:hover {
    background-color: #e4f4f9 !important;
    color: #003680;
    font-size: 16px !important;
}

.publication-collapsible:hover {
    color: #003680;
}

.publications-content-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    text-align: center;
    gap: 10px;
    font-weight: 600;
}

.publications-content-grid-item {
    border: 1px transparent;
    padding: 20px 0px;
}


@media (min-width: 1200px) {
    .col-md-6.col-12 {

        padding-top: 25px !important;
    }

    .col-md-12.col-12.page-content {
        margin-bottom: 36px !important;
    }

    h3.py-2.pb-related-artile.search_title {
        margin-top: 20px !important;
    }
}

@media only screen and (max-width: 668px) {
    .publications-content-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        font-weight: 600;
    }

    .col-md-6.col-12 {
        border-bottom: none !important;
        border-right: none !important;
    }

    .publication-tittle.mb-4.mt-4 {

        width: 333px !important;
        position: relative !important;
        left: 5px !important;

    }

    #dropdownMenuButton.btn.bg-white.border.w-100.catos {

        margin-bottom: 10px !important;
        margin-top: -19px !important;
    }

    /*shold create collapsable-area class */
    .container.collapsable-area {
        padding-bottom: 20px !important;
        padding-top: 20px !important;
    }
}

@media only screen and (min-device-width: 869px) and (max-device-width: 1190px) {}


@media only screen and (device-width: 768px) {

    .highlights .carousel-control-prev {
        left: -65px !important;
    }

    .highlights .carousel-control-next {
        right: -90px !important;
    }

}

@media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) {

    .highlights .carousel-control-prev {
        left: -65px !important;
    }

    .highlights .carousel-control-next {
        right: -90px !important;
    }

}

@media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {

    .highlights .carousel-control-prev {
        left: -65px !important;
    }

    .highlights .carousel-control-next {
        right: -90px !important;
    }


}
</style>

<style>
@media (max-width: 767.98px) {
    .sticky_cha {
        top: 0px !important;
    }

    .pt-2.mobile-search {
        display: block !important;
    }

    .navbar-light .navbar-toggler {
        border-color: rgba(0, 0, 0, 0) !important;
    }

    .mobile-nav-bar {
        display: flex !important;
    }
}

@media (max-width: 575.98px) {
    .p-1.rounded {
        padding-right: .25rem !important;
        padding-left: .25rem !important;
        padding-bottom: 0 !important;
    }

    .ch-mob {
        margin-bottom: 0 !important;
    }

    .publications-page .highlights {
        height: 100% !important;
        padding-right: 16px !important;
    }

    #highlightsCarousel .highlight-image {
        float: unset !important;
    }

    #highlightsCarousel .carousel-inner {
        height: 580px !important;
    }

    #highlightsCarousel .highligh-heading {
        padding-bottom: 100px;
        font-size: 18px !important;
    }

    .related-article {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    #latest-1st .row .col-md-6 {
        padding-top: 8px;
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    #latest-2nd .row .col-md-6 {
        padding-top: 8px;
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
}

@media (min-width: 481px) and (max-width: 767.98px) {
    .new_pub {
        margin-top: 0 !important;
        text-align: left;
    }

    #highlightsCarousel .carousel-inner,
    .highlights-pub {
        height: 100% !important;
        text-align: center !important;
    }

    #highlightsCarousel .dot {
        text-align: center !important;
        margin-bottom: 100px !important;
        margin-top: -100px !important;
    }

    .highlights h2 {
        text-align: center !important;
    }

    #highlightsCarousel .highligh-heading {
        padding-bottom: 10px;
        font-size: 18px !important;
    }

    .related-article {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    #latest-1st .row .col-md-6 {
        padding-top: 8px;
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    #latest-2nd .row .col-md-6 {
        padding-top: 8px;
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    .publications-page .highlights {
        height: 100% !important;
        padding-right: 16px !important;
    }

    .latest-1st-col {
        border-bottom: none !important;
        border-right: none !important;
    }

    #latest-2nd div {
        border-bottom: none !important;
        border-right: none !important;
    }

    #dropdownMenuButton.btn.bg-white.border.w-100.catos {
        margin-bottom: 10px !important;
        margin-top: -19px !important;
    }

    .related-article .pub-img {
        width: 100% !important;
        /*85%*/
    }

    .publication-collapsible {
        margin-bottom: .5rem !important;
    }

    .p-1.rounded {
        padding-right: .25rem !important;
        padding-left: .25rem !important;
        padding-bottom: 0 !important;
        margin-bottom: .5rem !important;
    }
}

@media (min-width: 769px) and (max-width: 991.98px) {
    .new_pub {
        margin-top: 0 !important;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .highlight-image img {
        margin-top: -50px !important;
    }

    .publications-page .highlights {
        padding-right: 16px !important;
    }

    .page-content .heading {
        font-size: 16px !important;
    }

    #latest-1st .row .col-md-6 {
        padding-left: 8px !important;
        padding-right: 0 !important;
    }

    #latest-2nd .row .col-md-6 {
        padding-left: 8px !important;
        padding-right: 0 !important;
    }

    .related-article {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .related-article .page-content .latest-1st-col,
    #latest-2nd {
        padding-top: 16px !important;
    }

    .p-1.rounded {
        padding: 0 !important;
        padding-right: .25rem !important;
        padding-left: .25rem !important;
        margin-bottom: 1rem !important;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    .new_pub {
        margin-top: 0 !important;
    }

    .publications-page .highlights {
        padding-right: 16px !important;
    }

    #latest-1st .row .col-md-6 {
        padding-right: 0 !important;
        padding-left: 8px !important;
    }

    #latest-2nd .row .col-md-6 {
        padding-right: 0 !important;
        padding-left: 8px !important;
    }

    .related-article {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .related-article .page-content .latest-1st-col,
    #latest-2nd {
        padding-top: 16px !important;
    }

    .p-1.rounded {
        padding: 0 !important;
        padding-right: .25rem !important;
        padding-left: .25rem !important;
        margin-bottom: 1rem !important;
    }
}

@media (min-width: 1200px) {
    .publications-page .highlights {
        padding-right: 16px !important;
    }

    .p-1.rounded {
        padding: 0 !important;
        padding-right: .25rem !important;
        padding-left: .25rem !important;
        margin-bottom: 1rem !important;
    }
}


@media (min-width: 992px) and (max-width: 1199.98px) {

    #highlightsCarousel .new_pub {
        margin-top: 15px !important;
    }
}


@media (min-width: 768px) and (max-width: 991.98px) {
    #highlightsCarousel .carousel-item img {
        margin-top: -40px !important;
    }
}

.publication-collapsible:after {
    margin-top: -13px;
    margin-right: 5px;
}

.publicationactive:after {
    margin-top: -3px !important;
    margin-right: 5px !important;
}

.browserby {
    padding-top: 1.5rem;
    padding-bottom: 3rem;
}

.page-content .btn {
    position: relative;
}



.new_publication {


    position: absolute;
    z-index: 9999;




    height: 310px;

    overflow: auto;
    width: 100%;



}

.new_publication_inside {
    border: solid 1px #ced4da;
    border-radius: 0;

}

.check-btns {

    padding: 10px;
}

.publication-collapsible {
    width: 100% !important;
}

/* .input-group>.form-control:not(:first-child) {
        border-radius: 0 !important;
        height: 40px !important;
        font-size: 14px;
    } */

.publication-collapsible:after {
    margin-top: -14px !important;
    margin-right: 8px !important;
}

.publicationactive:after {
    margin-top: -2px !important;
    margin-right: 8px !important;
}

img.responsive {
    object-fit: contain !important;
}

.publications-image {
    flex: none;
    width: 100%;
    height: auto;
    overflow: hidden;
    border: 1px solid #000;
}

.publications-image img {
    width: 100%;
    object-fit: cover;
}

.new_publication {
    z-index: 99 !important;
}

.highlight-swiper {
    width: 100%;
    height: 100%;
}

.swiper-button-prev,
.swiper-button-next {
    height: 45px;
    width: 45px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    visibility: hidden;
    transition: all 0.3ms ease;
    color: #003680;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    content: "";
}

.higlight-swiper-slider-image {
    /* height: 350px; */
    overflow: hidden;
}

.higlight-swiper-slider-image img {
    object-fit: cover;
}

.highlight-swiper-slider-content {
    width: 100%;
}

.highlight-slide-swiper:hover .swiper-button-prev,
.highlight-slide-swiper:hover .swiper-button-next {
    visibility: visible;
}

@media (min-width:768px) {
    .higlight-swiper-slider-image img {
        /* width: 450px; */
        height: 400px;
    }

    .highlight-swiper-slider-content {
        width: 75%;
        padding-left: 30px;
    }

    .publications-image {
        height: 445px;
        border: 1px solid #000;
    }


}

@media (min-width:1024px) {
    .publications-image {
        width: 250px;
        height: auto;
        border: 1px solid #000;
    }
}



.publication-collapsible:after {

    background-image: url('resources/images/SocialMedia/down.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}

.publicationactive:after {

    background-image: url('resources/images/SocialMedia/up.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}
</style>

<div class="publications-page section-top">
    <!-- highlights -->
    <div class="highlights py-5 mb-3 mb-lg-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h2 class="main-title text-white text-left">Highlighted Publications</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 highlight-slide-swiper">
                    <div class="swiper highlight-swiper mb-4">
                        <div class="swiper-wrapper">
                            <?php $x = 0;
                            $pu = array();
                            foreach ($news as $news) {
                                $x++;
                                $result = '';
                                $nresult = '';
                                $pu[] = $x;

                                if (file_exists(FCPATH . $news['image_name'])) {
                                    $img = base_url() . $news['image_name'];
                                } else {
                                    $img = "https://www.eria.org" . $news['image_name'];
                                }
                            ?>

                            <div class="swiper-slide d-md-flex align-items-center">
                                <div class="higlight-swiper-slider-image mb-3 mb-md-0">
                                    <img src="<?= $img ?>" alt="<?= str_replace("â€™", "'", $news['title']) ?>"
                                        class="w-100">
                                </div>
                                <div class="highlight-swiper-slider-content text-white pl-md-5">
                                    <h3 class="second-title text-white"> <?= str_replace("â€™", "'", $news['title']) ?>
                                    </h3>
                                    <div class="highlight-author font-merriweather pb-2 pt-1">
                                        <?php
                                            $getAuthorEditorHighLIght = $this->frontModel->getHighlightByArticleId($news['article_id']);

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
                                                    $people_title[] = $value['title'];
                                                    $people_uri[] = $value['uri'];
                                                }

                                                echo 'Author(s) / Editor(s): <a href="' . base_url() . 'experts/' . $people_uri . '">' . implode(', ', $people_title) . '</a>';
                                            } else {
                                                if (!empty($news['editor']) || !empty($news['author'])) {
                                                    $a1 = explode(', ', $news['editor']);
                                                    $a2 = explode(', ', $news['author']);

                                                    $mergingPeople = array_merge($a1, $a2);
                                                    for ($i=0; $i < count($mergingPeople); $i++) { 
                                                        if (!empty($mergingPeople[$i])){
                                                            $author[]= $mergingPeople[$i];
                                                        }
                                                    }
                                                    
                                                    foreach ($mergingPeople as $value) {
                                                        $this->db->select('*');
                                                        $this->db->where('published', 1);
                                                        $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'fellows']);
                                                        $this->db->where('title', $value);
                                                        $peopleresult = $this->db->get('articles')->row();

                                                        if (isset($peopleresult)) {
                                                            $peoples[] = '<a href="' . base_url() . 'experts/' . $peopleresult->uri . '" style="color:#fff;">' . $peopleresult->title . '</a>';
                                                        } else {
                                                            $peoples[] = $value;
                                                        }
                                                        
                                                    }

                                                    echo 'Author(s)/Editor(s): ' . implode(', ', $author);
                                                } else {
                                                    echo 'Author(s)/Editor(s): ';
                                                }
                                            }
                                            ?>

                                    </div>
                                    <small class="font-montserrat"><?= $news['posted_date'] ?></small>
                                    <p class="description mt-3 pr-lg-5">
                                        <?php
                                            $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $news['content']);
                                            $ns = strip_tags($n);
                                            echo limit_text($ns, 50, 'publications/' . $news['uri']);
                                            ?>
                                    </p>
                                    <a href="<?php echo base_url() . 'publications/' . $news['uri'] ?>"
                                        class="btn second-button mt-4">
                                        Read more
                                    </a>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper-pagination d-block d-md-none mb-4" id="highlight-pagination"
                        style="bottom:-40px"></div>
                    <div class="swiper-button-prev" id="highlight-button-prev" style="left:-8px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </div>
                    <div class="swiper-button-next" id="highlight-button-next" style="right:-8px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- date -->
    <div class="container py-3 py-lg-5">
        <h2 class="main-title text-blue ">
            Latest Publications
        </h2>
        <hr>
        <div class="container related-article pl-0 pr-0">
            <div class="container page-content py-3 pr-0 pl-0">
                <div class="row" id="latest-publications"></div>
                <!--latest-1st-->
                <div class="row justify-content-center">
                    <button id="ldmrLatestPublications" class="btn third-button mx-auto">View more </button>
                    <button id="ldmrNextSession" class="btn third-button d-none">Load more</button>
                    <input type="hidden" id="limitNextSession">
                    <input type="hidden" id="startNextSession">
                </div>
            </div>
        </div>
    </div>

    <div id="n_req" class="container">
        <?php $this->load->view('front-end/content/search-publications/searchPublications'); ?>
    </div>

    <!-- Results Publications -->
    <div class="container page-content">
        <div class="row" id="searchResult"></div>
        <div id="rowBtnLoadMore" class="row justify-content-center py-4 d-none">
            <button id="ldmrSearch" class="btn third-button mx-auto">Load more</button>
        </div>
    </div>
</div>

<!-- collapsible BROWSE Type & Category area 1 -->
<div class="browserby container pt-0">
    <?php $this->load->view('front-end/content/search-publications/browseType'); ?>
    <?php $this->load->view('front-end/content/search-publications/browseTopics'); ?>
    <?php $this->load->view('front-end/content/search-publications/browseLocations'); ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plus_pubSlides(n) {
    showSlides(slideIndex += n);
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    // var slides = document.getElementsByClassName("mySlides");
    // var dots = document.getElementsByClassName("dot");
    var pdots = document.getElementsByClassName("pdots");

    if (n > pdots.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = pdots.length
    }

    for (i = 0; i < pdots.length; i++) {
        pdots[i].className = pdots[i].className.replace(" actives", "");
    }

    pdots[slideIndex - 1].className += " actives";
    // slides[slideIndex-1].style.display = "block";
    // dots[slideIndex-1].className += " actives";
}
</script>
<script>
$(document).ready(function(e) {
    if (e.keyCode == 116 || e.keyCode == 82) {
        window.location.reload();
        sessionStorage.removeItem('param_publications');
    }

    var dropselvalue = sessionStorage.getItem("param_publications");
    var sessions_data = JSON.parse(dropselvalue);

    var start_ = 0;

    if (sessions_data != null) {
        var limit_ = sessions_data['limit'];
        var start_session = sessions_data['start'];

        limit_ += start_session;

        $('#ldmrLatestPublications').remove();
        $('#ldmrNextSession').removeClass('d-none');
        $('#limitNextSession').val(limit_);
        $('#startNextSession').val(start_session);
    } else {
        var limit_ = 4;
    }

    getPostLatestPublicationData(start_, limit_);
    sessionStorage.removeItem('param_publications');

    $('.profile-overView1').click(function() {
        $('.publicationcontent').show();

    });

    var start_ = parseInt($('#startNextSession').val());
    var limit_ = parseInt($('#limitNextSession').val());
    $('#ldmrNextSession').click(function() {
        start_ += limit_;
        // alert("start_next_session: " + start_ + ", limit_next_session: " +
        //     limit_);
        var arrSessions = '{"start":' + start_ + ', "limit":' + limit_ +
            '}';

        //here we save the item in the sessionStorage.
        sessionStorage.setItem("param_publications", arrSessions);
        getPostLatestPublicationData(start_, limit_);
    });

    var start_click = 4;
    var limit_click = 4;
    $('#ldmrLatestPublications').click(function() {
        $.ajax({
            url: '<?= base_url() ?>Publications/countLimitSession?start=' + start_click +
                "&limit=" +
                limit_click,
            method: 'GET',
            success: function(response) {
                // console.log("response : " + response);
                var data = JSON.parse(response);

                var startclick = data['startclick'];
                var limitclick = data['limitclick'];
                start_click += limit_click;
                var arrSessions = '{"start":' + startclick + ', "limit":' + limitclick +
                    '}';

                //here we save the item in the sessionStorage.
                sessionStorage.setItem("param_publications", arrSessions);
                getPostLatestPublicationData(startclick, limitclick);

            }
        });


    });

    function getPostLatestPublicationData(start_, limit_) {
        var publication = 'all'; // $('#topic').val()
        var url = '<?= base_url() ?>Publications/getDataLatestPublications';
        var key = ''; // $('#key').val()
        var cato = 'all'; // $('#cato').val()
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start_,
                limit: limit_,
                publication: publication,
                key: key,
                cato: cato
            },
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $("#ldmrLatestPublications").html("That's All");
                } else {
                    $('.loadButton').show();

                    $("#ldmrLatestPublications").html("Load more");
                    $('#normals').show();
                    $('#normal').hide();
                    // start_ += limit_;
                    $(".loader-image").show();
                    $("#latest-publications").append(response); // publications
                }
            }
        });
    }

});
</script>
<script>
$('.type').click(function() {
    var to = $(this).data("typed");
    var tm = $(this).data("tmd");
    $('.btty').html(tm);
    $('#topic').val(to);
});

$('.cnty').click(function() {
    var to = $(this).data("cnt");
    $('.reg').html(to);
    $('#cb').val(to);
});

$('.ncls').click(function() {
    var to = $(this).data("type");
    var nme = $(this).data("nme");
    $('.catos').html(nme);
    $('#cato').val(to);
});
</script>

<script>
if ($('.latest-1st-col').length > 4) {
    $('.latest-1st-col:gt(3)').hide();
    $('.show-more').show();
}

$('.show-more').on('click', function() {
    //toggle elements with class .ty-compact-list that their index is bigger than 2
    $('.latest-1st-col:gt(3)').toggle();
    //change text of show more element just for demonstration purposes to this demo
    $(this).html() === 'Load more' ? $(this).html('Load more') : $(this).html('Load more');
});
</script>
<script>
$(document).mouseup(function(e) {
    var container = $(".publication-collapsible");
    var co = $(".new_publication");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0 && !co.is(e.target) && co.has(e.target)
        .length === 0) {
        $('.new_publication').css("max-height", "");
        $(".publication-collapsible").removeClass("publicationactive");
    }
});
</script>
<script>
$("#tall").click(function() {
    $('.tall').not(this).prop('checked', this.checked);
});


$("#pall").click(function() {
    $('.pall').not(this).prop('checked', this.checked);
});
</script>
<script>
const highlightSwiper = new Swiper('.highlight-swiper', {
    slidesPerView: 1,
    loop: true,
    navigation: {
        nextEl: '#highlight-button-next',
        prevEl: '#highlight-button-prev',
    },
    pagination: {
        el: '#highlight-pagination',
    },
});
</script>