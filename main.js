/*
The groundStationMapper class uses AJAX to connect with the
NASA Satellite Situation Center web service to collect
ground station information and map it using Google Maps 
geocoding API.
*/
function groundStationMapper(){
	//Class Variables
	this.map;
	
	//Class methods
	this.init = init;
	this.loadGroundStations = loadGroundStations;
	this.addNewMarker = addNewMarker;
	//this.processLongLat = processLongLat;
	
	function init(){
		this.loadGroundStations();
		//Init Map
		var latlng = new google.maps.LatLng(0, 0);
		var options = { zoom: 2, center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP 
			// This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
		};
		// Calling the constructor, thereby initializing the map
		this.map = new google.maps.Map(document.getElementById('map_div'), options);
		
		//this.addNewMarker(42, -121, 'au');
	}
	
	function loadGroundStations(){
		getStationRequest = new XMLHttpRequest();
		
		//This function will fire when we have our station information
		getStationRequest.onreadystatechange = function(){
			if (getStationRequest.readyState == 4 && getStationRequest.status == 200){
				//Evaluate JSON => Array of objects
				var stations = eval(getStationRequest.responseText);				
				//For each station, try to geocode a country for custom markers
				for (key in stations){
					var httpRequest = new XMLHttpRequest();

					//This fires when geocoder returns.
					httpRequest.onreadystatechange = function(){
						if (httpRequest.readyState == 4 && httpRequest.status == 200){
							this.mapOwner.addNewMarker(
								this.station.latitude,
								this.station.longitude,
								httpRequest.responseText,
								this.station.name,
								this.station.latitude + ", " + 
								this.station.longitude);
						}
					}
					httpRequest.mapOwner = this.mapOwner;
					httpRequest.station = stations[key];
					httpRequest.open("GET",
						"geocodeLongLat.php?lat=" + stations[key].latitude +
						"&long="+ stations[key].longitude, false);
					httpRequest.send();
				}
			}
		}
		//Don't forget whose map you're editing
		getStationRequest.mapOwner = this;
		getStationRequest.open("GET","loadStations.php", true);
		getStationRequest.send();
	}
	function addNewMarker(lat, lng, country, name, info){
		if (country != '' && country != "None"){
			//If country is known, then place a flag for it.
			var image = new google.maps.MarkerImage('png/'+country+'.png', null,
				null, new google.maps.Point(16, 11), new google.maps.Size(32,22));
			
			var marker1 = new google.maps.Marker( {
				position: new google.maps.LatLng(lat, lng),
				map: this.map, icon: image} );
		}else{
			//Otherwise we should use the default pin.
			var marker1 = new google.maps.Marker( {
				position: new google.maps.LatLng(lat, lng), 
				map: this.map} );
		}
		// Add listener for a click on the pin
		google.maps.event.addListener(marker1, 'click', function() {
			infowindow1.open(this.map, marker1); } );
		
		// Add information window
		var infowindow1 = new google.maps.InfoWindow({content:createInfo(name, info)});
		// Create information window
		function createInfo(name, info) {
			return '<div class="infowindow"><strong>'+ name +
			'</strong><br/>'+ info +'</div>'; }
	}
	//function processLongLat(
}