<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JOB OPENINGS</title>
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/jobstyle.css" />
        <script type="text/javascript" src="js/banner1.js"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript" src="js/modernizr.custom.41769.js"></script>
	</head>
	<body>
        <div class="container">
            <div id="wrapper" class="wrapper">
                <canvas id="canvas-banner" class="inactive">
                    <img src="images/fallback1.png" />
                </canvas>
            </div>			
        </div>
		<script type="text/javascript">
			
			if(Modernizr.canvas) {
			
				var wrapper = document.getElementById('wrapper'),
					loading	= document.createElement('div');
				
				loading.className = 'loading';
				loading.setAttribute('id','loading');
				loading.innerHTML = 'Loading...';

				wrapper.appendChild(loading);
			
				google.load('webfont','1');
				google.setOnLoadCallback(function() {
					WebFont.load({
						google: {
							families: ['Jockey One']
						},
						active: function() {
							setTimeout(function() {
								
								loading.style.display = 'none';
								
								var banner = new Banner();
								banner.initialize('canvas-banner');
								
								document.getElementById('font').style.display = 'block';
							
							}, 1000);
						},
						inactive: function() {
							
							// google font not loaded, we will use the default font : Arial (set in baner.js file)
							loading.style.display = 'none';
							
							var banner = new Banner();
							banner.initialize('canvas-banner');
							
						}
					});
				});
			
			}
			
        </script>
    </body>
</html>