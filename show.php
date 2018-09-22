<?php

require_once 'fetchdata.php';
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


$data=useroverview($table,$project);
htmlusertable($data);

$data=getobservations($table,$project);
htmltablehead($tablehead);
htmlobsdata($data);

?>
</body>
</html>

