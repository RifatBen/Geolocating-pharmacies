<?php
require_once('views/View.php');

class ControllerHoraires {
  private $_view;
  private $_PharmacienManager;
  private $_PharmacienUpdateManager;
  private $_CongeManager;
  private $_GardeManager;

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
    $this->_CongeManager = new CongeManager;
    $this->_GardeManager = new GardeManager;

    date_default_timezone_set('Africa/Algiers');
    
    $info = $this->_PharmacienManager->getPharmacien($_SESSION['id']);
    $info2 = $this->_CongeManager->getConges($_SESSION['id']);
    $info3 = $this->_GardeManager->getGardes($_SESSION['id']);

    if(isset($_POST['submit-1'])) {
      $this->_PharmacienUpdateManager->updateWorkTime($info['id'], $_POST['ouverture'], $_POST['fermeture']);
      header('Location: Horaires');
    }

    if(isset($_POST['submit-2'])) {
      $this->_CongeManager->setConge($info['id'], $_POST['debut'], $_POST['fin']);
      header('Location: Horaires');
    }

    if(isset($_POST['submit-3'])) {
      $this->_GardeManager->setGarde($info['id'], $_POST['date'], $_POST['debut'], $_POST['fin']);
      header('Location: Horaires');
    }

    if(isset($_POST['submit-del-conge'])) {
      $this->_CongeManager->deleteConge($_POST['id']);
      header('Location: Horaires');
    }

    if(isset($_POST['submit-del-garde'])) {
      $this->_GardeManager->deleteGarde($_POST['id']);
      header('Location: Horaires');
    }

    $data = array('ouverture' => $info['ouverture'], 'fermeture' => $info['fermeture'], 'conges' => $info2, 'gardes' => $info3);

    $this->_view = new View('pharmacien/horaires');
    $this->_view->generate($data);
  }
}