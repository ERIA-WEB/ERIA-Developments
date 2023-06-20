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
                    <h1 class="title"> Home Page Recent Updates </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Home </strong></a>
                        </li>

                        <li class="active">
                            Recent Updates
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left"> Create Recent Page </h2>
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
                                    action="<?php echo $action ?>">
                                    <?php if (count($rs) < 6) { ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <?php
                                                    $error = (form_error('home_title') === '') ? '' : 'error';
                                                    $home_title = (set_value('home_title') == false && isset($contentData)) ? $contentData->home_title : set_value('home_title');
                                                    ?>
                                                <label class="form-label" for="formfield1"> Select
                                                    Article/Publication/Programme </label>
                                                <span class="desc">e.g. "News/Publications"</span>
                                                <div class="controls">
                                                    <i class=""></i>
                                                    <select name="asean" class="change_f" id="s2example-2">
                                                        <?php
                                                            if ($asean_t->article_id) {
                                                                $s = $asean_t->article_id;
                                                            } else {
                                                                $s = '';
                                                            }
                                                            ?>

                                                        <?php foreach ($asean as $as) { ?>
                                                        <option data-class="tasean" data-iclass="timg"
                                                            <?php if ($s == $as->article_id) { ?> selected <?php } ?>
                                                            data-img="<?php echo $as->image_name ?>"
                                                            data-title="<?php echo $as->title ?>"
                                                            value="<?php echo $as->article_id ?>">
                                                            <?php echo $as->title ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo form_error('home_title', '<span class="help-inline">', '</span>'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="formfield1"> Sort Order </label>
                                                <span class="desc">e.g. "100"</span>
                                                <div class="controls">
                                                    <i class=""></i>
                                                    <input name="sort" class="form-control" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bImg fa fa-save "></i>
                                                Assign </button>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <b> Allowed Only 6 Article If you want to add please delete below article. </b>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left"> Home page Recent Post </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class='display table data'>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Sort</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $x = 0; ?>
                                    <?php foreach ($rs as $key => $rs) { ?>
                                    <tr>
                                        <td><?php echo ++$key ?></td>
                                        <td><?php echo $rs->title ?></td>
                                        <td>
                                            <?php
                                                if (file_exists(FCPATH . $rs->image_name)) {
                                                    $img = base_url() . $rs->image_name;
                                                } else {
                                                    $img = "https://www.eria.org" . $rs->image_name;
                                                }
                                                ?>
                                            <img width="200" src="<?php echo $img; ?>">
                                        </td>
                                        <td><?php echo $rs->sort ?></td>
                                        <td>
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php

                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'News/editA/', $rs->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $rs->article_id);

                                                // get action edit
                                                echo $edit_action['edit'];
                                                echo "&nbsp; &nbsp;";
                                                // get action delete
                                                echo $delete_action['delete'];
                                                echo "&nbsp; &nbsp;";
                                                ?>
                                            <a class="btn btn-success"
                                                href="<?php echo base_url(); ?>system-content/Card/assignCard_article/<?php echo $rs->article_id; ?>"
                                                target="_blank">
                                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/cards/recent.js" type="text/javascript"></script>