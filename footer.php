<style>

    .switch-cal {


        text-align: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        color: #01377f !important;
    }


</style>

<footer class="page-footer font-small mdb-color lighten-3 pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left pr-2 pl-2 mb-4 mt-2 footer-section">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <!-- <div class="col-md-3 col-lg-4 mr-auto my-md-4 my-0 mt-4 mb-1 footer-section-divider"></div> -->
            <div class="col-md-4 col-lg-4 mb-4 mt-2 footer-section pl-4 pr-4">

                <!-- Content -->
                <table>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>">
                                <div class="footer-logo">
                                    <img src="<?php echo base_url() ?>v6/assets/logo.png" alt="Logo" width="100px">
                                </div>
                            </a>
                        </td>
                        <td>
                            <div class="logo-text"><?=$this->header->get_Site()->slogan ?></div>
                        </td>
                    </tr>
                </table>

                <div class="pt-4 pb-2 topic">
                    About us
                </div>
                <p class="description">

                    <?=$this->header->get_Site()->footer_about ?>



                </p>

                <div class="py-3 topic">
                    <a href="<?=base_url()?>history"> History </a>
                </div>

                <div class="topic">
                    <a href="<?=base_url()?>Research/catogery/call-for-proposals">        Call for Proposals </a>
                </div>

            </div>

            <!-- Grid column -->

            <!--<hr class="clearfix w-100 d-md-none">-->

            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <!-- <div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1 footer-section-divider"></div> -->
            <div class="col-md-4 col-lg-4 mb-4 mt-2 pl-4 pr-4 footer-section-divider footer-section">

                <!-- Contact details -->
                <div class="topic pb-3">Address</div>

                <ul class="list-unstyled">
                    <li>
                        <p style="font-size: 13px; font-weight: bold;">
                            <i class="fa fa-map-marker"></i> ERIA Annex Office</p>
                    </li>
                    <li>
                        <p class="description">
                            <?=$this->header->get_Site()->footer_Content ?>
                        </p>
                    </li>


                    <li>
                        <div class="topic pt-3">
                            <a href="<?=base_url()?>Contact" >   Contact  </a> </div>
                    </li>

                    <li>
                        <div class="topic pt-3">
                            <a href="<?=base_url()?>Experts" > Our Experts  </a> </div>
                    </li>

                    <li>
                        <div class="topic pt-3">
                            <a href="<?=base_url()?>Career" >  Career Opportunities </a> </div>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <!-- <div class="col-md-3 col-lg-3 mx-auto my-4"></div> -->
            <div class="col-md-4 col-lg-4 mb-4 mt-2 footer-section-divider footer-section">
                <div>
                    <!-- Social buttons -->
                    <div class="topic">Get Updates</div>

                    <div class="py-3">
                        <input type="email" id="emailN" required class="form-control" placeholder="Enter your email address">
                        <div id="_error" style=" display: none; padding: 5px; color: red; ">Please Check your email.</div>
                    </div>

                    <div class="">
                        <button style="border-color: #0f3979;font-size: 1rem !important;letter-spacing: 0.5px !important;]padding: 0.375rem 0.75rem !important;" type="button" id="_email" class="btn btn-outline-light btn-subscribe">Subscribe</button>
                    </div>
                </div>
                <div>
                    <div class="topic py-2">Follow Us</div>
                    <!-- Social media icons -->
                    <div class="icon-container">
                        <a href="<?=$this->header->get_variableContent('FB')?>" target="_blank" >   <img src="<?php echo base_url() ?>v6/assets/SocialMedia/facebook.png" alt="Logo" width="55px"> </a>
                        <a href="<?=$this->header->get_variableContent('Twitter')?>" target="_blank" > <img src="<?php echo base_url() ?>v6/assets/SocialMedia/twitter.png" alt="Logo" width="55px"> </a>
                        <a href="<?=$this->header->get_variableContent('Linked')?>" target="_blank" >  <img src="<?php echo base_url() ?>v6/assets/SocialMedia/linkedin.png" alt="Logo" width="55px"></a>
                        <a href="<?=$this->header->get_variableContent('Youtube')?>" target="_blank" > <img src="<?php echo base_url() ?>v6/assets/SocialMedia/social_1.png" alt="Logo" width="55px"></a>
                        <a href="<?=$this->header->get_variableContent('Google')?>" target="_blank" > <img src="<?php echo base_url() ?>v6/assets/SocialMedia/googleplus.png" alt="Logo" width="55px"> </a>
                        <a href="<?=$this->header->get_variableContent('Flickr')?>" target="_blank" > <img src="<?php echo base_url() ?>v6/assets/SocialMedia/flickr.png" alt="Logo" width="55px"> </a>
                        <a href="<?=$this->header->get_variableContent('M')?>" target="_blank" >   <img src="<?php echo base_url() ?>v6/assets/SocialMedia/social_2.png" alt="Logo" width="55px"> </a>
                    </div>
                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright py-4 bg-light small copyright-bar">
        <div class="container mobile-footer d-flex justify-content-between">
            <div class="float-left"> <?=$this->header->get_Site()->footer_copyrights ?>  </div>
            <a href="<?php echo base_url() ?>privacy" class="float-right">Privacy Policy</a>
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

