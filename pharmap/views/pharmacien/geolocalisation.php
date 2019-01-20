<link rel="stylesheet" href="views/pharmacien/composants/profil.css">
<nav class="navbar fixed-top"></nav>
  
<div class="row">
  <div class="col-perso-1 col-md-3">
    <a href="Compte" class="btn btn-light">Informations<br>du compte</a>
    <a href="Horaires" class="btn btn-light">Informations<br>sur les horaires</a>
    <a href="Geo" class="btn btn-light active">Informations<br>de géolocalisation</a>
    <a href="Deconnexion" class="btn btn-warning">Déconnexion</a>
  </div>
  
  <div class="col-perso-2 col-md-9 offset-md-3">

    <div class="box-info">
      <form method="POST" name="vform" onsubmit="return Valider()">
        <h4 class="titre">Informations de géolocalisation</h4>
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
            
        <button type="button" id="localisation" class="btn btn-primary bouton-validation" onclick="codeAddress()">Localiser</button>
            
        <div class="form-group">
          <label>Localisation de la pharmacie</label>
          <div id="position"></div>
          <script src="views/pharmacien/composants/position2.js"></script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKs1wa7sFFxVQYgRLROQLmt61Qeq84lLQ&callback=initMap"></script>
      
          <input type="hidden" name="lat" id="lat" value="<?= $lat ?>">
          <input type="hidden" name="lng" id="lng" value="<?= $lng ?>">
          <div id="position-err" class="val-err"></div>
        </div>
          
        <div class="row">
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit" class="btn btn-primary">Valider</button>                  
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
    
<script src="views/pharmacien/composants/erreurGeo.js"></script>