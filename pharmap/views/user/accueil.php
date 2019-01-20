<link rel="stylesheet" href="views/user/composants/style.css">

<div class="row">
  <button class="btn btn-info action" id="action" type="button" onclick="affiche()">Afficher le menu d'options</button>
  <div class="col-md-3 menu" id="divacacher">
  
    <div id="resultat">
      <h5 class="titre">Liste des pharmacies</h5>
      <button type="button" class="btn btn-link" onclick="afficheRech()">formulaire de recherche</button>
      <div id="listRes"></div>
    </div>

    <form id="recherche">
      <h5 class="titre">Recherche de pharmacies</h5>
      <button type="button" class="btn btn-link" onclick="afficheRes()">liste des resultats</button>
      <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="commune">Commune</label>
        <input type="text" name="commune" id="commune" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="distance">Distance de recherche</label>
        <div class="input-group">
          <input type="number" name="distance" id="distance" value="10" class="form-control">
          <div class="input-group-prepend">
            <div class="input-group-text">Km</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Choix d'itinéraire</label>
        <div class="radio-div">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="itineraire" id="apied" value="WALKING" checked>
            <label class="form-check-label" for="apied">A pied</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="itineraire" id="vehicule" value="DRIVING">
            <label class="form-check-label" for="vehicule">Par vehicule</label>
          </div>
        </div>
      </div>
      
      <button type="button" id="localisation" class="btn btn-success">Valider</button>
      
      <hr>
      
<?php
if(isset($nom)) {
  echo '<p>Bienvenue '.$nom.'<br>';
  echo '<a href="CompteClient">informations sur le compte</a><br>';
  echo '<a href="Deconnexion">se déconnecter</a></p>';
} else { ?>

<p><a href="Connexion">se connecter en tant que pharmacien</a></p>
<p><a href="Connexionclient">se connecter en tant que client</a></p>

<?php } ?>

    </form>

    <div id="erreur-map"></div>
    <br>
  </div>

  <div class="col-md-9 map" id="divafficher">
    <div id="map"></div>
  </div>
</div>

<script src="views/user/composants/menu.js"></script>
<script src="views/user/composants/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKs1wa7sFFxVQYgRLROQLmt61Qeq84lLQ&callback=initMap"></script>