<!-- ©Hashan Pallewatte 2020  -->
<!-- Except as permitted by the copyright law applicable to you, you may not reproduce or communicate any of the content on this website, including files downloadable from this website, without the permission of the copyright owner. -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>



<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

    $(document).ready(function(){

        $(".showsearch").click(function () {

            $(".searchbar").toggleClass("searchbar-show");

            $("#searchbar-input").focus();


        });
    })

</script>

<script>

    $(document).ready(function(){




        $('#fechasiniestro').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            changeMonth: true,
            changeYear: true,

            yearRange: "-90:+00"
        })


        $('#fechasiniestroa').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            showOn: "button",
            buttonImage: "images/cal.gif",
            buttonImageOnly: true,
            showOn: "both",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,

            yearRange: "-90:+00"
        })







        $('.start').click(function(){


            $("#fechasiniestroa").datepicker("show");

            // $ ('.datepicker-switch').removeClass('datepicker-switch').addClass("switch-cal");


            // $(".datepicker-dropdown").css('left','154.312px');

        })

        $('#fechasiniestroa').click(function () {

            //  $('.datepicker-switch').removeClass('datepicker-switch').addClass("switch-cal");
        })


        $('#fechasiniestro').click(function () {

            // $('.datepicker-switch').removeClass('datepicker-switch').addClass("switch-cal");
        })




        $('.end').click(function(){


            $("#fechasiniestro").datepicker("show");
            //  $('.datepicker-switch').removeClass('datepicker-switch').addClass("switch-cal");
            // $(".datepicker-dropdown").css('left','154.312px');

        })






    })


</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>


<script>

    $(document).ready(function() {
        $('#ingredients').multiselect();
    });
    /*$(document).ready(function() {


        var stickyTop = $('.sticky').offset().top;



        $(window).scroll(function() {
            var windowTop = $(window).scrollTop();

            if (stickyTop < windowTop) {
                $('.sticky').css('position', 'fixed');
                $('.sticky').css('margin-top', '-190px');

               //  $('.tsearch').css('margin-top', '110px');



            } else {
                $('.sticky').css('position', 'relative');
              //  $('.tsearch').css('margin-top', '56px');

            }


           // var sticky = $('.top_search'), scroll = $(window).scrollTop();

        });









    });*/







</script>

<!-- HighlightCarousel  -->
<script>
    // $('#highlightCarousel').carousel({
    //   interval: 1000000000
    // })

    // $('.carousel .carousel-item').each(function () {
    //   var minPerSlide = 3;
    //   var next = $(this).next();
    //   if (!next.length) {
    //     next = $(this).siblings(':first');
    //   }
    //   next.children(':first-child').clone().appendTo($(this));

    //   for (var i = 0; i < minPerSlide; i++) {
    //     next = next.next();
    //     if (!next.length) {
    //       next = $(this).siblings(':first');
    //     }

    //     next.children(':first-child').clone().appendTo($(this));
    //   }
    // });
</script>

