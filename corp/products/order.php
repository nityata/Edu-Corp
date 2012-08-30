<?php

	include 'config.php';
	
	$query = "INSERT INTO orders(oprid,osid) VALUES ($_POST[prid],$_POST[sid])";
	
	if (!mysql_query($query,$con))
	{
	  echo "failed";
	}
	else {
		echo "success";
	}
	//echo "COMMENT ADDED SUCCESSFULLY<hr />";

	mysql_close($con);

?>