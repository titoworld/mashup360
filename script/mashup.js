;var googleMaps = googleMaps || {};
googleMaps = {
		initialize: function(){
		$("#adminSection").unbind();
		$("#adminSection").click(function() {
			window.location=window.BACKEND_DOMAIN;
		});
		googleMaps.markerArray=[];
		googleMaps.infoWindowArray=[];
		googleMaps.infoWindowListArray=[];
		googleMaps.clusterStyles=[]; 
			 var myLatlng = new google.maps.LatLng(42.4,0.1);
			 var mapOptions = {
				 zoom: 10,
				 center: myLatlng,
				 mapTypeId: google.maps.MapTypeId.ROADMAP
				 };
			googleMaps.map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			googleMaps.poiTable();
		},
	
		get_API_URL: function() {
			urlServidor = window.API_DOMAIN;
			return urlServidor;	
		},
		clustering: function(){
			var markerClusterer = new MarkerClusterer(googleMaps.map, googleMaps.markerArray, {styles: googleMaps.clusterStyles, maxZoom:13});
			markerClusterer.setGridSize(15);
			$('.map_container').gmap('set', 'MarkerClusterer', markerClusterer); 
			//  Create a new viewpoint bound
				var bounds = new google.maps.LatLngBounds ();
				for (var i = 0, LtLgLen = googleMaps.LatLngList.length; i < LtLgLen; i++) {
				 bounds.extend (googleMaps.LatLngList[i]);
				}
				//  Fit these bounds to the map
				googleMaps.map.fitBounds (bounds);
			},
			closeInfoWindows: function() {
			  for (var mkey in googleMaps.infoWindowArray) {
			    var mobj =  googleMaps.infoWindowArray[mkey];
			    mobj.close();
			  }
			   for (var mkey in googleMaps.infoWindowListArray) {
			    var mobj =   googleMaps.infoWindowListArray[mkey];
			    mobj.close();
			  }
			 
			},
		createMarker: function(lat,lng,value) {
				var idPOI = value["POI_id"];
				var name= value["POI_name"]
				var html="<span>"+value["POI_description"]+"</span>";
				var POIURL=value["POI_360url"];
				var myLatlng = new google.maps.LatLng(lat,lng);
				var contentString =html;
			    var marker = new google.maps.Marker({
			        position: myLatlng,
			        map: googleMaps.map,
			        id: idPOI,
			        url: POIURL,
			        contentBubble: contentString,
			        bounds: true,
			        icon:window.IMAGE_DOMAIN+'green_marker.png',
			        title: name
			    });
			    googleMaps.markerArray.push(marker);
			    $("#llistaPOI").append(" <li><div class='POIElement "+idPOI+"'>"+googleMaps.displayHTMLImage("placeholder_location.png","POIThumb"+idPOI,"thumbnail","POIThumb")+"<span class='POIThumb'>"+name+"</span></div></li>");
			    if(value["POI_mini_logo"]){
			  
				    $("#POIThumb"+idPOI).attr("src",window.UPLOADS_DOMAIN+"/POILogos/"+idPOI+"/"+value["POI_mini_logo"]);
			    }
			    googleMaps.infowindow = new google.maps.InfoWindow({
						content: html,
						minWidth:300,
						minHeight:300
				});
				googleMaps.infoWindowArray.push(googleMaps.infowindow);
				
				var infowindow= googleMaps.infowindow;
			    google.maps.event.addListener(marker, 'click', function() {
				    googleMaps.closeInfoWindows();
			        infowindow.open(googleMaps.map,marker);
			        googleMaps.displayPanorama(marker);
			    });
		      googleMaps.clusterStyles.push({
			    opt_textColor: 'transparent',
			    textColor: '#000000',
			    url: window.IMAGE_DOMAIN+'green_cluster.png',
			    height: 35,
			    width: 35
			});
	 
		},
		   getWS: function(url, success, fail){
				$.ajax({
		            type: "GET",
		            dataType: "json",
		            url: googleMaps.get_API_URL()+url,
		            cache: false,
		            success: function(data, status){
						if (data.status == "success"){
								success(data, status);	
						}
						else{
							setTimeout(function(){
								googleMaps.getWS(url,success,fail);
							}, 5000);
						}
		            },
		            error: function (xhr, ajaxOptions, thrownError) {
		            	//console.log(xhr);
						//console.log(ajaxOptions);
						//console.log(thrownError);
		            	fail(true);
		            }
		        });
			},
			displayHTMLImage: function(file, id, alt, classe){
				if (classe){
					return '<img  id="'+id+'" src="'+window.IMAGE_DOMAIN+file+'" class="'+classe+'" alt="'+alt+'" />';
				}
				else{
					return '<img id="'+id+'" src="'+window.IMAGE_DOMAIN+file+'" alt="'+alt+'" />';
				}
			},
			displayPanorama: function(marker){
				$("#viewer360").empty();
				$("#viewer360").attr("class","seixantaAmple");
				$("#section").attr("class","quarantaAmple");
				if (marker){
					$("#viewer360").append('<iframe src="'+marker.url+'"></iframe><div id="titleViewBar"><span class="titleLocation">'+marker.title+'</span><div id="toggleCaptionButton">'+googleMaps.displayHTMLImage("slideDownBar.png", "slideDownBar","slideBar")+'</div></div><div id="toggleViewerButton">'+googleMaps.displayHTMLImage("slideBar.png", "slideLeftBar","slideBar")+'</div>');
					$("#toggleViewerButton").unbind();
					$("#toggleViewerButton").click(function(){
						$("#viewer360").removeClass("seixantaAmple");
						$("#section").removeClass("quarantaAmple");	
					});
					$("#toggleCaptionButton").unbind();
					$("#toggleCaptionButton").click(function(){
						if ($("#titleViewBar").hasClass("baixaTitleBar")){
							$("#titleViewBar").removeClass("baixaTitleBar");
							$("#slideDownBar").attr("src",window.IMAGE_DOMAIN+"slideDownBar.png");
						}
						else{
							$("#titleViewBar").addClass("baixaTitleBar");
							$("#slideDownBar").attr("src",window.IMAGE_DOMAIN+"slideUpBar.png");
						}
					});
				}
			},
			linkListMarker: function(){
				$.each(googleMaps.markerArray, function(index,value){
					googleMaps.infowindow = new google.maps.InfoWindow({
						content: value.contentBubble,
						minWidth:300,
						minHeight:300
					});
					var infowindow= googleMaps.infowindow;
					googleMaps.infoWindowListArray.push(infowindow);
					$("."+value.id).click(function() {
							googleMaps.closeInfoWindows();
						    infowindow.open(googleMaps.map,value);
						    googleMaps.displayPanorama(value);
					});
				})
			},
			poiWindow: function(){
				var POITableList;
				var ampleFinestra=200;
				var margesFinestra=10;
				var marginTopFinestra=120;
				var windowsize = $(window).width();
				POITableList= $.window({
							   icon: window.IMAGE_DOMAIN+"green_marker.png",
							   width: ampleFinestra,
							   height: 500,
							   maxWidth: 200,
							   maxHeight: 500,
							   x: (windowsize-(ampleFinestra+margesFinestra)),
							   y: marginTopFinestra,
							   title: "Llista de POIs",
							   content: $("#POITable").html(), 
							   onShow: function(wnd){
								   googleMaps.linkListMarker();
							   },
							  // footerContent: "<img style='vertical-align:middle;' src='img/star.png'> This is a nice plugin :^)"
							  footerContent: "Selecciona el POI"
					    });
						$(window).resize(function() {
							  var windowsize = $(window).width();
							  POITableList.move(windowsize-(ampleFinestra+margesFinestra), marginTopFinestra);
						});
						
		},
			poiTable: function(){
			var geocoder = new google.maps.Geocoder();
			var latitude;
			var longitude;
			var POIURL;
			var address,unique_id;
			googleMaps.LatLngList=[];
			googleMaps.pointsArray=[];
			googleMaps.clusterStyles=[];
			googleMaps.getWS(
				"llista_POIs",
			  function(data){	
				$.each(data.llistaPOI, function(index,value){
					POIURL = value["POI_360url"];
					address= value["POI_postal"] + "," + value["POI_ciutat"];
						geocoder.geocode( { 'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {	
							latitude =results[0].geometry.location.lat();
							unique_id= value["POI_id"];
							longitude = results[0].geometry.location.lng();
							googleMaps.LatLngList[index] = new google.maps.LatLng (latitude,longitude);
							googleMaps.createMarker(latitude,longitude,value);
							if (index==data.llistaPOI.length-1){
								googleMaps.clustering();	
								googleMaps.poiWindow();
							}
						}
						else {
							console.log("Geocode was not successful for the following reason: " + status);
						 }
						 });
				});			
			});
		},
	
			loadScript: function() {
					var script = document.createElement('script');
					script.type = 'text/javascript';
					script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&' + 'callback=googleMaps.initialize';
					document.body.appendChild(script);
			},
	

};


(function(win, doc, ns, undefined) {
	win.onload = function(){
		ns.loadScript();
	};
}(window, document, googleMaps));
  