<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css"> -->
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">

<style>
/* ===---=== */
.active {
    background-color: var(--primaryBlue);
    color: #fff;
}

table {
    width: 100% !important;
}

.sidebar-item-link {
    display: inline-block;
    font-weight: 500;
    font-size: 15px;
    padding: 1rem;
    width: 100%;
}

.sidebar-item-link:hover {
    text-decoration: none;
    background-color: #edf1f3;
}

.sidebar-item-link.active {
    background-color: var(--primaryBlue);
    color: #fff;
}

.sidebar-item.active:hover {
    background-color: var(--primaryBlue);
}

.btn.sidebar-collapse-button:focus {
    box-shadow: none;
}

.btn.sidebar-collapse-button:hover {
    background-color: #edf1f3;
}

.btn.sidebar-collapse-button[aria-expanded="false"] .bi-chevron-right {
    transform: rotate(0deg);
    transition: all 0.3s ease-in-out;
}

.btn.sidebar-collapse-button[aria-expanded="true"] .bi-chevron-right {
    transform: rotate(90deg);
    transition: all 0.3s ease-in-out;
}

.sidebar-item.active a {
    color: #fff;
}

/* ===---=== */
</style>
<input type="hidden" value="<?php echo $id ?>" id="key" placeholder="Keywords" aria-describedby="button-addon2"
    name="msearch" class="form-control border-left-0 ">
<input type="hidden" name="region" class="region" id="region" value="all">
<div class="program-sidebar bg-light-blue p-4 sticky-top mb-4">
    <h5 class="font-merriweather text-blue font-weight-bold pl-3 pr-3">Topics</h5>
    <ul class="sidebar-items list-unstyled">
        <?php
            $menudb = $this->header->get_dbMenu();
            ?>
        <?php foreach ($menudb as $menuD) { ?>
        <?php if ($menuD['published'] == 1) { ?>
        <?php
                    if ($menuD['uri'] == 'Organisation_for_Economic_Co-operation_and_Development_(OECD)') {
                        $uri = strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $menuD['uri'])));
                    } else {
                        $uri = $menuD['uri'];
                    }
                    ?>
        <li class="sidebar-item">
            <a href="<?php echo base_url() ?>database-and-programmes/topic/<?php echo $uri; ?>"
                class="sidebar-item-link">
                <div <?php if ($uri == strtolower(str_replace('_', '-', str_replace(array('(', ')'), '', $id)))) { ?>
                    class="selected" <?php } ?>><?php echo $menuD['category_name'] ?></div>
            </a>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<input type="hidden" id="base_url_front" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/db-left.js"></script>