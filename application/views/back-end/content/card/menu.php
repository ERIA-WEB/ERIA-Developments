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
                    <h1 class="title"> Megamenu </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Megamenu</strong></a>
                        </li>

                        <li class="active">
                            Featured
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?= $action ?>">
            <div class="row">
                <div class="col-lg-6">
                    <?php $this->load->view('back-end/common/message'); ?>
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Publications </h2>
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
                                        <label class="form-label" for="formfield1"> Publications </label>
                                        <span class="desc">e.g. "Publications"</span>
                                        <div class="controls">
                                            <select name="pub" class="change_f" id="branch">
                                                <?php foreach ($pub as $pub) { ?>
                                                <option data-class="pasean" data-iclass="pimg"
                                                    <?php if ($pub_t->article_id == $pub['article_id']) { ?> selected=""
                                                    <?php } ?> data-img="<?= $pub['image_name'] ?>"
                                                    value="<?= $pub['article_id'] ?>" data-title="<?= $pub['title'] ?>">
                                                    <?= $pub['title'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('page_title', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img width="300" class="img-fluid pimg "
                                            src="<?= base_url() ?><?= $pub_t->image_name ?>">
                                        <div style="  " class="dropdown-item-header pasean "><?= $pub_t->title ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Updates </h2>
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
                                        <label class="form-label" for="formfield1"> Updates </label>
                                        <span class="desc">e.g. "Updates"</span>
                                        <div class="controls">
                                            <i class=""></i>
                                            <select name="updates" class="change_f" id="s2example-1">
                                                <?php foreach ($update as $as) { ?>

                                                <option data-class="uasean" data-iclass="uimg"
                                                    data-img="<?= $as['image_name'] ?>"
                                                    <?php if ($updates_t->article_id == $as['article_id']) { ?>
                                                    selected="" <?php } ?> data-title="<?= $as['title'] ?>"
                                                    value="<?= $as['article_id'] ?>"> <?= $as['title'] ?>
                                                </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img width="300" class="img-fluid uimg "
                                            src="<?= base_url() ?><?= $updates_t->image_name ?>">
                                        <div style="  " class="dropdown-item-header uasean "><?= $updates_t->title ?>
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
                            <h2 class="title pull-left"> Multimedia </h2>
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
                                        <label class="form-label" for="formfield1"> Multimedia </label>
                                        <span class="desc">e.g. "Affordability of Carbon Capture, Utilisation..."</span>
                                        <div class="controls">
                                            <select name="multimedia" class="change_f" id="s2example-3">
                                                <?php  foreach ($multi as $as) { ?>

                                                <option data-class="masean"
                                                    <?php if ($multimedia_t->article_id == $as->article_id) { ?>
                                                    selected <?php  } ?> data-iclass="mimg"
                                                    data-img="<?= $as->image_name ?>" data-title="<?= $as->title ?>"
                                                    value="<?= $as->article_id ?>"> <?= $as->title ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img width="300" class="img-fluid mimg "
                                            src="<?= base_url() ?><?= $multimedia_t->image_name ?>">
                                        <div style="  " class="dropdown-item-header masean ">
                                            <?= $multimedia_t->title ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bImg fa fa-save "></i>
                                                Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </section>
</section>
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
<script>
$('.change_f').change(function() {
    var heading = $(this).find(':selected').data('title');
    var tasean = $(this).find(':selected').data('class');
    var img = $(this).find(':selected').data('img');
    var iclass = $(this).find(':selected').data('iclass');

    $('.' + iclass).attr('src', img);
    $('.' + tasean).html(heading);
});
</script>