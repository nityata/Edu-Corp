<?php

	$aaid = -1;
	$failed = false;
	
	if(isset($_GET['aaid']))
	{
		$aaid = $_GET['aaid'];
	}
	else {
		$failed = true;
	}
	
	include 'config.php';
	
	$query = 'SELECT * FROM appcomments WHERE aaid='. $aaid;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$json = array();
		$json['comment'] = array();
		$json['cdate'] = array();
		//$json['cname'] = array();
		$i = 0 ;
		while ($row = mysql_fetch_array($result)) {
			$json['comment'][$i] = $row['content'];
			$json['cdate'][$i] = $row['created_on'];
			//$json['cname'][$i] = $row['name'];
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