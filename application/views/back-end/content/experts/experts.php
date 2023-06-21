<style>
.dataTables_info {
    margin-top: -50px !important;
}

table,
th,
tr,
td {
    border: 1px solid;
    padding: 5px;
}
</style>
<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Add People </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-globe"></i><strong>People </strong></a>
                        </li>
                        <li class="active">
                            Add
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <?php $this->load->view('back-end/common/message'); ?>
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left"> People </h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                            action="<?php echo $action; ?>">
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
                                    value="<?php echo (isset($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb" style="margin-left: 40%;">
                                            <?php $path = (!isset($slider_row->image_name)) ? "/uploads/experts/slider.jpg" : $slider_row->image_name; ?>
                                            <img id="placeholder" class="grayscale"
                                                src="<?php echo base_url(); ?><?php echo $path; ?>" width="142"
                                                alt="Sample Image">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('image') === '') ? '' : 'error';
                                    $image = (set_value('image') == false && isset($slider_row)) ? $slider_row->image_name : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Image </label>
                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please using Demensions
                                        240px x 340px*)</span>
                                    <div class="controls">
                                        <input type="hidden" id="image" name="image" value="<?php echo $image; ?>" />
                                        <input class="input-file form-control uniform_on focused" id="photo"
                                            value="<?php echo $image; ?>" name="photo" type="file" accept="image/*"
                                            placeholder="photo">
                                        <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $menu_title = (set_value('menu_title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Name </label>
                                    <span class="desc">e.g. "Takuya Fujita"</span>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $menu_title ?>" class="form-control"
                                            id="title" name="title">
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('sub_experts') === '') ? '' : 'error';
                                            $sub_experts = (set_value('sub_experts') == false && isset($slider_row)) ? $slider_row->sub_experts : set_value('sub_experts');
                                            ?>
                                            <label class="form-label" for="formfield1"> People Category </label>
                                            <span class="desc">Choose people category</span>
                                            <div class="controls">
                                                <select name="sub_experts" id="cat">
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($areaList as $areaList) { ?>
                                                    <option <?php if ($sub_experts == $areaList->ec_id) { ?> selected
                                                        <?php } ?> value="<?php echo $areaList->ec_id ?>">
                                                        <?php echo $areaList->category ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('sub_experts', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <?php
                                        $error = (form_error('subcategory') === '') ? '' : 'error';
                                        $subcategoryexpert = (set_value('subcategory') == false && isset($slider_row)) ? $slider_row->sc_id : set_value('subcategory');
                                        ?>
                                        <!-- comment -->
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Departement or Unit</label>
                                            <span class="desc">e.g. " Policy Advisor"</span>
                                            <span style="font-size: 9px;font-style: italic;color: red;">(Please choose
                                                People category first*)</span>
                                            <div class="controls">
                                                <!--sub_pexperts-->
                                                <select id="departementUnit" name="subcategory[]" multiple>
                                                    <option value="">--Select Departement or Units--</option>
                                                    <!--id="pcat"-->
                                                    <?php
                                                    $getResultDepartement = $this->Page_model->getArticleExpertDepartementById($slider_row->article_id);

                                                    foreach ($getResultDepartement as $value) {
                                                        echo '<option value="' . $value->id . '" selected>' . $value->name . '</option>';
                                                    }
                                                    if (isset($slider_row->sub_experts)) {
                                                        $getDepartement = $this->Page_model->getExpertDepartementByCategoryID($slider_row->sub_experts);

                                                        if (!empty($getDepartement)) {
                                                            foreach ($getDepartement as $value) {
                                                                $departementIDs[] = $value->eria_departement_id;
                                                            }

                                                            $departement_units = $this->Page_model->getDepartementByIDs($departementIDs);
                                                        } else {
                                                            $departement_units = array();
                                                        }

                                                        foreach ($departement_units as $value) {
                                                            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php echo form_error('sub_pexperts', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('major') === '') ? '' : 'error';
                                            $major = (set_value('major') == false && isset($slider_row)) ? $slider_row->major : set_value('major');
                                            ?>
                                            <label class="form-label" for="formfield1"> Post/Major </label>
                                            <span class="desc">e.g. "Spatial Economics Economic Integration in East Asia
                                                Simulation"</span>
                                            <div class="controls">
                                                <input type="text" value="<?php echo $major ?>" class="form-control"
                                                    id="major" name="major">
                                                <?php echo form_error('major', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <?php
                                                $error = (form_error('majorEmail') === '') ? '' : 'error';
                                                $menu_major_email = (set_value('majorEmail') == false && isset($slider_row)) ? $slider_row->majorEmail : set_value('majorEmail');
                                                ?>
                                                <label class="form-label" for="formfield1"> Email </label>
                                                <span class="desc">e.g. "example@mail.com"</span>
                                                <div class="controls">
                                                    <input type="text" value="<?php echo $menu_major_email ?>"
                                                        class="form-control" id="majorEmail" name="majorEmail">
                                                    <?php echo form_error('majorEmail', '<span class="help-inline">', '</span>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    $error = (form_error('article_keywords') === '') ? '' : 'error';
                                    $article_keywords = (set_value('article_keywords') == false && isset($slider_row)) ? $slider_row->article_keywords : set_value('article_keywords');
                                    ?>
                                    <label class="form-label" for="formfield1"> Short Bio </label>
                                    <div class="controls">
                                        <textarea style="width:100%;height: 250px" id="article_keywords"
                                            class="form-control mytextarea" name="article_keywords">
                                            <?php echo $article_keywords ?>
                                        </textarea>
                                        <?php echo form_error('article_keywords', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Expertise </label>
                                    <?php if (!empty($content)) { ?>
                                    <textarea class="form-control mytextarea" name="content">
                                            <?php echo $content; ?>
                                        </textarea>
                                    <?php } else { ?>
                                    <textarea class="form-control mytextarea" name="content"></textarea>
                                    <?php } ?>
                                    <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $education = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->education : set_value('education');
                                    ?>
                                    <label class="form-label" for="formfield1"> Education </label>
                                    <div class="controls">
                                        <?php if (!empty($education)) { ?>
                                        <textarea id="education" class="form-control mytextarea"
                                            name="education"><?php echo $education; ?></textarea>
                                        <?php } else { ?>
                                        <textarea id="education" class="form-control mytextarea"
                                            name="education"></textarea>
                                        <?php } ?>
                                        <!--  <table class="table table-bordered"><tbody><tr><td><br></td><td><br></td></tr></tbody></table>  -->
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $publications = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->publications : set_value('publications');
                                    ?>
                                    <label class="form-label" for="formfield1"> Publications </label>
                                    <div class="controls">
                                        <?php if (!empty($publications)) { ?>
                                        <?php
                                            function safeDisplayEditor($str)
                                            {
                                                $str = stripslashes($str);
                                                $str = str_replace("\n", "", $str);
                                                $str = str_replace("\r", "", $str);
                                                $str = str_replace(array('?quot;'), array('"'), $str);
                                                $str = str_replace(array('?gt;'), array('>'), $str);
                                                $str = str_ireplace(array('<p>&nbsp;</p>', '&#65533;'), array('', '&bull;'), $str);
                                                return $str;
                                            }

                                            function createDomDocumentFromHtml($html)
                                            {
                                                $document = new \DOMDocument('1.0', 'UTF-8');
                                                $internalErrors = libxml_use_internal_errors(true);
                                                $document->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
                                                libxml_use_internal_errors($internalErrors);
                                                $document->formatOutput = true;

                                                return $document;
                                            }

                                            $chars = str_split($publications);
                                            ?>
                                        <textarea id="publications" class="form-control mytextarea"
                                            name="publications"><?php echo mb_convert_encoding($publications, 'HTML-ENTITIES', 'UTF-8'); ?></textarea>
                                        <?php } else { ?>
                                        <textarea id="publications" class="form-control mytextarea"
                                            name="publications"></textarea>
                                        <?php } ?>
                                        <?php echo form_error('publications', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $experience = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->experience : set_value('experience');
                                    ?>
                                    <label class="form-label" for="formfield1"> Experience </label>
                                    <div class="controls">
                                        <?php if (!empty($experience)) { ?>
                                        <textarea style="height: 750px" id="experience" class="form-control mytextarea"
                                            name="experience"><?php echo $experience; ?></textarea>
                                        <?php } else { ?>
                                        <textarea id="experience" class="form-control mytextarea"
                                            name="experience"></textarea>
                                        <?php } ?>
                                        <!--  <table class="table table-bordered"><tbody><tr><td><br></td><td><br></td></tr></tbody></table>  -->
                                        <?php echo form_error('experience', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $presentations = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->presentations : set_value('presentations');
                                    ?>
                                    <label class="form-label" for="formfield1"> Presentations </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="presentations"
                                            class="form-control mytextarea"
                                            name="presentations"><?php echo $presentations ?></textarea>
                                        <?php echo form_error('presentations', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $others = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->others : set_value('others');
                                    ?>
                                    <label class="form-label" for="formfield1"> Others </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="others"
                                            class="form-control mytextarea"
                                            name="others"><?php echo $others ?></textarea>
                                        <?php echo form_error('others', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div style="display:none" class="form-group">
                                    <?php
                                    $error = (form_error('posted_date') === '') ? '' : 'error';
                                    $posted_date = (set_value('posted_date') == false && isset($slider_row)) ? $slider_row->posted_date : set_value('posted_date');
                                    ?>
                                    <label class="form-label" for="formfield1"> Update </label>
                                    <span class="desc">e.g. "12/12/12"</span>
                                    <div class="controls">
                                        <input type="date" value="<?php echo $posted_date ?>" class="form-control"
                                            id="posted_date" name="posted_date">
                                        <?php echo form_error('posted_date', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('order_id') === '') ? '' : 'error';
                                    $order_id = (set_value('order_id') == false && isset($slider_row)) ? $slider_row->order_id : set_value('order_id');
                                    ?>
                                    <label class="form-label" for="formfield1"> Sort Order </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <input type="number" value="<?php echo $order_id ?>" class="form-control"
                                            id="order_id" name="order_id">
                                        <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && isset($slider_row)) ? $slider_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <div style="width: 30px" class="controls">
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php if (!empty($people_id)) { ?>
        <div class="col-lg-12">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Input Field Card People Events</h2>
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
                                action="<?php echo $action_event; ?>">
                                <?php
                                    $csrf = array(
                                        'name' => $this->security->get_csrf_token_name(),
                                        'hash' => $this->security->get_csrf_hash()
                                    );
                                    ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="people_id"
                                    value="<?php echo $people_id ? $people_id : ""; ?>">
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Event Content </label>
                                    <span class="desc">e.g. "Asia-Europe Cooperation on Inclusive Digital
                                        Societies"</span>
                                    <div class="controls">
                                        <select id="selectEventPeople" name="event_id[]" multiple>
                                            <?php if (!empty($events_data)) { ?>
                                            <?php foreach ($events_data as $value) { ?>
                                            <option value="<?php echo $value->event_id; ?>" selected>
                                                <?php echo $value->title; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php foreach ($people_events as $value) { ?>
                                            <?php if ($value->published > 0) { ?>
                                            <option value="<?php echo $value->article_id; ?>">
                                                <?php echo $value->title; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
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
        <?php } ?>
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
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>


<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/experts/experts.js" type="text/javascript"></script>