<?php
$page_card = $this->header->getPageCardParamFive(5);

$categoryIds = $page_card->sub_heading;
$topics = $this->header->getCategoryResearchById($categoryIds); //getArticleCardOtherTopics($articleIds);

?>

<style>
.latest-news-card:last-child hr {
    display: none;
}
</style>
<div class="latest-news-card bg-light-blue px-3 py-4 mb-4">
    <h6 class="font-merriweather font-weight-bold text-blue related-topic-titlle mb-4">
        <?php echo ucfirst($page_card->c_name); ?></h6>
    <?php
		foreach ($topics as $key => $value) {
			echo '<div class="border-top pt-2 pb-2 pl-2">
					<a href="'. base_url() .'research/topic/'. $value->uri .'" class="font-merriweather font-weight-normal text-blue pt-3 pb-3" style="font-size:13px;">
						'. ucfirst($value->category_name) .'
					</a>
				</div>';
		}
	?>

</div>