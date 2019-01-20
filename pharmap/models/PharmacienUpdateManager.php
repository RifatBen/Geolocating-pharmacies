<?php

class PharmacienUpdateManager extends Model {

  public function updateName($id, $nom, $prenom) {
    $str = "UPDATE pharmaciens SET nom = '".$nom."', prenom = '".$prenom."' WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function updatePharma($id, $nompharma, $tel, $assurance) {
    $str = "UPDATE pharmaciens SET nompharma = '".$nompharma."', tel = '".$tel."', assurance = ".$assurance." WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function updatePass($id, $oldPass, $newPass) {
    $str = "SELECT password FROM pharmaciens WHERE id = ".$id;
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();

    if($info['password'] == sha1($oldPass)) {

      $str = "UPDATE pharmaciens SET password = '".sha1($newPass)."' WHERE id = ".$id;
      
      $req = $this->getBdd()->prepare($str);
      $req->execute();

      return '<script>
      document.getElementById("submit-pass-err").style.color="green";
      document.getElementById("submit-pass-err").textContent="Votre mot de passe a été modifié avec succès";
      </script>';
    } else {
      return '<script>document.getElementById("submit-pass-err").textContent="Ancient mot de passe incorrect";</script>';
    }
  }

  public function updateGeo($id, $lat, $lng) {
    $str = "UPDATE pharmaciens SET lat = ".$lat.", lng = ".$lng." WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function updateWorkTime($id, $ouverture, $fermeture) {
    $str = "UPDATE pharmaciens SET ouverture = '".$ouverture."', fermeture = '".$fermeture."' WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function deleteAccount($id, $pass) {
    $str = "SELECT password FROM pharmaciens WHERE id = ".$id;
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();

    if($info['password'] == sha1($pass)) {
      $str = "DELETE FROM conges WHERE id_pharmacien = ".$id;
      $req = $this->getBdd()->prepare($str);
      $req->execute();
      
      $str = "DELETE FROM gardes WHERE id_pharmacien = ".$id;
      $req = $this->getBdd()->prepare($str);
      $req->execute();

      $str = "DELETE FROM pharmaciens WHERE id = ".$id;
      $req = $this->getBdd()->prepare($str);
      $req->execute();
      
      header('Location: Deconnexion');
    } else {
      return '<script>document.getElementById("submit-del-err").textContent="Mot de passe incorrect";</script>';
    }
  }

}