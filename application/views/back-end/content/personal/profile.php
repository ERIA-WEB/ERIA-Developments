<style>
.form-group {
    margin: 20px !important;
}
</style>

<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">User Profile</h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=""><i class="fa fa-home"></i>Home</a>
                        </li>
                        <!--<li>
                                        <a href="ui-pricing.html">Pages</a>
                                    </li>-->
                        <li class="active">
                            <strong>Profile</strong>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <section class="box  ">
                <div class="content-body" style="    background-color:#f1f2f7;
    border: 0px solid transparent;
    padding: 0 0px 0px 0px;">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="img-relative ">
                                <!-- Loading image -->
                                <div class="overlay uploadProcess" style="display: none;">
                                    <div class="overlay-content"><img src="images/loading.gif" /></div>
                                </div>
                                <!-- Hidden upload form -->
                                <form method="post" action="<?php echo base_url() ?>system-content/Profile/profile"
                                    enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
                                    <input type="file" name="picture" id="fileInput" style="display:none" />
                                </form>
                                <iframe id="uploadTarget" name="uploadTarget" src="#"
                                    style="width:0;height:0;border:0px solid #fff;"></iframe>
                                <!-- Image update link -->

                                <!-- Profile image -->
                                <div class="uprofile-image">

                                    <?php if ($profile) {
                                        if ($profile->p_pic) {
                                    ?>
                                    <img src="<?php echo base_url() ?>resources/images/profile/<?php echo $profile->p_pic ?>"
                                        id="imagePreview" class="img-responsive ">
                                    <?php
                                        } else {
                                        ?>
                                    <img src="<?php echo base_url() ?>resources/images/profile/avatar.png"
                                        id="imagePreview" class="img-responsive ">
                                    <?php
                                        }
                                    } else {
                                        ?>
                                    <img src="<?php echo base_url() ?>resources/images/profile/avatar.png"
                                        id="imagePreview" class="img-responsive ">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="uprofile-name">
                                <h3>
                                    <a href="#">
                                        <?php
                                        $data_s = $this->session->userdata('logged_in');
                                        $id = $profile->user_id;
                                        $username = $profile->username;
                                        $email = $profile->email;
                                        echo $username;
                                        ?>
                                    </a>
                                    <a class="editLinks" href="javascript:void(0);">
                                        <img src="<?php echo base_url() ?>resources/images/pen-checkbox-512.webp"
                                            width="20" height="20" /></a>
                                    <!-- Available statuses: online, idle, busy, away and offline -->
                                    <span class="uprofile-status online"></span>
                                </h3>
                                <p class="uprofile-title"> System User </p>
                            </div>
                            <!--<div class="uprofile-info">
                                            <ul class="list-unstyled">
                                                <li><i class='fa fa-home'></i> New York, USA</li>
                                                <li><i class='fa fa-user'></i> 340 Contacts</li>
                                                <li><i class='fa fa-suitcase'></i> Tech Lead, YIAM</li>
                                            </ul>
                                        </div>-->
                            <!-- <div class="uprofile-buttons">
                                            <a class="btn btn-md btn-primary">Send Message</a>
                                            <a class="btn btn-md btn-primary">Add as Friend</a>
                                        </div>-->
                            <!--<div class=" uprofile-social">

                                            <a href="#" class="btn btn-primary btn-md facebook"><i class="fa fa-facebook icon-xs"></i></a>
                                            <a href="#" class="btn btn-primary btn-md twitter"><i class="fa fa-twitter icon-xs"></i></a>
                                            <a href="#" class="btn btn-primary btn-md google-plus"><i class="fa fa-google-plus icon-xs"></i></a>
                                            <a href="#" class="btn btn-primary btn-md dribbble"><i class="fa fa-dribbble icon-xs"></i></a>

                                        </div>-->

                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12">

                            <div class="uprofile-content">
                                <div class="enter_post col-md-12 col-sm-12 col-xs-12">
                                    <?php $this->load->view('back-end/common/message'); ?>
                                    <section class="box ">
                                        <header class="panel_header">
                                            <h2 class="title pull-left">Update Password</h2>
                                            <div class="actions panel_actions pull-right">
                                                <i class="box_toggle fa fa-chevron-down"></i>
                                                <i class="box_setting fa fa-cog" data-toggle="modal"
                                                    href="#section-settings"></i>
                                                <i class="box_close fa fa-times"></i>
                                            </div>
                                        </header>
                                        <div class="content-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">



                                                    <form id="icon_validate" method="post"
                                                        action="<?php echo $action; ?>">

                                                        <div class="form-group">
                                                            <label class="form-label" for="formfield3">Current Password
                                                                :</label>

                                                            <div class="controls">
                                                                <i class=""></i>
                                                                <input type="password" required="required"
                                                                    class="form-control" id="o_password"
                                                                    name="o_password">

                                                                <?php echo form_error('o_password', '<span class="help-inline">', '</span>'); ?>


                                                            </div>
                                                        </div>




                                                        <div class="form-group">
                                                            <label class="form-label" for="formfield3">New
                                                                Password:</label>

                                                            <div class="controls">
                                                                <i class=""></i>
                                                                <input type="password" required="required"
                                                                    class="form-control" id="n_password"
                                                                    name="n_password">

                                                                <?php echo form_error('n_password', '<span class="help-inline">', '</span>'); ?>
                                                            </div>
                                                        </div>







                                                        <div class="form-group">
                                                            <label class="form-label" for="formfield3">Confirm
                                                                Password:</label>

                                                            <div class="controls">
                                                                <i class=""></i>
                                                                <input type="password" required="required"
                                                                    class="form-control" id="c_password"
                                                                    name="c_password">

                                                                <?php echo form_error('c_password', '<span class="help-inline">', '</span>'); ?>
                                                            </div>
                                                        </div>





                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="btn btn-primary pull-right">Update</button>



                                                        </div>

                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                </div>
                                <div class="clearfix"></div>
                            </div>
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