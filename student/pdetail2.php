<?php

	include 'config.php';
	
	$sid = $_GET['sid'];
	$pid = $_GET['pid'];
	$csid = $_GET['csid'];
	
	//echo $csid;
	
	$failed = false;
	
	$query = 'SELECT * FROM project2 WHERE pid=' . $pid ;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json = array();
		$json['pabstract'] = array();
		$json['guide'] = array();
		$json['files'] = array();
		$i = 0 ;
		while ($row = mysql_fetch_array($result)) {
			$json['pabstract'][$i] = $row['abstract'];
			$json['guide'][$i] = $row['guide'];
			$json['files'][$i] = $row['files'];
			$i++;
		}
	}
	
	
	$query = 'SELECT * FROM student WHERE sid='. $sid;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		while ($row = mysql_fetch_array($result)) {
			$json['Cname'] = $row['name'];
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
	}

?>