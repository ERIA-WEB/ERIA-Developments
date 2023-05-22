<style>
    .hidem {
        display: none;
    }

    .hidew {
        display: none;
    }
</style>

<div class="research-page news-views-page section-top">


    <!-- head title and cards -->

    <!-- content -->
    <div class="container page-content py-4 my-4 pr-md-5 pr-4">
        <div class="row">

            <!-- Content section left -->
            <div class="col-md-8 col-xs-12">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 py-2 pr-3 begin-title">
                            <div class=" heading">
                                <h3 class="float-left left-span main-title"> <?= urldecode($country) ?></h3>
                            </div>
                        </div>
                    </div>


                    <?php $c = 0;
                    foreach ($multimedia as $multimedia) {

                        $c++;

                    ?>



                        <div class=" <?php if ($c > 3) { ?> hidem <?php } ?> medi row py-4 mt-1 bottom-section-divider">
                            <div class="col-md-5 col-xs-12 m-0 pr-md-1">
                                <img class="responsive" src="<?php echo base_url() ?><?php echo $multimedia->image_name; ?>">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <div class="category"> <?= ucfirst($multimedia->article_type) ?> </div>
                                <div class="heading">
                                    <a href="<?= base_url() ?>NewsMultimedia/detail/<?php echo $multimedia->uri; ?>"> <?php echo strip_tags($multimedia->title); ?> </a>
                                </div>
                                <div>
                                    <span class="date"> <?php echo date('j F Y', strtotime($multimedia->posted_date)); ?> </span>
                                </div>
                                <div class="description"> <?php $ns = substr(strip_tags($multimedia->content), 0, 195);

                                                            $str = substr($ns, 0, strrpos($ns, ' ')) . "(...)";

                                                            echo $str;

                                                            ?> </div>
                                <?php if ($c == 3) { ?>
                                    <br>
                                    <a href="#mmore" id="mmore">
                                        <h4 class="float-right right-span">VIEW MORE <i class="fa fa-angle-right"></i></h4>
                                    </a>
                                <?php } ?>
                            </div>

                        </div>

                    <?php } ?>









                </div>
            </div>

            <!-- ©Hashan Pallewatte 2020  -->
            <!-- Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including files downloadable from this website, without the permission of the copyright owner. -->
            <!-- Content section right -->
            <div class="content-section-right latest-news col-md-4 col-xs-12 pl-md-4 m-0">

                <?php


                $lastmdata = $this->header->get_menuMultimedia(178);



                ?>

                <div class="mb-4 headline"> Latest Multimedia</div>
                <div class="container-fluid p-0 m-0">
                    <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?= substr($lastmdata[0]->video_url, 17, 100) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



                    <?php



                    ?>

                </div>
                <div class="container background">
                    <div class="row py-3 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category"><?= ucfirst($lastmdata[0]->article_type) ?></div>
                            <div class="heading">

                                <a href="<?= base_url() ?>NewsMultimedia/detail/<?php echo $lastmdata[0]->uri; ?>">

                                    <?= $lastmdata[0]->title ?> </a>
                            </div>
                            <div>
                                <span class="date"> <?php echo date('l jS \of F Y', strtotime($lastmdata[0]->posted_date)) ?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category"> <?= ucfirst($lastmdata[1]->article_type) ?></div>
                            <div class="heading2"> <a href="<?= base_url() ?>NewsMultimedia/detail/<?php echo $lastmdata[1]->uri; ?>">

                                    <?= $lastmdata[1]->title ?> </a>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category"> <?= ucfirst($lastmdata[2]->article_type) ?> </div>
                            <div class="heading2"> <a href="<?= base_url() ?>NewsMultimedia/detail/<?php echo $lastmdata[2]->uri; ?>"> <?= $lastmdata[2]->title ?> </a>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3 pb-4 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category"> <?= ucfirst($lastmdata[3]->article_type) ?> </div>
                            <div class="heading2"> <a href="<?= base_url() ?>NewsMultimedia/detail/<?php echo $lastmdata[3]->uri; ?>"> <?= $lastmdata[3]->title ?> </a> </div>
                        </div>
                    </div>

                </div>

                <div class="container mt-5 pt-2 subscribe">
                    <div class="row py-3 pb-4 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="heading"> Subscribe to Our Mailing List </div>
                            <div class="description">Invitations | Publications | Newsletters</div>
                            <div class="py-3">
                                <input type="text" class="form-control" placeholder="Enter your email address">
                            </div>
                            <button class="btn btn-subscribe mt-1 py-2" data-toggle="modal" data-target="#subscribeModal">Subscribe</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("#mmore").click(function() {



        $('.hidem').show();


    });


    $("#wmore").click(function() {



        $('.hidew').show();


    });
</script>