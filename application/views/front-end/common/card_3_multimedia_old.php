<style>
.iframe-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>

<div class="multimedia-card card card-body d-none border-0 rounded-0 bg-second-gray d-md-block mb-3">
    <h4 class="font-merriweather font-weight-bold text-blue mb-3">Multimedia</h4>
    <?php
    $c3 = $this->header->getPageCardMultimedia();
    ?>
    <div class="d-none d-sm-block">
        <?php
        foreach ($c3 as $key => $c3) {
            if ($c3['video_url'] != '') {
        ?>
        <div class="d-none d-sm-block mb-3">
            <div id="accordion<?php echo $key; ?>">
                <div id="heading<?php echo $key; ?>" data-toggle="collapse"
                    data-target="#collapseMultimedia<?php echo $key; ?>" aria-expanded="true"
                    aria-controls="collapse<?php echo $key; ?>" class="pb-2"
                    style="position:relative;font-weight: 500 !important;font-size: 12px;color: #69AAB4;cursor: pointer;">
                    <div style="width: 279px;">
                        <a class="font-merriweather"
                            href="<?= base_url() ?>multimedia/<?php echo strtolower($c3['category']); ?>/<?php echo $c3['uri']; ?>">
                            <?php echo str_replace('â€”', "-", substr($c3['title'], 0, 200)); ?>...
                        </a>
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"
                        style="position: absolute;right: 5%;bottom: 50%;"></i>
                </div>
                <div id="collapseMultimedia<?php echo $key; ?>" class="collapse"
                    aria-labelledby="heading<?php echo $key; ?>" data-parent="#accordion<?php echo $key; ?>">

                    <div class="iframe-container">
                        <?php echo $c3['video_url']; ?>
                    </div>

                </div>
            </div>
            <hr>
        </div>
        <?php   } else {
            ?>
        <div class="row py-3 section-divider d-none d-sm-block">
            <div id="accordion<?php echo $key; ?>">
                <div class="" id="heading<?php echo $key; ?>" data-toggle="collapse"
                    data-target="#collapseMultimedia<?php echo $key; ?>" aria-expanded="true"
                    aria-controls="collapseMultimedia<?php echo $key; ?>">
                    <div style="width: 279px;">
                        <a
                            href="<?= base_url() ?>multimedia/<?php echo strtolower($c3['category']); ?>/<?php echo $c3['uri']; ?>">
                            <?php echo str_replace('â€”', "-", substr($c3['title'], 0, 200)); ?>...
                        </a>
                    </div>
                    <i class="fa fa-chevron-down" aria-hidden="true"
                        style="position: absolute;right: 5%;bottom: 50%;"></i>
                </div>
                <div id="collapseMultimedia<?php echo $key; ?>" class="collapse"
                    aria-labelledby="heading<?php echo $key; ?>" data-parent="#accordion<?php echo $key; ?>">
                    <div class="heading2" style="margin-top: 5px;padding: 0 11px !important;">
                        <img width="100%" height="200px" src="<?php echo base_url(); ?>upload/Video.jpg">
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>