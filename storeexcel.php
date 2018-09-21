<?php

require_once 'fetchdata.php';
require_once '../PHP_XLSXWriter/xlsxwriter.class.php';

$rows=getobservations($table,$project);

$filename = "$project.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');



$writer = new XLSXWriter();
$writer->setAuthor('Morten Sickel');
$writer->setDescription("Data collected using obslogger");

$writer->writeSheetRow($tablehead);
foreach($rows as $row)
        $writer->writeSheetRow('Sheet1', $row);
$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);

