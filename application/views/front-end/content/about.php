<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
<style>
.active_ {
    background: #0e3680 !important;
}

.hid {
    display: none;
}

.person-description {
    background-color: #F3F3F3;
    height: 260px;
    overflow-y: auto;
}

.about-page .plus1 {
    bottom: 253px;
}

.about-page .plus2 {
    bottom: 253px;
}

/*
  ** New Update Css
  */

.author #AuthorCarousel .carousel-control-prev {
    left: -68px;
}

.author #AuthorCarousel .carousel-control-next {
    right: -59px;
}

#AuthorCarousel .person-description {
    height: 236px;
}

a#back,
a#forward {
    top: 25%;
}

.yearInput {
    width: 25px;
    height: 25px;
    border: 4px solid #F3F3F3;
    position: relative;
    border-radius: 50%;
}

.yearInput span {
    width: 1px;
    height: 1px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    visibility: hidden;
}

.yearInput::before,
.yearInput::after {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    top: 50%;
    transform: translateY(-50%);
    background-image: linear-gradient(90deg, rgb(150, 150, 150, 0.5), rgb(150, 150, 150, 0.5) 50%, transparent 50%, transparent 100%);
    background-size: 4px 1px;
    border: none;
    width: 5vw;
    height: 1px;
    max-width: 61px;
    border: 0;
}

.yearInput span::before {
    font-weight: 400;
    content: attr(data-info);
    top: -65px;
    width: 70px;
    transform: translateX(-5px) rotateZ(-45deg);
    font-size: 12px;
    text-indent: -10px;
}

.yearInput span::before,
.yearInput span::after {
    visibility: visible;
    position: absolute;
    left: 50%;
}

.yearInput::before {
    left: calc(-4vw + 12.5px);
}

.yearInput::after {
    right: 24.5px;
}

.timeLine {
    overflow: auto;
}

