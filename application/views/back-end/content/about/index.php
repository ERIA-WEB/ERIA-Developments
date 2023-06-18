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
                    <h1 class="title"> About US </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> About US </strong></a>
                        </li>
                        <li class="active">
                            Manage Content
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php $this->load->view('back-end/common/message'); ?>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?php echo $action; ?>">
            <div class="row">
                <div class="col-lg-6">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> About US </h2>
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
                                        value="<?php echo (isset($slider_row)) ? $slider_row->page_id : '' ?>" />
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('menu_title') === '') ? '' : 'error';
                                        $menu_title = (set_value('menu_title') == false && isset($slider_row)) ? $slider_row->menu_title : set_value('menu_title');
                                        ?>
                                        <label class="form-label" for="formfield1"> Menu Title </label>
                                        <span class="desc">e.g. "About Us"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $menu_title ?>"
                                                class="form-control" id="menu_title" name="menu_title">
                                            <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('title') === '') ? '' : 'error';
                                        $title = (set_value('title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                        ?>
                                        <label class="form-label" for="formfield1"> Page Title </label>
                                        <span class="desc">e.g. "About ERIA"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $title ?>"
                                                class="form-control" id="title" name="title">
                                            <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('title') === '') ? '' : 'error';
                                        $titles = (set_value('title') == false && isset($slider_row)) ? $slider_row->content : set_value('title');
                                        ?>
                                        <label class="form-label" for="formfield1"> Mission </label>
                                        <span class="desc">e.g. "ERIA is an international organization established in
                                            Jakarta, Indonesia in 2008 by a formal agreement among Leaders of 16
                                            countries"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control mytextarea" id="content"
                                                name="content"><?php echo $titles ?></textarea>
                                            <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div style="display:none" class="form-group">
                                        <?php
                                        $error = (form_error('order_id') === '') ? '' : 'error';
                                        $order_id = (set_value('order_id') == false && isset($slider_row)) ? $slider_row->order_id : set_value('order_id');
                                        ?>
                                        <label class="form-label" for="formfield1"> Sort Order </label>
                                        <span class="desc">e.g. "100"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="number" required="required" value="<?php echo $order_id ?>"
                                                class="form-control" id="order_id" name="order_id">
                                            <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div style="display: none" class="form-group">
                                        <?php
                                        $error = (form_error('published') === '') ? '' : 'error';
                                        $published = (set_value('published') == false && isset($slider_row)) ? $slider_row->published : set_value('published');
                                        ?>
                                        <label class="form-label" for="formfield1"> Published </label>
                                        <div style="width: 30px" class="controls">base_url_front+"
                                            <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                                <?php } ?> class="form-control" id="published" name="published">
                                            <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>

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
                            <h2 class="title pull-left"> About US Page Content </h2>
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
                                        $error = (form_error('discription') === '') ? '' : 'error';
                                        $discription = (set_value('discription') == false && isset($slider_row)) ? $ns->discription : set_value('discription');
                                        ?>
                                        <label class="form-label" for="formfield1"> Short Description </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control mytextarea"
                                                id="discription"
                                                name="discription"><?php echo $discription ?></textarea>
                                            <?php echo form_error('discription', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('buttonn') === '') ? '' : 'error';
                                        $buttonn = (set_value('buttonn') == false && isset($slider_row)) ? $ns->buttonn : set_value('buttonn');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $buttonn ?>"
                                                class="form-control" id="buttonn" name="buttonn">
                                            <?php echo form_error('buttonn', '<span class="help-inline">', '</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('lik') === '') ? '' : 'error';
                                        $lik = (set_value('lik') == false && isset($slider_row)) ? $ns->lik : set_value('lik');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/how-do-sectoral-employment-structures-affect-mobility-during-the-covid-19-pandemic/"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $lik ?>"
                                                class="form-control" id="lik" name="lik">
                                            <?php echo form_error('lik', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Heading 1 </h2>
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
                                        $error = (form_error('he1') === '') ? '' : 'error';
                                        $he1 = (set_value('he1') == false && isset($slider_row)) ? $ns->he1 : set_value('he1');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $he1 ?>"
                                                class="form-control" id="he1" name="he1">
                                            <?php echo form_error('he1', '<span class="help-inline">', '</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he1_dis') === '') ? '' : 'error';
                                        $he1_dis = (set_value('he1_dis') == false && isset($slider_row)) ? $ns->he1_dis : set_value('he1_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="he1_dis"
                                                name="he1_dis"><?php echo $he1_dis ?></textarea>
                                            <?php echo form_error('he1_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he1_butt') === '') ? '' : 'error';
                                        $he1_butt = (set_value('he1_butt') == false && isset($slider_row)) ? $ns->he1_butt : set_value('he1_butt');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he1_butt ?>"
                                                class="form-control" id="he1_butt" name="he1_butt">
                                            <?php echo form_error('he1_butt', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he1_link') === '') ? '' : 'error';
                                        $he1_link = (set_value('he1_link') == false && isset($slider_row)) ? $ns->he1_link : set_value('he1_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he1_link ?>"
                                                class="form-control" id="he1_link" name="he1_link">
                                            <?php echo form_error('he1_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Heading 2 </h2>
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
                                        $error = (form_error('he2') === '') ? '' : 'error';
                                        $he2 = (set_value('he2') == false && isset($slider_row)) ? $ns->he2 : set_value('he2');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 2 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $he2 ?>"
                                                class="form-control" id="he2" name="he2">
                                            <?php echo form_error('he2', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he2_dis') === '') ? '' : 'error';
                                        $he2_dis = (set_value('he2_dis') == false && isset($slider_row)) ? $ns->he2_dis : set_value('he2_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description 2 </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" value="" class="form-control" id="he2_dis"
                                                name="he2_dis"><?php echo $he2_dis ?></textarea>
                                            <?php echo form_error('he2_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he2_butt') === '') ? '' : 'error';
                                        $he2_butt = (set_value('he2_butt') == false && isset($slider_row)) ? $ns->he2_butt : set_value('he2_butt');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name 2 </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he2_butt ?>"
                                                class="form-control" id="he2_butt" name="he2_butt">
                                            <?php echo form_error('he2_butt', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he2_link') === '') ? '' : 'error';
                                        $he2_link = (set_value('he2_link') == false && isset($slider_row)) ? $ns->he2_link : set_value('he2_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link 2 </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he2_link ?>"
                                                class="form-control" id="he2_link" name="he2_link">
                                            <?php echo form_error('he2_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Heading 3 </h2>
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
                                        $error = (form_error('he3') === '') ? '' : 'error';
                                        $he3 = (set_value('he3') == false && isset($slider_row)) ? $ns->he3 : set_value('he3');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 3 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $he3 ?>"
                                                class="form-control" id="he3" name="he3">
                                            <?php echo form_error('he3', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he3_dis') === '') ? '' : 'error';
                                        $he3_dis = (set_value('he3_dis') == false && isset($slider_row)) ? $ns->he3_dis : set_value('he3_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description 3 </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" value="" class="form-control" id="he3_dis"
                                                name="he3_dis"><?php echo $he3_dis ?></textarea>
                                            <?php echo form_error('he3_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he3_butt') === '') ? '' : 'error';
                                        $he3_butt = (set_value('he3_butt') == false && isset($slider_row)) ? $ns->he3_butt : set_value('he3_butt');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name 3 </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he3_butt ?>"
                                                class="form-control" id="he3_butt" name="he3_butt">
                                            <?php echo form_error('he3_butt', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('he3_link') === '') ? '' : 'error';
                                        $he3_link = (set_value('he3_link') == false && isset($slider_row)) ? $ns->he3_link : set_value('he3_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link 2 </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $he3_link ?>"
                                                class="form-control" id="he3_link" name="he3_link">
                                            <?php echo form_error('he3_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Highlighted Menu </h2>
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
                                        $error = (form_error('hig_menu1') === '') ? '' : 'error';
                                        $hig_menu1 = (set_value('hig_menu1') == false && isset($slider_row)) ? $ns->hig_menu1 : set_value('hig_menu1');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Latest Publications"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $hig_menu1 ?>"
                                                class="form-control" id="hig_menu1" name="hig_menu1">
                                            <?php echo form_error('hig_menu1', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_h1') === '') ? '' : 'error';
                                        $hig_menu_h1 = (set_value('hig_menu_h1') == false && isset($slider_row)) ? $ns->hig_menu_h1 : set_value('hig_menu_h1');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 2 </label>
                                        <span class="desc">e.g. "Ageing and Health in Vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_h1 ?>"
                                                class="form-control" id="hig_menu_h1" name="hig_menu_h1">
                                            <?php echo form_error('hig_menu_h1', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b1') === '') ? '' : 'error';
                                        $hig_menu_b1 = (set_value('hig_menu_b1') == false && isset($slider_row)) ? $ns->hig_menu_b1 : set_value('hig_menu_b1');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_b1 ?>"
                                                class="form-control" id="hig_menu_b1" name="hig_menu_b1">
                                            <?php echo form_error('hig_menu_b1', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b1_link') === '') ? '' : 'error';
                                        $hig_menu_b1_link = (set_value('hig_menu_b1_link') == false && isset($slider_row)) ? $ns->hig_menu_b1_link : set_value('hig_menu_b1_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required"
                                                value="<?php echo $hig_menu_b1_link ?>" class="form-control"
                                                id="hig_menu_b1_link" name="hig_menu_b1_link">
                                            <?php echo form_error('hig_menu_b1_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Highlighted Menu 2 </h2>
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
                                        $error = (form_error('hig_menu2') === '') ? '' : 'error';
                                        $hig_menu2 = (set_value('hig_menu2') == false && isset($slider_row)) ? $ns->hig_menu2 : set_value('hig_menu2');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Latest Publications"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $hig_menu2 ?>"
                                                class="form-control" id="hig_menu2" name="hig_menu2">
                                            <?php echo form_error('hig_menu2', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_h2') === '') ? '' : 'error';
                                        $hig_menu_h2 = (set_value('hig_menu_h2') == false && isset($slider_row)) ? $ns->hig_menu_h2 : set_value('hig_menu_h2');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 2 </label>
                                        <span class="desc">e.g. "Ageing and Health in Vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_h2 ?>"
                                                class="form-control" id="hig_menu_h2" name="hig_menu_h2">
                                            <?php echo form_error('hig_menu_h2', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b2') === '') ? '' : 'error';
                                        $hig_menu_b2 = (set_value('hig_menu_b2') == false && isset($slider_row)) ? $ns->hig_menu_b2 : set_value('hig_menu_b2');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_b2 ?>"
                                                class="form-control" id="hig_menu_b2" name="hig_menu_b2">
                                            <?php echo form_error('hig_menu_b2', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b2_link') === '') ? '' : 'error';
                                        $hig_menu_b2_link = (set_value('hig_menu_b2_link') == false && isset($slider_row)) ? $ns->hig_menu_b2_link : set_value('hig_menu_b2_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required"
                                                value="<?php echo $hig_menu_b2_link ?>" class="form-control"
                                                id="hig_menu_b2_link" name="hig_menu_b2_link">
                                            <?php echo form_error('hig_menu_b2_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Highlighted Menu 3</h2>
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
                                        $error = (form_error('hig_menu3') === '') ? '' : 'error';
                                        $hig_menu3 = (set_value('hig_menu3') == false && isset($slider_row)) ? $ns->hig_menu3 : set_value('hig_menu3');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Latest Publications"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $hig_menu3 ?>"
                                                class="form-control" id="hig_menu3" name="hig_menu3">
                                            <?php echo form_error('hig_menu3', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_h3') === '') ? '' : 'error';
                                        $hig_menu_h3 = (set_value('hig_menu_h3') == false && isset($slider_row)) ? $ns->hig_menu_h3 : set_value('hig_menu_h3');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 2 </label>
                                        <span class="desc">e.g. "Ageing and Health in Vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_h3 ?>"
                                                class="form-control" id="hig_menu_h3" name="hig_menu_h3">
                                            <?php echo form_error('hig_menu_h3', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b3') === '') ? '' : 'error';
                                        $hig_menu_b3 = (set_value('hig_menu_b3') == false && isset($slider_row)) ? $ns->hig_menu_b3 : set_value('hig_menu_b3');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $hig_menu_b3 ?>"
                                                class="form-control" id="hig_menu_b3" name="hig_menu_b3">
                                            <?php echo form_error('hig_menu_b3', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('hig_menu_b3_link') === '') ? '' : 'error';
                                        $hig_menu_b3_link = (set_value('hig_menu_b3_link') == false && isset($slider_row)) ? $ns->hig_menu_b3_link : set_value('hig_menu_b3_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required"
                                                value="<?php echo $hig_menu_b1_link ?>" class="form-control"
                                                id="hig_menu_b3_link" name="hig_menu_b3_link">
                                            <?php echo form_error('hig_menu_b3_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
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
                            <h2 class="title pull-left"> Research Content </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                <i class="box_close fa fa-times"></i>
                            </div>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('r_head') === '') ? '' : 'error';
                                        $r_head = (set_value('r_head') == false && isset($slider_row)) ? $nsr->r_head : set_value('r_head');
                                        ?>
                                        <label class="form-label" for="formfield1"> Content Heading </label>
                                        <span class="desc">e.g. "Agricultural Development"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $r_head ?>"
                                                class="form-control" id="r_head" name="r_head">
                                            <?php echo form_error('r_head', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('rdis') === '') ? '' : 'error';
                                        $rdis = (set_value('rdis') == false && isset($slider_row)) ? $nsr->rdis : set_value('rdis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "ERIA's research on agricultural development attempts to
                                            address the growing opportunities for agricultural development and trade
                                            arising from a robustly growing East Asia, as well as the political and
                                            social imperative of food security in the region."</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="rdis"
                                                name="rdis"><?= $rdis ?></textarea>
                                            <?php echo form_error('rdis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('rbbutton') === '') ? '' : 'error';
                                        $rbbutton = (set_value('rbbutton') == false && isset($slider_row)) ? $nsr->rbbutton : set_value('rbbutton');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button </label>
                                        <span class="desc">e.g. "Read more"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $rbbutton ?>"
                                                class="form-control" id="rbbutton" name="rbbutton">
                                            <?php echo form_error('rbbutton', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('r_link') === '') ? '' : 'error';
                                        $r_link = (set_value('r_link') == false && isset($slider_row)) ? $nsr->r_link : set_value('r_link');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/research/topic/agricultural-development"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $r_link ?>"
                                                class="form-control" id="r_link" name="r_link">
                                            <?php echo form_error('r_link', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 1 </h2>
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
                                        $error = (form_error('h_1') === '') ? '' : 'error';
                                        $h_1 = (set_value('h_1') == false && isset($slider_row)) ? $nsr->h_1 : set_value('h_1');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_1 ?>"
                                                class="form-control" id="h_1" name="h_1">
                                            <?php echo form_error('h_1', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_1_dis') === '') ? '' : 'error';
                                        $h_1_dis = (set_value('h_1_dis') == false && isset($slider_row)) ? $nsr->h_1_dis : set_value('h_1_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="he1_dis"
                                                name="h_1_dis"><?php echo $h_1_dis ?></textarea>
                                            <?php echo form_error('h_1_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_1_b') === '') ? '' : 'error';
                                        $h_1_b = (set_value('h_1_b') == false && isset($slider_row)) ? $nsr->h_1_b : set_value('h_1_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_1_b ?>"
                                                class="form-control" id="h_1_b" name="h_1_b">
                                            <?php echo form_error('h_1_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_1_l') === '') ? '' : 'error';
                                        $h_1_l = (set_value('h_1_l') == false && isset($slider_row)) ? $nsr->h_1_l : set_value('h_1_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_1_l ?>"
                                                class="form-control" id="h_1_l" name="h_1_l">
                                            <?php echo form_error('h_1_l', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 2 </h2>
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
                                        $error = (form_error('h_2') === '') ? '' : 'error';
                                        $h_2 = (set_value('h_2') == false && isset($slider_row)) ? $nsr->h_2 : set_value('h_2');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_2 ?>"
                                                class="form-control" id="h_2" name="h_2">
                                            <?php echo form_error('h_2', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_2_dis') === '') ? '' : 'error';
                                        $h_2_dis = (set_value('h_2_dis') == false && isset($slider_row)) ? $nsr->h_2_dis : set_value('h_2_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Discription </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="h_2_dis"
                                                name="h_2_dis"><?php echo $h_2_dis ?></textarea>
                                            <?php echo form_error('h_2_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_2_b') === '') ? '' : 'error';
                                        $h_2_b = (set_value('h_2_b') == false && isset($slider_row)) ? $nsr->h_2_b : set_value('h_2_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_2_b ?>"
                                                class="form-control" id="h_2_b" name="h_2_b">
                                            <?php echo form_error('h_2_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_2_l') === '') ? '' : 'error';
                                        $h_2_l = (set_value('h_2_l') == false && isset($slider_row)) ? $nsr->h_2_l : set_value('h_2_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_2_l ?>"
                                                class="form-control" id="h_2_l" name="h_2_l">
                                            <?php echo form_error('h_2_l', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 3 </h2>
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
                                        $error = (form_error('h_3') === '') ? '' : 'error';
                                        $h_3 = (set_value('h_3') == false && isset($slider_row)) ? $nsr->h_3 : set_value('h_3');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_3 ?>"
                                                class="form-control" id="h_3" name="h_3">
                                            <?php echo form_error('h_3', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_3_dis') === '') ? '' : 'error';
                                        $h_3_dis = (set_value('h_3_dis') == false && isset($slider_row)) ? $nsr->h_3_dis : set_value('h_3_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="h_3_dis"
                                                name="h_3_dis"><?php echo $h_3_dis ?></textarea>
                                            <?php echo form_error('h_3_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_3_b') === '') ? '' : 'error';
                                        $h_3_b = (set_value('h_3_b') == false && isset($slider_row)) ? $nsr->h_3_b : set_value('h_3_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_3_b ?>"
                                                class="form-control" id="h_3_b" name="h_3_b">
                                            <?php echo form_error('h_3_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_3_l') === '') ? '' : 'error';
                                        $h_3_l = (set_value('h_3_l') == false && isset($slider_row)) ? $nsr->h_3_l : set_value('h_3_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_3_l ?>"
                                                class="form-control" id="h_3_l" name="h_3_l">
                                            <?php echo form_error('h_3_l', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 4 </h2>
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
                                        $error = (form_error('h_4') === '') ? '' : 'error';
                                        $h_4 = (set_value('h_4') == false && isset($slider_row)) ? $nsr->h_4 : set_value('h_4');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_4 ?>"
                                                class="form-control" id="h_4" name="h_4">
                                            <?php echo form_error('h_4', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_4_dis') === '') ? '' : 'error';
                                        $h_4_dis = (set_value('h_4_dis') == false && isset($slider_row)) ? $nsr->h_4_dis : set_value('h_4_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="h_4_dis"
                                                name="h_4_dis"><?php echo $h_4_dis ?></textarea>
                                            <?php echo form_error('h_4_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_4_b') === '') ? '' : 'error';
                                        $h_4_b = (set_value('h_4_b') == false && isset($slider_row)) ? $nsr->h_4_b : set_value('h_4_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_4_b ?>"
                                                class="form-control" id="h_4_b" name="h_4_b">
                                            <?php echo form_error('h_4_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_4_l') === '') ? '' : 'error';
                                        $h_4_l = (set_value('h_4_l') == false && isset($slider_row)) ? $nsr->h_4_l : set_value('h_4_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_4_l ?>"
                                                class="form-control" id="h_4_l" name="h_4_l">
                                            <?php echo form_error('h_4_l', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 5 </h2>
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
                                        $error = (form_error('h_5') === '') ? '' : 'error';
                                        $h_5 = (set_value('h_5') == false && isset($slider_row)) ? $nsr->h_5 : set_value('h_5');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_5 ?>"
                                                class="form-control" id="h_5" name="h_5">
                                            <?php echo form_error('h_5', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_5_dis') === '') ? '' : 'error';
                                        $h_5_dis = (set_value('h_5_dis') == false && isset($slider_row)) ? $nsr->h_5_dis : set_value('h_5_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="h_5_dis"
                                                name="h_5_dis"><?php echo $h_5_dis ?></textarea>
                                            <?php echo form_error('h_5_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_5_b') === '') ? '' : 'error';
                                        $h_5_b = (set_value('h_5_b') == false && isset($slider_row)) ? $nsr->h_5_b : set_value('h_5_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_5_b ?>"
                                                class="form-control" id="h_5_b" name="h_5_b">
                                            <?php echo form_error('h_5_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_5_l') === '') ? '' : 'error';
                                        $h_5_l = (set_value('h_5_l') == false && isset($slider_row)) ? $nsr->h_5_l : set_value('h_5_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_5_l ?>"
                                                class="form-control" id="h_5_l" name="h_5_l">
                                            <?php echo form_error('h_5_l', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"> Research Heading 6 </h2>
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
                                        $error = (form_error('h_6') === '') ? '' : 'error';
                                        $h_6 = (set_value('h_6') == false && isset($slider_row)) ? $nsr->h_6 : set_value('h_6');
                                        ?>
                                        <label class="form-label" for="formfield1"> Heading 1 </label>
                                        <span class="desc">e.g. "Introduction"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?= $h_6 ?>"
                                                class="form-control" id="h_6" name="h_6">
                                            <?php echo form_error('h_6', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_6_dis') === '') ? '' : 'error';
                                        $h_6_dis = (set_value('h_6_dis') == false && isset($slider_row)) ? $nsr->h_6_dis : set_value('h_6_dis');
                                        ?>
                                        <label class="form-label" for="formfield1"> Description </label>
                                        <span class="desc">e.g. "See More"</span>
                                        <div class="controls">base_url_front+"
                                            <textarea required="required" class="form-control" id="h_6_dis"
                                                name="h_6_dis"><?php echo $h_6_dis ?></textarea>
                                            <?php echo form_error('h_6_dis', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_6_b') === '') ? '' : 'error';
                                        $h_6_b = (set_value('h_6_b') == false && isset($slider_row)) ? $nsr->h_6_b : set_value('h_6_b');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Name </label>
                                        <span class="desc">e.g. "Read More"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_6_b ?>"
                                                class="form-control" id="h_6_b" name="h_6_b">
                                            <?php echo form_error('h_6_b', '<span class="help-inline">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $error = (form_error('h_6_l') === '') ? '' : 'error';
                                        $h_6_l = (set_value('h_6_l') == false && isset($slider_row)) ? $nsr->h_6_l : set_value('h_6_l');
                                        ?>
                                        <label class="form-label" for="formfield1"> Button Link </label>
                                        <span class="desc">e.g.
                                            "https://www.eria.org/publications/ageing-and-health-vietnam"</span>
                                        <div class="controls">base_url_front+"
                                            <input type="text" required="required" value="<?php echo $h_6_l ?>"
                                                class="form-control" id="h_6_l" name="h_6_l">
                                            <?php echo form_error('h_6_l', '<span class="help-inline">', '</span>'); ?>
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

            </div>
        </form>

    </section>
</section>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
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
<script src="<?= base_url(); ?>v6/js/admin/abouts/index.js" type="text/javascript"></script>