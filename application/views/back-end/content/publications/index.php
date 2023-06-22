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
                    <h1 class="title"> Manage Publication Page </h1>
                </div>


                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Publication </strong></a>
                        </li>

                        <li class="active">
                            Manage Content
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
                    <h2 class="title pull-left"> Publication </h2>
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
                                    value="<?php echo (isset($slider_row)) ? $slider_row->page_id : '' ?>" />










                                <div class="form-group">


                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $menu_title = (set_value('menu_title') == false && isset($slider_row)) ? $slider_row->menu_title : set_value('menu_title');
                                    ?>



                                    <label class="form-label" for="formfield1"> Menu Title </label>
                                    <span class="desc">e.g. "Publications"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $menu_title ?>"
                                            class="form-control" id="menu_title" name="menu_title">
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>



                                <div class="form-group">


                                    <?php
                                    $error = (form_error('title') === '') ? '' : 'error';
                                    $title = (set_value('title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                    ?>



                                    <label class="form-label" for="formfield1"> Page Title </label>
                                    <span class="desc">e.g. "Comprehensive Mapping of FTAs in ASEAN and East
                                        Asia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $title ?>"
                                            class="form-control" id="title" name="title">
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>

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
                                    $error = (form_error('meta_keywords') === '') ? '' : 'error';
                                    $meta_keywords = (set_value('meta_keywords') == false && isset($slider_row)) ? $slider_row->meta_keywords : set_value('meta_keywords');
                                    ?>



                                    <label class="form-label" for="formfield1"> Meta Keywords </label>
                                    <span class="desc">e.g. "new "</span>
                                    <div class="controls">
                                        <i class=""></i>



                                        <input type="text" value="<?= $meta_keywords ?>" class="form-control"
                                            id="meta_keywords" name="meta_keywords">


                                        <?php echo form_error('meta_keywords', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>



                                <div class="form-group">


                                    <?php
                                    $error = (form_error('meta_description') === '') ? '' : 'error';
                                    $meta_description = (set_value('meta_description') == false && isset($slider_row)) ? $slider_row->meta_description : set_value('meta_description');
                                    ?>



                                    <label class="form-label" for="formfield1"> Meta Description </label>
                                    <span class="desc">e.g. "new "</span>
                                    <div class="controls">
                                        <i class=""></i>



                                        <input type="text" value="<?= $meta_description ?>" class="form-control"
                                            id="meta_description" name="meta_description">


                                        <?php echo form_error('meta_description', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>


                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">

                                        <i class="bImg fa fa-save "></i>

                                        Save</button>

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
<script src="<?= base_url(); ?>v6/js/admin/publications/index.js" type="text/javascript"></script>