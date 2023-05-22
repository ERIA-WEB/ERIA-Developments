<?php

$ptype = $ptype;


$topics = $topics;


function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '[...]';
    }
    return $text;
}



?>



<style>
/* ==== */

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
    }


}

@media (min-width:1024px) {
    .publications-image {
        width: 250px;
        height: auto;
    }
}

/* ==== */


.category a {
    color: #69AAB4 !important;
}





.search-result-btn {
    width: 100% !important;
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
</style>
<style>
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

@media only screen and (max-width: 668px) {

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

.new_publication {


    position: absolute;
    z-index: 9999;




    height: 310px;

    overflow: auto;

    width: 100%;



}

.new_publication_inside {

    border: solid 1px #ced4da;

}

.check-btns {

    padding: 10px;
}

.publication-collapsible:after {
    margin-top: -11px;
}
</style>

<style>
.publication-collapsible:after {
    margin-top: -13px;
    margin-right: 5px;
    font-size: 20px;
    font-weight: bold;
}

.publicationactive:after {
    margin-top: -3px !important;
    margin-right: 5px !important;
    font-size: 15px;
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
    <!-- Highlights -->
    <div class="highlights py-5 mb-3 mb-lg-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h2 class="main-title text-white text-left">ASEAN Insight</h2>
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
                                $pu[] = $x;  ?>
                            <div class="swiper-slide d-md-flex align-items-center">
                                <div class="higlight-swiper-slider-image mb-3 mb-md-0">
                                    <img src="<?php echo base_url() ?><?= $news['image_name'] ?>"
                                        alt="<?= str_replace("â€™", "'", $news['title']) ?>" class="w-100">
                                </div>
                                <div class="highlight-swiper-slider-content text-white pl-md-5">
                                    <h3 class="second-title text-white">
                                        <?= ucfirst(str_replace("â€™", "'", $news['title'])) ?>
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
    <!-- End of Highlights -->

    <!-- content -->
    <div id="n_req" class="container py-md-4 py-1 my-4">
        <div class="row">

            <!-- content left section -->
            <div class="col-md-8 col-12">
                <form id="form_id" method="post">
                    <div class=" mb-5 ">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="rounded my-md-0 my-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="button-addon2" type="submit"
                                                class="btn btn-link text-secondary border border-right-0">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <input type="search" id="key" name="key" placeholder="Keywords"
                                            aria-describedby="button-addon2" class="form-control border-left-0">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6  ">
                                <div class="rounded my-md-0 my-2">
                                    <div class="dropdown">

                                        <input type="hidden" id="cato" value="all">
                                        <button type="button"
                                            class="publication-collapsible  profile-overView1 search-result-btn ">
                                            Topic
                                        </button>
                                        <div class="new_publication publicationcontent">
                                            <div class="new_publication_inside">
                                                <div class="check-btns">
                                                    <?php
                                                        foreach ($topics as $ptypes) {
                                                        ?>
                                                    <label class="container-check"> <?= $ptypes->category_name ?>
                                                        <input type="checkbox" name="research[]" id=""
                                                            value="<?= $ptypes->category_id ?>">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="rounded my-md-0 my-2">
                                    <div class="dropdown">
                                        <input id="topic" type="hidden" value="all">

                                        <button type="button"
                                            class="publication-collapsible  profile-overView1 search-result-btn ">
                                            Publication Type
                                        </button>
                                        <div class="new_publication publicationcontent">

                                            <div class="new_publication_inside">
                                                <div class="check-btns">
                                                    <?php
                                                        foreach ($ptype as $pub) {

                                                        ?>
                                                    <label class="container-check"> <?= $pub->category_name ?>


                                                        <input type="checkbox" name="research_type[]"
                                                            value="<?= $pub->category_id ?>">




                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <?php

                                                        }

                                                        ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  ">
                            <div class="col-md-6  ">
                                <div class="rounded my-md-0 my-2">
                                    <div class="dropdown">
                                        <input id="topic" type="hidden" value="all">

                                        <button type="button"
                                            class="publication-collapsible  profile-overView1 search-result-btn ">
                                            Content Type
                                        </button>

                                        <div class="new_publication publicationcontent">

                                            <div class="new_publication_inside">
                                                <div class="check-btns">

                                                    <label class="container-check"> All
                                                        <input type="checkbox" name="c_type[]" id="" value="all">
                                                        <span class="checkmark"></span>
                                                    </label>

                                                    <label class="container-check"> Articles
                                                        <input type="checkbox" name="c_type[]" id="" value="articles">
                                                        <span class="checkmark"></span>
                                                    </label>


                                                    <label class="container-check"> Publications
                                                        <input type="checkbox" name="c_type[]" id=""
                                                            value="publications"> <span class="checkmark"></span>
                                                    </label>

                                                    <label class="container-check"> Research
                                                        <input type="checkbox" name="c_type[]" id="" value="research">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-xs-12 mb-md-0 ">
                                <div class="rounded my-md-0 my-2">
                                    <button class="btn third-button w-100" id="_msearch" type="button">
                                        Search
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>




                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <h4 class="main-title text-blue">Latest
                                    Articles</h4>
                                <a href="<?= base_url() ?>publications" class="font-weight-bold">See All
                                    Articles</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- card section -->
                <div id="searchResult" class="row page-content pb-3">
                </div>
                <div class="loadButton text-center">
                    <button id="ldmr" class="btn third-button">View more[...] </button>
                </div>
            </div>

            <!-- Content section right -->
            <div class="content-section-right latest-news col-md-4 col-xs-12 pl-md-4 m-0">
                <?php

                    foreach ($card as $c) {

                        $this->load->view('front-end/common/card_' . $c->card);
                    }


                    ?>



            </div>
        </div>
    </div>






    <div class="container-fluid" style="background-color: #F3F8FC !important;">
        <!-- Related Publications -->
        <div class="container related-article my-4">
            <div class="container page-content py-5">
                <h3 class="main-title text-blue mb-3"> Featured Publications </h3>
                <div class="row" id="latest-2 nd">
                    <?php $x = 0;
                    foreach ($new as $new) {
                        $x++;
                        if (file_exists(FCPATH . $new['image_name'])) {
                            $img = base_url() . $new['image_name'];
                        } else if ($new['image_name']) {
                            $img = "https://www.eria.org/" . $new['image_name'];
                        } else {
                            $img = base_url() . 'upload/Article.jpg';
                        }
                    ?>

                    <div style=" <?php if ($x == 1) { ?> border-right:solid #c7c7c7 1px; <?php } ?> "
                        class="col-md-6 col-12 mb-4">
                        <div class="row pb-4 mx-1">
                            <div class="col-md-5 col-xs-12 mr- md-2 m-0 p-0">
                                <img class="responsive pub-img" src="<?= $img ?>">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <div class="category"> <?php if ($new['article_type'] == 'publications') {
                                                                echo "Publication" . $new['tags'];
                                                            } else {
                                                                echo ucfirst($new['article_type']) . $new['tags'];
                                                            } ?> </div>
                                <div class="card-title text-blue"> <a
                                        href="<?= base_url() ?>Publications/Detail/<?= $new['uri'] ?>">
                                        <?php
                                            $w = limit_text($new['title'], 6);
                                            echo $w; ?>

                                    </a> </div>
                                <div>
                                    <span class="date"> <?= $new['posted_date'] ?> </span>
                                </div>
                                <?php

                                    $nc =  count($new['editornew']) + count($new['authornew']);

                                    if ($nc != 0) {
                                    ?>


                                <div>
                                    <span class="author"> Writer(s)/Editor(s): </span>
                                </div>

                                <div class="pb-au-sec" style="display:block;">

                                    <span class="author"> <?php $nresult = '';
                                                                    foreach ($new['editornew'] as $ed) {

                                                                        $nresult .= "<a style=' '  href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                                                                    }
                                                                    echo rtrim($nresult, ', ');  ?> </span>



                                    <span class="author"> <?php $_result = '';
                                                                    foreach ($new['authornew'] as $ed) {


                                                                        $_result .= "<a style=' '  href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>, ";
                                                                    }
                                                                    echo rtrim($_result, ', ');  ?> </span>
                                </div>

                                <?php } else {

                                    ?>

                                <div>
                                    <span class="author">Writer(s)/Editor(s):</span>
                                </div>

                                <div class="pb-au-sec" style="display:block;">

                                    <span class="author"> <?= $new['author'] ?> </span>
                                    <span class="author"> <?= $new['editor'] ?> </span>
                                </div>


                                <?php



                                    } ?>





                                <div class="description">

                                    <?php

                                        $ng = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $new['content']);
                                        $nsg = strip_tags($ng);
                                        echo limit_text($nsg, 15);


                                        ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="loadButton" style="  text-align: center; display: none">
                    <button style=" background-color: #003680;
    color: #f2f4f7; " id="ldmr" class="btn btn-highlight1">View more[...] </button>


                </div>

            </div>
        </div>
    </div>

    <!-- collapsible area 1 -->
    <div class="container">
        <button class="publication-collapsible pub-tc Browser-type-pb mb-2">Browse by Type </button>
        <div class="publicationcontent">
            <div class="row table table-borderless ">
                <?php foreach ($ptype as $ptype) {
                ?>
                <div class="col-md-4 col-xs-12    pt-4">
                    <div class=" pl-2  pub-th publication-tb-tittle">
                        <a
                            href="<?= base_url() ?>Publications/Brows/<?= $ptype->uri ?>"><?= $ptype->category_name ?></a>
                    </div>
                    <div class=" pl-2  pub-td pt-3">
                        <?php
                            $ns = substr(Strip_tags($ptype->meta_description), 0, 80);

                            $str = substr($ns, 0, strrpos($ns, ' '));

                            if (strlen($ptype->meta_description) > 80) {
                                echo $str . "[...]";
                            } else {
                                echo $str;
                            }

                            ?>
                    </div>
                </div>
                <?php
                } ?>
            </div>

        </div>
        <!-- collapsible area 2 -->
        <button class="publication-collapsible pub-tc Browser-type-pb mb-2">Browse by Topic</button>
        <div class="publicationcontent">
            <div class="row table table-borderless ">
                <?php foreach ($topics as $ptype) {
                ?>
                <div class="col-md-4 col-xs-12    pt-4">
                    <div class=" pl-2  pub-th publication-tb-tittle ">
                        <a href="<?= base_url() ?>Research/catogery/<?= $ptype->uri ?>"><?= $ptype->category_name ?></a>
                    </div>
                    <div class=" pl-2  pub-td pt-3">
                        <?php
                            $ns = substr(Strip_tags($ptype->meta_description), 0, 80);

                            $str = substr($ns, 0, strrpos($ns, ' '));

                            if (strlen($ptype->meta_description) > 80) {
                                echo $str . "[...]";
                            } else {
                                echo $str;
                            }
                            ?>
                    </div>
                </div>
                <?php
                } ?>
            </div>
        </div>

        <!-- collapsible area 3 -->
        <button class="publication-collapsible pub-tc mb-4 Browser-type-pb">Browse by Location</button>
        <div class="publicationcontent">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="pub-th publication-tb-tittle" scope="col"> <a
                                href="<?= base_url() ?>Asean/country/Brunei Darussalam"> Brunei Darussalam </a></th>
                        <th class="pub-th publication-tb-tittle" scope="col "><a
                                href="<?= base_url() ?>Asean/country/Cambodia"> Cambodia </a> </th>
                        <th class="pub-th publication-tb-tittle" scope="col "> <a
                                href="<?= base_url() ?>Asean/country/all/Indonesia"> Indonesia </a> </th>
                        <th class="pub-th publication-tb-tittle" scope="col "><a
                                href="<?= base_url() ?>Asean/country/Malaysia"> Malaysia </a> </th>
                        <th class="pub-th publication-tb-tittle" scope="col "> <a
                                href="<?= base_url() ?>Asean/country/Lao PDR"> Lao PDR </a> </th>

                    </tr>
                </thead>

            </table>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="pub-th publication-tb-tittle" scope="col"> <a
                                href="<?= base_url() ?>Asean/country/Myanmar"> Myanmar </a> </th>
                        <th class="pub-th publication-tb-tittle" scope="col "> <a
                                href="<?= base_url() ?>Asean/country/Phillippines"> Phillippines </a></th>
                        <th class="pub-th publication-tb-tittle" scope="col "> <a
                                href="<?= base_url() ?>Asean/country/Singapore"> Singapore </a></th>
                        <th class="pub-th publication-tb-tittle" scope="col "> <a
                                href="<?= base_url() ?>Asean/country/Vietnam"> Viet Nam </a> </th>
                        <th class="pub-th publication-tb-tittle" scope="col "> </th>


                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
$("#mmore").click(function() {



    $('.hidem').show();


});


$("#wmore").click(function() {



    $('.hidew').show();


});
</script>



<script type="text/javascript">
$('.publication-collapsible').click(function() {


})
$(document).ready(function() {


    var start = 0;
    var limit = 6;


    getPost__comment_searchData();


    var reachedMax = false;

    //   getPost_searchData();





    $('#_msearch').click(function() {


        $('.new_publication').hide();


        // start = 0;
        // limit = 5;


        $('#searchResult').html('');

        //  getPost_searchData();

        $("#latest-2nd").html('');
        start = 0;
        limit = 4;
        // getPost_searchData();

        getPost__comment_searchData();

    })

    $('#ldmr').click(function() {
        getPost__comment_searchData();
    })


    $(document).on('click', '.n_related', function() {

        start = 0;
        limit = 6;
        var key = $(this).data("key");
        $('#key').val(key);

        $('#searchResult').html('');



        $('html, body').animate({
            scrollTop: $("#n_req").offset().top
        }, 1000);


        getPost__comment_searchData();

    })

    function getPost_searchData() {


        $('.search_title').html("Search Result");

        var publication = $('#topic').val();


        var url = '<?= base_url() ?>Publications/loadm_Search';

        var key = $('#key').val();

        var cato = $('#cato').val();




        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start,
                limit: limit,
                publication: publication,
                key: key,
                cato: cato
            },
            success: function(response) {



                if (response == "") {


                    $(".loader-image").hide();
                    $("#ldmr").html("That's All");
                } else {

                    $('.loadButton').show();

                    $("#ldmr").html("Load More");
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $("#latest-2nd").append(response);
                }
            }
        });
    }





    function getPost__comment_searchData() {




        var region = $('.region').val();
        var url = '<?= base_url() ?>Asean/loadmSearch';

        var key = $('#key').val();





        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: $("#form_id").serialize() + "&start=" + start + "&limit=" + limit,
            success: function(response) {




                if (response == "") {


                    $(".loader-image").hide();
                    $("#ldmr").html("That's All");
                } else {
                    $("#ldmr").html("Load More");
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $("#searchResult").append(response);
                }
            }
        });
    }




});






$('.cnty').click(function() {

    var to = $(this).data("cnt");
    $('#dropdownMenuButton').html(to);
    $('.region').val(to);
})
</script>

<script>
$('.type').click(function() {


    var to = $(this).data("typed");
    var tm = $(this).data("tmd");



    $('.btty').html(tm);
    $('#topic').val(to);
})




$('.cnty').click(function() {



    var to = $(this).data("cnt");




    $('.reg').html(to);
    $('#cb').val(to);
})



$('.ncls').click(function() {



    var to = $(this).data("type");

    var nme = $(this).data("nme");

    // alert (to);


    $('.catos').html(nme);
    $('#cato').val(to);
})
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