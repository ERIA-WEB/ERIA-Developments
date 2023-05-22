<style>
    @media (min-width: 1200px) {

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:not(:first-child),
        .input-group>.custom-file:not(:first-child) .custom-file-label,
        .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-radius: 0 !important;
            /*0px 9px 9px 0px !important*/
        }

        #button-addon2 {
            z-index: 0 !important;
            border-radius: 0 !important;
            /*9px 0px 0px 9px !important*/
        }

        .serch-ch-desktop {
            position: relative !important;
            top: -3.5px !important;
        }

        #associates {
            padding-bottom: 42px !important;
        }

    }

    @media only screen and (min-width: 768px) and (max-width: 868px) {
        .experts-page .view-profile .padding-left {
            padding-left: 9px !important;
            padding-right: 7px !important;
        }

        .experts-page .view-profile .upper-section {
            padding-top: 20px !important;
            padding-bottom: 10px !important;
            height: 260px !important;
        }

        .experts-page.person-description.padding-left.py-3 {
            font-size: 12px !important;
            font-family: 'Literata', serif !important;
            height: 120px !important;
        }

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:not(:first-child),
        .input-group>.custom-file:not(:first-child) .custom-file-label,
        .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-radius: 0px 9px 9px 0px !important;
        }

        #button-addon2 {
            z-index: 0 !important;
            border-radius: 9px 0px 0px 9px !important;
        }

        .card-ch-tab-exp {

            max-width: 50% !important;
            flex: 0 0 50% !important;
        }

        .serch-ch-desktop {
            position: relative !important;
            top: -3.5px !important;
        }

        #associates {

            padding-bottom: 42px !important;
        }


    }


    @media only screen and (min-device-width: 869px) and (max-device-width: 1190px) {


        .experts-page .view-profile .upper-section {
            padding-top: 20px !important;
            padding-bottom: 10px !important;
            height: 260px !important;
        }

        .experts-page.person-description.padding-left.py-3 {
            font-size: 12px !important;
            font-family: 'Literata', serif !important;
            height: 120px !important;
        }

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:not(:first-child),
        .input-group>.custom-file:not(:first-child) .custom-file-label,
        .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-radius: 0px 9px 9px 0px !important;
        }

        #button-addon2 {
            z-index: 0 !important;
            border-radius: 9px 0px 0px 9px !important;
        }

        .card-ch-tab-exp {

            max-width: 50% !important;
            flex: 0 0 50% !important;
        }

        .serch-ch-desktop {
            position: relative !important;
            top: -3.5px !important;
        }

        #associates {

            padding-bottom: 42px !important;
        }

    }


    @media only screen and (max-width: 668px) {

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:not(:first-child),
        .input-group>.custom-file:not(:first-child) .custom-file-label,
        .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-radius: 0 !important;
            /*0px 9px 9px 0px !important*/
        }

        #button-addon2 {
            z-index: 0 !important;
            border-radius: 0 !important;
            /*9px 0px 0px 9px !important*/
        }

        #dropdownMenuButton.btn.bg-white.border.w-100 {
            margin-top: 0px !important;
            margin-bottom: -10px !important;
            border-radius: 0 !important;
        }

        .btn.text-light.w-100.drop-btn {
            border-radius: 0 !important;
            /*8px !important*/
        }

        .p-1.rounded.my-md-0.my-2 {
            margin-left: -4px !important;
            margin-right: -5px !important;
        }

        #associates {
            padding-bottom: 42px !important;
        }

        .experts-page .dropdown .fa {
            position: absolute !important;
            right: 5% !important;
            top: 54% !important;
        }

        .fa.fa-envelope-o {
            position: relative !important;
            top: 50% !important;
            /*57px !important*/
        }
    }
</style>

