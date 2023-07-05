
    $('.profile-overView1').click(function() {
        $('.publicationcontent').show();
    });

    var base_url_front = $('.base_url_front').val();
    $(document).ready(function() {
        var start = 11;
        var limit = 10;
        var reachedMax = false;
        // getPost_searchData();

        $('#form_id').keypress(function(e) {
            if (e.keyCode == 13) {
                $('#_msearch').trigger('click');
            }
        });

        $('#_msearch').click(function() {

            $('.publicationcontent').hide();
            start = 0;
            limit = 11;
            $('#searchResult').html('');

            getPost_searchData();
        });

        $('#ldmr').click(function() {
            getPost_searchData();
        });

        function getPost_searchData() {
            var publication = $('#publication').val();
            var topic = $('#topic').val();
            var region = $('#region').val();
            var url = base_url_front+'Research/loadmSearch';
            var key = $('#key').val();

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'text',
                cache: false,
                data: $("#form_id").serialize() + "&start=" + start + "&limit=" + limit,
                success: function(response) {
                    if (response == "") {
                        $(".loader-image").hide();
                        $("#ldmr").addClass("d-none");
                    } else {
                        $("#ldmr").html("Load more");
                        $('#normals').show();
                        $('#normal').hide();
                        start += limit;
                        $(".loader-image").show();
                        $("#searchResult").append(response);
                    }
                }
            });
        }
    });

    $('.type').click(function() {

        var to = $(this).data("type");
        $('#dropdownMenuButton').html(to);
        $('#topic').val(to);
    });
    
    
    const ourExpertSwiper = new Swiper('.our-expert-swiper', {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 20,
        pagination: {
            el: '#our-expert-pagination'
        },
        navigation: {
            nextEl: '#our-expert-button-next',
            prevEl: '#our-expert-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 5
            }
        }
    });
    