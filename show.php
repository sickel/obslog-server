<?php

require_once 'fetchdata.php';
$udata=useroverview($table,$project);
$data=getobservations($table,$project);

$n=count($data);
?>
<form>
Project: <input type="text" name="project" value="<?php echo($project)?>"/>
<input type="submit" value="View"/>
</form>
<hr />
<?php

print "<p><a href=\"storeexcel.php?project=$project\">Save excel</a>";
print " <a href=\"storekml.php?project=$project\">Save kml</a></p>";
print "<p>$n datapoints</p>";


htmlusertable($udata);

htmltablehead($tablehead);
htmlobsdata($data);

?>
</body>
</html>

