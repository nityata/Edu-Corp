<?php
session_start();
$sid = -1;
$esid = -1;
$tsid = -1;
$external = false;
$hname = '';


//assuming $_GET['sid'] will contain student id and is assigned to $sid
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

include 'config.php';
$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
while($row = mysql_fetch_array($result))
  {
  	$hname = $row['fname'];
  }

mysql_close($con);



if(isset($_GET['see']))
{
	if($_GET['see'] == "external")
	{
		$external = true;
		$esid = $_GET['esid'];
		
		if($sid == $esid)
		{
			$external = false;
		}
		else {
			$tsid = $sid;
			$sid = $esid;	
		}
	}
}

include 'config.php';
$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
while($row = mysql_fetch_array($result))
  {
  	$uemail = $row['email'];
  	$ufname = $row['fname'];
  	$uphoto = $row['photo'];
  	$uabout = $row['about'];
  	$uinstitution = $row['institution'];
  }

mysql_close($con);


error_log(print_r('sid = ' . $sid . 'esid = ' . $esid, TRUE), 0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>STUDENT WALL</title>
		<!--<link rel="stylesheet" href="style5.css" />
		<link rel="stylesheet" href="demo.css" /> -->
		<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
		<link type="text/css" href="myjsp/jquery.jscrollpane.css" rel="stylesheet" media="all" />
		<link type="text/css" href="wall.css" rel="stylesheet"  />
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="myjsp/jquery.mousewheel.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="myjsp/jquery.jscrollpane.min.js"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
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
		<!-- the mousewheel plugin - optional to provide mousewheel support -->
		
		<!--<link rel="stylesheet" href="wall.css" /> -->
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');
		</script>
	</head>
	<body>
		<input type="hidden" id="sidval" value="<?php  echo $sid; ?>" />
		<input type="hidden" id="tsidval" value="<?php  echo $tsid; ?>" />
		
		<div id="sidebar">
					<div id="person">
						<div id="photoFrame">
							<img src="./photos/<?php echo $uphoto; ?>" id="photo" />
						</div>
						<?php
						
						if(!$external)
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
						
							if($external)
							{
						?>
						<div id="button"><a class="linkbtn" href="./pindex2.php?sid=<?php echo $tsid; ?>&csid=<?php echo $sid; ?>">PROJECTS</a></div>
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
		
		<?php
		
			if(!$external)
			{
			
		?>
		
		<div id="ads">
			<div id="container">
				<section class="rw-wrapper">
				<h2 class="rw-sentence">
					
					<div class="rw-words" id="adchange">
					</div>
				</h2>
			</section>
			</div>
		</div>
		
		<?php
			}
		
		?>
		<div id="content">
		</div>
		<div id="notifications-head">Wall Posts</div>
		<div id="wall" class="scroll-pane"></div>
	</body>
</html>