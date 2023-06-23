<?php if (isset($article)) { ?>
<?php
// this is remove special character in html
function RemoveBS($Str)
{
    $StrArr = str_split($Str);
    $NewStr = '';
    foreach ($StrArr as $Char) {
        $CharNo = ord($Char);
        if ($CharNo == 163) {
            $NewStr .= $Char;
            continue;
        } // keep £ 
        if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
        }
    }
    return $NewStr;
}
?>
<style>
.image-container img {
    width: 100% !important;
    height: auto;
}

.third-button[aria-expanded="false"] .bi-chevron-right {
    transform: rotate(0deg);
    transition: all 0.5s ease-in-out;
}

.third-button[aria-expanded="true"] .bi-chevron-right {
    transform: rotate(90deg);
    transition: all 0.5s ease-in-out;
}

.social-icons a {
    font-size: 24px;
    color: #727272;
}

.social-icons a:hover {
    color: #0F3979;
}

.image-container img {
    width: 100%;
    object-fit: cover;
}

.btn.calendar-button:hover {
    background-color: #013e93;
}

.btn.register-outline-button:hover {
    background-color: #ced4da;
    color: #212529;
}

.eventbrite-checkout-button button {
    background-color: #0f3979;
    border: 1.5px solid #0f3979;
    color: #fff;
    font-weight: 500;
    letter-spacing: 1px;
    padding: 10px 24px;
    width: 100%;
    transition: all 0.3s ease-in-out;
}

.eventbrite-checkout-button button:hover {
    background-color: #124797;
}

#gtx-trans {
    display: none !important;
}

table {
    width: 100% !important;
}

.status-events {
    color: #fff;
    padding: 5px;
    width: max-content;
}
</style>
<?php


$Url = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
$Url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

