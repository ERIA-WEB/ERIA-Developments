
    <div class="container-fluid p-0 m-0">
        <img class="responsive" src="<?=base_url()?><?=$articles[0]['image_name']?>">
    </div>

    <?php //var_dump($articles[0]['image_name']) ?>


    <div class="container background">
        <div class="row py-3 section-divider">
            <div class="col-md-12 col-xs-12">
                <div class="category">
                    <?php
                    $cname='';
                    //  echo rtrim($cname, ", ");
                    ?>
                    <?php

                    echo str_replace(",",",&nbsp",$articles[0]['tags']);


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



                        //   echo rtrim($cname, ", ");

                        ?>

                        <?php



                        echo str_replace(",",",&nbsp",$articles[$x]['tags']);




                        ?>
                    </div>
                    <div class="heading"><a href="<?=base_url()?>Publications/Detail/<?=$articles[$x]['uri']?>"> <?=$articles[$x]['title']?> </a> </div>
                </div>
            </div>

        <?php } ?>









    </div>




</div>