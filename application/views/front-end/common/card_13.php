<?php
$c1 = $this->header->getPage_card(1);
?>

<div class="subscribe subscriber-card d-none d-sm-block px-3 py-4">
    <!--height: 270px;-->
    <h4 class="font-merriweather font-weight-bold text-white mb-3"><?= $c1->c_name ?></h4>
    <p class="description text-white"><?= $c1->headinng ?></p>
    <div class="mb-3">
        <input type="text" id="subscribe_email_box" class="form-control" placeholder="<?= $c1->sub_heading ?>">
    </div>
    <button class="btn second-button w-100 subscribe_email text"><?= $c1->button ?>
    </button>
</div>