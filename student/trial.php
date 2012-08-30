<?php

include 'config.php';

date_default_timezone_set('Asia/Kolkata');

echo 'Current Time: ' . date("Y-m-d H:i:s");

echo "<BR>";

// Now let us deduct 5 hours, 2 days and 1 year from now

echo 'New Time: ' . subtractTime();


date_default_timezone_set('Asia/Kolkata');
	
	$curTime = date("Y-m-d H:i:s");
	//echo $curTime;
	//echo "<br>";
	$fiveMinBefore = subtractTime();
	
$query = "Select * From applicant Where sid=1 AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";

$result = mysql_query($query);
	if(!$result)
	{
		echo "failed";
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			echo $row['aid'];
		}
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