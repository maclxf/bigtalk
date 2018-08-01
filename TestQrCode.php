<?php
require_once 'Toolise/QrCodeGenerater.php';


$qr = new QrCodeGenerater(['codeStr' => 'http://origin.ccic.com/wap/index.aspx?key=000000204203626', 'codeSize' => 100]);
//$qr->setLevel('M');
//
$a = [
	'level' => 'H',
	'title' => '社会主义好',
	'logoPath' => './toolise/Images/Logo/maclxf.jpg'
];
$qr->setParames($a);

echo $qr->show();


/*require_once __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
//use Endroid\QrCode\Response\QrCodeResponse;

// Create a basic QR code
$qrCode = new QrCode('http://origin.ccic.com/wap/index.aspx?key=000000204203626');
$qrCode->setSize(200);

// Set advanced options
$qrCode->setWriterByName('png');
$qrCode->setMargin(2);
$qrCode->setEncoding('UTF-8');

// 纠错级别 点点多与少
$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);

// 点点的颜色
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
// 点点背后的颜色
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);

// 二维码底部文字
$qrCode->setLabel('中检溯源', 16, __DIR__.'/vendor/endroid/qr-code/assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
//$qrCode->setLogoPath(__DIR__.'/vendor/endroid/qr-code/assets/images/symfony.png');
//$qrCode->setLogoWidth(150);

// 外围边框
$qrCode->setRoundBlockSize(true);
// 有效值的展示
$qrCode->setValidateResult(false);

// Directly output the QR code
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();*/

// Save it to a file
//$qrCode->writeFile(__DIR__.'/qrcode.png');

// Create a response object
//$response = new QrCodeResponse($qrCode);

