<?php

	$jid = $_GET['jid'];
	
	include 'config.php';
	
	$failed = false;
	
	$json = array();
	$json['aid'] = array();
	$json['iid'] = array();
	$json['sid'] = array();
	$json['aname'] = array();
	$sids = array();
	
	$query = "Select * From intern Where jid=".$jid;
	
	$result = mysql_query($query);
	
	if(!$result)
	{
		$failed = true;
	}
	else {
		$i = 0;
		while ($row = mysql_fetch_array($result)) {
			$json['aid'][$i] = $row['aid'];
			$json['iid'][$i] = $row['iid'];
			$i++;
		}
	}
	
	//echo "json[aid] : " + $json['aid'];
	$i = 0;
	//echo "trying to get sid";
	foreach ($json['aid'] as $value) {
		//echo "value : " .$value;
		$query = "Select * From applicant Where aid=".$value;
		$result = mysql_query($query);
	
		if(!$result)
		{
			$failed = true;
		}
		else {
			while ($row = mysql_fetch_array($result)) {
				$sids[$i] = $row['sid'];
				$json['sid'][$i] = $row['sid'];
				//echo "sids[i] : " .$sids[$i];
				$i++;
			}
		}
	}
	
	$i = 0;
	//echo "length of array sids : " . count($sids);
	//echo "trying to get name";
	for($j = 0 ; $j < count($sids) ; $j++) {
		//echo $sids[$j];
		$query = "Select * From student Where sid=". $sids[$j];
		$result = mysql_query($query);
	
		if(!$result)
		{
			$failed = true;
		}
		else {
			while ($row = mysql_fetch_array($result)) {
				$json['aname'][$i] = $row['name'];
				$i++;
			}
		}
	}
	
	if($failed)
	{
		echo "failed";
	}
	else {
		$encoded = json_encode($json);
		echo $encoded;
	}
?>