<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Edit Card </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-globe"></i><strong>Card </strong></a>
                        </li>
                        <li class="active">
                            Edit
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?= $action; ?>">
            <div class="col-lg-12">
                <!-- start: Alert Message -->
                <style>
                .help-inline {
                    color: rgba(240, 80, 80, 1.0);
                    font-weight: 400;
                    font-size: 13px;
                }
                </style>
                <!-- end: Alert Message -->
                <section class="box">
                    <header class="panel_header">
                        <h2 class="title pull-left">Input Field Card</h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" name="id" value="<?php echo $cards->c_id; ?>">
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Title Card </label>
                                    <span class="desc">e.g. "Card template 1"</span>
                                    <div class="controls">
                                        <input type="text" required="required" value="<?php echo $cards->c_name; ?>"
                                            class="form-control" id="title" name="title" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="form-label" for="formfield1"> Choose Template Card</label>
                                    <span class="desc">e.g. "Upload File ext .PHP"</span>
                                    <div class="controls">
                                        <select id="chooseSelectTemplate" class="form-control" required>
                                            <option>--Select--</option>
                                            <option value="template_file">Upload File ext .PHP</option>
                                            <option value="template_code">Template Code HTML</option>
                                        </select>
                                    </div>
                                </div> -->
                                <?php if (!empty($cards->file)) { ?>
                                <div id="templateCardFile" class="form-group">
                                    <label class="form-label" for="formfield1"> Upload File Template Cards </label>
                                    <br>
                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please using extension
                                        .php*)</span>
                                    <div class="controls">
                                        <span style="font-size: 14px;font-style: italic;">Path Card :
                                            <?php echo $cards->path . '' . $cards->file; ?></span>
                                        <input type="hidden" name="file_card_old" value="<?php echo $cards->file; ?>">
                                        <input class="input-file form-control uniform_on focused" id="file_card"
                                            name="file_card" type="file" accept=".php/*"
                                            placeholder="Upload file card ext .php">
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if (!empty($cards->template)) { ?>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Template Code Card </label>
                                    <textarea rows="5" id="summernoteTextArea" class="form-control mytextarea"
                                        name="template_content"><?php echo $cards->template; ?></textarea>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="form-label" for="formfield3">Sort Order</label>
                                    <div class="controls">
                                        <input type="number" value="<?php echo $cards->sorted; ?>" name="sorted"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <div style="width: 30px" class="controls">
                                        <?php
                                        if ($cards->published == 0) {
                                            $checked = '';
                                        } else {
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input type="checkbox" class="form-control" id="published" name="published"
                                            <?php echo $checked; ?>>
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

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/cards/randoms/edit-card-randoms.js" type="text/javascript"></script>