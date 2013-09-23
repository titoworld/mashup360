;var login = login || {};
login = { 
	getWS: function(requestType,objectToSend, url, success, fail){
			if (requestType=="get"){
				$.ajax({
		            type: "GET",
		            dataType: "json",
		            url: window.API_DOMAIN+url,
		            cache: false,
		            success: function(data, status){
						if (data.status == "success"){
								success(data, status);	
						}
						else{
							setTimeout(function(){
								login.getWS(requestType,objectToSend,url,success,fail);
							}, 5000);
						}
		            },
		            error: function (xhr, ajaxOptions, thrownError) {
		            	//console.log(xhr);
						//console.log(ajaxOptions);
						//console.log(thrownError);
		            	//fail(true);
		            }
		        });
		    }
		    else if (requestType=="post"){
		 	   $.ajax({
				  type: "POST",
				  url: window.API_DOMAIN+url,
				  data: objectToSend,
				  success: function(data, status){
						if (status == "success"){
								success(data, status);	
						}
						else if(status = "error"){
							alert("Login incorrecte");
						}
						else{
							setTimeout(function(){
								login.getWS(requestType,objectToSend,url,success,fail);
							}, 5000);
						}
		            },
		            error: function (xhr, ajaxOptions, thrownError) {
		            	console.log(xhr);
						console.log(ajaxOptions);
						console.log(thrownError);
		            	//fail(true);
		            }

			   });
			 }
	 },
	init: function() {
		$("#loginButt").unbind();
		$("#loginButt").click(function(){
			var user = $("#input-username").val();
			var passw;
			//solicitem la clau publica
			login.getWS("post",null,"getPublicKey",
			function(data){
					passw= md5($("#input-password").val()+"-"+data.publicKey.hash); //fem un hash am el passw i la clau publica
					login.getWS("post",{usuari:user, contrasenya:passw},
					"login",
				  function(data){	
					  if(data.status=="success"){
					  		$.ajax({
							  type: "POST",
							  url: "../sessionController.php", //guardem el hash del usuari (generat al servidor, a una sessio)
							  data: {userHash:data.login.hash},
							  success: function(data, status){
							 	 window.location.href = 'admin.php?section=POIS';
							  },
							  error:function(error){
								  console.log(error);
							  }
							});
				  	  } 
				  	  else {
					  	  alert ("Login incorrecte");
				  	  }
				  });
			});
			
		});
	}
};
(function(win, doc, ns, undefined) {
   
        ns.init();

}(window, document, login));