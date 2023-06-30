<style>
#mobile-device-menu {
    transform: translate(-105%, 0);
    transition: width 2s;
}

.bg-mobile {
    background: #000000b8;
    position: fixed;
    top: 0;
    bottom: 0;
    z-index: 999999999;
    width: 100%;
}

.navbar-mobile {
    bottom: 0;
    background: #fff;
    z-index: 999999999;
    left: 0;
    top: 0;
    width: 100%;
    /*350px*/
}

#menuToggle {
    display: flex;
    flex-direction: column;
    position: relative;
    top: 0;
    left: 0;
    z-index: 1;
    -webkit-user-select: none;
    user-select: none;
}

#menuToggle input {
    display: flex;
    width: 40px;
    height: 32px;
    position: absolute;
    cursor: pointer;
    opacity: 1;
    z-index: 2;
}

#menu {
    position: fixed;
    box-shadow: 0 0 10px #85888c;
    padding: 20px;
    background-color: #fff;
    -webkit-font-smoothing: antialiased;
    transform-origin: 0% 0%;
    transform: translate(-105%, 0);
    transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
    overflow: auto;
}

#menuToggle:active~#menu:active {
    transform: translate(0%, 0);
}

.bg-white {
    background: #fff;
}

.font-14 {
    font-size: 14px;
}

.close-menu {
    position: absolute;
    right: 13px;
    top: 22px;
    background: transparent;
    border: none;
    z-index: 1;
}

.close-menu .fa.fa-times {
    font-size: 30px;
    color: rgba(0, 0, 0, 0.5);
}
</style>


<div class="navbar-mobile" id="menu">
    <button id="closeToggle" class="close-menu" type="button" onclick="clickCloseMenuMobileFunction()">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    <script>
    function clickCloseMenuMobileFunction() {
        $('#menu').css('transform', 'translate(-105%, 0)');
    }
    </script>
    <!--collapsibleNavbar-->
    <div class="row">
        <div class="col-md-12 pb-3">
            <a href="<?= base_url(); ?>">
                <img href="<?= base_url(); ?>" src="<?= base_url(); ?>v6/assets/logo.png" width="100px" alt="Logo">
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pb-3">
            <form action="<?= base_url(); ?>home/search" method="GET">

                <div class="row position-relative">
                    <div class="col-12">
                        <input type="text" id="mobile-Search-dropdown-input" class="form-control" placeholder="Search.."
                            name="msearch">
                    </div>
                    <div class="position-absolute" style="right: 13px;top: -1px;">
                        <button id="Search-button-dropdown" class="nav-item" type="submit" style="height: 54px;">
                            <i class="fa fa-search" style="font-size:19px"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="accordion" id="accordionMobile">
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingOneMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseOneMobile" aria-expanded="true"
                                aria-controls="collapseOneMobile">
                                RESEARCH AREAS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOneMobile" class="collapse" aria-labelledby="headingOneMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>research" class="p-1">
                                        All Research Areas
                                    </a>
                                </li>
                                <?php $menuPub = $this->header->get_menuTopic('topics', null); ?>
                                <?php foreach ($menuPub as $publicationtype) { ?>
                                <?php if ($publicationtype->published == 1) { ?>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>research/topic/<?= $publicationtype->uri ?>" class="p-1">
                                        <?= $publicationtype->category_name ?>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="car-header bg-white p-2">
                        <a href="<?= base_url() ?>programmes" class="btn btn-link btn-block text-left p-1 font-14">
                            PROGRAMMES
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingThreeMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseThreeMobile" aria-expanded="true"
                                aria-controls="collapseThreeMobile">
                                PUBLICATIONS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThreeMobile" class="collapse" aria-labelledby="headingThreeMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <?php
                                $publication_types = $this->header->getPublicationType('pubtypes');
                            ?>
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>publications" class="p-1">
                                        All Publications
                                    </a>
                                </li>
                                <?php
                                    foreach ($publication_types as $key => $value) {
                                        echo '<li style="padding: 10px;">
                                                <a href="'.base_url().'publications/category/'.$value->uri.'" class="p-1">
                                                    '.ucfirst($value->category_name).'
                                                </a>
                                            </li>';
                                    }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingFourMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseFourMobile" aria-expanded="true"
                                aria-controls="collapseFourMobile">
                                UPDATES
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFourMobile" class="collapse" aria-labelledby="headingFourMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <?php
                                $update_news_types = $this->header->getUpdatesNewsType('newscategories');
                            ?>
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>news-and-views" class="p-1">
                                        All Updates
                                    </a>
                                </li>
                                <?php
                                    foreach ($update_news_types as $key => $value) {
                                        echo '<li style="padding: 10px;">
                                                <a href="'.base_url().'news-and-views/category/'.$value->uri.'" class="p-1">
                                                    '.ucfirst($value->category_name).'
                                                </a>
                                            </li>';
                                    }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingFiveMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseFiveMobile" aria-expanded="true"
                                aria-controls="collapseFiveMobile">
                                EVENTS
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFiveMobile" class="collapse" aria-labelledby="headingFiveMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>events" class="p-1">
                                        All Events
                                    </a>
                                </li>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>events/browse/past" class="p-1">
                                        Past Events
                                    </a>
                                </li>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>events/browse/up" class="p-1">
                                        Upcoming Events
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingSixMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseSixMobile" aria-expanded="true"
                                aria-controls="collapseSixMobile">
                                MULTIMEDIA
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSixMobile" class="collapse" aria-labelledby="headingSixMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>multimedia" class="p-1">
                                        All Multimedia
                                    </a>
                                </li>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>multimedia/webinar" class="p-1">
                                        Webinars
                                    </a>
                                </li>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>multimedia/video" class="p-1">
                                        Videos
                                    </a>
                                </li>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>multimedia/podcasts" class="p-1">
                                        Podcasts
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingSevenMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseSevenMobile" aria-expanded="true"
                                aria-controls="collapseSevenMobile">
                                ABOUT US
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSevenMobile" class="collapse" aria-labelledby="headingSevenMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <?php
                            $aboutus = $this->header->getPageAllAboutPage();
                            
                            ?>
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>about-us" class="p-1">
                                        All
                                    </a>
                                </li>
                                <?php foreach ($aboutus as $key => $value) { ?>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>about-us/<?= $value->uri; ?>" class="p-1">
                                        <?= ucfirst($value->menu_title) ?>
                                    </a>

                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white p-2" id="headingEightMobile">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left dropdown-toggle p-1 font-14" type="button"
                                data-toggle="collapse" data-target="#collapseEightMobile" aria-expanded="true"
                                aria-controls="collapseEightMobile">
                                PEOPLE
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEightMobile" class="collapse" aria-labelledby="headingEightMobile"
                        data-parent="#accordionMobile">
                        <div class="card-body p-0">
                            <ul class="list-unstyled">
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>experts" class="p-1">
                                        All
                                    </a>
                                </li>
                                <?php
                                $category_people = $this->header->people_category_top_menu();
                                ?>
                                <?php foreach ($category_people as $people) { ?>
                                <?php if ($people->category != 'Unclassified') { ?>
                                <li style="padding: 10px;">
                                    <a href="<?= base_url() ?>experts?category=<?= $people->slug; ?>" class="p-1">
                                        <?= $people->category; ?>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="car-header bg-white p-2">
                        <a href="<?= base_url() ?>news/press-room" class="btn btn-link btn-block text-left p-1 font-14">
                            PRESS ROOM
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="car-header bg-white p-2">
                        <a href="<?= base_url() ?>contact" class="btn btn-link btn-block text-left p-1 font-14">
                            CONTACT US
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>