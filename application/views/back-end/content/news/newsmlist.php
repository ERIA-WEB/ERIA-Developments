<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">List of Multimedia News </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>News</strong></a>
                        </li>
                        <li class="active">
                            list of News
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
                    <h2 class="title pull-left">Filter Multimedia</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#filter"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body" style="padding: 10px;">
                    <div class="row">
                        <form method="post">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Type </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="All">All</option>
                                            <?php
                                            $this->db->select('*');
                                            $this->db->where('parent', 'multimedia');

                                            $categories = $this->db->get('eria_expert_categories')->result();

                                            foreach ($categories as $cat) {
                                                echo '<option value="' . $cat->ec_id . '">' . $cat->category . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3" style="padding-top: 36px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-search "></i>
                                        Search </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <header class="panel_header">
                    <h2 class="title pull-left"> Multimedia News List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <?php $this->load->view('back-end/common/message'); ?>
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Post Date</th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print text-center" width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $results = $this->privilage->cacheManager($areaList->result(), 'multimedia_list');
                                    foreach ($results as $key => $area) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$key; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->privilage->RemoveBS($area->title); ?>
                                        </td>
                                        <td>
                                            <?php
                                                $this->db->select('*');
                                                $this->db->where('ec_id', $area->sub_experts);
                                                $categorymultimedia = $this->db->get('eria_expert_categories')->row();
                                                if (!empty($categorymultimedia->category)) {
                                                    if ($categorymultimedia->parent == 'multimedia') {
                                                        echo $categorymultimedia->category;
                                                    } else {
                                                        echo "Unclassified";
                                                    }
                                                } else {
                                                    echo "Unclassified";
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?php echo date('j F Y', strtotime($area->posted_date)); ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal<?= $key ?>">
                                                Pages
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

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->article_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'News/editmA/', $area->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->article_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                            <a class="btn btn-success"
                                                href="<?php echo base_url() ?>system-content/Card/assignCard_article/<?php echo $area->article_id ?>"
                                                data-toggle="tooltip" data-html="true"
                                                title="Card News: <?php echo $area->title; ?>">
                                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <?php
                                        $site_url = base_url().'system-content/News/duplication_page_multimedia';
                                        $modal_duplication_page = $this->privilage->duplicationPage('multimedia', $area->article_id, $area->title, $key, $site_url, $area->uri);

                                        echo $modal_duplication_page;
                                    ?>
                                    <?php } ?>
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
                url: "<?php echo base_url(); ?>system-content/News/deleteNN",
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
                url: "<?php echo base_url(); ?>system-content/News/publishMultimedia",
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

$(document).ready(function() {
    $('#examples').DataTable({
        order: [
            [0, 'asc']
        ],
    });
});
</script>