<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/../libs/obslog.php';
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
        print('<table><tr>');
	foreach( array('drag','drop','timestamp','uuid','username','project','lat','lon','alt','acc','gpstime') as $p){
            print ("<th>$p</th>");
        }
        print("</tr>");
	$sqlh = $dbh->prepare("select drag,drp,ts,uuid,username,project,lat,lon,alt,acc,gpstime from $table 
order by id desc");
	$sqlh->execute();
        while($row=$sqlh->fetch(PDO::FETCH_NUM)){
	print("<tr>");
	foreach($row as $i){
	   $i=htmlentities($i);
           print("<td>$i</td>");
        }
	print("</tr>\n");
        }
        print("</table>"); 


	

}
catch(Exception $e){
	$errormsg=$e->getMessage();
	print ("<p>$errormsg</p>");
}

?>
</body>
</html>

