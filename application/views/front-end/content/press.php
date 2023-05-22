<style>
.hidem {
    display: none;
}

.hidew {
    display: none;
}

.pressroom-card-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.pressroom-card-image img {
    width: 100%;
    object-fit: cover;
}

#contentLeftPressRoom h1 {
    margin-bottom: 0 !important;
    line-height: 15px !important;
    font-size: 23px !important;
}

#contentLeftPressRoom h5 {
    font-size: 18px !important;
    line-height: 13px !important;
}

@media screen and (max-width: 640px) {
    #contentLeftPressRoom h5 {
        line-height: 20px !important;
    }
}
</style>

<div class="container research-page news-views-page section-top">
    <div class="research-topic pt-4">
        <div class="container pr-0 pl-0">
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="main-title text-blue">Press Room </h3>
                    <div class="description"> ERIA&apos;s Communications Department works closely with the media to
                        provide information about our research and programs, set up interviews with ERIA experts, or
                        answer any other questions. </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container py-5 pr-0 pl-0">
        <div class="row">
            <!-- Content section left -->
            <div id="contentLeftPressRoom" class="col-lg-8 col-xs-12">
                <div id="resultPage" class="row"></div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button id="ldmr" class="btn third-button">Load more... </button>
                    </div>
                </div>
            </div>
            <!-- Content section right -->
            <div class="col-md-4 content-section-right d-none d-lg-block">
                <div class="latest-news-card bg-light-blue px-3 py-4">
                    <h4 class="font-merriweather font-weight-bold text-blue mb-4">Contact Us</h4>
                    <p class="font-merriweather font-weight-normal text-blue">For general media enquiries,<br> please
                        contact us by <ins><a href="mailto:isabella.italia@eria.org">
                                Email.</a></ins>
                    </p>
                </div>
                <br>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var start = 0;
    var limit = 6;
    var article_type = 'press-releases';

    result_press_room();

    $('#_msearch').click(function() {

        start = 0;
        limit = 6;

        $('#resultPage').html('');

        result_press_room();

    })

    $('#ldmr').click(function() {
        result_press_room();
    })

    function result_press_room() {
        var url = '<?php echo base_url() ?>News/load_page';

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start,
                limit: limit,
                article_type: article_type
            },
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $("#ldmr").html("End");
                } else {
                    $("#ldmr").html("Load more");
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $("#resultPage").append(response);
                }
            }
        });
    }
});
</script>