<!-- AuthorCarousel -->
<script>
    $('#carouselExampleControls').carousel({
        interval: 1000000000
    })


    $('.carousel').carousel({
        interval: false,
    });



    $('.author .carousel .carousel-item').each(function () {
        var minPerSlide = 3;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });
</script>

<!-- Search bar toggle -->
<script>

</script>


<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 5) {
                $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                    .removeClass("hide");
            } else {
                $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                    .removeClass("hide");
            }
        });
    });







</script>
<script>
    var coll = document.getElementsByClassName("publication-collapsible ");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("publicationactive");
            var publicationcontent = this.nextElementSibling;
            if (publicationcontent.style.maxHeight) {
                publicationcontent.style.maxHeight = null;
            } else {
                publicationcontent.style.maxHeight = publicationcontent.scrollHeight + "px";
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 5) {
                $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content').removeClass("hide");
            } else {
                $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content').removeClass("hide");


            }
        });
    });


    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";






        }
    }




</script>

<script>







    $kword=null;



    var src_str = $(".hgh").html();
    var term = "<?php echo $kword ?>";

    if(term) {
        term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
        var pattern = new RegExp("(" + term + ")", "gi");

        src_str = src_str.replace(pattern, "<mark>$1</mark>");
        src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");

        $(".hgh").html(src_str);
    }

</script>



<script>
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });
    });
</script>

<script>
    var coll = document.getElementsByClassName("career-op-collapse ");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("careeropcollapseactive");
            var careeropcontent = this.nextElementSibling;
            if (careeropcontent.style.maxHeight) {
                careeropcontent.style.maxHeight = null;
            } else {
                careeropcontent.style.maxHeight = careeropcontent.scrollHeight + "px";
            }
        });
    }
</script>













<script>
    $(window).scroll(function () {
        var  winTop = $(window).scrollTop();
        if (winTop >= 1 ) {
            var top_bar_s_height = $('.sticky_cha').height() - 30;
            $('.top__bar__s').css({
                height: top_bar_s_height,
                display: 'block',
            });
            $('.main-nav').addClass('sticky_cha').removeClass('top');
            $('.logo-description').addClass('logo-description-scrol').removeClass('logo-description-top');
            $('.header-img').addClass('logo-scrol').removeClass('logo-top');
            $('.small-sub-nav').hide();
            $('.main-nav-headings').css('padding-top', '60px');
            $('.logo-scrol').css('top', '37px');

        } else if (winTop <= 0) {
            var top_bar_s_height = $('.sticky_cha').height() - 30;
            $('.top__bar__s').css({
                height: top_bar_s_height,
                display: 'none',
            });
            $('.main-nav').addClass('top').removeClass('sticky_cha');
            $('.logo-description').addClass('logo-description-top').removeClass('logo-description-scrol');
            $('.header-img').addClass('logo-top').removeClass('logo-scrol');
            $('.small-sub-nav').show();
            $('.main-nav-headings').css('padding-top', '20px');

        }

    });
</script>


<script>

    $('#_email').click(function(){


        var emailN = $('#emailN').val();

        var url ='<?=base_url()?>Home/sentEmail';


        $.ajax({
            url : url,
            method: 'POST',
            dataType: 'text',
            cache:false,
            data : {email:emailN},
            success:function(response){


                if (response)
                {
                    $('#_error').hide();
                    $('#subscribeModal').modal('show');

                }
                else
                {
                    $('#_error').show();
                }


            }
        });



    })

</script>


