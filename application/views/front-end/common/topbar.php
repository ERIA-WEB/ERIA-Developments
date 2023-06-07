<?php
function limit_words($text, $limit)
{

    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '[...]';
    }
    return str_replace("â€™", "'", $text);
}
?>
<style>
#gtx-trans {
    display: none !important;
}
</style>

<header class="header fixed-top bg-white">
    <nav id="mobileNav" class="py-2 d-block d-lg-none">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>/v6/assets/eria-logo.svg" alt="navbar-brand" class="img-fluid"
                    style="height:35px">
            </a>
            <button id="menuToggle" class="btn px-0" type="button" onclick="clickmenumobileFunction()">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
        </div>
        <?php $this->load->view('front-end/common/menu-mobile'); ?>
    </nav>

    <nav id="desktopNav" class="c-navbar d-none d-lg-block">
        <div class="container">
            <div class="c-navbar-content d-flex justify-content-between align-items-center">
                <div class="c-navbar-brand overflow-hidden">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>/v6/assets/eria-logo.svg" alt="ERIA-Logo"
                            class="eria-logo img-fluid">
                    </a>
                    <div id="logo-desc" class="logo-desc">Economic Research Institute<br />
                        for ASEAN and East Asia</div>
                </div>
                <div class="c-navbar-items">
                    <div class="c-navbar-top-item d-flex justify-content-end">
                        <div class="c-navbar-top-dropdown closed">
                            <a class="c-navbar-top-link" href="<?= base_url() ?>about-us">About Us
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="ml-1 mb-1 bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a>
                            <?php
                            $aboutus = $this->header->getPageAllAboutMenu();
                            ?>
                            <div class="dropdown-menu-container">
                                <ul class="dropdown-menu-items mb-0 list-unstyled">
                                    <li class="mb-3">
                                        <a href="<?= base_url(); ?>about-us/history">
                                            History
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a href="<?= base_url(); ?>about-us/history" class="mb-2">
                                            Leadership and Staff
                                        </a>
                                        <ul class="mt-2" style="list-style-type: none;">
                                            <li class="mb-2">
                                                <a href="#">Organizational Structure</a>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">President’s Office</a>
                                                <ul class="mt-2" style="list-style-type: none;">
                                                    <li class="mb-2">
                                                        <a href="#">Message from the President</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">Governing Board</a>
                                                <ul class="mt-2" style="list-style-type: none;">
                                                    <li class="mb-2">
                                                        <a href="#">Messages from the Board</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">Academic Advisory Council</a>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">Experts</a>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">Key Staff</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mb-3">
                                        <a href="<?= base_url(); ?>about-us/networks" class="mb-2">
                                            Networks
                                        </a>
                                        <ul class="mt-2" style="list-style-type: none;">
                                            <li class="mb-2">
                                                <a href="#">Research Institutes Network</a>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">ERIN</a>
                                            </li>
                                            <li class="mb-2">
                                                <a href="#">Organization We Work With</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mb-3">
                                        <a href="<?= base_url(); ?>about-us/networks" class="mb-2">
                                            Career Opportunities
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a href="<?= base_url(); ?>about-us/networks" class="mb-2">
                                            Logo Standards Use
                                        </a>
                                    </li>
                                </ul>
                                <ul class="dropdown-menu-items mb-0 list-unstyled d-none">
                                    <?php foreach ($aboutus as $key => $value) { ?>
                                    <?php $submenu_aboutus = $this->header->getPageAllAboutSubMenu($value->page_id); ?>
                                    <li <?php if (count($submenu_aboutus) == 0) { echo 'class="mb-3"'; } ?>>
                                        <a
                                            href="<?= base_url() ?>about-us/<?= $value->uri; ?>"><?= ucfirst($value->menu_title) ?></a>
                                        <?php if (!empty($submenu_aboutus)) { ?>
                                        <ul
                                            style="padding: 10px 20px;font-size: 14px;font-weight: 500;color: var(--primaryBlue);">
                                            <?php
                                                foreach ($submenu_aboutus as $i => $val) {
                                                    echo '<li>
                                                        <a href="'. base_url() .'about-us/'. $val->uri .'">'. $val->menu_title .'</a>
                                                    </li>';
                                                }
                                            ?>
                                        </ul>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                        <div class="c-navbar-top-dropdown closed">
                            <a class="c-navbar-top-link" href="<?= base_url() ?>experts">People<svg
                                    xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="ml-1 mb-1 bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a>
                            <div class="dropdown-menu-container people">
                                <?php
                                $category_people = $this->header->people_category_top_menu();
                                ?>
                                <ul class="dropdown-menu-items list-unstyled">
                                    <?php foreach ($category_people as $people) { ?>
                                    <?php if ($people->category != 'Unclassified') { ?>
                                    <li class="mb-3">
                                        <a
                                            href="<?= base_url() ?>experts?category=<?= $people->slug; ?>"><?= $people->category; ?></a>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="c-navbar-top">
                            <a class="c-navbar-top-link" href="<?= base_url() ?>news/press-room">Press Room</a>
                        </div>
                        <div class="c-navbar-top">
                            <a class="c-navbar-top-link last-child" href="<?= base_url() ?>contact-us">Contact</a>
                        </div>
                    </div>

                    <div class="c-navbar-bottom-item">
                        <div class="d-flex align-items-center">
                            <div class="d-flex">
                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>research">Research Areas</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <div class="row">
                                                    <?php $menuPub = $this->header->get_menuTopic('topics', null); ?>
                                                    <?php foreach (array_slice($menuPub, 0, 29) as $key => $publicationtype) { ?>
                                                    <?php if ($publicationtype->published == 1 and $publicationtype->uri != 'call-for-proposals') { ?>
                                                    <div class="col-md-4 column">
                                                        <a class="w-100"
                                                            href="<?= base_url() ?>research/topic/<?= $publicationtype->uri ?>">
                                                            <?= $publicationtype->category_name ?></a>
                                                    </div>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8 column d-block d-none"></div>
                                                    <div class="col-md-4 column">
                                                        <a class="w-100"
                                                            href="<?= base_url() ?>research/topic/call-for-proposals"
                                                            style="color: var(--primaryBlue);font-weight: bold;">Call
                                                            for Proposals
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>database-and-programmes">Programmes</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h4 class="mega-menu-title">Programmes</h4>
                                                        <p>
                                                            As a leading international research organization, ERIA is
                                                            actively conducting quality research on numerous issues.
                                                            With its partnership network of organizations and strong
                                                            relations with governments in the region, ERIA is well
                                                            positioned to support regional initiatives for sustainable
                                                            growth and quality of life for the people in ASEAN and East
                                                            Asia
                                                        </p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?php
                                                        $m_asean = $this->header->get_menu_asean();

                                                        $asean = $this->header->get_menucatogery('categories');
                                                        ?>
                                                        <h4 class="mega-menu-title">Featured</h4>
                                                        <div class="row">
                                                            <?php foreach ($asean as $key => $value) { ?>
                                                            <div class="col-md-3">
                                                                <img style="width: 100%;height: 65px;"
                                                                    src="<?= base_url() ?><?= $value->image_name; ?>">
                                                                <div class="dropdown-item-heading">
                                                                    <a href="<?= base_url() ?>database-and-programmes/topic/<?= $value->uri ?>"
                                                                        class="nav_lnk">
                                                                        <?php
                                                                            echo $value->category_name;
                                                                        ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>publications">Publications</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <?php
                                                $m_publication = $this->header->get_menuArticle('publications');
                                                $pub = $this->header->getFeature('pub');
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h4 class="mega-menu-title">Featured Publication</h4>
                                                        <img class="img-fluid" style="border: 1px solid #000;"
                                                            src="<?= base_url() ?><?= $pub->image_name ?>">
                                                        <div class="dropdown-item-header mb-2">
                                                            <?php //echo $m_publication[0]->tags ?>
                                                        </div>
                                                        <div class="dropdown-item-heading">
                                                            <a class="nav_lnk"
                                                                href="<?= base_url() ?>publications/<?= $pub->uri ?>">
                                                                <?= limit_words($pub->title, 30) ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h4 class="mega-menu-title">Publications</h4>
                                                        <div class="row">
                                                            <?php
                                                                $publication_types = $this->header->getPublicationType('pubtypes');
                                                            ?>
                                                            <div class="col-md-12 column">
                                                                <?php
                                                                    foreach ($publication_types as $key => $value) {
                                                                        if ($value->uri != 'co-publications-routledge' AND $value->uri != 'co-publications-springer' AND $value->uri != 'east-asia-updates') {
                                                                            echo '<a href="'.base_url().'publications/category/'.$value->uri.'">'.ucfirst($value->category_name).'</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mega-menu-title">Latest Publications</h4>
                                                        <?php foreach (array_slice($m_publication, 0, 4) as $publication_) { ?>
                                                        <div class="row pb-4">
                                                            <div class="col-md-2">
                                                                <?php
                                                                    
                                                                    if (!empty($publication_->image_name)) {
                                                                        if (file_exists(FCPATH . $publication_->image_name) && $publication_->image_name != '') {
                                                                            $img = base_url() . $publication_->image_name;
                                                                        } elseif (file_exists(FCPATH . '/resources/images' . $publication_->image_name) && $publication_->image_name != '') {
                                                                            $img = base_url() . 'resources/images' . $publication_->image_name;
                                                                        } else {
                                                                            $url_pub = "https://www.eria.org" . $publication_->image_name;
                                                                            $response_pub = @get_headers($url_pub, 1);
                                                                            $file_exists_pub = (strpos($response_pub[0], "404") === false);

                                                                            if ($file_exists_pub == 1) {
                                                                                $img = "https://www.eria.org" . $publication_->image_name;
                                                                            } else {
                                                                                $img = base_url() . "/upload/thumbnails-pub.jpg";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $url_pub = "https://www.eria.org" . $publication_->image_name;
                                                                        $response_pub = @get_headers($url_pub, 1);
                                                                        $file_exists_pub = (strpos($response_pub[0], "404") === false);
                                                                        
                                                                        if ($file_exists_pub == 1) {
                                                                            $img = "https://www.eria.org" . $publication_->image_name;
                                                                            if (file_exists($img)) {
                                                                                $img = $img;
                                                                            } else {
                                                                                $img = base_url() . "/upload/thumbnails-pub.jpg";
                                                                            }
                                                                            
                                                                        } else {
                                                                            $img = base_url() . "/upload/thumbnails-pub.jpg";
                                                                        }
                                                                    }
                                                                    
                                                                    echo '<img class="img-fluid" style="border: 1px solid #000;" src="'.$img .'">';
                                                                ?>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div
                                                                    class="dropdown-item-heading pt-0 d-flex flex-column">
                                                                    <a style="padding-top: 0px; margin-top: -5px;"
                                                                        href="<?= base_url() ?>publications/<?= $publication_->uri ?>"
                                                                        class="nav_lnk w-100">
                                                                        <?= str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $publication_->title); ?>
                                                                    </a>
                                                                    <?php if (!empty($publication_->author)) { ?>
                                                                    <span style="color: #383a50;">Editor(s)/Author(s):
                                                                        <?= $publication_->author; ?></span>
                                                                    <?php } else { ?>
                                                                    <span style="color: #383a50;">Editor(s)/Author(s):
                                                                        <?= str_replace(',', ', ', $publication_->editor); ?></span>
                                                                    <?php } ?>
                                                                    <span
                                                                        style="color: #383a50;"><?= date('j F Y', strtotime($publication_->posted_date));  ?><span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>news-and-views">Updates</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <?php
                                                $m_news = $this->header->get_menuArticle('news');
                                                $up = $this->header->getFeature('updates');
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-2 d-flex flex-column">
                                                        <h4 class="mega-menu-title">Recent Updates</h4>
                                                        <?php
                                                            $update_news_types = $this->header->getUpdatesNewsType('newscategories');
                                                        ?>
                                                        <ul class="list-unstyled d-flex flex-column h-100">
                                                            <?php
                                                                foreach ($update_news_types as $key => $value) {
                                                                    if ($value->uri != 'multimedia') {
                                                                        echo '<li>
                                                                            <a href="'.base_url().'news-and-views/category/'.$value->uri.'" class="w-100">
                                                                                '.ucfirst($value->category_name).' 
                                                                            </a>
                                                                        </li>';
                                                                    }
                                                                }
                                                            ?>
                                                            <li>
                                                                <a href="<?= base_url(); ?>news-and-views/category/all/call-for-proposals"
                                                                    class="w-100 text-blue font-weight-medium">
                                                                    Call For Proposals
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h4 class="mega-menu-title">Featured News</h4>
                                                        <img class="img-fluid"
                                                            src="<?= base_url() ?><?= $up->image_name ?>">
                                                        <div class="dropdown-item-header"><?= $up->tags ?></div>
                                                        <div class="dropdown-item-heading">
                                                            <a href="<?= base_url() ?>news-and-views/<?= $up->uri ?>"
                                                                style=" " class="nav_lnk">
                                                                <?= substr($up->title, 0, 600) ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <h4 class="mega-menu-title">Latest News & Opinions</h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php foreach ($m_news as $key => $value) { ?>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <?php
                                                                            if (file_exists(FCPATH . $value->image_name) && $value->image_name != '') {
                                                                                $img = base_url() . $value->image_name;
                                                                            } elseif (file_exists(FCPATH . '/resources/images' . $value->image_name) && $value->image_name != '') {
                                                                                $img = base_url() . 'resources/images' . $value->image_name;
                                                                            } else {
                                                                                if (!empty($value->image_name)) {
                                                                                    $url_articles = "https://www.eria.org" . $value->image_name;
                                                                                    $response_articles = @file_get_contents($url_articles);
                                                                                    if (strlen($response_articles)) {
                                                                                        $img = "https://www.eria.org" . $value->image_name;
                                                                                    } else {
                                                                                        $img = base_url() . "/upload/news.jpg";
                                                                                    }
                                                                                } else {
                                                                                    $img = base_url() . "/upload/news.jpg";
                                                                                }
                                                                            }
                                                                            ?>

                                                                        <img class="img-fluid" src=" <?= $img; ?>">
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="dropdown-item-heading pt-0 d-flex flex-column">
                                                                            <a style="padding: 0px; margin-top: -5px;"
                                                                                href="<?= base_url() ?>news-and-views/<?= $value->uri ?>"
                                                                                class="nav_lnk w-100">
                                                                                <?= str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $value->title); ?>
                                                                            </a>
                                                                            <span style="color: #383a50;">
                                                                                <?php
                                                                                    if (!empty($value->author) || !empty($value->editor)) {
                                                                                        
                                                                                        $authors = explode(', ', $value->author);
                                                                                        $editors = explode(', ', $value->editor);

                                                                                        $mergingAuthorEditor = array_merge($authors, $editors);
                                                                                        
                                                                                        for ($i=0; $i <count($mergingAuthorEditor); $i++) { 
                                                                                            if (!empty($mergingAuthorEditor[$i])) {
                                                                                                $peoples_[$i] = $mergingAuthorEditor[$i];
                                                                                            }
                                                                                        }

                                                                                        echo implode(', ', $peoples_);
                                                                                    } else {
                                                                                        echo '';
                                                                                    }
                                                                                    ?>
                                                                            </span>

                                                                            <span
                                                                                style="color: #383a50;"><?= date('j F Y', strtotime($value->posted_date));  ?><span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>events">Events</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <?php $m_p_events = $this->header->get_menuEvents('future', 6); ?>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <?php if (!empty($m_p_events) AND isset($m_p_events)) { ?>
                                                        <h4 class="mega-menu-title">Upcoming Events</h4>
                                                        <table width="100%">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Event</th>
                                                            </tr>
                                                            <?php $m = 0; ?>
                                                            <?php foreach ($m_p_events as $m_p_events) { ?>
                                                            <?php $m++; ?>
                                                            <?php 
                                                                    if ($m % 2 == 0) {
                                                                        $highlight_row = "highlight-row";
                                                                    } else {
                                                                        $highlight_row = '';
                                                                    } 
                                                                ?>
                                                            <tr class="<?= $highlight_row; ?> align-top">
                                                                <td style="font-size: 12px;">
                                                                    <?= date('j F Y', strtotime($m_p_events->start_date));  ?>
                                                                </td>
                                                                <td class="text-blue">
                                                                    <?php if (!empty($m_p_events->content)) { ?>
                                                                    <a class="nav_lnk font-weight-normal"
                                                                        href="<?= base_url() ?>events/<?= $m_p_events->uri ?>">
                                                                        <?= htmlspecialchars($m_p_events->title); ?>
                                                                    </a>
                                                                    <?php } else { ?>
                                                                    <span
                                                                        style="font-size: 12px;"><?= htmlspecialchars($m_p_events->title); ?>
                                                                    </span>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>
                                                        <a href="<?= base_url() ?>events">
                                                            <h6 class="mt-4 border-0">More Upcoming Events <svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="12"
                                                                    height="12" fill="currentColor"
                                                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                                                </svg>
                                                            </h6>
                                                        </a>
                                                        <?php } else { ?>
                                                        <h4 class="mega-menu-title">Past Events</h4>
                                                        <?php $m_p_events = $this->header->get_menuEvents('past', 3); ?>
                                                        <table width="100%">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th class="pl-2">Event</th>
                                                            </tr>
                                                            <?php $m = 0;
                                                            foreach ($m_p_events as $m_p_events) {
                                                                $m++;   ?>
                                                            <tr class="<?php if ($m % 2 == 0) {
                                                                                echo "highlight-row";
                                                                            }   ?> align-top">
                                                                <td class="pr-2" style="font-size: 12px;">
                                                                    <?= date('j F Y', strtotime($m_p_events->start_date));  ?>
                                                                </td>
                                                                <td class="text-blue pl-2">
                                                                    <?php if (!empty($m_p_events->content)) { ?>
                                                                    <a style="font-size: 12px;" class="text-blue"
                                                                        href="<?= base_url() ?>events/<?= $m_p_events->uri ?>">
                                                                        <?= str_replace(array('â€˜', 'â€™'), "", $m_p_events->title); ?>
                                                                    </a>
                                                                    <?php } else { ?>
                                                                    <span
                                                                        style="font-size:12px;"><?= str_replace(array('â€˜', 'â€™'), "", $m_p_events->title); ?></span>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>
                                                        <a href="<?= base_url() ?>events">
                                                            <h6 class="mt-4 border-0">More Past Events <svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="12"
                                                                    height="12" fill="currentColor"
                                                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                                                </svg>
                                                            </h6>

                                                        </a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php
                                                        $me_vid = $this->header->get_menuV_Event();
                                                        ?>
                                                        <h4 class="mega-menu-title">Event Videos</h4>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <?php

                                                                if (file_exists(FCPATH . $me_vid[0]->image_name) && $me_vid[0]->image_name != '') {
                                                                    $img = base_url() . $me_vid[0]->image_name;
                                                                } else {
                                                                    $url_video = "https://www.eria.org" . $me_vid[0]->image_name;
                                                                    $get_headers = @get_headers($url_video, 1);
                                                                    if (!$get_headers) {
                                                                        $file_exists_video == 0;
                                                                    } else {
                                                                        $response_video = $get_headers;
                                                                        $file_exists_video = (strpos($response_video[0], "404") === false);
                                                                    }

                                                                    if ($file_exists_video == 1) {
                                                                        if (!empty($me_vid[0]->image_name)) {
                                                                            $img = "https://www.eria.org" . $me_vid[0]->image_name;
                                                                        } else {
                                                                            $img = base_url() . "upload/Event.jpg";
                                                                        }
                                                                    } else {
                                                                        $img = base_url() . "upload/Event.jpg";
                                                                    }
                                                                }
                                                                ?>
                                                                <?php
                                                                if (file_exists(FCPATH . $me_vid[1]->image_name) && $me_vid[1]->image_name != '') {
                                                                    $img = base_url() . $me_vid[1]->image_name;
                                                                } else {
                                                                    $url_video2 = "https://www.eria.org" . $me_vid[1]->image_name;
                                                                    $get_headers = @get_headers($url_video2, 1);
                                                                    if (!$get_headers) {
                                                                        $file_exists_video2 == 0;
                                                                    } else {
                                                                        $response_video2 = $get_headers;
                                                                        $file_exists_video2 = (strpos($response_video2[0], "404") === false);
                                                                    }

                                                                    if ($file_exists_video2 == 1) {
                                                                        if (!empty($me_vid[1]->image_name)) {
                                                                            $img = "https://www.eria.org" . $me_vid[1]->image_name;
                                                                        } else {
                                                                            $img = base_url() . "upload/Event.jpg";
                                                                        }
                                                                    } else {
                                                                        $img = base_url() . "upload/Event.jpg";
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="event-videos-image overflow-hidden">
                                                                    <img class="img-fluid h-100" src=" <?= $img ?>"
                                                                        style="background-color: var(--primaryBlue);">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div style="display: none"
                                                                    class="dropdown-item-header pt-0">
                                                                    <?= $me_vid[0]->tags ?></div>
                                                                <?php if (!empty($me_vid[0]->content)) { ?>
                                                                <a style="margin-top: -5px; padding: 0px;"
                                                                    class="nav_lnk"
                                                                    href="<?= base_url() ?>events/<?= $me_vid[0]->uri ?>">
                                                                    <div class="dropdown-item-heading">
                                                                        <?= limit_words(str_replace(array("â€˜", "â€™"), "", $me_vid[0]->title), 30)  ?>
                                                                    </div>
                                                                </a>
                                                                <?php } else { ?>
                                                                <div class="dropdown-item-heading">
                                                                    <?= limit_words(str_replace(array("â€˜", "â€™"), "", $me_vid[0]->title), 30)  ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row pt-3">
                                                            <div class="col-md-5">
                                                                <div class="event-videos-image overflow-hidden">
                                                                    <img class="img-fluid h-100" src=" <?= $img ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div style="display: none"
                                                                    class="dropdown-item-header pt-0">
                                                                    <?= $me_vid[1]->tags ?> </div>
                                                                <?php if (!empty($me_vid[0]->content)) { ?>
                                                                <a style="margin-top: -5px; padding: 0px;"
                                                                    class="nav_lnk"
                                                                    href="<?= base_url() ?>events/<?= $me_vid[1]->uri ?>">
                                                                    <div class="dropdown-item-heading">
                                                                        <?= limit_words($me_vid[1]->title, 30) ?>
                                                                    </div>
                                                                </a>
                                                                <?php } else { ?>
                                                                <div class="dropdown-item-heading">
                                                                    <?= limit_words($me_vid[1]->title, 30) ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <h4 class="mt-5 mega-menu-title">Event Reports</h4>
                                                        <div class="text-blue">
                                                            <a class="nav_lnk"
                                                                href="<?= base_url() ?>events/asia-europe-sustainable-connectivity-scientific-conference">Asia-Europe
                                                                Sustainable Connectivity Scientific Conference</a>
                                                        </div>
                                                        <p class="date text-secondary">12 August 2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>multimedia">Multimedia</a>
                                    <?php
                                    $mdata = $this->header->get_menu_latest_multimedia(178); // get_menuMultimedia
                                    $mm = $this->header->getFeatureMultimedia('multimedia'); // getFeature 
                                    ?>
                                    <div class="mega-menu-container bg-transparent">
                                        <?php if (isset($mm) OR isset($mdata)) { ?>
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <div class="row">
                                                    <?php if (isset($mm)) { ?>
                                                    <div class="col-md-3">
                                                        <h4 class="mega-menu-title">Featured Video</h4>
                                                        <?php
                                                        if (file_exists(FCPATH . $mm->image_name)) {
                                                            $img5 = base_url() . $mm->image_name;
                                                        } else if ($mm->image_name == '') {
                                                            $img5 = base_url() . "upload/Video.jpg";
                                                        } else if ("https://www.eria.org/" . $mm->image_name) {
                                                            $img5 = "https://www.eria.org/" . $mm->image_name;
                                                        } else {
                                                            $img5 = base_url() . "upload/Video.jpg";
                                                        }
                                                        ?>
                                                        <img class="img-fluid" src="<?= $img5; ?>">
                                                        <div class="dropdown-item-header mb-2">
                                                            <?php //echo ucfirst($mm->article_type); 
                                                            ?>
                                                        </div>
                                                        <div style="font-weight:bold" class="dropdown-item-heading">
                                                            <a class="nav_lnk"
                                                                href="<?= base_url() ?>multimedia/<?= strtolower($mm->category); ?>/<?= $mm->uri ?>">
                                                                <?= limit_words($mm->title, 40); ?>
                                                                <!--NewsMultimedia-->
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if (!empty($mdata)) { ?>
                                                    <div class="col-md-8">
                                                        <h4 class="mega-menu-title">Latest Multimedia</h4>
                                                        <div class="row">
                                                            <?php foreach (array_slice($mdata, 0, 6) as $latestmultimedia) { ?>
                                                            <div class="col-md-6">

                                                                <div class="row mb-3">
                                                                    <div class="col-md-5">
                                                                        <img class="img-fluid"
                                                                            src="<?= base_url() ?><?= $latestmultimedia->image_name ? $latestmultimedia->image_name: "upload/Video.jpg"; ?>">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div style="font-weight:bold"
                                                                            class="dropdown-item-heading pt-0">
                                                                            <a style="padding: 0px; margin-top: -5px;"
                                                                                class="nav_lnk"
                                                                                href="<?= base_url() ?>multimedia/<?= strtolower($latestmultimedia->category); ?>/<?= $latestmultimedia->uri ?>">
                                                                                <!--NewsMultimedia-->
                                                                                <?= limit_words($latestmultimedia->title, 40);  ?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-1">
                                                        <h4 class="mega-menu-title">Multimedia</h4>
                                                        <a href="<?= base_url() ?>multimedia/webinar">Webinars</a>
                                                        <a href="<?= base_url() ?>multimedia/video">Videos</a>
                                                        <a href="<?= base_url() ?>multimedia/podcasts">Podcasts</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-action ml-2">
                                <button type="button" class="btn c-navbar-search-button" data-toggle="modal"
                                    data-target="#searchModal" onclick="setFocusOnModal()" autoco>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-4">
                <form action="<?php echo base_url() ?>home/search" method="GET" class="d-flex">
                    <input class="form-control mr-sm-2 searchbar-input w-100" type="search" placeholder="Search"
                        name="msearch" id="searchBarInput" aria-label="Search" autofocus>
                    <button class="btn third-button d-flex align-items-center px-4" id="show" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search mr-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        <span class="go">Search</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function setFocusOnModal() {
    $('#searchModal').on('shown.bs.modal', function() {
        $('#searchBarInput').focus();
    });
}
</script>

<script>
// On Navbar Scroll
const onScroll = document.getElementById("desktopNav");
window.addEventListener("scroll", () => {
    if (window.scrollY < 500) {
        onScroll.classList.remove("scrolled");
    } else {
        onScroll.classList.add("scrolled");
    }
});
// End of Nabvar Scroll


// Dropdown on Hover
let dropdowns = document.querySelectorAll('.c-navbar-top-dropdown')

dropdowns.forEach((dropdown) => {
    dropdown.addEventListener('mouseenter', (e) => {
        if (dropdown.classList.contains('closed')) {
            dropdown.classList.remove('closed')
        }
    })
    dropdown.addEventListener('mouseleave', (e) => {
        if (!dropdown.classList.contains('closed')) {
            dropdown.classList.add('closed')
        }
    })
})
// End of Dropdown on Hover

// Mega Menu
const megaMenus = document.querySelectorAll('.mega-menu')

megaMenus.forEach((megaMenu) => {
    megaMenu.addEventListener('mouseenter', (e) => {
        megaMenu.classList.add('showed')
        // if (megaMenu.classList.contains('showed')) {
        //     megaMenu.classList.remove('showed')
        // }
    })
    megaMenu.addEventListener('mouseleave', (e) => {
        megaMenu.classList.remove('showed')
        // if (!megaMenu.classList.contains('showed')) {
        //     megaMenu.classList.add('showed')
        // }
    })
})
// End of Mega Menu
</script>

<script>
function clickmenumobileFunction() {
    $('#menu').css('transform', 'translate(0%, 0)');
}
</script>