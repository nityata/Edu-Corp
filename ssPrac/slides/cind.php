<?php

	$pid = -1;
	
	if(isset($_GET['pid']))
	{
		$pid = $_GET['pid'];
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>COMMENT</title>
		<link rel="stylesheet" type="text/css" href="css/comments.css" />
	</head>
	<body>
		<div id="main">
			<?php
	
				// have a $_GET variable here from the other page
				$comment_on = "project";
				include 'config.php';
				
				$comments = array();
				$result = mysql_query("SELECT * FROM comments WHERE cid=".$pid." AND comment_on='".$comment_on."'");
				
				while($row = mysql_fetch_array($result))
			  	{
					echo '<div class="comment">
							<div class="avatar">
								<img src="css/img/default_avatar.gif" />
							</div>
							
							<div class="name">'.$row['name'].'</div>
							<div class="date" title="Added at '.$row['date'].'">'.$row['date'].'</div>
							<p>'.$row['comment'].'</p>
						</div>';
			  	}
			 
			?>
			
			
			
		</div>
		<div id="addCommentContainer">
				<p>Add a Comment</p>
				<form id="addCommentForm" method="post" action="">
			    	<div>
			            
			            <label for="commentText">Enter your comment here</label><br />
						<textarea name="commentText" id="body" cols="20" rows="5" value="">
						</textarea><br />
						<input type="hidden" name="cname" value="Nityata" />
						<input type="hidden" name="pid" value="1" />
						<input type="hidden" name="con" value="project" />
			            <input type="button" id="submit" value="Submit" onclick="commentSubmit()"/>
					</div>
    			</form>
			</div>
			
			<a href="http://localhost/ss/sampleindex.php?pid=1">Back</a>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/mycomments.js"></script>
	</body>
</html>