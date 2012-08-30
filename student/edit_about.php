<?php
include 'config.php';
	$uid = $_GET["id"];
	$text = $_GET["text"];
	$result = mysql_query("SELECT * FROM users WHERE uid=".$uid);

while($row = mysql_fetch_array($result))
  {
  	mysql_query("UPDATE users SET about = '".$text."' WHERE uid=".$uid);
  }
  
mysql_query("UPDATE student SET interests = '".$text."' WHERE sid=".$uid);
echo "Your profile has been updated";
mysql_close($con);
	
?>