<style>
.profile-title {
    margin: 0 0 10px !important;
}

.btn.btn-danger {
    background: rgba(240, 80, 80, 1.0);
    color: #ffffff;
    padding: 4px 6px !important;
}

.fa-cog {
    display: none
}

#main-menu-wrapper li.open .sub-menu a {
    font-size: 13px;
}

#main-menu-wrapper {
    background: #0F3979;
}

.tab-content.primary {
    border: 0px solid;
    padding: 0px;
    background-color: #0F3979;
}

.page-sidebar.collapseit #main-menu-wrapper .wraplist {
    background: #0F3979;
}

#main-menu-wrapper li.open .sub-menu a.active,
#main-menu-wrapper li.open .sub-menu a:hover,
#main-menu-wrapper li .sub-menu a:hover {
    background-color: #20b5ab;
    color: #fff;
}

table.dataTable thead th,
table.dataTable thead td {
    background: #0F3979;
}

section header {
    background-color: #0F3979;
}

section .content-body {
    background-color: #fff;
    border: 0;
}
</style>

<?php

if (!isset($sactive))
    $sactive = null;

?>
<div class="page-sidebar collapseit " id="sde">
    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
        <!-- USER INFO - START -->
        <div style="border-bottom:solid 1px #20b5ab" class="profile-info row">
            <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                <?php if (isset($profile)) {
                    if ($profile->p_pic) { ?>
                <img src="<?php echo base_url() ?>resources/images/profile/<?php echo $profile->p_pic ?>"
                    alt="user-image" class="img-responsive img-circle" style="object-fit: cover;">
                <?php } else { ?>
                <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" class="img-responsive img-circle"
                    style="object-fit: cover;">
                <?php
                    }
                } else {
                    ?>
                <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" alt="user-image"
                    class="img-responsive img-circle" style="object-fit: cover;">
                <?php
                }
                ?>
            </div>
            <div class="profile-details col-md-8 col-sm-8 col-xs-8">
                <h3>
                    <a href="#" style="text-transform:capitalize">
                        <?php 
                        $user_data = $this->session->userdata('logged_in');
                        
                        if (isset($user_data)) {
                            echo $user_data['username'];
                        }
                        ?>
                    </a>
                    <span class="profile-status online"></span>
                </h3>
                <p class="profile-title">System User</p>
            </div>
        </div>
        <!-- USER INFO - END -->
        <div class="tab-content primary">
            <div class="tab-pane fade in active" id="home-1">
                <ul class='wraplist'>
                    <li class="<?php if ($active == 'dashboard') { ?> open <?php } ?>> ">
                        <a href=" <?php echo base_url() ?>system-content/Dashboard">
                            <i class="fa fa-dashboard"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if ($active == 'home') { ?> open <?php } ?>">
                        <a href="javascript:;">
                            <i class=" fa  fa-home" aria-hidden="true"></i>
                            <span class="title">Home</span>
                            <span class="arrow <?php if ($active == 'home') { ?> open <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'content') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Content" target=''> Manage Content </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'header') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Content/header" target=''> Header </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'footer') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Content/footer" target=''> Footer </a>
                            </li>
                            <li style="display:none">
                                <a class="<?php if ($sub == 'banner') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Content/banner" target=''> Banners </a>
                            </li>
                            <li style="display:none">
                                <a class="<?php if ($sub == 'social') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Content/social" target=''> Social Media
                                </a>
                            </li>
                            <li class=" <?php if ($sactive == 'slider') { ?> active open  <?php } ?> ">
                                <a class="<?php if ($sactive == 'slider') { ?> open active <?php } ?>"><span
                                        class="title "> Home Slider </span><span
                                        class="arrow <?php if ($sactive == 'slider') { ?> open <?php } ?> "></span></a>
                                <ul class="sub-menu" style="display: none;">
                                    <li> <a class="<?php if ($sub == 'add') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Slider" target=''>Add Slider
                                        </a> </li>
                                    <li>
                                        <a class=" <?php if ($sub == 'list') { ?> active <?php } ?> "
                                            href="<?php echo base_url() ?>system-content/Slider/listSlider"
                                            target=''>Manage Slider </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'rupd') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Mmenu/recent" target=''> Recent Updates
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'addc1') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Card/assignCard/1" target=''> Home page
                                    Card </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'about') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="title">About Us </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'acontent') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/About" target=''>
                                    <i class="fa fa-indent" aria-hidden="true"></i>
                                    Manage Content
                                </a>
                            </li>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'board') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/board" target=''>
                                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                        Board Messages
                                    </a>
                                </li>
                            </div>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'staff') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/staff" target=''>
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        Key Staffs
                                    </a>
                                </li>
                            </div>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'organization') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/organization" target=''>
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                        Organization
                                    </a>
                                </li>
                            </div>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'ostructure') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/ostructure" target=''>
                                        <i class="fa fa-circle-o" aria-hidden="true"></i>
                                        Organization Structure
                                    </a>
                                </li>
                            </div>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'gb') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/gb" target=''>
                                        <i class="fa fa-table" aria-hidden="true"></i>
                                        Governing Board
                                    </a>
                                </li>
                            </div>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'career') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/about/career" target=''>
                                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                                        Careers
                                    </a>
                                </li>
                            </div>
                            <li>
                                <a class="<?php if ($sub == 'lsubpage') { ?> active <?php } ?>" href="javascript:;">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    <span class="title"> Pages </span>
                                    <span class="arrow <?php if ($sactive == 'time') { ?>open active<?php } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="hidden">
                                        <a class="<?php if ($sub == 'subpage') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/about/subpage" target=''>
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                            Add Page
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'lsubpage') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/about/listpage" target=''>
                                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                                            List of Pages
                                        </a>
                                    </li>
                                    <li class="hidden">
                                        <a class="<?php if ($sub == 'subpagechild') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/about/subpagechild" target=''>
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                            Add Subpage
                                        </a>
                                    </li>
                                    <li class="hidden">
                                        <a class="<?php if ($sub == 'listsubpagechild') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/about/listsubpagechild"
                                            target=''>
                                            <i class="fa fa-lastfm-square" aria-hidden="true"></i>
                                            List of Subpages
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php if ($sactive == 'time') { ?>open active<?php } ?>">
                                <a class="<?php if ($sactive == 'time') { ?>active<?php } ?>" href="javascript:;">
                                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                                    <span class="title"> Timeline </span>
                                    <span class="arrow <?php if ($sactive == 'time') { ?>open active<?php } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a class="<?php if ($sub == 'addtime') { ?>active<?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Time" target=''> Add </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'timel') { ?>active<?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Time/add" target=''> List </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'experts') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-flask" aria-hidden="true"></i>
                            <span class="title"> Peoples </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'econtent') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/content" target=''> Manage
                                    Content </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'expertsc') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/catogeries" target=''> People
                                    Categories </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'expertssc') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/sub_catogeries" target=''>
                                    People Department </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'experts') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts" target=''> Add People </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'expertslist') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/expertlist" target=''> People
                                    List </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'research') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/research" target=''> Research
                                    Associates </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'researchlist') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Experts/researchlist" target=''> List
                                    of Research Associates </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'db') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-database" aria-hidden="true"></i>
                            <span class="title"> Programmes </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'dbcontent') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Programmes" target=''> Manage Content
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'dbcat') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Programmes/categories" target=''>
                                    Categories </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'dbscat') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Programmes/s_categories" target=''> Sub
                                    Categories </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'article') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Programmes/article" target=''> Create
                                    Article </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'articlel') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Programmes/a_list" target=''> Article
                                    List </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'news') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-bullhorn" aria-hidden="true"></i>
                            <span class="title"> News and Views </span><!-- Press Room -->
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'ncontent') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/content" target=''> Manage Content
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'ncat') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/categories" target=''> Categories
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'topics') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/topic" target=''> Topics </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'news') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News" target=''> News </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'newsl') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/listnews" target=''> News List
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'addc7') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Card/assignCard/7" target=''> Update
                                    page Card </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'mnews') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa  fa-file-video-o" aria-hidden="true"></i>
                            <span class="title"> Multimedia </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'mnews_c') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/mcat" target=''> Add Multimedia
                                    Category </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'mnews_sc') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/mscat" target=''> Add Multimedia
                                    Sub Category </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'mnews') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/multimedia" target=''> Add
                                    Multimedia News </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'mnewsl') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/News/listmnews" target=''> Multimedia
                                    List </a>
                            </li>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'addc8') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/Card/assignCard/8" target=''>
                                        Multimedia Inside page Card </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'research') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-info" aria-hidden="true"></i>
                            <span class="title">Research Areas & Publications </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="javascript:;">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span class="title"> Research Areas </span>
                                    <span class="arrow <?php if ($sactive == 'time') { ?>open active<?php } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a class="<?php if ($sub == 'rcontent') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/content" target=''>
                                            Manage Research Content
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'topic') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/topic" target=''>
                                            Topics
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'stopic') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/stopic" target=''>
                                            Sub Topics
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'addc2') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Card/assignCard/2" target=''>
                                            Page Card Research
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'addc3') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Card/assignCard/3" target=''>
                                            Page Card Research Topics
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="" href="javascript:;">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    <span class="title"> Publications </span>
                                    <span class="arrow <?php if ($sactive == 'time') { ?>open active<?php } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a class="<?php if ($sub == 'content') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Publications" target=''>
                                            Manage Publications Content
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'ptype') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/ptype" target=''>
                                            Publication Type
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'addlpublication') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/publication_slider"
                                            target=''>
                                            Add Slider Publications
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'listlpublication') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Research/listpublication_Slider"
                                            target=''>
                                            Slider Publications
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?php if ($sub == 'addc6') { ?> active <?php } ?>"
                                            href="<?php echo base_url() ?>system-content/Card/assignCard/6" target=''>
                                            Page Cards Publication Type
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'publication') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Research/publication" target=''>
                                    Add Research & Publications
                                </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'lpublication') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Research/listpublication" target=''>
                                    List of Research & Publications
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'events') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="title"> Events </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'evcontent') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Events/content" target=''> Manage
                                    Content </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'cat') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Events/categories" target=''>
                                    Categories </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'event') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Events" target=''> Add Events </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'eventl') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Events/listevent" target=''> Events
                                    List </a>
                            </li>

                        </ul>
                    </li>
                    <li class="<?php if ($active == 'privacy') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                            <span class="title">Privacy Policy </span>
                            <span
                                class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'content') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Policy" target=''> Manage Content </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'card') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="title"> Cards </span>
                            <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'addc') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/card/" target=''> Card List </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'random_card') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/card/randoms" target=''>
                                    Card Randoms
                                </a>
                            </li>
                            <div class="hidden">
                                <li>
                                    <a class="<?php if ($sub == 'addc4') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/Card/assignCard/4" target=''> Asean
                                        page Card </a>
                                </li>
                                <li>
                                    <a class="<?php if ($sub == 'addc5') { ?> active <?php } ?>"
                                        href="<?php echo base_url() ?>system-content/Card/assignCard/5" target=''> Asean
                                        Inside page Card </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'mmenu') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="title"> Mega menu </span>
                            <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'fe') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Mmenu" target=''> Featured </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                        $user_data = $this->session->userdata('logged_in');
                    ?>
                    <?php if ($user_data['user_id'] == 1) { ?>
                    <li class="<?php if ($active == 'admin') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                            <span class="title">Administration</span>
                            <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'index') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/user" target=''> Users </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'group') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/user/group" target=''> Groups </a>
                            </li>
                            <li>
                                <a class="<?php if ($sub == 'history') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/History" target=''> Logs </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if ($active == 'config') { ?> open <?php } ?> ">
                        <a href="javascript:;">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="title">Configurations and Verbiages </span>
                            <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="<?php if ($sub == 'indexc') { ?> active <?php } ?>"
                                    href="<?php echo base_url() ?>system-content/Configuration" target=''>
                                    Configurations </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- MAIN MENU - END -->
</div>
<script type="text/javascript">
function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September',
        'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    h = date.getHours();
    if (h < 10) {
        h = "0" + h;
    }
    m = date.getMinutes();
    if (m < 10) {
        m = "0" + m;
    }
    s = date.getSeconds();
    if (s < 10) {
        s = "0" + s;
    }
    result = ' ' + months[month] + ' ' + d + ' ' + year + ' ' + h + ':' + m + ':' + s;
    //result = ''+d+' '+h+':'+m+':'+s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("' + id + '");', '1000');
    return true;
}
</script>
<script type="text/javascript">
window.onload = date_time('date_time');
</script>