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
                    <h1 class="title"> Manage Pages </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>About US </strong></a>
                        </li>
                        <li class="active">
                            List of Pages
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
                    <h2 class="title pull-left"> Page List</h2>
                    <div class="actions panel_actions pull-right">
                        <a class="btn btn-success" href="<?php echo base_url() ?>system-content/about/add_page">
                            <i class="fa fa-plus bold" aria-hidden="true" style="color:#fff;"></i>
                        </a>
                        <i class="box_toggle fa fa-chevron-down" style="color:#fff;"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"
                            style="color:#fff;"></i>
                        <i class="box_close fa fa-times" style="color:#fff;"></i>
                    </div>
                </header>
                <div class="content-body" style="background:#f5f5f5">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Menu Name </th>
                                        <th> Page Title </th>
                                        <th> Sort Order </th>
                                        <th> Published </th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;
                                    foreach ($areaList as $id => $area) : $x++; ?>
                                    <tr>
                                        <td> <?php echo $x; ?> </td>
                                        <td> <?php echo $area->menu_title; ?></td>
                                        <td> <?php echo $area->title; ?></td>
                                        <td> <?php echo $area->order_id; ?></td>
                                        <td>
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->page_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'about/edit_page/', $area->page_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->page_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];

                                                // // People Organization Structure
                                                // if ($area->page_id == 14) {
                                                //     echo '<a href="'.base_url().'system-content/about/ostructure" class="btn btn-success">
                                                //             <i class="fa fa-circle-o" aria-hidden="true"></i>
                                                //         </a>';
                                                // }
                                                
                                                // // Member From the board
                                                // if ($area->page_id == 9) {
                                                //     echo '<a href="'.base_url().'system-content/about/board" class="btn btn-success">
                                                //             <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                                //         </a>';
                                                // }

                                                // // Member keystaff
                                                // if ($area->page_id == 15) {
                                                //     echo '<a href="'.base_url().'system-content/about/staff" class="btn btn-success">
                                                //             <i class="fa fa-users"></i> 
                                                //         </a>';
                                                // }

                                                // // Organization we work with
                                                // if ($area->page_id == 16) {
                                                //     echo '<a href="'.base_url().'system-content/about/organization" class="btn btn-success">
                                                //             <i class="fa fa-sitemap" aria-hidden="true"></i>
                                                //         </a>';
                                                // }

                                                // // Careers we work with
                                                // if ($area->page_id == 17) {
                                                //     echo '<a href="'.base_url().'system-content/about/career" class="btn btn-success">
                                                //             <i class="fa fa-list-ul" aria-hidden="true"></i> 
                                                //         </a>';
                                                // }

                                                // // Governing Board
                                                // // if ($area->page_id == 10) {
                                                // //     echo '<a href="'.base_url().'system-content/about/gb" class="btn btn-success">
                                                // //             <i class="fa fa-table" aria-hidden="true"></i>
                                                // //         </a>';
                                                // // }
                                                 
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
<script src="<?= base_url(); ?>v6/js/admin/abouts/all-sub/listpage.js" type="text/javascript"></script>