<?php

	session_start();
	
	$jid = -1;
	$applicant = false;
	$student = false;
	$external = false;
	$studentExt = false;
	$intern = false;
	$sid = -1;
	$wsid = -1;
	$cid = -1;
	// store session data
	
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
	}
	if(isset($_GET['see']))
	{
		//make the inline-editable divs non-inline editable
		// make edit n delete openings disappear
		//make the upload file in docs disappear
		// make the accept, reject, call for interview disappear
		// make the checkboxes also disppear
		if($_GET['see'] == "applicant")
		{
			$applicant = true;
		}
		else if($_GET['see'] == "student")
		{
			$student = true;
			$sid = $_GET['sid'];
			$wsid = $_GET['wsid'];
		}
		else if($_GET['see'] == "studentExt")
		{
			$studentExt = true;
			$sid = $_GET['sid'];
		}
		else if($_GET['see'] == "intern")
		{
			$intern = true;
			$sid = $_GET['sid'];
		}
		else if($_GET['see'] == "external")
		{
			$external = true;
		}
	}
	
	include 'config.php';
	
	
	$query = "Select * from job Where jid=".$jid;
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result)) {
		$cid = $row['cid'];
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

if($student || $intern || $studentExt)
{
	include 'config.php';
	$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
	while($row = mysql_fetch_array($result))
	  {
	  	$hname = $row['fname'];
	  }
	
	mysql_close($con);
}

else if(!$student && !$studentExt && !$external && !$intern && !$applicant){
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
		<title>JOBS PAGE</title>
		<script src="jquery-1.4.2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="comments.css" />
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
		<script src="sjob.js"></script>
		 <script type="text/javascript" src="Ajaxfileupload-jquery-1.3.2.js" ></script>
		<script type="text/javascript" src="ajaxupload.3.5.js" ></script>
		<script type="text/javascript" >
			
			$(function(){
				var jid = $('#jid').val();
				var btnUpload=$('#me');
				var mestatus=$('#mestatus');
				new AjaxUpload(btnUpload, {
					action: 'uploadPhoto.php?jid='+jid,
					name: 'uploadfile',
					onSubmit: function(file, ext){
						 if (! (ext && /^(jpg|png|jpeg|gif|pptx|pdf|docx)$/.test(ext))){ 
		                    // extension is not allowed 
							mestatus.text('Only JPG, PNG or GIF files are allowed');
							return false;
						}
						
						mestatus.html('<img src="ajax-loader.gif" height="16" width="16">');
					},
					onComplete: function(file, response){
						//On completion clear the status
						mestatus.text('File Uploaded Sucessfully!');
						
						
						//alert(response);
						
						if(response == file)
						{
							var ul = document.getElementById("doc");
							var old = ul.innerHTML;
							ul.innerHTML = old + '<li><a href="http://localhost/upload/' + file + '" class="docItem" target="_blank">' + file + '</a></li>';
						}
						//On completion clear the status
						mestatus.text('');
					}
				});
				
			});
			
			
			$(function(){
				var btnUpload=$('#me2');
				var mestatus=$('#mestatus2');
				new AjaxUpload(btnUpload, {
					action: 'uploadFile.php',
					name: 'uploadfile',
					onSubmit: function(file, ext){
						 if (! (ext && /^(jpg|png|jpeg|gif|pptx|pdf|docx)$/.test(ext))){ 
		                    // extension is not allowed 
							mestatus.text('Only JPG, PNG or GIF files are allowed');
							return false;
						}
						
						mestatus.html('<img src="ajax-loader.gif" height="16" width="16">');
					},
					onComplete: function(file, response){
						//On completion clear the status
						mestatus.text('File Uploaded Sucessfully!');
						
						
						//alert(response);
						
						if(response == file)
						{
							var ul = document.getElementById("AppDocs");
							var old = ul.innerHTML;
							ul.innerHTML = old + '<li><a href="http://localhost/upload/' + file + '" target="_blank">' + file + '</a></li>';
						}
						//On completion clear the status
						mestatus.text('');
					}
				});
				
			});
			
		</script>
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
			
			function viewDocs()
			{
				var jid = document.getElementById("jid").value;
				xhr2 = new XMLHttpRequest();
				xhr2.onreadystatechange = docsView;
				xhr2.open("GET","http://localhost/corp/jobs/docs.php?jid="+jid,true);
				xhr2.send();
			}
			
			function docsView()
			{
				if(xhr2.readyState == 4 && xhr2.status == 200)
				{
					if(xhr2.responseText == "failed")
					{
						alert("Docs couldn't be fetched. Try again after sometime.");
						//var listJob = document.getElementById("listJob");
						//var li = '<li><a href="http://localhost/corp/jobs/job2.php?jid=">'
					}
					else
					{
						
						 var JSONtext = xhr2.responseText;
						// convert received string to JavaScript object
						 var JSONobject = JSON.parse(JSONtext);
						 
						 var docs = JSONobject.docs;
						
						 
						 var docList = document.getElementById("doc");
						 
						 var i = 0;
						 var lis = '';
						 
						 for(i=0;i<docs.length;i++)
						 {
						 	//populate the ul and give the title a link
						 	lis = lis + '<li><a href="../../upload/' + docs[i] +'" style="color:black;font-weight:bold;">'+docs[i]+'</a></li>';
						 	//docList.appendChild(lis);
						 	//msg = "Title: "+titles[i] + ", JID: "+jids[i];
						 	//alert(msg);
						 }
					 	 docList.innerHTML = lis;
					 	 
					 	 //alert("Docs have been Fetched");
						// notice how variables are used
						 //var msg = "Title: "+JSONobject.title[0] + ", JID: "+JSONobject.jid[0];
					 
						 //alert(msg);
					}
				}
			}
			
			function applicationSubmit()
			{
				//alert(document.getElementById("sid").value);
				//alert(document.getElementById("jid").value);
				// call function to fill into applicant and application tables
				var jid = document.getElementById("jid").value;
				console.log("jid : " + jid);
				var sid = document.getElementById("sid").value;
				console.log("sid : " + sid);
				var abs = document.getElementById("application").value;
				console.log("abs : " + abs);
				
				
				xhr3 = new XMLHttpRequest();
				xhr3.onreadystatechange = appSubmit;
				xhr3.open("POST","http://localhost/corp/jobs/appsubmit.php",true);
				xhr3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhr3.send("jid=" + jid + "&sid=" + sid + "&abs=" + abs);
			}
			
			
			function appSubmit()
			{
				if(xhr3.readyState == 4 && xhr3.status == 200)
				{
					if(xhr3.responseText == "failed")
					{
						alert("Application couldn't be submitted. Try again after sometime.");
					}
					else
					{
						alert("Application submitted");
					}
				}
			}
			
			
			function editdesp(event)
		{
			thisbox = event.target;
			content=thisbox.innerHTML;
			editbox.value=content;
			editbox = document.getElementById("editbox");
			thisbox.style.display="none";
			editbox.style.display="inline";
		}
		function savetext(text)
		{
			
			document.getElementById("editbox").style.display="none";
			var jid = document.getElementById("jid").value;
			thisbox.style.display="block";	
			var xhr5;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xhr5=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xhr5=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhr5.onreadystatechange=function()
			  {
			  if (xhr5.readyState==4 && xhr5.status==200)
				{
			
					thisbox.innerHTML=text;
					//alert=xhr3.responseText;
				}
			  }
		xhr5.open("GET","./edit_about.php?id="+jid+"&text="+text,true);
		xhr5.send();
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
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/style7.css" />
		<link rel="stylesheet" type="text/css" href="css/form.css" />
		<link rel="stylesheet" type="text/css" href="css/doc.css" />
		<link rel="stylesheet" type="text/css" href="css/appform.css" />
		<link rel="stylesheet" href="css/sjob.css" />
		<link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css' />
	</head>
	<body>
		<?php
		
			if($student || $intern || $applicant || $studentExt || $external)
			{
		
		?>
		
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
						<?php if(!$student) {  ?><br/><div id="roundedbox"><table id="details"><tr><td>Name:</td><td><?php echo $ufname; ?></td></tr><tr><td>E-mail:</td><td><?php echo $uemail; ?></td></tr><tr><td>TAGS: </td></td><td><?php echo $tags; ?></td></tr></table></div> <?php  } ?>
					<br/><br/></div>
					<div id="buttons">
						
						<div id="button"><a class="linkbtn" href="#" onclick="showJobs()">JOBS</a></div>	
						<div id="button"><a class="linkbtn" href="#">PRODUCTS</a></div>
					</div>
		</div>
		<div class="container">
        	<?php if($student || $intern || $studentExt){  ?><p id="welcs">Welcome <?php echo $hname; ?></p><?php } ?>
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
                    <a href="http://localhost/student/index.php">
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
		
		<?php
		
			}
			else {
				?>
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
						
						<div id="button"><a class="linkbtn" href="http://localhost/corp/jobs/Alljobs.php">JOBS</a></div>	
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
				<?php
			}
		
		?>
		<input type="hidden" id="cidval" value="<?php echo $cid;  ?>" />
		<div id="wrapper">
			<div id="header">
				
				<!-- Div is for Shadow Overlay-->
				<div>
					<h3>
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
			<?php
					if(!$applicant && !$external)
					{
			?>
			<div id="nav">
				<!-- Navigation Goes HERE -->
				<?php
					if(!$student && !$studentExt && !$intern)
					{
				?>
				<a href="#" style="float: left;">Edit Opening</a>
				<a href="#" onclick="deleteJob()" style="float: right;">Delete Opening</a>
				<a href="#app" onclick="viewDocs()" style="position: relative;left:200px;">Docs</a>
				<a href="http://localhost/corp/jobs/applicants.php" style="position: relative;left:380px;">View Applicants</a>
				<?php
					}
					else if($student || $studentExt)
					{
				?>
				<input type="hidden" id="sid" name="sid" value="<?php echo $sid; ?>" />
				<input type="hidden" id="wsid" name="sid" value="<?php echo $wsid; ?>" />
				<a href="#apply">Apply</a>
				<!-- <a href="http://localhost/student/index.php">Back to home</a> -->
				<!-- <input type="hidden" id="sid" name="sid" value="<?php echo $sid; ?>" /> -->
				
				<?php
					}
					if($studentExt)
					{
				?>
				
					<a href="http://localhost/corp/jobs/index.php?see=student&sid=<?php echo $sid; ?>" style="float: right;position: relative;left: -400px;">Back to corporate home</a>
				<?php
					}
					if ($intern || $student) {
						?>
					<a href="#comm" onclick="viewwork('<?php echo $sid; ?>','<?php echo $jid;  ?>')" style="float: right;">View Work</a>
					
				<?php	
					}
					if ($studentExt) {
				?>
					<a href="#interns" onclick="fillInts('<?php echo $jid;  ?>')" style="float: right;">View Work</a>
				<?php
					}
					if($intern)
					{
				?>
				<p>WELCOME INTERN!</p>	
				<?php
					}
				?>
			</div>
			<?php
					}
			?>
			<div id="body">
				<!-- Body Content Goes HERE -->
				<!--<ul></ul>-->
					<div id="home" class="content">
				<div id="left">
					<div id="abstract">
						<p class="heads">ABSTRACT</p>
						<?php
							echo '<input type="hidden" id="jid" value="'.$jid.'" />';
							include 'config.php';
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								if(!$student && !$studentExt && !$external && !$intern && !$applicant)
								{
									echo '<p class="jobInfo" onclick="editdesp(event)">'.$row['abstract'].'</p>';
									echo '<textarea id="editbox" style="display:none;" onblur="savetext(this.value)"></textarea>';
								}
								else
									echo '<p class="jobInfo">'.$row['abstract'].'</p>';
								//echo '<input type="hidden" id="jid" value="'.$jid.'" />';
							}
							mysql_close($con);
						?>
					</div>
					<div id="prerequisite">
						<label class="heads">PRE-REQUISITE</label>
						<?php
							include 'config.php';
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="prer">'.$row['prerequisite'].'</p>';
							}
							mysql_close($con);
						?>
					</div>
				</div>
				<div id="right">
					<div id="deadline">
						<p class="heads">DEADLINE</p>
						<?php
							include 'config.php';
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								echo '<p class="jobInfo">'.$row['deadline'].'</p>';
							}
							mysql_close($con);
						?>
					</div>
					<div id="tags">
						<p class="heads">TAGS</p>
						<?php
							include 'config.php';
							$result = mysql_query("SELECT * FROM job WHERE jid=".$jid);
							while($row = mysql_fetch_array($result))
							{
								if(!$student && !$studentExt && !$external && !$intern && !$applicant)
								{
									echo '<p class="jobInfo" onclick="editdesp2(event)">'.$row['tags'].'</p>';
									echo '<textarea id="editbox2" style="display:none;" onblur="savetext(this.value)"></textarea>';
								}
								else
									echo '<p class="jobInfo">'.$row['tags'].'</p>';
							}
							mysql_close($con);
						?>
					</div>
				</div>
				<!-- body gets over -->
				</div>
				
				<div id="app" class="panel">
					<div class="content">
						<ul id="doc">
						</ul>
						<form id="uploadForm" action="" enctype="multipart/form-data" method="post">
							<p>
			                    <label id="me" style=" cursor:pointer;">UPLOAD FILE</label><span id="mestatus" style="position: relative; top: 11px;"></span>
			               </p>
						</form>
						<a href="#home" id="bkk">BACK TO JOB</a>
					</div>
				</div>
				
				
				<div id="apply" class="panel">
					<div class="content">
						<form id="uploadForm2" action="" enctype="multipart/form-data" method="post">
							<p>
								<label id="applabel" for="application">ABSTRACT FOR APPLICATION</label>
								<textarea id="application" name="application" rows="10" cols="50"></textarea>
							</p>
							<p>
			                    <label id="me2" style=" cursor:pointer;">UPLOAD FILE</label><span id="mestatus2"></span>
			               </p>
			   			   <p class="apply_button"><a href="#" onclick="applicationSubmit()">SUBMIT</a></p>
						</form>
						
						<ul id="AppDocs"></ul>
						
						<a href="#home" id="backlink">BACK TO JOB</a>
					</div>
				</div>
				
				<div id="interns" class="panel">
					<div class="content">
						<ul id="internList">
							
						</ul>
						<a href="#home" style="position: relative;top:150px;left: 400px;" >BACK TO LIST</a>
					</div>
				</div>
				
				<div id="comm" class="panel">
					<div class="content">
						<div id="percent"></div>
						<div id="work"></div>
						<div id="todo"></div>
						<div id="commentarea">
							<?php
								if($intern)
								{
							?>
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
							<?php
								}
							?>
						</div>
						<a href="#home" id="bkk2">BACK TO JOB</a>
					</div>
				</div>
				
			</div>
			<?php
				if(!$applicant && !$student && !$studentExt && !$intern && !$external)
				{
			?>
			<!--<a id="bck" href="http://localhost/corp/jobs/Alljobs.php">BACK TO JOBS</a> -->
			<?php
				}
			?>
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			function fillInts(jid)
			{
				//alert("fill ints clicked")
				ijid = jid;
				cid = document.getElementById("cidval").value;
				xhr4 = new XMLHttpRequest();
				xhr4.onreadystatechange = internList;
				xhr4.open("GET","./internlist.php?jid=" + jid,true)
				xhr4.send(null)
			}
			
			function internList()
			{
				if(xhr4.readyState == 4 && xhr4.status == 200)
				{
					if(xhr4.responseText == "failed")
					{
						alert("intern list could not be fetched")
					}
					else
					{
						// populate
						var il = document.getElementById("internList");
						var JSONtext = xhr4.responseText;
									// convert received string to JavaScript object
						var JSONobject = JSON.parse(JSONtext);
						var aids = JSONobject.aid;
						var iids = JSONobject.iid;
						var sids = JSONobject.sid;
						var anames = JSONobject.aname;
						
						var i = 0;
						var li = '<h4>INTERNS</h4>';
						for(i = 0 ; i < aids.length; i++)
						{
							li += '<li><a href="#comm" onclick="viewwork(' + sids[i] + ', ' + ijid + ')">' + anames[i] + '</a></li>';
						}
						il.innerHTML = li;
						console.log("li : " + li)
					}
				}
			}
		</script>	
	</body>
	

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