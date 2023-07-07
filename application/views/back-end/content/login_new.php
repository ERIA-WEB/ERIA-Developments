<?php defined('BASEPATH') or exit('No direct script access allowed');
$bgs = glob("resources/login-bgs/*.jpg");



// $this->sma->print_arrays($bgs);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <script type="text/javascript">
    if (parent.frames.length !== 0) {
        top.location = '<?=base_url()?>';
    }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url() ?>resources/images/favicon.png" type="image/x-icon" />
    <link href="<?= base_url() ?>resources/login/theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>resources/login/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>resources/login/helpers/login.css" rel="stylesheet" />
    <script type="text/javascript" src="<?= base_url() ?>resources/login/js/jquery-2.0.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?= $assets ?>js/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
        min-width: 350px;
    }

    .bblue {
        background: #fff !important;
    }

    .login-page .page-back {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        background-size: cover !important;
        background-position: center !important;
        background-image: url("<?=base_url().$bgs[mt_rand(0, count($bgs) - 1)] ?>") !important;
    }

    .contents {
        margin: 16px;
        border-radius: 6px;
        padding: 32px 16px;
        background: rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    .login-content,
    .login-page .login-form-links {
        margin-top: 20px;
        border-radius: 6px;
    }
    </style>

</head>

<body class="login-page">
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p>
                    <strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript
                    enabled in
                    your browser to utilize the functionality of this website.
                </p>
            </div>
        </div>
    </noscript>
    <div class="page-back">
        <div class="contents">
            <div class="text-center">
                <img src="<?= base_url() ?>v6/assets/logo.webp" width="200" alt="" style="margin-bottom:10px;   " />
            </div>

            <div id="login">
                <div class="container">

                    <div class="login-form-div">
                        <div class="login-content">
                            <?php
                             if ($this->session->flashdata('error-message') != '') { ?>

                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <ul class="list-group"><?php echo $this->session->flashdata('error-message'); ?></ul>
                            </div>
                            <?php
                            }
                            if ($this->session->flashdata('success-message') != '') {
                                ?>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <ul class="list-group"><?php echo $this->session->flashdata('success-message'); ?></ul>
                            </div>
                            <?php
                            }
                            ?>


                            <?php echo form_open('system-content/Login/validate', 'class=" " id=" " '); ?>

                            <div class="div-title col-sm-12">
                                <h3 class="text-primary"> Log in to your Account </h3>
                            </div>
                            <div class="col-sm-12">
                                <div class="textbox-wrap form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" value="" required="required" class="form-control"
                                            name="username" placeholder="" />
                                    </div>
                                </div>
                                <div class="textbox-wrap form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" value="" required="required" class="form-control "
                                            name="password" placeholder="" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-action col-sm-12">
                                <div class="checkbox pull-left">
                                    <div class="custom-checkbox">
                                        <?php echo form_checkbox('remember', '1', false, 'id="remember"'); ?>
                                    </div>
                                    <span class="checkbox-text pull-left"><label for="remember">Remember
                                            Me</label></span>
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Login &nbsp; <i
                                        class="fa fa-sign-in"></i></button>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="login-form-links link2">
                            <h4 class="text- ">Forgot your password ? </h4>

                            <a href="#forgot_password" class="text-danger forgot_password_link">Click here to reset </a>

                        </div>








                    </div>
                </div>



            </div>


            <div id="forgot_password" style="display: none;">
                <div class=" container">
                    <div class="login-form-div">
                        <div class="login-content">

                            <div class="div-title col-sm-12">
                                <h3 class="text-primary"> Reset Password </h3>
                            </div>

                            <?php echo form_open('system-content/Login/forgot_password', 'class="login" data-toggle="validator"'); ?>
                            <div class="col-sm-12">
                                <p>
                                    Please enter your email address to generate your temporary password
                                </p>
                                <div class="textbox-wrap form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
                                        <input type="email" name="forgot_email" class="form-control "
                                            placeholder="Email Address" required="required" />
                                    </div>
                                </div>
                                <div class="form-action">
                                    <a class="btn btn-success pull-left login_link" href="#login">
                                        <i class="fa fa-chevron-left"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Submit &nbsp;&nbsp; <i class="fa fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    </div>
    <script src="<?= base_url() ?>resources/login/js/jquery.js"></script>
    <script src="<?= base_url() ?>resources/login/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>resources/login/js/jquery.cookie.js"></script>
    <script src="<?= base_url() ?>resources/login/js/login.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        localStorage.clear();
        var hash = window.location.hash;
        if (hash && hash != '') {
            $("#login").hide();
            $(hash).show();
        }
    });
    </script>
</body>

</html>