<link rel="stylesheet" href="views/client/composants/formulaire.css">
<div class="skewedBox"></div>

<div class="row row-form">
  <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 formulaire">
    <a href="./">Retourner vers la carte</a>
    <h2 class="titre">Formulaire d'inscription</h2>
    <p class="qst">Vous êtes déjà inscris ? <a href="Connexionclient">se connecter</a></p>
    <div id="submit-err" class="titre val-err"></div>

    <form method="POST" name="vform" onsubmit="return Valider()">
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
      <div class="form-group">
        <label for="tel">Numéro de téléphone</label>
        <input type="text" name="tel" id="tel" class="form-control" autocomplete="off">
        <div id="tel-err" class="val-err"></div>
      </div>
        
      <div class="row">
        <div class="col-md-6 offset-md-6 col-sm-12">
          <button type="submit" name="submit" class="btn btn-primary">Valider</button>                  
        </div>
      </div>

    </form>
  </div>
</div>

<script src="views/client/composants/erreurInscription.js"></script>