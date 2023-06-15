<style>
.check_flag {
    background-color: #e4f4f9;
}
</style>
<div class="container-fluid px-0">
    <form class="bottom-divider" id="form_id" method="post">
        <?php 
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
            $urlArray = explode('/', $parse_url);
        ?>
        <input type="hidden" id="slug_" name="slug_" value="<?= end($urlArray); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit"
                                class="btn btn-link text-secondary border border-right-0">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="search" id="key" name="key"
                            value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placeholder="Keywords"
                            aria-describedby="button-addon2" class="form-control border-left-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="cato" value="all">
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <button type="button" class="publication-collapsible profile-overView1 search-result-btn">Topics
                        <span id="countTopics"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="tall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <?php 
                                foreach ($topics as $ptypes) {
                                    if ($research_categories_data->category_name == $ptypes->category_name) {
                                        $checked_ = 'checked';
                                    } else {
                                        $checked_ = '';
                                    }

                                    echo '<label class="container-check">
                                                '.$ptypes->category_name.'
                                                <input class="tall" '.$checked_.' type="checkbox" name="research[]" value="'.$ptypes->category_id.'">
                                                <span class="checkmark"></span>
                                        </label>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <input id="topic" type="hidden" value="all">
                    <button type="button"
                        class="publication-collapsible  profile-overView1 search-result-btn ">Publication Type <span
                            id="countPublicationType"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="pall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <?php foreach ($ptype as $ptypes) { ?>
                                <label class="container-check"> <?= $ptypes->category_name ?>
                                    <input class="pall" type="checkbox" name="research_type[]" id=""
                                        value="<?= $ptypes->category_id ?>">
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
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <input type="hidden" value="all" id="cb">
                    <button type="button" class="publication-collapsible  profile-overView1 search-result-btn ">Region
                        <span id="countRegion"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="rall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Brunei Darussalam <input class="rall" type="checkbox" name="region[]" id=""
                                        value="Brunei Darussalam"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Cambodia <input type="checkbox" class="rall" name="region[]" id="" value="Cambodia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Indonesia <input type="checkbox" class="rall" name="region[]" id=""
                                        value="Indonesia"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Malaysia <input type="checkbox" class="rall" name="region[]" id="" value="Malaysia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Lao PDR <input type="checkbox" class="rall" name="region[]" id="" value="Lao PDR">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Thiland <input type="checkbox" class="rall" name="region[]" id="" value="Thiland">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Myanmar <input type="checkbox" class="rall" name="region[]" id="" value="Myanmar">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Phillippines <input type="checkbox" class="rall" name="region[]" id=""
                                        value="Phillippines"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Singapore <input type="checkbox" name="region[]" id="" value="Singapore"> <span
                                        class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Viet Nam <input type="checkbox" class="rall" name="region[]" id="" value="Vietnam">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <button class="btn third-button w-100" id="_msearch" type="button">Search</button>
            </div>
        </div>
    </form>
</div>
<!-- <div style="display: none" class="row mt-4">
    <div class="col-md-0 py-2">
        <div class="sort-by">Sort by</div>
    </div>
    <div class="col-md-5 col-10">
        <div class="dropdown">
            <button class="btn bg-white border w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Sort by<i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Ascending</a>
                <a class="dropdown-item" href="#"> Descending</a>

            </div>
        </div>
    </div>
</div> -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/research/searchResearchCategories.js"></script>