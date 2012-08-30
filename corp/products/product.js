function placeOrder()
{
	//alert("place order clicked")
	sid = $("#sid").val();
	prid = $("#prid").val();
	//alert("sid : " + sid + " prid : " + prid)
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = orderresult;
	xhr.open("POST","./order.php",true)
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xhr.send("sid=" + sid + "&prid=" + prid)
}

function orderresult()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText == "failed")
		{
			document.getElementById("orderres").innerHTML = "Order failed"
		}
		else
		{
			document.getElementById("orderres").innerHTML = "Order placed! You will be given key within a week"
		}
	}
}


function deleteProduct(event,delElem)
{
	delLi = event.target.parentNode;
	ul = event.target.parentNode.parentNode;
	//alert("delElem: "+delElem);
	var del = confirm("Are you sure you want to delete the job?");
	if(del == true)
	{
					// make an ajax call
					xhr2 = new XMLHttpRequest();
					xhr2.onreadystatechange = deleteItem;
					xhr2.open("GET","./del.php?prid="+delElem,true);
					xhr2.send();
	}
}

function deleteItem()
{
	if(xhr2.readyState == 4 && xhr2.status == 200)
	{
		if(xhr2.responseText == "failed")
		{
			alert("failed to delete product")
		}
		else
		{
			ul.removeChild(delLi);
		}
	}
}
