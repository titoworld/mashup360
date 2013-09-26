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
								backend.getWS(requestType,objectToSend,url,success,fail);
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
								backend.getWS(requestType,objectToSend,url,success,fail);
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
	 POISEnTaula: function(){
		 backend.POISTable.fnClearTable();  
		 backend.getWS("get",null,"llista_POIs",
			function(data){
				$.each(data.llistaPOI, function(index,value) {
					var a = backend.POISTable.fnAddData(['<a href="#" id="'+value.POI_id+'">'+value.POI_name+'</a>',value.POI_postal,value.POI_email,value.POI_telefon]);
					$("#"+value.POI_id).unbind();
      				$("#"+value.POI_id).click(function(e){
      					  e.preventDefault();
      					  $("#contentPicker").removeClass("mostraInline");
      					  $("#contentPicker").addClass("amaga");
      					  if (value.POI_mini_logo) {
      					 	 $("#logoCampoImg").attr('src',window.UPLOADS_DOMAIN+"/POILogos/"+value.POI_id+"/"+value.POI_mini_logo);
      					 }
      					 else{
      						 $("#logoCampoImg").attr('src',window.IMAGE_DOMAIN+"/placeholder_location.png");
      					 }	
      					  $("#profile-username").text(value.POI_name);
      					  $("#profile-ubication").html("<a href='#'>"+value.POI_postal+", ["+value.POI_latitude+","+value.POI_longitude+"]</a>");
      					  $("#profile-mail").text(value.POI_email);
      					  $("#campoFieldMod").val(value.POI_name);
      					  $("#emailFieldMod").val(value.POI_email);
      					  $("#webFieldMod").val(value.POI_web);
      					  $("#telphFieldMod").val(value.POI_telefon);
      					  $("#direccionFieldMod").val(value.POI_postal);
      					  $("#posicionFieldMod").val(value.POI_latitude+","+value.POI_longitude);
      					  var geocoder = new google.maps.Geocoder();
      					  geocoder.geocode( { 'address': value.POI_postal}, function(results, status) {
	      					  if (status == google.maps.GeocoderStatus.OK) {	
		      					  latitude =results[0].geometry.location.lat();
		      					  longitude = results[0].geometry.location.lng();
		      					   var mapOptions = {
		         					 center: new google.maps.LatLng(latitude, longitude),
		         					 zoom: 11,
		          					 mapTypeId: google.maps.MapTypeId.ROADMAP,
		          				 	    zoomControl: true,
									    zoomControlOptions: {
									        style: google.maps.ZoomControlStyle.SHORT,
									        position: google.maps.ControlPosition.LEFT_CENTER
									    },
		       					   };
		       					  var map = new google.maps.Map(document.getElementById("mapaCampo"),mapOptions);
		       					  var myLatLng = new google.maps.LatLng(latitude, longitude);
		       					  backend.marker=null;
		       					  backend.placeMarker(myLatLng, map,null);
		       					  $('#POIModal').reveal();
		       				 }
		       			});
       					  $( "#tabs" ).tabs();
       					  $("#addPhotoButton").unbind();
						   $("#addPhotoButton").click(function() {
						   		$("#uploadPhoto").addClass("mostra");
						   		$("#contentPhoto").addClass("amaga");
						   });
						   $("#uploadFotos").unbind();
						    $("#uploadFotos").click(function() {
						     		var fotoClass= Parse.Object.extend("campoPhotoGallery");
									var nuevaFoto = new fotoClass();
									var fileUploadControl = $("#fotoFileCampo")[0];
									if (fileUploadControl.files.length > 0) {
										var file = fileUploadControl.files[0];
										var name = "photo.jpg";
 									}
 									else {
 										return 0;
 									}							
									$("#uploadPhoto").removeClass("mostra");
	   								$("#contentPhoto").removeClass("amaga");
									//$("#camposBox").hideModal();
									$("#"+id).trigger("click");								
						     });
						      $("#removePhotoButton").unbind();
						   $("#removePhotoButton").click(function() {
						   	var fotos= Parse.Object.extend("campoPhotoGallery");
							var query = new Parse.Query(fotos);
							$.msgbox("Confirma que desea eliminar esta foto ?", {
								type: "confirm",
								buttons : [
									{type: "submit", value: "Si"},
									{type: "submit", value: "No"}
								]
							}, function(result) {
									if (result=="Si") {
										query.get(window.currentImage, {
										  success: function(fotoObject) {
										  		fotoObject.destroy({
										 			 success: function(myObject) {
										   				$("#camposBox").hideModal();
														$("#"+id).trigger("click");
										 			 },
													  error: function(myObject, error) {
										  				}
												});
										  },
										  error: function(object,error) {

										  }
										});
									}
								});
						   });
						   $("#modificarCampo").unbind();
						   $("#modificarCampo").click(function() {
						   		//galf.updateCampo(e.currentTarget.id);
						   });
						   $("#eliminarCampo").unbind();
						   $("#eliminarCampo").click(function() {
						   		//galf.destroyCampo(e.currentTarget.id);
						   });						       					   
      		     });
				});
			});
	},
		placeMarker: function(position, map,evt) {
			if (backend.marker) {
				backend.marker.setPosition(position);
			}
			else {
				if (evt!=null) {
	        		backend.marker = new google.maps.Marker({
	     	   			position: position,
	          			map: map,
	          			draggable:true
	       			 });
	        	}
	        	else {
	        		backend.marker = new google.maps.Marker({
	     	   			position: position,
	          			map: map,
	          			draggable:false
	       			 });
	        	}	
	        }
	        map.panTo(position);
	        if (evt!=null) {
	       	 	backend.getLocationVars(evt);
	       	 	google.maps.event.addListener(backend.marker, 'dragend', function(evt){
    				backend.getLocationVars(evt);
				});
	       	}
	       	 backend.marker.setIcon(window.IMAGE_DOMAIN+"green_marker.png");		        
	},
	getLocationVars:function(evt) {
		backend.latitude= evt.latLng.lat().toFixed(6);
   		backend.longitude = evt.latLng.lng().toFixed(6);
		$("#posicionField").val(backend.latitude+","+backend.longitude);
	},
	init: function(){
		backend.hash = window.hash;
		if(backend.getUrlVars().section=="POIS"){
			backend.POISTable = $('#POISBackendTable').dataTable({ "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] } ] });
			backend.POISEnTaula();
			$("#addPOI").unbind();
			 $("#addPOI").click(function() {
			 	google.maps.visualRefresh = true;
			 	navigator.geolocation.getCurrentPosition(function(pos) {
					backend.latitude= pos.coords.latitude;
					backend.longitude= pos.coords.longitude;
					backend.mapOptions = {
         				 center: new google.maps.LatLng(backend.latitude, backend.longitude),
         				 zoom: 8,
          				 mapTypeId: google.maps.MapTypeId.ROADMAP,
          				  zoomControlOptions: {
        					  style: google.maps.ZoomControlStyle.LARGE,
      						  position: google.maps.ControlPosition.RIGHT_CENTER
    						}
    				}
	       		backend.map = new google.maps.Map(document.getElementById("googleMap"),backend.mapOptions);
	       		 $("#cerrarMapa").unbind();
	       		 $("#cerrarMapa").click(function(){
	   		   		$('#googleMap').removeClass("mostra").addClass("amaga");
	   		   		$('#cerrarMapa').removeClass("mostra").addClass("amaga");
	   		   	});
	   		   	$('#posicionField').unbind();
	   		   	$('#posicionField').click(function(){
	   		   		$('#googleMap').removeClass("amaga").addClass("mostra");
	   		   		$('#cerrarMapa').removeClass("amaga").addClass("mostra");
					 google.maps.event.addListener(backend.map, 'click', function(e) {
					         backend.placeMarker(e.latLng, backend.map,e);
					  });
					google.maps.event.trigger(backend.map, "resize");
	   		   });
	   		    galf.marker=null;
			   $("#addCampoNuevo").unbind();
			   $("#addCampoNuevo").click(function() {
			   		var POIObject={POI_name:'',POI_description:'',POI_telefon:'',POI_email:'',POI_postal:'',POI_ciutat:'',POI_codi_postal:'',POI_web:'',POI_web:'',POI_latitude:'',POI_longitude:'',POI_360url:'',POI_mini_logo:''};
			   		 backend.getWS("post",POIObject,"llista_POIs",
			function(data){
			console.log(data);
			   });
			   $('#prevImg').attr('src', window.IMAGE_DOMAIN+'placeholder.png');	
			   $("#logoField").val("");
			   $("#telefonoField").val("");
			   $("#posicionField").val("");
			   $("#cerrarMapa").trigger("click");
			   $('#myPOI').reveal();
			 });
		 });
		}
	}
};


(function(win, doc, ns, undefined) {
    win.onload = function(){
        ns.init();
    };
}(window, document, backend)); 