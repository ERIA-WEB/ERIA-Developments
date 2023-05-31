<style>
/* ===---=== */

.arrow-active {
    position: absolute;
    cursor: pointer;
    top: 0;
    right: 0;
    padding: 17px 10px;
}

a.active.btn.py-3.text-left.w-100,
a.active.btn.py-3.text-left.w-100>span:hover {
    color: #fff;
}

.active {
    background-color: var(--primaryBlue);
    color: #fff;
}

table {
    width: 100% !important;
}

.sidebar-item-link {
    display: inline-block;
    font-weight: 500;
    font-size: 15px;
    padding: 0.8rem 1rem;
    width: 100%;
}

.sidebar-item-link:hover {
    text-decoration: none;
    background-color: #edf1f3
}

.sidebar-item-link.active {
    background-color: var(--primaryBlue);
    color: #fff;
}

.sidebar-item.active:hover {
    background-color: var(--primaryBlue);
}

.btn.sidebar-collapse-button:focus {
    box-shadow: none;
}

.btn.sidebar-collapse-button:hover {
    background-color: #edf1f3;
}

.btn.sidebar-collapse-button[aria-expanded="false"] .bi-chevron-right {
    transform: rotate(0deg);
    transition: all 0.3s ease-in-out;
}

.btn.sidebar-collapse-button[aria-expanded="true"] .bi-chevron-right {
    transform: rotate(90deg);
    transition: all 0.3s ease-in-out;
}

.btn.collapse-button[aria-expanded="false"] .bi-chevron-right {
    transform: rotate(0deg);
    transition: all 0.3s ease-in-out;
}

.btn.collapse-button[aria-expanded="true"] .bi-chevron-right {
    transform: rotate(90deg);
    transition: all 0.3s ease-in-out;
}

.sidebar-item.active a {
    color: #fff;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
    background-color: transparent;
}

/* Track */
.sidebar:hover::-webkit-scrollbar-track {
    background-color: transparent;
}

/* Handle */
.sidebar:hover::-webkit-scrollbar-thumb {
    background: #e5e5e5;
    height: 200px;
}

/* Handle on hover */
.sidebar:hover::-webkit-scrollbar-thumb:hover {
    background: #c1c1c1;
}

@media(min-width:768px) {
    .sidebar-item-link {
        padding: 1rem;
    }
}

