<?php 
// somewhere early in your project's loading, require the Composer autoloader
// see: http://getcomposer.org/doc/00-intro.md
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html = <<<HTML

	<!DOCTYPE html>
	
	<html>
	
		<head>
		
			<meta charset="utf-8">
			<title>Test Page</title>
			<style>
    * {font-family: arial;
      font-size: 14px;line-height: 14px;}
  </style>
		</head>
		
		<body>
			
			<p>Привет, <span style="color: green">Мир</span>!</p>
			
		</body>
		
	</html>
	
HTML;

#$html = file_get_contents("resume.html");
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('resume');


?>