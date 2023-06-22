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
                    <h1 class="title"> List of Articles </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Programmes </strong></a>
                        </li>

                        <li class="active">
                            Articles List
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
                    <h2 class="title pull-left"> Articles List</h2>
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
                                        <th>No</th>
                                        <th> Title </th>
                                        <th> Image </th>
                                        <th> Post Date </th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print text-center" width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $results = $this->privilage->cacheManager($areaList->result(), 'programmes_a_list');
                                    $x = 0;
                                    foreach ($results as $id => $area) : $x++; ?>
                                    <tr>
                                        <td> <?php echo $x; ?> </td>
                                        <td> <?php echo $this->privilage->RemoveBS($area->title); ?></td>
                                        <td>
                                            <?php
                                                if (file_exists(FCPATH . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . $area->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . "/upload/news.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $area->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/news.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($area->image_name)) {
                                                                $img = "https://www.eria.org/" . $area->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/news.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/news.jpg";
                                                        }
                                                    }
                                                }
                                                ?>
                                            <a href="#" class="pop">
                                                <img src="<?php echo $img; ?>" width="50">
                                            </a>
                                        </td>
                                        <td> <?php echo date('j F Y', strtotime($area->posted_date)); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal<?= $id ?>">
                                                Pages
                                            </button>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-aid="<?= $area->article_id ?>"
                                                class="btn btn-info _pdf hidden" href="#myModal1">
                                                <i class="  fa fa-file-pdf-o "></i>
                                            </a>
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
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Programmes/editArt/', $area->article_id);
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
                                        $site_url = base_url().'system-content/Programmes/duplication_pages';
                                        $modal_duplication_page = $this->privilage->duplicationPage('articles', $area->article_id, $area->title, $id, $site_url, $area->uri);

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
<div style="z-index: 8888" class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> Manage PDF </h4>
            </div>
            <div class="modal-body">
                <form method='post' action='' enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>:</td>
                            <td><input type="text" id="pdf_title" name="pdf_title" class="form-control">

                                <input type="hidden" id="aid" name="aid">
                                <input type="hidden" id="ptype" value="article" name="ptype">
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td><input type="text" id="pdf_dis" name="pdf_dis" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>PDF </td>
                            <td>:</td>
                            <td> <input type='file' name='file' id='file' class='form-control'> </td>
                        </tr>
                        <tr>
                            <td>Author/Editor </td>
                            <td>:</td>
                            <td>
                                <select id="author" name="author[]" class="" multiple>

                                    <?php foreach ($editor_->result() as $areaList) { ?>
                                    <option value="<?= $areaList->article_id ?>"><?= $areaList->title ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" id="error"> </td>
                            <td style="text-align:right"> <input type='button' class='btn btn-info' value='Upload'
                                    id='btn_upload'></td>
                        </tr>
                    </table>
                </form>
                <!-- Preview-->
                <div id='preview'></div>
            </div>
            <div class="modal-body3">
            </div>
            <div style="text-align:center" class="modal-footer pdf_dis">

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
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/programmes/alist.js" type="text/javascript"></script>