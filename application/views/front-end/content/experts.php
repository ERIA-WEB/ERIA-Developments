<style>
.bg-lg-light {
    background-color: #f3f8fc;
}

select {
    appearance: none;
}

.people-card a:hover {
    text-decoration: none;
}

.people-card img {
    aspect-ratio: 3/4;
    object-fit: cover;
}

.text-secondary {
    font-size: 14px;
}

#dropdownCategory {
    text-align: left;
}

@media (min-width:1024px) {
    .people-card .card-body {
        background-color: #f3f8fc;
    }
}

.sub_cat_experts {
    text-align: left !important;
    border-radius: 0 !important;
    border: 1px solid #d9dde1 !important;
    border: 1px solid #d9dde1 !important;
    font-size: 12px !important;
    color: #251f20 !important;
    height: 48px !important;
}

.sub_cat_experts:hover {
    cursor: pointer;
}

p.mail-people {
    position: absolute;
    bottom: -10px;
}

@media (min-width: 1200px) {

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:not(:first-child),
    .input-group>.custom-file:not(:first-child) .custom-file-label,
    .input-group>.custom-select:not(:first-child),
    .input-group>.form-control:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-radius: 0 !important;
    }

    #button-addon2 {
        z-index: 0 !important;
        border-radius: 0 !important;
    }

    .serch-ch-desktop {
        position: relative !important;
        top: -3.5px !important;
    }

}

@media only screen and (min-width: 768px) and (max-width: 868px) {
    .experts-page .view-profile .padding-left {
        padding-left: 9px !important;
        padding-right: 7px !important;
    }

    .experts-page .view-profile .upper-section {
        padding-top: 20px !important;
        padding-bottom: 10px !important;
        height: 260px !important;
    }

    .experts-page.person-description.padding-left.py-3 {
        font-size: 12px !important;
        height: 120px !important;
    }

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:not(:first-child),
    .input-group>.custom-file:not(:first-child) .custom-file-label,
    .input-group>.custom-select:not(:first-child),
    .input-group>.form-control:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    #button-addon2 {
        z-index: 0 !important;
    }

    .card-ch-tab-exp {

        max-width: 50% !important;
        flex: 0 0 50% !important;
    }

    .serch-ch-desktop {
        position: relative !important;
        top: -3.5px !important;
    }

}


@media only screen and (min-device-width: 869px) and (max-device-width: 1190px) {


    .experts-page .view-profile .upper-section {
        padding-top: 20px !important;
        padding-bottom: 10px !important;
        height: 260px !important;
    }

    .experts-page.person-description.padding-left.py-3 {
        font-size: 12px !important;
        height: 120px !important;
    }

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:not(:first-child),
    .input-group>.custom-file:not(:first-child) .custom-file-label,
    .input-group>.custom-select:not(:first-child),
    .input-group>.form-control:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    #button-addon2 {
        z-index: 0 !important;
    }

    .card-ch-tab-exp {

        max-width: 50% !important;
        flex: 0 0 50% !important;
    }

    .serch-ch-desktop {
        position: relative !important;
        top: -3.5px !important;
    }


}


