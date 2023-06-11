<style>
.has-bg-img :after {
    content: '';
    background-image: url('https://eria-development.website/eria/uploads/publications/20181112/0.jpg') !important;
    opacity: 0.6;
    background-size: cover;
    z-index: 1;
    height: 220px;
}

/* shold write the export.css file. this is resuce the gap between page header and page items*/

.experts-detail-page {
    position: relative;
    background-color: #ffffff;
    top: -32px !important;
}


@media (min-width: 1200px) {
    div.loadButton {
        padding-top: 25px !important;
    }
}

@media only screen and (min-device-width: 869px) and (max-device-width: 1190px) {

    div.loadButton {
        padding-top: 25px !important;
    }
}

@media only screen and (min-width: 768px) and (max-width: 868px) {

    div.loadButton {
        padding-top: 25px !important;
        margin-bottom: -30px !important;
    }

}

@media only screen and (max-width: 668px) {

    div.loadButton {
        padding-top: 25px !important;
        margin-bottom: -25px !important;
    }

    .publication-browse-tittle.mb-3 {
        padding-top: 27px !important;
    }

    .col-md-6.col-xs-12.mb-md-0.mb-2 {
        margin-top: -26px !important;
    }

    .publication-browsing-heading {
        margin-top: 25px !important;
    }
}


.new_publication {
    position: absolute;
    z-index: 9999;
    height: 310px;
    overflow: auto;
}

.new_publication_inside {
    border: solid 1px #ced4da;
    border-radius: 8px;
}

.check-btns {
    padding: 10px;
}

.publication-collapsible:after {
    margin-top: -11px;
}

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
    background-image: url('../../resources/images/SocialMedia/down.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}

.publicationactive:after {
    background-image: url('../../resources/images/SocialMedia/up.png');
    background-size: 20px 20px;
    display: inline-block;
    width: 20px;
    height: 20px;
    content: "";
    margin-top: 4px !important;
}
</style>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <?php 
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
            
            $urlCategories = explode('/', $parse_url);
            
            if (isset($urlArray) || !empty($urlCategories)) {
                if (end($urlCategories) == 'all') {
                    $title_head = 'ASEAN';
                } else {
                    $g = ucwords(str_replace("_", " ", end($urlCategories)));
                    $title_head = str_replace(array("-", "%20"), " ", $g);
                }
            } else {
                $title_head = 'ASEAN';
            }

            echo '<h1 class="event-title text-white font-merriweather">'.$title_head.'</h1>';
        ?>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="container experts-detail-page mt-3 mb-5 pr-md-5 pr-1">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="profile-overView ">
                <?php
                $countries_asean = $this->frontModel->getCountriesAsean(16);
                
                $not_asean = ['Australia', 'China', 'India', 'Japan', 'New Zealand', 'Republic of Korea'];
                foreach ($countries_asean as $value) {
                    if (!in_array($value->venue, $not_asean)) {

                        echo '<div class="pt-3">
                                    <a href="'.base_url().'research/topic/asean/'.$value->venue.'">'.ucfirst($value->venue).'</a>
                                </div>';
                    }
                }
            ?>
            </div>

            <?php
            foreach ($card as $c) {
                $this->load->view('front-end/common/card_' . $c->card);
            }
            ?>
        </div>

        <!-- right section -->
        <!-- Search Publications Brows -->
        <?php $this->load->view('front-end/content/search-publications/searchAseanBrows'); ?>
        <!-- end Search Publications Brows -->
    </div>
</div>