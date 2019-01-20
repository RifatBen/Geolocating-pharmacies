<?php
require_once('views/View.php');

class ControllerAccueil {
  private $_view;
  private $_ClientManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(isset($_SESSION['id'])) {
        header('Location: Compte');
      } else {
        $this->open();
      }
    }
  }

  private function open() {

    $this->_MapManager = new MapManager;
    $listpos = $this->_MapManager->getPositions();

    date_default_timezone_set('Africa/Algiers');

    echo "<markers>\n";
    foreach($listpos as $pos) {
      echo "<marker ";
      echo 'lat="'.$pos['lat'].'" ';
      echo 'lng="'.$pos['lng'].'" ';
      echo 'ouverture="'.$pos['ouverture'].'" ';
      echo 'fermeture="'.$pos['fermeture'].'" ';
      echo 'nom="'.$pos['nompharma'].'" ';
      echo 'tel="'.$pos['tel'].'" ';

      echo 'assurance="';
      $assurance = decbin($pos['assurance']);
      if($assurance > 0) {
        if((int)($assurance / 100)) {
          echo ' CASNOS';
          $assurance -= 100;
        }
        if((int)($assurance / 10)) {
          echo ' CNAS';
          $assurance -= 10;
        }
        if((int)($assurance)) {
          echo ' CAMSSP';
        }
      } else {
        echo 'aucune';
      }
      echo '" ';

      echo 'conge="';
      $conges = true;
      $listConges = $this->_MapManager->getConges($pos['id']);
      foreach($listConges as $conge) {
        if($conges && date("Y-m-d") >= $conge['cong_debut'] && date("Y-m-d") < $conge['cong_fin']) {
          echo 't" cdebut="'.$conge['cong_debut'].'" cfin="'.$conge['cong_fin'].'" ';
          $conges = false;
        }
      }
      if($conges) {
        echo 'f" ';
      }

      echo 'garde="';
      $gardes = true;
      $listGardes = $this->_MapManager->getGardes($pos['id']);
      foreach($listGardes as $garde) {
        if($garde['garde_debut'] >= $garde['garde_fin']) {
          $dateTime = new DateTime('yesterday');
          if($gardes && (date("Y-m-d") == $garde['garde_date'] || ($dateTime->format('Y-m-d') == $garde['garde_date'] && date("H:i:sa") <= $garde['garde_fin']))) {
            echo 't2" gdebut="'.$garde['garde_debut'].'" gfin="'.$garde['garde_fin'].'" ';
            $gardes = false;
          }
        } else {
          if($gardes && date("Y-m-d") == $garde['garde_date'] && date("H:i:sa") <= $garde['garde_fin']) {
            echo 't1" gdebut="'.$garde['garde_debut'].'" gfin="'.$garde['garde_fin'].'" ';
            $gardes = false;
          }
        }
             
      }
      if($gardes) {
        echo 'f" ';
      }

      echo "/>\n";
    }
    echo "</markers>\n\n";


    $data = array();
    if(isset($_SESSION['idClient'])) {
      $this->_ClientManager = new ClientManager;
      $info = $this->_ClientManager->getClient($_SESSION['idClient']);
      $data = array(
        'nom' => $info['nom']
      );
    }

    $this->_view = new View('user/accueil');
    $this->_view->generate($data);

  }
}