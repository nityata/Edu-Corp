<?php

	$pid = $_GET['pid'];
	$sid = $_GET['sid'];
	$cid = -1;
	$csid = -1;
	
	if(isset($_GET['csid']))
	{
		$csid = $_GET['csid'];
	}
	
	
	$corp = false;
	$faculty = false;
	$owner = false;
	
	
	if(isset($_GET['see']))
	{
		if($_GET['see'] == "corp")
		{
			$corp = true;
			$cid = $_GET['cid'];
		}
		else if($_GET['see'] == "faculty")
		{
			$faculty = true;
		}
		else if($_GET['see'] == "owner")
		{
			$owner = true;
		}
	}
	
	
		include 'config.php';
		$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
		while($row = mysql_fetch_array($result))
		  {
		  	$hname = $row['fname'];
		  }
	    
		if($csid != -1)
		{
	    $result = mysql_query("SELECT * FROM users WHERE uid=".$csid);
		while($row = mysql_fetch_array($result))
		  {
		  	$uemail = $row['email'];
		  	$ufname = $row['fname'];
		  	$uphoto = $row['photo'];
		  	$uabout = $row['about'];
		  	$uinstitution = $row['institution'];
		  }
		}
		else {
			$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
		while($row = mysql_fetch_array($result))
		  {
		  	$uemail = $row['email'];
		  	$ufname = $row['fname'];
		  	$uphoto = $row['photo'];
		  	$uabout = $row['about'];
		  	$uinstitution = $row['institution'];
		  }
		}
		
		mysql_close($con);
	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PROJECT PAGE</title>
		<script src="jquery-1.4.2.min.js"></script>
		<script src="pindex3.js"></script>
		<link rel="stylesheet" href="pindex.css" />
		<link rel="stylesheet" type="text/css" href="comments.css" />
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
		<link type="text/css" href="myjsp/jquery.jscrollpane.css" rel="stylesheet" media="all" />
		<script type="text/javascript" src="myjsp/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="myjsp/jquery.jscrollpane.min.js"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');
		</script>
	</head>
	<body>
		<input type="hidden" id="sidval"  value="<?php echo $sid;  ?>"/>
		<div id="sidebar">
					<div id="person">
						<div id="photoFrame">
							<img src="./photos/<?php echo $uphoto; ?>" id="photo" />
						</div>
						<?php
						
						if(!$corp && !$faculty)
						{
						
						?>
						<div id="roundedbox" onclick="editdesp(event)"><?php echo $uabout; ?></div>
						<?php
						}
						else {
						?>
						<div id="roundedbox"><?php echo $uabout; ?></div>
						<?php
						}
						?>
						<textarea id="editbox" style="display:none;" onblur="savetext(this.value)"></textarea>
						<br/><div id="roundedbox"><table id="details"><tr><td>Name:</td><td><?php echo $ufname; ?></td></tr><tr><td>College:</td><td><?php echo $uinstitution; ?></td></tr><tr><td>Branch:</td><td>CSE</td></tr><tr><td>E-mail:</td><td><?php echo $uemail; ?></td></tr></table></div>
					<br/><br/></div>
					<div id="buttons">
						<?php
						
							if($corp)
							{
						?>
						<div id="button"><a class="linkbtn" href="./pindex2.php?see=corp&cid=<?php echo $cid;  ?>">PROJECTS</a></div>
						<?php
							}
							elseif ($faculty) {
						?>
						<div id="button"><a class="linkbtn" href="./pindex2.php?see=faculty">PROJECTS</a></div>
						<?php
							}
							else {
						?>
						<div id="button"><a class="linkbtn" href="./pindex2.php?sid=<?php echo $sid; ?>&csid=<?php echo $sid; ?>">PROJECTS</a></div>
						<?php
							}
						?>
						<div id="button"><a class="linkbtn" href="">TESTIMONIALS</a></div>
						<div id="button"><a class="linkbtn" href="">INTERACTIONS</a></div>
					</div>
		</div>
		<div class="container">
        	<p id="welcs">Welcome <?php echo $hname; ?></p>
            <ul id="menu">
                <li>
                    <a href="#">
                        <i class="icon_about"></i>
                        <span class="title">Themes</span>
                        <span class="description">Customize the look and feel</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon_work"></i>
                        <span class="title">Profile</span>
                        <span class="description">See your profile and portfolio</span>
                    </a>
                </li>
                <li>
                    <a href="./index.php">
                        <i class="icon_help"></i>
                        <span class="title">Home</span>
                        <span class="description">Go to your wall</span>
                    </a>
                </li>
                <li>
                    <a href="./logout.php">
                        <i class="icon_search"></i>
                        <span class="title">Logout</span>
                        <span class="description">Logout of educorp</span>
                    </a>
                </li>
            </ul>
        </div>
		<div id="commentarea">
			<a href="#" onclick="hideComment()">X</a>
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
		</div>
		
		
		<div id="recoarea">
			<a href="#" onclick="hideReco()">X</a>
			<?php
				if($corp || $faculty)
				{
			?>
			<div id="addRecoContainer">
				<p>Add a Recommendation</p>
				<form id="addRecoForm" method="post" action="">
			    	<div>
			            <label for="recoText">Enter your recommendation here</label><br />
						<textarea name="recoText" id="recoText" cols="20" rows="5" value="">
						</textarea>
			            <input type="button" id="submit" value="Submit" onclick="recoSubmit()"/>
					</div>
    			</form>
    			<!--<span href="#" onclick="viewPrevComments()">View Previous Comments</span> -->
			</div>
			<?php
				}
			?>
		</div>
		
		<div id="projectslist" class="scroll-pane">
			<?php
				include 'config.php';
				
				
				$projects = '';
						
				$query = "SELECT * FROM project2 WHERE pid=" . $pid;
							
				$result = mysql_query($query);
							
				if(!$result)
				{
					echo "";
				}
				else {
					
					while ($row = mysql_fetch_array($result)) {
						$projects = $projects .'<div onclick="showPr(event)" class="newupdate" id="'. $row['pid'].'"><p class="title">TITLE: '. $row['title'] . '</p><p class="duration">DURATION: ' . $row['duration'] . ' months</p><p class="authors">AUTHORS: ' . $row['author'] . '</p></div><br />';
					}
					echo $projects;
					error_log(print_r($projects, TRUE), 0);
				}
							
				mysql_close($con);
				//echo $projects;
			?>
		</div>
		<?php
		
			if($owner)
			{
				echo "owner";
			}
		
		?>
	</body>
</html>