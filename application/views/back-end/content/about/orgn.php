<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Manage Organization Structure </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>About US </strong></a>
                        </li>
                        <li class="active">
                            Organization Structure
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
                    <h2 class="title pull-left"> Add Organization Structure </h2>
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
                                    value="<?php echo (isset($slider_row)) ? $slider_row->oid : '' ?>" />
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Organization Structure / Departement
                                    </label>
                                    <span class="desc">e.g. "OFFICE OF THE PRESIDENT"</span>
                                    <div class="controls">
                                        <select name="departement_id" class="form-control select" required="required">
                                            <?php
                                                if (!empty($slider_row->departement_id)) {
                                                    $departement = $this->Page_model->getDepartementByID($slider_row->departement_id);

                                                    echo '<option value="'.$departement->id.'">'.ucfirst($departement->name).'</option>';
                                                } else {
                                                    echo '<option>Choose Departement</option>';
                                                }  
                                            ?>
                                            <?php
                                                foreach ($departements as $value) {
                                                    if ($value->name != 'Editors' AND $value->name != 'Authors') {
                                                        echo '<option value="'.$value->id.'">'.ucfirst($value->name).'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group border" style="border:1px solid;padding:10px;">
                                    <div class="controls">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Choose Peoples</label>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button id="add_form_button" class=" btn btn-primary" type="button">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Peoples
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                    if (!empty($slider_row->oid)) {
                                                        
                                                        $all_peoples = $this->Page_model->getPeopleInOrganizationStructure($slider_row->oid);
                                                        if (isset($all_peoples) and count($all_peoples) > 0) {
                                                            echo '<input type="hidden" id="count_key" value="'.count($all_peoples).'">';
                                                        } else {
                                                            echo '<input type="hidden" id="count_key" value="0">';
                                                        }
                                                        foreach ($all_peoples as $i => $value) {
                                                            echo '<label class="form-label">Peoples</label>
                                                                <select class="form-control" name="people_id['.$i.'][people]">
                                                                    <option value="'.$value->people_id.'" selected>'.ucfirst($value->title).'</option>  
                                                                </select>';
                                                        }
                                                    } else {
                                                        echo '<label class="form-label">Peoples</label>
                                                                <select class="form-control" name="people_id[0][people]">';
                                                        foreach ($peoples as $value) {
                                                            if ($value->article_id != '4101' and $value->article_id != '6563') {
                                                                echo '<option value="'.$value->article_id.'" selected>'.ucfirst($value->title).'</option>';
                                                            }
                                                            
                                                        }
                                                        echo '</select>';
                                                        echo '<input type="hidden" id="count_key" value="0">';
                                                    }
                                                ?>

                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    if (!empty($slider_row->oid)) {
                                                        
                                                        $all_sorters = $this->Page_model->getPeopleInOrganizationStructure($slider_row->oid);
                                                        foreach ($all_sorters as $i => $value) {
                                                            echo '<label class="form-label" for="formfield1">Sort order</label>
                                                                    <input type="number" class="form-control" name="people_id['.$i.'][sort]" value="'.$value->sort.'">';
                                                        }
                                                    } else {
                                                        echo '<label class="form-label" for="formfield1">Sort order</label>
                                                                <input type="number" class="form-control" name="people_id[0][sort]">';
                                                    }
                                                ?>



                                            </div>
                                            <div class="form_peoples"></div>
                                        </div>

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
        <div class="col-lg-6">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Organization Structure List</h2>

                    <div class="actions panel_actions pull-right">
                        <a class="btn btn-success" href="<?php echo base_url(); ?>/system-content/about/ostructure">
                            <i class="fa fa-plus" style="color:#ffffff"></i>
                        </a>
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#ffffff">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed w-100" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="2%">No</th>
                                        <th width="30%">Structure</th>
                                        <th>Peoples</th>
                                        <th width="1%">Published</th>
                                        <th width="2%" class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($areaList->result() as $key => $area) { ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td>
                                            <?php 
                                                $departement = $this->Page_model->getDepartementByID($area->departement_id);
                                                
                                                echo strtoupper($departement->name); 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                
                                                $people_id[$key] = json_decode($area->people_id);
                                                
                                                $all_peoples[$key] = $this->Page_model->getPeopleInOrganizationStructure($area->oid);
                                                
                                                $people_s = array();
                                                foreach ($all_peoples[$key] as $i => $value) {
                                                    $people_s[$i] = ucfirst($value->title).'('.$value->sort.')';
                                                }
                                                
                                                echo implode(', ', $people_s); 
                                            ?>
                                        </td>
                                        <td>
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->oid, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'About/edit_Org/', $area->oid);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->oid);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                        </td>
                                    </tr>
                                    <?php }  ?>
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
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
<script>
// Add Form
$(document).ready(function() {
    var max_fields = 0;
    var wrapper = $(".form_peoples");
    var add_form = $("#add_form_button");

    if ($('#count_key').val() != 0) {
        var i = $('#count_key').val() - 1;
    } else {
        var i = $('#count_key').val();
    }

    $(add_form).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>system-content/About/getAllPeople",
            data: {
                published: 1
            }
        }).done(function(json) {
            ++i;
            $(wrapper).append(
                '<div class="col-md-6"><label class="form-label">Peoples</label><select class="form-control" name="people_id[' +
                i + '][people]">' + json +
                '</select></div><div class="col-md-6"><label class="form-label">Sort order</label><input type="number" class="form-control" name="people_id[' +
                i + '][sort]"></div>'
            );
        });
    });
});
</script>
<script>
$("#peoples").select2({
    placeholder: 'Choose People',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
</script>

<script>
var delete_id = null;
var delete_tr = null;
var name = null;

$('.confirmation-callback').click(function() {
    delete_id = $(this).data("id");
    name = $(this).data("area");
    delete_tr = $(this).closest('tr');

    confirmationCallback(delete_id, name, delete_tr);
});

function confirmationCallback(delete_id, name, delete_tr) {
    $('.confirmation-callback').confirmation({

        singleton: true,

        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/About/deleteorg",
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
            });
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
var delete_id = null;
var delete_tr = null;
var status = null;

$('.pub-callback').click(function() {
    delete_id = $(this).data("id");
    status = $(this).data("status");
    delete_tr = $(this).closest('tr');

    statusData(delete_id, status, delete_tr);

});

function statusData(delete_id, status, delete_tr) {
    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/about/publishO",
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
$(document).ready(function() {
    $('#examples').DataTable();
});
</script>