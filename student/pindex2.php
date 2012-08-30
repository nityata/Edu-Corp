<?php
	
	session_start();
	
	$sid = -1;
	$corp = false;
	$faculty = false;
	$csid = -1;
	$hname = "";
	$cid = -1;
	
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
	
	if(isset($_GET['csid']))
	{
		$csid = $_GET['csid'];
	}
	
	if(isset($_GET['see']))
	{
		if($_GET['see'] == "corp")
		{
			$corp = true;
			$cid = $_GET['cid'];
		}
		else if($_GET['see'] == "faculty")
		{
			$faculty = true;
		}
	}
	
	include 'config.php';
	$result = mysql_query("SELECT * FROM users WHERE uid=".$csid);
	while($row = mysql_fetch_array($result))
	  {
	  	$uemail = $row['email'];
	  	$ufname = $row['fname'];
	  	$uphoto = $row['photo'];
	  	$uabout = $row['about'];
	  	$uinstitution = $row['institution'];
	  }
	  
	$result = mysql_query("SELECT * FROM users WHERE uid=".$sid);
	while($row = mysql_fetch_array($result))
	  {
	  	
	  	$hname = $row['fname'];
	  }
	
	mysql_close($con);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PROJECTS PAGE</title>
		<script src="jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="pindex2.js"></script>
		<link rel="stylesheet" href="pindex.css" />
		<link rel="stylesheet" type="text/css" href="comments.css" />
		<!-- new add -->
		<link rel="stylesheet" href="css/menustyle.css" type="text/css" media="screen"/>
        <!--<link rel="stylesheet" href="css/searchstyle.css" type="text/css" media="screen"/> -->
        <link rel="stylesheet" href="css/navstyle.css" type="text/css" media="screen"/>
        <!--<link rel="stylesheet" type="text/css" href="css/style.css" /> -->
       	<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<!-- <link rel="stylesheet" type="text/css" href="css/styleforbar.css" /> -->
		<!--<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.codrops1.css" /> -->
		<!-- <script type="text/javascript" src="tinybox.js"></script> -->
		<!-- the mousewheel plugin -->
		<!--<script type="text/javascript" src="js/jquery.mousewheel.js"></script> -->
		<!-- the jScrollPane script -->
		<!--<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script> -->
		<link type="text/css" href="myjsp/jquery.jscrollpane.css" rel="stylesheet" media="all" />
		<script type="text/javascript" src="myjsp/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="myjsp/jquery.jscrollpane.min.js"></script>
		<!--<script type="text/javascript" src="js/scroll-startstop.events.jquery.js"></script> -->
		<!--<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic' rel='stylesheet' type='text/css' /> -->
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');
		</script>
	</head>
	<body>
		<input type="hidden" id="sidval"  value="<?php echo $sid;  ?>"/>
		<input type="hidden" id="csidval"  value="<?php echo $csid;  ?>"/>
		
		<div id="sidebar">
					<div id="person">
						<div id="photoFrame">
							<img src="./photos/<?php echo $uphoto; ?>" id="photo" />
						</div>
						<div id="roundedbox" onclick="editdesp(event)"><?php echo $uabout; ?></div>
						<textarea id="editbox" style="display:none;" onblur="savetext(this.value)"></textarea>
						<br/><div id="roundedbox"><table id="details"><tr><td>Name:</td><td><?php echo $ufname; ?></td></tr><tr><td>College:</td><td><?php echo $uinstitution; ?></td></tr><tr><td>Branch:</td><td>CSE</td></tr><tr><td>E-mail:</td><td><?php echo $uemail; ?></td></tr></table></div>
					<br/><br/></div>
					<div id="buttons">
						
						<div id="button"><a class="linkbtn" href="#">PROJECTS</a></div>
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
        
        	if(!$corp && !$faculty)
			{
        		if($csid == $sid)
				{
		?>
        <div id="top_navigation">
			<ul class="nav">
			<li><a href="./projectindex2.php"><u>Add Project</u></a></li>
			<li><a href="#">Edit project </a></li>
			<li><a href="#">Delete project </a></li>
			</ul>
		</div>
		<?php
				}
			}
		
		?>
        <div id="commentarea">
			<a href="#" onclick="hideComment()">X</a>
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
		</div>
		
		
		<div id="recoarea">
			<a href="#" onclick="hideReco()">X</a>
			<?php
				if($corp || $faculty)
				{
			?>
			<div id="addRecoContainer">
				<p>Add a Recommendation</p>
				<form id="addRecoForm" method="post" action="">
			    	<div>
			            <label for="recoText">Enter your recommendation here</label><br />
						<textarea name="recoText" id="recoText" cols="20" rows="5" value="">
						</textarea>
			            <input type="button" id="submit" value="Submit" onclick="recoSubmit()"/>
					</div>
    			</form>
    			<!--<span href="#" onclick="viewPrevComments()">View Previous Comments</span> -->
			</div>
			<?php
				}
			?>
		</div>
		<!--<div class="wrapper" id="plist">
				<div id="jp-container" class="jp-container"> -->
					<div id="projectslist" class="scroll-pane">
						<?php
							include 'config.php';
							
							$query = "SELECT * FROM project2 WHERE submitter=" . $csid;
							
							$result = mysql_query($query);
							
							if(!$result)
							{
								echo "";
							}
							else {
								$projects = '';
								while ($row = mysql_fetch_array($result)) {
									//$projects += '<div id="$row[pid]" onclick="showProject(event)"><p class="title">'. $row['title'] . '</p><p class="duration">' . $row['duration'] . ' months</p><p class="authors">' . $row['author'] . '</p></div>';
									//$projects = $projects .'<p class="newupdate" id="' . $row['pid'] . '"><div class="prj" id="'. $row['pid'].'" onclick="showProject(event)"><p class="title">TITLE: '. $row['title'] . '</p><p class="duration">DURATION: ' . $row['duration'] . ' months</p><p class="authors">AUTHORS: ' . $row['author'] . '</p></div></p><br />';
									$projects = $projects .'<div class="newupdate" id="'. $row['pid'].'" onclick="showProject(event)"><p class="title">TITLE: '. $row['title'] . '</p><p class="duration">DURATION: ' . $row['duration'] . ' months</p><p class="authors">AUTHORS: ' . $row['author'] . '</p></div>';
								}
								echo $projects;
								error_log(print_r($projects, TRUE), 0);
							}
							
							mysql_close($con);
						?>
					</div>
			<!--	</div>
				<div class="clr"></div>
		</div> -->
		<!--<script type="text/javascript">
			$(function() {
			
				// the element we want to apply the jScrollPane
				var $el					= $('#jp-container').jScrollPane({
					verticalGutter 	: -16
				}),
						
				// the extension functions and options 	
					extensionPlugin 	= {
						
						extPluginOpts	: {
							// speed for the fadeOut animation
							mouseLeaveFadeSpeed	: 500,
							// scrollbar fades out after hovertimeout_t milliseconds
							hovertimeout_t		: 1000,
							// if set to false, the scrollbar will be shown on mouseenter and hidden on mouseleave
							// if set to true, the same will happen, but the scrollbar will be also hidden on mouseenter after "hovertimeout_t" ms
							// also, it will be shown when we start to scroll and hidden when stopping
							useTimeout			: true,
							// the extension only applies for devices with width > deviceWidth
							deviceWidth			: 980
						},
						hovertimeout	: null, // timeout to hide the scrollbar
						isScrollbarHover: false,// true if the mouse is over the scrollbar
						elementtimeout	: null,	// avoids showing the scrollbar when moving from inside the element to outside, passing over the scrollbar
						isScrolling		: false,// true if scrolling
						addHoverFunc	: function() {
							
							// run only if the window has a width bigger than deviceWidth
							if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
							
							var instance		= this;
							
							// functions to show / hide the scrollbar
							$.fn.jspmouseenter 	= $.fn.show;
							$.fn.jspmouseleave 	= $.fn.fadeOut;
							
							// hide the jScrollPane vertical bar
							var $vBar			= this.getContentPane().siblings('.jspVerticalBar').hide();
							
							/*
							 * mouseenter / mouseleave events on the main element
							 * also scrollstart / scrollstop - @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
							 */
							$el.bind('mouseenter.jsp',function() {
								
								// show the scrollbar
								$vBar.stop( true, true ).jspmouseenter();
								
								if( !instance.extPluginOpts.useTimeout ) return false;
								
								// hide the scrollbar after hovertimeout_t ms
								clearTimeout( instance.hovertimeout );
								instance.hovertimeout 	= setTimeout(function() {
									// if scrolling at the moment don't hide it
									if( !instance.isScrolling )
										$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
								}, instance.extPluginOpts.hovertimeout_t );
								
								
							}).bind('mouseleave.jsp',function() {
								
								// hide the scrollbar
								if( !instance.extPluginOpts.useTimeout )
									$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
								else {
								clearTimeout( instance.elementtimeout );
								if( !instance.isScrolling )
										$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
								}
								
							});
							
							if( this.extPluginOpts.useTimeout ) {
								
								$el.bind('scrollstart.jsp', function() {
								
									// when scrolling show the scrollbar
								clearTimeout( instance.hovertimeout );
								instance.isScrolling	= true;
								$vBar.stop( true, true ).jspmouseenter();
								
							}).bind('scrollstop.jsp', function() {
								
									// when stop scrolling hide the scrollbar (if not hovering it at the moment)
								clearTimeout( instance.hovertimeout );
								instance.isScrolling	= false;
								instance.hovertimeout 	= setTimeout(function() {
									if( !instance.isScrollbarHover )
											$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
									}, instance.extPluginOpts.hovertimeout_t );
								
							});
							
								// wrap the scrollbar
								// we need this to be able to add the mouseenter / mouseleave events to the scrollbar
							var $vBarWrapper	= $('<div/>').css({
								position	: 'absolute',
								left		: $vBar.css('left'),
								top			: $vBar.css('top'),
								right		: $vBar.css('right'),
								bottom		: $vBar.css('bottom'),
								width		: $vBar.width(),
								height		: $vBar.height()
							}).bind('mouseenter.jsp',function() {
								
								clearTimeout( instance.hovertimeout );
								clearTimeout( instance.elementtimeout );
								
								instance.isScrollbarHover	= true;
								
									// show the scrollbar after 100 ms.
									// avoids showing the scrollbar when moving from inside the element to outside, passing over the scrollbar								
								instance.elementtimeout	= setTimeout(function() {
									$vBar.stop( true, true ).jspmouseenter();
								}, 100 );	
								
							}).bind('mouseleave.jsp',function() {
								
									// hide the scrollbar after hovertimeout_t
								clearTimeout( instance.hovertimeout );
								instance.isScrollbarHover	= false;
								instance.hovertimeout = setTimeout(function() {
										// if scrolling at the moment don't hide it
									if( !instance.isScrolling )
											$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
									}, instance.extPluginOpts.hovertimeout_t );
								
							});
							
							$vBar.wrap( $vBarWrapper );
							
						}
						
						}
						
					},
					
					// the jScrollPane instance
					jspapi 			= $el.data('jsp');
					
				// extend the jScollPane by merging	
				$.extend( true, jspapi, extensionPlugin );
				jspapi.addHoverFunc();
			
			});
		
		</script> -->
	</body>
</html>