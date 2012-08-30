<?php

	include 'config.php';
	
	$query = "INSERT INTO appcomments(aaid,submitterID,content,submitterType) VALUES ($_POST[aaid],$_POST[cid],'$_POST[comment]','$_POST[con]')";
	
	if (!mysql_query($query,$con))
	{
	  echo "failed";
	}
	else {
		echo "success";
	}
	//echo "COMMENT ADDED SUCCESSFULLY<hr />";

	mysql_close($con);
	//echo '<a href="http://localhost/ss/sampleindex.php?pid='.$_POST['pid'].'">Back</a>';

?>