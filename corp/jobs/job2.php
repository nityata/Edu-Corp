<?php

	$jid = $_GET['jid'];
	include 'config.php';
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JOBS PAGE</title>
		<script type="text/javascript">
			function deleteJob()
			{
				var jid = document.getElementById("jid").value;
				//alert(jid);
				var del = confirm("Are you sure you want to delete the job?");
				if(del == true)
				{
					xhr = new XMLHttpRequest();
					xhr.onreadystatechange = deleteItem;
					xhr.open("GET","http://localhost/corp/jobs/del.php?jid="+jid,true);
					xhr.send();
				}
				
			}
			
			function deleteItem()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					if(xhr.responseText == "success")
					{
						alert("Deleted Opening successfully");
						//load back jobs3.php?
					}
					else
					{
						alert("Couldn't delete job. Try after a while."); 
					}
				}
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
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				
				<!-- Div is for Shadow Overlay-->
				<div>
					<h3>Research project at Adobe, India</h3>	
				</div>	
			</div>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<a href="#" style="float: left;">Edit Opening</a>
				<a href="#" onclick="deleteJob()" style="float: right;">Delete Opening</a>
				<a href="#" style="position: relative;left:200px;">Docs</a>
				<a href="http://localhost/corp/jobs/applicants.php" style="position: relative;left:380px;">View Applicants</a>
			</div>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<div id="left">
					<div id="abstract">
						<?php
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="jobInfo">'.$row['abstract'].'</p>';
								echo '<input type="hidden" id="jid" value="'.$jid.'" />';
							}
						?>
					</div>
					<div id="prerequisite">
						<?php
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="jobInfo">'.$row['prerequisite'].'</p>';
							}
						?>
					</div>
				</div>
				<div id="right">
					<div id="deadline">
						<?php
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="jobInfo">'.$row['deadline'].'</p>';
							}
						?>
					</div>
					<div id="tags">
						<?php
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="jobInfo">'.$row['tags'].'</p>';
							}
						?>
					</div>
				</div>
				
			</div>
			<a id="bck" href="http://localhost/corp/jobs/jobs3.php">BACK TO JOBS</a>
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