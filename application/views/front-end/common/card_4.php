<?php
$c4 = $this->header->getPage_card(4);
//var_dump($c4);
?>

<div class="container px-3 py-4 subscribe d-none d-sm-block mb-4">
    <div class="row py-3 pb-4">
        <div class="col-md-12">
            <h3 class="second-title text-white mb-3"><?= $c4->c_name ?></h3>
            <div class="description text-white mb-4"><?= $c4->headinng ?></div>
            <a href="<?= $c4->content; ?>" class="btn second-button w-100">
                <?= $c4->sub_heading ?>
            </a>
            <!-- <button class="btn second-button w-100" data-toggle="modal" data-target="#subscribeModal"> <?= $c4->sub_heading ?> </button> -->
        </div>
    </div>
</div>