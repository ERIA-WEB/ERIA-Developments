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
    <script>
    // Create cookie
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    // Read cookie
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function acceptCookieConsent() {
        setCookie('user_cookie_consent', 1, 30);
        const cookieNoticeElement = document.getElementById("cookieNotice");
        const classes = cookieNoticeElement.classList;
        classes.remove("d-flex");
        document.getElementById("cookieNotice").className += " d-none";
    }

    $(document).ready(function() {
        let cookie_consent = getCookie("user_cookie_consent");
        if (cookie_consent != "") {
            const cookieNoticeElement = document.getElementById("cookieNotice");
            const classes = cookieNoticeElement.classList;
            classes.remove("d-flex");
            document.getElementById("cookieNotice").className += " d-none";
        } else {
            document.getElementById("cookieNotice").className += " d-flex";
            document.getElementById("cookieNotice").classList.remove("d-none");
        }
    });
    </script>
</body>

</html>