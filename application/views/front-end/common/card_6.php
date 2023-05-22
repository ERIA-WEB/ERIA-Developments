<?php
$topic = $this->header->getPage_cat('pubtypes');
?>

<div class="related-category-event p-4 d-none d-sm-block mb-4">
    <h6 class="mt-2 related-topic-titlle">Related Categories :</h6>
    <?php for ($s = 0; $s <= 2; $s++) { ?>
    <h6 class="mt-3 related-cat-topic"> <a
            href="<?= base_url() ?>publications/category/<?= $topic[$s]->uri ?>"><?= $topic[$s]->category_name ?></a> </h6>
    <?php } ?>
</div>