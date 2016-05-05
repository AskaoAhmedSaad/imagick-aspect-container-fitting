# php-resize-image-according-to-given-image-size-ratio-and-given-container-width-height
resize image according to given image size ratio (width &amp; height) , and given container width&amp;height using Imagick library
<br>
### install ImageMagick library
[look at this link](http://php.net/manual/en/imagick.setup.php)
<br>
### we have some test cases in this script
- <b>TestCase 1 : <b> if the given container_width or container_height is negative or equals zero then nothing to do
```
	if ($container_width < 0 || $container_height < 0 || $container_width == 0 || $container_height == 0 || 
		!is_numeric($container_width) || !is_numeric($container_height)){
		return;
	}
```
- <b>TestCase 2 : <b> If the image two dimensions equals container two dimensions OR  if the width difference and height difference less than 0 then nothing to do
```
	if(($image_width == $container_width && $image_height == $container_height) || 
		($width_difference < 0 && $height_difference < 0))
	{
		return;
	}
```
- <b>TestCase 3 : <b> If the width difference is negative and height difference is positive use container width as the new width and adjust the new height to image_height/image_width ratio
```
	elseif($width_difference < 0 && $height_difference > 0)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}
```
- <b>TestCase 4 : <b> If the width difference is positive and height difference is negative use container height as the new height and adjust the new width to image_width/image_height ratio
```
	elseif($width_difference > 0 && $height_difference < 0)
	{
		$new_height = $container_height;
		$new_width = $new_height * $image_width/$image_height;
	}
```
- <b>TestCase 5 : <b> If the width difference is greater the the height difference use container width as the new width and adjust the new height to image_height/image_width ratio
```
	elseif($width_difference > $height_difference)
	{
		$new_width = $container_width;
		$new_height = $new_width * $image_height/$image_width;
	}
```
- <b>TestCase 6 : <b> Else the height difference is greater the the width difference use container height as the new height and adjust the new width to image_width/image_height ratio
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
- example 1 (TestCase 1):
```
php Test_ImageRatioResizing.php 480 640 -400 -400
```
...we must get result as the following:
```
the given container_width or container_height is not valid
```

- example 2 (TestCase 2):
```
php Test_ImageRatioResizing.php 380 340 400 400
```
...we must get result as the following:
```
image_width: 380
image_height: 340
image_width/image_height : 1.1176470588235
container_width: 400
container_height: 400
width_difference: -20
image_height: 340
the image two dimensions equals container two dimensions ORthe width difference and height difference less than 0 then nothing to do
```

- example 3 (TestCase 3):
```
php Test_ImageRatioResizing.php 380 440 400 400
```
...we must get result as the following:
```
image_width: 380
image_height: 440
image_width/image_height : 0.86363636363636
container_width: 400
container_height: 400
width_difference: -20
image_height: 440
the width difference is negative and height difference is positive use container widthas the new width and adjust the new height to image_height/image_width rationew_width: 400
new_height: 463.15789473684
new_width/new_height : 0.86363636363636
outFile: 400x463.15789473684_image.png

```

- example 4 (TestCase 4):
```
php Test_ImageRatioResizing.php 480 340 400 400
```
...we must get result as the following:
```
image_width: 480
image_height: 340
image_width/image_height : 1.4117647058824
container_width: 400
container_height: 400
width_difference: 80
image_height: 340
the width difference is positive and height difference is negative use container heightthe new height and adjust the new width to image_width/image_height rationew_width: 564.70588235294
new_height: 400
new_width/new_height : 1.4117647058824
outFile: 564.70588235294x400_image.png
```

- example 5 (TestCase 5):
```
php Test_ImageRatioResizing.php 480 440 400 400
```
...we must get result as the following:
```
image_width: 480
image_height: 440
image_width/image_height : 1.0909090909091
container_width: 400
container_height: 400
width_difference: 80
image_height: 440
the width difference is greater the the height difference use container widththe new width and adjust the new height to image_height/image_width rationew_width: 400
new_height: 366.66666666667
new_width/new_height : 1.0909090909091
outFile: 400x366.66666666667_image.png
```

- example 6 (TestCase 6):
```
php Test_ImageRatioResizing.php 440 480 400 400
```
...we must get result as the following:
```
image_width: 440
image_height: 480
image_width/image_height : 0.91666666666667
container_width: 400
container_height: 400
width_difference: 40
image_height: 480
the height difference is greater the the width difference use container heightthe new height and adjust the new width to image_width/image_height rationew_width: 366.66666666667
new_height: 400
new_width/new_height : 0.91666666666667
outFile: 366.66666666667x400_image.png
```
