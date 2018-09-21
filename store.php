<?php

require_once '/home/sickel/libs/obslog.php';
$prefix='obslog_';
$database='sickel';
$username='sickel';     
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
try{
	$sqlh = $dbh->prepare("insert into $table (drag,drp,ts,uuid,username,project,lat,lon,alt,acc,gpstime) 
values(?,?,?,?,?,?,?,?,?,?,?)");
        $params=array();
	foreach( array('drag','drop','ts','uuid','username','project','lat','lon','alt','acc','gpstime') as $p){
	    $params[]=$_GET[$p];
        }
	$sqlh->execute($params);
	print('OK');	

}
catch(Exception $e){
	$errormsg=$e->getMessage();
	print ("<p>$errormsg</p>");
}

?>
</body>
</html>

