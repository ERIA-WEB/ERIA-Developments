<div class="container px-lg-4 related-article mb-5">
    <div class="page-content py-3">
        <?php 
            if ($count_related_publications === 2) {
                echo '<h3 class="second-title text-blue py-4">Related Articles</h3>';
            } else {
                echo '<h3 class="second-title text-blue py-4">Latest Articles</h3>';
            }
        ?>
        <div class="row">
            <?php for ($t = 0; $t <= 2; $t++) {
                if (isset($publ[$t])) {
                    if (file_exists(FCPATH . $publ[$t]->image_name)) {
                        $img = base_url() . $publ[$t]->image_name;
                    } else if ($publ[$t]->image_name) {
                        $img = "https://www.eria.org" . $publ[$t]->image_name;
                    } else {

                        if ($publ[$t]->article_type == 'publications') {
                            $img = "upload/Publication.jpg";
                        } else {
                            $img = "upload/Article.jpg";
                        }
                    }
            ?>
            <div class="col-md-6 col-12 mb-4">
                <div class="row pb-4 mx-1">
                    <div class="col-md-5 col-xs-12 mr-m m-0 p-0 col-100-w mb-3 mb-lg-0">
                        <a href="<?php echo base_url() ?>research/<?php echo $publ[$t]->uri ?>" class="w-100">
                            <img class="responsive" src=" <?php echo $img ?>">
                        </a>
                    </div>
                    <div class="col-md-7 col-xs-12 col-100-w">
                        <div class="fs-xs font-weight-medium mb-2 article-category">
                            <?php
                                if (isset($publ[$t])) {
                                    $topics_related = $this->frontModel->getTopicRelatedData($publ[$t]->uri);
                                    if (!empty($topics_related)) {
                                        echo $topics_related;
                                    }
                                } else {
                                    echo '';
                                }
                                
                                ?>
                        </div>
                        <div class="card-title">
                            <a href="<?php echo base_url() ?>research/<?php echo $publ[$t]->uri ?>">
                                <?php echo str_replace(array("â€™", "â€”", "â€“", "â€˜"), "'", $publ[$t]->title); ?>
                            </a>
                        </div>

                        <div class="category font-italic d-none">
                            <?php echo str_replace(',', ', ', $publ[$t]->tags); ?>
                        </div>

                        <div class="text-blue date">
                            <?php echo date('j  F Y', strtotime($publ[$t]->posted_date)) ?> </div>

                        <div class="py-2" style="display: grid;">
                            <span class="font-merriweather text-blue font-weight-semibold fs-xs">Editor(s)/Author(s):
                            </span>
                            <span class="date">
                                <?php 
                                    if ($publ[$t]->author != '' AND $publ[$t]->editor != '') {
                                        echo str_replace(',', ', ', $publ[$t]->editor).', '.str_replace(',', ', ', $publ[$t]->author); 
                                    } elseif ($publ[$t]->author != '' AND $publ[$t]->editor == '') {
                                        echo str_replace(',', ', ', $publ[$t]->author);
                                    } elseif ($publ[$t]->author == '' and $publ[$t]->editor != '') {
                                        echo str_replace(',', ', ', $publ[$t]->editor);
                                    } else {
                                        echo '';
                                    }
                                ?>
                            </span>
                        </div>

                        <div class="description d-none">
                            <?php
                            $ns = strip_tags(substr($publ[$t]->content, 0, 150));
                            $str = substr($ns, 0, strrpos($ns, ' '));
                            $nb = str_replace("â€™", "'", $str);
                            echo $nb . "<a href='" . base_url() . "publications/" . $publ[$t]->uri . "'>[...]</a>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } ?>
        </div>
    </div>
</div>