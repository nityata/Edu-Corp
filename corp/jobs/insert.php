<?php

	include 'config.php';
	
	$query = "INSERT INTO job(title,abstract,deadline,tags,prerequisite,cid) VALUES ('$_POST[title]','$_POST[abs]','$_POST[dl]','$_POST[tg]','$_POST[preR]',$_POST[cid])";
	
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