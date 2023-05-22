<?php
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

function limit_text($text, $limit, $link = null)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        if ($link) {
            $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >[...]</a>';
        } else {
            $text  = substr($text, 0, $pos[$limit]);
        }
    }
    return $text;
}
?>

<style>
/* === */
.bottom-0 {
    bottom: 0;
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

/* === */

.card-title {
    font-size: 15px;
}

.event-title {
    font-size: 24px;
}

.tabs .nav .nav-item {
    width: 50%;
}

.tabs .nav .nav-item .nav-link {
    font-size: 12px;
}

.upcoming-btn,
.past-btn {
    width: 100%;
}

.ribbon-2 {
    --f: 10px;
    /* control the folded part*/
    --r: 15px;
    /* control the ribbon shape */
    --t: 10px;
    /* the top offset */

    position: absolute;
    inset: var(--t) calc(-1*var(--f)) auto auto;
    padding: 0 10px var(--f) calc(10px + var(--r));
    clip-path:
        polygon(0 0, 100% 0, 100% calc(100% - var(--f)), calc(100% - var(--f)) 100%,
            calc(100% - var(--f)) calc(100% - var(--f)), 0 calc(100% - var(--f)),
            var(--r) calc(50% - var(--f)/2));
    box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
    color: #fff;
}

@media (min-width:768px) {
    .tabs .nav .nav-item {
        width: auto;
    }

    .tabs .nav .nav-item .nav-link {
        font-size: 14px;
    }

    .event-title {
        font-size: 2rem;
    }

    .upcoming-btn,
    .past-btn {
        width: 192px;
    }
}
</style>

<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <h1 class="event-title text-white font-merriweather">Calendar of Events</h1>
    </div>
</section>

<section class="mb-3 mb-lg-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item align-items-center">
                    <a href="<?php echo base_url() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-house mb-1" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
                <li class="breadcrumb-item active" aria-current="page">Calendar of Events</li>
            </ol>
        </nav>
    </div>
</section>

<section class="mb-4">
    <div class="container">
        <div class="tabs">
            <ul class="nav nav-pills mb-3 d-flex" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <button class="upcoming-btn h-100 text-center nav-link border-0 py-3 px-4 active"
                        id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab"
                        aria-controls="pills-home" aria-selected="true">Upcoming Events</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="past-btn h-100 text-center nav-link border-0 py-3 px-4" id="pills-profile-tab"
                        data-toggle="pill" data-target="#pills-profile" type="button" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Past Events</button>
                </li>
            </ul>
        </div>
        <hr class="w-100">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <input type="hidden" id="paramFuture" value="up">
                <div class="future-events"></div>
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <button id="ldmrFuture" class="btn third-button py-3">Load More</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <input type="hidden" id="paramPast" value="past">
                <div class="upcoming-events"></div>
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <button id="ldmr" class="btn third-button py-3">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<script>
$(document).ready(function() {
    var start = 0;
    var limit = 9;
    var start_future = 0;
    var limit_future = 9;
    var reachedMax = false;

    getPost_searchData();
    getFuturesearchData();

    $('#ldmrFuture').on('click', function() {
        getFuturesearchData();
    });

    function getFuturesearchData() {
        var type = $('#paramFuture').val();
        var url = '<?= base_url() ?>Events/loadmSearch';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start_future,
                limit: limit_future,
                type: type
            },
            success: function(response) {
                if (response == "") {
                    $("#ldmrFuture").hide();
                } else {
                    $("#ldmrFuture").html("Load more");
                    start_future += limit_future;
                    $(".loader-image").show();
                    $(".future-events").append(response);
                }
            }
        });
    }

    $('#ldmr').click(function() {
        getPost_searchData();
    });

    function getPost_searchData() {
        var type = $('#paramPast').val();
        var url = '<?= base_url() ?>Events/loadmSearch';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start,
                limit: limit,
                type: type
            },
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $("#ldmr").hide();
                } else {
                    $("#ldmr").html("Load more");
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $(".upcoming-events").append(response);
                }
            }
        });
    }
});
</script>