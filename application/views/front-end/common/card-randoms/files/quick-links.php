<?php
$page_card = $this->header->getPageCardQuickLinksRandoms(5);

$categoryIds = $page_card->sub_heading;
$topics = $this->header->getCategoryResearchById($categoryIds); //getArticleCardOtherTopics($articleIds);

?>

<style>
.latest-news-card:last-child hr {
    display: none;
}
</style>
<div class="latest-news-card bg-light-blue card-body mb-4">
    <h4 class="font-merriweather font-weight-bold text-blue mb-3">
        <?php echo ucfirst($page_card->c_name); ?></h4>
    <?php
		foreach ($topics as $key => $value) {
			echo '<div class="border-top py-2">
					<a href="'. base_url() .'research/topic/'. $value->uri .'" class="font-weight-medium text-secondary py-3">
						'. ucfirst($value->category_name) .'
					</a>
				</div>';
		}
	?>

</div>