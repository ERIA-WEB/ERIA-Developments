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
                        <img src="<?php echo base_url() ?>resources/images/profile/<?php echo $profile->p_pic ?>" alt="user-image" class="img-responsive img-circle" style="object-fit: cover;">
                    <?php } else { ?>
                        <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" class="img-responsive img-circle" style="object-fit: cover;">
                    <?php
                    }
                } else {
                    ?>
                    <img src="<?php echo base_url() ?>resources/images/profile/avatar.png" alt="user-image" class="img-responsive img-circle" style="object-fit: cover;">
                <?php
                }
                ?>
            </div>
            <div class="profile-details col-md-8 col-sm-8 col-xs-8">
                <h3><a href="#" style="text-transform:capitalize">
                        <?php $data_s = $this->session->userdata('logged_in');
                        //var_dump($data_s);
                        echo $data_s['username'];
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
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Home", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'home') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class=" fa  fa-home" aria-hidden="true"></i>
                                <span class="title">Home</span>
                                <span class="arrow <?php if ($active == 'home') { ?> open <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'content') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Content" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Header", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'header') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Content/header" target=''> Header </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Footer", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'footer') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Content/footer" target=''> Footer </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Banners", $data_s['sub_privilages'])) { ?>
                                    <li style="display:none">
                                        <a class="<?php if ($sub == 'banner') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Content/banner" target=''> Banners </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Social Media", $data_s['sub_privilages'])) { ?>
                                    <li style="display:none">
                                        <a class="<?php if ($sub == 'social') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Content/social" target=''> Social Media </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Home Slider", $data_s['sub_privilages'])) { ?>
                                    <li class=" <?php if ($sactive == 'slider') { ?> active open  <?php } ?> ">
                                        <a class="<?php if ($sactive == 'slider') { ?> open active <?php } ?>"><span class="title "> Home Slider </span><span class="arrow <?php if ($sactive == 'slider') { ?> open <?php } ?> "></span></a>
                                        <ul class="sub-menu" style="display: none;">
                                            <li> <a class="<?php if ($sub == 'add') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Slider" target=''>Add Slider </a> </li>
                                            <li>
                                                <a class=" <?php if ($sub == 'list') { ?> active <?php } ?> " href="<?php echo base_url() ?>system-content/Slider/listSlider" target=''>Manage Slider </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Recent Updates", $data_s['sub_privilages'])) { ?>
                                    <li> <a class="<?php if ($sub == 'rupd') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Mmenu/recent" target=''> Recent Updates </a> </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("About Us", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'about') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="title">About Us </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'acontent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Board Messages", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'board') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/board" target=''> Board Messages </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Key Staffs", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'staff') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/staff" target=''> Key Staffs </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Organization", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'organization') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/organization" target=''> Organization </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Organization Structure", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'ostructure') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/ostructure" target=''> Organization Structure </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Governing Board", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'gb') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/gb" target=''> Governing Board </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Careers", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'career') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/career" target=''> Careers </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Add Sub Page", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'subpage') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/subpage" target=''> Add Page </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Sub Pages", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'lsubpage') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/About/listsubpage" target=''> List of Pages </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Timeline", $data_s['sub_privilages'])) { ?>
                                    <li class="<?php if ($sactive == 'time') { ?> open active   <?php } ?> ">
                                        <a class="<?php if ($sactive == 'time') { ?>   active   <?php } ?> href=" javascript:;">
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                                            <span class="title"> Timeline </span>
                                            <span class="arrow <?php if ($sactive == 'time') { ?>   open active <?php } ?>  "></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a class="<?php if ($sub == 'addtime') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Time" target=''> Add </a>
                                            </li>
                                            <li>
                                                <a class="<?php if ($sub == 'timel') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Time/add" target=''> List </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Experts", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'experts') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-flask" aria-hidden="true"></i>
                                <span class="title"> People </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'econtent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/content" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Expert Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'expertsc') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/catogeries" target=''> People Categories </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Expert Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'expertssc') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/sub_catogeries" target=''> People Department </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Experts", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'experts') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts" target=''> Add People </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Experts", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'expertslist') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/expertlist" target=''> People List </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Research Associates", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'research') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/research" target=''> Research Associates </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Research Associates", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'researchlist') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Experts/researchlist" target=''> List of Research Associates </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Programmes", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'db') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span class="title"> Programmes </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'dbcontent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Programmes" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'dbcat') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Programmes/categories" target=''> Categories </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Sub Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'dbscat') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Programmes/s_categories" target=''> Sub Categories </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Create Article", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'article') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Programmes/article" target=''> Create Article </a>
                                    </li>
                                <?php } ?>

                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Article List", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'articlel') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Programmes/a_list" target=''> Article List </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Press Room", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'news') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <span class="title"> Press Room </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'ncontent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/content" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'ncat') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/categories" target=''> Categories </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Topics", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'topics') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/topic" target=''> Topics </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("News", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'news') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News" target=''> News </a>
                                    </li>
                                <?php } ?>

                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("News List", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'newsl') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/listnews" target=''> News List </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Multimedia", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'mnews') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <span class="title"> Multimedia </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Add Multimedia Categery", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'mnews_c') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/mcat" target=''> Add Multimedia Category </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Add Multimedia Categery", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'mnews_sc') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/mscat" target=''> Add Multimedia Sub Category </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Add Multimedia News", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'mnews') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/multimedia" target=''> Add Multimedia News </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Multimedia List", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'mnewsl') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/News/listmnews" target=''> Multimedia List </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Research & Publications", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'research') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="title">Research & Publications </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Publications Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'content') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Publications" target=''> Manage Publications Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Research Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'rcontent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/content" target=''> Manage Research Content </a>
                                    </li>
                                <?php } ?>

                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Topics", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'topic') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/topic" target=''> Topics </a>
                                    </li>
                                <?php } ?>

                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Sub Topics", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'stopic') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/stopic" target=''> Sub Topics </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Publication Type", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'ptype') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/ptype" target=''> Publication Type </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Upload Publications/Research", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'publication') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/publication" target=''> Upload Publications/Research </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Publications/Research", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'lpublication') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/listpublication" target=''> List of Publications/Research </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Publications/Research", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addlpublication') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/publication_slider" target=''> Add Publications Slider </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("List of Publications/Research", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'listlpublication') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Research/listpublication_Slider" target=''> Publications Slider </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Events", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'events') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="title"> Events </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'evcontent') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Events/content" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Categories", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'cat') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Events/categories" target=''> Categories </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Add Events", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'event') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Events" target=''> Add Events </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Events List", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'eventl') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Events/listevent" target=''> Events List </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Privacy Policy", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'privacy') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <span class="title">Privacy Policy </span>
                                <span class="arrow <?php if ($active == 'ro') { ?> Add Publication Type <?php } ?>  "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Manage Content", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'content') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Policy" target=''> Manage Content </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Administration", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'admin') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                <span class="title">Administration</span>
                                <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Users", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'index') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/user" target=''> Users </a>
                                    </li> <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Groups", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'group') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/user/group" target=''> Groups </a>
                                    </li> <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Logs", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'history') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/History" target=''> Logs </a>
                                    </li> <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Configurations and Verbiages", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'config') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <span class="title">Configurations and Verbiages </span>
                                <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Configurations", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'indexc') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Configuration" target=''> Configurations </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Card", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'card') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <span class="title"> Cards </span>
                                <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Card List", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/card/" target=''> Card List </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Home page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc1') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/1" target=''> Home page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Research page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc2') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/2" target=''> Research page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Research Inside page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc3') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/3" target=''> Research Inside page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Asean page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc4') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/4" target=''> Asean page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Asean Inside page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc5') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/5" target=''> Asean Inside page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Publication page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc6') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/6" target=''> Publication page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Update page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc7') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/7" target=''> Update page Card </a>
                                    </li>
                                <?php } ?>
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Multimedia page Card", $data_s['sub_privilages'])) { ?>
                                    <li>
                                        <a class="<?php if ($sub == 'addc8') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Card/assignCard/8" target=''> Multimedia page Card </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Mega menu", $data_s['main_privilages'])) { ?>
                        <li class="<?php if ($active == 'mmenu') { ?> open <?php } ?> ">
                            <a href="javascript:;">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <span class="title"> Mega menu </span>
                                <span class="arrow <?php if ($active == 'admin') { ?> open <?php } ?> "></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if ($data_s['user_id'] == 1 or $data_s['user_id'] == 4 or $data_s['user_id'] == 15 or in_array("Featured", $data_s['sub_privilages'])) { ?>
                                    <li> <a class="<?php if ($sub == 'fe') { ?> active <?php } ?>" href="<?php echo base_url() ?>system-content/Mmenu" target=''> Featured </a> </li>
                                <?php } ?>
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
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
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