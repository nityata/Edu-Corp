<?php

	$pid = -1;
	if(isset($_GET['pid']))
	{
		$pid = $_GET['pid'];
	}
	else {
		echo "failed";
	}
	
	include 'config.php';
	
	$failed = false;
	
	$query = 'SELECT * FROM comments WHERE cid='. $pid;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json = array();
		$json['comment'] = array();
		$json['cdate'] = array();
		$json['cname'] = array();
		$i = 0 ;
		while ($row = mysql_fetch_array($result)) {
			$json['comment'][$i] = $row['comment'];
			$json['cdate'][$i] = $row['date'];
			$json['cname'][$i] = $row['name'];
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
	}

?>