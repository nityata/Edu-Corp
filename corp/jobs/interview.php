<?php

	include 'config.php';

	$success = false;

	$decoded = json_decode($_GET['json'],true);
	$jidArr = $decoded['jid'];
	$sidArr = $decoded['sid'];
	$aidArr = $decoded['aid'];
	//$iDate = $decoded['intDate'];
	//$iPlace = $decoded['intPlace'];
	$itime = $_GET['time'];
	$idate = $_GET['date'];
	$iplace = $_GET['place'];
	error_log(print_r("time : ".$itime, TRUE), 0);
	error_log(print_r("date : ".$idate, TRUE), 0);
	error_log(print_r("place : ".$iplace, TRUE), 0);
	
	for($i=0;$i<count($jidArr);$i++)
	{
		//echo $jidArr[$i];
		/*error_log(print_r("JID".$i.": ".$jidArr[$i], TRUE), 0);
		error_log(print_r("SID".$i.": ".$sidArr[$i], TRUE), 0);
		error_log(print_r("AID".$i.": ".$aidArr[$i], TRUE), 0);*/
		// add to table wall here
		$content = "called for an interview on ".$idate. " ". $itime . " at ". $iplace;
		$query = "INSERT INTO wall(content,aid,jid) VALUES ('$content',$aidArr[$i],$jidArr[$i])";
	
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