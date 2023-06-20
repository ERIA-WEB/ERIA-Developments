<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">Banner Manage </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Home</strong></a>
                        </li>
                        <li class="active">
                            Banner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-4"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Create Banner </h2>
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
                                    value="<?php echo (isset($banner_row)) ? $banner_row->banner_id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('caption') === '') ? '' : 'error';
                                    $caption = (set_value('caption') == false && isset($banner_row)) ? $banner_row->caption : set_value('caption');
                                    ?>
                                    <label class="form-label" for="formfield1"> Banner Title </label>
                                    <span class="desc">e.g. "AESCON"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $caption ?>"
                                            class="form-control" id="caption" name="caption">
                                        <?php echo form_error('caption', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb" style="margin-left: 25%;">
                                            <?php $path = (!isset($banner_row->image_name)) ? "/uploads/banners/slider.jpg" : $banner_row->image_name; ?>
                                            <img id="placeholder" class="grayscale"
                                                src="<?php echo base_url(); ?>resources/images<?php echo $path; ?>"
                                                width="142" alt="Sample Image">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('image') === '') ? '' : 'error';
                                    $image = (set_value('image') == false && isset($banner_row)) ? $banner_row->image_name : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Image </label>
                                    <span class="desc">e.g. "320 X 170 PX "</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="hidden" id="image" name="image" value="" />
                                        <input class="input-file form-control uniform_on focused" id="photo"
                                            value="<?php echo $image; ?>" name="photo" type="file" accept="image/*"
                                            placeholder="photo">
                                        <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('banner_url') === '') ? '' : 'error';
                                    $banner_url = (set_value('banner_url') == false && isset($banner_row)) ? $banner_row->banner_url : set_value('banner_url');
                                    ?>
                                    <label class="form-label" for="formfield1"> URL </label>
                                    <span class="desc">e.g. "https://www.google.com"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="url" required="required" value="<?php echo $banner_url ?>"
                                            class="form-control" id="banner_url" name="banner_url">
                                        <?php echo form_error('banner_url', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('banner_target') === '') ? '' : 'error';
                                    $banner_target = (set_value('banner_target') == false && isset($banner_row)) ? $banner_row->banner_target : set_value('banner_target');
                                    ?>
                                    <label class="form-label" for="formfield1"> Target </label>
                                    <span class="desc">e.g. "new window"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select class="form-control" id="banner_target" name="banner_target">
                                            <option <?php if ($banner_target == "_blank") { ?> selected <?php } ?>
                                                value="_blank">New Window</option>
                                            <option <?php if ($banner_target == "_self") { ?> selected <?php } ?>
                                                value="_self">Current Window</option>
                                        </select>
                                        <?php echo form_error('banner_target', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('order_id') === '') ? '' : 'error';
                                    $order_id = (set_value('order_id') == false && isset($banner_row)) ? $banner_row->order_id : set_value('order_id');
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
                                    $published = (set_value('published') == false && isset($banner_row)) ? $banner_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>

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
        <div class="col-lg-8">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Banner List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#f5f5f5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="example" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Title </th>
                                        <th> Image </th>
                                        <th> Order </th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>\
                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) : $x++; ?>
                                    <tr>
                                        <td> <?php echo $x; ?> </td>
                                        <td> <?php echo $area->caption; ?></td>
                                        <td> <a href="#" class="pop"> <img
                                                    src="<?php echo base_url() ?>resources/images<?php echo $area->image_name; ?>"
                                                    width="90"> </a> </td>
                                        <td> <?php echo $area->order_id; ?></td>
                                        <td class="hidden-print">

                                            <a class="btn btn-info"
                                                href="<?php echo base_url() ?>system-content/Content/editBanner/<?php echo $area->banner_id ?>">
                                                <i class="fa fa-edit"></i> </a>
                                            &nbsp; &nbsp;
                                            <a href="#confirm" data-id="<?php echo $area->banner_id; ?>"
                                                data-area="<?php echo $area->caption; ?>" data-placement="left"
                                                class="btn btn-danger confirmation-callback">

                                                <i class="fa fa-trash"></i> </a>
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
<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/banner.js"></script>