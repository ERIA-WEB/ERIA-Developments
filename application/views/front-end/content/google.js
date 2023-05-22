<?php
    /**
     * The main template file
     *
     * This is the most generic template file in a WordPress theme
     * and one of the two required files for a theme (the other being style.css).
     * It is used to display a page when nothing more specific matches a query.
     * E.g., it puts together the home page when no home.php file exists.
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package WordPress
     * @subpackage Twenty_Twenty
     * @since Twenty Twenty 1.0
     */

    $homepage_title = get_field('homepage_title');
$homepage_concept_description = get_field('homepage_concept_description');
$homepage_concept_description_en = get_field('homepage_concept_description_en');
$homepage_palma_description = get_field('homepage_palma_description');
$homepage_palma_description_en = get_field('homepage_palma_description_en');
$homepage_title_2 = get_field('homepage_title_2');
$homepage_title_2_en = get_field('homepage_title_2_en');
$homepage_image = get_field('homepage_image');
$homepage_description_2 = get_field('homepage_description_2');
$homepage_description_2_en = get_field('homepage_description_2_en');
$homepage_features = get_field('homepage_features');

get_header();

    ?>

<style>
    @keyframes pop1Anim {
    0%{opacity: 0; transform: scale(0.8); }
    100%{opacity: 1; transform: scale(1); }
}
.markerLabel{
    padding: 6px 8px;
    border-radius: 5px;
    font-family: var(--font-family-sans-serif);
    background: #3b6736;
    animation: pop1Anim .3s;
}
</style>

<div class="home">

    <div class="hero">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
<?php foreach ($homepage_title as $key => $value): ?>
<div class="carousel-item  <?php echo $retVal = ($key==0) ? 'active' : '' ; ?>">
    <img src="<?php echo $value['image']['url'] ?>" class="d-block w-100" alt="...">
    <div class="carousel-caption py-0">
    <div class="container">
