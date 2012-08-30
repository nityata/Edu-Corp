<?php

	session_start();

	$cid = -1;
	/*if(isset($_SESSION['jid']))
	{
		//echo '<p style="font-size:30px;color:white;font-weight:bold;">set variable:'.$_SESSION['jid'].'</p>';
		$jid = $_SESSION['jid'];
	}
	else {
		$jid = -1;
	}*/
	
	if(isset($_GET['jid']))
	{
		$jid = $_GET['jid'];
		$_SESSION['jid']=$jid;	
	}
	else
	{
		if(isset($_SESSION['jid']))
		{
			//echo '<p style="font-size:30px;color:white;font-weight:bold;">set variable:'.$_SESSION['jid'].'</p>';
			$jid = $_SESSION['jid'];
		}
		else {
			$jid = -1;
		}
	}
	
	include 'config.php';
	
	
	$query = "Select * from job Where jid=".$jid;
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)) {
		$cid = $row['cid'];
	}
	
	$result = mysql_query("SELECT * FROM users WHERE uid=".$cid);
	while($row = mysql_fetch_array($result))
	  {
	  	$uemail = $row['email'];
	  	$ufname = $row['fname'];
	  	$uphoto = $row['photo'];
	  	$uabout = $row['about'];
	  	$uinstitution = $row['institution'];
	  }
	$result = mysql_query("SELECT * FROM users WHERE uid=".$cid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
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
	
	//echo '<p style="font-size:30px;color:white;font-weight:bold;">set variable:'.$jid.'</p>';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JOBS PAGE</title>
		<script type="text/javascript">
			function acceptApp()
			{
				
				var checks = document.getElementsByClassName("check");
				var i;
				 var JSONObject = new Object;
				 JSONObject.jid = new Array;
				 JSONObject.sid = new Array;
				 JSONObject.aid = new Array;
				
				 
				for(i=0;i<checks.length;i++)
				{
					if(checks[i].checked)
					{
						//alert(i+1);
						var div = checks[i].parentNode;
						var id = div.getAttribute("id");
						var idArr = id.split(";")
						var j;
						/*for(j =1 ; j< idArr.length;j++)
						{
							alert(idArr[j]);
						}*/
						JSONObject.jid[i] = idArr[1];
						JSONObject.sid[i] = idArr[2];
						JSONObject.aid[i] = idArr[3];
					}
				}
				
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
				var checks = document.getElementsByClassName("check");
				var i;
				 var JSONObject = new Object;
				 JSONObject.jid = new Array;
				 JSONObject.sid = new Array;
				 JSONObject.aid = new Array;
				
				 
				for(i=0;i<checks.length;i++)
				{
					if(checks[i].checked)
					{
						//alert(i+1);
						var div = checks[i].parentNode;
						var id = div.getAttribute("id");
						var idArr = id.split(";")
						
						JSONObject.jid[i] = idArr[1];
						JSONObject.sid[i] = idArr[2];
						JSONObject.aid[i] = idArr[3];
					}
				}
				
				JSONstring = JSON.stringify(JSONObject);
				
				xhr2 = new XMLHttpRequest();
				xhr2.onreadystatechange = rejection;
				xhr2.open("GET","http://localhost/corp/jobs/reject.php?json="+JSONstring,true);
				xhr2.send(null);
			}
			
			function rejection()
			{
				if(xhr2.readyState == 4 && xhr2.status == 200)
				{
					if(xhr2.responseText == "success")
					{
						alert("sent rejection");
					}
					else
					{
						alert("Couldn't send rejection. Try after a while. Have you checked on an applicant?"); 
					}
				}
			}
			
			function interviewApp()
			{
				var checks = document.getElementsByClassName("check");
				 var i;
				 
				 var JSONObject = new Object;
				 JSONObject.jid = new Array;
				 JSONObject.sid = new Array;
				 JSONObject.aid = new Array;
				
				 
				for(i=0;i<checks.length;i++)
				{
					if(checks[i].checked)
					{
						//alert(i+1);
						var div = checks[i].parentNode;
						var id = div.getAttribute("id");
						var idArr = id.split(";")
						
						JSONObject.jid[i] = idArr[1];
						JSONObject.sid[i] = idArr[2];
						JSONObject.aid[i] = idArr[3];
					}
				}
				var itime = 0;
				var iplace = '';
				var idate = 0;
				var setDetails = false;
				
				iplace = prompt("Set place for interview")
				idate = prompt("Set date for interview")
				itime = prompt("Set time for interview")
				
				if(itime != 0 && iplace != '' && idate != 0)
				{
					setDetails = true;	
				}
				
				JSONstring = JSON.stringify(JSONObject);
				
				console.log(JSONstring);
				
				if(setDetails == true)
				{
					xhr3 = new XMLHttpRequest();
					xhr3.onreadystatechange = interview;
					xhr3.open("GET","http://localhost/corp/jobs/interview.php?json="+JSONstring + "&time=" + itime + "&date=" + idate + "&place=" + iplace,true);
					xhr3.send(null);
				}
				else
				{
					console.log("here");
				}
			}
			
			function interview()
			{
				if(xhr3.readyState == 4 && xhr3.status == 200)
				{
					if(xhr3.responseText == "success")
					{
						alert("sent interview message");
					}
					else
					{
						alert("Couldn't send interview message. Try after a while. Have you checked on an applicant?"); 
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
		<link rel="stylesheet" href="css/applicant.css" />
		<link rel="stylesheet" href="css/menustyle.css" />
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
						
						<div id="button"><a class="linkbtn" href="#" onclick="showJobs()">JOBS</a></div>	
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
                    <a href="http://localhost/corp/jobs/index.php">
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
		<div id="wrapper">
			<div id="header">
				
				<!-- Div is for Shadow Overlay-->
				<div>
					<h3>Applicants for 
						<?php
						
							include 'config.php';
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo $row['title'];
							}
							mysql_close($con);
						
						?> 
					</h3>	
				</div>
			</div>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<a href="#" onclick="acceptApp()" style="float: left;">Accept</a>
				<a href="http://localhost/corp/jobs/Specificjob.php" style="float: right;">Back to Job</a>
				<a href="#" onclick="rejectApp()" style="position: relative;left:200px;">Reject</a>
				<a href="#" onclick="interviewApp()" style="position: relative;left:380px;">Call for Interview</a>
			</div>
			<div id="body">
			
				<!-- Body Content Goes HERE -->
				<ul id="applicant">
					<?php
					
						include 'config.php';
						
						
						$result = mysql_query("SELECT * FROM application WHERE jid=".$jid);
						$json = array();
						$json['appid'] = array();
						$i = 0;
						while($row = mysql_fetch_array($result))
						{
							$json['appid'][$i] = $row['aid'];
							$i++; 
						}
						$appids = $json['appid'];
						
						
						$json['sid'] = array();
						$j = 0;
						for($i=0;$i<(count($appids));$i++)
						{
							$result = mysql_query("SELECT * FROM applicant WHERE aid=".$appids[$i]);
							while($row = mysql_fetch_array($result))
							{
								$json['sid'][$j] = $row['sid'];
								$j++; 
							}
						}
						
						
						$json['names'] = array();
						$j = 0;
						$sids = $json['sid'];
						
						for($i=0;$i<(count($sids));$i++)
						{
							$result = mysql_query("SELECT * FROM student WHERE sid=".$sids[$i]);
							while($row = mysql_fetch_array($result))
							{
								$json['names'][$j] = $row['name'];
								$j++; 
							}
						}
						
						
						$names = $json['names'];
						for($i=0;$i<(count($names));$i++)
						{
							echo '<li><div id="app;'.$jid.';'.$sids[$i].';'.$appids[$i].'"><input type="checkbox" class="check" />&nbsp;<label class="name">'.$names[$i].'</label><span class="applinks"><a href="http://localhost/corp/jobs/app.php?see=app&aid='.$appids[$i].'&jid='.$jid.'&sid='.$sids[$i].'">application</a>&nbsp;<a href="http://localhost/corp/jobs/app.php?see=resume&sid='.$sids[$i].'&jid='.$jid.'&aid='.$appids[$i].'">resume</a>&nbsp;<a href="http://localhost/corp/jobs/app.php?see=profile&sid='.$sids[$i].'&jid='.$jid.'&aid='.$appids[$i].'">profile</a></span></div>';
						}
						
						mysql_close($con);	
					
					?>
				
				</ul>
				
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