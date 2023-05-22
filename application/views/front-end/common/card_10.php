<?php
$c1             = $this->header->getPage_card(9);
$card_ptype     = $this->frontModel->get_catogery('pubtypes');
$card_topics    = $this->frontModel->get_catogery('topics');
?>

<style>
.pub-tc:hover {
    background: white !important;
}

#headingOneNew,
#headingTwoNew,
#headingThreeNew {
    position: relative;
    font-weight: 600 !important;
    font-size: 14px;
    color: #FFF;
    cursor: pointer;
    padding: 8px 16px;
    text-transform: uppercase;
}

.fa.fa-chevron-down {
    position: absolute;
    right: 5%;
    bottom: 50%;
}

#collapseOneNew,
#collapseTwoNew,
#collapseThreeNew {
    background: #FFF;
    border: 2px solid #F3F8FC;
}
</style>
<!-- start -->
<!-- By Type -->
<div class="brows-card d-none d-md-block mb-4">
    <div class="container background d-none d-sm-block">
        <div class="row subscribe py-3 section-divider d-none d-sm-block">
            <div class="col-md-12 col-xs-12 d-none d-sm-block pr-0 pl-0">
                <div id="accordionOneNew">
                    <div class="" id="headingOneNew" data-toggle="collapse" data-target="#collapseOneNew"
                        aria-expanded="true" aria-controls="collapseOneNew">
                        Browse by Type<i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div id="collapseOneNew" class="collapse" aria-labelledby="headingOneNew"
                        data-parent="#accordionOneNew">
                        <div class="heading2" style="margin-top: 5px;padding: 0 11px !important;">
                            <div class="panel-body pl-3 pr-3">
                                <?php
                                $numOfCols = 2;
                                $rowCount = 0;
                                $bootstrapColWidth = 12 / $numOfCols;
                                ?>
                                <div class="row">
                                    <?php foreach ($card_ptype as $ptype) { ?>
                                    <div class="col-md-<?php echo $bootstrapColWidth; ?> pl-0">
                                        <ul class="nav nav-compact flex-column text-smaller">
                                            <li>
                                                <a
                                                    href="<?= base_url() ?>publications/category/<?= $ptype->uri ?>"><?= $ptype->category_name ?></a>
                                                <!-- <div class=" pl-2  pub-td pt-3" style="width: 325px !important; " >
                                                    <?php
    
                                                    $ns = substr(Strip_tags($ptype->meta_description), 0, 80);
                                                    $str = substr($ns, 0, strrpos($ns, ' '));
    
                                                    if (strlen($ptype->meta_description) > 80) {
                                                        echo $str . "<a href=" . base_url() . "publications/category/" . $ptype->uri . ">[...]</a>";
                                                    } else {
                                                        echo $str;
                                                    }
    
                                                    ?>
                                                </div>-->
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                        $rowCount++;
                                        if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- By Topic -->
    <div class="container background d-none d-sm-block">
        <div class="row subscribe py-3 section-divider d-none d-sm-block">
            <div class="col-md-12 col-xs-12 d-none d-sm-block pr-0 pl-0">
                <div id="accordionTwoNew">
                    <div class="" id="headingTwoNew" data-toggle="collapse" data-target="#collapseTwoNew"
                        aria-expanded="true" aria-controls="collapseTwoNew">
                        Browse by Topic<i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div id="collapseTwoNew" class="collapse" aria-labelledby="headingTwoNew"
                        data-parent="#accordionTwoNew">
                        <div class="heading2" style="margin-top: 5px;padding: 0 11px !important;">
                            <div class="panel-body pl-3 pr-3">
                                <?php
                                $numOfCols = 2;
                                $rowCount = 0;
                                $bootstrapColWidth = 12 / $numOfCols;
                                ?>
                                <div class="row">
                                    <?php foreach ($card_topics as $ptype) { ?>
                                    <div class="col-md-<?php echo $bootstrapColWidth; ?> pl-0">
                                        <ul class="nav nav-compact flex-column text-smaller">
                                            <li>
                                                <a
                                                    href="<?= base_url() ?>research/category/<?= $ptype->uri ?>"><?= $ptype->category_name ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                        $rowCount++;
                                        if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- By Location -->
    <div class="container background d-none d-sm-block">
        <div class="row subscribe py-3 section-divider d-none d-sm-block">
            <div class="col-md-12 col-xs-12 d-none d-sm-block pr-0 pl-0">
                <div id="accordionTwoNew">
                    <div class="" id="headingThreeNew" data-toggle="collapse" data-target="#collapseThreeNew"
                        aria-expanded="true" aria-controls="collapseThreeNew">
                        Browse by Location<i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div id="collapseThreeNew" class="collapse" aria-labelledby="headingThreeNew"
                        data-parent="#accordionTwoNew">
                        <div class="heading2" style="margin-top: 5px;padding: 0 11px !important;">
                            <div class="panel-body pl-3 pr-3">
                                <div class="row">
                                    <div class="col-md-6 pl-0">
                                        <ul class="nav nav-compact flex-column text-smaller">
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Brunei Darussalam">Brunei
                                                    Darussalam</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Cambodia">Cambodia</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/all/Indonesia">Indonesia</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Malaysia">Malaysia</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Lao PDR">Lao PDR</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <ul class="nav nav-compact flex-column text-smaller">
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Myanmar">Myanmar</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Phillippines">Phillippines</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Singapore">Singapore</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url() ?>Asean/country/Vietnam">Viet Nam</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end -->