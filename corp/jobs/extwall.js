$(document).ready(fillWall)

function fillWall()
{
	console.log("calling fillwall in corp wall in extwall");
	cid = $("#cidval").val();
	tcid = $("#tcidval").val();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = wallInfo;
	xhr.open("GET","http://localhost/corp/jobs/wall.php?cid="+cid);
	xhr.send();
	
	id = setTimeout("fillWall()",300000);
}

function wallInfo()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failed")
		{
			//alert("Couldn't delete job. Try after a while.");
			alert("failed");
		}
		else
		{
			/*
			 * parse jids, aids and sids for each jid. count no of aids for each jid and populate notification bubbles and wall.
			 * Populate wall in the following way: x applicants for y project
			 * give a link on x and applicant.php giving jid as get variable.
			 * on clicking notification bubble - x applicants for y project are displayed for each jid y
			 */
			var i =0, j = 0;
			var JSONtext = xhr.responseText;
			// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
			
			var jids = JSONobject.jid;
			var sids = JSONobject.sid;
			var aids = JSONobject.aid;
			var titles = JSONobject.title;
			
			//var notes = 0;
			var count = new Array(jids.length);
			for(i=0;i<count.length;i++)
			{
				count[i] = 0;
			}
			
			for(i=0;i<aids.length;i++)
			{
				if(aids[i]!="$")
				{
					count[j]++;
					//notes++;
				}
				else
					j++;
			}
			var updates ='';
			for(i=0;i<count.length;i++)
			{
				if(count[i] > 1)
					updates += "<p>" + '<a href="http://localhost/corp/jobs/applicants.php?see=external&jid=' + jids[i] + '">' + count[i] + "</a> applicants for " + '<a href="http://localhost/corp/jobs/Specificjob.php?jid=' + jids[i] + '">' + titles[i] + "</a></p>"
				else if(count[i] == 1)
					updates += "<p>" + '<a href="http://localhost/corp/jobs/applicants.php?see=external&jid=' + jids[i] + '">' + count[i] + "</a> applicant for " + '<a href="http://localhost/corp/jobs/Specificjob.php?jid=' + jids[i] + '">' + titles[i] + "</a></p>"
			}
			
			document.getElementById("wall").innerHTML = updates;
			// here on click of a launch the flag call and fill wall with descending order of updates. Remember launch separate calls for job filling and advertisement of products.
			/*if(notes > 0)
				document.getElementById("note").innerHTML = '<a href="#">' + notes + '</a>';
			else
				document.getElementById("note").innerHTML = '';*/
		}
	}
}


function showJobs()
{
	sid = $("#sidval").val();
	console.log("sid = " + sid);
	//alert(cid);
	xhr2 = new XMLHttpRequest();
	xhr2.onreadystatechange = fillJobs;
	xhr2.open("GET","http://localhost/corp/jobs/job.php?cid="+cid);
	xhr2.send();
}

function fillJobs()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failed")
		{
			//alert("Couldn't delete job. Try after a while.");
			alert("failed");
		}
		else
		{
			var i = 0;
			var JSONtext = xhr.responseText;
			// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
			
			var jids = JSONobject.jid;
			var titles = JSONobject.title;
			
			//<li><a href="http://localhost/corp/jobs/Specificjob.php?jid='.$row['jid'].'">'.$row['title'].'</a><a onclick="deleteJob(event,'.$row['jid'].')" class="del" style="position:absolute;left:1020px;cursor:pointer;">delete</a></li>'
			var jobs = ''; 
			for(i = 0 ; i<jids.length ; i++)
			{
				jobs += '<p><a href="http://localhost/corp/jobs/Specificjob.php?see=studentExt&jid=' + jids[i] + '&sid=' + sid + '">' + titles[i] + '</a></p>'
			}
			jobs += '<a href="http://localhost/corp/jobs/index.php?see=student&sid=' + sid + '">BACK</a>';
			document.getElementById("desc").innerHTML = jobs;
		}
	}
}


