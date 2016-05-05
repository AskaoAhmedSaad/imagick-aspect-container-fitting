# php-resize-image-according-to-given-image-size-ratio-and-given-container-width-height
resize image according to given image size ratio (width &amp; height) , and given container width&amp;height using Imagick library
<br>
### install ImageMagick library
[look at this link](http://php.net/manual/en/imagick.setup.php)
<br>
### we have some test cases in this script
- If the image two dimensions equals container two dimensions OR  if the width difference and height difference less than 0 then nothing to do
```
	if(($image_width == $container_width && $image_height == $container_height) || 
		($width_difference < 0 && $height_difference < 0))
	{
		return;
	}
```
- If the width difference is negative and height difference is positive use container width as the new width and adjust the new height to image_height/image_width ratio
```
	elseif($width_difference < 0 && $height_difference > 0)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}
```
- If the width difference is positive and height difference is negative use container height as the new height and adjust the new width to image_width/image_height ratio
```
	elseif($width_difference > 0 && $height_difference < 0)
	{
		$new_height = $container_height;
		$new_width = $new_height * $image_width/$image_height;
	}
```
- If the width difference is greater the the height difference use container width as the new width and adjust the new height to image_height/image_width ratio
```
	elseif($width_difference > $height_difference)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}
```
- Else the height difference is greater the the width difference use container height as the new height and adjust the new width to image_width/image_height ratio
```
else
	{
		$new_height = $container_height;
		$new_width = $new_height * $image_width/$image_height;
	}
```
<br>

#### we can use Test_ImageRatioResizing.php to test our logic in command line as this and pass ($image_width, $image_height, $container_width, $container_height):
```
$image_width = $argv[1];
$image_height= $argv[2];
$container_width = $argv[3];
$container_height = $argv[4];
```
- example 1:
```
php Test_ImageRatioResizing.php 480 640 400 400
```
⋅⋅* we must get result as the following:
```
image_width: 480
image_height: 640
image_width/image_height : 0.75
container_width: 400
container_height: 400
width_difference: 80
image_height: 640
the height difference is greater the the width difference use container heightthe new height and adjust the new width to image_width/image_height rationew_width: 300
new_height: 400
new_width/new_height : 0.75
outFile: 300x400_image.png
```

- example 2 (change container dimensions):
```
php Test_ImageRatioResizing.php 480 640 600 400
```
⋅⋅* we must get result as the following:
```
image_width: 480
image_height: 640
image_width/image_height : 0.75
container_width: 600
container_height: 400
width_difference: -120
image_height: 640
the width difference is negative and height difference is positive use container widthas the new width and adjust the new height to image_height/image_width rationew_width: 600
new_height: 800
new_width/new_height : 0.75
outFile: 600x800_image.png
```