<div class="container experts-page pt-5">
    <div class="experts-page-title">Experts</div>
    <div class="col-md-12 mt-3 px-0">
        <!-- Searches and drop downs -->
        <input type="hidden" value="<?= $catogeryID ?>" name="catogery" id="catogery">
        <input type="hidden" value="all" name="cn" id="cn">
        <input type="hidden" value="all" name="cns" id="cns">



        <div class="row">
            <div class="col-md-3">
                <div class="p-1 rounded my-md-0 my-2 serch-ch-desktop">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit" class="btn btn-link text-secondary border border-right-0">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="search" value="<?= $key ?>" name="key" id="key" placeholder="Keywords " aria-describedby="button-addon2" class=" search form-control border-left-0">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 mb-md-0 mb-4">
                <div class="dropdown">
                    <button class="btn bg-white border w-100 cv " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if ($catogery) {
                            echo $catogery;
                        } else {  ?> All <?php } ?> <i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item cds " data-cid="all" data-nme="all" href="#">All</a>
                        <?php foreach ($ex_cat as $ex) { ?>
                            <a class="dropdown-item cds" data-cid="<?= $ex->ec_id ?>" data-nme="<?= $ex->category ?>" href="#"><?= $ex->category ?></a>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xs-12 mb-md-0 mb-4">
                <div class="dropdown">
                    <button class="btn bg-white border w-100 cvs  " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All <i class="fa fa-angle-down"></i>
                    </button>
                    <div class=" suc dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item cdss " data-cid="all" data-nme="all" href="#">All</a>


                    </div>
                </div>
            </div>



            <div class="col-md-3 col-xs-4">
                <button id="esearch" class="btn text-light w-100 drop-btn" type="button">
                    Search
                </button>
            </div>
        </div>
        <div style="display: none" class="row mb-md-3 mb-0 mr-md-2 mr-0">
            <div class="col-md-3 col-xs-12 mb-md-0 mb-2">
                <div class="dropdown">
                    <button class="btn bg-white border w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Area of expertise<i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 mb-md-0 mb-2">
                <div class="dropdown">
                    <button class="btn bg-white border w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Department<i class="fa fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none" class=" result_ex sre row view-profile px-3 my-1"></div>
        <div class="row rexp  view-profile px-3 my-1">
            <?php foreach ($experts as $experts) { ?>
                <div class="col-md-4 col-12 pl-0 pr-md-4 pr-0 item-inner card-ch-tab-exp">
                    <div class="card card-body border-0 px-0 pb-0">
                        <a href="#">
                            <div style="background-color:#F3F3F3" class="person-main padding-left upper-section ">
                                <div class="image-container">
                                    <?php
                                    echo '<img class="img-fluid img-round" src="' . base_url() . '' . $experts["image_name"] . '">';
                                    ?>
                                </div>
                                <div class="name mt-2">
                                    <a href="<?php echo base_url() ?>Experts/detail/<?= $experts['uri'] ?>">
                                        <?php
                                        echo implode(' ', array_slice(explode(' ', $experts['title']), 0, 3));
                                        // substr($experts['title'],0,20)
                                        ?>
                                    </a>
                                </div>
                                <div style='height: 23px' class="status">
                                    <?php
                                    // echo $experts['major']."--";
                                    // $n = substr($experts['major'],0,40);
                                    // $str=substr($n, 0, strrpos($n, ' '));
                                    // if(strlen(($experts['major']))>=42)
                                    //  {
                                    //      echo $str."<a href='".base_url()."Experts/detail/".$experts['uri']."'>(...)</a>";
                                    //  }
                                    //  else
                                    //  {
                                    //     echo $experts['major'];
                                    // }
                                    //  echo strlen(($experts['major']));
                                    ?>
                                    <a href="mailto: info@eria.com">
                                        <div style="float: left; "><i class="fa fa-envelope-o"></i></div>
                                    </a>
                                </div>
                            </div>
                        </a>
                        <div style="height:111px; background-color: #d4d4d4;" class="person-description padding-left py-3">
                            <div class="description mt-2 pr-2">
                                <?php
                                $ns = substr(strip_tags($experts['major']), 0, 75);
                                $str = substr($ns, 0, strrpos($ns, ' '));
                                // echo $str."(...)";
                                $c = strip_tags($experts['major']);
                                if (strlen($c) > 90) {
                                    echo substr($c, 0, 90) . "<a href='" . base_url() . "Experts/detail/" . $experts['uri'] . "'>(...)</a>";
                                } else {
                                    echo $c;
                                }
                                ?>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="associates" class=" rexp row px-3 mb-4">
            <div class="experts-page-title pb-3 w-100">Research Associates</div>
            <div class="row view-profile px-3 my-1">
                <?php foreach ($associates as $experts) { ?>
                    <div class="col-md-4 col-12 pl-0 pr-md-4 pr-0 item-inner card-ch-tab-exp">
                        <div class="card card-body border-0 px-0">
                            <a href="#">
                                <div style="background-color: #F3F3F3;" class="person-main padding-left upper-section ">
                                    <div class="image-container">
                                        <img class=" img-fluid img-round " src="<?php echo base_url() ?><?= $experts['image_name'] ?>">
                                    </div>
                                    <div class="name mt-2"> <a href="<?php echo base_url() ?>Experts/detail/<?= $experts['uri'] ?>"> <?= substr($experts['title'], 0, 30) ?> </a> </div>
                                    <div class="status">
                                        <?php
                                        // $n = substr($experts['major'],0,40);
                                        // $str=substr($n, 0, strrpos($n, ' '));
                                        // if(strlen(($experts['major']))>=42)
                                        // {
                                        //     echo $str."(...)";
                                        // }
                                        // else
                                        // {
                                        //     echo $str;
                                        // }
                                        ?>
                                        <a href="mailto: info@eria.com">
                                            <div style="float: left; "><i class="fa fa-envelope-o"></i></div>
                                        </a>
                                    </div>
                                </div>
                            </a>
                            <div style="height:111px; background-color: #d4d4d4;" class="person-description padding-left py-3">
                                <a href="#">
                                    <div class="description mt-2 pr-2">
                                        <?php
                                        $ns = substr(strip_tags($experts['major']), 0, 75);
                                        echo strip_tags($experts['major']);
                                        //$str=substr($ns, 0, strrpos($ns, ' '));
                                        // echo $str."(...)";
                                        ?>
                                    </div>
                                </a>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

/* <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> */

<script>
    $('.cds').click(function() {
        var td = $(this).data("cid");
        var nme = $(this).data("nme") + "<i class='fa fa-angle-down'></i>";
        $('#catogery').val(td);
        $('.cv').html(nme);
        $('#cn').val(td);
    });


    $(document).on("click", ".cdss", function() {

        var td = $(this).data("cid");
        var nme = $(this).data("nme") + "<i class='fa fa-angle-down'></i>";



        $('.cvs').html(nme);
        $('#cns').val(td);
    });




    $('.search').keypress(function(e) {
        if (e.keyCode == 13) {
            $('#esearch').trigger('click');
        }
    });

    $('#esearch').click(function() {
        var key = $('#key').val();
        var role = $('#cn').val();
        var srole = $('#cns').val();
        //alert (role);

        var url = '<?= base_url() ?>Experts/load_expert';
        // alert(role);
        $('.sre').show();
        $(".result_ex").html('');

        $('.rexp').hide();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                key: key,
                role: role,
                srole: srole
            },
            success: function(response) {

                //alert (response);

                if (response != "") {
                    $(".result_ex").html(response);
                } else {

                }
            }
        });
    });
</script>




<script>
    $('#photo').change(function() {
        var input = this;
        var name = $(this).val();

        $('#image').val(name);

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#placeholder').attr('src', e.target.result).attr('width', 142);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });



    $('.cds').click(function() {



        var id = $(this).data('cid');

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Experts/getSub",
            data: {
                id: id

            }
        }).done(function(json) {


            $('.suc').html(json);


        })















    })
</script>