<?php
	
	session_start();
	
	$sid = -1;
	$corp = false;
	$faculty = false;
	$csid = -1;
	
	if(isset($_GET['sid']))
	{
		$sid = $_GET['sid'];
		$_SESSION['sid'] = $sid;
	}
	else {
		if(isset($_SESSION['sid']))
		{
			$sid = $_SESSION['sid'];
		}
	}
	
	if(isset($_GET['csid']))
	{
		$csid = $_GET['csid'];
	}
	
	if(isset($_GET['see']))
	{
		if($_GET['see'] == "corp")
		{
			$corp = true;
		}
		else if($_GET['see'] == "faculty")
		{
			$faculty = true;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PROJECTS PAGE</title>
		<script src="jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="pindex.js"></script>
		<link rel="stylesheet" href="pindex.css" />
		<link rel="stylesheet" type="text/css" href="comments.css" />
	</head>
	<body>
		<input type="hidden" id="sidval"  value="<?php echo $sid;  ?>"/>
		
		<div id="commentarea">
			<a href="#" onclick="hideComment()">X</a>
			<?php
				if($corp || $faculty)
				{
			?>
			<div id="addCommentContainer">
				<p>Add a Comment</p>
				<form id="addCommentForm" method="post" action="">
			    	<div>
			            <label for="commentText">Enter your comment here</label><br />
						<textarea name="commentText" id="commentText" cols="20" rows="5" value="">
						</textarea>
			            <input type="button" id="submit" value="Submit" onclick="commentSubmit()"/>
					</div>
    			</form>
    			<!--<span href="#" onclick="viewPrevComments()">View Previous Comments</span> -->
			</div>
			<?php
				}
			?>
		</div>
		
		
		
		<div id="projectslist">
			<?php
				include 'config.php';
				
				$query = "SELECT * FROM project2 WHERE submitter=" . $sid;
				
				$result = mysql_query($query);
				
				if(!$result)
				{
					echo "";
				}
				else {
					$projects = '';
					while ($row = mysql_fetch_array($result)) {
						//$projects += '<div id="$row[pid]" onclick="showProject(event)"><p class="title">'. $row['title'] . '</p><p class="duration">' . $row['duration'] . ' months</p><p class="authors">' . $row['author'] . '</p></div>';
						$projects = $projects .'<div class="prj" id="'. $row['pid'].'" onclick="showProject(event)"><p class="title">TITLE: '. $row['title'] . '</p><p class="duration">DURATION: ' . $row['duration'] . ' months</p><p class="authors">AUTHORS: ' . $row['author'] . '</p></div><br />';
					}
					echo $projects;
					error_log(print_r($projects, TRUE), 0);
				}
				
				mysql_close($con);
			?>
		</div>
	</body>
</html>