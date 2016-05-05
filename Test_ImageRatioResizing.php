<?php
/**
 * test resize image according to given image size ratio (width & height) ,
 * and given container width&height using Imagick library
 */


// get params from command line args
$image_src = 'image.png';
$image_width = $argv[1];
$image_height= $argv[2];
$container_width = $argv[3];
$container_height = $argv[4];

// check if the given container_width or container_height is negative or equals zero then nothing to do
if ($container_width < 0 || $container_height < 0 || $container_width == 0 || $container_height == 0 || 
		!is_numeric($container_width) || !is_numeric($container_height)){
	return;
}

echo 'image_width: '.$image_width."\n";
echo 'image_height: '.$image_height."\n";
echo 'image_width/image_height : '. $image_width/$image_height."\n";
echo 'container_width: '.$container_width."\n";
echo 'container_height: '.$container_height."\n";

// calculate width_difference and height_difference
$width_difference = $image_width - $container_width;
$height_difference = $image_height- $container_height;

echo 'width_difference: '.$width_difference."\n";
echo 'image_height: '.$image_height."\n";

$new_width = 0;
$new_height = 0;

// If the image two dimensions equals container two dimensions OR 
// if the width difference and height difference less than 0 then nothing to do
if(($image_width == $container_width && $image_height == $container_height) || 
	($width_difference < 0 && $height_difference < 0))
{
	echo 'the image two dimensions equals container two dimensions OR'
	.'the width difference and height difference less than 0 then nothing to do';
	return;
}
// if the width difference is negative and height difference is positive use container width
// as the new width and adjust the new height to image_height/image_width ratio
elseif($width_difference < 0 && $height_difference > 0)
{
	echo 'the width difference is negative and height difference is positive use container width'
	.'as the new width and adjust the new height to image_height/image_width ratio';
	$new_width = $container_width;
	$new_height = $new_width * $image_height/$image_width;
}
// if the width difference is positive and height difference is negative use container height
// as the new height and adjust the new width to image_width/image_height ratio
elseif($width_difference > 0 && $height_difference < 0)
{
	echo 'the width difference is positive and height difference is negative use container height'
	.'the new height and adjust the new width to image_width/image_height ratio';
	$new_height = $container_height;
	$new_width = $new_height * $image_width/$image_height;
}
// if the width difference is greater the the height difference use container width
// as the new width and adjust the new height to image_height/image_width ratio
elseif($width_difference > $height_difference)
{
	echo 'the width difference is greater the the height difference use container width'
	.'the new width and adjust the new height to image_height/image_width ratio';
	$new_width = $container_width;
	$new_height = $new_width * $image_height/$image_width;
}// else the height difference is greater the the width difference use container height
// as the new height and adjust the new width to image_width/image_height ratio
else
{
	echo 'the height difference is greater the the width difference use container height'
	.'the new height and adjust the new width to image_width/image_height ratio';
	$new_height = $container_height;
	$new_width = $new_height * $image_width/$image_height;
}

echo 'new_width: '.$new_width."\n";
echo 'new_height: '.$new_height."\n";
echo 'new_width/new_height : '. $new_width/$new_height."\n";

$outFile = $new_width . 'x' . $new_height . '_' . $image_src;
echo 'outFile: '.$outFile."\n";


?>
