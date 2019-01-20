var geocoder;
var map;

var latitude = document.forms["vform"]["lat"];
var longitude = document.forms["vform"]["lng"];
var position_err = document.getElementById("position-err");

function initMap() {
	geocoder = new google.maps.Geocoder();

	if(latitude != "" && longitude != "") {

		positionPharma = {lat: parseFloat(latitude.value), lng: parseFloat(longitude.value)};
		map = new google.maps.Map(document.getElementById('position'), {
			zoom: 15,
			center: positionPharma
		});

		var pharma = new google.maps.Marker({
			map: map,
			position: positionPharma
		});

		pharma.info = new google.maps.InfoWindow({
			content: 'Position de votre pharmacie.'
		});
		pharma.info.open(map, pharma);
		google.maps.event.addListener(pharma, 'click', function() {
			pharma.info.open(map, pharma);
		});

	}
}

function codeAddress() {
	var adresse;
	if(document.getElementById('ville').value !== "")
		adresse = document.getElementById('ville').value;

	if(document.getElementById('commune').value !== "")
		adresse += ', ' + document.getElementById('commune').value;

	if(document.getElementById('adresse').value !== "")
		adresse += ', ' + document.getElementById('adresse').value;

	geocoder.geocode( { 'address': adresse}, function(results, status) {
		if (status == 'OK') {
			initMap();

			map.setCenter(results[0].geometry.location);
			map.setZoom(15);

			var pharma = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});

			pharma.info = new google.maps.InfoWindow({
				content: 'Position de votre pharmacie.'
			});
			pharma.info.open(map, pharma);
			google.maps.event.addListener(pharma, 'click', function() {
				pharma.info.open(map, pharma);
			});
			
			latitude.value = results[0].geometry.location.lat();
			longitude.value = results[0].geometry.location.lng();
      		position_err.innerHTML = "";
		} else {
     		position_err.textContent = "le Geocode n'a pas réussi";
		}
	});
}