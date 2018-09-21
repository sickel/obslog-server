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
?>
<form>
Project: <input type="text" name="project"/>
<input type="submit" value="View"/>
</form>


<?php
$table="${prefix}logging";



$sql_ov="select count(id), username from $table where project=? group by username";
$sql="select drag,drp,ts,username,project,lat,lon,alt,acc,gpstime,uuid from $table";
# $sql .= " where project=? ";
$sql.=" where project = ? ";
$sql.=" order by id desc";
$project="";
if($_GET["project"]>""){
	$project=$_GET["project"];
}
try{
	$sqlh=$dbh->prepare($sql_ov);
	$sqlh->execute(array($project));
	print("<table>");
	while($row=$sqlh->fetch(PDO::FETCH_NUM)){
		print("<tr><td>${row[1]}</td><td>${row[0]}</td></tr>\n");
	}
	print("</table>\n");
        print('<table><tr>');
	foreach( array('drag','drop','timestamp','username','project','lat','lon','alt','acc','gpstime','uuid') 
as $p){
            print ("<th>$p</th>");
        }
        print("</tr>");
	$sqlh = $dbh->prepare($sql);
	$sqlh->execute(array($project));
	
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

print "<p><a href=\"?savexcel=true&project=$project\">Save excel</a></p>";

?>
</body>
</html>

