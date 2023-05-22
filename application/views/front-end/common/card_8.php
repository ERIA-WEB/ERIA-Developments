<?php
if (isset($card_type)) {
    if ($card_type != 1) {
        echo '<div class="mb-4 headline d-none d-sm-block">Upcoming Events</div>';
    }
}
?>
<?php
$c2 = $this->header->getPage_card_events();

if ($c2) {
    if (file_exists(FCPATH . $c2['image_name']) && $c2['image_name'] != '') {
        $img = $c2['image_name'];
    } else {
        $img = "upload/Event.png";
    }

?>
    <div class="container-fluid p-0 m-0 d-none d-sm-block" style="background-color: var(--primaryBlue);">
        <img class="responsive" src="<?= base_url() ?><?= $img ?>">
    </div>
    <div style="background: #F3F8FC" class="container background d-none d-sm-block">
        <div class="row py-3 section-divider d-none d-sm-block">
            <div class="col-md-12 col-xs-12 d-none d-sm-block">
                <div class="category d-none d-sm-block">

                    <?php
                    if ($c2['article_type'] == 'articles') {
                        echo "Article";
                    } else {
                        if ($c2['article_type'] == 'events') {
                            echo "Upcoming Events";
                        }
                    }
                    echo ($c2['tags']);
                    ?>
                </div>
                <div style="font-weight: 700;font-size: 22px !important;line-height: 1.23; font-family: 'SF Pro Display', 'Source Sans Pro', Arial, sans-serif; " class="heading">
                    <?php if (!empty($c2['content'])) { ?>
                        <a href="<?= base_url() ?>events/<?= $c2['uri'] ?>">
                            <?= $c2['title'] ?>
                        </a>
                    <?php } else { ?>
                        <?= $c2['title'] ?>
                    <?php } ?>
                </div>
                <div>
                    <span style="display:none" class="by">by</span>
                    <span style="display:none" class="author"> </span>
                    <span style="display:none" class="hori-line">----</span>
                    <span class="date"><?= $c2['posted_date'] ?></span>
                </div>
            </div>
        </div>
        <?php foreach ($c2['blk'] as $nd) {  ?>
            <div class="row py-3 section-divider">
                <div class="col-md-12 col-xs-12">
                    <div class="category">
                        <?php
                        if ($nd['article_type'] == 'articles') {
                            echo "Article";
                        } else {
                            echo "Upcoming Events";
                        }

                        echo $nd['tags'];
                        ?>
                    </div>
                    <div class="heading2">
                        <?php if (!empty($nd['content'])) { ?>
                            <a href="<?= base_url() ?>events/<?= $nd['uri'] ?>"> 
                                <?= $nd['title'] ?> 
                            </a> 
                        <?php } else { ?>
                            <?= $nd['title'] ?> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>