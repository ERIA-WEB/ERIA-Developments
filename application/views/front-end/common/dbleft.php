<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">

<style>
/* ===---=== */
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
    padding: 1rem;
    width: 100%;
}

.sidebar-item-link:hover {
    text-decoration: none;
    background-color: #edf1f3;
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

.sidebar-item.active a {
    color: #fff;
}

/* ===---=== */
</style>
<input type="hidden" value="<?php echo $id ?>" id="key" placeholder="Keywords" aria-describedby="button-addon2"
    name="msearch" class="form-control border-left-0 ">
<input type="hidden" name="region" class="region" id="region" value="all">
<div class="program-sidebar bg-light-blue p-4 sticky-top mb-4">
    <h5 class="font-merriweather text-blue font-weight-bold pl-3 pr-3">Topics</h5>
    <ul class="sidebar-items list-unstyled">
        <?php
            $menudb = $this->header->get_dbMenu();
            ?>
        <?php foreach ($menudb as $menuD) { ?>
        <?php if ($menuD['published'] == 1) { ?>
        <?php
                    if ($menuD['uri'] == 'Organisation_for_Economic_Co-operation_and_Development_(OECD)') {
                        $uri = strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $menuD['uri'])));
                    } else {
                        $uri = $menuD['uri'];
                    }
                    ?>
        <li class="sidebar-item">
            <a href="<?php echo base_url() ?>database-and-programmes/topic/<?php echo $uri; ?>"
                class="sidebar-item-link">
                <div <?php if ($uri == strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $id)))) { ?>
                    class="selected" <?php } ?>><?php echo $menuD['category_name'] ?></div>
            </a>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
</div>

<!-- <div class="col-md-4 col-12">
    <div style="z-index: 1;" class=" top_search  sticky-top">
        <div class="profile-overView p-4">
            <h3 class="publication-type-tittle mb-3 border-0">Category</h3>
            <?php
            $menudb = $this->header->get_dbMenu();
            ?>
            <?php foreach ($menudb as $menuD) { ?>
            <?php if ($menuD['published'] == 1) { ?>
            <?php
                    if ($menuD['uri'] == 'Organisation_for_Economic_Co-operation_and_Development_(OECD)') {
                        $uri = strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $menuD['uri'])));
                    } else {
                        $uri = $menuD['uri'];
                    }
                    ?>
            <a href="<?php echo base_url() ?>database-and-programmes/topic/<?php echo $uri; ?>">
                <div <?php if ($uri == strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $id)))) { ?>
                    class="selected" <?php } ?>><?php echo $menuD['category_name'] ?></div>
            </a>
            <?php 
                        if (isset($menuD['sub'])) {
                            foreach ($menuD['sub'] as $key => $value) {
                                if ($value->uri == $id) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<div class="pl-5 '.$selected.'">
                                        <ul>
                                            <li><a href="'.base_url().'database-and-programmes/topic/'.$value->uri .'">'.$value->category_name.'</a></li>
                                        </ul>
                                    </div>';
                            }
                        }
                    ?>
            <?php } ?>
            <?php } ?>
        </div>
        <br>
        <div class="phara-database d-none">
            <p>Use the search box below to find the specific information from this category</p>
        </div>
        <div class="row searc-main-sec d-none">
            <div class="col-md-12">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <button id="button-addon2" type="submit"
                            class="btn btn-link text-secondary border border-right-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <?php
                    if (isset($catData->category_name)) {
                        $cd = $catData->category_name;
                    } else {
                        $cd = null;
                    }
                    ?>
                    <input type="search" value="<?php echo $id ?>" id="key" placeholder="Keywords"
                        aria-describedby="button-addon2" name="msearch" class="form-control border-left-0 ">
                    <input type="hidden" name="region" class="region" id="region" value="all">
                </div>
                <div class="search-arrow-btn">
                    <button style="display: none " type="button"
                        class="publication-collapsible  profile-overView1 search-result-btn mt-4"> &emsp;Publication
                        Type &nbsp;<span style="float:right"><i class="fa fa-angle-down pl-1"></i></span></button>
                    <div style="display: none" class="publicationcontent">
                        <div class="check-btns">
                            <?php foreach ($ptype as $ptype) { ?>
                            <label class="container-check"> <?php echo $ptype->category_name ?>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="dropdown mt-2">
                        <button class="btn bg-white border reg  w-100" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Region<i style="right: 5%;top: 23%;" class="fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item cnty " data-cnt="all">All</a>
                            <a class="dropdown-item cnty" data-cnt="Brunei Darussalam">Brunei Darussalam </a>
                            <a class="dropdown-item cnty" data-cnt="Cambodia">Cambodia </a>
                            <a class="dropdown-item cnty" data-cnt="Indonesia">Indonesia </a>
                            <a class="dropdown-item cnty" data-cnt="Malaysia">Malaysia </a>
                            <a class="dropdown-item cnty" data-cnt="Lao PDR">Lao PDR </a>
                            <a class="dropdown-item cnty" data-cnt="Myanmar">Myanmar </a>
                            <a class="dropdown-item cnty" data-cnt="Phillippines">Phillippines </a>
                            <a class="dropdown-item cnty" data-cnt="Singapore">Singapore </a>
                            <a class="dropdown-item cnty" data-cnt="Vietnam">Vietnam </a>
                        </div>
                    </div>
                    <div class="input-group mt-2" data-provide="fecha-default">
                        <input title="Fecha derivacion" id="fechasiniestroa" autocomplete="off"
                            class="form-control input-sm" type="text" name="sdate" size="30" placeholder="Start Date">
                        <span id="input-group-addon" class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <div class="input-group mt-2" data-provide="fecha-default">
                        <input title="Fecha derivacion" id="fechasiniestro" autocomplete="off"
                            class="form-control input-sm" type="text" name="fdate" size="30" placeholder="End Date">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <button type="button" name="commit" id="_msearch" value="Search"
                        style="color:white !important;width: 100% !important;"
                        class="btn btn-primary btn-block  button-search4 button11">Search</button>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
</div> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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