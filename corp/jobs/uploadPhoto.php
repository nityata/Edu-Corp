<?php
	
		$jid = $_GET['jid'];
		include 'config.php';

      if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"C:/wamp/www/upload/" . $_FILES["uploadfile"]["name"]))
	  {
      	
		$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
		while($row = mysql_fetch_array($result))
		{
			$doc = $row['docs'];
		}
		if($doc != '')
		{
			mysql_query("UPDATE job SET docs='".$doc.";".$_FILES["uploadfile"]["name"]."' WHERE jid=".$jid);
		}
		else {
			mysql_query("UPDATE job SET docs='".$_FILES["uploadfile"]["name"]."' WHERE jid=".$jid);
		}
		
		echo $_FILES["uploadfile"]["name"];
		
		//mysql_close($con);
		// here oly put it in to database
	  }
	  else {
		  echo "error";
	  }
		
	  mysql_close($con);      
?>
