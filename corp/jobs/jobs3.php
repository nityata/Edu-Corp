<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
	<head>
		<title>JOBS PAGE</title>
		<script type="text/javascript">
			function deleteJob(event,delElem)
			{
				delLi = event.target.parentNode;
				ul = event.target.parentNode.parentNode;
				//alert("delElem: "+delElem);
				var del = confirm("Are you sure you want to delete the job?");
				if(del == true)
				{
					// make an ajax call
					xhr = new XMLHttpRequest();
					xhr.onreadystatechange = deleteItem;
					xhr.open("GET","http://localhost/corp/jobs/del.php?jid="+delElem,true);
					xhr.send();
				}
			}
			
			
			function deleteItem()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					if(xhr.responseText == "success")
					{
						ul.removeChild(delLi);
					}
					else
					{
						alert("Couldn't delete job. Try after a while."); 
					}
				}
			}
			
			function addJob()
			{
				title = document.getElementById("title").value;
				title = title.trim();
				abs = document.getElementById("abs").value;
				abs = abs.trim();
				dl = document.getElementById("dl").value;
				dl = dl.trim();
				preR = document.getElementById("preR").value;
				preR = preR.trim();
				tg = document.getElementById("tg").value;
				tg = tg.trim();
				
				if(title != "" && abs != "")
				{
					
					xhr2 = new XMLHttpRequest();
					xhr2.onreadystatechange = insertItem;
					xhr2.open("POST","http://localhost/corp/jobs/insert.php",true);
					xhr2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					xhr2.send("title="+title+"&abs=" + abs+"&dl="+dl+"&preR="+preR+"&tg="+tg);
				}
				else
				{
					alert("fill in title and abstract");
					document.getElementById("title").value = "";
					document.getElementById("abs").value = "";
					document.getElementById("dl").value = "";
					document.getElementById("preR").value = "";
					document.getElementById("tg").value = "";
				}
				//alert(abs);
			}
			
			
			function insertItem()
			{
				if(xhr2.readyState == 4 && xhr2.status == 200)
				{
					if(xhr2.responseText == "success")
					{
						alert("Job added");
						//var listJob = document.getElementById("listJob");
						//var li = '<li><a href="http://localhost/corp/jobs/job2.php?jid=">'
					}
					else
					{
						 alert("Job couldn't be added");
					}
				}
			}
			
			function viewOld()
			{
				//make ajax call and retrieve all records from previous season
				xhr3 = new XMLHttpRequest();
				xhr3.onreadystatechange = oldItems;
				xhr3.open("GET","http://localhost/corp/jobs/old.php",true);
				xhr3.send();
			}
			
			function oldItems()
			{
				if(xhr3.readyState == 4 && xhr3.status == 200)
				{
					if(xhr3.responseText == "failed")
					{
						alert("Old Jobs couldn't be fetched. Try again after sometime.");
						//var listJob = document.getElementById("listJob");
						//var li = '<li><a href="http://localhost/corp/jobs/job2.php?jid=">'
					}
					else
					{
						 var JSONtext = xhr3.responseText;
						// convert received string to JavaScript object
						 var JSONobject = JSON.parse(JSONtext);
						 
						 var titles = JSONobject.title;
						 var jids = JSONobject.jid;
						 
						 var oldList = document.getElementById("listOld");
						 
						 var i = 0;
						 var lis = '';
						 
						 for(i=0;i<titles.length;i++)
						 {
						 	//populate the ul and give the title a link
						 	lis = lis + '<li><a href="http://localhost/corp/jobs/Fjob2.php?jid='+jids[i]+'">'+titles[i]+'</a><a onclick="deleteJob(event,'+jids[i]+')" class="del" style="position:relative;left:650px;cursor:pointer;">delete</a></li>';
						 	//oldList.appendChild(lis);
						 	//msg = "Title: "+titles[i] + ", JID: "+jids[i];
						 	//alert(msg);
						 }
					 	 oldList.innerHTML = lis;
						// notice how variables are used
						 //var msg = "Title: "+JSONobject.title[0] + ", JID: "+JSONobject.jid[0];
					 
						 //alert(msg);
					}
				}
			}
		</script>
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
				<a href="#edit" onclick="viewOld()" style="float: right;">View Older Openings</a>
			</div>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<div id="home" class="content">
					<ul id="listJob">
						<?php
							include 'config.php';
							//add where clause for summer, fal etc.
							$result = mysql_query("SELECT * FROM job");
							while($row = mysql_fetch_array($result))
							{
								echo '<li><a href="http://localhost/corp/jobs/Fjob2.php?jid='.$row['jid'].'">'.$row['title'].'</a><a onclick="deleteJob(event,'.$row['jid'].')" class="del" style="position:absolute;left:1020px;cursor:pointer;">delete</a></li>';
							}
							mysql_close($con);
						?>
					</ul>
				</div>
				<div id="application" class="panel">
					<div class="content">
						<div class="registration">
							 <form>
							 	<table>
							 	<tr>
							 		 <td>
									 <label>Title</label>
									 </td>
									 <td class="info">
									 <textarea id="title" rows="1" cols="60">
									 </textarea>
									 </td>
							 	</tr>
								 <tr>
								 	 <td>
									 <label>Abstract</label>
									 </td>
									 <td class="info">
									 <textarea id="abs" rows="5" cols="60">
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
									 <input id="dl" type="datetime" />
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
									 <textarea id="preR" rows="2" cols="60"></textarea>
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
									 <textarea id="tg" rows="2" cols="60"></textarea>
									 </td>
									 <td>
									 <p class="error"><span>Enter tag and comma</span></p>
									</td>
								 </tr>
							 </table>
							 
							 <div class="register_button"><span><a href="#" onclick="addJob()">ADD OPENING</a></span></div>
							 
							 
							 </form>
						</div>
						<a href="#home" id="back">BACK TO LIST</a>
					</div>
				</div>
				
				<div id="edit" class="panel">
					<div class="content">
						<ul id="listOld">
							
						</ul>
						<a href="#home" id="bk">BACK TO LIST</a>
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