<div class="container mb-4">
    <form class="bottom-divider" id="form_id" method="post">
        <!-- <input type="hidden" class="publication" name="publication" value="<?= $nt ?>"> -->
        <!-- <input type="hidden" class="author" name="author" value=""> -->
        <!-- <input type="hidden" name="region" class="region" value="<?= $nt ?>"> -->
        <!-- <input type="hidden" name="kw" value="<?= $nt ?>"> -->
        <div class="row">
            <div class="col-md-6 order-1 mb-3 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button id="button-addon2" type="submit"
                            class="btn btn-link text-secondary border border-right-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <input type="search" id="key" name="key" placeholder="Keywords" aria-describedby="button-addon2"
                        class="form-control border-left-0">
                </div>
            </div>
            <div class="col-md-3 order-2">
                <div class="dropdown">
                    <div class="dropdown mb-3">
                        <button type="button"
                            class="publication-collapsible profile-overView1 search-result-btn w-100">Topics
                            <span id="countTopics"></span>
                        </button>
                        <div class="new_publication publicationcontent">
                            <div class="new_publication_inside">
                                <div class="check-btns">
                                    <label class="container-check"> Select All
                                        <input type="checkbox" id="tall" name="topics[]">
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php 
                                        foreach ($topics as $ptypes) {
                                            echo '<label class="container-check">
                                                    '.$ptypes->category_name.'
                                                    <input class="tall" type="checkbox" id="tall" name="topics[]"
                                                        value="'.$ptypes->category_id.'">
                                                    <span class="checkmark"></span>
                                                </label>';
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 order-4 order-md-3 mb-3"> <button id="_msearch" class="btn third-button w-100"
                    type="button">Search</button></div>
            <div class="col-md-6 order-4 mb-3">
                <div class="dropdown">
                    <select name="cat" id="cat" class="custom-select form-control">
                        <option>Category</option>
                        <?php foreach ($cat as $topics) { ?>
                        <?php 
                            if ($topics->category == 'Unclassified') {
                                $topic_category = 'Others';
                            } else {
                                $topic_category = $topics->category;
                            }
                                
                            ?>
                        <option <?php if ($type == $topics->category) { ?> selected <?php } ?>
                            value="<?= $topics->ec_id ?>"><?= $topic_category ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 order-4 mb-3">
                <div class="dropdown">
                    <select name="subcat" id="subcat" class="custom-select form-control">
                        <option>Subcategory</option>
                        <?php
                        $subcategories = $this->frontModel->getAllSubCategories('multimedia');
                        ?>
                        <?php foreach ($subcategories as $value) { ?>
                        <option value="<?= $value->es_id; ?>"><?= ucfirst($value->s_catogery); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>