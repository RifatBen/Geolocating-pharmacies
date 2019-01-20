var map;
var geocoder;
var service;
var directionsService;
var directionsDisplay;

var on = true;
var activeInfoWindow;
var resultRech = document.getElementById("listRes");

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 35.5, lng: 3.3}
  });

  geocoder = new google.maps.Geocoder();
  service = new google.maps.DistanceMatrixService();
  directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);

  if(on) {
    document.getElementById('localisation').click();
    on = false;
  }

}

document.getElementById('localisation').addEventListener('click', function() {
  codeAddress();
});





function codeAddress() { // -> Point de Recherche
  // BEGIN : Recuperer l'adresse
	var adresse = "";
	if(document.getElementById('ville').value !== "")
		adresse = document.getElementById('ville').value;
	if(document.getElementById('commune').value !== "")
		adresse += ', ' + document.getElementById('commune').value;
	if(document.getElementById('adresse').value !== "")
    adresse += ', ' + document.getElementById('adresse').value;
  //// END : Recuperer l'adresse

  if(adresse != "") {

    // BEGIN : Geocodage
	  geocoder.geocode({'address': adresse}, function(results, status) {
      if(status == 'OK') {
        codePharma(results[0].geometry.location);
      } else {
        document.getElementById("erreur-map").textContent="Erreur: Le service Geocoding a échoué";
      }
    });
    //// END : Geocodage

  } else {

    // BEGIN : Geolocalisation
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        codePharma(pos);
      }, function() {
        document.getElementById("erreur-map").textContent="Erreur: Le service de Geolocation a échoué";
      });
    } else {
      document.getElementById("erreur-map").textContent="Erreur: Votre navigateur ne supporte pas le service Geolocation";
    }
    //// END : Geolocalisation

  }

}





