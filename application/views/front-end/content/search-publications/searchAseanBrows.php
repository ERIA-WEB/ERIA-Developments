<div class="col-md-8 col-12 publication-browse-page pl-4 pr-4">
    <div class="publication-browse-tittle mb-3 d-none">
        <?php
            $g = strtoupper(str_replace("_", " ", $nt));
            echo str_replace(array("-", "%20"), " ", $g);
            ?>
    </div>
    <?php
    if ($country) {
        $country = $country;
    } else {
        $country = 'all';
    }
    ?>
    <form id="form_id" method="post">
        <input type="hidden" class="publication" name="publication" id="publication" value="<?= $nt ?>">
        <input type="hidden" class="author" name="author" id="author" value="all">
        <input type="hidden" name="region" class="region" id="region" value="<?= $country ?>">
        <input type="hidden" name="kw" value="<?= $nt ?>">
        <div class="row mb-2">
            <div class="col-md-12 pl-1 pr-1">
                <div class="my-md-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-link text-secondary border border-right-0">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Keywords" value="<?= $key ?>" id="keywords" name="key"
                            class="form-control border-left-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-1 pr-1 mb-2">
                <div class="dropdown">
                    <button type="button" class="publication-collapsible profile-overView1 search-result-btn">Author /
                        Editor (s)
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="tall">
                                    <span class="checkmark"></span>
                                </label>
                                <?php foreach ($author as $author) { ?>
                                <label class="container-check">
                                    <?= ucfirst($author->title); ?>
                                    <input class="tall" type="checkbox" name="author[]"
                                        value="<?= $author->article_id ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-1 pr-1 mb-2">
                <div class="dropdown">
                    <input id="topic" type="hidden" value="all">
                    <button type="button"
                        class="publication-collapsible profile-overView1 search-result-btn">Publication
                        Type</button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="pall">
                                    <span class="checkmark"></span>
                                </label>
                                <?php foreach ($ptype as $pub) { ?>
                                <label class="container-check"> <?= $pub->category_name ?>
                                    <input class="pall" type="checkbox" name="research_type[]" id=""
                                        value="<?= $pub->category_name ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pl-1 pr-1 mb-4">
                <div class="dropdown">
                    <input type="hidden" value="all" id="cb">
                    <button type="button"
                        class="publication-collapsible profile-overView1 search-result-btn">Region</button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="rall">
                                    <span class="checkmark"></span>
                                </label>
                                <?php
                                    $countries_asean = $this->frontModel->getCountriesAsean(16);
                                    $get_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
                                    $explodeUrl = explode('/', $get_url);
                                    
                                    $not_asean = ['Australia', 'China', 'India', 'Japan', 'New Zealand', 'Republic of Korea'];
                                    foreach ($countries_asean as $value) {
                                        
                                        $last_url = end($explodeUrl);
                                        
                                        if ($value->venue == str_replace('%20', ' ', ucfirst($last_url))) {
                                            $checked = 'checked';
                                        } else {
                                            $checked = '';
                                        }
                                        
                                        if (!in_array($value->venue, $not_asean)) {
                                            echo '<label class="container-check">
                                                    '.$value->venue.' 
                                                    <input class="rall" type="checkbox" name="region[]" value="'.$value->venue.'" '.$checked.'> 
                                                    <span class="checkmark"></span>
                                                </label>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-1 pr-1">
                <button class="btn text-light w-100 drop-btn" type="button" id="_msearch" style="padding: 11px;">
                    Search
                </button>
            </div>
        </div>
        <!-- drop sort -->
        <div class="row mt-2">
            <div style="display: none" class="col-md-6 col-xs-12 mb-md-0 mb-2 sort-section">
                <div class="sorrt-tittle">Sort by</div>
                <div class="dropdown" style="width: 100px;">
                    <button class="btn bg-white border w-100" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort By <i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="sortByPrice dropdown-item">Ascending</a>
                        <a class="sortByA dropdown-item">Descending</a>
                    </div>
                </div>
            </div>
            <div style="display: none" class="col-md-6 col-xs-12 mb-md-0 mb-2 sort-section">
                <div class="sorrt-tittle">
                    View By
                </div>
                <div class="dropdown" style="width: 80px;">
                    <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        60<i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">1</a>
                        <a class="dropdown-item" href="#">2</a>
                        <a class="dropdown-item" href="#">3</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Articles -->
    <div id="searchResult" class="sorteren"></div>
    <div class="loadButton" style="padding: 10px; text-align: center">
        <button style=" background-color: #003680;color: #f2f4f7;padding: 0.375rem 0.75rem !important;" id="ldmr"
            class="btn btn-highlight1" type="button">Load more[...] </button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/searchAseanBrows.js"></script>