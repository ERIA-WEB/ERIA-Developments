<div style="z-index: 99999999999999" class="modal downloadPdfModal1 fade" id="downloadPdfModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 style="font-weight: bold" class="modal-title p-2" id="exampleModalLongTitle">Download Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <!-- dropdown 1 -->
                <!-- dropdown 2 -->
                <div id="accordion2">
                    <div class="card border-0">
                        <?php $x = 0;
                        foreach ($pdf as $pdf) {
                            $x++; ?>
                            <div class="card-header border-0 p-0" id="<?php echo $pdf['pdf_title'] ?><?php echo $x ?>">
                                <h5 style="padding-left: 1.5rem !important; " class="mb-0 p-3">
                                    <div class="toggle-btn panel-title" data-toggle="collapse" data-target="#<?php echo $pdf['pdf_title'] ?>" aria-expanded="true" aria-controls="collapseTwo">
                                        <?php echo $pdf['pdf_title'] ?>
                                    </div>
                                </h5>
                            </div>
                            <div id="<?php echo $pdf['pdf_title'] ?>" class="collapse show" aria-labelledby="<?php echo $pdf['pdf_title'] ?><?php echo $x ?>" data-parent="#accordion2">
                                <div class="container p-0">

                                    <?php foreach ($pdf['content'] as $pdf) {  ?>


                                        <div class="row py-3 p-3" style="padding-left: 1.5rem!important; padding-bottom: 1rem !important; ">
                                            <div class="col-md-8 toggle-content">
                                                <p style=" color: #251F20;   margin-bottom:0px; font-size: 14px; font-weight: 500; "> <?php echo $pdf['pdf_discription'] ?> </p>

                                                <?php $r = '';
                                                if ($pdf['author']) {  ?>
                                                    <p style="margin-bottom:0px #5C5C5C; font-size: 12px;">
                                                        Editor(s)/Author(s):
                                                        <?php
                                                        foreach ($pdf['author'] as $ath) {
                                                            if ($ath->article_type == 'experts') {
                                                                $slug_article_type = strtolower($ath->article_type);
                                                            } else {
                                                                $slug_article_type = 'news-and-views';
                                                            }
                                                            $r .= "<a style='color:#5C5C5C;  font-size: 12px; font-weight:500;  font-family:Literata Roman' href='" . base_url() . $slug_article_type . "/" . $ath->uri . "' target='_blank'    >" . $ath->title . "</a>,&nbsp";
                                                        }
                                                        echo substr($r, 0, -6);
                                                        ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3">
                                                <a style="padding-top: 5px; height: 31px; width: 121px; border-radius: 7px !important;  " href="<?php echo base_url() ?><?php echo $pdf['pdf'] ?>" target="_blank" class="form-control btn modal-btn">Download</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>