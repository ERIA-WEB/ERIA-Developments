<div class="container experts-detail-page history-page section-top">
    <div class="row">

        <!-- left section -->

        <?php

        $this->load->view('front-end/common/left');

        ?>

        <!-- right section -->
        <div class="col-md-8 col-12 author-detail pr-md-5 pr-3">
            <div class="experts-page-title pb-3 mb-3"><?= $slider_row->title ?> </div>




            <?php

            echo ($slider_row->content)

            ?>

        </div>



    </div>
</div>