<?php
$areaList = $areaList;
?>
<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Manage Card </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Card</strong></a>
                        </li>
                        <li class="active">
                            Manage
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?php echo $action; ?>">
            <div class="col-lg-6"><?php $this->load->view('back-end/common/message'); ?>
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
                                    value="<?php echo (isset($contentData)) ? $contentData->c_id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                    $home_title = (set_value('home_title') == false && isset($contentData)) ? $contentData->c_name : set_value('home_title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Form Title </label>
                                    <span class="desc">e.g. "PROGRAMS"</span>
                                    <div class="controls">
                                        <input type="text" value="<?= $home_title ?>" class="form-control"
                                            id="home_title" name="home_title">
                                        <?php echo form_error('home_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('headinng') === '') ? '' : 'error';
                                    $headinng = (set_value('headinng') == false && isset($contentData)) ? $contentData->headinng : set_value('headinng');
                                    ?>
                                    <label class="form-label" for="formfield3"> Main News </label>
                                    <div class="controls">
                                        <select class="" id="s2example-2" name="headinng" required="required">
                                            <?php foreach ($areaList as $areaLists) { ?>
                                            <option <?php if ($headinng == $areaLists->article_id) { ?> selected=""
                                                <?php  } ?> value="<?php echo $areaLists->article_id; ?>">
                                                <?php echo $this->privilage->RemoveBS($areaLists->title); ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('headinng', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('sub_heading') === '') ? '' : 'error';
                                    $sub_heading = (set_value('sub_heading') == false && isset($contentData)) ? $contentData->sub_heading : set_value('sub_heading');
                                    $sub_heading = explode(',', $sub_heading);
                                    ?>
                                    <label class="form-label" for="formfield3"> Text box Placeholder </label>
                                    <div class="controls">

                                        <?php foreach ($areaList as $f) { } ?>
                                        <select class="" id="s2example-3" name="topics[]" required="required" multiple>
                                            <?php foreach ($areaList as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $sub_heading)) { ?>
                                                selected="" <?php  } ?> value="<?= $areaList->article_id ?>">
                                                <?php echo $areaList->title; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('sub_heading', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save</button>
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
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>