function commentSubmit()
{
	var form = document.getElementById("addCommentForm");
	var cname = form['cname'].value;
	var comment = form['commentText'].value.trim();
	var pid = form['pid'].value;
	var con = form['con'].value;
	var dateFull = new Date();
	var date = dateFull.getFullYear() + "-" + dateFull.getMonth() + "-" + dateFull.getDate() + " " + dateFull.getHours() + ":" + dateFull.getMinutes() + ":" + dateFull.getSeconds();
	form['commentText'].value = "";
	var param = "cname="+cname+"&comment="+comment+"&pid="+pid+"&con="+con;
	
	xhr = new XMLHttpRequest();
			
	if(xhr)
	{
				
		try
		{
			xhr.onreadystatechange = fetchData;
			xhr.open("POST","http://localhost/ss/commentsubmit.php",true);
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
	
	function fetchData()
	{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				var com = '<div style="display: none;" class="comment"><div class="avatar"><img src="default_avatar.gif" /></div><div class="name">'+cname+'</div><div class="date">' + date + '</div><p>'+comment+'</p></div>';
				//window.location.reload();
				$('#main').append(com);
				$('#main').find(".comment:last").slideDown("fast");
			}
	}
}
