<?php
require_once __DIR__ . '/vendor/autoload.php';

use Component\Folder;
use Component\File;

$rootFolder = new Folder('C:/');
$videosFolder = new Folder('videos/');
$imagesFolder = new Folder('images/');

$rootFolder->add($videosFolder);
$rootFolder->add($imagesFolder);

$videosFolder->add(new File('film.mp4'));
$imagesFolder->add(new File('photo.jpg'));

$rootFolder->getChild();