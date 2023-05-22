<?php
//$topic = $this->header->getPage_topic('newscategories');
$topic = $this->header->getPage_topic('newscategories');
//var_dump($topic);
// foreach ($topic as $d) {
//  echo $d->category_name."<br>";
// }
?>

<div class="related-category-event p-3 pt-4 pl-4 d-none d-sm-block">
    <h6 class="mt-2 related-topic-titlle">Related Topics :</h6>
    <?php for ($s = 0; $s <= 2; $s++) { ?>
    <h6 class="mt-3 related-cat-topic"><a
            href="<?= base_url() ?>update/type/<?= $topic[$s]->uri ?>"><?= $topic[$s]->category_name ?></a> </h6>
    <?php } ?>
</div><br>