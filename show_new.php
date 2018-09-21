<?php

require_once 'fetchdata.php';

?>

<form>
Project: <input type="text" name="project"/>
<input type="submit" value="View"/>
</form>


<?php
$data=useroverview($table,$project);
htmlusertable($data);

print "<p><a href=\"?savexcel=true&project=$project\">Save excel</a></p>";
?>
</body>
</html>

