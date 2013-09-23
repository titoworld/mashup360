;var backend = backend || {};
backend = {
	getUrlVars: function() {
	    var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	        vars[key] = value;
	    });
	    return vars;
	},
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
								googleMaps.getWS(requestType,objectToSend,url,success,fail);
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
						if (data.status == "success"){
								success(data, status);	
						}
						else{
							setTimeout(function(){
								googleMaps.getWS(requestType,objectToSend,url,success,fail);
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
	 },
	init: function(){
		var hash = window.hash;
		backend.getWS("post",{hash});
	}
}


(function(win, doc, ns, undefined) {
    win.onload = function(){
        ns.init();
    };
}(window, document, backend)); 