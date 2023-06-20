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
                                <?php
                                $error = (form_error('sub_heading') === '') ? '' : 'error';
                                $sub_heading = (set_value('sub_heading') == false && isset($contentData)) ? $contentData->sub_heading : set_value('sub_heading');
                                $sub_heading = explode(',', $sub_heading);
                                ?>
                                <div class="form-group">
                                    <label class="form-label" for="formfield3"> Select Videos </label>
                                    <div class="controls">
                                        <select class="form-control" name="topics[0]">
                                            <?php 
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts == '20') {
                                                        if (in_array($value->article_id, $sub_heading)) {
                                                            $video_selected = 'selected';
                                                            $video_id = $value->article_id;
                                                            $video_name = $value->title;
                                                        }
                                                    }
                                                }
                                                if (isset($video_selected)) {
                                                    echo '<option value="'.$video_id.'" '.$video_selected.'>
                                                            '.$video_name.'
                                                        </option>';
                                                } else {
                                                    echo '<option value="">
                                                            None
                                                        </option>';
                                                }
                                            ?>
                                            <?php 
                                                if (isset($video_selected)) {
                                                    echo '<option value="">None</option>';
                                                }
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts !== '20') {
                                                        echo '<option value="'.$value->article_id.'">
                                                                '.$value->title.'
                                                            </option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield3"> Select Podcasts </label>
                                    <div class="controls">
                                        <select class="form-control" name="topics[1]">
                                            <option value="">None</option>
                                            <?php 
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts === '8') {
                                                        if (in_array($value->article_id, $sub_heading)) {
                                                            $podcasts_selected = 'selected';
                                                            $podcasts_id = $value->article_id;
                                                            $podcasts_name = $value->title;
                                                        }
                                                    }
                                                }
                                                if (isset($podcasts_selected)) {
                                                    echo '<option value="'.$podcasts_id.'" '.$podcasts_selected.'>
                                                            '.$podcasts_name.'
                                                        </option>';
                                                } else {
                                                    echo '<option value="">
                                                            None
                                                        </option>';
                                                }
                                            ?>

                                            <?php 
                                                if (isset($podcasts_selected)) {
                                                    echo '<option value="">None</option>';
                                                }
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts !== '8') {
                                                        echo '<option value="'.$value->article_id.'">
                                                                '.$value->title.'
                                                            </option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield3"> Select Webinar </label>
                                    <div class="controls">
                                        <select class="form-control" name="topics[2]">
                                            <option value="">None</option>
                                            <?php 
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts === '7') {
                                                        if (in_array($value->article_id, $sub_heading)) {
                                                            $webinar_selected = 'selected';
                                                            $webinar_id = $value->article_id;
                                                            $webinar_name = $value->title;
                                                        }
                                                    }
                                                }
                                                
                                                if (isset($webinar_selected)) {
                                                    echo '<option value="'.$webinar_id.'" '.$webinar_selected.'>
                                                            '.$webinar_name.'
                                                        </option>';
                                                } else {
                                                    echo '<option value="">None</option>';
                                                }
                                            ?>
                                            <?php 
                                                if (isset($webinar_selected)) {
                                                    echo '<option value="">None</option>';
                                                }
                                                foreach ($areaList as $value) {
                                                    if ($value->sub_experts !== '7') {
                                                        echo '<option value="'.$value->article_id.'">
                                                                '.$value->title.'
                                                            </option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield3">Sort Order</label>
                                    <div class="controls">
                                        <input type="number" value="<?= $contentData->sorted; ?>" name="sorted"
                                            class="form-control">
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