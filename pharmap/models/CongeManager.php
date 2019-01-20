<?php

class CongeManager extends Model {

  public function setConge($id, $debut, $fin) {
    if($debut < $fin) {
      $str = "INSERT INTO conges (id_pharmacien, cong_debut, cong_fin) VALUES (".$id.", '".$debut."', '".$fin."')";
  
      $req = $this->getBdd()->prepare($str);
      $req->execute();
    }
  }

  public function getConges($id) {
    $str = "SELECT id, cong_debut, cong_fin FROM conges WHERE id_pharmacien = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
    return $req->fetchAll();
  }

  public function deleteConge($id) {
    $str = "DELETE FROM conges WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

}