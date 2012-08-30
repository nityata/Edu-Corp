<?php

	$cid = $_GET['cid'];

//echo $cid;

	include 'config.php';
	$json = array();
	$failed = false;
	
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