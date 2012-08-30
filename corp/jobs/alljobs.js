$(document).ready(
	
	function()
	{
		console.log("here at alljobs.js")
		
		con = document.getElementById("commentarea").innerHTML	
	}
);

function fillWork(jid)
{
	//alert("fill work clicked - jid : " + jid)
	ijid = jid;
	cid = document.getElementById("cidval").value;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = internList;
	xhr.open("GET","./internlist.php?jid=" + jid,true)
	xhr.send(null)
}

function internList()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failed")
		{
			alert("intern list could not be fetched")
		}
		else
		{
			// populate
			var il = document.getElementById("internList");
			var JSONtext = xhr.responseText;
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
				li += '<li><a href="#comm" onclick="viewwork(' + sids[i] + ', ' + ijid + ', ' + cid +')">' + anames[i] + '</a></li>';
			}
			il.innerHTML = li;
		}
	}
}


function viewwork(wsid,wjid,wcid)
{
	//alert("view work clicked")
	// implement as much of viewwork of sjob.s as u can
	csid = wsid
	cjid = wjid;
	ccid = wcid;
	xhr2 = new XMLHttpRequest();
	xhr2.onreadystatechange = fillworkandcomm;
	xhr2.open("GET","./jobprogress.php?jid=" + wjid + "&sid=" + wsid + "&see=corp"+ "&cid=" + wcid,true);
	xhr2.send();
}

function fillworkandcomm()
{
	if(xhr2.readyState == 4 && xhr2.status == 200)
	{
		console.log("responseText : " + xhr2.responseText)
		if(xhr2.responseText == "failed")
		{
			alert("failed to fill progress")
		}
		else
		{
			var JSONtext = xhr2.responseText;
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
	
	var param = "comment=" + comment + "&pgrid=" + pgrid + "&sid=" + csid + "&stype=corp";
	
	xhr3 = new XMLHttpRequest();
			
	if(xhr3)
	{
				
		try
		{
			xhr3.onreadystatechange = submitcomment;
			xhr3.open("POST","./commentsubmit.php",true);
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


function submitcomment()
{
	if(xhr3.readyState == 4 && xhr3.status == 200)
			{
				if(xhr3.responseText == "success")
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

function editdesp(event)
		{
			thisbox = event.target;
			ftype = event.target.id || event.currentTarget.id;
			console.log("type = " + ftype)
			content=thisbox.innerHTML;
			editbox.value=content;
			editbox = document.getElementById("editbox");
			thisbox.style.display="none";
			editbox.style.display="inline";
		}
		function savetext(text)
		{
			
			document.getElementById("editbox").style.display="none";
			thisbox.style.display="block";	
			var xhr4;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xhr4=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xhr4=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xhr4.onreadystatechange=function()
			  {
			  if (xhr4.readyState==4 && xhr4.status==200)
				{
			
					thisbox.innerHTML=text;
					//alert=xhr3.responseText;
				}
			  }
		xhr4.open("GET","./editAll.php?jid="+cjid + "&sid=" + csid + "&cid=" + ccid + "&text="+text + "&type=" + ftype,true);
		xhr4.send();
		}