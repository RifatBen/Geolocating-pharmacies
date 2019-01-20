<?php

class MapManager extends Model {

  public function getPositions() {
    $str = "SELECT id, lat, lng, ouverture, fermeture, nompharma, tel, assurance FROM pharmaciens";

    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $pos = $req->fetchAll();

    return $pos;
  }

  public function getGardes(int $id) {
    $str = "SELECT garde_date, garde_debut, garde_fin FROM gardes WHERE id_pharmacien = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $gardes = $req->fetchAll();

    return $gardes;
  }

  public function getConges(int $id) {
    $str = "SELECT cong_debut, cong_fin FROM conges WHERE id_pharmacien = ".$id;

    $req = $this->getBdd()->prepare($str);
    $req->execute();
    $conges = $req->fetchAll();

    return $conges;
  }

}