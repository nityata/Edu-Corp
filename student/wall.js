$(document).ready(function () {
  var settings = {
				showArrows: false,
				autoReinitialise: true
			};
				var pane = $('.scroll-pane')
				pane.jScrollPane(settings);
				contentPane = pane.data('jsp').getContentPane();
  fillWall();
  fillAd();
  sidebar=document.getElementById("sidebar");
  sidebar.style.height=window.innerHeight+"px";
});

function editdesp(event)
		{
			thisbox = event.target;
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
					//alert=xhr.responseText;
				}
			  }
		xhr3.open("GET","./edit_about.php?id="+sid+"&text="+text,true);
		xhr3.send();
		}

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
	console.log("calling fillwall in student wall wall.js");
	sid = $("#sidval").val();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = wallInfo;
	xhr.open("GET","http://localhost/student/wall2.php?sid="+sid);
	xhr.send();
	
	id = setTimeout("fillWall()",300000);
}


function fillAd()
{
	console.log("fill ad executing sid = " + sid)
	xhr2 = new XMLHttpRequest();
	xhr2.onreadystatechange = adInfo;
	xhr2.open("GET","http://localhost/student/ads.php?sid="+sid);
	xhr2.send();
}

function adInfo()
{
	if(xhr2.readyState == 4 && xhr2.status == 200)
	{
		if(xhr2.responseText == "failure")
		{
			//alert("Couldn't delete job. Try after a while.");
			alert("failed");
		}
		else
		{
			// retrieve data fill up div
			var JSONtext = xhr2.responseText;
						// convert received string to JavaScript object
			var JSONobject = JSON.parse(JSONtext);
						 
			var adcid = JSONobject.adcid;
			var adcontent = JSONobject.adcontent;
			var adid = JSONobject.adid;
			var adctags = JSONobject.adctags;
			var adcname = JSONobject.adcname;
			var adprid = JSONobject.adprid;
			var ADinterests = JSONobject.SAdinterest;
			console.log("interests in  adInfo : " + ADinterests);
			var adinterests = ADinterests[0].split(";");
			console.log("interests in  adInfo in arr: "+adinterests);
			adUpdates = new Array;
			adUpdates['adcname'] = new Array;
			adUpdates['adcid'] = new Array;
			adUpdates['adid'] = new Array;
			adUpdates['adcontent'] = new Array;
			
			//adList = ''
			
			var ADinterested = new Array;
			var i = 0;
			
			for(i=0;i<adctags.length;i++)
			{
				var tags = adctags[i].split(";");
				//console.log("tags : "+tags)
				for(j=0;j<tags.length;j++){
					//console.log("tags[j]: "+tags[j]);
					if((jQuery.inArray(tags[j], adinterests)) > -1)
					{
						//console.log("yes");
						ADinterested[i] = true;
					}
					else
					{
						//console.log("no");
						//interested[i] = false;
					}
				}
			}
			
			var j = 0;
			for(i = 0 ; i < adcontent.length ; i++)
			{
				if(ADinterested[i] == true)
				{
					//adUpdates += '<p>' + adcontent[i] + "</p>"
					adUpdates['adcname'][j] = adcname[i];
					adUpdates['adid'][j] = adprid[i];
					adUpdates['adcid'][j] = adcid[i];
					adUpdates['adcontent'][j] = adcontent[i];
					
					//adList += '<span><p><a href="http://localhost/corp/products/SpecificProduct.php?see=student&prid=' + adprid[i] + '&sid=' + sid + '">' + adcontent[i] + '</a></p><p>By <a href="http://localhost/corp/jobs/index.php?see=student&sid=' + sid + '&cid=' + adcid[i] +  '">' + adcname[i]  + '</a></p></span>'
					j++;
				}
			}
			//console.log("adupdates : " + adUpdates['adcontent']);
			startanimate(adUpdates);
		/*	console.log("adlist : " + adList)
			document.getElementById("adchange").innerHTML = adList;
			 $("#ads").animate({
			    opacity: 0.4,
			    fontSize: "30px",
			    borderWidth: "5px"
			  }, 1500 );*/
			  
			   
		}
	}
}

n = 0;


