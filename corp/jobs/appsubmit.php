<?php
	
	include 'config.php';

	$jid = $sid = $aid = -1;
	$abs = '';
	
	if(isset($_POST['jid']))
	{
		$jid = $_POST['jid'];
	}
	else {
		echo "failed";
	}
	
	if(isset($_POST['sid']))
	{
		$sid = $_POST['sid'];
	}
	else {
		echo "failed";
	}
	
	if(isset($_POST['abs']))
	{
		$abs = $_POST['abs'];
	}
	/*
	 * get aid from applicant , if not present generate aid for sid and retrieve it.
	 * get post data of abstract
	 * enter all these data in table application.
	 */
	
	$result = mysql_query("SELECT * FROM applicant WHERE sid=".$sid);
	$num_rows = mysql_num_rows($result);
	
	if($num_rows > 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$aid = $row['aid'];
		}
		
	}
	else {
		$query = "INSERT INTO applicant(sid) VALUES ($sid)";
	
		if (!mysql_query($query,$con))
		{
		  echo "failed";
		}
		else {
			$result = mysql_query("SELECT * FROM applicant WHERE sid=".$sid);
			while($row = mysql_fetch_array($result))
			{
				$aid = $row['aid'];
			}
		}
	}
	
	$query = "INSERT INTO application(aid,jid,abstract) VALUES ($aid,$jid,'$abs')";
	if (!mysql_query($query,$con))
	{
		echo "failed";
	}
	else {
		echo "success";
	}
	
	mysql_close($con);
?>