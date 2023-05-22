<?php

$sliders=$slider;

?>

<style>

    .h1, h1 {
        font-size: 2rem !important;
    }

    .nav-link_new {

        margin-top: 6px !important;

    }
</style>

<div class="container-fluid page-cover">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xs-8 m-0 p-0">
            <div id="carouselExampleControls" class="carousel slide cover-responsive" data-ride="carousel">
                <div class="carousel-inner cover-responsive">



                    <?php $x=0; foreach ($sliders as $slider) { $x++;  ?>

                    <div class="carousel-item <?php if($x==1) { ?>active <?php } ?> cover-responsive">

                        <div class="col-md-7 col-lg-7 col-xs-12 m-0 p-0 h-100">
                            <img class="cover-left-image cover-responsive" src="https://www.eria.org<?=$slider->image_name?>">
                        </div>
                        <div class="container col-md-5 col-lg-5 col-xs-12 h-100 cover-right">




                            <div class="container  p-4 cover-right-spacing">

                                <h3 class="text-light"><?=$slider->heading ?></h3>
                                <p class="text-light py-3">

                                <?php


                                //echo strlen($slider->content)."<br>";




                                $ns = substr(Strip_tags($slider->content),0,280);


                                $str=substr($ns, 0, strrpos($ns, ' '));

                                if(strlen($slider->content)>280)
                                {
                                    echo $str."(...)";
                                }
                                else
                                {
                                    echo $str;
                                }


                                ?>

                                </p>


                                <a href="<?=$slider->banner_url?>" target="<?=$slider->banner_target?>" class="btn btn-cover explore-btn">Read More</a>











                                <div style="font-size:60px" class="  mt-4 text-light">


                                    <?php if($x==1) { ?> <span style="font-size:99px" class="bold">.</span> . . . . <?php } ?>
                                    <?php if($x==2) { ?> . <span style="font-size:99px" class="bold">.</span> . . .   <?php } ?>
                                    <?php if($x==3) { ?>  . . <span style="font-size:99px" class="bold">.</span> . . <?php } ?>
                                    <?php if($x==4) { ?>  . . . <span style="font-size:99px" class="bold">.</span> . <?php } ?>
                                    <?php if($x==5) { ?>  . . . . <span style="font-size:99px" class="bold">.</span> <?php } ?>



                                </div>
                            </div>
                        </div>

                    </div>


                  <?php } ?>

                    <div class="carousel-controller">
                        <div class="btn-container d-flex">
                            <div class="left" href="#carouselExampleControls" role="button" data-slide="prev">
                                <!-- <i class="fa fa-arrow-left"></i> -->
                                <img src="<?php echo base_url() ?>v6/assets/Icons/arrow-left.png" />
                            </div>
                            <div class="right" href="#carouselExampleControls" role="button" data-slide="next">
                                <!-- <i class="fa fa-arrow-right"></i> -->
                                <img src="<?php echo base_url() ?>v6/assets/Icons/arrow-right.png" />
                            </div>
                        </div>
                    </div>

                    <!-- <a class="carousel-control-prevs" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-nexts" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a> -->

                </div>
            </div>
        </div>

        <div style="display: none" class="col-md-4 col-lg-4 col-xs-4 m-0 p-0">
            <div id="carouselExampleControls" class="carousel slide cover-responsive" data-ride="carousel">
                <div class="carousel-inner cover-responsive">



                    <?php $x=0; foreach ($sliders as $slider) { $x++;  ?>

                        <div class="carousel-item <?php if($x==1) { ?>active <?php } ?> cover-responsive">

                            <div class="col-md-7 col-lg-7 col-xs-12 m-0 p-0 h-100">
                                <img class="cover-left-image cover-responsive" src="https://www.eria.org<?=$slider->image_name?>">
                            </div>
                            <div class="container col-md-5 col-lg-5 col-xs-12 h-100 cover-right">




                                <div class="container  p-4 cover-right-spacing">

                                    <h3 class="text-light"><?=$slider->heading ?></h3>
                                    <p class="text-light py-3">

                                        <?php


                                        //echo strlen($slider->content)."<br>";




                                        $ns = substr(Strip_tags($slider->content),0,280);


                                        $str=substr($ns, 0, strrpos($ns, ' '));

                                        if(strlen($slider->content)>280)
                                        {
                                            echo $str."(...)";
                                        }
                                        else
                                        {
                                            echo $str;
                                        }


                                        ?>

                                    </p>


                                    <a href="<?=$slider->banner_url?>" target="<?=$slider->banner_target?>" class="btn btn-cover explore-btn">Read More</a>











                                    <div style="font-size:60px" class="  mt-4 text-light">


                                        <?php if($x==1) { ?> <span style="font-size:99px" class="bold">.</span> . . . . <?php } ?>
                                        <?php if($x==2) { ?> . <span style="font-size:99px" class="bold">.</span> . . .   <?php } ?>
                                        <?php if($x==3) { ?>  . . <span style="font-size:99px" class="bold">.</span> . . <?php } ?>
                                        <?php if($x==4) { ?>  . . . <span style="font-size:99px" class="bold">.</span> . <?php } ?>
                                        <?php if($x==5) { ?>  . . . . <span style="font-size:99px" class="bold">.</span> <?php } ?>



                                    </div>
                                </div>
                            </div>

                        </div>


                    <?php } ?>

                    <div class="carousel-controller">
                        <div class="btn-container d-flex">
                            <div class="left" href="#carouselExampleControls" role="button" data-slide="prev">
                                <!-- <i class="fa fa-arrow-left"></i> -->
                                <img src="<?php echo base_url() ?>v6/assets/Icons/arrow-left.png" />
                            </div>
                            <div class="right" href="#carouselExampleControls" role="button" data-slide="next">
                                <!-- <i class="fa fa-arrow-right"></i> -->
                                <img src="<?php echo base_url() ?>v6/assets/Icons/arrow-right.png" />
                            </div>
                        </div>
                    </div>

                    <!-- <a class="carousel-control-prevs" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-nexts" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a> -->

                </div>
            </div>
        </div>


    </div>