function startanimate() {
	console.log("startanimate again")
	
	console.log("adupdates : " + adUpdates['adcontent'][0]);
	console.log("adupdates length : " + adUpdates['adcontent'].length);
	console.log("n : " + n);
	
	
	//adList += '<span><p><a href="http://localhost/corp/products/SpecificProduct.php?see=student&prid=' + adprid[i] + '&sid=' + sid + '">' + adcontent[i] + '</a></p><p>By <a href="http://localhost/corp/jobs/index.php?see=student&sid=' + sid + '&cid=' + adcid[i] +  '">' + adcname[i]  + '</a></p></span>'
	
	var adsFill = '';
	adsFill += '<span><p><a href="http://localhost/corp/products/SpecificProduct.php?see=student&prid=' + adUpdates['adid'][n] + '&sid=' + sid + '">' + adUpdates['adcontent'][n] + '</a></p><p>By <a href="http://localhost/corp/jobs/index.php?see=student&sid=' + sid + '&cid=' + adUpdates['adcid'][n] +  '">' + adUpdates['adcname'][n]  + '</a></p></span>'
	//adsFill += '<p>' + adUpdates['adcname'][n] + "</p>"	
	
	/*$('#ads').slideDown('slow', function() {
			    // Animation complete.
		document.getElementById("ads").style.display = "block";
	});*/
	
	document.getElementById("ads").innerHTML = adsFill
	
			if(n % 2 == 0)
			{
			 $("#ads").animate({
			    opacity: 0.4,
			    fontSize: "30px",
			    borderWidth: "5px"
			  }, 1000 );
			 }
			 else{
			 	$("#ads").animate({
			    opacity: 1.0,
			    fontSize: "20px",
			    borderWidth: "3px"
			  }, 1000 );
			 }
	
	n++;
	var len = adUpdates['adcontent'].length
	if(n >= len)
		n = 0;
	setTimeout(startanimate,5000)
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
			 
			 console.log("his projects")
			 var CTitles = JSONobject.Ctitle;
			 console.log(CTitles);
			 var Cids = JSONobject.Cid;
			 var Comments = JSONobject.Comment;
			 var CDate = JSONobject.CDate;
			 var CName = JSONobject.CName;
			 var CSid = JSONobject.CSid;
			 
			 console.log("not his projects")
			 var NIpid = JSONobject.NIpid;
			 console.log("NI pid : " + NIpid);
			 var NItitle = JSONobject.NItitle;
			 var NIfiles = JSONobject.NIfiles;
			 var NIsubmitter = JSONobject.NIsubmitter;
			 var NIauthor = JSONobject.NIauthor;
			 console.log("NI author : " + NIauthor);
			 var NIabstract = JSONobject.NIabstract;
			 var NIname = JSONobject.NIname;
			 
			 
			 var aaids = JSONobject.aaid;
			 console.log("aaids : " + aaids)
			 var appcomms = JSONobject.appcomment;
			 var subtype = JSONobject.acommStype;
			 
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
			console.log("interests: "+interests);
			
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
				if(contents[i] == "Accepted")
					updates += '<p class="newupdate">You have been ' + contents[i] + " for <a href='http://localhost/corp/jobs/Specificjob.php?jid=" + jids[i] + "&see=intern&sid=" + sid + "'>" + titles[i] + "</a></p>";
				else				
					updates += '<p class="newupdate">You have been ' + contents[i] + " for <a href='http://localhost/corp/jobs/Specificjob.php?jid=" + jids[i] + "&see=applicant'>" + titles[i] + "</a></p>";
			}
			// check here for job viability for student using Jtags and sinterests
			
			
			
			for(i=0;i<Jtitles.length;i++)
			{
				//updates += '<p>You have been ' + contents[i] + " for <a href='#'>" + titles[i] + "</a></p>";
				if(interested[i] == true)
					updates += '<p class="newupdate"><a href="http://localhost/corp/jobs/Specificjob.php?jid=' + Jjids[i] + '&sid='+ sid  + '&wsid=' + sid +'&see=student">' + Jtitles[i] + '</a> has been posted by <a href="http://localhost/corp/jobs/index.php?see=student&sid=' + sid + '&cid=' + JCids[i] + '">' + JCnames[i] + '</a></p>';
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
					updates += '<p class="newupdate"><a href="./index.php?esid=' + CSid[i] + '&see=external' + '">' + CName[i] + '</a> has posted a <a href="./SpecificProject.php?pid='+ Cids[i] + '&sid=' + sid + '">Comment on ' + CTitles[i] + '</a> ' + Math.floor(duration) + " " + unit + " ago";
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
						updates += '<p class="newupdate"><a href="http://localhost/student/SpecificProject.php?pid=' + NIpid[i] + '&see=owner&sid='+ sid + '&csid=' + NIsubmitter[i] + '">' + NItitle[i] + '</a> has been posted by <a href="http://localhost/student/index.php?see=external&esid=' + NIsubmitter[i]  + '">' + NIname[i] + '</a></p>';
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
							updates += '<p class="newupdate"><a href="http://localhost/student/SpecificProject.php?pid=' + NIpid[i] + '&sid='+ sid + '&csid=' + NIsubmitter[i] +'">' + NItitle[i] + '</a> has been posted by <a href="http://localhost/student/index.php?see=external&esid=' + NIsubmitter[i]  + '">' + NIname[i] + '</a></p>';
							done[i] = true;
						}						
					}
				}
			}
			
			
			for( i =0 ; i < aaids.length ; i++)
			{
				//if(subtype[i] == "corp")
					//updates += '<p><a href="./app.php?aaid=' + aaids[i] + '&see=student&ssid=' + sid;  + '">' + 'A comment has been posted on your application' + '</a></p>'
					updates += '<p class="newupdate"><a href="http://localhost/corp/jobs/app.php?see=student&aaid=' + aaids[i] + '&ssid=' + sid + '">Comment on your application has been posted</p>'
			}
			
			//wall.innerHTML = updates;
			contentPane.append(
				updates
			);
		}
	}
}
