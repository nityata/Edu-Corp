<?php
	
	$sid = $_GET['sid'];
	
	date_default_timezone_set('Asia/Kolkata');
	
	$curTime = date("Y-m-d H:i:s");
	//echo $curTime;
	//echo "<br>";
	$threeMonBefore = subtractTime();
	
	include 'config.php';
	
	$json = array();
	$failed = false;
	//$query = "Select * From job Where created_on Between '".$newdate." 00:00:00' And '".$old." 00:00:00'";
	$query = "Select * From ads Where created_on Between '". $threeMonBefore ."' And '" . $curTime . "'";
	//$query = "Select * From applicant Where sid=".$sid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$json['adcid'] = array();
		$json['adcontent'] = array();
		$json['adid'] = array();
		$json['adctags'] = array();
		$json['adcname'] = array();
		$json['adprid'] = array();
		$i = 0;
		
		while($row = mysql_fetch_array($result))
		{
			$cid = $row['cid'];
			
			$json['adcid'][$i] = $row['cid'];
			$json['adcontent'][$i] = $row['content'];
			$json['adid'][$i] = $row['adid'];
			$json['adprid'][$i] = $row['prid'];
			
			$query2 = "Select * From corp Where cid=".$cid;
			$result2 = mysql_query($query2);
			
			if(!$result2)
			{
				$failed = true;
			}
			else {
				while ($row2 = mysql_fetch_array($result2)) {
					$json['adctags'][$i] = $row2['tags'];
					$json['adcname'][$i] = $row2['name'];	
				}
			}
			$i++;
		}
	}
	
	
	$query = "Select * From student Where sid=".$sid;
	//$query = "Select * From applicant Where sid=".$sid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$json['SAdinterest'] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$json['SAdinterest'][$i] = $row['interests'];
			$i++;
		}
	}
	
	mysql_close($con);
	
	if($failed)
	{
		echo "failed";
	}
	else {
		$encoded = json_encode($json);
		echo $encoded;
		error_log(print_r($encoded, TRUE), 0);
	}
	
	function subtractTime()
	{
	
		$three = 3;
		
		$totalHours = date("H") ;
		
		$totalMinutes = date("i");
		
		$totalSeconds = date("s");
		
		$totalMonths = date("m") - $three;
		
		$totalDays = date("d") ;
		
		$totalYears = date("Y");
		
		$timeStamp = mktime($totalHours, $totalMinutes, $totalSeconds, $totalMonths, $totalDays, $totalYears);
		
		$myTime = date("Y-m-d H:i:s", $timeStamp);
		
		return $myTime;
	
	}

?>