<!-- collapsible area 2 -->
<button class="btnBrowse publication-collapsible pub-tc Browser-type-pb mb-2">Browse by Topic</button>
<div class="publicationcontent">
    <div class="row table table-borderless">
        <?php foreach (array_slice($topics, 0, 29) as $key => $ptype) { ?>
        <?php if ($ptype->published == 1 and $ptype->uri != 'call-for-proposals') { ?>
        <div class="col-md-4 col-xs-12 pt-4">
            <div class="pub-th publication-tb-tittle font-merriweather">
                <a href="<?= base_url() ?>research/topic/<?= $ptype->uri ?>"
                    class="text-blue"><?= $ptype->category_name ?></a>
            </div>
            <div class="pub-td">
                <?php
                $ns = substr(Strip_tags($ptype->meta_description), 0, 80);
                $str = substr($ns, 0, strrpos($ns, ' '));

                if (strlen($ptype->meta_description) > 80) {
                    echo $str . "<a href=" . base_url() . "research/topic/" . $ptype->uri . ">[...]</a>";
                } else {
                    echo $str;
                }
                ?>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <div class="col-md-8 col-xs-12 pt-4"></div>
        <div class="col-md-4 col-xs-12 pt-4">
            <div class="pub-th publication-tb-tittle font-merriweather">
                <a href="<?= base_url() ?>research/topic/call-for-proposals" class="text-blue">Call for Proposals</a>
            </div>
        </div>
    </div>
</div>