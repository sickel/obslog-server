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
?>
<form>
Project: <input type="text" name="project"/>
<input type="submit" value="View"/>
</form>


<?php
$table="${prefix}logging";
$sql="select drag,drp,ts,uuid,username,project,lat,lon,alt,acc,gpstime from $table";
# $sql .= " where project=? ";
$sql.=" where project = ? ";
$sql.=" order by id desc";
$project="";
if($_GET["project"]>""){
	$project=$_GET["project"];
}
try{
        print('<table><tr>');
	foreach( array('drag','drop','timestamp','uuid','username','project','lat','lon','alt','acc','gpstime') as $p){
            print ("<th>$p</th>");
        }
        print("</tr>");
	$sqlh = $dbh->prepare($sql);
		$sqlh->execute(array($project));
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

