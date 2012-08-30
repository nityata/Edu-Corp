<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Enter Project Details</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="PHP/MySQL Contact Form with jQuery" />
        <meta name="keywords" content="contact form, php, mysql, jquery" />
        <link rel="stylesheet" href="css/filestyle.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="Ajaxfileupload-jquery-1.3.2.js" ></script>
		<script type="text/javascript" src="ajaxupload.3.5.js" ></script>
		<script type="text/javascript" >
			$(function(){
				var btnUpload=$('#me');
				var mestatus=$('#mestatus');
				new AjaxUpload(btnUpload, {
					action: 'uploadPhoto.php',
					name: 'uploadfile',
					onSubmit: function(file, ext){
						 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
		                    // extension is not allowed 
							mestatus.text('Only JPG, PNG or GIF files are allowed');
							return false;
						}
						
						mestatus.html('<img src="ajax-loader.gif" height="16" width="16">');
					},
					onComplete: function(file, response){
						//On completion clear the status
						mestatus.text('File Uploaded Sucessfully!');
						var files = document.getElementById("filesname").value + ";"+file;
						document.getElementById("filesname").value = files
						//On completion clear the status
						
					}
				});
				
			});
		</script>
        <style>
            a.back{
                width:184px;
                height:32px;
                position:absolute;
                bottom:10px;
                left:10px;
                /*background:transparent url('images/back.png') no-repeat top left;*/
               font-family:"Comic Sans MS";
            }
        </style>
    </head>
    <body>
        <div id="contact">
            <h1>Enter Project Details</h1>
            <form id="ContactForm" action="" enctype="multipart/form-data" method="post">
                <p>
                    <label>Title</label>
                    <input id="name" name="name" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Authors' names</label>
                    <input id="email" name="email" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Guide name</label>
                    <input id="website" name="website" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
                </p>
                <p>
                    <label>Duration of Project</label>
                    <input id="duration" name="duration" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
                    <span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Abstract</label>
                    <textarea id="message" name="message" class="inplaceError" cols="6" rows="5" autocomplete="off"></textarea>
					<span class="error" style="display:none;"></span>
                </p>
                
                 <p>
                    <label id="me" style=" cursor:pointer;">Upload File</label><span id="mestatus" style="position: relative; top: 11px;"></span>
                </p>
                
                <p class="submit">
                    <input id="send" type="button" value="Submit"/>
                    <span id="loader" class="loader" style="display:none;"></span>
					<span id="success_message" class="success"></span>
                </p>
                <!-- for newcontact put the id of student-->
				<input id="newcontact" name="newcontact" type="hidden" value="1"></input>
				<input id="filesname" name="filesname" type="hidden" value=""></input>
            </form>
        </div>
        <div class="envelope">
            <img id="envelope" src="images/envelope.png" alt="envelope" width="246" height="175" style="display:none;"/>
        </div>
        <div><a class="back" href="http://localhost/ss/projecthome.php">BACK TO PROJECTS</a></div>
        <!-- The JavaScript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="js/jquery.contact.js" type="text/javascript"></script>
    </body>
</html>