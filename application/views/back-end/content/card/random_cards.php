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
                    <h1 class="title"> Manage Cards </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Card </strong></a>
                        </li>
                        <li class="active">
                            List of Card Randoms
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Card Randoms</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 text-left" style="margin-bottom: 20px;">
                            <a class="btn btn-info"
                                href="<?php echo base_url() ?>system-content/card/create_card_randoms">
                                <i class="fa fa-plus"></i> Add Card Images
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <?php $this->load->view('back-end/common/message'); ?>
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Card Files</th>
                                        <th>Sort Order</th>
                                        <th width="7%">Type Card</th>
                                        <th width="5%">Pages </th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print" width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0; ?>
                                    <?php foreach ($card_files as $id => $area) : $x++; ?>
                                    <tr>
                                        <td class="text-center"><?php echo $x; ?> </td>
                                        <td><?php echo $area->ref; ?></td>
                                        <td class="text-center"><?php echo $area->sorted; ?></td>
                                        <td class="text-center"><?php echo ucfirst($area->sort_by); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalFiles<?= $id ?>">Pages
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->c_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="hidden-print text-center">
                                            <?php
                                                if ($area->c_id > 1 && $area->c_id < 11) {
                                                    $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'card/edit_random_card_sub/', $area->c_id);
                                                } else {
                                                    $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'card/edit_random/', $area->c_id);
                                                }

                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->c_id);
                                                // get action edit
                                                echo $edit_action['edit'];

                                                if ($area->sort_by == 'images') {
                                                    // get action delete
                                                    echo $delete_action['delete'];
                                                } else {
                                                    echo '<button class="btn btn-danger" disabled>
                                                            <i class="fa fa-trash"></i> 
                                                        </button>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalFiles<?= $id ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabelFiles<?= $id ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelFiles<?= $id ?>">
                                                        Card <?php echo $area->ref; ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"
                                                        style="position: absolute;right: 15px;top: 15px;">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                                    action="<?= base_url(); ?>system-content/card/edit_card_randoms">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?php echo $area->c_id; ?>"
                                                            name="card_id">
                                                        <div class="form-group">
                                                            <?php foreach ($pages as $key => $val) { ?>
                                                            <?php if ($val->uri != 'about-us' and $val->uri != 'experts') { ?>
                                                            <div class="controls">
                                                                <?php
                                                                    
                                                                    $getPage = $this->privilage->getCardPage($val->page_id, $area->c_id);
                                                                    
                                                                    if (isset($getPage->page_id) and $getPage->page_id == $val->page_id) {
                                                                        $checked = 'checked';
                                                                    } else {
                                                                        $checked = '';
                                                                    }
                                                                    
                                                                    if ($val->menu_title == 'Updates') {
                                                                        $aliasTitle = ' / news & views';
                                                                    } else {
                                                                        $aliasTitle = '';
                                                                    }
                                                                    ?>
                                                                <input
                                                                    style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;"
                                                                    type="checkbox" value="<?= $val->page_id ?>"
                                                                    class="form-control" id="category_name<?= $key ?>"
                                                                    name="pages[]"
                                                                    <?= $checked ?>><?= strtoupper($val->menu_title).strtoupper($aliasTitle) ?>
                                                            </div>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Card Images</th>
                                        <th>Sort Order</th>
                                        <th width="7%">Type Card</th>
                                        <th width="5%">Pages </th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print" width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0; ?>
                                    <?php foreach ($card_images as $id => $area) : $x++; ?>
                                    <tr>
                                        <td class="text-center"><?php echo $x; ?> </td>
                                        <td><?php echo $area->ref; ?></td>
                                        <td class="text-center"><?php echo $area->sorted; ?></td>
                                        <td class="text-center"><?php echo ucfirst($area->sort_by); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalImages<?= $id ?>">Pages
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->c_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="hidden-print text-center">
                                            <?php
                                                if ($area->c_id > 1 && $area->c_id < 11) {
                                                    $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'card/edit_random_card_sub/', $area->c_id);
                                                } else {
                                                    $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'card/edit_random/', $area->c_id);
                                                }

                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->c_id);
                                                // get action edit
                                                echo $edit_action['edit'];

                                                if ($area->sort_by == 'images') {
                                                    // get action delete
                                                    echo $delete_action['delete'];
                                                } else {
                                                    echo '<button class="btn btn-danger" disabled>
                                                            <i class="fa fa-trash"></i> 
                                                        </button>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalImages<?= $id ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabelImages<?= $id ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelImages<?= $id ?>">
                                                        Card <?php echo $area->ref; ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"
                                                        style="position: absolute;right: 15px;top: 15px;">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                                    action="<?= base_url(); ?>system-content/card/edit_card_randoms">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?php echo $area->c_id; ?>"
                                                            name="card_id">
                                                        <div class="form-group">
                                                            <?php foreach ($pages as $key => $val) { ?>
                                                            <?php if ($val->uri != 'about-us' and $val->uri != 'experts') { ?>
                                                            <div class="controls">
                                                                <?php
                                                                    
                                                                    $getPage = $this->privilage->getCardPage($val->page_id, $area->c_id);
                                                                    
                                                                    if (isset($getPage->page_id) and $getPage->page_id == $val->page_id) {
                                                                        $checked = 'checked';
                                                                    } else {
                                                                        $checked = '';
                                                                    }
                                                                    
                                                                    if ($val->menu_title == 'Updates') {
                                                                        $aliasTitle = ' / news & views';
                                                                    } else {
                                                                        $aliasTitle = '';
                                                                    }
                                                                    ?>
                                                                <input
                                                                    style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;"
                                                                    type="checkbox" value="<?= $val->page_id ?>"
                                                                    class="form-control" id="category_name<?= $key ?>"
                                                                    name="pages[]"
                                                                    <?= $checked ?>><?= strtoupper($val->menu_title).strtoupper($aliasTitle) ?>
                                                            </div>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
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
<div class="modal fade subscribe-modal p-4" id="subscribeModal" tabindex="-1" role="dialog"
    aria-labelledby="subscribeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0"> Info
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="font-weight:bold" class="modal-body text-center stext">
                You Can't Edit this Card
            </div>
        </div>
    </div>
</div><!-- comment -->
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
                url: "<?php echo base_url(); ?>system-content/card/deleteCardRandoms",
                data: {
                    id: delete_id,
                    name: name
                }
            }).done(function(json) {
                delete_tr.css("background-color", "#FF0000");
                delete_tr.fadeOut(1200, function() {
                    delete_tr.remove();
                    location.reload();
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

    publishR(delete_id, status, delete_tr);
});

function publishR(delete_id, status, delete_tr) {
    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/Card/publishRandom",
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
    // $('#pageCard').DataTable();
    $('#examples').DataTable();
});
</script>