<?php if (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"]): ?>
<h5 class="belleza mb-0"><?php echo $value['title']; ?></h5>
<?php else: ?>
<h5 class="belleza mb-0"><?php echo $value['title_en']; ?></h5>
<?php endif; ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    </div>
    </div>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade show" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header border-bottom-0">
    <h2 class="modal-title font-weight-light belleza" id="staticBackdropLabel">REGISTER FOR <br>SPECIAL OFFERS</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <form>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Full Name" >
    </div>
    <div class="form-group">
    <input type="email" class="form-control" placeholder="Email" >
    </div>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Phone" >
    </div>
    <div class="text-right">
    <button type="submit" class="btn btn-primary green px-5 py-1 my-3 border-0">SUBMIT</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>

    <div class="container section my-5 pt-5">
<?php
    $the_query = new WP_Query( 'page_id=45' );

while ($the_query -> have_posts()) : $the_query -> the_post();

$concept_image = get_field('concept_image');

    ?>
<div class="concept">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
<?php foreach ($concept_image as $key => $image): ?>
<div class="carousel-item <?php echo $act = ($key==0)?"active":""; ?>">
<img src="<?php echo $image['image']['url'] ?>" class="d-block w-100" alt="...">
</div>
<?php endforeach; ?>
</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    </div>
    <div class="content py-5">
    <div class="p-4 text-white text-uppercase belleza">
    <p class="px-5"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? $homepage_concept_description : $homepage_concept_description_en ?></p>
<div class="text-right px-5">
    <a href="<?php echo esc_url(home_url('/concept')); ?>" class="btn btn-outline-light rounded-lg px-5 belleza my-3">CONCEPT</a>
</div>
</div>
</div>
</div>
<?php endwhile;?>
<?php
    $the_query = new WP_Query( 'page_id=67' );

while ($the_query -> have_posts()) : $the_query -> the_post();

$location_address = get_field('location_address');
$location_transportation = get_field('location_transportation');
$location_retain = get_field('location_retain');
$location_hospital = get_field('location_hospital');
$location_education = get_field('location_education');

    ?>
<div class="location">
    <div id="map_canvas"></div>
    <div class="row p-5 mx-3">
    <div class="col-md-4 mb-4">
    <strong class="pb-3 d-inline-block c-dark">PINANG RESIDENCES</strong> <br>
<small id="link5" class="c-dark-50 font-weight-light "><?php echo nl2br($location_address) ?></small>
</div>

<div class="col-md-4">
    <div class="pb-4">
<?php foreach ($location_transportation as $key => $v1): ?>
<small><strong class="d-inline-block c-dark pb-1"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "TRANSPORTASI" : "TRANSPORTATION" ?></strong><br></small>
<small id="link<?php echo "trs".$key ?>" class="c-dark-50 font-weight-light"><span><?php echo $v1['number'] ?></span><?php echo $v1['name'] ?></small> <br>
<?php endforeach; ?>
</div>
<div class="pb-4">
    <small><strong class="d-inline-block c-dark pb-1"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "MALL DAN RETAIL" : "RETAIN & SHOPPING MALLS" ?></strong><br></small>
<?php foreach ($location_retain as $key => $v2): ?>
<small id="link<?php echo "rsm".$key ?>" class="c-dark-50 font-weight-light"><span><?php echo $v2['number'] ?></span><?php echo $v2['name'] ?></small><br>
<?php endforeach; ?>
</div>
</div>

<div class="col-md-4">
    <div class="pb-4">
    <small><strong class="d-inline-block c-dark pb-1"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "RUMAH SAKIT" : "HOSPITAL" ?></strong><br></small>
<?php foreach ($location_hospital as $key => $v3): ?>
<small id="link<?php echo "hos".$key ?>" class="c-dark-50 font-weight-light"><span><?php echo $v3['number'] ?></span><?php echo $v3['name'] ?></small><br>
<?php endforeach; ?>
</div>
<div class="pb-4">
    <small><strong class="d-inline-block c-dark pb-1"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "PENDIDIKAN" : "EDUCATION" ?></strong><br></small>
<?php foreach ($location_education as $key => $v4): ?>
<small id="link<?php echo "edu".$key ?>" class="c-dark-50 font-weight-light"><span><?php echo $v4['number'] ?></span><?php echo $v4['name'] ?></small><br>
<?php endforeach; ?>
</div>
</div>
</div>
</div>
<?php endwhile;?>
<?php
    $the_query = new WP_Query( 'page_id=71' );

while ($the_query -> have_posts()) : $the_query -> the_post();

$palma_image_3 = get_field('palma_image_3');

    ?>
<div class="palma">
    <div id="carouselPalma" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

<?php foreach ($palma_image_3 as $key => $image_3): ?>
<div class="carousel-item <?php echo $act = ($key==0)?"active":""; ?>">
<img src="<?php echo $image_3['url'] ?>" class="d-block w-100" alt="...">
</div>
<?php endforeach; ?>
</div>
<a class="carousel-control-prev" href="#carouselPalma" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselPalma" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    </div>
    <div class="content py-5">
    <div class="p-4 text-white text-uppercase belleza">
    <p class="px-5"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? $homepage_palma_description : $homepage_palma_description_en ?></p>
<div class="text-right px-5">
    <a href="<?php echo esc_url(home_url('/concept')); ?>" class="btn btn-outline-light rounded-lg px-5 belleza my-3">PALMA</a>
</div>
</div>
</div>
</div>
<?php endwhile;?>

<div class="hightlight-article my-5">
    <div class="row my-4">
    <div class="col-md-4 col-12 mb-4"><img src="<?php echo $homepage_image['url'] ?>" alt="" width="100%"></div>
    <div class="col-md-8 col-12">
    <div class="px-3">
    <h2 class="belleza text-uppercase"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? $homepage_title_2 : $homepage_title_2_en ?></h2>
<p><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? $homepage_description_2 : $homepage_description_2_en ?></p>
</div>
</div>
</div>
</div>

</div>
<div class="news-homepage py-5">
    <div class="container">
    <div class="owl-carousel-news-homepage owl-carousel owl-theme">
<?php
    $args = array(
        'post_type' => 'news_update',
    'posts_per_page' => -1,
);
$work_query = new WP_Query($args);

while ($work_query->have_posts()) : $work_query->the_post();

$image = get_field('news_image');
$type = get_field('news_type');

    ?>
<div class="item">
    <img src="<?php echo $image['url'] ?>" alt="">
    <a href="<?php echo the_permalink() ?>" class="py-2 d-inline-block"><?php the_title(); ?></a>
</div>
<?php endwhile;
wp_reset_postdata();
    ?>
</div>
<div class="text-right">
    <a href="<?php echo esc_url(home_url('/news-update')); ?>" class="btn green"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "BERITA TERBARU" : "NEWS & UPDATES" ?></a>
</div>
</div>
</div>

<div class="container pb-5">
<?php
    $the_query = new WP_Query( 'page_id=55' );

while ($the_query -> have_posts()) : $the_query -> the_post();

$features_image = get_field('features_image');
$features_description = get_field('features_description');
    ?>

<div id="carouselFeatures" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
<?php foreach ($homepage_features as $key => $features): ?>
<div class="carousel-item <?php echo $act = ($key==0)?"active":""; ?>">
<div class="features p-5 d-flex align-items-end" style="background-image: url('<?php echo $features['image']['url'] ?>')">
    <div class="row mx-3 pt-5 w-100">
    <div class="col-md-8 d-flex align-items-center p-0">
<p><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? $features['description'] : $features['description_en'] ?></p>
</div>
<div class="col-md-4 d-flex align-items-center justify-content-end p-0">
    <a href="<?php echo esc_url(home_url('/features')); ?>" class="btn btn-light rounded-lg px-5 text-nowrap"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "PELAJARI LEBIH LANJUT" : "LEARN MORE" ?></a>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<a class="carousel-control-prev" href="#carouselFeatures" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselFeatures" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>

<?php endwhile;?>

<div class="inquiries p-5">
    <div class="row mx-3">
    <h2 class="col-md-12 p-0 belleza mt-3"><?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "DAFTARKAN MINAT ANDA" : "REGISTER YOUR INTEREST" ?></h2>
<div class="col-md-6 p-0">
    <div class="py-5">
<?php
    $the_query = new WP_Query( 'page_id=65' );

while ($the_query -> have_posts()) : $the_query -> the_post();

    ?>

<p class="mb-3"><?php echo apply_filters('the_content', $post->post_content) ?></p>

<?php endwhile;?>
</div>
</div>
<div class="col-md-6 p-0">
    <div role="form" class="wpcf7" id="wpcf7-f12-p8-o1" lang="en-US" dir="ltr">
    <div class="screen-reader-response"></div>
    <form action="/#wpcf7-f12-p8-o1" method="post" class="wpcf7-form form-inquiries py-5" novalidate="novalidate">
    <div style="display: none;">
    <input type="hidden" name="_wpcf7" value="12">
    <input type="hidden" name="_wpcf7_version" value="5.1.7">
    <input type="hidden" name="_wpcf7_locale" value="en_US">
    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f12-p8-o1">
    <input type="hidden" name="_wpcf7_container_post" value="8">
    </div>
    <div class="form-group mb-4">
    <input type="text" name="full-name" value="" size="40" class="wpcf7-text wpcf7-validates-as-required form-control rounded-0" aria-required="true" aria-invalid="false" placeholder="<?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "Nama Lengkap*" : "Full Name*" ?>">
</div>
<div class="form-group mb-4">
    <input type="email" name="email" value="" size="40" class="wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control rounded-0" aria-required="true" placeholder="Email*" aria-invalid="false">
    </div>
    <div class="form-group mb-4">
    <input type="tel" name="phone" value="" size="40" class="wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel form-control rounded-0" aria-required="true" placeholder="<?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "Telepon*" : "Phone*" ?>" aria-invalid="false">
    </div>
    <div class="form-group mb-4">
    <input type="text" name="subject" value="" size="40" class="wpcf7-text form-control rounded-0" aria-invalid="false" placeholder="<?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "Subyek*" : "Subject*" ?>">
</div>
<div class="form-group mb-4">
    <textarea name="message" rows="5" class="wpcf7-textarea form-control rounded-0" aria-invalid="false" placeholder="<?php echo $bl = (empty($_COOKIE["_ps_enqueue_language"]) || $_COOKIE["_ps_enqueue_language"] == "id" || !$_COOKIE["_ps_enqueue_language"])? "Pesan*" : "Message*" ?>"></textarea>
</div>
<div class="text-right mb-5">
    <input type="submit" value="Submit" class="wpcf7-submit btn green px-5 rounded-xl">
    <span class="ajax-loader"></span>
    </div>
    <div class="wpcf7-response-output wpcf7-display-none"></div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>


<?php get_footer();  ?>

<script>
var marker;
var map;
var labelText = 'MRT Lebak Bulus';

<?php
    $the_query = new WP_Query( 'page_id=67' );

while ($the_query -> have_posts()) : $the_query -> the_post();

$location_address = get_field('location_address');
$location_transportation = get_field('location_transportation');
$location_retain = get_field('location_retain');
$location_hospital = get_field('location_hospital');
$location_education = get_field('location_education');

    ?>
<?php foreach ($location_transportation as $key => $v1): ?>
$("#link<?php echo "trs".$key ?>").click(function(){

    var txt = $(this).html().replace(/<\/?span[^>]*>/g,"");
    var label = marker.getLabel();
    label.text = txt.substring(1);
    marker.setLabel(label);

    changeMarkerPos(<?php echo $v1['coordinate'] ?>);

});
<?php endforeach; ?>

<?php foreach ($location_retain as $key => $v2): ?>
$("#link<?php echo "rsm".$key ?>").click(function(){

    var txt = $(this).html().replace(/<\/?span[^>]*>/g,"");
    var label = marker.getLabel();
    label.text = txt.substring(1);
    marker.setLabel(label);

    changeMarkerPos(<?php echo $v2['coordinate'] ?>);

});
<?php endforeach; ?>

<?php foreach ($location_hospital as $key => $v3): ?>
$("#link<?php echo "hos".$key ?>").click(function(){

    var txt = $(this).html().replace(/<\/?span[^>]*>/g,"");
    var label = marker.getLabel();
    label.text = '<?=$key?>'+txt.substring(1);
    marker.setLabel(label);

    changeMarkerPos(<?php echo $v3['coordinate'] ?>);

});
<?php endforeach; ?>

<?php foreach ($location_education as $key => $v4): ?>
$("#link<?php echo "edu".$key ?>").click(function(){

    var txt = $(this).html().replace(/<\/?span[^>]*>/g,"");
    var label = marker.getLabel();
    label.text = txt.substring(1);
    marker.setLabel(label);

    changeMarkerPos(<?php echo $v4['coordinate'] ?>);

});
<?php endforeach; ?>

<?php endwhile;?>

// $("#link2").click(function(){
//     changeMarkerPos(-6.2731651, 106.7699676);
// });
// $("#link3").click(function(){
//     changeMarkerPos(-6.2719009, 106.766358);
// });
// $("#link4").click(function(){
//     changeMarkerPos(-6.2731651, 106.7699676);
// });
// $("#link5").click(function(){
//     changeMarkerPos(-6.2717767, 106.7681078);
// });

function initialize() {
    var styles = [
        {
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#808181"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#616161"
                }
            ]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#f5f5f5"
                }
            ]
        },
        {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#bdbdbd"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#eeeeee"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#757575"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e5e5e5"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#9e9e9e"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#d9dad9"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#757575"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#d9dad9"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#616161"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#d9dad9"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#9e9e9e"
                }
            ]
        },
        {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#e5e5e5"
                }
            ]
        },
        {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#eeeeee"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#74afb4"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#9e9e9e"
                }
            ]
        }
    ];
    var styledMap = new google.maps.StyledMapType(styles, {
        name: "Styled Map"
    });


    var mapProp = {
        center: new google.maps.LatLng(-6.2717767, 106.7681078),
        zoom: 17,
        panControl: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        overviewMapControl: false,
        rotateControl: true,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };



    map = new google.maps.Map(document.getElementById("map_canvas"), mapProp);

    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style')
    var myLatlng = new google.maps.LatLng(-6.2717767,106.7681078);

    var iconSetting = {
        url: '<?php echo get_template_directory_uri() ?>/img/Pinang-Residences-Location-Icon.png',
        size: new google.maps.Size(35, 45),
        scaledSize: new google.maps.Size(35, 45),
        labelOrigin: new google.maps.Point(20, -20)
    };

    var pinColor = "FE7569";
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor);








    marker = new google.maps.Marker({
        position: myLatlng,
        animation: google.maps.Animation.DROP,
        label: {
            color: '#ffffff',
            fontWeight: 'normal',
            fontSize: '12px',
            text: labelText,
            className: 'markerLabel',

        },
        icon: iconSetting,
    });

    marker.setMap(map);
    map.panTo(marker.position);
}

function changeMarkerPos(lat, lon){
    myLatLng = new google.maps.LatLng(lat, lon)
    marker.setPosition(myLatLng);
    map.panTo(myLatLng);
}

google.maps.event.addDomListener(window, 'load', initialize);


// popup start
// $('#staticBackdrop').modal('show')
$(document).ready(function(){
    var shown= localStorage.getItem('isshow');
    if(shown !="t"){
        $('#staticBackdrop').modal('show');
        localStorage.setItem('isshow', "t");
    }
});
</script>

