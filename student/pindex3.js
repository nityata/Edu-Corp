$(document).ready(
	function()
	{
		//alert("here");
		console.log("pindex3.js")
		content = document.getElementById("commentarea").innerHTML; 
		console.log(content);
		contentR = document.getElementById("recoarea").innerHTML;
	}
);


function showPr(event)
{ 
	console.log("showPr called")
	 sid = $("#sidval").val();
	// csid = $("#csidval").val();
	 id=event.target.id || event.currentTarget.id;
   	console.log("ID:"+id); 
   	
   	 var elem = event.currentTarget;
   	 //elem.click(function() { return false; });
   	 elem.onclick="return false;"
   	 
   	 xhr8 = new XMLHttpRequest();
   	 xhr8.onreadystatechange = fillProject;
   	 xhr8.open("GET","./pdetail2.php?sid="+sid + "&pid=" + id + "&csid=" + sid,true);
   	 console.log("sid = " + sid + " pid  = "+ id )
   	 xhr8.send(null);
   	 //event.currentTarget.innerHTML = "wassup";
   	 nodeToFill = event.currentTarget;
   	 nodeContent = event.currentTarget.innerHTML;
}

function fillProject()
{
	console.log("fillProject called")
	if(xhr8.readyState == 4 && xhr8.status == 200)
	{
		if(xhr8.responseText == "failed")
		{
			alert("Couldn't fetch details");
		}
		else
		{
			console.log(xhr8.responseText);
			var i = 0;
			var JSONtext = xhr8.responseText;
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
					fnode = fnode + '<a href="http://localhost/upload/' + fileList[j] +'" target="_blank">' + fileList[j] + '</a>&nbsp;'
				}
				
				nodeToFill.innerHTML = nodeContent + '<p class="abs">ABSTRACT: ' + pabs[i] + '</p><p class="guide">GUIDE: ' + guide[i] + '</p><p class="files">FILES: ' + fnode + '</p><p onclick="fillComments(event)" class="commentLabel" id="' + id + '">Comments</p><p onclick="fillRecos(event)" class="commentLabel" id="'+ id + '">Recommendations</p>';
			}
		}
	}
}


function fillComments(event)
{
	console.log("in fill comments")
	pid = event.target.id;
	console.log("pid : " + pid)
	xhr2 = new XMLHttpRequest();
   	xhr2.onreadystatechange = fillComment;
   	xhr2.open("GET","./comments.php?pid=" + pid,true);
   	xhr2.send(null);
}

function fillRecos()
{
	prid = event.target.id;
	console.log("pid: " + prid )
	xhr4 = new XMLHttpRequest();
   	xhr4.onreadystatechange = fillReco;
   	xhr4.open("GET","./recos.php?pid=" + prid,true);
   	xhr4.send(null);
}


function fillReco()
{
	if(xhr4.readyState == 4 && xhr4.status == 200)
	{
		if(xhr4.responseText == "failed")
		{
			alert("Couldn't fetch comments");
		}
		else
		{
			var i = 0;
			var JSONtext = xhr4.responseText;
			console.log(JSONtext);
			var JSONobject = JSON.parse(JSONtext);
			
			var i  = 0;
			var reco = JSONobject.reco;
			var rdate = JSONobject.rdate;
			var rname = JSONobject.rname;
			
			var recos = '';
			
			for(i =0; i< reco.length; i++)
			{
				/*
				 * make comment div visible
				 * fill in comments in comment div
				 */
				recos += '<div class="reco"><div class="name">' + rname[i] + '</div><div class="date">' + rdate[i] + '</div><p class="recommendation">' + reco[i] + '</p></div>'
			}
			
			$('#recoarea').slideDown('slow', function() {
			    // Animation complete.
			    document.getElementById("recoarea").style.display = "block";
			  });
			document.getElementById("recoarea").innerHTML = contentR + recos;
		}
	}	
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
			document.getElementById("recoarea").style.left = "500px";
			nodeToFill.style.textAlign = "center";
		}
	}
}


function hideComment()
{
	document.getElementById("commentarea").style.display = "none";
}

function hideReco()
{
	document.getElementById("recoarea").style.display = "none";
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
	console.log("comment : " + comment)
	var con = "project";
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	console.log("cname : " + cname + "pid : " + pid + "sid : " + sid)
	var param = "cname="+cname+"&comment="+comment+"&pid="+pid+"&con="+con + "&sid=" + sid;
	
	xhr9 = new XMLHttpRequest();
			
	if(xhr9)
	{
				
		try
		{
			xhr9.onreadystatechange = fetchData;
			xhr9.open("POST","./commentsubmit.php",true);
			xhr9.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			//post req - set req header
			xhr9.send(param);
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
			if(xhr9.readyState == 4 && xhr9.status == 200)
			{
				if(xhr9.responseText == "success")
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
	
function recoSubmit()
{
	//alert("submit clicked");
	var form = document.getElementById("addRecoForm");
	comment = form['recoText'].value.trim();
	var con = "project";
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['recoText'].value = "";
	var param = "cname="+cname+"&reco="+comment+"&pid="+prid+"&con="+con;
	
	console.log(param);
	
	xhr3 = new XMLHttpRequest();
			
	if(xhr3)
	{
				
		try
		{
			xhr3.onreadystatechange = submitReco;
			xhr3.open("POST","./recosubmit.php",true);
			xhr3.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			//post req - set req header
			xhr3.send(param);
		}
		catch(err)
		{
			alert("ajax error: " + err);
			return;
		}
	}
}

function submitReco()
{
	if(xhr3.readyState == 4 && xhr3.status == 200)
			{
				if(xhr3.responseText == "success")
				{
					var com = '<div class="reco"><div class="name">'+cname+'</div><div class="date">' + date + '</div><p class="recommendation">'+comment+'</p></div>';
					//window.location.reload();
					$('#recoarea').append(com);
					$('#recoarea').find(".comment:last").slideDown("fast");
				}
				else
				{
					alert("Couldn't submit reco. please try later");
				}
			}
}
