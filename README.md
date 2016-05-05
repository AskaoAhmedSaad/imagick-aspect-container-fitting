# php-resize-image-according-to-given-image-size-ratio-and-given-container-width-height
resize image according to given image size ratio (width &amp; height) , and given container width&amp;height using Imagick library
<br>
### install ImageMagick library
[look at this link](http://php.net/manual/en/imagick.setup.php)
<br>
### we have some test cases in this script
- If the image two dimensions equals container two dimensions OR  if the width difference and height difference less than 0 then nothing to do
- If the width difference is negative and height difference is positive use container width as the new width and adjust the new height to image_height/image_width ratio
- If the width difference is positive and height difference is negative use container height as the new height and adjust the new width to image_width/image_height ratio
- If the width difference is greater the the height difference use container width as the new width and adjust the new height to image_height/image_width ratio
- Else the height difference is greater the the width difference use container height as the new height and adjust the new width to image_width/image_height ratio
<br>

### we can use Test_ImageRatioResizing.php to test our logic in command line as this:
```
php Test_ImageRatioResizing.php 480 640 400 400
```
- we must get result as the following:
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

