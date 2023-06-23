<style>
.tableEventBrowse {
    width: 100%;
    overflow: auto;
}

.table td,
.table th {
    padding: 7px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

#prevAndNext {
    height: 31px;
    position: relative;
}

.page-mover {
    position: absolute;
    top: -22px;
    right: 15px;
}

#loadMore {
    text-align: right;
}

@media screen and (max-width: 767px) {

    #prevAndNext {
        text-align: center;
    }

    .page-mover {
        right: 0;
        left: 0;
    }

    #loadMore {
        text-align: center;
    }
}
</style>
<style>
/* === */
.bottom-0 {
    bottom: 0;
}

/* === */
.past-card-image,
.upcoming-card-image {
    overflow: hidden;
    width: 100%;
    height: 230px;
    background: var(--primaryBlue);
}

.past-card-image::after,
.upcoming-card-image::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.upcoming-card-image img,
.past-card-image img {
    max-width: 100%;
    height: auto;
}

.past-card-body {
    height: 180px;
}

.past-card-contact a:hover,
.upcoming-card-contact a:hover {
    text-decoration: underline !important;
}

.past-card a:hover,
.upcoming-card a:hover {
    text-decoration: none;
}

/*2020-06-20*/
html,
body {
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
}

.tableEvent {
    width: 100%;
    overflow: auto;
}

.table td,
.table th {
    padding: 7px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>
<div class="container section-top">
    <div class="database-programes-main-tittle mb-3 pb-3 mt-3">
        <div class="row">
            <div class="col-md-6 mb-3">
                <?php if ($type == 'past') {
                    echo "Past Events";
                } else {
                    echo "Upcoming Events";
                } ?>
                <input type="hidden" id="type" value="<?= $type ?>">
            </div>
            <div id="prevAndNext" class="col-md-6 mb-3">
                <div class="page-mover pt-4 d-flex">
                    <a href="<?= base_url() ?>events" type="button" class="btn event-action-btn mr-2">
                        Back
                    </a>
                    <?php if ($type == 'past') { ?>
                    <a href="<?= base_url() ?>events/browse/up" type="button" class="btn event-action-btn">
                        Upcoming Events
                    </a>
                    <?php  } else { ?>
                    <a href="<?= base_url() ?>events/browse/past" type="button" class="btn event-action-btn">
                        Past Events
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content data events -->
    <div class="upcoming-events"></div>
    <div class="page-list">
        <div class="row">
            <div id="loadMore" class="col-md-12 text-center my-4">
                <div class="loadButton">
                    <button id="ldmr" class="btn third-button py-3 px-5">Load more[...]</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/events/events-browse.js"></script>