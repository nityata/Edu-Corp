$(document).ready(
	function()
	{
		if(document.getElementById("cid"))
		{
			console.log("cid value is : " + document.getElementById("cid").value)
			cid = document.getElementById("cid").value;
		} 	
		if(document.getElementById("aaid"))
		{
			aaid = document.getElementById("aaid").value;
		}
		
		content = document.getElementById("commentarea").innerHTML;
		fillComments();
	}
);

function fillComments()
{
	xhr2 = new XMLHttpRequest();
   	xhr2.onreadystatechange = fillComment;
   	xhr2.open("GET","./appC.php?aaid=" + aaid,true);
   	xhr2.send(null);
}

function fillComment()
{
	if(xhr2.readyState == 4 && xhr2.status == 200)
	{
		if(xhr2.responseText == "failed")
		{
			alert("Couldn't fetch comments");
		}
		else
		{
			var i = 0;
			var JSONtext = xhr2.responseText;
			// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
			
			console.log("JSONText : " + JSONtext);
			
			var comment = JSONobject.comment;
			
			console.log("comment : " + comment);
			var cdate = JSONobject.cdate;
			//var cname = JSONobject.cname;
			var comments = '';
						
			for(i =0; i< comment.length; i++)
			{
				/*
				 * make comment div visible
				 * fill in comments in comment div
				 */
				comments += '<div class="comment"><div class="date">' + cdate[i] + '</div><p class="comments">' + comment[i] + '</p></div>'
			}
			
			
			$('#commentarea').slideDown('slow', function() {
			    // Animation complete.
			    document.getElementById("commentarea").style.display = "block";
			  });
			document.getElementById("commentarea").innerHTML = content + comments;
		}
	}
}

function commentSubmit() {
	
  	var form = document.getElementById("addCommentForm");
	comment = form['commentText'].value.trim();
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	see = "";
	
	if(document.getElementById("see"))
	{
		see = document.getElementById("see").value;
	}
	if(see == "student")
	{
		var con = "student";
		if(document.getElementById("ssid"))
		{
			ssid = document.getElementById("ssid").value;
		}
		var param = "aaid="+aaid+"&comment="+comment+"&cid="+ssid+"&con="+con
	}
	else
	{
		var con = "corp";
		var param = "aaid="+aaid+"&comment="+comment+"&cid="+cid+"&con="+con
	}
	
	console.log("param : " + param)
	
	xhr = new XMLHttpRequest();
			
	if(xhr)
	{
				
		try
		{
			xhr.onreadystatechange = submitcomment;
			xhr.open("POST","./appcomments.php",true);
			xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			//post req - set req header
			xhr.send(param);
		}
		catch(err)
		{
			alert("ajax error: " + err);
			return;
		}
	}
}

function submitcomment () {
  if(xhr.readyState == 4 && xhr.status == 200)
  {
  	console.log("response text : " + xhr.responseText)
  	if(xhr.responseText == "success")
				{
					var com = '<div class="comment"><div class="date">' + date + '</div><p class="comments">'+comment+'</p></div>';
					//window.location.reload();
					$('#commentarea').append(com);
					$('#commentarea').find(".comment:last").slideDown("fast");
				}
				else
				{
					alert("Couldn't submit comment. please try later");
				}
  }
}