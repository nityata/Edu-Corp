<?php

      if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"C:/wamp/www/upload/" . $_FILES["uploadfile"]["name"]))
      	echo "Stored in: " . "upload/" . $_FILES["uploadfile"]["name"];
	  else {
		  echo "error";
	  }
      
?>
