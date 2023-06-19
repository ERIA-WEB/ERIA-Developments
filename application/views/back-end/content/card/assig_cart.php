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
            <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
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
                                <input type="hidden" id="id" name="id"
                                    value="<?php echo (isset($contentData)) ? $contentData->pc_id : '' ?>" />
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('sub_heading') === '') ? '' : 'error';
                                    $sub_heading = (set_value('sub_heading') == false && isset($contentData)) ? $contentData->card : set_value('sub_heading');
                                    $sub_heading = explode(',', $sub_heading);
                                    ?>
                                    <div class="controls">
                                        <div id="loading" class="text-center">
                                            <img src="<?php echo base_url() ?>upload/loading-bar-1.gif"
                                                class="w-100 hidden">
                                        </div>
                                        <table id="tblCards" class="display table table-condensed no-footer">
                                            <?php foreach ($card as $card) { ?>
                                            <tr>
                                                <td><?= $card['ref'] ?></td>
                                                <td>
                                                    <select class="form-control assig_order">
                                                        <option <?php if ($card['nm'] == 0) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="0">Deactive</option>
                                                        <option <?php if ($card['nm'] == 1) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="1">1</option>
                                                        <option <?php if ($card['nm'] == 2) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="2">2</option>
                                                        <option <?php if ($card['nm'] == 3) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="3">3</option>
                                                        <option <?php if ($card['nm'] == 4) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="4">4</option>
                                                        <option <?php if ($card['nm'] == 5) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="5">5</option>
                                                        <option <?php if ($card['nm'] == 6) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="6">6</option>
                                                        <option <?php if ($card['nm'] == 7) { ?> selected <?php } ?>
                                                            data-page="<?= $card['c_id'] ?>" value="7">7</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                        <?php echo form_error('home_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
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

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/cards/assign_card.js" type="text/javascript"></script>