<!-- start: Alert Message -->
<style>

.help-inline {   color: rgba(240, 80, 80, 1.0);
    font-weight: 400;
    font-size: 13px; }

</style>
<?php if ($this->session->flashdata('error-message') != ''): ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Error!</h4>
        <p><?php echo $this->session->flashdata('error-message'); ?></p>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success-message') != ''): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Success!</h4>
        <p><?php echo $this->session->flashdata('success-message'); ?></p>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('info-message') != ''): ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Info!</h4>
        <p><?php echo $this->session->flashdata('info-message'); ?></p>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('warning-message') != ''): ?>
    <div class="alert alert-block ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Warning!</h4>
        <p><?php echo $this->session->flashdata('warning-message'); ?></p>
    </div>
<?php endif; ?>
<!-- end: Alert Message -->
