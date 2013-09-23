;var googleMaps = googleMaps || {};
googleMaps = {
		initialize: function(){
		googleMaps.markerArray=[];
		googleMaps.clusterStyles=[]; 
			 var myLatlng = new google.maps.LatLng(42.4,0.1);
			 var mapOptions = {
				 zoom: 4,
				 center: myLatlng,
				 mapTypeId: google.maps.MapTypeId.ROADMAP
				 };
			googleMaps.map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			googleMaps.poiTable();
		},
	
		get_API_URL: function() {
			urlServidor = "http://api.farrepuche.com/";
			return urlServidor;	
		},
		clustering: function(){
			var markerClusterer = new MarkerClusterer(googleMaps.map, googleMaps.markerArray, {styles: googleMaps.clusterStyles, maxZoom:13});
			markerClusterer.setGridSize(15);
			$('.map_container').gmap('set', 'MarkerClusterer', markerClusterer); 	
		},
		createMarker: function(idPOI,name,lat,lng,html) {
				var myLatlng = new google.maps.LatLng(lat,lng);
				var contentString =html;
				var name=name.replace(" ","");
			    var marker = new google.maps.Marker({
			        position: myLatlng,
			        map: googleMaps.map,
			        id: idPOI,
			        contentBubble: contentString,
			        bounds: true,
			        icon:'http://images.farrepuche.com/green_marker.png',
			        title: name
			    });
			    googleMaps.markerArray.push(marker);
			    $("#llistaPOI").append(" <li><div class='POIElement "+idPOI+"'><span>"+name+"</span></div></li>");
			    google.maps.event.addListener(marker, 'click', function() {
			      googleMaps.infowindow.open(googleMaps.map,marker);
			    });
			
		      googleMaps.clusterStyles.push({
			    opt_textColor: 'transparent',
			    textColor: '#000000',
			    url: 'http://images.farrepuche.com/green_cluster.png',
			    height: 35,
			    width: 35
			});
			console.log(googleMaps.clusterStyles);
	 
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
			reattach: function(){
				$.each(googleMaps.markerArray, function(index,value){
					googleMaps.infowindow = new google.maps.InfoWindow({
						content: value.contentBubble
					});
					var infowindow= googleMaps.infowindow;
					$("."+value.id).click(function() {
						    infowindow.open(googleMaps.map,value);
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
							   icon: "http://www.fstoke.me/favicon.ico",
							   width: ampleFinestra,
							   height: 500,
							   maxWidth: 200,
							   maxHeight: 500,
							   x: (windowsize-(ampleFinestra+margesFinestra)),
							   y: marginTopFinestra,
							   title: "Llista de POIs",
							   content: $("#POITable").html(), 
							   onShow: function(wnd){
								   googleMaps.reattach();
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
			var address,unique_id;
			googleMaps.pointsArray=[];
			googleMaps.clusterStyles=[];
			googleMaps.getWS(
				"llista_POIs",
			  function(data){	
				$.each(data.llistaPOI, function(index,value){
					address= value["POI_postal"] + "," + value["POI_ciutat"];
						geocoder.geocode( { 'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {	
							latitude =results[0].geometry.location.lat();
							unique_id= value["POI_id"];
							longitude = results[0].geometry.location.lng();
							googleMaps.createMarker(unique_id,value["POI_name"],latitude,longitude,"<span>"+value["POI_description"]+"</span>");
							if (index==data.llistaPOI.length-1){
								googleMaps.clustering();	
								googleMaps.poiWindow();
							}
						}
						else {
							alert("Geocode was not successful for the following reason: " + status);
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
  