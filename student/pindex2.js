$(document).ready(
	function()
	{
		var settings = {
				showArrows: false,
				autoReinitialise: true
			};
				var pane = $('.scroll-pane')
				pane.jScrollPane(settings);
				contentPane = pane.data('jsp').getContentPane();
		content = document.getElementById("commentarea").innerHTML; 
		contentR = document.getElementById("recoarea").innerHTML;
		cdisp = false;
		rdisp = false;
	}
);


function showProject(event)
{ 
	 sid = $("#sidval").val();
	 csid = $("#csidval").val();
	 id=event.target.id || event.currentTarget.id;
   	 //alert("ID:"+id); 
   	
   	 var elem = event.currentTarget;
   	 //elem.click(function() { return false; });
   	 elem.onclick="return false;"
   	 
   	 xhr = new XMLHttpRequest();
   	 xhr.onreadystatechange = fillProject;
   	 xhr.open("GET","./pdetail.php?sid="+sid + "&pid=" + id + "&csid=" + csid,true);
   	 xhr.send(null);
   	 //event.currentTarget.innerHTML = "wassup";
   	 nodeToFill = event.currentTarget || event.target;
   	 //nodeID = nodeToFill.id;
   	 nodeContent = nodeToFill.innerHTML;
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
				//var fnode = ''
				var j = 0
				
				/*for(j = 1; j < fileList.length; j++)
				{
					//fnode = fnode + '<a href="http://localhost/upload/' + fileList[j] +'" target="_blank">' + fileList[j] + '</a>&nbsp;'
				}*/
				
				//nodeToFill.innerHTML = nodeContent + '<p class="abs">ABSTRACT: ' + pabs[i] + '</p><p class="guide">GUIDE: ' + guide[i] + '</p><p class="files">FILES: ' + fnode + '</p><p onclick="fillComments(event)" class="commentLabel" id="' + id + '">Comments</p><p onclick="fillRecos(event)" class="commentLabel" id="'+ id + '">Recommendations</p>';
				/*var temp = '<p class="newupdate"><p class="abs">ABSTRACT: ' + pabs[i] + '</p><p class="guide">GUIDE: ' + guide[i] + '</p><p class="files">FILES: ' + fnode + '</p><p onclick="fillComments(event)" class="commentLabel" id="' + id + '">Comments</p><p onclick="fillRecos(event)" class="commentLabel" id="'+ id + '">Recommendations</p></p>';
				contentPane.append(
				nodeContent + temp
				);*/
				var p1 = document.createElement("p")
				p1.setAttribute("class","abs");
				p1.appendChild(document.createTextNode("ABSTRACT: " + pabs[i]));
				
				var p2 = document.createElement("p")
				p2.setAttribute("class","guide");
				p2.appendChild(document.createTextNode("GUIDE: " + guide[i]));
				
				var p3 = document.createElement("p")
				p3.setAttribute("class","files");
				p3.appendChild(document.createTextNode("FILES: "));
				
				var p4 = document.createElement("p")
				p4.setAttribute("class","commentLabel");
				p4.appendChild(document.createTextNode("Comments"));
				p4.setAttribute("id",id)
				p4.addEventListener("click",fillComments,true)
				
				var p5 = document.createElement("p")
				p5.setAttribute("class","commentLabel");
				p5.appendChild(document.createTextNode("Recommendations"));
				p5.setAttribute("id",id)
				p5.addEventListener("click",fillRecos,true)
				
				for(j = 1; j < fileList.length; j++)
				{
					//fnode = fnode + '<a href="http://localhost/upload/' + fileList[j] +'" target="_blank">' + fileList[j] + '</a>&nbsp;'
					var a = document.createElement("a");
					a.setAttribute("href","http://localhost/upload/" + fileList[j])
					a.setAttribute("target","_blank")
					a.appendChild(document.createTextNode(fileList[j]))
					p3.appendChild(a);
				}
				
				document.getElementById(id).appendChild(p1)
				document.getElementById(id).appendChild(p2)
				document.getElementById(id).appendChild(p3)
				document.getElementById(id).appendChild(p4)
				document.getElementById(id).appendChild(p5)
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
			/*rdisp = true;
			if(cdisp && rdisp)
			{
				document.getElementById("plist").style.position = "relative";
				document.getElementById("plist").style.top = "-170px";
			}*/
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
			document.getElementById("recoarea").style.left = "450px";
			/*cdisp = true;
			if(cdisp && rdisp)
			{
				document.getElementById("plist").style.position = "relative";
				document.getElementById("plist").style.top = "-170px";
			}*/
		}
	}
}


function hideComment()
{
	document.getElementById("commentarea").style.display = "none";
	document.getElementById("recoarea").style.left = "-15px";
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
	var con = "project";
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	var param = "cname="+cname+"&comment="+comment+"&pid="+pid+"&con="+con + "&sid=" + sid;
	
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
