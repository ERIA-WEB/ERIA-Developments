<style>
.btn-group>.btn-group:not(:first-child)>.btn,
.btn-group>.btn:not(:first-child),
.input-group>.custom-file:not(:first-child) .custom-file-label,
.input-group>.custom-select:not(:first-child),
.input-group>.form-control:not(:first-child) {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
}


.highlight {
    background: #00FF00;
    padding: 1px;
    border: #00CC00 dotted 1px;
}

.input-group-addon {

    position: absolute;
    margin-left: 92%;
    margin-top: 8px;
}


a.active {

    color: #fff !important;
    background-color: #003680 !important;
    border-color: #003680 !important;
}

.table-condensed {

    width: 100%;

}

.datepicker-switch {
    text-align: center;
    margin-bottom: 10px;
    padding-bottom: 10px;
    color: #01377f !important;

}

.prev {
    text-align: right;
}

.day {
    text-align: center;
}

.dow {
    text-align: center;
}

.next,
.prev {
    color: #151414 !important;
    padding-top: 1px !important;
}

.next,
.prev:hover {
    cursor: pointer;

}

.dow {
    text-align: center;
    font-size: 12px;
    color: gray;
    font-weight: normal;
    border-top: 1px #dcd8d8 solid;
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom: 1px #dcd8d8 solid;
}


.day {
    text-align: center;
    font-size: 11px;
    padding: 8px;
    color: black;
}

.day:hover {
    cursor: pointer;
    background: #062E65;
    color: white;
}

.pagination {

    left: 0 !important;
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff !important;
    background-color: #003680 !important;
    border-color: #003680;
}

.month {
    padding: 20px;

    display: inline-block;

    cursor: pointer;
}

.year {

    padding: 20px;

    display: inline-block;

    cursor: pointer;


}
</style>

