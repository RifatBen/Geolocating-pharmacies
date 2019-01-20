<link rel="stylesheet" href="views/pharmacien/composants/profil.css">
<nav class="navbar fixed-top"></nav>
  
<div class="row">
  <div class="col-perso-1 col-md-3">
    <a href="Compte" class="btn btn-light">Informations<br>du compte</a>
    <a href="Horaires" class="btn btn-light active">Informations<br>sur les horaires</a>
    <a href="Geo" class="btn btn-light">Informations<br>de géolocalisation</a>
    <a href="Deconnexion" class="btn btn-warning">Déconnexion</a>
  </div>

  <div class="col-perso-2 col-md-9 offset-md-3">

    <div class="box-info">
      <form method="POST" name="vform4" onsubmit="return Valider4()">
        <h4 class="titre">Informations sur les horaires de travail</h4>
        <div class="form-group">
          <label for="ouverture">Horaires d'ouverture</label>
          <input type="time" name="ouverture" id="ouverture" value="<?= $ouverture ?>" class="form-control">
          <div id="ouverture-err" class="val-err"></div>
        </div>
        <div class="form-group">
          <label for="fermeture">Horaires de fermeture</label>
          <input type="time" name="fermeture" id="fermeture" value="<?= $fermeture ?>" class="form-control">
          <div id="fermeture-err" class="val-err"></div>
        </div>
    
        <div class="row">
          <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
            <button type="submit" name="submit-1" class="btn btn-primary">Valider</button>                  
          </div>
        </div>
      </form>
    </div>


    
<div class="box-info">
  <form method="POST" name="vform6" onsubmit="return Valider6()">
    <h4 class="titre">Informations sur les Gardes</h4>
    <div class="form-group">
      <label for="date">Date de la garde</label>
      <input type="date" name="date" id="date" value="<?= $date ?>" class="form-control">
      <div id="gdate-err" class="val-err"></div>
    </div>
    <div class="form-group">
      <label for="debut">Heure de début</label>
      <input type="time" name="debut" id="debut" value="<?= $debut ?>" class="form-control">
      <div id="gdebut-err" class="val-err"></div>
    </div>
    <div class="form-group">
      <label for="fin">Heure de fin</label>
      <input type="time" name="fin" id="fin" value="<?= $fin ?>" class="form-control">
      <div id="gfin-err" class="val-err"></div>
    </div>

    <div class="row">
      <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
        <button type="submit" name="submit-3" class="btn btn-primary">Ajouter</button>                  
      </div>
    </div>
  </form><hr>

<?php if(!empty($gardes)) { ?>
  <h5 class="titre">Liste des gardes</h5>
  <br>
  <div class="table-responsive table-borderless">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">date de garde</th>
          <th scope="col">debut</th>
          <th scope="col">fin</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($gardes as $value) { ?>
        <tr
<?php
  if($value['garde_debut'] >= $value['garde_fin']) {
    $date_tmp = strtotime("+1 day", strtotime($value['garde_date']));
    if(date("Y-m-d", $date_tmp) < date("Y-m-d")) {
      echo 'class="depase"';
    } else if(date("Y-m-d", $date_tmp) == date("Y-m-d")) {
      if(date("H-i", strtotime($value['garde_fin'])) < date("H-i")) {
        echo 'class="depase"';
      }
    }
  } else {
      $date_tmp = strtotime($value['garde_date']);
      if(date("Y-m-d", $date_tmp) < date("Y-m-d")) {
          echo 'class="depase"';
      } else if(date("Y-m-d", $date_tmp) == date("Y-m-d")) {
          if(date("H-i", strtotime($value['garde_fin'])) < date("H-i")) {
              echo 'class="depase"';
          }
      }
  }
?>
        >
          <td><?= $value['garde_date'] ?></td>
          <td><?= date("H:i", strtotime($value['garde_debut'])) ?></td>
          <td><?= date("H:i", strtotime($value['garde_fin'])) ?></td>
          <td>
            <form method="POST">
              <input type="hidden" name="id" value="<?= $value['id'] ?>">
              <button type="submit" name="submit-del-garde" class="btn btn-link btn-delete">X</button>
            </form>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } else { echo '<tr><td colspan="4">vous n\'avez pas de gardes</td></tr>'; } ?>
</div>


<div class="box-info">
  <form method="POST" name="vform5" onsubmit="return Valider5()">
    <h4 class="titre">Informations sur les Congés</h4>
    <div class="form-group">
      <label for="debut">Date de début</label>
      <input type="date" name="debut" id="debut" value="<?= $debut ?>" class="form-control">
      <div id="debut-err" class="val-err"></div>
    </div>
    <div class="form-group">
      <label for="fin">Date de fin</label>
      <input type="date" name="fin" id="fin" value="<?= $fin ?>" class="form-control">
      <div id="fin-err" class="val-err"></div>
    </div>

    <div class="row">
      <div class="col-lg-3 offset-lg-9 col-md-6 offset-md-6 col-sm-12 none-padd">
        <button type="submit" name="submit-2" class="btn btn-primary">Ajouter</button>                  
      </div>
    </div>
  </form><hr>

<?php if(!empty($conges)) { ?>
  <h5 class="titre">Liste des congés</h5>
  <br>
  <div class="table-responsive table-borderless">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">debut</th>
          <th scope="col">fin</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($conges as $value) { ?>
        <tr <?php if(date("Y-m-d", strtotime($value['cong_fin'])) < date("Y-m-d")) echo 'class="depase"'; ?>>
          <td><?= $value['cong_debut'] ?></td>
          <td><?= $value['cong_fin'] ?></td>
          <td>
            <form method="POST">
              <input type="hidden" name="id" value="<?= $value['id'] ?>">
              <button type="submit" name="submit-del-conge" class="btn btn-link btn-delete">X</button>
            </form>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } else { echo '<tr><td colspan="4">vous n\'avez pas de congés</td></tr>'; } ?>
</div>

  </div>
</div>
  
<script src="views/pharmacien/composants/erreurHoraires.js"></script>