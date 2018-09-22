<?php
// Creates the Document.
require_once 'fetchdata.php';

$rows=getobservations($table,$project);
$now=date("_Ymd_His");
$filename = "$project$now.kml";

$dom = new DomDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

$i=0;
foreach($rows as $row){

  $node = $dom->createElement('Placemark');
  $node->setAttribute('id', 'placemark' . $i++);

  $placeNode = $docNode->appendChild($node);

  // Creates an id attribute and assign it the value of id column.
  
  // Create name, and description elements and assigns them the values of the name and address columns from the results.
  $nameNode = $dom->createElement('name',htmlentities($i)); # Timestamp
  $placeNode->appendChild($nameNode);
  $descNode = $dom->createElement('description', $row[0].' '.$row[1])." by ".$row[3]. " at ".$row[2]); 
  # Drag  Drop by Username at timestamp
  $placeNode->appendChild($descNode);
  
  #$styleUrl = $dom->createElement('styleUrl', '#' . $row['type'] . 'Style');
  #$placeNode->appendChild($styleUrl);

  // Creates a Point element.
  $pointNode = $dom->createElement('Point');
  $placeNode->appendChild($pointNode);

  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
  $coorStr = $row[6] . ','  . $row[5];
  $coorNode = $dom->createElement('coordinates', $coorStr);
  $pointNode->appendChild($coorNode);

}

$kmlOutput = $dom->saveXML();
header('Content-disposition: attachment; filename="'.$filename.'"');

header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;



?>
