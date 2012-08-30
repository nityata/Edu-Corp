<?php
	
	$sid = $_GET['sid'];
	
	date_default_timezone_set('Asia/Kolkata');
	
	$curTime = date("Y-m-d H:i:s");
	//echo $curTime;
	//echo "<br>";
	$fiveMinBefore = subtractTime();
	//echo $fiveMinBefore;
	/*
	 * check aid from applicant table to corresponding sid
	 * in wall check for that aid and obtain jid
	 * using the jid fetch title of job from job table
	 * send back JSON data with content, jid and title.
	 */
	
	include 'config.php';
	
	
	//$query = "Select * From job Where created_on Between '".$newdate." 00:00:00' And '".$old." 00:00:00'";
	$query = "Select * From applicant Where sid=".$sid;
	//$query = "Select * From applicant Where sid=".$sid;
	$result = mysql_query($query);
	if(!$result)
	{
		echo "failed";
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			$aid = $row['aid'];
		}
	}
	
	//$query = "Select * From wall Where aid=".$aid." AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";
	$query = "Select * From wall Where aid=".$aid;
	$result = mysql_query($query);
	if(!$result)
	{
		echo "failed";
	}
	else {
		$json = array();
		$json['title'] = array();
		$json['jid'] = array();
		$json['content'] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$json['content'][$i] = $row['content'];
			$json['jid'][$i] = $row['jid'];
			$query2 = "Select * From job Where jid=".$row['jid'];
			$result2 = mysql_query($query2);
			if(!$result2)
			{
				echo "failed";
			}
			else {
				while($row2 = mysql_fetch_array($result2))
				{
					$title = $row2['title'];
					$json['title'][$i] = $title;
				}
			}
			
			$i++;
		}
		
		$encoded = json_encode($json);
		echo $encoded;
	}
	
	
	mysql_close($con);
	
	
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