function codePharma(pos) {
  // BEGIN : Positionner le marqueur
  initMap();
  map.setCenter(pos);
  map.setZoom(16);

  var userPosition = new google.maps.Marker({
    position: pos,
    map: map
  });
  userPosition.info = new google.maps.InfoWindow({
    content: 'Votre position'
  });
  userPosition.info.open(map, userPosition);
  //// END : Positionner le marqueur


  // BEGIN : Recuperer la configuration
  var distmax = document.getElementById('distance').value;
  if(distmax == '')
    distmax = 10;
  var adritin;
  if (document.getElementById('apied').checked)
    adritin = document.getElementById('apied').value;
  if (document.getElementById('vehicule').checked)
    adritin = document.getElementById('vehicule').value;
  //// END : Recuperer la configuration


  // BEGIN : parcourir la liste des pharmacies
  resultRech.innerHTML = '<hr><br><center>Aucun resultat trouvé</center>';
  var noRechRes = true;

  var markers = document.getElementsByTagName('marker');
  Array.prototype.forEach.call(markers, function(markerElem) {

    var pharmaPoint = {
      lat: parseFloat(markerElem.getAttribute('lat')),
      lng: parseFloat(markerElem.getAttribute('lng'))
    };


    // BEGIN : calculer les distances
    service.getDistanceMatrix(
      {
        origins: [pos],
        destinations: [pharmaPoint],
        travelMode: adritin
      },
      function(response, status) {
        if (status == 'OK') {
          var results = response.rows[0].elements;
          var distance = results[0].distance.text;

          if(distmax != "" && parseFloat(distmax) >= parseFloat(distance.replace(',', '.'))) {
            var fillColor = "#6c757d";

            
            // BEGIN : calculer l'ouverture et fermeture
            var d = new Date();
            var info_ouv = false;
            var info_cong = false;
            var info_garde = false;

            if(markerElem.getAttribute('conge') == 'f') { // -> les congés
              var debut_travail = markerElem.getAttribute('ouverture');
              debut_travail = debut_travail.split(':');
              var fin_travail = markerElem.getAttribute('fermeture');
              fin_travail =fin_travail.split(':');

              var d_ouverture = new Date();
              d_ouverture.setHours(debut_travail[0]);
              d_ouverture.setMinutes(debut_travail[1]);
              var d_fermeture = new Date();
              d_fermeture.setHours(fin_travail[0]);
              d_fermeture.setMinutes(fin_travail[1]);
              
              if(d.getTime() >= d_ouverture.getTime() && d.getTime() <= d_fermeture.getTime()) {
                fillColor = "#28a760";
                info_ouv = true;
              }
            } else {
              info_cong = true;
            }

            if(markerElem.getAttribute('garde') == 't1' || markerElem.getAttribute('garde') == 't2') { // -> les gardes
              var debut_garde = markerElem.getAttribute('gdebut');
              debut_garde = debut_garde.split(':');
              var fin_garde = markerElem.getAttribute('gfin');
              fin_garde = fin_garde.split(':');

              var d_gdebut = new Date();
              d_gdebut.setHours(debut_garde[0]);
              d_gdebut.setMinutes(debut_garde[1]);
              var d_gfin = new Date();
              d_gfin.setHours(fin_garde[0]);
              d_gfin.setMinutes(fin_garde[1]);
              
              info_garde = true;
            
              if(markerElem.getAttribute('garde') == 't1') {
  
                if(d.getTime() >= d_gdebut.getTime() && d.getTime() <= d_gfin.getTime()) {
                  fillColor = "#28a760";
                  info_ouv = true;
                }
  
              } else if(markerElem.getAttribute('garde') == 't2') {

                if(d.getTime() >= d_gdebut.getTime() || d.getTime() <= d_gfin.getTime()) {
                  fillColor = "#28a760";
                  info_ouv = true;
                }

              }

            }
            // END : calculer l'ouverture et fermeture

          
            // BEGIN : afficher les marqueurs
            var icon = {
              path: 'M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z',
              fillColor: fillColor,
              fillOpacity: 1,
              strokeColor: '#f8f9fa',
              strokeWeight: 2,
              scale: 0.65
            };
            var pharmarker = new google.maps.Marker({
              map: map,
              icon: icon,
              position: pharmaPoint
            });
            //// END : afficher les marqueurs


            // BEGIN : liste des pharmacies
            if(noRechRes) {
              resultRech.innerHTML = '';
              noRechRes = false;
            }

            var contentString = '<hr><br><div class="content">';
            contentString += "<center>" + markerElem.getAttribute('nom') + "</center><br>";

            if(info_ouv)
              contentString += "status : <span style=\"color:green;\">ouvert</span>";
            else
              contentString += "status : <span style=\"color:red;\">fermé</span>";

            if(info_cong) {
              contentString += "<br>debut du congé : " + markerElem.getAttribute('cdebut');
              contentString += "<br>fin du congé : " + markerElem.getAttribute('cfin') + "<br>";
            } else {
              contentString += "<br>heure d'ouverture : " + markerElem.getAttribute('ouverture');
              contentString += "<br>heure de fermeture : " + markerElem.getAttribute('fermeture') + "<br>";
            }
            
            if(info_garde) {
              contentString += "<br>debut de la garde : " + markerElem.getAttribute('gdebut');
              contentString += "<br>fin de la garde : " + markerElem.getAttribute('gfin') + "<br>";
            }
            

            contentString += "<br> assurance sociale : " + markerElem.getAttribute('assurance');
            contentString += "<br> distance : " + distance;
            contentString += "<br> numéro de téléphone : " + markerElem.getAttribute('tel') + "<br>";

            contentString += '<br><center><button onclick="setCenter(' + pharmaPoint.lat + ', ' + pharmaPoint.lng + ')" class="btn btn-info">Afficher la pharmacie</button>';
            contentString += '<button onclick="setDirection(' + pos.lat + ', ' + pos.lng + ', ' + pharmaPoint.lat + ', ' + pharmaPoint.lng + ', \'' + adritin + '\')" class="btn btn-info btn-info-perso">Afficher l\'itinéraire</button></center>';
            contentString += '</div>';

            resultRech.innerHTML += contentString;
            //// END : liste des pharmacies

          }

        } else {
          document.getElementById("erreur-map").textContent="Erreur: Le service Directions a échoué";
        }
      });
      //// END : calculer les distances

  });
  //// END : parcourir la liste des pharmacies
  
}



function setCenter(phlat, phlng) {
  map.setCenter({ lat: phlat, lng: phlng });
  map.setZoom(18);

  clickMap();
}

function setDirection(poslat, poslng, phlat, phlng, adritin) {
  var request = {
    origin: { lat: poslat, lng: poslng },
    destination: { lat: phlat, lng: phlng },
    travelMode: adritin
  };

  // BEGIN : calculer l'itineraire
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    } else {
      document.getElementById("erreur-map").textContent="Erreur: Le service Distance Matrix a échoué";
    }
  });
  //// END : calculer l'itineraire

  clickMap();
}