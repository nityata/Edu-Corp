<?php

	include 'config.php';

	$date = date("Y-m-d");
	
	$old = strtotime ( '-3 month' , strtotime ( $date ) ) ;
	$old = date ( 'Y-m-j' , $old );
	
	$newdate = strtotime ( '-3 month' , strtotime ( $old ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
	
	//echo $old;
	//echo $newdate."\n";
	 
	
	
	$query = "Select * From job Where created_on Between '".$newdate." 00:00:00' And '".$old." 00:00:00'";
	$result = mysql_query($query);
	if(!$result)
	{
		echo "failed";
	}
	else {
		$json = array();
		$json['title'] = array();
		$json['jid'] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			//echo $row['title'];
			// echo in json the title and jid
			$json['title'][$i] = $row['title'];
			$json['jid'][$i] = $row['jid'];
			$i++;
		}
		$encoded = json_encode($json);
		echo $encoded;
	}
	
	mysql_close($con);

?>