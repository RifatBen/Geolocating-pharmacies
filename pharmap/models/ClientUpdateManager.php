<?php

class ClientUpdateManager extends Model {

  public function updateInfo($id, $nom, $prenom, $tel) {
    $str = "UPDATE clients SET nom = '".$nom."', prenom = '".$prenom."', tel = '".$tel."' WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function updatePass($id, $oldPass, $newPass) {
    $str = "SELECT password FROM clients WHERE id = ".$id;
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();

    if($info['password'] == sha1($oldPass)) {
      $str = "UPDATE clients SET password = '".sha1($newPass)."' WHERE id = ".$id;

      $req = $this->getBdd()->prepare($str);
      $req->execute();

      echo '<script>
      document.getElementById("submit-pass-err").style.color="green";
      document.getElementById("submit-pass-err").textContent="Votre mot de passe a été modifié avec succès";
      </script>';
    } else {
      echo '<script>document.getElementById("submit-pass-err").textContent="Ancient Mot de passe incorrect";</script>';
    }
  }

  public function deleteAccount($id, $pass) {
    $str = "SELECT password FROM clients WHERE id = ".$id;
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();

    if($info['password'] == sha1($pass)) {
      $str = "DELETE FROM clients WHERE id = ".$id;
      $req = $this->getBdd()->prepare($str);
      $req->execute();
      
      header('Location: Deconnexion');
    } else {
      return '<script>document.getElementById("submit-del-err").textContent="Mot de passe incorrect";</script>';
    }
  }

}