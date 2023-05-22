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
                    <h1 class="title"> List of Timeline </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Timeline </strong></a>
                        </li>
                        <li class="active">
                            List
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
                    <h2 class="title pull-left"> Timeline List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#f5f5f5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;" class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Title </th>
                                        <th> Year </th>
                                        <th> Content </th>
                                        <th> Published </th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) : $x++; ?>
                                        <tr>
                                            <td> <?php echo $x; ?> </td>
                                            <td> <?php echo $area->title; ?></td>
                                            <td> <?php echo $area->year; ?> </td>
                                            <td> <?php echo $area->content; ?></td>
                                            <td>
                                                <?php $session_user = $this->session->userdata('logged_in'); ?>
                                                <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->time_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                            </td>
                                            <td class="hidden-print">
                                                <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Time/edit/', $area->time_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->time_id);
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
    });

    $('.confirmation-callback').confirmation({
        singleton: true,
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/Time/delete",
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
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    var delete_id = null;
    var delete_tr = null;
    var status = null;

    $('.pub-callback').click(function() {
        delete_id = $(this).data("id");
        status = $(this).data("status");
        delete_tr = $(this).closest('tr');
    });

    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/Time/publish",
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
</script>
<script>
    $(document).ready(function() {
        $('#examples').DataTable({
            order: [
                [2, 'desc']
            ],
        });
    });
</script>