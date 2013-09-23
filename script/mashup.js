;var googleMaps = googleMaps || {};
googleMaps = {
	initialize: function() {
        var mapOptions = {
          center: new google.maps.LatLng(41.61736, 0.619354),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        googleMaps.map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        googleMaps.poiTable();
        googleMaps.tooltip();
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
	tooltip: function() {
			$( document ).tooltip({
	      position: {
	        my: "center bottom-20",
	        at: "center top",
	        using: function( position, feedback ) {
	          $( this ).css( position );
	          $( "<div>" )
	            .addClass( "arrow" )
	            .addClass( feedback.vertical )
	            .addClass( feedback.horizontal )
	            .appendTo( this );
	        }
	      }
	    });
	},
	getLocationParameters: function(address){
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
       		 googleMaps.map.setCenter(results[0].geometry.location);
       		 console.log(address +" " + results[0].geometry.location);
       		 var marker = new google.maps.Marker({
	       		 map: googleMaps.map,
	       		 position: results[0].geometry.location
	       	});
	    } else {
        	alert("Geocode was not successful for the following reason: " + status);
        }
    });
		  
	},
	clickPOI:function (direccio) {
			console.log(googleMaps.getLocationParameters(direccio));
	},
	poiTable: function() {
		var POITableList;
		var ampleFinestra=200;
		var margesFinestra=10;
		var marginTopFinestra=120;
		var windowsize = $(window).width();
		googleMaps.getWS(
			"llista_POIs",
			function(data){	
				$.each(data.llistaPOI, function(index,value){
				googleMaps.direccio = value["POI_postal"] + "," + value["POI_ciutat"];
				//'<input type="button" onClick="gotoNode(\'' + result.name + '\')" />'
					$("#llistaPOI").append('<li><div onclick="googleMaps.getLocationParameters(\''+googleMaps.direccio+'\')" class="POIElement" id="POI'+value["id"]+'"><span>'+value["POI_name"]+'</span></div></li>');
					
				});
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

			},
			function(error){
				console.log(error);
		 	}
		 );
		
   	}
   	
};


(function(win, doc, ns, undefined) {
	win.onload = function(){
		ns.initialize();
	};
}(window, document, googleMaps))

