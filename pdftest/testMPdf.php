<?php
require_once __DIR__ . '/../vendor/autoload.php';


//https://mpdf.github.io/ 文档

$html = file_get_contents('http://adi-v3-admin.dev/tax_refund_invoice/taxrefundinvoiceshtml?id=63');

//https://mpdf.github.io/reference/mpdf-functions/construct.html
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => [200, 256],
	'margin_left' => 0,
	'margin_right' => 0,
	'margin_top' => 0,
	'margin_bottom' => 0,
]);

//https://mpdf.github.io/reference/mpdf-variables/

//CJK - Chinese-Japanese-Korean languages
$mpdf->useAdobeCJK = true;
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;

//https://mpdf.github.io/reference/mpdf-functions/
$mpdf->WriteHTML($html);
$mpdf->Output();