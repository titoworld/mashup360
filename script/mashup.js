;var googleMaps = googleMaps || {};
googleMaps = {
	initialize: function() {
        var mapOptions = {
          center: new google.maps.LatLng(41.61736, 0.619354),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        googleMaps.map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        googleMaps.markerArray = [];
        googleMaps.clusterStyes=[];
        googleMaps.poiTable();
        googleMaps.toggleViewer();
	},
	get_API_URL: function() {
		urlServidor = "http://api.farrepuche.com/";
		return urlServidor;	
	},
	map_recenter: function(map,latlng,offsetx,offsety) {
	    var point1 = map.getProjection().fromLatLngToPoint(
	        (latlng instanceof google.maps.LatLng) ? latlng : map.getCenter()
	    );
	    var point2 = new google.maps.Point(
	        ( (typeof(offsetx) == 'number' ? offsetx : 0) / Math.pow(2, map.getZoom()) ) || 0,
	        ( (typeof(offsety) == 'number' ? offsety : 0) / Math.pow(2, map.getZoom()) ) || 0
	    );  
	    map.setCenter(map.getProjection().fromPointToLatLng(new google.maps.Point(
	        point1.x - point2.x,
	        point1.y + point2.y
	    )));
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
	
	toggleViewer: function () {
			$("#enrenou").click(function() {
		    	$("#viewer360").slideToggle("fast");
		    	 var myLatlng = new google.maps.LatLng(41.62975,0.628817);
				  var mapOptions = {
				    zoom: 15,
				    center: myLatlng,
				    mapTypeId: google.maps.MapTypeId.ROADMAP
				  }
				  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
				
				  var marker = new google.maps.Marker({
				      position: myLatlng,
				      map: map,
				      title:"Hello World!"
				  });	
				  googleMaps.map_recenter(map,myLatlng,0,100);
		    });
	},
	clusteringMarkers: function(map,markers){
			var markerClusterer = new MarkerClusterer(map, markers, {styles: googleMaps.clusterStyles, maxZoom:13});
				markerClusterer.setGridSize(15);
				$('.map_container').gmap('set', 'MarkerClusterer', markerClusterer);
				 	
		},
	createMarker: function(map,name,lat,lng,html) {
		   var myLatlng = new google.maps.LatLng(lat,lng);
			var contentString =html;
			var infowindow = new google.maps.InfoWindow({
		        content: ""
		    });
		    var marker = new google.maps.Marker({
		        position: myLatlng,
		        map: map,
		        bounds: true,
		        icon:'http://images.farrepuche.com/green_marker.png',
		        title: name
		    });
		    googleMaps.markerArray.push(marker);
		    $("#llistaPOI").append('<li><div class="POIElement" id="'+name+'"><span>'+name+'</span></div></li>');	
		    google.maps.event.addListener(marker, 'click', function() {
		      infowindow.open(map,marker);
		    });
		
		    google.maps.event.addDomListener(document.getElementById(name), 'click', function() {
		      infowindow.open(map,marker);
		    });
		     googleMaps.clusterStyles.push({
			    opt_textColor: 'transparent',
			    textColor: '#000000',
			    url: 'http://images.farrepuche.com/green_cluster.png',
			    height: 35,
			    width: 35
			}); 
		 },
	loadScript: function() {
		    var script = document.createElement('script');
		    script.type = 'text/javascript';
		    script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&' +
		        'callback=initialize';
		    document.body.appendChild(script);
		 },

	poiTable: function(){
		var geocoder = new google.maps.Geocoder();
		var map;
		var latitude;
		var longitude;
		var address;
		googleMaps.pointsArray=[];
		googleMaps.clusterStyles=[];
		var map = googleMaps.map;
		googleMaps.getWS(
			"llista_POIs",
		  function(data){	
			$.each(data.llistaPOI, function(index,value){
				address= value["POI_postal"] + "," + value["POI_ciutat"];
					geocoder.geocode( { 'address': address}, function(results, status) {
					  var myLatlng = new google.maps.LatLng(42.4,0.1);
					  var mapOptions = {
				      zoom: 4,
				      center: myLatlng,
				      mapTypeId: google.maps.MapTypeId.ROADMAP
				    };
				    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
					if (status == google.maps.GeocoderStatus.OK) {	
						latitude =results[0].geometry.location.lat();
						longitude = results[0].geometry.location.lng();
					}
					else {
						alert("Geocode was not successful for the following reason: " + status);
					 }
					    //googleMaps.createMarker(map,value["POI_name"],results[0].geometry.location.lat(),results[0].geometry.location.lng(),"<span>"+value["POI_description"]+"</span>");
					    console.log(latitude + " " + longitude);
					googleMaps.createMarker(map,value["POI_name"],value["POI_name"],latitude,longitude,"<span>hola</span>");
				    	if (index == data.llistaPOI.length -1) {
							googleMaps.clusteringMarkers(map,$('.map_container').gmap('get', 'markers'));
							googleMaps.poiWindow();
										
							}
					
			
					 
				 });
			});
		});
		
		
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
					  // footerContent: "<img style='vertical-align:middle;' src='img/star.png'> This is a nice plugin :^)"
					  footerContent: "Selecciona el POI"
			    });
				$(window).resize(function() {
					  var windowsize = $(window).width();
					  POITableList.move(windowsize-(ampleFinestra+margesFinestra), marginTopFinestra);
				});

	}
   	
};


(function(win, doc, ns, undefined) {
	win.onload = function(){
		ns.initialize();
	};
}(window, document, googleMaps))

