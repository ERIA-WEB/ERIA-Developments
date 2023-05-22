<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
<style>
html,
body {
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
}

table,
th,
tr,
td {
    border: none !important;
}

.test.col-md-8.col-12.author-detail.author>h1>span {
    font-size: 23px;
    font-family: 'Merriweather';
    font-weight: bold;
}

.test.col-md-8.col-12.author-detail.author>h1 {
    font-size: 23px;
    font-family: 'Merriweather';
    font-weight: bold;
    color: #003366;
}

@media screen and (max-width: 767px) {
    .test.col-md-8.col-12.author-detail.author {
        overflow: auto;
    }
}

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
    .message-board-page .author-detail p:nth-child(2) {
        padding-bottom: 1px !important;
    }
}
</style>
<div class="container experts-detail-page message-board-page govering-board section-top">
    <div class="row">
        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>
        </div>
        <div class="test col-md-8 col-12 author-detail author">
            <div class="experts-page-title pb-3 mb-3">Organisations We Work With</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="bg-light-blue p-3">
                            <img src="<?php echo base_url(); ?>/uploads/cache/organizations/300px-seal_of_asean-4-300.png"
                                style="width:auto;height:54px;" alt="Association of Southeast Asian Nations">
                            <div class="upcoming-card-body bottom-0 pt-3 bg-light-blue">
                                <h5>Association of Southeast Asian Nations</h5>
                                <p class="odet">The Association of Southeast Asian Nations, or ASEAN, was established on
                                    8 August 1967 in Bangkok, Thailand, with the signing of the ASEAN Declaration
                                    (Bangkok Declaration) by the Founding Fathers of ASEAN, namely Indonesia, Malaysia,
                                    Philippines, Singapore and Thailand. Brunei Darussalam then joined on 7 January
                                    1984, Viet Nam on …</p>

                            </div>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <figure class="bg-light-blue p-3">
                            <img src="<?php echo base_url(); ?>/uploads/cache/organizations/aipa_300-4-300.png"
                                style="width:auto;height:54px;" alt="ASEAN Inter-Parliamentary Assembly">
                            <div class="upcoming-card-body bottom-0 pt-3 bg-light-blue">
                                <h5>ASEAN Inter-Parliamentary Assembly</h5>
                                <p class="odet">The ASEAN Inter-Parliamentary Assembly (AIPA) is a regional
                                    parliamentary organization. It was originally formed on September 2, 1977 as the
                                    ASEAN Inter-Parliamentary Organization (AIPO) by the leaders of the parliamentary
                                    delegations of Indonesia, Malaysia, the Philippines, Singapore and Thailand
                                    attending the Third ASEAN Inter-Parliamentary Conference in Manila, Philippines. In
                                    1995, …</p>

                            </div>
                        </figure>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <figure class="bg-light-blue p-3">
                            <img src="<?php echo base_url(); ?>/uploads/cache/organizations/oecd-logo1_300-4-300.png"
                                style="width:auto;height:54px;"
                                alt="Organisation for Economic Co-operation and Development">
                            <div class="upcoming-card-body bottom-0 pt-3 bg-light-blue">
                                <h5>Organisation for Economic Co-operation and Development</h5>
                                <p class="odet">The mission of the Organisation for Economic Co-operation and
                                    Development (OECD) is to promote policies that will improve the economic and social
                                    well-being of people around the world. The OECD provides a forum in which
                                    governments can work together to share experiences and seek solutions to common
                                    problems. We …</p>

                            </div>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <figure class="bg-light-blue p-3">
                            <img src="<?php echo base_url(); ?>/uploads/cache/organizations/iges-logo-4-300.jpg"
                                style="width:auto;height:54px;" alt="Institute for Global Environmental Strategies">
                            <div class="upcoming-card-body bottom-0 pt-3 bg-light-blue">
                                <h5>Institute for Global Environmental Strategies</h5>
                                <p class="odet">The Institute for Global Environmental Strategies (IGES) was established
                                    in March 1998 under an initiative of the Japanese government and with the support of
                                    Kanagawa Prefecture based on the “Charter for the Establishment of the Institute for
                                    Global Environmental Strategies”. The aim of the Institute is to achieve a new …</p>

                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>

        </article>
    </div>
</div>