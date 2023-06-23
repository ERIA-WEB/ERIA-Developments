<div class="modal downloadPdfModal1 fade" id="downloadPdfModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title p-2" id="exampleModalLongTitle">Download document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">

                <!-- dropdown 1 -->
                <div id="accordion">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Full Report
                                </div>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="container p-0">
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dropdown 2 -->
                <div id="accordion2">
                    <div class="card border-0">
                        <div class="card-header border-0 p-0" id="headingOne">
                            <h5 class="mb-0 p-4">
                                <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="true" aria-controls="collapseTwo">
                                    Content
                                </div>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion2">
                            <div class="container p-0">
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
                                    </div>
                                </div>
                                <div class="row py-3 p-4">
                                    <div class="col-md-9 toggle-content">
                                        ASEAN Vision 2040 - Volume I
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="form-control btn modal-btn">Download</button>
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

<!-------------------------------------------- Research page ------------------------------------------------------------------>


<?php
//var_dump($article);
?>

<div class="research-page research-article-page px-3 px-md-0 pr-md-5 section-top">

    <!-- Donwload pdf 1 -->
    <div class="container top-cover">
        <div class="background-grey-article"></div>
        <div class="row">
            <div class="col-md-6 col-12 page-content">
                <div>
                    <div class="category"><?= $article->article_type ?></div>
                    <h2 class="heading"> <?= $article->title ?> </h2>
                    <div>
                        <?php if ($article->author != '') { ?>
                        <span class="date">by</span>
                        <span class="author"><?= $article->author ?></span>
                        <span class="date hori-line">---</span>
                        <?php } ?>
                        <span class="date"> <?php echo date('j  F Y', strtotime($article->posted_date)) ?> </span>
                    </div>
                </div>
                <div class="row mt-4 authors">
                    <div class="col-md-12">
                        <div class="social-media-icons">
                            <span>Share Article</span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/facebook-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/twitter-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/linkdin-icon.png"></span>
                            <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/instagram-icon.png"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-gap" style="padding-right: 5rem;" class="col-md-6 col-12">
                <div class="img-container">
                    <img src="<?php echo base_url() ?><?= $article->image_name ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container mt-4 article-content">
        <div class="row">
            <div class="col-md-2 share-article download-section-two">
                <div class="small-text">Share Article</div>
                <div class="social-media-icons">
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/facebook-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/twitter-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/linkdin-icon.png"></span>
                    <span><img src="<?php echo base_url() ?>v6/assets/SocialMedia/instagram-icon.png"></span>
                </div>
                <div class="small-text">Print Article</div>
                <div><img src="<?php echo base_url() ?>v6/assets/SocialMedia/print-icon.png"></div>
            </div>
            <div class="col-md-10 article-content">
                <div class="row">
                    <div class="col-md-12">


                        <?php echo $article->content ?>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <p>Women comprise a disproportionately large share of healthcare workers -- the World Health
                            Organization (WHO) estimates that 70% of health workers globally, with an even larger
                            representation in care homes.</p>
                        <p>
                            In the informal sector, the discrepancy is even greater: women are three times more
                            likely than men to care for ill people: daughters are expected to care for ageing
                            parents
                        </p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="related-category p-3 pt-4 pl-4">
                            <h5>Related Categories :</h5>
                            <h6 class="mt-4">Labour and Migration</h6>
                            <h6 class="mt-3">ASEAN</h6>
                            <h6 class="mt-3">Finance and Macroeconomy</h6>
                        </div>
                    </div>
                </div>

                <!-- ©Hashan Pallewatte 2020  -->
                <!-- Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including files downloadable from this website, without the permission of the copyright owner. -->
                <div class="row">
                    <div class="col-md-12">
                        <p>Taken together, these facts expose several issues related to the gender gap in health
                            care, especially in Asean. In the immediate term, women make up by far the larger
                            percentage of coronavirus infections amongst healthcare workers. In a recent study based
                            on data from Spain, UN Women found that 76% of infected healthcare workers were women.
                        </p>
                        <p>
                            Similar percentages were found in the United States (73%) and Italy (69%). This is
                            dramatically higher than the percentages representing the general population where women
                            make up about 46% of those infected. And these numbers did not include informal
                            caregivers, where women make up an even higher percentage of carers.
                        </p>
                        <p>
                            Furthermore, UN Women reported that women in the Asia-Pacific region are much less
                            likely to receive health and safety information to help them prepare for Covid-19.
                        </p>
                        <p>
                            In a nutshell, the immediate problem is how to assist the Covid-19 heroes -- the women
                            who make up the majority of caregivers for the sick and elderly. However, this quickly
                            merges into the larger issue of addressing the gender gap in ageing care in Asean in
                            general. In fact, this is an issue that is growing in importance regardless of the
                            Covid-19 pandemic as many Asean countries are entering a phase of the ageing population.
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <p>Asean has one of the fastest-growing ageing populations in the world. Singapore and
                            Thailand are already there, with Vietnam and Brunei trailing by just a few years. Within
                            about 20 years, Asean as a whole will have reached this stage. Asean is aware of this
                            issue and has already recognised the need for bilateral and regional cooperation to
                            address the issue (Chairman's Statement of the 20th Commemorative Summit of Asean +3).
                        </p>
                        <p>
                            The impact of ageing populations on women, as the main providers of elderly care, is
                            huge. These jobs are generally low-paid and often provide unsafe working conditions.
                        </p>
                        <p>
                            The impact of ageing populations on women, as the main providers of elderly care, is
                            huge. These jobs are generally low-paid and often provide unsafe working conditions.
                        </p>
                    </div>
                    <div class="col-md-5">
                        <div class="container pt-2 mb-3 subscribe">
                            <div class="row py-3 pb-4 section-divider">
                                <div class="col-md-12 col-xs-12">
                                    <div class="heading">Subscribe to Mailing List</div>
                                    <div class="description">Invitations . Publications . Newsletters</div>
                                    <div class="py-3">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                    </div>
                                    <button class="btn btn-subscribe mt-1 py-2" data-toggle="modal"
                                        data-target="#subscribeModal">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>A recent study of elderly care in the Philippines funded by the Economic Research
                            Institute for Asean and East Asia (Eria) showed that informal care for older people is
                            provided by women to a far greater extent than by men. About six in 10 men reported that
                            their major caregiver is their spouse. Women most commonly reported a daughter as their
                            major caregiver (38%) with only 18% cared for by their spouse.
                        </p>
                        <div class="quote p-5 mb-3 mx-5">
                            <p>
                                “We know already that an investment in infrastructure pays back in terms of job
                                creation, but also in growth. And we’re going to be looking for different ways to
                                grow our economy.”
                            </p>
                            <div class="author-name mt-4">by <span class="font-weight-bold">Robert D. Blackwill</span>
                            </div>
                        </div>
                        <p>
                            This gender gap is even wider when it comes to long-term care (LTC) because the idea of
                            LTC being handed over to non-family members, much less to institutional facilities such
                            as nursing homes, is not yet in the consciousness of the current cohort of older
                            Filipinos. In fact, 73% of the respondents to the survey over the age of 60 believed it
                            was preferable to live with a daughter rather than with a son.
                        </p>
                        <p>
                            These kinds of numbers are not unique to the Philippines. At a recent Eria event on
                            post-Covid-19 care for older people, co-hosted with the Indonesian Ministry of Planning
                            and Development, Dr Kirana Pritasari, the director-
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <p>general of Public Health at Indonesia's Ministry of Health, shared that about 80% of
                            Indonesia's older people live with family, where women are the main caregivers. The
                            impact on women, and in turn on families, is huge. In the informal sector, women who do
                            not receive appropriate training are far more likely to fall ill. They are then more
                            likely to spread illnesses to their families, especially if they are not aware of
                            appropriate protocols. Women who are providing care for elderly family are often unable
                            to continue earning an income outside the home.</p>
                        <p>
                            As Asean governments prepare recovery packages, they can consider addressing the gender
                            gap in informal care as a long-term issue, not just one that has arisen due to the
                            pandemic.
                        </p>
                        <p>
                            As developing countries, many Asean members do not have the same capacity as more
                            advanced economies to care for older people. Yet, they are amongst the most rapidly
                            ageing populations in the world.
                        </p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="related-topic">
                            <div class="topic">Related topic</div>
                            <h6>Call for Proposals: ERIA Microdata Research Fiscal Year 2020</h6>
                            <div class="author-name mt-4"><span class="topic">by </span><span class="name">Robert D.
                                    Blackwill</span></div>
                        </div>
                        <div class="related-topic mt-1">
                            <h6>Call for Proposals: ERIA Microdata Research Fiscal Year 2020</h6>
                            <div class="author-name mt-4"><span class="topic">by </span><span class="name">Robert D.
                                    Blackwill</span></div>
                        </div>
                        <div class="related-topic mt-1">
                            <h6>Call for Proposals: ERIA Microdata Research Fiscal Year 2020</h6>
                            <div class="author-name mt-4"><span class="topic">by </span><span class="name">Robert D.
                                    Blackwill</span></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>Training is needed for informal care givers so they know basic best treatment and safety
                            practices and can cope with the physical and emotional burden of care. Incentivise the
                            private sector to provide more care facilities and higher wages for care workers through
                            tax deductions or other policy mechanisms. The low wages issue needs to be addressed to
                            attract more people to work in this field.</p>
                        <p>
                            This opinion piece was written by Ms Lydia Ruddy, ERIA's Director of Communications.
                            This oped has been published in The Bangkok Post, The Manila Times, and The ASEAN Post,
                            Click here to subscribe to the monthly newsletter.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Related articles -->
    <div class="container related-article">
        <div class="container py-3">
            <h3 class="py-4">Related Articles</h3>
            <div class="row page-content pb-3">

                <?php

                for ($c = 0; $c <= 2; $c++) {

                ?>


                <div class="col-md-4 col-12 mb-4">
                    <img class="responsive" src="<?= base_url() ?><?= $related[$c]->image_name ?>">
                    <div class="category mt-3"> <?= $related[$c]->article_type ?> </div>
                    <div class="heading"> <?= $related[$c]->title ?> </div>
                    <div>

                        <?php if ($related[$c]->author != '') { ?>
                        <span class="date">by</span>
                        <span class="author"><?= $related[$c]->author ?></span>
                        <span class="date hori-line">---</span>
                        <?php } ?>

                        <span class="date"> <?php echo date('j  F Y', strtotime($related[$c]->posted_date)) ?> </span>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>

</div>

<!-- subscribe popup modal -->
<!-- Modal -->
<div class="modal fade subscribe-modal p-4" id="subscribeModal" tabindex="-1" role="dialog"
    aria-labelledby="subscribeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Thank you for subscribing to our letter
            </div>
            <div class="modal-footer text-center border-0">
                <button type="button" class="btn btn-primary px-5" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>