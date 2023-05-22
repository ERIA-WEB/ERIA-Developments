<!-- collapsible area 3 -->
<button class="btnBrowse publication-collapsible pub-tc Browser-type-pb mb-2">Browse by Location</button>
<div class="publicationcontent">
    <div class="publications-content-grid my-3 px-1">
        <?php
            $countries_asean = $this->frontModel->getCountriesAsean(16);

            $not_asean = ['Australia', 'China', 'India', 'Japan', 'New Zealand', 'Republic of Korea'];

            foreach ($countries_asean as $value) {
                if (!in_array($value->venue, $not_asean)) {
                    echo '<a class="publications-content-grid-item text-blue" href="'.base_url().'research/topic/asean/'.$value->venue.'">
                                '.ucfirst($value->venue).'
                            </a>';
                }
            }
        ?>
    </div>
</div>