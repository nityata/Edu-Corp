<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
	<head>
		<title>JOBS PAGE</title>
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
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/style4.css" />
		<link rel="stylesheet" type="text/css" href="css/form.css" />
		<link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css' />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				
				<!-- Div is for Shadow Overlay-->
				<div>
					<h1>Openings for Summer 2012</h1>	
				</div>	
			</div>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<a href="#application" style="float: left;">Add New Opening</a>
				<a href="#edit" style="float: right;">View Older Openings</a>
			</div>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<div id="home" class="content">
					<ul>
						<li><a href="http://localhost/corp/jobs/job2.php">SUMMER INTERNSHIP AT ADOBE LABS</a><a href="#" class="del">delete</a></li>
						<li><a href="http://localhost/corp/jobs/job2.php">RESEARCH PROJECT AT ADOBE INDIA</a><a href="#" class="del">delete</a></li>
					</ul>
				</div>
				<div id="application" class="panel">
					<div class="content">
						<div class="registration">
							 <form>
							 	<table>
								 <tr>
								 	<td>
									 <label>Abstract</label>
									 </td>
									 <td class="info">
									 <textarea rows="5" cols="60">
									 </textarea>
									 </td>
									 <td>
									 <p class="error"><span>Some text here</span></p>
									</td>
								 </tr>
								 <tr>
								 	<td>
									 <label>Deadline</label>
									 </td>
									 <td class="info">
									 <input type="date" />
									 </td>
									 <td>
									 <p class="error"><span></span></p>
									</td>
								 </tr>
								 <tr>
								 	<td>
									 <label>Prerequisite Knowledge</label>
									 </td>
									 <td class="info">
									 <textarea rows="2" cols="60"></textarea>
									 </td>
									 <td>
									 <p class="error"><span>Some text here</span></p>
								    </td>
								 </tr>
								 <tr>
								 	<td>
									 <label>Tags</label>
									 </td>
									 <td class="info">
									 <textarea rows="2" cols="60"></textarea>
									 </td>
									 <td>
									 <p class="error"><span>Enter tag and comma</span></p>
									</td>
								 </tr>
							 </table>
							 
							 <div class="register_button"><span><a href="#">ADD OPENING</a></span></div>
							 
							 
							 </form>
						</div>
						<a href="#home" id="back">BACK TO LIST</a>
					</div>
				</div>
				
				<div id="edit" class="panel">
					<div class="content">
						<p class="appl">Implementation details: I want to implement it as follows.I want to implement it as follows.I want to implement it as follows.I want to implement it as follows.I want to implement it as follows.I want to implement it as follows.I want to implement it as follows.I want to implement it as followsI want to implement it as follows</p>
						<a href="#home" id="back">BACK TO LIST</a>
					</div>
				</div>
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