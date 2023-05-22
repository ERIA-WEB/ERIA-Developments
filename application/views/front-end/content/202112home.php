<?php

$sliders = $slider;

function limit_text($text, $limit, $link = null)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >(...)</a>';
    }
    return $text;
}

?>
<style>
    html,
    body {
        /*width: 100%;
        height: 100%;*/
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }


    .highlight-author {
        font-family: 'Literata' !important;
    }

    @media only screen and (device-width: 768px) {
        .fades {
            width: 300px !important;
        }

        .cover-right h3 {
            font-size: 19px;
            line-height: 30px;

        }

        .cover-right p {

            font-size: 12px;
        }

        .page-cover .carousel-controller {

            width: 20%;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .main-nav-headings .nav-item .nav-link {
            padding-left: 5px;
            padding-right: 5px;
            font-size: 9px;
        }



        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav .nav-item .nav-link {
            padding: 10px;
        }

        nav .fa {
            font-size: 16px;
        }

        .page-content .heading {
            font-size: 15px;
        }

        .page-content .date {
            font-size: 10px;
        }

        .page-content .description {
            font-size: 11px;
        }

        .author .carousel-inner .carousel-item>div {
            display: block
        }

        .person-description .description {
            padding-right: 0px !important;
        }

        /*.person-description { height: 190px !important; }*/
        .person-main {
            height: 250px;
        }

        .author .carousel-control-prev {
            left: -40px !important;
        }

        .new_pub {
            float: right;
            margin-top: -440px;
            text-align: left;
        }

        .highlight-image {
            width: 100% !important;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav {
            padding-top: 2px !important;
        }
    }




    @media only screen and (min-device-width: 1212px) and (max-device-width: 1212px) and (orientation:portrait) {


        .imn {
            width: 55% !important;
        }

    }

    @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) {


        .fades {
            width: 300px !important;
        }

        .cover-right h3 {
            font-size: 19px;
            line-height: 30px;

        }

        .cover-right p {

            font-size: 12px;
        }

        .page-cover .carousel-controller {

            width: 20%;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .main-nav-headings .nav-item .nav-link {
            padding-left: 5px;
            padding-right: 5px;
            font-size: 9px;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav .nav-item .nav-link {
            padding: 10px;
        }

        nav .fa {
            font-size: 16px;
        }

        .page-content .heading {
            font-size: 15px;
        }

        .page-content .date {
            font-size: 10px;
        }

        .page-content .description {
            font-size: 11px;
        }

        .author .carousel-inner .carousel-item>div {
            display: block
        }

        .person-description .description {
            padding-right: 0px !important;
        }

        /*.person-description { height: 190px !important; }*/
        .person-main {
            height: 250px;
        }

        .author .carousel-control-prev {
            left: -40px !important;
        }

        .new_pub {
            float: right;
            margin-top: -440px;
            text-align: left;
        }

        .highlight-image {
            width: 100% !important;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav {
            padding-top: 2px !important;
        }

        /*.p-0{ padding-left: 0px !important; }*/
        .topic-item a {

            font-family: 'Literata';
            font-size: 11px;
            padding-right: 10px;

        }

        .nav-link_new {
            padding-left: 8px !important;
        }

        .main-topic {
            font-size: 16px !important;
            font-family: 'Literata';
        }

        .highlights .carousel-control-prev {
            left: -75px !important;
        }

        .highlights .carousel-control-next {
            right: -75px !important;
        }

        .searchbar-input {
            width: 80% !important;
        }

    }

    @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {


        .fades {
            width: 300px !important;
        }

        .cover-right h3 {
            font-size: 19px;
            line-height: 30px;

        }

        .cover-right p {

            font-size: 12px;
        }

        .page-cover .carousel-controller {

            width: 20%;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .main-nav-headings .nav-item .nav-link {
            padding-left: 5px;
            padding-right: 5px;
            font-size: 9px;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav .nav-item .nav-link {
            padding: 10px;
        }

        nav .fa {
            font-size: 16px;
        }

        .page-content .heading {
            font-size: 15px;
        }

        .page-content .date {
            font-size: 10px;
        }

        .page-content .description {
            font-size: 11px;
        }

        .author .carousel-inner .carousel-item>div {
            display: block
        }

        .person-description .description {
            padding-right: 0px !important;
        }

        /*.person-description { height: 190px !important; }*/
        .person-main {
            height: 250px;
        }

        .author .carousel-control-prev {
            left: -40px !important;
        }

        .new_pub {
            float: right;
            margin-top: -440px;
            text-align: left;
        }

        .highlight-image {
            width: 100% !important;
        }

        .navbar.main-nav.navbar-light .navbar-collapse .small-sub-nav {
            padding-top: 2px !important;
        }

        .p-0 {
            padding-left: 0px !important;
        }

        .topic-item a {

            font-family: 'Literata';
            font-size: 11px;
            padding-right: 10px;

        }

        .nav-link_new {
            padding-left: 8px !important;
        }

        .main-topic {
            font-size: 16px !important;
            font-family: 'Literata';
        }

        .highlights .carousel-control-prev {
            left: -75px !important;
        }

        .highlights .carousel-control-next {
            right: -75px !important;
        }

        .searchbar-input {
            width: 80% !important;
        }
    }



    @media (max-width: 480px) {

        .p-0 {
            padding-left: 0px !important;
        }

        .footer-section {
            text-align: left
        }

        .mobile-footer {
            padding-right: 5px !important;
            padding-left: 5px !important;
            font-size: 12px;
        }

        .cover-responsive {
            height: 200px !important;
        }

        .fades h3 {
            font-size: 16px;
        }

        .cover-right-spacing {
            width: 100% !important;
        }

        .cover-right p {
            font-size: 12px;
            height: 70px;
            overflow-y: auto
        }

        .cover-right .explore-btn {
            padding: 2px;
            border: none;
        }

        .slider-dot {
            margin-top: -5px !important;
            margin-left: 0px !important;
        }

        .highlights-pub {
            height: 100% !important;
        }

        .carousel-inner-pub {
            height: 100% !important;
        }

        .highlights .carousel-control-prev {
            left: -48px !important;
        }

        .highlights .carousel-control-next {
            right: -48px !important;
        }

        .highlight-image {
            width: auto !important;
        }

        .highlights .img-fluid {
            padding-bottom: 25px !important;
        }

        .page-cover .carousel-controller {
            display: block
        }

        .dot {
            display: none !important;
        }

        .page-cover .carousel-controller {
            bottom: 0 !important;
            height: 60px;
            background-color: #ffffff;
            right: 0% !important;
            width: 30%;
            opacity: 0.7;

        }

        .topic-item a {

            font-family: 'Literata';
            font-size: 11px;
            padding-right: 10px;

        }

        .nav-link_new {
            padding-left: 8px !important;
        }

        .main-topic {
            font-size: 16px !important;
            font-family: 'Literata';
        }

        .highlights .carousel-control-prev {
            left: -75px !important;
        }

        .highlights .carousel-control-next {
            right: -75px !important;
        }

        .searchbar-input {
            width: 80% !important;
        }
    }

    .fades {
        -webkit-animation-name: fades;
        -webkit-animation-duration: 1.5s;
        animation-name: fades;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fades {
        from {
            opacity: .1
        }

        to {
            opacity: 1
        }
    }

    @keyframes fades {
        from {
            opacity: .1
        }

        to {
            opacity: 1
        }
    }


    .h1,
    h1 {
        font-size: 2rem !important;
    }

    .nav-link_new {

        margin-top: 6px !important;

    }



    .dot {
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
    .dot:hover {
        background-color: #717171;
    }

    .cover-right p {
        font-family: 'Literata', serif !important;
    }

    .multimedia {
        padding-bottom: 0 !important;
    }

    @media only screen and (min-width: 768px) and (max-width: 868px) {
        #carouselExampleControls .col-md-12.col-xs-12 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-left: 0 !important;
        }
    }

    @media (max-width: 575.98px) {
        #highlightsCarousel .dot {
            display: none !important;
        }

        .research-areas .research-items {
            flex-direction: column !important;
        }

        #highlightsCarousel .highlight-image {
            float: unset !important;
        }

        #AuthorCarousel .person-description {
            height: 120px !important;
        }

        #AuthorCarousel .carousel-inner .carousel-item .col-md-4 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .content-section-right .subscribe .section-divider .col-md-12 {
            padding-bottom: 10px !important;
        }

        #AuthorCarousel .person-description .description {
            font-size: 12px !important;
            padding-right: 0px !important;
        }

        #AuthorCarousel .person-main {
            height: 260px;
        }

        #highlightsCarousel .carousel-control-next {
            right: -40px !important;
        }

        #highlightsCarousel .carousel-control-prev {
            left: -40px !important;
        }

        .multimedia iframe {
            height: 150px !important;
        }

        .multimedia .pt-4 .col-md-8 {
            padding-left: 0 !important;
            padding-bottom: 15px !important;
        }

        .multimedia .pt-4 .col-md-4 {
            padding-left: 0 !important;
        }

    }

    @media (min-width: 481px) and (max-width: 767.98px) {
        .research-areas .research-items {
            flex-direction: column !important;
        }

        #highlightsCarousel .dot {
            display: none !important;
        }

        #carouselExampleControls .slider-dot {
            display: none;
        }

        .container-fluid .col-md-4 #carouselExampleControls .cover-responsive {
            height: 100% !important;
            text-align: center !important;
        }

        .container-fluid #carouselExampleControls {
            height: 100% !important;
            background-color: #003680;
        }

        .page-cover .carousel-controller {
            bottom: 0 !important;
            height: 60px;
            background-color: #ffffff;
            right: 0% !important;
            width: 30%;
            opacity: 0.7;
        }

        .fades {
            width: 100% !important;
        }

        .cover-right-spacing {
            padding-right: 0 !important;
            padding: 1.5rem !important;
        }

        .new_pub {
            margin-top: 0 !important;
            text-align: center;
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


    }

    @media (min-width: 640px) and (max-width: 767.98px) {
        .featured-topic-areas .navbar-nav {
            flex-direction: row !important;
            margin-right: -35px !important;
            margin-left: -35px !important;
        }

        .topic-item a {
            font-size: 8px !important;
        }
    }


    @media (min-width: 576px) and (max-width: 767.98px) {
        .research-areas .row {
            flex-direction: column !important;
        }

        .page-content .mobile-padding-0 {
            margin-top: 10px;
            padding: 0px;
        }

        .featured-topic-areas .navbar-nav {
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        #AuthorCarousel .person-description {
            height: 120px !important;
        }

        #AuthorCarousel .carousel-inner .carousel-item .col-md-4 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        #AuthorCarousel .person-description .description {
            font-size: 12px !important;
            padding-right: 0px !important;
        }

        #AuthorCarousel .person-main {
            height: 290px;
        }

        #highlightsCarousel .carousel-control-next {
            right: -40px !important;
        }

        #highlightsCarousel .carousel-control-prev {
            left: -40px !important;
        }

        .multimedia .col-md-8 iframe {
            height: 280px !important;
        }

        .multimedia .pt-4 .col-md-8 {
            padding-left: 0 !important;
            padding-bottom: 15px !important;
        }

        .multimedia .pt-4 .col-md-4 {
            padding-left: 0 !important;
        }

        .mobile-nav-bar {
            display: flex !important;
        }
    }

    @media only screen and (max-width: 767.98px) {
        .sticky_cha {
            top: 0px !important;
        }

        .pt-2.mobile-search {
            display: block !important;
        }

        .navbar-light .navbar-toggler {
            border-color: rgba(0, 0, 0, 0) !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        #AuthorCarousel .person-description {
            height: 140px !important;
        }

        #AuthorCarousel .person-description .description {
            font-size: 12px !important;
        }

        #AuthorCarousel .person-main {
            height: 260px;
        }

        #highlightsCarousel .carousel-control-next {
            right: -60px !important;
        }

        #highlightsCarousel .carousel-control-prev {
            left: -60px !important;
        }

        .page-content .content-section-right .row.section-divider:first-child .heading {
            font-size: 15px !important;
        }

        .multimedia .col-md-8 iframe {
            height: 280px !important;
        }

        .multimedia .col-md-4 iframe {
            height: 115px !important;
        }

        .multimedia .heading {
            font-size: 17px !important;
        }

        .multimedia .pt-4 .col-md-8 {
            padding-left: 0 !important;
            padding-bottom: 15px !important;
        }

        .multimedia .col-md-12.col-xs-12.px-md-0 {
            margin-bottom: 0 !important;
            margin-top: 0 !important;
        }
    }

    @media (min-width: 769px) and (max-width: 991.98px) {
        #highlightsCarousel .new_pub {
            margin-top: 15px !important;
        }
    }

    @media (min-width: 992px) and (max-width: 1199.98px) {
        #AuthorCarousel .person-description {
            height: 120px !important;
        }

        #AuthorCarousel .person-main {
            height: 250px;
        }

        #AuthorCarousel .person-description .description {
            padding-right: 0px !important;
        }

        #highlightsCarousel .carousel-control-next {
            right: -92px !important;
        }

        #highlightsCarousel .carousel-control-prev {
            left: -92px !important;
        }

        .page-content .content-section-right .row.section-divider:first-child .heading {
            font-size: 15px !important;
        }

        #highlightsCarousel .new_pub {
            margin-top: 15px !important;
        }
    }

    @media (min-width: 1025px) and (max-width: 1200.98px) {
        .fades {
            width: 320px !important;
            padding-left: 5px !important;
        }
    }

    @media (min-width: 900px) and (max-width: 990px) {
        .fades {
            width: 280px !important;
            padding-left: 5px !important;
        }
    }

    @media (min-width: 871px) and (max-width: 899.98px) {
        .fades {
            width: 340px !important;
        }
    }

    @media (min-width: 1200px) {
        #highlightsCarousel .carousel-control-next {
            right: -92px !important;
        }

        #highlightsCarousel .carousel-control-prev {
            left: -92px !important;
        }





    }


    @media (min-width: 1900px) {

        .cover-right-spacing {
            width: 85% !important;
            text-align: left;
            float: left
        }


    }



    .author #AuthorCarousel .carousel-control-next {
        opacity: 1 !important;
        right: -38px !important;
    }

    .author #AuthorCarousel .carousel-control-prev {
        opacity: 1 !important;
        left: -38px !important;
    }

    .author #AuthorCarousel .carousel-inner .carousel-item .col-md-4 {
        padding-right: 5px !important;
        padding-left: 5px !important;
    }

    .highlights-pub {
        padding-top: 1.8rem !important;
        padding-bottom: 0 !important;
    }

    .category a {
        color: #69AAB4 !important;
    }
