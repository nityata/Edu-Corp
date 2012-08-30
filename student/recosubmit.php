<?php

	include 'config.php';
	
	$query = "INSERT INTO recommendations(pid,recommendation,reco_on,rname) VALUES ($_POST[pid],'$_POST[reco]','$_POST[con]','$_POST[cname]')";
	
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