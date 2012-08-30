$(document).ready(
	function()
	{
		content = document.getElementById("commentarea").innerHTML; 
	}
);


function showProject(event)
{ 
	 sid = $("#sidval").val();
	 id=event.target.id || event.currentTarget.id;
   	 //alert("ID:"+id); 
   	
   	 var elem = event.currentTarget;
   	 //elem.click(function() { return false; });
   	 elem.onclick="return false;"
   	 
   	 xhr = new XMLHttpRequest();
   	 xhr.onreadystatechange = fillProject;
   	 xhr.open("GET","./pdetail.php?sid="+sid + "&pid=" + id ,true);
   	 xhr.send(null);
   	 //event.currentTarget.innerHTML = "wassup";
   	 nodeToFill = event.currentTarget;
   	 nodeContent = event.currentTarget.innerHTML;
}

function fillProject()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failed")
		{
			alert("Couldn't fetch details");
		}
		else
		{
			var i = 0;
			var JSONtext = xhr.responseText;
			// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
			
			var guide = JSONobject.guide;
			var files = JSONobject.files;
			var pabs = 	JSONobject.pabstract;
			cname = JSONobject.Cname;
			
			for(i =0; i<guide.length; i++)
			{
				var fileList = files[i].split(";")
				var fnode = ''
				var j = 0
				
				for(j = 1; j < fileList.length; j++)
				{
					fnode = fnode + '<a href="http://localhost/upload/' + fileList[j] +'">' + fileList[j] + '</a>&nbsp;'
				}
				
				nodeToFill.innerHTML = nodeContent + '<p class="abs">ABSTRACT: ' + pabs[i] + '</p><p class="guide">GUIDE: ' + guide[i] + '</p><p class="files">FILES: ' + fnode + '</p><p onclick="fillComments(event)" class="commentLabel" id="' + id + '">View Comments/Comment</p>';
			}
		}
	}
}


function fillComments(event)
{
	pid = event.target.id;
	xhr2 = new XMLHttpRequest();
   	xhr2.onreadystatechange = fillComment;
   	xhr2.open("GET","./comments.php?pid=" + pid,true);
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
			var cname = JSONobject.cname;
			var comments = '';
						
			for(i =0; i< comment.length; i++)
			{
				/*
				 * make comment div visible
				 * fill in comments in comment div
				 */
				comments += '<div class="comment"><div class="name">' + cname[i] + '</div><div class="date">' + cdate[i] + '</div><p class="comments">' + comment[i] + '</p></div>'
			}
			
			
			$('#commentarea').slideDown('slow', function() {
			    // Animation complete.
			    document.getElementById("commentarea").style.display = "block";
			  });
			document.getElementById("commentarea").innerHTML = content + comments;
		}
	}
}


function hideComment()
{
	document.getElementById("commentarea").style.display = "none";
}

function hideRecommend()
{
	document.getElementById("recommendarea").style.display = "none";
}


function viewPrevComments()
{
	alert("previous comments clicked");
	// ajax call
}

function commentSubmit()
{
	//alert("pid: " + pid + " sid: " + sid + " cname: " + cname);
	// ajax call
	var form = document.getElementById("addCommentForm");
	comment = form['commentText'].value.trim();
	var con = "project";
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	var param = "cname="+cname+"&comment="+comment+"&pid="+pid+"&con="+con;
	
	xhr2 = new XMLHttpRequest();
			
	if(xhr2)
	{
				
		try
		{
			xhr2.onreadystatechange = fetchData;
			xhr2.open("POST","./commentsubmit.php",true);
			xhr2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			//post req - set req header
			xhr2.send(param);
		}
		catch(err)
		{
			alert("ajax error: " + err);
			return;
		}
	}
}

function fetchData()
	{
			if(xhr2.readyState == 4 && xhr2.status == 200)
			{
				if(xhr2.responseText == "success")
				{
					var com = '<div class="comment"><div class="name">'+cname+'</div><div class="date">' + date + '</div><p class="comments">'+comment+'</p></div>';
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
	


