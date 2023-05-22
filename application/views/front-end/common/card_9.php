<?php
$c1 = $this->header->getPage_card(9);
?>
<div class="container   pt-2 subscribe d-none d-sm-block mb-4">
    <div class="row py-3 pb-4 section-divider">
        <div class="col-md-12 col-xs-12">
            <form action="<?= base_url() ?>Home/search" method="get">
                <div style="font-weight: 700;
    font-size: 22px !important;
    line-height: 1.23; " class="heading"><?= $c1->c_name ?></div>
                <div class="subscribe-description"><?= $c1->headinng ?></div>
                <div class="py-3">
                    <input type="text" name="msearch" style="width: 100%" id="searchbar-input" class="form-control"
                        placeholder="<?= $c1->sub_heading ?>">
                </div>
                <button class="btn btn-subscribe mt-1 py-2" type="submit"
                    data-target="#subscribeModal"><?= $c1->button ?>
                </button>
            </form>
        </div>
    </div>
</div>