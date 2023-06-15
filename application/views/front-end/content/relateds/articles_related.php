<div class="container px-lg-4 related-article mb-4">
    <div class="py-3">
        <?php 
            if ($count_related === 3) {
                echo '<h3 class="second-title text-blue py-4">Related Articles</h3>';
            } else {
                echo '<h3 class="second-title text-blue py-4">Latest Articles</h3>';
            }
        ?>

        <div class="row page-content pb-3">
            <?php for ($c = 0; $c <= 3; $c++) { ?>
            <?php
                if (isset($related[$c])) {

                    if ($related[$c]->article_id) {
                        if (file_exists(FCPATH . $related[$c]->image_name) && $related[$c]->image_name != '') {
                            $img = base_url() .'get_share_image.php?im='. $related[$c]->image_name;
                        } elseif (file_exists(FCPATH . '/resources/images' . $related[$c]->image_name) && $related[$c]->image_name != '') {
                            $img = base_url() .'get_share_image.php?im='.'/resources/images' . $related[$c]->image_name;
                        } else {
                            if (!empty($related[$c]->image_name)) {
                                $url_articles = "https://www.eria.org" . $related[$c]->image_name;
                                $response_articles = file_get_contents($url_articles);
                                if (strlen($response_articles)) {
                                    $img = "https://www.eria.org" . $related[$c]->image_name;
                                } else {
                                    $img = base_url() .'get_share_image.php?im='.'/upload/Article.jpg';
                                }
                            } else {
                                $img = base_url() .'get_share_image.php?im='.'/upload/Article.jpg';
                            }
                        }
            ?>
            <?php
                if ($related[$c]->article_type == 'news') {
                    $slug = 'news-and-views/';
                } else {
                    $slug = 'database-and-programmes/';
                }
            ?>
            <div class="col-md-4 col-12 mb-4">

                <div class="article-card">
                    <div class="article-card-image position-relative d-flex align-items-center overflow-hidden">
                        <a href="<?= base_url().$slug.$related[$c]->uri ?>" class="w-100">
                            <img class="responsive position-relative" style="height: 230px" src="<?= $img ?>">
                            <div class="card-image-background position-absolute">
                                <img class="w-100" src="<?= $img ?>">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="fs-xs font-weight-medium mt-2 mb-2 article-category">
                    <?php
                        
                        if (isset($related[$c]->article_id)) {
                            $tags = $this->frontModel->tag_topic_programmes($related[$c]->article_id);
                            /*
                            ** it's topics
                            */ 
                            if (!empty($tags)) {
                                echo str_replace('<br>', '', ltrim($tags, ':'));
                            }
                        }
                    ?>
                </div>
                <div class="card-title mt-1">
                    <a href="<?= base_url().$slug.$related[$c]->uri ?>">
                        <?php echo RemoveBS(str_replace('â€™', "", $related[$c]->title)); ?>
                    </a>
                </div>
                <div>
                    <?php if ($related[$c]->author != '') { ?>
                    <span class="font-merriweather text-blue font-weight-semibold">Editor(s)/Author(s): </span>
                    <span class="author"><?= substr($related[$c]->author, 0, 20) ?></span>
                    <span class="date hori-line">---</span>
                    <?php } ?>
                    <span class="date"> <?php echo date('j  F Y', strtotime($related[$c]->posted_date)) ?>
                    </span>
                </div>
            </div>

            <?php }
                }
            } ?>
        </div>
    </div>
</div>