<?php
require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/vendor/dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;


$html = file_get_contents('xto_daifa.html');

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
