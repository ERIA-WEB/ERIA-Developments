<button class="btnBrowse publication-collapsible pub-tc Browser-type-pb mb-2">Browse by Type </button>
<div class="publicationcontent">
    <div class="row table table-borderless ">
        <?php foreach ($ptype as $ptype) { ?>
        <div class="col-md-4 col-xs-12 pt-4">
            <div class="pub-th publication-tb-tittle font-merriweather">
                <a href="<?= base_url() ?>publications/category/<?= $ptype->uri ?>"
                    class="text-blue"><?= $ptype->category_name ?></a>
            </div>
            <div class="pub-td">
                <?php echo $ptype->meta_description; ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>