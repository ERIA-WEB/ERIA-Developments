<style>
.dataTables_info {
    margin-top: 0px !important;
}

.select2-container-multi .select2-choices {

    z-index: 9999999;
}
</style>
<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> List of Publication </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a><i class="fa fa-globe"></i><strong> Research & Publication </strong></a>
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
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left"> Publication List</h2>
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
                                        <th class="text-center" width="50%">Title </th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Post Date</th>
                                        <th class="text-center" width="5%">PDF</th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th class="text-center" width="5%">Published</th>
                                        <th class="text-center hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $results = $this->privilage->cacheManager($areaList->result(), 'publications_list');
                                    $x = 0;
                                    foreach ($results as $id => $area) : $x++; ?>
                                    <tr>
                                        <td class="text-center"> <?php echo $x; ?> </td>
                                        <td> <?php echo $this->privilage->RemoveBS($area->title); ?></td>
                                        <td class="text-center">
                                            <?php
                                                if (file_exists(FCPATH . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . $area->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . "/upload/Publication.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $area->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/Publication.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($area->image_name)) {
                                                                $img = "https://www.eria.org/" . $area->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/Publication.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/Publication.jpg";
                                                        }
                                                    }
                                                }
                                                ?>
                                            <a href="#" class="pop">
                                                <img src="<?php echo $img; ?>" width="30px">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php echo date('j F Y', strtotime($area->posted_date)); ?>
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-aid="<?php echo $area->article_id ?>"
                                                data-title="<?php echo $area->title ?>"
                                                data-author_editor="<?php echo $area->editor . ', ' . $area->author; ?>"
                                                class="btn btn-info _pdf" href="#myModal1">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
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
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Research/editPub/', $area->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->article_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                            <a class="btn btn-success"
                                                href="<?php echo base_url() ?>system-content/Card/assignCard_article/<?php echo $area->article_id ?>">
                                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <?php
                                        $site_url = base_url().'system-content/Research/duplication_pages';
                                        $modal_duplication_page = $this->privilage->duplicationPage('publications', $area->article_id, $area->title, $id, $site_url, $area->uri);

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
<?php $this->load->view('back-end/content/research/modals/image-preview'); ?>
<?php $this->load->view('back-end/content/research/modals/manage-pdf'); ?>

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
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/research/publicationlist.js" type="text/javascript"></script>