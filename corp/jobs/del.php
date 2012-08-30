<?php

	$jid = $_GET['jid'];
	
	include 'config.php';
	if(mysql_query("DELETE FROM job WHERE jid=".$jid))
	{
		echo "success";	
	}
	else
		{
			echo "failed";
		}
	
	mysql_close($con);

?>