</div>

<!-- Featured topics -->
<nav class="navbar navbar-expand-sm featured-topic-areas p-md-3 px-5 py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="navbar-nav justify-content-end" style="font-size: 14px">
                    <li class="nav-item main-topic">
                        <a class="nav-link font-italic">Featured Topics</a>
                    </li>

                    <?php $new_rarea = $this->header->get_menuTopic('newscategories',6)  ?>


<?php foreach ($new_rarea as $new_rarea) {

    ?>

    <li class="nav-item topic-item">
        <a style="padding-left: 18px; " class="nav-link nav-link_new" href="<?=base_url()?>News/catogery/<?=$new_rarea->category_name?>"><?=strtoupper($new_rarea->category_name)?></a>
    </li>


                    <?php


} ?>






                </ul>
            </div>
        </div>
    </div>
    </div>
</nav>

<!-- Page content -->
<div class="page-content pt-3 p-4">
    <div class="container">
        <div class="row">

            <!-- Content section left -->
            <div class="col-md-8 col-xs-12">
                <div class="container-fluid">

                    <div class="row py-3 mb-3">
                        <div class="col-12  m-0 p-0">
                            <div class="main-title">Recent Updates</div>
                        </div>
                    </div>

                    <?php $s=0; foreach ($newsall as $news) {  if(strip_tags($news['title'])!='Inaugural Meeting of APEN Business Club') { $s++;   ?>
                    <div class="row py-4 <?php if($s!=4) { ?> bottom-section-divider <?php } ?>">
                        <div class="col-md-5 col-xs-12 mr-md-2 m-0 p-0">
                            <img class="responsive" src="https://www.eria.org<?=$news['image_name']?>">
                        </div>
                        <div class="col-md-6 col-xs-12 mobile-padding-0">
                            <div class="category">

                                <?php

                                $cname='';

                                foreach ($news['cat'] as $cat)
                                {
                                    $cname .=$cat->category_name.",";
                                }

                              //  echo rtrim($cname, ", ");

                                 echo ucfirst($news['article_type']);

                                if($news['article_type']=='news')
                                {
                                    $url='news/details/'.$news['uri'];
                                }
                                else
                                {
                                    $url='news/details/'.$news['uri'];
                                }

                                ?>

                            </div>
                            <a href="<?php echo base_url() ?><?=$url?>">
                                <div class="heading"><?=strip_tags($news['title'])?></div>
                            </a>
                            <div>
                                <span style="display:none" class="by">by</span>
                                <span style="display:none" class="author"><?php if($news['editor']){ echo $news['editor']; }else { echo "Editor";  }?></span>
                                <span style="display:none" class="hori-line">----</span>
                                <span class="date"><?=$news['posted_date']?></span>
                            </div>
                            <div class="description"><?php $ns = substr(strip_tags($news['content']),0,159);



                                $str=substr($ns, 0, strrpos($ns, ' '));




                                if(strlen($news['content'])>159)
                                {
                                    echo $str."(...)";
                                }
                                else
                                {
                                    echo $str;
                                }


                            ?></div>
                        </div>
                    </div>


                    <?php } } ?>



                </div>
            </div>

            <!-- Content section right -->
            <div class="content-section-right col-md-4 col-xs-12 py-4">
                <div class="container-fluid p-0 m-0">
                    <img class="responsive" src="https://www.eria.org<?=$articles[0]['image_name']?>">
                </div>

                <?php //var_dump($articles[0]['image_name']) ?>


                <div class="container background">
                    <div class="row py-3 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category">

                                <?php





                                $cname='';

                                foreach ($articles[0]['cat'] as $cat)
                                {
                                    $cname .=$cat->category_name.",";
                                }

                              //  echo rtrim($cname, ", ");

                                ?>
                                <?php

                                echo str_replace(",",",&nbsp&nbsp&nbsp",$articles[0]['tags']);


                                ?>

                            </div>
                            <div class="heading">
                                <a href="<?=base_url()?>Publications/Detail/<?=$articles[0]['uri']?>">
                                    <?=$articles[0]['title']?> </a></div>
                            <div>
                                <span style="display:none" class="by">by</span>
                                <span style="display:none" class="author"><?php if($articles[0]['editor']){ echo $articles[0]['editor']; } else { echo "Editor"; } ?></span>
                                <span style="display:none" class="hori-line">----</span>
                                <span class="date"><?=$articles[0]['posted_date']?></span>
                            </div>
                        </div>
                    </div>


                    <?php for($x=1; $x<=3; $x++) { ?>

                    <div class="row py-3 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="category">

                                <?php

                                $cname='';

                                foreach ($articles[$x]['cat'] as $cat)
                                {
                                    $cname .=$cat->category_name.",";
                                }

                             //   echo rtrim($cname, ", ");

                                ?>

                                <?php



                                echo str_replace(",",",&nbsp&nbsp&nbsp",$articles[$x]['tags']);




                                ?>
                            </div>
                            <div class="heading"><a href="<?=base_url()?>Publications/Detail/<?=$articles[$x]['uri']?>"> <?=$articles[$x]['title']?> </a> </div>
                        </div>
                    </div>

                 <?php } ?>









                </div>

                <div class="container mt-5 pt-2 subscribe">
                    <div class="row py-3 pb-4 section-divider">
                        <div class="col-md-12 col-xs-12">
                            <div class="heading">Subscribe to Our Mailing List</div>
                            <div class="subscribe-description">Invitations | Publications | Newsletters</div>
                            <div class="py-3">
                                <input type="text" class="form-control" placeholder="Enter your email address">
                            </div>
                            <button class="btn btn-subscribe mt-1 py-2" data-toggle="modal"
                                    data-target="#subscribeModal">Subscribe</button>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>


