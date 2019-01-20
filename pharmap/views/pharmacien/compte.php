<link rel="stylesheet" href="views/pharmacien/composants/profil.css">
<nav class="navbar fixed-top"></nav>

<div class="row">
  <div class="col-perso-1 col-md-3">
    <a href="Compte" class="btn btn-light active">Informations<br>du compte</a>
    <a href="Horaires" class="btn btn-light">Informations<br>sur les horaires</a>
    <a href="Geo" class="btn btn-light">Informations<br>de géolocalisation</a>
    <a href="Deconnexion" class="btn btn-warning">Déconnexion</a>
  </div>

  <div class="col-perso-2 col-md-9 offset-md-3">

    <div class="box-info">
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
      
        <div class="row">
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit-1" class="btn btn-primary">Valider</button>                  
          </div>
        </div>
      </form>
    </div>

    <div class="box-info">
      <form method="POST" name="vform3" onsubmit="return Valider3()">
        <h4 class="titre">Information sur la pharmacie</h4>
        <div class="form-group">
          <label for="nom">Nom de la pharmacie</label>
          <input type="text" name="nompharma" id="nompharma" class="form-control"  value="<?= $nompharma ?>" autocomplete="off">
          <div id="nompharma-err" class="val-err"></div>
        </div>
        <div class="form-group">
          <label>Numéro d’inscription à l’ordre des pharmaciens</label>
          <input type="text" class="form-control" value="<?= $numero ?>" readonly>
        </div>
        <div class="form-group">
          <label for="tel">Numéro de téléphone de la pharmacie</label>
          <input type="text" name="tel" id="tel" class="form-control" value="<?= $tel ?>" autocomplete="off">
          <div id="tel-err" class="val-err"></div>
        </div>

        <label>Système d'assurance sociale</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="casnos" name="casnos" <?php if($c1) echo "checked"; ?>>
          <label class="form-check-label" for="casnos">CASNOS</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="cnas" name="cnas" <?php if($c2) echo "checked"; ?>>
          <label class="form-check-label" for="cnas">CNAS</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="camssp" name="camssp" <?php if($c3) echo "checked"; ?>>
          <label class="form-check-label" for="camssp">CAMSSP</label>
        </div>
    
        <div class="row">
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit-3" class="btn btn-primary">Valider</button>                  
          </div>
        </div>
      </form>
    </div>
      
    <div class="box-info">
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
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit-2" class="btn btn-primary">Valider</button>                  
          </div>
        </div>
      </form>
    </div>
    
    <div class="box-info">
      <form method="POST" name="vform4" onsubmit="return Valider4()">
        <h4 class="titre">Suppression du compte</h4>
        <p class="titre">L'exécution de cette action mènera à la suppression définitive de votre compte, et cette action est irréversible</p>

        <div id="submit-del-err" class="titre val-err"></div>
      
        <div class="form-group">
          <label for="password">Mot de passe du compte</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
    
        <div class="row">
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit-4" class="btn btn-danger">Valider</button>                  
          </div>
        </div>
      </form>
    </div>

  </div>
</div>

<script src="views/pharmacien/composants/erreurCompte.js"></script>