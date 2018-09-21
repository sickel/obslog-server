<?php

require_once 'fetchdata.php';
require_once '../PHP_XLSXWriter/xlsxwriter.class.php';

$rows=getobservations($table,$project);

$xls = new Excel($project);
foreach ($rows as $num => $row) {
  $xls->home();
  $xls->label($row['id']);
  $xls->right();
  $xls->label($row['title']);
  $xls->down();
}
ob_start();
$data = ob_get_clean();
file_put_contents(__DIR__ .'/report.xls', $data);
