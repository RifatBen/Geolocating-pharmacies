<link rel="stylesheet" href="views/pharmacien/composants/formulaire.css">
<div class="skewedBox"></div>

<div class="row row-form">
  <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 formulaire">
    <a href="./">Retourner vers la carte</a>
    <h2 class="titre">Formulaire d'inscription</h2>
    <p class="qst">Vous êtes déjà inscris ? <a href="./Connexion">se connecter</a></p>
    <div id="submit-err" class="titre val-err"></div>

    <form method="POST" name="vform" onsubmit="return Valider()">
      <h4 class="titre">Informations du compte</h4>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" autocomplete="off">
        <div id="nom-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" autocomplete="off">
        <div id="prenom-err" class="val-err"></div>
      </div>
      
      <div class="form-group">
        <label for="email">Adresse électronique</label>
        <input type="text" name="email" id="email" class="form-control" autocomplete="off">
        <div id="email-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
        <div id="password-err" class="val-err"></div>
      </div>

      <h4 class="titre">Information sur la pharmacie</h4>
      <div class="form-group">
        <label for="nom">Nom de la pharmacie</label>
        <input type="text" name="nompharma" id="nompharma" class="form-control" autocomplete="off">
        <div id="nompharma-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="numero">Numéro d’inscription à l’ordre des pharmaciens</label>
        <input type="text" name="numero" id="numero" class="form-control" autocomplete="off">
        <div id="numero-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="tel">Numéro de téléphone de la pharmacie</label>
        <input type="text" name="tel" id="tel" class="form-control" autocomplete="off">
        <div id="tel-err" class="val-err"></div>
      </div>

      <label>Système d'assurance sociale</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="casnos" name="casnos">
        <label class="form-check-label" for="casnos">CASNOS</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="cnas" name="cnas">
        <label class="form-check-label" for="cnas">CNAS</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="camssp" name="camssp">
        <label class="form-check-label" for="camssp">CAMSSP</label>
      </div>
        
      <h4 class="titre">Informations de géolocalisation et horaires</h4>
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
        <script src="views/pharmacien/composants/position.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKs1wa7sFFxVQYgRLROQLmt61Qeq84lLQ&callback=initMap"></script>

        <input type="hidden" name="lat" id="lat" value="">
        <input type="hidden" name="lng" id="lng" value="">
        <div id="position-err" class="val-err"></div>
      </div>
      
      <div class="form-group">
        <label for="ouverture">Horaires d'ouverture</label>
        <input type="time" name="ouverture" id="ouverture" class="form-control">
        <div id="ouverture-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="fermeture">Horaires de fermeture</label>
        <input type="time" name="fermeture" id="fermeture" class="form-control">
        <div id="fermeture-err" class="val-err"></div>
      </div>
        
      <div class="row">
        <div class="col-md-6 offset-md-6 col-sm-12">
          <button type="submit" name="submit" class="btn btn-primary">Valider</button>                  
        </div>
      </div>

    </form>
  </div>
</div>

<script src="views/pharmacien/composants/erreurInscription.js"></script>