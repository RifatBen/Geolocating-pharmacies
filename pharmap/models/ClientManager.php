<?php

class ClientManager extends Model {

  public function setClient($form) {
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
  
      $str = "INSERT INTO clients (nom, prenom, email, password, tel) VALUES ";
      $str .= "('".$form['nom']."','".$form['prenom']."','".$form['email']."','".sha1($form['password'])."','".$form['tel']."');";
  
      $req = $this->getBdd()->prepare($str);
      $req->execute();

      echo '<script>
      submit_err = document.getElementById("submit-err");
      submit_err.style.color="green";
      submit_err.textContent="Votre compte a été créé avec succès";
      </script>';

    } else {
      echo '<script>document.getElementById("submit-err").textContent="Adresse électronique déjà utilisé";</script>';
    }
  }



  public function getClient($id) {
    $str = "SELECT * FROM clients WHERE id = '".$id."'";
    
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $info = $req->fetch();
    return $info;
  }
  


  public function authentification($form) {
    $str = "SELECT id, email, password FROM clients WHERE email = '".$form['email']."'";
    
    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $count = $req->rowCount();

    if($count > 0) {

      $auth = $req->fetch();
      if($auth['password'] == sha1($form['password'])) {

        $_SESSION['idClient'] = $auth['id'];

        header('Location: ./');

      } else {
        return '<script>document.getElementById("submit-err").textContent="Mot de passe incorrect";</script>';
      }

    } else {
      return '<script>document.getElementById("submit-err").textContent="Ce compte n\'existe pas";</script>';
    }
  }
}