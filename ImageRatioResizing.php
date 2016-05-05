<?php
/**
 * resize image according to given image size ratio (width & height) ,
 * and given container width&height using Imagick library
 */
function imageRatioResizing($image_src, $container_width, $container_height) {

	// check if the given container_width or container_height is negative or equals zero then nothing to do
	if ($container_width < 0 || $container_height < 0 || $container_width == 0 || $container_height == 0 || 
		!is_numeric($container_width) || !is_numeric($container_height)){
		return;
	}

	$image = new Imagick($image_src);
	// Get the current image width and height
	$dimensions = $image->getImageGeometry();
	$image_width = $dimensions['width'];
	$image_height= $dimensions['height'];

	// calculate width_difference and height_difference
	$width_difference = $image_width - $container_width;
	$height_difference = $image_height- $container_height;

	$new_width = 0;
	$new_height = 0;

	// If the image two dimensions equals container two dimensions OR 
	// if the width difference and height difference less than 0 then nothing to do
	if(($image_width == $container_width && $image_height == $container_height) || 
		($width_difference < 0 && $height_difference < 0))
	{
		return;
	}
	// if the width difference is negative and height difference is positive use container width
	// as the new width and adjust the new height to image_height/image_width ratio
	elseif($width_difference < 0 && $height_difference > 0)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}
	// if the width difference is positive and height difference is negative use container height
	// as the new height and adjust the new width to image_width/image_height ratio
	elseif($width_difference > 0 && $height_difference < 0)
	{
		$new_height = $container_height;
		$new_width = $new_height * $image_width/$image_height;
	}
	// if the width difference is greater the the height difference use container width
	// as the new width and adjust the new height to image_height/image_width ratio
	elseif($width_difference > $height_difference)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}// else the height difference is greater the the width difference use container height
	// as the new height and adjust the new width to image_width/image_height ratio
	else
	{
		$new_height = $container_height;
		$new_width = $new_height * $image_width/$image_height;
	}

	$outFile = $new_width . 'x' . $new_height . '_' . $image_src;

	// resize the image according to the new dimensions if not exists using Imagick library
	if(!file_exists($outFile)){
		$image = new Imagick($image_src);
		$image->thumbnailImage($new_width, $new_height);
		$image->writeImage($outFile);
	}
}


// call imageRatioResizing function
imageRatioResizing('image.png', 500, 300);

?>
