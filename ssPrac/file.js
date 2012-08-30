function upload()
{
	alert("inside function");
	$.ajax({
			   type		: 'POST',
			   url		: 'http://localhost/ss/file_upload.php',
			   dataType	: 'json',
			   data		: $('#fileForm'),
			   success	: function(data,textStatus){
							  //hide the ajax loader
							  alert("in success");
							  if(data.result == '1'){
							      //show success message
								  alert("File uploaded");
							  }
							  else if(data.result == '-1'){
								  alert("File not uploaded")
							  }	
							  else if(data.result == '2'){
								  alert("File already exists")
							  }			  
						  },
			   error	: function(data,textStatus){
			   				var response = JSON.parse(data);
			   				alert("error");
			   				console.log("errors"+response.errors);
			   }
		});
}
