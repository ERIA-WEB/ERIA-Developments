<style>
.iframe-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.Podcasts .collapse .iframe-container,
.Podcasts .collapsing .iframe-container {
    padding-bottom: 49.25%;
}

.iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.multimedia-card-collapse-icon {
    height: 54px;
    width: 54px;
    background-color: #1A3B70;
}

.btn.multimedia-card-collapse-button[aria-expanded="false"] .bi-chevron-down {
    transform: rotate(-90deg);
    transition: all 0.3s ease-in-out;
}

.btn.multimedia-card-collapse-button[aria-expanded="true"] .bi-chevron-down {
    transform: rotate(0deg);
    transition: all 0.3s ease-in-out;
}
</style>

<?php $c3 = $this->header->getPageCardMultimedia(); ?>
<?php if (!empty($c3)) { ?>
<div class="multimedia-card card card-body mb-4 rounded-0 bg-second-gray border-0">
    <?php
    $category_multimedia = [
        'Podcasts' => [
            'name' => 'Podcast',
            'class' => 'bg-blue',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-mic" viewBox="0 0 16 16">
                            <path
                                d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0v5zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z" />
                        </svg>',
        ], 
        'Video' => [
            'name'          => 'Video',
            'class'    => 'bg-main-green',
            'icon'          => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-camera-reels" viewBox="0 0 16 16">
                                <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0z"/>
                                <path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7zm6 8.73V7.27l-3.5 1.555v4.35l3.5 1.556zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z"/>
                                <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>',
        ],  
        'Webinar' => [
            'name'          => 'Webinar',
            'class'    => 'bg-main-orange',
            'icon'          => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                                <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                                </svg>',
        ],
    ];

    ?>
    <h4 class="font-merriweather font-weight-bold text-blue mb-3">Latest Multimedia</h4>
    <div class="accordion" id="multimediaCardAccordion">
        <?php foreach ($c3 as $key => $c3):?>

        <?php
            $tools = $category_multimedia[$c3['category']];
        ?>

        <div class="<?php echo $c3['category']; ?>">
            <div id="heading<?php echo $key; ?>">
                <button
                    class="btn multimedia-card-collapse-button text-left px-0 w-100 d-flex justify-content-between align-items-center <?php echo ($key == 0 ? "" : "collapsed")  ?>"
                    type="button" data-toggle="collapse" data-target="#<?php echo $key; ?>" aria-expanded="false"
                    aria-controls="<?php echo $key; ?>">
                    <div class="multimedia-card-header d-flex align-items-center">
                        <div
                            class="d-flex justify-content-center align-items-center text-light p-2 <?= $tools['class']; ?>">
                            <?= $tools['icon']?>
                        </div>
                        <span class="font-merriweather ml-2"><?= $tools['name'];?></span>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            <div id="<?php echo $key; ?>" class="collapse" aria-labelledby="accordion<?php echo $key; ?>"
                data-parent="#multimediaCardAccordion">
                <div class="iframe-container my-2">
                    <?php echo $c3['video_url']; ?>
                </div>
                <a href="<?= base_url() ?>multimedia/<?php echo strtolower($c3['category']); ?>/<?php echo $c3['uri']; ?>"
                    class="mt-1 font-weight-semibold">
                    <?php echo str_replace('â€”', "-", substr($c3['title'], 0, 200)); ?>
                </a>
            </div>
            <hr>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php } ?>