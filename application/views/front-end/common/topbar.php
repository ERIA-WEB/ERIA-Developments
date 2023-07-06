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
            <a href="<?= base_url() ?>" aria-label="Logo ERIA">
                <img loading="lazy" data-src="<?= base_url() ?>/v6/assets/eria-logo.svg"
                    src="<?= base_url() ?>/v6/assets/eria-logo-mobile.svg" alt="navbar-brand" class="img-fluid">
            </a>
            <button id="menuToggle" class="btn px-0" type="button" onclick="clickmenumobileFunction()"
                aria-label="Menu Mobile Page ERIA">
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
                    <a href="<?= base_url() ?>" aria-label="Logo ERIA">
                        <img loading="lazy" data-src="<?= base_url() ?>/v6/assets/eria-logo.svg"
                            src="<?= base_url() ?>/v6/assets/eria-logo.svg" alt="ERIA-Logo" class="eria-logo img-fluid">
                    </a>
                    <div id="logo-desc" class="logo-desc">Economic Research Institute<br />
                        for ASEAN and East Asia</div>
                </div>
                <div class="c-navbar-items">
                    <div class="c-navbar-top-item d-flex justify-content-end">
                        <div class="c-navbar-top-dropdown closed">
                            <a class="c-navbar-top-link" href="<?= base_url() ?>about-us" aria-label="About Us">About Us
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="ml-1 mb-1 bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a>
                            <?php
                            $aboutus = $this->header->getPageAllAboutPage();
                            ?>
                            <div class="dropdown-menu-container">
                                <ul class="dropdown-menu-items mb-0 list-unstyled">
                                    <?php 
                                    foreach ($aboutus as $key => $value) {
                                        echo '<li class="mb-3">
                                                <a href="'.base_url().'about-us/'.$value->uri.'" aria-label="'.$value->title.'">
                                                    '.$value->title.'
                                                </a>
                                            </li>';
                                    }
                                    ?>
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
                                                        <a href="'. base_url() .'about-us/'. $val->uri .'" aria-label="'.$val->menu_title.'">'. $val->menu_title .'</a>
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
                            <a class="c-navbar-top-link" href="<?= base_url() ?>experts"
                                aria-label="People ERIA">People<svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="ml-1 mb-1 bi bi-chevron-down"
                                    viewBox="0 0 16 16">
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
                                        <a href="<?= base_url() ?>experts?category=<?= $people->slug; ?>"
                                            aria-label="<?= $people->category; ?>"><?= $people->category; ?></a>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="c-navbar-top">
                            <a class="c-navbar-top-link" href="<?= base_url() ?>news/press-room"
                                aria-label="Press Room">Press Room</a>
                        </div>
                        <div class="c-navbar-top">
                            <a class="c-navbar-top-link last-child" href="<?= base_url() ?>contact-us"
                                aria-label="Contact ERIA">Contact</a>
                        </div>
                    </div>

                    <div class="c-navbar-bottom-item">
                        <div class="d-flex align-items-center">
                            <div class="d-flex">
                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>research"
                                        aria-label="Research Areas ERIA">Research Areas</a>
                                    <div class="mega-menu-container bg-transparent">
                                        <div class="mega-menu-items bg-white mt-2">
                                            <div class="container p-4">
                                                <div class="row">
                                                    <?php $menuPub = $this->header->get_menuTopic('topics', null); ?>
                                                    <?php foreach (array_slice($menuPub, 0, 29) as $key => $publicationtype) { ?>
                                                    <?php if ($publicationtype->published == 1 and $publicationtype->uri != 'call-for-proposals') { ?>
                                                    <div class="col-md-4 column">
                                                        <a class="w-100"
                                                            href="<?= base_url() ?>research/topic/<?= $publicationtype->uri ?>"
                                                            aria-label="<?= $publicationtype->category_name ?>">
                                                            <?= $publicationtype->category_name ?>
                                                        </a>
                                                    </div>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8 column d-block d-none"></div>
                                                    <div class="col-md-4 column">
                                                        <a class="w-100"
                                                            href="<?= base_url() ?>research/topic/call-for-proposals"
                                                            style="color: var(--primaryBlue);font-weight: bold;"
                                                            aria-label="Call for Proposals">Call
                                                            for Proposals
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mega-menu">
                                    <a class="nav-link" href="<?= base_url() ?>database-and-programmes"
                                        aria-label="Programmes ERIA">Programmes</a>
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
                                                            <?php 
                                                                $image_caching = $value->thumbnail_image;
                        
                                                                if (file_exists(FCPATH . $image_caching) == 1) {
                                                                    
                                                                    $img_prog = base_url().$image_caching;
                                                                    
                                                                } else {
                                                                    $url_programmes_home = "https://www.eria.org" . $value->image_name;
                                                                    $response_programmes_home = @get_headers($url_programmes_home, 1);
                                                                    $file_exists_programmes_home = (strpos($response_programmes_home[0], "404") === false);

                                                                    if ($file_exists_programmes_home == 1) {
                                                                        $img_prog = "https://www.eria.org" . $value->image_name;
                                                                    } else {
                                                                        $img_prog = base_url() . "/upload/thumbnails-pub.webp";
                                                                    }
                                                                }    
                                                                ?>
                                                            <div class="col-md-3">
                                                                <img loading="lazy" style="width: 100%;height: 65px;"
                                                                    data-src="<?= $img_prog; ?>"
                                                                    src="<?= $img_prog; ?>">
                                                                <div class="dropdown-item-heading">
                                                                    <a href="<?= base_url() ?>database-and-programmes/topic/<?= $value->uri ?>"
                                                                        class="nav_lnk"
                                                                        aria-label="<?= $value->category_name; ?>">
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
                                    <a class="nav-link" href="<?= base_url() ?>publications"
                                        aria-label="Publications ERIA">Publications</a>
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
                                                        <?php 
                                                        $image_caching_pub_featured = $pub->thumbnail_image;
                                                        
                                                        if (!empty($pub->thumbnail_image) && file_exists(FCPATH . $image_caching_pub_featured) == 1) {
                                                            $img_pub_featured = base_url().$image_caching_pub_featured;
                                                        } else {
                                                            if (!empty($pub->image_name)) {
                                                                if (file_exists(FCPATH . $pub->image_name)) {
                                                                    $image_temporary_pub_featured = '/caching' . $pub->image_name;
                                                                    
                                                                    if (file_exists(FCPATH . $image_temporary_pub_featured)) {
                                                                        $img_pub_featured = base_url().$image_temporary_pub_featured;
                                                                    } else {
                                                                        $img_pub_featured = base_url() .'get_compress_slider.php?im='. $pub->image_name;
                                                                    }
                                                                    
                                                                } else {
                                                                    $url_pub_featured = "https://www.eria.org" . $pub->image_name;
                                                                    $response_pub_featured = @get_headers($url_pub_featured, 1);
                                                                    $file_pub_featured = (strpos($response_pub_featured[0], "404") === false);

                                                                    if ($file_pub_featured == 1) {
                                                                        $img_pub_featured = "https://www.eria.org" . $pub->image_name;
                                                                    } else {
                                                                        $img_pub_featured = base_url() . "/upload/thumbnails-pub.webp";
                                                                    }
                                                                }
                                                            } else {
                                                                $img_pub_featured = base_url() . "/upload/thumbnails-pub.webp";
                                                            }
                                                        }
                                                        ?>
                                                        <img loading="lazy" class="img-fluid"
                                                            style="border: 1px solid #000;"
                                                            data-src="<?= $img_pub_featured ?>"
                                                            src="<?= $img_pub_featured ?>">
                                                        <div class="dropdown-item-header mb-2">
                                                            <?php //echo $m_publication[0]->tags ?>
                                                        </div>
                                                        <div class="dropdown-item-heading">
                                                            <a class="nav_lnk"
                                                                href="<?= base_url() ?>publications/<?= $pub->uri ?>"
                                                                aria-label="Publications Futured ERIA">
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
                                                                            echo '<a href="'.base_url().'publications/category/'.$value->uri.'" aria-label="'.ucfirst($value->category_name).'">'.ucfirst($value->category_name).'</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mega-menu-title">Latest Publications</h4>
                                                        <?php foreach (array_slice($m_publication, 0, 4) as $pub_latest) { ?>
                                                        <div class="row pb-4">
                                                            <div class="col-md-2">
                                                                <?php
                                                                    $image_caching_pub_latest = $pub_latest->thumbnail_image;
                                                        
                                                                    if (!empty($pub_latest->thumbnail_image) && file_exists(FCPATH . $image_caching_pub_latest) == 1) {
                                                                        $img_pub_latest = base_url().$image_caching_pub_latest;
                                                                    } else {
                                                                        if (file_exists(FCPATH . $pub_latest->image_name)) {
                                                                            $image_temporary_pub_latest = '/caching' . $pub->image_name;
                                                                            
                                                                            if (file_exists(FCPATH . $image_temporary_pub_latest)) {
                                                                                $img_pub_latest = base_url().$image_temporary_pub_latest;
                                                                            } else {
                                                                                $img_pub_latest = base_url() .'get_compress_slider.php?im='. $pub_latest->image_name;
                                                                            }
                                                                            
                                                                        } else {
                                                                            $url_pub_latest = "https://www.eria.org" . $pub_latest->image_name;
                                                                            $response_pub_latest = @get_headers($url_pub_latest, 1);
                                                                            $file_pub_latest = (strpos($response_pub_latest[0], "404") === false);

                                                                            if ($file_pub_latest == 1) {
                                                                                $img_pub_latest = "https://www.eria.org" . $pub_latest->image_name;
                                                                            } else {
                                                                                $img_pub_latest = base_url() . "/upload/thumbnails-pub.webp";
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                    echo '<img loading="lazy" class="img-fluid" style="border: 1px solid #000;" data-src="'.$img_pub_latest .'" src="'.$img_pub_latest .'">';
                                                                ?>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div
                                                                    class="dropdown-item-heading pt-0 d-flex flex-column">
                                                                    <a style="padding-top: 0px; margin-top: -5px;"
                                                                        href="<?= base_url() ?>publications/<?= $pub_latest->uri ?>"
                                                                        class="nav_lnk w-100"
                                                                        aria-label="<?= str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $pub_latest->title); ?>">
                                                                        <?= str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $pub_latest->title); ?>
                                                                    </a>
                                                                    <?php if (!empty($pub_latest->author)) { ?>
                                                                    <span style="color: #383a50;">Editor(s)/Author(s):
                                                                        <?= $pub_latest->author; ?></span>
                                                                    <?php } else { ?>
                                                                    <span style="color: #383a50;">Editor(s)/Author(s):
                                                                        <?= str_replace(',', ', ', $pub_latest->editor); ?></span>
                                                                    <?php } ?>
                                                                    <span
                                                                        style="color: #383a50;"><?= date('j F Y', strtotime($pub_latest->posted_date));  ?><span>
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
                                    <a class="nav-link" href="<?= base_url() ?>news-and-views"
                                        aria-label="News Updates ERIA">Updates</a>
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
                                                                            <a href="'.base_url().'news-and-views/category/'.$value->uri.'" class="w-100" aria-label="'.ucfirst($value->category_name).' ">
                                                                                '.ucfirst($value->category_name).' 
                                                                            </a>
                                                                        </li>';
                                                                    }
                                                                }
                                                            ?>
                                                            <li>
                                                                <a href="<?= base_url(); ?>news-and-views/category/all/call-for-proposals"
                                                                    class="w-100 text-blue font-weight-medium"
                                                                    aria-label="Call For Proposals">
                                                                    Call For Proposals
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h4 class="mega-menu-title">Featured News</h4>
                                                        <?php 
                                                        $image_caching = $up->thumbnail_image;
                                                        
                                                        if (!empty($up->thumbnail_image) && file_exists(FCPATH . $image_caching) == 1) {
                                                            $img_news_featured = base_url().$image_caching;
                                                        } else {
                                                            if (!empty($up->image_name)) {
                                                                if (file_exists(FCPATH . $up->image_name)) {
                                                                    $image_temporary = '/caching' . $up->image_name;
                                                                    
                                                                    if (file_exists(FCPATH . $image_temporary)) {
                                                                        $img_news_featured = base_url().$image_temporary;
                                                                    } else {
                                                                        $img_news_featured = base_url() .'get_compress_slider.php?im='. $up->image_name;
                                                                    }
                                                                    
                                                                } else {
                                                                    $url_news_home = "https://www.eria.org" . $up->image_name;
                                                                    $response_news_home = @get_headers($url_news_home, 1);
                                                                    $file_news_home = (strpos($response_news_home[0], "404") === false);

                                                                    if ($file_news_home == 1) {
                                                                        $img_news_featured = "https://www.eria.org" . $up->image_name;
                                                                    } else {
                                                                        $img_news_featured = base_url() . "/upload/news.webp";
                                                                    }
                                                                }
                                                            } else {
                                                                $img_news_featured = base_url() . "/upload/news.webp";
                                                            }
                                                        }
                                                        ?>
                                                        <img loading="lazy" class="img-fluid"
                                                            data-src="<?= $img_news_featured ?>"
                                                            src="<?= $img_news_featured ?>">
                                                        <div class="dropdown-item-header"><?= $up->tags ?></div>
                                                        <div class="dropdown-item-heading">
                                                            <a href="<?= base_url() ?>news-and-views/<?= $up->uri ?>"
                                                                class="nav_lnk"
                                                                aria-label="<?= substr($up->title, 0, 600) ?>">
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
                                                                            $image_caching = $value->thumbnail_image;
                        
                                                                            if (!empty($value->thumbnail_image) && file_exists(FCPATH . $image_caching)) {
                                                                                $img_news_menu = base_url().$image_caching;
                                                                            } else {
                                                                                if (!empty($value->image_name)) {
                                                                                    if (file_exists(FCPATH . $value->image_name)) {
                                                                                        $image_temporary = '/caching' . $value->image_name;
                                                                                        
                                                                                        if (file_exists(FCPATH . $image_temporary)) {
                                                                                            $img_news_menu = base_url().$image_temporary;
                                                                                        } else {
                                                                                            $img_news_menu = base_url() .'get_compress_slider.php?im='. $value->image_name;
                                                                                        }
                                                                                        
                                                                                    } else {
                                                                                        $url_news_home = "https://www.eria.org" . $value->image_name;
                                                                                        $response_news_home = @get_headers($url_news_home, 1);
                                                                                        $file_news_home = (strpos($response_news_home[0], "404") === false);

                                                                                        if ($file_news_home == 1) {
                                                                                            $img_news_menu = "https://www.eria.org" . $value->image_name;
                                                                                        } else {
                                                                                            $img_news_menu = base_url() . "/upload/news.webp";
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    $img_news_menu = base_url() . "/upload/news.webp";
                                                                                }
                                                                            }
                                                                            
                                                                            ?>

                                                                        <img loading="lazy" class="img-fluid"
                                                                            data-src=" <?= $img_news_menu; ?>"
                                                                            src=" <?= $img_news_menu; ?>">
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div
                                                                            class="dropdown-item-heading pt-0 d-flex flex-column">
                                                                            <a style="padding: 0px; margin-top: -5px;"
                                                                                href="<?= base_url() ?>news-and-views/<?= $value->uri ?>"
                                                                                class="nav_lnk w-100"
                                                                                aria-label="<?= str_replace(array('â€’','â€™', 'â€“', 'â€”', 'â€˜'), "'", $value->title); ?>">
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
                                    <a class="nav-link" href="<?= base_url() ?>events"
                                        aria-label="Events ERIA">Events</a>
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
                                                                        href="<?= base_url() ?>events/<?= $m_p_events->uri ?>"
                                                                        aria-label="<?= htmlspecialchars($m_p_events->title); ?>">
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
                                                        <a href="<?= base_url() ?>events"
                                                            aria-label="More Upcoming Events ERIA">
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
                                                                        href="<?= base_url() ?>events/<?= $m_p_events->uri ?>"
                                                                        aria-label="<?= str_replace(array('â€˜', 'â€™'), "", $m_p_events->title); ?>">
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
                                                        <a href="<?= base_url() ?>events"
                                                            aria-label="More Past Events ERIA">
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
                                                                            $img = base_url() . "upload/Event.webp";
                                                                        }
                                                                    } else {
                                                                        $img = base_url() . "upload/Event.webp";
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
                                                                            $img = base_url() . "upload/Event.webp";
                                                                        }
                                                                    } else {
                                                                        $img = base_url() . "upload/Event.webp";
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="event-videos-image overflow-hidden">
                                                                    <img loading="lazy" class="img-fluid h-100"
                                                                        data-src=" <?= $img ?>" src=" <?= $img ?>"
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
                                                                    href="<?= base_url() ?>events/<?= $me_vid[0]->uri ?>"
                                                                    aria-label="<?= limit_words(str_replace(array("â€˜", "â€™"), "", $me_vid[0]->title), 30)  ?>">
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
                                                                    <img loading="lazy" class="img-fluid h-100"
                                                                        data-src=" <?= $img ?>" src=" <?= $img ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div style="display: none"
                                                                    class="dropdown-item-header pt-0">
                                                                    <?= $me_vid[1]->tags ?> </div>
                                                                <?php if (!empty($me_vid[0]->content)) { ?>
                                                                <a style="margin-top: -5px; padding: 0px;"
                                                                    class="nav_lnk"
                                                                    href="<?= base_url() ?>events/<?= $me_vid[1]->uri ?>"
                                                                    aria-label="<?= limit_words($me_vid[1]->title, 30) ?>">
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
                                                                href="<?= base_url() ?>events/asia-europe-sustainable-connectivity-scientific-conference"
                                                                aria-label="Asia-Europe
                                                                Sustainable Connectivity Scientific Conference">Asia-Europe
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
                                    <a class="nav-link" href="<?= base_url() ?>multimedia"
                                        aria-label="Multimedia ERIA">Multimedia</a>
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
                                                        $image_caching = $mm->thumbnail_image;
                        
                                                        if (!empty($mm->thumbnail_image) && file_exists(FCPATH . $image_caching)) {
                                                            $img5 = base_url().$image_caching;
                                                        } else {
                                                            if (!empty($mm->image_name)) {
                                                                if (file_exists(FCPATH . $mm->image_name)) {
                                                                    $image_temporary5 = '/caching' . $mm->image_name;
                                                                    
                                                                    if (file_exists(FCPATH . $image_temporary5)) {
                                                                        $img5 = base_url().$image_temporary5;
                                                                    } else {
                                                                        $img5 = base_url() .'get_compress_slider.php?im='. $mm->image_name;
                                                                    }
                                                                    
                                                                } else {
                                                                    $url_multimedia_5 = "https://www.eria.org" . $mm->image_name;
                                                                    $response_multimedia_5 = @get_headers($url_multimedia_5, 1);
                                                                    $file_multimedia_5 = (strpos($response_multimedia_5[0], "404") === false);

                                                                    if ($file_multimedia_5 == 1) {
                                                                        $img5 = "https://www.eria.org" . $mm->image_name;
                                                                    } else {
                                                                        $img5 = base_url() . "/upload/news.webp";
                                                                    }
                                                                }
                                                            } else {
                                                                $img5 = base_url() . "/upload/news.webp";
                                                            }
                                                        }
                                                        
                                                        ?>
                                                        <img loading="lazy" class="img-fluid" data-src="<?= $img5; ?>"
                                                            src="<?= $img5; ?>">
                                                        <div class="dropdown-item-header mb-2">
                                                            <?php //echo ucfirst($mm->article_type); 
                                                            ?>
                                                        </div>
                                                        <div style="font-weight:bold" class="dropdown-item-heading">
                                                            <a class="nav_lnk"
                                                                href="<?= base_url() ?>multimedia/<?= strtolower($mm->category); ?>/<?= $mm->uri ?>"
                                                                aria-label="<?= limit_words($mm->title, 40); ?>">
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
                                                                <?php 
                                                                $image_caching_6 = $latestmultimedia->thumbnail_image;
                        
                                                                if (!empty($latestmultimedia->thumbnail_image) && file_exists(FCPATH . $image_caching_6)) {
                                                                    $img6 = base_url().$image_caching_6;
                                                                } else {
                                                                    if (!empty($latestmultimedia->image_name)) {
                                                                        if (file_exists(FCPATH . $latestmultimedia->image_name)) {
                                                                            $image_temporary5 = '/caching' . $latestmultimedia->image_name;
                                                                            
                                                                            if (file_exists(FCPATH . $image_temporary5)) {
                                                                                $img6 = base_url().$image_temporary5;
                                                                            } else {
                                                                                $img6 = base_url() .'get_compress_slider.php?im='. $latestmultimedia->image_name;
                                                                            }
                                                                            
                                                                        } else {
                                                                            $url_multimedia_5 = "https://www.eria.org" . $latestmultimedia->image_name;
                                                                            $response_multimedia_5 = @get_headers($url_multimedia_5, 1);
                                                                            $file_multimedia_5 = (strpos($response_multimedia_5[0], "404") === false);

                                                                            if ($file_multimedia_5 == 1) {
                                                                                $img6 = "https://www.eria.org" . $latestmultimedia->image_name;
                                                                            } else {
                                                                                $img6 = base_url() . "/upload/news.webp";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $img6 = base_url() . "/upload/news.webp";
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-5">
                                                                        <img loading="lazy" class="img-fluid"
                                                                            data-src="<?= $img6; ?>"
                                                                            src="<?= $img6; ?>">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div style="font-weight:bold"
                                                                            class="dropdown-item-heading pt-0">
                                                                            <a style="padding: 0px; margin-top: -5px;"
                                                                                class="nav_lnk"
                                                                                href="<?= base_url() ?>multimedia/<?= strtolower($latestmultimedia->category); ?>/<?= $latestmultimedia->uri ?>"
                                                                                aria-label="<?= limit_words($latestmultimedia->title, 40);  ?>">
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
                                                        <a href="<?= base_url() ?>multimedia/webinar"
                                                            aria-label="Webinars ERIA">Webinars</a>
                                                        <a href="<?= base_url() ?>multimedia/video"
                                                            aria-label="Videos ERIA">Videos</a>
                                                        <a href="<?= base_url() ?>multimedia/podcasts"
                                                            aria-label="Podcasts ERIA">Podcasts</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-action ml-2">
                                <button type="button" title="Search General ERIA" aria-label="Search General ERIA"
                                    class="btn c-navbar-search-button" data-toggle="modal" data-target="#searchModal"
                                    onclick="setFocusOnModal()" autocomplete>
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
                <form action="<?= base_url() ?>home/search" method="GET" class="d-flex">
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

<script src="<?= base_url(); ?>v6/js/topbar.min.js" async></script>