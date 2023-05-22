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
                    <h1 class="title"> Manage Key Staff </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>About US </strong></a>
                        </li>
                        <li class="active">
                            Key Staff
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
                    <h2 class="title pull-left"> Add Key Staff </h2>
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
                                <input type="hidden" name="id" value="<?php echo (isset($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb" style="margin-left: 30%;">
                                            <?php $path = (!isset($slider_row->image_name)) ? "/uploads/keystaffs/slider.jpg" : $slider_row->image_name; ?>
                                            <img id="placeholder" class="grayscale" src="<?php echo base_url(); ?><?php echo $path; ?>" width="142" alt="Sample Image">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('image') === '') ? '' : 'error';
                                    $image = (set_value('image') == false && isset($slider_row)) ? $slider_row->image_name : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Image </label>
                                    <span class="desc">Dimensions "240 X 340 PX"</span>
                                    <input type="hidden" id="image" name="image" value="" />
                                    <input class="input-file form-control uniform_on focused" id="photo" value="<?php echo $image; ?>" name="photo" type="file" accept="image/*" placeholder="photo">
                                    <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $error = (form_error('menu_title') === '') ? '' : 'error';
                            $title = (set_value('category_name') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                            ?>
                            <label class="form-label" for="formfield1"> Name </label>
                            <span class="desc">e.g. "Annisa Nadhilah Utoro"</span>
                            <div class="controls">
                                <i class=""></i>
                                <input type="text" required="required" value="<?php echo $title ?>" class="form-control" id="title" name="title">
                                <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $error = (form_error('menu_title') === '') ? '' : 'error';
                            $major = (set_value('category_name') == false && isset($slider_row)) ? $slider_row->major : set_value('major');
                            ?>
                            <label class="form-label" for="formfield1"> Position </label>
                            <span class="desc">e.g. "Coordinating Officer"</span>
                            <div class="controls">
                                <i class=""></i>
                                <input type="text" required="required" value="<?php echo $major ?>" class="form-control" id="major" name="major">
                                <?php echo form_error('major', '<span class="help-inline">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $error = (form_error('menu_title') === '') ? '' : 'error';
                            $majorEmail = (set_value('majorEmail') == false && isset($slider_row)) ? $slider_row->majorEmail : set_value('majorEmail');
                            ?>
                            <label class="form-label" for="formfield1"> Email </label>
                            <span class="desc">e.g. "annisanadhilah@eria.com"</span>
                            <div class="controls">
                                <i class=""></i>
                                <input type="email" value="<?php echo $majorEmail ?>" class="form-control" id="majorEmail" name="majorEmail">
                                <?php echo form_error('majorEmail', '<span class="help-inline">', '</span>'); ?>
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
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="bImg fa fa-save"></i>
                                Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Catogery List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#f5f5f5;overflow:auto;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;" class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Name </th>
                                        <th> Photo </th>
                                        <th> Position </th>
                                        <th> Email </th>
                                        <th> Sort Order </th>
                                        <th> Published </th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) {
                                        $x++; ?>
                                        <tr>
                                            <td><?php echo $x; ?> </td>
                                            <td><?php echo $area->title; ?></td>
                                            <td><a href="#" class="pop"> <img src="<?= base_url() ?>get_thumbs.php?im=<?php echo $area->image_name; ?>" width="110"> </a> </td>
                                            <td><?php echo $area->major; ?></td>
                                            <td><?php echo $area->video_url; ?></td>
                                            <td><?php echo $area->order_id; ?></td>
                                            <td>
                                                <?php $session_user = $this->session->userdata('logged_in'); ?>
                                                <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->article_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>

                                            </td>
                                            <td class="hidden-print">
                                                <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'About/editS/', $area->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->article_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    </div>
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
<script>
    var delete_id = null;
    var delete_tr = null;
    var name = null;

    $('.confirmation-callback').click(function() {
        delete_id = $(this).data("id");
        name = $(this).data("area");
        delete_tr = $(this).closest('tr');

        confirmationCallbackDelete(delete_id, name, delete_tr);
    });

    function confirmationCallbackDelete(delete_id, name, delete_tr) {
        $('.confirmation-callback').confirmation({
            singleton: true,
            onConfirm: function(event, element) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>system-content/About/deleter",
                    data: {
                        id: delete_id,
                        name: name

                    }
                }).done(function(json) {
                    delete_tr.css("background-color", "#FF0000");
                    delete_tr.fadeOut(1200, function() {
                        delete_tr.remove();
                    });
                })
            }
        });
    }
</script>
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

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#article_keywords').summernote();
    });
</script>

<script>
    var delete_id = null;
    var delete_tr = null;
    var status = null;

    $('.pub-callback').click(function() {
        delete_id = $(this).data("id");
        status = $(this).data("status");
        delete_tr = $(this).closest('tr');

        publishR(delete_id, status, delete_tr);
    });

    function publishR(delete_id, status, delete_tr) {
        $('.pub-callback').confirmation({
            singleton: true,
            title: "Publish confirmation",
            onConfirm: function(event, element) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>system-content/research/publishR",
                    data: {
                        id: delete_id,
                        pub: status

                    }
                }).done(function(json) {
                    delete_tr.css("background-color", "yellow");
                    delete_tr.fadeOut(1200, function() {
                        location.reload();
                    });
                })
            }
        });
    }
    $(document).ready(function() {
        $('#examples').DataTable({
            order: [
                [2, 'desc']
            ],
        });
    });
</script>