/* ===---=== */
</style>
<div class="d-block d-md-none sidebar-mobile">
    <button class="btn third-button collapse-button w-100 d-flex justify-content-between align-items-center py-3"
        type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
        aria-controls="collapseExample">
        <span>Jump to section...</span>
        <i class="bi bi-chevron-right"></i>
    </button>
    <div class="collapse" id="collapseExample">
        <div class="card card-body px-2">
            <ul class="sidebar-items list-unstyled h-100">
                <?php 
                    $aboutus = $this->header->getPageAllAboutMenu();
                    $count_url = $this->uri->total_segments();
                    $last_url = $this->uri->segment($count_url);

                    foreach ($aboutus as $key => $value) {
                        if ($value->uri == $last_url) {
                            $active_first = 'active';
                            $color = 'color: #fff;';
                            
                        } else {
                            $active_first = '';
                            $color = '';
                        }
                        $submenu_aboutus = $this->header->getPageAllAboutSubMenu($value->page_id); 
                        
                        /*
                        ** Check url submenu same with last url/slug browser
                        */ 
                        foreach ($submenu_aboutus as $val) {
                            $checkurlsame_for_submenu[] = $val->uri;
                        }
                        /*
                        ** end
                        */ 
                        if (in_array($last_url, $checkurlsame_for_submenu)) {
                            $urlsubmenu_show = 'show';
                        } else {
                            $urlsubmenu_show = '';
                        }
                        echo '<li class="sidebar-item position-relative">';
                        if (!empty($submenu_aboutus)) {
                            echo '<a href="'.base_url() .'about-us/'. $value->uri.'" class="btn py-3 w-100 text-left '.$active_first.'">
                                <span>'.ucfirst($value->menu_title).'</span>
                                </a>
                                <button class="arrow-active sidebar-collapse-button justify-content-between bg-transparent border-0"
                                    data-toggle="collapse" data-target="#'.$key.'_Collapse" aria-expanded="false"
                                aria-controls="'.$key.'_Collapse" style="'.$color.'">
                                <i class="bi bi-chevron-right"></i>
                                </button>

                                <div class="collapse '.$urlsubmenu_show.'" id="'.$key.'_Collapse">
                                <div class="card card-body border-0 py-0 bg-light-blue">
                                    <ul>';
                                        foreach ($submenu_aboutus as $i => $submenu_aboutus) {

                                        if ($submenu_aboutus->uri == $last_url) {
                                            $active_ = 'active';
                                            $show = 'show';
                                        } else {
                                            $active_ = '';
                                            $show = '';
                                        }

                                        if ($submenu_aboutus->uri != 'contact-us') {
                                            $about_us = 'about-us/';
                                        } else {
                                            $about_us = '';
                                        }
                                        echo '<li>
                                            <a class="sidebar-item-link '.$active_.'"
                                                href="'.base_url(). $about_us .$submenu_aboutus->uri.'">'.ucfirst($submenu_aboutus->menu_title).'</a>
                                        </li>';
                                        }
                                        echo '</ul>
                                </div>
                        </div>';
                        } else {
                            echo '<a class="sidebar-item-link '.$active_first.'" href="'.base_url().'about-us/'.$value->uri.'">
                                    '.ucfirst($value->menu_title).'
                                    </a>';
                        }
                        echo '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</div>


<div class="d-none d-md-block sidebar bg-light-blue p-lg-4 sticky-top sticky-top pr-2" style="top:113px;">
    <ul class="sidebar-items list-unstyled h-100">
        <?php 
            $aboutus = $this->header->getPageAllAboutMenu();
            $count_url = $this->uri->total_segments();
            $last_url = $this->uri->segment($count_url);

            foreach ($aboutus as $key => $value) {
                if ($value->uri == $last_url) {
                    $active_first = 'active';
                    $color = 'color: #fff;';
                    
                } else {
                    $active_first = '';
                    $color = '';
                }
                $submenu_aboutus = $this->header->getPageAllAboutSubMenu($value->page_id); 
                
                /*
                ** Check url submenu same with last url/slug browser
                */ 
                foreach ($submenu_aboutus as $val) {
                    $checkurlsame_for_submenu[] = $val->uri;
                }
                /*
                ** end
                */ 

                if (!empty($submenu_aboutus)) {
                    echo '<li class="sidebar-item position-relative">';
                    if (in_array($last_url, $checkurlsame_for_submenu)) {
                        $urlsubmenu_show = 'show';
                    } else {
                        $urlsubmenu_show = '';
                    }

                    echo ' <a href="'.base_url().'about-us/'.$value->uri.'"
                                class="btn py-3 w-100 text-left '.$active_first.'">
                                <span>'.ucfirst($value->menu_title).'</span>
                            </a>
                            <button class="arrow-active sidebar-collapse-button justify-content-between bg-transparent border-0" data-toggle="collapse" data-target="#'.$key.'_Collapse" aria-expanded="false" aria-controls="'.$key.'_Collapse" style="'.$color.'">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                            <div class="collapse '.$urlsubmenu_show.'" id="'.$key.'_Collapse">
                                <div class="card card-body border-0 py-0 bg-light-blue">
                                    <ul>';
                                    foreach ($submenu_aboutus as $i => $submenu_aboutus) {
                                        
                                        if ($submenu_aboutus->uri == $last_url) {
                                            $active_ = 'active';
                                            $show = 'show';
                                        } else {
                                            $active_ = '';
                                            $show = '';
                                        }
                                        
                                        if ($submenu_aboutus->uri != 'contact-us') {
                                            $about_us = 'about-us/';
                                        } else {
                                            $about_us = '';
                                        }

                                        echo '<li>
                                                <a class="sidebar-item-link '.$active_.'" href="'.base_url().$about_us.$submenu_aboutus->uri.'">'.ucfirst($submenu_aboutus->menu_title).'</a>
                                            </li>';
                                    }
                                echo '</ul>
                                </div>
                            </div>';
                    echo '</li>';
                } else {
                    if ($value->uri != 'contact-us' ) {
                        $about_us = 'about-us/';
                    } else {
                        $about_us = '';
                    }
                    echo '<a class="sidebar-item-link '.$active_first.'"href="'.base_url().$about_us.$value->uri.'">
                            '.ucfirst($value->menu_title).'
                        </a>';
                }
            }
        ?>
    </ul>
</div>


<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    const path = window.location.href;
    // because the 'href' property of the DOM element is the absolute path
    $('.sidebar-item-link').each(function() {
        if (this.href === path) {
            $(this).addClass('active');
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    var scrollpos = sessionStorage.getItem('scrollpos');
    if (scrollpos) {
        window.scrollTo(0, scrollpos);
        sessionStorage.removeItem('scrollpos');
    }
});

window.addEventListener("beforeunload", function(e) {
    sessionStorage.setItem('scrollpos', window.scrollY);
});
</script>