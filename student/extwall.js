//$(document).ready(fillWall)
$(document).ready(function () {
  var settings = {
				showArrows: false,
				autoReinitialise: true
			};
				var pane = $('.scroll-pane')
				pane.jScrollPane(settings);
				contentPane = pane.data('jsp').getContentPane();
  fillWall();
  sidebar=document.getElementById("sidebar");
  sidebar.style.height=window.innerHeight+"px";
});

function fillWall()
{
	//alert("fill wall executing");
	/*
	 * run ajax to fetch aid from applicant table
	 * check for that aid in wall table
	 * also check time - refer trial.php
	 * get title of job with jid in wall
	 * fill in wall with content & give title as link (with jid)
	 */
	console.log("calling fillwall in student wall extwall.js");
	sid = $("#sidval").val();
	tsid = $("#tsidval").val();
	console.log("sid = " + sid + "tsid = " + tsid)
	//sid = tsid;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = wallInfo;
	xhr.open("GET","http://localhost/student/wall2.php?sid="+sid);
	xhr.send();
	
	id = setTimeout("fillWall()",300000);
}


function wallInfo()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failure")
		{
			//alert("Couldn't delete job. Try after a while.");
			alert("failed");
		}
		else
		{
			 // parse json and get title, content and jid out...
			 var JSONtext = xhr.responseText;
						// convert received string to JavaScript object
			 var JSONobject = JSON.parse(JSONtext);
						 
			 var titles = JSONobject.title;
			 var jids = JSONobject.jid;
			 var contents = JSONobject.content;
			 
			 var Jjids = JSONobject.Jjid;
			 var Jtitles = JSONobject.Jtitle;
			 var Jtags = JSONobject.Jtags;
			 var JCnames = JSONobject.JCName;
			 var JCids = JSONobject.JCid;
			 
			 var sinterests = JSONobject.Sinterest;
			 
			 var CTitles = JSONobject.Ctitle;
			 console.log(CTitles);
			 var Cids = JSONobject.Cid;
			 var Comments = JSONobject.Comment;
			 var CDate = JSONobject.CDate;
			 var CName = JSONobject.CName;
			 var CSid = JSONobject.CSid;
			 
			 console.log("not his projects")
			 var NIpid = JSONobject.NIpid;
			 var NItitle = JSONobject.NItitle;
			 var NIfiles = JSONobject.NIfiles;
			 var NIsubmitter = JSONobject.NIsubmitter;
			 var NIauthor = JSONobject.NIauthor;
			 console.log("ni author : " + NIauthor);
			 var NIabstract = JSONobject.NIabstract;
			 var NIname = JSONobject.NIname;
			 
			 
			 var yrs = (1000 * 60 * 60 * 24 * 30 * 12);
			 var months = (1000 * 60 * 60 * 24 * 30);
			 var weeks = (1000 * 60 * 60 * 24 * 7);
			 var days = (1000 * 60 * 60 * 24);
			 var hours = (1000 * 60 * 60);
			 var mins = (1000 * 60);
			 var sec = (1000);
			 
			//console.log("sinterests: "+sinterests);
			//console.log("jtags: "+Jtags);
			
			var i = 0;
			var j = 0;
			var interested = new Array;
			
			var interests = sinterests[0].split(";");
			//console.log("interests: "+interests);
			
			for(i=0;i<Jtags.length;i++)
			{
				var tags = Jtags[i].split(";");
				//console.log("tags : "+tags)
				for(j=0;j<tags.length;j++){
					//console.log("tags[j]: "+tags[j]);
					if((jQuery.inArray(tags[j], interests)) > -1)
					{
						//console.log("yes");
						interested[i] = true;
					}
					else
					{
						//console.log("no");
						//interested[i] = false;
					}
				}
			}
			 var wall = document.getElementById("wall");
			 var updates = '';
			 
			for(i=0;i<titles.length;i++)
			{
				//updates += '<p>You have been ' + contents[i] + " for <a href='#'>" + titles[i] + "</a></p>";
				updates += '<p class="newupdate">You have been ' + contents[i] + " for <a href='http://localhost/corp/jobs/Specificjob.php?jid=" + jids[i] +  '&sid='+ tsid + '&wsid='+ sid + "&see=student'>" + titles[i] + "</a></p>";
				console.log("updates : " + updates)
			}
			// check here for job viability for student using Jtags and sinterests
			
			
			
			for(i=0;i<Jtitles.length;i++)
			{
				//updates += '<p>You have been ' + contents[i] + " for <a href='#'>" + titles[i] + "</a></p>";
				if(interested[i] == true)
					updates += '<p class="newupdate"><a href="http://localhost/corp/jobs/Specificjob.php?jid=' + Jjids[i] + '&sid='+ tsid +'&see=student">' + Jtitles[i] + '</a> has been posted by <a href="http://localhost/corp/jobs/index.php?see=student&sid=' + tsid + '&cid=' + JCids[i] + '">' + JCnames[i] + '</a></p>';
			}
			
			for(i = 0 ; i < CTitles.length ; i++)
			{
				var date1 = new Date();
				var date2 = new Date(CDate[i]);
				
				var diff = (date1.getTime() - date2.getTime());
				var duration = diff/yrs;
				var unit = 'years';
				
				if(duration < 1)
				{
					duration = diff/months;
					unit = 'months'
					if(duration < 1)
					{
						duration = diff/weeks;
						unit = 'weeks'
						if(duration < 1)
						{
							duration = diff/days;
							unit = 'days'
							if(duration < 1)
							{
								duration = diff/hours;
								unit = 'hours'
								if (duration < 1) 
								{
									duration = diff/mins;
									unit = 'minutes'
									if(duration < 1)
									{
										diff/sec;
										unit = 'seconds'
									}	
								}
							}
						}
					} 
				}
				
				//console.log(Math.floor(duration) + " " + unit);
				
				if(CSid[i] != sid)
					updates += '<p class="newupdate"><a href="./index.php?esid=' + CSid[i] + '&see=external' + '">' + CName[i] + '</a> has posted a <a href="./SpecificProject.php?pid='+ Cids[i] + '&sid=' + tsid +  '">Comment on ' + CTitles[i] + '</a> ' + Math.floor(duration) + " " + unit + " ago";
			}
			
			var interested = new Array;
			
			for(i=0;i<NIpid.length;i++)
			{
				var tags = NIabstract[i].split(";");
				//console.log("tags : "+tags)
				for(j=0;j<tags.length;j++){
					//console.log("tags[j]: "+tags[j]);
					if((jQuery.inArray(tags[j], interests)) > -1)
					{
						//console.log("yes");
						interested[i] = true;
					}
					else
					{
						//console.log("no");
						//interested[i] = false;
					}
				}
			}
			
			
			
			var authored = new Array;
			var done = new Array;
			var k = 0;
			for(i=0;i< NIauthor.length; i++)
			{
				done[i] = false;
				var authors = NIauthor[i].split(";")
				for(j=0;j<authors.length;j++)
				{
					console.log("sid = " + sid)
					console.log("authors[j] = " + authors[j])
					if(authors[j] == sid)
					{
						authored[k] = NIpid[i];
						k++;
						done[i] = true;
						updates += '<p class="newupdate"><a href="http://localhost/student/SpecificProject.php?pid=' + NIpid[i] + '&see=owner&sid='+ tsid +'">' + NItitle[i] + '</a> has been posted by <a href="http://localhost/student/index.php?see=external&esid=' + NIsubmitter[i]  + '">' + NIname[i] + '</a></p>';
					}
					else
					{
						console.log("no")
					}
				}
			}
			console.log("authored: " + authored)
			for(i=0;i<NIpid.length;i++)
			{
				//updates += '<p>You have been ' + contents[i] + " for <a href='#'>" + titles[i] + "</a></p>";
				
				for(j=0;j<authored.length;j++)
				{
					console.log("authored[j] : " + authored[j])
					console.log("nipid : " + NIpid[i])
					if(authored[j] == NIpid[i])
					{
						console.log("came here to if")
					}
					else
					{
						console.log("came here to else")
						if(interested[i] == true && done[i] == false)
						{
							console.log("came here to interested if")
							updates += '<p class="newupdate"><a href="http://localhost/student/SpecificProject.php?pid=' + NIpid[i] + '&sid='+ tsid +'">' + NItitle[i] + '</a> has been posted by <a href="http://localhost/student/index.php?see=external&esid=' + NIsubmitter[i]  + '">' + NIname[i] + '</a></p>';
							done[i] = true;
						}						
					}
				}
			}
			
			//wall.innerHTML = updates;
			contentPane.append(
				updates
			);
		}
	}
}
