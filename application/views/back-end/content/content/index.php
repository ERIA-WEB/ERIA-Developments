<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Manage Content </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Home</strong></a>
                        </li>

                        <li class="active">
                            Manage Content
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?php echo $action; ?>">
            <div class="col-lg-6"><?php   $this->load->view('back-end/common/message'); ?>
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Manage Content </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                    $csrf = array(
                                        'name' => $this->security->get_csrf_token_name(),
                                        'hash' => $this->security->get_csrf_hash()
                                    );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($contentData)) ? $contentData->id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                        $error = (form_error('home_title') === '') ? '' : 'error';
                                        $home_title = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('home_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Menu Title </label>
                                    <span class="desc">e.g. "PROGRAMS"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?= $home_title ?>" class="form-control"
                                            id="home_title" name="home_title">
                                        <?php echo form_error('home_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div style="display:none" class="form-group">
                                    <?php
                                        $error = (form_error('sort_order') === '') ? '' : 'error';
                                        $sort_order = (set_value('sort_order') == false && isset($contentData)) ? $contentData->sort_order : set_value('sort_order');
                                    ?>
                                    <label class="form-label" for="formfield1"> Sort Order </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="number" required="required" value="<?php echo $sort_order ?>"
                                            class="form-control" id="sort_order" name="sort_order">
                                        <?php echo form_error('sort_order', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $error = (form_error('meta_keywords') === '') ? '' : 'error';
                                        $meta_keywords = (set_value('meta_keywords') == false && isset($contentData)) ? $contentData->meta_keywords : set_value('meta_keywords');
                                    ?>
                                    <label class="form-label" for="formfield3"> Meta Keywords </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?=$contentData->meta_keywords?>" class="form-control"
                                            id="meta_keywords" name="meta_keywords">
                                        <?php echo form_error('meta_keywords', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <?php
                                        $error = (form_error('meta_discriptions') === '') ? '' : 'error';
                                        $meta_discriptions = (set_value('meta_discriptions') == false && isset($contentData)) ? $contentData->meta_discriptions : set_value('meta_discriptions');
                                    ?>
                                    <label class="form-label" for="formfield3"> Meta Discriptions </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?=$meta_discriptions?>" class="form-control"
                                            id="meta_discriptions" name="meta_discriptions">
                                        <?php echo form_error('meta_discriptions', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left"> Page Title Content </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <?php
                                        $error = (form_error('page_title') === '') ? '' : 'error';
                                        $page_title = (set_value('page_title') == false && isset($contentData)) ? $contentData->page_title : set_value('page_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Page Title </label>
                                    <span class="desc">e.g. "Comprehensive Asia Development Plan"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?=$page_title?>" class="form-control" id="page_title"
                                            name="page_title">
                                        <?php echo form_error('page_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $error = (form_error('sort_title') === '') ? '' : 'error';
                                        $sort_title = (set_value('sort_title') == false && isset($contentData)) ? $contentData->sort_title : set_value('sort_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Short Page Title </label>
                                    <span class="desc">e.g. "Development Plan"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $sort_title ?>"
                                            class="form-control" id="sort_title" name="sort_title">
                                        <?php echo form_error('sort_title', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
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