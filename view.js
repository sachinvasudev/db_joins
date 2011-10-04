
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

function update()
{
	
	
	
}