<!--Author carousel -->
<div class="carousel author container my-4 px-md-0 px-5">
    <div class="author-head-title">Our experts</div>
    <div class="row mx-auto my-auto">
        <div id="AuthorCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">

                <?php $e=0; foreach($experts as $experts) { $e++;  ?>
                <div class="carousel-item <?php if($e==1) { ?> active <?php } ?> ">
                    <div class="col-md-4 pl-0 pr-md-4 item-inner">
                        <div class="card card-body border-0 px-0">
                            <div class="person-main pl-5 pr-4 py-4">
                                <div class="image-container">
                                    <img width="100" height="100" class="img-fluid img-round" src="https://www.eria.org<?=$experts['image_name']?>">
                                </div>
                                <div class="name mt-2"><a href="<?php echo base_url() ?>Experts/detail/<?=$experts['uri']?>"><?=$experts['title']?></a></div>
                                <div class="status">  <?php



                                     $ns= substr(strip_tags($experts['major']),0,120);


                                    $str=substr($ns, 0, strrpos($ns, ' '));

                                    echo $str;

                                    ?></div>
                            </div>
                            <div class="person-description pl-5 pr-4 py-4">
                                <div class="department"><?=$experts['major']?></div>
                                <div class="description mt-2 pr-5"><?php


                                    $ns= substr(strip_tags($experts['content']),0,50);


                                    $str=substr($ns, 0, strrpos($ns, ' '));

                                    if(strlen($experts['content'])>50)
                                    {
                                        echo $str."(...)";
                                    }
                                    else
                                    {
                                        echo $str;
                                    }

                                   // echo substr(strip_tags($experts['content']),0,50); ?>
                                </div>
                                <div>
                                    <span style="display:none" class="publications">Publications</span>
                                    <span style="display:none" class="hori-line date">---</span>
                                    <span style="display:none"  class="date"><?=$experts['posted_date']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              <?php } ?>

            </div>

            <a class="carousel-control-prev w-auto author-slider-btn-left" href="#AuthorCarousel" role="button"
               data-slide="prev">
                <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_left.png">
                <!-- <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span> -->
            </a>

            <a class="carousel-control-next w-auto author-slider-btn-right" href="#AuthorCarousel" role="button"
               data-slide="next">
                <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_right.png">
                <!-- <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span> -->
            </a>

        </div>
    </div>