</style>


<div class="container-fluid page-cover">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xs-8 m-0 p-0">
            <div id="carouselExampleControls" class="carousel slide cover-responsive" data-ride="carousel">
                <div class="carousel-inner cover-responsive">



                    <?php $x = 0;
                    foreach ($sliders as $slider) {
                        $x++;


                    ?>

                        <div class="carousel-item <?php if ($x == 1) { ?>active <?php } ?> cover-responsive">

                            <div style="padding: 0px !important;" class="col-md-12 col-lg-12 col-xs-12 m-0 p-0 h-100">
                                <img class="cover-left-image cover-responsive" src="<?= base_url() ?><?= $slider->image_name ?>">
                            </div>


                        </div>


                    <?php } ?>

                    <div class="carousel-controller">
                        <div class="btn-container d-flex">
                            <div onclick="plusSlides(-1)" class="left" href="#carouselExampleControls" role="button" data-slide="prev">
                                <!-- <i class="fa fa-arrow-left"></i> -->
                                <img class="imn" src="<?php echo base_url() ?>v6/assets/Icons/arrow-left.png" />
                            </div>
                            <div onclick="plusSlides(1)" class="right" href="#carouselExampleControls" role="button" data-slide="next">
                                <!-- <i class="fa fa-arrow-right"></i> -->
                                <img class="imn" src="<?php echo base_url() ?>v6/assets/Icons/arrow-right.png" />
                            </div>
                        </div>
                    </div>

                    <!-- <a class="carousel-control-prevs" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-nexts" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a> -->

                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xs-4 m-0 p-0">
            <div id="carouselExampleControls" class="carousel slide cover-responsive" data-ride="carousel">
                <div class="carousel-inner cover-responsive">



                    <?php $x = 1;
                    $dot = array();
                    foreach ($sliders as $slider_d) {
                        $x++;
                        $dot[] = $x;




                    ?>

                        <div class="carousel-item <?php if ($x == 100) { ?>active <?php } ?>   cover-responsive mybSlides">
                            <?php

                            //var_dump($slider->heading);
                            ?>

                            <div class="container col-md-12 col-lg-12 col-xs-12 h-100 cover-right">




                                <div style="width: 500px; " class="container fades p-4 cover-right-spacing">

                                    <h3 style="color: white !important;" class="text-light  "> <?php echo substr($slider_d->heading, 0, 10) ?></h3>
                                    <p class="text-light py-3">

                                        <?php


                                        //echo strlen($slider->content)."<hr>";

                                        $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $slider_d->content);
                                        $ns = strip_tags($n);


                                        // echo $ns."<hr>";



                                        echo limit_text($ns, 33, $slider_d->banner_url);




                                        //$ns = substr(Strip_tags($slider->content),0,250);


                                        $str = substr($ns, 0, 260);

                                        if (strlen($ns) > 260) {
                                            //  echo $str."(...)";
                                        } else {
                                            // echo $str;
                                        }


                                        ?>



















                                    </p>


                                    <a href="<?= $slider_d->banner_url ?>" target="<?= $slider_d->banner_target ?>" class="btn btn-cover explore-btn">Read More</a>











                                </div>
                            </div>

                        </div>


                    <?php } ?>





                </div>

                <div class="slider-dot" style=" /* text-align:center; */bottom: 20px;position: relative;margin-bottom: -20px;margin-top: -20px;margin-left: 40px;  ">

                    <?php

                    foreach ($dot as $d) {

                    ?>
                        <span class="dot <?php if ($d == 1) { ?> actives <?php } ?> " "></span>

                         <?php

                        }

                            ?>
                </div>



            </div>
        </div>


    </div>
