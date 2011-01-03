<?php
//header('Content-type: image/png');
$image = new Imagick('Image.png');
// If 0 is provided as a width or height parameter,
// aspect ratio is maintained
/*
$image->cropThumbnailImage(24, 24);
echo $image;
$image->writeImage("mini.png");

*/
echo "nama image".$image->getFilename();
?> 
