<style>
.dataTables_info {
    margin-top: 0px !important;
}
</style>

<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title"> Manage and Add Department </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Peoples </strong></a>
                        </li>

                        <li class="active">
                            Department
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
                    <h2 class="title pull-left"> Add Department </h2>
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
                                    value="<?php echo (isset($slider_row)) ? $slider_row->id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('s_catogery') === '') ? '' : 'error';
                                    $s_catogery = (set_value('s_catogery') == false && isset($slider_row)) ? $slider_row->name : set_value('s_catogery');
                                    ?>
                                    <label class="form-label" for="formfield1">Department</label>
                                    <br>
                                    <span class="desc" style="margin-left: 0;">e.g. "Energy Unit"</span>
                                    <div class="controls">
                                        <input type="text" id="s_catogery" value="<?= $s_catogery ?>" name="s_catogery"
                                            class="form-control">
                                        <?php echo form_error('s_catogery', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Select Relevant People
                                        Categories</label>
                                    <br>
                                    <span class="desc" style="margin-left: 0;">Type in Relevant People Categories and
                                        press enter </span>
                                    <div class="controls">
                                        <?php
                                        $error = (form_error('category_name') === '') ? '' : 'error';
                                        ?>
                                        <select class="" id="selectCategoryinDepartement" name="category_name[]"
                                            required multiple>
                                            <?php
                                            if (isset($this->uri->segment_array()[4])) {
                                                $departement_id = $this->uri->segment_array()[4];

                                                $getexpertdepartement = $this->Page_model->getExpertDepartementRelatedCategories($departement_id);
                                                
                                                if (!empty($getexpertdepartement)) {
                                                    $category_IDS = array();
                                                    foreach ($getexpertdepartement as $i => $dep_cate) {
                                                        $category_IDS[] = $dep_cate->eria_expert_category_id;
                                                    }

                                                    $get_category = $this->Page_model->getExpertSelectCategories($category_IDS);

                                                    $categories = array();
                                                    foreach ($get_category as $value) {
                                                        echo '<option value="' . $value->ec_id . '" selected>' . $value->category . '</option>';
                                                    }
                                                }
                                            }

                                            foreach ($c_list as $c_list) {

                                                echo '<option value="' . $c_list->ec_id . '">' . $c_list->category . '</option>';
                                            }


                                            ?>
                                        </select>

                                        <?php echo form_error('category_name', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>Save
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
                    <h2 class="title pull-left"> Department List</h2>
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
                                        <th>Department</th>
                                        <th>Categories</th>
                                        <th class="hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($areaList as $key => $area) { ?>
                                    <tr>
                                        <td> <?php echo ++$key; ?> </td>
                                        <td> <?php echo $area->name; ?></td>
                                        <td>
                                            <?php
                                                $departement_id = $area->id;
                                                
                                                $get__departement_category = $this->Page_model->getExpertDepartementRelatedCategories($area->id);
                                                
                                                $categoryIDs = array();
                                                if (!empty($get__departement_category)) {
                                                    foreach ($get__departement_category as $i => $dep_cate) {
                                                        $categoryIDs[] = $dep_cate->eria_expert_category_id;
                                                    }

                                                    $get_category = $this->Page_model->getExpertCategories($categoryIDs);

                                                    $departement_name = implode(', ', $get_category);
                                                } else {
                                                    $departement_name = '';
                                                }
                                                

                                                ?>
                                            <?php echo $departement_name; ?>
                                        </td>
                                        <td class="hidden-print">
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Experts/editscat/', $area->id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->id);
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

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/experts/s_category.js" type="text/javascript"></script>