<?php
require_once('views/View.php');

class ControllerGeo {
  private $_view;
  private $_PharmacienManager;
  private $_PharmacienUpdateManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(!isset($_SESSION['id'])) {
        header('Location: ./');
      } else {
        $this->open();
      }
    }
  }

  private function open() {
    $this->_PharmacienManager = new PharmacienManager;
    $this->_PharmacienUpdateManager = new PharmacienUpdateManager;
    
    $info = $this->_PharmacienManager->getPharmacien($_SESSION['id']);

    if(isset($_POST['submit'])) {
      $this->_PharmacienUpdateManager->updateGeo($info['id'], $_POST['lat'], $_POST['lng']);
      header('Location: Geo');
    }

    $data = array('lat' => $info['lat'], 'lng' => $info['lng']);

    $this->_view = new View('pharmacien/geolocalisation');
    $this->_view->generate($data);
  }
}