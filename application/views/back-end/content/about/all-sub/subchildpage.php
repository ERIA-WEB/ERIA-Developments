<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>

<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"><?= !empty($slider_row) ? ucwords($slider_row->menu_title) : "ADD"; ?> Sub Child
                        Page
                    </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>About US </strong></a>
                        </li>
                        <li class="active">
                            <?= !empty($slider_row) ? ucwords($slider_row->menu_title) : "ADD"; ?> Sub Child Page
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">
                        <?= !empty($slider_row) ? ucwords($slider_row->menu_title) : "Sub Child Page"; ?>
                    </h2>
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
                                <input type="hidden" name="parent_id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->parent_id : '' ?>" />
                                <input type="hidden" name="page_id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->page_id : '' ?>" />
                                <input type="hidden" name="page_sub_id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->page_sub_id : '' ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->id : '' ?>" />
                                <div class="form-group">
                                    <?php 
                                        $path = (!isset($slider_row->banner_image)) ? "/uploads/events/slider.jpg" : $slider_row->banner_image;
                                        if ($path == "") {
                                            $path = base_url()."/uploads/events/slider.jpg";
                                        } else {
                                            $path = base_url().$path;
                                        }
                                    ?>
                                    <img id="placeholder" class="img img-fluid" src="<?php echo $path; ?>"
                                        style="width:50%;">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $error = (form_error('image') === '') ? '' : 'error';
                                        $image = (set_value('image') == false && isset($slider_row)) ? $slider_row->banner_image : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Hero Image </label>
                                    <span style="font-size: 9px;font-style: italic;color: red;">
                                        (Please Using Dimensions 1564 × 485 PX*)
                                    </span>
                                    <div class="controls">
                                        <input type="hidden" id="image" name="image" value="<?= $image ?>" />
                                        <input class="input-file form-control uniform_on focused" id="photo"
                                            value="<?php echo $image; ?>" name="photo" type="file" accept="image/*"
                                            placeholder="photo">
                                        <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $menu_title = (set_value('menu_title') == false && isset($slider_row)) ? $slider_row->menu_title : set_value('menu_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Menu Title </label>
                                    <span class="desc">e.g. "Experts"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $menu_title ?>"
                                            class="form-control" id="menu_title" name="menu_title">
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $title = (set_value('title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Page Title </label>
                                    <span class="desc">e.g. "Experts"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $title ?>"
                                            class="form-control" id="title" name="title">
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('short_desc') === '') ? '' : 'error';
                                    $short_desc = (set_value('short_desc') == false && isset($slider_row)) ? $slider_row->short_desc : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Short Description </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <textarea rows="5" style="height: 150px" id="summernote"
                                            class="form-control mytextarea"
                                            name="short_desc"><?= $short_desc ?></textarea>
                                        <?php echo form_error('short_desc', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('content') === '') ? '' : 'error';
                                    $content = (set_value('content') == false && isset($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea" name="content"><?= $content ?></textarea>
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('order_id') === '') ? '' : 'error';
                                    $order_id = (set_value('order_id') == false && isset($slider_row)) ? $slider_row->order_id : set_value('order_id');
                                    ?>
                                    <label class="form-label" for="formfield1"> Sort Order </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="number" required="required" value="<?php echo $order_id ?>"
                                            class="form-control" id="order_id" name="order_id">
                                        <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && isset($slider_row)) ? $slider_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $meta_keywords = (set_value('meta_keywords') == false && isset($slider_row)) ? $slider_row->meta_keywords : set_value('meta_keywords');
                                    ?>
                                    <label class="form-label" for="formfield1"> Meta Keywords </label>
                                    <span class="desc">e.g. "ERIA"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?php echo $meta_keywords ?>" class="form-control"
                                            id="meta_keywords" name="meta_keywords">
                                        <?php echo form_error('meta_keywords', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $meta_description = (set_value('meta_description') == false && isset($slider_row)) ? $slider_row->meta_description : set_value('meta_description');
                                    ?>
                                    <label class="form-label" for="formfield1"> Meta Description </label>
                                    <span class="desc">e.g. "The Economic Research Institute for ASEAN and East
                                        Asia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?php echo $meta_description ?>" class="form-control"
                                            id="meta_description" name="meta_description">
                                        <?php echo form_error('meta_description', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save
                                    </button>
                                    <?php 
                                        if (isset($slider_row)) {
                                            $param_id = $slider_row->page_sub_id;
                                        } else {
                                            $param_id = $_GET['page_sub_id'];
                                        }
                                    ?>
                                    <a href="<?= base_url().'system-content/about/edit_pages_sub/'.$param_id ?>"
                                        class="btn btn-danger">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                        Back
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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

<script>
$(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');
    });
});
</script>
<script>
$('#photo').change(function() {
    var input = this;
    var name = $(this).val();

    $('#image').val(name);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#placeholder').attr('src', e.target.result).attr('width', 142);
        };
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
<script>
$(document).ready(function() {
    $('#examplesPageTables').DataTable({
        "bInfo": false
    });
});
</script>