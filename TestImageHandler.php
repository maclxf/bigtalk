<?php
require_once __DIR__ . '/vendor/autoload.php';


// import the Intervention Image Manager Class
//use Intervention\Image\ImageManager as Image;

// create an image manager instance with favored driver
// $manager = new ImageManager(array('driver' => 'imagick'));

// // to finally create image instances
// $image = $manager->make('public/foo.jpg')->resize(300, 200);

use Intervention\Image\ImageManagerStatic as Image;

//Image::configure(array('driver' => 'imagick'));

//echo Image::make('public/a.png')->response('png');

Image::make('public/a.png')->fit(384, 70)->save('public/b.jpg');

list($width, $height, $type, $attr) = getimagesize('public/a.png');

dump($width);
dump($height);
dump($type);
dump($attr);
//https://phpartisan.cn/news/4.html
//http://image.intervention.io/api/trim
//http://c.biancheng.net/view/8022.html