</div>

<!-- Featured topics -->
<nav class=" navbar navbar-expand-sm featured-topic-areas p-md-3 px-5 py-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="navbar-nav justify-content-end" style="font-size: 14px">
                                            <li class="nav-item main-topic">
                                                <a class="nav-link font-italic">Featured Topics</a>
                                            </li>

                                            <?php $new_rarea = $this->header->get_menuTopic('newscategories', 6)  ?>


                                            <?php foreach ($new_rarea as $new_rarea) {

                                            ?>

                                                <li class="nav-item topic-item">
                                                    <a style="padding-left: 18px; " class="nav-link nav-link_new" href="<?= base_url() ?>Update/Brows/<?= $new_rarea->uri ?>"><?= strtoupper($new_rarea->category_name) ?></a>
                                                </li>


                                            <?php


                                            } ?>






                                        </ul>
                                    </div>
                                </div>
                            </div>
                </div>
                </nav>

                <!-- Page content -->
                <div class="page-content pt-3 p-4">
                    <div class="container">
                        <div class="row">

                            <!-- Content section left -->
                            <div class="col-md-8 col-xs-12">
                                <div class="container-fluid">

                                    <div class="row py-3 mb-3">
                                        <div class="col-12  m-0 p-0">
                                            <div class="main-title"><a href="<?= base_url() ?>Update/Brows/all">Recent Updates</a></div>
                                        </div>
                                    </div>

                                    <?php $s = 0;
                                    foreach ($newsall as $news) {
                                        if (strip_tags($news['title']) != 'Inaugural Meeting of APEN Business Club') {
                                            $s++;   ?>
                                            <div class=" <?php if ($s != 1) { ?> py-4 <?php  } else { ?> pb-4 <?php } ?> row  <?php if ($s != 4) { ?> bottom-section-divider <?php } ?>">
                                                <div style="margin-right: 0rem!important;" class="col-md-5 col-xs-12 mr-md-2 m-0 p-0">
                                                    <img class="responsive" src="<?= base_url() ?><?= $news['image_name'] ?>">
                                                </div>
                                                <div class="col-md-7 col-xs-12 mobile-padding-0">
                                                    <div class="category">

                                                        <?php

                                                        $cname = '';



                                                        //  echo rtrim($cname, ", ");


                                                        if ($news['article_type'] == 'articles') {
                                                            echo "Article";
                                                        } else {
                                                            echo ucfirst($news['article_type']);
                                                        }



                                                        echo $news['tags'];


                                                        if ($news['article_type'] == 'news') {
                                                            $url = 'news/details/' . $news['uri'];
                                                        } else {
                                                            $url = 'news/details/' . $news['uri'];
                                                        }

                                                        ?>

                                                    </div>
                                                    <a href="<?php echo base_url() ?><?= $url ?>">
                                                        <div class="heading"><?= strip_tags($news['title']) ?></div>
                                                    </a>
                                                    <div>
                                                        <span style="display:none" class="by">by</span>
                                                        <span style="display:none" class="author"><?php if ($news['editor']) {
                                                                                                        echo $news['editor'];
                                                                                                    } else {
                                                                                                        echo "Editor";
                                                                                                    } ?></span>
                                                        <span style="display:none" class="hori-line">----</span>
                                                        <span class="date"><?= $news['posted_date'] ?></span>
                                                    </div>
                                                    <div class="description"><?php



                                                                                $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $news['content']);
                                                                                $ns = strip_tags($n);
                                                                                echo limit_text($ns, 21, $url);



                                                                                $ns = substr(strip_tags($news['content']), 0, 140);



                                                                                $str = substr($ns, 0, strrpos($ns, ' '));




                                                                                if (strlen($news['content']) > 120) {
                                                                                    // echo $str."(...)";
                                                                                } else {
                                                                                    //  echo $str;
                                                                                }


                                                                                ?></div>
                                                </div>
                                            </div>


                                    <?php }
                                    } ?>



                                </div>
                            </div>

                            <!-- Content section right -->
                            <div class="content-section-right col-md-4 col-xs-12 py-4">



                                <?php

                                foreach ($card as $c) {

                                    $this->load->view('front-end/common/card_' . $c->card);
                                }


                                ?>




                            </div>



                        </div>
                    </div>
                </div>


                <!--Author carousel -->
                <div class="carousel author container my-4 px-md-0 px-5">
                    <div class="author-head-title">Programmes </div>
                    <div class="row mx-auto my-auto">
                        <div id="AuthorCarousel" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">

                                <?php $e = 0;
                                foreach ($categories as $categories) {
                                    $e++;  ?>
                                    <div class="carousel-item <?php if ($e == 1) { ?> active <?php } ?> ">
                                        <div class="col-md-4 pl-0 pr-md-4 item-inner">



                                            <div class="col db-card">
                                                <div class="card detail-db-section db-full-crd">
                                                    <a href="#"><img style="height: 150px" src="<?= base_url() ?><?= $categories->image_name ?>" class="card-img-top db-image-top" alt="(...)"></a>
                                                    <div class="card-body">
                                                        <h5 style="height: 58px" class="card-title db-programe-tittle"> <a href="<?= base_url() ?>Programmes/catogery/<?= $categories->uri ?>">







                                                                <?php


                                                                //echo strlen($slider->content)."<hr>";

                                                                $n = $categories->category_name;
                                                                $ns = strip_tags($n);


                                                                // echo $ns."<hr>";



                                                                echo limit_text($ns, 15, null);




                                                                //$ns = substr(Strip_tags($slider->content),0,250);


                                                                $str = substr($ns, 0, 260);

                                                                if (strlen($ns) > 260) {
                                                                    //  echo $str."(...)";
                                                                } else {
                                                                    // echo $str;
                                                                }


                                                                ?>








                                                            </a>
                                                        </h5>
                                                        <p style="display: none" class="card-text db-crd-text"> <?= substr(strip_tags($categories->description), 0, 150) ?>(...)</p>
                                                        <div style="background: #003680; color: white" class="up-search-db mt-4">
                                                            <a style="color: white" href="<?= base_url() ?>Programmes/catogery/<?= $categories->uri ?>"> LEARN MORE&nbsp; &nbsp; <i class="db-arrow fa fa-angle-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>

                                <?php } ?>

                            </div>

                            <a class="carousel-control-prev w-auto author-slider-btn-left" href="#AuthorCarousel" role="button" data-slide="prev">
                                <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_left.png">
                                <!-- <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span> -->
                            </a>

                            <a class="carousel-control-next w-auto author-slider-btn-right" href="#AuthorCarousel" role="button" data-slide="next">
                                <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_right.png">
                                <!-- <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span> -->
                            </a>

                        </div>
                    </div>
                </div>















                <!-- highlights -->
                <div style="height:600px" class="container-fluid highlights highlights-pub py-4 p-4">
                    <div class="container mt-4">
                        <h2 class="font-weight-bold text-light">Highlighted Publications</h2>

                        <div class="container-lg my-3">
                            <div id="highlightsCarousel" class="carousel slide" data-ride="highlightsCarousel">
                                <!-- Wrapper for carousel items -->
                                <!-- ©Hashan Pallewatte 2020  -->
                                <!-- Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including files downloadable from this website, without the permission of the copyright owner. -->
                                <div style="height:550px" class="carousel-inner-pub carousel-inner">

                                    <?php $x = 0;
                                    $pu = array();
                                    foreach ($publications as $pub) {
                                        $x++;
                                        $result = '';
                                        $nresult = '';
                                        $pu[] = $x; ?>

                                        <div class="carousel-item <?php if ($x == 1) { ?> active <?php  } ?> ">
                                            <div class="row pt-4">
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="highlight-image float-right mb-5">
                                                        <img height="400" style="height:400px !important;" class="img-fluid" src="<?= base_url() ?><?= $pub['image_name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="new_pub col-md-8 col-xs-12 text-light">
                                                    <div class="highligh-heading">
                                                        <?= str_replace("â€™", "'", $pub['title']) ?>
                                                    </div>
                                                    <div class="highlight-author pb-4 pt-1">
                                                        <?php


                                                        $nc =  count($pub['editornew']) + count($pub['authornew']);


                                                        if ($nc != 0) {

                                                            if (count($pub['editornew']) != 0) {
                                                        ?>

                                                                Author(s)/Editor(s) : <?php foreach ($pub['editornew'] as $ed) {






                                                                                            $result .= "<a style='color:white' href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>,&nbsp";
                                                                                        }
                                                                                        echo rtrim($result, ', ');

                                                                                        if (count($pub['authornew']) != 0) {

                                                                                        ?> / <?php
                                                                                        }

                                                    ?>

                                                            <?php

                                                            }

                                                            if (count($pub['authornew']) != 0) {
                                                            ?>

                                                                Author(s) : <?php foreach ($pub['authornew'] as $ed) {

                                                                                $nresult .= "<a style='color:white' href='" . base_url() . "Experts/detail/$ed->uri' target='_blank'>" . $ed->title . "</a>,&nbsp";
                                                                            } ?>

                                                            <?php

                                                                echo rtrim($nresult, ',');
                                                            }
                                                        } else {

                                                            if ($pub['author']) { ?>


                                                                <span class="book-by"> Author(s) </span><span class="book-by-author"><?= $pub['author'] ?></span>






                                                                <?php if ($pub['editor']) { ?> / <?php }
                                                                                            }


                                                                                            if ($pub['editor']) { ?>


                                                                <span class="book-by"> Editor(s) </span><span class="book-by-author"><?= $pub['editor'] ?>&nbsp</span>






                                                        <?php }
                                                                                        }



                                                        ?>


                                                        <br>
                                                        <span class="date"> <?= $pub['posted_date'] ?> </span>
                                                    </div>
                                                    <div class="highlight-description pb-4">

                                                        <?php
                                                        // $n=preg_replace("/<h2(.*)<\/h2>/iUs", " ", $pub['content']);

                                                        //  $ns = strip_tags($n);

                                                        $n = preg_replace("/<h2(.*)<\/h2>/iUs", " ", $pub['content']);
                                                        $ns = strip_tags($n);
                                                        echo limit_text($ns, 50, 'Publications/Detail/' . $pub['uri']);




                                                        //  echo $n;

                                                        // substr($pub['content'],0,400)
                                                        //  $str=substr($ns, 0, strrpos($ns, ' '));


                                                        // echo strip_tags($pub['content']);






                                                        ?>

                                                    </div>
                                                    <div class="pb-5">
                                                        <a href="<?php echo base_url() ?>Publications/Detail/<?= $pub['uri'] ?>" class="btn btn-highlight py-2 px-4">Read More </a>
                                                    </div>
                                                    <div style="font-size:60px " class="  mt-4 text-light">


















                                                    </div>







                                                </div>

                                                <div class="col-md-1">
                                                </div>

                                            </div>
                                        </div>

                                    <?php } ?>


                                    <div style="text-align: center;
    margin-bottom: 100px;
    margin-top: 425px; ">


                                        <?php

                                        foreach ($pu as $d) {

                                        ?>
                                            <span class="pdot ppdot <?php if ($d == 1) { ?> actives <?php } ?> " onclick="currentSlide(<?= $d ?>)"></span>

                                        <?php

                                        }

                                        ?>

                                    </div>


                                </div>


                                <!-- Carousel controls -->
                                <a class="carousel-control-prev" href="#highlightsCarousel" onclick="_plus_pubSlides(-1)" data-slide="prev">
                                    <!-- <span class="carousel-control-prev-icon"></span> -->
                                    <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_left.png">
                                </a>
                                <a class="carousel-control-next" href="#highlightsCarousel" onclick="_plus_pubSlides(1)" data-slide="next">
                                    <!-- <span class="carousel-control-next-icon"></span> -->
                                    <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_right.png">
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- MultiMedia -->
                <div class="multimedia py-5 mb-5 p-4">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12 col-xs-12 heading">
                                <div class="float-left left-span align-middle font-weight-bold text-dark">Multimedia </div>
                                <div class="float-right right-span align-middle d-none d-md-block font-weight-bold"><a href="<?php echo base_url() ?>NewsMultimedia"> See other multimedia</a>
                                </div>
                            </div>







                            <div class="col-md-12 col-xs-12 px-md-0">
                                <div class="row pt-4 mx-0">

                                    <div class="col-md-8 col-xs-12">








                                        <iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?= substr($multimedia[0]->video_url, 32, 100) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div class="heading"><a href="<?= base_url() ?>NewsMultimedia/detail/<?= $multimedia[0]->uri ?>"><?= $multimedia[0]->title ?></a></div>
                                        <div style="color:black" class="date"><?= date('j F Y', strtotime($multimedia[0]->posted_date)) ?> </div>
                                        <div class="description mt-3"><?php


                                                                        // substr($multimedia[0]->content,0,195)


                                                                        $ns = substr(strip_tags($multimedia[0]->content), 0, 196);


                                                                        $str = substr($ns, 0, strrpos($ns, ' '));

                                                                        echo $str . "<a href='" . base_url() . "NewsMultimedia/detail/" . $multimedia[1]->uri . "'>(...)</a>";



                                                                        ?>




                                        </div>
                                        <button onclick="reload_('<?= base_url() ?>NewsMultimedia/detail/<?= $multimedia[1]->uri ?>')" class="btn mt-3 font-weight-bold"><a href="<?= base_url() ?>NewsMultimedia/detail/<?= $multimedia[1]->uri ?>">LEARN MORE</a><span class="fa fa-angle-right font-weight-bold"></span></button>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?= substr($multimedia[1]->video_url, 32, 100) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div class="heading mb-3"><a href="<?= base_url() ?>NewsMultimedia/detail/<?= $multimedia[1]->uri ?>">

                                                <?php


                                                $string = preg_replace("/<p\s(.+?)>(.+?)<\/p>/is", " $2 ", $multimedia[1]->title);


                                                $ns = substr(strip_tags($string), 0, 60);


                                                $str = substr($ns, 0, strrpos($ns, ' '));



                                                echo str_replace("â€˜", "", $str) . "(...)";  ?>



                                            </a></div>
                                        <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?= substr($multimedia[2]->video_url, 32, 100) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div class="heading"><a href="<?= base_url() ?>NewsMultimedia/detail/<?= $multimedia[2]->uri ?>">

                                                <?php

                                                $ns = substr(strip_tags($multimedia[2]->title), 0, 60);


                                                $str = substr($ns, 0, strrpos($ns, ' '));

                                                echo str_replace("â€˜", "", $str) . "(...)";  ?>

                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Research area -->
                <div class="research-areas p-4">
                    <div class="container">
                        <div class="row py-4">
                            <div class="col-md-4 col-sm-6 col-xs-12  ">
                                <div style="font-size: 28px;"> Research Areas </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-8">
                                <div class="research-items">

                                    <?php $rarea = $this->header->get_menuTopic('topics', 9)  ?>

                                    <?php foreach ($rarea as $rarea) { ?>
                                        <div class="research-item"> <a href="<?= base_url() ?>Research/catogery/<?= $rarea->uri ?>"> <?= $rarea->category_name ?> </a> </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    function reload_(i) {
                        window.location = i;
                    }
                </script>



                <script>
                    var slideIndex = 1;
                    showbannerSlides(slideIndex);




                    function plus_pubSlides(n) {



                        showbannerSlides(slideIndex += n);
                    }


                    function plusSlides(n) {
                        showbannerSlides(slideIndex += n);
                    }

                    function currentSlide(n) {
                        showbannerSlides(slideIndex = n);
                    }

                    function showSlides(n) {





                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("dot");
                        var pdots = document.getElementsByClassName("pdot");



                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";

                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" actives", "");
                        }

                        for (i = 0; i < pdots.length; i++) {
                            pdots[i].className = pdots[i].className.replace(" actives", "");
                        }

                        pdots[slideIndex - 1].className += " actives";
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " actives";
                    }

                    function showbannerSlides(n) {




                        var i;
                        var slides = document.getElementsByClassName("mybSlides");
                        var dots = document.getElementsByClassName("dot");
                        var pdots = document.getElementsByClassName("pdot");



                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";

                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" actives", "");
                        }

                        for (i = 0; i < pdots.length; i++) {
                            pdots[i].className = pdots[i].className.replace(" actives", "");
                        }

                        pdots[slideIndex - 1].className += " actives";
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " actives";
                    }
                </script>