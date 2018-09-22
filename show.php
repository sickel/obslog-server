<?php

require_once 'fetchdata.php';

?>

<form>
Project: <input type="text" name="project" value="<?php echo($project)?>"/>
<input type="submit" value="View"/>
</form>


<?php
$data=useroverview($table,$project);
htmlusertable($data);

$data=getobservations($table,$project);
htmltablehead($tablehead);
htmlobsdata($data);
print "<p><a href=\"storeexcel.php?project=$project\">Save excel</a></p>";
print "<p><a href=\"storekml.php?project=$project\">Save kml</a></p>";

?>
</body>
</html>

