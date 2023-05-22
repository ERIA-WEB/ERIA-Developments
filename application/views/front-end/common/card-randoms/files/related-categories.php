<?php
$page_card = $this->header->getPageCardRelatedCategoriesRandoms(6);

$sub_heading = explode(', ', $page_card->sub_heading); 

$topic = $this->header->getPage_cat('pubtypes');

?>

<div class="related-category-event card-body d-none d-sm-block mb-4">
    <h4 class="font-merriweather font-weight-bold text-blue mb-3">Related Categories:</h4>
    <?php 
        foreach ($topic as $key => $value) {
            if (in_array($value->category_id, $sub_heading)) {
                echo '<ul class="list-unstyled">
                <li>
                <a href="'.base_url().'publications/category/'.$value->uri.'" class="font-weight-medium text-secondary">'.$value->category_name.'</a>
                </li>
                </ul>
                ';
            }
        }
    ?>
</div>