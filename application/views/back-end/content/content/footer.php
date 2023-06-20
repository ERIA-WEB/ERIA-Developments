<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>
<!-- include summernote css/js -->
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">Footer Manager </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Home</strong></a>
                        </li>

                        <li class="active">
                            Footer
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?php echo $action; ?>">
            <div class="col-lg-6"> <?php $this->load->view('back-end/common/message'); ?>
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Manage Footer Info </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php

                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($contentData)) ? $contentData->id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $footer_about = (set_value('footer_Content') == false && isset($contentData)) ? $contentData->footer_about : set_value('footer_about');
                                    ?>
                                    <label class="form-label" for="formfield1"> About </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="footer_about"
                                            class="form-control mytextarea"
                                            name="footer_about"><?= $footer_about ?></textarea>
                                        <?php echo form_error('footer_about', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $footer_Content = (set_value('footer_Content') == false && isset($contentData)) ? $contentData->footer_Content : set_value('footer_Content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Contact Information </label>

                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea"
                                            name="footer_Content"><?= $footer_Content ?></textarea>
                                        <?php echo form_error('footer_Content', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $footer_copyrights = (set_value('footer_copyrights') == false && isset($contentData)) ? $contentData->footer_copyrights : set_value('footer_copyrights');
                                    ?>
                                    <label class="form-label" for="formfield1"> Copyright </label>
                                    <div class="controls">
                                        <input type="text" value="<?= $footer_copyrights ?>" id="footer_copyrights"
                                            class="form-control" name="footer_copyrights">
                                        <?php echo form_error('footer_copyrights', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Manage Social Media </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php

                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($contentData)) ? $contentData->id : '' ?>" />

                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Facebook Page </label>
                                    <span class="desc">e.g. "https://www.facebook.com/ERIA.org"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color: #0A31E9"
                                                class="fa fa-facebook-official" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $fb ?>" class="form-control" id="faceook"
                                            name="faceook">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('twitter');
                                    ?>
                                    <label class="form-label" for="formfield1"> Twitter Page </label>
                                    <span class="desc">e.g. "https://twitter.com/ERIAorg"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:  #499be2"
                                                class="fa fa-twitter-square" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Twitter ?>" class="form-control" id="twitter"
                                            name="twitter">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Instagram Page </label>
                                    <span class="desc">e.g. "https://www.instagram.com/ERIA_org/"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #f58220"
                                                class="fa fa-instagram" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Instagram ?>" class="form-control" id="instagram"
                                            name="instagram">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Linked In Page </label>
                                    <span class="desc">e.g.
                                        "https://www.linkedin.com/company/eria-economic-research-institute-for-asean-and-east-asia/"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #20baf5"
                                                class="fa fa-linkedin-square" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Linked ?>" class="form-control" id="Linked"
                                            name="Linked">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Youtube Page </label>
                                    <span class="desc">e.g. " https://www.youtube.com/ERIAorg-Indonesia"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #c33a11"
                                                class="fa fa-youtube-play" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Youtube ?>" class="form-control" id="Youtube"
                                            name="Youtube">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Scribd Page </label>
                                    <span class="desc">e.g. "Scribd.com"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon">Scribd Page</span>
                                        <input type="url" value="<?= $Scribe ?>" class="form-control" id="Scribe"
                                            name="Scribe">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Google Page </label>
                                    <span class="desc">e.g. "Google.com"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #c30b03 "
                                                class="  fa fa-google-plus" aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Google ?>" class="form-control" id="Google"
                                            name="Google">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Academia Page </label>
                                    <span class="desc">e.g. "Academia.com"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"> Academia Page </span>
                                        <input type="url" value="<?= $Academia ?>" class="form-control" id="Academia"
                                            name="Academia">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $faceook = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('faceook');
                                    ?>
                                    <label class="form-label" for="formfield1"> Flickr Page </label>
                                    <span class="desc">e.g. "Flickr.com"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #20baf5"
                                                class="fa fa-flickr " aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $Flickr ?>" class="form-control" id="Flickr"
                                            name="Flickr">
                                        <?php echo form_error('faceook', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $m = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('m');
                                    ?>
                                    <label class="form-label" for="formfield1"> M Page </label>
                                    <span class="desc">e.g. "Flickr.com"</span>
                                    <div class="controls input-group">
                                        <span class="input-group-addon"><i style="color:   #20baf5"
                                                class="fa fa-flickr " aria-hidden="true"></i></span>
                                        <input type="url" value="<?= $M ?>" class="form-control" id="m" name="m">
                                        <?php echo form_error('m', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </section>
</section>
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script>
<script
    src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js"
    type="text/javascript"></script>
<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/footer.js"></script>