<?php
include 'config.php';
	$jid = $_GET["jid"];
	$sid = $_GET["sid"];
	$cid = $_GET["cid"];
	$text = $_GET["text"];
	$ty = $_GET["type"];
	$aid = -1;
	$iid = -1;
	
	$query = "Select * from applicant Where sid=".$sid;
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)) {
		$aid = $row['aid'];
	}
	
	$query = "Select * from intern Where aid=".$aid . " AND jid=".$jid;
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)) {
		$iid = $row['iid'];
	}
	//$result = mysql_query("SELECT * FROM users WHERE uid=".$uid);

/*while($row = mysql_fetch_array($result))
  {
  	mysql_query("UPDATE users SET about = '".$text."' WHERE uid=".$uid);
  }*/
  
//mysql_query("UPDATE student SET interests = '".$text."' WHERE sid=".$uid);
error_log(print_r("iid = " .$iid, TRUE), 0);

if ($ty == "work") {
	mysql_query("UPDATE progress SET work = '".$text."' WHERE iid=".$iid);	
}
elseif ($ty == "todo") {
	mysql_query("UPDATE progress SET todo = '".$text."' WHERE iid=".$iid);
}
echo "Your profile has been updated";
mysql_close($con);
	
?>