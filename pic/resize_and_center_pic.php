<?php

//$image1_path = "1.jpeg";
//$image1_path = "2.jpeg";
function resizeAndCenterPic($image1_path, $wh=300){
	$target_path = "target.jpeg";

	$image = new Imagick();
	$image->newImage($wh, $wh, new ImagickPixel('white'));

	$org_image = new Imagick();
	$org_image->readImage($image1_path);

	$org_image_width = $org_image->getImageWidth();
	$org_image_heigth = $org_image->getImageHeight();

	if($org_image_width > $wh || $org_image_heigth > $wh){
		$ratio = $wh / ($org_image_width > $org_image_heigth ? ($org_image_width) : ($org_image_heigth));
		//$ratio = ceil($ratio);
		$org_image->resizeImage($org_image_width * $ratio, $org_image_heigth * $ratio, imagick::FILTER_LANCZOS, 1);
		$org_image_width = $org_image->getImageWidth();
		$org_image_heigth = $org_image->getImageHeight();
	}


	$x = ($wh - $org_image_width) / 2;
	$y = ($wh - $org_image_heigth) / 2;


	$image->compositeimage($org_image, imagick::COMPOSITE_OVER, $x, $y);
	$image->setImageFormat('jpg');
	@file_put_contents($target_path, $image);
	return $target_path;
}

	$image1_path = "http://p5.yokacdn.com/pic/fashion/model/2015/U464P1T117D928250F2571DT20150126230412.jpg";
	$r = resizeAndCenterPic($image1_path, 300);
	var_dump($r);



?>
