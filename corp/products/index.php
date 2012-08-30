<?php
	// cid is either got by get variable or is stored after logging in , in the session variable.
	session_start();
	$cid = -1;
	$external = false;
	
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
		
		if($_GET['see'] == "external")
		{
			$external = true;
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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PRODUCTS</title>
		<script src="product.js"></script>
		<link rel="stylesheet" href="product.css" />
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
		<style type="text/css" media="screen">
		
			
			body{
				background-color: #000;
				position:relative;
				left:110px;
			}
			
			/* Center the website */
			#wrapper{
				width:920px;
				margin:0 auto;
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
			#header h1{
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
			#body ul
			{
				font-family:"Courier New";
			}
			
			#body ul li
			{
				padding:5px;
			}
			
			a
			{
				text-decoration:none;
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
						<?php if(!$external)
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
                    <?php if(!$external){ ?><a href="http://localhost/corp/jobs/index.php"><?php }else {
                        ?>
                        <a href="http://localhost/student/index.php">
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
		<div id="wrapper">
			<div id="header">
				<div>
					<h1>Products for the year 2012</h1>	
				</div>	
			</div>
			<div id="body">
				<ul>
				<?php
							include 'config.php';
							//add where clause for summer, fal etc.
							$result = mysql_query("SELECT * FROM products WHERE cid=".$cid);
							while($row = mysql_fetch_array($result))
							{
								if ($external) {
									echo '<li><a href="./SpecificProduct.php?prid='.$row['prdid'].'&see=student">'.$row['name'].'</a></li>';
								}
								else {
									echo '<li><a href="./SpecificProduct.php?prid='.$row['prdid'].'">'.$row['name'].'</a><a onclick="deleteProduct(event,'.$row['prdid'].')" class="del" style="position:absolute;left:1020px;cursor:pointer;">delete</a></li>';	
								}
								
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