<style>
@media (max-width: 575.98px) {
    .top_search {
        margin-top: 30px !important;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    .top_search {
        margin-top: 30px !important;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .input-group-addon {
        margin-left: 89% !important;
    }

    .searc-main-sec .fa-calendar {
        font-Size: 15px !important;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {}

@media (min-width: 1200px) {}

.main-search-tittle {
    margin-bottom: 1rem !important;
}

.searc-main-sec {
    margin-top: 1rem !important;
}

.searc-main-sec .fa-angle-down {
    font-size: 14px !important;
}

.results-row .search-tittle {
    line-height: 1.3 !important;
}

.searc-main-sec .publicationcontent {
    margin-top: 0 !important;
}

.form-control {
    border-radius: 0 !important;
}

.search-section p {
    margin-bottom: 0 !important;
}

.search-result-btn,
.button-search4 {
    width: 100% !important;
}

.rgt {
    margin-bottom: 1rem !important;
}

.rgt {
    width: 100%;
    margin: auto;
    max-width: 215px;
}
</style>
<form action="<?php echo base_url() ?>home/search" id="s_form" method="GET">
    <div class="container section-top">
        <!-- <div class="row">
            <div class="col-md-12">
                <form class="row">
                    <div class="col-12 col-sm pr-sm-0"></div>
                </form>
            </div>
        </div> -->
        <!-- drop downs -->
        <div class="main-search-tittle mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-12">
                        Search result for “<?php echo $kword ?>”
                    </div>

                    <div class="col-lg-2 col-12 ">
                        <input type="hidden" id="sort" name="sort" value="<?php echo $sort ?>">
                        <div class="text-right">
                            <label style="font-size: 10px;">Sort by</label>
                            <button class="btn bg-white dis_p w-100" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="font-size: 11px;width: auto !important;height: auto !important;">
                                <?php         
                                if ($sort == "rel") {
                                    echo "Relevance";
                                } else if ($sort == 'des') {
                                    echo "Date Descending";
                                } else {
                                    echo "Date Ascending"; // as for parameter
                                }
                                ?>
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="#" data-sort="as" class=" from_s sortByPrice dropdown-item"
                                    style="font-size: 12px;">
                                    Date Ascending
                                </a>
                                <a href="#" data-sort="des" class=" from_s sortByPrice dropdown-item"
                                    style="font-size: 12px;">
                                    Date Descending
                                </a>
                                <a data-sort="rel" class="from_s dropdown-item sortByA" href="#"
                                    style="font-size: 12px;">
                                    Relevance
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 searc-main-sec">
            <div class=" col-md-4">
                <div style="z-index: 1;" class="top_search sticky-top">
                    <input type="hidden" id="limit" name="limit" value="<?php echo $lim ?>">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit"
                                class="btn btn-link text-secondary border border-right-0">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="text" value="<?php echo strip_tags($kword) ?>" placeholder="Search Keyword"
                            aria-describedby="button-addon2" name="msearch" class="form-control border-left-0 kword">
                    </div>
                    <div class="search-arrow-btn">
                        <?php
                        $content_type = ['research', 'programmes', 'publications', 'news', 'events', 'multimedia'];
                        ?>
                        <button type="button"
                            class="publication-collapsible profile-overView1 search-result-btn mt-2 py-2 px-2">

                            <?php foreach ($content_type as $type_) { ?>
                            <?php
                                if (in_array($type_, $ptop)) {
                                    $resulttype[] = ucfirst($type_);
                                }
                                ?>
                            <?php } ?>

                            <?php
                            if (!empty($resulttype)) {
                                echo implode(', ', $resulttype);
                            } else {
                                echo 'Content Type';
                            }
                            ?>
                            <span style="float:right">
                                <i class="fa fa-angle-down pl-1"></i>
                            </span>
                        </button>
                        <div class="border publicationcontent">
                            <div class="check-btns">
                                <?php foreach ($content_type as $type_) { ?>
                                <label class="container-check">
                                    <?php
                                        if ($type_ == 'research') {
                                            $title_type = 'Research Areas';
                                        } elseif ($type_ == 'programmes') {
                                            $title_type = 'Programmes';
                                        } elseif ($type_ == 'publications') {
                                            $title_type = 'Publications';
                                        } elseif ($type_ == 'news') {
                                            $title_type = 'Updates';
                                        } elseif ($type_ == 'events') {
                                            $title_type = 'Events';
                                        } else {
                                            $title_type = 'Multimedia';
                                        }
                                        ?>
                                    <?php echo $title_type; ?>
                                    <input <?php if (in_array($type_, $ptop)) { ?> checked <?php }  ?> type="checkbox"
                                        name="ptop[]" id="" value="<?php echo $type_; ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>

                                <?php foreach ($ptype as $ptype) { ?>
                                <label style="display:none" class="container-check"> <?php echo $ptype->category_name ?>
                                    <input <?php if (in_array($ptype->category_id, $ptop)) { ?> checked <?php }  ?>
                                        type="checkbox" name="ptop[]" id="" value="<?php echo $ptype->category_id ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <button type="button"
                            class="publication-collapsible  profile-overView1 search-result-btn mt-2">Topics<span
                                style="float:right"><i class="fa fa-angle-down pl-1"></i></span></button>
                        <div class="publicationcontent">
                            <div class="check-btns">
                                <?php foreach ($topics as $ptype) { ?>
                                <label class="container-check"> <?php echo $ptype->category_name ?>
                                    <input <?php if (in_array($ptype->category_id, $pser)) { ?> checked <?php }  ?>
                                        type="checkbox" name="research[]" id=""
                                        value="<?php echo $ptype->category_id ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>

                        <button style="display:none" type="button"
                            class="publication-collapsible sr-arrow profile-overView search-result-btn mt-2">Region
                            <span style="float:right"><i class="fa fa-angle-down pl-1"></i></span></button>
                        <div class="publicationcontent">
                            <div class="check-btns">
                                <label class="container-check">Brunei Darussalam
                                    <input <?php if (in_array('Brunei Darussalam', $cn)) { ?> checked <?php }  ?>
                                        type="checkbox" value="Brunei Darussalam" name="country[]">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Cambodia
                                    <input <?php if (in_array('Cambodia', $cn)) { ?> checked <?php }  ?> type="checkbox"
                                        name="country[]" value="Cambodia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Indonesia
                                    <input <?php if (in_array('Indonesia', $cn)) { ?> checked <?php }  ?>
                                        type="checkbox" name="country[]" value="Indonesia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Malaysia
                                    <input <?php if (in_array('Malaysia', $cn)) { ?> checked <?php }  ?> type="checkbox"
                                        name="country[]" value="Malaysia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Lao PDR
                                    <input <?php if (in_array('Lao PDR', $cn)) { ?> checked <?php }  ?> type="checkbox"
                                        name="country[]" value="Lao PDR">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Myanmar
                                    <input <?php if (in_array('Myanmar', $cn)) { ?> checked <?php }  ?> type="checkbox"
                                        name="country[]" value="Myanmar">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Phillippines
                                    <input <?php if (in_array('Phillippines', $cn)) { ?> checked <?php }  ?>
                                        type="checkbox" name="country[]" value="Phillippines">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Singapore
                                    <input <?php if (in_array('Singapore', $cn)) { ?> checked <?php }  ?>
                                        type="checkbox" name="country[]" value="Singapore">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">Vietnam
                                    <input <?php if (in_array('Vietnam', $cn)) { ?> checked <?php }  ?> type="checkbox"
                                        name="country[]" value="Vietnam">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div style="display:none" class="input-group mt-2" data-provide="fecha-default">
                        <input title="Fecha derivacion" value="<?php //echo $sdate ?>" id="fechasiniestroa"
                            autocomplete="off" class="form-control input-sm" type="text" name="sdate" size="30"
                            style="font-size:12px;" placeholder="Start Date">
                        <span class=" start input-group-addon"><i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <div style="display:none" class="input-group mt-2" data-provide="fecha-default">
                        <input title="Fecha derivacion" value="<?php //echo $fdate ?>" id="fechasiniestro"
                            autocomplete="off" class="form-control input-sm" type="text" name="fdate" size="30"
                            style="font-size:12px;" placeholder="End Date">
                        <span class=" end input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <input type="submit" name="commit" value="Search"
                        class="btn btn-primary btn-block button-search4 button11 mt-2 py-2">
                    <br>
                    <br>
                </div>
            </div>
            <!-- topics -->
            <div class="col-md-8" style="display: inline-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="co-lg-8 col-12">
                            <?php
                                // this is remove special character in html
                                function RemoveBS($Str)
                                {
                                    $StrArr = str_split($Str);
                                    $NewStr = '';
                                    foreach ($StrArr as $Char) {
                                        $CharNo = ord($Char);
                                        if ($CharNo == 163) {
                                            $NewStr .= $Char;
                                            continue;
                                        } // keep £ 
                                        if ($CharNo > 31 && $CharNo < 127) {
                                            $NewStr .= $Char;
                                        }
                                    }
                                    return $NewStr;
                                }

                                if ($searchData) {
                                    $num = 0;
                                    foreach ($searchData as $f) {
                                        $num++;
                                        $n = strip_tags($f['content']);
                                        $string = $n;
                                        $ku = strtolower($kword);
                                        $kl = strtoupper($kword);
                                        //var_dump($string."<br>");

                                        $ti = RemoveBS($f['title']);
                                        
                                        // echo $ti."<br>";
                                        if ($f['article_type'] == 'publications') {

                                            $url = base_url() . "publications/" . $f['uri'];

                                        } else if ($f['article_type'] == 'experts') {

                                            $url = base_url() . "experts/" . $f['uri'];

                                        } elseif ($f['article_type'] == 'keystaffs') {
                                            
                                            $url = base_url() . "experts/" . $f['uri'];
                                            
                                        } else if ($f['article_type'] == 'associates') {
                                            
                                            $url = base_url() . "experts/" . $f['uri'];

                                        } else if ($f['article_type'] == 'fellows') {
                                            
                                            $url = base_url() . "experts/" . $f['uri'];

                                        } else if ($f['article_type'] == 'events') {

                                            $url = base_url() . "events/" . $f['uri'];

                                        } elseif ($f['article_type'] == 'organizations') {

                                            $url = base_url() . "database-and-programmes/topics/" . $f['uri'];
                                            
                                        } else if ($f['article_type'] == 'articles') { 

                                            $url = base_url() . "database-and-programmes/" . $f['uri'];
                                            
                                        } else if ($f['article_type'] == 'multimedia') { 

                                            $ec_id = $f['sub_experts'];
                                            // echo "<pre>";
                                            // print_r($ec_id);
                                            // exit();
                                            $this->db->select('*');
                                            $this->db->where('parent', 'multimedia');
                                            $this->db->where('ec_id', $ec_id);
                                            $query = $this->db->get('eria_expert_categories');
                                            $multimedia = $query->row();
                                            
                                            $url = base_url() . "multimedia/" . $multimedia->slug .'/'. $f['uri'];

                                        }  else if ($f['article_type'] == 'news') {

                                            $url = base_url() . "news-and-views/" . $f['uri'];

                                        } else {

                                            $url = '#';
                                        }

                                        $mccou = 0;

                                        $fd =  str_replace(["â€˜", "‘", "â€™"], "'", $ti);

                                        $text_param = $_GET['msearch'];
                                        $bold_text_search = str_replace($text_param, "<span style='background:#efefef;font-style: italic;'>" . $text_param . "</span>", $fd);
                                        $result_bold_text_search = $bold_text_search;

                                        $textparam = $_GET['msearch'];
                                        $bold_text_desc_search = str_replace($textparam, "<span style='background:#efefef;font-style: italic;'>" . $textparam . "</span>", $f['content']);

                                        echo '<div class="results-row search-section" data-nh="'.$mccou.'">
                                                    <div class="new-high search-tittle ">
                                                        <a href="'.$url.'">
                                                            '.str_replace(["â€˜", "‘", "â€™"], "-", $result_bold_text_search).'
                                                        </a>
                                                    </div>
                                                    <div class="date pb-2">
                                                        '.date('l jS \of F Y', strtotime($f['posted_date'])).'
                                                    </div>
                                                    <p class="new-high">
                                                        '.strip_tags(substr($bold_text_desc_search, 0, 310), '<br><hr>').'
                                                        <a href="'.$url.'">[...]</a>
                                                    </p>
                                                    <span style="display: none" class="link">
                                                        <a href="'.$url.'">'.substr($url, 0, 100).'</a>
                                                    </span>
                                                    <hr>
                                                </div>';
                                    }
                                } else {
                                    echo '<div class="search-section" style=" margin-top:50px;  display: inline-block">
                                            <div class="search-tittle "> Result Not Found </div>
                                            <hr>
                                        </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="rgt">
                    <div style="padding: 0">
                        <div class="row">

                        </div>
                    </div>
                </div>

                <nav aria-label="Page navigation example " style="padding-bottom: 100px">
                    <?php echo $links; ?>
                </nav>
            </div>
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<input type="hidden" id="kword_search" class="kword_search" value="<?php echo $kword ?>">
<script src="<?= base_url(); ?>v6/js/search.js"></script>