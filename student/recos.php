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
	
	$query = 'SELECT * FROM recommendations WHERE pid='. $pid;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json = array();
		$json['reco'] = array();
		$json['rdate'] = array();
		$json['rname'] = array();
		$i = 0 ;
		while ($row = mysql_fetch_array($result)) {
			$json['reco'][$i] = $row['recommendation'];
			$json['rdate'][$i] = $row['created_on'];
			$json['rname'][$i] = $row['rname'];
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