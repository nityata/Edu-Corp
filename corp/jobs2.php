<!DOCTYPE html>
<html lang="en">
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
				text-align:center;
			}
			#nav a
			{
				vertical-align:middle;
				font-family:"Comic Sans MS";
				text-decoration:underline;
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
					<h1>Openings for Summer 2012</h1>	
				</div>	
			</div>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<a href="#">Add New Opening</a>
			</div>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<ul>
					<li><a href="#"><div class="listitem">SUMMER INTERNSHIP AT ADOBE LABS</div></a><a href="#"><div class="del">delete</div></a></li>
					<li><a href="#"><div class="listitem">RESEARCH PROJECT AT ADOBE INDIA</div></a><a href="#"><div class="del">delete</div></a></li>
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