<?php

	$jid = -1;
	$sid = -1;
	$aid = -1;
	$iid = -1;
	$pgrid = -1;
	$cid  = -1;
	
	$intern = false;
	$corp = false;
	
	$name = '';
	$nameC = '';
	// store session data
	
	if(isset($_GET['jid']))
	{
		$jid = $_GET['jid'];
		//echo "jid = ". $jid;
	}
	
	if(isset($_GET['sid']))
	{
		$sid = $_GET['sid'];
		//echo "sid = ". $sid;
	}
	
	if(isset($_GET['cid']))
	{
		$cid = $_GET['cid'];
		//echo "sid = ". $sid;
	}
	
	if(isset($_GET['see']))
	{
		if($_GET['see'] == "intern")
		{
			$intern = true;
		}
		else if($_GET['see'] == "corp")
		{
			$corp = true;
		}
	}
	
	include 'config.php';
	
	$json = array();
	$json['name'] = array();
	$json['nameTF'] = array();
	$json['date'] = array();
	$json['content'] = array();
	$json['work'] = array();
	$json['percent'] = array();
	$json['todo'] = array();
	
	// get aid to query intern table
	$query = 'Select * From applicant where sid='.$sid;	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			$aid = $row['aid'];
		}
	}
	
	// get student name
	$query = 'Select * From student where sid='.$sid;	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			$name = $row['name'];
			//$json['nameTF'][0] = $name;
		}
	}
	
	// get corp name
	$query = 'Select * From corp where cid='.$cid;	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		while($row = mysql_fetch_array($result))
		{
			$nameC = $row['name'];
			//$json['nameTF'][0] = $name;
		}
	}
	
	// return name of current commenter based on who has logged in
	if($intern)
	{
		$json['nameTF'][0] = $name;
	}
	else if($corp)
	{
		$json['nameTF'][0] = $nameC;
	}
	
	
	//echo "aid = ". $aid;
	// get iid by querying intern table
	$query = 'Select * From intern where jid='.$jid. ' AND aid='.$aid;
	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
//			$json['name'][$i] =  
			$iid = $row['iid'];
		}
	}
	
	// use iid to obtain accurate progress record and fill in details to be returned
	$query = 'Select * From progress where iid='.$iid;
	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
//			$json['name'][$i] =  
			$pgrid = $row['pgrid'];
			$json['pgrid'] = $pgrid;
			$json['work'][$i] = $row['work'];
			$json['todo'][$i] = $row['todo'];
			$json['percent'][$i] = $row['percentage'];
		}
	}
	
	//echo "iid = ". $iid;
	// return back comments made on progress
	$query = 'Select * From prcomments where pgrid='.$pgrid;
	
	$result = mysql_query($query);
	if (!$result) {
		echo "failed";
	}
	else {
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
//			$json['name'][$i] =  
			$json['content'][$i] = $row['content'];
			$json['date'][$i] = $row['created_on'];
			
			if($row['submitterType'] == "student")
			{
				$json['name'][$i] = $name;
			}
			else {
				$json['name'][$i] = $nameC;
			}
			
			$i++;
		}
	}
	
	mysql_close($con);
	
	$encoded = json_encode($json);
	echo $encoded;
	error_log(print_r($encoded, TRUE), 0);
?>