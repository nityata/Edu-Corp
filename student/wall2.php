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
	
	$json = array();
	$failed = false;
	//$query = "Select * From job Where created_on Between '".$newdate." 00:00:00' And '".$old." 00:00:00'";
	$query = "Select * From applicant Where sid=".$sid;
	//$query = "Select * From applicant Where sid=".$sid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			$aid = $row['aid'];
		}
	}
	
	
	// here send student's interests also
	
	
	$query = "Select * From student Where sid=".$sid;
	//$query = "Select * From applicant Where sid=".$sid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$json['Sinterest'] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$json['Sinterest'][$i] = $row['interests'];
			$i++;
		}
	}
	
	
	
//	$query = "Select * From wall Where aid=".$aid." AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";
	$query = "Select * From wall Where aid=".$aid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		
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
				//echo "failed";
				$failed = true;
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
	}
	
	// next query for job to see if any new opening has been added. send any new matches to student. client-side checking for interests in wall.js
	
	$curTime = date("Y-m-d H:i:s");
	$fiveMinBefore = subtractTime();
	
//	$query = "Select * From job Where created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";
	$query = "Select * From job";
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$cid = -1;
		$json['Jtitle'] = array();
		$json['Jjid'] = array();
		$json['Jtags'] = array();
		$json['JCName'] = array();
		$json['JCid'] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$json['Jtitle'][$i] = $row['title'];
			$json['Jjid'][$i] = $row['jid'];
			$json['Jtags'][$i] = $row['tags'];
			
			$cid = $row['cid'];
			$json['JCid'][$i] = $cid;
			
			
			$query2 = "Select * From corp Where cid=" . $cid;
			$result2 = mysql_query($query2);
			
			if(!$result2)
			{
				//echo "failed";
				$failed = true;
			}
			else {
				while($row2 = mysql_fetch_array($result2))
				{
					$json['JCName'][$i] = $row2['name'];
				}
			}
			$i++;
		}
	}
	
	
	// check here to see if any new comments have been added for any of student's projects
	
	$curTime = date("Y-m-d H:i:s");
	$fiveMinBefore = subtractTime();
	
//	$query = "Select * From project2 Where submitter=". $sid . "AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";
	$query = "Select * From project2 Where submitter=". $sid;
	$result = mysql_query($query);
	if(!$result)
	{
		//echo "failed";
		$failed = true;
	}
	else {
		$pid = -1;
		$title = '';
		$json['Ctitle'] = array();
		$json['Comment'] = array();
		$json['Cid'] = array();
		$json['CDate'] = array();
		$json['CName'] = array();
		$json['CSid'] = array();
		$j = 0;
		while($row = mysql_fetch_array($result))
		{
			$title = $row['title'];
			
			$pid = $row['pid'];
			
			
			//$query2 = "Select * From comments Where cid=" . $pid . " AND date Between '". $fiveMinBefore ."' And '" . $curTime . "'";
			$query2 = "Select * From comments Where cid=" . $pid;
			$result2 = mysql_query($query2);
			
			if(!$result2)
			{
				//echo "failed";
				$failed = true;
			}
			else {
				while($row2 = mysql_fetch_array($result2))
				{
					$json['Ctitle'][$j] = $title;
					$json['Cid'][$j] = $row2['cid'];
					$json['Comment'][$j] = $row2['comment'];
					$json['CDate'][$j] = $row2['date'];
					$json['CName'][$j] = $row2['name'];
					$json['CSid'][$j] = $row2['submitterID'];
					$j++;
				}
			}
		}
	}
	
	$curTime = date("Y-m-d H:i:s");
	$fiveMinBefore = subtractTime();
	
//	$query = "Select * From project2 Where submitter<>". $sid . "AND created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";
	$query = "Select * From project2 Where submitter<>". $sid;
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json['NIpid'] = array();
		$json['NItitle'] = array();
		$json['NIfiles'] = array();
		$json['NIsubmitter'] = array();
		$json['NIauthor'] = array();
		$json['NIabstract'] = array();
		$json['NIname'] = array();
		$i = 0 ;
		while ($row = mysql_fetch_array($result)) {
			$json['NIpid'][$i] = $row['pid'];
			$json['NItitle'][$i] = $row['title'];
			$json['NIfiles'][$i] = $row['files'];
			$json['NIsubmitter'][$i] = $row['submitter'];
			$json['NIauthor'][$i] = $row['author'];
			$json['NIabstract'][$i] = $row['abstract'];
			
			$query2 = "Select * From student Where sid=" . $json['NIsubmitter'][$i];  
			$result2 = mysql_query($query2);
			if(!$result2)
			{
				$failed = true;
			}
			else {
				while ($row2 = mysql_fetch_array($result2))
				{
					$json['NIname'][$i] = $row2['name'];
				}
			}
			
			$i++;
		}
	}
	
	/*$curTime = date("Y-m-d H:i:s");
	$threeMonthsBefore = subtractTime2();
	
	$query = "Select * ads Where created_on Between '". $fiveMinBefore ."' And '" . $curTime . "'";*/
	
	$query = "Select * From application Where aid=".$aid;
	$result = mysql_query($query);
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json['aaid'] = array();
		$json['appcomment'] = array();
		$json['acommStype'] = array();
		$i = 0;
		while ($row = mysql_fetch_array($result)) {
			$aaid = $row['aaid'];
			
			$query2 = "Select * from appcomments Where aaid=". $aaid;
			$result2 = mysql_query($query2);
			
			if(!$result2)
			{
				$failed = true;
			}
			else {
				while ($row2 = mysql_fetch_array($result2)) {
					$json['aaid'][$i] = $row2['aaid'];
					$json['appcomment'][$i] = $row2['content'];
					$json['acommStype'][$i] = $row2['submitterType'];
					$i++;
				}
			}
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
	
	//mysql_close($con);
	
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
	
	/*function subtractTime2()
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
	
	}*/
	
?>