<style>
.dataTables_info {
    margin-top: 0px !important;
}
</style>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title"> Publication </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Research </strong></a>
                        </li>

                        <li class="active">
                            Publication
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Add Publication </h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                action="<?php echo $action; ?>">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->np_id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('pub_id') === '') ? '' : 'error';
                                    $pub_id = (set_value('pub_id') == false && isset($slider_row)) ? $slider_row->pub_id : set_value('pub_id');
                                    ?>
                                    <label class="form-label" for="formfield1"> Select Publication </label>
                                    <span class="desc" style="font-style:italic;">*Type in article title and press
                                        enter</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select class="  " id="publication" name="publication" required>
                                            <option value="">--select--</option>

                                            <?php foreach ($related->result() as $areaList) { ?>
                                            <?php if ($areaList->published == 1) { ?>
                                            <option <?php if ($pub_id == $areaList->article_id) { ?> selected <?php } ?>
                                                value="<?php echo $areaList->article_id; ?>"
                                                data-text="<?php echo $areaList->title; ?>">
                                                <?php echo $areaList->title; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('publication', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('n_title') === '') ? '' : 'error';
                                    $titles = (set_value('n_title') == false && isset($slider_row)) ? $slider_row->n_title : set_value('n_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Title </label>
                                    <span class="desc">e.g. "Comprehensive Mapping of FTAs in ASEAN and East
                                        Asia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required"
                                            value="<?php echo str_replace('"', '', $titles);     ?>"
                                            class="form-control" id="n_title" name="n_title">
                                        <?php echo form_error('n_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->n_content : set_value('n_content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea"
                                            name="n_content"><?php echo $content ?></textarea>
                                        <?php echo form_error('n_content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home') === '') ? '' : 'error';
                                    $highlight = (set_value('home') == false && isset($slider_row)) ? $slider_row->home : set_value('home');
                                    ?>
                                    <label class="form-label" for="formfield1"> Home Page ? </label>
                                    <!-- <span class="desc">e.g. "100"</span> -->
                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($highlight == 1) { ?> checked
                                            <?php } ?> class="form-control" id="home" name="home">
                                        <?php echo form_error('home', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('inside') === '') ? '' : 'error';
                                    $published = (set_value('inside') == false && isset($slider_row)) ? $slider_row->inside : set_value('inside');
                                    ?>
                                    <label class="form-label" for="formfield1"> Publication Page ? </label>
                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="inside" name="inside">
                                        <?php echo form_error('inside', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</section>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>


<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/research/publication_slider.js" type="text/javascript"></script>