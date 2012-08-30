<?php

	include 'config.php';

	$success = false;

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
		
		$query = "INSERT INTO wall(content,aid,jid) VALUES ('Rejected',$aidArr[$i],$jidArr[$i])";
	
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