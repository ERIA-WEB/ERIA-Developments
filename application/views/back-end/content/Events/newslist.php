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
                    <h1 class="title">List of Events </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Events</strong></a>
                        </li>
                        <li class="active">
                            list of Events
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
                    <h2 class="title pull-left"> Event List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center" width="13%">Date</th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print text-center" width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $results = $this->privilage->cacheManager($areaList->result(), 'events_list');
                                    $x = 0;
                                    foreach ($results as $id => $area) : $x++; ?>
                                    <tr>
                                        <td class="text-center"> <?php echo $x; ?> </td>
                                        <td> <?php echo $this->privilage->RemoveBS($area->title); ?></td>
                                        <td>
                                            <?php echo "<b>Start:</b> " . $area->start_date . "<br>";
                                                echo "<b>End:</b> " . $area->end_date;  ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal<?= $id ?>">
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
                                        <td class="text-center hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Events/editA/', $area->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->article_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <?php
                                        $site_url = base_url().'system-content/Events/duplication_pages';
                                        $modal_duplication_page = $this->privilage->duplicationPage('events', $area->article_id, $area->title, $id, $site_url, $area->uri);

                                        echo $modal_duplication_page;
                                    ?>
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
<script src="<?= base_url(); ?>v6/js/admin/events/newslist.js" type="text/javascript"></script>