<?php

	$prid = $_GET['prid'];
	
	include 'config.php';
	if(mysql_query("DELETE FROM products WHERE prdid=".$prid))
	{
		echo "success";	
	}
	else
		{
			echo "failed";
		}
	
	if(mysql_query("DELETE FROM ads WHERE prid=".$prid))
	{
		echo "success";	
	}
	else
		{
			echo "failed";
		}
	
	mysql_close($con);

?>