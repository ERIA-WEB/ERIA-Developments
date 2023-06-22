<style>
    .dataTables_info {
        margin-top: 0px !important;
    }
</style>

<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Sub Topics </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Manage </strong></a>
                        </li>

                        <li class="active">
                            Sub Topics
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-6"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Add Sub Topics </h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo $action; ?>">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id" value="<?php echo (isset($slider_row)) ? $slider_row->category_id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $category_name = (set_value('category_name') == false && isset($slider_row)) ? $slider_row->category_name : set_value('category_name');
                                    ?>
                                    <label class="form-label" for="formfield1"> Sub Topic Name </label>
                                    <span class="desc">e.g. "Brunei Darussalam"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $category_name ?>" class="form-control" id="category_name" name="category_name">
                                        <?php echo form_error('category_name', '<span class="help-inline">', '</span>'); ?>
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
                                        <input type="number" required="required" value="<?php echo $order_id ?>" class="form-control" id="order_id" name="order_id">
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
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked <?php } ?> class="form-control" id="published" name="published">
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
                                        <input type="text" value="<?= $meta_keywords ?>" class="form-control" id="meta_keywords" name="meta_keywords">
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
                                        <input type="text" value="<?= $meta_description ?>" class="form-control" id="meta_description" name="meta_description">
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
        <div class="col-lg-6">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Category List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;" class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Sort Order</th>
                                        <th class="text-center">Published</th>
                                        <th class="hidden-print text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) : $x++; ?>
                                        <tr>
                                            <td class="text-center"> <?php echo $x; ?> </td>
                                            <td class="text-center"> <?php echo $area->category_name; ?></td>
                                            <td class="text-center"> <?php echo $area->order_id; ?></td>
                                            <td class="text-center">
                                                <?php $session_user = $this->session->userdata('logged_in'); ?>
                                                <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->category_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>

                                            </td>
                                            <td class="hidden-print text-center">
                                                <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Research/edit_stop/', $area->category_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->category_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach  ?>
                                </tbody>
                            </table>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>

<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/research/stopic.js" type="text/javascript"></script>