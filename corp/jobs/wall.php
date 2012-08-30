<?php

	$cid = $_GET['cid'];
	
	date_default_timezone_set('Asia/Kolkata');
	
	$curTime = date("Y-m-d H:i:s");
	
	$fiveMinBefore = subtractTime();
	
	include 'config.php';
	$json = array();
	$failed = false;	
	/*
	 * get all jobs with cid = $cid . Store all those jids in an array
	 * query application table and find out which records have been submitted 5 min ago for each jid
	 * for each jid , note down the aids as well.
	 * send as result -> aid,sid,jid
	 */
	$i = 0;
	$query = "Select * From job Where cid=".$cid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$i = 0;
		$json['jid'] = array();
		$json['title'] = array();
		while($row = mysql_fetch_array($result))
		{
			$json['jid'][$i] = $row['jid'];
			$json['title'][$i] = $row['title'];
			$i++;
		}
	}
	
	
	
	$i = 0;
	$json['aid'] = array();
	$json['sid'] = array();
	foreach ($json['jid'] as $jid)
	{
		  $query = "Select * From application Where jid=".$jid;
		  //$query = "Select * From application Where jid=".$jid." AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";;
		  $result = mysql_query($query);
		  if(!$result)
		  {
				//echo "failed";
				$failed = true;
		  }
		  else 
		  {
				while($row = mysql_fetch_array($result))
				{
					$json['aid'][$i] = $row['aid'];
					$query2 = "Select * From applicant Where aid=".$json['aid'][$i];
		  			$result2 = mysql_query($query2);
					if(!$result2)
					{
							//echo "failed";
							$failed = true;
					}
					else
					{
						while($row2 = mysql_fetch_array($result2))
						{
							$json['sid'][$i] = $row2['sid']; 
						}
					}
					$i++;
				}
		  }
		  $json['aid'][$i] = '$';
		  $json['sid'][$i] = '$';
		  $i++;
	}
	
	/*echo "JID<br />";
	foreach ($json['jid'] as $jid)
	{
		echo $jid."<br />";
	}
	echo "SID<br />";
	foreach ($json['sid'] as $sid)
	{
		echo $sid."<br />";
	}
	echo "AID<br />";
	foreach ($json['aid'] as $aid)
	{
		echo $aid."<br />";
	}*/
	
	
	
	mysql_close($con);
	
	if($failed)
	{
		echo "failed";
	}
	else {
		$encoded = json_encode($json);
		echo $encoded;
	}
	
	function subtractTime()
	{
	
		$five = 5;
		
		$totalHours = date("H") ;
		
		$totalMinutes = date("i") - $five;
		
		$totalSeconds = date("s");
		
		$totalMonths = date("m");
		
		$totalDays = date("d") ;
		
		$totalYears = date("Y");
		
		$timeStamp = mktime($totalHours, $totalMinutes, $totalSeconds, $totalMonths, $totalDays, $totalYears);
		
		$myTime = date("Y-m-d H:i:s", $timeStamp);
		
		return $myTime;
	
	}
	
?>