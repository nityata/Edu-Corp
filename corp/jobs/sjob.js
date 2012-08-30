$(document).ready(
	
	function()
	{
		console.log("here at sjob.js")
		wsid = -1;
		csid = -1;
		con = document.getElementById("commentarea").innerHTML	
	}
);


/*function fillInts(jid)
{
	alert("fill int clicked - jid : " + jid)
	ijid = jid;
	cid = document.getElementById("cidval").value;
	xhr4 = new XMLHttpRequest();
	xhr4.onreadystatechange = internList;
	xhr4.open("GET","./internlist.php?jid=" + jid,true)
	xhr4.send(null)
}*/

/*function internList()
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
		}
	}
}*/



function viewwork(sid,jid)
{
	console.log("letsc in view work")
	console.log("clicked = sid : " + sid + " jid : " + jid)
	
	csid = sid
	cid = document.getElementById('cidval').value
	
	if(document.getElementById('wsid'))
	{
		wsid = document.getElementById('wsid').value
		console.log("wsid : " + document.getElementById('wsid').value);
	}
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = fillwork;
	
	if(wsid!=-1)
		xhr.open("GET","./jobprogress.php?jid=" + jid + "&sid=" + wsid + "&cid=" + cid,true);
	else
		xhr.open("GET","./jobprogress.php?jid=" + jid + "&sid=" + sid + "&see=intern"+ "&cid=" + cid,true);
	xhr.send();
}

function fillwork()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		console.log("responseText : " + xhr.responseText)
		if(xhr.responseText == "failed")
		{
			alert("failed to fill progress")
		}
		else
		{
			var JSONtext = xhr.responseText;
						// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
			
			commentername = JSONobject.nameTF;
			var cname = JSONobject.name;
			console.log("cname : " + cname)
			var cdate = JSONobject.date;
			var content = JSONobject.content;
			
			var work = JSONobject.work;
			console.log("work : " + work)
			var per = JSONobject.percent;
			console.log("percent : " + per)
			var todo = JSONobject.todo;
			pgrid = JSONobject.pgrid;
			console.log("pgrid : " + pgrid)
			
			var comments = '';
			
			console.log("content : " + content)
			
			for(i =0; i< content.length; i++)
			{
				/*
				 * make comment div visible
				 * fill in comments in comment div
				 */
				comments += '<div class="comment"><div class="name">' + cname[i] + '</div><div class="date">' + cdate[i] + '</div><p class="comments">' + content[i] + '</p></div>'
				console.log("comments: " + comments)
			}
			
			
			$('#commentarea').slideDown('slow', function() {
			    // Animation complete.
			    document.getElementById("commentarea").style.display = "block";
			  });
			document.getElementById("commentarea").innerHTML = con + comments;
			if(per == "")
				per = "0";
			document.getElementById("percent").innerHTML = '<span>COMPLETED</span><p>' + per + "%" + '</p>'
			document.getElementById("work").innerHTML = '<p>PROGRESS</p><p>' + work + '</p>'
			document.getElementById("todo").innerHTML = '<p>TO-DO</p><p>' +  todo + '</p>'
		}
	}
}

function commentSubmit()
{
	var form = document.getElementById("addCommentForm");
	comment = form['commentText'].value.trim();
	var dateFull = new Date();
	date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	
	var param = "comment=" + comment + "&pgrid=" + pgrid + "&sid=" + csid + "&stype=student";
	
	xhr2 = new XMLHttpRequest();
			
	if(xhr2)
	{
				
		try
		{
			xhr2.onreadystatechange = submitcomment;
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


function submitcomment()
{
	if(xhr2.readyState == 4 && xhr2.status == 200)
			{
				if(xhr2.responseText == "success")
				{
					var com = '<div class="comment"><div class="name">'+commentername[0]+'</div><div class="date">' + date + '</div><p class="comments">'+comment+'</p></div>';
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


function editdesp2(event)
		{
			thisbox = event.target;
			content=thisbox.innerHTML;
			editbox2.value=content;
			editbox2 = document.getElementById("editbox");
			thisbox.style.display="none";
			editbox2.style.display="inline";
		}
		function savetext(text)
		{
			
			document.getElementById("editbox2").style.display="none";
			var jid = document.getElementById("jid").value;
			thisbox.style.display="block";	
			var xhr3;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xhr3=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xhr3=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhr3.onreadystatechange=function()
			  {
			  if (xhr3.readyState==4 && xhr3.status==200)
				{
			
					thisbox.innerHTML=text;
					//alert=xhr3.responseText;
				}
			  }
		xhr3.open("GET","./edit_about.php?id="+jid+"&text="+text,true);
		xhr3.send();
		}