?>
<div class="modal downloadPdfModal1 fade" id="downloadPdfModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title p-2" id="exampleModalLongTitle">Download document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <!-- dropdown 1 -->
                <!-- dropdown 2 -->
                <div id="accordion2">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="true" aria-controls="collapseTwo">
                                    Content
                                </div>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion2">
                            <div class="container p-0">
                                <?php foreach ($pdf as $pdf) {  ?>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        <?php echo $pdf->pdf_title ?>
                                        <p> <?php echo $pdf->pdf_discription ?> </p>
                                    </div>
                                    <div class="col-md-3">
                                        <button href="<?= base_url() ?><?php echo $pdf->pdf ?>" target="_blank"
                                            class="form-control btn modal-btn">Download</button>
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

<section class="section-top bg-main-grey">
    <div class="container">
        <!-- Breadcrumb -->
        <?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
        <!-- end Breadcrumb -->
        <div class="row pb-5">
            <div class="col-lg-12">
                <h2 class="main-title"><?php echo RemoveBS(str_replace(array('â€™'), "'", $article->title)); ?></h2>
            </div>
            <div class="col-lg-2 mt-2">
                <?php 
                if ($article->start_date == date('Y-m-d')) {
                    echo '<div class="status-events" style="background: #0c620c;">On Going</div>';
                } elseif ($article->start_date >= date('Y-m-d')) {
                    echo '<div class="status-events" style="background: #0f3979;">Upcoming</div>';
                } elseif ($article->start_date < date('Y-m-d')) {
                    echo '<div class="status-events" style="background: #0f3979;">Completed</div>'; // background: #BD1550;
                }
                ?>
            </div>
            <?php 
            if ($article->start_date < date('Y-m-d') AND !empty($article->old_url)) {
                echo '<div class="col-lg-12 mt-2">
                        <p>This event has been completed. To read the event summary click <a href="'.$article->old_url.'">here</a>. </p>
                    </div>';
            }
            ?>

        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 order-3 order-lg-1">
                <hr class="d-block d-lg-none">
                <div class="sticky-top" style="top:100px">
                    <small class="text-uppercase font-weight-semibold text-secondary mb-3">Share</small>
                    <div class="d-flex flex-row flex-lg-column social-icons">
                        <div class="mb-2 mr-3 mr-lg-0 mt-lg-2">
                            <a href="http://www.facebook.com/sharer.php?u=<?php echo $Url ?>" target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                        <div class="mb-2 mr-3 mr-lg-0">
                            <a target="_blank"
                                href="https://twitter.com/share?url=<?php echo $Url; ?>?utm_source=Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                        </div>
                        <div class="mb-2 mr-3 mr-lg-0">
                            <a target="_blank" href="https://www.instagram.com/sharer.php?u=<?php echo $Url; ?>">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                        <div class="mb-2 mr-3 mr-lg-0">
                            <a target="_blank"
                                href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $Url; ?>">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                        <div class="mb-2 mr-3 mr-lg-0">
                            <a id="btnPrint" href="#">
                                <i class="bi bi-printer"></i>
                            </a>
                        </div>
                        <div class="mb-2">
                            <?php if ($pdf) { ?>
                            <!-- <span class="download-event-text ">You can download complete <br> Information about this <br>event</span> -->
                            <a data-toggle="modal" data-target="#downloadPdfModal1"
                                class="btn pdf-download-btn w-100 mb-4 mt-4">
                                <i class="bi bi-file-pdf"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 order-1 order-lg-2">
                <div class="row mb-4">
                    <div class="col-lg-12 overflow-auto">
                        <?php if (!empty($article->content)) { ?>
                        <?php if (!empty($article->image_name) and file_exists(FCPATH . $article->image_name)) { ?>
                        <div style="height: auto" class="img-container mb-2">
                            <img src="<?php echo base_url() . $article->image_name; ?>"
                                alt="<?php echo $article->title; ?>" class="w-100">
                        </div>
                        <?php } ?>
                        <?php echo RemoveBS($article->content); ?>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!empty($agenda_list)) { ?>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3 class="font-montserrat">Agenda</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="accordion" id="accordionExample">
                            <?php foreach($agenda_list as $key => $value) { ?>
                            <div class="mb-3" id="heading<?php echo $key; ?>">
                                <button
                                    class="btn third-button py-3 px-4 w-100 text-left d-flex justify-content-between align-items-center"
                                    type="button" data-toggle="collapse"
                                    data-target="#collapseExample<?php echo $key; ?>" aria-expanded="true"
                                    aria-controls="collapseExample<?php echo $key; ?>">
                                    <span><?php echo $value->title; ?></span>
                                    <svg id="chevronIconRight" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>
                                <div class="collapse <?php if ($key == 0) { echo 'show'; }?>"
                                    id="collapseExample<?php echo $key; ?>" aria-labelledby="heading<?php echo $key; ?>"
                                    data-parent="#accordionExample">
                                    <div class="card card-body mt-1 rounded-0">
                                        <?php echo $value->content; ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <hr class=" d-lg-none"> -->
                </div>
                <?php } ?>
                <?php if (!empty($peoples)) { ?>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3 class="font-montserrat">ERIA Speakers</h3>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4">
                    <?php foreach ($peoples as $value) { ?>
                    <div class="col">
                        <div class="expert-image">
                            <a href="<?php echo base_url().'experts/'.$value->uri; ?>" target="_blank">
                                <img src="<?php echo base_url().$value->image_name; ?>"
                                    alt="<?php echo $value->title; ?>" class="img-fluid mb-2">
                                <h5 class="card-title textblue"><?php echo $value->title; ?></h5>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-4 order-2 order-lg-3">
                <div class="sticky-top" style="top:100px">
                    <?php if (!empty($agenda_detail->title) AND isset($agenda_detail->title)) { ?>
                    <div class="card bg-main-grey rounded-0 border-0 mb-4">
                        <div class="card-body py-4">
                            <h5 class="mb-3">Event Details:</h5>
                            <div class="mb-3" style="font-size:15px;">
                                <p class="mb-1"><i class="bi bi-geo-alt-fill mr-1"></i><?php echo $article->venue; ?>
                                </p>
                                <p class="mb-1"><?php echo ucfirst($agenda_detail->title); ?>,</p>
                                <p class="mb-1"><?php echo date('l', strtotime($agenda_detail->date)) ?>,
                                    <?php echo date('j F Y', strtotime($agenda_detail->date)) ?>,</p>
                                <p class="mb-1">
                                    <?php echo date('H:i A', strtotime($agenda_detail->time_from)); ?>,
                                    <?php echo date('H:i A', strtotime($agenda_detail->time_to)); ?></p>
                                <p class="mb-1"><?php echo ucfirst($agenda_detail->zone_time); ?></p>
                            </div>
                            <?php if (!empty($agenda_detail->emmbed_google_calendar) || !empty($agenda_detail->emmbed_outlook_calendar)) { ?>
                            <div class="dropdown mb-2">
                                <a href="" type="button"
                                    class="btn calendar-button text-center bg-blue text-white w-100 py-2 font-weight-semibold"
                                    style="font-size: 15px;" data-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-calendar4-week mr-2"></i>
                                    <span>Add to Calendar</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="<?php echo $agenda_detail->emmbed_google_calendar; ?>"
                                        target="_blank">Google Calendar</a>
                                    <a class="dropdown-item"
                                        href="<?php echo $agenda_detail->emmbed_outlook_calendar; ?>"
                                        target="_blank">Outlook Online</a>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (!empty($agenda_detail->emmbed_rsvp)) { ?>
                            <?php echo "<div class='eventbrite-checkout-button'>$agenda_detail->emmbed_rsvp</div>"; ?>
                            <?php } ?>
                            <hr class="w-100">
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                        if (!empty($card)) {
                            foreach ($card as $c) {
                                if (!empty($c->file)) {
                                    $this->load->view($c->path . $c->file);
                                } else {
                                    echo '<div class="container background d-none d-sm-block" style="background: #F3F8FC;">
                                            <div class="row d-none d-sm-block">
                                                <div class="col-md-12 col-xs-12 d-none d-sm-block">
                                                    '.$c->template.'
                                                </div>
                                            </div>

                                        </div>';
                                }
                            }
                        } else {
                            $this->load->view('front-end/common/card-randoms/cards');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Research area -->
<!-- <?php $this->load->view('front-end/content/sections/research-areas'); ?> -->
<!-- END Research area -->

<div class="row mr-md-2 mr-0 mr-md-0 ml-1">
    <div class="col-md-12 pl-0 pr-0">
        <!-- Related News -->
        <?php $this->load->view('front-end/content/relateds/news_related'); ?>
        <!-- END -->
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/events/events-browse.js"></script>

<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>