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

<div class="research-page news-views-page">
    <div class="research-topic">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="main-title text-blue">Press Room </h3>
                    <div class="description"> ERIA&apos;s Communications Department works closely with the media to provide information about our research and programs, set up interviews with ERIA experts, or answer any other questions. </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <!-- Content section left -->
            <div id="contentLeftPressRoom" class="col-md-8 col-xs-12">
                <div class="row">
                    <?php foreach ($pressRelease as $news_) { ?>
                        <?php
                        if (!empty($news_['image_name'])) {
                            if (file_exists(FCPATH . $news_['image_name']) && $news_['image_name'] != '') {
                                $img = base_url() . $news_['image_name'];
                            } elseif (file_exists(FCPATH . '/resources/images' . $news_['image_name']) && $news_['image_name'] != '') {
                                $img = base_url() . 'resources/images' . $news_['image_name'];
                            } else {
                                if (!empty($news_['image_name'])) {
                                    $url_ = "https://www.eria.org" . $news_['image_name'];
                                    $response = file_get_contents($url_);
                                    if (strlen($response)) {
                                        $img = "https://www.eria.org" . $news_['image_name'];
                                    } else {
                                        $img = base_url() . "/upload/news.jpg";
                                    }
                                } else {
                                    $img = base_url() . "/upload/news.jpg";
                                }
                            }
                        } else {
                            $img = base_url() . "/upload/news.jpg";
                        }
                        ?>
                        <div class="col-md-6 pb-4">
                            <div class="card rounded-0 border-0">
                                <div class="pressroom-card-image">
                                    <img src="<?php echo $img; ?>" alt="<?php echo $news_['title']; ?>" style="height: 252px;">
                                </div>
                                <div class="card-body bg-light-blue">
                                    <?php
                                    if (!empty($news_['tags'])) {
                                        $taging = $news_['tags'];
                                    } else {
                                        $taging = $this->frontModel->tag_topic($news_['article_id']);
                                    }

                                    ?>
                                    <small><?php echo ucfirst($news_['article_type']); ?><?php echo $taging; ?></small>
                                    <a href="<?php echo base_url() . 'news-and-views/' . $news_['uri']; ?>">
                                        <h3 class="card-title"><?php echo str_replace(array("â€˜", "â€™", "â€“"), "'", $news_['title']); ?></h3>
                                    </a>
                                    <small class="d-flex align-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar mr-2" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                        </svg><span> <?php echo $news_['posted_date'] ?></span></small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php //echo $slider_row->content 
                ?>
            </div>
            <!-- Content section right -->
            <div class="col-md-4 content-section-right d-none d-lg-block">
                <?php
                foreach ($card as $c) {
                    $this->load->view('front-end/common/card_' . $c->card);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- <div id="pod"> -->
    <?php //if ($pod) { 
    ?>
    <!-- Podcast -->
    <!-- <div class="container podcast related-article">
                <div class="container py-3">
                    <div class="py-4 heading">
                        <h3 class="float-left left-span">Podcasts</h3>
                        <h4 class="float-right right-span">VIEW MORE PODCASTS<i class="fa fa-angle-right"></i></h4>
                    </div> -->
    <!-- <div class="row page-content pb-3"> -->
    <?php //for ($y = 0; $y <= 2; $y++) { 
    ?>
    <!-- <div class="col-md-4 col-12 mb-4">
                                <img class="responsive" src="<?php //echo base_url() 
                                                                ?><?php //echo $pod[$y]->image_name 
                                                                    ?>">
                                <div class="category mt-3"><?php //echo $pod[$y]->article_type 
                                                            ?></div>
                                <div class="heading"> <?php //echo $pod[$y]->title 
                                                        ?> </div>
                                <div>
                                    <span class="date"> <?php //echo date('j  F Y', strtotime($pod[$y]->posted_date)) 
                                                        ?> </span>
                                </div>
                            </div> -->
    <?php //} 
    ?>
    <!-- </div>
                </div>
            </div> -->
    <?php //} 
    ?>
    <!-- </div> -->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("#mmore").click(function() {



        $('.hidem').show();


    });


    $("#wmore").click(function() {



        $('.hidew').show();


    });


    $('.cnty').click(function() {

        var type = $(this).data("cnt");

        $('.region').val(type);

        $('.reg').html(type);



    })
</script>


<script type="text/javascript">
    $(document).ready(function() {


        var start = 0;
        var limit = 5;





        var reachedMax = false;

        getPost_searchData();





        $('#_msearch').click(function() {


            start = 0;
            limit = 5;


            $('#searchResult').html('');

            getPost_searchData();



        })

        $('#ldmr').click(function() {
            getPost_searchData();
        })









        function getPost_searchData() {





            var region = $('.region').val();
            var url = '<?php echo base_url() ?>News/loadmSearch';

            var key = $('#key').val();





            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'text',
                cache: false,
                data: {
                    getData: 1,
                    start: start,
                    limit: limit,
                    region: region,
                    key: key
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
                        $("#searchResult").append(response);
                    }
                }
            });
        }




    });
</script>