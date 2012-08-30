<?php

	$jid = $_GET['jid'];
	include 'config.php';

	$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
	if(!$result)
	{
		echo "failed";
	}
	else {
		$json = array();
		$json['docs'] = array();
		while($row = mysql_fetch_array($result))
		{
			//echo '<li><a href="#" class="docItem">'.$row['docs'].'</a></li>';
			$docs = $row['docs'];
		}
									
		$docArr = explode(";", $docs);
									
		for($i=0;$i<(count($docArr));$i++)
		{
			//echo '<li><a href="#" class="docItem">'.$docArr[$i].'</a></li>';
			$json['docs'][$i] = $docArr[$i];
		}
		$encoded = json_encode($json);
		echo $encoded;
	}
	
	mysql_close($con);
?>