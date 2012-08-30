<?php

  if ($_FILES["file"]["error"] > 0)
    {
    	$json = array(
				'result' => -1, 
				'errors' => $_FILES["file"]["error"]
				);				
			$encoded = json_encode($json);
			echo $encoded;
			unset($encoded);
    }
  else
    {
    

    if (file_exists("C:/wamp/upload/" . $_FILES["file"]["name"]))
      {
      		$json = array('result' 	=> 2);
      }
    else
      {
      	move_uploaded_file($_FILES["file"]["tmp_name"],"C:/wamp/upload/" . $_FILES["file"]["name"]);
      	$json = array('result' 	=> 1);
      }
	  
	  		$encoded = json_encode($json);
			echo $encoded;
			unset($encoded);
    }
?>