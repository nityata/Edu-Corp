<?php

session_start();
//assuming $_GET['cid'] or session variable will contain corp id and is assigned to $cid

$cid = -1;
$student = false;
$sid = -1;
$ecid = -1;
$tcid = -1;
$external = false;
$tags = '';

if(isset($_GET['cid']))
{
	$cid = $_GET['cid'];
	$_SESSION['cid'] = $cid;
}
else {
	if(isset($_SESSION['cid']))
	{
		$cid = $_SESSION['cid'];
	}
}



if(isset($_GET['see']))
	{
		//make the inline-editable divs non-inline editable
		// make edit n delete openings disappear
		//make the upload file in docs disappear
		// make the accept, reject, call for interview disappear
		// make the checkboxes also disppear
		if($_GET['see'] == "student")
		{
			$student = true;
			$sid = $_GET['sid'];
		}
		
		if($_GET['see'] == "external")
		{
			$external = true;
			$ecid = $_GET['ecid'];
			
			if($cid == $ecid)
			{
				$external = false;
			}
			else {
				$tcid = $cid;
				$cid = $ecid;	
			}
		}
	}
	

	include 'config.php';
	$result = mysql_query("SELECT * FROM users WHERE uid=".$cid);
	while($row = mysql_fetch_array($result))
	  {
	  	$uemail = $row['email'];
	  	$ufname = $row['fname'];
	  	$uphoto = $row['photo'];
	  	$uabout = $row['about'];
	  	$uinstitution = $row['institution'];
	  }

if($student)
{
	include 'config.php';
	$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
	  }
	
	mysql_close($con);
}
else if(!$external && !$student)
{
	include 'config.php';
	$result = mysql_query("SELECT * FROM users WHERE uid=".$cid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
	  }
	
	mysql_close($con);
}


					include 'config.php';
					$query = "Select * From corp Where cid=".$cid;
					$result = mysql_query($query);
					if(!$result)
					{
						//echo "";
					}
					else {
						while($row = mysql_fetch_array($result))
						{
							//echo "<p>We are located at ".$row['address']."<br />";
							//echo "Email us at ".$row['email']."<br />";
							//echo "Contact us at ".$row['phone']."</p>";
							//echo "We primarily deal with ".$row['tags']."</p>";
							$tags = $row['tags'];
						}
					}
					mysql_close($con);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>CORP WALL</title>
		<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
		<?php
		
			if (!$external) {
				
			
		?>
		<script type="text/javascript" src="wall.js"></script>
		<?php
			}
			elseif ($external) {
				
		?>
		<script type="text/javascript" src="extwall.js"></script>
		<?php
		
			}
		
		?>
		<link rel="stylesheet" href="css/wall.css" />
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
		<link type="text/css" href="myjsp/jquery.jscrollpane.css" rel="stylesheet" media="all" />
		<script type="text/javascript" src="myjsp/jquery.mousewheel.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="myjsp/jquery.jscrollpane.min.js"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
	</head>
	<body>
		
		<div id="sidebar">
					<div id="person">
						<div id="photoFrame">
							<img src="./photos/<?php echo $uphoto; ?>" id="photo" />
							<?php
					
								include 'config.php';
								$query = "Select * From corp Where cid=".$cid;
								$result = mysql_query($query);
								if(!$result)
								{
									echo "";
								}
								else {
									while($row = mysql_fetch_array($result))
									{
										echo '<h1>' . $row['name'] . '</h1>';
									}
								}
								mysql_close($con);
							?>
						</div>
						<br/><div id="roundedbox"><table id="details"><tr><td>Name:</td><td><?php echo $ufname; ?></td></tr><tr><td>E-mail:</td><td><?php echo $uemail; ?></td></tr><tr><td>TAGS: </td></td><td><?php echo $tags; ?></td></tr></table></div>
					<br/><br/></div>
					<div id="buttons">
						<?php if(!$student && !$external)
						{ ?>
							<div id="button"><a class="linkbtn" href="./Alljobs.php?cid=<?php echo $cid; ?>">JOBS</a></div>	
							<div id="button"><a class="linkbtn" href="../products/index.php?cid=<?php echo $cid;  ?>">PRODUCTS</a></div>
						<?php
						}
						elseif ($external) {
						?>
							<div id="button"><a class="linkbtn" href="./Alljobs.php?cid=<?php echo $cid; ?>&see=external">JOBS</a></div>
							<div id="button"><a class="linkbtn" href="../products/index.php?cid=<?php echo $cid;  ?>&see=external">PRODUCTS</a></div>
						<?php
						}
						elseif($student) {
						?>
							<div id="button"><a class="linkbtn" href="#" onclick="showJobs()">JOBS</a></div>	
							<div id="button"><a class="linkbtn" href="../products/index.php?cid=<?php echo $cid;  ?>&see=external">PRODUCTS</a></div>
						<?php
						}
						?>
						
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
                    <?php if(!$student){  ?><a href="http://localhost/corp/jobs/index.php">  <?php }else {
                        ?> <a href="http://localhost/student/index.php">  <?php
                    } ?>
                        <i class="icon_help"></i>
                        <span class="title">Home</span>
                        <span class="description">Go to your wall</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/student/logout.php">
                        <i class="icon_search"></i>
                        <span class="title">Logout</span>
                        <span class="description">Logout of educorp</span>
                    </a>
                </li>
            </ul>
        </div>
		
		
		<input type="hidden" id="cidval" value="<?php  echo $cid; ?>" />
		<input type="hidden" id="tcidval" value="<?php  echo $tcid; ?>" />
		<?php
			if(!$student && !$external)
			{
		?>
		<div id="wall" class="scroll-pane"></div>
		<!--<div id="notes"><p id="note"></p></div> -->
		
		<!--<a href="./Alljobs.php?cid=<?php echo $cid; ?>">JOBS</a>
		<a href="../products/index.php?cid=<?php echo $cid;  ?>">PRODUCTS</a> -->
		
		<?php
			}
			elseif ($external) {
		?>
		<!--<a href="./Alljobs.php?cid=<?php echo $cid; ?>&see=external">JOBS</a>
		<a href="../products/index.php?cid=<?php echo $cid;  ?>&see=external">PRODUCTS</a> -->
		<?php
			}
			else if($student)
			{
		?>
			<input type="hidden" id="sidval" value="<?php  echo $sid; ?>" />
			
			<div id="desc" class="scroll-pane">
				<?php
					echo '<p class="newupdate">' . $uabout . '</p>';
				?>
				<!--<a href="#" onclick="showJobs()">View Jobs</a> -->
			</div>
		<?php
			}
		?>
	</body>
</html>