
function changeStatus(element)
{
	
  
	var req = new XMLHttpRequest();

	var id =element.childNodes(1).value;
	
	req.open("POST","server.php",true);
	req.onreadystatechange = function ()
	{
		if(req.readyState==4&&req.status==200)
	{
		
			var statusTag = req.responseXML.getElementsByTagName("status")[0];
			var value = statusTag.childNodes[0].nodeValue;
			element.innerHTML=value+" <input type='hidden' name='id' value='"+id+"'/>";
			if(value=="Active")
			classs="active";
			else
			classs="inactive";
			element.parentNode.setAttribute("class",classs);
			
		
	} 
	
		
	}
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	req.send("id="+id);
	
}

function edit(element)
{
	
	var req = new XMLHttpRequest();

	var id =element.id;
	
	req.open("POST","server.php",true);
	req.onreadystatechange = function ()
	{
		if(req.readyState==4&&req.status==200)
	{
		
			content = document.getElementById("content");
			content.innerHTML=req.responseText;
			
		
	} 
	
		
	}
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	req.send("edit="+id);
	
	
}

function save()
{
	var id = document.getElementById("id").value;
	var first_name = document.getElementById("first_name").value;
	var last_name = document.getElementById("last_name").value;
	var age = document.getElementById("age").value;
	var designation = document.getElementById("designation").value;
	var bgroup = document.getElementById("bgroup").value
	var allowance = document.getElementById("allowance").value;
	var address = document.getElementById("address").value;
	var status = document.getElementById("status").value;
	
var params="id2="+id+"&first_name="+first_name+"&last_name="+last_name+"&age="+age+"&designation="+designation+"&bgroup="+bgroup+"&allowance="+allowance+"&address="+address+"&status="+status;
	
	
	
	
	var req = new XMLHttpRequest();


	
	req.open("POST","server.php",true);
	req.onreadystatechange = function ()
	{
		if(req.readyState==4&&req.status==200)
	{
		
			//content = document.getElementById("content");
			//content.innerHTML=req.responseText;
			document.getElementById("content").innerHTML=req.responseText;
			
			
		
	} 
	
		
	}
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	
	req.send(params);
	
	
	
}
