<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Knp\Snappy\Pdf;

$snappy = new Pdf(__DIR__ . '/../vendor/wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf.exe');
$snappy->setOption('page-width', 200);
$snappy->setOption('page-height', 256);


// 生成PDF
//$snappy->generate('http://adi-v3-admin.dev/tax_refund_invoice/taxrefundinvoiceshtml?id=63', __DIR__ . '/knplabs.pdf');

// 预览pdf
header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="file.pdf"');
echo $snappy->getOutput('http://adi-v3-admin.dev/tax_refund_invoice/taxrefundinvoiceshtml?id=63');