<script>

    var slider = document.querySelector(".slide-wr");


    $('div.input').click(function(){


        var $scroller = $('.carousel-inner');

        var ccls = this.className;




        if(ccls.indexOf("active_") >  0)
        {
            $(this).removeClass('active_');
        }
        else
        {
            $(this).addClass('active_');
        }


        var cy = $(this).data('year');



        var tdot = document.getElementsByClassName("input_");
        var atdot = document.getElementsByClassName("active_");



        if(atdot.length==0)
        {

            $('.slide').fadeIn();
        }
        else {



            for (i = 0; i < tdot.length; i++) {


                var c = tdot[i].className;




                if (c.indexOf("active_") == 0) {
                    $('.slide').fadeIn();
                }
                else if (c.indexOf("active_") > 0) {

                    //alert ($('.' + tdot[i].getAttribute('data-year')));

                    $('.' + tdot[i].getAttribute('data-year')).fadeIn();

                    if(cy==tdot[i].getAttribute('data-year')) {
                        var scrollTo = $('.' + tdot[i].getAttribute('data-year'))
                            // change its bg

                            // retrieve its position relative to its parent
                            .position().left;
                        console.log(scrollTo);
                        // simply update the scroll of the scroller
                        // $('.scroller').scrollLeft(scrollTo);
                        // use an animation to scroll to the destination
                        $scroller
                            .animate({'scrollLeft': scrollTo}, 500);
                    }


                }
                else {
                    // alert ('.'+tdot[i].getAttribute('data-year'));

                    // alert (c.indexOf("active_"));

                    $('.' + tdot[i].getAttribute('data-year')).fadeOut();
                }


                //  (tdot[i].getAttribute('data-year'));


                var c = 0;
                var left = slider.style.transform.split("%")[0].split("(")[1];
                if (left) {
                    var num = Number(left) + Number(c);
                } else {
                    var num = Number(c);
                }

                slider.style.transform = `translateX(${num}%)`;


            }

        }



    })


</script>



<script>









    document.getElementById("back").onclick = () => {
        /*const c = 33.33;*/
        var window_width = $( window ).width();
        var c = 33.33;
        if(window_width < 768){
            c = 100;
        }
        if(window_width >= 768 && window_width < 992){
            c = 50;
        }
        if(window_width >= 992){
            c = 33.33;
        }

        let left = slider.style.transform.split("%")[0].split("(")[1];
        if (left) {
            var num = Number(left) + Number(c);
        } else {
            var num = Number(c);
        }
        slider.style.transform = `translateX(${num}%)`;

        if (left == -166.65) {
            slider.addEventListener("transitionend", myfunc);
            function myfunc() {
                this.style.transition = "none";
                this.style.transform = `translateX(-299.97%)`;
                slider.removeEventListener("transitionend", myfunc);
            }
        } else {
            slider.style.transition = "all 0.5s";
        }
    };

    document.getElementById("forward").onclick = () => {
        /*const c = -33.33;*/
        var window_width = $( window ).width();
        var c = -33.33;
        if(window_width < 768){
            c = -100;
        }
        if(window_width >= 768 && window_width < 992){
            c = -50;
        }
        if(window_width >= 992){
            c = -33.33;
        }

        let left = slider.style.transform.split("%")[0].split("(")[1];
        if (left) {
            var num = Number(left) + Number(c);
        } else {
            var num = Number(c);
        }

        slider.style.transform = `translateX(${num}%)`;

        if (left == -299.97) {
            console.log("reached the border");
            slider.addEventListener("transitionend", myfunc);
            function myfunc() {
                this.style.transition = "none";
                this.style.transform = `translateX(-166.65%)`;
                slider.removeEventListener("transitionend", myfunc);
            }
        } else {
            slider.style.transition = "all 0.5s";
        }
    };




</script>



<script>
    
    
     $(document).ready(function(){
        $('.subscribe_email').on('click', function(){
            
         
 
        
         var email = $('#subscribe_email_box').val();
         
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
if (testEmail.test(email))
{
    
     var url ='<?=base_url()?>Home/sentEmail';


        $.ajax({
            url : url,
            method: 'POST',
            dataType: 'text',
            cache:false,
            data : {email:email},
            success:function(response){


                if (response)
                {
                    $('.stext').html(' Thank you for subscribing to our letter');  $('#subscribeModal').modal('show'); $('#subscribe_email_box').val('');

                }
                else
                {
                    $('.stext').html(' Please Enter different email this already used');
                    $('#subscribeModal').modal('show'); $('#subscribe_email_box').val('');
                }
                
                
      
            
}})
        } 
    // Do whatever if it passes.
else
{
      
      $('.stext').html(' Please Enter valid email');
            $('#subscribeModal').modal('show');
             
         
}
    
    
    
         
        
    })})
    
    </script>