</div>

<!-- highlights -->
<div style="height:600px" class="container-fluid highlights py-4 p-4">
    <div class="container">
        <h2 class="font-weight-bold text-light">Highlighted Publications</h2>

        <div class="container-lg my-3">
            <div id="highlightsCarousel" class="carousel slide" data-ride="highlightsCarousel">
                <!-- Wrapper for carousel items -->
                <!-- ©Hashan Pallewatte 2020  -->
                <!-- Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including files downloadable from this website, without the permission of the copyright owner. -->
                <div style="height:550px" class="carousel-inner">

                    <?php $x=0;  foreach ($publications as $pub ) { $x++; $result=''; $nresult='';  ?>

                    <div class="carousel-item <?php if($x==1) { ?> active <?php  } ?> ">
                        <div class="row pt-4">
                            <div class="col-md-4 col-xs-12">
                                <div class="highlight-image float-right mb-5">
                                    <img height="400" style="height:400px !important;" class="img-fluid" src="https://www.eria.org<?=$pub['image_name']?>">
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-12 text-light">
                                <div class="highligh-heading">
                                    <?=str_replace("â€™", "'", $pub['title'])?>
                                </div>
                                <div class="highlight-author pb-4 pt-1">
                                   <?php


                                  $nc =  count($pub['editornew'])+count($pub['authornew']);


                                  if($nc!=0)
                                  {

                                      if(count($pub['editornew'])!=0) {
                                          ?>

                                          Editor(s) :  <?php foreach ($pub['editornew'] as $ed) {






                                              $result.="<a style='color:white' href='".base_url()."Experts/detail/$ed->uri' target='_blank'>".$ed->title."</a>, ";












                                          }
echo rtrim($result, ', ');

                                          if(count($pub['authornew'])!=0) {

                                              ?> / <?php
                                          }

                                          ?>

                                          <?php

                                      }

                                      if(count($pub['authornew'])!=0) {
                                          ?>

                                          Author(s) :  <?php foreach ($pub['authornew'] as $ed) {

                                              $nresult.="<a style='color:white' href='".base_url()."Experts/detail/$ed->uri' target='_blank'>".$ed->title."</a>, ";


                                          } ?>

                                          <?php

                                          echo rtrim($nresult, ', ');

                                      }

                                  }

                                    else
                                    {

                                   if($pub['author']) { ?>


                                       <span class="book-by"> Author(s) </span><span class="book-by-author"><?=$pub['author']?></span>






                                   <?php  if($pub['editor']) { ?> / <?php }  }


                                        if($pub['editor']) { ?>


                                            <span class="book-by"> Editor(s) </span><span class="book-by-author"><?=$pub['editor']?></span>






                                        <?php }



                                    }



                                   ?>


                                    <br>
                                    <span class="date"> <?=$pub['posted_date']?> </span>
                                </div>
                                <div class="highlight-description pb-4">

                                    <?php   $ns = strip_tags(substr($pub['content'],0,400));


                                    $str=substr($ns, 0, strrpos($ns, ' '));

                                    if(strlen($str)>400) {
                                        echo str_replace("â€™", "'", $str) . "(...)";
                                    }
                                    else
                                    {
                                        echo str_replace("â€™", "'", $str) ;
                                    }




                                    ?>

                                </div>
                                <div class="pb-5">
                                    <a href="<?php echo base_url() ?>Publications/Detail/<?=$pub['uri']?>" class="btn btn-highlight py-2 px-4">Read More  </a>
                                </div>
                                <div style="font-size:60px " class="  mt-4 text-light">







                                    <?php if($x==1) { ?> <span style="font-size:99px" class="bold">.</span> . . . . <?php } ?>





                                    <?php if($x==2) { ?> . <span style="font-size:99px" class="bold">.</span> . . .   <?php } ?>
                                    <?php if($x==3) { ?>  . . <span style="font-size:99px" class="bold">.</span> . . <?php } ?>
                                    <?php if($x==4) { ?>  . . . <span style="font-size:99px" class="bold">.</span> . <?php } ?>
                                    <?php if($x==5) { ?>  . . . . <span style="font-size:99px" class="bold">.</span> <?php } ?>





                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>





                </div>


                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#highlightsCarousel" data-slide="prev">
                    <!-- <span class="carousel-control-prev-icon"></span> -->
                    <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_left.png">
                </a>
                <a class="carousel-control-next" href="#highlightsCarousel" data-slide="next">
                    <!-- <span class="carousel-control-next-icon"></span> -->
                    <img src="<?php echo base_url() ?>v6/assets/Icons/ovel_arrow_right.png">
                </a>

            </div>
        </div>
    </div>
</div>


<!-- MultiMedia -->
<div class="multimedia py-5 mb-5 p-4">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-xs-12 heading">
                <div class="float-left left-span align-middle font-weight-bold text-dark">Multimedia Gallery</div>
                <div class="float-right right-span align-middle d-none d-md-block font-weight-bold"><a href="<?php echo base_url() ?>NewsMultimedia"> See other multimedia</a>
                </div>
            </div>







            <div class="col-md-12 col-xs-12 px-md-0">
                <div class="row pt-4 mx-0">

                    <div class="col-md-8 col-xs-12">
                        <iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?=substr($multimedia[0]->video_url,17,100)?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        <div class="heading"><a href="<?=base_url()?>NewsMultimedia/detail/<?=$multimedia[0]->uri?>"><?=$multimedia[0]->title?></a></div>
                        <div style="color:black" class="date"><?=date('j F Y', strtotime($multimedia[0]->posted_date))?> </div>
                        <div class="description mt-3"><?php


                           // substr($multimedia[0]->content,0,195)


 $ns= substr(strip_tags($multimedia[0]->content),0,196);


                                  $str=substr($ns, 0, strrpos($ns, ' '));

                                    echo $str."(...)";



                            ?>




                        </div>
                        <button onclick="reload_('<?=base_url()?>NewsMultimedia/detail/<?=$multimedia[0]->uri?>')"  class="btn mt-3 font-weight-bold"><a href="<?=base_url()?>NewsMultimedia/detail/<?=$multimedia[0]->uri?>">LEARN MORE</a><span
                                    class="fa fa-angle-right font-weight-bold"></span></button>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?=substr($multimedia[1]->video_url,17,100)?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        <div class="heading mb-3"><a href="<?=base_url()?>NewsMultimedia/detail/<?=$multimedia[1]->uri?>">

                                <?php

                                $ns= substr(strip_tags($multimedia[1]->content),0,60);


                                $str=substr($ns, 0, strrpos($ns, ' '));

                                echo $str."(...)";  ?>



                            </a></div>
                        <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?=substr($multimedia[2]->video_url,17,100)?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        <div class="heading"><a href="<?=base_url()?>NewsMultimedia/detail/<?=$multimedia[2]->uri?>">

                            <?php

                            $ns= substr(strip_tags($multimedia[2]->content),0,60);


                            $str=substr($ns, 0, strrpos($ns, ' '));

                            echo $str."(...)";  ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Research area -->
<div class="research-areas p-4">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-3 col-xs-12 mr-5">
                <div style="font-size: 28px;">Research Areas</div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="research-items">

                    <?php $rarea = $this->header->get_menuTopic('topics',9)  ?>

                    <?php foreach ($rarea as $rarea) { ?>
                        <div class="research-item"> <a href="<?=base_url()?>Research/catogery/<?=$rarea->uri?>" >  <?=$rarea->category_name?> </a>  </div>
<?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>



<script>


    function reload_(i)
    {
        window.location = i;
    }

</script>



