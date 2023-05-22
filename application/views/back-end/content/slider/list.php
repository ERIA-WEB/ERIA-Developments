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
                    <h1 class="title">List of Sliders </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Home</strong></a>
                        </li>

                        <li class="active">
                            List of Sliders
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Slider List</h2>
                    <div class="actions panel_actions pull-right">
                        <a data-toggle="modal" href="#ultraModal-2"> <i class="box_setting fa fa-cogs "></i> </a>
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#f5f5f5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <?php $this->load->view('back-end/common/message'); ?>
                            <table id="examples" style="font-size:12px;" class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Image </th>
                                        <th>Heading</th>
                                        <th> Content </th>
                                        <th> Order </th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) : $x++;
                                        // echo "<pre>";
                                        // print_r($area);
                                        // exit(); 
                                    ?>
                                        <tr>
                                            <td> <?php echo $x; ?> </td>
                                            <td>
                                                <a href="#" class="pop">
                                                    <img src="<?php echo base_url() ?><?php echo $area->image_name; ?>" width="285">
                                                </a>
                                            </td>
                                            <td> <?php echo $area->heading; ?></td>
                                            <td> <?php echo $area->content; ?></td>
                                            <td> <?php echo $area->order_id; ?></td>
                                            <td class="hidden-print">
                                                <?php $session_user = $this->session->userdata('logged_in'); ?>
                                                <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'slider/editSlider/', $area->slide_id);
                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->slide_id, $btnstatus);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->slide_id);

                                                // get action edit
                                                echo $edit_action['edit'];

                                                echo "&nbsp; &nbsp;";

                                                // get action status published
                                                echo $status_action['status'];

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
<div class="modal fade" id="ultraModal-2" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Assign Slider Speed</h4>
            </div>
            <div class="modal-body ">
                <table class="display table table-hover table-condensed  " style="font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="border:#000000  solid 0px !important;"> Speed Milli Seconds </td>
                            <td style="border:#000000  solid 0px !important;">
                                <input type="number" id="seconds" value="<?= $setting ?>" name="INV" class="form-control" required>
                            </td>
                            <td style="text-align:right; border:#000000  solid 0px !important;">
                                <button class="btn btn-success payFinal" type="button">Assign</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer "> </div>
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
                    url: "<?php echo base_url(); ?>system-content/slider/delete",
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
    var delete_id = null;
    var delete_tr = null;
    var status = null;

    $('.pub-callback').click(function() {
        delete_id = $(this).data("id");
        status = $(this).data("status");
        delete_tr = $(this).closest('tr');

        publish(delete_id, status, delete_tr);
    });

    function publish(delete_id, status, delete_tr) {
        $('.pub-callback').confirmation({
            singleton: true,
            title: "Publish confirmation",
            onConfirm: function(event, element) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>system-content/slider/publish",
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
</script>
<script>
    $('.payFinal').click(function() {
        var seconds = $('#seconds').val();
        if (seconds != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/slider/settings",
                data: {
                    id: seconds

                }
            }).done(function(json) {
                $('.modal-footer').html("Slider Speed has been changed ...");
                location.reload();
            })
        } else {
            $('.modal-footer').html("Slider Speed can't be Null ...");
        }

    })
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

    $(document).ready(function() {
        $('#examples').DataTable({
            order: [
                [2, 'desc']
            ],
        });
    });
</script>