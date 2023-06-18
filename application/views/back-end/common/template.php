<!DOCTYPE html>
<html>

<?php
$data_s = $this->session->userdata('logged_in');
$this->load->view('back-end/common/header');
?>

<body>
    <?php $this->load->view('back-end/common/topbar'); ?>
    <div class="page-container row-fluid">
        <?php
        $this->load->view('back-end/common/menu');
        $this->load->view($content);
        $this->load->view('back-end/common/right-panel');
        ?>
        <div class="chatapi-windows "></div>
    </div>
    <?php $this->load->view('back-end/common/footer'); ?>

    <script src="<?php echo base_url() ?>resources/plugins/jquery-ui/smoothness/jquery-ui.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/caleran.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/newcalendar.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url() ?>vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
    $(document).ready(function() {
        $('#article_keywords').ckeditor();
    });
    </script> -->

    <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js" type="text/javascript"></script>
    <input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
    <input type="text" class="filemanager_access_key"
        value="<?php echo md5($_SESSION['admin_user']['username'].$_SERVER['REMOTE_ADDR'].date('Ymd')); ?>">
    <script src="<?= base_url(); ?>v6/js/admin/general.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/xsc1u8yhlpzgzdkqt417bgt01vzf7w9t29qt5wsw0wwvtvu6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

</body>

</html>