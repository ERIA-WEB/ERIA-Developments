<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/database-update.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
@media (max-width: 767.98px) {
    .sticky_cha {
        top: 0px !important;
    }

    .pt-2.mobile-search {
        display: block !important;
    }

    .navbar-light .navbar-toggler {
        border-color: rgba(0, 0, 0, 0) !important;
    }

    .mobile-nav-bar {
        display: flex !important;
    }

    .send-btn {
        margin-top: 1rem !important;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    #captImg {
        margin-bottom: 0 !important;
    }

    .contact-us #captImg img {
        height: 50px !important;
    }
}

.help-inline {
    padding: 10px;
    border: solid red 1px;
    margin-bottom: 10px;
    width: 100%;
    color: red;
}

/* === */
.mapouter {
    position: relative;
    text-align: right;
    width: 100%;
    height: 400px;
}

.gmap_canvas {
    overflow: hidden;
    background: none !important;
    width: 100%;
    height: 400px;
}

.gmap_iframe {
    width: 100% !important;
    height: 400px !important;
}

.g-recaptcha {
    width: 100%;
}

/* === */
</style>
<section class="section-top bg-blue">
    <div class="container py-3 py-lg-5">
        <h1 class="event-title text-white font-merriweather">Contact Us</h1>
    </div>
</section>
<?php $this->load->view('front-end/content/breadcrumb/breadcrumb'); ?>
<div class="contact-us-page experts-detail-page">
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('front-end/common/left'); ?>
            </div>
            <div class="col-md-8 pt-4 pt-md-0">
                <h3 class="experts-page-title pb-3 mb-3">Contact Us</h3>
                <div class="row row-cols-1 mb-4">
                    <div class="col-md-8 mb-4 mb-md-0">
                        <form method="post" id="formContact" action="<?= $action ?>" class="p-3 p-md-4 bg-second-gray">
                            <?php echo form_error('c_password', '<div class="help-inline">', '</div>'); ?>
                            <?php if ($this->session->flashdata('success-message') != '') { ?>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <ul class="list-group"><?php echo $this->session->flashdata('success-message'); ?></ul>
                            </div>
                            <?php } ?>
                            <h5 class="mb-3">Write us a message</h5>
                            <div class="mb-3">
                                <input type="text" name="fullName" id="fullName" class="form-control"
                                    placeholder="Full name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="Email" id="Email" class="form-control"
                                    placeholder="Email address" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="Phone" id="Phone" class="form-control"
                                    placeholder="Phone number" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" id="message" rows="6" placeholder="Message"
                                    class="form-control" required></textarea>
                            </div>
                            <div class="contact_captform mb-3">
                                <div class="g-recaptcha" data-sitekey="6Ld11BYiAAAAAPS8zKpJA8LYDEtrqy9rg8WUTfWp"></div>
                            </div>
                            <button class="btn third-button send-btn w-100" type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-3">ERIA Annex Office:</h5>
                        <div class="d-flex">
                            <i class="bi bi-geo-alt mr-3"></i>
                            <div>
                                <p class="font-weight-semibold mb-0">Address:</p>
                                <p>Sentral Senayan II 6th Floor, <br>Jalan Asia Afrika No. 8 <br>Gelora Bung Karno,
                                    Senayan <br>Jakarta Pusat 10270, Indonesia.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="bi bi-telephone mr-3"></i>
                            <div>
                                <p class="font-weight-semibold mb-0">Telephone:</p>
                                <p>(62-21) 57974460</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="bi bi-envelope mr-3"></i>
                            <div>
                                <p class="font-weight-semibold mb-0">Email:</p>
                                <a href="mailto:contactus@eria.org">contactus@eria.org</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no"
                                    marginheight="0" marginwidth="0"
                                    src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Economic Research Institute for ASEAN and East Asia (ERIA), RT.1/RW.3, Gelora, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                                    href="https://pdflist.com/" alt="pdflist.com">Pdflist.com</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>