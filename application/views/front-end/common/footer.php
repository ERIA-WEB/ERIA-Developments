<style>
.switch-cal {
    text-align: center;
    margin-bottom: 10px;
    padding-bottom: 10px;
    color: #01377f !important;
}

.description p {
    margin-bottom: 0 !important;
}

#colfooter>table#tablefooter tr td {
    background-color: #fff !important;
}
</style>

<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-3 mb-md-0">
                <div class="footer-logo d-flex align-items-center">
                    <a href="<?php echo base_url(); ?>">
                        <img loading="lazy" data-src="<?php echo base_url() ?>v6/assets/logo.webp"
                            src="<?php echo base_url() ?>v6/assets/logo.webp" alt="Logo" width="100px">
                    </a>
                    <div class="logo-text ml-2"><?= $this->header->get_Site()->slogan ?></div>
                </div>
                <p><?= $this->header->get_Site()->footer_about ?></p>
            </div>
            <div class="col-md-6 col-lg-5 mb-3 mb-lg-0">
                <div class="row row-cols-2 ">
                    <div class="col-7">
                        <h6 class="card-title">Address</h6>
                        <div class="">
                            <p class="mb-1 font-weight-semibold">ERIA Annex Office:</p>
                            <?= $this->header->get_Site()->footer_Content ?>
                        </div>
                        <!-- <div>
                            <p class="mb-1 font-weight-semibold">Email:</p>
                            <a href="mailto:contactus@eria.org">contactus@eria.org</a>
                        </div> -->
                    </div>
                    <div class="col-5">
                        <h6 class="card-title">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li class="footer-link">
                                <a href="<?= base_url() ?>contact-us"> Contact </a>
                            </li>
                            <li class="footer-link">
                                <a href="<?= base_url() ?>experts"> Our Experts </a>
                            </li>
                            <li class="footer-link">
                                <a href="<?= base_url() ?>career"> Career Opportunities </a>
                            </li>
                            <li class="footer-link">
                                <a href="<?= base_url() ?>history"> History </a>
                            </li>
                            <li class="footer-link">
                                <a href="<?= base_url(); ?>research/topic/call-for-proposals"
                                    class="text-blue font-weight-bold"> Call for
                                    Proposals </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mb-5">
                    <h6 class="card-title">
                        Get Updates
                    </h6>
                    <form action="">
                        <input type="email" placeholder="Enter your email adress" class="form-control mb-3">
                        <button class="btn third-button w-100">Subscribe</button>
                    </form>
                </div>
                <div class="footer-social-icon d-flex justify-content-between align-items-center">
                    <?php 
                        $fb = $this->header->get_variableContent('FB');
                        
                        $twitter = $this->header->get_variableContent('Twitter');

                        $linkedIn = $this->header->get_variableContent('Linkedin');
                    ?>
                    <a href="<?php echo $fb; ?>" target="_blank"><i class="bi bi-facebook"></i>
                    </a>
                    <a href="<?php echo $twitter; ?>" target="_blank"><i class="bi bi-twitter"></i>
                    </a>
                    <a href="<?php echo $linkedIn; ?>" target="_blank">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="<?= $this->header->get_variableContent('Youtube') ?>" target="_blank"><i
                            class="bi bi-youtube"></i>
                    </a>
                    <a class="flickr-icon d-none" href="<?= $this->header->get_variableContent('Flickr') ?>"
                        target="_blank">
                        <img loading="lazy" data-src="<?php echo base_url() ?>v6/assets/SocialMedia/flickr-logo.svg"
                            src="<?php echo base_url() ?>v6/assets/SocialMedia/flickr-logo.svg" alt="fickr-logo-icon">
                    </a>
                    <a href="<?= $this->header->get_variableContent('M') ?>" class="d-none" target="_blank"><i
                            class="bi bi-medium"></i>
                    </a>
                    <a href="<?= $this->header->get_variableContent('Instagram') ?>" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <small class="font-merriweather">
                    <?= $this->header->get_Site()->footer_copyrights ?>
                </small>
            </div>
            <div class="col-6 text-right">
                <small class="font-merriweather">
                    <a href="<?php echo base_url() ?>privacy">Privacy Policy</a>
                </small>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade subscribe-modal p-4" id="subscribeModal" tabindex="-1" role="dialog"
    aria-labelledby="subscribeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center stext">

            </div>
            <div class="modal-footer text-center border-0">
                <button type="button" class="btn btn-primary px-5" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front-end/common/script-js'); ?>