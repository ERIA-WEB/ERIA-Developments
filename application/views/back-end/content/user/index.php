<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">



        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Manage Users </h1>
                </div>


                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Administration</strong></a>
                        </li>

                        <li class="active">
                            Users
                        </li>
                    </ol>
                </div>







            </div>
        </div>



        <!--my comment-->

        <div class="clearfix"></div>

        <div class="col-lg-4"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">Add User</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">





                            <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo $action; ?>">


                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id" value="<?php echo (isset($user_row)) ? $user_row->user_id : '' ?>" />






                                <div class="form-group">


                                    <?php
                                    $error = (form_error('username') === '') ? '' : 'error';
                                    $group = (set_value('username') == false && isset($user_row)) ? $user_row->group_id : set_value('group');
                                    ?>



                                    <label class="form-label" for="formfield1">Group Name</label>
                                    <span class="desc">e.g. "AH"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select class="form-control" id="group" name="group">

                                            <?php foreach ($glist->result() as $area) {

                                            ?>

                                                <option value="<?= $area->group_id ?>"><?= $area->group_name ?></option>

                                            <?php

                                            } ?>

                                        </select>
                                        <?php echo form_error('group', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>





                                <div class="form-group">


                                    <?php
                                    $error = (form_error('username') === '') ? '' : 'error';
                                    $user = (set_value('username') == false && isset($user_row)) ? $user_row->username : set_value('username');
                                    ?>



                                    <label class="form-label" for="formfield1">User Name</label>
                                    <span class="desc">e.g. "Avi Hazuria"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $user ?>" class="form-control" id="username" name="username">
                                        <?php echo form_error('username', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class="form-label" for="formfield3"> Password </label>

                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="password" class="form-control" id="n_password" name="n_password">

                                        <?php echo form_error('n_password', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="form-label" for="formfield3">Confirm Password </label>

                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="password" class="form-control" id="c_password" name="c_password">

                                        <?php echo form_error('c_password', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>



                                <div class="form-group">


                                    <?php
                                    $error = (form_error('email') === '') ? '' : 'error';
                                    $email = (set_value('email') == false && isset($user_row)) ? $user_row->email : set_value('email');
                                    ?>



                                    <label class="form-label" for="formfield1"> Email </label>
                                    <span class="desc">e.g. "info@company.com"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="email" required="required" value="<?php echo $email ?>" class="form-control" id="email" name="email">
                                        <?php echo form_error('email', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>



                                <div class="form-group">


                                    <?php
                                    $error = (form_error('full_name') === '') ? '' : 'error';
                                    $full_name = (set_value('full_name') == false && isset($user_row)) ? $user_row->full_name : set_value('full_name');
                                    ?>



                                    <label class="form-label" for="formfield1"> Full Name</label>
                                    <span class="desc">e.g. "system-content"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $full_name ?>" class="form-control" id="full_name" name="full_name">
                                        <?php echo form_error('full_name', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>






                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">

                                        <i class="bImg fa fa-save "></i>

                                        Save</button>

                                </div>
                            </form>






                        </div>
                    </div>
                </div>
            </section>
        </div>





        <div class="col-lg-8">




            <section class="box ">






                <header class="panel_header">


                    <h2 class="title pull-left"> User List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">


                            <table id="example " style="font-size:12px;" class="nt display table table-hover table-condensed" cellspacing="0" width="100%">


                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> User Name</th>
                                        <th> Group</th>
                                        <th> Full Name</th>
                                        <th> Email</th>
                                        <th> Last Update </th>
                                        <th class="hidden-print">Action</th>


                                    </tr>
                                </thead>

                                <tbody>






                                    <?php $x = 0;
                                    foreach ($areaList->result() as $id => $area) : $x++; ?>







                                        <tr>
                                            <td> <?php echo $x; ?> </td>
                                            <td> <?php echo $area->username; ?></td>
                                            <td> <?php echo $area->group_name; ?></td>
                                            <td> <?php echo $area->full_name; ?></td>
                                            <td> <?php echo $area->email; ?></td>
                                            <td> <?php echo $area->modified_date; ?></td>

                                            <td class="hidden-print">

                                                <?php $data_s = $this->session->userdata('logged_in');
                                                if ($data_s['user_id'] == 1 || $data_s['edit'] == 1 || $data_s['user_id'] == 4 || $data_s['edit'] == 4) {  ?>

                                                    <a class="btn btn-info" href="<?php echo base_url() ?>system-content/user/editUser/<?php echo $area->user_id ?>">
                                                        <i class="fa fa-edit"></i> </a>
                                                    &nbsp; &nbsp;


                                                <?php }
                                                if ($data_s['user_id'] == 1 || $data_s['delete'] == 1 || $data_s['user_id'] == 4 || $data_s['delete'] == 4) {  ?>




                                                    <a href="#confirm" data-id="<?php echo $area->user_id; ?>" data-area="<?php echo $area->username; ?>" data-placement="left" class="btn btn-danger confirmation-callback">

                                                        <i class="fa fa-trash"></i> </a>

                                                <?php } ?>


                                            </td>




                                        </tr>

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





<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>






<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>


<!-- CORE JS FRAMEWORK - END -->



<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>


<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>


<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>


<script>
    var delete_id = null;
    var delete_tr = null;
    var name = null;

    $('.confirmation-callback').click(function() {
        delete_id = $(this).data("id");
        name = $(this).data("area");
        delete_tr = $(this).closest('tr');
    });

    $('.confirmation-callback').confirmation({

        singleton: true,

        onConfirm: function(event, element) {



            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/user/deleteUser",
                data: {
                    id: delete_id,
                    name: name

                }
            }).done(function(json) {


                delete_tr.css("background-color", "#FF0000");
                delete_tr.fadeOut(1200, function() {
                    delete_tr.remove();
                });


            })


        }
    });






    $('.nt').dataTable({
        "ordering": true
    });
</script>