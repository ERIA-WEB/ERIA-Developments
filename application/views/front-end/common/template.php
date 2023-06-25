<!doctype html>
<html lang="en">
<?php $this->load->view('front-end/common/header'); ?>

<body>
    <?php $this->load->view('front-end/common/topbar'); ?>
    <div id="cookieNotice"
        class="container-fluid fixed-bottom bg-secondary p-4 justify-content-between align-items-center text-white d-none">
        <h6 class="mr-4">We use cookies on this website to give you a better user experience. By continuing to browse
            the
            site, you are
            agreeing to our use of cookies. <span><a class="text-white"
                    href="<?= base_url().'privacy-policy/'; ?>">Learn
                    more</a></span></h6>
        <button class="btn third-button h-100" onclick="acceptCookieConsent()">Accept</button>
    </div>
    <?php $this->load->view($content); ?>
    <?php $this->load->view('front-end/common/footer'); ?>
    <script type="text/javascript" src="<?= base_url(); ?>v6/js/cookies.min.js" async></script>
</body>

</html>