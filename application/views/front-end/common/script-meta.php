<?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<link rel="icon" type="image/x-icon" href="<?= base_url().'upload/apple-touch-icon.png'; ?>" sizes="16x16">
<meta property="og:url" content="<?= $actual_link ?>" />
<meta property="og:type" content="<?= mb_strimwidth($mk, 0, 90, "..."); ?>" />
<meta property="og:title" content="<?= $title; ?>" />
<meta property="og: description" content="<?= $md ?>" />
<?php 

$image_share = $image_meta;

$size_image = getimagesize($image_share);

$width = $size_image[0];
$height = $size_image[1];
if ($width > $height) {
    // horizontal;
    $share_image_general = $image_share;
} else {
    // vertical;
    // $share_image_general = base_url().'get_share_image_twitter.php?im=/v6/assets/image-default-sharelink.jpg';
    $share_image_general = base_url().'get_share_image_twitter.php?im=upload/Article.jpg';
}
?>

<meta property="og:image" content="<?= $share_image_general; ?>" />

<meta property="og:image:type" content="image/jpeg" />

<meta name="keywords" content="<?= $mk; ?>">
<meta name="description" content="<?= mb_strimwidth($md, 0, 90, "..."); ?>">

<!-- card twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= $title; ?>" />
<meta name="twitter:site" content="@ERIAorg" />
<meta name="twitter:site:id" content="@ERIAorg" />
<meta name="twitter:creator" content="@ERIAorg" />
<meta name="twitter:description" content="<?= mb_strimwidth($md, 0, 90, "..."); ?>" />
<?php
    
    $image_twitter = str_replace('get_share_image', 'get_share_image_twitter', $image_meta);

    $size = getimagesize($image_meta);

    $width = $size[0];
    $height = $size[1];
    if ($width > $height) {
        // horizontal;
        $share_image_twitter = $image_twitter;
    } else {
        // vertical;
        // $share_image_twitter = base_url().'get_share_image_twitter.php?im=/v6/assets/image-default-sharelink.jpg';
        $share_image_twitter = base_url().'get_share_image_twitter.php?im=upload/Article.jpg';
    }

?>
<meta name="twitter:image" content="<?= $share_image_twitter; ?>" />
<!-- end card twitter -->
<link rel="canonical" href="<?= $actual_link ?>" />