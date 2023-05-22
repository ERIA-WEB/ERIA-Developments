<?php
	/* fixed width and height */
	if(!function_exists('date_default_timezone_set')) {
		function date_default_timezone_set($timezone) {
			@putenv("TZ=".$timezone);
		}
	}
	date_default_timezone_set("Asia/Jakarta");
	if ( isset($_GET['width']) )
		$thumb_width  = $_GET['width'];
	else
		$thumb_width  = 100;
	if ( isset($_GET['height']) )
		$thumb_height = $_GET['height'];
	else
		$thumb_height = 100;
	if ( isset($_GET['im']) ) { $im   = $_GET['im'];   } else { $im   = ''; }
	
	if(substr($im, 0, 1) == "/") $im = substr($im, 1, strlen($im)-1);
	
	if(!file_exists($im)) {
		header('Content-type: text/html', true, 404);
		exit();
	}
	
	header("Cache-Control: private, max-age=10800, pre-check=10800");
	header("Pragma: private");
	header("Expires: " . date(DATE_RFC822,strtotime(" 9 day")));
	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == filemtime($im))) {
		// send the last mod time of the file back
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($im)).' GMT', true, 304);
		exit;
	}
	header('Content-Type: image/jpeg' );
	header('Content-Disposition: inline; filename=' . basename($im));
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($im)) . ' GMT');
	
	//header("Content-type: image/jpeg");
	//header("Content-Disposition:inline; filename=".basename($im));
	if(!empty($_GET["no_cache"])) {
		header("Expires", 0, true);
		header("Cache-Control", "must-revalidate, post-check=0, pre-check=0", true);
		header("Pragma", "public", true);
	}
	
	$what = getimagesize($im);
	switch( $what['mime'] ){
		case 'image/png' : $orig_image = imagecreatefrompng($im);break;
		case 'image/jpeg': $orig_image = imagecreatefromjpeg($im);break;
		case 'image/gif' : $orig_image = imagecreatefromgif($im);
	}

	list($width, $height, $type, $attr) = getimagesize($im);

	$ratioW = $width / $thumb_width;
	$ratioH = $height / $thumb_height;

	$ratioU = ($ratioW > $ratioH) ? $ratioW:$ratioH;

	$newWidth = $width / $ratioU;
	$newHeight = $height / $ratioU;

	/*$sm_image = imagecreatetruecolor($newWidth, $newHeight) or die ("Cannot Initialize new gd image stream");
	imagesavealpha($sm_image, true);
	$black = imagecolorallocate($sm_image, 0, 0, 0);
	imagefilledrectangle($sm_image, 0, 0, $thumb_width, $thumb_height, $black);
	$trans_colour = imagecolorallocatealpha($sm_image, 0, 0, 0, 127);
	imagefill($sm_image, 0, 0, $trans_colour);*/
	
	$sm_image = imagecreatetruecolor($thumb_width, $thumb_height) or die ("Cannot Initialize new gd image stream");
	$black = imagecolorallocate($sm_image, 255, 255, 255);
	imagefilledrectangle($sm_image, 0, 0, $thumb_width, $thumb_height, $black);
	
	/*imagesavealpha($sm_image, true);
	$black = imagecolorallocate($sm_image, 255, 255, 255);
	imagefilledrectangle($sm_image, 0, 0, $thumb_width, $thumb_height, $black);
	$trans_colour = imagecolorallocatealpha($sm_image, 0, 0, 0, 127);
	imagefill($sm_image, 0, 0, $trans_colour);*/
	
	imagecopyresampled($sm_image, $orig_image, intval(($thumb_width-$newWidth)/2), intval(($thumb_height-$newHeight)/2), 0, 0, $newWidth, $newHeight, imagesx($orig_image), imagesy($orig_image));
	
	//imagecopyresampled($sm_image, $orig_image, intval(($thumb_width-$newWidth)/2), intval(($thumb_height-$newHeight)/2), 0, 0, $newWidth, $newHeight, imagesx($orig_image), imagesy($orig_image));
	
	//$sm_image = imagecreatetruecolor($newWidth, $newHeight) or die ("Cannot Initialize new gd image stream");
	//imagecopyresampled($sm_image, $orig_image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($orig_image), imagesy($orig_image));
	
	ob_start();
	imagejpeg($sm_image, NULL, 90);
	$ImageData = ob_get_contents();
	$ImageDataLength = ob_get_length();
	ob_end_clean();
	header("Content-Length: ".$ImageDataLength);
	echo $ImageData;	

	imagedestroy($sm_image);
	imagedestroy($orig_image);
?>
