<style>
.icheck-minimal-pink {
    width: 25px;
    padding: 5px;
}

.thehead {
    background: #9c9c9c;
    color: black;
    font-weight: bold;

}


table.dataTable thead th,
table.dataTable thead td {

    padding: 10px 18px;
    border-bottom: none;
    border-right: solid 1px black;

    border-left: solid 1px black;

    background: #010101;
    color: white;

}


/* The container */
.container-checkbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.container-checkbox .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container-checkbox:hover input~.checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container-checkbox input:checked~.checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.container-checkbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container-checkbox input:checked~.checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container-checkbox .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}


/* The container */
.container-radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.container-radio .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container-radio:hover input~.checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container-radio input:checked~.checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.container-radio .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container-radio input:checked~.checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container-radio .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}

table.dataTable tbody th,
table.dataTable tbody td {
    padding: 8px 10px 16px !;
}
</style>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">

        <?php   ?>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Add User Privilages</h1>
                </div>


                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-home"></i>Privilages</a>
                        </li>

                        <li class="active">
                            <strong>Add User Privilages</strong>
                        </li>
                    </ol>
                </div>







            </div>
        </div>



        <!--my comment-->

        <div class="clearfix"></div>

        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">Privilages <?php
                                                            //var_dump($setprivilages);
                                                            ?></h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">


                            <?php   //var_dump($cdata);


                            $ndata = $cdata;

                            ?>
                            <table style="font-size:12px;" id=""
                                class=" dataTable display table table-hover table-condensed" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Module</th>
                                        <th>Access Permision</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $x = 0;
                                    foreach ($ndata as $privilages) {
                                        $x++;



                                    ?> <tr>

                                        <td colspan="3" class="thehead" style="border-left:#000 solid 1px; ">
                                            <?php echo $privilages['main']; ?></td>


                                    </tr>
                                    <?php $x = 0;
                                        foreach ($privilages['subdata'] as $sdata) {
                                            $x++; ?>

                                    <tr>

                                        <td style="border-left:#000 solid 1px; ">

                                            <?= $x ?>

                                        </td>



                                        <td>




                                            <?php echo ($sdata['name']) ?>





                                        </td>

                                        <td style="float:right;">



                                            <input tabindex="5" id="<?php echo $sdata['id'] ?>" type="checkbox"
                                                class="form-control icheck-minimal-pink"
                                                <?php if ($sdata['cnt'] == 1) { ?> checked="checked" <?php } ?>
                                                onclick="_privilages(<?php echo $sdata['id'] ?>,<?php echo $sdata['ud'] ?>);  ">

                                            <?php   ?>




                                        </td>



                                    </tr>

                                    <tr id="collapse<?php echo $sdata['id'] ?>"
                                        class="panel-collapse collapse <?php if ($sdata['cnt'] == 1) { ?> in <?php  } ?> "
                                        role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">

                                    </tr>


                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>



<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script>
<script
    src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js"
    type="text/javascript"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/users/privillages.js" type="text/javascript"></script>