/* Author Swiper */
.swiper {
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

.author-slide-swiper:hover .swiper-button-prev,
.author-slide-swiper:hover .swiper-button-next {
    visibility: visible;
}

/* Author Swiper */

.publications-image {
    flex: none;
    width: 100%;
    height: auto;
    overflow: hidden;
}

.publications-image img {
    width: 100%;
    object-fit: cover;
}

@media (min-width:768px) {
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


@media screen and (max-width: 981px) {
    .flex-parent {
        clip-path: calc(-4vw + 12.5px);
        /*overflow-x: scroll;*/
    }

    .input-flex-container {
        width: 80%;
    }

    .timeLine {
        overflow: auto;
    }

}

@media screen and (max-width: 769px) {
    .flex-parent {
        clip-path: unset;
        width: 100%;
        height: auto;
    }

    .input-flex-container {
        width: 671px;
    }
}
</style>

<div class="research-page about-page section-top">
    <!-- head title and cards -->
    <div class="about-topic bg-light-blue py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="second-title text-blue">
                        <?php echo $pc->content ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container about-content py-4 my-4">
        <div class="row main-content">
            <!-- Content section left -->
            <div class="col-md-8 col-xs-12">
                <div class="background-grey"></div>
                <div class="heading">PROF HIDETOSHI NISHIMURA</div>
                <div class="title font-merriweather text-blue mt-2">Message from the President </div>
                <div class="d-flex mt-2">
                    <hr class="pr-5 mr-3 mt-2">
                    <p class="description">ERIA is an international organisation that was established by an agreement of
                        the leaders of 16 East Asia Summit (EAS) member countries. Its main role is conduct research and
                        policy
                        analyses to facilitate the ASEAN Economic Community (AEC) building and to support wider regional
                        community
                        building.
                    </p>
                </div>
                <div class="center-button">
                    <a href="<?php echo base_url() ?>presidents-office" class="btn third-button mb-4 px-4 mt-4">Read
                        more</a>
                </div>
            </div>
            <!-- Content section right -->
            <div class="col-md-4 col-xs-12 pl-md-5 m-0">
                <div class="img-container pr-md-5">
                    <img src="<?php echo base_url() ?>v6/assets/Images/About/about_1.png">
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-5 ">
            <div class="col-md-8 video-container-background col-xs-12">
                <div style="width:90%" class="container text-center video-container pb-5">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/mRfNXlrMiLM" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 main-content text-center">
                <div class="title mt-2">ABOUT ERIA </div>
                <div class="d-flex mt-2">
                    <div class="description">ERIA is an international organisation that was established by an agreement
                        of
                        the leaders of 16 East Asia Summit (EAS) member countries. Its main role is conduct research and
                        policy
                        analyses to facilitate the ASEAN Economic Community (AEC) building and to support wider regional
                        community
                        building.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about row -->
    <div class="container-fluid">
        <div class="row mt-5 about-row">
            <div class="research-topic-cover w-100">
                <img src="<?php echo base_url() ?>v6/assets/Images/About/cover_2.png">
                <div class="overlay-effect h-100 w-100">
                </div>
                <div class="text-light overlay-text margin-top">
                    <h3 class="main-title">Our History</h3>
                    <p class="px-lg-5 mx-0">
                        <?php echo $ac->discription ?>
                    </p>
                    <a href="<?php echo base_url() ?>History" class="btn second-button mb-4 mt-2">
                        <?php echo $ac->buttonn ?></a>
                </div>
            </div>
            <div class="container about-card">
                <div class="row bg-white tab-card">
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"> <?php echo $ac->he1 ?></div>
                            <div class="details mb-3"> <?php echo $ac->he1_dis ?> </div>
                            <a href="<?php echo $ac->he1_link ?> ">
                                <div class="view-more"> <?php echo $ac->he1_butt ?> <span
                                        class="fa fa-angle-right"></span> </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"><?php echo $ac->he2 ?></div>
                            <div class="details mb-3"> <?php echo $ac->he2_dis ?> </div>
                            <a href="<?php echo $ac->he2_link ?> ">
                                <div class="view-more"> <?php echo $ac->he2_butt ?> <span
                                        class="fa fa-angle-right"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section border-0">
                            <div class="title mb-2"> <?php echo $ac->he3 ?> </div>
                            <div class="details mb-3"> <?php echo $ac->he3_dis ?> </div>
                            <a href="<?php echo $ac->he3_link ?> ">
                                <div class="view-more"> <?php echo $ac->he3_butt ?> <span
                                        class="fa fa-angle-right"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Annual report -->
    <div class="container-fluid anual-report mb-5">
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-4 col-12">
                    <div class="anual-report-card text-white">
                        <div style="opacity: 0.5" class="title mb-3">
                            <?php echo $ac->hig_menu1 ?>
                        </div>
                        <h3 class="main-title pb-4"> <?php echo $ac->hig_menu_h1 ?> </h3>
                        <a style="color: #fff;" href="<?php echo $ac->hig_menu_b1_link ?>">
                            <div class="view-more"> <?php echo $ac->hig_menu_b1 ?> <span
                                    class="fa fa-angle-right"></span></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="anual-report-card text-white">
                        <div style="opacity: 0.5" class="title mb-3">
                            <?php echo $ac->hig_menu2 ?>
                        </div>
                        <h3 class="main-title pb-4"> <?php echo $ac->hig_menu_h2 ?> </h3>
                        <a style="color: #fff;" href="<?php echo $ac->hig_menu_b2_link ?>">
                            <div class="view-more"> <?php echo $ac->hig_menu_b2 ?> <span
                                    class="fa fa-angle-right"></span></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="anual-report-card text-white">
                        <div style="opacity: 0.5" class="title mb-3">
                            <?php echo $ac->hig_menu3 ?>
                        </div>
                        <h3 class="main-title pb-4"> <?php echo $ac->hig_menu_h3 ?> </h3>
                        <a style="color: #fff;" href="<?php echo $ac->hig_menu_b3_link ?>">
                            <div class="view-more"> <?php echo $ac->hig_menu_b3 ?> <span
                                    class="fa fa-angle-right"></span></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Author carousel -->
    <!-- <div class="container pb-4">
        <div class="row">
            <div class="col-lg-12 author-slide-swiper">
                <div class="swiper author-swiper">
                    <div class="swiper-wrapper">
                        <?php
                            $c = 0;
                                $year = array();
                                foreach ($times as $t) {
                                    $c++;
                                    if (!in_array($t->year, $year)) {
                                        $year[] = $t->year;
                                    }
                                ?>
                        <div class="swiper-slide">
                            <div class="card bg-main-grey border-0 rounded-0 h-100">
                                <div class="card-header border-0">
                                    <h6 class="name mb-0"><?php echo $t->year ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-title text-blue mb-3"><?php echo $t->title ?></div>
                                    <div class="description"><?php echo $t->content ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="swiper-pagination d-block d-md-none" id="author-pagination" style="bottom:-40px"></div>
                <div class="d-none d-md-flex swiper-button-prev" id="author-button-prev" style="left:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </div>
                <div class="d-none d-md-flex swiper-button-next" id="author-button-next" style="right:-8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                    </svg>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Timeline -->
    <!-- <div class="container d-none d-sm-block timeLine">
      
        <div class="row ">

            <div class="flex-parent">
                <div class="input-flex-container d-none">

                    <?php $y = 0;
                    foreach ($year as $year) {
                        $y++; ?>

                    <div style="background: none" data-year="<?php echo $year ?>"
                        class="input_ yearInput input <?php if ($y == 1) { ?>active_<?php  } ?>">
                      
                        <a> <span data-year="<?php echo $year ?>"></span> </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Research & insight -->
    <div class="container-fluid">
        <div class="row mt-5 about-row">
            <div class="research-topic-cover w-100">
                <img src="<?php echo base_url() ?>v6/assets/Images/About/cover_2.png">
                <div class="overlay-effect h-100 w-100">
                </div>
                <div class="text-light overlay-text">
                    <h2 class="main-title"> <?php echo $rc->r_head ?></h2>
                    <!--<p style="font-family: 'Literata';padding-right: 8rem; padding-left: 8rem; font-size: 15px"
                       class="px-0 mx-0">-->
                    <p class="descripton px-0 mx-0">
                        <?php echo $rc->rdis ?>
                    </p>
                    <a href="<?php echo base_url() ?>research" class="btn second-button mb-4 mt-2">
                        <?php echo $ac->buttonn ?></a>
                    <!-- <a href="<?php echo $rc->r_link ?>" data-toggle="modal" data-target="#downloadPdfModal1" class="btn second-button mb-4 mt-2"> <?php echo $rc->rbbutton ?> -->
                    </a>
                </div>
            </div>
            <div class="container about-card research-card">
                <div class="row bg-white tab-card">
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"> <?php echo $rc->h_1 ?> </div>
                            <div class="details mb-3"> <?php echo $rc->h_1_dis ?> </div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_1_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_1_b ?> </div>
                                    <div style=" float: right " class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"> <?php echo $rc->h_2 ?> </div>
                            <div class="details mb-3"> <?php echo $rc->h_2_dis ?> </div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_2_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_2_b ?> </div>
                                    <div style="float: right" class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section border-0">
                            <div class="title mb-2"> <?php echo $rc->h_3 ?> </div>
                            <div class="details mb-3"> <?php echo $rc->h_3_dis ?> </div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_3_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_3_b ?> </div>
                                    <div style=" float: right " class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container about-card research-card">
                <!-- <img src="<?php echo base_url() ?>v6/assets/Icons/plus-icon.png" class="plus1"> -->
                <!-- <img src="<?php echo base_url() ?>v6/assets/Icons/plus-icon.png" class="plus2"> -->
                <div class="row bg-white tab-card">
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"> <?php echo $rc->h_4 ?> </div>
                            <div class="details mb-3"> <?php echo $rc->h_4_dis ?> </div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_4_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_4_b ?> </div>
                                    <div style=" float: right " class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section">
                            <div class="title mb-2"> <?php echo $rc->h_5 ?> </div>
                            <div class="details mb-3"><?php echo $rc->h_5_dis ?></div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_5_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_5_b ?> </div>
                                    <div style=" float: right " class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 section pl-0 pr-0">
                        <div class="inner-section border-0">
                            <div class="title mb-2"> <?php echo $rc->h_6 ?> </div>
                            <div class="details mb-3"> <?php echo $rc->h_6_dis ?> </div>
                            <div class="vmore">
                                <a href="<?php echo $rc->h_6_l ?> ">
                                    <div style="float: left" class="view-more"> <?php echo $rc->h_6_b ?> </div>
                                    <div style=" float: right " class="fa fa-angle-right"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Publications -->
    <!-- Related Articles -->
    <?php $this->load->view('front-end/content/relateds/publications_related'); ?>
    <!-- END -->
</div>


<script>
const swiper = new Swiper('.author-swiper', {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 16,
    loop: false,
    breakpoints: {
        768: {
            spaceBetween: 24,
            slidesPerView: 2
        },
        1024: {
            spaceBetween: 24,
            slidesPerView: 3
        }
    },
    pagination: {
        el: '#author-pagination',
    },
    navigation: {
        nextEl: '#author-button-next',
        prevEl: '#author-button-prev',
    }
});
</script>