<?php

	/*echo $_POST['commentText'].'<hr />';
	echo $_POST['cname'].'<hr />';
	echo $_POST['pid'].'<hr />';
	echo $_POST['con'].'<hr />';*/
	
	include 'config.php';
	
	$query = "INSERT INTO comments(cid,comment,comment_on,name,submitterID) VALUES ($_POST[pid],'$_POST[comment]','$_POST[con]','$_POST[cname]',$_POST[sid])";
	
	if (!mysql_query($query,$con))
	{
	  echo "failed";
	}
	else {
		echo "success";
	}
	//echo "COMMENT ADDED SUCCESSFULLY<hr />";

	mysql_close($con);
	//echo '<a href="http://localhost/ss/sampleindex.php?pid='.$_POST['pid'].'">Back</a>';
?>