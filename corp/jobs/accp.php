<?php

	include 'config.php';

	$success = false;
	
	$iid = -1;
	$cid = -1;

	$decoded = json_decode($_GET['json'],true);
	$jidArr = $decoded['jid'];
	$sidArr = $decoded['sid'];
	$aidArr = $decoded['aid'];
	
	
	for($i=0;$i<count($jidArr);$i++)
	{
		//echo $jidArr[$i];
		/*error_log(print_r("JID".$i.": ".$jidArr[$i], TRUE), 0);
		error_log(print_r("SID".$i.": ".$sidArr[$i], TRUE), 0);
		error_log(print_r("AID".$i.": ".$aidArr[$i], TRUE), 0);*/
		// add to table wall here
		
		$query = "INSERT INTO wall(content,aid,jid) VALUES ('Accepted',$aidArr[$i],$jidArr[$i])";
	
		if (!mysql_query($query,$con))
		{
		  $success = false;
		}
		else {
			$success = true;
		}
		
		$query = "INSERT INTO intern(aid,jid) VALUES ($aidArr[$i],$jidArr[$i])";
	
		if (!mysql_query($query,$con))
		{
		  $success = false;
		}
		else {
			$success = true;
		}
		
		$query = "Select * From intern Where aid = ". $aidArr[$i] . " And jid=" .$jidArr[$i];
		$result = mysql_query($query,$con);
		if (!$result)
		{
		  $success = false;
		}
		else {
			while ($row = mysql_fetch_array($result)) {
				$iid = $row['iid'];
			}
		}
		
		
		$query = "Select * From job Where jid = ". $jidArr[$i];
		$result = mysql_query($query,$con);
		if (!$result)
		{
		  $success = false;
		}
		else {
			while ($row = mysql_fetch_array($result)) {
				$cid = $row['cid'];
			}
		}
		
		
		$query = "INSERT INTO progress(iid,cid) VALUES ($iid,$cid)";
	
		if (!mysql_query($query,$con))
		{
		  $success = false;
		}
		else {
			$success = true;
		}
		
	}
	// experiment trying to use decoded
	//error_log(print_r($decoded, TRUE), 0);
	
	if($success)
	{
		echo "success";
	}
	else {
		echo "failed";
	}
	//echo "COMMENT ADDED SUCCESSFULLY<hr />";

	mysql_close($con);


?>