<div class="container px-lg-4 related-article mb-5">
    <div class="page-content py-3">
        <?php 
            if ($count_related_publications === 2) {
                echo '<h3 class="second-title text-blue py-4">Related Publications</h3>';
            } else {
                echo '<h3 class="second-title text-blue py-4">Latest Publications</h3>';
            }
        ?>
        <div class="row">
            <?php for ($t = 0; $t <= 2; $t++) {

                if (isset($publ[$t])) {
                    if (!empty($publ[$t]->image_name)) {
                        if (file_exists(FCPATH . $publ[$t]->image_name) && $publ[$t]->image_name != '') {
                            $img = base_url() .'get_share_image.php?im='. $publ[$t]->image_name;
                        } elseif (file_exists(FCPATH . '/resources/images' . $publ[$t]->image_name) && $publ[$t]->image_name != '') {
                            $img = base_url() .'get_share_image.php?im='.'/resources/images' . $publ[$t]->image_name;
                        } else {
                            $url_pub = "https://www.eria.org" . $publ[$t]->image_name;
                            $response_pub = @get_headers($url_pub, 1);
                            $file_exists_pub = (strpos($response_pub[0], "404") === false);

                            if ($file_exists_pub == 1) {
                                $img = "https://www.eria.org" . $publ[$t]->image_name;
                            } else {
                                $img = base_url() .'get_share_image.php?im='.'/upload/thumbnails-pub.jpg';
                            }
                        }
                    } else {
                        $url_pub = "https://www.eria.org" . $publ[$t]->image_name;
                        $response_pub = @get_headers($url_pub, 1);
                        $file_exists_pub = (strpos($response_pub[0], "404") === false);
                        
                        if ($file_exists_pub == 1) {
                            $img = "https://www.eria.org" . $publ[$t]->image_name;
                            if (file_exists($img)) {
                                $img = $img;
                            } else {
                                $img = base_url() .'get_share_image.php?im='.'/upload/thumbnails-pub.jpg';
                            }
                            
                        } else {
                            $img = base_url() .'get_share_image.php?im='.'/upload/thumbnails-pub.jpg';
                        }
                    }
            ?>
            <div class="col-md-6 col-12 mb-4">
                <div class="row pb-4 mx-1">
                    <div class="col-md-5 col-xs-12 mr-m -2 m-0 p-0 col-100-w">
                        <a href="<?php echo base_url() ?>publications/<?php echo $publ[$t]->uri ?>" class="w-100">
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
                            <a href="<?php echo base_url() ?>publications/<?php echo $publ[$t]->uri ?>" class="w-100">
                                <?php echo str_replace(array("â€™", "â€”", "â€“", "â€˜"), "'", $publ[$t]->title); ?>
                            </a>

                            <div class="category font-italic d-none">
                                <?php echo str_replace(',', ', ', $publ[$t]->tags); ?>
                            </div>
                        </div>
                        <h6 class="text-blue date my-3">
                            <?php echo date('j  F Y', strtotime($publ[$t]->posted_date)) ?> </h6>
                        <div>
                            <h6 class="font-merriweather text-blue font-weight-semibold fs-xs">Editor(s)/Author(s):</h6>
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