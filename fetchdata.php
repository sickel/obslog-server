<?php

require_once '/home/sickel/libs/obslog.php';
 
try{
        $connectstring='mysql:host='.$server.';dbname='.$database;
        $dbh = new PDO($connectstring, $username, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
        $database=$e->getMessage(); 
        exit( "<p>Cannot connect $database</p>");
        
        
}


$table="${prefix}logging";
$project="";
if($_GET["project"]>""){
	$project=$_GET["project"];
}

$tablehead=array('drag','drop','timestamp','username','project','lat','lon','alt','acc','gpstime','gps age','uuid');
	

function useroverview($table,$project){
  global $dbh;
  $sql_ov="select count(id), username from $table where project=? group by username";
  $sqlh=$dbh->prepare($sql_ov);
  $sqlh->execute(array($project));
  return($sqlh->fetchAll(PDO::FETCH_NUM));
  }

  
function htmlusertable($data){
  print("<table>");  
  foreach($data as $row){
		print("<tr><td>${row[1]}</td><td>${row[0]}</td></tr>\n");
	}
	print("</table>\n");
    }

function dropset($table,$project){
  global $dbh;
  $sql="select distinct drop from $table where project=?";
  $sqlh=$dbh->prepare($sql);
  $sqlh->execute(array($project));
  return($sqlh->fetchAll(PDO::FETCH_NUM));
}

function dragset($table,$project){
  global $dbh;
  $sql="select distinct drag from $table where project=?";
  $sqlh=$dbh->prepare($sql);
  $sqlh->execute(array($project));
  return($sqlh->fetchAll(PDO::FETCH_NUM));
}




function htmltablehead($tablehead){
	    print('<table><tr>');
    foreach( $tablehead as $p){
            print ("<th>$p</th>");
        }
        print("</tr>");
	}
  

function getobservations($table,$project){
    global $dbh;
    $sql="select drag,drp,ts,username,project,lat,lon,alt,acc,gpstime,-age,uuid from $table";
    $sql.=" where project = ? ";
    $sql.=" order by id desc";
    $data=array();
    try{
        $sqlh = $dbh->prepare($sql);
        $sqlh->execute(array($project));
        $data=$sqlh->fetchAll(PDO::FETCH_NUM);
    }
    catch(Exception $e){
        $errormsg=$e->getMessage();
        print ("<p>$errormsg</p>");
    }
    return($data);
}	
	
function htmlobsdata($data){
  foreach($data as $row){
	print("<tr>");
	foreach($row as $i){
	   $i=htmlentities($i);
       print("<td>$i</td>");
    }
    print("</tr>\n");
  }
  print("</table>"); 
}


	

