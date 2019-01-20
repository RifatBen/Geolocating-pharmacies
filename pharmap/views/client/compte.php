<link rel="stylesheet" href="views/client/composants/formulaire.css">
<div class="skewedBox"></div>

<div class="row row-form">
  <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 formulaire">
    <a href="./">Retourner vers la carte</a>

    <form method="POST" name="vform1" onsubmit="return Valider1()">
      <h4 class="titre">Informations du compte</h4>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="<?= $nom ?>" autocomplete="off">
        <div id="nom-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $prenom ?>" autocomplete="off">
        <div id="prenom-err" class="val-err"></div>
      </div>
      
      <div class="form-group">
        <label>Adresse électronique</label>
        <input type="text" class="form-control" value="<?= $email ?>" readonly>
      </div>
      <div class="form-group">
        <label for="tel">Numéro de téléphone</label>
        <input type="text" name="tel" id="tel" class="form-control" value="<?= $tel ?>" autocomplete="off">
        <div id="tel-err" class="val-err"></div>
      </div>
        
      <div class="row">
        <div class="col-md-6 offset-md-6 col-sm-12">
          <button type="submit" name="submit-1" class="btn btn-primary">Valider</button>                  
        </div>
      </div>

    </form>
  </div>

  <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 formulaire" style="margin-top:10px">
    <form method="POST" name="vform2" onsubmit="return Valider2()">
      <h4 class="titre">Modification du mot de passe</h4>
      <div id="submit-pass-err" class="titre val-err"></div>
      <div class="form-group">
        <label for="old-pass">Ancient mot de passe</label>
        <input type="password" name="old-pass" id="old-pass" class="form-control">
        <div id="old-pass-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="new-pass">Nouveau mot de passe</label>
        <input type="password" name="new-pass" id="new-pass" class="form-control">
        <div id="new-pass-err" class="val-err"></div>
      </div>
      <div class="form-group">
        <label for="confirm-pass">Confirmer le mot de passe</label>
        <input type="password" name="confirm-pass" id="confirm-pass" class="form-control">
        <div id="confirm-pass-err" class="val-err"></div>
      </div>
        
      <div class="row">
        <div class="col-md-6 offset-md-6 col-sm-12">
          <button type="submit" name="submit-2" class="btn btn-primary">Valider</button>                  
        </div>
      </div>

    </form>
  </div>

  <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 formulaire" style="margin-top:10px">
    <form method="POST">
      <h4 class="titre">Suppression du compte</h4>
      <p class="titre">L'exécution de cette action mènera à la suppression définitive de votre compte, et cette action est irréversible</p>

      <div id="submit-del-err" class="titre val-err"></div>
      
      <div class="form-group">
        <label for="password">Mot de passe du compte</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
        
      <div class="row">
        <div class="col-md-6 offset-md-6 col-sm-12">
          <button type="submit" name="submit-3" class="btn btn-danger">Valider</button>                  
        </div>
      </div>
    </form>
  </div>

</div>

<script src="views/client/composants/erreurCompte.js"></script>