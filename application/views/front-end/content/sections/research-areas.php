<div class="research-areas py-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="<?= base_url() ?>research" class="main-title text-blue" aria-label="Research Areas">Research
                    Areas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex flex-wrap">
                <?php $rarea = $this->header->get_menuTopic('topics', 30)  ?>
                <?php foreach ($rarea as $rarea) { ?>
                <?php if ($rarea->published != 0) { ?>
                <div class="research-items font-montserrat mb-3">
                    <a class="research-item" href="<?= base_url() ?>research/topic/<?= $rarea->uri ?>"
                        aria-label="<?= $rarea->category_name ?>">
                        <?= $rarea->category_name ?>
                    </a>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>