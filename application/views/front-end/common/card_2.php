<?php
$c2 = $this->header->getPage_card_news();


if (!empty($c2['blk'])) {
    $news_data['blk'] = $c2['blk'];
    $title = 'Related News';
} else {
    $news_data = $this->header->getLatestNewsPageCard();
    $title = 'Latest News';
}
// id article cards not randoms in DB => 7388,7387,7386
$c2['image_name'];
?>
<?php
if (file_exists(FCPATH . $c2['image_name']) && $c2['image_name'] != '') {
    $img = $c2['image_name'];
} else {
    $img = "upload/Event.jpg";
}
?>

<style>
.latest-news-card:last-child hr {
    display: none;
}
</style>

<div class="latest-news-card bg-light-blue px-3 py-4 mb-4">
    <h4 class="font-merriweather font-weight-bold text-blue mb-3"><?= $title; ?></h4>
    <?php foreach ($news_data['blk'] as $key => $nd) {  ?>
    <div class="latest-news-card">
        <p class="mb-1"><small>News</small></p>
        <a href="<?= base_url() ?>news-and-views/<?= $nd['uri'] ?>"
            class="font-merriweather font-weight-normal text-blue">
            <?= $nd['title'] ?>
        </a>
        <p><small><?= $nd['posted_date'] ?></small></p>
        <hr>
    </div>
    <?php } ?>
</div>