@media only screen and (max-width: 668px) {

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:not(:first-child),
    .input-group>.custom-file:not(:first-child) .custom-file-label,
    .input-group>.custom-select:not(:first-child),
    .input-group>.form-control:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-radius: 0 !important;
        /*0px 9px 9px 0px !important*/
    }

    #button-addon2 {
        z-index: 0 !important;
        border-radius: 0 !important;
        /*9px 0px 0px 9px !important*/
    }

    #dropdownMenuButton.btn.bg-white.border.w-100,
    #dropdownCategory {
        margin-top: 0px !important;
        margin-bottom: -10px !important;
        border-radius: 0 !important;
    }

    .btn.text-light.w-100.drop-btn {
        border-radius: 0 !important;
        /*8px !important*/
    }

    .p-1.rounded.my-md-0.my-2 {
        margin-left: -4px !important;
        margin-right: -5px !important;
    }


    .experts-page .dropdown .fa {
        position: absolute !important;
        right: 5% !important;
        top: 54% !important;
    }

    .fa.fa-envelope-o {
        position: relative !important;
        top: 50% !important;
        /*57px !important*/
    }
}
</style>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <h1 class="event-title text-white font-merriweather">ERIA Our People</h1>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="container experts-page">
    <!-- <div class="row my-4">
        <div class="col-lg-6">
            <div class="main-title text-blue d-none">Our People</div>
        </div>
    </div> -->
    <div class="row mb-4">
        <!-- Searches and drop downs -->
        <input type="hidden" value="<?= $catogeryID ?>" name="catogery" id="catogery">
        <input type="hidden" value="all" name="cn" id="cn">
        <input type="hidden" value="all" name="cns" id="cns">
        <input type="hidden" value="all" name="subcatdep" id="subcatdep">
        <div class="col-md-9 mb-3 order-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button id="button-addon2" type="submit" class="btn btn-link text-secondary border border-right-0">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <input type="search" value="<?= $key ?>" name="key" id="key" placeholder="Keywords "
                    aria-describedby="button-addon2" class="search form-control border-left-0 rounded-0">
            </div>
        </div>
        <div class="col-md-3 mb-3 order-10 order-md-2 ">
            <button id="esearch" class="btn third-button w-100" type="button">
                Search
            </button>
        </div>
        <div class="col-md-6 mb-4 order-3">
            <div class="dropdown">
                <button class="btn bg-white border w-100 cv" type="button" id="dropdownCategory" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php if ($catogery) {
                        echo $catogery;
                    } else {  ?> All <?php } ?> <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu rounded-0 w-100" aria-labelledby="dropdownCategory">
                    <a class="dropdown-item cds dropdown_category" data-cid="All" data-nme="All" href="#">All</a>
                    <?php foreach ($ex_cat as $ex) { ?>
                    <?php if ($ex->category != 'Unclassified') { ?>
                    <a class="dropdown-item cds dropdown_category" data-cid="<?= $ex->ec_id ?>"
                        data-nme="<?= $ex->category ?>" href="#"><?= $ex->category ?></a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 order-4">
            <div class="dropdown">
                <i class="fa fa-angle-down"></i>
                <select name="subcategory" id="dropdownMenuButton" class="form-control btn bg-white border w-100">
                    <option value="All">Department</option>
                    <?php foreach ($sub_cat as $subcat) { ?>
                    <?php
                        if($subcat->id == "20" || $subcat->id == "19"){
                            $hidden = "d-none";
                        } else {
                            $hidden = "";
                        }
                        ?>
                    <option data-subcat="<?= $subcat->id ?>" data-nme="<?= $subcat->name ?>" value="<?= $subcat->id ?>"
                        class="<?= $hidden ?>"><?= $subcat->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="result_ex">
        <img id="loading-image" src="<?= base_url(); ?>ajax-loader.gif" style="display:none;" />
        <!-- Governing Board -->
        <?php if (!empty($boardmessages)) { ?>
        <?php if (isset($_GET['category']) == false || $_GET['category'] == 'governing-board-members') { ?>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <h2 class="main-title text-blue">Governing Board</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3">
            <?php foreach ($boardmessages as $content) { ?>
            <div class="col mb-4">
                <a href="<?= base_url() ?>experts/<?= $content['uri'] ?>">
                    <div class="card people-card border-0 rounded-0 h-100">
                        <div class="people-card-image bg-lg-light pt-3 px-3">
                            <img src=" <?= base_url() . $content["image_name"] ?>" alt="governing-board-image"
                                class="img-fluid w-100">
                        </div>
                        <div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">
                            <h5 class="card-title text-blue">
                                <?php
                                if (isset($content['major'])) {
                                    $ns = substr(strip_tags($content['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags(str_replace('Message from', '', $content['major']));
                                    if (strlen($c) > 90) {
                                        echo substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $content['uri'] . "'>(...)</a>";
                                    } else {
                                        echo $c;
                                    }
                                }
                                ?>

                            </h5>
                            <p class="text-secondary mb-2" style="font-weight:600">
                                <?php
                                echo str_replace('Message from', '', $content['title']);
                                ?>
                            </p>
                            <p class="mail-people d-none">
                                <?php
                                if (!empty($boardmessage['email'])) {
                                    $mail = "mailto:" . $boardmessage['email'];
                                } else {
                                    $mail = "mailto:contactus@eria.org";
                                }
                                ?>
                                <a href="<?= $mail; ?>">
                                    <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        <!-- Key staff -->
        <?php if (!empty($keystaffs)) { ?>
        <?php if (isset($_GET['category']) == false || $_GET['category'] == 'key-staff') { ?>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <h2 class="main-title text-blue">Key Staff</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3">
            <?php foreach ($keystaffs as $content) { ?>
            <div class="col mb-4">
                <a href="<?= base_url() ?>experts/<?= $content['uri'] ?>">
                    <div class="card people-card border-0 rounded-0 h-100">
                        <div class="people-card-image bg-lg-light pt-3 px-3">
                            <img src=" <?= base_url() . $content["image_name"] ?>" alt="key-staff-image"
                                class="img-fluid w-100">
                        </div>
                        <div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">
                            <h5 class="card-title text-blue">
                                <?php
                                // echo implode(' ', array_slice(explode(' ', $content['title']), 0, 6));
                                echo $content['title'];
                                ?>
                            </h5>
                            <p class="text-secondary" style="font-weight:500">
                                <?php
                                if (isset($content['major'])) {
                                    $ns = substr(strip_tags($content['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags($content['major']);
                                    if (strlen($c) > 90) {
                                        echo substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $content['uri'] . "'>(...)</a>";
                                    } else {
                                        echo $c;
                                    }
                                }
                                ?>
                            </p>
                            <p class="mail-people">
                                <?php
                                if (!empty($content['email'])) {
                                    $mail = "mailto:" . $content['email'];
                                } else {
                                    $mail = "mailto:contactus@eria.org";
                                }
                                ?>
                                <a href="<?= $mail; ?>"><i class="fa fa-envelope"
                                        style="color: var(--primaryBlue);"></i></a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        <!-- experts -->
        <?php if (!empty($experts)) { ?>
        <?php if (isset($_GET['category']) == false || $_GET['category'] == 'experts') { ?>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <h2 class="main-title text-blue">Experts</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5">
            <?php foreach ($experts as $content) { ?>
            <div class="col mb-4">
                <a href="<?= base_url() ?>experts/<?= $content['uri'] ?>">
                    <div class="card people-card border-0 rounded-0 h-100">
                        <div class="people-card-image bg-lg-light pt-3 px-3">
                            <img src=" <?= base_url() . $content["image_name"] ?>" alt="expert-image"
                                class="img-fluid w-100">
                        </div>
                        <div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">
                            <h5 class="card-title text-blue">
                                <?php
                                // echo implode(' ', array_slice(explode(' ', $content['title']), 0, 6));
                                echo $content['title']
                                ?>
                            </h5>
                            <p class="text-secondary mb-4" style="font-weight:500; font-size:14px">
                                <?php
                                if (isset($content['major'])) {
                                    $ns = substr(strip_tags($content['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags($content['major']);
                                    if (strlen($c) > 90) {
                                        echo substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $content['uri'] . "'>(...)</a>";
                                    } else {
                                        echo $c;
                                    }
                                }
                                ?>
                            </p>
                            <p class="mail-people">
                                <?php
                                if (!empty($content['email'])) {
                                    $mail = "mailto:" . $content['email'];
                                } else {
                                    $mail = "mailto:contactus@eria.org";
                                }
                                ?>
                                <a href="<?= $mail; ?>">
                                    <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        <!-- Research Accosiates -->
        <?php if (!empty($associates)) { ?>
        <?php if (isset($_GET['category']) == false || $_GET['category'] == 'research-associates') { ?>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <h2 class="main-title text-blue">Research Associates</h2>
            </div>
        </div>
        <div id="associates" class="rexp row row-cols-1 row-cols-md-3 row-cols-lg-5 my-4 mb-3">
            <?php foreach ($associates as $content) { ?>
            <div class="col mb-4">
                <a href="<?= base_url() ?>experts/<?= $content['uri'] ?>">
                    <div class="card people-card border-0 rounded-0 h-100">
                        <div class="people-card-image bg-lg-light pt-3 px-3">
                            <img src=" <?= base_url() . $content["image_name"] ?>" alt="research-associates-image"
                                class="img-fluid w-100">
                        </div>
                        <div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">
                            <h5 class="card-title text-blue">
                                <?php
                                // echo implode(' ', array_slice(explode(' ', $content['title']), 0, 6));
                                echo $content['title'];
                                ?>
                            </h5>
                            <p class="text-secondary mb-2" style="font-weight:600">
                                <?php
                                if (isset($content['major'])) {
                                    $ns = substr(strip_tags($content['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags($content['major']);
                                    if (strlen($c) > 90) {
                                        echo substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $content['uri'] . "'>(...)</a>";
                                    } else {
                                        echo $c;
                                    }
                                }
                                ?>
                            </p>
                            <p class="mail-people">
                                <?php
                                if (!empty($content['email'])) {
                                    $mail = "mailto:" . $content['email'];
                                } else {
                                    $mail = "mailto:contactus@eria.org";
                                }
                                ?>
                                <a href="<?= $mail; ?>">
                                    <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
        <!-- fellows -->
        <?php if (!empty($fellows)) { ?>
        <?php if (isset($_GET['category']) == false || $_GET['category'] == 'research-fellows') { ?>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                <h2 class="main-title text-blue">Research Fellows</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 mb-4 mt-3">
            <?php foreach ($fellows as $content) { ?>
            <div class="col mb-4">
                <a href="<?= base_url() ?>experts/<?= $content['uri'] ?>">
                    <div class="card people-card border-0 rounded-0 h-100">
                        <div class="people-card-image bg-lg-light pt-3 px-3">
                            <img src=" <?= base_url() . $content["image_name"] ?>" alt="research-fellows-image"
                                class="img-fluid w-100">
                        </div>
                        <div class="card-body bg-lg-light pt-2 mt-0 px-0 px-3">
                            <h5 class="card-title text-blue">
                                <?php
                                // echo implode(' ', array_slice(explode(' ', $content['title']), 0, 6));
                                echo $content['title'];
                                ?>
                            </h5>
                            <p class="text-secondary mb-2" style="font-weight:600">
                                <?php
                                if (isset($content['major'])) {
                                    $ns = substr(strip_tags($content['major']), 0, 75);
                                    $str = substr($ns, 0, strrpos($ns, ' '));
                                    // echo $str."(...)";
                                    $c = strip_tags($content['major']);
                                    if (strlen($c) > 90) {
                                        echo substr($c, 0, 90) . "<a href='" . base_url() . "experts/" . $content['uri'] . "'>(...)</a>";
                                    } else {
                                        echo $c;
                                    }
                                }
                                ?>
                            </p>
                            <p class="mail-people">
                                <?php
                                if (!empty($content['email'])) {
                                    $mail = "mailto:" . $content['email'];
                                } else {
                                    $mail = "mailto:contactus@eria.org";
                                }
                                ?>
                                <a href="<?= $mail; ?>">
                                    <i class="fa fa-envelope" style="color: var(--primaryBlue);"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/experts/experts.js"></script>