<?php

class GardeManager extends Model {

  public function setGarde($id, $date, $debut, $fin) {
    $str = "INSERT INTO gardes (id_pharmacien, garde_date, garde_debut, garde_fin) VALUES (".$id.", '".$date."', '".$debut."', '".$fin."')";

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

  public function getGardes($id) {
    $str = "SELECT id, garde_date, garde_debut, garde_fin FROM gardes WHERE id_pharmacien = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
    return $req->fetchAll();
  }

  public function deleteGarde($id) {
    $str = "DELETE FROM gardes WHERE id = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
  }

}