<?php

class PharmacienManager extends Model {

  public function setPharmacien($form) {
    $str = "SELECT email FROM pharmaciens WHERE email = '".$form['email']."'";
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $count1 = $req->rowCount();
    
    $str = "SELECT email FROM clients WHERE email = '".$form['email']."'";
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $count2 = $req->rowCount();

    $count = $count1 + $count2;

    if($count == 0) {
      $str = "SELECT numero FROM pharmaciens WHERE numero = '".$form['numero']."'";
      
      $req = $this->getBdd()->prepare($str);
      $req->execute();
      $count = $req->rowCount();

      if($count == 0) {

        $str = "SELECT lat, lng FROM pharmaciens WHERE lat = '".$form['lat']."' AND lng = '".$form['lng']."'";
        
        $req = $this->getBdd()->prepare($str);
        $req->execute();
        $count = $req->rowCount();

        if($count == 0) {

          if(isset($form['casnos'])) $c1 = true; else $c1 = false;
          if(isset($form['cnas'])) $c2 = true; else $c2 = false;
          if(isset($form['camssp'])) $c3 = true; else $c3 = false;
          $assurance = bindec(($c1*100) + ($c2*10) +$c3);
      
          $str = "INSERT INTO pharmaciens (nom, prenom, email, password, nompharma, numero, tel, assurance, lat, lng, ouverture, fermeture) VALUES ";
          $str .= "('".$form['nom']."','".$form['prenom']."','".$form['email']."','".sha1($form['password'])."','".$form['nompharma']."','".$form['numero']."','".$form['tel']."',".$assurance.",".$form['lat'].",".$form['lng'].",'".$form['ouverture']."','".$form['fermeture']."');";
      
          $req = $this->getBdd()->prepare($str);
          $req->execute();
    
          return '<script>
          submit_err = document.getElementById("submit-err");
          submit_err.style.color="green";
          submit_err.textContent="Votre compte a été créé avec succès";
          </script>';

        } else {
          return '<script>document.getElementById("submit-err").textContent="Adresse de pharmacie déjà utilisé";</script>';
        }

      } else {
        return '<script>document.getElementById("submit-err").textContent="Numéro d’inscription à l’ordre des pharmaciens déjà utilisé";</script>';
      }

    } else {
      return '<script>document.getElementById("submit-err").textContent="Adresse électronique déjà utilisé";</script>';
    }
  }



  public function getPharmacien($id) {
    $str = "SELECT * FROM pharmaciens WHERE id = '".$id."'";
    
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();
    return $info;
  }
  


  public function authentification($form) {
    $str = "SELECT id, email, password FROM pharmaciens WHERE email = '".$form['email']."'";
    
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $count = $req->rowCount();

    if($count > 0) {

      $auth = $req->fetch();
      if($auth['password'] == sha1($form['password'])) {

        $_SESSION['id'] = $auth['id'];

        header('Location: ./Compte');

      } else {
        return '<script>document.getElementById("submit-err").textContent="Mot de passe incorrect";</script>';
      }

    } else {
      return '<script>document.getElementById("submit-err").textContent="Ce compte n\'existe pas";</script>';
    }
  }
}