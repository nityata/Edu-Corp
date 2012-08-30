<?php

	session_start();
	
	

	$aaid = -1;
	$profile = false;
	$resume = false;
	$app = false;
	$stu = false;
	$ssid = -1;
	$cid = -1;
	$hname ='';
	
	
	if(isset($_GET['cid']))
	{
		echo '<input type="hidden" id="cid" value="'.$_GET['cid'].'" />';
		$cid = $_GET['cid'];
	}
	else
	{
		if(isset($_SESSION['cid']))
		{
			echo '<input type="hidden" id="cid" value="'.$_SESSION['cid'].'" />';
			$cid = $_SESSION['cid'];
		}
	}
	
	if(isset($_GET['jid']))
	{
	$jid = $_GET['jid'];
	}
	if(isset($_GET['sid'])){
	$sid = $_GET['sid'];
	}
	if(isset($_GET['aid']))
	{
	$aid = $_GET['aid'];
	}
	$see = $_GET['see'];
	
	//echo '<input type="hidden" id="aid" value="'.$aid.'" />';
	//echo '<input type="hidden" id="jid" value="'.$jid.'" />';
	//echo '<input type="hidden" id="sid" value="'.$sid.'" />';
	
	if($see == "profile")
	{
		$id = $_GET['sid'];
		$profile = true;
	}
	else if($see == "resume")
	{
		$id = $_GET['sid'];
		$resume = true;
	}
	else if($see == "app")
	{
		$id = $_GET['aid'];
		$app = true;
	}
	else if($see == "student")
	{
		$aaid = $_GET['aaid'];
		$ssid = $_GET['ssid'];
		$stu = true;
	}
	
	if($stu)
	{
		$ajid = -1;
		include 'config.php';
	
		$result = mysql_query("SELECT * FROM application WHERE aaid=".$aaid);
		while($row = mysql_fetch_array($result))
		  {
		  	$ajid = $row['jid']; 
		  }
		$result = mysql_query("SELECT * FROM job WHERE jid=".$ajid);
		while($row = mysql_fetch_array($result))
		  {
		  	$cid = $row['cid']; 
		  }
		  mysql_close($con);
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
	
	if($stu)
	{
	$result = mysql_query("SELECT * FROM users WHERE uid=".$ssid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
	  }
	}
	else {
		$result = mysql_query("SELECT * FROM users WHERE uid=".$cid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
	  }
	}
    
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
		<title>JOBS PAGE</title>
		<script src="jquery-1.4.2.min.js"></script>
		<script src="app.js"></script>
		<script type="text/javascript">
			function acceptApp()
			{
				//alert("here");
				//get values from input ids
				// use applicants.php algo
				var jid = document.getElementById("jid").value;
				var aid = document.getElementById("aid").value;
				var sid = document.getElementById("sid").value;
				
				//alert(jid);
				//alert(aid);
				//alert(sid);
				
				var JSONObject = new Object;
				JSONObject.jid = new Array;
				JSONObject.aid = new Array;
				JSONObject.sid = new Array;
				
				JSONObject.jid[0] = jid;
				JSONObject.sid[0] = sid;
				JSONObject.aid[0] = aid;
				
				JSONstring = JSON.stringify(JSONObject);
				
				xhr = new XMLHttpRequest();
				xhr.onreadystatechange = acceptance;
				xhr.open("GET","http://localhost/corp/jobs/accp.php?json="+JSONstring,true);
				xhr.send(null);
			}
			
			
			function acceptance()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					if(xhr.responseText == "success")
					{
						alert("sent acceptance");
					}
					else
					{
						alert("Couldn't send acceptance. Try after a while."); 
					}
				}
			}
			
			function rejectApp()
			{
				
			}
			
			function interviewApp()
			{
				
			}
			
		</script>
		<style type="text/css" media="screen">
			
			body{
				background-color: #000;
			}
			
			/* Center the website */
			#wrapper{
				width:920px;
				margin:0 auto;
				position:relative;
				left:110px;
			}
			
			/* Give the header a height and a background image */
			#header{
				height:100px; 
				background: #000 url(background.jpg) repeat-y scroll left top;
				text-align:center;
			}
			
			/* Create a Shadow Overlay */ 
			#header div{
				width:920px;
				height:100px;
				background: transparent url(overlay.png) no-repeat scroll left top;
			}
			
			/* Vertically position header text and style it*/
			#header h3{
				padding-top:25px;
				font-family: Arial, "MS Trebuchet", sans-serif;
				color:white;
			}
			
			/* Give basic styles to the body and the navigation */
			#body{
				background-color:#efefef;
				height:350px;
			}
			#nav{
				height:35px;
				background-color: #111;
				color:white;
			}
			#nav a
			{
				vertical-align:middle;
				font-family:"Comic Sans MS";
				text-decoration:none;
				color:white;
			}
		</style>
		<!--[if lte IE 6]>
			<style type="text/css" media="screen">
				#header div{
					background-image: none;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='overlay.png', sizingMethod='scale');
				}
			</style>
		<![endif]-->
		<link rel="stylesheet" href="css/jobsstyle.css" />
		<link rel="stylesheet" href="css/applicant.css" />
		<link rel="stylesheet" href="css/menustyle.css" />
		<!--<link rel="stylesheet" href="comments.css" />
		<link rel="stylesheet" type="text/css" href="css/doc.css" />
		<link rel="stylesheet" type="text/css" href="css/form.css" />
		<link rel="stylesheet" type="text/css" href="css/appform.css" />
		<link rel="stylesheet" type="text/css" href="css/style7.css" /> -->
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
					<!--<br/><div id="roundedbox"><table id="details"><tr><td>Name:</td><td><?php echo $ufname; ?></td></tr><tr><td>E-mail:</td><td><?php echo $uemail; ?></td></tr><tr><td>TAGS: </td></td><td><?php echo $tags; ?></td></tr></table></div> -->
					<br/><br/></div>
					<div id="buttons">
						<?php if($stu){ ?><div id="button"><a class="linkbtn" href="./Alljobs.php?see=external">JOBS</a></div><?php }else {
							?>
							<div id="button"><a class="linkbtn" href="./Alljobs.php">JOBS</a></div>
							<?php
						} ?>	
						<div id="button"><a class="linkbtn" href="#">PRODUCTS</a></div>
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
                    <?php if($stu){ ?><a href="http://localhost/student/index.php"> <?php }else {
                        ?>
                        <a href="http://localhost/corp/jobs/index.php">
                        <?php
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
		<input type="hidden" id="aid" value="<?php echo $aid; ?>"/>
		<input type="hidden" id="jid" value="<?php echo $jid; ?>"/>
		<input type="hidden" id="sid" value="<?php echo $sid; ?>"/>
		
		<div id="wrapper">
			<div id="header">
				
				<!-- Div is for Shadow Overlay-->
				<div>
					<h3>Applicants for Research project at Adobe, India</h3>	
				</div>
			</div>
			<?php
				if(!$stu)
				{
			?>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<a href="#" onclick="acceptApp()" style="float: left;">Accept</a>
				<a href="http://localhost/corp/jobs/applicants.php" style="float: right;">Back to Applicants</a>
				<a href="#" onclick="rejectApp()" style="position: relative;left:200px;">Reject</a>
				<a href="#" onclick="interviewApp()" style="position: relative;left:380px;">Call for Interview</a>
			</div>
			<?php
				}
			?>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<!--<textarea rows="4" cols="10"></textarea> -->
				
				<p class="appl">
					<?php
						
						include 'config.php';
						//add where clause for summer, fal etc.
						if($profile)
						{
							$result = mysql_query("SELECT * FROM student WHERE sid=".$id);	
							while($row = mysql_fetch_array($result))
							{
								echo $row['profile'];
							}
						}
						
						else if($app)
						{
						?>
						<div id="commentarea" style="float: right; position: relative;top: -320px">
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
							</div>
						</div>
						<?php
							$result = mysql_query("SELECT * FROM application WHERE aid=".$id." AND jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p style="position:relative;top:-300px;width:500px;">'.$row['abstract'] . '</p>';
								// echo comments and introduce comment box
								?>
								<input type="hidden" id="aaid" value="<?php echo $row['aaid']; ?>" />	
						<?php
						
							}
						}
						
						else if($resume)
						{
							$result = mysql_query("SELECT * FROM student WHERE sid=".$id);
							while($row = mysql_fetch_array($result))
							{
								echo '<a href="#"'.$row['resume'].'</a>';
							}	
						}
						
						
						elseif ($stu) {
							?>
						<input type="hidden" id="aaid" value="<?php echo $aaid; ?>" />
						<input type="hidden" id="ssid" value="<?php echo $ssid; ?>" />
						<input type="hidden" id="see" value="student" />
						<div id="commentarea" style="position: relative;top: -320px">
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
							</div>
						</div>
						<?php
							
						}
						
						mysql_close($con);
					
					?>
				</p>
				
			</div>
		</div>
	</body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" charset="utf-8">
		
			var scrollSpeed = 70; 		// Speed in milliseconds
			var step = 1; 				// How many pixels to move per step
			var current = 0;			// The current pixel row
			var imageHeight = 4300;		// Background image height
			var headerHeight = 100;		// How tall the header is.
			
			//The pixel row where to start a new loop
			var restartPosition = -(imageHeight - headerHeight);
			
			function scrollBg(){
				
				//Go to next pixel row.
				current -= step;
				
				//If at the end of the image, then go to the top.
				if (current == restartPosition){
					current = 0;
				}
				
				//Set the CSS of the header.
				$('#header').css("background-position","0 "+current+"px");
				
				
			}
			
			//Calls the scrolling function repeatedly
			var init = setInterval("scrollBg()", scrollSpeed);

			
	</script>	
</html>